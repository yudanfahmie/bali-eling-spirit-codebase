<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — Snippet: Login / Register Page — Premium Stealth Revamp
 * ============================================================================
 *
 * @package BaliElingSpirit
 * @version 4.1.0  (pixel-perfect polish — universal eye-icon centering,
 *                  consistent 20px form rhythm, premium slider-blend
 *                  fade-out, robust mobile/tablet/desktop responsiveness)
 *
 * WHAT THIS FILE DOES:
 *   Surgically restyles the MasterStudy LMS authorization widget on the
 *   /login-register/ page (Elementor canvas template, page-id-517) and
 *   replaces the broken Elementor background-slideshow with a clean,
 *   self-owned Ken-Burns crossfade slideshow built from the same gallery
 *   data — but only with images that actually load.
 *
 *   ▸ FIX 1 — Eye icon mis-positioned on Sign Up password fields.
 *     Root cause: .__form-show-pass uses `position:absolute; top:50%` to
 *     center on the input. On the register form, the field's `__form-field`
 *     parent contains the input PLUS a 4-bar strength meter PLUS an
 *     explanation text node — so `top:50%` lands halfway down the entire
 *     stack (well below the input). FIX: pin eye to the input's centerline
 *     with a fixed `top: calc(0.95rem + 0.4em + 1px)` (= input padding-top
 *     + half line-height) so it ignores tall siblings below.
 *
 *   ▸ FIX 2 — Slideshow broken (only one slide cycling).
 *     Root cause: v3's slide-removal mutated Swiper's internal indices
 *     mid-flight, leaving it stuck. NEW strategy: take full ownership.
 *     1. Parse the gallery URL list from the Elementor container's
 *        `data-settings` JSON attribute.
 *     2. Pre-flight every URL with new Image() — keep only the working ones.
 *     3. Hide the original Elementor Swiper carousel.
 *     4. Inject our own self-contained Ken-Burns crossfade carousel
 *        (`#bes-slideshow`) using the surviving URLs, with:
 *        - Slow zoom + drift on each slide for cinematic feel.
 *        - Smooth opacity crossfade (1.6s) between slides.
 *        - Forest gradient vignette overlay for depth + readability.
 *        - Decorative gold-leaf top hairline + bottom caption ribbon
 *          ("BALI ELING SPIRIT • SACRED SANCTUARY") for brand polish.
 *        - Subtle indicator dots in leaf accent.
 *     5. Skill graceful degradation: if zero URLs survive, hide the
 *        whole left column entirely so the form stays balanced.
 *
 * Carry-overs from v3 (stable):
 *   • Global Style Kit tokens (Forest + Leaf + Gold + Parchment).
 *   • Glassmorphism wrapper with euphoric aurora animation.
 *   • Header dark-lock + MutationObserver.
 *   • Anti-FOUC opacity guard.
 *   • Single primary button per form state.
 *   • Native checkbox restore for "Remember me" / instructor.
 *   • Top-area padding on .e-parent so the layout clears the fixed header.
 */

if (! defined('ABSPATH')) exit;


/* =========================================================================
 * INJECT PREMIUM STYLES + JS HELPERS — wp_head priority 1
 * ========================================================================= */
