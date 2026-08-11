<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — Snippet: MasterStudy LMS Single Course — Dark Sanctuary v3
 * ============================================================================
 *
 * @package BaliElingSpirit
 * @version 3.7.0
 *
 * v3.7 WISHLIST + SHARE — CARDLESS BUTTON REVAMP:
 *
 *   The wishlist + share buttons were rendered inside a __buttons
 *   wrapper styled as a card (background, border, padding, radius),
 *   making them look like contents of a panel rather than two
 *   discrete primary actions. The icons were also being suppressed
 *   by an aggressive ::before/::after kill rule (originally added
 *   to remove a stray plugin "rogue circle" pseudo-dot), with the
 *   collateral damage that the actual heart + share-arrow glyphs —
 *   which MasterStudy draws via ::before content — were dimmed or
 *   missing entirely.
 *
 *   v3.7 strips the __buttons wrapper of all card chrome (no
 *   background, no border, no padding, no radius, no shadow). It is
 *   now a pure flex row sitting transparently on the page background.
 *   Each child becomes a standalone pill button with its own:
 *     - leaf-tinted gradient surface (12% -> 6% leaf)
 *     - 1px border at rgba(216,228,140,0.32)
 *     - 14px x 18px padding, 52px min-height (44 mobile -> 48)
 *     - bold 0.78rem uppercase letter-spaced label
 *     - subtle inset highlight + drop shadow for premium definition
 *
 *   The native ::before icon glyph is now KEPT (not suppressed) and
 *   painted ivory-bright (rgba(253,252,250,0.95)) at 16px so the
 *   heart + share-arrow read clearly. Selector specificity uses
 *   `html body` prefix to beat MasterStudy's stylesheet rules which
 *   ship with !important. Only ::after is still suppressed (that's
 *   the actual rogue plugin dot).
 *
 *   HOVER state: the entire pill fills with the leaf gradient
 *   (matching the primary CTA), the icon flips to forest-deep for
 *   high contrast, lifts 2px, and casts a 22px glow at 32% leaf
 *   opacity. ACTIVE state settles back to 1px lift with a tighter
 *   shadow. FOCUS-VISIBLE adds a 2px leaf outline ring with 3px
 *   offset for keyboard users.
 *
 *   Mobile: the cardless layout is preserved at <=768px (an earlier
 *   responsive rule was re-adding 18px padding + radius to __buttons,
 *   re-creating the wrapper on small screens — now removed).
 *
 *   No JS changes from v3.6.
 *
 * v3.6 ACCORDION POLISH (post-v3.5 visual cleanup):
 *
 *   FIX 1 — Double-chevron on opened sections.
 *   MasterStudy ships a native ::after pseudo-arrow on .__toggler.
 *   v3.5 added a ::before arrow on top, producing a stacked "v over v"
 *   when a section was opened. v3.6 hard-suppresses ::after with
 *   `content: none / display: none` and keeps only the ::before
 *   arrow with rotation logic. Also brightens the chevron color
 *   from leaf-green to near-ivory (rgba(253,252,250,0.85)) so it
 *   reads clearly against the dark card.
 *
 *   FIX 2 — Ghost spacing between header and items.
 *   v3.5 applied the card chrome (border, radius, margin-bottom,
 *   overflow:hidden, box-shadow) to .__section, but .__section is
 *   ONLY the header bar, not the whole card. The .__materials list
 *   sits as a sibling of .__section inside .__wrapper, so the
 *   bordered card visually ended at the header and the materials
 *   panel rendered outside it — with a 12px gap from the section's
 *   margin-bottom and disconnected borders. v3.6 moves all card
 *   chrome to .__wrapper (which contains BOTH the header and the
 *   materials list) and resets .__section to a transparent flex
 *   header bar with no margin/border. The materials list now lives
 *   inside the same bordered card and the ghost gap is gone.
 *
 *   FIX 3 — Right-side icon visibility.
 *   Course Details widget icons (lectures, assignments, quizzes,
 *   duration), wishlist heart, share-button, and lesson-row type
 *   glyphs were all rendered in leaf-green on a leaf-tinted backdrop
 *   — same hue, low contrast, hard to see. v3.6 switches all of
 *   them to near-ivory (rgba(253,252,250,0.95)) via fill / stroke /
 *   color rules covering svg, svg path, and pseudo-element glyph
 *   variants. Lesson row <img> glyphs (which are colored SVGs) get
 *   `filter: brightness(0) invert(1) opacity(0.85)` so they render
 *   bright regardless of source SVG color. The Course Details icon
 *   wrappers also gain a 1px leaf-soft hairline border for a touch
 *   of premium definition.
 *
 *   No new selectors removed; only redefined. JS unchanged from v3.5.
 *
 * v3.5 ACCORDION REPAIR + RESPONSIVE SEPARATORS:
 *   PROBLEM 1: Curriculum accordion appeared "100% open on init" with
 *   dead toggles. Root cause: MasterStudy renders every section's
 *   __wrapper with the _opened modifier server-side and ships no
 *   inline JS to bind toggles on this configuration. Our prior CSS
 *   styled the wrapper as if always open, so even if a click had
 *   fired, nothing would have collapsed. The previous block had a
 *   shared rule on __section-title AND __wrapper that left the
 *   __materials list permanently flowing.
 *
 *   FIX (v3.5):
 *     - CSS: split the section-title rule from the __wrapper. The
 *       __materials <ul> now defaults to max-height:0/overflow:hidden
 *       and animates to a 4000px ceiling only when the parent
 *       __wrapper carries the native _opened modifier. No display
 *       or height !important overrides; the native class is the
 *       single source of truth for visibility.
 *     - CSS: chevron drawn via ::before on .__toggler, rotates -90deg
 *       when collapsed, 0deg when _opened.
 *     - JS: new bindCurriculumAccordion() — delegated click handler
 *       on each .masterstudy-curriculum-list root that toggles the
 *       _opened modifier on the closest __wrapper. Idempotent
 *       (TAGGED_CURR data attribute), wired into boot(), the
 *       MutationObserver mutation callback, the window.load late
 *       pass, and the late AJAX observer. Lesson links inside
 *       __materials are explicitly excluded so navigation still
 *       works.
 *
 *   PROBLEM 2: Course Details (sidebar card) and Hero __info
 *   (instructor / students / rating) widgets had no separators on
 *   desktop and looked like a soup of pills/lines on mobile. The
 *   transition from vertical (desktop) to horizontal (mobile) was
 *   not handled, so dividers either disappeared or clashed with
 *   the dark-kit palette.
 *
 *   FIX (v3.5):
 *     - Course Details __item rows: subtle 1px bottom border at
 *       rgba(255,255,255,0.08), suppressed on the last item so the
 *       card edge isn't double-lined.
 *     - Hero __info-block: ::after pseudo-element draws a 1px
 *       vertical divider on the right edge of every block except
 *       the last (desktop). At max-width:768px the divider rotates
 *       to a 1px horizontal line along the bottom edge of each
 *       block as they stack to full width. Color clamped to
 *       rgba(255,255,255,0.1) — the premium dark-kit token.
 *
 *   No prior selectors removed; only redefined or extended. Backwards
 *   compatible with the v3.4 hero stack + sidebar containment.
 *
 * v3.4 LAYOUT-KIT-2 (hero stack + sidebar containment):
 *   The previous hero kit floated meta beside the title; with the long
 *   "Yoga Teacher Training 50 Hour | Hybrid" headline this caused the
 *   title to wrap into a tall column while meta floated awkwardly to
 *   the right with empty avatar gaps and a misaligned student counter.
 *   v3.4 swaps to a STACKED kit: title fills the hero width on its own
 *   row, meta sits below as a single horizontal strip on a divider —
 *   robust to any title length and any combination of meta blocks.
 *
 *   The wishlist/share row was also overflowing the card boundary
 *   because the parent card padding was being eaten by full-width
 *   pills. v3.4 contains them properly with reduced gap, smaller
 *   internal padding, and a max-width clamp on the row itself.
 *
 *   The buy CTA tax-info caption was being rendered OUTSIDE the leaf
 *   pill against the dark background. v3.4 moves the caption visually
 *   inside the same card via a wrapper that spans the full sidebar
 *   card surface (inheriting the bark-soft background), with the leaf
 *   pill stacked above it as a self-contained CTA.
 *
 * v3.3 PRODUCTION HARDENING (console-error resilience):
 *   The page environment runs Elementor, FlyingPress, Rank Math, plus
 *   user-installed browser extensions (ImprovedTube, fingerprint guards,
 *   ad blockers, TrustedScript enforcers). Some of those throw errors
 *   that, while unrelated to our styler, can interrupt sibling inline
 *   scripts in certain browsers. v3.3 makes our normalizer bulletproof:
 *
 *     - Every function body wrapped in try/catch so a single failure
 *       (e.g. a node detached mid-mutation) cannot kill the whole IIFE.
 *     - All DOM writes use setAttribute / style.setProperty / classList
 *       / appendChild — never innerHTML or eval — so TrustedScript /
 *       Trusted Types policies cannot block us.
 *     - Boot deferred via requestAnimationFrame to let Elementor's
 *       elementorFrontendConfig settle before we touch the DOM.
 *     - MutationObserver targets are validated as real Nodes before
 *       observe() is called (avoids the "parameter 1 is not of type
 *       Node" failure pattern seen in extensions).
 *     - All listeners use passive:true where applicable.
 *     - The CSS reveal failsafe runs even if JS never fires at all.
 *
 *   None of the console errors observed (Tailwind CDN warning, YouTube
 *   postMessage, googleads ERR_BLOCKED_BY_CLIENT, ImprovedTube, Ex.js,
 *   isolated.js, FingerPrint.js, proxy-apply.js TrustedScript) originate
 *   from this snippet — they come from plugins or browser extensions.
 *   They are documented here for triage clarity and the styler is
 *   isolated from all of them.
 *
 * v3.2 EMERGENCY RECALIBRATION (sidebar collapse + header collision):
 *   PROBLEM 1: Sidebar cards rendered at ~80px wide ("gepeng") because
 *   MasterStudy's __sidebar inherits a flex-basis from the parent grid
 *   that our grid-template-columns alone could not override at every
 *   breakpoint. Solution: hard-pin the sidebar column with an explicit
 *   width AND inject JS that strips MasterStudy's restrictive layout
 *   classes on first paint, replacing them with our own bes-* tags.
 *
 *   PROBLEM 2: Course title collides with the global #bes-hdr (fixed,
 *   z-index 9990, ~64-90px tall depending on scroll). The previous
 *   padding-top was being overridden by Elementor / theme container
 *   resets. Solution: walk up to .stm-lms-wrapper AND its container
 *   AND the masterstudy-lms shell, set min top-padding via html-prefixed
 *   selectors for max specificity, plus a JS fallback that forces the
 *   inline style if CSS still loses.
 *
 * v3.1 SURGICAL RECALIBRATION (ergonomic + raw-HTML map pass):
 *   - Sticky sidebar top recalculated against #bes-hdr fixed (z:9990, ~64px
 *     scrolled) + WP admin-bar to prevent overlap with site header.
 *   - All interactive controls bumped to 44px+ touch target on mobile
 *     (tabs, wishlist/share pills, curriculum lessons, primary CTAs).
 *   - Hero __info now wraps gracefully on narrow viewports; instructor row
 *     no longer collapses awkwardly when relocated.
 *   - Container padding floor raised so tabs__content and curriculum copy
 *     never touch the screen edge on 380px devices.
 *   - Tabs strip given subtle right-edge fade hint to telegraph horizontal
 *     scroll on mobile without affecting hit area.
 *   - z-index normalized: hero (auto), tabs strip (1), sticky bar (50),
 *     site header (inherits 9990) — no overlaps.
 *   - Active tab pill now stays legible against the leaf gradient with
 *     stronger forest-text contrast.
 *
 * STRATEGY (v3 — FULL DARK + DOM REFACTOR):
 *   v2 hit conflicts because MasterStudy renders the meta block
 *   (.masterstudy-single-course__info: instructor / students / rating)
 *   as a SIBLING of __heading, not a child. Our CSS scoped to .bes-hero
 *   could never reach it, so the hero looked empty while meta floated
 *   below as plain text on parchment.
 *
 *   v3 takes a hard line: the JS NORMALIZER physically RELOCATES the DOM
 *   nodes into the layout we want, then CSS styles the normalized tree.
 *   No more specificity wars — the markup is ours.
 *
 *   Key v3 changes:
 *   - Full DARK MODE — forest/bark backdrop site-wide on course page,
 *     ivory text, leaf accents. Cards are bark-soft on forest-deep.
 *   - JS moves __info INTO bes-hero (after the title).
 *   - JS neutralizes plugin icon pseudo-elements that broke wishlist/share.
 *   - Compacted sticky mobile bar so it never collides with WhatsApp bubble.
 *   - More top-wrapper breathing room so the site header sits clear.
 *   - Hardened responsive: 1280 / 1024 / 768 / 480 / 380 breakpoints.
 *
 *   JS NORMALIZER (idempotent, MutationObserver-guarded):
 *   - Tags root: bes-course-root
 *   - Tags __main / __sidebar
 *   - Tags __heading as bes-hero AND moves __info inside it
 *   - Tags __topbar as bes-utility-bar
 *   - Adds bes-tab-active mirror class on click
 *   - Re-clamps any plugin-injected icon SVGs that overflow
 *
 * UNIVERSAL TARGETING: only conditional gate is is_singular('stm-courses').
 * No hardcoded post IDs / slugs.
 *
 * INJECTION: wp_head priority 1, internal <style> + inline <script>.
 */

