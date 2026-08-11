<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — Snippet 1: Global Assets (v3 – Premium Overhaul)
 * ============================================================================
 *
 * WHAT THIS FILE DOES:
 *   Injects a cinematic Preloader, Smart Adaptive Header with reveal
 *   micro-interactions, and a luxury layered Footer across all pages
 *   using WordPress hooks. Paste into functions.php or a custom plugin.
 *
 * ★ KEY UPGRADES OVER v2:
 *   • Immersive preloader with lotus-bloom SVG morphing + particle mist
 *   • Header: frosted-glass with organic glow accent on hover, staggered
 *     link reveals on load, scroll-progress indicator, refined CTA pulse
 *   • Footer: layered parallax leaf pattern, newsletter CTA strip,
 *     animated social orbs, decorative Balinese fretwork divider
 *   • System-wide micro-interactions: magnetic hover, smooth focus rings,
 *     staggered entrance animations via IntersectionObserver
 *   • Refined mobile drawer with staggered slide-in links + blur backdrop
 *   • Luxury WooCommerce Cart/Checkout hero, controls + SVG ornament
 *   • Structural Cart/Checkout grid that repairs Elementor containment without cascade hacks
 *
 * HOOKS:
 *   wp_head(1)       → CDNs, Tailwind config, Google Fonts, FA, all CSS
 *   wp_body_open(5)  → Immersive Preloader
 *   wp_body_open(10) → Adaptive Header
 *   wp_footer(10)    → Luxury Footer
 *   wp_footer(20)    → All Vanilla JS (detection engine + interactions)
 *
 * @package BaliElingSpirit
 * @version 3.3.0-commerce-structural-grid-no-important
 */

if (! defined('ABSPATH')) exit;

/* =========================================================================
 * 0. BRAND CONSTANTS
 * ========================================================================= */

define('BES_SITE_NAME', 'Bali Eling Spirit');
define('BES_TAGLINE',   'Your Divine Home to Transform');

define('BES_NAV_LINKS', [
    ['label' => 'About Us',    'href' => '/about-us'],
    ['label' => 'Sanctuary',   'href' => '/sanctuary'],
    ['label' => 'Academy',     'href' => '/academy'],
    ['label' => 'Pasraman',    'href' => '/pasraman'],
    ['label' => 'Partnership', 'href' => '/partnership'],
    ['label' => 'Wisdom',      'href' => '/wisdom'],
]);

define('BES_CONTACT', [
    'address'   => 'Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552, Indonesia',
    'email'     => 'balielingspirit@elinggroup.com',
    'phone'     => '+62 878-2598-9117',
    'whatsapp'  => '+6287825989117',
]);

define('BES_SOCIALS', [
    ['platform' => 'Facebook',  'url' => 'https://facebook.com/PasramanBaliElingSpirit',  'icon' => 'fa-brands fa-facebook-f'],
    ['platform' => 'Instagram', 'url' => 'https://instagram.com/bali.elingspirit',        'icon' => 'fa-brands fa-instagram'],
    ['platform' => 'YouTube',   'url' => 'https://youtube.com/@PasramanBaliElingSpirit',  'icon' => 'fa-brands fa-youtube'],
    ['platform' => 'TikTok',    'url' => 'https://www.tiktok.com/@pasramanbalielingspirit', 'icon' => 'fa-brands fa-tiktok'],
    ['platform' => 'Spotify',   'url' => 'https://open.spotify.com/show/5eqVplP40VtkHWRlSmsd9T', 'icon' => 'fa-brands fa-spotify'],
]);


/* =========================================================================
 * ★ REFINED COLOUR PALETTE v3
 * =========================================================================
 * WCAG AA contrast verified for all text/bg pairings.
 * Added: gold accent, deeper shadows, richer gradients.
 * ------------------------------------------------------------------------ */
define('BES_COLORS', [
    // ── Dark tones ──
    'forest'       => '#1E2A16',
    'forest_deep'  => '#151E10',
    'forest_92'    => '#263320',
    'forest_80'    => '#2E3C28',

    // ── Brand greens ──
    'olive'        => '#3F5130',
    'olive_dark'   => '#344528',
    'olive_light'  => '#506440',

    // ── Mid-tones ──
    'moss'         => '#6B7F5A',
    'sage'         => '#94A883',

    // ── Accent — chartreuse/yellow-green ──
    'leaf'         => '#C2D24A',
    'leaf_hover'   => '#AFBF38',
    'leaf_soft'    => '#D8E48C',
    'leaf_glow'    => 'rgba(194,210,74,0.15)',

    // ── Warm gold accent ──
    'gold'         => '#C9A84C',
    'gold_soft'    => '#E8D5A0',

    // ── Warm neutrals ──
    'parchment'    => '#F7F4EE',
    'ivory'        => '#FDFCFA',
    'sand'         => '#EBE6DC',
    'cream'        => '#F2EDE4',

    // ── Text ──
    'bark'         => '#1C2415',
    'bark_soft'    => '#3A4A2F',
    'bark_muted'   => '#6B7A5E',
]);


/* =========================================================================
 * 1. wp_head — CDNs, TAILWIND CONFIG, FONTS, ALL CSS
 * ========================================================================= */
