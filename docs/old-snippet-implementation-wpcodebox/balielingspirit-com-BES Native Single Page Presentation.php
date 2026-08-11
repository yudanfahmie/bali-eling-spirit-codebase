<?php
/**
 * Plugin Name: BES Native Single Page Presentation
 * Description: Adds a polished, brand-aligned layout to native WordPress editor pages while leaving shortcode and page-builder output untouched.
 * Version: 1.0.1
 * Author: Bali Eling Spirit
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Determine whether the current page should receive the native editor layout.
 *
 * Rules:
 * - Main, public, singular Page only.
 * - Never front page, feeds, REST, previews, password-protected pages, or builder pages.
 * - Skip any page whose saved content contains a registered shortcode.
 * - `_bes_native_page_layout` can explicitly enable (`1`) or disable (`0`) the layout.
 */
function bes_native_page_is_eligible($post = null)
{
    if (
        is_admin()
        || wp_doing_ajax()
        || is_feed()
        || is_embed()
        || is_preview()
        || ! is_page()
        || is_front_page()
    ) {
        return false;
    }

    $post = get_post($post ?: get_queried_object_id());

    if (! $post instanceof WP_Post || 'page' !== $post->post_type || post_password_required($post)) {
        return false;
    }

    $override = get_post_meta($post->ID, '_bes_native_page_layout', true);

    if ('0' === $override) {
        return false;
    }

    if ('1' === $override) {
        return true;
    }

    // Common visual builders should retain complete control of their markup.
    $builder_meta_keys = [
        '_elementor_edit_mode',
        '_elementor_data',
        '_fl_builder_enabled',
        '_et_pb_use_builder',
        '_wpb_vc_js_status',
    ];

    foreach ($builder_meta_keys as $meta_key) {
        $value = get_post_meta($post->ID, $meta_key, true);
        if (! empty($value)) {
            return false;
        }
    }

    $raw_content = (string) $post->post_content;

    // Skip pages containing any currently registered shortcode.
    if (false !== strpos($raw_content, '[')) {
        $pattern = get_shortcode_regex();
        if ($pattern && preg_match('/' . $pattern . '/s', $raw_content)) {
            return false;
        }
    }

    return (bool) apply_filters('bes_native_page_is_eligible', true, $post);
}

/**
 * Add a narrowly scoped body class used by all CSS selectors.
 */
add_filter('body_class', function ($classes) {
    if (bes_native_page_is_eligible()) {
        $classes[] = 'bes-native-editor-page';
    }

    return $classes;
});

/**
 * Wrap only the main page content generated from the native editor.
 */
add_filter('the_content', function ($content) {
    if (
        ! bes_native_page_is_eligible()
        || ! in_the_loop()
        || ! is_main_query()
    ) {
        return $content;
    }

    static $wrapped = false;
    if ($wrapped) {
        return $content;
    }
    $wrapped = true;

    $post_id = get_the_ID();
    $title   = get_the_title($post_id);
    $excerpt = get_the_excerpt($post_id);

    $eyebrow = apply_filters('bes_native_page_eyebrow', __('Bali Eling Spirit', 'bes-native-page'), $post_id);

    $header = sprintf(
        '<header class="bes-native-page__hero" data-bes-header-theme="dark">' .
            '<div class="bes-native-page__hero-inner">' .
                '<p class="bes-native-page__eyebrow">%1$s</p>' .
                '<h1 class="bes-native-page__title">%2$s</h1>' .
                '%3$s' .
            '</div>' .
        '</header>',
        esc_html($eyebrow),
        esc_html($title),
        $excerpt ? '<p class="bes-native-page__lead">' . esc_html($excerpt) . '</p>' : ''
    );

    return '<article class="bes-native-page" aria-labelledby="bes-native-page-title">'
        . str_replace('class="bes-native-page__title"', 'id="bes-native-page-title" class="bes-native-page__title"', $header)
        . '<div class="bes-native-page__shell">'
        . '<div class="bes-native-page__content">'
        . $content
        . '</div>'
        . '</div>'
        . '</article>';
}, 20);

/**
 * Load only scoped presentation CSS on eligible pages.
 * Uses the existing BES design tokens with safe fallbacks.
 */
