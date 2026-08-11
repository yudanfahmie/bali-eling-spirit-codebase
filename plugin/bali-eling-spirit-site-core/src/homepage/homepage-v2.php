<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — HOMEPAGE v2 (Parallel Preview Engine)
 * ============================================================================
 *
 * File:        homepage.v2.php
 * Shortcode:   [bes_home_content_v2]
 * Preview URL: any page hosting the shortcode + ?preview-v2=true
 *
 * PURPOSE
 *   A self-contained consolidated rewrite of the legacy fragmented homepage
 *   (index.php + herobanner / trustbar / about-intro / pillar / program /
 *    yoga-teacher / experienced / testimonials / blog / contact / faqs).
 *   Built strictly per the client-approved PDF revision document.
 *
 * GOLDEN RULES (enforced throughout this file)
 *   1. Legacy fragments are NEVER modified — they remain on disk for
 *      production use.
 *   2. Sections marked "HILANGKAN" in the PDF are NOT deleted from the DOM;
 *      they are wrapped in the Tailwind utility class `hidden` on the outer
 *      <section> wrapper to allow zero-risk rollback by simply removing the
 *      class.
 *   3. Section content/copy revisions are applied inline at the data layer
 *      (PHP arrays) wherever possible to keep the visual chrome intact.
 *   4. While ?preview-v2=true is active, the registered nav menu is REPLACED
 *      in full with the client-approved structure (About Us · Sanctuary ·
 *      Academy · Pasraman · Partnership · Wisdom). Outside preview mode the
 *      production menu is untouched.
 *
 * SECTION MAP (revisions per PDF)
 *   §1  Hero ........................ REVISED (4 new slides + WA CTA slide 4)
 *   §2  Trust Bar ................... REVISED (image strip + CORE VALUES ELING)
 *   §3  About Intro ................. SOFT-DELETED (hidden)
 *   §4  Three Pillars ............... SOFT-DELETED (hidden)
 *   §5  Programs (Eling Sanctuary) .. REVISED (categories + sub-block hidden)
 *   §6  Online Sessions ............. SOFT-DELETED (hidden, nested in §5 file)
 *   §7  Eling Academy (YTT) ......... REVISED (YTT / Wellness / Workshop YACEP)
 *   §8  Social & Community Program .. REVISED (Yoga / Meditasi / Pelukatan / Komunitas)
 *   §9  Live Google Reviews ......... REVISED (review widget mount + fallback)
 *   §10 Eling Pedia (Blog) .......... REVISED (heading + Indonesian tagline)
 *   §11 Begin Your Journey (Contact). REVISED (Indonesian copy)
 *   §12 FAQ ......................... REVISED (Indonesian header + intro)
 *
 * @package    BaliElingSpirit
 * @version    2.0.7-faq-feedback
 * @since      2026-06
 * ============================================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access
}

/* ============================================================================
 * PREVIEW-MENU INJECTION LOGIC
 * ----------------------------------------------------------------------------
 * Detects ?preview-v2=true on the current request and, while active, appends
 * the same parameter to every internal WordPress nav-menu link so the visitor
 * never leaves the v2 preview shell when they click around the header menu.
 *
 * Implementation notes:
 *   - The detection is wrapped in helpers so other modules can re-use it.
 *   - We hook `nav_menu_link_attributes` to rewrite href values at render time.
 *   - We only touch INTERNAL links (same host as home_url) — external links
 *     are left untouched.
 *   - Anchors (#...) and javascript: links are left untouched.
 *   - We are conservative: if the link already carries ?preview-v2=true we do
 *     nothing, avoiding duplicate params.
 * ============================================================================
 */

if ( ! function_exists( 'bes_v2_is_preview_active' ) ) {
    /**
     * Determine whether the v2 preview mode is currently active for this request.
     *
     * @return bool
     */
    function bes_v2_is_preview_active() {
        // Use REQUEST so the flag works both via GET (initial click) and
        // when carried inside form submissions — defensive default.
        if ( ! isset( $_REQUEST['preview-v2'] ) ) {
            return false;
        }
        $val = strtolower( (string) $_REQUEST['preview-v2'] );
        return in_array( $val, array( '1', 'true', 'yes', 'on' ), true );
    }
}

if ( ! function_exists( 'bes_v2_is_internal_url' ) ) {
    /**
     * Decide whether a given URL points to the same site as home_url().
     *
     * @param string $url
     * @return bool
     */
    function bes_v2_is_internal_url( $url ) {
        if ( empty( $url ) || ! is_string( $url ) ) {
            return false;
        }
        // Leave anchors and protocol-special links alone.
        $first = substr( ltrim( $url ), 0, 1 );
        if ( $first === '#' ) {
            return false;
        }
        if ( preg_match( '#^(javascript|mailto|tel|whatsapp):#i', $url ) ) {
            return false;
        }
        // Relative URLs (e.g. /about, ./foo) are always internal.
        if ( $first === '/' || strpos( $url, '://' ) === false ) {
            return true;
        }
        $home_host = wp_parse_url( home_url(), PHP_URL_HOST );
        $link_host = wp_parse_url( $url, PHP_URL_HOST );
        return ( $home_host && $link_host && strcasecmp( $home_host, $link_host ) === 0 );
    }
}

if ( ! function_exists( 'bes_v2_append_preview_param' ) ) {
    /**
     * Append ?preview-v2=true to an internal URL.
     *
     * @param string $url
     * @return string
     */
    function bes_v2_append_preview_param( $url ) {
        if ( ! bes_v2_is_internal_url( $url ) ) {
            return $url;
        }
        // If we already carry the flag, do nothing.
        $parsed = wp_parse_url( $url );
        if ( ! empty( $parsed['query'] ) ) {
            parse_str( $parsed['query'], $existing );
            if ( isset( $existing['preview-v2'] ) ) {
                return $url;
            }
        }
        return add_query_arg( 'preview-v2', 'true', $url );
    }
}

if ( ! function_exists( 'bes_v2_filter_nav_menu_link_attributes' ) ) {
    /**
     * WordPress filter callback — rewrites nav-menu link hrefs while preview
     * mode is active. Hooked unconditionally; the active check happens inside.
     *
     * @param array $atts
     * @return array
     */
    function bes_v2_filter_nav_menu_link_attributes( $atts ) {
        if ( ! bes_v2_is_preview_active() ) {
            return $atts;
        }
        if ( isset( $atts['href'] ) ) {
            $atts['href'] = bes_v2_append_preview_param( $atts['href'] );
        }
        return $atts;
    }
    add_filter( 'nav_menu_link_attributes', 'bes_v2_filter_nav_menu_link_attributes', 99 );
}

if ( ! function_exists( 'bes_v2_filter_page_menu_link_attributes' ) ) {
    /**
     * Companion filter for the fallback wp_page_menu() helper, in case the
     * active theme renders a page-list menu instead of a registered menu.
     *
     * @param array $atts
     * @return array
     */
    function bes_v2_filter_page_menu_link_attributes( $atts ) {
        return bes_v2_filter_nav_menu_link_attributes( $atts );
    }
    add_filter( 'page_menu_link_attributes', 'bes_v2_filter_page_menu_link_attributes', 99 );
}

/* ----------------------------------------------------------------------------
 * NEW-MENU REPLACEMENT
 * While preview mode is active, the entire registered nav menu is REPLACED
 * with the client-approved v2 structure:
 *
 *   ABOUT US · SANCTUARY · ACADEMY · PASRAMAN · PARTNERSHIP · WISDOM
 *
 * This is done via the `wp_nav_menu_objects` filter, which lets us hand
 * WordPress's menu walker a freshly-synthesized array of menu-item objects
 * just before they're rendered to HTML. The replacement is total — child
 * items, parent references, classes, and aria attributes are rebuilt from
 * scratch so the output matches WP's expected menu-item shape exactly.
 *
 * Why `wp_nav_menu_objects` rather than `wp_nav_menu_items`?
 *   - `wp_nav_menu_items` passes the already-rendered HTML string, which
 *     means we'd have to string-template the markup ourselves and risk
 *     breaking theme-specific menu styling.
 *   - `wp_nav_menu_objects` lets the theme's own walker render our items,
 *     so they inherit every CSS class, hover effect, and accessibility
 *     attribute the theme already applies to its real menu items. This is
 *     the WordPress-best-practice path.
 *
 * URLs are mapped to existing pages where possible; PASRAMAN and PARTNERSHIP
 * are deliberate placeholder slugs the client can create as real WP pages
 * later. Each URL is passed through `bes_v2_append_preview_param()` so the
 * visitor stays in the v2 preview shell when clicking through.
 * -------------------------------------------------------------------------- */

if ( ! function_exists( 'bes_v2_get_preview_menu_definition' ) ) {
    /**
     * Returns the canonical v2 menu blueprint. Single source of truth so the
     * same structure can be reused (e.g. by a fallback widget) without
     * duplication.
     *
     * @return array<int, array{title: string, slug: string}>
     */
    function bes_v2_get_preview_menu_definition() {
        return array(
            array( 'title' => 'About Us',    'slug' => 'about-us'    ),
            array( 'title' => 'Sanctuary',   'slug' => 'sanctuary'   ),
            array( 'title' => 'Academy',     'slug' => 'academy'     ),
            array( 'title' => 'Pasraman',    'slug' => 'pasraman'    ),
            array( 'title' => 'Partnership', 'slug' => 'partnership' ),
            array( 'title' => 'Wisdom',      'slug' => 'wisdom'      ),
        );
    }
}

if ( ! function_exists( 'bes_v2_build_menu_item' ) ) {
    /**
     * Synthesize a single WordPress menu-item object. Matches the shape that
     * `wp_get_nav_menu_items()` would normally return so theme walkers don't
     * choke on missing properties.
     *
     * @param int    $id
     * @param string $title
     * @param string $url
     * @return object
     */
    function bes_v2_build_menu_item( $id, $title, $url ) {
        $item = new stdClass();
        $item->ID               = $id;
        $item->db_id            = $id;
        $item->menu_item_parent = 0;
        $item->object_id        = $id;
        $item->object           = 'custom';
        $item->type             = 'custom';
        $item->type_label       = 'Custom Link';
        $item->title            = $title;
        $item->url              = $url;
        $item->target           = '';
        $item->attr_title       = '';
        $item->description      = '';
        $item->classes          = array( 'menu-item', 'menu-item-type-custom', 'menu-item-object-custom', 'bes-v2-preview-menu-item' );
        $item->xfn              = '';
        $item->current          = false;
        $item->current_item_ancestor = false;
        $item->current_item_parent   = false;
        return $item;
    }
}

if ( ! function_exists( 'bes_v2_filter_nav_menu_objects' ) ) {
    /**
     * Replace the rendered menu items with the v2 preview menu when the
     * preview flag is active. Untouched otherwise — production menus on
     * the live site behave exactly as they always have.
     *
     * @param array $items   Array of WP_Post menu-item objects.
     * @param object $args   wp_nav_menu() arguments (theme-supplied).
     * @return array
     */
    function bes_v2_filter_nav_menu_objects( $items, $args = null ) {
        if ( ! bes_v2_is_preview_active() ) {
            return $items;
        }

        $new_items = array();
        $base_id   = 9000; // High base so no collision with existing menu-item IDs.

        foreach ( bes_v2_get_preview_menu_definition() as $i => $node ) {
            $url = home_url( '/' . ltrim( $node['slug'], '/' ) . '/' );
            $url = bes_v2_append_preview_param( $url );
            $new_items[] = bes_v2_build_menu_item( $base_id + $i, $node['title'], $url );
        }

        return $new_items;
    }
    add_filter( 'wp_nav_menu_objects', 'bes_v2_filter_nav_menu_objects', 99, 2 );
}

/* ----------------------------------------------------------------------------
 * CLIENT-SIDE MENU REPLACEMENT (the bulletproof layer)
 * The PHP filters above are the "polite" way to do this, but they can be
 * bypassed by:
 *   - HTML page caches (FlyingPress, WP Rocket, Cloudflare APO, etc.) that
 *     serve a pre-rendered snapshot of the menu.
 *   - Theme builders like Elementor Pro Nav Menu widget which sometimes
 *     render menus through their own pipeline that doesn't fire
 *     `wp_nav_menu_objects` reliably.
 *   - Caching reverse proxies and Cloudflare edge cache.
 *
 * To guarantee the new menu is visible regardless of stack, we inject a
 * tiny vanilla-JS payload via `wp_footer` ONLY when `?preview-v2=true` is
 * active. The script:
 *   1. Locates every plausible menu container in the DOM.
 *   2. Replaces each container's <li> children with the v2 structure
 *      (About Us · Sanctuary · Academy · Pasraman · Partnership · Wisdom),
 *      copying the original first <li>'s class list so the new items
 *      inherit theme styling (typography, hover, spacing — everything).
 *   3. Appends `?preview-v2=true` to each link so click-through stays in
 *      the preview shell.
 *   4. Re-runs on a short delay to catch menus rendered late by Elementor's
 *     lazy widget initializer or by JS-driven mobile drawers.
 *
 * Outside preview mode the action callback short-circuits in PHP and emits
 * nothing — zero overhead on the production page.
 * -------------------------------------------------------------------------- */