add_action('wp_head', 'bes_global_head', 1);
function bes_global_head()
{
    $c = BES_COLORS;
?>
    <!-- ====== BES Global Head v3 ====== -->

    <!-- Google Fonts: Cormorant Garamond (elegant serif) + Plus Jakarta Sans (refined geometric sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide-core.min.css">

    <!-- Tailwind v3 Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config with BES v3 tokens -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bes: {
                            forest: '<?php echo $c['forest']; ?>',
                            'forest-deep': '<?php echo $c['forest_deep']; ?>',
                            'forest-92': '<?php echo $c['forest_92']; ?>',
                            'forest-80': '<?php echo $c['forest_80']; ?>',
                            olive: '<?php echo $c['olive']; ?>',
                            'olive-dark': '<?php echo $c['olive_dark']; ?>',
                            'olive-light': '<?php echo $c['olive_light']; ?>',
                            moss: '<?php echo $c['moss']; ?>',
                            sage: '<?php echo $c['sage']; ?>',
                            leaf: '<?php echo $c['leaf']; ?>',
                            'leaf-hover': '<?php echo $c['leaf_hover']; ?>',
                            'leaf-soft': '<?php echo $c['leaf_soft']; ?>',
                            gold: '<?php echo $c['gold']; ?>',
                            'gold-soft': '<?php echo $c['gold_soft']; ?>',
                            parchment: '<?php echo $c['parchment']; ?>',
                            ivory: '<?php echo $c['ivory']; ?>',
                            sand: '<?php echo $c['sand']; ?>',
                            cream: '<?php echo $c['cream']; ?>',
                            bark: '<?php echo $c['bark']; ?>',
                            'bark-soft': '<?php echo $c['bark_soft']; ?>',
                            'bark-muted': '<?php echo $c['bark_muted']; ?>',
                        }
                    },
                    fontFamily: {
                        display: ['"Cormorant Garamond"', 'Georgia', '"Times New Roman"', 'serif'],
                        body: ['"Plus Jakarta Sans"', '"Helvetica Neue"', 'Arial', 'sans-serif'],
                    },
                    fontSize: {
                        'xs': ['0.75rem', {
                            lineHeight: '1rem'
                        }],
                        'sm': ['0.875rem', {
                            lineHeight: '1.375rem'
                        }],
                        'base': ['1rem', {
                            lineHeight: '1.7rem'
                        }],
                        'lg': ['1.125rem', {
                            lineHeight: '1.8rem'
                        }],
                        'xl': ['1.25rem', {
                            lineHeight: '1.875rem'
                        }],
                        '2xl': ['1.563rem', {
                            lineHeight: '2.125rem'
                        }],
                        '3xl': ['1.953rem', {
                            lineHeight: '2.5rem'
                        }],
                        '4xl': ['2.441rem', {
                            lineHeight: '3rem'
                        }],
                        '5xl': ['3.052rem', {
                            lineHeight: '3.5rem'
                        }],
                    },
                    letterSpacing: {
                        'nav': '0.18em',
                        'label': '0.14em',
                        'display': '-0.015em',
                    },
                }
            }
        }
    </script>

    <!-- ============================================================
         CRITICAL BASE CSS + ALL COMPONENT STYLES
         ============================================================ -->
    <style>
        /* ── Reset & Base ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 96px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Helvetica Neue', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.7;
            color: <?php echo $c['bark']; ?>;
            background: <?php echo $c['parchment']; ?>;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 500;
            letter-spacing: -0.015em;
            color: <?php echo $c['bark']; ?>;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar {
            width: 5px
        }

        ::-webkit-scrollbar-track {
            background: <?php echo $c['parchment']; ?>
        }

        ::-webkit-scrollbar-thumb {
            background: <?php echo $c['sage']; ?>;
            border-radius: 10px
        }

        ::-webkit-scrollbar-thumb:hover {
            background: <?php echo $c['olive']; ?>
        }

        ::selection {
            background: <?php echo $c['leaf']; ?>;
            color: <?php echo $c['forest']; ?>
        }

        /* ── Focus ring utility ── */
        .bes-focus:focus-visible {
            outline: 2px solid <?php echo $c['leaf']; ?>;
            outline-offset: 3px;
            border-radius: 4px
        }

        /* ============================================================
         PRELOADER
         ============================================================ */
        #bes-preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: <?php echo $c['forest_deep']; ?>;
            transition: opacity .8s cubic-bezier(.4, 0, .2, 1), visibility .8s ease;
        }

        #bes-preloader.bes-loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none
        }

        /* Lotus bloom animation */
        .bes-lotus {
            position: relative;
            width: 120px;
            height: 120px
        }

        .bes-lotus svg {
            width: 100%;
            height: 100%;
            overflow: visible
        }

        .bes-lotus-petal {
            transform-origin: center 85%;
            animation: petalBloom 2.8s cubic-bezier(.34, 1.56, .64, 1) both;
            opacity: 0;
        }

        @keyframes petalBloom {
            0% {
                opacity: 0;
                transform: rotate(var(--r, 0deg)) scaleY(0.1) scaleX(0.6)
            }

            40% {
                opacity: 1
            }

            100% {
                opacity: 1;
                transform: rotate(var(--r, 0deg)) scaleY(1) scaleX(1)
            }
        }

        .bes-lotus-center {
            animation: centerPulse 2s ease-in-out 1.2s infinite;
        }

        @keyframes centerPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: .6;
                transform: scale(1.15)
            }
        }

        /* Mist particles */
        .bes-mist {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden
        }

        .bes-mist-dot {
            position: absolute;
            width: 2px;
            height: 2px;
            border-radius: 50%;
            background: rgba(194, 210, 74, 0.25);
            animation: mistFloat linear infinite;
        }

        @keyframes mistFloat {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0
            }

            15% {
                opacity: 1
            }

            85% {
                opacity: 1
            }

            100% {
                transform: translateY(-120px) translateX(40px);
                opacity: 0
            }
        }

        /* Preloader text shimmer */
        .bes-pre-text {
            background: linear-gradient(90deg, rgba(253, 252, 250, .3), rgba(194, 210, 74, .7), rgba(253, 252, 250, .3));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textShimmer 2.5s linear infinite;
        }

        @keyframes textShimmer {
            0% {
                background-position: 200% center
            }

            100% {
                background-position: -200% center
            }
        }

        /* Progress arc (SVG circle) */
        .bes-arc {
            stroke-dasharray: 188.5;
            stroke-dashoffset: 188.5;
            transition: stroke-dashoffset 0.3s ease;
            transform: rotate(-90deg);
            transform-origin: center;
        }

        /* ============================================================
         HEADER
         ============================================================ */
        #bes-hdr {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9990;
            transition: all .5s cubic-bezier(.4, 0, .2, 1);
        }

        /* Scroll progress bar */
        #bes-scroll-prog {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 0%;
            background: linear-gradient(90deg, <?php echo $c['leaf']; ?>, <?php echo $c['gold']; ?>);
            transition: width .15s linear;
            z-index: 1;
            border-radius: 0 1px 1px 0;
        }

        /* WP Admin Bar */
        body.admin-bar #bes-hdr {
            top: 32px
        }

        body.admin-bar #bes-drawer {
            top: 32px;
            height: calc(100dvh - 32px)
        }

        @media(max-width:782px) {
            body.admin-bar #bes-hdr {
                top: 46px
            }

            body.admin-bar #bes-drawer {
                top: 46px;
                height: calc(100dvh - 46px)
            }
        }

        /* ── SCROLLED STATE: frosted glass ── */
        #bes-hdr.bes-hdr-scrolled {
            background: rgba(30, 42, 22, .88);
            backdrop-filter: blur(24px) saturate(1.6);
            -webkit-backdrop-filter: blur(24px) saturate(1.6);
            box-shadow: 0 4px 32px rgba(21, 30, 16, .18), inset 0 -1px 0 rgba(194, 210, 74, .08);
        }

        #bes-hdr.bes-hdr-scrolled .bes-h-txt {
            color: <?php echo $c['ivory']; ?>
        }

        #bes-hdr.bes-hdr-scrolled .bes-h-svg path,
        #bes-hdr.bes-hdr-scrolled .bes-h-svg circle {
            stroke: <?php echo $c['ivory']; ?>;
            fill: <?php echo $c['ivory']; ?>;
        }

        #bes-hdr.bes-hdr-scrolled .bes-h-cta {
            background: <?php echo $c['leaf']; ?>;
            color: <?php echo $c['forest']; ?>
        }

        #bes-hdr.bes-hdr-scrolled .bes-h-link .bes-h-dot {
            background: <?php echo $c['leaf']; ?>
        }

        #bes-hdr.bes-hdr-scrolled #bes-scroll-prog {
            opacity: 1
        }

        /* ── ON DARK BG ── */
        #bes-hdr.bes-hdr-on-dark .bes-h-txt {
            color: <?php echo $c['ivory']; ?>
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-svg path,
        #bes-hdr.bes-hdr-on-dark .bes-h-svg circle {
            stroke: <?php echo $c['ivory']; ?>;
            fill: <?php echo $c['ivory']; ?>;
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-link:hover .bes-h-txt {
            color: <?php echo $c['leaf']; ?>
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-link .bes-h-dot {
            background: <?php echo $c['leaf']; ?>
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-cta {
            background: transparent;
            color: <?php echo $c['leaf']; ?>;
            border: 1.5px solid rgba(194, 210, 74, .45);
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-cta:hover {
            background: <?php echo $c['leaf']; ?>;
            color: <?php echo $c['forest']; ?>;
            border-color: <?php echo $c['leaf']; ?>;
        }

        #bes-hdr.bes-hdr-on-dark .bes-h-burger {
            color: <?php echo $c['ivory']; ?>
        }

        /* ── ON LIGHT BG ── */
        #bes-hdr.bes-hdr-on-light .bes-h-txt {
            color: <?php echo $c['bark']; ?>
        }

        #bes-hdr.bes-hdr-on-light .bes-h-svg path,
        #bes-hdr.bes-hdr-on-light .bes-h-svg circle {
            stroke: <?php echo $c['bark']; ?>;
            fill: <?php echo $c['bark']; ?>;
        }

        #bes-hdr.bes-hdr-on-light .bes-h-link:hover .bes-h-txt {
            color: <?php echo $c['olive']; ?>
        }

        #bes-hdr.bes-hdr-on-light .bes-h-link .bes-h-dot {
            background: <?php echo $c['olive']; ?>
        }

        #bes-hdr.bes-hdr-on-light .bes-h-cta {
            background: <?php echo $c['olive']; ?>;
            color: <?php echo $c['ivory']; ?>;
            border: 1.5px solid transparent;
        }

        #bes-hdr.bes-hdr-on-light .bes-h-cta:hover {
            background: <?php echo $c['olive_dark']; ?>
        }

        #bes-hdr.bes-hdr-on-light .bes-h-burger {
            color: <?php echo $c['bark']; ?>
        }

        /* ── Shared transitions ── */
        .bes-h-txt,
        .bes-h-burger {
            transition: color .45s ease
        }

        .bes-h-svg path,
        .bes-h-svg circle {
            transition: stroke .45s ease, fill .45s ease;
        }

        .bes-h-cta {
            transition: all .35s cubic-bezier(.4, 0, .2, 1)
        }

        /* ── Nav link — dot-expand hover ── */
        .bes-h-link {
            position: relative;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px
        }

        .bes-h-dot {
            width: 0;
            height: 4px;
            border-radius: 2px;
            transition: width .35s cubic-bezier(.34, 1.56, .64, 1);
            flex-shrink: 0;
        }

        /* Only expand dot on hover */
        .bes-h-link:hover .bes-h-dot {
            width: 16px;
            opacity: 1;
        }

        /* Completely hide dot when active to let the keris stripe shine */
        .bes-h-link.active .bes-h-dot {
            width: 0;
            opacity: 0;
            margin: 0;
            padding: 0;
        }

        /* ── Dropdown / Submenu (Desktop) ── */
        .bes-h-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            max-width: min(320px, calc(100vw - 32px));
            background: rgba(30, 42, 22, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 12px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .bes-h-link-wrapper:hover .bes-h-dropdown,
        .bes-h-link-wrapper.touch-open .bes-h-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .bes-h-link-wrapper.touch-open .bes-h-link .fa-chevron-down {
            transform: rotate(180deg);
        }

        .bes-h-sublink {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            color: rgba(253, 252, 250, 0.7) !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .bes-h-sublink:hover {
            color: <?php echo $c['leaf']; ?>;
            background: rgba(194, 210, 74, 0.06);
            padding-left: 26px;
        }

        /* ── Mobile Accordion ── */
        .bes-m-sub-wrap {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .bes-m-sub-wrap.open {
            max-height: 1500px;
        }

        .bes-m-sublink {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px 12px 48px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(253, 252, 250, 0.4);
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.01);
        }

        .bes-m-sublink:hover {
            color: <?php echo $c['leaf']; ?>;
            padding-left: 54px;
        }

        /* ── Staggered link entrance ── */
        .bes-h-link {
            opacity: 0;
            transform: translateY(-8px);
            animation: hdrLinkIn .5s cubic-bezier(.4, 0, .2, 1) forwards;
        }

        @keyframes hdrLinkIn {
            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ============================================================
         USER AVATAR BUTTON — Adaptive, Elegant, Smooth Rounded
         ============================================================ */
        .bes-user-btn {
            position: relative;
            border: 1.5px solid transparent;
            background: transparent;
            cursor: pointer;
            border-radius: 9999px;
            padding: 5px 8px 5px 5px;
            min-height: 48px;
            gap: 12px;
            transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
            isolation: isolate;
        }

        /* Soft inner glow for organic feel */
        .bes-user-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, transparent 50%, rgba(194, 210, 74, 0.02) 100%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            z-index: 0;
        }

        .bes-user-btn:hover::after {
            opacity: 1;
        }

        /* Ensure contents sit above the inner gradient */
        .bes-user-btn > * {
            position: relative;
            z-index: 1;
        }

        .bes-user-chev-wrap {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            margin-left: 2px;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .bes-user-btn:hover .bes-user-chev-wrap {
            background: rgba(194, 210, 74, 0.2);
        }

        #bes-hdr.bes-hdr-on-light .bes-user-chev-wrap {
            background: rgba(30, 42, 22, 0.06);
        }

        #bes-hdr.bes-hdr-on-light .bes-user-btn:hover .bes-user-chev-wrap {
            background: rgba(63, 81, 48, 0.15);
        }

        /* Avatar ring — subtle glow that adapts */
        .bes-user-avatar-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .bes-user-ring {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px solid transparent;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
            z-index: 0;
        }

        /* Outer soft glow halo around avatar */
        .bes-user-avatar-wrap::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(194, 210, 74, 0.12) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            z-index: 0;
        }

        .bes-user-btn:hover .bes-user-avatar-wrap::before {
            opacity: 1;
        }

        /* ── ON DARK BG (hero) ── */
        #bes-hdr.bes-hdr-on-dark .bes-user-btn {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(194, 210, 74, 0.2);
            box-shadow: 
                0 2px 8px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        #bes-hdr.bes-hdr-on-dark .bes-user-btn:hover {
            background: rgba(194, 210, 74, 0.1);
            border-color: rgba(194, 210, 74, 0.5);
            box-shadow: 
                0 6px 24px rgba(194, 210, 74, 0.18),
                0 2px 8px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transform: translateY(-1px);
        }

        #bes-hdr.bes-hdr-on-dark .bes-user-ring {
            border-color: rgba(194, 210, 74, 0.35);
        }

        #bes-hdr.bes-hdr-on-dark .bes-user-btn:hover .bes-user-ring {
            border-color: <?php echo $c['leaf']; ?>;
            inset: -3px;
            box-shadow: 0 0 12px rgba(194, 210, 74, 0.3);
        }

        /* ── ON LIGHT BG ── */
        #bes-hdr.bes-hdr-on-light .bes-user-btn {
            background: rgba(30, 42, 22, 0.05);
            border-color: rgba(63, 81, 48, 0.2);
            box-shadow: 
                0 2px 8px rgba(30, 42, 22, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border-radius: 12px;
        }

        #bes-hdr.bes-hdr-on-light .bes-user-btn:hover {
            background: rgba(63, 81, 48, 0.09);
            border-color: rgba(63, 81, 48, 0.42);
            box-shadow: 
                0 6px 24px rgba(30, 42, 22, 0.12),
                0 2px 8px rgba(30, 42, 22, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        #bes-hdr.bes-hdr-on-light .bes-user-ring {
            border-color: rgba(63, 81, 48, 0.3);
        }

        #bes-hdr.bes-hdr-on-light .bes-user-btn:hover .bes-user-ring {
            border-color: <?php echo $c['olive']; ?>;
            inset: -3px;
            box-shadow: 0 0 12px rgba(63, 81, 48, 0.2);
        }

        /* ── SCROLLED STATE (frosted) ── */
        #bes-hdr.bes-hdr-scrolled .bes-user-btn {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(194, 210, 74, 0.25);
            box-shadow: 
                0 2px 10px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        #bes-hdr.bes-hdr-scrolled .bes-user-btn:hover {
            background: rgba(194, 210, 74, 0.13);
            border-color: rgba(194, 210, 74, 0.55);
            box-shadow: 
                0 8px 28px rgba(194, 210, 74, 0.2),
                0 2px 10px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        #bes-hdr.bes-hdr-scrolled .bes-user-ring {
            border-color: rgba(194, 210, 74, 0.4);
        }

        /* Name text — ensures it inherits the bes-h-txt adaptive color properly */
        .bes-user-name {
            transition: color 0.45s ease, letter-spacing 0.3s ease;
        }

        .bes-user-btn:hover .bes-user-name {
            letter-spacing: 0.16em;
        }

        .bes-user-btn:hover .bes-user-chev {
            opacity: 1;
        }

        /* Dropdown panel — slightly refined offset for new button */
        #bes-user-panel {
            margin-top: 8px;
            left: auto;
            right: 0;
        }
        /* Auto-flip dropdowns for the last two nav items so they never clip */
        nav .bes-h-link-wrapper:nth-last-of-type(-n+2) .bes-h-dropdown {
            left: auto;
            right: 0;
        }

        /* ── CTA glow ring ── */
        .bes-h-cta {
            position: relative;
            overflow: hidden
        }

        .bes-h-cta::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: conic-gradient(from 0deg, transparent, <?php echo $c['leaf']; ?>, transparent, <?php echo $c['gold']; ?>, transparent);
            opacity: 0;
            transition: opacity .4s ease;
            z-index: -1;
            animation: ctaSpin 4s linear infinite;
        }

        @keyframes ctaSpin {
            to {
                transform: rotate(360deg)
            }
        }

        .bes-h-cta:hover::before {
            opacity: .35
        }

        /* ============================================================
         MOBILE DRAWER
         ============================================================ */
        #bes-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 380px;
            height: 100dvh;
            z-index: 9995;
            background: linear-gradient(180deg, <?php echo $c['forest_deep']; ?>, <?php echo $c['forest']; ?>);
            transform: translateX(100%);
            transition: transform .5s cubic-bezier(.22, 1, .36, 1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        #bes-drawer.open {
            transform: translateX(0)
        }

        /* Backdrop with blur */
        #bes-backdrop {
            position: fixed;
            inset: 0;
            z-index: 9994;
            background: rgba(10, 14, 7, .4);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            opacity: 0;
            visibility: hidden;
            transition: opacity .5s ease, visibility .5s ease;
        }

        #bes-backdrop.show {
            opacity: 1;
            visibility: visible
        }

        /* Drawer nav links with stagger */
        .bes-m-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 28px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(253, 252, 250, .5);
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, .03);
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
            transform: translateX(30px);
            opacity: 0;
        }

        #bes-drawer.open .bes-m-link {
            transform: translateX(0);
            opacity: 1;
            transition: transform .4s cubic-bezier(.22, 1, .36, 1), opacity .4s ease, color .2s ease, padding .2s ease, background .2s ease;
        }

        .bes-m-link:hover {
            background: rgba(194, 210, 74, .06);
            color: <?php echo $c['leaf']; ?>;
            padding-left: 36px;
        }

        .bes-m-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(194, 210, 74, .2);
            transition: all .3s ease;
            flex-shrink: 0;
        }

        .bes-m-link:hover .bes-m-dot {
            background: <?php echo $c['leaf']; ?>;
            transform: scale(1.4)
        }

        /* ============================================================
         FOOTER
         ============================================================ */
        .bes-ftr-glow {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 240px;
            background: radial-gradient(ellipse, rgba(194, 210, 74, .06), transparent 70%);
            pointer-events: none;
        }

        /* Balinese fretwork divider pattern */
        .bes-fret {
            height: 40px;
            width: 100%;
            background: repeating-linear-gradient(90deg,
                    transparent 0px, transparent 18px,
                    rgba(194, 210, 74, .06) 18px, rgba(194, 210, 74, .06) 19px,
                    transparent 19px, transparent 37px);
            mask-image: linear-gradient(90deg, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(90deg, transparent, black 15%, black 85%, transparent);
        }

        /* Footer link hover lift */
        .bes-ftr-link {
            transition: all .25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .bes-ftr-link:hover {
            transform: translateX(3px)
        }

        /* Social orbs */
        .bes-soc-orb {
            position: relative;
            overflow: hidden;
            transition: all .4s cubic-bezier(.34, 1.56, .64, 1);
        }

        .bes-soc-orb::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: <?php echo $c['leaf']; ?>;
            transform: scale(0);
            transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
            z-index: 0;
        }

        .bes-soc-orb:hover::before {
            transform: scale(1)
        }

        .bes-soc-orb:hover {
            border-color: <?php echo $c['leaf']; ?>;
            color: <?php echo $c['forest']; ?>;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(194, 210, 74, .2);
        }

        .bes-soc-orb i {
            position: relative;
            z-index: 1
        }

        /* Newsletter CTA strip */
        .bes-nl-input {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .08);
            color: white;
            font-size: 13px;
            padding: 12px 18px;
            border-radius: 12px 0 0 12px;
            outline: none;
            transition: all .3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 100%;
        }

        .bes-nl-input::placeholder {
            color: rgba(255, 255, 255, .3)
        }

        .bes-nl-input:focus {
            border-color: rgba(194, 210, 74, .35);
            background: rgba(255, 255, 255, .08);
            box-shadow: 0 0 0 3px rgba(194, 210, 74, .08);
        }

        .bes-nl-btn {
            background: <?php echo $c['leaf']; ?>;
            color: <?php echo $c['forest']; ?>;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 12px 20px;
            border-radius: 0 12px 12px 0;
            border: none;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .3s ease;
            white-space: nowrap;
        }

        .bes-nl-btn:hover {
            background: <?php echo $c['leaf_hover']; ?>
        }

        /* ============================================================
         UTILITY: Staggered entrance for any element
         ============================================================ */
        .bes-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s cubic-bezier(.4, 0, .2, 1), transform .6s cubic-bezier(.4, 0, .2, 1);
        }

        .bes-reveal.bes-visible {
            opacity: 1;
            transform: translateY(0)
        }

        /* ── Goresan Keris Active Stripe ── */
        .bes-h-link,
        .bes-ftr-link {
            position: relative;
        }

        .bes-keris-stripe {
            position: absolute;
            bottom: -4px;
            height: 1.5px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Header centering */
        .bes-h-link .bes-keris-stripe {
            left: 50%;
            transform: translateX(-50%) scaleX(0.2);
        }

        .bes-h-link.active .bes-keris-stripe {
            opacity: 1;
            transform: translateX(-50%) scaleX(1);
        }

        /* Footer left-align */
        .bes-ftr-link .bes-keris-stripe {
            left: 16px;
            /* Offsets past the dot */
            transform-origin: left center;
            transform: scaleX(0.2);
        }

        .bes-ftr-link.active .bes-keris-stripe {
            opacity: 1;
            transform: scaleX(1);
        }

        /* ── Respect users who prefer reduced motion ── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms;
                animation-iteration-count: 1;
                transition-duration: 0.01ms;
                scroll-behavior: auto;
            }
            .bes-lotus-petal, .bes-lotus-center, .bes-mist-dot,
            .bes-pre-text, .bes-h-cta::before, .bes-arc {
                animation: none;
            }
        }
    </style>
<?php
}

/* =========================================================================
 * 1B. WOOCOMMERCE CART + CHECKOUT — STRUCTURAL COMMERCE LAYER
 * =========================================================================
 * A route-scoped, source-order-safe layout system for WooCommerce Blocks.
 * It fixes the Elementor wrapper first, then applies a true two-column grid
 * directly to Cart and Checkout. The normal cascade is used throughout this layer.
 * ========================================================================= */

if (! function_exists('bes_is_commerce_page')) {
    function bes_is_commerce_page()
    {
        return function_exists('is_woocommerce')
            && ((function_exists('is_cart') && is_cart())
                || (function_exists('is_checkout') && is_checkout()));
    }
}

add_filter('body_class', 'bes_commerce_body_classes');
function bes_commerce_body_classes($classes)
{
    if (! bes_is_commerce_page()) {
        return $classes;
    }

    $classes[] = 'bes-commerce-page';

    if (function_exists('is_cart') && is_cart()) {
        $classes[] = 'bes-commerce-cart';
    }

    if (function_exists('is_checkout') && is_checkout()) {
        $classes[] = 'bes-commerce-checkout';
    }

    return array_values(array_unique($classes));
}

/* Priority 999 deliberately prints after Elementor and WooCommerce block CSS.
   The selectors are route-scoped and structurally specific, so the normal
   cascade is sufficient through source order and structural specificity. */
add_action('wp_head', 'bes_commerce_styles', 999);
function bes_commerce_styles()
{
    if (! bes_is_commerce_page()) {
        return;
    }

    $c = BES_COLORS;
?>
    <!-- ====== BES Commerce UI v3.3.0 ====== -->
    <style id="bes-commerce-ui-v330">
        /* -------------------------------------------------------------
         * Commerce design tokens and fixed-header clearance
         * ------------------------------------------------------------- */
        body.woocommerce-page.bes-commerce-page {
            --bes-commerce-admin-offset: 0px;
            --bes-commerce-header-height: 82px;
            --bes-commerce-content-width: 1240px;
            --bes-commerce-page-gutter: clamp(18px, 3vw, 34px);
            --bes-commerce-column-gap: clamp(24px, 3.2vw, 46px);
            --bes-commerce-card-radius: 22px;
            --bes-commerce-card-border: color-mix(in srgb, <?php echo $c['sand']; ?> 92%, <?php echo $c['gold']; ?> 8%);
            --bes-commerce-card-shadow: 0 22px 54px color-mix(in srgb, <?php echo $c['forest_deep']; ?> 11%, transparent);
            --bes-commerce-soft-shadow: 0 12px 34px color-mix(in srgb, <?php echo $c['forest_deep']; ?> 8%, transparent);
            color: <?php echo $c['bark']; ?>;
            background: <?php echo $c['parchment']; ?>;
        }

        body.admin-bar.woocommerce-page.bes-commerce-page {
            --bes-commerce-admin-offset: 32px;
        }

        @media (max-width: 782px) {
            body.admin-bar.woocommerce-page.bes-commerce-page {
                --bes-commerce-admin-offset: 46px;
            }
        }

        /* Keep the global header visually stable on transactional pages. */
        body.woocommerce-page.bes-commerce-page #bes-hdr:not(.bes-hdr-scrolled) {
            background: color-mix(in srgb, <?php echo $c['forest']; ?> 94%, transparent);
            -webkit-backdrop-filter: blur(18px) saturate(1.2);
            backdrop-filter: blur(18px) saturate(1.2);
            box-shadow: inset 0 -1px 0 color-mix(in srgb, <?php echo $c['leaf']; ?> 12%, transparent);
        }

        body.woocommerce-page.bes-commerce-page #bes-hdr:not(.bes-hdr-scrolled) .bes-h-txt,
        body.woocommerce-page.bes-commerce-page #bes-hdr:not(.bes-hdr-scrolled) .bes-h-burger {
            color: <?php echo $c['ivory']; ?>;
        }

        body.woocommerce-page.bes-commerce-page #bes-hdr:not(.bes-hdr-scrolled) .bes-h-svg path,
        body.woocommerce-page.bes-commerce-page #bes-hdr:not(.bes-hdr-scrolled) .bes-h-svg circle {
            stroke: <?php echo $c['ivory']; ?>;
            fill: <?php echo $c['ivory']; ?>;
        }

        /* -------------------------------------------------------------
         * Hero
         * ------------------------------------------------------------- */
        body.woocommerce-page.bes-commerce-page .bes-commerce-hero,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child {
            --min-height: clamp(390px, 37vw, 500px);
            --padding-top: calc(var(--bes-commerce-admin-offset) + var(--bes-commerce-header-height) + clamp(58px, 6vw, 88px));
            --padding-right: var(--bes-commerce-page-gutter);
            --padding-bottom: clamp(88px, 8vw, 116px);
            --padding-left: var(--bes-commerce-page-gutter);
            position: relative;
            isolation: isolate;
            min-height: var(--min-height);
            padding: var(--padding-top) var(--padding-right) var(--padding-bottom) var(--padding-left);
            overflow: hidden;
            background:
                radial-gradient(circle at 50% 72%, color-mix(in srgb, <?php echo $c['leaf']; ?> 14%, transparent) 0, transparent 28%),
                radial-gradient(circle at 14% 10%, color-mix(in srgb, <?php echo $c['gold']; ?> 10%, transparent) 0, transparent 30%),
                linear-gradient(132deg, <?php echo $c['forest_deep']; ?> 0%, <?php echo $c['forest']; ?> 58%, <?php echo $c['olive_dark']; ?> 100%);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero::before,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            opacity: .38;
            background-image:
                linear-gradient(115deg, transparent 0 43%, color-mix(in srgb, <?php echo $c['ivory']; ?> 4%, transparent) 43.2% 43.35%, transparent 43.55%),
                repeating-linear-gradient(90deg, transparent 0 47px, color-mix(in srgb, <?php echo $c['leaf']; ?> 4%, transparent) 47px 48px);
            -webkit-mask-image: linear-gradient(to bottom, black 0%, transparent 94%);
            mask-image: linear-gradient(to bottom, black 0%, transparent 94%);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero > .e-con-inner,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child > .e-con-inner {
            position: relative;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            width: min(1180px, 100%);
            min-height: 100%;
            margin-inline: auto;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero .elementor-widget-heading,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child .elementor-widget-heading {
            position: relative;
            width: auto;
            margin: 0;
            text-align: center;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero .elementor-widget-heading::before,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child .elementor-widget-heading::before {
            content: 'BALI ELING SPIRIT';
            display: block;
            margin-bottom: 14px;
            color: <?php echo $c['leaf_soft']; ?>;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(9px, .8vw, 11px);
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: .32em;
            text-transform: uppercase;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero .elementor-widget-heading::after,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child .elementor-widget-heading::after {
            content: '';
            display: block;
            width: 74px;
            height: 1px;
            margin: 20px auto 0;
            background: linear-gradient(90deg, transparent, <?php echo $c['gold_soft']; ?>, <?php echo $c['leaf']; ?>, transparent);
            box-shadow: 0 0 14px color-mix(in srgb, <?php echo $c['leaf']; ?> 28%, transparent);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-hero .elementor-heading-title,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child .elementor-heading-title {
            margin: 0;
            color: <?php echo $c['ivory']; ?>;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(3.45rem, 6vw, 5.6rem);
            font-weight: 500;
            line-height: .94;
            letter-spacing: -.038em;
            text-wrap: balance;
            text-shadow: 0 12px 38px color-mix(in srgb, <?php echo $c['forest_deep']; ?> 70%, transparent);
        }

        /* Animated inline SVG ornament. */
        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament {
            position: absolute;
            left: 50%;
            bottom: -13px;
            z-index: 1;
            width: min(920px, 96vw);
            transform: translateX(-50%);
            pointer-events: none;
            opacity: .58;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament svg {
            display: block;
            width: 100%;
            height: auto;
            overflow: visible;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__draw {
            stroke-dasharray: 1150;
            stroke-dashoffset: 1150;
            animation: besCommerceDraw 2.3s cubic-bezier(.22, 1, .36, 1) .12s forwards;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__lotus {
            transform-box: fill-box;
            transform-origin: center;
            opacity: 0;
            animation: besCommerceLotus 1.4s cubic-bezier(.22, 1, .36, 1) .55s forwards;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__halo {
            transform-box: fill-box;
            transform-origin: center;
            animation: besCommerceHalo 8s linear infinite;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__spark {
            transform-box: fill-box;
            transform-origin: center;
            animation: besCommerceSpark 3.6s ease-in-out infinite;
        }

        @keyframes besCommerceDraw {
            to { stroke-dashoffset: 0; }
        }

        @keyframes besCommerceLotus {
            from { opacity: 0; transform: translateY(18px) scale(.88); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes besCommerceHalo {
            to { transform: rotate(360deg); }
        }

        @keyframes besCommerceSpark {
            0%, 100% { opacity: .28; transform: scale(.75); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* -------------------------------------------------------------
         * Elementor containment repair — this is the key structural fix
         * ------------------------------------------------------------- */
        body.woocommerce-page.bes-commerce-page .bes-commerce-shell.e-con,
        body.woocommerce-page.bes-commerce-page .bes-commerce-shell.e-con-boxed,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-cart),
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-checkout) {
            --min-height: 0px;
            --width: 100%;
            --content-width: var(--bes-commerce-content-width);
            --padding-top: clamp(56px, 6vw, 84px);
            --padding-right: var(--bes-commerce-page-gutter);
            --padding-bottom: clamp(64px, 7vw, 92px);
            --padding-left: var(--bes-commerce-page-gutter);
            width: 100%;
            min-height: 0;
            padding: var(--padding-top) var(--padding-right) var(--padding-bottom) var(--padding-left);
            background: <?php echo $c['parchment']; ?>;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-shell.e-con-boxed > .e-con-inner,
        body.woocommerce-page.bes-commerce-page .bes-commerce-shell > .e-con-inner,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-cart) > .e-con-inner,
        body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-checkout) > .e-con-inner {
            display: block;
            width: min(var(--bes-commerce-content-width), 100%);
            max-width: var(--bes-commerce-content-width);
            min-height: 0;
            margin-inline: auto;
            padding: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-widget.elementor-widget,
        body.woocommerce-page.bes-commerce-page .elementor-widget:has(.wp-block-woocommerce-cart),
        body.woocommerce-page.bes-commerce-page .elementor-widget:has(.wp-block-woocommerce-checkout) {
            --container-widget-width: 100%;
            --container-widget-flex-grow: 1;
            width: 100%;
            max-width: none;
            min-width: 0;
            margin: 0;
            flex: 1 1 100%;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-widget > .elementor-widget-container,
        body.woocommerce-page.bes-commerce-page .elementor-widget:has(.wp-block-woocommerce-cart) > .elementor-widget-container,
        body.woocommerce-page.bes-commerce-page .elementor-widget:has(.wp-block-woocommerce-checkout) > .elementor-widget-container {
            width: 100%;
            max-width: none;
            min-width: 0;
            margin: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-widget > .elementor-widget-container > p:empty,
        body.woocommerce-page.bes-commerce-page .bes-commerce-widget > .elementor-widget-container > br:first-child,
        body.woocommerce-page.bes-commerce-page .bes-commerce-widget > .elementor-widget-container > br:last-child {
            display: none;
        }

        /* -------------------------------------------------------------
         * True two-column foundations
         * ------------------------------------------------------------- */

        body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .wp-block-woocommerce-checkout > .wp-block-woocommerce-checkout-fields-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wp-block-woocommerce-checkout-fields-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-checkout__main,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-components-main {
            grid-column: 1;
            grid-row: 1;
            width: auto;
            max-width: none;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .wp-block-woocommerce-checkout > .wp-block-woocommerce-checkout-totals-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wp-block-woocommerce-checkout-totals-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-checkout__sidebar,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-components-sidebar {
            grid-column: 2;
            grid-row: 1;
            align-self: start;
            width: auto;
            max-width: none;
            min-width: 0;
            margin: 0;
            padding: 0;
            position: sticky;
            top: calc(var(--bes-commerce-admin-offset) + var(--bes-commerce-header-height) + 22px);
        }

        body.woocommerce-cart.woocommerce-page.bes-commerce-cart .elementor-widget-text-editor > .elementor-widget-container > .wp-block-woocommerce-cart,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root.wp-block-woocommerce-cart,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root.wc-block-cart {
            width: 100%;
            max-width: none;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wp-block-woocommerce-filled-cart-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__main + .wc-block-cart__sidebar,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-components-sidebar-layout {
            min-width: 0;
        }

        body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart > .wp-block-woocommerce-filled-cart-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wp-block-woocommerce-filled-cart-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root.wc-block-components-sidebar-layout,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wc-block-components-sidebar-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(320px, .78fr);
            column-gap: var(--bes-commerce-column-gap);
            row-gap: 28px;
            align-items: start;
            width: 100%;
            max-width: none;
            min-width: 0;
            margin: 0;
        }

        body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart .wp-block-woocommerce-cart-items-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-items-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__main,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-components-main {
            grid-column: 1;
            grid-row: 1;
            width: auto;
            max-width: none;
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart .wp-block-woocommerce-cart-totals-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-totals-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__sidebar,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-components-sidebar {
            grid-column: 2;
            grid-row: 1;
            align-self: start;
            width: auto;
            max-width: none;
            min-width: 0;
            margin: 0;
            padding: 0;
            position: sticky;
            top: calc(var(--bes-commerce-admin-offset) + var(--bes-commerce-header-height) + 22px);
        }

        /* Classic-template fallback. */
        body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .woocommerce {
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(320px, .78fr);
            gap: var(--bes-commerce-column-gap);
            align-items: start;
        }

        body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .woocommerce-cart-form {
            grid-column: 1;
            min-width: 0;
        }

        body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .cart-collaterals {
            grid-column: 2;
            min-width: 0;
        }

        /* -------------------------------------------------------------
         * Card system and typography
         * ------------------------------------------------------------- */
        body.woocommerce-page.bes-commerce-page .bes-commerce-root,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root input,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root select,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root textarea,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root button {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root h1,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root h2,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root h3,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root h4,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-title,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart__totals-title {
            color: <?php echo $c['bark']; ?>;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 600;
            line-height: 1.08;
            letter-spacing: -.025em;
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkout-step,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-contact-information-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-billing-address-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-shipping-address-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-payment-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-additional-information-block,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-order-note-block {
            width: 100%;
            min-width: 0;
            margin: 0 0 18px;
            padding: clamp(24px, 2.8vw, 34px);
            border: 1px solid var(--bes-commerce-card-border);
            border-radius: var(--bes-commerce-card-radius);
            background: <?php echo $c['ivory']; ?>;
            box-shadow: var(--bes-commerce-soft-shadow);
        }

        /* Avoid double cards after WooCommerce hydrates the placeholder block. */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-contact-information-block:has(.wc-block-components-checkout-step),
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-billing-address-block:has(.wc-block-components-checkout-step),
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-shipping-address-block:has(.wc-block-components-checkout-step),
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-payment-block:has(.wc-block-components-checkout-step),
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-additional-information-block:has(.wc-block-components-checkout-step),
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-order-note-block:has(.wc-block-components-checkout-step) {
            margin: 0;
            padding: 0;
            border: 0;
            border-radius: 0;
            background: transparent;
            box-shadow: none;
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkout-step__heading {
            margin: 0 0 18px;
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkout-step__title,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-title {
            margin: 0;
            font-size: clamp(1.75rem, 2.2vw, 2.15rem);
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkout-step__description,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-metadata,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-metadata__description,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-item__description {
            color: <?php echo $c['bark_muted']; ?>;
            font-size: 12px;
            line-height: 1.65;
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-totals-block,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-totals-block,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-sidebar {
            padding: clamp(24px, 2.5vw, 32px);
            border: 0;
            border-radius: var(--bes-commerce-card-radius);
            background: <?php echo $c['ivory']; ?>;
            box-shadow: var(--bes-commerce-card-shadow);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-sidebar > :first-child,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-checkout-totals-block > :first-child,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-cart-totals-block > :first-child {
            margin-top: 0;
            padding: 15px 15px 0 15px;
            border-bottom: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-sidebar > :last-child,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-checkout-totals-block > :last-child,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-cart-totals-block > :last-child {
            margin-bottom: 0;
            border: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart__totals-title,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-checkout-order-summary__title,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-cart-order-summary-heading-block,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wp-block-woocommerce-checkout-order-summary-block > h2 {
            margin: 0 0 18px;
            font-size: clamp(1.8rem, 2.25vw, 2.25rem);
        }

        /* Cart table / line items. */
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-items,
        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .woocommerce-cart-form {
            width: 100%;
            min-width: 0;
            overflow: hidden;
            border: 1px solid var(--bes-commerce-card-border);
            border-radius: var(--bes-commerce-card-radius);
            background: <?php echo $c['ivory']; ?>;
            box-shadow: var(--bes-commerce-soft-shadow);
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-items {
            table-layout: auto;
            border-collapse: separate;
            border-spacing: 0;
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-items th {
            padding: 16px clamp(18px, 2vw, 26px);
            border-bottom: 1px solid <?php echo $c['sand']; ?>;
            color: <?php echo $c['bark_muted']; ?>;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-items td {
            padding: clamp(24px, 2.5vw, 34px) clamp(18px, 2vw, 26px);
            vertical-align: top;
            border-bottom-color: <?php echo $c['sand']; ?>;
            flex-direction: column;
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-item__image {
            width: clamp(88px, 8vw, 112px);
            min-width: clamp(88px, 8vw, 112px);
            padding-right: clamp(14px, 1.5vw, 22px);
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-item__image img,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__image img {
            display: block;
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 8px 22px color-mix(in srgb, <?php echo $c['forest_deep']; ?> 12%, transparent);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-name {
            color: <?php echo $c['bark']; ?>;
            font-size: clamp(14px, 1.15vw, 16px);
            font-weight: 700;
            line-height: 1.45;
            text-decoration: none;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-name:hover {
            color: <?php echo $c['olive']; ?>;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-metadata,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-product-metadata__description {
            max-width: 62ch;
            margin-top: 8px;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item {
            display: grid;
            grid-template-columns: 72px minmax(0, 1fr) auto;
            gap: 14px;
            align-items: start;
            padding-block: 18px;
            border-color: <?php echo $c['sand']; ?>;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__image {
            width: 72px;
            min-width: 72px;
            margin: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__description,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__total-price {
            min-width: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__total-price {
            color: <?php echo $c['bark']; ?>;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.45;
            text-align: right;
            white-space: nowrap;
        }

        /* Form controls. */
        body.woocommerce-page.bes-commerce-page .bes-commerce-root input[type="text"],
        body.woocommerce-page.bes-commerce-page .bes-commerce-root input[type="email"],
        body.woocommerce-page.bes-commerce-page .bes-commerce-root input[type="tel"],
        body.woocommerce-page.bes-commerce-page .bes-commerce-root input[type="number"],
        body.woocommerce-page.bes-commerce-page .bes-commerce-root select,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root textarea,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-text-input input,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-combobox-control input.components-combobox-control__input {
            min-height: 50px;
            border: 1px solid <?php echo $c['sand']; ?>;
            border-radius: 12px;
            color: <?php echo $c['bark']; ?>;
            background: <?php echo $c['ivory']; ?>;
            font-size: 14px;
            line-height: 1.4;
            transition: border-color .22s ease, box-shadow .22s ease, background-color .22s ease;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root textarea {
            min-height: 118px;
            resize: vertical;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root input:focus,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root select:focus,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root textarea:focus,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-text-input input:focus,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-combobox-control input.components-combobox-control__input:focus {
            border-color: <?php echo $c['sage']; ?>;
            background: <?php echo $c['ivory']; ?>;
            box-shadow: 0 0 0 4px color-mix(in srgb, <?php echo $c['leaf']; ?> 16%, transparent);
            outline: 0;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-text-input label,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-combobox-control label,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-checkbox__label,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-radio-control__label {
            color: <?php echo $c['bark_soft']; ?>;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.35;
        }

        /* Payment and note surfaces. */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkbox {
            border-radius: 14px;
        }

        /* 1. Set the outer accordion wrapper as the primary card */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control-accordion-option {
            border: 1px solid <?php echo $c['sand']; ?>;
            border-radius: 12px;
            background: <?php echo $c['ivory']; ?>;
            transition: border-color .22s ease, background-color .22s ease, box-shadow .22s ease;
            overflow: hidden;
        }

        /* 2. Transparent out the inner label's default structural border/bg without touching layout/padding */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control__option {
            border-color: transparent !important;
            background-color: transparent !important;
        }

        /* 3. Hover and Focus states on the outer card */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control-accordion-option:hover,
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control-accordion-option:focus-within {
            border-color: <?php echo $c['sage']; ?>;
            box-shadow: 0 4px 16px color-mix(in srgb, <?php echo $c['forest_deep']; ?> 4%, transparent);
        }
        
        /* 4. Active/Checked state on the outer card */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control-accordion-option.wc-block-components-radio-control-accordion-option--checked-option-highlighted {
            border-color: <?php echo $c['leaf']; ?>;
            background: color-mix(in srgb, <?php echo $c['leaf']; ?> 8%, <?php echo $c['ivory']; ?> 92%);
            box-shadow: 0 4px 16px color-mix(in srgb, <?php echo $c['leaf']; ?> 12%, transparent);
        }

        /* 5. Align the expanding description perfectly past the radio circle */
        body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-radio-control-accordion-content {
            padding: 0 16px 16px 42px !important; 
            color: <?php echo $c['bark_muted']; ?>;
            font-size: 13px;
        }

        /* Totals hierarchy. */
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-wrapper,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-panel,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item {
            border-color: <?php echo $c['sand']; ?>;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-item {
            gap: 16px;
            padding-block: 14px;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-item__label {
            color: <?php echo $c['bark_soft']; ?>;
            font-size: 13px;
            line-height: 1.45;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-item__value {
            color: <?php echo $c['bark']; ?>;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-footer-item {
            margin-top: 8px;
            padding-top: 20px;
            border-top: 1px solid <?php echo $c['sand']; ?>;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-footer-item .wc-block-components-totals-item__label,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-footer-item .wc-block-components-totals-item__value {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(1.4rem, 1.8vw, 1.72rem);
            font-weight: 600;
            line-height: 1.1;
        }

        /* Coupon controls and primary actions. */
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-panel__button,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-totals-coupon__button {
            min-height: 42px;
            border-radius: 10px;
            color: <?php echo $c['olive']; ?>;
            background: color-mix(in srgb, <?php echo $c['cream']; ?> 84%, <?php echo $c['leaf_soft']; ?> 16%);
            font-size: 12px;
            font-weight: 700;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-button,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart__submit-button,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-checkout-place-order-button,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root #place_order,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .checkout-button,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .button.alt {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 54px;
            padding: 14px 22px;
            border: 1px solid transparent;
            border-radius: 12px;
            color: <?php echo $c['forest']; ?>;
            background: <?php echo $c['leaf']; ?>;
            box-shadow: 0 12px 28px color-mix(in srgb, <?php echo $c['leaf']; ?> 24%, transparent);
            font-size: 11px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: .08em;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: transform .22s ease, background-color .22s ease, box-shadow .22s ease;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-button:hover,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart__submit-button:hover,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-checkout-place-order-button:hover,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root #place_order:hover,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .checkout-button:hover,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root .button.alt:hover {
            transform: translateY(-2px);
            background: <?php echo $c['leaf_hover']; ?>;
            box-shadow: 0 16px 34px color-mix(in srgb, <?php echo $c['leaf']; ?> 30%, transparent);
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-button:focus-visible,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root button:focus-visible,
        body.woocommerce-page.bes-commerce-page .bes-commerce-root a:focus-visible {
            outline: 2px solid <?php echo $c['olive']; ?>;
            outline-offset: 3px;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart-item__remove-link {
            color: <?php echo $c['olive']; ?>;
            font-size: 12px;
            font-weight: 700;
            text-underline-offset: 3px;
        }

        body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-cart-item__remove-link:hover {
            color: <?php echo $c['olive_dark']; ?>;
        }

        /* -------------------------------------------------------------
         * Empty cart — centered independently of the filled-cart grid
         * ------------------------------------------------------------- */
        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-shell {
            min-height: clamp(520px, 62vh, 720px);
        }

        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-root.wp-block-woocommerce-cart,
        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-root.wc-block-cart {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: clamp(390px, 48vh, 560px);
        }

        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-root > .wp-block-woocommerce-filled-cart-block {
            display: none;
        }

        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-root > .wp-block-woocommerce-empty-cart-block,
        body.woocommerce-page.bes-commerce-cart.bes-cart-is-empty .bes-commerce-root .wc-block-cart__empty-cart {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: min(720px, 100%);
            min-height: 300px;
            margin: 0 auto;
            padding: clamp(38px, 5vw, 62px);
            border: 1px solid var(--bes-commerce-card-border);
            border-radius: var(--bes-commerce-card-radius);
            background: <?php echo $c['ivory']; ?>;
            box-shadow: var(--bes-commerce-card-shadow);
            text-align: center;
        }

        body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__empty-cart__title {
            margin: 0 0 16px;
            color: <?php echo $c['bark']; ?>;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(2rem, 3vw, 2.7rem);
        }

        /* -------------------------------------------------------------
         * Responsive system
         * ------------------------------------------------------------- */
        @media (max-width: 1040px) and (min-width: 821px) {
            body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .elementor-widget-text-editor > .elementor-widget-container > .wp-block-woocommerce-checkout.wc-block-checkout,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-widget .bes-commerce-root.wp-block-woocommerce-checkout,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-widget .bes-commerce-root.wc-block-checkout,
            body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart > .wp-block-woocommerce-filled-cart-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wp-block-woocommerce-filled-cart-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root.wc-block-components-sidebar-layout,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wc-block-components-sidebar-layout,
            body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .woocommerce {
                grid-template-columns: minmax(0, 1fr) minmax(292px, 330px);
                column-gap: 24px;
            }

            body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .wp-block-woocommerce-checkout > .wp-block-woocommerce-checkout-totals-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wp-block-woocommerce-checkout-totals-block,
            body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart .wp-block-woocommerce-cart-totals-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-totals-block {
                padding: 24px 20px;
            }
        }

        @media (max-width: 820px) {
            body.woocommerce-page.bes-commerce-page {
                --bes-commerce-header-height: 74px;
            }

            body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .elementor-widget-text-editor > .elementor-widget-container > .wp-block-woocommerce-checkout.wc-block-checkout,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-widget .bes-commerce-root.wp-block-woocommerce-checkout,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-widget .bes-commerce-root.wc-block-checkout,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-widget .wc-block-components-sidebar-layout.bes-commerce-root,
            body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart > .wp-block-woocommerce-filled-cart-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wp-block-woocommerce-filled-cart-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root.wc-block-components-sidebar-layout,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root > .wc-block-components-sidebar-layout,
            body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .woocommerce {
                grid-template-columns: minmax(0, 1fr);
                row-gap: 24px;
            }

            body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .wp-block-woocommerce-checkout > .wp-block-woocommerce-checkout-fields-block,
            body.woocommerce-checkout.woocommerce-page.bes-commerce-checkout .wp-block-woocommerce-checkout > .wp-block-woocommerce-checkout-totals-block,
            body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart .wp-block-woocommerce-cart-items-block,
            body.woocommerce-cart.woocommerce-page.bes-commerce-cart .wp-block-woocommerce-cart .wp-block-woocommerce-cart-totals-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wp-block-woocommerce-checkout-fields-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-checkout__main,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-components-main,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wp-block-woocommerce-checkout-totals-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-checkout__sidebar,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root > .wc-block-components-sidebar,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-items-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__main,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-components-main,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-totals-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart__sidebar,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-components-sidebar,
            body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .woocommerce-cart-form,
            body.woocommerce-cart.bes-commerce-cart .bes-commerce-widget .cart-collaterals {
                grid-column: 1;
                grid-row: auto;
                width: 100%;
                max-width: none;
                position: static;
                top: auto;
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-hero,
            body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:first-child {
                --min-height: clamp(340px, 62vw, 420px);
                --padding-top: calc(var(--bes-commerce-admin-offset) + var(--bes-commerce-header-height) + 48px);
                --padding-bottom: 78px;
            }
        }

        @media (max-width: 600px) {
            body.woocommerce-page.bes-commerce-page {
                --bes-commerce-page-gutter: 15px;
                --bes-commerce-card-radius: 17px;
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-shell.e-con,
            body.woocommerce-page.bes-commerce-page .bes-commerce-shell.e-con-boxed,
            body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-cart),
            body.woocommerce-page.bes-commerce-page .elementor[data-elementor-type="wp-page"] > .e-con:has(.wp-block-woocommerce-checkout) {
                --padding-top: 40px;
                --padding-bottom: 56px;
            }

            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wc-block-components-checkout-step,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-contact-information-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-billing-address-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-shipping-address-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-payment-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-additional-information-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-order-note-block,
            body.woocommerce-page.bes-commerce-checkout .bes-commerce-root .wp-block-woocommerce-checkout-totals-block,
            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wp-block-woocommerce-cart-totals-block,
            body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-sidebar {
                padding: 20px 16px;
            }

            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-items td {
                padding: 20px 14px;
            }

            body.woocommerce-page.bes-commerce-cart .bes-commerce-root .wc-block-cart-item__image {
                width: 76px;
                min-width: 76px;
                padding-right: 12px;
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item {
                grid-template-columns: 60px minmax(0, 1fr);
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__image {
                width: 60px;
                min-width: 60px;
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-root .wc-block-components-order-summary-item__total-price {
                grid-column: 2;
                text-align: left;
                white-space: normal;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__draw,
            body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__halo,
            body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__lotus,
            body.woocommerce-page.bes-commerce-page .bes-commerce-ornament__spark {
                animation: none;
                stroke-dashoffset: 0;
            }

            body.woocommerce-page.bes-commerce-page .bes-commerce-root *,
            body.woocommerce-page.bes-commerce-page .bes-commerce-root *::before,
            body.woocommerce-page.bes-commerce-page .bes-commerce-root *::after {
                scroll-behavior: auto;
                transition-duration: .01ms;
            }
        }
    </style>
<?php
}

add_action('wp_footer', 'bes_commerce_ornament', 15);
function bes_commerce_ornament()
{
    if (! bes_is_commerce_page()) {
        return;
    }

    $c = BES_COLORS;
?>
    <template id="bes-commerce-ornament-template">
        <div class="bes-commerce-ornament" aria-hidden="true">
            <svg viewBox="0 0 1000 260" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <defs>
                    <linearGradient id="bes-commerce-ornament-gradient" x1="70" y1="155" x2="930" y2="155" gradientUnits="userSpaceOnUse">
                        <stop stop-color="<?php echo esc_attr($c['gold_soft']); ?>" stop-opacity="0"/>
                        <stop offset="0.26" stop-color="<?php echo esc_attr($c['gold_soft']); ?>" stop-opacity="0.78"/>
                        <stop offset="0.5" stop-color="<?php echo esc_attr($c['leaf_soft']); ?>"/>
                        <stop offset="0.74" stop-color="<?php echo esc_attr($c['gold_soft']); ?>" stop-opacity="0.78"/>
                        <stop offset="1" stop-color="<?php echo esc_attr($c['gold_soft']); ?>" stop-opacity="0"/>
                    </linearGradient>
                    <radialGradient id="bes-commerce-ornament-core" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(500 155) rotate(90) scale(44)">
                        <stop stop-color="<?php echo esc_attr($c['leaf_soft']); ?>" stop-opacity="0.34"/>
                        <stop offset="1" stop-color="<?php echo esc_attr($c['leaf']); ?>" stop-opacity="0"/>
                    </radialGradient>
                </defs>

                <ellipse cx="500" cy="155" rx="76" ry="76" fill="url(#bes-commerce-ornament-core)"/>

                <g class="bes-commerce-ornament__halo" opacity="0.58" stroke="url(#bes-commerce-ornament-gradient)" stroke-width="1">
                    <circle cx="500" cy="155" r="70" stroke-dasharray="4 10"/>
                    <circle cx="500" cy="155" r="88" stroke-dasharray="1 13"/>
                </g>

                <g class="bes-commerce-ornament__draw" stroke="url(#bes-commerce-ornament-gradient)" stroke-width="1.25" stroke-linecap="round">
                    <path d="M52 156C162 156 198 124 286 124C359 124 401 153 438 155"/>
                    <path d="M948 156C838 156 802 124 714 124C641 124 599 153 562 155"/>
                    <path d="M88 176C192 176 241 145 322 145C375 145 411 159 442 162" opacity="0.6"/>
                    <path d="M912 176C808 176 759 145 678 145C625 145 589 159 558 162" opacity="0.6"/>
                    <path d="M192 109C252 109 293 92 344 92C392 92 421 113 448 136" opacity="0.42"/>
                    <path d="M808 109C748 109 707 92 656 92C608 92 579 113 552 136" opacity="0.42"/>
                </g>

                <g class="bes-commerce-ornament__lotus" stroke="url(#bes-commerce-ornament-gradient)" stroke-width="1.35" fill="none" stroke-linejoin="round">
                    <path d="M500 164C482 145 478 119 500 84C522 119 518 145 500 164Z"/>
                    <path d="M498 166C470 156 453 136 452 104C482 118 498 139 498 166Z"/>
                    <path d="M502 166C530 156 547 136 548 104C518 118 502 139 502 166Z"/>
                    <path d="M493 169C459 171 436 159 421 132C455 132 480 145 493 169Z"/>
                    <path d="M507 169C541 171 564 159 579 132C545 132 520 145 507 169Z"/>
                    <path d="M500 172C475 183 448 180 425 158C458 153 483 157 500 172Z"/>
                    <path d="M500 172C525 183 552 180 575 158C542 153 517 157 500 172Z"/>
                    <path d="M438 184C468 198 532 198 562 184" opacity="0.72"/>
                    <path d="M459 196C480 204 520 204 541 196" opacity="0.48"/>
                </g>

                <g fill="<?php echo esc_attr($c['leaf_soft']); ?>">
                    <circle class="bes-commerce-ornament__spark" cx="210" cy="126" r="2.2"/>
                    <circle class="bes-commerce-ornament__spark" cx="314" cy="93" r="1.7"/>
                    <circle class="bes-commerce-ornament__spark" cx="391" cy="137" r="1.6"/>
                    <circle class="bes-commerce-ornament__spark" cx="609" cy="137" r="1.6"/>
                    <circle class="bes-commerce-ornament__spark" cx="686" cy="93" r="1.7"/>
                    <circle class="bes-commerce-ornament__spark" cx="790" cy="126" r="2.2"/>
                </g>
            </svg>
        </div>
    </template>

    <script id="bes-commerce-presentation-v330">
        (function () {
            'use strict';

            var selectors = {
                page: '.elementor[data-elementor-type="wp-page"]',
                root: '.wp-block-woocommerce-cart, .wc-block-cart, .wp-block-woocommerce-checkout, .wc-block-checkout',
                empty: '.wp-block-woocommerce-empty-cart-block, .wc-block-cart__empty-cart',
                items: '.wc-block-cart-items__row, .wc-block-cart-item__product, .woocommerce-cart-form__cart-item'
            };

            function directContainerBefore(shell) {
                if (!shell) return null;
                var previous = shell.previousElementSibling;
                while (previous) {
                    if (previous.classList && previous.classList.contains('e-con')) return previous;
                    previous = previous.previousElementSibling;
                }
                return null;
            }

            function mountOrnament(hero) {
                var template = document.getElementById('bes-commerce-ornament-template');
                if (!hero || !template || hero.querySelector('.bes-commerce-ornament')) return;
                hero.insertBefore(template.content.cloneNode(true), hero.firstChild);
            }

            function classifyCommerceDom() {
                var root = document.querySelector(selectors.root);
                if (!root) return null;

                root.classList.add('bes-commerce-root');

                var widget = root.closest('.elementor-widget');
                var shell = widget ? widget.closest('.e-con') : null;
                var page = root.closest(selectors.page);
                var hero = directContainerBefore(shell);

                if (!hero && page) {
                    hero = Array.prototype.find.call(page.children, function (child) {
                        return child.classList && child.classList.contains('e-con') && child !== shell;
                    });
                }

                if (widget) widget.classList.add('bes-commerce-widget');
                if (shell) shell.classList.add('bes-commerce-shell');
                if (hero) {
                    hero.classList.add('bes-commerce-hero');
                    mountOrnament(hero);
                }

                document.body.classList.add('bes-commerce-dom-ready');
                return { root: root, widget: widget, shell: shell };
            }

            function isRendered(element) {
                if (!element || !element.getClientRects().length) return false;
                var style = window.getComputedStyle(element);
                return style.display !== 'none' && style.visibility !== 'hidden';
            }

            function syncEmptyCartState(root) {
                if (!document.body.classList.contains('bes-commerce-cart') || !root) return;

                if (root.classList.contains('is-loading') || root.getAttribute('aria-busy') === 'true') {
                    document.body.classList.remove('bes-cart-is-empty');
                    return;
                }

                var emptyState = root.querySelector(selectors.empty);
                var itemNodes = root.querySelectorAll(selectors.items);
                var hasVisibleItems = Array.prototype.some.call(itemNodes, isRendered);
                var emptyVisible = isRendered(emptyState);

                document.body.classList.toggle('bes-cart-is-empty', emptyVisible && !hasVisibleItems);
            }

            function refreshCommerceDom() {
                var context = classifyCommerceDom();
                if (context) syncEmptyCartState(context.root);
                return context;
            }

            function initCommercePresentation() {
                var context = refreshCommerceDom();
                var observationRoot = context && context.widget ? context.widget : document.body;

                if ('MutationObserver' in window && observationRoot) {
                    var scheduled = false;
                    var observer = new MutationObserver(function () {
                        if (scheduled) return;
                        scheduled = true;
                        window.requestAnimationFrame(function () {
                            scheduled = false;
                            refreshCommerceDom();
                        });
                    });

                    observer.observe(observationRoot, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        attributeFilter: ['class', 'hidden', 'aria-busy']
                    });
                }

                [100, 300, 700, 1400, 2600].forEach(function (delay) {
                    window.setTimeout(refreshCommerceDom, delay);
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCommercePresentation, { once: true });
            } else {
                initCommercePresentation();
            }
        }());
    </script>
<?php
}



/* =========================================================================
 * 2. IMMERSIVE PRELOADER (wp_body_open priority 5)
 * ========================================================================= */
add_action('wp_body_open', 'bes_preloader', 5);
function bes_preloader()
{
    $c = BES_COLORS;
?>
    <div id="bes-preloader" role="status" aria-label="Loading Bali Eling Spirit">
        <!-- Floating mist particles (generated via JS) -->
        <div class="bes-mist" id="bes-mist"></div>

        <!-- Lotus bloom SVG -->
        <div class="bes-lotus" aria-hidden="true">
            <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Petals — each delayed for bloom sequence -->
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.12)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:0deg;animation-delay:0s" />
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.10)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:30deg;animation-delay:.12s" />
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.10)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:60deg;animation-delay:.24s" />
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.10)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:90deg;animation-delay:.36s" />
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.10)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:120deg;animation-delay:.48s" />
                <ellipse class="bes-lotus-petal" cx="60" cy="45" rx="8" ry="28"
                    fill="rgba(194,210,74,0.10)" stroke="<?php echo $c['leaf']; ?>" stroke-width="0.8"
                    style="--r:150deg;animation-delay:.60s" />
                <!-- Center glow -->
                <circle class="bes-lotus-center" cx="60" cy="85" r="5"
                    fill="<?php echo $c['leaf']; ?>" opacity="0.6" />
            </svg>
        </div>

        <!-- Progress arc (circular) -->
        <svg width="140" height="140" viewBox="0 0 140 140" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)" aria-hidden="true">
            <circle cx="70" cy="70" r="60" fill="none" stroke="rgba(255,255,255,.04)" stroke-width="1" />
            <circle cx="70" cy="70" r="60" fill="none" stroke="<?php echo $c['leaf']; ?>" stroke-width="1.5"
                class="bes-arc" id="bes-arc" stroke-linecap="round" />
        </svg>

        <!-- Shimmer brand text -->
        <p class="bes-pre-text" style="font-family:'Cormorant Garamond',serif;font-size:13px;letter-spacing:5px;text-transform:uppercase;margin-top:90px;font-weight:500">
            <?php echo esc_html(BES_SITE_NAME); ?>
        </p>
        <p style="font-family:'Plus Jakarta Sans',sans-serif;color:rgba(253,252,250,.25);font-size:10px;letter-spacing:3px;text-transform:uppercase;margin-top:8px;font-weight:400">
            <?php echo esc_html(BES_TAGLINE); ?>
        </p>
    </div>
<?php
}


/* =========================================================================
 * 3. ADAPTIVE STICKY HEADER (wp_body_open priority 10)
 * ========================================================================= */
add_action('wp_body_open', 'bes_header', 10);
function bes_header()
{
    $c   = BES_COLORS;

    // Fetch Menu 48 specifically for the header & build parent/child tree
    $raw_menu_items = wp_get_nav_menu_items(48);
    $menu_tree = [];

    if (empty($raw_menu_items) || is_wp_error($raw_menu_items)) {
        foreach (BES_NAV_LINKS as $link) {
            $item = new stdClass();
            $item->ID = rand(1000, 9999);
            $item->title = $link['label'];
            $item->url = $link['href'];
            $item->children = [];
            $menu_tree[] = $item;
        }
    } else {
        $items_by_id = [];
        foreach ($raw_menu_items as $item) {
            $item->children = [];
            $items_by_id[$item->ID] = $item;
        }
        foreach ($raw_menu_items as $item) {
            if ($item->menu_item_parent) {
                if (isset($items_by_id[$item->menu_item_parent])) {
                    $items_by_id[$item->menu_item_parent]->children[] = $item;
                }
            } else {
                $menu_tree[] = $item;
            }
        }
    }
?>
    <header id="bes-hdr" class="bes-hdr-on-dark" role="banner">
        <!-- Scroll progress indicator -->
        <div id="bes-scroll-prog" style="opacity:0"></div>

        <div class="max-w-[1440px] mx-auto flex items-center justify-between px-5 md:px-10 py-5 transition-[padding] duration-500" id="bes-hdr-inner">

            <!-- LOGO — organic SVG mark + refined type -->
            <a href="/" class="flex items-center gap-3 group relative z-10 bes-focus" aria-label="<?php echo esc_attr(BES_SITE_NAME); ?> — Home">
                <div class="relative">
                    <svg class="bes-h-svg w-10 h-10 md:w-12 md:h-12 transition-transform duration-500 group-hover:scale-110"
                        viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path fill="currentColor" d="M27.1992 0.0527344C27.4013 -0.0550224 27.5602 -0.030124 29.6523 0.442383C29.8929 0.496981 30.1335 0.551297 30.374 0.605469C30.6642 0.835869 30.9016 0.935479 31.0889 0.975586C31.2756 1.01523 31.4885 1.12029 31.5625 1.20898C31.6363 1.29816 31.8682 1.45999 32.0781 1.56836C32.5734 1.82397 34.0429 3.33354 34.2656 3.81641C34.3608 4.02249 34.5523 4.39126 34.6914 4.63574C35.4341 5.94042 35.6741 8.59562 35.1836 10.083C35.0485 10.4918 34.9021 10.8752 34.8584 10.9346C34.8145 10.9935 34.7445 11.2223 34.7031 11.4434C34.6622 11.6638 34.5888 11.8438 34.541 11.8438C34.4929 11.8452 34.282 12.1098 34.0723 12.4326C33.9447 12.6289 33.8166 12.8252 33.6895 13.0215C33.023 13.8364 32.6618 14.174 32.457 14.2969C32.333 14.371 32.2085 14.4459 32.085 14.5205C32.0106 14.5358 31.9366 14.5501 31.8623 14.5654C31.9369 14.5501 32.0113 14.5359 32.0859 14.5205C32.0502 14.5558 32.0138 14.5912 31.9785 14.627C31.9428 14.6622 31.9078 14.6981 31.8721 14.7334L31.7646 14.9482C31.6602 15.2826 31.7452 15.4307 31.9785 15.627C32.1639 15.783 32.4233 15.9109 32.5557 15.9111C32.6879 15.9111 32.9096 16.0316 33.0479 16.1787C33.1855 16.3257 33.4067 16.446 33.5391 16.4463C33.7618 16.4463 35.2289 17.6669 35.4277 18.0176C35.4546 18.0649 35.481 18.1119 35.5078 18.1592C35.6503 18.2663 35.7931 18.3734 35.9355 18.4805C36.5068 19.076 37.0187 19.7233 37.459 20.4072C37.5917 20.6133 37.7997 20.9064 37.9209 21.0596C38.1189 21.3102 38.6261 22.2721 38.9307 22.9756C38.9942 23.1227 39.1153 23.3636 39.2002 23.5107C39.2851 23.6579 39.3556 23.9418 39.3564 24.1406C39.3574 24.3399 39.4522 24.6538 39.5664 24.8389C39.9619 25.4797 40.2074 28.0082 40.0107 29.4141C39.8823 30.334 39.4676 31.9078 39.1553 32.6621C38.7962 33.5288 38.7452 33.6371 38.4053 34.2568C38.2146 34.6046 37.8469 35.1589 37.5879 35.4883C37.3289 35.8177 36.9357 36.3175 36.7139 36.5986C36.4916 36.8797 36.1659 37.2017 35.9893 37.3145C35.8126 37.4267 35.4777 37.7142 35.2451 37.9531C35.0126 38.1924 34.7672 38.3887 34.7002 38.3887C34.6331 38.3889 34.489 38.4873 34.3799 38.6074C34.1286 38.8849 33.0161 39.5654 32.8135 39.5654C32.7296 39.5657 32.4979 39.686 32.2988 39.833C32.0996 39.9801 31.8434 40.1006 31.7295 40.1006C31.6156 40.1006 31.3724 40.192 31.1895 40.3037C30.6382 40.6386 28.8752 41.194 28.0479 41.293C27.7896 41.3236 27.5312 41.3527 27.2734 41.3838V41.3848C26.447 41.6659 25.1452 41.7023 19.6787 41.7373C13.3572 41.7774 12.9426 41.7919 12.0322 42.0039C10.253 42.4182 9.43168 42.6435 9.10059 42.8086C8.92015 42.8986 8.61538 43.007 8.42383 43.0488C8.232 43.0906 7.96079 43.2152 7.82031 43.3252C7.67994 43.4348 7.49274 43.5254 7.40527 43.5254C7.31712 43.526 6.94066 43.7435 6.56836 44.0098C5.48778 44.7811 4.39583 46.1598 4.38867 46.7607C4.38697 46.9215 4.30863 47.2449 4.21484 47.4795C3.93114 48.1885 4.1287 49.5346 4.6875 50.6963C5.06592 51.4838 6.40484 52.8388 7.1123 53.1504C8.34997 53.6961 8.8268 53.8008 10.0771 53.8008C11.9511 53.8008 13.4858 53.2464 15.2402 51.9365C15.9873 51.3793 18.7093 49.5093 19.4727 49.0293C19.7605 48.848 20.0813 48.6246 20.1855 48.5332C20.4282 48.3191 22.134 47.4861 22.3311 47.4854C22.413 47.4854 22.6085 47.397 22.7646 47.2891C23.1032 47.0548 24.7957 46.5767 25.8975 46.4043C26.8924 46.249 29.3409 46.3414 30.2412 46.5684C30.4638 46.6242 30.6866 46.6805 30.9092 46.7363C30.829 46.7397 30.7482 46.7427 30.668 46.7461L30.6689 46.7471C30.749 46.7437 30.8291 46.7397 30.9092 46.7363C31.23 46.9023 31.4157 46.9502 31.5283 46.9502C31.6418 46.9505 31.9598 47.0708 32.2363 47.2178C32.5128 47.365 32.8502 47.4854 32.9863 47.4854C33.1224 47.4854 33.3479 47.5743 33.4883 47.6826C33.6286 47.791 33.8991 47.9332 34.0898 47.998C34.2801 48.0633 34.7854 48.3451 35.2129 48.625C35.9945 49.1374 36.1299 49.2196 37.0762 49.7627C37.3608 49.9261 37.8588 50.2515 38.1826 50.4854C38.5055 50.7187 38.8461 50.9097 38.9404 50.9102C39.0343 50.9106 39.1978 51.006 39.3027 51.1221C39.4077 51.2381 39.5914 51.3648 39.71 51.4023C39.8293 51.4406 40.1615 51.6097 40.4492 51.7793C40.7368 51.9491 41.0336 52.0879 41.1074 52.0879C41.1821 52.0884 41.4057 52.2086 41.6045 52.3555C41.8037 52.5027 42.0712 52.623 42.1992 52.623C42.3267 52.623 42.5504 52.7174 42.6963 52.832C42.8422 52.9472 43.3907 53.1471 43.9141 53.2764C44.4376 53.4056 44.9966 53.5765 45.1553 53.6562C45.5745 53.866 48.1587 53.8598 48.3359 53.6484C48.4055 53.5644 48.7227 53.4133 49.041 53.3135C49.3939 53.2022 49.6834 53.0327 49.7852 52.8779C49.8765 52.738 50.0406 52.623 50.1494 52.623C50.3701 52.6229 50.9357 52.0064 51.5107 51.1387C51.7812 50.7301 51.9189 50.3739 51.9863 49.9082C52.1907 48.4955 52.0402 46.6678 51.666 46.0312C51.37 45.5266 51.1408 45.2577 50.2422 44.3564C49.6632 43.7753 49.3366 43.5257 49.1543 43.5254C49.011 43.5254 48.7578 43.4161 48.5918 43.2822C48.4254 43.1483 47.9518 42.9628 47.54 42.8711C47.1283 42.7793 46.623 42.6148 46.417 42.5039C46.088 42.3273 45.7372 42.2977 43.5293 42.2627C41.4079 42.2294 40.9747 42.1955 40.749 42.0449C40.6019 41.9473 40.3135 41.8175 40.1074 41.7568C39.6335 41.6169 39.2609 40.9788 39.1768 40.1641C39.1268 39.6798 39.1578 39.5146 39.3643 39.1729C39.6561 38.6891 40.1991 38.1847 40.4346 38.1787C40.5258 38.1766 40.6943 38.1037 40.8086 38.0176C41.1056 37.7927 44.0166 37.7851 44.4463 38.0078C44.6106 38.0931 45.0136 38.192 45.3408 38.2266C46.5229 38.352 47.3334 38.5256 47.6602 38.7227C47.8674 38.8475 48.1947 38.9228 48.5254 38.9229C48.92 38.9229 49.1069 38.9783 49.249 39.1357C49.3548 39.2522 49.6147 39.3789 49.8271 39.417C50.0396 39.455 50.2867 39.5475 50.375 39.623C50.4637 39.6987 50.8047 39.8974 51.1338 40.0645C51.4632 40.2317 51.9285 40.4991 52.167 40.6582C52.804 41.0833 54.1001 42.4686 54.4697 43.1201C54.6464 43.4312 54.9031 43.8207 55.04 43.9854C55.177 44.1501 55.342 44.4828 55.4072 44.7246C55.4725 44.9665 55.6162 45.2411 55.7275 45.335C56.2074 45.7405 56.2471 50.8928 55.7754 51.5889C55.6892 51.716 55.454 52.1819 55.2539 52.623C55.0538 53.0646 54.7413 53.619 54.5596 53.8545C53.9599 54.6316 53.5343 55.1176 53.1641 55.4512C52.9631 55.6325 52.7207 55.8531 52.626 55.9414C52.3328 56.2149 51.5624 56.6904 51.4131 56.6904C51.3346 56.6909 51.1128 56.8076 50.9199 56.9502C50.7263 57.0931 50.3681 57.2435 50.124 57.2832C49.8795 57.3233 49.4389 57.4591 49.1445 57.585C48.6692 57.7889 48.4136 57.8138 46.8447 57.8125C45.341 57.8108 44.97 57.7765 44.332 57.5791C43.9203 57.452 43.3566 57.317 43.0801 57.2803C42.8032 57.2435 42.3554 57.0959 42.085 56.9521C41.8141 56.808 41.4705 56.6904 41.3213 56.6904C41.172 56.6903 40.928 56.5941 40.7783 56.4766C40.6292 56.359 40.4342 56.2629 40.3457 56.2627C40.1934 56.2627 39.6235 55.9567 38.6631 55.3594C38.4277 55.2132 38.0916 55.0608 37.915 55.0215C37.7384 54.9822 37.4574 54.8368 37.291 54.6973C37.1251 54.5578 36.9206 54.4434 36.8369 54.4434C36.7535 54.4434 36.6849 54.3958 36.6846 54.3379C36.6846 54.2803 36.4562 54.1108 36.1768 53.9619C35.4848 53.5938 35.0499 53.3408 34.6895 53.0977C34.5222 52.985 34.3076 52.8445 34.2129 52.7852C34.1179 52.7252 33.8653 52.5447 33.6514 52.3828C33.5213 52.2848 33.3923 52.1859 33.2627 52.0879H33.2617C32.9562 52.0878 32.7805 51.9916 32.6738 51.874C32.5677 51.7568 32.4081 51.6603 32.3193 51.6602C32.2306 51.6602 31.9613 51.5458 31.7207 51.4062C31.4805 51.2672 30.9226 51.0443 30.4814 50.9111C30.0403 50.7776 29.6265 50.6279 29.5625 50.5771C29.4984 50.5268 28.8252 50.4551 28.0654 50.418C26.8644 50.3595 26.5609 50.3812 25.7383 50.583C25.2183 50.7106 24.7125 50.8565 24.6152 50.9072C23.8932 51.2857 23.2977 51.5523 23.1738 51.5527C23.0936 51.5527 22.9402 51.6498 22.834 51.7676C22.7274 51.8851 22.5878 51.9825 22.5234 51.9834C22.4203 51.9857 21.8984 52.3028 21.1201 52.8369C20.9912 52.9253 20.6022 53.1854 20.2559 53.4141C19.9104 53.6417 19.603 53.8593 19.5723 53.8984C19.5428 53.9368 19.2545 54.1478 18.9307 54.3662C18.6073 54.5846 17.8905 55.0798 17.3389 55.4668C15.6659 56.6397 13.7077 57.5469 12.8467 57.5469C12.6674 57.5469 12.2945 57.624 12.0186 57.7178C11.424 57.9195 8.61069 57.961 8.25977 57.7734C8.14246 57.7107 7.70529 57.6068 7.28809 57.542C6.87123 57.4776 6.22747 57.2778 5.8584 57.0986C5.48933 56.9194 5.07269 56.7287 4.93359 56.6758C4.5605 56.533 3.71742 55.8749 2.89551 55.085C1.83794 54.0679 1.26848 53.1863 0.52832 51.4189C0.294517 50.8605 0.119841 49.8135 0.046875 48.5293C0.031515 48.2528 0.0157867 47.9757 0 47.6992C0.459459 45.3176 0.826192 44.2444 1.48828 43.3506C1.58129 43.2247 1.73046 43.0104 1.81836 42.873C2.2194 42.2502 3.24082 41.3028 4.1709 40.6914C5.30754 39.9447 6.43489 39.3516 6.71777 39.3516C6.82065 39.3514 6.99931 39.287 7.11523 39.209C7.32955 39.0655 8.23261 38.7554 9.30469 38.4561C11.089 37.9586 13.0266 37.6539 14.4922 37.6406C15.1152 37.6347 15.5483 37.5778 15.7217 37.4785C16.1245 37.2485 22.0871 37.2471 22.5283 37.4775C22.723 37.579 23.1372 37.6373 23.6631 37.6377C23.9393 37.6381 24.2155 37.6373 24.4912 37.6377C25.5566 37.6377 25.9222 37.5784 26.0459 37.4922C26.1625 37.412 26.6421 37.3131 27.1123 37.2734C27.8874 37.2081 29.7778 36.651 30.2666 36.3438C30.3549 36.2883 30.6305 36.1455 30.8779 36.0273C31.125 35.91 31.3558 35.7663 31.3926 35.708C31.4284 35.65 31.6388 35.5095 31.8594 35.3965C32.382 35.1302 33.7856 33.8162 34.3975 33.0205C34.6615 32.6771 34.973 32.1666 35.0908 31.8867C35.2086 31.6068 35.3999 31.1787 35.5146 30.9355C35.8248 30.2797 36.0783 28.6302 36.0059 27.7402C35.8898 26.3132 35.5326 25.0173 35.002 24.0996C34.9341 23.9819 34.6764 23.5353 34.4307 23.1074C34.1846 22.6792 33.9266 22.2939 33.8574 22.251C33.7879 22.2079 33.4758 21.8617 33.1631 21.4824C32.6157 20.8182 32.0245 20.2988 31.4707 19.9941C31.3258 19.9144 31.1162 19.7582 31.0049 19.6465C30.8931 19.5351 30.7212 19.4434 30.623 19.4434C30.5247 19.4432 30.1844 19.2963 29.8672 19.1172C29.2993 18.7966 29.2635 18.7907 27.7012 18.7783C26.4135 18.7681 26.0629 18.7984 25.8525 18.9365C25.7097 19.0304 25.4053 19.1402 25.1758 19.1816C24.9467 19.223 24.5304 19.4198 24.251 19.6182C23.9718 19.816 23.7045 19.9777 23.6553 19.9785C23.6075 19.9785 23.2826 20.2489 22.9336 20.5791C22.2813 21.1964 21.6948 21.9366 21.2285 22.7344C21.1398 22.8858 21.0507 23.038 20.9619 23.1895C20.9397 23.1354 20.9316 23.0777 20.9346 23.0176V23.0186C20.9331 23.0485 20.934 23.0779 20.9385 23.1064C20.943 23.1349 20.9509 23.1626 20.9619 23.1895C20.7123 23.5764 20.4669 24.2149 20.2549 24.8574C19.9051 25.9189 19.8693 26.1391 19.8633 27.2627C19.8573 28.4714 19.866 28.5168 20.2334 29.2383C20.5286 29.8183 20.734 30.0648 21.1904 30.3877C21.7681 30.7966 21.7756 30.7981 22.9062 30.8203C24.0232 30.8416 24.0486 30.8372 24.4385 30.5215C24.6565 30.3449 24.9827 29.995 25.1641 29.7441C25.4798 29.3077 25.4959 29.2355 25.5352 28.0322C25.5667 27.0538 25.6236 26.6688 25.7949 26.2939C26.4076 24.9529 28.3718 24.8466 29.3066 26.1035C29.537 26.4133 29.5721 26.5861 29.6045 27.5781C29.6578 29.2216 29.3933 30.7288 28.918 31.4844C28.8442 31.6021 28.6123 31.971 28.4033 32.3037C28.0108 32.9284 27.0247 33.7914 26.2559 34.1826C24.8717 34.8873 24.7739 34.9099 23.0566 34.9082C21.7869 34.9074 21.3641 34.8696 21.0693 34.7314C20.8633 34.6346 20.5507 34.5232 20.374 34.4844C19.859 34.3717 18.7986 33.8202 18.4219 33.4678C18.3059 33.3599 18.1902 33.2514 18.0742 33.1436V33.1426C17.2605 32.301 16.9481 31.805 16.6738 31.1904C16.5348 30.8782 16.3959 30.5657 16.2568 30.2539C16.1816 29.7355 16.1191 29.3468 16.0664 29.0547C16.1191 29.3468 16.1816 29.7355 16.2568 30.2539C16.0192 29.2999 15.8939 28.806 15.8252 28.541C15.6303 27.7867 15.9182 24.786 16.2441 24.1758C16.2979 24.0751 16.3778 23.7514 16.4209 23.457C16.4586 23.1996 16.5546 22.8915 16.6465 22.7197L16.7637 22.5234C16.8418 22.3746 16.9153 22.1831 16.9463 22.04C16.9876 21.8496 17.0707 21.6634 17.1309 21.626C17.191 21.5884 17.3136 21.3833 17.4023 21.1699C17.4911 20.9562 17.7028 20.6005 17.873 20.3799L18.1816 19.9785C18.6825 19.0941 19.1282 18.5279 19.4951 18.1494C20.4567 17.1584 22.0765 15.9941 22.6855 15.8564C23.0503 15.7741 23.4219 15.4224 23.4219 15.1592C23.4217 15.0387 23.0214 14.554 22.4746 14.0127C21.5475 13.0945 20.3203 11.408 20.3203 11.0518C20.32 10.9524 20.2187 10.673 20.0947 10.4297C19.907 10.0611 19.8599 9.73356 19.8164 8.48047C19.7857 7.59692 19.8103 6.79676 19.876 6.5459C20.2535 5.09542 20.4471 4.50708 20.6045 4.33301C20.7026 4.22462 20.8354 4.04845 20.8994 3.94141C21.6221 2.73383 22.541 1.78249 23.3408 1.41211C23.5328 1.32336 23.9549 1.09869 24.2783 0.913086C24.6738 0.686601 25.2145 0.507652 25.9307 0.368164C26.5165 0.254671 27.0874 0.112468 27.1992 0.0527344ZM10.6045 56.4434C10.6181 56.6952 10.6262 56.8272 10.6553 56.9199C10.6844 57.0129 10.7342 57.0672 10.8301 57.1631C10.9902 57.3233 11.0446 57.4932 10.9873 57.6143C11.0449 57.4931 10.9906 57.3226 10.8301 57.1621C10.6389 56.9709 10.6317 56.9474 10.6045 56.4434ZM10.5518 56.2119C10.5191 56.1768 10.4669 56.1796 10.3838 56.2061L10.4404 56.1914C10.4743 56.1847 10.501 56.1848 10.5225 56.1934C10.5334 56.1977 10.5425 56.204 10.5508 56.2129L10.5518 56.2119ZM9.93262 55.6426C9.98306 55.7184 10.0246 55.8025 10.0537 55.8906C10.1286 56.118 10.1853 56.2112 10.2773 56.2217C10.1854 56.2111 10.1295 56.1169 10.0547 55.8896C10.0256 55.8016 9.98298 55.7183 9.93262 55.6426ZM9.75781 55.4434C9.77964 55.4619 9.80085 55.4818 9.82129 55.5029L9.75879 55.4434C9.73701 55.4248 9.71431 55.4081 9.69141 55.3926L9.75781 55.4434ZM8.60938 55.2988V55.2998V55.2988ZM9.02051 55.1973C9.21762 55.2073 9.44664 55.2599 9.62207 55.3506L9.48242 55.29C9.33459 55.2364 9.16859 55.2048 9.02051 55.1973ZM8.66699 55.248V55.249V55.248ZM8.68945 54.5332C8.34755 54.2475 7.94846 54.1116 7.60547 54.1436C7.66765 54.1378 7.73168 54.1384 7.79688 54.1436C7.82982 54.1461 7.86303 54.1499 7.89648 54.1553C8.09558 54.1871 8.30236 54.2668 8.49805 54.3926C8.56342 54.4346 8.62719 54.4821 8.68945 54.5342C8.78669 54.6154 8.84403 54.6766 8.8584 54.7295C8.84416 54.6765 8.78687 54.6146 8.68945 54.5332ZM7.18262 54.293C7.07006 54.3718 7.00512 54.4115 6.94434 54.4092C6.97466 54.4102 7.00611 54.4012 7.04395 54.3818L7.18262 54.293ZM6.52441 53.9717C6.52431 53.9172 6.45843 53.8337 6.35645 53.7393C6.43296 53.8101 6.4886 53.8748 6.51172 53.9258C6.51936 53.9427 6.52341 53.9581 6.52344 53.9717C6.52354 53.9878 6.52949 54.0087 6.54004 54.0322C6.57169 54.1029 6.64608 54.199 6.73145 54.2764C6.82714 54.3631 6.88345 54.407 6.94434 54.4092C6.88357 54.4069 6.82698 54.3629 6.73145 54.2764C6.61778 54.1733 6.52482 54.0363 6.52441 53.9717ZM54.9248 52.9678C54.8095 53.1808 54.6958 53.3807 54.6016 53.5293C54.6958 53.3807 54.8095 53.1808 54.9248 52.9678ZM5.19922 53.0986C5.26998 53.0908 5.38888 53.127 5.52637 53.1904C5.38916 53.1272 5.27098 53.091 5.2002 53.0986H5.19922ZM4.28125 52.5156C4.37929 52.5807 4.48845 52.6698 4.58398 52.7686C4.64462 52.8311 4.7015 52.8845 4.75586 52.9287C4.78327 52.951 4.80977 52.9714 4.83594 52.9893C4.88788 53.0246 4.93787 53.0509 4.98633 53.0693L4.91309 53.0352C4.81294 52.9815 4.70564 52.8941 4.58398 52.7686C4.48843 52.6698 4.37931 52.5807 4.28125 52.5156ZM3.96289 52.3955C3.98651 52.4049 4.01356 52.4092 4.04297 52.4092L4.00098 52.4053C3.98764 52.4029 3.97471 52.4002 3.96289 52.3955ZM3.76465 52.0273C3.81771 52.1006 3.8495 52.164 3.84961 52.208C3.84961 52.2537 3.8606 52.2935 3.87988 52.3252C3.86057 52.2935 3.85061 52.2537 3.85059 52.208C3.85059 52.1493 3.79292 52.0564 3.70508 51.9512L3.76465 52.0273ZM2.78125 51.2852C2.81099 51.2669 2.86694 51.2801 2.93848 51.3145C3.01005 51.3488 3.09692 51.4046 3.18848 51.4727L3.18945 51.4717C3.0062 51.3354 2.84061 51.2484 2.78125 51.2852ZM55.665 51.4492H55.666H55.665ZM31.8271 51.2998H31.8281H31.8271ZM1.93262 50.3389C1.93758 50.3507 1.94478 50.3635 1.9541 50.377C2.01103 50.4592 2.14442 50.5681 2.29883 50.6514C2.43045 50.7224 2.52423 50.7911 2.58496 50.8643C2.6001 50.8825 2.6129 50.9011 2.62402 50.9199C2.65755 50.9767 2.67383 51.0367 2.67383 51.1025C2.67384 51.1374 2.6763 51.1687 2.68164 51.1953C2.68705 51.2221 2.6953 51.2443 2.70508 51.2607C2.71949 51.2851 2.73774 51.2962 2.75879 51.293C2.70949 51.3001 2.67383 51.2236 2.67383 51.1016C2.67368 50.9264 2.5619 50.7924 2.29883 50.6504C2.11879 50.5532 1.96736 50.4219 1.93262 50.3379V50.3389ZM52.2998 50.1973C52.2998 50.2401 52.2952 50.2852 52.2881 50.3311H52.2891C52.2962 50.2853 52.2998 50.24 52.2998 50.1973ZM0.700195 50.0322V50.0332C0.786081 50.1052 0.940758 50.1759 1.10254 50.2295C1.31857 50.301 1.54773 50.3424 1.64355 50.3164C1.47543 50.3615 0.900616 50.2002 0.700195 50.0322ZM1.89551 50.2051C1.9132 50.2286 1.92479 50.2621 1.9248 50.3057L1.91699 50.2471C1.912 50.2304 1.90427 50.2167 1.89551 50.2051ZM1.74902 50.1904C1.73659 50.2002 1.7252 50.2131 1.71484 50.2285L1.74902 50.1914C1.76157 50.1815 1.77463 50.1742 1.78809 50.1699L1.74902 50.1904ZM0.446289 49.9473C0.426799 49.9473 0.411289 49.9552 0.397461 49.9678C0.411214 49.9554 0.426975 49.9482 0.446289 49.9482C0.467301 49.9483 0.490277 49.9498 0.513672 49.9541L0.446289 49.9473ZM52.4062 49.7871C52.3989 49.7917 52.3917 49.7987 52.3848 49.8076H52.3857C52.3927 49.7988 52.3999 49.7916 52.4072 49.7871H52.4062ZM55.9961 48.7959C55.9987 48.4933 55.9961 48.1862 55.9873 47.8867C55.9961 48.1862 55.9987 48.4933 55.9961 48.7959ZM27.5234 48.124C27.57 48.1964 27.6578 48.3026 27.7666 48.4189C27.6578 48.3026 27.5699 48.1964 27.5234 48.124ZM27.4863 48.0439H27.4873H27.4863ZM27.1387 47.8936H27.1396H27.1387ZM27.1914 47.2891C27.1666 47.3397 27.1287 47.3784 27.0762 47.4102C27.1288 47.3784 27.1666 47.3397 27.1914 47.2891ZM26.9688 46.4482C26.757 46.4627 26.5792 46.4853 26.4541 46.5156C26.5791 46.4853 26.757 46.4627 26.9688 46.4482ZM55.6182 45.4424C55.6481 45.4679 55.6767 45.5114 55.7031 45.5713C55.6768 45.5117 55.6489 45.4679 55.6191 45.4424H55.6182ZM52.9707 41.5596V41.5586V41.5596ZM26.4629 40.8691H26.4639H26.4629ZM51.0264 40.1719C51.1913 40.2555 51.39 40.3641 51.5771 40.4717C51.39 40.3642 51.1922 40.2545 51.0273 40.1709L51.0264 40.1719ZM31.5254 40.0088C31.4818 40.0191 31.4333 40.0343 31.3828 40.0527C31.4834 40.016 31.5767 39.9932 31.6377 39.9932L31.5254 40.0088ZM31.7471 39.9727C31.7263 39.9791 31.7068 39.9849 31.6885 39.9883L31.7471 39.9736C31.7888 39.9606 31.8346 39.9413 31.8818 39.918L31.7471 39.9727ZM25.1865 39.2441H25.1875H25.1865ZM48.8037 39.0908H48.8047H48.8037ZM47.7959 38.9756H47.7969H47.7959ZM28.4072 37.167C28.0297 37.2699 27.654 37.3372 27.2715 37.3711C26.772 37.415 26.2685 37.5176 26.1523 37.5986C26.1364 37.6098 26.1167 37.6207 26.0938 37.6309C26.1168 37.6207 26.1363 37.6098 26.1523 37.5986C26.1669 37.5885 26.1879 37.578 26.2139 37.5674C26.2398 37.5567 26.2709 37.546 26.3066 37.5352C26.5208 37.4701 26.8979 37.404 27.2725 37.3711C27.4254 37.3575 27.5772 37.3388 27.7285 37.3145C27.8042 37.3023 27.8796 37.2884 27.9551 37.2734C28.1059 37.2436 28.2564 37.2081 28.4072 37.167ZM28.8613 37.0264H28.8623H28.8613ZM37.1348 34.8164H37.1338H37.1348ZM21.1592 34.6084H21.1602H21.1592ZM19.3076 33.8887C19.6323 34.0677 19.9854 34.2262 20.2773 34.3193C19.9853 34.2262 19.6322 34.0677 19.3076 33.8887ZM18.1543 33.1357C18.1921 33.1321 18.3672 33.2437 18.5654 33.3945C18.3676 33.244 18.1933 33.1323 18.1553 33.1357H18.1543ZM36.1201 28.1719H36.1211H36.1201ZM16.0303 25.6709C15.9 26.6084 15.8331 27.7374 15.9062 28.2773C15.8818 28.0972 15.8729 27.8516 15.877 27.5693C15.8823 27.1934 15.9103 26.7526 15.9541 26.3154C15.9979 25.8782 16.0574 25.4446 16.126 25.083L16.0303 25.6709ZM39.2666 24.415C39.2774 24.4754 39.2925 24.5392 39.3115 24.6025C39.2924 24.5389 39.2774 24.4747 39.2666 24.4141V24.415ZM16.3516 24.2832C16.3118 24.3575 16.2722 24.4666 16.2344 24.6025L16.293 24.4199C16.3124 24.3664 16.3317 24.3203 16.3516 24.2832C16.365 24.2581 16.3799 24.2188 16.3955 24.1699V24.1689C16.3798 24.2183 16.365 24.2579 16.3516 24.2832ZM16.5723 23.335C16.5534 23.4126 16.5381 23.4908 16.5273 23.5645C16.5058 23.7116 16.4753 23.8659 16.4434 23.9961L16.4902 23.7871C16.5046 23.7137 16.5175 23.6382 16.5283 23.5645C16.5391 23.4908 16.5534 23.4126 16.5723 23.335ZM34.2783 22.5967H34.2793H34.2783ZM19.0107 22.9268C18.9996 22.9331 18.9898 22.9365 18.9814 22.9385C19.0065 22.9329 19.043 22.908 19.0957 22.8643L19.0107 22.9268ZM16.9453 22.4707C16.898 22.582 16.8432 22.6881 16.792 22.7617C16.7793 22.78 16.767 22.8019 16.7539 22.8262C16.767 22.8018 16.7802 22.78 16.793 22.7617C16.8698 22.6512 16.9545 22.4679 17.0098 22.3027L16.9453 22.4707ZM21.8564 21.5381H21.8574H21.8564ZM17.1377 21.8828H17.1387H17.1377ZM17.8506 20.7168C17.7425 20.7671 17.6759 20.8903 17.5557 21.1709C17.4973 21.3072 17.433 21.439 17.375 21.541C17.433 21.439 17.4983 21.3073 17.5566 21.1709C17.6767 20.8908 17.7428 20.7672 17.8506 20.7168ZM18.627 21.2207C18.6575 21.232 18.6856 21.2445 18.7119 21.2568C18.6461 21.2258 18.5671 21.1971 18.4756 21.1738L18.627 21.2207ZM35.8965 18.7109V18.71V18.7109ZM35.0098 17.7881C35.1395 17.9209 35.2476 18.0429 35.3184 18.1406V18.1396C35.2475 18.042 35.1394 17.9198 35.0098 17.7871V17.7881ZM31.0615 16.2754H31.0625H31.0615ZM32.6914 16.0977L32.6904 16.0967L32.6914 16.0977ZM30.6992 15.3438H30.7002H30.6992ZM23.7305 15.3223V15.3232V15.3223ZM31.7139 14.7744H31.7148H31.7139ZM29.1162 11.7607C29.0664 11.8104 29.0309 11.8548 29.0088 11.8906C29.0309 11.8548 29.0664 11.8104 29.1162 11.7607ZM28.7852 4.45898C27.5807 4.07968 26.5907 4.22534 25.5078 4.94043C24.8699 5.36155 24.63 5.62035 24.2148 6.33203C23.9235 6.83237 23.9033 6.94139 23.9033 8.00879C23.9033 8.99772 23.9327 9.19131 24.126 9.4541C24.2488 9.6209 24.3805 9.88307 24.4189 10.0371C24.485 10.3036 25.573 11.3076 25.7969 11.3086C25.8545 11.3086 26.0245 11.4057 26.1738 11.5234C26.4066 11.7062 26.6078 11.7373 27.5713 11.7373C28.5974 11.7373 28.7409 11.7119 29.1885 11.4512C29.8217 11.0823 30.7011 10.4227 30.6982 10.3193C30.6974 10.2925 30.6962 10.2652 30.6953 10.2383C30.7306 10.203 30.7661 10.1671 30.8018 10.1318C31.3236 9.01866 31.3789 8.74662 31.3789 8.09766C31.3789 7.65654 31.3214 7.11409 31.251 6.89355C31.2083 6.7601 31.1657 6.62607 31.123 6.49219C30.8114 6.03645 30.6663 5.8444 30.6006 5.77051C30.5609 5.72618 30.5211 5.68105 30.4814 5.63672C29.6081 4.80814 29.2741 4.61301 28.7852 4.45898ZM29.8301 11.2139L29.8311 11.2148L29.8301 11.2139ZM24.5049 4.40527H24.5059H24.5049ZM28.6309 4.27344C28.6631 4.28176 28.6951 4.29169 28.7275 4.30078C28.6175 4.26993 28.5088 4.24178 28.4004 4.21973L28.6309 4.27344ZM24.6602 1.24023C24.6811 1.31594 24.7148 1.46277 24.751 1.63867C24.7148 1.4629 24.682 1.31595 24.6611 1.24023C24.6496 1.19827 24.6424 1.15927 24.6387 1.12305C24.6424 1.15923 24.6486 1.19832 24.6602 1.24023ZM30.3613 0.665039V0.666016V0.665039ZM28.0879 0.225586V0.224609V0.225586ZM27.2803 0.173828H27.2812H27.2803Z" />
                    </svg>
                    <!-- Organic glow behind logo on hover -->
                    <div class="absolute -inset-3 rounded-full bg-[rgba(194,210,74,0.1)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-lg pointer-events-none"></div>
                </div>
                <div class="hidden sm:flex flex-col leading-none">
                    <span class="bes-h-txt font-display text-[17px] md:text-lg font-medium tracking-wide">Bali Eling Spirit</span>
                    <span class="bes-h-txt text-[9px] font-body font-medium uppercase tracking-[0.22em] opacity-40 mt-0.5">Sacred Sanctuary</span>
                </div>
            </a>

            <!-- DESKTOP NAV — dot-expand hover effect -->
            <nav class="hidden lg:flex items-center gap-0" role="navigation" aria-label="Primary">
                <?php foreach ($menu_tree as $i => $item): $has_children = !empty($item->children); ?>
                    <div class="relative group bes-h-link-wrapper">
                        <a href="<?php echo esc_url($item->url); ?>"
                            class="bes-h-link bes-focus px-3 xl:px-4 py-2 flex items-center gap-1.5"
                            style="animation-delay:<?php echo ($i * 0.08 + 0.2); ?>s"
                            <?php echo $has_children ? 'aria-haspopup="true" aria-expanded="false"' : ''; ?>>
                            <span class="bes-h-dot"></span>
                            <span class="bes-h-txt text-[10.5px] xl:text-[11px] font-body font-bold uppercase tracking-nav"><?php echo esc_html($item->title); ?></span>
                            <?php if ($has_children): ?>
                                <i class="fa-solid fa-chevron-down text-[8px] opacity-60 ml-0.5 bes-h-txt transition-transform duration-300 group-hover:rotate-180"></i>
                            <?php endif; ?>
                            <span class="bes-keris-stripe w-10 bg-gradient-to-r from-transparent via-bes-leaf to-transparent"></span>
                        </a>

                        <?php if ($has_children): ?>
                            <div class="bes-h-dropdown">
                                <?php foreach ($item->children as $child): ?>
                                    <a href="<?php echo esc_url($child->url); ?>" class="bes-h-sublink">
                                        <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf/30 flex-shrink-0"></span>
                                        <?php echo esc_html($child->title); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>

            <!-- RIGHT: CTA + Hamburger -->
            <div class="flex items-center gap-3">
                <?php if (is_user_logged_in()) :
                    $user     = wp_get_current_user();
                    $avatar   = get_avatar_url($user->ID, ['size' => 80]);
                    $name     = esc_html($user->display_name);
                    $initials = strtoupper(mb_substr($user->display_name, 0, 1));
                    $logout   = wp_logout_url(home_url('/'));
                ?>
                    <!-- ── LOGGED IN: Avatar dropdown (Ultra-Pill) ── -->
                    <div class="relative hidden lg:block group bes-h-link-wrapper" style="animation:hdrLinkIn .5s cubic-bezier(.4,0,.2,1) .7s forwards;opacity:0">
                        <button class="bes-user-btn bes-focus flex items-center gap-3 transition-all duration-400"
                            aria-haspopup="true" aria-expanded="false" id="bes-user-btn">
                            <span class="bes-user-avatar-wrap relative flex-shrink-0">
                                <?php if ($avatar) : ?>
                                    <img src="<?php echo esc_url($avatar); ?>" alt="<?php echo $name; ?>"
                                        class="w-9 h-9 rounded-full object-cover relative z-[1]">
                                <?php else : ?>
                                    <span class="w-9 h-9 rounded-full bg-bes-leaf/20 flex items-center justify-center text-bes-leaf text-[12px] font-bold relative z-[1]"><?php echo $initials; ?></span>
                                <?php endif; ?>
                                <span class="bes-user-ring"></span>
                            </span>
                            <span class="bes-h-txt bes-user-name text-[10.5px] font-bold uppercase tracking-label max-w-[110px] xl:max-w-[160px] truncate"><?php echo $name; ?></span>
                            <span class="bes-user-chev-wrap flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-chevron-down text-[8px] bes-h-txt bes-user-chev opacity-60 transition-transform duration-400 group-hover:rotate-180" aria-hidden="true"></i>
                            </span>
                        </button>

                        <!-- Dropdown panel -->
                        <div class="bes-h-dropdown !min-w-[260px]" id="bes-user-panel">
                            <!-- Learning Area -->
                            <p class="px-4 pt-3 pb-1 text-[9px] font-bold uppercase tracking-[0.18em] text-white/25">Learning Area</p>
                            <?php
                            $learning = [
                                ['label' => 'Enrolled Courses',  'href' => '/user-account/enrolled-courses/', 'icon' => 'fa-solid fa-graduation-cap'],
                                ['label' => 'Messages',           'href' => '/user-account/chat/',             'icon' => 'fa-solid fa-comment-dots'],
                                ['label' => 'Wishlist',           'href' => '/wishlist/',                      'icon' => 'fa-solid fa-heart'],
                                ['label' => 'My Certificates',    'href' => '/user-account/my-certificates/',  'icon' => 'fa-solid fa-certificate'],
                                ['label' => 'My Orders',          'href' => '/user-account/my-orders/',        'icon' => 'fa-solid fa-bag-shopping'],
                            ];
                            foreach ($learning as $item) : ?>
                                <a href="<?php echo esc_url(home_url($item['href'])); ?>" class="bes-h-sublink">
                                    <i class="<?php echo esc_attr($item['icon']); ?> text-[9px] opacity-50 w-3.5 text-center" aria-hidden="true"></i>
                                    <?php echo esc_html($item['label']); ?>
                                </a>
                            <?php endforeach; ?>

                            <div class="my-2 border-t border-white/[.05]"></div>

                            <!-- Instructor Area (only if user has instructor cap) -->
                            <?php if (current_user_can('stm_lms_instructor') || current_user_can('administrator')) : ?>
                                <p class="px-4 pt-1 pb-1 text-[9px] font-bold uppercase tracking-[0.18em] text-white/25">Instructor Area</p>
                                <?php
                                $instructor = [
                                    ['label' => 'Dashboard',  'href' => '/user-account/',          'icon' => 'fa-solid fa-gauge-high'],
                                    ['label' => 'Add Course', 'href' => '/user-account/edit-course/', 'icon' => 'fa-solid fa-plus'],
                                    ['label' => 'Analytics',  'href' => '/user-account/analytics/', 'icon' => 'fa-solid fa-chart-line'],
                                    ['label' => 'My Sales',   'href' => '/user-account/sales/',     'icon' => 'fa-solid fa-coins'],
                                    ['label' => 'Students',   'href' => '/user-account/enrolled-students/', 'icon' => 'fa-solid fa-users'],
                                ];
                                foreach ($instructor as $item) : ?>
                                    <a href="<?php echo esc_url(home_url($item['href'])); ?>" class="bes-h-sublink">
                                        <i class="<?php echo esc_attr($item['icon']); ?> text-[9px] opacity-50 w-3.5 text-center" aria-hidden="true"></i>
                                        <?php echo esc_html($item['label']); ?>
                                    </a>
                                <?php endforeach; ?>
                                <div class="my-2 border-t border-white/[.05]"></div>
                            <?php endif; ?>

                            <!-- Settings + Logout -->
                            <a href="<?php echo esc_url(home_url('/user-account/settings')); ?>" class="bes-h-sublink">
                                <i class="fa-solid fa-gear text-[9px] opacity-50 w-3.5 text-center" aria-hidden="true"></i>
                                Settings
                            </a>
                            <a href="<?php echo esc_url($logout); ?>" class="bes-h-sublink hover:!text-red-400">
                                <i class="fa-solid fa-arrow-right-from-bracket text-[9px] opacity-50 w-3.5 text-center" aria-hidden="true"></i>
                                Logout
                            </a>
                        </div>
                    </div>

                <?php else : ?>
                    <!-- ── LOGGED OUT: Login / Sign Up ── -->
                    <a href="<?php echo esc_url(home_url('/login-register/')); ?>"
                        class="bes-h-cta hidden lg:inline-flex items-center gap-2 text-[10.5px] font-bold uppercase tracking-label px-5 py-2.5 rounded-full"
                        style="animation:hdrLinkIn .5s cubic-bezier(.4,0,.2,1) .7s forwards;opacity:0">
                        <i class="fa-regular fa-circle-user text-sm" aria-hidden="true"></i> Login / Sign Up
                    </a>
                <?php endif; ?>
                <button id="bes-burger"
                    class="bes-h-burger lg:hidden relative z-10 w-11 h-11 flex items-center justify-center rounded-xl hover:bg-white/5 transition-all duration-300"
                    aria-label="Open menu" aria-expanded="false" aria-controls="bes-drawer">
                    <div class="flex flex-col gap-[5px]" id="bes-burger-lines">
                        <span class="block w-5 h-[1.5px] bg-current rounded-full transition-all duration-300 origin-center" id="bes-bl1"></span>
                        <span class="block w-3.5 h-[1.5px] bg-current rounded-full transition-all duration-300 origin-center" id="bes-bl2"></span>
                        <span class="block w-5 h-[1.5px] bg-current rounded-full transition-all duration-300 origin-center" id="bes-bl3"></span>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Backdrop + Drawer -->
    <div id="bes-backdrop" aria-hidden="true"></div>
    <nav id="bes-drawer" role="navigation" aria-label="Mobile" aria-hidden="true">
        <!-- Drawer header -->
        <div class="flex items-center justify-between px-7 py-6 border-b border-white/[.04]">
            <div class="flex flex-col">
                <span class="font-display text-white text-xl font-medium tracking-wide"><?php echo esc_html(BES_SITE_NAME); ?></span>
                <span class="text-[9px] font-body font-medium uppercase tracking-[0.2em] text-white/25 mt-1"><?php echo esc_html(BES_TAGLINE); ?></span>
            </div>
            <button id="bes-drawer-x" class="w-10 h-10 flex items-center justify-center text-white/40 hover:!text-bes-leaf rounded-xl hover:bg-white/5 transition-all" aria-label="Close menu">
                <i class="fa-solid fa-xmark text-lg" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Drawer nav links -->
        <div class="py-4 w-full">
            <?php foreach ($menu_tree as $i => $item): $has_children = !empty($item->children); ?>
                <div class="bes-m-item-wrap w-full flex flex-col">
                    <div class="flex items-center justify-between pr-6 w-full group">
                        <a href="<?php echo esc_url($item->url); ?>"
                            class="bes-m-link flex-1"
                            style="transition-delay:<?php echo ($i * 0.06); ?>s">
                            <span class="bes-m-dot"></span>
                            <?php echo esc_html($item->title); ?>
                        </a>
                        <?php if ($has_children): ?>
                            <button class="bes-m-toggler w-12 h-12 flex items-center justify-center text-white/40 hover:!text-bes-leaf transition-colors" aria-label="Toggle sub-menu">
                                <i class="fa-solid fa-plus text-xs transition-transform duration-300"></i>
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php if ($has_children): ?>
                        <div class="bes-m-sub-wrap">
                            <div class="pt-1 pb-2">
                                <?php foreach ($item->children as $child): ?>
                                    <a href="<?php echo esc_url($child->url); ?>" class="bes-m-sublink">
                                        <span class="w-1 h-1 rounded-full bg-bes-leaf/40 flex-shrink-0"></span>
                                        <?php echo esc_html($child->title); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Drawer CTA — auth-aware -->
        <div class="px-7 pt-0 pb-5">
            <?php if (is_user_logged_in()) :
                $mu      = wp_get_current_user();
                $mav     = get_avatar_url($mu->ID, ['size' => 60]);
                $minit   = strtoupper(mb_substr($mu->display_name, 0, 1));
                $mlogout = wp_logout_url(home_url('/'));
            ?>
                <!-- Logged-in profile strip -->
                <div class="flex items-center gap-3 mb-4 p-3 rounded-xl bg-white/[.04] border border-white/[.05]">
                    <?php if ($mav) : ?>
                        <img src="<?php echo esc_url($mav); ?>" alt="" class="w-9 h-9 rounded-full object-cover ring-1 ring-bes-leaf/30">
                    <?php else : ?>
                        <span class="w-9 h-9 rounded-full bg-bes-leaf/20 flex items-center justify-center text-bes-leaf text-sm font-bold"><?php echo $minit; ?></span>
                    <?php endif; ?>
                    <div class="flex flex-col leading-none min-w-0 flex-1">
                        <span class="text-white/80 text-[12px] font-semibold truncate"><?php echo esc_html($mu->display_name); ?></span>
                        <span class="text-white/30 text-[10px] mt-0.5 truncate"><?php echo esc_html($mu->user_email); ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="<?php echo esc_url(home_url('/user-account/')); ?>"
                        class="flex-1 inline-flex items-center justify-center gap-1.5 text-bes-leaf border border-bes-leaf/40 text-[10px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-full hover:bg-bes-leaf/10 transition-all">
                        <i class="fa-solid fa-gauge-high text-xs" aria-hidden="true"></i> Dashboard
                    </a>
                    <a href="<?php echo esc_url($mlogout); ?>"
                        class="inline-flex items-center justify-center gap-1.5 text-white/30 border border-white/10 text-[10px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-full hover:!text-red-400 hover:border-red-400/30 transition-all">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs" aria-hidden="true"></i> Out
                    </a>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/login-register/')); ?>"
                    class="inline-flex items-center gap-2 text-[#C2D24A] border-[1.5px] border-[#C2D24A]/45 text-[10.5px] font-bold uppercase tracking-widest px-6 py-2.5 rounded-full hover:bg-[#C2D24A]/10 transition-all">
                    <i class="fa-regular fa-circle-user text-sm" aria-hidden="true"></i> Login / Sign Up
                </a>
            <?php endif; ?>
        </div>

        <!-- Drawer socials -->
        <div class="px-7 py-5 mt-auto border-t border-white/[.04]">
            <p class="text-[9px] uppercase tracking-[0.2em] text-white/20 font-bold mb-3">Follow Our Journey</p>
            <div class="flex items-center gap-2.5">
                <?php foreach (BES_SOCIALS as $s): ?>
                    <a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener noreferrer"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-white/[.04] text-white/35 hover:bg-bes-leaf/15 hover:!text-bes-leaf transition-all duration-300 text-xs"
                        aria-label="<?php echo esc_attr($s['platform']); ?>"><i class="<?php echo esc_attr($s['icon']); ?>" aria-hidden="true"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>
<?php
}


/* =========================================================================
 * 4. LUXURY FOOTER (wp_footer priority 10)
 * ========================================================================= */
add_action('wp_footer', 'bes_footer', 10);
function bes_footer()
{
    $c   = BES_COLORS;
    $ct  = BES_CONTACT;
    $menu_items = wp_get_nav_menu_items(48);
    if (empty($menu_items) || is_wp_error($menu_items)) {
        $menu_items = [];
        foreach (BES_NAV_LINKS as $link) {
            $item = new stdClass();
            $item->title = $link['label'];
            $item->url = $link['href'];
            $item->menu_item_parent = 0;
            $menu_items[] = $item;
        }
    }
    $soc = BES_SOCIALS;
    $yr  = date('Y');

    $nav = BES_NAV_LINKS;

    $progs = [
        ['label' => 'Healing &amp; Therapy', 'href' => '/healing-therapy-retreats'],
        ['label' => 'Retreats',              'href' => '/retreats'],
        ['label' => 'Tapa Brata',            'href' => '/program-bahasa-indonesia'],
    ];
?>
    <footer class="relative bg-bes-forest-deep text-white overflow-hidden" role="contentinfo">

        <!-- Top glow -->
        <div class="bes-ftr-glow"></div>

        <!-- Gradient border top -->
        <div class="h-[2px] w-full bg-gradient-to-r from-transparent via-bes-leaf/30 to-transparent"></div>

        <!-- Fretwork pattern strip -->
        <div class="bes-fret"></div>

        <!-- Dot texture overlay -->
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>

        <!-- ─── Newsletter CTA Strip ─── -->
        <div class="hidden relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="relative -mt-2 mb-12 lg:mb-16 py-8 px-8 md:px-12 rounded-2xl border border-white/[.05]"
                style="background:linear-gradient(135deg,rgba(38,51,32,.6),rgba(30,42,22,.8))">
                <div class="absolute inset-0 rounded-2xl opacity-30 pointer-events-none"
                    style="background:radial-gradient(ellipse at 20% 50%,rgba(194,210,74,.08),transparent 60%)"></div>
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <h3 class="font-display text-xl md:text-2xl font-medium text-white mb-1">Begin Your Sacred Journey</h3>
                        <p class="text-[13px] text-white/40 font-body">Receive wisdom, retreat updates &amp; exclusive offerings</p>
                    </div>
                    <div class="flex w-full md:w-auto md:min-w-[360px]">
                        <input type="email" placeholder="Your email address" class="bes-nl-input flex-1" aria-label="Email for newsletter">
                        <button class="bes-nl-btn">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── Main Footer Grid ─── -->
        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 pb-16">

                <!-- Brand (4 cols) -->
                <div class="lg:col-span-4">
                    <a href="/" class="inline-flex items-center gap-3 group mb-6 bes-focus text-bes-ivory" aria-label="<?php echo esc_attr(BES_SITE_NAME); ?>">
                        <div class="relative">
                            <svg class="bes-h-svg w-10 h-10 md:w-12 md:h-12 transition-transform duration-500 group-hover:scale-110"
                                viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path fill="currentColor" d="M27.1992 0.0527344C27.4013 -0.0550224 27.5602 -0.030124 29.6523 0.442383C29.8929 0.496981 30.1335 0.551297 30.374 0.605469C30.6642 0.835869 30.9016 0.935479 31.0889 0.975586C31.2756 1.01523 31.4885 1.12029 31.5625 1.20898C31.6363 1.29816 31.8682 1.45999 32.0781 1.56836C32.5734 1.82397 34.0429 3.33354 34.2656 3.81641C34.3608 4.02249 34.5523 4.39126 34.6914 4.63574C35.4341 5.94042 35.6741 8.59562 35.1836 10.083C35.0485 10.4918 34.9021 10.8752 34.8584 10.9346C34.8145 10.9935 34.7445 11.2223 34.7031 11.4434C34.6622 11.6638 34.5888 11.8438 34.541 11.8438C34.4929 11.8452 34.282 12.1098 34.0723 12.4326C33.9447 12.6289 33.8166 12.8252 33.6895 13.0215C33.023 13.8364 32.6618 14.174 32.457 14.2969C32.333 14.371 32.2085 14.4459 32.085 14.5205C32.0106 14.5358 31.9366 14.5501 31.8623 14.5654C31.9369 14.5501 32.0113 14.5359 32.0859 14.5205C32.0502 14.5558 32.0138 14.5912 31.9785 14.627C31.9428 14.6622 31.9078 14.6981 31.8721 14.7334L31.7646 14.9482C31.6602 15.2826 31.7452 15.4307 31.9785 15.627C32.1639 15.783 32.4233 15.9109 32.5557 15.9111C32.6879 15.9111 32.9096 16.0316 33.0479 16.1787C33.1855 16.3257 33.4067 16.446 33.5391 16.4463C33.7618 16.4463 35.2289 17.6669 35.4277 18.0176C35.4546 18.0649 35.481 18.1119 35.5078 18.1592C35.6503 18.2663 35.7931 18.3734 35.9355 18.4805C36.5068 19.076 37.0187 19.7233 37.459 20.4072C37.5917 20.6133 37.7997 20.9064 37.9209 21.0596C38.1189 21.3102 38.6261 22.2721 38.9307 22.9756C38.9942 23.1227 39.1153 23.3636 39.2002 23.5107C39.2851 23.6579 39.3556 23.9418 39.3564 24.1406C39.3574 24.3399 39.4522 24.6538 39.5664 24.8389C39.9619 25.4797 40.2074 28.0082 40.0107 29.4141C39.8823 30.334 39.4676 31.9078 39.1553 32.6621C38.7962 33.5288 38.7452 33.6371 38.4053 34.2568C38.2146 34.6046 37.8469 35.1589 37.5879 35.4883C37.3289 35.8177 36.9357 36.3175 36.7139 36.5986C36.4916 36.8797 36.1659 37.2017 35.9893 37.3145C35.8126 37.4267 35.4777 37.7142 35.2451 37.9531C35.0126 38.1924 34.7672 38.3887 34.7002 38.3887C34.6331 38.3889 34.489 38.4873 34.3799 38.6074C34.1286 38.8849 33.0161 39.5654 32.8135 39.5654C32.7296 39.5657 32.4979 39.686 32.2988 39.833C32.0996 39.9801 31.8434 40.1006 31.7295 40.1006C31.6156 40.1006 31.3724 40.192 31.1895 40.3037C30.6382 40.6386 28.8752 41.194 28.0479 41.293C27.7896 41.3236 27.5312 41.3527 27.2734 41.3838V41.3848C26.447 41.6659 25.1452 41.7023 19.6787 41.7373C13.3572 41.7774 12.9426 41.7919 12.0322 42.0039C10.253 42.4182 9.43168 42.6435 9.10059 42.8086C8.92015 42.8986 8.61538 43.007 8.42383 43.0488C8.232 43.0906 7.96079 43.2152 7.82031 43.3252C7.67994 43.4348 7.49274 43.5254 7.40527 43.5254C7.31712 43.526 6.94066 43.7435 6.56836 44.0098C5.48778 44.7811 4.39583 46.1598 4.38867 46.7607C4.38697 46.9215 4.30863 47.2449 4.21484 47.4795C3.93114 48.1885 4.1287 49.5346 4.6875 50.6963C5.06592 51.4838 6.40484 52.8388 7.1123 53.1504C8.34997 53.6961 8.8268 53.8008 10.0771 53.8008C11.9511 53.8008 13.4858 53.2464 15.2402 51.9365C15.9873 51.3793 18.7093 49.5093 19.4727 49.0293C19.7605 48.848 20.0813 48.6246 20.1855 48.5332C20.4282 48.3191 22.134 47.4861 22.3311 47.4854C22.413 47.4854 22.6085 47.397 22.7646 47.2891C23.1032 47.0548 24.7957 46.5767 25.8975 46.4043C26.8924 46.249 29.3409 46.3414 30.2412 46.5684C30.4638 46.6242 30.6866 46.6805 30.9092 46.7363C30.829 46.7397 30.7482 46.7427 30.668 46.7461L30.6689 46.7471C30.749 46.7437 30.8291 46.7397 30.9092 46.7363C31.23 46.9023 31.4157 46.9502 31.5283 46.9502C31.6418 46.9505 31.9598 47.0708 32.2363 47.2178C32.5128 47.365 32.8502 47.4854 32.9863 47.4854C33.1224 47.4854 33.3479 47.5743 33.4883 47.6826C33.6286 47.791 33.8991 47.9332 34.0898 47.998C34.2801 48.0633 34.7854 48.3451 35.2129 48.625C35.9945 49.1374 36.1299 49.2196 37.0762 49.7627C37.3608 49.9261 37.8588 50.2515 38.1826 50.4854C38.5055 50.7187 38.8461 50.9097 38.9404 50.9102C39.0343 50.9106 39.1978 51.006 39.3027 51.1221C39.4077 51.2381 39.5914 51.3648 39.71 51.4023C39.8293 51.4406 40.1615 51.6097 40.4492 51.7793C40.7368 51.9491 41.0336 52.0879 41.1074 52.0879C41.1821 52.0884 41.4057 52.2086 41.6045 52.3555C41.8037 52.5027 42.0712 52.623 42.1992 52.623C42.3267 52.623 42.5504 52.7174 42.6963 52.832C42.8422 52.9472 43.3907 53.1471 43.9141 53.2764C44.4376 53.4056 44.9966 53.5765 45.1553 53.6562C45.5745 53.866 48.1587 53.8598 48.3359 53.6484C48.4055 53.5644 48.7227 53.4133 49.041 53.3135C49.3939 53.2022 49.6834 53.0327 49.7852 52.8779C49.8765 52.738 50.0406 52.623 50.1494 52.623C50.3701 52.6229 50.9357 52.0064 51.5107 51.1387C51.7812 50.7301 51.9189 50.3739 51.9863 49.9082C52.1907 48.4955 52.0402 46.6678 51.666 46.0312C51.37 45.5266 51.1408 45.2577 50.2422 44.3564C49.6632 43.7753 49.3366 43.5257 49.1543 43.5254C49.011 43.5254 48.7578 43.4161 48.5918 43.2822C48.4254 43.1483 47.9518 42.9628 47.54 42.8711C47.1283 42.7793 46.623 42.6148 46.417 42.5039C46.088 42.3273 45.7372 42.2977 43.5293 42.2627C41.4079 42.2294 40.9747 42.1955 40.749 42.0449C40.6019 41.9473 40.3135 41.8175 40.1074 41.7568C39.6335 41.6169 39.2609 40.9788 39.1768 40.1641C39.1268 39.6798 39.1578 39.5146 39.3643 39.1729C39.6561 38.6891 40.1991 38.1847 40.4346 38.1787C40.5258 38.1766 40.6943 38.1037 40.8086 38.0176C41.1056 37.7927 44.0166 37.7851 44.4463 38.0078C44.6106 38.0931 45.0136 38.192 45.3408 38.2266C46.5229 38.352 47.3334 38.5256 47.6602 38.7227C47.8674 38.8475 48.1947 38.9228 48.5254 38.9229C48.92 38.9229 49.1069 38.9783 49.249 39.1357C49.3548 39.2522 49.6147 39.3789 49.8271 39.417C50.0396 39.455 50.2867 39.5475 50.375 39.623C50.4637 39.6987 50.8047 39.8974 51.1338 40.0645C51.4632 40.2317 51.9285 40.4991 52.167 40.6582C52.804 41.0833 54.1001 42.4686 54.4697 43.1201C54.6464 43.4312 54.9031 43.8207 55.04 43.9854C55.177 44.1501 55.342 44.4828 55.4072 44.7246C55.4725 44.9665 55.6162 45.2411 55.7275 45.335C56.2074 45.7405 56.2471 50.8928 55.7754 51.5889C55.6892 51.716 55.454 52.1819 55.2539 52.623C55.0538 53.0646 54.7413 53.619 54.5596 53.8545C53.9599 54.6316 53.5343 55.1176 53.1641 55.4512C52.9631 55.6325 52.7207 55.8531 52.626 55.9414C52.3328 56.2149 51.5624 56.6904 51.4131 56.6904C51.3346 56.6909 51.1128 56.8076 50.9199 56.9502C50.7263 57.0931 50.3681 57.2435 50.124 57.2832C49.8795 57.3233 49.4389 57.4591 49.1445 57.585C48.6692 57.7889 48.4136 57.8138 46.8447 57.8125C45.341 57.8108 44.97 57.7765 44.332 57.5791C43.9203 57.452 43.3566 57.317 43.0801 57.2803C42.8032 57.2435 42.3554 57.0959 42.085 56.9521C41.8141 56.808 41.4705 56.6904 41.3213 56.6904C41.172 56.6903 40.928 56.5941 40.7783 56.4766C40.6292 56.359 40.4342 56.2629 40.3457 56.2627C40.1934 56.2627 39.6235 55.9567 38.6631 55.3594C38.4277 55.2132 38.0916 55.0608 37.915 55.0215C37.7384 54.9822 37.4574 54.8368 37.291 54.6973C37.1251 54.5578 36.9206 54.4434 36.8369 54.4434C36.7535 54.4434 36.6849 54.3958 36.6846 54.3379C36.6846 54.2803 36.4562 54.1108 36.1768 53.9619C35.4848 53.5938 35.0499 53.3408 34.6895 53.0977C34.5222 52.985 34.3076 52.8445 34.2129 52.7852C34.1179 52.7252 33.8653 52.5447 33.6514 52.3828C33.5213 52.2848 33.3923 52.1859 33.2627 52.0879H33.2617C32.9562 52.0878 32.7805 51.9916 32.6738 51.874C32.5677 51.7568 32.4081 51.6603 32.3193 51.6602C32.2306 51.6602 31.9613 51.5458 31.7207 51.4062C31.4805 51.2672 30.9226 51.0443 30.4814 50.9111C30.0403 50.7776 29.6265 50.6279 29.5625 50.5771C29.4984 50.5268 28.8252 50.4551 28.0654 50.418C26.8644 50.3595 26.5609 50.3812 25.7383 50.583C25.2183 50.7106 24.7125 50.8565 24.6152 50.9072C23.8932 51.2857 23.2977 51.5523 23.1738 51.5527C23.0936 51.5527 22.9402 51.6498 22.834 51.7676C22.7274 51.8851 22.5878 51.9825 22.5234 51.9834C22.4203 51.9857 21.8984 52.3028 21.1201 52.8369C20.9912 52.9253 20.6022 53.1854 20.2559 53.4141C19.9104 53.6417 19.603 53.8593 19.5723 53.8984C19.5428 53.9368 19.2545 54.1478 18.9307 54.3662C18.6073 54.5846 17.8905 55.0798 17.3389 55.4668C15.6659 56.6397 13.7077 57.5469 12.8467 57.5469C12.6674 57.5469 12.2945 57.624 12.0186 57.7178C11.424 57.9195 8.61069 57.961 8.25977 57.7734C8.14246 57.7107 7.70529 57.6068 7.28809 57.542C6.87123 57.4776 6.22747 57.2778 5.8584 57.0986C5.48933 56.9194 5.07269 56.7287 4.93359 56.6758C4.5605 56.533 3.71742 55.8749 2.89551 55.085C1.83794 54.0679 1.26848 53.1863 0.52832 51.4189C0.294517 50.8605 0.119841 49.8135 0.046875 48.5293C0.031515 48.2528 0.0157867 47.9757 0 47.6992C0.459459 45.3176 0.826192 44.2444 1.48828 43.3506C1.58129 43.2247 1.73046 43.0104 1.81836 42.873C2.2194 42.2502 3.24082 41.3028 4.1709 40.6914C5.30754 39.9447 6.43489 39.3516 6.71777 39.3516C6.82065 39.3514 6.99931 39.287 7.11523 39.209C7.32955 39.0655 8.23261 38.7554 9.30469 38.4561C11.089 37.9586 13.0266 37.6539 14.4922 37.6406C15.1152 37.6347 15.5483 37.5778 15.7217 37.4785C16.1245 37.2485 22.0871 37.2471 22.5283 37.4775C22.723 37.579 23.1372 37.6373 23.6631 37.6377C23.9393 37.6381 24.2155 37.6373 24.4912 37.6377C25.5566 37.6377 25.9222 37.5784 26.0459 37.4922C26.1625 37.412 26.6421 37.3131 27.1123 37.2734C27.8874 37.2081 29.7778 36.651 30.2666 36.3438C30.3549 36.2883 30.6305 36.1455 30.8779 36.0273C31.125 35.91 31.3558 35.7663 31.3926 35.708C31.4284 35.65 31.6388 35.5095 31.8594 35.3965C32.382 35.1302 33.7856 33.8162 34.3975 33.0205C34.6615 32.6771 34.973 32.1666 35.0908 31.8867C35.2086 31.6068 35.3999 31.1787 35.5146 30.9355C35.8248 30.2797 36.0783 28.6302 36.0059 27.7402C35.8898 26.3132 35.5326 25.0173 35.002 24.0996C34.9341 23.9819 34.6764 23.5353 34.4307 23.1074C34.1846 22.6792 33.9266 22.2939 33.8574 22.251C33.7879 22.2079 33.4758 21.8617 33.1631 21.4824C32.6157 20.8182 32.0245 20.2988 31.4707 19.9941C31.3258 19.9144 31.1162 19.7582 31.0049 19.6465C30.8931 19.5351 30.7212 19.4434 30.623 19.4434C30.5247 19.4432 30.1844 19.2963 29.8672 19.1172C29.2993 18.7966 29.2635 18.7907 27.7012 18.7783C26.4135 18.7681 26.0629 18.7984 25.8525 18.9365C25.7097 19.0304 25.4053 19.1402 25.1758 19.1816C24.9467 19.223 24.5304 19.4198 24.251 19.6182C23.9718 19.816 23.7045 19.9777 23.6553 19.9785C23.6075 19.9785 23.2826 20.2489 22.9336 20.5791C22.2813 21.1964 21.6948 21.9366 21.2285 22.7344C21.1398 22.8858 21.0507 23.038 20.9619 23.1895C20.9397 23.1354 20.9316 23.0777 20.9346 23.0176V23.0186C20.9331 23.0485 20.934 23.0779 20.9385 23.1064C20.943 23.1349 20.9509 23.1626 20.9619 23.1895C20.7123 23.5764 20.4669 24.2149 20.2549 24.8574C19.9051 25.9189 19.8693 26.1391 19.8633 27.2627C19.8573 28.4714 19.866 28.5168 20.2334 29.2383C20.5286 29.8183 20.734 30.0648 21.1904 30.3877C21.7681 30.7966 21.7756 30.7981 22.9062 30.8203C24.0232 30.8416 24.0486 30.8372 24.4385 30.5215C24.6565 30.3449 24.9827 29.995 25.1641 29.7441C25.4798 29.3077 25.4959 29.2355 25.5352 28.0322C25.5667 27.0538 25.6236 26.6688 25.7949 26.2939C26.4076 24.9529 28.3718 24.8466 29.3066 26.1035C29.537 26.4133 29.5721 26.5861 29.6045 27.5781C29.6578 29.2216 29.3933 30.7288 28.918 31.4844C28.8442 31.6021 28.6123 31.971 28.4033 32.3037C28.0108 32.9284 27.0247 33.7914 26.2559 34.1826C24.8717 34.8873 24.7739 34.9099 23.0566 34.9082C21.7869 34.9074 21.3641 34.8696 21.0693 34.7314C20.8633 34.6346 20.5507 34.5232 20.374 34.4844C19.859 34.3717 18.7986 33.8202 18.4219 33.4678C18.3059 33.3599 18.1902 33.2514 18.0742 33.1436V33.1426C17.2605 32.301 16.9481 31.805 16.6738 31.1904C16.5348 30.8782 16.3959 30.5657 16.2568 30.2539C16.1816 29.7355 16.1191 29.3468 16.0664 29.0547C16.1191 29.3468 16.1816 29.7355 16.2568 30.2539C16.0192 29.2999 15.8939 28.806 15.8252 28.541C15.6303 27.7867 15.9182 24.786 16.2441 24.1758C16.2979 24.0751 16.3778 23.7514 16.4209 23.457C16.4586 23.1996 16.5546 22.8915 16.6465 22.7197L16.7637 22.5234C16.8418 22.3746 16.9153 22.1831 16.9463 22.04C16.9876 21.8496 17.0707 21.6634 17.1309 21.626C17.191 21.5884 17.3136 21.3833 17.4023 21.1699C17.4911 20.9562 17.7028 20.6005 17.873 20.3799L18.1816 19.9785C18.6825 19.0941 19.1282 18.5279 19.4951 18.1494C20.4567 17.1584 22.0765 15.9941 22.6855 15.8564C23.0503 15.7741 23.4219 15.4224 23.4219 15.1592C23.4217 15.0387 23.0214 14.554 22.4746 14.0127C21.5475 13.0945 20.3203 11.408 20.3203 11.0518C20.32 10.9524 20.2187 10.673 20.0947 10.4297C19.907 10.0611 19.8599 9.73356 19.8164 8.48047C19.7857 7.59692 19.8103 6.79676 19.876 6.5459C20.2535 5.09542 20.4471 4.50708 20.6045 4.33301C20.7026 4.22462 20.8354 4.04845 20.8994 3.94141C21.6221 2.73383 22.541 1.78249 23.3408 1.41211C23.5328 1.32336 23.9549 1.09869 24.2783 0.913086C24.6738 0.686601 25.2145 0.507652 25.9307 0.368164C26.5165 0.254671 27.0874 0.112468 27.1992 0.0527344ZM10.6045 56.4434C10.6181 56.6952 10.6262 56.8272 10.6553 56.9199C10.6844 57.0129 10.7342 57.0672 10.8301 57.1631C10.9902 57.3233 11.0446 57.4932 10.9873 57.6143C11.0449 57.4931 10.9906 57.3226 10.8301 57.1621C10.6389 56.9709 10.6317 56.9474 10.6045 56.4434ZM10.5518 56.2119C10.5191 56.1768 10.4669 56.1796 10.3838 56.2061L10.4404 56.1914C10.4743 56.1847 10.501 56.1848 10.5225 56.1934C10.5334 56.1977 10.5425 56.204 10.5508 56.2129L10.5518 56.2119ZM9.93262 55.6426C9.98306 55.7184 10.0246 55.8025 10.0537 55.8906C10.1286 56.118 10.1853 56.2112 10.2773 56.2217C10.1854 56.2111 10.1295 56.1169 10.0547 55.8896C10.0256 55.8016 9.98298 55.7183 9.93262 55.6426ZM9.75781 55.4434C9.77964 55.4619 9.80085 55.4818 9.82129 55.5029L9.75879 55.4434C9.73701 55.4248 9.71431 55.4081 9.69141 55.3926L9.75781 55.4434ZM8.60938 55.2988V55.2998V55.2988ZM9.02051 55.1973C9.21762 55.2073 9.44664 55.2599 9.62207 55.3506L9.48242 55.29C9.33459 55.2364 9.16859 55.2048 9.02051 55.1973ZM8.66699 55.248V55.249V55.248ZM8.68945 54.5332C8.34755 54.2475 7.94846 54.1116 7.60547 54.1436C7.66765 54.1378 7.73168 54.1384 7.79688 54.1436C7.82982 54.1461 7.86303 54.1499 7.89648 54.1553C8.09558 54.1871 8.30236 54.2668 8.49805 54.3926C8.56342 54.4346 8.62719 54.4821 8.68945 54.5342C8.78669 54.6154 8.84403 54.6766 8.8584 54.7295C8.84416 54.6765 8.78687 54.6146 8.68945 54.5332ZM7.18262 54.293C7.07006 54.3718 7.00512 54.4115 6.94434 54.4092C6.97466 54.4102 7.00611 54.4012 7.04395 54.3818L7.18262 54.293ZM6.52441 53.9717C6.52431 53.9172 6.45843 53.8337 6.35645 53.7393C6.43296 53.8101 6.4886 53.8748 6.51172 53.9258C6.51936 53.9427 6.52341 53.9581 6.52344 53.9717C6.52354 53.9878 6.52949 54.0087 6.54004 54.0322C6.57169 54.1029 6.64608 54.199 6.73145 54.2764C6.82714 54.3631 6.88345 54.407 6.94434 54.4092C6.88357 54.4069 6.82698 54.3629 6.73145 54.2764C6.61778 54.1733 6.52482 54.0363 6.52441 53.9717ZM54.9248 52.9678C54.8095 53.1808 54.6958 53.3807 54.6016 53.5293C54.6958 53.3807 54.8095 53.1808 54.9248 52.9678ZM5.19922 53.0986C5.26998 53.0908 5.38888 53.127 5.52637 53.1904C5.38916 53.1272 5.27098 53.091 5.2002 53.0986H5.19922ZM4.28125 52.5156C4.37929 52.5807 4.48845 52.6698 4.58398 52.7686C4.64462 52.8311 4.7015 52.8845 4.75586 52.9287C4.78327 52.951 4.80977 52.9714 4.83594 52.9893C4.88788 53.0246 4.93787 53.0509 4.98633 53.0693L4.91309 53.0352C4.81294 52.9815 4.70564 52.8941 4.58398 52.7686C4.48843 52.6698 4.37931 52.5807 4.28125 52.5156ZM3.96289 52.3955C3.98651 52.4049 4.01356 52.4092 4.04297 52.4092L4.00098 52.4053C3.98764 52.4029 3.97471 52.4002 3.96289 52.3955ZM3.76465 52.0273C3.81771 52.1006 3.8495 52.164 3.84961 52.208C3.84961 52.2537 3.8606 52.2935 3.87988 52.3252C3.86057 52.2935 3.85061 52.2537 3.85059 52.208C3.85059 52.1493 3.79292 52.0564 3.70508 51.9512L3.76465 52.0273ZM2.78125 51.2852C2.81099 51.2669 2.86694 51.2801 2.93848 51.3145C3.01005 51.3488 3.09692 51.4046 3.18848 51.4727L3.18945 51.4717C3.0062 51.3354 2.84061 51.2484 2.78125 51.2852ZM55.665 51.4492H55.666H55.665ZM31.8271 51.2998H31.8281H31.8271ZM1.93262 50.3389C1.93758 50.3507 1.94478 50.3635 1.9541 50.377C2.01103 50.4592 2.14442 50.5681 2.29883 50.6514C2.43045 50.7224 2.52423 50.7911 2.58496 50.8643C2.6001 50.8825 2.6129 50.9011 2.62402 50.9199C2.65755 50.9767 2.67383 51.0367 2.67383 51.1025C2.67384 51.1374 2.6763 51.1687 2.68164 51.1953C2.68705 51.2221 2.6953 51.2443 2.70508 51.2607C2.71949 51.2851 2.73774 51.2962 2.75879 51.293C2.70949 51.3001 2.67383 51.2236 2.67383 51.1016C2.67368 50.9264 2.5619 50.7924 2.29883 50.6504C2.11879 50.5532 1.96736 50.4219 1.93262 50.3379V50.3389ZM52.2998 50.1973C52.2998 50.2401 52.2952 50.2852 52.2881 50.3311H52.2891C52.2962 50.2853 52.2998 50.24 52.2998 50.1973ZM0.700195 50.0322V50.0332C0.786081 50.1052 0.940758 50.1759 1.10254 50.2295C1.31857 50.301 1.54773 50.3424 1.64355 50.3164C1.47543 50.3615 0.900616 50.2002 0.700195 50.0322ZM1.89551 50.2051C1.9132 50.2286 1.92479 50.2621 1.9248 50.3057L1.91699 50.2471C1.912 50.2304 1.90427 50.2167 1.89551 50.2051ZM1.74902 50.1904C1.73659 50.2002 1.7252 50.2131 1.71484 50.2285L1.74902 50.1914C1.76157 50.1815 1.77463 50.1742 1.78809 50.1699L1.74902 50.1904ZM0.446289 49.9473C0.426799 49.9473 0.411289 49.9552 0.397461 49.9678C0.411214 49.9554 0.426975 49.9482 0.446289 49.9482C0.467301 49.9483 0.490277 49.9498 0.513672 49.9541L0.446289 49.9473ZM52.4062 49.7871C52.3989 49.7917 52.3917 49.7987 52.3848 49.8076H52.3857C52.3927 49.7988 52.3999 49.7916 52.4072 49.7871H52.4062ZM55.9961 48.7959C55.9987 48.4933 55.9961 48.1862 55.9873 47.8867C55.9961 48.1862 55.9987 48.4933 55.9961 48.7959ZM27.5234 48.124C27.57 48.1964 27.6578 48.3026 27.7666 48.4189C27.6578 48.3026 27.5699 48.1964 27.5234 48.124ZM27.4863 48.0439H27.4873H27.4863ZM27.1387 47.8936H27.1396H27.1387ZM27.1914 47.2891C27.1666 47.3397 27.1287 47.3784 27.0762 47.4102C27.1288 47.3784 27.1666 47.3397 27.1914 47.2891ZM26.9688 46.4482C26.757 46.4627 26.5792 46.4853 26.4541 46.5156C26.5791 46.4853 26.757 46.4627 26.9688 46.4482ZM55.6182 45.4424C55.6481 45.4679 55.6767 45.5114 55.7031 45.5713C55.6768 45.5117 55.6489 45.4679 55.6191 45.4424H55.6182ZM52.9707 41.5596V41.5586V41.5596ZM26.4629 40.8691H26.4639H26.4629ZM51.0264 40.1719C51.1913 40.2555 51.39 40.3641 51.5771 40.4717C51.39 40.3642 51.1922 40.2545 51.0273 40.1709L51.0264 40.1719ZM31.5254 40.0088C31.4818 40.0191 31.4333 40.0343 31.3828 40.0527C31.4834 40.016 31.5767 39.9932 31.6377 39.9932L31.5254 40.0088ZM31.7471 39.9727C31.7263 39.9791 31.7068 39.9849 31.6885 39.9883L31.7471 39.9736C31.7888 39.9606 31.8346 39.9413 31.8818 39.918L31.7471 39.9727ZM25.1865 39.2441H25.1875H25.1865ZM48.8037 39.0908H48.8047H48.8037ZM47.7959 38.9756H47.7969H47.7959ZM28.4072 37.167C28.0297 37.2699 27.654 37.3372 27.2715 37.3711C26.772 37.415 26.2685 37.5176 26.1523 37.5986C26.1364 37.6098 26.1167 37.6207 26.0938 37.6309C26.1168 37.6207 26.1363 37.6098 26.1523 37.5986C26.1669 37.5885 26.1879 37.578 26.2139 37.5674C26.2398 37.5567 26.2709 37.546 26.3066 37.5352C26.5208 37.4701 26.8979 37.404 27.2725 37.3711C27.4254 37.3575 27.5772 37.3388 27.7285 37.3145C27.8042 37.3023 27.8796 37.2884 27.9551 37.2734C28.1059 37.2436 28.2564 37.2081 28.4072 37.167ZM28.8613 37.0264H28.8623H28.8613ZM37.1348 34.8164H37.1338H37.1348ZM21.1592 34.6084H21.1602H21.1592ZM19.3076 33.8887C19.6323 34.0677 19.9854 34.2262 20.2773 34.3193C19.9853 34.2262 19.6322 34.0677 19.3076 33.8887ZM18.1543 33.1357C18.1921 33.1321 18.3672 33.2437 18.5654 33.3945C18.3676 33.244 18.1933 33.1323 18.1553 33.1357H18.1543ZM36.1201 28.1719H36.1211H36.1201ZM16.0303 25.6709C15.9 26.6084 15.8331 27.7374 15.9062 28.2773C15.8818 28.0972 15.8729 27.8516 15.877 27.5693C15.8823 27.1934 15.9103 26.7526 15.9541 26.3154C15.9979 25.8782 16.0574 25.4446 16.126 25.083L16.0303 25.6709ZM39.2666 24.415C39.2774 24.4754 39.2925 24.5392 39.3115 24.6025C39.2924 24.5389 39.2774 24.4747 39.2666 24.4141V24.415ZM16.3516 24.2832C16.3118 24.3575 16.2722 24.4666 16.2344 24.6025L16.293 24.4199C16.3124 24.3664 16.3317 24.3203 16.3516 24.2832C16.365 24.2581 16.3799 24.2188 16.3955 24.1699V24.1689C16.3798 24.2183 16.365 24.2579 16.3516 24.2832ZM16.5723 23.335C16.5534 23.4126 16.5381 23.4908 16.5273 23.5645C16.5058 23.7116 16.4753 23.8659 16.4434 23.9961L16.4902 23.7871C16.5046 23.7137 16.5175 23.6382 16.5283 23.5645C16.5391 23.4908 16.5534 23.4126 16.5723 23.335ZM34.2783 22.5967H34.2793H34.2783ZM19.0107 22.9268C18.9996 22.9331 18.9898 22.9365 18.9814 22.9385C19.0065 22.9329 19.043 22.908 19.0957 22.8643L19.0107 22.9268ZM16.9453 22.4707C16.898 22.582 16.8432 22.6881 16.792 22.7617C16.7793 22.78 16.767 22.8019 16.7539 22.8262C16.767 22.8018 16.7802 22.78 16.793 22.7617C16.8698 22.6512 16.9545 22.4679 17.0098 22.3027L16.9453 22.4707ZM21.8564 21.5381H21.8574H21.8564ZM17.1377 21.8828H17.1387H17.1377ZM17.8506 20.7168C17.7425 20.7671 17.6759 20.8903 17.5557 21.1709C17.4973 21.3072 17.433 21.439 17.375 21.541C17.433 21.439 17.4983 21.3073 17.5566 21.1709C17.6767 20.8908 17.7428 20.7672 17.8506 20.7168ZM18.627 21.2207C18.6575 21.232 18.6856 21.2445 18.7119 21.2568C18.6461 21.2258 18.5671 21.1971 18.4756 21.1738L18.627 21.2207ZM35.8965 18.7109V18.71V18.7109ZM35.0098 17.7881C35.1395 17.9209 35.2476 18.0429 35.3184 18.1406V18.1396C35.2475 18.042 35.1394 17.9198 35.0098 17.7871V17.7881ZM31.0615 16.2754H31.0625H31.0615ZM32.6914 16.0977L32.6904 16.0967L32.6914 16.0977ZM30.6992 15.3438H30.7002H30.6992ZM23.7305 15.3223V15.3232V15.3223ZM31.7139 14.7744H31.7148H31.7139ZM29.1162 11.7607C29.0664 11.8104 29.0309 11.8548 29.0088 11.8906C29.0309 11.8548 29.0664 11.8104 29.1162 11.7607ZM28.7852 4.45898C27.5807 4.07968 26.5907 4.22534 25.5078 4.94043C24.8699 5.36155 24.63 5.62035 24.2148 6.33203C23.9235 6.83237 23.9033 6.94139 23.9033 8.00879C23.9033 8.99772 23.9327 9.19131 24.126 9.4541C24.2488 9.6209 24.3805 9.88307 24.4189 10.0371C24.485 10.3036 25.573 11.3076 25.7969 11.3086C25.8545 11.3086 26.0245 11.4057 26.1738 11.5234C26.4066 11.7062 26.6078 11.7373 27.5713 11.7373C28.5974 11.7373 28.7409 11.7119 29.1885 11.4512C29.8217 11.0823 30.7011 10.4227 30.6982 10.3193C30.6974 10.2925 30.6962 10.2652 30.6953 10.2383C30.7306 10.203 30.7661 10.1671 30.8018 10.1318C31.3236 9.01866 31.3789 8.74662 31.3789 8.09766C31.3789 7.65654 31.3214 7.11409 31.251 6.89355C31.2083 6.7601 31.1657 6.62607 31.123 6.49219C30.8114 6.03645 30.6663 5.8444 30.6006 5.77051C30.5609 5.72618 30.5211 5.68105 30.4814 5.63672C29.6081 4.80814 29.2741 4.61301 28.7852 4.45898ZM29.8301 11.2139L29.8311 11.2148L29.8301 11.2139ZM24.5049 4.40527H24.5059H24.5049ZM28.6309 4.27344C28.6631 4.28176 28.6951 4.29169 28.7275 4.30078C28.6175 4.26993 28.5088 4.24178 28.4004 4.21973L28.6309 4.27344ZM24.6602 1.24023C24.6811 1.31594 24.7148 1.46277 24.751 1.63867C24.7148 1.4629 24.682 1.31595 24.6611 1.24023C24.6496 1.19827 24.6424 1.15927 24.6387 1.12305C24.6424 1.15923 24.6486 1.19832 24.6602 1.24023ZM30.3613 0.665039V0.666016V0.665039ZM28.0879 0.225586V0.224609V0.225586ZM27.2803 0.173828H27.2812H27.2803Z" />
                            </svg>
                            <!-- Organic glow behind logo on hover -->
                            <div class="absolute -inset-3 rounded-full bg-[rgba(194,210,74,0.1)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-lg pointer-events-none"></div>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span class="font-display text-[17px] md:text-lg font-medium tracking-wide text-white"><?php echo esc_html(BES_SITE_NAME); ?></span>
                            <span class="text-[9px] font-body font-medium uppercase tracking-[0.22em] text-white/40 mt-0.5"><?php echo esc_html(BES_TAGLINE); ?></span>
                        </div>
                    </a>
                    <p class="text-sm leading-relaxed text-white/40 max-w-[360px] font-body font-light">
                        Sebuah sanctuary spiritual wellness yang berakar pada kearifan autentik Bali, melestarikan warisan suci melalui yoga, meditasi, dan ajaran Dharma untuk menghadirkan kehidupan yang lebih sadar, seimbang, dan harmonis.
                    </p>
                </div>

                <!-- Quick Links (2 cols) -->
                <div class="lg:col-span-2">
                    <h3 class="font-display text-[13px] font-medium mb-6 tracking-widest text-white/70 uppercase">Menu</h3>
                    <ul class="space-y-3">
                        <?php foreach ($nav as $item): ?>
                            <li><a href="<?php echo esc_url($item['href']); ?>" class="bes-ftr-link text-[13px] text-white/40 hover:!text-bes-leaf transition-all group pb-1">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/20 group-hover:bg-bes-leaf group-hover:shadow-[0_0_6px_rgba(194,210,74,.3)] transition-all flex-shrink-0"></span>
                                    <span><?php echo wp_kses_post($item['label']); ?></span>
                                    <span class="bes-keris-stripe w-8 bg-gradient-to-r from-bes-leaf/80 to-transparent"></span>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Programs (3 cols) -->
                <div class="lg:col-span-3">
                    <h3 class="font-display text-[13px] font-medium mb-6 tracking-widest text-white/70 uppercase">Programs</h3>
                    <ul class="space-y-3">
                        <?php foreach ($progs as $p): ?>
                            <li><a href="<?php echo esc_url($p['href']); ?>" class="bes-ftr-link text-[13px] text-white/40 hover:!text-bes-leaf transition-all group pb-1">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/20 group-hover:bg-bes-leaf group-hover:shadow-[0_0_6px_rgba(194,210,74,.3)] transition-all flex-shrink-0"></span>
                                    <span><?php echo wp_kses_post($p['label']); ?></span>
                                    <span class="bes-keris-stripe w-8 bg-gradient-to-r from-bes-leaf/80 to-transparent"></span>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact (3 cols) -->
                <div class="lg:col-span-3">
                    <h3 class="font-display text-[13px] font-medium mb-6 tracking-widest text-white/70 uppercase">Mari Terhubung</h3>
                    <ul class="space-y-4 text-[13px] text-white/40">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/[.03] border border-white/[.04] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-location-dot text-bes-leaf/50 text-[10px]" aria-hidden="true"></i>
                            </div>
                            <span class="leading-relaxed"><?php echo esc_html($ct['address']); ?></span>
                        </li>
                        <li>
                            <a href="mailto:<?php echo esc_attr($ct['email']); ?>" class="flex items-center gap-3 hover:!text-bes-leaf transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-white/[.03] border border-white/[.04] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-envelope text-bes-leaf/50 text-[10px]" aria-hidden="true"></i>
                                </div>
                                <?php echo esc_html($ct['email']); ?>
                            </a>
                        </li>
                        <li>
                            <a href="tel:<?php echo str_replace(' ', '', $ct['phone']); ?>" class="flex items-center gap-3 hover:!text-bes-leaf transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-white/[.03] border border-white/[.04] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-phone text-bes-leaf/50 text-[10px]" aria-hidden="true"></i>
                                </div>
                                <?php echo esc_html($ct['phone']); ?>
                            </a>
                        </li>
                    </ul>

                    <!-- Social orbs -->
                    <div class="flex items-center gap-2.5 mt-7">
                        <?php foreach ($soc as $s): ?>
                            <a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener noreferrer"
                                class="bes-soc-orb w-10 h-10 flex items-center justify-center rounded-full border border-white/[.06] text-white/35 text-xs"
                                aria-label="<?php echo esc_attr($s['platform']); ?>"><i class="<?php echo esc_attr($s['icon']); ?>" aria-hidden="true"></i></a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- ── Bottom bar ── -->
            <div class="border-t border-white/[.04] py-6 flex flex-col sm:flex-row sm:flex-wrap items-center justify-center sm:justify-between gap-4 text-center">
                <p class="text-[11px] text-white/25 tracking-wide font-body">
                    &copy; <?php echo $yr; ?> <?php echo esc_html(BES_SITE_NAME); ?> &mdash; All rights reserved
                </p>
                <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-[11px] text-white/25 font-body">
                    <a href="/privacy-policy" class="hover:!text-bes-leaf transition-colors">Privacy Policy</a>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <a href="/terms" class="hover:!text-bes-leaf transition-colors">Terms of Service</a>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <a href="/sitemap" class="hover:!text-bes-leaf transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
<?php
}


/* =========================================================================
 * 5. ALL VANILLA JAVASCRIPT (wp_footer priority 20)
 * =========================================================================
 *   a) Preloader with mist + circular arc progress
 *   b) Smart adaptive header detection engine
 *   c) Scroll handler + progress bar
 *   d) Mobile drawer with animated burger
 *   e) Content padding offset
 *   f) Active link highlighting
 *   g) Staggered entrance observer (bes-reveal utility)
 * ========================================================================= */
add_action('wp_footer', 'bes_scripts', 20);
function bes_scripts()
{
?>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        (function() {
            'use strict';

            /* ==============================================================
             * a) IMMERSIVE PRELOADER
             * ============================================================== */
            var pre = document.getElementById('bes-preloader');
            var arc = document.getElementById('bes-arc');
            var mist = document.getElementById('bes-mist');
            var prog = 0;
            var totalDash = 188.5; /* 2 * PI * 30 */

            if (mist) {
                for (var m = 0; m < 20; m++) {
                    var dot = document.createElement('div');
                    dot.className = 'bes-mist-dot';
                    dot.style.left = Math.random() * 100 + '%';
                    dot.style.top = 50 + Math.random() * 40 + '%';
                    dot.style.animationDuration = (3 + Math.random() * 4) + 's';
                    dot.style.animationDelay = (Math.random() * 3) + 's';
                    dot.style.width = dot.style.height = (1.5 + Math.random() * 2) + 'px';
                    mist.appendChild(dot);
                }
            }

            var pInt = setInterval(function() {
                prog += Math.random() * 15 + 6;
                if (prog > 90) prog = 90;
                if (arc) arc.style.strokeDashoffset = totalDash - (totalDash * prog / 100);
            }, 200);

            function killPre() {
                clearInterval(pInt);
                if (arc) arc.style.strokeDashoffset = '0';
                setTimeout(function() {
                    if (pre) pre.classList.add('bes-loaded');
                    setTimeout(function() {
                        if (pre && pre.parentNode) pre.parentNode.removeChild(pre);
                    }, 900);
                }, 350);
            }
            window.addEventListener('load', killPre);
            setTimeout(killPre, 4500);

            /* ==============================================================
             * b) SMART ADAPTIVE HEADER — Detection Engine
             * ============================================================== */
            var hdr = document.getElementById('bes-hdr');
            var hdrInner = document.getElementById('bes-hdr-inner');
            var scrollPrg = document.getElementById('bes-scroll-prog');
            var THRESHOLD = 60;
            var scrolled = false;
            var curMode = 'on-dark';
            var lastAutoT = 0;

            function parseColor(s) {
                if (!s) return null;
                var m = s.match(/rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*(?:,\s*([\d.]+))?\)/);
                if (!m) return null;
                return {
                    r: +m[1],
                    g: +m[2],
                    b: +m[3],
                    a: m[4] !== undefined ? +m[4] : 1
                };
            }

            function luminance(r, g, b) {
                var s = [r, g, b].map(function(v) {
                    v /= 255;
                    return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
                });
                return 0.2126 * s[0] + 0.7152 * s[1] + 0.0722 * s[2];
            }

            function setMode(mode) {
                if (curMode === mode) return;
                hdr.classList.remove('bes-hdr-on-dark', 'bes-hdr-on-light');
                hdr.classList.add('bes-hdr-' + mode);
                curMode = mode;
            }

            var themed = document.querySelectorAll('[data-bes-header]');
            var hasThemed = themed.length > 0;
            var autoMode = !hasThemed;

            if (hasThemed && 'IntersectionObserver' in window) {
                var io = new IntersectionObserver(function(entries) {
                    entries.forEach(function(e) {
                        if (e.isIntersecting && !scrolled) {
                            var val = e.target.getAttribute('data-bes-header');
                            setMode(val === 'dark' ? 'on-dark' : 'on-light');
                        }
                    });
                }, {
                    rootMargin: '0px 0px -88% 0px',
                    threshold: 0
                });
                themed.forEach(function(s) {
                    io.observe(s)
                });
            }

            /* ── Nuclear Auto-Detect Helpers ── */
            var DARK_CLASS_SIGNALS = ['bg-black', 'bg-gray-900', 'bg-gray-800', 'bg-zinc-900', 'bg-slate-900', 'bg-neutral-900', 'bg-stone-900', 'bg-bes-forest', 'bg-bes-forest-deep', 'bg-bes-forest-92', 'bg-bes-forest-80', 'bg-bes-olive', 'bg-bes-olive-dark', 'bg-bes-bark', 'dark', 'bg-dark', 'hero-dark', 'section-dark', 'is-dark', 'has-dark-bg'];
            var LIGHT_CLASS_SIGNALS = ['bg-white', 'bg-gray-50', 'bg-gray-100', 'bg-zinc-50', 'bg-slate-50', 'bg-neutral-50', 'bg-stone-50', 'bg-bes-parchment', 'bg-bes-ivory', 'bg-bes-cream', 'bg-bes-sand', 'light', 'bg-light', 'section-light', 'is-light', 'has-light-bg'];

            function checkClassSignals(el) {
                if (!el || !el.classList) return null;
                var node = el,
                    depth = 5;
                while (node && node !== document.documentElement && depth-- > 0) {
                    var classes = Array.from(node.classList || []);
                    for (var i = 0; i < DARK_CLASS_SIGNALS.length; i++) {
                        if (classes.indexOf(DARK_CLASS_SIGNALS[i]) !== -1) return 'on-dark';
                    }
                    for (var j = 0; j < LIGHT_CLASS_SIGNALS.length; j++) {
                        if (classes.indexOf(LIGHT_CLASS_SIGNALS[j]) !== -1) return 'on-light';
                    }
                    if (node.style && node.style.backgroundColor) {
                        var col = parseColor(node.style.backgroundColor);
                        if (col && col.a > 0.5) return luminance(col.r, col.g, col.b) < 0.38 ? 'on-dark' : 'on-light';
                    }
                    node = node.parentElement;
                }
                return null;
            }

            function cssDeepWalk(elements) {
                for (var i = 0; i < elements.length; i++) {
                    var n = elements[i];
                    if (!n || n === hdr || hdr.contains(n)) continue;
                    if (n.id === 'bes-preloader' || (n.classList && n.classList.contains('bes-mist'))) continue;

                    if (n.tagName === 'IMG') {
                        var cl = Array.from(n.classList || []);
                        if (cl.indexOf('object-cover') !== -1 || cl.indexOf('object-center') !== -1) return 0.12;
                        return 0.12;
                    }

                    var walk = 16,
                        node = n;
                    while (node && node !== document.documentElement && walk-- > 0) {
                        var cs = window.getComputedStyle(node);
                        if (cs.backgroundImage && cs.backgroundImage !== 'none' && cs.backgroundImage.indexOf('url(') !== -1) {
                            var filt = cs.filter || cs.webkitFilter || '';
                            var bm = filt.match(/brightness\(([\d.]+)\)/);
                            return 0.12 * (bm ? parseFloat(bm[1]) : 1);
                        }
                        if (cs.backgroundImage && cs.backgroundImage.indexOf('gradient') !== -1) {
                            var stops = cs.backgroundImage.match(/rgba?\([^)]+\)/g) || [];
                            if (stops.length) {
                                var avgLum = 0;
                                for (var s = 0; s < stops.length; s++) {
                                    var sc = parseColor(stops[s]);
                                    if (sc) avgLum += luminance(sc.r, sc.g, sc.b) * sc.a;
                                }
                                avgLum /= stops.length;
                                var r2 = node.getBoundingClientRect();
                                if (r2.width >= window.innerWidth * 0.5) return avgLum;
                            }
                        }
                        var col = parseColor(cs.backgroundColor);
                        if (col && col.a > 0.05) {
                            var rawLum = luminance(col.r, col.g, col.b);
                            var rr = node.getBoundingClientRect();
                            var isHero = rr.width >= window.innerWidth * 0.75 && rr.height >= 200;
                            if (col.a < 0.92 && isHero && rawLum < 0.2) return rawLum * col.a + 0.08 * (1 - col.a);
                            if (col.a > 0.5) return rawLum;
                        }
                        node = node.parentElement;
                    }
                }
                return null;
            }

            function probeRenderedColor(cx, cy, callback) {
                var pageSection = null;
                var candidates = document.querySelectorAll('main > section, main > div, #primary > *, .site-main > *, body > section, body > div:not(#bes-preloader):not(#bes-hdr):not(#bes-drawer):not(#bes-backdrop)');
                for (var i = 0; i < candidates.length; i++) {
                    var c = candidates[i];
                    var cr = c.getBoundingClientRect();
                    if (cr.top <= cy && cr.bottom >= cy && cr.left <= cx && cr.right >= cx) {
                        pageSection = c;
                        break;
                    }
                }
                if (!pageSection) {
                    callback(null);
                    return;
                }
                var classResult = checkClassSignals(pageSection);
                if (classResult) {
                    callback(classResult === 'on-dark' ? 0.1 : 0.9);
                    return;
                }
                var allInSection = pageSection.querySelectorAll('*');
                var sectionElements = [pageSection];
                for (var k = 0; k < Math.min(allInSection.length, 30); k++) {
                    sectionElements.push(allInSection[k]);
                }
                callback(cssDeepWalk(sectionElements));
            }

            function getTopRegionLuminance() {
                // Sample multiple points across the top ~15% of the viewport
                var sampleY = Math.round(window.innerHeight * 0.08); // 8% from top
                var samplePoints = [{
                        x: Math.round(window.innerWidth * 0.2),
                        y: sampleY
                    },
                    {
                        x: Math.round(window.innerWidth * 0.5),
                        y: sampleY
                    },
                    {
                        x: Math.round(window.innerWidth * 0.8),
                        y: sampleY
                    },
                ];

                var lumTotal = 0,
                    lumCount = 0;

                samplePoints.forEach(function(pt) {
                    var elements = (typeof document.elementsFromPoint === 'function') ?
                        document.elementsFromPoint(pt.x, pt.y) : [];

                    // Skip the header itself
                    var filtered = elements.filter(function(el) {
                        return el !== hdr && !hdr.contains(el) && el.id !== 'bes-preloader';
                    });

                    // Check class signals first
                    for (var i = 0; i < Math.min(filtered.length, 6); i++) {
                        var sig = checkClassSignals(filtered[i]);
                        if (sig) {
                            lumTotal += (sig === 'on-dark' ? 0.05 : 0.9);
                            lumCount++;
                            break;
                        }
                    }

                    // Walk elements for background/image
                    for (var j = 0; j < Math.min(filtered.length, 10); j++) {
                        var el = filtered[j];
                        if (!el || !el.style) continue;

                        var cs = window.getComputedStyle(el);

                        // Background image (photo/hero) — sample is bright if it's a sky/beach
                        if (cs.backgroundImage && cs.backgroundImage.indexOf('url(') !== -1) {
                            // Can't read pixel color cross-origin, but check brightness filter
                            var filt = cs.filter || cs.webkitFilter || '';
                            var bm = filt.match(/brightness\(([\d.]+)\)/);
                            var imgLum = 0.55 * (bm ? parseFloat(bm[1]) : 1); // assume mid-bright for photos
                            lumTotal += imgLum;
                            lumCount++;
                            break;
                        }

                        // Check for <img> tags (hero image element)
                        if (el.tagName === 'IMG') {
                            lumTotal += 0.55; // assume photo is medium-bright
                            lumCount++;
                            break;
                        }

                        // Gradient — parse first stop only (top of gradient = transparent usually)
                        if (cs.backgroundImage && cs.backgroundImage.indexOf('gradient') !== -1) {
                            var stops = cs.backgroundImage.match(/rgba?\([^)]+\)/g) || [];
                            // For "to-transparent" heroes, the TOP of the gradient is transparent
                            // Find first stop with meaningful alpha
                            for (var s = 0; s < stops.length; s++) {
                                var sc = parseColor(stops[s]);
                                if (sc && sc.a > 0.3) {
                                    lumTotal += luminance(sc.r, sc.g, sc.b);
                                    lumCount++;
                                    break;
                                }
                            }
                            if (lumCount > 0) break;
                        }

                        // Solid background color
                        var col = parseColor(cs.backgroundColor);
                        if (col && col.a > 0.5) {
                            lumTotal += luminance(col.r, col.g, col.b);
                            lumCount++;
                            break;
                        }
                    }
                });

                return lumCount > 0 ? lumTotal / lumCount : null;
            }

            function autoDetect() {
                if (!autoMode || scrolled) return;
                var now = Date.now();
                if (now - lastAutoT < 80) return;
                lastAutoT = now;

                // Use the improved top-region sampler
                var lum = getTopRegionLuminance();
                setMode((lum !== null && lum < 0.45) ? 'on-dark' : 'on-light');
            }

            // Force on-dark initially since hero is always dark
            setMode('on-dark');
            window.addEventListener('load', autoDetect);
            window.addEventListener('resize', function() {
                if (!scrolled) {
                    lastAutoT = 0;
                    autoDetect();
                }
            });

            /* ==============================================================
             * c) SCROLL HANDLER + Progress Bar
             * ============================================================== */
            var ticking = false;
            var docH = 0;

            function calcDocHeight() {
                docH = Math.max(document.body.scrollHeight - window.innerHeight, 1);
            }
            calcDocHeight();
            window.addEventListener('resize', calcDocHeight);

            function onScroll() {
                var sy = window.scrollY || window.pageYOffset;
                if (scrollPrg) scrollPrg.style.width = Math.min((sy / docH) * 100, 100) + '%';
                if (sy > THRESHOLD) {
                    if (!scrolled) {
                        scrolled = true;
                        hdr.classList.add('bes-hdr-scrolled');
                        hdrInner.classList.remove('py-5');
                        hdrInner.classList.add('py-3');
                    }
                } else {
                    if (scrolled) {
                        scrolled = false;
                        hdr.classList.remove('bes-hdr-scrolled');
                        hdrInner.classList.remove('py-3');
                        hdrInner.classList.add('py-5');
                        if (autoMode) autoDetect();
                    }
                }
                ticking = false;
            }

            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(onScroll);
                    ticking = true;
                }
            }, {
                passive: true
            });

            /* ==============================================================
             * d) MOBILE DRAWER — Animated burger morph
             * ============================================================== */
            var burger = document.getElementById('bes-burger');
            var drawer = document.getElementById('bes-drawer');
            var backdrop = document.getElementById('bes-backdrop');
            var closeBtn = document.getElementById('bes-drawer-x');
            var bl1 = document.getElementById('bes-bl1'),
                bl2 = document.getElementById('bes-bl2'),
                bl3 = document.getElementById('bes-bl3');

            function openD() {
                drawer.classList.add('open');
                backdrop.classList.add('show');
                drawer.setAttribute('aria-hidden', 'false');
                burger.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
                bl1.style.transform = 'translateY(6.5px) rotate(45deg)';
                bl2.style.opacity = '0';
                bl2.style.transform = 'translateX(-8px)';
                bl3.style.transform = 'translateY(-6.5px) rotate(-45deg)';
            }

            function closeD() {
                drawer.classList.remove('open');
                backdrop.classList.remove('show');
                drawer.setAttribute('aria-hidden', 'true');
                burger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
                bl1.style.transform = '';
                bl2.style.opacity = '';
                bl2.style.transform = '';
                bl3.style.transform = '';
            }

            if (burger) burger.addEventListener('click', function() {
                drawer.classList.contains('open') ? closeD() : openD();
            });
            if (closeBtn) closeBtn.addEventListener('click', closeD);
            if (backdrop) backdrop.addEventListener('click', closeD);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeD();
            });
            // Close drawer when clicking actual links
            drawer.querySelectorAll('a').forEach(function(a) {
                a.addEventListener('click', closeD);
            });

            /* ── User avatar dropdown click toggle (desktop touch) ── */
            var userBtn = document.getElementById('bes-user-btn');
            var userPanel = document.getElementById('bes-user-panel');
            if (userBtn && userPanel) {
                userBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var isOpen = userPanel.style.opacity === '1';
                    userPanel.style.opacity = isOpen ? '0' : '1';
                    userPanel.style.visibility = isOpen ? 'hidden' : 'visible';
                    userPanel.style.transform = isOpen ? 'translateY(10px)' : 'translateY(0)';
                    userBtn.setAttribute('aria-expanded', String(!isOpen));
                });
                document.addEventListener('click', function() {
                    userPanel.style.opacity = '0';
                    userPanel.style.visibility = 'hidden';
                    userPanel.style.transform = 'translateY(10px)';
                    userBtn.setAttribute('aria-expanded', 'false');
                });
            }

            /* ── Touch tap-to-open for desktop dropdowns (iPad/tablet) ── */
            var isTouch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
            if (isTouch) {
                document.querySelectorAll('nav .bes-h-link-wrapper').forEach(function(wrap) {
                    var dd = wrap.querySelector('.bes-h-dropdown');
                    var lk = wrap.querySelector('.bes-h-link');
                    if (!dd || !lk) return;
                    lk.addEventListener('click', function(e) {
                        if (!wrap.classList.contains('touch-open')) {
                            e.preventDefault();
                            document.querySelectorAll('.bes-h-link-wrapper.touch-open').forEach(function(w) {
                                if (w !== wrap) w.classList.remove('touch-open');
                            });
                            wrap.classList.add('touch-open');
                            lk.setAttribute('aria-expanded', 'true');
                        }
                    });
                });
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.bes-h-link-wrapper')) {
                        document.querySelectorAll('.bes-h-link-wrapper.touch-open').forEach(function(w) {
                            w.classList.remove('touch-open');
                            var l = w.querySelector('.bes-h-link');
                            if (l) l.setAttribute('aria-expanded', 'false');
                        });
                    }
                });
            }

            // Mobile Accordion Toggle Logic
            var m_togglers = document.querySelectorAll('.bes-m-toggler');
            m_togglers.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var icon = this.querySelector('i');
                    var subWrap = this.parentElement.nextElementSibling;

                    if (subWrap.classList.contains('open')) {
                        // Close this one
                        subWrap.classList.remove('open');
                        icon.classList.remove('fa-minus');
                        icon.classList.add('fa-plus');
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        // Open this one (and close others)
                        document.querySelectorAll('.bes-m-sub-wrap').forEach(function(w) {
                            w.classList.remove('open');
                        });
                        document.querySelectorAll('.bes-m-toggler i').forEach(function(i) {
                            i.classList.remove('fa-minus');
                            i.classList.add('fa-plus');
                            i.style.transform = 'rotate(0deg)';
                        });

                        subWrap.classList.add('open');
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                        icon.style.transform = 'rotate(180deg)';
                        setTimeout(function(){ try { subWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); } catch(_){} }, 350);
                    }
                });
            });

            /* ==============================================================
             * e) CONTENT PADDING for fixed header
             * ============================================================== */
            function padContent() {
                var main = document.querySelector('main') || document.querySelector('.site-main') || document.querySelector('#primary');
                if (main && hdr) {
                    var h = hdr.offsetHeight;
                    if (parseInt(getComputedStyle(main).paddingTop, 10) < h) main.style.paddingTop = h + 'px';
                }
            }
            window.addEventListener('load', padContent);
            window.addEventListener('resize', padContent);

            /* ==============================================================
             * f) ACTIVE NAV LINK highlighting
             * ============================================================== */
            var path = location.pathname.replace(/\/+$/, '') || '/';

            // ADDED .bes-ftr-link to the selector below
            document.querySelectorAll('.bes-h-link, .bes-m-link, .bes-ftr-link').forEach(function(a) {
                // Use browser's native URL parser to ensure we ONLY compare the pathname
                var lp = new URL(a.href, window.location.origin).pathname.replace(/\/+$/, '') || '/';

                if (path === lp) {
                    a.classList.add('active'); // This triggers the keris stripe

                    if (a.classList.contains('bes-m-link')) {
                        a.style.color = '#C2D24A';
                        var dot = a.querySelector('.bes-m-dot');
                        if (dot) dot.style.background = '#C2D24A';
                    }

                    // NEW: Make footer text bright green when active
                    if (a.classList.contains('bes-ftr-link')) {
                        a.classList.remove('text-white/40');
                        a.classList.add('text-bes-leaf');
                        var fdot = a.querySelector('span.w-1');
                        if (fdot) {
                            fdot.classList.remove('bg-bes-leaf/20');
                            fdot.classList.add('bg-bes-leaf', 'shadow-[0_0_6px_rgba(194,210,74,.3)]');
                        }
                    }
                }
            });

            /* ==============================================================
             * g) STAGGERED ENTRANCE OBSERVER
             * ============================================================== */
            if ('IntersectionObserver' in window) {
                var revealObs = new IntersectionObserver(function(entries) {
                    entries.forEach(function(e) {
                        if (e.isIntersecting) {
                            e.target.classList.add('bes-visible');
                            revealObs.unobserve(e.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                });
                document.querySelectorAll('.bes-reveal').forEach(function(el) {
                    revealObs.observe(el);
                });
            }
        })();
    </script>
<?php
}


/* =========================================================================
 * 6. OPTIONAL: Register WP nav menus (uncomment to enable)
 * ========================================================================= */
/*
add_action('after_setup_theme', function(){
    register_nav_menus([
        'bes-primary' => __('BES Primary Nav', 'bali-eling-spirit'),
        'bes-footer'  => __('BES Footer Nav', 'bali-eling-spirit'),
    ]);
});
*/

/* =========================================================================
 * 7. OPTIONAL: wp_body_open shim for older themes
 * ========================================================================= */
/*
add_action('after_setup_theme', function(){
    if(!function_exists('wp_body_open')){
        function wp_body_open(){ do_action('wp_body_open'); }
    }
});
*/