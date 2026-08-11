<?php
/**
 * BES — Global Price Tax Note (v2)
 * Adds "(Price does not include tax 12.5%)" below visible price blocks.
 *
 * Smart detection covers:
 *   - Rp 4.999.000  |  Rp 4,999,000  |  Rp.4.999.000
 *   - Rp 199k       |  Rp 199 k      |  Rp 199K
 *   - IDR 2.989K ++ |  IDR 2,989K ++ |  IDR3.989K++
 *   - Inline suffixes: ++, +, *, †, ‡, net, nett, nta
 *   - Split typography across multiple <span>/<sup>/<em>/<strong>
 *   - Mixed whitespace, NBSP, zero-width characters
 *   - Lazy-loaded content (MutationObserver re-scan)
 *
 * Manual hooks:
 *   - <div data-bes-tax-skip="1">     → force-skip an element/subtree
 *   - <div data-bes-tax-target="1">   → force-treat an element as a price
 *
 * Debug mode (logs detections to console):
 *   - Append ?bes_tax_debug=1 to any URL
 *   - Or run window.besTaxDebug = true in the console before reload
 */

if (! function_exists('bes_global_price_tax_note_styles')) {
    add_action('wp_head', 'bes_global_price_tax_note_styles', 99);

    function bes_global_price_tax_note_styles()
    {
        if (is_admin()) return;
        ?>
        <style id="bes-global-price-tax-note-css">
            .bes-tax-note {
                display: block;
                width: 100%;
                margin: .35rem 0 1.1rem;
                font-size: 12px;
                line-height: 1.45;
                font-weight: 400;
                letter-spacing: .01em;
                text-align: inherit;
                opacity: 0;
                transform: translateY(-3px);
                transition: opacity .22s ease, transform .22s ease;
                pointer-events: none;
            }

            .bes-tax-note.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            .bes-tax-note--dark {
                color: rgba(255, 255, 255, .48);
            }

            .bes-tax-note--light {
                color: rgba(38, 51, 32, .62);
            }

            /* Tighter spacing when the note lives inside a cell / list item. */
            td > .bes-tax-note,
            th > .bes-tax-note,
            li > .bes-tax-note,
            dt > .bes-tax-note,
            dd > .bes-tax-note,
            .bes-tax-note--inside {
                margin: .25rem 0 0;
            }

            /* When the parent is a CSS grid, the note becomes an extra
               grid item and wraps to a new row in column 1. To prevent
               that we span the full row width — semantically nicer too,
               since the note applies to the whole row of prices. */
            .bes-tax-note--span {
                grid-column: 1 / -1;
                margin: 0;
                padding: .5rem 1.25rem .85rem;
                text-align: center;
            }
        </style>
        <?php
    }
}