add_action('wp_enqueue_scripts', function () {
    if (! bes_native_page_is_eligible()) {
        return;
    }

    wp_register_style('bes-native-single-page', false, [], '1.0.1');
    wp_enqueue_style('bes-native-single-page');

    $css = <<<'CSS'
body.bes-native-editor-page {
    --bes-native-forest: var(--bes-forest, #1E2A16);
    --bes-native-forest-deep: var(--bes-forest-deep, #151E10);
    --bes-native-olive: var(--bes-olive, #3F5130);
    --bes-native-leaf: var(--bes-leaf, #C2D24A);
    --bes-native-gold: var(--bes-gold, #C9A84C);
    --bes-native-parchment: var(--bes-parchment, #F7F4EE);
    --bes-native-ivory: var(--bes-ivory, #FDFCFA);
    --bes-native-sand: var(--bes-sand, #EBE6DC);
    --bes-native-bark: var(--bes-bark, #1C2415);
    --bes-native-muted: var(--bes-bark-muted, #6B7A5E);
}

body.bes-native-editor-page main.site-main,
body.bes-native-editor-page main#content {
    width: 100%;
    max-width: none;
    min-height: 0;
    margin-bottom: 0;
    padding: 0;
    background: var(--bes-native-parchment);
}

body.bes-native-editor-page main.site-main > .page-header,
body.bes-native-editor-page main#content > .page-header {
    display: none;
}

body.bes-native-editor-page main.site-main > .page-content,
body.bes-native-editor-page main#content > .page-content {
    width: 100%;
    max-width: none;
    min-height: 0;
    margin: 0;
    padding: 0;
    background: transparent;
}

.bes-native-page {
    position: relative;
    width: 100%;
    margin: 0;
    overflow: clip;
    color: var(--bes-native-bark);
    background: var(--bes-native-parchment);
}

.bes-native-page__hero {
    position: relative;
    isolation: isolate;
    display: grid;
    place-items: end start;
    min-height: clamp(360px, 52vw, 620px);
    padding: clamp(140px, 17vw, 210px) clamp(20px, 6vw, 88px) clamp(64px, 9vw, 112px);
    background:
        radial-gradient(circle at 82% 18%, rgba(194, 210, 74, 0.16), transparent 27%),
        radial-gradient(circle at 12% 84%, rgba(201, 168, 76, 0.10), transparent 30%),
        linear-gradient(135deg, var(--bes-native-forest-deep), var(--bes-native-forest));
}

.bes-native-page__hero::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: -1;
    opacity: 0.28;
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
    background-size: 48px 48px;
    mask-image: linear-gradient(to bottom, transparent, #000 30%, #000);
}

.bes-native-page__hero-inner {
    width: min(100%, 980px);
    margin-inline: auto;
}

.bes-native-page__eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 0 18px;
    color: var(--bes-native-leaf);
    font-family: 'Plus Jakarta Sans', 'Helvetica Neue', Arial, sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    line-height: 1.4;
    text-transform: uppercase;
}

.bes-native-page__eyebrow::before {
    content: '';
    width: 32px;
    height: 1px;
    background: currentColor;
}

.bes-native-page__title {
    max-width: 850px;
    margin: 0;
    color: var(--bes-native-ivory);
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(3rem, 8vw, 6.75rem);
    font-weight: 500;
    letter-spacing: -0.035em;
    line-height: 0.92;
    text-wrap: balance;
}

.bes-native-page__lead {
    max-width: 720px;
    margin: 28px 0 0;
    color: rgba(253, 252, 250, 0.72);
    font-size: clamp(1rem, 1.8vw, 1.2rem);
    line-height: 1.8;
}

.bes-native-page__shell {
    position: relative;
    z-index: 1;
    width: min(calc(100% - 32px), 1080px);
    margin: clamp(-42px, -5vw, -64px) auto 0;
}

.bes-native-page__content {
    padding: clamp(32px, 6vw, 76px) clamp(24px, 6vw, 76px) clamp(36px, 4.5vw, 56px);
    border: 1px solid rgba(63, 81, 48, 0.10);
    border-radius: 4px;
    background: rgba(253, 252, 250, 0.96);
    box-shadow: 0 24px 80px rgba(21, 30, 16, 0.10);
    font-family: 'Plus Jakarta Sans', 'Helvetica Neue', Arial, sans-serif;
    font-size: clamp(1rem, 1.1vw, 1.075rem);
    line-height: 1.85;
}

.bes-native-page__content > :first-child {
    margin-top: 0;
}

.bes-native-page__content > :last-child {
    margin-bottom: 0;
}

.bes-native-page__content h2,
.bes-native-page__content h3,
.bes-native-page__content h4,
.bes-native-page__content h5,
.bes-native-page__content h6 {
    color: var(--bes-native-bark);
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 600;
    letter-spacing: -0.02em;
    line-height: 1.08;
    text-wrap: balance;
}

.bes-native-page__content h2 {
    margin: clamp(48px, 7vw, 76px) 0 20px;
    padding-top: 22px;
    border-top: 1px solid rgba(63, 81, 48, 0.14);
    font-size: clamp(2rem, 4vw, 3.25rem);
}

.bes-native-page__content h3 {
    margin: 42px 0 16px;
    font-size: clamp(1.65rem, 3vw, 2.25rem);
}

.bes-native-page__content h4 {
    margin: 34px 0 14px;
    font-size: clamp(1.35rem, 2.3vw, 1.75rem);
}

.bes-native-page__content p,
.bes-native-page__content ul,
.bes-native-page__content ol,
.bes-native-page__content blockquote,
.bes-native-page__content table,
.bes-native-page__content figure,
.bes-native-page__content pre {
    margin-top: 0;
    margin-bottom: 1.55em;
}

.bes-native-page__content a {
    color: var(--bes-native-olive);
    text-decoration-color: rgba(63, 81, 48, 0.32);
    text-decoration-thickness: 1px;
    text-underline-offset: 0.2em;
    transition: color 180ms ease, text-decoration-color 180ms ease;
}

.bes-native-page__content a:hover {
    color: var(--bes-native-forest);
    text-decoration-color: var(--bes-native-leaf);
}

/*
 * Native-editor lists need their own markers because Tailwind's preflight
 * intentionally removes browser bullets and numbering. Structural lists such
 * as galleries, social links, and menus are excluded from this presentation.
 */
.bes-native-page__content :where(
    ul:not([class*='menu']):not([class*='gallery']):not([class*='social']),
    ol:not([class*='menu']):not([class*='gallery']):not([class*='social'])
) {
    display: grid;
    gap: 0;
    margin: 0 0 1.75em;
    padding: 0;
    overflow: hidden;
    border: 1px solid rgba(63, 81, 48, 0.14);
    border-radius: 4px;
    background: linear-gradient(180deg, rgba(253, 252, 250, 0.98), rgba(247, 244, 238, 0.76));
    box-shadow: 0 12px 36px rgba(21, 30, 16, 0.05);
    list-style: none;
}

.bes-native-page__content :where(
    ul:not([class*='menu']):not([class*='gallery']):not([class*='social']),
    ol:not([class*='menu']):not([class*='gallery']):not([class*='social'])
) > li {
    position: relative;
    min-height: 56px;
    margin: 0;
    padding: 14px 18px 14px 52px;
    border-bottom: 1px solid rgba(63, 81, 48, 0.10);
    transition: background-color 180ms ease;
}

.bes-native-page__content :where(
    ul:not([class*='menu']):not([class*='gallery']):not([class*='social']),
    ol:not([class*='menu']):not([class*='gallery']):not([class*='social'])
) > li:last-child {
    border-bottom: 0;
}

.bes-native-page__content :where(
    ul:not([class*='menu']):not([class*='gallery']):not([class*='social']),
    ol:not([class*='menu']):not([class*='gallery']):not([class*='social'])
) > li:hover {
    background: rgba(194, 210, 74, 0.07);
}

.bes-native-page__content ul:not([class*='menu']):not([class*='gallery']):not([class*='social']) > li::before {
    content: '';
    position: absolute;
    top: 1.55rem;
    left: 20px;
    width: 9px;
    height: 9px;
    border: 2px solid var(--bes-native-olive);
    border-radius: 50%;
    background: var(--bes-native-leaf);
    box-shadow: 0 0 0 4px rgba(194, 210, 74, 0.14);
    transform: translateY(-50%);
}

.bes-native-page__content ol:not([class*='menu']):not([class*='gallery']):not([class*='social']) {
    counter-reset: bes-native-list;
}

.bes-native-page__content ol:not([class*='menu']):not([class*='gallery']):not([class*='social']) > li {
    counter-increment: bes-native-list;
}

.bes-native-page__content ol:not([class*='menu']):not([class*='gallery']):not([class*='social']) > li::before {
    content: counter(bes-native-list);
    position: absolute;
    top: 14px;
    left: 14px;
    display: grid;
    width: 27px;
    height: 27px;
    place-items: center;
    border: 1px solid rgba(63, 81, 48, 0.22);
    border-radius: 50%;
    color: var(--bes-native-forest);
    background: rgba(194, 210, 74, 0.22);
    font-size: 0.72rem;
    font-weight: 800;
    line-height: 1;
}

.bes-native-page__content :where(ul, ol) > li > :first-child {
    margin-top: 0;
}

.bes-native-page__content :where(ul, ol) > li > :last-child {
    margin-bottom: 0;
}

.bes-native-page__content :where(ul, ol) > li > :where(ul, ol) {
    margin-top: 12px;
    margin-bottom: 2px;
    box-shadow: none;
}

.bes-native-page__content blockquote {
    margin-inline: 0;
    padding: 24px 28px;
    border-left: 3px solid var(--bes-native-leaf);
    border-radius: 0 4px 4px 0;
    background: color-mix(in srgb, var(--bes-native-sand) 62%, transparent);
    color: var(--bes-native-forest);
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(1.35rem, 2.4vw, 1.85rem);
    line-height: 1.45;
}

.bes-native-page__content img {
    display: block;
    max-width: 100%;
    height: auto;
    border-radius: 4px;
}

.bes-native-page__content figure figcaption {
    margin-top: 10px;
    color: var(--bes-native-muted);
    font-size: 0.82rem;
    line-height: 1.55;
    text-align: center;
}

.bes-native-page__content table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border: 1px solid rgba(63, 81, 48, 0.14);
    border-radius: 4px;
}

.bes-native-page__content th,
.bes-native-page__content td {
    padding: 14px 16px;
    border-bottom: 1px solid rgba(63, 81, 48, 0.12);
    text-align: left;
    vertical-align: top;
}

.bes-native-page__content th {
    color: var(--bes-native-ivory);
    background: var(--bes-native-forest);
    font-size: 0.82rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.bes-native-page__content hr {
    height: 1px;
    margin: 52px 0;
    border: 0;
    background: linear-gradient(90deg, transparent, rgba(63, 81, 48, 0.25), transparent);
}

.bes-native-page__content :where(input, textarea, select) {
    width: 100%;
    min-height: 48px;
    padding: 12px 14px;
    border: 1px solid rgba(63, 81, 48, 0.24);
    border-radius: 4px;
    color: var(--bes-native-bark);
    background: var(--bes-native-ivory);
    font: inherit;
}

.bes-native-page__content textarea {
    min-height: 150px;
    resize: vertical;
}

.bes-native-page__content :where(input, textarea, select):focus-visible {
    border-color: var(--bes-native-olive);
    outline: 2px solid rgba(194, 210, 74, 0.48);
    outline-offset: 2px;
}

.bes-native-page__content :where(button, input[type='submit'], .wp-element-button) {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 12px 22px;
    border: 1px solid transparent;
    border-radius: 4px;
    color: var(--bes-native-ivory);
    background: var(--bes-native-olive);
    font: 700 0.78rem/1 'Plus Jakarta Sans', sans-serif;
    letter-spacing: 0.12em;
    text-decoration: none;
    text-transform: uppercase;
    cursor: pointer;
    transition: transform 180ms ease, background-color 180ms ease, box-shadow 180ms ease;
}

.bes-native-page__content :where(button, input[type='submit'], .wp-element-button):hover {
    background: var(--bes-native-forest);
    box-shadow: 0 10px 28px rgba(21, 30, 16, 0.14);
    transform: translateY(-1px);
}

@media (max-width: 680px) {
    .bes-native-page__hero {
        min-height: 390px;
        padding-inline: 20px;
    }

    .bes-native-page__shell {
        width: min(calc(100% - 20px), 1080px);
        margin-top: -30px;
    }

    .bes-native-page__content {
        padding: 28px 22px 32px;
    }

    .bes-native-page__content :where(
        ul:not([class*='menu']):not([class*='gallery']):not([class*='social']),
        ol:not([class*='menu']):not([class*='gallery']):not([class*='social'])
    ) > li {
        min-height: 52px;
        padding: 13px 14px 13px 46px;
    }

    .bes-native-page__content ul:not([class*='menu']):not([class*='gallery']):not([class*='social']) > li::before {
        left: 17px;
    }

    .bes-native-page__content ol:not([class*='menu']):not([class*='gallery']):not([class*='social']) > li::before {
        left: 11px;
    }

    .bes-native-page__content table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}

@media (prefers-reduced-motion: reduce) {
    .bes-native-page *,
    .bes-native-page *::before,
    .bes-native-page *::after {
        scroll-behavior: auto;
        transition-duration: 0.01ms;
        animation-duration: 0.01ms;
        animation-iteration-count: 1;
    }
}
CSS;

    wp_add_inline_style('bes-native-single-page', $css);
}, 20);