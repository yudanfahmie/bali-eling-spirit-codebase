<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — Snippet 2: Home Hero (v3 – Cinematic Editorial)
 * ============================================================================
 *
 * ANTI-MAINSTREAM CONCEPT:
 *   Instead of a generic centered slider, this hero uses a cinematic
 *   editorial layout with:
 *
 *   ★ Asymmetric split — dramatic oversize type LEFT, organic blob-masked
 *     imagery RIGHT that bleeds across the layout
 *   ★ Organic SVG clip-path wipe transitions — a morphing blob shape reveals
 *     each new slide's image (no fade, no slide, pure organic flow)
 *   ★ Vertical timeline navigation on the right edge (not dots)
 *   ★ Mouse-responsive parallax on the image layer
 *   ★ Floating sacred geometry (Flower of Life) + golden particle mist
 *   ★ Film grain overlay for cinematic texture
 *   ★ Dramatic mixed-weight typography with italic accents
 *   ★ Scroll-cue breathing animation at bottom
 *
 * DEPENDENCIES: Snippet 1 v3 (Tailwind config, Cormorant Garamond +
 *               Plus Jakarta Sans, BES color tokens)
 *
 * SHORTCODE: [bes_home_hero]
 *
 * @package BaliElingSpirit
 * @version 3.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_home_hero', 'bes_render_home_hero');

/**
 * Resolve hero media by WordPress attachment ID first, with a safe filename
 * fallback for environments where attachment IDs differ after migration.
 */
if (! function_exists('bes_find_attachment_id_by_filename')) {
  function bes_find_attachment_id_by_filename($filename)
  {
    static $cache = [];

    $filename = basename((string) $filename);
    if ($filename === '') {
      return 0;
    }

    if (isset($cache[$filename])) {
      return $cache[$filename];
    }

    global $wpdb;

    $attachment_id = 0;
    $like          = '%' . $wpdb->esc_like($filename);

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
        $like
      )
    );

    if (! $attachment_id) {
      $title = pathinfo($filename, PATHINFO_FILENAME);

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

    $cache[$filename] = $attachment_id;

    return $attachment_id;
  }
}

if (! function_exists('bes_resolve_hero_image_id')) {
  function bes_resolve_hero_image_id($attachment_id, $fallback_filename = '')
  {
    $attachment_id = absint($attachment_id);

    if ($attachment_id && wp_attachment_is_image($attachment_id)) {
      return $attachment_id;
    }

    return bes_find_attachment_id_by_filename($fallback_filename);
  }
}

if (! function_exists('bes_get_hero_image_html')) {
  function bes_get_hero_image_html(array $slide, $index)
  {
    $attachment_id = bes_resolve_hero_image_id(
      isset($slide['img_id']) ? $slide['img_id'] : 0,
      isset($slide['img_file']) ? $slide['img_file'] : ''
    );

    $alt = wp_strip_all_tags(
      trim(
        (isset($slide['title_1']) ? $slide['title_1'] : '') . ' ' .
          (isset($slide['title_2']) ? $slide['title_2'] : '') . ' ' .
          (isset($slide['title_em']) ? $slide['title_em'] : '')
      )
    );

    $attrs = [
      'class'           => 'bh-img',
      'alt'             => $alt,
      'loading'         => ((int) $index === 0) ? 'eager' : 'lazy',
      'decoding'        => ((int) $index === 0) ? 'sync' : 'async',
      'sizes'           => '(max-width: 1024px) 100vw, 65vw',
      'data-image-id'   => (string) $attachment_id,
      'data-image-file' => isset($slide['img_file']) ? $slide['img_file'] : '',
    ];

    if ((int) $index === 0) {
      $attrs['fetchpriority'] = 'high';
    }

    if ($attachment_id) {
      $full = wp_get_attachment_image_src($attachment_id, 'full');

      if (! empty($full[0])) {
        $attrs['src']    = $full[0];
        $attrs['width']  = ! empty($full[1]) ? (int) $full[1] : '';
        $attrs['height'] = ! empty($full[2]) ? (int) $full[2] : '';

        $html_attrs = '';

        foreach ($attrs as $name => $value) {
          if ($value === '' || $value === null) {
            continue;
          }

          $html_attrs .= sprintf(
            ' %s="%s"',
            esc_attr($name),
            esc_attr($value)
          );
        }

        return '<img' . $html_attrs . ' />';
      }
    }

    $fallback_url = isset($slide['img']) ? $slide['img'] : '';

    if (! $fallback_url) {
      return '';
    }

    $fetchpriority = ((int) $index === 0) ? ' fetchpriority="high"' : '';

    return sprintf(
      '<img src="%1$s" alt="%2$s" class="bh-img" loading="%3$s" decoding="%4$s"%5$s data-image-id="%6$s" data-image-file="%7$s" />',
      esc_url($fallback_url),
      esc_attr($alt),
      ((int) $index === 0) ? 'eager' : 'lazy',
      ((int) $index === 0) ? 'sync' : 'async',
      $fetchpriority,
      esc_attr((string) $attachment_id),
      esc_attr(isset($slide['img_file']) ? $slide['img_file'] : '')
    );
  }
}