add_action('wp_head', 'bes_login_register_revamp_styles', 1);
function bes_login_register_revamp_styles()
{
    /* ── Conditional: target slug only ─────────────────────────────────── */
    if (! is_page('login-register')) return;

    /* ── BES Global Style Kit v3 tokens (mirrored locally) ─────────────── */
    $forest      = '#1E2A16';
    $forest_deep = '#151E10';
    $forest_92   = '#263320';
    $olive       = '#3F5130';
    $olive_dark  = '#344528';
    $moss        = '#6B7F5A';
    $sage        = '#94A883';
    $leaf        = '#C2D24A';
    $leaf_hover  = '#AFBF38';
    $leaf_soft   = '#D8E48C';
    $gold        = '#C9A84C';
    $gold_soft   = '#E8D5A0';
    $parchment   = '#F7F4EE';
    $ivory       = '#FDFCFA';
    $bark        = '#1C2415';
?>
    <!-- ====== BES Login/Register — Premium Stealth Revamp v4.0 ====== -->
    <style id="bes-login-register-revamp">

        /* ====================================================================
         * 0. PAGE BACKDROP — Cinematic forest gradient
         * ==================================================================== */
        body.page-id-517,
        body.page-id-517 .elementor,
        body.page-id-517 .elementor-section-wrap {
            background:
                radial-gradient(ellipse 80% 60% at 50% 0%, rgba(194,210,74,0.08), transparent 60%),
                radial-gradient(ellipse 60% 50% at 100% 100%, rgba(201,168,76,0.06), transparent 60%),
                linear-gradient(180deg, <?php echo $forest_deep; ?> 0%, <?php echo $forest; ?> 100%) !important;
        }

        body.page-id-517 .elementor-element-1593160 {
            background: transparent !important;
        }

        /* ====================================================================
         * 1. TOP SAFE-ZONE — Push the WHOLE layout below the fixed header
         * ==================================================================== */
        body.page-id-517 .elementor-element.e-con.e-parent,
        body.page-id-517 > .elementor-element.e-parent,
        body.page-id-517 .elementor.elementor-517 > .e-con.e-parent {
            padding-top: clamp(110px, 13vh, 150px) !important;
            padding-bottom: clamp(40px, 6vh, 80px) !important;
        }

        body.admin-bar.page-id-517 .elementor-element.e-con.e-parent {
            padding-top: clamp(140px, 15vh, 180px) !important;
        }

        body.page-id-517 .elementor-element-1593160 {
            padding-top: 8px !important;
            padding-bottom: 24px !important;
        }

        /* ====================================================================
         * 2. SLIDESHOW TAKEOVER — Hide the broken Elementor Swiper carousel.
         *    Our own #bes-slideshow takes its place (inserted by JS below).
         * ==================================================================== */
        body.page-id-517 .elementor-element-ece31da > .elementor-background-slideshow.swiper {
            display: none !important;
            visibility: hidden !important;
        }

        /* The host container for OUR slideshow */
        body.page-id-517 .elementor-element-ece31da {
            position: relative !important;
            overflow: hidden !important;
            isolation: isolate;
        }

        /* ── PREMIUM BLEND EFFECT ────────────────────────────────────────
           Smoothly fade the slideshow's right edge into the solid forest
           page background so the carousel dissolves seamlessly into the
           layout instead of stopping at a hard vertical line.
           ──────────────────────────────────────────────────────────────── */
        body.page-id-517 .elementor-element-ece31da::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            width: clamp(60px, 12%, 180px);
            z-index: 4;
            pointer-events: none;
            background: linear-gradient(
                to right,
                transparent 0%,
                rgba(30, 42, 22, 0.55) 55%,
                <?php echo $forest; ?> 100%
            );
        }

        /* ── Custom Ken-Burns slideshow ───────────────────────────────── */
        #bes-slideshow {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(135deg,
                <?php echo $forest_deep; ?> 0%,
                <?php echo $forest; ?> 100%);
            border-radius: inherit;
        }

        #bes-slideshow .bes-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transform: scale(1.08);
            transition:
                opacity 1.6s cubic-bezier(.4, 0, .2, 1),
                transform 7s linear;
            will-change: opacity, transform;
        }

        #bes-slideshow .bes-slide.bes-active {
            opacity: 1;
            transform: scale(1.0);
            transition:
                opacity 1.6s cubic-bezier(.4, 0, .2, 1),
                transform 7s linear;
        }

        /* Cinematic vignette + leaf tint */
        #bes-slideshow::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                radial-gradient(ellipse 100% 70% at 50% 50%,
                    transparent 0%,
                    rgba(21,30,16,0.35) 70%,
                    rgba(21,30,16,0.65) 100%),
                linear-gradient(180deg,
                    rgba(21,30,16,0.30) 0%,
                    transparent 30%,
                    transparent 70%,
                    rgba(21,30,16,0.50) 100%);
            pointer-events: none;
        }

        /* Decorative gold-leaf hairline at the top */
        #bes-slideshow::after {
            content: "";
            position: absolute;
            top: 0; left: 8%; right: 8%;
            height: 1px;
            z-index: 2;
            background: linear-gradient(90deg,
                transparent 0%,
                <?php echo $leaf; ?> 30%,
                <?php echo $gold; ?> 70%,
                transparent 100%);
            opacity: 0.50;
        }

        /* Bottom caption ribbon — brand mark */
        .bes-slide-caption {
            position: absolute;
            left: 0; right: 0;
            bottom: clamp(24px, 4vh, 40px);
            z-index: 3;
            text-align: center;
            font-family: 'Plus Jakarta Sans', 'Helvetica Neue', sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: <?php echo $leaf; ?>;
            text-shadow: 0 2px 12px rgba(0,0,0,0.75);
            opacity: 0.78;
            pointer-events: none;
        }
        .bes-slide-caption::before,
        .bes-slide-caption::after {
            content: "";
            display: inline-block;
            width: 22px;
            height: 1px;
            background: <?php echo $leaf; ?>;
            margin: 0 0.85em;
            vertical-align: middle;
            opacity: 0.55;
        }

        /* Indicator dots */
        .bes-slide-dots {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: clamp(64px, 7vh, 88px);
            z-index: 3;
            display: flex;
            gap: 8px;
            pointer-events: auto;
        }
        .bes-slide-dot {
            width: 6px;
            height: 6px;
            border-radius: 12px !important;
            background: rgba(253,252,250,0.30);
            border: 1px solid rgba(253,252,250,0.20);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(.4, 0, .2, 1);
            padding: 0;
        }
        .bes-slide-dot.bes-dot-active {
            width: 22px;
            background: <?php echo $leaf; ?>;
            border-color: <?php echo $leaf; ?>;
            box-shadow: 0 0 8px rgba(194,210,74,0.45);
        }
        .bes-slide-dot:hover {
            background: rgba(194,210,74,0.55);
            border-color: rgba(194,210,74,0.55);
        }

        /* If no working images, hide the entire slideshow column */
        body.page-id-517 .elementor-element-ece31da.bes-slideshow-empty {
            display: none !important;
        }
        body.page-id-517 .elementor-element-ece31da.bes-slideshow-empty + .e-con.e-child {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* ====================================================================
         * 3. CONTAINER — Glassmorphism card + EUPHORIC AMBIENT ANIMATION
         * ==================================================================== */
        .masterstudy-authorization,
        .masterstudy-authorization.masterstudy-authorization_login,
        .masterstudy-authorization.masterstudy-authorization_register {
            font-family: 'Plus Jakarta Sans', 'Helvetica Neue', Arial, sans-serif !important;
            max-width: 460px !important;
            width: 100% !important;
            margin: 0 auto !important;
            padding: 0 !important;
            position: relative !important;
            color: <?php echo $ivory; ?> !important;
        }

        .masterstudy-authorization__wrapper {
            position: relative !important;
            background: linear-gradient(160deg,
                rgba(63,81,48,0.32) 0%,
                rgba(30,42,22,0.55) 100%) !important;
            backdrop-filter: blur(24px) saturate(140%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(140%) !important;
            border: 1px solid rgba(194,210,74,0.18) !important;
            border-radius: 20px !important;
            padding: 2.5rem 2.25rem !important;
            box-shadow:
                0 20px 60px -10px rgba(0,0,0,0.45),
                0 8px 24px -4px rgba(0,0,0,0.30),
                inset 0 1px 0 rgba(253,252,250,0.10),
                inset 0 -1px 0 rgba(194,210,74,0.04) !important;
            overflow: hidden !important;
            isolation: isolate;
        }

        /* Euphoric drifting aurora */
        .masterstudy-authorization__wrapper::before {
            content: "";
            position: absolute;
            inset: -40%;
            z-index: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(194,210,74,0.22) 0%, transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(201,168,76,0.18) 0%, transparent 45%),
                radial-gradient(circle at 50% 80%, rgba(148,168,131,0.20) 0%, transparent 50%),
                radial-gradient(circle at 10% 90%, rgba(216,228,140,0.14) 0%, transparent 40%);
            background-size: 200% 200%;
            filter: blur(28px);
            opacity: 0.85;
            animation: bes-aurora 22s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .masterstudy-authorization__wrapper::after {
            content: "";
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 1px;
            z-index: 2;
            background: linear-gradient(90deg,
                transparent 0%,
                <?php echo $leaf; ?> 35%,
                <?php echo $gold; ?> 65%,
                transparent 100%);
            opacity: 0.55;
            animation: bes-shimmer 6s ease-in-out infinite;
        }

        @keyframes bes-aurora {
            0%   { transform: translate3d(0%, 0%, 0) rotate(0deg);   filter: blur(28px) hue-rotate(0deg); }
            33%  { transform: translate3d(3%, -2%, 0) rotate(40deg); filter: blur(32px) hue-rotate(8deg); }
            66%  { transform: translate3d(-2%, 3%, 0) rotate(80deg); filter: blur(26px) hue-rotate(-6deg); }
            100% { transform: translate3d(2%, 1%, 0) rotate(120deg); filter: blur(30px) hue-rotate(4deg); }
        }

        @keyframes bes-shimmer {
            0%, 100% { opacity: 0.40; }
            50%      { opacity: 0.75; }
        }

        .masterstudy-authorization__wrapper > * {
            position: relative;
            z-index: 1;
        }

        /* ====================================================================
         * 4. HEADER — Cormorant display title with leaf accent
         * ==================================================================== */
        .masterstudy-authorization__header {
            text-align: center !important;
            margin-bottom: 1.75rem !important;
            display: block !important;
        }

        .masterstudy-authorization__header-title {
            display: block !important;
            font-family: 'Cormorant Garamond', Georgia, 'Times New Roman', serif !important;
            font-size: 2.25rem !important;
            font-weight: 500 !important;
            letter-spacing: -0.015em !important;
            color: <?php echo $ivory; ?> !important;
            line-height: 1.15 !important;
            margin: 0 !important;
        }

        .masterstudy-authorization__header::after {
            content: "WELCOME • SELAMAT DATANG";
            display: block;
            margin-top: 0.65rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.22em;
            color: <?php echo $leaf; ?>;
            opacity: 0.78;
            text-align: center;
        }

        /* ====================================================================
         * 5. SOCIAL LOGIN — Glass button + duplicate-block fix
         * ==================================================================== */
        .masterstudy-authorization__social {
            margin-bottom: 1rem !important;
            display: block !important;
        }

        .masterstudy-authorization.masterstudy-authorization_login
            #masterstudy-authorization-social-register {
            display: none !important;
        }
        .masterstudy-authorization.masterstudy-authorization_register
            #masterstudy-authorization-social-login {
            display: none !important;
        }

        .masterstudy-authorization__social-google {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.625rem !important;
            width: 100% !important;
            padding: 0.85rem 1.25rem !important;
            background: rgba(253,252,250,0.04) !important;
            border: 1px solid rgba(253,252,250,0.12) !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.02em !important;
            color: <?php echo $ivory; ?> !important;
            text-decoration: none !important;
            transition: all 0.35s cubic-bezier(.4,0,.2,1) !important;
            cursor: pointer !important;
        }

        .masterstudy-authorization__social-google:hover {
            background: rgba(194,210,74,0.10) !important;
            border-color: rgba(194,210,74,0.45) !important;
            color: <?php echo $leaf; ?> !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 18px -4px rgba(194,210,74,0.20) !important;
        }

        .masterstudy-authorization__social-google img {
            width: 18px !important;
            height: 18px !important;
            filter: brightness(1.05);
        }

        /* ====================================================================
         * 6. SEPARATOR
         * ==================================================================== */
        .masterstudy-authorization__separator {
            display: flex !important;
            align-items: center !important;
            gap: 0.875rem !important;
            margin: 1.5rem 0 1.25rem !important;
        }

        .masterstudy-authorization__separator-line {
            flex: 1 !important;
            height: 1px !important;
            background: linear-gradient(90deg,
                transparent,
                rgba(194,210,74,0.22),
                transparent) !important;
        }

        .masterstudy-authorization__separator-title {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 10px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.18em !important;
            color: rgba(253,252,250,0.50) !important;
            white-space: nowrap !important;
        }

        /* ====================================================================
         * 7. FORM FIELDS — Premium inputs with explicit vertical rhythm
         *    UNIVERSAL: applies seamlessly to BOTH Sign In and Sign Up.
         *    Fixed 20px vertical gap between every form-field for visual
         *    consistency across login_form-wrapper & register_form-wrapper.
         * ==================================================================== */
        .masterstudy-authorization__form-wrapper,
        .masterstudy-authorization__login_form-wrapper,
        .masterstudy-authorization__register_form-wrapper {
            display: flex !important;
            flex-direction: column !important;
            gap: 20px !important;
        }

        .masterstudy-authorization__form-field {
            position: relative !important;
            margin: 0 !important;
            margin-bottom: 20px !important;
            display: block !important;
        }
        .masterstudy-authorization__form-field:last-child {
            margin-bottom: 0 !important;
        }
        /* When inside a flex form-wrapper, gap handles spacing — kill margin */
        .masterstudy-authorization__form-wrapper > .masterstudy-authorization__form-field,
        .masterstudy-authorization__login_form-wrapper > .masterstudy-authorization__form-field,
        .masterstudy-authorization__register_form-wrapper > .masterstudy-authorization__form-field {
            margin-bottom: 0 !important;
        }

        .masterstudy-authorization__form-input {
            width: 100% !important;
            padding: 15px 15px 18px !important;
            background: rgba(21,30,16,0.45) !important;
            border: 1px solid rgba(253,252,250,0.10) !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.9375rem !important;
            font-weight: 400 !important;
            letter-spacing: 0.005em !important;
            color: <?php echo $ivory; ?> !important;
            line-height: 1.5 !important;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.18) !important;
            transition:
                border-color 0.3s cubic-bezier(.4,0,.2,1),
                background 0.3s cubic-bezier(.4,0,.2,1),
                box-shadow 0.3s cubic-bezier(.4,0,.2,1) !important;
            outline: none !important;
            appearance: none !important;
            -webkit-appearance: none !important;
        }

        .masterstudy-authorization__form-input::placeholder {
            color: rgba(253,252,250,0.38) !important;
            font-weight: 400 !important;
        }

        .masterstudy-authorization__form-input:hover {
            border-color: rgba(194,210,74,0.28) !important;
            background: rgba(21,30,16,0.55) !important;
        }

        .masterstudy-authorization__form-input:focus,
        .masterstudy-authorization__form-input:focus-visible {
            border-color: <?php echo $leaf; ?> !important;
            background: rgba(21,30,16,0.65) !important;
            box-shadow:
                0 0 0 3px rgba(194,210,74,0.18),
                inset 0 1px 2px rgba(0,0,0,0.20) !important;
            outline: none !important;
        }

        .masterstudy-authorization__form-input:-webkit-autofill,
        .masterstudy-authorization__form-input:-webkit-autofill:hover,
        .masterstudy-authorization__form-input:-webkit-autofill:focus {
            -webkit-text-fill-color: <?php echo $ivory; ?> !important;
            -webkit-box-shadow: 0 0 0 1000px rgba(21,30,16,0.85) inset !important;
            transition: background-color 9999s ease-in-out 0s !important;
            caret-color: <?php echo $leaf; ?>;
        }

        /* Password input — extra right padding so text never touches eye icon */
        .masterstudy-authorization__form-input_pass,
        input.masterstudy-authorization__form-input.masterstudy-authorization__form-input_pass {
            padding-right: 45px !important;
        }

        /* ── EYE ICON FIX (UNIVERSAL — Sign In + Sign Up) ─────────────────
           Pinned absolutely to the INPUT's vertical center, NOT the field's
           center, so it stays correct even when the register form adds the
           strength-meter + explainer siblings BELOW the input.

           Input metrics: padding-top 0.95rem (15.2px) + line-height
           (0.9375rem * 1.5 = 22.5px) + 2px borders → input height ≈ 53px,
           input centerline ≈ 26.5px from the top of the field.

           Geometry: position absolute, right: 15px (text padding 45px keeps
           input text well clear). top is locked to input centerline; the
           translateY(-50%) re-centers the icon box on that line.
           ──────────────────────────────────────────────────────────────── */
        .masterstudy-authorization__form-show-pass {
            position: absolute !important;
            top: 20px !important;
            right: 15px !important;
            transform: translateY(-50%) !important;
            width: 22px !important;
            height: 22px !important;
            margin: 0 !important;
            padding: 0 !important;
            cursor: pointer !important;
            opacity: 0.55 !important;
            transition: opacity 0.25s ease, color 0.25s ease !important;
            color: <?php echo $leaf; ?> !important;
            z-index: 3;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: none !important;
            line-height: 1 !important;
        }
        .masterstudy-authorization__form-show-pass:hover {
            opacity: 1 !important;
        }
        /* Color the plugin's existing eye SVG / icon font in leaf */
        .masterstudy-authorization__form-show-pass svg,
        .masterstudy-authorization__form-show-pass svg path,
        .masterstudy-authorization__form-show-pass i,
        .masterstudy-authorization__form-show-pass::before {
            color: <?php echo $leaf; ?> !important;
            fill: <?php echo $leaf; ?> !important;
            stroke: <?php echo $leaf; ?> !important;
        }

        /* Password strength meter */
        .masterstudy-authorization__strength-password {
            display: flex !important;
            gap: 4px !important;
            margin-top: 0.5rem !important;
            flex-wrap: wrap !important;
        }
        .masterstudy-authorization__strength-password__separator {
            flex: 1 !important;
            height: 3px !important;
            background: rgba(253,252,250,0.10) !important;
            border-radius: 999px !important;
            transition: background 0.3s ease !important;
        }
        .masterstudy-authorization__strength-password__label {
            width: 100% !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 11px !important;
            font-weight: 500 !important;
            color: rgba(253,252,250,0.55) !important;
            letter-spacing: 0.04em !important;
            margin-top: 0.25rem !important;
        }

        /* Password explainer text — styled, with breathing room from eye */
        .masterstudy-authorization__form-explain-pass {
            display: block !important;
            margin-top: 0.5rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 11.5px !important;
            font-weight: 400 !important;
            color: rgba(253,252,250,0.50) !important;
            line-height: 1.5 !important;
            letter-spacing: 0.01em !important;
        }

        /* ====================================================================
         * 8. ACTIONS ROW — Stacked layout
         * ==================================================================== */
        .masterstudy-authorization__actions {
            display: flex !important;
            flex-direction: column !important;
            gap: 1.25rem !important;
            margin-top: 1.75rem !important;
            align-items: stretch !important;
        }

        .masterstudy-authorization__actions-remember {
            display: flex !important;
            align-items: center !important;
            gap: 0.625rem !important;
            margin: 0 !important;
            order: 1;
        }

        .masterstudy-authorization__checkbox {
            position: relative !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 18px !important;
            height: 18px !important;
            margin: 0 !important;
            flex-shrink: 0;
        }

        .masterstudy-authorization__checkbox input[type="checkbox"],
        #masterstudy-authorization-remember,
        #masterstudy-authorization-instructor {
            -webkit-appearance: auto !important;
            -moz-appearance: auto !important;
            appearance: auto !important;
            position: static !important;
            opacity: 1 !important;
            visibility: visible !important;
            width: 18px !important;
            height: 18px !important;
            min-width: 18px !important;
            min-height: 18px !important;
            margin: 0 !important;
            padding: 0 !important;
            accent-color: <?php echo $leaf; ?> !important;
            border-radius: 4px !important;
            cursor: pointer !important;
            background: rgba(21,30,16,0.6) !important;
            border: 1px solid rgba(194,210,74,0.35) !important;
            display: inline-block !important;
            pointer-events: auto !important;
        }

        .masterstudy-authorization__checkbox-wrapper {
            display: none !important;
        }

        .masterstudy-authorization__checkbox-title,
        .masterstudy-authorization__instructor-text {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.875rem !important;
            color: rgba(253,252,250,0.78) !important;
            cursor: pointer !important;
            line-height: 1.4 !important;
            white-space: nowrap !important;
            user-select: none;
        }

        /* ====================================================================
         * 9. PRIMARY CTA BUTTON — Single per state
         * ==================================================================== */
        .masterstudy-button.masterstudy-button_style-primary,
        a.masterstudy-button.masterstudy-button_style-primary {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            padding: 1rem 1.5rem !important;
            background: linear-gradient(135deg, <?php echo $leaf; ?> 0%, <?php echo $leaf_hover; ?> 100%) !important;
            border: 1px solid <?php echo $leaf_hover; ?> !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.8125rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.16em !important;
            color: <?php echo $forest_deep; ?> !important;
            text-decoration: none !important;
            cursor: pointer !important;
            position: relative !important;
            overflow: hidden !important;
            box-shadow:
                0 8px 24px -6px rgba(194,210,74,0.45),
                0 4px 12px -2px rgba(0,0,0,0.25),
                inset 0 1px 0 rgba(253,252,250,0.30) !important;
            transition: all 0.35s cubic-bezier(.4,0,.2,1) !important;
            order: 2;
            margin: 0 !important;
        }

        .masterstudy-button.masterstudy-button_style-primary::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(253,252,250,0.20) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .masterstudy-button.masterstudy-button_style-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow:
                0 14px 32px -8px rgba(194,210,74,0.55),
                0 6px 14px -2px rgba(0,0,0,0.30),
                inset 0 1px 0 rgba(253,252,250,0.40) !important;
            background: linear-gradient(135deg, <?php echo $leaf_soft; ?> 0%, <?php echo $leaf; ?> 100%) !important;
        }

        .masterstudy-button.masterstudy-button_style-primary:hover::before {
            opacity: 1;
        }

        .masterstudy-button.masterstudy-button_style-primary:active {
            transform: translateY(0) !important;
        }

        .masterstudy-button.masterstudy-button_style-primary:focus-visible {
            outline: 2px solid <?php echo $leaf_soft; ?> !important;
            outline-offset: 3px !important;
        }

        .masterstudy-button__title {
            position: relative !important;
            z-index: 1 !important;
            font-family: inherit !important;
            color: inherit !important;
            font: inherit !important;
        }

        .masterstudy-authorization.masterstudy-authorization_login
            [data-id="masterstudy-authorization-register-button"] {
            display: none !important;
        }
        .masterstudy-authorization.masterstudy-authorization_register
            [data-id="masterstudy-authorization-login-button"] {
            display: none !important;
        }

        /* ====================================================================
         * 10. SWITCH (Sign In ↔ Sign Up ↔ Lost Password)
         * ==================================================================== */
        .masterstudy-authorization__switch {
            margin-top: 1.5rem !important;
            padding-top: 1.25rem !important;
            border-top: 1px solid rgba(253,252,250,0.08) !important;
        }

        .masterstudy-authorization__switch-wrapper {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 0.625rem !important;
            text-align: center !important;
        }

        .masterstudy-authorization__switch-account {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.875rem !important;
            color: rgba(253,252,250,0.65) !important;
        }

        .masterstudy-authorization__switch-account-title {
            margin-right: 0.375rem !important;
        }

        .masterstudy-authorization__switch-account-link {
            font-weight: 600 !important;
            color: <?php echo $leaf; ?> !important;
            text-decoration: none !important;
            position: relative !important;
            transition: color 0.25s ease !important;
        }

        .masterstudy-authorization__switch-account-link::after {
            content: "";
            position: absolute;
            left: 0; right: 0;
            bottom: -2px;
            height: 1px;
            background: <?php echo $leaf; ?>;
            transform: scaleX(0);
            transform-origin: left center;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
        }

        .masterstudy-authorization__switch-account-link:hover {
            color: <?php echo $leaf_soft; ?> !important;
        }

        .masterstudy-authorization__switch-account-link:hover::after {
            transform: scaleX(1);
        }

        .masterstudy-authorization__switch-lost-pass {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.8125rem !important;
            font-weight: 500 !important;
            color: rgba(253,252,250,0.50) !important;
            cursor: pointer !important;
            transition: color 0.25s ease !important;
            letter-spacing: 0.02em !important;
        }

        .masterstudy-authorization__switch-lost-pass:hover {
            color: <?php echo $leaf; ?> !important;
        }

        /* ====================================================================
         * 11. RESTORE-PASSWORD FORM
         * ==================================================================== */
        .masterstudy-authorization__restore-header {
            display: flex !important;
            align-items: center !important;
            gap: 0.75rem !important;
            margin-bottom: 1.25rem !important;
        }

        .masterstudy-authorization__restore-header-back {
            width: 32px !important;
            height: 32px !important;
            border-radius: 8px !important;
            background: rgba(253,252,250,0.06) !important;
            border: 1px solid rgba(253,252,250,0.10) !important;
            cursor: pointer !important;
            transition: all 0.25s ease !important;
        }
        .masterstudy-authorization__restore-header-back:hover {
            background: rgba(194,210,74,0.10) !important;
            border-color: rgba(194,210,74,0.35) !important;
        }

        .masterstudy-authorization__restore-header-title {
            font-family: 'Cormorant Garamond', Georgia, serif !important;
            font-size: 1.5rem !important;
            font-weight: 500 !important;
            color: <?php echo $ivory; ?> !important;
        }

        /* ====================================================================
         * 12. CONFIRMATION STATES
         * ==================================================================== */
        .masterstudy-authorization__send-mail {
            text-align: center !important;
            padding: 1.5rem 0.5rem !important;
        }

        .masterstudy-authorization__send-mail-icon-wrapper {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 64px !important;
            height: 64px !important;
            background: radial-gradient(circle, rgba(194,210,74,0.18) 0%, rgba(194,210,74,0.04) 70%) !important;
            border: 1px solid rgba(194,210,74,0.28) !important;
            border-radius: 50% !important;
            margin: 0 auto 1rem !important;
        }

        .masterstudy-authorization__send-mail-content-title,
        .masterstudy-authorization__send-mail-title {
            display: block !important;
            font-family: 'Cormorant Garamond', Georgia, serif !important;
            font-size: 1.5rem !important;
            font-weight: 500 !important;
            color: <?php echo $ivory; ?> !important;
            margin-bottom: 0.5rem !important;
        }

        .masterstudy-authorization__send-mail-content-subtitle,
        .masterstudy-authorization__send-mail-instructions {
            display: block !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 0.9375rem !important;
            color: rgba(253,252,250,0.65) !important;
            line-height: 1.6 !important;
        }

        /* ====================================================================
         * 13. INSTRUCTOR EXTRA FIELDS
         * ==================================================================== */
        .masterstudy-authorization__instructor {
            display: flex !important;
            align-items: center !important;
            gap: 0.625rem !important;
            margin-top: 0.5rem !important;
        }

        /* ====================================================================
         * 14. RESPONSIVE — Universal coverage: mobile, tablet, desktop
         * ==================================================================== */

        /* Tablet (≤ 1024px) — soften blend, keep eye + spacing intact */
        @media (max-width: 1024px) {
            body.page-id-517 .elementor-element-ece31da::after {
                width: clamp(40px, 8%, 100px);
                background: linear-gradient(
                    to right,
                    transparent 0%,
                    rgba(30, 42, 22, 0.45) 60%,
                    <?php echo $forest; ?> 100%
                );
            }
        }

        /* Tablet portrait / stacked layouts (≤ 768px) — slider often stacks
           ABOVE the form, so the right-edge blend is irrelevant. Switch the
           blend to fade the BOTTOM edge instead so it dissolves into the
           form column below. */
        @media (max-width: 768px) {
            body.page-id-517 .elementor-element-ece31da::after {
                top: auto;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: clamp(50px, 12vh, 120px);
                background: linear-gradient(
                    to bottom,
                    transparent 0%,
                    rgba(30, 42, 22, 0.55) 55%,
                    <?php echo $forest; ?> 100%
                );
            }
            .masterstudy-authorization__form-wrapper,
            .masterstudy-authorization__login_form-wrapper,
            .masterstudy-authorization__register_form-wrapper {
                gap: 18px !important;
            }
            .masterstudy-authorization__form-field {
                margin-bottom: 18px !important;
            }
        }

        /* Mobile (≤ 540px) — tighter spacing + adjusted eye + smaller blend */
        @media (max-width: 540px) {
            body.page-id-517 .elementor-element.e-con.e-parent {
                padding-top: clamp(90px, 14vh, 120px) !important;
            }
            body.admin-bar.page-id-517 .elementor-element.e-con.e-parent {
                padding-top: clamp(120px, 16vh, 150px) !important;
            }
            .masterstudy-authorization,
            .masterstudy-authorization.masterstudy-authorization_login,
            .masterstudy-authorization.masterstudy-authorization_register {
                margin: 0 1rem !important;
            }
            .masterstudy-authorization__wrapper {
                padding: 1.875rem 1.375rem !important;
                border-radius: 16px !important;
            }
            .masterstudy-authorization__header-title {
                font-size: 1.875rem !important;
            }
            .masterstudy-authorization__form-input {
                padding: 0.875rem 1rem !important;
                font-size: 0.9375rem !important;
            }
            /* Mobile password padding — keep clear of the eye icon */
            .masterstudy-authorization__form-input_pass,
            input.masterstudy-authorization__form-input.masterstudy-authorization__form-input_pass {
                padding-right: 42px !important;
            }
            /* Re-pin eye to the (slightly tighter) mobile input centerline */
            .masterstudy-authorization__form-show-pass {
                top: calc(0.875rem + (0.9375rem * 1.5 / 2) + 1px) !important;
                right: 12px !important;
                width: 20px !important;
                height: 20px !important;
            }
            /* Tighter consistent vertical gap on mobile */
            .masterstudy-authorization__form-wrapper,
            .masterstudy-authorization__login_form-wrapper,
            .masterstudy-authorization__register_form-wrapper {
                gap: 16px !important;
            }
            .masterstudy-authorization__form-field {
                margin-bottom: 16px !important;
            }
            .masterstudy-button.masterstudy-button_style-primary {
                padding: 0.9rem 1.25rem !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.14em !important;
            }
            /* Smaller bottom blend on mobile so it doesn't dominate */
            body.page-id-517 .elementor-element-ece31da::after {
                height: clamp(40px, 9vh, 80px);
            }
            .bes-slide-caption { font-size: 9px; letter-spacing: 0.28em; }
        }

        /* ====================================================================
         * 15. ACCESSIBILITY — Reduced motion respect
         * ==================================================================== */
        @media (prefers-reduced-motion: reduce) {
            .masterstudy-authorization__wrapper::before,
            .masterstudy-authorization__wrapper::after,
            #bes-slideshow .bes-slide {
                animation: none !important;
                transition: opacity 0.3s ease !important;
                transform: none !important;
            }
            .masterstudy-authorization *,
            .masterstudy-authorization *::before,
            .masterstudy-authorization *::after {
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }

        /* ====================================================================
         * 16. ANTI-FOUC GUARD
         * ==================================================================== */
        html:not(.bes-auth-ready) .masterstudy-authorization {
            opacity: 0;
        }
        html.bes-auth-ready .masterstudy-authorization {
            opacity: 1;
            transition: opacity 0.4s ease 0.05s;
        }

        /* ====================================================================
         * 17. HEADER DARK-LOCK CSS BACKUP
         * ==================================================================== */
        body.page-id-517 #bes-hdr .bes-h-txt,
        body.page-id-517 #bes-hdr.bes-hdr-on-light .bes-h-txt {
            color: <?php echo $ivory; ?> !important;
        }
        body.page-id-517 #bes-hdr .bes-h-svg path,
        body.page-id-517 #bes-hdr .bes-h-svg circle,
        body.page-id-517 #bes-hdr.bes-hdr-on-light .bes-h-svg path,
        body.page-id-517 #bes-hdr.bes-hdr-on-light .bes-h-svg circle {
            stroke: <?php echo $ivory; ?> !important;
            fill: <?php echo $ivory; ?> !important;
        }
        body.page-id-517 #bes-hdr .bes-h-burger {
            color: <?php echo $ivory; ?> !important;
        }
        body.page-id-517 #bes-hdr .bes-h-cta,
        body.page-id-517 #bes-hdr.bes-hdr-on-light .bes-h-cta {
            background: transparent !important;
            color: <?php echo $leaf; ?> !important;
            border: 1.5px solid rgba(194,210,74,0.45) !important;
        }
        body.page-id-517 #bes-hdr .bes-h-cta:hover,
        body.page-id-517 #bes-hdr.bes-hdr-on-light .bes-h-cta:hover {
            background: <?php echo $leaf; ?> !important;
            color: <?php echo $forest; ?> !important;
            border-color: <?php echo $leaf; ?> !important;
        }

    </style>

    <!-- ============================================================
         BES LOGIN/REGISTER — JS HELPERS
         (FOUC + header-lock + bespoke slideshow takeover)
         ============================================================ -->
    <script>
        (function () {
            var d = document.documentElement;
            var SLIDESHOW_HOST_SELECTOR = '.elementor-element-ece31da';

            /* ── 1. Anti-FOUC unlock ───────────────────────────────────── */
            d.classList.add('bes-auth-ready');

            /* ── 2. Header dark-lock + MutationObserver ────────────────── */
            function lockHeaderDark() {
                var hdr = document.getElementById('bes-hdr');
                if (!hdr) return false;
                if (!hdr.classList.contains('bes-hdr-on-dark')) {
                    hdr.classList.remove('bes-hdr-on-light');
                    hdr.classList.add('bes-hdr-on-dark');
                }
                return true;
            }

            function attachHdrObserver() {
                var hdr = document.getElementById('bes-hdr');
                if (!hdr || !('MutationObserver' in window)) return;
                var locking = false;
                var mo = new MutationObserver(function (muts) {
                    if (locking) return;
                    muts.forEach(function (m) {
                        if (m.attributeName === 'class') {
                            if (!hdr.classList.contains('bes-hdr-on-dark')) {
                                locking = true;
                                hdr.classList.remove('bes-hdr-on-light');
                                hdr.classList.add('bes-hdr-on-dark');
                                setTimeout(function () { locking = false; }, 0);
                            }
                        }
                    });
                });
                mo.observe(hdr, { attributes: true, attributeFilter: ['class'] });
            }

            /* ── 3. Bespoke Slideshow Takeover ─────────────────────────────
             *
             * Strategy:
             *   • Read the gallery URL list from the Elementor container's
             *     `data-settings` attribute (JSON).
             *   • Validate every URL with `new Image()`.
             *   • Build an independent crossfade carousel of working URLs.
             *   • Hide the original Elementor Swiper.
             *
             * No mutation of Swiper internals → cannot break Swiper state.
             * ────────────────────────────────────────────────────────────── */
            function extractGalleryURLs(host) {
                if (!host) return [];
                var raw = host.getAttribute('data-settings');
                if (!raw) return [];
                try {
                    var settings = JSON.parse(raw);
                    var gallery = settings.background_slideshow_gallery || [];
                    return gallery
                        .map(function (item) { return item && item.url ? String(item.url) : ''; })
                        .filter(Boolean);
                } catch (e) {
                    return [];
                }
            }

            function validateImages(urls, callback) {
                if (!urls.length) { callback([]); return; }
                var working = [];
                var done = 0;
                urls.forEach(function (url, idx) {
                    var img = new Image();
                    img.onload = function () {
                        working.push({ url: url, originalIndex: idx });
                        if (++done === urls.length) finalize();
                    };
                    img.onerror = function () {
                        if (++done === urls.length) finalize();
                    };
                    img.src = url;
                });

                /* Safety timeout — never hang */
                setTimeout(function () {
                    if (done < urls.length) finalize();
                }, 8000);

                var finalized = false;
                function finalize() {
                    if (finalized) return;
                    finalized = true;
                    /* Preserve original gallery order */
                    working.sort(function (a, b) { return a.originalIndex - b.originalIndex; });
                    callback(working.map(function (w) { return w.url; }));
                }
            }

            function buildSlideshow(host, workingUrls) {
                /* Hide the original Elementor Swiper (CSS already does this
                   too, but belt-and-suspenders for fast paint). */
                var oldSwiper = host.querySelector('.elementor-background-slideshow');
                if (oldSwiper) {
                    oldSwiper.style.display = 'none';
                    oldSwiper.style.visibility = 'hidden';
                }

                if (!workingUrls.length) {
                    host.classList.add('bes-slideshow-empty');
                    return;
                }

                /* If our slideshow already exists (e.g. re-run on load),
                   destroy it before rebuilding. */
                var existing = host.querySelector('#bes-slideshow');
                if (existing) existing.remove();
                var existingCap = host.querySelector('.bes-slide-caption');
                if (existingCap) existingCap.remove();
                var existingDots = host.querySelector('.bes-slide-dots');
                if (existingDots) existingDots.remove();

                var slideshow = document.createElement('div');
                slideshow.id = 'bes-slideshow';

                var slides = workingUrls.map(function (url, idx) {
                    var s = document.createElement('div');
                    s.className = 'bes-slide';
                    s.style.backgroundImage = 'url("' + url.replace(/"/g, '\\"') + '")';
                    if (idx === 0) s.classList.add('bes-active');
                    slideshow.appendChild(s);
                    return s;
                });

                /* Caption + dots — only when more than one slide */
                var caption = document.createElement('div');
                caption.className = 'bes-slide-caption';
                caption.textContent = 'BALI ELING SPIRIT \u2022 SACRED SANCTUARY';

                host.appendChild(slideshow);
                host.appendChild(caption);

                if (workingUrls.length > 1) {
                    var dotsWrap = document.createElement('div');
                    dotsWrap.className = 'bes-slide-dots';
                    var dots = workingUrls.map(function (_, idx) {
                        var dot = document.createElement('button');
                        dot.type = 'button';
                        dot.className = 'bes-slide-dot' + (idx === 0 ? ' bes-dot-active' : '');
                        dot.setAttribute('aria-label', 'Go to slide ' + (idx + 1));
                        dot.addEventListener('click', function () { goTo(idx, true); });
                        dotsWrap.appendChild(dot);
                        return dot;
                    });
                    host.appendChild(dotsWrap);

                    var current = 0;
                    var timerId = null;
                    var INTERVAL = 5500;  /* ms between slide changes */

                    function goTo(idx, manual) {
                        if (idx === current) return;
                        slides[current].classList.remove('bes-active');
                        dots[current].classList.remove('bes-dot-active');
                        current = idx;
                        slides[current].classList.add('bes-active');
                        dots[current].classList.add('bes-dot-active');
                        if (manual) restart();
                    }

                    function next() { goTo((current + 1) % slides.length); }
                    function start() { timerId = setInterval(next, INTERVAL); }
                    function restart() {
                        if (timerId) clearInterval(timerId);
                        start();
                    }
                    start();

                    /* Pause on hover for considered viewing */
                    host.addEventListener('mouseenter', function () {
                        if (timerId) { clearInterval(timerId); timerId = null; }
                    });
                    host.addEventListener('mouseleave', function () {
                        if (!timerId) start();
                    });
                }
            }

            function initBespokeSlideshow() {
                var host = document.querySelector(SLIDESHOW_HOST_SELECTOR);
                if (!host) return;

                /* Idempotency guard */
                if (host.dataset.besSlideshowInit === '1') return;
                host.dataset.besSlideshowInit = '1';

                var urls = extractGalleryURLs(host);
                if (!urls.length) {
                    host.classList.add('bes-slideshow-empty');
                    return;
                }

                validateImages(urls, function (workingUrls) {
                    buildSlideshow(host, workingUrls);
                });
            }

            /* ── Boot sequence ─────────────────────────────────────────── */
            function boot() {
                lockHeaderDark();
                attachHdrObserver();
                initBespokeSlideshow();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', boot);
            } else {
                boot();
            }

            /* Re-assert header lock on full window load too */
            window.addEventListener('load', function () {
                lockHeaderDark();
                /* Slideshow is idempotent — safe to re-run */
                initBespokeSlideshow();
            });
        })();
    </script>
<?php
}