if ( ! function_exists( 'bes_v2_render_client_menu_replacement' ) ) {
    /**
     * Emit the JS menu-replacement payload into wp_footer.
     *
     * GATING STRATEGY — why we do NOT gate on bes_v2_is_preview_active():
     *   The preview page (/homepage-v2/) may be visited with or without
     *   ?preview-v2=true in the URL.  If we gate on the query string here,
     *   the script is silently omitted whenever someone visits the page
     *   normally (e.g. after the team shares just the plain URL, or after
     *   FlyingPress serves a cached copy that strips query params).
     *
     *   Instead we gate on whether the current page actually contains the
     *   [bes_home_content_v2] shortcode — that's the permanent, reliable
     *   signal that this is the preview page and the new menu is wanted.
     *   The client-side JS then double-checks via the DOM sentinel element
     *   `#bes-home-main-v2` before touching anything, so it is fully
     *   inert on every other page on the site.
     */
    function bes_v2_render_client_menu_replacement() {
        global $post;

        /* Only emit on pages that actually render our shortcode. */
        if ( ! isset( $post ) || ! is_a( $post, 'WP_Post' ) ) {
            return;
        }
        if ( strpos( $post->post_content, 'bes_home_content_v2' ) === false ) {
            return;
        }

        $menu    = bes_v2_get_preview_menu_definition();
        $payload = array();
        foreach ( $menu as $node ) {
            $url       = home_url( '/' . ltrim( $node['slug'], '/' ) . '/' );
            $payload[] = array(
                'title' => $node['title'],
                'href'  => $url,
                'slug'  => $node['slug'],
            );
        }

        $payload_json = wp_json_encode( $payload );
        if ( false === $payload_json ) {
            return;
        }
        ?>
<script id="bes-v2-menu-replacement" data-bes-v2="menu">
(function () {
    'use strict';

    /* ── SENTINEL: only run on pages where our shortcode rendered ──────── */
    if (!document.getElementById('bes-home-main-v2')) return;

    var SITE = 'https://balielingspirit.com';
    var V2_MENU = <?php echo $payload_json; ?>;

    function inAdminBar(el) {
        for (var p = el; p; p = p.parentElement) {
            if (p.id === 'wpadminbar') return true;
        }
        return false;
    }

    /* ══════════════════════════════════════════════════════════════════════
     * STRATEGY A — bes-hdr (Elementor theme-builder header on this site)
     * Structure:
     *   <header id="bes-hdr">
     *     <nav aria-label="Primary">
     *       <div class="bes-h-link-wrapper">          ← one per nav item
     *         <a class="bes-h-link …" href="…">
     *           <span class="bes-h-dot"></span>
     *           <span class="bes-h-txt …">About Us</span>
     *         </a>
     *       </div>
     *       …
     *     </nav>
     *   </header>
     * We rebuild the wrapper divs in place.
     * ══════════════════════════════════════════════════════════════════════ */
    function rebuildBesHdr() {
        var hdr = document.getElementById('bes-hdr');
        if (!hdr || hdr.dataset.besV2 === '1') return false;

        /* Find the desktop nav (hidden on mobile, shown lg:flex) */
        var desktopNav = hdr.querySelector('nav[aria-label="Primary"]');
        if (!desktopNav) desktopNav = hdr.querySelector('nav');
        if (!desktopNav) return false;

        /* Clone one wrapper to preserve all classes/styles */
        var wrapperTemplate = desktopNav.querySelector('.bes-h-link-wrapper');
        var linkTemplate    = wrapperTemplate ? wrapperTemplate.querySelector('.bes-h-link') : null;
        var dotTemplate     = linkTemplate    ? linkTemplate.querySelector('.bes-h-dot')     : null;
        var txtClass        = linkTemplate    ? (linkTemplate.querySelector('.bes-h-txt') || {}).className || '' : '';
        var linkClass       = linkTemplate    ? linkTemplate.className : 'bes-h-link bes-focus px-3 xl:px-4 py-2 flex items-center gap-1.5';
        var wrapClass       = wrapperTemplate ? wrapperTemplate.className : 'relative group bes-h-link-wrapper';

        /* Remove all existing link-wrapper divs */
        var existing = Array.prototype.slice.call(desktopNav.querySelectorAll('.bes-h-link-wrapper'));
        existing.forEach(function (el) { el.parentNode.removeChild(el); });

        /* Inject new items */
        V2_MENU.forEach(function (item, i) {
            var wrapper = document.createElement('div');
            wrapper.className = wrapClass;

            var a = document.createElement('a');
            a.href      = item.href;
            a.className = linkClass;
            a.setAttribute('style', 'animation-delay:' + (0.2 + i * 0.08) + 's');

            if (dotTemplate) {
                var dot = document.createElement('span');
                dot.className = dotTemplate.className;
                a.appendChild(dot);
            }

            var txt = document.createElement('span');
            txt.className   = txtClass || 'bes-h-txt text-[10.5px] xl:text-[11px] font-body font-bold uppercase tracking-nav';
            txt.textContent = item.title;
            a.appendChild(txt);

            /* Keris stripe (decorative underline) */
            var stripe = document.createElement('span');
            stripe.className = 'bes-keris-stripe w-10 bg-gradient-to-r from-transparent via-bes-leaf to-transparent';
            a.appendChild(stripe);

            wrapper.appendChild(a);
            desktopNav.appendChild(wrapper);
        });

        hdr.dataset.besV2 = '1';

        /* ── Mobile drawer (id="bes-drawer") ─────────────────────────────
           Same site, separate element. Rebuild its nav links too. */
        rebuildBesDrawer();
        return true;
    }

    function rebuildBesDrawer() {
        var drawer = document.getElementById('bes-drawer');
        if (!drawer || drawer.dataset.besV2 === '1') return;

        /* Drawer uses same bes-h-link-wrapper pattern */
        var drawerNav = drawer.querySelector('nav, ul, [class*="drawer-nav"]');
        if (!drawerNav) return;

        var existing = Array.prototype.slice.call(drawerNav.querySelectorAll('.bes-h-link-wrapper, a[class*="bes-h"]'));
        existing.forEach(function (el) { el.parentNode.removeChild(el); });

        V2_MENU.forEach(function (item) {
            var a = document.createElement('a');
            a.href = item.href;
            a.className = 'block py-3 font-body font-bold uppercase tracking-[0.18em] text-bes-ivory hover:text-bes-leaf transition-colors duration-300';
            a.textContent = item.title;
            drawerNav.appendChild(a);
        });

        drawer.dataset.besV2 = '1';
    }

    /* ══════════════════════════════════════════════════════════════════════
     * STRATEGY B — Standard WP wp_nav_menu UL output + Hello Theme nav
     * Targets: #menu-main-menu, .site-navigation ul.menu, etc.
     * ══════════════════════════════════════════════════════════════════════ */
    var UL_SELECTORS = [
        '#menu-main-menu',
        '#menu-main-menu-1',
        '.site-navigation ul.menu',
        '.site-navigation-dropdown ul.menu'
    ];

    function rebuildUL(ul) {
        if (!ul || ul.tagName !== 'UL') return false;
        if (inAdminBar(ul)) return false;
        if (ul.dataset.besV2 === '1') return false;
        /* Skip sub-menus */
        if (ul.parentElement && ul.parentElement.tagName === 'LI') return false;
        if (ul.classList.contains('sub-menu')) return false;

        var firstLi = ul.querySelector(':scope > li.menu-item');
        var liClass  = firstLi ? firstLi.className
            .replace(/\bmenu-item-\d+\b/g, '')
            .replace(/\bcurrent[_\-a-z0-9]+\b/gi, '')
            .replace(/\bmenu-item-has-children\b/g, '')
            .replace(/\s{2,}/g, ' ').trim() : 'menu-item menu-item-type-custom menu-item-object-custom';

        var firstA = ul.querySelector(':scope > li > a');
        var aClass  = firstA ? firstA.className : '';

        while (ul.firstChild) ul.removeChild(ul.firstChild);

        V2_MENU.forEach(function (item, i) {
            var li = document.createElement('li');
            li.id  = 'bes-v2-mi-' + i;
            li.className = liClass + ' bes-v2-menu-item';

            var a = document.createElement('a');
            a.href = item.href;
            a.textContent = item.title;
            if (aClass) a.className = aClass;

            li.appendChild(a);
            ul.appendChild(li);
        });

        ul.dataset.besV2 = '1';
        return true;
    }

    function sweepUL() {
        UL_SELECTORS.forEach(function (sel) {
            try {
                document.querySelectorAll(sel).forEach(rebuildUL);
            } catch (e) {}
        });
    }

    /* ══════════════════════════════════════════════════════════════════════
     * COMBINED SWEEP — runs both strategies
     * ══════════════════════════════════════════════════════════════════════ */
    function sweep() {
        rebuildBesHdr();
        sweepUL();
    }

    /* ── MutationObserver (primary engine) ────────────────────────────────
       Fires on any DOM change, so it catches the header whether it renders
       synchronously or is injected by Elementor's deferred widget system.
       Uses rAF to batch rapid mutations (e.g. Elementor widget hydration). */
    var pending = false;
    var obs = new MutationObserver(function () {
        if (pending) return;
        pending = true;
        requestAnimationFrame(function () {
            pending = false;
            sweep();
        });
    });

    obs.observe(document.documentElement, { childList: true, subtree: true });
    setTimeout(function () { obs.disconnect(); }, 15000);

    /* ── Eager passes (catches sync-rendered header already in DOM) ─────── */
    sweep();
    document.addEventListener('DOMContentLoaded', sweep);
    window.addEventListener('load', sweep);

})();
</script>
        <?php
    }
    add_action( 'wp_footer', 'bes_v2_render_client_menu_replacement', 99 );
}


/* ============================================================================
 * HERO IMAGE RESOLUTION — WP MEDIA ID FIRST, FULL-SIZE ONLY
 * ----------------------------------------------------------------------------
 * Uses the mapped WordPress attachment IDs for the v2 hero slides. If the site
 * is migrated and attachment IDs change, the renderer safely falls back to the
 * expected filename in Media Library, then to the direct uploads URL.
 * ============================================================================
 */

if ( ! function_exists( 'bes_v2_find_attachment_id_by_filename' ) ) {
    /**
     * Find an image attachment by its original filename.
     *
     * @param string $filename Expected Media Library filename.
     * @return int Attachment ID or 0.
     */
    function bes_v2_find_attachment_id_by_filename( $filename ) {
        static $cache = array();

        $filename = basename( (string) $filename );
        if ( $filename === '' ) {
            return 0;
        }

        if ( isset( $cache[ $filename ] ) ) {
            return $cache[ $filename ];
        }

        global $wpdb;

        $attachment_id = (int) $wpdb->get_var(
            $wpdb->prepare(
                "SELECT pm.post_id
                 FROM {$wpdb->postmeta} pm
                 INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                 WHERE pm.meta_key = '_wp_attached_file'
                   AND pm.meta_value LIKE %s
                   AND p.post_type = 'attachment'
                   AND p.post_mime_type LIKE 'image/%%'
                 ORDER BY p.post_date_gmt DESC
                 LIMIT 1",
                '%' . $wpdb->esc_like( $filename )
            )
        );

        if ( ! $attachment_id ) {
            $title = pathinfo( $filename, PATHINFO_FILENAME );

            $attachment_id = (int) $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT ID
                     FROM {$wpdb->posts}
                     WHERE post_type = 'attachment'
                       AND post_mime_type LIKE 'image/%%'
                       AND post_title = %s
                     ORDER BY post_date_gmt DESC
                     LIMIT 1",
                    $title
                )
            );
        }

        $cache[ $filename ] = $attachment_id;

        return $attachment_id;
    }
}

if ( ! function_exists( 'bes_v2_resolve_hero_image_id' ) ) {
    /**
     * Resolve the hero image by WP attachment ID, falling back to filename.
     *
     * @param int    $attachment_id Preferred WP attachment ID.
     * @param string $fallback_filename Filename fallback for migrations.
     * @return int Attachment ID or 0.
     */
    function bes_v2_resolve_hero_image_id( $attachment_id, $fallback_filename = '' ) {
        $attachment_id = absint( $attachment_id );

        if ( $attachment_id && wp_attachment_is_image( $attachment_id ) ) {
            return $attachment_id;
        }

        return bes_v2_find_attachment_id_by_filename( $fallback_filename );
    }
}

if ( ! function_exists( 'bes_v2_get_hero_image_html' ) ) {
    /**
     * Render a full-size hero image from WP Media without srcset down-selection.
     *
     * @param array $slide Hero slide data.
     * @param int   $index Slide index.
     * @return string Safe image HTML.
     */
    function bes_v2_get_hero_image_html( array $slide, $index ) {
        $attachment_id = bes_v2_resolve_hero_image_id(
            isset( $slide['img_id'] ) ? $slide['img_id'] : 0,
            isset( $slide['img_file'] ) ? $slide['img_file'] : ''
        );

        $alt = wp_strip_all_tags(
            trim(
                ( isset( $slide['title_1'] ) ? $slide['title_1'] : '' ) . ' ' .
                ( isset( $slide['title_2'] ) ? $slide['title_2'] : '' ) . ' ' .
                ( isset( $slide['title_em'] ) ? $slide['title_em'] : '' )
            )
        );

        $attrs = array(
            'class'           => 'bh-img',
            'alt'             => $alt,
            'loading'         => ( (int) $index === 0 ) ? 'eager' : 'lazy',
            'decoding'        => ( (int) $index === 0 ) ? 'sync' : 'async',
            'data-image-id'   => (string) $attachment_id,
            'data-image-file' => isset( $slide['img_file'] ) ? $slide['img_file'] : '',
        );

        if ( (int) $index === 0 ) {
            $attrs['fetchpriority'] = 'high';
        }

        if ( $attachment_id ) {
            $full = wp_get_attachment_image_src( $attachment_id, 'full' );

            if ( ! empty( $full[0] ) ) {
                $attrs['src']    = $full[0];
                $attrs['width']  = ! empty( $full[1] ) ? (int) $full[1] : '';
                $attrs['height'] = ! empty( $full[2] ) ? (int) $full[2] : '';

                $html_attrs = '';

                foreach ( $attrs as $name => $value ) {
                    if ( $value === '' || $value === null ) {
                        continue;
                    }

                    $html_attrs .= sprintf(
                        ' %s="%s"',
                        esc_attr( $name ),
                        esc_attr( $value )
                    );
                }

                return '<img' . $html_attrs . ' />';
            }
        }

        $fallback_url = isset( $slide['img'] ) ? $slide['img'] : '';
        if ( ! $fallback_url ) {
            return '';
        }

        $attrs['src'] = $fallback_url;

        $html_attrs = '';
        foreach ( $attrs as $name => $value ) {
            if ( $value === '' || $value === null ) {
                continue;
            }

            $html_attrs .= sprintf(
                ' %s="%s"',
                esc_attr( $name ),
                esc_attr( $value )
            );
        }

        return '<img' . $html_attrs . ' />';
    }
}

if ( ! function_exists( 'bes_v2_get_full_media_image_html' ) ) {
    /**
     * Render a full-size WordPress Media Library image without responsive
     * srcset down-selection. Uses attachment ID first, filename fallback second,
     * and direct URL fallback last for safe redeploys across environments.
     *
     * @param array $image Image data: img_id, img_file, img, alt.
     * @param array $attrs HTML attributes to merge into the image tag.
     * @return string Safe image HTML.
     */
    function bes_v2_get_full_media_image_html( array $image, array $attrs = array() ) {
        $attachment_id = bes_v2_resolve_hero_image_id(
            isset( $image['img_id'] ) ? $image['img_id'] : 0,
            isset( $image['img_file'] ) ? $image['img_file'] : ''
        );

        $default_attrs = array(
            'alt'             => isset( $image['alt'] ) ? wp_strip_all_tags( $image['alt'] ) : '',
            'loading'         => 'lazy',
            'decoding'        => 'async',
            'data-image-id'   => (string) $attachment_id,
            'data-image-file' => isset( $image['img_file'] ) ? $image['img_file'] : '',
        );

        $attrs = array_merge( $default_attrs, $attrs );

        if ( $attachment_id ) {
            $full = wp_get_attachment_image_src( $attachment_id, 'full' );

            if ( ! empty( $full[0] ) ) {
                $attrs['src']    = $full[0];
                $attrs['width']  = ! empty( $full[1] ) ? (int) $full[1] : '';
                $attrs['height'] = ! empty( $full[2] ) ? (int) $full[2] : '';
            }
        }

        if ( empty( $attrs['src'] ) && ! empty( $image['img'] ) ) {
            $attrs['src'] = $image['img'];
        }

        if ( empty( $attrs['src'] ) ) {
            return '';
        }

        $html_attrs = '';
        foreach ( $attrs as $name => $value ) {
            if ( $value === '' || $value === null ) {
                continue;
            }

            $html_attrs .= sprintf(
                ' %s="%s"',
                esc_attr( $name ),
                esc_attr( $value )
            );
        }

        return '<img' . $html_attrs . ' />';
    }
}

/* ============================================================================
 * MASTER SHORTCODE — [bes_home_content_v2]
 * ----------------------------------------------------------------------------
 * Renders the entire v2 homepage as a single, fully inlined document.
 * Each section is annotated with a banner comment matching the PDF revision
 * doc so future maintainers can map sections at a glance.
 * ============================================================================
 */

