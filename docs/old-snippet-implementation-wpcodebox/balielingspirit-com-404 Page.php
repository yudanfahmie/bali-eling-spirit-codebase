<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Snippet 404: Sacred Cave 404 Handler
 * ============================================================================
 *
 * WHAT THIS FILE DOES:
 *   Overrides WordPress's default 404 behaviour with a cinematic,
 *   atmosphere-rich "lost in the sacred cave" experience. Fully
 *   self-contained — uses the existing BES design-system tokens
 *   (colors, fonts, social links, nav) already declared in Snippet 1.
 *
 * ★ DESIGN CONCEPT — "Goa Tirta" (Sacred Water Cave):
 *   Visitor lands on a darkened cave mouth scene with:
 *   • Animated torch-flame particles casting warm amber glow
 *   • Stalactite drip animation along the top edge
 *   • Floating lotus petals drifting down
 *   • Ancient stone-carved "404" numeral with mossy texture shimmer
 *   • Soft bioluminescent pools of light (teal-leaf palette)
 *   • Sacred Sanskrit "Aum" / Balinese Aksara watermark pulse
 *   • Clear, poetic CTA to find the way back
 *   • Smart redirect suggestions powered by fuzzy path matching
 *
 * RENDER STRATEGY — Output Buffer Injection:
 *   Instead of wp_footer hooks (which always land AFTER Snippet 1's <footer>),
 *   we start an output buffer on template_redirect, then on PHP shutdown we do
 *   a single str_replace() to splice the 404 block directly before the first
 *   <footer tag in the final HTML stream. This is theme-agnostic and immune to
 *   hook priority races — the content always appears above the site footer,
 *   exactly where it belongs in the document flow.
 *
 * HOOKS:
 *   template_redirect      → Starts ob_start() + registers shutdown injector
 *   wp_head (priority 2)   → Injects 404-specific CSS (only on 404)
 *   shutdown (priority 999)→ ob_get_clean() → str_replace → echo final HTML
 *
 * DEPENDENCIES:
 *   Requires Snippet 1 to be active (BES_COLORS, BES_SOCIALS, BES_NAV_LINKS,
 *   Google Fonts, Font Awesome, Tailwind CDN already loaded by Snippet 1).
 *
 * @package BaliElingSpirit
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =========================================================================
 * GUARD — Only register hooks if Snippet 1 constants exist
 * ========================================================================= */
// if ( ! defined( 'BES_COLORS' ) ) {
//     // Minimal fallback so the 404 never shows a blank white page
//     define( 'BES_COLORS', [ 'forest_deep' => '#151E10', 'leaf' => '#C2D24A', 'ivory' => '#FDFCFA' ] );
//     define( 'BES_NAV_LINKS', [] );
//     define( 'BES_SOCIALS', [] );
// }

/* =========================================================================
 * 1. INTERCEPT 404 — start output buffer, register shutdown injector
 * =========================================================================
 *
 * WHY ob_start() + shutdown:
 *   wp_footer hooks always fire AFTER Snippet 1's bes_footer() (priority 10).
 *   Any content printed there ends up below <footer> in the DOM — wrong.
 *   Instead we capture the entire rendered page as a string, then surgically
 *   insert our #bes-404 block immediately before the first <footer tag.
 *   This works regardless of theme, page builder, or hook ordering.
 * ========================================================================= */
add_action( 'template_redirect', 'bes_404_intercept' );
function bes_404_intercept() {
    if ( ! is_404() ) return;

    // Register CSS into <head> as normal
    add_action( 'wp_head', 'bes_404_styles', 2 );

    // Capture all output from this point forward
    ob_start();

    // On PHP shutdown (after wp_footer has fully fired and flushed), grab the
    // buffer, inject our block before <footer, then echo the final page.
    add_action( 'shutdown', 'bes_404_inject_content', 999 );
}

/* ── Shutdown injector (Updated) ── */
function bes_404_inject_content() {
    if ( ! is_404() ) return;

    $html      = ob_get_clean();
    $block     = bes_404_build_block();
    $script    = bes_404_build_script();
    $injection = $block . $script;

    // 1. Try finding a semantic <footer tag (case-insensitive)
    if ( stripos( $html, '<footer' ) !== false ) {
        $html = preg_replace( '/<footer/i', $injection . '<footer', $html, 1 );
    }
    // 2. Fallback: Elementor specific footer wrappers (if semantic tag is missing)
    elseif ( preg_match( '/<div[^>]*data-elementor-type="footer"[^>]*>/i', $html ) ) {
        $html = preg_replace( '/(<div[^>]*data-elementor-type="footer"[^>]*>)/i', $injection . '$1', $html, 1 );
    }
    // 3. Fallback: Inject immediately after the main content wrapper closes
    elseif ( stripos( $html, '</main>' ) !== false ) {
        $html = preg_replace( '/<\/main>/i', '</main>' . $injection, $html, 1 );
    }
    // 4. Last Resort: Inject right before the closing body tag
    elseif ( stripos( $html, '</body>' ) !== false ) {
        $html = str_replace( '</body>', $injection . '</body>', $html );
    } else {
        $html .= $injection;
    }

    echo $html; // phpcs:ignore WordPress.Security.EscapeOutput
}

/* =========================================================================
 * 2. 404-SPECIFIC CSS
 * ========================================================================= */
add_action( 'wp_head', function() {
    if ( ! is_404() ) return;
    bes_404_styles();
}, 2 );

function bes_404_styles() {
    if ( ! is_404() ) return;
    $c = BES_COLORS;
    ?>
    <style id="bes-404-css">
      /* ── Override body background specifically for 404 using native WP class ── */
      body.error404 { background: <?php echo $c['forest_deep']; ?> !important; overflow-x: hidden; }

      /* ============================================================
         CAVE SCENE — full-viewport immersive wrapper
         ============================================================ */
      #bes-404 {
        min-height: 100dvh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 140px 24px 80px;
        background: radial-gradient(ellipse 120% 80% at 50% 110%,
          rgba(21,30,16,0.0) 0%,
          rgba(21,30,16,1) 55%),
          linear-gradient(180deg, #060a04 0%, #0d1509 40%, #1a2614 100%);
      }

      /* ── Anti-Flicker Initial State ── */
      #bes-404-wrapper { 
        display: none; 
      }
      #bes-404-wrapper.bes-teleported {
        display: block;
        animation: besFadeIn 0.3s ease-out forwards;
      }
      @keyframes besFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      /* ── Cave ceiling texture ── */
      #bes-404::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
          radial-gradient(ellipse 60% 30% at 25% 0%, rgba(139,101,64,0.06) 0%, transparent 70%),
          radial-gradient(ellipse 40% 25% at 75% 0%, rgba(139,101,64,0.05) 0%, transparent 60%),
          radial-gradient(ellipse 80% 40% at 50% 0%, rgba(10,14,7,0.8) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
      }

      /* ── Bioluminescent ambient pools ── */
      .bes-404-pool {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
        animation: poolBreath ease-in-out infinite;
      }
      @keyframes poolBreath {
        0%, 100% { opacity: 0.18; transform: scale(1); }
        50%       { opacity: 0.32; transform: scale(1.12); }
      }

      /* ── Stalactite drip bar ── */
      #bes-stalactites {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 120px;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
      }
      .bes-stlct {
        position: absolute;
        top: 0;
        width: 2px;
        background: linear-gradient(180deg,
          rgba(80,60,40,0.5) 0%,
          rgba(100,80,55,0.6) 70%,
          rgba(139,101,64,0.2) 100%);
        border-radius: 0 0 50% 50%;
        transform-origin: top center;
      }
      .bes-stlct::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 6px; height: 6px;
        border-radius: 50%;
        background: rgba(139,101,64,0.45);
        animation: dripFall linear infinite;
      }
      @keyframes dripFall {
        0%   { transform: translateX(-50%) translateY(0); opacity: 0.7; }
        80%  { opacity: 0.5; }
        100% { transform: translateX(-50%) translateY(140px); opacity: 0; }
      }

      /* ── Floating lotus petals ── */
      .bes-404-petal {
        position: absolute;
        pointer-events: none;
        opacity: 0;
        animation: petalDrift linear infinite;
      }
      @keyframes petalDrift {
        0%   { opacity: 0; transform: translateY(-20px) rotate(0deg) scale(0.8); }
        10%  { opacity: 0.25; }
        90%  { opacity: 0.18; }
        100% { opacity: 0; transform: translateY(110vh) rotate(540deg) scale(0.6); }
      }

      /* ── Torch flame particles ── */
      .bes-flame-wrap {
        position: absolute;
        bottom: 0;
        pointer-events: none;
        z-index: 1;
      }
      .bes-flame-particle {
        position: absolute;
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        animation: flameDance ease-in-out infinite alternate;
        filter: blur(1.5px);
      }
      @keyframes flameDance {
        0%   { transform: translateY(0) scaleX(1) scaleY(1); opacity: 0.9; }
        50%  { transform: translateY(-12px) scaleX(0.85) scaleY(1.2); opacity: 0.7; }
        100% { transform: translateY(-20px) scaleX(1.1) scaleY(0.9); opacity: 0.5; }
      }
      .bes-torch-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(30px);
        animation: torchPulse ease-in-out infinite alternate;
        pointer-events: none;
      }
      @keyframes torchPulse {
        0%   { opacity: 0.15; transform: scale(1); }
        100% { opacity: 0.28; transform: scale(1.2); }
      }

      /* ── Sacred Aksara watermark ── */
      #bes-aksara {
        position: absolute;
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: clamp(180px, 28vw, 380px);
        font-weight: 300;
        letter-spacing: -0.04em;
        line-height: 1;
        color: transparent;
        -webkit-text-stroke: 1px rgba(194,210,74,0.04);
        user-select: none;
        pointer-events: none;
        z-index: 1;
        animation: aksaraPulse 6s ease-in-out infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
      }
      @keyframes aksaraPulse {
        0%, 100% { -webkit-text-stroke: 1px rgba(194,210,74,0.04); }
        50%       { -webkit-text-stroke: 1px rgba(194,210,74,0.09); }
      }

      /* ── Stone-carved 404 numeral ── */
      #bes-404-num {
        position: relative;
        z-index: 10;
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: clamp(88px, 18vw, 180px);
        font-weight: 600;
        letter-spacing: -0.04em;
        line-height: 1;
        color: transparent;
        background: linear-gradient(180deg,
          rgba(194,210,74,0.9) 0%,
          rgba(148,168,131,0.7) 40%,
          rgba(107,127,90,0.5) 75%,
          rgba(63,81,48,0.3) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        text-shadow: none;
        filter: drop-shadow(0 0 40px rgba(194,210,74,0.12)) drop-shadow(0 2px 4px rgba(0,0,0,0.6));
        animation: numCarve 3s ease-out both;
      }
      @keyframes numCarve {
        0%   { opacity: 0; transform: scale(1.15) translateY(10px); filter: drop-shadow(0 0 80px rgba(194,210,74,0.4)) blur(8px); }
        60%  { opacity: 1; filter: drop-shadow(0 0 50px rgba(194,210,74,0.2)) blur(2px); }
        100% { opacity: 1; filter: drop-shadow(0 0 40px rgba(194,210,74,0.12)) drop-shadow(0 2px 4px rgba(0,0,0,0.6)) blur(0); }
      }

      /* Mossy shimmer overlay on the 404 */
      #bes-404-num::after {
        content: '404';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg,
          transparent 0%,
          rgba(255,255,255,0.06) 45%,
          rgba(194,210,74,0.1) 50%,
          transparent 55%,
          transparent 100%);
        background-size: 200% 100%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: mossShimmer 5s ease-in-out 2s infinite;
      }
      @keyframes mossShimmer {
        0%   { background-position: 200% center; }
        100% { background-position: -200% center; }
      }

      /* ── Content block ── */
      #bes-404-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 540px;
        margin: 0 auto;
        animation: contentRise 1s cubic-bezier(.22,1,.36,1) 0.6s both;
      }
      @keyframes contentRise {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
      }

      /* ── Ornamental divider ── */
      .bes-404-ornament {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: 20px 0;
      }
      .bes-404-ornament-line {
        height: 1px;
        width: 60px;
        background: linear-gradient(90deg, transparent, rgba(194,210,74,0.3), transparent);
      }
      .bes-404-ornament-gem {
        width: 5px; height: 5px;
        border: 1px solid rgba(194,210,74,0.4);
        transform: rotate(45deg);
        animation: gemPulse 2.5s ease-in-out infinite;
      }
      @keyframes gemPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(194,210,74,0); }
        50%       { box-shadow: 0 0 8px 2px rgba(194,210,74,0.15); }
      }

      /* ── Smart path suggestions ── */
      #bes-404-suggest {
        position: relative;
        z-index: 10;
        margin-top: 36px;
        animation: contentRise 1s cubic-bezier(.22,1,.36,1) 1s both;
        opacity: 0;
      }
      .bes-404-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 16px;
        border-radius: 100px;
        border: 1px solid rgba(194,210,74,0.12);
        background: rgba(194,210,74,0.04);
        color: rgba(253,252,250,0.5);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
      }
      .bes-404-pill:hover {
        background: rgba(194,210,74,0.1);
        border-color: rgba(194,210,74,0.3);
        color: #C2D24A;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(194,210,74,0.1);
      }
      .bes-404-pill-dot {
        width: 4px; height: 4px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.4;
      }

      /* ── Primary CTA ── */
      .bes-404-cta-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #C2D24A;
        color: #1E2A16;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        padding: 15px 32px;
        border-radius: 100px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
        position: relative;
        overflow: hidden;
      }
      .bes-404-cta-primary::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.15) 50%, transparent 100%);
        transform: translateX(-100%);
        transition: transform 0.5s ease;
      }
      .bes-404-cta-primary:hover::before { transform: translateX(100%); }
      .bes-404-cta-primary:hover {
        background: #AFBF38;
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(194,210,74,0.25);
      }
      .bes-404-cta-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(253,252,250,0.35);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        text-decoration: none;
        padding: 15px 24px;
        border-radius: 100px;
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.3s ease;
      }
      .bes-404-cta-secondary:hover {
        color: rgba(253,252,250,0.7);
        border-color: rgba(255,255,255,0.12);
        background: rgba(255,255,255,0.03);
      }

      /* ── Responsive ── */
      @media (max-width: 480px) {
        #bes-404-num { font-size: 22vw; }
        .bes-404-pill { font-size: 10px; padding: 7px 13px; }
      }

      /* ── Hide default WP content for 404 ── */
      .error404 main > *:not(#bes-404-wrapper),
      .error404 .entry-content,
      .error404 .page-header { display: none !important; }
    </style>
    <?php
}