if (! defined('ABSPATH')) exit;


/* =========================================================================
 * INJECT DARK SANCTUARY STYLES + JS NORMALIZER — wp_head priority 1
 * ========================================================================= */
add_action('wp_head', 'bes_single_course_revamp_assets', 1);
function bes_single_course_revamp_assets()
{
    if (! is_singular('stm-courses')) return;

    /* BES Dark Sanctuary tokens */
    $forest      = '#1E2A16';
    $forest_deep = '#0F1609';   /* deeper than v2 for full dark backdrop */
    $forest_92   = '#263320';
    $olive       = '#3F5130';
    $moss        = '#6B7F5A';
    $leaf        = '#C2D24A';
    $leaf_hover  = '#AFBF38';
    $leaf_soft   = '#D8E48C';
    $gold        = '#C9A84C';
    $gold_soft   = '#E8D5A0';
    $parchment   = '#F7F4EE';
    $ivory       = '#FDFCFA';
    $cream       = '#F2EDE4';
    $bark        = '#1C2415';
    $bark_soft   = '#2A3520';   /* card surface on dark */
    $bark_card   = '#1A2210';   /* slightly darker card */
    $bark_muted  = '#8C9A7E';
    $line_dark   = 'rgba(216, 228, 140, 0.14)';
?>
    <!-- ====== BES MasterStudy Single Course — Dark Sanctuary v3.7 ====== -->
    <style id="bes-single-course-revamp">

        /* ====================================================================
         * 0. LOCAL TOKENS
         * ==================================================================== */
        body.single-stm-courses {
            --bes-forest:        <?php echo $forest; ?>;
            --bes-forest-deep:   <?php echo $forest_deep; ?>;
            --bes-forest-92:     <?php echo $forest_92; ?>;
            --bes-olive:         <?php echo $olive; ?>;
            --bes-moss:          <?php echo $moss; ?>;
            --bes-leaf:          <?php echo $leaf; ?>;
            --bes-leaf-hover:    <?php echo $leaf_hover; ?>;
            --bes-leaf-soft:     <?php echo $leaf_soft; ?>;
            --bes-gold:          <?php echo $gold; ?>;
            --bes-gold-soft:     <?php echo $gold_soft; ?>;
            --bes-parchment:     <?php echo $parchment; ?>;
            --bes-ivory:         <?php echo $ivory; ?>;
            --bes-cream:         <?php echo $cream; ?>;
            --bes-bark:          <?php echo $bark; ?>;
            --bes-bark-soft:     <?php echo $bark_soft; ?>;
            --bes-bark-card:     <?php echo $bark_card; ?>;
            --bes-bark-muted:    <?php echo $bark_muted; ?>;
            --bes-line-dark:     <?php echo $line_dark; ?>;

            --bes-font-display: "Cormorant Garamond", Georgia, "Times New Roman", serif;
            --bes-font-body:    "Plus Jakarta Sans", "Helvetica Neue", Arial, sans-serif;

            --bes-radius-sm: 10px;
            --bes-radius-md: 14px;
            --bes-radius-lg: 22px;
            --bes-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.30);
            --bes-shadow-md: 0 8px 28px rgba(0, 0, 0, 0.36);
            --bes-shadow-lg: 0 18px 50px rgba(0, 0, 0, 0.50);

            --bes-sidebar-w: 360px;
            --bes-gap: clamp(20px, 3vw, 36px);

            /* Top spacing — generous so site header always breathes.
               Site #bes-hdr is fixed, ~76px tall; admin bar adds 32px;
               we add a comfort buffer of ~60px on top. */
            --bes-page-top: clamp(150px, 18vh, 210px);
            --bes-page-top-admin: clamp(180px, 20vh, 240px);
        }

        /* ====================================================================
         * 1. PAGE BACKDROP — full dark mode, ample top space
         *    NOTE: html-prefixed selectors win specificity wars against the
         *    theme's container resets and Elementor's body padding rules.
         * ==================================================================== */
        body.single-stm-courses {
            background: var(--bes-forest-deep) !important;
            font-family: var(--bes-font-body) !important;
            color: var(--bes-ivory) !important;
        }

        html body.single-stm-courses .masterstudy-lms-learning-management-system,
        html body.single-stm-courses .masterstudy-lms,
        html body.single-stm-courses .stm-lms-wrapper {
            background: transparent !important;
            padding-top: var(--bes-page-top) !important;
            padding-bottom: clamp(80px, 10vh, 130px) !important;
            margin-top: 0 !important;
        }

        html body.admin-bar.single-stm-courses .masterstudy-lms-learning-management-system,
        html body.admin-bar.single-stm-courses .masterstudy-lms,
        html body.admin-bar.single-stm-courses .stm-lms-wrapper {
            padding-top: var(--bes-page-top-admin) !important;
        }

        body.single-stm-courses .stm-lms-wrapper {
            background: transparent !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        body.single-stm-courses .stm-lms-wrapper > .container,
        body.single-stm-courses .stm-lms-wrapper .container {
            background: transparent !important;
            max-width: 1280px !important;
            width: 100% !important;
            margin: 0 auto !important;
            padding: 0 clamp(18px, 3vw, 32px) !important;
            box-sizing: border-box !important;
        }

        /* ====================================================================
         * 2. ROOT GRID — hard-pinned sidebar, html-prefixed for max specificity
         * ==================================================================== */
        html body.single-stm-courses .masterstudy-single-course,
        html body.single-stm-courses .bes-course-root {
            display: grid !important;
            grid-template-columns: minmax(0, 1fr) var(--bes-sidebar-w) !important;
            gap: var(--bes-gap) !important;
            align-items: start !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: transparent !important;
            font-family: var(--bes-font-body) !important;
            color: var(--bes-ivory) !important;
            float: none !important;
            box-sizing: border-box !important;
        }

        html body.single-stm-courses .masterstudy-single-course__main,
        html body.single-stm-courses .bes-col-main {
            min-width: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            flex: 1 1 auto !important;
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            display: flex !important;
            flex-direction: column !important;
            gap: clamp(18px, 2.5vw, 26px) !important;
            box-sizing: border-box !important;
            grid-column: 1 / 2 !important;
        }

        html body.single-stm-courses .masterstudy-single-course__sidebar,
        html body.single-stm-courses .bes-col-sidebar {
            min-width: var(--bes-sidebar-w) !important;
            width: var(--bes-sidebar-w) !important;
            max-width: var(--bes-sidebar-w) !important;
            flex: 0 0 var(--bes-sidebar-w) !important;
            background: transparent !important;
            padding: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 14px !important;
            position: sticky;
            top: clamp(96px, 12vh, 130px);
            align-self: start;
            z-index: 1;
            box-sizing: border-box !important;
            grid-column: 2 / 3 !important;
        }

        body.admin-bar.single-stm-courses .bes-col-sidebar,
        html body.admin-bar.single-stm-courses .masterstudy-single-course__sidebar {
            top: clamp(128px, 14vh, 162px);
        }

        /* ====================================================================
         * 3. UTILITY BAR — categories pills (NOT a hero)
         * ==================================================================== */
        body.single-stm-courses .bes-utility-bar {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            box-shadow: none !important;
            min-height: 0 !important;
        }

        body.single-stm-courses .bes-utility-bar .masterstudy-single-course__row {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            background: transparent !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories__title {
            color: var(--bes-leaf-soft) !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.16em !important;
            text-transform: uppercase !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories__container,
        body.single-stm-courses .masterstudy-single-course-categories__list,
        body.single-stm-courses .masterstudy-single-course-categories__wrapper {
            display: inline-flex !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories__item-wrapper,
        body.single-stm-courses .masterstudy-single-course-categories__item {
            display: inline-flex !important;
            align-items: center !important;
            padding: 5px 12px !important;
            border-radius: 999px !important;
            background: rgba(194, 210, 74, 0.10) !important;
            border: 1px solid rgba(194, 210, 74, 0.28) !important;
            transition: all 0.25s ease !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.12em !important;
            text-transform: uppercase !important;
            color: var(--bes-leaf-soft) !important;
            text-decoration: none !important;
            line-height: 1.2 !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories__item-wrapper:hover,
        body.single-stm-courses .masterstudy-single-course-categories__item:hover {
            background: rgba(194, 210, 74, 0.22) !important;
            border-color: var(--bes-leaf) !important;
            color: var(--bes-ivory) !important;
            transform: translateY(-1px);
        }

        body.single-stm-courses .masterstudy-single-course-categories__item a {
            color: inherit !important;
            text-decoration: none !important;
        }

        body.single-stm-courses .masterstudy-single-course-categories__icon {
            color: var(--bes-leaf) !important;
        }

        /* ====================================================================
         * 4. HERO — JS moves __info inside, so meta is in the hero card
         * ==================================================================== */
        body.single-stm-courses .bes-hero {
            position: relative !important;
            background: linear-gradient(135deg,
                #0A1206 0%,
                var(--bes-forest) 55%,
                var(--bes-forest-92) 100%) !important;
            border-radius: var(--bes-radius-lg) !important;
            padding: clamp(32px, 4.5vw, 56px) clamp(24px, 4vw, 52px) !important;
            margin: 0 !important;
            box-shadow: var(--bes-shadow-lg) !important;
            overflow: hidden !important;
            isolation: isolate;
            color: var(--bes-ivory) !important;
            border: 1px solid var(--bes-line-dark) !important;
            z-index: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 0 !important;
        }

        body.single-stm-courses .bes-hero::before {
            content: "";
            position: absolute;
            top: -25%; right: -10%;
            width: 55%; height: 150%;
            background: radial-gradient(ellipse at center,
                rgba(194,210,74,0.22) 0%,
                rgba(194,210,74,0.06) 40%,
                transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        body.single-stm-courses .bes-hero::after {
            content: "";
            position: absolute;
            left: clamp(24px, 4vw, 52px);
            right: clamp(24px, 4vw, 52px);
            top: 0;
            height: 2px;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--bes-gold) 30%,
                var(--bes-gold-soft) 50%,
                var(--bes-gold) 70%,
                transparent 100%);
            opacity: 0.5;
            z-index: 1;
        }

        body.single-stm-courses .bes-hero > * {
            position: relative;
            z-index: 2;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-title,
        body.single-stm-courses .bes-hero h1 {
            font-family: var(--bes-font-display) !important;
            font-weight: 500 !important;
            color: var(--bes-ivory) !important;
            font-size: clamp(1.85rem, 3.4vw, 3rem) !important;
            line-height: 1.15 !important;
            letter-spacing: -0.015em !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            display: block !important;
            order: 1 !important;
        }

        /* The relocated __info block — JS appends it inside bes-hero.
           LAYOUT-KIT-2: full-width meta strip BELOW the title on its
           own row, separated by a leaf-tinted divider. Robust to any
           title length and any subset of meta children. */
        body.single-stm-courses .bes-hero .masterstudy-single-course__info {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            justify-content: flex-start !important;
            column-gap: clamp(20px, 2.8vw, 36px) !important;
            row-gap: clamp(12px, 1.8vw, 16px) !important;
            margin: clamp(20px, 2.5vw, 28px) 0 0 !important;
            padding: clamp(18px, 2.2vw, 24px) 0 0 !important;
            border-top: 1px solid rgba(216, 228, 140, 0.14) !important;
            width: 100% !important;
            max-width: 100% !important;
            order: 2 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course__info-block {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            color: rgba(247, 244, 238, 0.92) !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.92rem !important;
            background: transparent !important;
            margin: 0 !important;
            padding: 0 clamp(20px, 2.8vw, 36px) 0 0 !important;
            min-width: 0 !important;
            flex: 0 0 auto !important;
            position: relative !important;
        }
        /* DESKTOP — vertical separator on the right edge of each block,
           except the last. The line uses the dark-kit token opacity. */
        body.single-stm-courses .bes-hero .masterstudy-single-course__info-block::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 1px;
            height: 60%;
            background: rgba(255, 255, 255, 0.1);
            pointer-events: none;
        }
        body.single-stm-courses .bes-hero .masterstudy-single-course__info-block:last-child::after {
            display: none;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-current-students,
        body.single-stm-courses .bes-hero .masterstudy-single-course-current-students__wrapper {
            display: inline-flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: center !important;
            gap: 2px !important;
            color: rgba(247, 244, 238, 0.92) !important;
            background: transparent !important;
            line-height: 1.15 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-current-students__count {
            font-family: var(--bes-font-display) !important;
            font-size: 1.35rem !important;
            font-weight: 700 !important;
            color: var(--bes-leaf-soft) !important;
            line-height: 1 !important;
            display: block !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-current-students__title {
            color: rgba(247, 244, 238, 0.6) !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            display: block !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating,
        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__wrapper {
            display: inline-flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: center !important;
            gap: 4px !important;
            background: transparent !important;
            line-height: 1.15 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__star-wrapper {
            display: inline-flex !important;
            gap: 2px !important;
            align-items: center !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__star,
        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__star::before {
            color: var(--bes-gold) !important;
            font-size: 0.95rem !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__star svg,
        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__star path {
            fill: var(--bes-gold) !important;
            color: var(--bes-gold) !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__count {
            color: var(--bes-leaf-soft) !important;
            font-size: 0.92rem !important;
            font-weight: 700 !important;
            margin-left: 6px !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-rating__quantity {
            color: rgba(247, 244, 238, 0.6) !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            display: block !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            background: transparent !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__avatar {
            position: relative !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
            background: linear-gradient(135deg,
                rgba(194, 210, 74, 0.30) 0%,
                rgba(63, 81, 48, 0.55) 100%) !important;
            border: 2px solid rgba(194, 210, 74, 0.45) !important;
            box-shadow: 0 0 0 3px rgba(15, 22, 9, 0.6) !important;
            overflow: hidden !important;
            flex-shrink: 0 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__avatar img {
            border: none !important;
            box-shadow: none !important;
            border-radius: 50% !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            display: block !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__info {
            display: inline-flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: center !important;
            gap: 2px !important;
            line-height: 1.15 !important;
            min-width: 0 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__name,
        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__name a {
            color: var(--bes-leaf-soft) !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            font-size: 0.95rem !important;
            line-height: 1.15 !important;
            transition: color 0.25s ease;
            display: block !important;
            order: 2 !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__name a:hover {
            color: var(--bes-leaf) !important;
        }

        body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__title {
            color: rgba(247, 244, 238, 0.6) !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            display: block !important;
            line-height: 1.15 !important;
            order: 1 !important;
        }

        /* ====================================================================
         * 4b. ORPHAN __info — fallback if JS hasn't relocated yet
         * ==================================================================== */
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            gap: clamp(14px, 2.5vw, 28px) !important;
            background: var(--bes-bark-soft) !important;
            border: 1px solid var(--bes-line-dark) !important;
            border-radius: var(--bes-radius-md) !important;
            padding: 18px 22px !important;
            color: var(--bes-ivory) !important;
        }
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course__info-block {
            color: rgba(247, 244, 238, 0.92) !important;
        }
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course-instructor__title,
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course-current-students__title,
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course-rating__quantity {
            color: rgba(247, 244, 238, 0.7) !important;
        }
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course-instructor__name,
        body.single-stm-courses .bes-col-main > .masterstudy-single-course__info .masterstudy-single-course-instructor__name a {
            color: var(--bes-leaf-soft) !important;
        }

        /* ====================================================================
         * 5. NAVIGATION TABS
         * ==================================================================== */
        body.single-stm-courses .masterstudy-single-course-tabs,
        body.single-stm-courses .masterstudy-single-course-tabs_style-underline {
            display: flex !important;
            flex-wrap: nowrap !important;
            gap: 4px !important;
            padding: 6px !important;
            margin: 0 !important;
            background: var(--bes-bark-soft) !important;
            border-radius: 999px !important;
            border: 1px solid var(--bes-line-dark) !important;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.30), var(--bes-shadow-sm) !important;
            justify-content: flex-start !important;
            align-items: center !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            list-style: none !important;
            position: relative !important;
            z-index: 1 !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs::-webkit-scrollbar,
        body.single-stm-courses .masterstudy-single-course-tabs_style-underline::-webkit-scrollbar {
            display: none !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__item {
            font-family: var(--bes-font-body) !important;
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            color: rgba(247, 244, 238, 0.65) !important;
            background: transparent !important;
            padding: 12px 22px !important;
            margin: 0 !important;
            border: none !important;
            border-radius: 999px !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            white-space: nowrap !important;
            line-height: 1 !important;
            min-height: 40px !important;
            flex-shrink: 0 !important;
            text-decoration: none !important;
            list-style: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__item::after,
        body.single-stm-courses .masterstudy-single-course-tabs__item::before {
            display: none !important;
            content: none !important;
            background: none !important;
            border: none !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__item:hover {
            color: var(--bes-leaf-soft) !important;
            background: rgba(194, 210, 74, 0.12) !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__item.masterstudy-single-course-tabs__item_active,
        body.single-stm-courses .masterstudy-single-course-tabs__item_active,
        body.single-stm-courses .masterstudy-single-course-tabs__item.bes-tab-active {
            color: var(--bes-forest-deep) !important;
            background: linear-gradient(135deg,
                var(--bes-leaf) 0%,
                var(--bes-leaf-hover) 100%) !important;
            box-shadow:
                0 4px 14px rgba(194, 210, 74, 0.36),
                inset 0 1px 0 rgba(255, 255, 255, 0.34) !important;
            font-weight: 800 !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__content {
            background: var(--bes-bark-soft) !important;
            border-radius: var(--bes-radius-lg) !important;
            padding: clamp(22px, 3vw, 38px) !important;
            margin: 0 !important;
            box-shadow: var(--bes-shadow-md) !important;
            border: 1px solid var(--bes-line-dark) !important;
            color: var(--bes-ivory) !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__container {
            display: none !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__container.masterstudy-single-course-tabs__container_active,
        body.single-stm-courses .masterstudy-single-course-tabs__container_active {
            display: block !important;
            animation: bes-tab-fade 0.35s ease forwards;
        }

        @keyframes bes-tab-fade {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ====================================================================
         * 6. CONTENT TYPOGRAPHY (DARK)
         * ==================================================================== */
        body.single-stm-courses .masterstudy-single-course-tabs__content h1,
        body.single-stm-courses .masterstudy-single-course-tabs__content h2,
        body.single-stm-courses .masterstudy-single-course-tabs__content h3,
        body.single-stm-courses .masterstudy-single-course-tabs__content h4,
        body.single-stm-courses .masterstudy-single-course-description h2,
        body.single-stm-courses .masterstudy-single-course-description h3,
        body.single-stm-courses .masterstudy-single-course-description h4 {
            font-family: var(--bes-font-display) !important;
            font-weight: 500 !important;
            color: var(--bes-leaf-soft) !important;
            letter-spacing: -0.01em !important;
            line-height: 1.25 !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__content h2 {
            font-size: clamp(1.55rem, 2.4vw, 2rem) !important;
            margin: 0.4em 0 0.55em !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__content h3 {
            font-size: clamp(1.25rem, 1.9vw, 1.55rem) !important;
            margin: 1em 0 0.5em !important;
        }

        body.single-stm-courses .masterstudy-single-course-description,
        body.single-stm-courses .masterstudy-single-course-description__content,
        body.single-stm-courses .masterstudy-single-course-description p,
        body.single-stm-courses .masterstudy-single-course-description li,
        body.single-stm-courses .masterstudy-single-course-tabs__content p,
        body.single-stm-courses .masterstudy-single-course-tabs__content li,
        body.single-stm-courses .masterstudy-single-course-tabs__content span {
            font-family: var(--bes-font-body) !important;
            color: rgba(247, 244, 238, 0.88) !important;
            font-size: 1rem !important;
            line-height: 1.75 !important;
        }

        body.single-stm-courses .masterstudy-single-course-description__image {
            border-radius: var(--bes-radius-md) !important;
            overflow: hidden !important;
            margin: 0 0 clamp(18px, 2.5vh, 28px) !important;
            box-shadow: var(--bes-shadow-sm) !important;
            max-width: 100% !important;
        }

        body.single-stm-courses .masterstudy-single-course-description__image img {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            border-radius: var(--bes-radius-md) !important;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__content a,
        body.single-stm-courses .masterstudy-single-course-description a {
            color: var(--bes-leaf) !important;
            text-decoration: underline;
            text-decoration-color: rgba(194, 210, 74, 0.5);
            text-underline-offset: 3px;
            transition: all 0.25s ease;
        }

        body.single-stm-courses .masterstudy-single-course-tabs__content a:hover,
        body.single-stm-courses .masterstudy-single-course-description a:hover {
            color: var(--bes-leaf-soft) !important;
            text-decoration-color: var(--bes-leaf-soft);
        }

        /* ====================================================================
         * 7. COURSE DETAILS (sidebar card)
         * ==================================================================== */
        body.single-stm-courses .masterstudy-single-course-details,
        body.single-stm-courses .masterstudy-single-course-details_default {
            background: transparent !important;
            border-radius: 0 !important;
            padding: 0 !important;
            border: none !important;
            margin: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 14px !important;
        }

        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-details__title {
            display: block !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.18em !important;
            text-transform: uppercase !important;
            color: var(--bes-leaf-soft) !important;
            margin-bottom: 6px !important;
        }

        body.single-stm-courses .masterstudy-single-course-details__item {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            padding: 0 0 14px 0 !important;
            position: relative !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        /* Last item: drop the bottom rule so the card edge isn't double-lined. */
        body.single-stm-courses .masterstudy-single-course-details__item:last-child {
            padding-bottom: 0 !important;
            border-bottom: 0 !important;
        }

        body.single-stm-courses .masterstudy-single-course-details__icon-wrapper {
            background: rgba(194, 210, 74, 0.18) !important;
            border: 1px solid rgba(216, 228, 140, 0.35) !important;
            border-radius: 50% !important;
            width: 38px !important;
            height: 38px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
        }

        /* Icon glyphs (lectures, assignments, quizzes, duration, etc.)
           Brightened to near-ivory so they read clearly against the
           leaf-tinted circular wrapper. Previously bes-leaf which had
           insufficient contrast on the same-hue background. */
        body.single-stm-courses .masterstudy-single-course-details__icon,
        body.single-stm-courses .masterstudy-single-course-details__icon svg,
        body.single-stm-courses .masterstudy-single-course-details__icon svg path,
        body.single-stm-courses .masterstudy-single-course-details__icon svg * {
            color: rgba(253, 252, 250, 0.95) !important;
            fill: rgba(253, 252, 250, 0.95) !important;
            stroke: rgba(253, 252, 250, 0.95) !important;
            opacity: 1 !important;
        }
        /* The font-icon variant uses ::before glyphs from MasterStudy's
           icon font — match the same brightness. */
        body.single-stm-courses .masterstudy-single-course-details__icon::before {
            color: rgba(253, 252, 250, 0.95) !important;
            opacity: 1 !important;
        }

        body.single-stm-courses .masterstudy-single-course-details__name {
            font-family: var(--bes-font-body) !important;
            font-size: 0.66rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            color: rgba(247, 244, 238, 0.55) !important;
            display: block;
        }

        body.single-stm-courses .masterstudy-single-course-details__quantity,
        body.single-stm-courses .masterstudy-single-course-details__info {
            font-family: var(--bes-font-display) !important;
            font-size: 1.3rem !important;
            font-weight: 600 !important;
            color: var(--bes-leaf-soft) !important;
            line-height: 1 !important;
        }

        /* ====================================================================
         * 8. CURRICULUM ACCORDION (DARK)
         * ==================================================================== */
        body.single-stm-courses .masterstudy-curriculum-list,
        body.single-stm-courses .masterstudy-curriculum-list__container,
        body.single-stm-courses .masterstudy-curriculum-list__container-wrapper {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
        }

        /* CARD CHROME — applied to __wrapper (which contains BOTH the
           header __section AND the __materials list). v3.5 had this on
           __section, which made the materials panel render OUTSIDE the
           bordered card and produced a 12px ghost gap between the
           header and the items when expanded. Moving the chrome to
           __wrapper unifies the card and removes the gap. */
        body.single-stm-courses .masterstudy-curriculum-list__wrapper {
            background: var(--bes-bark-card) !important;
            border: 1px solid var(--bes-line-dark) !important;
            border-radius: var(--bes-radius-md) !important;
            margin: 0 0 12px 0 !important;
            overflow: hidden !important;
            transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
            box-shadow: var(--bes-shadow-sm) !important;
            padding: 0 !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__wrapper:hover {
            border-color: rgba(194, 210, 74, 0.4) !important;
            box-shadow: var(--bes-shadow-md) !important;
        }

        /* __section is now ONLY the clickable header bar — no border,
           no margin, no radius. Those live on __wrapper. It IS a flex
           row so the title span and toggler span sit on one line and
           the toggler can use margin-left:auto to pin itself right. */
        body.single-stm-courses .masterstudy-curriculum-list__section {
            background: linear-gradient(90deg,
                rgba(194, 210, 74, 0.10) 0%,
                transparent 100%) !important;
            border: none !important;
            border-radius: 0 !important;
            margin: 0 !important;
            padding: 16px 20px !important;
            box-shadow: none !important;
            cursor: pointer;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            user-select: none;
        }
        body.single-stm-courses .masterstudy-curriculum-list__section-title {
            font-family: var(--bes-font-display) !important;
            font-size: 1.15rem !important;
            font-weight: 600 !important;
            color: var(--bes-leaf-soft) !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            display: inline-block !important;
            line-height: 1.3 !important;
        }

        /* TOGGLER — the chevron span. Drawn as a CSS arrow that rotates
           when the parent __wrapper has the _opened modifier.
           NOTE: MasterStudy ships its own ::after pseudo-arrow on the
           toggler. v3.5 added a ::before arrow on top of it, producing
           a stacked double-chevron when opened. v3.6 explicitly
           suppresses ::after so only our ::before renders. */
        body.single-stm-courses .masterstudy-curriculum-list__toggler {
            color: rgba(253, 252, 250, 0.85) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 22px !important;
            height: 22px !important;
            margin-left: auto !important;
            position: relative !important;
            flex-shrink: 0 !important;
            transition: transform 0.3s ease !important;
            transform: rotate(-90deg);
            background: transparent !important;
            border: none !important;
        }
        body.single-stm-courses .masterstudy-curriculum-list__toggler::after {
            content: none !important;
            display: none !important;
            background: none !important;
            border: none !important;
        }
        body.single-stm-courses .masterstudy-curriculum-list__toggler::before {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            border-right: 2px solid currentColor;
            border-bottom: 2px solid currentColor;
            transform: translateY(-2px) rotate(45deg);
            background: transparent;
        }
        body.single-stm-courses .masterstudy-curriculum-list__wrapper_opened
            .masterstudy-curriculum-list__toggler {
            transform: rotate(0deg);
        }

        /* MATERIALS LIST — DEFAULT COLLAPSED.
           We DO NOT use display:none / height:auto !important — those
           would either kill the animation or force the panel open. We
           use a max-height clamp toggled by the _opened modifier so
           MasterStudy's native class drives visibility and our JS
           fallback (below) toggles the same class on click. */
        body.single-stm-courses .masterstudy-curriculum-list__materials {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        body.single-stm-courses .masterstudy-curriculum-list__wrapper_opened
            .masterstudy-curriculum-list__materials {
            /* Generous ceiling to accommodate the longest section without
               clipping; the actual rendered height is content-driven. */
            max-height: 4000px;
        }

        body.single-stm-courses .masterstudy-curriculum-list__item {
            padding: 14px 20px !important;
            background: var(--bes-bark-soft) !important;
            border-top: 1px solid var(--bes-line-dark) !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.95rem !important;
            color: rgba(247, 244, 238, 0.85) !important;
            transition: background 0.2s ease !important;
            min-height: 44px !important;
            display: flex !important;
            align-items: center !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__item:hover {
            background: rgba(194, 210, 74, 0.08) !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__title,
        body.single-stm-courses .masterstudy-curriculum-list__link {
            color: rgba(247, 244, 238, 0.88) !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            width: 100% !important;
            min-height: 24px !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__link:hover {
            color: var(--bes-leaf) !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__order {
            color: var(--bes-leaf-soft) !important;
            font-family: var(--bes-font-display) !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            margin-right: 10px;
            opacity: 0.6;
        }

        /* Per-lesson type icon (text / video / quiz / assignment).
           MasterStudy ships these as <img> with green-tinted SVGs.
           Brighten via filter so they read clearly on the dark item. */
        body.single-stm-courses .masterstudy-curriculum-list__image {
            filter: brightness(0) invert(1) opacity(0.85) !important;
            width: 16px !important;
            height: 16px !important;
            flex-shrink: 0 !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__meta,
        body.single-stm-courses .masterstudy-curriculum-list__materials {
            color: rgba(247, 244, 238, 0.55) !important;
            font-size: 0.78rem !important;
            letter-spacing: 0.06em !important;
        }

        body.single-stm-courses .masterstudy-curriculum-list__locked {
            color: var(--bes-gold) !important;
        }

        /* SIDEBAR CARDS — bark-soft cards on dark.
           NOTE: __buttons is intentionally NOT in this rule anymore.
           v3.7 strips __buttons of all card chrome (no background, no
           border, no padding wrapper) so the wishlist + share render
           as two free-floating standalone buttons, not a wrapped card. */
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__cta,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-buy-button,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course-details,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course-details_default {
            background: var(--bes-bark-soft) !important;
            border-radius: var(--bes-radius-lg) !important;
            box-shadow: var(--bes-shadow-md) !important;
            border: 1px solid var(--bes-line-dark) !important;
            padding: 22px !important;
        }

        /* __buttons block: pure flex container, NO card chrome.
           Wishlist and Share render as two standalone pill buttons
           sitting directly on the page background. */
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: stretch !important;
            justify-content: stretch !important;
            gap: 12px !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            position: relative !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow: visible !important;
        }

        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button {
            flex: 1 1 0 !important;
            min-width: 0 !important;
            max-width: 100% !important;
            min-height: 52px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            padding: 14px 18px !important;
            background: linear-gradient(135deg,
                rgba(194, 210, 74, 0.12) 0%,
                rgba(194, 210, 74, 0.06) 100%) !important;
            border-radius: 999px !important;
            border: 1px solid rgba(216, 228, 140, 0.32) !important;
            cursor: pointer !important;
            transition: background 0.3s ease,
                        border-color 0.3s ease,
                        color 0.3s ease,
                        transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s ease !important;
            color: rgba(253, 252, 250, 0.95) !important;
            text-align: center !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            position: relative !important;
            box-sizing: border-box !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.12em !important;
            text-transform: uppercase !important;
            box-shadow:
                0 2px 6px rgba(0, 0, 0, 0.20),
                inset 0 1px 0 rgba(255, 255, 255, 0.05) !important;
        }

        /* Title <span> inside each button — inherit button color, no
           independent margin/padding so the icon glyph and label sit
           tight together with the gap rule on the parent. */
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-wishlist__title,
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-share-button__title {
            color: inherit !important;
            font: inherit !important;
            letter-spacing: inherit !important;
            text-transform: inherit !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1 !important;
        }

        /* ICON GLYPHS — drawn by MasterStudy via ::before pseudo-element
           on the button itself (heart for wishlist, share-arrow for
           share). v3.6 was killing these with content:none, which is
           why the user asked to "ensure the icon have more light color"
           — they were faint/missing. v3.7 KEEPS the native ::before
           glyph and just paints it ivory-bright + sized properly.
           Native ::after (which sometimes draws a stray dot) is still
           suppressed.

           Selector specificity is intentionally maxed (html body +
           direct-child chain) to beat MasterStudy's stylesheet which
           also marks its rules !important. */
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist::before,
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button::before {
            color: rgba(253, 252, 250, 0.95) !important;
            font-size: 16px !important;
            line-height: 1 !important;
            opacity: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
            background: none !important;
            border: none !important;
            position: static !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: auto !important;
            height: auto !important;
            transition: color 0.3s ease, transform 0.3s ease !important;
        }
        /* Suppress only ::after (rogue plugin dot), keep ::before icons. */
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist::after,
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button::after {
            content: none !important;
            display: none !important;
            background: none !important;
            border: none !important;
        }

        /* HOVER — leaf gradient fills the pill, lift + glow.
           Icon glyph color flips to forest-deep for high contrast on
           the leaf surface. */
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:hover,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:hover {
            background: linear-gradient(135deg,
                var(--bes-leaf) 0%,
                var(--bes-leaf-hover) 100%) !important;
            border-color: var(--bes-leaf) !important;
            color: var(--bes-forest) !important;
            transform: translateY(-2px) !important;
            box-shadow:
                0 8px 22px rgba(194, 210, 74, 0.32),
                0 2px 6px rgba(0, 0, 0, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.30) !important;
        }
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:hover::before,
        html body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:hover::before {
            color: var(--bes-forest) !important;
            transform: scale(1.08) !important;
        }
        /* Active press — settle back down briefly */
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:active,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:active {
            transform: translateY(-1px) !important;
            box-shadow:
                0 4px 12px rgba(194, 210, 74, 0.28),
                0 1px 3px rgba(0, 0, 0, 0.30) !important;
        }
        /* Focus ring for keyboard users */
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:focus-visible,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:focus-visible {
            outline: 2px solid var(--bes-leaf) !important;
            outline-offset: 3px !important;
        }

        /* The share-modal is a popup overlay — pull it out of flow */
        body.single-stm-courses .masterstudy-single-course-share-button-modal {
            flex: 0 0 0 !important;
            width: 0 !important;
            height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            background: transparent !important;
            position: absolute !important;
        }

        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__cta {
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            justify-content: center !important;
            gap: 14px !important;
        }

        body.single-stm-courses .masterstudy-buy-button {
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            align-items: stretch !important;
            background: transparent !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        body.single-stm-courses .masterstudy-buy-button__price,
        body.single-stm-courses .masterstudy-buy-button__price_regular {
            font-family: var(--bes-font-display) !important;
            font-weight: 600 !important;
            color: var(--bes-leaf-soft) !important;
            font-size: clamp(1.7rem, 2.8vw, 2.2rem) !important;
            line-height: 1.1 !important;
            text-align: center !important;
            letter-spacing: -0.01em !important;
            text-transform: none !important;
            background: transparent !important;
            padding: 0 !important;
        }

        body.single-stm-courses .masterstudy-buy-button__separator {
            color: rgba(247, 244, 238, 0.4) !important;
            margin: 0 6px !important;
        }

        /* The (Price does not include tax) caption — sibling of __link
           inside the same __cta card. Position it as a captioned strip
           below the pill on the bark-soft card surface. */
        body.single-stm-courses .masterstudy-buy-button__single-price-info-text,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__cta > .masterstudy-buy-button__single-price-info-text {
            display: block !important;
            width: 100% !important;
            color: rgba(247, 244, 238, 0.55) !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.72rem !important;
            text-align: center !important;
            font-weight: 500 !important;
            font-style: italic !important;
            letter-spacing: 0.02em !important;
            text-transform: none !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.4 !important;
        }

        body.single-stm-courses .masterstudy-buy-button__title {
            font-family: var(--bes-font-body) !important;
            font-weight: 700 !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            color: var(--bes-forest) !important;
        }

        /* ====================================================================
         * 10. ALL MASTERSTUDY BUTTONS
         * ==================================================================== */
        body.single-stm-courses .masterstudy-button {
            font-family: var(--bes-font-body) !important;
            font-weight: 700 !important;
            font-size: 0.82rem !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            border-radius: 999px !important;
            padding: 14px 26px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: none !important;
            cursor: pointer !important;
            position: relative;
            overflow: hidden;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            text-decoration: none !important;
            line-height: 1 !important;
        }

        body.single-stm-courses .masterstudy-button.masterstudy-button_style-primary,
        body.single-stm-courses .masterstudy-button_style-primary {
            background: linear-gradient(135deg,
                var(--bes-leaf) 0%,
                var(--bes-leaf-hover) 100%) !important;
            color: var(--bes-forest) !important;
            box-shadow:
                0 4px 14px rgba(194, 210, 74, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
            padding: 14px 24px !important;
            font-size: 0.82rem !important;
            font-weight: 800 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            border-radius: 999px !important;
        }

        /* BUY BUTTON — centered column inside leaf pill, balanced layout */
        body.single-stm-courses .masterstudy-buy-button__link,
        body.single-stm-courses a.masterstudy-buy-button__link {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            background: linear-gradient(135deg,
                var(--bes-leaf) 0%,
                var(--bes-leaf-hover) 100%) !important;
            color: var(--bes-forest) !important;
            box-shadow:
                0 6px 18px rgba(194, 210, 74, 0.40),
                inset 0 1px 0 rgba(255, 255, 255, 0.32) !important;
            width: 100% !important;
            padding: 18px 22px !important;
            border-radius: var(--bes-radius-md) !important;
            text-decoration: none !important;
            line-height: 1.1 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            text-align: center !important;
            min-height: 76px !important;
            box-sizing: border-box !important;
        }

        body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__title {
            display: block !important;
            width: 100% !important;
            font-family: var(--bes-font-body) !important;
            font-size: 0.7rem !important;
            font-weight: 800 !important;
            letter-spacing: 0.22em !important;
            text-transform: uppercase !important;
            color: var(--bes-forest-deep) !important;
            opacity: 0.78 !important;
            margin: 0 !important;
            padding: 0 !important;
            text-align: center !important;
            line-height: 1 !important;
        }

        body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__separator {
            display: none !important;
        }

        body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__price,
        body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__price_regular {
            display: block !important;
            width: 100% !important;
            font-family: var(--bes-font-display) !important;
            font-size: clamp(1.4rem, 2.4vw, 1.8rem) !important;
            font-weight: 700 !important;
            color: var(--bes-forest-deep) !important;
            line-height: 1.1 !important;
            letter-spacing: -0.005em !important;
            text-transform: none !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            white-space: nowrap !important;
            text-align: center !important;
        }

        body.single-stm-courses .masterstudy-button_style-primary:hover,
        body.single-stm-courses .masterstudy-buy-button__link:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 22px rgba(194, 210, 74, 0.55),
                inset 0 1px 0 rgba(255, 255, 255, 0.4) !important;
            background: linear-gradient(135deg,
                var(--bes-leaf-hover) 0%,
                var(--bes-leaf) 100%) !important;
        }

        body.single-stm-courses .masterstudy-button_style-tertiary {
            background: rgba(194, 210, 74, 0.10) !important;
            color: var(--bes-leaf-soft) !important;
            border: 1px solid rgba(194, 210, 74, 0.28) !important;
        }

        body.single-stm-courses .masterstudy-button_style-tertiary:hover {
            background: rgba(194, 210, 74, 0.20) !important;
            border-color: var(--bes-leaf) !important;
            color: var(--bes-ivory) !important;
            transform: translateY(-1px);
        }

        /* ====================================================================
         * 11. SHARE / WISHLIST title text + icon clamping
         * ==================================================================== */
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-share-button,
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-wishlist {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            cursor: pointer;
        }

        body.single-stm-courses .masterstudy-single-course-share-button__title,
        body.single-stm-courses .masterstudy-single-course-wishlist__title {
            font-family: var(--bes-font-body) !important;
            font-size: 0.68rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.10em !important;
            text-transform: uppercase !important;
            color: var(--bes-leaf-soft) !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            min-width: 0 !important;
        }

        /* SVG fallback — if a future MasterStudy build switches the
           wishlist/share icons from CSS pseudo-element glyphs to inline
           SVG, this defensive rule ensures the SVG paints ivory-bright
           too (matching the ::before glyph color above). */
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-wishlist svg,
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-wishlist svg path,
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-share-button svg,
        body.single-stm-courses .bes-col-sidebar .masterstudy-single-course-share-button svg path {
            width: 16px !important;
            height: 16px !important;
            fill: rgba(253, 252, 250, 0.95) !important;
            stroke: rgba(253, 252, 250, 0.95) !important;
            color: rgba(253, 252, 250, 0.95) !important;
            opacity: 1 !important;
            flex-shrink: 0 !important;
            transition: fill 0.3s ease, stroke 0.3s ease, transform 0.3s ease !important;
        }
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:hover svg,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist:hover svg path,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:hover svg,
        body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button:hover svg path {
            fill: var(--bes-forest) !important;
            stroke: var(--bes-forest) !important;
            color: var(--bes-forest) !important;
            transform: scale(1.08) !important;
        }

        /* ====================================================================
         * 12. REVIEWS (DARK)
         * ==================================================================== */
        body.single-stm-courses .masterstudy-single-course-reviews {
            background: transparent !important;
        }

        body.single-stm-courses .masterstudy-single-course-reviews__row {
            background: var(--bes-bark-card) !important;
            border-radius: var(--bes-radius-md) !important;
            padding: 18px 22px !important;
            margin-bottom: 12px !important;
            border: 1px solid var(--bes-line-dark) !important;
            color: rgba(247, 244, 238, 0.88) !important;
        }

        body.single-stm-courses .masterstudy-single-course-reviews__star svg,
        body.single-stm-courses .masterstudy-single-course-reviews__star path,
        body.single-stm-courses .masterstudy-single-course-complete__review-rating svg,
        body.single-stm-courses .masterstudy-single-course-complete__review-rating path {
            fill: var(--bes-gold) !important;
            color: var(--bes-gold) !important;
        }

        body.single-stm-courses .masterstudy-single-course-reviews__add-button {
            background: rgba(194, 210, 74, 0.08) !important;
            border: 1px dashed rgba(194, 210, 74, 0.32) !important;
            color: var(--bes-leaf-soft) !important;
            border-radius: var(--bes-radius-md) !important;
            padding: 14px 22px !important;
            font-family: var(--bes-font-body) !important;
            font-weight: 600 !important;
            transition: all 0.25s ease !important;
            cursor: pointer;
        }

        body.single-stm-courses .masterstudy-single-course-reviews__add-button:hover {
            background: rgba(194, 210, 74, 0.18) !important;
            border-color: var(--bes-leaf) !important;
            color: var(--bes-ivory) !important;
        }

        /* ====================================================================
         * 13. STICKY BOTTOM BAR — compact & mobile-aware
         * ==================================================================== */
        body.single-stm-courses .masterstudy-single-course-stickybar {
            background: rgba(15, 22, 9, 0.96) !important;
            backdrop-filter: saturate(160%) blur(14px) !important;
            -webkit-backdrop-filter: saturate(160%) blur(14px) !important;
            border-top: 1px solid rgba(194, 210, 74, 0.20) !important;
            box-shadow: 0 -8px 28px rgba(0, 0, 0, 0.50) !important;
            padding: 10px clamp(14px, 3vw, 28px) !important;
            z-index: 998 !important;
            color: var(--bes-ivory) !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar__wrapper {
            max-width: 1280px !important;
            margin: 0 auto !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 14px !important;
            flex-wrap: nowrap !important;
            padding: 0 !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar__column {
            display: flex !important;
            flex-direction: column !important;
            gap: 4px !important;
            min-width: 0 !important;
            flex: 1 1 auto !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar__title {
            font-family: var(--bes-font-display) !important;
            color: var(--bes-ivory) !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            line-height: 1.2 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            max-width: 100% !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar__row {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            flex-wrap: nowrap !important;
            margin: 0 !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-instructor {
            background: transparent !important;
            gap: 8px !important;
        }
        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-instructor__avatar img {
            width: 28px !important;
            height: 28px !important;
            border-radius: 50% !important;
            border: 1px solid rgba(194, 210, 74, 0.4) !important;
            object-fit: cover !important;
        }
        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-instructor__name,
        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-instructor__name a {
            color: var(--bes-leaf-soft) !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-categories__title {
            color: rgba(247, 244, 238, 0.55) !important;
        }
        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-single-course-categories__item {
            background: rgba(194, 210, 74, 0.10) !important;
            border-color: rgba(194, 210, 74, 0.30) !important;
            color: var(--bes-leaf-soft) !important;
            font-size: 0.62rem !important;
            padding: 3px 10px !important;
        }

        body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-button_style-primary {
            padding: 12px 22px !important;
            font-size: 0.74rem !important;
            white-space: nowrap !important;
            flex-shrink: 0 !important;
            min-height: 44px !important;
        }

        /* ====================================================================
         * 14. RESPONSIVE
         * ==================================================================== */
        @media (max-width: 1024px) {
            html body.single-stm-courses .masterstudy-single-course,
            html body.single-stm-courses .bes-course-root {
                grid-template-columns: 1fr !important;
                gap: 18px !important;
            }
            html body.single-stm-courses .masterstudy-single-course__main,
            html body.single-stm-courses .bes-col-main {
                grid-column: 1 / -1 !important;
            }
            html body.single-stm-courses .masterstudy-single-course__sidebar,
            html body.single-stm-courses .bes-col-sidebar {
                position: static !important;
                top: auto !important;
                z-index: auto !important;
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;
                flex: 1 1 auto !important;
                grid-column: 1 / -1 !important;
            }
            body.admin-bar.single-stm-courses .bes-col-sidebar {
                top: auto !important;
            }
        }

        @media (max-width: 768px) {
            body.single-stm-courses .masterstudy-lms-learning-management-system,
            body.single-stm-courses .masterstudy-lms {
                padding-top: clamp(110px, 14vh, 140px) !important;
                padding-bottom: 140px !important;
            }
            body.single-stm-courses .bes-hero {
                padding: 30px 22px !important;
                border-radius: var(--bes-radius-md) !important;
            }
            body.single-stm-courses .bes-hero h1,
            body.single-stm-courses .bes-hero .masterstudy-single-course-title {
                font-size: 1.7rem !important;
            }
            body.single-stm-courses .bes-hero .masterstudy-single-course__info {
                gap: 14px !important;
                margin-top: 16px !important;
                padding-top: 16px !important;
            }
            body.single-stm-courses .bes-hero .masterstudy-single-course__info-block {
                font-size: 0.85rem !important;
                /* Mobile: each block becomes a full-width row. Trim the
                   right-side trailing padding (used on desktop to reserve
                   room for the vertical separator) and add bottom padding
                   for the new horizontal separator below. */
                padding: 0 0 12px 0 !important;
                width: 100% !important;
                flex: 0 0 100% !important;
            }
            /* Flip separator: vertical right-edge -> horizontal bottom-edge.
               Color matches dark-kit token. */
            body.single-stm-courses .bes-hero .masterstudy-single-course__info-block::after {
                top: auto !important;
                right: auto !important;
                bottom: 0 !important;
                left: 0 !important;
                transform: none !important;
                width: 100% !important;
                height: 1px !important;
                background: rgba(255, 255, 255, 0.1) !important;
            }
            body.single-stm-courses .masterstudy-single-course-tabs__item {
                font-size: 0.7rem !important;
                padding: 12px 18px !important;
                letter-spacing: 0.1em !important;
                min-height: 44px !important;
            }
            body.single-stm-courses .masterstudy-single-course-tabs__content {
                padding: 24px 20px !important;
                border-radius: var(--bes-radius-md) !important;
            }
            body.single-stm-courses .masterstudy-curriculum-list__section {
                padding: 16px 18px !important;
            }
            body.single-stm-courses .masterstudy-curriculum-list__section-title {
                font-size: 1rem !important;
            }
            body.single-stm-courses .masterstudy-curriculum-list__item {
                padding: 14px 18px !important;
                font-size: 0.9rem !important;
                min-height: 48px !important;
            }
            body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__cta,
            body.single-stm-courses .bes-col-sidebar > .masterstudy-buy-button,
            body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course-details {
                padding: 18px !important;
                border-radius: var(--bes-radius-md) !important;
            }
            /* Mobile: __buttons keeps its cardless layout — pure flex
               row of two standalone pills, no wrapper. */
            body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons {
                padding: 0 !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                gap: 10px !important;
            }
            body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-wishlist,
            body.single-stm-courses .bes-col-sidebar > .masterstudy-single-course__buttons > .masterstudy-single-course-share-button {
                min-height: 48px !important;
                padding: 12px 16px !important;
                font-size: 0.72rem !important;
            }

            /* STICKY BAR mobile compact — hide instructor & category pills */
            body.single-stm-courses .masterstudy-single-course-stickybar {
                padding: 10px 14px !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar__wrapper {
                gap: 10px !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar__title {
                font-size: 0.88rem !important;
                line-height: 1.25 !important;
                white-space: nowrap !important;
                max-width: 100% !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar__row .masterstudy-single-course-instructor,
            body.single-stm-courses .masterstudy-single-course-stickybar__row .masterstudy-single-course-categories {
                display: none !important;
            }
            /* Right-margin keeps CTA clear of bottom-right WhatsApp bubble */
            body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-button_style-primary {
                padding: 12px 18px !important;
                font-size: 0.7rem !important;
                margin-right: 60px !important;
                min-height: 44px !important;
            }
        }

        @media (max-width: 480px) {
            body.single-stm-courses .bes-hero {
                padding: 26px 18px !important;
            }
            body.single-stm-courses .bes-hero h1,
            body.single-stm-courses .bes-hero .masterstudy-single-course-title {
                font-size: 1.45rem !important;
            }
            body.single-stm-courses .bes-hero .masterstudy-single-course__info {
                gap: 12px !important;
            }
            body.single-stm-courses .bes-hero .masterstudy-single-course-instructor__avatar img {
                width: 36px !important;
                height: 36px !important;
            }
            body.single-stm-courses .masterstudy-button {
                padding: 14px 22px !important;
                font-size: 0.76rem !important;
                min-height: 44px !important;
            }
            body.single-stm-courses .masterstudy-buy-button__link {
                padding: 16px 22px !important;
                min-height: 70px !important;
            }
            body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__price,
            body.single-stm-courses .masterstudy-buy-button__link .masterstudy-buy-button__price_regular {
                font-size: 1.2rem !important;
            }
            body.single-stm-courses .masterstudy-single-course-tabs__item {
                font-size: 0.66rem !important;
                padding: 11px 16px !important;
                letter-spacing: 0.08em !important;
                min-height: 42px !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar__title {
                font-size: 0.8rem !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar .masterstudy-button_style-primary {
                padding: 11px 14px !important;
                font-size: 0.66rem !important;
                margin-right: 56px !important;
                min-height: 42px !important;
            }
        }

        @media (max-width: 380px) {
            body.single-stm-courses .bes-hero h1,
            body.single-stm-courses .bes-hero .masterstudy-single-course-title {
                font-size: 1.3rem !important;
            }
            body.single-stm-courses .masterstudy-single-course-stickybar__title {
                font-size: 0.74rem !important;
            }
            body.single-stm-courses .masterstudy-single-course-tabs__item {
                padding: 10px 14px !important;
                min-height: 40px !important;
            }
        }

        /* ====================================================================
         * 15. ANTI-FOUC + reveal guard
         *    If JS fails entirely (extension blocks, TrustedScript, etc.)
         *    the failsafe still reveals the raw MasterStudy markup after
         *    1.2s so the page is never permanently invisible to the user.
         * ==================================================================== */
        body.single-stm-courses .bes-course-root {
            animation: bes-course-fade-in 0.5s ease both;
        }

        @keyframes bes-course-fade-in {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        body.single-stm-courses .masterstudy-single-course:not(.bes-course-root) {
            opacity: 0;
            animation: bes-failsafe-reveal 0s 1.2s forwards;
        }
        @keyframes bes-failsafe-reveal {
            to { opacity: 1; }
        }

    </style>

    <!-- ====== BES JS NORMALIZER v3.2 — DOM relocation + layout enforcement ====== -->
    <script id="bes-single-course-normalizer">
        (function () {
            'use strict';

            var TAGGED_ROOT  = 'data-bes-tagged';
            var TAGGED_INFO  = 'data-bes-info-relocated';
            var TAGGED_TAB   = 'data-bes-tab';
            var TAGGED_CURR  = 'data-bes-curriculum-bound';
            var TAGGED_LAYOUT = 'data-bes-layout-forced';
            var TAGGED_SPACING = 'data-bes-spacing-forced';

            /**
             * Safe try/catch wrapper. Errors are swallowed silently in
             * production so a failure in one helper cannot break siblings.
             */
            function safe(fn, label) {
                try {
                    return fn();
                } catch (e) {
                    if (window.console && console.warn) {
                        console.warn('[BES styler] ' + (label || 'fn') + ' failed:', e && e.message ? e.message : e);
                    }
                    return null;
                }
            }

            /**
             * Enforce top spacing as inline style fallback in case theme CSS
             * out-specificities our padding-top.
             */
            function enforceTopSpacing() {
                return safe(function () {
                    var isAdmin = document.body && document.body.classList && document.body.classList.contains('admin-bar');
                    var px = isAdmin ? 200 : 170;
                    /* Use viewport-aware floor so big screens get more air */
                    var vh = (window.innerHeight || 800) * 0.18;
                    px = Math.max(px, Math.min(vh, isAdmin ? 240 : 210));
                    var hosts = document.querySelectorAll(
                        '.masterstudy-lms-learning-management-system, .masterstudy-lms, .stm-lms-wrapper'
                    );
                    hosts.forEach(function (h) {
                        if (!h || h.getAttribute(TAGGED_SPACING) === '1') return;
                        h.style.setProperty('padding-top', px + 'px', 'important');
                        h.setAttribute(TAGGED_SPACING, '1');
                    });
                }, 'enforceTopSpacing');
            }

            /**
             * Enforce sidebar / main column widths inline so MasterStudy's
             * own flex-basis cannot collapse our sidebar to a sliver.
             */
            function enforceLayout() {
                return safe(function () {
                    var root = document.querySelector('.masterstudy-single-course');
                    if (!root) return;
                    var main    = root.querySelector(':scope > .masterstudy-single-course__main');
                    var sidebar = root.querySelector(':scope > .masterstudy-single-course__sidebar');
                    if (!main || !sidebar) return;

                    /* Strip any inline width/flex MasterStudy may have set */
                    [main, sidebar].forEach(function (el) {
                        if (!el || !el.style) return;
                        el.style.removeProperty('flex');
                        el.style.removeProperty('flex-basis');
                        el.style.removeProperty('max-width');
                        el.style.removeProperty('min-width');
                        el.style.removeProperty('width');
                    });

                    var isStacked = window.matchMedia && window.matchMedia('(max-width: 1024px)').matches;

                    /* Root container: enforce grid */
                    root.style.setProperty('display', 'grid', 'important');
                    root.style.setProperty('width', '100%', 'important');
                    root.style.setProperty('max-width', '100%', 'important');
                    if (isStacked) {
                        root.style.setProperty('grid-template-columns', '1fr', 'important');
                    } else {
                        root.style.setProperty('grid-template-columns', 'minmax(0, 1fr) 360px', 'important');
                    }

                    /* Main column */
                    main.style.setProperty('min-width', '0', 'important');
                    main.style.setProperty('width', '100%', 'important');
                    main.style.setProperty('max-width', '100%', 'important');
                    main.style.setProperty('grid-column', isStacked ? '1 / -1' : '1 / 2', 'important');

                    /* Sidebar column */
                    if (isStacked) {
                        sidebar.style.setProperty('width', '100%', 'important');
                        sidebar.style.setProperty('max-width', '100%', 'important');
                        sidebar.style.setProperty('min-width', '0', 'important');
                        sidebar.style.setProperty('flex', '1 1 auto', 'important');
                        sidebar.style.setProperty('position', 'static', 'important');
                        sidebar.style.setProperty('grid-column', '1 / -1', 'important');
                    } else {
                        sidebar.style.setProperty('width', '360px', 'important');
                        sidebar.style.setProperty('min-width', '360px', 'important');
                        sidebar.style.setProperty('max-width', '360px', 'important');
                        sidebar.style.setProperty('flex', '0 0 360px', 'important');
                        sidebar.style.setProperty('grid-column', '2 / 3', 'important');
                    }

                    root.setAttribute(TAGGED_LAYOUT, '1');
                }, 'enforceLayout');
            }

            /**
             * Tag the rendered MasterStudy DOM with our own bes-* classes
             * AND physically move __info inside __heading so meta lives
             * in the hero card.
             */
            function normalize() {
                return safe(function () {
                    var root = document.querySelector('.masterstudy-single-course');
                    if (!root) return false;

                    root.classList.add('bes-course-root');

                    var main    = root.querySelector(':scope > .masterstudy-single-course__main');
                    var sidebar = root.querySelector(':scope > .masterstudy-single-course__sidebar');
                    if (main)    main.classList.add('bes-col-main');
                    if (sidebar) sidebar.classList.add('bes-col-sidebar');

                    var heading = root.querySelector('.masterstudy-single-course__heading');
                    if (heading) heading.classList.add('bes-hero');

                    var topbar = root.querySelector('.masterstudy-single-course__topbar');
                    if (topbar) topbar.classList.add('bes-utility-bar');

                    /* KEY MOVE: relocate __info INSIDE __heading.
                       Default markup makes __info a sibling between __heading
                       and the tabs, leaving the hero looking empty. */
                    if (main && heading) {
                        var info = main.querySelector(':scope > .masterstudy-single-course__info');
                        if (info && info.getAttribute(TAGGED_INFO) !== '1') {
                            heading.appendChild(info);
                            info.setAttribute(TAGGED_INFO, '1');
                        }
                    }

                    if (root.getAttribute(TAGGED_ROOT) !== '1') {
                        root.setAttribute(TAGGED_ROOT, '1');
                    }

                    /* Enforce layout AFTER tagging so our class hooks exist */
                    enforceLayout();

                    return true;
                }, 'normalize') || false;
            }

            /**
             * Mirror tab-active state instantly on click.
             */
            function bindTabMirror() {
                return safe(function () {
                    var tabs = document.querySelectorAll('.masterstudy-single-course-tabs__item');
                    if (!tabs.length) return;
                    tabs.forEach(function (tab) {
                        if (!tab || tab.getAttribute(TAGGED_TAB) === '1') return;
                        tab.setAttribute(TAGGED_TAB, '1');
                        tab.addEventListener('click', function () {
                            safe(function () {
                                tabs.forEach(function (t) { if (t) t.classList.remove('bes-tab-active'); });
                                tab.classList.add('bes-tab-active');
                            }, 'tab-click');
                        }, { passive: true });
                    });
                }, 'bindTabMirror');
            }

            /**
             * CURRICULUM ACCORDION — re-bind toggle behavior.
             *
             * MasterStudy renders every section's __wrapper with the
             * _opened modifier server-side and relies on Vue or jQuery
             * to bind clicks. On this build that binding never fires
             * (no inline curriculum script ships to the page), so the
             * toggle appears dead. We bind a delegated click handler
             * on the curriculum-list root that flips the _opened
             * modifier on the nearest __wrapper. CSS (max-height
             * transition on __materials) handles the animation.
             *
             * Idempotent (TAGGED_CURR attribute on the list root).
             * Uses a single delegated listener so dynamically added
             * sections (rare, but safe) work too.
             */
            function bindCurriculumAccordion() {
                return safe(function () {
                    var lists = document.querySelectorAll('.masterstudy-curriculum-list');
                    if (!lists.length) return;
                    lists.forEach(function (list) {
                        if (!list || list.getAttribute(TAGGED_CURR) === '1') return;
                        list.setAttribute(TAGGED_CURR, '1');
                        list.addEventListener('click', function (ev) {
                            safe(function () {
                                var t = ev.target;
                                if (!t || t.nodeType !== 1) return;
                                /* Ignore clicks on actual lesson links —
                                   they should navigate, not toggle. */
                                if (t.closest('.masterstudy-curriculum-list__materials')) return;
                                if (t.closest('a')) return;
                                var wrapper = t.closest('.masterstudy-curriculum-list__wrapper');
                                if (!wrapper) return;
                                /* Only react to clicks on the header area
                                   (section-title row, toggler chevron, or
                                   the section itself), not stray padding. */
                                var inHeader =
                                    t.closest('.masterstudy-curriculum-list__section') ||
                                    t.closest('.masterstudy-curriculum-list__section-title') ||
                                    t.closest('.masterstudy-curriculum-list__toggler');
                                if (!inHeader) return;
                                ev.preventDefault();
                                wrapper.classList.toggle('masterstudy-curriculum-list__wrapper_opened');
                            }, 'curriculum-click');
                        }, false);
                    });
                }, 'bindCurriculumAccordion');
            }

            /**
             * Re-clamp any plugin-injected SVG icons in wishlist/share
             * that can overflow the pill button when injected post-render.
             */
            function neutralizeSidebarIcons() {
                return safe(function () {
                    var sidebar = document.querySelector('.bes-col-sidebar');
                    if (!sidebar) return;
                    var iconHosts = sidebar.querySelectorAll(
                        '.masterstudy-single-course-wishlist > svg, ' +
                        '.masterstudy-single-course-share-button > svg'
                    );
                    iconHosts.forEach(function (svg) {
                        if (!svg) return;
                        svg.setAttribute('width', '14');
                        svg.setAttribute('height', '14');
                    });
                }, 'neutralizeSidebarIcons');
            }

            function boot() {
                safe(function () {
                    enforceTopSpacing();
                    var ok = normalize();
                    bindTabMirror();
                    bindCurriculumAccordion();
                    neutralizeSidebarIcons();
                    if (!ok) {
                        var target = document.body || document.documentElement;
                        /* Validate Node before observing — extensions sometimes
                           replace document.body with a non-Node proxy. */
                        if (!target || target.nodeType !== 1) return;
                        var observer = new MutationObserver(function () {
                            safe(function () {
                                if (normalize()) {
                                    bindTabMirror();
                                    bindCurriculumAccordion();
                                    neutralizeSidebarIcons();
                                    observer.disconnect();
                                }
                            }, 'mutation-cb');
                        });
                        try {
                            observer.observe(target, { childList: true, subtree: true });
                        } catch (e) { /* swallow — extension interference */ }
                        setTimeout(function () {
                            safe(function () { observer.disconnect(); }, 'observer-disconnect');
                        }, 5000);
                    }
                }, 'boot');
            }

            /* Re-enforce layout on viewport changes so sidebar width adapts
               correctly when crossing the 1024px breakpoint. */
            var resizeTimer = null;
            window.addEventListener('resize', function () {
                if (resizeTimer) clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    enforceLayout();
                }, 120);
            }, { passive: true });

            /* Defer first run via requestAnimationFrame so any synchronous
               theme/plugin scripts that throw (Elementor missing config,
               extension TrustedScript blocks, etc.) finish before we touch
               the DOM. Falls back to setTimeout if rAF unavailable. */
            function deferredBoot() {
                if (window.requestAnimationFrame) {
                    window.requestAnimationFrame(boot);
                } else {
                    setTimeout(boot, 0);
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', deferredBoot, { once: true });
            } else {
                deferredBoot();
            }

            window.addEventListener('load', function () {
                safe(function () {
                    enforceTopSpacing();
                    normalize();
                    bindTabMirror();
                    bindCurriculumAccordion();
                    neutralizeSidebarIcons();
                    enforceLayout();
                }, 'window-load');
            }, { once: true });

            /* Late watcher for AJAX re-renders (e.g. wishlist toggle re-mounts) */
            var lateObserver = new MutationObserver(function () {
                safe(function () {
                    neutralizeSidebarIcons();
                    var root = document.querySelector('.masterstudy-single-course');
                    if (!root) return;
                    var main = root.querySelector(':scope > .masterstudy-single-course__main');
                    var heading = root.querySelector('.masterstudy-single-course__heading');
                    if (main && heading) {
                        var orphan = main.querySelector(':scope > .masterstudy-single-course__info');
                        if (orphan) {
                            heading.appendChild(orphan);
                            orphan.setAttribute(TAGGED_INFO, '1');
                        }
                    }
                    /* Re-bind curriculum on re-render (idempotent — guarded
                       by TAGGED_CURR — so existing bindings are preserved) */
                    bindCurriculumAccordion();
                    /* Re-pin sidebar/main widths if MasterStudy re-applies inline styles */
                    enforceLayout();
                }, 'late-observer-cb');
            });
            window.addEventListener('load', function () {
                safe(function () {
                    var root = document.querySelector('.masterstudy-single-course');
                    if (!root || root.nodeType !== 1) return;
                    try {
                        lateObserver.observe(root, { childList: true, subtree: true });
                    } catch (e) { /* swallow — extension interference */ }
                    setTimeout(function () {
                        safe(function () { lateObserver.disconnect(); }, 'late-disconnect');
                    }, 8000);
                }, 'late-observer-attach');
            }, { once: true });
        })();
    </script>
<?php
}