if ( ! function_exists( 'bes_render_home_content_v2' ) ) {

    add_shortcode( 'bes_home_content_v2', 'bes_render_home_content_v2' );

    function bes_render_home_content_v2() {

        ob_start();
        ?>

        <main
            id="bes-home-main-v2"
            class="w-full overflow-hidden bg-bes-parchment"
            data-bes-preview-active="<?php echo bes_v2_is_preview_active() ? 'true' : 'false'; ?>"
            role="main"
        >

        <?php
        /* ====================================================================
         * §1 — HERO  (REVISED per PDF pages 3–6)
         * --------------------------------------------------------------------
         * Four-slide cinematic carousel. New copy for all four slides:
         *   Slide 1 — Sanctuary    : "Helping You to Remember Who You Are"
         *   Slide 2 — Academy      : "Remember Your Highest Potential"
         *   Slide 3 — Pasraman     : "Remember The Wisdom of Life"
         *   Slide 4 — Eling Living : "A Way of Remembering Every Day"
         *                             + WhatsApp CTA button
         * ==================================================================== */
        ?>
        <?php
            $bes_v2_slides = array(
                array(
                    'kicker'   => 'Sanctuary',
                    'title_1'  => 'Helping You',
                    'title_2'  => 'to Remember',
                    'title_em' => 'Who You Are',
                    'desc'     => 'Kembali terhubung dengan diri Anda sendiri, menerima diri apa adanya, melangkah, bertumbuh menjadi versi terbaik diri Anda sendiri.',
                    'img_id'   => 3348, // xerWE.webp — Sanctuary
                    'img_file' => 'xerWE.webp',
                    'img'      => content_url( 'uploads/2026/07/xerWE.webp' ),
                    'btn'      => 'Discover Sanctuary',
                    'link'     => '/sanctuary',
                    'tag'      => 'Sanctuary',
                    'is_wa'    => false,
                ),
                array(
                    'kicker'   => 'Academy',
                    'title_1'  => 'Remember',
                    'title_2'  => 'Your Highest',
                    'title_em' => 'Potential',
                    'desc'     => 'Mengenali talenta sejati Anda, melalui jalan "eling", yoga, meditasi, life mastery, spiritual mastery.',
                    'img_id'   => 3341, // jlKQh.webp — Academy
                    'img_file' => 'jlKQh.webp',
                    'img'      => content_url( 'uploads/2026/07/jlKQh.webp' ),
                    'btn'      => 'Explore Academy',
                    'link'     => '/academy',
                    'tag'      => 'Academy',
                    'is_wa'    => false,
                ),
                array(
                    'kicker'   => 'Pasraman',
                    'title_1'  => 'Remember',
                    'title_2'  => 'The Wisdom',
                    'title_em' => 'of Life',
                    'desc'     => 'Cara kami menebar cinta dan kebermanfaatan bagi sesama.',
                    'img_id'   => 3349, // eXToe.webp — Pasraman
                    'img_file' => 'eXToe.webp',
                    'img'      => content_url( 'uploads/2026/07/eXToe.webp' ),
                    'btn'      => 'Discover Pasraman',
                    'link'     => '/pasraman',
                    'tag'      => 'Pasraman',
                    'is_wa'    => false,
                ),
                array(
                    'kicker'   => 'Eling Living',
                    'title_1'  => 'A Way of',
                    'title_2'  => 'Remembering',
                    'title_em' => 'Every Day',
                    'desc'     => 'Merasakan napas dan merayakan kehidupan.',
                    'img_id'   => 3342, // KlQvy.webp — Eling Living
                    'img_file' => 'KlQvy.webp',
                    'img'      => content_url( 'uploads/2026/07/KlQvy.webp' ),
                    'btn'      => 'Chat via WhatsApp',
                    'link'     => 'https://wa.me/6287825989117',
                    'tag'      => 'Eling Living',
                    'is_wa'    => true,
                ),
            );
            $bes_v2_total = count( $bes_v2_slides );
        ?>

        <!-- ▼▼▼ §1 HERO STYLES (verbatim cinematic engine from legacy) ▼▼▼ -->
        <style>
          .bh{position:relative;width:100%;height:100svh;min-height:650px;overflow:hidden;background:#151E10}
          .bh-grain{position:absolute;inset:0;z-index:50;pointer-events:none;opacity:.035;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");background-repeat:repeat;background-size:128px 128px;mix-blend-mode:overlay}
          .bh-slide{position:absolute;inset:0;opacity:0;pointer-events:none;transition:opacity .1s ease;z-index:1}
          .bh-slide.is-active{opacity:1;pointer-events:auto;z-index:10}
          .bh-img-wrap{position:absolute;top:5%;right:-5%;width:65%;height:90%;clip-path:url(#bh-blob-v2);-webkit-clip-path:url(#bh-blob-v2);overflow:hidden;transition:clip-path 1.2s cubic-bezier(.4,0,.2,1)}
          @media(max-width:1024px){.bh-img-wrap{top:0;right:0;width:100%;height:100%;clip-path:none;-webkit-clip-path:none}}
          .bh-img{width:100%;height:100%;object-fit:cover;transition:transform 12s cubic-bezier(.25,.46,.45,.94),opacity 1s ease;transform:scale(1.02);will-change:transform}
          .bh-slide.is-active .bh-img{transform:scale(1.12)}
          .bh-img-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(21,30,16,.92) 0%,rgba(21,30,16,.45) 40%,rgba(21,30,16,.15) 70%,transparent 100%);transition:background 1s ease}
          @media(max-width:1024px){.bh-img-overlay{background:linear-gradient(180deg,rgba(21,30,16,.85) 0%,rgba(21,30,16,.5) 50%,rgba(21,30,16,.7) 100%)}}
          .bh-content{position:relative;z-index:20;height:100%;display:flex;flex-direction:column;justify-content:center;padding:0 6% 0 7%;max-width:55%}
          @media(max-width:1024px){.bh-content{max-width:100%;padding:0 6%;text-align:center;align-items:center}}
          .bh-kicker{display:inline-flex;align-items:center;gap:12px;opacity:0;transform:translateY(15px);transition:all .7s cubic-bezier(.22,1,.36,1) .3s}
          .bh-slide.is-active .bh-kicker{opacity:1;transform:translateY(0)}
          .bh-kicker-line{width:0;height:1px;background:#C2D24A;transition:width .8s cubic-bezier(.22,1,.36,1) .5s}
          .bh-slide.is-active .bh-kicker-line{width:40px}
          /* Metric-safe title reveal: preserve the cinematic mask without clipping
             Cormorant Garamond ascenders, descenders, or italic overhangs. */
          .bh-title-line{display:block;overflow:hidden;font-family:'Cormorant Garamond',serif;font-weight:300;letter-spacing:-.02em;padding:.1em .14em .18em;margin:-.1em -.14em -.18em}
          .bh-t1,.bh-t2{font-size:clamp(2.5rem,6vw,5.5rem);font-style:normal;color:#FDFCFA;line-height:1.08}
          .bh-t3{font-size:clamp(3rem,7.5vw,7rem);font-style:italic;color:#C2D24A;line-height:1.08}
          .bh-title-inner{display:block;max-width:100%;font:inherit;color:inherit;letter-spacing:inherit;line-height:inherit;white-space:normal;overflow-wrap:normal;word-break:normal;text-wrap:balance;transform:translate3d(0,125%,0);transition:transform .9s cubic-bezier(.22,1,.36,1);will-change:transform}
          @keyframes bhTitleUnclip{to{overflow:visible}}
          .bh-slide.is-active .bh-title-line{animation:bhTitleUnclip 0s linear 1.15s forwards}
          @media(prefers-reduced-motion:reduce){.bh-title-line{overflow:visible}.bh-title-inner{transform:none;transition:none;will-change:auto}.bh-slide.is-active .bh-title-line{animation:none}}
          .bh-slide.is-active .bh-t1 .bh-title-inner{transition-delay:.15s;transform:translateY(0)}
          .bh-slide.is-active .bh-t2 .bh-title-inner{transition-delay:.25s;transform:translateY(0)}
          .bh-slide.is-active .bh-t3 .bh-title-inner{transition-delay:.35s;transform:translateY(0)}
          .bh-desc{opacity:0;transform:translateY(20px);transition:all .8s cubic-bezier(.22,1,.36,1) .55s}
          .bh-slide.is-active .bh-desc{opacity:1;transform:translateY(0)}
          .bh-cta{opacity:0;transform:translateY(20px);transition:all .7s cubic-bezier(.22,1,.36,1) .7s}
          .bh-slide.is-active .bh-cta{opacity:1;transform:translateY(0)}
          .bh-btn{position:relative;display:inline-flex;align-items:center;gap:10px;padding:16px 32px;border-radius:60px;overflow:hidden;background:transparent;border:1.5px solid rgba(194,210,74,.4);color:#C2D24A !important;font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;text-decoration:none;transition:all .4s cubic-bezier(.22,1,.36,1)}
          .bh-btn::before{content:'';position:absolute;inset:0;border-radius:inherit;background:#C2D24A;transform:scaleX(0);transform-origin:left;transition:transform .45s cubic-bezier(.22,1,.36,1);z-index:0}
          .bh-btn:hover::before{transform:scaleX(1)}
          .bh-btn:hover{color:#151E10 !important;border-color:#C2D24A}
          .bh-btn span,.bh-btn i{position:relative;z-index:1}
          .bh-btn i{transition:transform .3s ease;font-size:12px}
          .bh-btn:hover i{transform:translateX(4px)}
          /* WhatsApp variant — green fill to signal the CTA channel */
          .bh-btn--wa{background:#25D366;border-color:#25D366;color:#0b3d2e !important}
          .bh-btn--wa::before{background:#1ebe5d}
          .bh-btn--wa:hover{color:#0b3d2e !important;border-color:#1ebe5d}
          .bh-timeline{position:absolute;right:28px;top:50%;transform:translateY(-50%);z-index:40;display:flex;flex-direction:column;align-items:center;gap:0}
          @media(max-width:1024px){.bh-timeline{right:16px}}
          @media(max-width:640px){.bh-timeline{display:none}}
          .bh-tl-item{position:relative;display:flex;align-items:center;cursor:pointer;padding:14px 0;transition:all .3s ease}
          .bh-tl-line{position:absolute;left:50%;top:100%;width:1px;height:28px;background:rgba(255,255,255,.08);transform:translateX(-50%)}
          .bh-tl-item:last-child .bh-tl-line{display:none}
          .bh-tl-node{width:10px;height:10px;border-radius:50%;border:1.5px solid rgba(255,255,255,.15);background:transparent;transition:all .5s cubic-bezier(.34,1.56,.64,1);position:relative}
          .bh-tl-item.is-active .bh-tl-node{border-color:#C2D24A;background:#C2D24A;box-shadow:0 0 12px rgba(194,210,74,.3),0 0 24px rgba(194,210,74,.1);transform:scale(1.3)}
          .bh-tl-item:hover:not(.is-active) .bh-tl-node{border-color:rgba(255,255,255,.4);transform:scale(1.15)}
          .bh-tl-label{position:absolute;right:22px;top:50%;transform:translateY(-50%);white-space:nowrap;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.5);opacity:0;transform:translateY(-50%) translateX(8px);transition:all .35s cubic-bezier(.22,1,.36,1);pointer-events:none}
          .bh-tl-item.is-active .bh-tl-label,.bh-tl-item:hover .bh-tl-label{opacity:1;transform:translateY(-50%) translateX(0)}
          .bh-tl-item.is-active .bh-tl-label{color:#C2D24A}
          .bh-tl-ring{position:absolute;inset:-6px;width:22px;height:22px}
          .bh-tl-ring circle{fill:none;stroke:rgba(194,210,74,.3);stroke-width:1;stroke-dasharray:62.83;stroke-dashoffset:62.83;transform:rotate(-90deg);transform-origin:center;transition:stroke-dashoffset .15s linear}
          .bh-sacred{position:absolute;z-index:5;pointer-events:none;opacity:.04}
          .bh-sacred-1{top:8%;left:3%;width:300px;height:300px;animation:sacredSpin 60s linear infinite}
          .bh-sacred-2{bottom:10%;right:15%;width:200px;height:200px;animation:sacredSpin 45s linear infinite reverse;opacity:.025}
          @keyframes sacredSpin{to{transform:rotate(360deg)}}
          .bh-particle{position:absolute;border-radius:50%;pointer-events:none;z-index:6;animation:bhFloat linear infinite}
          @keyframes bhFloat{0%{transform:translateY(0) translateX(0);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(var(--dy,-200px)) translateX(var(--dx,30px));opacity:0}}
          .bh-scroll-cue{position:absolute;bottom:32px;left:50%;transform:translateX(-50%);z-index:40;display:flex;flex-direction:column;align-items:center;gap:8px;opacity:.4}
          @media(max-width:640px){.bh-scroll-cue{bottom:20px}}
          .bh-scroll-line{width:1px;height:32px;position:relative;overflow:hidden;background:rgba(255,255,255,.08);border-radius:1px}
          .bh-scroll-fill{position:absolute;top:-100%;left:0;width:100%;height:100%;background:#C2D24A;border-radius:1px;animation:scrollPulse 2s cubic-bezier(.4,0,.2,1) infinite}
          @keyframes scrollPulse{0%{top:-100%}50%{top:0}100%{top:100%}}
          .bh-counter{position:absolute;bottom:32px;left:7%;z-index:40;display:flex;align-items:baseline;gap:4px;font-family:'Cormorant Garamond',serif}
          @media(max-width:640px){.bh-counter{left:20px;bottom:20px}}
          .bh-counter-cur{font-size:36px;font-weight:300;color:#C2D24A;line-height:1;transition:all .5s cubic-bezier(.22,1,.36,1)}
          .bh-counter-sep{font-size:14px;color:rgba(255,255,255,.15);margin:0 2px}
          .bh-counter-tot{font-size:14px;font-weight:400;color:rgba(255,255,255,.2)}
          .bh-wipe{position:absolute;inset:0;z-index:35;pointer-events:none;background:#151E10;clip-path:circle(0% at 50% 50%);transition:clip-path 1s cubic-bezier(.77,0,.175,1)}
          .bh-wipe.is-wiping{clip-path:circle(150% at 50% 50%)}
          .bh-mobile-dots{display:none;position:absolute;bottom:28px;left:50%;transform:translateX(-50%);z-index:40;gap:8px}
          @media(max-width:640px){.bh-mobile-dots{display:flex}}
          .bh-m-dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.2);border:none;cursor:pointer;transition:all .4s cubic-bezier(.34,1.56,.64,1)}
          .bh-m-dot.is-active{width:24px;border-radius:3px;background:#C2D24A}
        </style>

        <section class="bh" id="bh-v2" data-bes-header="dark" aria-label="Hero Showcase">
          <div class="bh-grain" aria-hidden="true"></div>

          <svg width="0" height="0" style="position:absolute" aria-hidden="true">
            <defs>
              <clipPath id="bh-blob-v2" clipPathUnits="objectBoundingBox">
                <path d="M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z">
                  <animate attributeName="d" dur="18s" repeatCount="indefinite" values="
                    M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z;
                    M0.48,0.02 C0.68,0.0,0.88,0.1,0.96,0.26 C1.02,0.42,0.98,0.62,0.92,0.78 C0.86,0.94,0.68,1.0,0.48,0.98 C0.28,0.96,0.08,0.86,0.03,0.68 C-0.02,0.5,0.04,0.32,0.1,0.2 C0.18,0.08,0.28,0.04,0.48,0.02Z;
                    M0.42,0.0 C0.62,-0.01,0.9,0.08,0.97,0.24 C1.03,0.4,1.0,0.6,0.94,0.76 C0.88,0.92,0.7,1.01,0.5,0.99 C0.3,0.97,0.1,0.9,0.04,0.74 C-0.02,0.58,0.02,0.36,0.08,0.22 C0.14,0.08,0.22,0.01,0.42,0.0Z;
                    M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z
                  "/>
                </path>
              </clipPath>
            </defs>
          </svg>

          <div class="bh-sacred bh-sacred-1" aria-hidden="true">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="100" cy="100" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="100" cy="60" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="100" cy="140" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="65" cy="80" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="135" cy="80" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="65" cy="120" r="40" stroke="white" stroke-width=".5"/>
              <circle cx="135" cy="120" r="40" stroke="white" stroke-width=".5"/>
            </svg>
          </div>
          <div class="bh-sacred bh-sacred-2" aria-hidden="true">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="100" cy="100" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="100" cy="50" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="100" cy="150" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="57" cy="75" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="143" cy="75" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="57" cy="125" r="50" stroke="white" stroke-width=".5"/>
              <circle cx="143" cy="125" r="50" stroke="white" stroke-width=".5"/>
            </svg>
          </div>

          <div id="bh-particles-v2" aria-hidden="true"></div>

          <?php foreach ( $bes_v2_slides as $i => $s ) : ?>
          <div class="bh-slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo (int) $i; ?>">
            <div class="bh-img-wrap">
              <?php echo bes_v2_get_hero_image_html( $s, $i ); ?>
              <div class="bh-img-overlay"></div>
            </div>

            <div class="bh-content">
              <div class="bh-kicker mb-6 lg:mb-8">
                <span class="bh-kicker-line"></span>
                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(194,210,74,.7)">
                  <?php echo esc_html( $s['kicker'] ); ?>
                </span>
              </div>

              <h1 class="bh-title" style="margin:0;padding:0">
                <span class="bh-title-line bh-t1">
                  <span class="bh-title-inner">
                    <?php echo esc_html( $s['title_1'] ); ?>
                  </span>
                </span>
                <span class="bh-title-line bh-t2">
                  <span class="bh-title-inner">
                    <?php echo esc_html( $s['title_2'] ); ?>
                  </span>
                </span>
                <span class="bh-title-line bh-t3">
                  <span class="bh-title-inner">
                    <?php echo esc_html( $s['title_em'] ); ?>
                  </span>
                </span>
              </h1>

              <p class="bh-desc" style="font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;line-height:1.8;color:rgba(253,252,250,.6);max-width:440px;margin:24px 0 32px;font-weight:300">
                <?php echo esc_html( $s['desc'] ); ?>
              </p>

              <div class="bh-cta">
                <?php if ( ! empty( $s['is_wa'] ) ) : ?>
                  <a href="<?php echo esc_url( $s['link'] ); ?>" target="_blank" rel="noopener" class="bh-btn bh-btn--wa">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    <span><?php echo esc_html( $s['btn'] ); ?></span>
                  </a>
                <?php else : ?>
                  <a href="<?php echo esc_url( bes_v2_is_preview_active() ? bes_v2_append_preview_param( $s['link'] ) : $s['link'] ); ?>" class="bh-btn">
                    <span><?php echo esc_html( $s['btn'] ); ?></span>
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

          <div class="bh-wipe" id="bh-wipe-v2" aria-hidden="true"></div>

          <div class="bh-timeline" role="tablist" aria-label="Slide navigation">
            <?php foreach ( $bes_v2_slides as $i => $s ) : ?>
            <div class="bh-tl-item <?php echo $i === 0 ? 'is-active' : ''; ?>" data-target="<?php echo (int) $i; ?>" role="tab" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>" tabindex="0">
              <div class="bh-tl-node">
                <svg class="bh-tl-ring" viewBox="0 0 22 22"><circle cx="11" cy="11" r="10" id="bh-ring-v2-<?php echo (int) $i; ?>"/></svg>
              </div>
              <span class="bh-tl-label"><?php echo esc_html( $s['tag'] ); ?></span>
              <?php if ( $i < $bes_v2_total - 1 ) : ?><div class="bh-tl-line"></div><?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="bh-mobile-dots">
            <?php foreach ( $bes_v2_slides as $i => $s ) : ?>
            <button class="bh-m-dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-target="<?php echo (int) $i; ?>" aria-label="Slide <?php echo (int) ( $i + 1 ); ?>"></button>
            <?php endforeach; ?>
          </div>

          <div class="bh-counter">
            <span class="bh-counter-cur" id="bh-cur-v2">01</span>
            <span class="bh-counter-sep">/</span>
            <span class="bh-counter-tot"><?php echo str_pad( $bes_v2_total, 2, '0', STR_PAD_LEFT ); ?></span>
          </div>

          <div class="bh-scroll-cue" aria-hidden="true">
            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:8px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.3);font-weight:600">Scroll</span>
            <div class="bh-scroll-line"><div class="bh-scroll-fill"></div></div>
          </div>
        </section>

        <script>
        document.addEventListener('DOMContentLoaded', function(){
          'use strict';
          var hero       = document.getElementById('bh-v2');
          if (!hero) return;
          var slides     = hero.querySelectorAll('.bh-slide');
          var tlItems    = hero.querySelectorAll('.bh-tl-item');
          var mDots      = hero.querySelectorAll('.bh-m-dot');
          var wipe       = document.getElementById('bh-wipe-v2');
          var counterCur = document.getElementById('bh-cur-v2');
          var total      = slides.length;
          var current    = 0;
          var isAnimating= false;
          var autoTimer;
          var AUTO_DELAY = 7000;
          var RING_DURATION = AUTO_DELAY;
          var ringCircumference = 62.83;

          var particleBox = document.getElementById('bh-particles-v2');
          if (particleBox) {
            for (var p = 0; p < 18; p++) {
              var dot = document.createElement('div');
              dot.className = 'bh-particle';
              var size = 1.5 + Math.random() * 2.5;
              var isGold = Math.random() > 0.6;
              dot.style.cssText =
                'width:'+size+'px;height:'+size+'px;'+
                'left:'+Math.random()*100+'%;'+
                'top:'+(30+Math.random()*60)+'%;'+
                'background:'+(isGold ? 'rgba(201,168,76,0.3)' : 'rgba(194,210,74,0.2)')+';'+
                '--dy:-'+(120+Math.random()*180)+'px;'+
                '--dx:'+(Math.random()*80-40)+'px;'+
                'animation-duration:'+(6+Math.random()*8)+'s;'+
                'animation-delay:'+(Math.random()*6)+'s;';
              particleBox.appendChild(dot);
            }
          }

          if (window.innerWidth > 1024) {
            hero.addEventListener('mousemove', function(e){
              if (isAnimating) return;
              var rect = hero.getBoundingClientRect();
              var mx = (e.clientX - rect.left) / rect.width - 0.5;
              var my = (e.clientY - rect.top) / rect.height - 0.5;
              var activeWrap = slides[current].querySelector('.bh-img-wrap');
              if (activeWrap) {
                activeWrap.style.transform = 'translate('+(-mx*12)+'px,'+(-my*8)+'px)';
                activeWrap.style.transition = 'transform .6s cubic-bezier(.22,1,.36,1)';
              }
            });
            hero.addEventListener('mouseleave', function(){
              var activeWrap = slides[current].querySelector('.bh-img-wrap');
              if (activeWrap) { activeWrap.style.transform=''; activeWrap.style.transition='transform .8s cubic-bezier(.22,1,.36,1)'; }
            });
          }

          function goTo(index, skipWipe) {
            if (isAnimating || index === current) return;
            isAnimating = true;
            var prev = current; current = index;
            counterCur.style.opacity = '0';
            counterCur.style.transform = 'translateY(-6px)';
            setTimeout(function(){
              counterCur.textContent = String(current + 1).padStart(2,'0');
              counterCur.style.opacity = ''; counterCur.style.transform = '';
            }, 250);
            tlItems.forEach(function(tl, i){ tl.classList.toggle('is-active', i === current); tl.setAttribute('aria-selected', i === current ? 'true':'false'); });
            mDots.forEach(function(d, i){ d.classList.toggle('is-active', i === current); });
            if (!skipWipe && wipe) {
              wipe.classList.add('is-wiping');
              setTimeout(function(){
                slides[prev].classList.remove('is-active');
                slides[current].classList.add('is-active');
                setTimeout(function(){ wipe.classList.remove('is-wiping'); wipe.style.transition='none'; wipe.offsetHeight; wipe.style.transition=''; isAnimating=false; }, 150);
              }, 600);
            } else {
              slides[prev].classList.remove('is-active');
              slides[current].classList.add('is-active');
              setTimeout(function(){ isAnimating = false; }, 800);
            }
            startRingProgress();
          }

          function startRingProgress() {
            for (var r = 0; r < total; r++) {
              var circle = document.getElementById('bh-ring-v2-' + r);
              if (circle) { circle.style.transition='none'; circle.style.strokeDashoffset = ringCircumference; }
            }
            var activeCircle = document.getElementById('bh-ring-v2-' + current);
            if (activeCircle) { activeCircle.offsetHeight; activeCircle.style.transition = 'stroke-dashoffset ' + (RING_DURATION/1000) + 's linear'; activeCircle.style.strokeDashoffset = '0'; }
          }

          function startAuto() { clearInterval(autoTimer); autoTimer = setInterval(function(){ goTo((current + 1) % total); }, AUTO_DELAY); startRingProgress(); }
          function resetAuto() { clearInterval(autoTimer); startAuto(); }

          tlItems.forEach(function(tl){
            tl.addEventListener('click', function(){ var t = parseInt(this.getAttribute('data-target'),10); goTo(t); resetAuto(); });
            tl.addEventListener('keydown', function(e){ if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); var t = parseInt(this.getAttribute('data-target'),10); goTo(t); resetAuto(); } });
          });
          mDots.forEach(function(d){ d.addEventListener('click', function(){ var t = parseInt(this.getAttribute('data-target'),10); goTo(t); resetAuto(); }); });

          var touchStartX = 0;
          hero.addEventListener('touchstart', function(e){ touchStartX = e.changedTouches[0].screenX; }, {passive:true});
          hero.addEventListener('touchend', function(e){
            var diff = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(diff) > 50) { if (diff < 0) goTo((current + 1) % total); else goTo((current - 1 + total) % total); resetAuto(); }
          }, {passive:true});

          document.addEventListener('keydown', function(e){
            var r = hero.getBoundingClientRect();
            if (!(r.top < window.innerHeight && r.bottom > 0)) return;
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { goTo((current + 1) % total); resetAuto(); }
            else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') { goTo((current - 1 + total) % total); resetAuto(); }
          });

          startAuto();
        });
        </script>
        <!-- ▲▲▲ §1 HERO END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §2 — TRUST BAR  (REVISED per PDF page 8)
         * --------------------------------------------------------------------
         * Replaces the icon-row stats with a 5-panel image strip carrying the
         * sacred captions, followed by the "CORE VALUES ELING" acrostic:
         *   E mpowerment  L ove  I ntegrity  N atural  G rowth
         * The legacy stat-icon row is preserved as a hidden DOM fallback (see
         * the second <section class="hidden ..."> block at the bottom).
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §2 TRUST BAR — REVISED ▼▼▼ -->
        <section class="relative py-20 md:py-28 bg-bes-forest overflow-hidden border-y border-white/[.04]" data-bes-feedback="988962-section-2">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-bes-gold/5 blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>
            <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-bes-gold/30 to-transparent opacity-60"></div>

            <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

                <!-- Image strip: 5 core-value panels -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4 max-w-[980px] mx-auto mb-12 md:mb-14 bes-reveal">
                    <?php
                    $bes_v2_strip = array(
                        array(
                            'img_id'   => 3345,
                            'img_file' => '',
                            'img'      => wp_get_attachment_url( 3345 ) ?: '',
                            'alt'      => 'Bali Eling Spirit empowerment activity',
                            'cap'      => 'Rooted in Balinese Wisdom',
                            'value'    => 'Empowerment',
                        ),
                        array(
                            'img_id'   => 3340,
                            'img_file' => '',
                            'img'      => wp_get_attachment_url( 3340 ) ?: '',
                            'alt'      => 'Bali Eling Spirit blessing and care moment',
                            'cap'      => 'Conscious Living',
                            'value'    => 'Love',
                        ),
                        array(
                            'img_id'   => 3343,
                            'img_file' => '',
                            'img'      => wp_get_attachment_url( 3343 ) ?: '',
                            'alt'      => 'Bali Eling Spirit academy learning circle',
                            'cap'      => 'A Journey Back to Yourself',
                            'value'    => 'Integrity',
                        ),
                        array(
                            'img_id'   => 3344,
                            'img_file' => '',
                            'img'      => wp_get_attachment_url( 3344 ) ?: '',
                            'alt'      => 'Bali Eling Spirit nature path experience',
                            'cap'      => 'Heal. Awaken. Empower',
                            'value'    => 'Natural',
                        ),
                        array(
                            'img_id'   => 3339,
                            'img_file' => '',
                            'img'      => wp_get_attachment_url( 3339 ) ?: '',
                            'alt'      => 'Bali Eling Spirit meditation and growth',
                            'cap'      => 'Sanctuary. Community. Growth',
                            'value'    => 'Growth',
                        ),
                    );
                    foreach ( $bes_v2_strip as $idx => $panel ) : ?>
                    <div class="relative group overflow-hidden rounded-xl shadow-xl shadow-black/40 aspect-[3/4]" style="transition-delay: <?php echo 0.1 + ( $idx * 0.08 ); ?>s;">
                        <?php
                        echo bes_v2_get_full_media_image_html(
                            $panel,
                            array(
                                'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out',
                            )
                        );
                        ?>
                        <div class="absolute inset-0 z-10 pointer-events-none" style="background: linear-gradient(to top, rgba(21,30,16,0.9) 0%, rgba(21,30,16,0.28) 48%, transparent 100%);"></div>
                        <div class="absolute inset-x-0 bottom-0 z-20 p-4 md:p-5 text-center">
                            <div class="font-display !text-bes-gold text-[10px] tracking-[0.25em] uppercase mb-1.5">&#10047;</div>
                            <div class="font-body text-[10.5px] md:text-[11px] font-bold tracking-[0.18em] uppercase text-bes-ivory leading-snug">
                                <?php echo esc_html( $panel['cap'] ); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Core Values wording below the photos -->
                <div class="text-center bes-reveal" style="transition-delay: 0.5s;">
                    <div class="flex items-center justify-center gap-4 mb-5 md:mb-6">
                        <span class="w-8 md:w-10 h-[1px] bg-bes-gold/40"></span>
                        <span class="font-body text-[10px] md:text-[11px] font-bold tracking-[0.32em] uppercase !text-bes-gold/90">
                            CORE VALUES ELING
                        </span>
                        <span class="w-8 md:w-10 h-[1px] bg-bes-gold/40"></span>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-x-7 gap-y-3 md:gap-x-10">
                        <?php foreach ( $bes_v2_strip as $v ) : ?>
                        <div class="font-display text-lg md:text-xl lg:text-[22px] !text-bes-gold leading-none">
                            <?php echo esc_html( $v['value'] ); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="absolute inset-x-0 bottom-0 h-[1px] bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent opacity-60"></div>
        </section>

        <!-- Legacy §2 stat-icon row — preserved in DOM but hidden for rollback safety -->
        <section class="hidden relative py-12 md:py-16 bg-bes-forest overflow-hidden border-y border-white/[.04]" data-bes-legacy="trustbar">
            <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
                <div class="flex flex-wrap justify-center items-start gap-10 md:gap-12 lg:gap-16">
                    <div class="flex flex-col items-center text-center gap-4 w-[130px] md:w-[150px]">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 leading-relaxed">Est. Pejeng Kangin,<br>Bali</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-4 w-[130px] md:w-[150px]">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 leading-relaxed">Yoga Alliance Accredited<br>(USA &amp; India)</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-4 w-[130px] md:w-[150px]">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 leading-relaxed">1,000+ Lives<br>Transformed</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-4 w-[130px] md:w-[150px]">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 leading-relaxed">Authentic Balinese<br>Dharma Teachings</span>
                    </div>
                    <div class="flex flex-col items-center text-center gap-4 w-[130px] md:w-[150px]">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 leading-relaxed">11 Unique Retreat<br>Programs</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- ▲▲▲ §2 TRUST BAR END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §3 — ABOUT INTRO  (SOFT-DELETED per PDF page 9: "HILANGKAN")
         * --------------------------------------------------------------------
         * Markup is preserved verbatim from the legacy fragment but the outer
         * <section> wrapper carries Tailwind's `hidden` utility class. Remove
         * that class to instantly re-enable the section if the client reverses
         * the decision.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §3 ABOUT INTRO — SOFT-DELETED (hidden) ▼▼▼ -->
        <section id="about" class="hidden relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest-deep overflow-hidden" data-bes-soft-deleted="about-intro">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-bes-gold/5 blur-[120px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/3" aria-hidden="true"></div>
            <div class="relative max-w-[1440px] mx-auto grid lg:grid-cols-12 gap-16 md:gap-20 items-center">
                <div class="lg:col-span-6 relative">
                    <div class="absolute -inset-4 md:-inset-6 border border-bes-gold/10 rounded-2xl z-0 pointer-events-none"></div>
                    <div class="relative z-10 grid grid-cols-2 gap-3 md:gap-5">
                        <div class="row-span-2 rounded-xl overflow-hidden shadow-2xl shadow-black/50 relative" style="height: 520px;">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="Sacred temple Bali" class="w-full h-full object-cover" loading="lazy" />
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-xl shadow-black/40 relative" style="height: 250px;">
                            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=600&q=80" alt="Meditation practice" class="w-full h-full object-cover" loading="lazy" />
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-xl shadow-black/40 relative" style="height: 250px;">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&q=80" alt="Yoga alignment" class="w-full h-full object-cover" loading="lazy" />
                        </div>
                        <div class="absolute -bottom-8 -right-4 md:-right-8 p-6 md:p-8 max-w-[280px] md:max-w-xs rounded-xl border border-bes-gold/20 shadow-2xl z-20" style="background: rgba(21, 30, 16, 0.75); backdrop-filter: blur(16px);">
                            <p class="font-display italic !text-bes-gold text-lg md:text-xl leading-relaxed mb-3">"Yogas citta vrtti nirodhah &mdash; Yoga is the stilling of the movements of the mind."</p>
                            <div class="w-8 h-[1px] bg-bes-gold/40 mb-3"></div>
                            <p class="font-body text-[10px] tracking-[0.2em] uppercase text-bes-ivory/50 font-bold">Pata&ntilde;jali Yoga S&umacr;tra I.2</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 flex flex-col pt-10 lg:pt-0 lg:pl-8">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="w-12 h-[1px] bg-bes-gold"></span>
                        <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">About Our Sanctuary</span>
                    </div>
                    <h2 class="font-display font-medium text-bes-ivory leading-[1.1] mb-8" style="font-size: clamp(2.8rem, 4vw, 4rem);">
                        Your Divine Sanctuary<br>for Profound <em class="italic !text-bes-gold font-light">Transformation</em>
                    </h2>
                    <div class="space-y-6 font-body text-bes-ivory/60 text-[15px] md:text-base leading-[1.8] font-light">
                        <p>Pasraman Bali Eling Spirit transcends the traditional retreat experience; it is an awakened portal for deep inner alchemy, holistic rebirth, and the luminous discovery of your True Self. Nestled in the spiritual embrace of Bali, we curate a sacred container where ancient yogic sciences, mindful meditation, and the noble path of Dharma converge.</p>
                        <p>Enveloped by the vibrating energy of Pejeng Kangin, Tampaksiring&mdash;the untouched cultural heartland of Gianyar&mdash;our sanctuary offers a safe haven to pause and realign. Under the compassionate guidance of master spiritual guides Jero Ratni, Aji Bhagawan, and an esteemed lineage of authorized mentors, our teachings are anchored in the authentic Balinese philosophy of <span class="text-bes-ivory font-medium">Tri Hita Karana</span>: the eternal rhythm bridging humanity, the natural world, and the Divine consciousness.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-y-8 gap-x-6 my-10">
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">Tri Hita</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Karana Philosophy</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">Catur</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Marga Yoga Path</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">11</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Retreat Programs</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">200 / 300H</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">YTT Certified</div>
                        </div>
                    </div>
                    <div>
                        <a href="#about-full" class="inline-flex items-center gap-3 border border-bes-gold !text-bes-gold font-body text-[11px] font-bold tracking-[0.2em] uppercase px-8 py-4 rounded-sm">
                            <span>Our Story &amp; Vision</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ▲▲▲ §3 ABOUT INTRO END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §4 — THREE PILLARS  (SOFT-DELETED per PDF page 10: "HILANGKAN")
         * --------------------------------------------------------------------
         * Tri Hita Karana three-card section. Wrapper carries `hidden` class.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §4 THREE PILLARS — SOFT-DELETED (hidden) ▼▼▼ -->
        <section class="hidden relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest overflow-hidden border-t border-white/[.04]" data-bes-soft-deleted="pillars">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-bes-leaf/5 blur-[120px] rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2" aria-hidden="true"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-bes-gold/5 blur-[150px] rounded-full pointer-events-none translate-x-1/3 translate-y-1/3" aria-hidden="true"></div>
            <div class="relative max-w-[1440px] mx-auto z-10">
                <div class="text-center max-w-2xl mx-auto mb-16 md:mb-24">
                    <div class="flex items-center justify-center gap-4 mb-6">
                        <span class="w-8 h-[1px] bg-bes-gold/50"></span>
                        <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.25em] uppercase !text-bes-gold">Tri Hita Karana</span>
                        <span class="w-8 h-[1px] bg-bes-gold/50"></span>
                    </div>
                    <h2 class="font-display font-medium text-bes-ivory leading-tight mb-6" style="font-size: clamp(2.4rem, 4vw, 3.6rem);">
                        Three Pillars of <em class="italic !text-bes-gold font-light">Sacred Balance</em>
                    </h2>
                    <p class="font-body text-[15px] text-bes-ivory/60 leading-relaxed font-light">The ancient Balinese philosophy breathing life into every ritual, meditation, and awakening at our sanctuary. True peace is found when these three realms align.</p>
                </div>
                <div class="relative grid lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
                    <div class="hidden lg:block absolute top-[44px] left-[15%] right-[15%] h-[1px] bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent z-0"></div>
                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center" style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px);">
                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" class="!text-bes-gold"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                        </div>
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Pawongan</h3>
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Sacred Fellowship</div>
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">Harmony between humans. We hold a profound space for authentic community, compassionate guidance, and soul-to-soul connection that transcends all earthly boundaries.</p>
                    </div>
                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center" style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px);">
                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="!text-bes-gold"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Palemahan</h3>
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Earthly Harmony</div>
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">Harmony with nature. Immerse yourself in practices set amidst vibrating Balinese landscapes, healing rivers, emerald rice terraces, and ancient holy temple grounds.</p>
                    </div>
                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center" style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px);">
                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="!text-bes-gold"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                        </div>
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Parahyangan</h3>
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Divine Communion</div>
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">Harmony with the Divine. Awaken your spirit through sacred rituals, deep Chakra ceremonies, and Dharma teachings that illuminate the path to your highest self.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ▲▲▲ §4 THREE PILLARS END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §5 — ELING SANCTUARY (Programs)  (REVISED per PDF page 12 + feedback #988860)
         * --------------------------------------------------------------------
         * Was "Healing & Retreat Awakenings". Re-titled "Eling Sanctuary" and
         * reframed into three visible program category tiles in the requested
         * order:
         *   • HEALING & THERAPY
         *   • RETREATS
         *   • TAPA BRATA (Program Bahasa Indonesia)
         * The Punarbawa / Atma / Eling Retreat / 7-Chakra sub-grid is retained
         * in the DOM but hidden per client feedback for safe rollback.
         * The "Virtual Sanctuary / Online Session" panel (legacy §6) is kept
         * in the DOM but hidden per the PDF (HILANGKAN).
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §5 ELING SANCTUARY — REVISED ▼▼▼ -->
        <section id="programs" class="relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest-deep overflow-hidden">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-bes-gold/5 blur-[150px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/3" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-bes-leaf/5 blur-[120px] rounded-full pointer-events-none -translate-x-1/2 translate-y-1/2" aria-hidden="true"></div>

            <div class="relative max-w-[1440px] mx-auto z-10">

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-16 md:mb-20 bes-reveal" data-bes-feedback="988964-section-3">
                    <div class="max-w-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="w-12 h-[1px] bg-bes-gold"></span>
                            <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">
                                Healing &amp; Therapy
                            </span>
                        </div>
                        <h2 class="font-display font-medium text-bes-ivory leading-[1.1]" style="font-size: clamp(2.8rem, 4vw, 4rem);">
                            Eling <em class="italic !text-bes-gold font-light">Sanctuary</em>
                        </h2>
                    </div>
                    <div class="lg:max-w-md lg:pb-3">
                        <p class="font-body text-[15px] text-bes-ivory/60 leading-relaxed font-light">
                            Masuki ruang suci transformasi diri yang mendalam. Setiap perjalanan dirancang dengan penuh kesadaran untuk melepaskan hambatan energi, mengembalikan keseimbangan spiritual, dan menyelaraskan tubuh, pikiran, serta jiwa Anda terhubung dengan Sumber Kehidupan.
                        </p>
                    </div>
                </div>

                <!-- 3-tile headline grid: HEALING & THERAPY | RETREATS | TAPA BRATA (Program Bahasa Indonesia) -->
                <?php
                $bes_v2_sanctuary_cards = array(
                    array(
                        'img_id'   => 3337, // ceEcf-scaled.webp — Healing & Therapy
                        'img_file' => 'ceEcf-scaled.webp',
                        'img'      => content_url( 'uploads/2026/07/ceEcf-scaled.webp' ),
                        'alt'      => 'Healing and therapy ritual at Bali Eling Spirit',
                        'eyebrow'  => '01',
                        'title'    => 'Healing &amp; Therapy',
                        'subtitle' => '',
                        'desc'     => 'Healing and therapy program journey at Bali Eling Spirit.',
                        'link'     => '/healing-therapy-retreats',
                        'delay'    => '0.1s',
                    ),
                    array(
                        'img_id'   => 3336, // anVqu.webp — Retreats
                        'img_file' => 'anVqu.webp',
                        'img'      => content_url( 'uploads/2026/07/anVqu.webp' ),
                        'alt'      => 'Retreat experience in sacred water at Bali Eling Spirit',
                        'eyebrow'  => '02',
                        'title'    => 'Retreats',
                        'subtitle' => '',
                        'desc'     => 'Retreat experiences for remembering and reconnecting with the self.',
                        'link'     => '/retreats',
                        'delay'    => '0.2s',
                    ),
                    array(
                        'img_id'   => 3338, // JjnJV.webp — Tapa Brata / Program Bahasa Indonesia
                        'img_file' => 'JjnJV.webp',
                        'img'      => content_url( 'uploads/2026/07/JjnJV.webp' ),
                        'alt'      => 'Tapa Brata Indonesian program meditation group at Bali Eling Spirit',
                        'eyebrow'  => '03',
                        'title'    => 'Tapa Brata',
                        'subtitle' => 'Program Bahasa Indonesia',
                        'desc'     => 'Tapa Brata program delivered in Bahasa Indonesia.',
                        'link'     => '/program-bahasa-indonesia',
                        'delay'    => '0.3s',
                    ),
                );
                ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-16" data-bes-feedback="988860-section-3">
                    <?php foreach ( $bes_v2_sanctuary_cards as $card ) : ?>
                        <?php
                        $card_url = isset( $card['link'] ) ? $card['link'] : '';
                        if ( $card_url && bes_v2_is_internal_url( $card_url ) && bes_v2_is_preview_active() ) {
                            $card_url = bes_v2_append_preview_param( $card_url );
                        }
                        ?>
                        <article class="relative rounded-2xl overflow-hidden group shadow-xl shadow-black/40 bes-reveal" style="min-height: 420px; transition-delay: <?php echo esc_attr( $card['delay'] ); ?>;">
                            <?php if ( $card_url ) : ?>
                                <a href="<?php echo esc_url( $card_url ); ?>" class="absolute inset-0 z-40" aria-label="<?php echo esc_attr( wp_strip_all_tags( $card['title'] . ' ' . $card['subtitle'] ) ); ?>"></a>
                            <?php endif; ?>

                            <div class="absolute inset-0 bg-bes-forest/55 z-10 group-hover:bg-bes-forest/20 transition-colors duration-[1s]"></div>
                            <?php
                            echo bes_v2_get_full_media_image_html(
                                $card,
                                array(
                                    'class'    => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                )
                            );
                            ?>
                            <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.92) 0%, rgba(21, 30, 16, 0.22) 55%, rgba(21, 30, 16, 0.08) 100%);"></div>

                            <div class="absolute inset-x-0 bottom-0 z-30 p-7 md:p-8 flex flex-col justify-end">
                                <div class="font-body text-[9px] font-bold tracking-[0.24em] uppercase !text-bes-gold opacity-80 mb-3">
                                    <?php echo esc_html( $card['eyebrow'] ); ?>
                                </div>
                                <h3 class="font-display text-3xl md:text-[34px] text-bes-ivory mb-1 font-medium leading-tight">
                                    <?php echo wp_kses_post( $card['title'] ); ?>
                                </h3>
                                <?php if ( ! empty( $card['subtitle'] ) ) : ?>
                                    <p class="font-body text-[10px] md:text-[11px] font-bold tracking-[0.18em] uppercase !text-bes-gold leading-snug">
                                        <?php echo esc_html( $card['subtitle'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Supporting sub-grid (Punarbawa, Atma, Eling, 7-Chakra) -->
                <div class="hidden grid sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-12 md:mb-16" data-bes-soft-deleted="sanctuary-supporting-sub-grid" data-bes-feedback="988860-section-3-bottom-hidden">
                    <?php
                    $bes_v2_sub_programs = array(
                        array(
                            'img'   => 'https://images.unsplash.com/photo-1536623975707-c4b3b2af565d?w=600&q=80',
                            'badge' => 'Rebirth Ceremony',
                            'title' => 'Punarbawa',
                            'desc'  => 'A profound cellular-level rebirth. Sever ancestral trauma loops, heal past-life wounds, and realign seamlessly with your highest soul purpose.',
                            'delay' => '0.1s',
                        ),
                        array(
                            'img'   => 'https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=600&q=80',
                            'badge' => 'Deep Soul Quest',
                            'title' => 'Atma Retreat',
                            'desc'  => 'Descend into the absolute core of the self &mdash; the Atman. Features advanced prolonged silence, sensory withdrawal, and the sacred Agni Hotra fire rite.',
                            'delay' => '0.2s',
                        ),
                        array(
                            'img'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&q=80',
                            'badge' => 'Mindful Awakening',
                            'title' => 'Eling Retreat',
                            'desc'  => '&lsquo;Eling&rsquo; signifies absolute awareness. A gentle yet profound return to the present moment via conscious breathwork, walking meditation, and Dharma teachings.',
                            'delay' => '0.3s',
                        ),
                        array(
                            'img'   => 'https://images.unsplash.com/photo-1616699002805-0741e1e4a9c5?w=600&q=80',
                            'badge' => 'Energy Cleansing',
                            'title' => '7-Chakra Rite',
                            'desc'  => 'The sacred Pelukatan ceremony. Submerge in holy waters while ancient mantras dissolve energetic stagnation, realigning your 7 spiritual wheels.',
                            'delay' => '0.4s',
                        ),
                    );
                    foreach ( $bes_v2_sub_programs as $p ) : ?>
                    <div class="relative rounded-2xl overflow-hidden group shadow-xl shadow-black/40 bes-reveal" style="min-height: 340px; transition-delay: <?php echo esc_attr( $p['delay'] ); ?>;">
                        <div class="absolute inset-0 bg-bes-forest/80 z-10 group-hover:bg-transparent transition-colors duration-[1s]"></div>
                        <img src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out"/>
                        <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.95) 0%, transparent 60%);"></div>

                        <div class="absolute inset-0 z-30 p-6 flex flex-col justify-end transform transition-transform duration-500 group-hover:translate-y-[-8px]">
                            <div class="mb-3">
                                <span class="inline-block border border-bes-gold/20 bg-bes-forest/40 backdrop-blur-md px-2.5 py-1 font-body text-[8px] font-bold tracking-[0.2em] uppercase text-white/70 rounded-sm"><?php echo esc_html( $p['badge'] ); ?></span>
                            </div>
                            <h3 class="font-display text-[26px] text-bes-ivory mb-2 font-medium"><?php echo esc_html( $p['title'] ); ?></h3>
                            <p class="font-body text-[12px] text-bes-ivory/60 leading-[1.7] mb-4 font-light opacity-90 group-hover:opacity-100 transition-opacity">
                                <?php echo $p['desc']; ?>
                            </p>
                            <a href="#" class="font-body text-[9px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit">
                                Explore <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php
                /* ============================================================
                 * §6 — VIRTUAL SANCTUARY / ONLINE SESSION
                 * Nested in legacy program.php; soft-deleted per PDF page 13.
                 * Wrapper carries `hidden` for safe rollback.
                 * ============================================================ */
                ?>
                <!-- ▼ §6 ONLINE SESSION — SOFT-DELETED (hidden) ▼ -->
                <div class="hidden relative rounded-2xl border border-bes-gold/20 p-8 md:p-12 overflow-hidden shadow-2xl bes-reveal" style="background: rgba(30, 42, 22, 0.6); backdrop-filter: blur(20px); transition-delay: 0.5s;" data-bes-soft-deleted="online-sessions">
                    <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-bes-leaf/10 blur-[80px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                        <div class="lg:max-w-md">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="w-8 h-[1px] bg-bes-gold"></span>
                                <span class="font-body text-[9px] font-bold tracking-[0.28em] uppercase !text-bes-gold">Virtual Sanctuary</span>
                            </div>
                            <h3 class="font-display text-3xl md:text-[34px] text-bes-ivory mb-3 font-medium">Program Online Session</h3>
                            <p class="font-body text-[14px] text-bes-ivory/60 leading-relaxed font-light">
                                Experience profound energetic recalibration from anywhere in the world. Join our transformative online sessions designed for deep healing and continuous spiritual growth.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <?php
                            $bes_v2_daily = array( 'Meditation Course', 'Eling Caring', 'Virtual Breathwork', 'Online Dharma Talk', 'Spiritual Consultation', 'Remote Energy Healing' );
                            foreach ( $bes_v2_daily as $d ) : ?>
                                <span class="border border-bes-ivory/10 bg-bes-ivory/5 px-4 py-2.5 rounded-sm font-body text-[10px] font-bold tracking-[0.15em] uppercase text-bes-ivory/80">
                                    <?php echo esc_html( $d ); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- ▲ §6 ONLINE SESSION END ▲ -->

            </div>
        </section>

        <style>
            @keyframes shimmer { 100% { transform: translateX(100%); } }
        </style>
        <!-- ▲▲▲ §5 ELING SANCTUARY END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §7 — ELING ACADEMY  (REVISED per PDF page 15 + feedback #988862)
         * --------------------------------------------------------------------
         * Was "Awaken as a Certified Yoga Teacher in Bali" with 200H / 300H
         * cards. Re-titled "Eling Academy" and converted into three visible
         * image-led program tiles following the Sanctuary card structure:
         *   • YOGA TEACHER TRAINING
         *   • WELLNESS TRAINING
         *   • WORKSHOP YACEP
         * The previous editorial text/accreditation layout is retained hidden
         * in the DOM for rollback safety.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §7 ELING ACADEMY — REVISED ▼▼▼ -->
        <style>
            :root { --noise-bg: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E"); }
            @keyframes besMorphBlob { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%;transform:translate(33%,0) scale(1) rotate(0deg);} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%;transform:translate(33%,20px) scale(1.05) rotate(5deg);} }
            @keyframes besMorphBlobReverse { 0%,100%{border-radius:40% 60% 70% 30%/40% 70% 30% 60%;transform:translate(-25%,0) scale(1) rotate(0deg);} 50%{border-radius:70% 30% 40% 60%/60% 40% 60% 30%;transform:translate(-25%,-20px) scale(1.02) rotate(-5deg);} }
            @keyframes besFloat { 0%,100%{transform:translateY(0px);} 50%{transform:translateY(-8px);} }
            .bes-glass-edge { box-shadow: inset 0 1px 1px rgba(255,255,255,0.1), inset 0 -1px 1px rgba(0,0,0,0.2), 0 10px 30px rgba(0,0,0,0.3); }
        </style>

        <section id="academy" class="relative py-28 md:py-36 px-6 lg:px-10 overflow-hidden border-t border-white/[.04] bg-[#0c0501]">
            <div class="absolute inset-0 pointer-events-none z-0 opacity-30" style="background-image: var(--noise-bg); background-color: wheat; background-blend-mode: soft-light; mix-blend-mode: color-dodge; filter: grayscale(100%); background-size: 250px;"></div>
            <div class="absolute inset-0 pointer-events-none z-0" style="background: radial-gradient(ellipse 70% 80% at 20% 50%, rgba(186, 110, 40, 0.06), transparent);"></div>
            <div class="absolute top-1/4 right-0 w-[500px] h-[500px] md:w-[600px] md:h-[600px] bg-bes-gold/10 blur-[120px] pointer-events-none translate-x-1/3 z-0" style="animation: besMorphBlob 15s ease-in-out infinite; mix-blend-mode: screen;" aria-hidden="true"></div>
            <div class="absolute bottom-10 left-0 w-[400px] h-[400px] bg-orange-900/20 blur-[120px] pointer-events-none -translate-x-1/4 z-0" style="animation: besMorphBlobReverse 18s ease-in-out infinite;" aria-hidden="true"></div>

            <div class="relative max-w-[1440px] mx-auto z-10">

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14 md:mb-18 bes-reveal" data-bes-feedback="988966-section-4-heading">
                    <div class="max-w-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="w-12 h-[1px] bg-bes-gold"></span>
                            <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">
                                CONSCIOUS LEARNING
                            </span>
                        </div>
                        <h2 class="font-display font-medium text-bes-ivory leading-[1.1]" style="font-size: clamp(2.8rem, 4vw, 4rem);">
                            Eling <em class="italic !text-bes-gold font-light">Academy</em>
                        </h2>
                    </div>
                    <div class="lg:max-w-md lg:pb-3">
                        <p class="font-body text-[15px] text-bes-ivory/60 leading-relaxed font-light">
                            Program pembelajaran yang mengintegrasikan pengetahuan, praktik, dan kebijaksanaan spiritual untuk membentuk praktisi spiritual wellness yang autentik, kompeten, dan membawa transformasi bagi diri sendiri maupun sesama.
                        </p>
                    </div>
                </div>

                <?php
                $bes_v2_academy_cards = array(
                    array(
                        'img_id'   => 3333, // SYQLV.webp — Yoga Teacher Training
                        'img_file' => 'SYQLV.webp',
                        'img'      => content_url( 'uploads/2026/07/SYQLV.webp' ),
                        'alt'      => 'Yoga Teacher Training practice at Bali Eling Spirit Academy',
                        'eyebrow'  => '01',
                        'title'    => 'Yoga Teacher Training',
                        'subtitle' => '',
                        'desc'     => 'Yoga Teacher Training program at Bali Eling Spirit Academy.',
                        'link'     => '/academy',
                        'delay'    => '0.1s',
                    ),
                    array(
                        'img_id'   => 3332, // reNKZ.webp — Wellness Training
                        'img_file' => 'reNKZ.webp',
                        'img'      => content_url( 'uploads/2026/07/reNKZ.webp' ),
                        'alt'      => 'Wellness Training sound healing and learning session at Bali Eling Spirit Academy',
                        'eyebrow'  => '02',
                        'title'    => 'Wellness Training',
                        'subtitle' => '',
                        'desc'     => 'Wellness Training program at Bali Eling Spirit Academy.',
                        'link'     => '/academy',
                        'delay'    => '0.2s',
                    ),
                    array(
                        'img_id'   => 3350, // CYxia.webp — Workshop YACEP
                        'img_file' => 'CYxia.webp',
                        'img'      => content_url( 'uploads/2026/07/CYxia.webp' ),
                        'alt'      => 'Workshop YACEP group learning at Bali Eling Spirit Academy',
                        'eyebrow'  => '03',
                        'title'    => 'Workshop YACEP',
                        'subtitle' => '',
                        'desc'     => 'Yoga Alliance Continuing Education Provider workshop at Bali Eling Spirit Academy.',
                        'link'     => '/academy',
                        'delay'    => '0.3s',
                    ),
                );
                ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8" data-bes-feedback="988862-section-4">
                    <?php foreach ( $bes_v2_academy_cards as $card ) : ?>
                        <?php
                        $card_url = isset( $card['link'] ) ? $card['link'] : '';
                        if ( $card_url && bes_v2_is_internal_url( $card_url ) && bes_v2_is_preview_active() ) {
                            $card_url = bes_v2_append_preview_param( $card_url );
                        }
                        ?>
                        <article class="relative rounded-2xl overflow-hidden group shadow-xl shadow-black/50 bes-reveal" style="min-height: 360px; transition-delay: <?php echo esc_attr( $card['delay'] ); ?>;">
                            <?php if ( $card_url ) : ?>
                                <a href="<?php echo esc_url( $card_url ); ?>" class="absolute inset-0 z-40" aria-label="<?php echo esc_attr( wp_strip_all_tags( $card['title'] . ' ' . $card['subtitle'] ) ); ?>"></a>
                            <?php endif; ?>

                            <div class="absolute inset-0 bg-[#1a0a02]/45 z-10 group-hover:bg-[#1a0a02]/20 transition-colors duration-[1s]"></div>
                            <?php
                            echo bes_v2_get_full_media_image_html(
                                $card,
                                array(
                                    'class'    => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                )
                            );
                            ?>
                            <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(18, 7, 1, 0.94) 0%, rgba(18, 7, 1, 0.26) 55%, rgba(18, 7, 1, 0.08) 100%);"></div>

                            <div class="absolute inset-x-0 bottom-0 z-30 p-7 md:p-8 flex flex-col justify-end">
                                <div class="font-body text-[9px] font-bold tracking-[0.24em] uppercase !text-bes-gold opacity-80 mb-3">
                                    <?php echo esc_html( $card['eyebrow'] ); ?>
                                </div>
                                <h3 class="font-display text-3xl md:text-[34px] text-bes-ivory mb-1 font-medium leading-tight">
                                    <?php echo wp_kses_post( $card['title'] ); ?>
                                </h3>
                                <?php if ( ! empty( $card['subtitle'] ) ) : ?>
                                    <p class="font-body text-[10px] md:text-[11px] font-bold tracking-[0.18em] uppercase !text-bes-gold leading-snug">
                                        <?php echo esc_html( $card['subtitle'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="hidden grid lg:grid-cols-2 gap-16 md:gap-24 items-center" style="display:none" data-bes-legacy="academy-editorial-layout" data-bes-feedback="988862-section-4-legacy-hidden">

                    <div class="order-2 lg:order-1 flex flex-col pt-10 lg:pt-0">

                        <div class="flex items-center gap-4 mb-6 bes-reveal" style="transition-delay: 0.1s;">
                            <span class="w-12 h-[1px] bg-bes-gold"></span>
                            <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">
                                CONSCIOUS LEARNING
                            </span>
                        </div>

                        <h2 class="font-display font-medium text-bes-ivory leading-[1.1] mb-8 bes-reveal" style="font-size: clamp(2.6rem, 4vw, 3.8rem); transition-delay: 0.2s;">
                            Eling <em class="italic !text-bes-gold font-light">Academy</em>
                        </h2>

                        <div class="space-y-6 font-body text-bes-ivory/60 text-[15px] md:text-base leading-[1.8] font-light mb-10 bes-reveal" style="transition-delay: 0.3s;">
                            <p>
                                Step onto the path of mastery. Eling Academy is not merely a curriculum &mdash; it is a profound spiritual initiation. Globally accredited by <strong class="text-bes-ivory font-medium">Yoga Alliance USA</strong>, <strong class="text-bes-ivory font-medium">World Yoga Federation</strong>, and <strong class="text-bes-ivory font-medium">Yoga Alliance International India</strong>, we forge confident, character-driven leaders deeply rooted in authentic yogic wisdom.
                            </p>
                            <p>
                                Our pathways span teacher training, holistic wellness, and continuing-education workshops &mdash; each designed to elevate practice, refine teaching, and unlock the sacred science of Balinese spiritual ritual.
                            </p>
                        </div>

                        <!-- 3 Academy program cards -->
                        <div class="grid sm:grid-cols-3 gap-4 mb-10 bes-reveal items-stretch" style="transition-delay: 0.4s;">

                            <div class="group relative rounded-xl border border-bes-gold/20 p-6 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:border-bes-gold/50 bes-glass-edge flex flex-col h-full" style="background: rgba(21, 15, 10, 0.6); backdrop-filter: blur(12px);">
                                <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                <div class="font-display text-[28px] md:text-[32px] !text-bes-gold leading-tight mb-2 font-medium relative z-10">YTT</div>
                                <div class="font-body text-[10px] font-bold tracking-[0.15em] uppercase text-bes-ivory/80 mb-3 relative z-10">Yoga Teacher Training</div>
                                <p class="font-body text-[12.5px] text-bes-ivory/50 leading-[1.7] font-light mb-5 flex-1 relative z-10">
                                    200H foundations dan 300H advanced. Bangun suara mengajar yang percaya diri, berkarakter, berakar dalam kearifan yogis yang autentik.
                                </p>
                                <a href="#" class="font-body text-[10px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit relative z-10 mt-auto">
                                    Explore YTT <span>&rarr;</span>
                                </a>
                            </div>

                            <div class="group relative rounded-xl border border-bes-gold/20 p-6 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:border-bes-gold/50 bes-glass-edge flex flex-col h-full" style="background: rgba(21, 15, 10, 0.6); backdrop-filter: blur(12px);">
                                <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                <div class="font-display text-[28px] md:text-[32px] !text-bes-gold leading-tight mb-2 font-medium relative z-10">Wellness</div>
                                <div class="font-body text-[10px] font-bold tracking-[0.15em] uppercase text-bes-ivory/80 mb-3 relative z-10">Wellness Training</div>
                                <p class="font-body text-[12.5px] text-bes-ivory/50 leading-[1.7] font-light mb-5 flex-1 relative z-10">
                                    Sertifikasi holistik mencakup breathwork, sound healing, nutrisi sattvic, dan anatomi energetik untuk praktisi wellness modern.
                                </p>
                                <a href="#" class="font-body text-[10px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit relative z-10 mt-auto">
                                    Explore Wellness <span>&rarr;</span>
                                </a>
                            </div>

                            <div class="group relative rounded-xl border border-bes-gold/20 p-6 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:border-bes-gold/50 bes-glass-edge flex flex-col h-full" style="background: rgba(21, 15, 10, 0.6); backdrop-filter: blur(12px);">
                                <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                <div class="font-display text-[28px] md:text-[32px] !text-bes-gold leading-tight mb-2 font-medium relative z-10">YACEP</div>
                                <div class="font-body text-[10px] font-bold tracking-[0.15em] uppercase text-bes-ivory/80 mb-3 relative z-10">Workshop YACEP</div>
                                <p class="font-body text-[12.5px] text-bes-ivory/50 leading-[1.7] font-light mb-5 flex-1 relative z-10">
                                    Workshop Yoga Alliance Continuing Education Provider &mdash; sequencing lanjutan, intensif filosofi, dan modalitas spesialisasi.
                                </p>
                                <a href="#" class="font-body text-[10px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit relative z-10 mt-auto">
                                    Explore YACEP <span>&rarr;</span>
                                </a>
                            </div>

                        </div>

                        <div class="bes-reveal" style="transition-delay: 0.5s;">
                            <a href="https://wa.me/6287825989117" target="_blank" rel="noopener" class="inline-flex items-center gap-3 border border-bes-gold !text-bes-gold font-body text-[11px] font-bold tracking-[0.2em] uppercase px-8 py-4 rounded-sm hover:bg-bes-gold hover:!text-bes-forest transition-all duration-500 w-fit">
                                <span>Enquire About Academy</span>
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2 relative bes-reveal" style="transition-delay: 0.2s;">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/60 group" style="height: 600px;">
                            <div class="absolute inset-0 bg-orange-950/20 z-10 group-hover:bg-transparent transition-colors duration-1000"></div>
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=900&q=80" alt="Eling Academy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out"/>
                            <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to right, rgba(36, 18, 5, 0.7) 0%, transparent 60%);"></div>
                        </div>

                        <div class="absolute top-10 -left-6 md:-left-12 p-6 rounded-xl border border-bes-gold/30 z-30 max-w-[240px] bes-glass-edge" style="background: rgba(26, 13, 5, 0.7); backdrop-filter: blur(16px); animation: besFloat 6s ease-in-out infinite;">
                            <div class="font-display text-[17px] !text-bes-gold italic mb-2 leading-tight">"Atha yoga-anusasanam"</div>
                            <div class="font-body text-[9px] font-bold tracking-[0.18em] uppercase text-bes-ivory/80 mb-3 leading-relaxed">"Now begins the discipline of Yoga."</div>
                            <div class="w-6 h-[1px] bg-bes-gold/40 mb-3"></div>
                            <div class="font-body text-[8px] font-bold tracking-[0.15em] uppercase !text-bes-gold/70">Pata&ntilde;jali S&umacr;tra I.1</div>
                        </div>

                        <div class="absolute -bottom-8 -right-4 md:-right-8 p-6 md:p-8 rounded-xl border border-bes-gold/30 z-30 text-center min-w-[180px] bes-glass-edge" style="background: rgba(26, 13, 5, 0.8); backdrop-filter: blur(20px); animation: besFloat 7s ease-in-out infinite 1s;">
                            <div class="font-display text-[54px] md:text-[64px] !text-bes-gold leading-none mb-1 font-medium">3</div>
                            <div class="font-body text-[9px] font-bold tracking-[0.25em] uppercase text-bes-ivory/80 leading-relaxed">Global Yoga<br>Accreditations</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ▲▲▲ §7 ELING ACADEMY END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §8 — SOCIAL & COMMUNITY PROGRAM  (FEEDBACK #988864 / Section 5)
         * --------------------------------------------------------------------
         * Client direction:
         *   - Replace photos.
         *   - Make all four lanes equal and aligned in one balanced row:
         *     Yoga | Meditasi | Pelukatan | Komunitas.
         *
         * Implementation notes:
         *   - Uses WP Media attachment IDs first, filename fallback second,
         *     and direct uploads URL last through bes_v2_get_full_media_image_html().
         *   - All cards share the same visual structure, aspect ratio, rounded
         *     arch mask, title placement, and hover behavior.
         *   - The former uneven Social & Community grid is preserved below as
         *     hidden DOM for safe rollback, not deleted.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §8 SOCIAL & COMMUNITY PROGRAM — REVISED / FEEDBACK #988864 ▼▼▼ -->
        <section id="community" class="relative py-24 md:py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden" data-bes-feedback="988968-section-5">
            <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position: center top; filter: invert(1);"></div>
            <div class="absolute top-1/2 left-1/2 w-[720px] h-[420px] -translate-x-1/2 -translate-y-1/2 bg-bes-gold/5 blur-[120px] rounded-full pointer-events-none" aria-hidden="true"></div>

            <div class="relative max-w-[1280px] mx-auto z-10">

                <div class="text-center mb-14 md:mb-16 bes-reveal">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                        <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">PASRAMAN</span>
                        <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                    </div>
                    <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                        Social &amp; Community <em class="italic !text-bes-gold font-medium">Program</em>
                    </h2>
                    <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                        Ruang suci untuk belajar, berlatih, dan bertumbuh bersama dalam semangat Dharma. Melalui yoga, meditasi, pelukatan, serta berbagai program pelayanan dan pengabdian sosial-spiritual, setiap perjalanan menjadi persembahan yang menghadirkan harapan, kepedulian, dan manfaat bagi mereka yang membutuhkan, masyarakat, serta alam.
                    </p>
                </div>

                <?php
                $bes_v2_community_cards = array(
                    array(
                        'img_id'   => 3346, // KACKf.webp — Yoga
                        'img_file' => 'KACKf.webp',
                        'img'      => content_url( 'uploads/2026/07/KACKf.webp' ),
                        'alt'      => 'Yoga community class at Bali Eling Spirit',
                        'eyebrow'  => '01',
                        'title'    => 'Yoga',
                        'desc'     => 'Kelas yoga komunitas untuk menyelaraskan napas, tubuh, dan kesadaran.',
                        'link'     => '/yoga',
                        'delay'    => '0.1s',
                    ),
                    array(
                        'img_id'   => 3335, // ZVDSb-scaled.webp — Meditasi
                        'img_file' => 'ZVDSb-scaled.webp',
                        'img'      => content_url( 'uploads/2026/07/ZVDSb-scaled.webp' ),
                        'alt'      => 'Meditation group session at Bali Eling Spirit',
                        'eyebrow'  => '02',
                        'title'    => 'Meditasi',
                        'desc'     => 'Sesi meditasi untuk menenangkan pikiran dan memulihkan kejernihan batin.',
                        'link'     => '/meditasi',
                        'delay'    => '0.2s',
                    ),
                    array(
                        'img_id'   => 3334, // SyYoW-scaled.webp — Pelukatan
                        'img_file' => 'SyYoW-scaled.webp',
                        'img'      => content_url( 'uploads/2026/07/SyYoW-scaled.webp' ),
                        'alt'      => 'Pelukatan ceremony at Bali Eling Spirit',
                        'eyebrow'  => '03',
                        'title'    => 'Pelukatan',
                        'desc'     => 'Ritual pemurnian dengan air suci, mantra, dan kearifan Bali.',
                        'link'     => '/pelukatan',
                        'delay'    => '0.3s',
                    ),
                    array(
                        'img_id'   => 3347, // TVvXk.webp — Komunitas
                        'img_file' => 'TVvXk.webp',
                        'img'      => content_url( 'uploads/2026/07/TVvXk.webp' ),
                        'alt'      => 'Community social impact activity at Bali Eling Spirit',
                        'eyebrow'  => '04',
                        'title'    => 'Komunitas',
                        'desc'     => 'Inisiatif sosial untuk menebar cinta dan kebermanfaatan bagi sesama.',
                        'link'     => '/foundation',
                        'delay'    => '0.4s',
                    ),
                );
                ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 lg:gap-x-10 items-start max-w-[1120px] mx-auto" data-bes-feedback="988864-section-5-equal-grid">
                    <?php foreach ( $bes_v2_community_cards as $card ) : ?>
                        <?php
                        $card_url = isset( $card['link'] ) ? $card['link'] : '';
                        if ( $card_url && bes_v2_is_internal_url( $card_url ) && bes_v2_is_preview_active() ) {
                            $card_url = bes_v2_append_preview_param( $card_url );
                        }
                        ?>
                        <article class="group relative bes-reveal" style="transition-delay: <?php echo esc_attr( $card['delay'] ); ?>;">
                            <?php if ( $card_url ) : ?>
                                <a href="<?php echo esc_url( $card_url ); ?>" class="absolute inset-0 z-40 rounded-t-full rounded-b-md" aria-label="<?php echo esc_attr( wp_strip_all_tags( $card['title'] ) ); ?>"></a>
                            <?php endif; ?>

                            <div class="relative overflow-hidden rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.03] bg-bes-forest">
                                <span class="absolute top-5 left-1/2 -translate-x-1/2 z-30 font-body text-[9px] font-bold tracking-[0.24em] uppercase !text-bes-gold opacity-85">
                                    <?php echo esc_html( $card['eyebrow'] ); ?>
                                </span>
                                <div class="absolute inset-0 bg-bes-forest/20 z-10 group-hover:bg-bes-forest/5 transition-colors duration-[1s]"></div>
                                <?php
                                echo bes_v2_get_full_media_image_html(
                                    $card,
                                    array(
                                        'class'    => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.7s] ease-out opacity-95 group-hover:opacity-100',
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    )
                                );
                                ?>
                                <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21,30,16,0.56) 0%, rgba(21,30,16,0.08) 42%, rgba(21,30,16,0.12) 100%);"></div>
                            </div>

                            <div class="pt-5 text-left">
                                <h3 class="font-display text-2xl md:text-[28px] text-bes-ivory font-medium leading-tight group-hover:!text-bes-leaf transition-colors duration-500">
                                    <?php echo esc_html( $card['title'] ); ?>
                                </h3>
                                <p class="sr-only">
                                    <?php echo esc_html( $card['desc'] ); ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Legacy uneven Social & Community layout — preserved hidden for rollback safety. -->
                <div class="hidden" data-bes-soft-deleted="legacy-community-uneven-grid" data-bes-feedback="988864-section-5-legacy-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-16 lg:gap-y-20">

                    <!-- 01. YOGA -->
                    <div class="group relative bes-reveal" style="transition-delay: 0.1s;">
                        <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">01</span>
                        <div class="relative z-10">
                            <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                                <img src="https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=800&q=80" alt="Yoga" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            </div>
                            <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                                <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Yoga</h3>
                                <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                    Kelas yoga komunitas: Hatha, Vinyasa, dan Yin yang terbuka untuk semua tingkat. Bersama-sama menyelaraskan napas, tubuh, dan kesadaran.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 02. MEDITASI -->
                    <div class="group relative bes-reveal" style="transition-delay: 0.2s;">
                        <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">02</span>
                        <div class="relative z-10">
                            <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                                <img src="https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=800&q=80" alt="Meditasi" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            </div>
                            <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                                <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Meditasi</h3>
                                <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                    Sesi meditasi terbimbing &mdash; Vipassana, sound healing, dan dharma talk &mdash; untuk menenangkan pikiran dan memulihkan kejernihan batin.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 03. PELUKATAN -->
                    <div class="group relative bes-reveal" style="transition-delay: 0.3s;">
                        <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">03</span>
                        <div class="relative z-10">
                            <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80" alt="Pelukatan" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            </div>
                            <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                                <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Pelukatan</h3>
                                <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                    Ritual pemurnian dengan air suci, mantra, dan kearifan Bali. Pelukatan terbuka untuk umum di hari-hari sakral &mdash; Purnama dan Tilem.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 04. FOUNDATION — Full-width strip (col-span-3) -->
                    <div class="group relative md:col-span-3 bes-reveal" style="transition-delay: 0.4s;">
                        <div class="relative rounded-2xl overflow-hidden border border-bes-gold/10 flex flex-col md:flex-row gap-0" style="background: rgba(21, 30, 16, 0.5); backdrop-filter: blur(12px);">
                            <div class="md:w-72 lg:w-80 flex-shrink-0 overflow-hidden" style="min-height: 220px;">
                                <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=600&q=80" alt="Komunitas" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s] ease-out" style="min-height: 220px;"/>
                            </div>
                            <div class="flex flex-col justify-center p-8 md:p-10 border-l-0 md:border-l border-bes-gold/10">
                                <span class="absolute -top-10 right-8 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.07] transition-opacity duration-700 pointer-events-none z-0">04</span>
                                <div class="relative z-10">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="w-8 h-[1px] bg-bes-leaf/40"></span>
                                        <span class="font-body text-[9px] uppercase tracking-[0.25em] font-bold text-bes-leaf">Social Impact</span>
                                    </div>
                                    <h3 class="font-display text-3xl lg:text-4xl text-bes-ivory mb-4 group-hover:!text-bes-leaf transition-colors">Komunitas</h3>
                                    <p class="font-body text-bes-parchment/60 text-[14px] leading-relaxed max-w-2xl">
                                        Kegiatan sosial yayasan &mdash; donasi, bakti masyarakat, dan inisiatif komunitas yang menebar cinta dan kebermanfaatan bagi sesama. Bergabunglah dalam gerakan nyata membangun kehidupan yang lebih bermakna.
                                    </p>
                                    <a href="#" class="inline-flex items-center gap-2 font-body text-[10px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-leaf transition-colors mt-6 w-fit">
                                        Lihat Program Komunitas <span>&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>

            </div>
        </section>
        <!-- ▲▲▲ §8 SOCIAL & COMMUNITY PROGRAM END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §9 — LIVE GOOGLE REVIEWS  (REVISED per PDF page 19)
         * --------------------------------------------------------------------
         * Was "Echoes of Awakening" with 3 hand-curated testimonials. Replaced
         * with a live Google Reviews mount point. The container is wired to
         * accept any of three common providers (Elfsight, EmbedSocial, Trust)
         * by setting one of the data-* attributes. If no widget script is
         * loaded, a graceful fallback link directs visitors to the live Google
         * Maps reviews for Bali Eling Spirit.
         *
         * To activate:
         *   • Elfsight:    add data-elfsight-app-lazy with widget ID
         *   • EmbedSocial: paste the provider <div ...> inside the mount node
         *   • Trustmary:   inject the <script> tag in functions.php
         * The legacy 3-card testimonial markup is preserved in a sibling
         * <section class="hidden ..."> for safe rollback.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §9 LIVE GOOGLE REVIEWS — REVISED ▼▼▼ -->
        <section id="reviews" class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-bes-leaf/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
            <div class="absolute top-0 left-10 right-10 h-[1px] bg-gradient-to-r from-transparent via-white/[0.05] to-transparent pointer-events-none"></div>

            <div class="relative max-w-[1440px] mx-auto z-10">

                <div class="text-center mb-16 md:mb-20 bes-reveal">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <span class="w-8 h-[1px] bg-bes-gold/30"></span>
                        <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold !text-bes-gold/80">AUTHENTIC EXPERIENCES</span>
                        <span class="w-8 h-[1px] bg-bes-gold/30"></span>
                    </div>
                    <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                        Voices of <em class="italic !text-bes-gold font-medium">Transformation</em>
                    </h2>
                    <p class="font-body text-bes-parchment/60 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                        Setiap perjalanan meninggalkan cerita. Inilah pengalaman autentik dari mereka yang telah menemukan ruang untuk bertumbuh, pulih, dan kembali terhubung dengan diri melalui Bali Eling Spirit.
                    </p>
                </div>

                <!-- LIVE WIDGET MOUNT POINT
                     Replace the <noscript>-style fallback with your widget HTML:
                       Option A — Elfsight: <div class="elfsight-app-XXXXXXXX"></div>
                       Option B — EmbedSocial: paste <div class="embedsocial-reviews" ...></div>
                       Option C — Trustmary / Trustpilot: provider's <div data-...></div>
                  -->
                <div id="bes-google-reviews-widget"
                     class="bes-reveal min-h-[420px] rounded-2xl border border-white/[0.06] p-6 md:p-10 bg-white/[0.02] backdrop-blur"
                     data-bes-google-place-id="REPLACE_WITH_GOOGLE_PLACE_ID"
                     data-bes-elfsight-app=""
                     style="transition-delay: 0.2s;">

                    <!-- Graceful fallback (visible until a live widget is mounted) -->
                    <div class="bes-google-reviews-fallback flex flex-col items-center justify-center text-center py-12 md:py-20">
                        <div class="flex items-center gap-2 mb-5">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#C9A84C"/></svg>
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#C9A84C"/></svg>
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#C9A84C"/></svg>
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#C9A84C"/></svg>
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#C9A84C"/></svg>
                        </div>
                        <div class="font-display !text-bes-gold text-3xl md:text-4xl mb-2">4.9 / 5</div>
                        <div class="font-body text-[11px] tracking-[0.25em] uppercase font-bold text-bes-parchment/60 mb-8">Rating &middot; Google Reviews</div>
                        <p class="font-body text-bes-parchment/50 max-w-md text-[14px] leading-relaxed mb-8">
                            Widget Google Reviews akan dimuat di sini. Sementara itu, baca ulasan terbaru langsung di Google.
                        </p>
                        <a href="https://www.google.com/maps/search/?api=1&query=Bali+Eling+Spirit+Pejeng+Kangin" target="_blank" rel="noopener" class="inline-flex items-center gap-3 px-7 py-3.5 rounded-full bg-bes-leaf text-bes-forest-deep font-body text-[11px] uppercase tracking-[0.2em] font-bold hover:bg-bes-leaf-hover transition-all duration-300 shadow-[0_4px_20px_rgba(194,210,74,0.15)]">
                            <i class="fa-brands fa-google" aria-hidden="true"></i>
                            <span>Lihat di Google</span>
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Legacy §9 hand-curated testimonials — preserved hidden for rollback safety -->
        <section class="hidden relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden" data-bes-legacy="testimonials">
            <div class="relative max-w-[1440px] mx-auto z-10">
                <div class="text-center mb-20 md:mb-24">
                    <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                        Echoes of <em class="italic !text-bes-gold font-medium">Awakening</em>
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24">
                    <div class="p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04]">
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10">"Pengalaman yang sangat luar biasa bisa berada di Pasraman dan mengikuti Tapa Brata 4 hari. Perjalanan yang menyenangkan, teman-teman yang begitu baik dan supportive."</p>
                        <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory">Alumni Tapa Brata &mdash; Bali, Indonesia</div>
                    </div>
                    <div class="p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04]">
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10">"I've joined both Healing Retreat &amp; Surya Namaskar &mdash; both helped me through my spiritual awakening. The team is dedicated, loving, and deeply knowledgeable."</p>
                        <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory">Monica Wahib &mdash; Healing Retreat Alumni</div>
                    </div>
                    <div class="p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04]">
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10">"Kelas Tapa Brata yang saya ikuti sangat menakjubkan &mdash; sangat membangunkan spiritual saya yang sudah hampir padam. Energi positifnya luar biasa."</p>
                        <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory">Retreat Participant &mdash; Tapa Brata, Bali</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ▲▲▲ §9 LIVE GOOGLE REVIEWS END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §10 — ELING PEDIA (Blog/Wisdom)  (REVISED per PDF page 21)
         * --------------------------------------------------------------------
         * Was "Words of Wisdom" with English-only tagline. Re-titled
         * "Eling Pedia" with Indonesian inspirational tagline. Splide carousel
         * mechanics, WP_Query, and all card markup preserved verbatim.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §10 ELING PEDIA — REVISED ▼▼▼ -->
        <?php
            $bes_v2_blog_args = array(
                'post_type'        => 'post',
                'posts_per_page'   => 9,
                'post_status'      => 'publish',
                'suppress_filters' => false,
            );

            $bes_v2_blog_wpml_previous_language = '';

            if ( function_exists( 'pll_languages_list' ) ) {
                $bes_v2_blog_languages = pll_languages_list( array( 'fields' => 'slug' ) );

                if ( is_array( $bes_v2_blog_languages ) && in_array( 'id', $bes_v2_blog_languages, true ) ) {
                    $bes_v2_blog_args['lang'] = 'id';
                }
            } elseif ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
                $bes_v2_blog_wpml_previous_language = (string) apply_filters( 'wpml_current_language', null );
                do_action( 'wpml_switch_language', 'id' );
            }

            $bes_v2_blog_months_id = array(
                'Jan' => 'Jan',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Apr',
                'May' => 'Mei',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Agu',
                'Sep' => 'Sep',
                'Oct' => 'Okt',
                'Nov' => 'Nov',
                'Dec' => 'Des',
            );

            $bes_v2_blog_query = new WP_Query( $bes_v2_blog_args );
        ?>
        <section id="eling-pedia" class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none bes-fret mix-blend-overlay" style="background-position: center bottom; filter: invert(1);"></div>
            <div class="hidden md:block absolute top-0 left-0 w-16 lg:w-32 h-full bg-gradient-to-r from-bes-forest via-bes-forest/90 to-transparent z-10 pointer-events-none"></div>
            <div class="hidden md:block absolute top-0 right-0 w-16 lg:w-32 h-full bg-gradient-to-l from-bes-forest via-bes-forest/90 to-transparent z-10 pointer-events-none"></div>

            <div class="relative max-w-[1440px] mx-auto z-0">

                <div class="text-center mb-16 md:mb-20 bes-reveal">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <span class="w-10 h-[1px] bg-gradient-to-r from-transparent to-bes-leaf/50"></span>
                        <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">WISDOM</span>
                        <span class="w-10 h-[1px] bg-gradient-to-l from-transparent to-bes-leaf/50"></span>
                    </div>
                    <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight drop-shadow-sm">
                        Eling <em class="italic !text-bes-gold font-medium">Pedia</em>
                    </h2>
                    <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                        Jelajahi berbagai pengetahuan dan kebijaksanaan seputar spiritual wellness, yoga, meditasi, serta ilmu kehidupan untuk mendukung perjalanan menuju hidup yang lebih sadar dan seimbang.
                    </p>
                </div>

                <div class="relative bes-reveal" style="transition-delay: 0.2s;">
                    <div class="splide bes-wisdom-carousel-v2 pb-16">
                        <div class="splide__track !overflow-visible">
                            <ul class="splide__list">

                                <?php if ( $bes_v2_blog_query->have_posts() ) : while ( $bes_v2_blog_query->have_posts() ) : $bes_v2_blog_query->the_post(); ?>
                                    <?php
                                        $bes_v2_cats      = get_the_category();
                                        $bes_v2_catnm     = ! empty( $bes_v2_cats ) ? $bes_v2_cats[0]->name : 'Kebijaksanaan';
                                        $bes_v2_month_key = get_the_date( 'M' );
                                        $bes_v2_date_id   = sprintf(
                                            '%s %s %s',
                                            get_the_date( 'j' ),
                                            isset( $bes_v2_blog_months_id[ $bes_v2_month_key ] ) ? $bes_v2_blog_months_id[ $bes_v2_month_key ] : $bes_v2_month_key,
                                            get_the_date( 'Y' )
                                        );
                                        $bes_v2_permal = get_the_permalink();

                                        if ( strcasecmp( $bes_v2_catnm, 'Uncategorized' ) === 0 ) {
                                            $bes_v2_catnm = 'Tak Berkategori';
                                        }

                                        if ( bes_v2_is_preview_active() ) {
                                            $bes_v2_permal = bes_v2_append_preview_param( $bes_v2_permal );
                                        }
                                    ?>
                                    <li class="splide__slide">
                                        <a href="<?php echo esc_url( $bes_v2_permal ); ?>" class="group block h-full relative bg-[#1A2415] border border-white/[0.05] rounded-2xl overflow-hidden hover:border-bes-leaf/40 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(194,210,74,0.1)] flex flex-col">
                                            <div class="aspect-[4/3] overflow-hidden relative border-b border-white/[0.02]">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s] ease-out opacity-90 group-hover:opacity-100" />
                                                <?php else : ?>
                                                    <div class="w-full h-full bg-bes-forest flex items-center justify-center group-hover:scale-105 transition-transform duration-[1.5s]">
                                                        <i class="fa-solid fa-leaf text-bes-leaf/20 text-4xl"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="absolute inset-0 bg-gradient-to-t from-[#1A2415] via-transparent to-transparent opacity-90"></div>
                                                <div class="absolute bottom-4 left-5">
                                                    <span class="text-[9px] font-bold uppercase tracking-[0.2em] !text-bes-gold bg-black/50 backdrop-blur-md border border-white/10 shadow-lg px-4 py-2 rounded-full">
                                                        <?php echo esc_html( $bes_v2_catnm ); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="p-6 md:p-8 flex flex-col flex-1 relative z-10">
                                                <span class="text-bes-parchment/40 text-[10px] font-body uppercase tracking-[0.15em] mb-3 block">
                                                    <?php echo esc_html( $bes_v2_date_id ); ?>
                                                </span>
                                                <h3 class="font-display text-2xl lg:text-[26px] text-bes-ivory mb-4 group-hover:!text-bes-leaf transition-colors duration-300 leading-snug line-clamp-2">
                                                    <?php the_title(); ?>
                                                </h3>
                                                <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed mb-8 line-clamp-3">
                                                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
                                                </p>
                                                <div class="mt-auto border-t border-white/[0.04] pt-5">
                                                    <span class="inline-flex items-center gap-2 text-[10.5px] font-bold uppercase tracking-[0.15em] text-bes-leaf group-hover:!text-bes-gold transition-colors duration-300">
                                                        Baca Artikel <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-2 transition-transform duration-300"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endwhile; wp_reset_postdata(); else : ?>
                                    <li class="splide__slide">
                                        <p class="text-bes-parchment/50 font-body text-center p-10">Belum ada artikel.</p>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <?php
            if ( $bes_v2_blog_wpml_previous_language !== '' && $bes_v2_blog_wpml_previous_language !== 'id' ) {
                do_action( 'wpml_switch_language', $bes_v2_blog_wpml_previous_language );
            }
        ?>

        <style>
            .bes-wisdom-carousel-v2 .splide__arrows{position:absolute !important;top:50% !important;left:0 !important;width:100% !important;transform:translateY(-50%) !important;z-index:20 !important;pointer-events:none !important}
            .bes-wisdom-carousel-v2 .splide__arrow{position:absolute !important;top:50% !important;transform:translateY(-50%) !important;background:rgba(26,36,21,0.8) !important;backdrop-filter:blur(8px) !important;border:1px solid rgba(194,210,74,0.3) !important;color:#C2D24A !important;height:3.5rem !important;width:3.5rem !important;border-radius:50% !important;display:flex !important;align-items:center !important;justify-content:center !important;transition:all 0.4s cubic-bezier(.4,0,.2,1) !important;opacity:1 !important;pointer-events:auto !important}
            .bes-wisdom-carousel-v2 .splide__arrow:hover{background:#C2D24A !important;border-color:#C2D24A !important;color:#151E10 !important;transform:translateY(-50%) scale(1.1) !important;box-shadow:0 10px 25px -5px rgba(194,210,74,0.4) !important}
            .bes-wisdom-carousel-v2 .splide__arrow svg{fill:currentColor !important;height:1.25rem !important;width:1.25rem !important;display:block !important}
            .bes-wisdom-carousel-v2 .splide__arrow--prev{left:-1rem !important}
            .bes-wisdom-carousel-v2 .splide__arrow--next{right:-1rem !important}
            @media(min-width:1024px){.bes-wisdom-carousel-v2 .splide__arrow--prev{left:-3.5rem !important}.bes-wisdom-carousel-v2 .splide__arrow--next{right:-3.5rem !important}}
            .bes-wisdom-carousel-v2 .splide__pagination{position:absolute !important;bottom:0 !important;left:0 !important;right:0 !important;z-index:10 !important;padding:0 !important;margin:0 !important;display:flex !important;justify-content:center !important}
            .bes-wisdom-carousel-v2 .splide__pagination__page{background:rgba(194,210,74,0.2) !important;border:1px solid transparent !important;border-radius:50% !important;height:8px !important;width:8px !important;margin:0 6px !important;padding:0 !important;transition:all 0.4s cubic-bezier(0.25,1,0.5,1) !important;display:inline-block !important}
            .bes-wisdom-carousel-v2 .splide__pagination__page.is-active{background:#C2D24A !important;transform:scale(1.5) !important;border-color:rgba(255,255,255,0.2) !important;box-shadow:0 0 10px rgba(194,210,74,0.4) !important}
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initWisdomCarouselV2 = function() {
                var el = document.querySelector('.bes-wisdom-carousel-v2');
                if (el && typeof Splide !== 'undefined') {
                    new Splide(el, {
                        type:'loop', perPage:3, gap:'2.5rem', autoplay:true, interval:6000, speed:1000,
                        arrows:true, pagination:true, easing:'cubic-bezier(.4,0,.2,1)',
                        breakpoints:{ 1180:{perPage:2,gap:'2rem'}, 768:{perPage:1,gap:'1.5rem',padding:{left:0,right:'3rem'}}, 480:{padding:{left:0,right:'1.5rem'}} }
                    }).mount();
                } else if (el) { setTimeout(initWisdomCarouselV2, 150); }
            };
            initWisdomCarouselV2();
        });
        </script>
        <!-- ▲▲▲ §10 ELING PEDIA END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §11 — DENGARKAN PANGGILAN HATIMU (Contact)  (REVISED per PDF page 23)
         * --------------------------------------------------------------------
         * Was "Return to Your Sacred Home". Rewritten in Bahasa Indonesia
         * with the headline "Dengarkan Panggilan Hatimu" and CTAs
         * "Mulai Perjalanan Anda" + "Hubungi Kami". Contact details preserved:
         *   • Pejeng Kangin, Tampaksiring, Gianyar, Bali
         *   • +62 878 2598 9117 (WhatsApp)
         *   • balielingspirit@elinggroup.com
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §11 BEGIN YOUR JOURNEY — REVISED ▼▼▼ -->
        <?php
            $bes_v2_maps_url = 'https://www.google.com/maps/search/?api=1&query=Bali+Eling+Spirit+Pejeng+Kangin%2C+Tampaksiring%2C+Gianyar%2C+Bali';
            $bes_v2_contact_image = array(
                'img_id'   => 3432,
                'img_file' => '',
                'img'      => wp_get_attachment_url( 3432 ) ?: '',
                'alt'      => 'Gapura Bali Eling Spirit',
            );
        ?>
        <section id="contact" class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-bes-gold/5 rounded-full blur-[150px] pointer-events-none z-0"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-bes-leaf/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
            <div class="absolute top-0 left-10 right-10 h-[1px] bg-gradient-to-r from-transparent via-white/[0.03] to-transparent pointer-events-none"></div>

            <div class="relative max-w-[1440px] mx-auto grid lg:grid-cols-2 gap-16 lg:gap-24 items-center z-10">

                <div class="pr-0 lg:pr-10">
                    <div class="flex items-center gap-3 mb-6 bes-reveal" style="transition-delay: 0.1s;">
                        <span class="w-8 h-[1px] bg-bes-gold/40"></span>
                        <span class="font-body text-[10px] tracking-[0.3em] uppercase font-bold !text-bes-gold/90">Begin Your Journey</span>
                    </div>

                    <h2 class="font-display font-light leading-tight mb-6 text-5xl lg:text-6xl text-bes-ivory bes-reveal" style="transition-delay: 0.2s;">
                        Dengarkan<br>
                        <em class="italic !text-bes-gold font-medium">Panggilan Hatimu</em>
                    </h2>

                    <p class="font-body text-bes-parchment/65 text-[14.5px] leading-relaxed mb-12 bes-reveal" style="transition-delay: 0.3s;">
                        Di tengah kesibukan dan berbagai tuntutan kehidupan, terkadang yang paling kita butuhkan adalah ruang untuk berhenti sejenak, bernapas, dan mendengarkan diri sendiri. Bali Eling Spirit mengundang Anda untuk memulai perjalanan menuju kehidupan yang lebih sadar, seimbang, dan bermakna.
                    </p>

                    <div class="flex flex-col gap-2 mb-12 bes-reveal" style="transition-delay: 0.4s;">

                        <div class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300">
                            <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">LOKASI KAMI</div>
                                <div class="font-body text-[13.5px] text-bes-parchment/50 leading-relaxed group-hover:!text-bes-parchment/80 transition-colors">Pejeng Kangin, Tampaksiring, Gianyar,<br>Bali 80552, Indonesia</div>
                                <a href="<?php echo esc_url( $bes_v2_maps_url ); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 mt-3 font-body !text-bes-gold text-[10px] tracking-[0.18em] uppercase font-bold hover:!text-bes-leaf transition-colors">
                                    <span>GOOGLE MAPS</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <a href="https://wa.me/6287825989117" target="_blank" rel="noopener" class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300 cursor-pointer">
                            <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 flex-shrink-0">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </div>
                            <div class="pt-1">
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">WhatsApp</div>
                                <div class="font-body text-[13.5px] text-bes-parchment/50 group-hover:!text-bes-leaf transition-colors">+62 878 2598 9117</div>
                            </div>
                        </a>

                        <a href="mailto:balielingspirit@elinggroup.com" class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300 cursor-pointer">
                            <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 flex-shrink-0">
                                <i class="fa-solid fa-envelope-open-text text-sm"></i>
                            </div>
                            <div class="pt-1">
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Email</div>
                                <div class="font-body text-[13.5px] text-bes-parchment/50 group-hover:!text-bes-gold transition-colors">balielingspirit@elinggroup.com</div>
                            </div>
                        </a>

                    </div>

                    <div class="flex flex-wrap items-center gap-5 bes-reveal" style="transition-delay: 0.5s;">
                        <a href="https://wa.me/6287825989117" target="_blank" rel="noopener"
                           class="group relative overflow-hidden bg-bes-leaf text-bes-forest-deep font-body text-[11px] font-bold tracking-[0.18em] uppercase px-8 py-4 rounded-xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-[0_4px_20px_rgba(194,210,74,0.15)] hover:shadow-[0_8px_30px_rgba(194,210,74,0.3)] flex items-center gap-3">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span class="relative z-10">Mulai Perjalanan Anda</span>
                        </a>

                        <a href="mailto:balielingspirit@elinggroup.com"
                           class="group border border-bes-gold/30 !text-bes-gold font-body text-[11px] font-bold tracking-[0.18em] uppercase px-8 py-4 rounded-xl hover:bg-bes-gold hover:!text-bes-forest-deep transition-all duration-500 flex items-center gap-3">
                            <span class="relative z-10">Hubungi Kami</span>
                        </a>
                    </div>
                </div>

                <div class="relative bes-reveal" style="transition-delay: 0.3s;">
                    <div class="absolute -inset-4 bg-bes-leaf/10 blur-3xl rounded-full z-0 pointer-events-none"></div>

                    <a href="<?php echo esc_url( $bes_v2_maps_url ); ?>" target="_blank" rel="noopener" aria-label="Buka lokasi Bali Eling Spirit di Google Maps" class="block relative w-full h-[500px] lg:h-[600px] rounded-[2rem] overflow-hidden group border border-white/[0.05] z-10 shadow-2xl shadow-black/50">
                        <?php
                            echo bes_v2_get_full_media_image_html(
                                $bes_v2_contact_image,
                                array(
                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2.5s] ease-out',
                                )
                            );
                        ?>
                    </a>
                </div>

            </div>
        </section>
        <!-- ▲▲▲ §11 BEGIN YOUR JOURNEY END ▲▲▲ -->

        <?php
        /* ====================================================================
         * §12 — FAQ  (FEEDBACK #988978 / #988980 / #988982)
         * --------------------------------------------------------------------
         * Client-approved Indonesian FAQ heading, natural-language questions,
         * answers, and contact CTA. The removed retreat-preparation item is not
         * rendered. Accordion structure and interaction remain unchanged.
         * ==================================================================== */
        ?>
        <!-- ▼▼▼ §12 FAQ — CLIENT COPY COMPLETE / FEEDBACK #988978–#988982 ▼▼▼ -->
        <?php
            $bes_v2_faqs = array(
                array(
                    'q' => 'Apa itu Bali Eling Spirit?',
                    'a' => 'Bali Eling Spirit adalah sanctuary spiritual wellness di Bali yang menghadirkan perjalanan transformasi holistik melalui yoga, meditasi, life mastery, dan ajaran Sanatana Dharma untuk membantu Anda kembali terhubung dengan diri sejati.',
                ),
                array(
                    'q' => 'Di mana lokasi Bali Eling Spirit?',
                    'a' => 'Kami berlokasi di Banjar Umadawa, Pejeng Kangin, Gianyar, Bali, dalam lingkungan yang tenang dan sakral untuk mendukung proses pemulihan serta perjalanan spiritual Anda.',
                ),
                array(
                    'q' => 'Apakah program Bali Eling Spirit terbuka untuk semua orang?',
                    'a' => 'Ya. Program kami terbuka bagi peserta dari berbagai latar belakang dan keyakinan. Setiap perjalanan dirancang secara universal melalui yoga, meditasi, dan pengembangan kesadaran diri.',
                ),
                array(
                    'q' => 'Pakaian apa yang sebaiknya dikenakan saat berkunjung?',
                    'a' => 'Kenakan pakaian yang sopan, nyaman, dan leluasa untuk bergerak, seperti pakaian yoga. Pilihan busana tersebut membantu Anda mengikuti kegiatan dengan nyaman sekaligus menghormati suasana sakral Bali Eling Spirit.',
                ),
                array(
                    'q' => 'Apakah perlu melakukan reservasi sebelum datang?',
                    'a' => 'Ya. Reservasi paling lambat satu hari sebelumnya (H-1) diperlukan agar kami dapat memastikan ketersediaan pendamping, healer, pemangku, serta kesiapan program yang akan Anda ikuti.',
                ),
                array(
                    'q' => 'Apakah saya dapat menginap di Bali Eling Spirit?',
                    'a' => 'Akomodasi tersedia khusus bagi peserta program intensif yang mencakup sesi menginap, seperti Tapa Brata dan Atma Retreat. Saat ini kami tidak menyediakan akomodasi harian untuk umum.',
                ),
                array(
                    'q' => 'Apakah makanan yang disediakan vegetarian?',
                    'a' => 'Ya. Hidangan selama retreat disiapkan dalam bentuk makanan vegetarian yang bergizi dan bersifat sattvic untuk mendukung proses pemurnian tubuh, pikiran, dan energi.',
                ),
                array(
                    'q' => 'Apa itu Healing Retreat?',
                    'a' => 'Healing Retreat adalah perjalanan pemulihan selama lima jam, pukul 08.00–13.00, yang dirancang untuk membantu meredakan kelelahan, menyeimbangkan energi, dan memulihkan koneksi dengan diri melalui yoga, sound healing, serta prosesi melukat.',
                ),
                array(
                    'q' => 'Apa itu Tapa Brata?',
                    'a' => 'Tapa Brata merupakan program intensif selama empat hari tiga malam untuk membantu memulihkan luka batin, melepaskan beban emosional, serta membangkitkan kesadaran dan energi spiritual secara alami.',
                ),
                array(
                    'q' => 'Apa itu Atma Retreat?',
                    'a' => 'Atma Retreat adalah perjalanan spiritual privat dan personal selama tiga hari. Program ini menjadi pilihan bagi Anda yang membutuhkan pendampingan lebih khusus, jadwal yang fleksibel, dan ruang pemulihan yang lebih intim.',
                ),
                array(
                    'q' => 'Apa itu Pemurnian 7 Chakra?',
                    'a' => 'Pemurnian 7 Chakra adalah ritual pembersihan diri menggunakan tujuh jenis air suci, mantra, dan kristal untuk membantu membersihkan serta menyelaraskan pusat-pusat energi di dalam tubuh.',
                ),
                array(
                    'q' => 'Apakah Yoga Teacher Training (YTT) di Bali Eling Spirit bersertifikat?',
                    'a' => 'Ya. Program Eling Yoga Teacher Training 50 jam dan 200 jam dirancang secara komprehensif dan profesional untuk memperkuat kemampuan mengajar, kemandirian dalam praktik, serta pemahaman Dharma yang lebih mendalam.',
                ),
            );
            $bes_v2_col1 = array_slice( $bes_v2_faqs, 0, (int) ceil( count( $bes_v2_faqs ) / 2 ) );
            $bes_v2_col2 = array_slice( $bes_v2_faqs, (int) ceil( count( $bes_v2_faqs ) / 2 ) );
        ?>
        <section class="relative py-24 md:py-32 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden" data-bes-feedback="988978-988980-988982-section-9">
            <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-bes-forest to-transparent pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position: center top; filter: invert(1);"></div>

            <div class="relative max-w-[1280px] mx-auto">

                <div class="text-center mb-16 md:mb-20 bes-reveal">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                        <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">Panduan Perjalanan</span>
                        <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                    </div>
                    <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                        FAQ
                    </h2>
                    <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                        Temukan jawaban atas berbagai pertanyaan yang sering diajukan sebelum memulai perjalanan bersama Bali Eling Spirit. Mulai dari program, reservasi, hingga hal-hal yang perlu Anda persiapkan.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 items-start bes-reveal" style="transition-delay: 0.2s;">

                    <div class="flex flex-col gap-4">
                        <?php foreach ( $bes_v2_col1 as $faq ) : ?>
                            <div class="bes-faq-item-v2 bg-black/20 border border-white/[0.04] rounded-2xl overflow-hidden transition-colors duration-500 hover:border-bes-leaf/30">
                                <button class="bes-faq-btn-v2 w-full flex items-center justify-between gap-6 p-6 text-left focus:outline-none group" aria-expanded="false">
                                    <span class="font-display text-lg md:text-xl text-bes-ivory font-medium group-hover:!text-bes-leaf transition-colors duration-300">
                                        <?php echo esc_html( $faq['q'] ); ?>
                                    </span>
                                    <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center flex-shrink-0 group-hover:border-bes-leaf/50 transition-colors duration-300 bg-white/[0.02]">
                                        <i class="fa-solid fa-plus text-bes-leaf/70 text-sm bes-faq-icon-v2 transition-transform duration-500"></i>
                                    </div>
                                </button>
                                <div class="bes-faq-content-v2 max-h-0 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] bg-bes-forest/30">
                                    <div class="p-6 pt-0 font-body text-[14px] text-bes-parchment/60 leading-relaxed">
                                        <?php echo esc_html( $faq['a'] ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex flex-col gap-4">
                        <?php foreach ( $bes_v2_col2 as $faq ) : ?>
                            <div class="bes-faq-item-v2 bg-black/20 border border-white/[0.04] rounded-2xl overflow-hidden transition-colors duration-500 hover:border-bes-leaf/30">
                                <button class="bes-faq-btn-v2 w-full flex items-center justify-between gap-6 p-6 text-left focus:outline-none group" aria-expanded="false">
                                    <span class="font-display text-lg md:text-xl text-bes-ivory font-medium group-hover:!text-bes-leaf transition-colors duration-300">
                                        <?php echo esc_html( $faq['q'] ); ?>
                                    </span>
                                    <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center flex-shrink-0 group-hover:border-bes-leaf/50 transition-colors duration-300 bg-white/[0.02]">
                                        <i class="fa-solid fa-plus text-bes-leaf/70 text-sm bes-faq-icon-v2 transition-transform duration-500"></i>
                                    </div>
                                </button>
                                <div class="bes-faq-content-v2 max-h-0 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] bg-bes-forest/30">
                                    <div class="p-6 pt-0 font-body text-[14px] text-bes-parchment/60 leading-relaxed">
                                        <?php echo esc_html( $faq['a'] ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="mt-16 text-center bes-reveal" style="transition-delay: 0.3s;">
                    <p class="font-body text-bes-parchment/50 text-sm mb-6">Butuh informasi lebih lanjut? Silakan hubungi kami.</p>
                    <a href="https://wa.me/6287825989117" target="_blank" rel="noopener" class="inline-flex items-center gap-3 px-8 py-3.5 rounded-full border border-bes-leaf text-bes-forest bg-bes-leaf font-body text-[11px] uppercase tracking-[0.2em] font-bold hover:bg-transparent hover:!text-bes-leaf transition-all duration-300 shadow-[0_0_20px_rgba(194,210,74,0.15)] hover:shadow-[0_0_30px_rgba(194,210,74,0.3)]">
                        <i class="fa-brands fa-whatsapp text-sm"></i> Hubungi Kami
                    </a>
                </div>

            </div>
        </section>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btns = document.querySelectorAll('.bes-faq-btn-v2');
            btns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var content = this.nextElementSibling;
                    var icon = this.querySelector('.bes-faq-icon-v2');
                    var isOpen = this.getAttribute('aria-expanded') === 'true';
                    if (isOpen) {
                        this.setAttribute('aria-expanded', 'false');
                        content.style.maxHeight = null;
                        icon.style.transform = 'rotate(0deg)';
                        icon.classList.replace('fa-minus', 'fa-plus');
                    } else {
                        this.setAttribute('aria-expanded', 'true');
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.style.transform = 'rotate(180deg)';
                        icon.classList.replace('fa-plus', 'fa-minus');
                    }
                });
            });
        });
        </script>
        <!-- ▲▲▲ §12 FAQ END ▲▲▲ -->

        </main>

        <?php
        return ob_get_clean();
    } // end bes_render_home_content_v2()

} // end if ( ! function_exists ... )