/* =========================================================================
 * 3. 404 PAGE CONTENT — returns HTML string (called by shutdown injector)
 * =========================================================================
 *
 * Returns the full #bes-404 scene as a string so the shutdown injector can
 * splice it directly before <footer in the buffered page output.
 * ========================================================================= */
function bes_404_build_block() {
    if ( ! is_404() ) return '';
    $c   = BES_COLORS;
    $nav = is_array( BES_NAV_LINKS ) ? BES_NAV_LINKS : [];

    ob_start();
    ?>
    <div id="bes-404-wrapper">
    <div id="bes-404" role="main" aria-label="Page not found — Sacred Cave">

      <!-- ── Aksara watermark ── -->
      <div id="bes-aksara" aria-hidden="true">ᬒᬁ</div>

      <!-- ── Bioluminescent pools ── -->
      <div class="bes-404-pool" style="width:500px;height:300px;background:radial-gradient(circle,rgba(194,210,74,0.07),transparent 70%);top:60%;left:30%;animation-duration:7s;animation-delay:0s"></div>
      <div class="bes-404-pool" style="width:300px;height:200px;background:radial-gradient(circle,rgba(50,180,120,0.05),transparent 70%);top:55%;right:25%;animation-duration:9s;animation-delay:2s"></div>
      <div class="bes-404-pool" style="width:200px;height:150px;background:radial-gradient(circle,rgba(201,168,76,0.06),transparent 70%);top:30%;left:15%;animation-duration:11s;animation-delay:1s"></div>

      <!-- ── Stalactites ── -->
      <div id="bes-stalactites" aria-hidden="true"></div>

      <!-- ── Torch — Left ── -->
      <div class="bes-flame-wrap" style="left:5%;bottom:20%" aria-hidden="true">
        <div class="bes-torch-glow" style="width:120px;height:120px;background:radial-gradient(circle,rgba(220,140,40,0.25),transparent 70%);bottom:10px;left:-55px;animation-duration:3s"></div>
        <div class="bes-flame-particle" style="width:14px;height:18px;background:rgba(255,200,60,0.8);bottom:30px;left:0;animation-duration:0.9s;animation-delay:0s"></div>
        <div class="bes-flame-particle" style="width:10px;height:14px;background:rgba(255,140,30,0.7);bottom:28px;left:4px;animation-duration:0.7s;animation-delay:0.1s"></div>
        <div class="bes-flame-particle" style="width:7px;height:10px;background:rgba(255,240,100,0.6);bottom:36px;left:2px;animation-duration:0.5s;animation-delay:0.2s"></div>
      </div>

      <!-- ── Torch — Right ── -->
      <div class="bes-flame-wrap" style="right:5%;bottom:20%" aria-hidden="true">
        <div class="bes-torch-glow" style="width:120px;height:120px;background:radial-gradient(circle,rgba(220,140,40,0.22),transparent 70%);bottom:10px;right:-55px;animation-duration:4s;animation-delay:1s"></div>
        <div class="bes-flame-particle" style="width:14px;height:18px;background:rgba(255,200,60,0.8);bottom:30px;left:0;animation-duration:1.1s;animation-delay:0.3s"></div>
        <div class="bes-flame-particle" style="width:10px;height:14px;background:rgba(255,140,30,0.7);bottom:28px;left:4px;animation-duration:0.8s;animation-delay:0.15s"></div>
        <div class="bes-flame-particle" style="width:7px;height:10px;background:rgba(255,240,100,0.6);bottom:36px;left:2px;animation-duration:0.6s;animation-delay:0.4s"></div>
      </div>

      <!-- ── Stone 404 ── -->
      <div id="bes-404-num" aria-hidden="true">404</div>

      <!-- ── Content ── -->
      <div id="bes-404-content">

        <!-- Ornament -->
        <div class="bes-404-ornament" aria-hidden="true">
          <div class="bes-404-ornament-line"></div>
          <div class="bes-404-ornament-gem"></div>
          <div class="bes-404-ornament-gem" style="animation-delay:0.5s"></div>
          <div class="bes-404-ornament-gem" style="animation-delay:1s"></div>
          <div class="bes-404-ornament-line"></div>
        </div>

        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:0.28em;text-transform:uppercase;color:rgba(194,210,74,0.6);margin-bottom:16px;">
          Path Not Found
        </p>

        <h1 style="font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(28px,5vw,46px);font-weight:500;letter-spacing:-0.01em;line-height:1.2;color:rgba(253,252,250,0.92);margin:0 0 16px;">
          You Wandered Into<br>
          <em style="color:rgba(194,210,74,0.8);font-style:italic;">The Sacred Cave</em>
        </h1>

        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;line-height:1.8;color:rgba(253,252,250,0.38);max-width:420px;margin:0 auto 28px;font-weight:300;">
          Even the most devoted seeker sometimes loses the trail. This page has dissolved into the mist — but the sanctuary awaits.
        </p>

        <!-- Ornament -->
        <div class="bes-404-ornament" aria-hidden="true">
          <div class="bes-404-ornament-line"></div>
          <div class="bes-404-ornament-gem" style="animation-delay:0.8s"></div>
          <div class="bes-404-ornament-line"></div>
        </div>

        <!-- CTAs -->
        <div style="display:flex;align-items:center;justify-content:center;gap:12px;flex-wrap:wrap;margin-top:24px;">
          <a href="/" class="bes-404-cta-primary">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
              <path d="M7 1L1 7l6 6M1 7h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Return to Sanctuary
          </a>
          <a href="/healing-retreat" class="bes-404-cta-secondary">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
              <circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/>
              <path d="M6 3v3l2 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
            Explore Retreats
          </a>
        </div>

      </div><!-- /#bes-404-content -->

      <!-- ── Smart path suggestions ── -->
      <div id="bes-404-suggest" aria-live="polite">
        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:rgba(253,252,250,0.2);margin-bottom:14px;text-align:center;">
          Perhaps you seek
        </p>
        <div id="bes-404-pills" style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center;">
          <?php foreach ( $nav as $item ):
              $label = is_object($item) ? $item->title : $item['label'];
              $href  = is_object($item) ? $item->url   : $item['href'];
          ?>
          <a href="<?php echo esc_url($href); ?>"
             class="bes-404-pill"
             data-label="<?php echo esc_attr( strtolower($label) ); ?>">
            <span class="bes-404-pill-dot"></span>
            <?php echo esc_html($label); ?>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

    </div><!-- /#bes-404 -->
    </div><!-- /#bes-404-wrapper -->
    <?php
    return ob_get_clean();
}