if (! function_exists('bes_global_price_tax_note_script')) {
    add_action('wp_footer', 'bes_global_price_tax_note_script', 5);

    function bes_global_price_tax_note_script()
    {
        if (is_admin() || (function_exists('is_cart') && (is_cart() || is_checkout()))) return;
        ?>
        <script id="bes-global-price-tax-note-js">
            (function () {
                'use strict';

                // =========================================================
                // Config
                // =========================================================
                const NOTE_TEXT      = '(Price does not include tax 12.5%)';
                const NOTE_CLASS     = 'bes-tax-note';
                const PROCESSED_ATTR = 'data-bes-tax-processed';
                const SKIP_ATTR      = 'data-bes-tax-skip';
                const FORCE_ATTR     = 'data-bes-tax-target';
                const MAX_PRICE_LEN  = 60;   // an isolated price line should never be longer
                const MAX_BUBBLE_UP  = 8;    // how many ancestors to walk when promoting

                const DEBUG = (function () {
                    try {
                        if (typeof window === 'undefined') return false;
                        if (window.besTaxDebug === true) return true;
                        return /[?&]bes_tax_debug=1\b/.test(window.location.search);
                    } catch (e) { return false; }
                })();

                const SCAN_SELECTOR = [
                    'p', 'span', 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
                    'strong', 'b', 'em', 'i', 'sup', 'sub', 'mark', 'small',
                    'ins', 'time', 'data', 'output', 'dfn',
                    'figcaption', 'caption',
                    // Cells & list items — when the price is the entire cell text,
                    // these are the anchors we need to scan directly.
                    'td', 'th', 'li', 'dt', 'dd'
                ].join(',');

                const EXCLUDE_SELECTOR = [
                    '#wpadminbar', 'header', 'nav', 'footer',
                    'script', 'style', 'noscript',
                    'svg', 'canvas', 'iframe',
                    'form', 'input', 'textarea', 'select',
                    '.' + NOTE_CLASS,
                    '[' + SKIP_ATTR + ']',
                    'a', 'button'
                ].join(',');

                // Tags whose direct children are restricted (e.g. <tr> may only
                // contain <td>/<th>; <ul> may only contain <li>). If the price
                // wrapper resolves to one of these, we can NOT anchor the note
                // as its sibling — the browser will silently re-parent it out
                // of the table. We stop bubbling at the cell/item itself and
                // insert the note INSIDE that anchor instead.
                const RESTRICTED_PARENT_TAGS = /^(?:TR|THEAD|TBODY|TFOOT|TABLE|COLGROUP|UL|OL|DL|MENU)$/;

                // =========================================================
                // Regex — built from a string so escaping is easy to audit
                // =========================================================

                // Currency unit alternation
                const CURRENCY_SRC = '(?:Rp\\.?|IDR|USD|US\\$|\\$|€|£)';

                // Amount:
                //   1, 12, 123
                //   1.234, 1,234, 1.234.567, 1,234,567
                //   1.99, 1,99 (decimal)
                //   2.989K, 199k, 199 k, 199K, 12M  (optional kilo/mega/billion abbr.)
                const AMOUNT_SRC = '\\d{1,3}(?:[.,]\\d{3})*(?:[.,]\\d{1,2})?\\s*[kKmMbB]?';

                // Optional trailing tax marker: ++ + * † ‡ net nett nta
                const SUFFIX_SRC = '(?:\\+\\+|\\+|\\*|nett?|nta|†|‡)?';

                // Full price line: starts with currency, ends right after suffix.
                const PRICE_RE = new RegExp(
                    '^' + CURRENCY_SRC + '\\s*' + AMOUNT_SRC + '\\s*' + SUFFIX_SRC + '\\s*$',
                    'i'
                );

                // Token detectors for split-typography fragments:
                const TOKEN_CURRENCY = new RegExp('^' + CURRENCY_SRC + '$', 'i');
                const TOKEN_AMOUNT   = new RegExp('^' + AMOUNT_SRC + '$');
                const TOKEN_K_ALONE  = /^[kKmMbB]$/;
                const TOKEN_SUFFIX   = /^(?:\+\+|\+|\*|nett?|nta|†|‡)$/i;

                // =========================================================
                // Helpers
                // =========================================================
                function log() {
                    if (DEBUG && window.console && console.log) {
                        try {
                            console.log.apply(console, ['[bes-tax]'].concat([].slice.call(arguments)));
                        } catch (e) {}
                    }
                }

                function normalize(value) {
                    if (!value) return '';
                    return String(value)
                        // unicode spaces (NBSP, em-space, en-space, narrow-NBSP, etc.)
                        .replace(/[\u00a0\u1680\u2000-\u200a\u202f\u205f\u3000]/g, ' ')
                        // zero-width characters
                        .replace(/[\u200b-\u200d\ufeff]/g, '')
                        // collapse whitespace
                        .replace(/\s+/g, ' ')
                        .trim();
                }

                function isElement(node) {
                    return node && node.nodeType === 1;
                }

                function isExcluded(el) {
                    if (!isElement(el)) return true;
                    if (el.classList && el.classList.contains(NOTE_CLASS)) return true;
                    try {
                        if (el.closest && el.closest(EXCLUDE_SELECTOR)) return true;
                    } catch (e) { /* invalid selector envs */ }
                    return false;
                }

                function isVisible(el) {
                    if (!el || !el.getClientRects) return false;
                    if (!el.getClientRects().length) return false;
                    try {
                        const cs = window.getComputedStyle(el);
                        if (cs.display === 'none') return false;
                        if (cs.visibility === 'hidden' || cs.visibility === 'collapse') return false;
                        if (parseFloat(cs.opacity || '1') === 0) return false;
                    } catch (e) {
                        return false;
                    }
                    return true;
                }

                function isStruck(el) {
                    if (!el) return false;
                    try {
                        if (el.closest &&
                            el.closest('s, del, .line-through, .strikethrough, .price-was, .compare-at, .old-price')) {
                            return true;
                        }
                        const cs = window.getComputedStyle(el);
                        if ((cs.textDecorationLine || '').indexOf('line-through') !== -1) return true;
                    } catch (e) {}
                    return false;
                }

                /**
                 * Detect whether an element uses CSS Grid for layout.
                 * When this is the parent of our anchor, inserting the note
                 * as a sibling makes it an extra grid item that wraps to the
                 * next implicit row in column 1 — visually broken. We use
                 * this to switch to a row-spanning insertion mode instead.
                 */
                function isGridParent(el) {
                    if (!el) return false;
                    try {
                        const d = window.getComputedStyle(el).display;
                        return d === 'grid' || d === 'inline-grid';
                    } catch (e) {
                        return false;
                    }
                }

                function parseRgb(color) {
                    const m = String(color || '').match(
                        /rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)(?:\s*,\s*([\d.]+))?\s*\)/i
                    );
                    if (!m) return null;
                    return {
                        r: +m[1], g: +m[2], b: +m[3],
                        a: m[4] === undefined ? 1 : +m[4]
                    };
                }

                function isDarkContext(el) {
                    let node = el;
                    while (node && node !== document.documentElement) {
                        try {
                            const bg = parseRgb(window.getComputedStyle(node).backgroundColor);
                            if (bg && bg.a > 0.15) {
                                const lum = (0.2126 * bg.r) + (0.7152 * bg.g) + (0.0722 * bg.b);
                                return lum < 140;
                            }
                        } catch (e) {}
                        node = node.parentElement;
                    }
                    return true; // default: assume dark theme
                }

                // =========================================================
                // Price detection
                // =========================================================
                function isFullPriceText(text) {
                    if (!text || text.length > MAX_PRICE_LEN) return false;
                    if (!/\d/.test(text)) return false;   // must contain a digit
                    if (!/[a-z$€£]/i.test(text)) return false; // must contain a currency-ish char
                    return PRICE_RE.test(text);
                }

                function isPriceToken(text) {
                    if (!text || text.length > 20) return false;
                    return TOKEN_CURRENCY.test(text) ||
                           TOKEN_AMOUNT.test(text) ||
                           TOKEN_K_ALONE.test(text) ||
                           TOKEN_SUFFIX.test(text);
                }

                /**
                 * Walk up from startEl, returning the OUTERMOST ancestor whose
                 * normalized text is itself a complete price expression and nothing
                 * more. This is the safe anchor we attach the note after.
                 *
                 * Stops as soon as the parent's text overflows or stops matching.
                 */
                function findPriceWrapper(startEl) {
                    let current = startEl;
                    let best = null;

                    for (let i = 0; i < MAX_BUBBLE_UP && current; i++) {
                        if (isExcluded(current) || !isVisible(current) || isStruck(current)) break;

                        // Hard stop: never promote into <tr>/<table>/<ul>/etc.
                        // Those parents won't host a <p> child, so anchoring
                        // there would corrupt the layout.
                        if (RESTRICTED_PARENT_TAGS.test(current.tagName)) break;

                        const text = normalize(current.textContent);

                        if (text.length > MAX_PRICE_LEN) break;

                        if (isFullPriceText(text)) {
                            best = current;
                        } else if (best) {
                            // Parent no longer matches → previous best is the outermost.
                            break;
                        }

                        current = current.parentElement;
                    }

                    return best;
                }

                /**
                 * Returns the anchor element to insert the tax note after,
                 * or null if this element is not part of a price line.
                 */
                function findPriceTarget(el) {
                    if (isExcluded(el) || !isVisible(el) || isStruck(el)) return null;

                    // Manual override
                    if (el.getAttribute && el.getAttribute(FORCE_ATTR) === '1') {
                        return el;
                    }

                    const text = normalize(el.textContent);

                    // Direct match — this element already holds the whole price line.
                    if (isFullPriceText(text)) {
                        return findPriceWrapper(el) || el;
                    }

                    // Token match — this element is a fragment (currency, amount,
                    // bare "K", or "++"). Bubble up to find the wrapper.
                    if (isPriceToken(text)) {
                        const wrapper = findPriceWrapper(el.parentElement);
                        if (wrapper) return wrapper;
                    }

                    return null;
                }

                function hasNearbyTaxNote(el) {
                    if (!el || !el.parentElement) return true;

                    const parent = el.parentElement;

                    // When parent is a restricted container (td/li/etc.), our
                    // note lives INSIDE el — so look for it among descendants.
                    if (RESTRICTED_PARENT_TAGS.test(parent.tagName)) {
                        try {
                            if (el.querySelector('.' + NOTE_CLASS)) return true;
                        } catch (e) {}
                    }

                    const kids = parent.children;

                    for (let i = 0; i < kids.length; i++) {
                        const c = kids[i];
                        if (c === el) continue;

                        if (c.classList && c.classList.contains(NOTE_CLASS)) return true;

                        // Also catch hand-written notes the site may already render.
                        const txt = normalize(c.textContent || '');
                        if (txt.length < 120 && txt.toLowerCase().indexOf('does not include tax') !== -1) {
                            return true;
                        }
                    }

                    return false;
                }

                // =========================================================
                // Insertion
                // =========================================================
                function insertTaxNote(target) {
                    if (!target) return;
                    if (target.getAttribute(PROCESSED_ATTR) === '1') return;
                    target.setAttribute(PROCESSED_ATTR, '1');

                    if (hasNearbyTaxNote(target)) {
                        log('skip (already has note):', target);
                        return;
                    }

                    const note = document.createElement('p');

                    // Surgical placement, layout-aware:
                    //   1. Parent is <tr>/<ul>/<table>/etc. → cannot host a <p>
                    //      sibling. Insert INSIDE the target.
                    //   2. Parent is a CSS grid → inserting after the target
                    //      adds an extra grid item that wraps to a new row in
                    //      column 1. Insert AFTER and add --span so the note
                    //      spans the full grid row.
                    //   3. Anything else → plain sibling insertion.
                    const parent = target.parentElement;
                    const insertInside = !!(parent && RESTRICTED_PARENT_TAGS.test(parent.tagName));
                    const spanRow      = !insertInside && isGridParent(parent);

                    const modifier =
                        (isDarkContext(target) ? 'bes-tax-note--dark' : 'bes-tax-note--light') +
                        (insertInside ? ' ' + NOTE_CLASS + '--inside' : '') +
                        (spanRow      ? ' ' + NOTE_CLASS + '--span'   : '');

                    note.className = NOTE_CLASS + ' ' + modifier;
                    note.textContent = NOTE_TEXT;

                    if (insertInside) {
                        target.appendChild(note);
                    } else {
                        target.insertAdjacentElement('afterend', note);
                    }

                    requestAnimationFrame(function () {
                        note.classList.add('is-visible');
                    });

                    log(
                        'inserted',
                        insertInside ? 'inside' : (spanRow ? 'after (grid-span)' : 'after'),
                        target,
                        '| text:', normalize(target.textContent)
                    );
                }

                // =========================================================
                // Scanning
                // =========================================================
                function scan(root) {
                    const scope = (root && root.querySelectorAll) ? root : document;
                    const targets = new Set();

                    let nodes;
                    try {
                        nodes = scope.querySelectorAll(SCAN_SELECTOR);
                    } catch (e) {
                        return;
                    }

                    for (let i = 0; i < nodes.length; i++) {
                        const t = findPriceTarget(nodes[i]);
                        if (t) targets.add(t);
                    }

                    targets.forEach(insertTaxNote);
                }

                let queued = false;
                function queueScan() {
                    if (queued) return;
                    queued = true;
                    requestAnimationFrame(function () {
                        queued = false;
                        scan(document);
                    });
                }

                // =========================================================
                // Boot
                // =========================================================
                function boot() {
                    log('boot — debug =', DEBUG);
                    scan(document);

                    // Re-scan for builders, lazy load, tabs, accordions, transitions
                    setTimeout(queueScan, 250);
                    setTimeout(queueScan, 1000);
                    setTimeout(queueScan, 2500);
                    setTimeout(queueScan, 5000);

                    window.addEventListener('load', queueScan, { once: true });

                    if ('MutationObserver' in window && document.body) {
                        try {
                            new MutationObserver(queueScan).observe(document.body, {
                                childList: true,
                                subtree: true
                            });
                        } catch (e) {}
                    }
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', boot, { once: true });
                } else {
                    boot();
                }
            })();
        </script>
        <?php
    }
}