function bes_render_home_hero()
{
  ob_start();

  $slides = [
    [
      'kicker'   => 'Est. Bali, Indonesia',
      'title_1'  => 'Awaken',
      'title_2'  => 'Your Inner',
      'title_em' => 'Peace',
      'desc'     => 'Step into a sacred sanctuary in the heart of Bali. Breathe deeply, release what no longer serves you, and reconnect with your divine essence through ancient wisdom.',
      'img_id'   => 3348, // xerWE.webp — Sanctuary
      'img_file' => 'xerWE.webp',
      'img'      => content_url('uploads/2026/07/xerWE.webp'),
      'btn'      => 'Discover Retreats',
      'link'     => '/healing-retreat',
      'tag'      => 'Sanctuary',
    ],
    [
      'kicker'   => 'Ancient Balinese Wisdom',
      'title_1'  => 'Restore',
      'title_2'  => 'Body &amp;',
      'title_em' => 'Spirit',
      'desc'     => 'Experience healing traditions passed down through generations — ceremonies, meditation, and holistic therapies designed to harmonize your entire being.',
      'img_id'   => 3341, // jlKQh.webp — Academy
      'img_file' => 'jlKQh.webp',
      'img'      => content_url('uploads/2026/07/jlKQh.webp'),
      'btn'      => 'Our Philosophy',
      'link'     => '/wisdom',
      'tag'      => 'Academy',
    ],
    [
      'kicker'   => '200 & 300 Hour Certified',
      'title_1'  => 'Deepen',
      'title_2'  => 'Your Sacred',
      'title_em' => 'Practice',
      'desc'     => 'Transform your passion into purpose. Our Yoga Alliance certified training goes beyond asana — explore breathwork, philosophy, and the art of conscious teaching.',
      'img_id'   => 3349, // eXToe.webp — Pasraman
      'img_file' => 'eXToe.webp',
      'img'      => content_url('uploads/2026/07/eXToe.webp'),
      'btn'      => 'View Programs',
      'link'     => '/yoga-teacher-training',
      'tag'      => 'Pasraman',
    ],
    [
      'kicker'   => 'A Global Community',
      'title_1'  => 'Find Your',
      'title_2'  => 'Soul',
      'title_em' => 'Tribe',
      'desc'     => 'Join a worldwide community of seekers, healers, and teachers united by a shared devotion to growth, compassion, and conscious living.',
      'img_id'   => 3342, // KlQvy.webp — Eling Living
      'img_file' => 'KlQvy.webp',
      'img'      => content_url('uploads/2026/07/KlQvy.webp'),
      'btn'      => 'About Us',
      'link'     => '/about-us',
      'tag'      => 'Eling Living',
    ],
  ];

  $total = count($slides);
?>

  <!-- ================================================================
         HERO STYLES
         ================================================================ -->
  <style>
    /* ── Container ── */
    .bh {
      position: relative;
      width: 100%;
      height: 100svh;
      min-height: 650px;
      overflow: hidden;
      background: #151E10
    }

    /* ── Film grain overlay ── */
    .bh-grain {
      position: absolute;
      inset: 0;
      z-index: 50;
      pointer-events: none;
      opacity: .035;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      background-repeat: repeat;
      background-size: 128px 128px;
      mix-blend-mode: overlay;
    }

    /* ── Slide layers ── */
    .bh-slide {
      position: absolute;
      inset: 0;
      opacity: 0;
      pointer-events: none;
      transition: opacity .1s ease;
      z-index: 1
    }

    .bh-slide.is-active {
      opacity: 1;
      pointer-events: auto;
      z-index: 10
    }

    /* ── Image container + organic blob mask ── */
    .bh-img-wrap {
      position: absolute;
      top: 5%;
      right: -5%;
      width: 65%;
      height: 90%;
      clip-path: url(#bh-blob);
      -webkit-clip-path: url(#bh-blob);
      overflow: hidden;
      transition: clip-path 1.2s cubic-bezier(.4, 0, .2, 1);
    }

    @media(max-width:1024px) {
      .bh-img-wrap {
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        clip-path: none;
        -webkit-clip-path: none
      }
    }

    .bh-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 12s cubic-bezier(.25, .46, .45, .94), opacity 1s ease;
      transform: scale(1.02);
      will-change: transform;
    }

    .bh-slide.is-active .bh-img {
      transform: scale(1.12)
    }

    /* Image overlay — different per slide context */
    .bh-img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(21, 30, 16, .92) 0%, rgba(21, 30, 16, .45) 40%, rgba(21, 30, 16, .15) 70%, transparent 100%);
      transition: background 1s ease;
    }

    @media(max-width:1024px) {
      .bh-img-overlay {
        background: linear-gradient(180deg, rgba(21, 30, 16, .85) 0%, rgba(21, 30, 16, .5) 50%, rgba(21, 30, 16, .7) 100%);
      }
    }

    /* ── Text Content ── */
    .bh-content {
      position: relative;
      z-index: 20;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 0 6% 0 7%;
      max-width: 55%;
    }

    @media(max-width:1024px) {
      .bh-content {
        max-width: 100%;
        padding: 0 6%;
        text-align: center;
        align-items: center
      }
    }

    /* Kicker line */
    .bh-kicker {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      opacity: 0;
      transform: translateY(15px);
      transition: all .7s cubic-bezier(.22, 1, .36, 1) .3s;
    }

    .bh-slide.is-active .bh-kicker {
      opacity: 1;
      transform: translateY(0)
    }

    .bh-kicker-line {
      width: 0;
      height: 1px;
      background: #C2D24A;
      transition: width .8s cubic-bezier(.22, 1, .36, 1) .5s
    }

    .bh-slide.is-active .bh-kicker-line {
      width: 40px
    }

    /* Title lines — dramatic stagger */
    .bh-title-line {
      display: block;
      overflow: hidden;
    }

    .bh-title-inner {
      display: block;
      transform: translateY(110%);
      transition: transform .9s cubic-bezier(.22, 1, .36, 1);
    }

    .bh-slide.is-active .bh-t1 .bh-title-inner {
      transition-delay: .15s;
      transform: translateY(0)
    }

    .bh-slide.is-active .bh-t2 .bh-title-inner {
      transition-delay: .25s;
      transform: translateY(0)
    }

    .bh-slide.is-active .bh-t3 .bh-title-inner {
      transition-delay: .35s;
      transform: translateY(0)
    }

    /* Description */
    .bh-desc {
      opacity: 0;
      transform: translateY(20px);
      transition: all .8s cubic-bezier(.22, 1, .36, 1) .55s;
    }

    .bh-slide.is-active .bh-desc {
      opacity: 1;
      transform: translateY(0)
    }

    /* CTA button */
    .bh-cta {
      opacity: 0;
      transform: translateY(20px);
      transition: all .7s cubic-bezier(.22, 1, .36, 1) .7s;
    }

    .bh-slide.is-active .bh-cta {
      opacity: 1;
      transform: translateY(0)
    }

    .bh-btn {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 16px 32px;
      border-radius: 60px;
      overflow: hidden;
      background: transparent;
      border: 1.5px solid rgba(194, 210, 74, .4);
      color: #C2D24A !important;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-decoration: none;
      transition: all .4s cubic-bezier(.22, 1, .36, 1);
    }

    .bh-btn::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: inherit;
      background: #C2D24A;
      transform: scaleX(0);
      transform-origin: left;
      transition: transform .45s cubic-bezier(.22, 1, .36, 1);
      z-index: 0;
    }

    .bh-btn:hover::before {
      transform: scaleX(1)
    }

    .bh-btn:hover {
      color: #151E10 !important;
      border-color: #C2D24A
    }

    .bh-btn span,
    .bh-btn i {
      position: relative;
      z-index: 1
    }

    .bh-btn i {
      transition: transform .3s ease;
      font-size: 10px;
    }

    .bh-btn:hover i {
      transform: translateX(4px)
    }

    /* ── Vertical Timeline Nav (right edge) ── */
    .bh-timeline {
      position: absolute;
      right: 28px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 40;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0;
    }

    @media(max-width:1024px) {
      .bh-timeline {
        right: 16px
      }
    }

    @media(max-width:640px) {
      .bh-timeline {
        display: none
      }
    }

    .bh-tl-item {
      position: relative;
      display: flex;
      align-items: center;
      cursor: pointer;
      padding: 14px 0;
      transition: all .3s ease;
    }

    /* Connecting line */
    .bh-tl-line {
      position: absolute;
      left: 50%;
      top: 100%;
      width: 1px;
      height: 28px;
      background: rgba(255, 255, 255, .08);
      transform: translateX(-50%);
    }

    .bh-tl-item:last-child .bh-tl-line {
      display: none
    }

    /* Node circle */
    .bh-tl-node {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      border: 1.5px solid rgba(255, 255, 255, .15);
      background: transparent;
      transition: all .5s cubic-bezier(.34, 1.56, .64, 1);
      position: relative;
    }

    .bh-tl-item.is-active .bh-tl-node {
      border-color: #C2D24A;
      background: #C2D24A;
      box-shadow: 0 0 12px rgba(194, 210, 74, .3), 0 0 24px rgba(194, 210, 74, .1);
      transform: scale(1.3);
    }

    .bh-tl-item:hover:not(.is-active) .bh-tl-node {
      border-color: rgba(255, 255, 255, .4);
      transform: scale(1.15);
    }

    /* Label that appears on hover/active */
    .bh-tl-label {
      position: absolute;
      right: 22px;
      top: 50%;
      transform: translateY(-50%);
      white-space: nowrap;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .5);
      opacity: 0;
      transform: translateY(-50%) translateX(8px);
      transition: all .35s cubic-bezier(.22, 1, .36, 1);
      pointer-events: none;
    }

    .bh-tl-item.is-active .bh-tl-label,
    .bh-tl-item:hover .bh-tl-label {
      opacity: 1;
      transform: translateY(-50%) translateX(0);
    }

    .bh-tl-item.is-active .bh-tl-label {
      color: #C2D24A
    }

    /* ── Progress ring around active node ── */
    .bh-tl-ring {
      position: absolute;
      inset: -6px;
      width: 22px;
      height: 22px;
    }

    .bh-tl-ring circle {
      fill: none;
      stroke: rgba(194, 210, 74, .3);
      stroke-width: 1;
      stroke-dasharray: 62.83;
      stroke-dashoffset: 62.83;
      transform: rotate(-90deg);
      transform-origin: center;
      transition: stroke-dashoffset .15s linear;
    }

    .bh-tl-item.is-active .bh-tl-ring circle {
      animation: none;
      /* Controlled via JS */
    }

    /* ── Floating Sacred Geometry ── */
    .bh-sacred {
      position: absolute;
      z-index: 5;
      pointer-events: none;
      opacity: .04;
    }

    .bh-sacred-1 {
      top: 8%;
      left: 3%;
      width: 300px;
      height: 300px;
      animation: sacredSpin 60s linear infinite;
    }

    .bh-sacred-2 {
      bottom: 10%;
      right: 15%;
      width: 200px;
      height: 200px;
      animation: sacredSpin 45s linear infinite reverse;
      opacity: .025;
    }

    @keyframes sacredSpin {
      to {
        transform: rotate(360deg)
      }
    }

    /* ── Floating particles ── */
    .bh-particle {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      z-index: 6;
      animation: bhFloat linear infinite;
    }

    @keyframes bhFloat {
      0% {
        transform: translateY(0) translateX(0);
        opacity: 0
      }

      10% {
        opacity: 1
      }

      90% {
        opacity: 1
      }

      100% {
        transform: translateY(var(--dy, -200px)) translateX(var(--dx, 30px));
        opacity: 0
      }
    }

    /* ── Scroll cue ── */
    .bh-scroll-cue {
      position: absolute;
      bottom: 32px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 40;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      opacity: .4;
    }

    @media(max-width:640px) {
      .bh-scroll-cue {
        bottom: 20px
      }
    }

    .bh-scroll-line {
      width: 1px;
      height: 32px;
      position: relative;
      overflow: hidden;
      background: rgba(255, 255, 255, .08);
      border-radius: 1px;
    }

    .bh-scroll-fill {
      position: absolute;
      top: -100%;
      left: 0;
      width: 100%;
      height: 100%;
      background: #C2D24A;
      border-radius: 1px;
      animation: scrollPulse 2s cubic-bezier(.4, 0, .2, 1) infinite;
    }

    @keyframes scrollPulse {
      0% {
        top: -100%
      }

      50% {
        top: 0
      }

      100% {
        top: 100%
      }
    }

    /* ── Counter / Slide number ── */
    .bh-counter {
      position: absolute;
      bottom: 32px;
      left: 7%;
      z-index: 40;
      display: flex;
      align-items: baseline;
      gap: 4px;
      font-family: 'Cormorant Garamond', serif;
    }

    @media(max-width:640px) {
      .bh-counter {
        left: 20px;
        bottom: 20px
      }
    }

    .bh-counter-cur {
      font-size: 36px;
      font-weight: 300;
      color: #C2D24A;
      line-height: 1;
      transition: all .5s cubic-bezier(.22, 1, .36, 1);
    }

    .bh-counter-sep {
      font-size: 14px;
      color: rgba(255, 255, 255, .15);
      margin: 0 2px
    }

    .bh-counter-tot {
      font-size: 14px;
      font-weight: 400;
      color: rgba(255, 255, 255, .2)
    }

    /* ── Transition wipe overlay ── */
    .bh-wipe {
      position: absolute;
      inset: 0;
      z-index: 35;
      pointer-events: none;
      background: #151E10;
      clip-path: circle(0% at 50% 50%);
      transition: clip-path 1s cubic-bezier(.77, 0, .175, 1);
    }

    .bh-wipe.is-wiping {
      clip-path: circle(150% at 50% 50%);
    }

    /* ── Mobile bottom nav dots (shown on small screens) ── */
    .bh-mobile-dots {
      display: none;
      position: absolute;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 40;
      gap: 8px;
    }

    @media(max-width:640px) {
      .bh-mobile-dots {
        display: flex
      }
    }

    .bh-m-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .2);
      border: none;
      cursor: pointer;
      transition: all .4s cubic-bezier(.34, 1.56, .64, 1);
    }

    .bh-m-dot.is-active {
      width: 24px;
      border-radius: 3px;
      background: #C2D24A;
    }
  </style>

  <!-- ================================================================
         HERO MARKUP
         ================================================================ -->
  <section class="bh" id="bh" data-bes-header="dark" aria-label="Hero Showcase">

    <!-- Film grain -->
    <div class="bh-grain" aria-hidden="true"></div>

    <!-- SVG blob for clip-path (hidden, referenced via url(#bh-blob)) -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
      <defs>
        <clipPath id="bh-blob" clipPathUnits="objectBoundingBox">
          <path d="M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z" id="bh-blob-path">
            <animate attributeName="d" dur="18s" repeatCount="indefinite" values="
                M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z;
                M0.48,0.02 C0.68,0.0,0.88,0.1,0.96,0.26 C1.02,0.42,0.98,0.62,0.92,0.78 C0.86,0.94,0.68,1.0,0.48,0.98 C0.28,0.96,0.08,0.86,0.03,0.68 C-0.02,0.5,0.04,0.32,0.1,0.2 C0.18,0.08,0.28,0.04,0.48,0.02Z;
                M0.42,0.0 C0.62,-0.01,0.9,0.08,0.97,0.24 C1.03,0.4,1.0,0.6,0.94,0.76 C0.88,0.92,0.7,1.01,0.5,0.99 C0.3,0.97,0.1,0.9,0.04,0.74 C-0.02,0.58,0.02,0.36,0.08,0.22 C0.14,0.08,0.22,0.01,0.42,0.0Z;
                M0.45,0.01 C0.65,-0.02,0.92,0.06,0.98,0.22 C1.04,0.38,1.01,0.58,0.96,0.74 C0.91,0.9,0.72,1.02,0.52,1.0 C0.32,0.98,0.12,0.88,0.05,0.72 C-0.02,0.56,0.0,0.38,0.06,0.24 C0.12,0.1,0.25,0.04,0.45,0.01Z
              " />
          </path>
        </clipPath>
      </defs>
    </svg>

    <!-- Sacred geometry — Flower of Life -->
    <div class="bh-sacred bh-sacred-1" aria-hidden="true">
      <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="100" cy="100" r="40" stroke="white" stroke-width=".5" />
        <circle cx="100" cy="60" r="40" stroke="white" stroke-width=".5" />
        <circle cx="100" cy="140" r="40" stroke="white" stroke-width=".5" />
        <circle cx="65" cy="80" r="40" stroke="white" stroke-width=".5" />
        <circle cx="135" cy="80" r="40" stroke="white" stroke-width=".5" />
        <circle cx="65" cy="120" r="40" stroke="white" stroke-width=".5" />
        <circle cx="135" cy="120" r="40" stroke="white" stroke-width=".5" />
      </svg>
    </div>
    <div class="bh-sacred bh-sacred-2" aria-hidden="true">
      <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="100" cy="100" r="50" stroke="white" stroke-width=".5" />
        <circle cx="100" cy="50" r="50" stroke="white" stroke-width=".5" />
        <circle cx="100" cy="150" r="50" stroke="white" stroke-width=".5" />
        <circle cx="57" cy="75" r="50" stroke="white" stroke-width=".5" />
        <circle cx="143" cy="75" r="50" stroke="white" stroke-width=".5" />
        <circle cx="57" cy="125" r="50" stroke="white" stroke-width=".5" />
        <circle cx="143" cy="125" r="50" stroke="white" stroke-width=".5" />
      </svg>
    </div>

    <!-- Floating particles container -->
    <div id="bh-particles" aria-hidden="true"></div>

    <!-- ── SLIDES ── -->
    <?php foreach ($slides as $i => $s): ?>
      <div class="bh-slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>">

        <!-- Image + blob mask -->
        <div class="bh-img-wrap" id="bh-img-wrap-<?php echo $i; ?>">
          <?php echo bes_get_hero_image_html($s, $i); ?>
          <div class="bh-img-overlay"></div>
        </div>

        <!-- Text content — asymmetric left -->
        <div class="bh-content">
          <!-- Kicker -->
          <div class="bh-kicker mb-6 lg:mb-8">
            <span class="bh-kicker-line"></span>
            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(194,210,74,.7)">
              <?php echo esc_html($s['kicker']); ?>
            </span>
          </div>

          <!-- Title — dramatic oversized with italic accent -->
          <h1 style="margin:0;padding:0">
            <span class="bh-title-line bh-t1">
              <span class="bh-title-inner" style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,6vw,5.5rem);font-weight:300;color:#FDFCFA;letter-spacing:-0.02em;line-height:1.05;display:block">
                <?php echo $s['title_1']; ?>
              </span>
            </span>
            <span class="bh-title-line bh-t2">
              <span class="bh-title-inner" style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,6vw,5.5rem);font-weight:300;color:#FDFCFA;letter-spacing:-0.02em;line-height:1.05;display:block">
                <?php echo $s['title_2']; ?>
              </span>
            </span>
            <span class="bh-title-line bh-t3">
              <span class="bh-title-inner" style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,7.5vw,7rem);font-weight:300;font-style:italic;color:#C2D24A;letter-spacing:-0.02em;line-height:1.0;display:block">
                <?php echo $s['title_em']; ?>
              </span>
            </span>
          </h1>

          <!-- Description -->
          <p class="bh-desc" style="font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;line-height:1.8;color:rgba(253,252,250,.45);max-width:440px;margin:24px 0 32px;font-weight:300">
            <?php echo esc_html($s['desc']); ?>
          </p>

          <!-- CTA -->
          <div class="bh-cta">
            <a href="<?php echo esc_url($s['link']); ?>" class="bh-btn">
              <span><?php echo esc_html($s['btn']); ?></span>
              <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- ── Transition wipe ── -->
    <div class="bh-wipe" id="bh-wipe" aria-hidden="true"></div>

    <!-- ── Vertical Timeline Nav ── -->
    <div class="bh-timeline" role="tablist" aria-label="Slide navigation">
      <?php foreach ($slides as $i => $s): ?>
        <div class="bh-tl-item <?php echo $i === 0 ? 'is-active' : ''; ?>" data-target="<?php echo $i; ?>" role="tab" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>" tabindex="0">
          <div class="bh-tl-node">
            <svg class="bh-tl-ring" viewBox="0 0 22 22">
              <circle cx="11" cy="11" r="10" id="bh-ring-<?php echo $i; ?>" />
            </svg>
          </div>
          <span class="bh-tl-label"><?php echo esc_html($s['tag']); ?></span>
          <?php if ($i < $total - 1): ?><div class="bh-tl-line"></div><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Mobile dots ── -->
    <div class="bh-mobile-dots">
      <?php foreach ($slides as $i => $s): ?>
        <button class="bh-m-dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-target="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
      <?php endforeach; ?>
    </div>

    <!-- ── Slide counter (bottom-left) ── -->
    <div class="bh-counter">
      <span class="bh-counter-cur" id="bh-cur">01</span>
      <span class="bh-counter-sep">/</span>
      <span class="bh-counter-tot"><?php echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></span>
    </div>

    <!-- ── Scroll cue ── -->
    <div class="bh-scroll-cue" aria-hidden="true">
      <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:8px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.3);font-weight:600">Scroll</span>
      <div class="bh-scroll-line">
        <div class="bh-scroll-fill"></div>
      </div>
    </div>
  </section>

  <!-- ================================================================
         HERO JAVASCRIPT
         ================================================================ -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      'use strict';

      var slides = document.querySelectorAll('.bh-slide');
      var tlItems = document.querySelectorAll('.bh-tl-item');
      var mDots = document.querySelectorAll('.bh-m-dot');
      var wipe = document.getElementById('bh-wipe');
      var counterCur = document.getElementById('bh-cur');
      var hero = document.getElementById('bh');
      var total = slides.length;
      var current = 0;
      var isAnimating = false;
      var autoTimer;
      var AUTO_DELAY = 7000;
      var RING_DURATION = AUTO_DELAY;
      var ringCircumference = 62.83; // 2*PI*10

      /* ── Generate floating particles ── */
      var particleBox = document.getElementById('bh-particles');
      if (particleBox) {
        for (var p = 0; p < 18; p++) {
          var dot = document.createElement('div');
          dot.className = 'bh-particle';
          var size = 1.5 + Math.random() * 2.5;
          var isGold = Math.random() > 0.6;
          dot.style.cssText =
            'width:' + size + 'px;height:' + size + 'px;' +
            'left:' + Math.random() * 100 + '%;' +
            'top:' + (30 + Math.random() * 60) + '%;' +
            'background:' + (isGold ? 'rgba(201,168,76,0.3)' : 'rgba(194,210,74,0.2)') + ';' +
            '--dy:-' + (120 + Math.random() * 180) + 'px;' +
            '--dx:' + (Math.random() * 80 - 40) + 'px;' +
            'animation-duration:' + (6 + Math.random() * 8) + 's;' +
            'animation-delay:' + (Math.random() * 6) + 's;';
          particleBox.appendChild(dot);
        }
      }

      /* ── Mouse parallax on image ── */
      if (window.innerWidth > 1024) {
        hero.addEventListener('mousemove', function(e) {
          if (isAnimating) return;
          var rect = hero.getBoundingClientRect();
          var mx = (e.clientX - rect.left) / rect.width - 0.5;
          var my = (e.clientY - rect.top) / rect.height - 0.5;
          var activeWrap = slides[current].querySelector('.bh-img-wrap');
          if (activeWrap) {
            activeWrap.style.transform = 'translate(' + (-mx * 12) + 'px,' + (-my * 8) + 'px)';
            activeWrap.style.transition = 'transform .6s cubic-bezier(.22,1,.36,1)';
          }
        });
        hero.addEventListener('mouseleave', function() {
          var activeWrap = slides[current].querySelector('.bh-img-wrap');
          if (activeWrap) {
            activeWrap.style.transform = '';
            activeWrap.style.transition = 'transform .8s cubic-bezier(.22,1,.36,1)';
          }
        });
      }

      /* ── Slide transition engine ── */
      function goTo(index, skipWipe) {
        if (isAnimating || index === current) return;
        isAnimating = true;

        var prev = current;
        current = index;

        /* Update counter */
        counterCur.style.opacity = '0';
        counterCur.style.transform = 'translateY(-6px)';
        setTimeout(function() {
          counterCur.textContent = String(current + 1).padStart(2, '0');
          counterCur.style.opacity = '';
          counterCur.style.transform = '';
        }, 250);

        /* Update timeline */
        tlItems.forEach(function(tl, i) {
          tl.classList.toggle('is-active', i === current);
          tl.setAttribute('aria-selected', i === current ? 'true' : 'false');
        });

        /* Update mobile dots */
        mDots.forEach(function(d, i) {
          d.classList.toggle('is-active', i === current)
        });

        /* Wipe transition */
        if (!skipWipe && wipe) {
          wipe.classList.add('is-wiping');
          setTimeout(function() {
            slides[prev].classList.remove('is-active');
            slides[current].classList.add('is-active');
            setTimeout(function() {
              wipe.classList.remove('is-wiping');
              wipe.style.transition = 'none';
              wipe.offsetHeight; /* force reflow */
              wipe.style.transition = '';
              isAnimating = false;
            }, 150);
          }, 600);
        } else {
          slides[prev].classList.remove('is-active');
          slides[current].classList.add('is-active');
          setTimeout(function() {
            isAnimating = false;
          }, 800);
        }

        /* Restart ring progress */
        startRingProgress();
      }

      /* ── Ring progress animation ── */
      function startRingProgress() {
        /* Reset all rings */
        for (var r = 0; r < total; r++) {
          var circle = document.getElementById('bh-ring-' + r);
          if (circle) {
            circle.style.transition = 'none';
            circle.style.strokeDashoffset = ringCircumference;
          }
        }
        /* Animate current ring */
        var activeCircle = document.getElementById('bh-ring-' + current);
        if (activeCircle) {
          activeCircle.offsetHeight; /* reflow */
          activeCircle.style.transition = 'stroke-dashoffset ' + (RING_DURATION / 1000) + 's linear';
          activeCircle.style.strokeDashoffset = '0';
        }
      }

      /* ── Auto-advance ── */
      function startAuto() {
        clearInterval(autoTimer);
        autoTimer = setInterval(function() {
          goTo((current + 1) % total);
        }, AUTO_DELAY);
        startRingProgress();
      }

      function resetAuto() {
        clearInterval(autoTimer);
        startAuto();
      }

      /* ── Timeline click ── */
      tlItems.forEach(function(tl) {
        tl.addEventListener('click', function() {
          var t = parseInt(this.getAttribute('data-target'), 10);
          goTo(t);
          resetAuto();
        });
        tl.addEventListener('keydown', function(e) {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            var t = parseInt(this.getAttribute('data-target'), 10);
            goTo(t);
            resetAuto();
          }
        });
      });

      /* ── Mobile dots click ── */
      mDots.forEach(function(d) {
        d.addEventListener('click', function() {
          var t = parseInt(this.getAttribute('data-target'), 10);
          goTo(t);
          resetAuto();
        });
      });

      /* ── Swipe support ── */
      var touchStartX = 0;
      hero.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      }, {
        passive: true
      });
      hero.addEventListener('touchend', function(e) {
        var diff = e.changedTouches[0].screenX - touchStartX;
        if (Math.abs(diff) > 50) {
          if (diff < 0) goTo((current + 1) % total);
          else goTo((current - 1 + total) % total);
          resetAuto();
        }
      }, {
        passive: true
      });

      /* ── Keyboard arrows ── */
      document.addEventListener('keydown', function(e) {
        if (!isElementInViewport(hero)) return;
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
          goTo((current + 1) % total);
          resetAuto();
        } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
          goTo((current - 1 + total) % total);
          resetAuto();
        }
      });

      function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom > 0;
      }

      /* ── Start ── */
      startAuto();
    });
  </script>

<?php
  return ob_get_clean();
}