/* =========================================================================
 * 4. 404 JAVASCRIPT — returns HTML string
 * ========================================================================= */
function bes_404_build_script() {
    if ( ! is_404() ) return '';
    ob_start();
    ?>
    <script id="bes-404-js">
    (function () {
        'use strict';

        var wrapper = document.getElementById('bes-404-wrapper');
        if (!wrapper) return;

        /* ================================================================
         * 0. REAL-TIME NUCLEAR DOM TELEPORTER (Anti-Flicker)
         * ============================================================== */
        // Broad selector to catch semantic footers, Elementor footers, and standard WP footer IDs
        var footer = document.querySelector('footer, .site-footer, #colophon, [data-elementor-type="footer"]');
        
        if (footer && footer.parentNode) {
            // Teleport the wrapper right before the detected footer
            footer.parentNode.insertBefore(wrapper, footer);
        } else {
            // Fallback: Just put it at the end of the main content area if no footer exists
            var main = document.querySelector('main, #content, #primary');
            if (main) main.appendChild(wrapper);
        }

        // Remove the display:none and trigger the smooth fade-in
        wrapper.classList.add('bes-teleported');

        // Safety: Only run the rest if our cave scene exists
        if (!document.getElementById('bes-404')) return;

        /* ================================================================
         * 1. Generate stalactites
         * ============================================================== */
        var container = document.getElementById('bes-stalactites');
        if (container) {
            var count = Math.round(window.innerWidth / 28);
            for (var i = 0; i < count; i++) {
                var s = document.createElement('div');
                s.className = 'bes-stlct';
                var left   = (i / count * 100) + (Math.random() * 2.5 - 1.25);
                var height = 40 + Math.random() * 70;
                var width  = 1.5 + Math.random() * 2.5;
                var delay  = Math.random() * 6;
                var dur    = 2.5 + Math.random() * 3.5;
                s.style.cssText = [
                    'left:' + left + '%',
                    'height:' + height + 'px',
                    'width:' + width + 'px',
                    'opacity:' + (0.3 + Math.random() * 0.4)
                ].join(';');
                s.style.setProperty('--drip-dur', dur + 's');
                if (s.querySelector && false) {} // placeholder
                // Apply drip animation to pseudo via parent
                s.style.setProperty('animation', 'none');
                // Use a real child element for the drip (pseudo can't be animated via JS)
                var drip = document.createElement('span');
                drip.style.cssText = [
                    'position:absolute',
                    'bottom:-5px',
                    'left:50%',
                    'transform:translateX(-50%)',
                    'width:' + Math.max(4, width * 2) + 'px',
                    'height:' + Math.max(4, width * 2) + 'px',
                    'border-radius:50%',
                    'background:rgba(139,101,64,' + (0.25 + Math.random() * 0.25) + ')',
                    'animation:dripFall ' + dur + 's linear ' + delay + 's infinite'
                ].join(';');
                s.appendChild(drip);
                container.appendChild(s);
            }
        }

        /* ================================================================
         * 2. Spawn floating lotus petals
         * ============================================================== */
        var scene = document.getElementById('bes-404');
        var PETAL_COLORS = [
            'rgba(194,210,74,0.15)',
            'rgba(194,210,74,0.10)',
            'rgba(148,168,131,0.12)',
            'rgba(201,168,76,0.10)',
        ];
        var PETAL_SVG_PATHS = [
            'M10,0 Q14,4 10,10 Q6,4 10,0 Z',
            'M10,0 Q16,5 10,12 Q4,5 10,0 Z',
            'M10,0 Q13,6 10,10 Q7,6 10,0 Z',
        ];

        function spawnPetal() {
            var p   = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            var idx = Math.floor(Math.random() * PETAL_SVG_PATHS.length);
            p.setAttribute('viewBox', '0 0 20 14');
            p.setAttribute('width', 12 + Math.random() * 10 + '');
            p.setAttribute('height', 12 + Math.random() * 10 + '');
            var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', PETAL_SVG_PATHS[idx]);
            path.setAttribute('fill', PETAL_COLORS[Math.floor(Math.random() * PETAL_COLORS.length)]);
            p.appendChild(path);
            p.className = 'bes-404-petal';
            p.setAttribute('aria-hidden', 'true');
            p.style.left = (Math.random() * 96 + 2) + '%';
            p.style.top  = '-20px';
            var dur   = 8 + Math.random() * 12;
            var delay = Math.random() * 6;
            p.style.animationDuration  = dur + 's';
            p.style.animationDelay     = delay + 's';
            p.style.animationFillMode  = 'forwards';
            if (scene) scene.appendChild(p);
            setTimeout(function () { if (p.parentNode) p.parentNode.removeChild(p); }, (dur + delay + 1) * 1000);
        }

        // Seed initial petals then keep spawning
        for (var pi = 0; pi < 8; pi++) spawnPetal();
        setInterval(spawnPetal, 1800);

        /* ================================================================
         * 3. Smart path-based pill highlighting
         *    Fuzzy match the broken URL against known nav paths
         * ============================================================== */
        var brokenPath = window.location.pathname.toLowerCase().replace(/\/$/, '') || '/';
        var pills       = document.querySelectorAll('.bes-404-pill');

        // Score each pill by character overlap
        var scored = [];
        pills.forEach(function (pill) {
            var label = (pill.dataset.label || '').toLowerCase();
            var href  = pill.getAttribute('href').toLowerCase().replace(/\/$/, '');
            // Simple scoring: check substring match + label word match
            var score = 0;
            var brokenParts = brokenPath.split(/[-\/_ ]+/).filter(Boolean);
            brokenParts.forEach(function (part) {
                if (part.length > 2) {
                    if (href.indexOf(part) !== -1) score += 3;
                    if (label.indexOf(part) !== -1) score += 2;
                }
            });
            scored.push({ pill: pill, score: score });
        });

        // Sort descending; top 3 get visual highlight
        scored.sort(function (a, b) { return b.score - a.score; });
        var topN = Math.min(scored.length, 3);
        scored.slice(0, topN).forEach(function (item, idx) {
            if (item.score === 0) return; // don't highlight if no match at all
            var el = item.pill;
            el.style.background     = 'rgba(194,210,74,' + (0.1 - idx * 0.02) + ')';
            el.style.borderColor    = 'rgba(194,210,74,' + (0.4 - idx * 0.08) + ')';
            el.style.color          = '#C2D24A';
            el.style.transitionDelay = (idx * 0.06) + 's';
        });

        /* ================================================================
         * 4. Stagger pills entrance
         * ============================================================== */
        pills.forEach(function (pill, i) {
            pill.style.opacity   = '0';
            pill.style.transform = 'translateY(10px)';
            pill.style.transition = 'opacity 0.4s ease, transform 0.4s ease, background 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease';
            setTimeout(function () {
                pill.style.opacity   = '1';
                pill.style.transform = 'translateY(0)';
            }, 1200 + i * 70);
        });

        /* ================================================================
         * 5. Cave ambient sound hint: subtle particle shimmer on mouse move
         * ============================================================== */
        var lastMoveT = 0;
        document.addEventListener('mousemove', function (e) {
            var now = Date.now();
            if (now - lastMoveT < 120) return;
            lastMoveT = now;
            // Create tiny sparkle at cursor
            var spark = document.createElement('div');
            spark.setAttribute('aria-hidden', 'true');
            spark.style.cssText = [
                'position:fixed',
                'pointer-events:none',
                'z-index:9999',
                'left:' + e.clientX + 'px',
                'top:' + e.clientY + 'px',
                'width:3px',
                'height:3px',
                'border-radius:50%',
                'background:rgba(194,210,74,0.5)',
                'transform:translate(-50%,-50%) scale(1)',
                'transition:transform 0.6s ease, opacity 0.6s ease',
                'opacity:0.6'
            ].join(';');
            document.body.appendChild(spark);
            requestAnimationFrame(function () {
                spark.style.transform = 'translate(-50%,-50%) scale(4)';
                spark.style.opacity   = '0';
            });
            setTimeout(function () {
                if (spark.parentNode) spark.parentNode.removeChild(spark);
            }, 700);
        });

        /* ================================================================
         * 6. Keyboard accessibility: press 'H' to go home, 'R' to go back
         * ============================================================== */
        document.addEventListener('keydown', function (e) {
            if (['INPUT','TEXTAREA','SELECT'].indexOf((document.activeElement || {}).tagName) !== -1) return;
            if (e.key === 'h' || e.key === 'H') window.location.href = '/';
            if (e.key === 'r' || e.key === 'R') history.length > 1 ? history.back() : (window.location.href = '/');
        });

        /* ================================================================
         * 7. Announce 404 to screen readers cleanly
         * ============================================================== */
        var liveRegion = document.createElement('div');
        liveRegion.setAttribute('role', 'alert');
        liveRegion.setAttribute('aria-live', 'assertive');
        liveRegion.className = 'sr-only';
        liveRegion.style.cssText = 'position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;';
        liveRegion.textContent   = 'Page not found. You are on the 404 error page for Bali Eling Spirit. Use the navigation links to find your way.';
        document.body.appendChild(liveRegion);

    })();
    </script>
    <?php
    return ob_get_clean();
}