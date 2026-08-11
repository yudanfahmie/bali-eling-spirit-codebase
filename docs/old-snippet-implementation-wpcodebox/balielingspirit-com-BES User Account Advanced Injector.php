<?php
/**
 * BES User Account Advanced Injector
 *
 * Surgical visual and interaction layer for the MasterStudy LMS User Account area.
 * The snippet keeps the original template, preserves plugin behavior, and injects
 * a scoped BES design system with responsive layout, account menu rescue, mobile
 * sidebar handling, analytics cards, instructor course cards, gradebook tables,
 * forms, modals, loaders, and runtime DOM repair.
 *
 * @package BaliElingSpirit
 * @version 2.0.50
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('bes_account_surgical_tokens')) {
    /**
     * Reuse the BES palette when available, with safe fallbacks that match the
     * established Course Player injector tokens.
     */
    function bes_account_surgical_tokens(): array {
        $fallback = [
            'forest'      => '#1E2A16',
            'forest_deep' => '#151E10',
            'forest_92'   => '#263320',
            'forest_80'   => '#2E3C28',
            'olive'       => '#3F5130',
            'olive_dark'  => '#344528',
            'olive_light' => '#506440',
            'moss'        => '#6B7F5A',
            'sage'        => '#94A883',
            'leaf'        => '#C2D24A',
            'leaf_hover'  => '#AFBF38',
            'leaf_soft'   => '#D8E48C',
            'leaf_glow'   => 'rgba(194,210,74,0.15)',
            'gold'        => '#C9A84C',
            'gold_soft'   => '#E8D5A0',
            'parchment'   => '#F7F4EE',
            'ivory'       => '#FDFCFA',
            'sand'        => '#EBE6DC',
            'cream'       => '#F2EDE4',
            'bark'        => '#1C2415',
            'bark_soft'   => '#3A4A2F',
            'bark_muted'  => '#6B7A5E',
        ];

        $global = (defined('BES_COLORS') && is_array(BES_COLORS)) ? BES_COLORS : [];

        return array_merge($fallback, array_intersect_key($global, $fallback));
    }
}

if (! function_exists('bes_account_surgical_css_value')) {
    /**
     * Permit only simple color values expected from the token map.
     */
    function bes_account_surgical_css_value(array $tokens, string $key): string {
        $value = isset($tokens[$key]) ? trim((string) $tokens[$key]) : '';

        if (preg_match('/^#(?:[0-9a-f]{3}|[0-9a-f]{6})$/i', $value)) {
            return $value;
        }

        if (preg_match('/^rgba?\([0-9\s.,%]+\)$/i', $value)) {
            return $value;
        }

        return '#000000';
    }
}

if (! function_exists('bes_account_surgical_should_target')) {
    /**
     * Target the full MasterStudy account route tree without depending on a specific page ID.
     */
    function bes_account_surgical_should_target(): bool {
        if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
            return false;
        }

        $request_uri = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
        $path        = wp_parse_url($request_uri, PHP_URL_PATH);
        $path        = is_string($path) && $path !== '' ? rawurldecode($path) : '/';
        $path        = '/' . ltrim((string) preg_replace('~/+~', '/', $path), '/');

        if (function_exists('home_url')) {
            $home_path = wp_parse_url(home_url('/'), PHP_URL_PATH);
            $home_path = is_string($home_path) ? '/' . trim($home_path, '/') : '';
            if ($home_path !== '' && $home_path !== '/' && stripos($path . '/', $home_path . '/') === 0) {
                $path = '/' . ltrim(substr($path, strlen($home_path)), '/');
            }
        }

        $path_regex = (string) apply_filters(
            'bes_account_surgical_path_regex',
            '#^/user-account(?:/|$)#i'
        );

        $path_trigger = (bool) preg_match($path_regex, $path);

        $page_ids   = (array) apply_filters('bes_account_surgical_page_ids', [303, 332]);
        $page_slugs = (array) apply_filters('bes_account_surgical_page_slugs', ['user-account']);

        $page_trigger = false;
        if (function_exists('is_page')) {
            $page_trigger = is_page($page_ids) || is_page($page_slugs);
        }

        $query_trigger = isset($_GET['profile_view']) || isset($_GET['student_id']) || isset($_GET['course_id']) || isset($_GET['instructor_id']);
        $should        = $path_trigger || $page_trigger || ($query_trigger && (bool) preg_match($path_regex, $path));

        return (bool) apply_filters('bes_account_surgical_should_target', $should, $path, get_post_type(), $request_uri);
    }
}

add_filter('body_class', function (array $classes): array {
    if (bes_account_surgical_should_target()) {
        $classes[] = 'bes-account-surgical-page';
    }

    return array_values(array_unique($classes));
}, 20);


if (! function_exists('bes_account_surgical_strip_ms_plugin_loader_markup')) {
    /**
     * Remove MasterStudy's global full-page loader from account HTML before the browser paints it.
     * This keeps the loader out of the DOM instead of merely hiding it after render.
     */
    function bes_account_surgical_strip_ms_plugin_loader_markup(string $html): string {
        if ($html === '' || (stripos($html, 'ms_plugin_loader_bg_') === false && stripos($html, 'ms_lms_loader_') === false)) {
            return $html;
        }

        $patterns = [
            '~<div\b(?=[^>]*\bclass=(?:"[^"]*\bms_plugin_loader_bg_\b[^"]*"|\'[^\']*\bms_plugin_loader_bg_\b[^\']*\'))[^>]*>\s*<div\b(?=[^>]*\bclass=(?:"[^"]*\bms_lms_loader_\b[^"]*"|\'[^\']*\bms_lms_loader_\b[^\']*\'))[^>]*>\s*</div>\s*</div>~is',
            '~<div\b(?=[^>]*\bclass=(?:"[^"]*\bms_plugin_loader_bg_\b[^"]*"|\'[^\']*\bms_plugin_loader_bg_\b[^\']*\'))[^>]*>\s*</div>~is',
            '~<div\b(?=[^>]*\bclass=(?:"[^"]*\bms_lms_loader_\b[^"]*"|\'[^\']*\bms_lms_loader_\b[^\']*\'))[^>]*>\s*</div>~is',
        ];

        $stripped = preg_replace($patterns, '', $html);

        return is_string($stripped) ? $stripped : $html;
    }
}

if (! function_exists('bes_account_surgical_start_loader_buffer')) {
    function bes_account_surgical_start_loader_buffer(): void {
        if (! bes_account_surgical_should_target()) {
            return;
        }

        ob_start('bes_account_surgical_strip_ms_plugin_loader_markup');
    }
}

add_action('template_redirect', 'bes_account_surgical_start_loader_buffer', 0);

add_action('wp_enqueue_scripts', function (): void {
    if (! bes_account_surgical_should_target()) {
        return;
    }

    $handle  = 'bes-user-account-advanced-injector';
    $version = '2.0.50';
    $tokens  = bes_account_surgical_tokens();

    wp_register_style($handle, false, [], $version);
    wp_enqueue_style($handle);
    wp_add_inline_style($handle, bes_account_surgical_css($tokens));

    wp_register_script($handle, '', [], $version, true);
    wp_enqueue_script($handle);
    wp_add_inline_script($handle, bes_account_surgical_js(), 'after');
}, 9999);

if (! function_exists('bes_account_surgical_css')) {
    function bes_account_surgical_css(array $tokens): string {
        $forest      = bes_account_surgical_css_value($tokens, 'forest');
        $forest_deep = bes_account_surgical_css_value($tokens, 'forest_deep');
        $forest_92   = bes_account_surgical_css_value($tokens, 'forest_92');
        $forest_80   = bes_account_surgical_css_value($tokens, 'forest_80');
        $olive       = bes_account_surgical_css_value($tokens, 'olive');
        $olive_dark  = bes_account_surgical_css_value($tokens, 'olive_dark');
        $olive_light = bes_account_surgical_css_value($tokens, 'olive_light');
        $moss        = bes_account_surgical_css_value($tokens, 'moss');
        $sage        = bes_account_surgical_css_value($tokens, 'sage');
        $leaf        = bes_account_surgical_css_value($tokens, 'leaf');
        $leaf_hover  = bes_account_surgical_css_value($tokens, 'leaf_hover');
        $leaf_soft   = bes_account_surgical_css_value($tokens, 'leaf_soft');
        $leaf_glow   = bes_account_surgical_css_value($tokens, 'leaf_glow');
        $gold        = bes_account_surgical_css_value($tokens, 'gold');
        $gold_soft   = bes_account_surgical_css_value($tokens, 'gold_soft');
        $parchment   = bes_account_surgical_css_value($tokens, 'parchment');
        $ivory       = bes_account_surgical_css_value($tokens, 'ivory');
        $sand        = bes_account_surgical_css_value($tokens, 'sand');
        $cream       = bes_account_surgical_css_value($tokens, 'cream');
        $bark        = bes_account_surgical_css_value($tokens, 'bark');
        $bark_soft   = bes_account_surgical_css_value($tokens, 'bark_soft');
        $bark_muted  = bes_account_surgical_css_value($tokens, 'bark_muted');

        return <<<CSS
/* ==========================================================================
   BES User Account Advanced Injector
   Scope: body.bes-account-surgical-page only.
   ========================================================================== */
html body.bes-account-surgical-page {
    --bes-account-forest: var(--bes-forest, {$forest});
    --bes-account-forest-deep: var(--bes-forest-deep, {$forest_deep});
    --bes-account-forest-92: var(--bes-forest-92, {$forest_92});
    --bes-account-forest-80: var(--bes-forest-80, {$forest_80});
    --bes-account-olive: var(--bes-olive, {$olive});
    --bes-account-olive-dark: var(--bes-olive-dark, {$olive_dark});
    --bes-account-olive-light: var(--bes-olive-light, {$olive_light});
    --bes-account-moss: var(--bes-moss, {$moss});
    --bes-account-sage: var(--bes-sage, {$sage});
    --bes-account-leaf: var(--bes-leaf, {$leaf});
    --bes-account-leaf-hover: var(--bes-leaf-hover, {$leaf_hover});
    --bes-account-leaf-soft: var(--bes-leaf-soft, {$leaf_soft});
    --bes-account-leaf-glow: var(--bes-leaf-glow, {$leaf_glow});
    --bes-account-gold: var(--bes-gold, {$gold});
    --bes-account-gold-soft: var(--bes-gold-soft, {$gold_soft});
    --bes-account-parchment: var(--bes-parchment, {$parchment});
    --bes-account-ivory: var(--bes-ivory, {$ivory});
    --bes-account-sand: var(--bes-sand, {$sand});
    --bes-account-cream: var(--bes-cream, {$cream});
    --bes-account-bark: var(--bes-bark, {$bark});
    --bes-account-bark-soft: var(--bes-bark-soft, {$bark_soft});
    --bes-account-bark-muted: var(--bes-bark-muted, {$bark_muted});
    --bes-account-font-body: var(--bes-font-body, 'Plus Jakarta Sans', 'Helvetica Neue', Arial, sans-serif);
    --bes-account-font-display: var(--bes-font-display, 'Cormorant Garamond', Georgia, 'Times New Roman', serif);
    --bes-account-adminbar-h: 0px;
    --bes-account-header-h: 96px;
    --bes-account-sidebar-w: clamp(286px, 22vw, 348px);
    --bes-account-content-w: minmax(0, 1fr);
    --bes-account-radius-xs: 8px;
    --bes-account-radius-sm: 12px;
    --bes-account-radius-md: 16px;
    --bes-account-radius-lg: 22px;
    --bes-account-radius-xl: 30px;
    --bes-account-shadow-xs: 0 4px 14px rgba(21, 30, 16, .07);
    --bes-account-shadow-soft: 0 14px 40px rgba(21, 30, 16, .10);
    --bes-account-shadow-card: 0 24px 70px rgba(21, 30, 16, .12);
    --bes-account-shadow-deep: 0 30px 90px rgba(21, 30, 16, .22);
    --bes-account-border: rgba(63, 81, 48, .14);
    --bes-account-border-strong: rgba(63, 81, 48, .24);
    --bes-account-border-dark: rgba(194, 210, 74, .16);
    --bes-account-muted-surface: rgba(247, 244, 238, .76);
    --bes-account-glass: rgba(253, 252, 250, .78);
    --bes-account-ease: cubic-bezier(.22, 1, .36, 1);
    --bes-account-ease-standard: cubic-bezier(.4, 0, .2, 1);
    --bes-account-mobile-bar-h: 76px;
    background:
        radial-gradient(circle at 15% 12%, rgba(194, 210, 74, .13), transparent 28vw),
        radial-gradient(circle at 96% 18%, rgba(201, 168, 76, .12), transparent 30vw),
        linear-gradient(135deg, var(--bes-account-cream), var(--bes-account-ivory) 42%, var(--bes-account-parchment));
    color: var(--bes-account-bark);
    font-family: var(--bes-account-font-body) !important;
    overflow-x: clip;
}

html body.admin-bar.bes-account-surgical-page {
    --bes-account-adminbar-h: 32px;
}

@media (max-width: 782px) {
    html body.admin-bar.bes-account-surgical-page {
        --bes-account-adminbar-h: 46px;
    }
}

html body.bes-account-surgical-page.bes-account-menu-open,
html body.bes-account-surgical-page.bes-account-modal-open {
    overflow: hidden !important;
}

html body.bes-account-surgical-page > .ms_plugin_loader_bg_,
html body.bes-account-surgical-page .ms_plugin_loader_bg_,
html body.bes-account-surgical-page .ms_lms_loader_,
body.bes-account-surgical-page .ms_plugin_loader_bg_,
body.bes-account-surgical-page .ms_lms_loader_,
body.bes-account-surgical-page .masterstudy-analytics-loader:not(.show):not(.active),
body.bes-account-surgical-page .masterstudy-instructor-courses__loader:not(.show):not(.active),
body.bes-account-surgical-page .masterstudy-loader,
body.bes-account-surgical-page .masterstudy-loader_global {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

html body.bes-account-surgical-page > .ms_plugin_loader_bg_,
html body.bes-account-surgical-page .ms_plugin_loader_bg_,
html body.bes-account-surgical-page .ms_lms_loader_ {
    position: absolute !important;
    inset: auto !important;
    z-index: -1 !important;
    width: 0 !important;
    min-width: 0 !important;
    max-width: 0 !important;
    height: 0 !important;
    min-height: 0 !important;
    max-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    outline: 0 !important;
    overflow: hidden !important;
    clip: rect(0 0 0 0) !important;
    clip-path: inset(50%) !important;
    transform: scale(0) !important;
    contain: strict !important;
}

body.bes-account-surgical-page :where(.masterstudy-account, .masterstudy-account *) {
    box-sizing: border-box;
}

body.bes-account-surgical-page :where(.masterstudy-account, .masterstudy-account-container, .masterstudy-account-sidebar, .masterstudy-account-mobile-menu) {
    font-family: var(--bes-account-font-body) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account h1, .masterstudy-account h2, .masterstudy-account h3, .masterstudy-account h4, .masterstudy-account h5, .masterstudy-account h6) {
    font-family: var(--bes-account-font-display) !important;
    color: var(--bes-account-bark) !important;
    letter-spacing: -.018em;
    font-weight: 600;
}

body.bes-account-surgical-page :where(.masterstudy-account a) {
    text-decoration: none !important;
    transition: color .22s var(--bes-account-ease-standard), background .22s var(--bes-account-ease-standard), border-color .22s var(--bes-account-ease-standard), transform .22s var(--bes-account-ease-standard), box-shadow .22s var(--bes-account-ease-standard);
}

body.bes-account-surgical-page :where(.masterstudy-account button, .masterstudy-account a, .masterstudy-account input, .masterstudy-account textarea, .masterstudy-account select, .masterstudy-account [tabindex]):focus-visible {
    outline: 2px solid var(--bes-account-leaf) !important;
    outline-offset: 3px !important;
    border-radius: var(--bes-account-radius-sm);
}

body.bes-account-surgical-page .masterstudy-account {
    position: relative !important;
    display: grid !important;
    grid-template-columns: var(--bes-account-sidebar-w) var(--bes-account-content-w) !important;
    gap: clamp(22px, 2.5vw, 38px) !important;
    width: min(1540px, calc(100vw - clamp(28px, 4.5vw, 84px))) !important;
    max-width: min(1540px, calc(100vw - clamp(28px, 4.5vw, 84px))) !important;
    min-height: min(980px, calc(100vh - var(--bes-account-header-h))) !important;
    margin: 0 auto !important;
    padding: calc(var(--bes-account-header-h) + var(--bes-account-adminbar-h) + clamp(26px, 3.8vw, 48px)) 0 clamp(66px, 7vw, 112px) !important;
    isolation: isolate;
}

body.bes-account-surgical-page .masterstudy-account::before {
    content: '';
    position: fixed;
    inset: calc(var(--bes-account-adminbar-h) + var(--bes-account-header-h)) 0 auto 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(63,81,48,.16), rgba(194,210,74,.28), transparent);
    pointer-events: none;
    z-index: 1;
}

body.bes-account-surgical-page .masterstudy-account::after {
    content: '';
    position: absolute;
    inset: clamp(90px, 11vw, 170px) -4vw auto auto;
    width: min(34vw, 430px);
    height: min(34vw, 430px);
    border-radius: 999px;
    background: radial-gradient(circle, rgba(148,168,131,.20), transparent 68%);
    filter: blur(12px);
    opacity: .62;
    pointer-events: none;
    z-index: -1;
}

/* Sidebar shell */
body.bes-account-surgical-page .masterstudy-account-sidebar {
    position: sticky !important;
    top: calc(var(--bes-account-adminbar-h) + 104px) !important;
    align-self: start !important;
    z-index: 12 !important;
    width: 100% !important;
    max-width: var(--bes-account-sidebar-w) !important;
    height: auto !important;
    max-height: calc(100dvh - var(--bes-account-adminbar-h) - 124px) !important;
    padding: 0 !important;
    border-radius: var(--bes-account-radius-xl) !important;
    overflow: hidden !important;
    background:
        radial-gradient(circle at 20% 0%, rgba(194,210,74,.20), transparent 34%),
        linear-gradient(160deg, rgba(21,30,16,.98), rgba(30,42,22,.97) 48%, rgba(38,51,32,.96)) !important;
    border: 1px solid rgba(194, 210, 74, .14) !important;
    box-shadow: var(--bes-account-shadow-deep) !important;
    color: var(--bes-account-ivory) !important;
    backdrop-filter: blur(20px) saturate(1.18);
    -webkit-backdrop-filter: blur(20px) saturate(1.18);
}

body.bes-account-surgical-page .masterstudy-account-sidebar::before {
    content: '';
    position: absolute;
    inset: 0 0 auto 0;
    height: 78px;
    background: linear-gradient(180deg, rgba(253,252,250,.08), transparent);
    pointer-events: none;
    z-index: 0;
}

body.bes-account-surgical-page .masterstudy-account-sidebar::after {
    content: '';
    position: absolute;
    inset: auto 18px 0 18px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(194,210,74,.28), transparent);
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-account-sidebar__wrapper {
    position: relative !important;
    z-index: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 0 !important;
    height: auto !important;
    max-height: inherit !important;
    min-height: min(720px, calc(100dvh - var(--bes-account-adminbar-h) - 124px)) !important;
    padding: 18px 16px 18px !important;
    overflow-y: auto !important;
    overscroll-behavior: contain;
    scrollbar-width: thin;
    scrollbar-color: rgba(194,210,74,.55) rgba(255,255,255,.05);
}

body.bes-account-surgical-page .masterstudy-account-sidebar__wrapper::-webkit-scrollbar {
    width: 5px;
}

body.bes-account-surgical-page .masterstudy-account-sidebar__wrapper::-webkit-scrollbar-track {
    background: rgba(255,255,255,.04);
}

body.bes-account-surgical-page .masterstudy-account-sidebar__wrapper::-webkit-scrollbar-thumb {
    background: rgba(194,210,74,.5);
    border-radius: 99px;
}

body.bes-account-surgical-page .masterstudy-account-sidebar__back {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    align-self: flex-start !important;
    min-height: 34px !important;
    margin: 0 0 12px !important;
    padding: 7px 12px !important;
    border: 1px solid rgba(255,255,255,.08) !important;
    border-radius: 999px !important;
    background: rgba(255,255,255,.06) !important;
    color: rgba(253,252,250,.76) !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: .12em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-account-sidebar__back::before {
    content: '‹';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 17px;
    height: 17px;
    border-radius: 999px;
    background: rgba(194,210,74,.16);
    color: var(--bes-account-leaf);
    font-size: 17px;
    line-height: 1;
}

body.bes-account-surgical-page .masterstudy-account-sidebar__back:hover {
    color: var(--bes-account-ivory) !important;
    border-color: rgba(194,210,74,.30) !important;
    background: rgba(194,210,74,.10) !important;
    transform: translateY(-1px);
}

/* Profile block */
body.bes-account-surgical-page .masterstudy-account-profile {
    position: relative !important;
    display: grid !important;
    grid-template-columns: 62px minmax(0, 1fr) !important;
    gap: 14px !important;
    align-items: center !important;
    width: 100% !important;
    min-height: 92px !important;
    margin: 0 0 16px !important;
    padding: 14px !important;
    border-radius: 22px !important;
    border: 1px solid rgba(194,210,74,.16) !important;
    background:
        linear-gradient(135deg, rgba(255,255,255,.10), rgba(255,255,255,.045)),
        radial-gradient(circle at 0 0, rgba(194,210,74,.16), transparent 55%) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.08), 0 14px 34px rgba(0,0,0,.15) !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-account-profile::after {
    content: '';
    position: absolute;
    inset: auto 14px 0 14px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(194,210,74,.28), transparent);
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-account-profile__avatar {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 62px !important;
    height: 62px !important;
    min-width: 62px !important;
    border-radius: 50% !important;
    overflow: visible !important;
    background: rgba(194,210,74,.12) !important;
    border: 1px solid rgba(194,210,74,.30) !important;
    box-shadow: 0 0 0 5px rgba(194,210,74,.07), 0 12px 26px rgba(0,0,0,.18) !important;
}

body.bes-account-surgical-page .masterstudy-account-profile__avatar::before {
    content: '';
    position: absolute;
    inset: -5px;
    border-radius: inherit;
    border: 1px solid rgba(194,210,74,.17);
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-account-profile__avatar img {
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    border-radius: 50% !important;
    object-fit: cover !important;
}

body.bes-account-surgical-page .masterstudy-account-profile__info {
    min-width: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 7px !important;
}

body.bes-account-surgical-page .masterstudy-account-profile__name {
    display: block !important;
    color: var(--bes-account-ivory) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: clamp(20px, 1.7vw, 24px) !important;
    line-height: 1.02 !important;
    font-weight: 600 !important;
    letter-spacing: -.018em !important;
    max-width: 100% !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}

body.bes-account-surgical-page .masterstudy-account-profile__link {
    display: inline-flex !important;
    align-items: center !important;
    gap: 7px !important;
    width: max-content !important;
    max-width: 100% !important;
    color: rgba(253,252,250,.67) !important;
    font-size: 11px !important;
    line-height: 1.2 !important;
    font-weight: 700 !important;
    letter-spacing: .10em !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-account-profile__link::after {
    content: '↗';
    color: var(--bes-account-leaf);
    font-size: 11px;
    opacity: .9;
}

body.bes-account-surgical-page .masterstudy-account-profile__link:hover {
    color: var(--bes-account-leaf) !important;
}

/* Instructor mode switch */
body.bes-account-surgical-page .masterstudy-account-menu__mode {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    min-height: 48px !important;
    margin: 0 0 14px !important;
    padding: 10px 12px 10px 14px !important;
    border: 1px solid rgba(194,210,74,.16) !important;
    border-radius: 18px !important;
    background: rgba(255,255,255,.055) !important;
    color: rgba(253,252,250,.82) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .10em !important;
    line-height: 1.2 !important;
    text-transform: uppercase !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.06) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__mode::before {
    content: '';
    display: inline-flex;
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: var(--bes-account-leaf);
    box-shadow: 0 0 0 5px rgba(194,210,74,.10);
    order: -1;
}

body.bes-account-surgical-page .masterstudy-switcher,
body.bes-account-surgical-page .masterstudy-account-menu-switcher {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    width: 48px !important;
    min-width: 48px !important;
    height: 28px !important;
    margin-left: auto !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-switcher input {
    position: absolute !important;
    opacity: 0 !important;
    width: 1px !important;
    height: 1px !important;
    pointer-events: none !important;
}

body.bes-account-surgical-page .masterstudy-switcher-background {
    position: relative !important;
    width: 48px !important;
    height: 28px !important;
    border-radius: 999px !important;
    background: rgba(255,255,255,.14) !important;
    border: 1px solid rgba(194,210,74,.18) !important;
    box-shadow: inset 0 1px 3px rgba(0,0,0,.18) !important;
}

body.bes-account-surgical-page .masterstudy-switcher-handle {
    position: absolute !important;
    top: 3px !important;
    left: 3px !important;
    width: 22px !important;
    height: 22px !important;
    border-radius: 999px !important;
    background: var(--bes-account-ivory) !important;
    box-shadow: 0 5px 14px rgba(0,0,0,.28) !important;
    transform: translateX(0) !important;
    transition: transform .25s var(--bes-account-ease), background .25s ease !important;
}

body.bes-account-surgical-page .masterstudy-switcher input:checked + .masterstudy-switcher-background,
body.bes-account-surgical-page .masterstudy-account-menu__mode.bes-account-switch-active .masterstudy-switcher-background {
    background: linear-gradient(135deg, var(--bes-account-leaf), var(--bes-account-gold)) !important;
    border-color: rgba(255,255,255,.22) !important;
}

body.bes-account-surgical-page .masterstudy-switcher input:checked + .masterstudy-switcher-background .masterstudy-switcher-handle,
body.bes-account-surgical-page .masterstudy-account-menu__mode.bes-account-switch-active .masterstudy-switcher-handle {
    transform: translateX(20px) !important;
    background: var(--bes-account-forest-deep) !important;
}

/* Sidebar menu */
body.bes-account-surgical-page .masterstudy-account-menu {
    width: 100% !important;
    flex: 1 1 auto !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list {
    display: flex !important;
    flex-direction: column !important;
    gap: 13px !important;
    width: 100% !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-section {
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 5px !important;
    margin: 0 !important;
    padding: 12px 9px 10px !important;
    border: 1px solid rgba(255,255,255,.055) !important;
    border-radius: 20px !important;
    background: rgba(255,255,255,.032) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-section-title {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    margin: 0 0 4px !important;
    padding: 0 6px 7px !important;
    color: rgba(253,252,250,.38) !important;
    font-size: 10px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
    letter-spacing: .16em !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-section-title::before {
    content: '';
    width: 14px;
    height: 3px;
    border-radius: 99px;
    background: linear-gradient(90deg, var(--bes-account-leaf), rgba(194,210,74,0));
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item {
    position: relative !important;
    display: grid !important;
    grid-template-columns: 34px minmax(0, 1fr) auto !important;
    align-items: center !important;
    gap: 10px !important;
    min-height: 44px !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 7px 10px 7px 9px !important;
    border: 1px solid transparent !important;
    border-radius: 15px !important;
    background: transparent !important;
    color: rgba(253,252,250,.66) !important;
    font-size: 13px !important;
    line-height: 1.25 !important;
    font-weight: 700 !important;
    letter-spacing: -.005em !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item::before {
    content: '';
    position: absolute;
    inset: 8px auto 8px 0;
    width: 3px;
    border-radius: 0 999px 999px 0;
    background: var(--bes-account-leaf);
    opacity: 0;
    transform: scaleY(.45);
    transition: opacity .22s ease, transform .22s var(--bes-account-ease);
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: linear-gradient(90deg, rgba(194,210,74,.13), transparent 64%);
    opacity: 0;
    pointer-events: none;
    transition: opacity .22s ease;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item i {
    position: relative !important;
    z-index: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 34px !important;
    height: 34px !important;
    min-width: 34px !important;
    border-radius: 12px !important;
    background: rgba(255,255,255,.055) !important;
    color: rgba(194,210,74,.78) !important;
    font-size: 16px !important;
    line-height: 1 !important;
    transition: background .22s ease, color .22s ease, transform .22s var(--bes-account-ease) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item-label {
    position: relative !important;
    z-index: 1 !important;
    display: block !important;
    min-width: 0 !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    color: inherit !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item-badge {
    position: relative !important;
    z-index: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 24px !important;
    height: 24px !important;
    padding: 0 8px !important;
    border-radius: 999px !important;
    background: var(--bes-account-leaf) !important;
    color: var(--bes-account-forest-deep) !important;
    font-size: 11px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
    box-shadow: 0 0 0 4px rgba(194,210,74,.10) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item:hover {
    color: var(--bes-account-ivory) !important;
    background: rgba(255,255,255,.06) !important;
    border-color: rgba(194,210,74,.16) !important;
    transform: translateX(2px) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item:hover::after {
    opacity: 1;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item:hover i {
    background: rgba(194,210,74,.16) !important;
    color: var(--bes-account-leaf) !important;
    transform: translateY(-1px) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_active,
body.bes-account-surgical-page .masterstudy-account-menu__list-item.bes-account-route-active,
body.bes-account-surgical-page .masterstudy-account-menu__list-item[aria-current="page"] {
    color: var(--bes-account-ivory) !important;
    background:
        linear-gradient(135deg, rgba(194,210,74,.16), rgba(255,255,255,.055)),
        rgba(255,255,255,.045) !important;
    border-color: rgba(194,210,74,.28) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.08), 0 10px 22px rgba(0,0,0,.13) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_active::before,
body.bes-account-surgical-page .masterstudy-account-menu__list-item.bes-account-route-active::before,
body.bes-account-surgical-page .masterstudy-account-menu__list-item[aria-current="page"]::before {
    opacity: 1;
    transform: scaleY(1);
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_active::after,
body.bes-account-surgical-page .masterstudy-account-menu__list-item.bes-account-route-active::after,
body.bes-account-surgical-page .masterstudy-account-menu__list-item[aria-current="page"]::after {
    opacity: 1;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_active i,
body.bes-account-surgical-page .masterstudy-account-menu__list-item.bes-account-route-active i,
body.bes-account-surgical-page .masterstudy-account-menu__list-item[aria-current="page"] i {
    background: var(--bes-account-leaf) !important;
    color: var(--bes-account-forest-deep) !important;
    box-shadow: 0 0 0 4px rgba(194,210,74,.12) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_logout {
    margin-top: 4px !important;
    color: rgba(253,252,250,.62) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_logout:hover {
    color: var(--bes-account-gold-soft) !important;
    border-color: rgba(201,168,76,.28) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_logout i {
    color: var(--bes-account-gold-soft) !important;
    background: rgba(201,168,76,.11) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_hidden:not(.bes-account-force-visible) {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-account-menu-divider {
    display: block !important;
    width: calc(100% - 20px) !important;
    height: 1px !important;
    min-height: 1px !important;
    margin: 16px auto !important;
    padding: 0 !important;
    background: linear-gradient(90deg, transparent, rgba(194,210,74,.25), rgba(255,255,255,.09), transparent) !important;
    border: 0 !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 9px !important;
    min-height: 48px !important;
    margin-top: auto !important;
    padding: 12px 14px !important;
    border-radius: 17px !important;
    border: 1px solid rgba(194,210,74,.20) !important;
    background: linear-gradient(135deg, rgba(194,210,74,.14), rgba(255,255,255,.055)) !important;
    color: var(--bes-account-ivory) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .11em !important;
    line-height: 1.2 !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.08) !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button::before,
body.bes-account-surgical-page .masterstudy-account-have-question__button::after {
    content: none !important;
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button > i.stmlms-menu-have-question,
body.bes-account-surgical-page .masterstudy-account-have-question__button > .bes-have-question-fallback-icon {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex: 0 0 24px !important;
    width: 24px !important;
    height: 24px !important;
    min-width: 24px !important;
    margin: 0 !important;
    padding: 0 !important;
    border-radius: 999px !important;
    background: var(--bes-account-leaf) !important;
    color: var(--bes-account-forest-deep) !important;
    box-shadow: 0 8px 18px rgba(21,30,16,.18), inset 0 1px 0 rgba(255,255,255,.34) !important;
    overflow: hidden !important;
    transform: none !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button > i.stmlms-menu-have-question::before,
body.bes-account-surgical-page .masterstudy-account-have-question__button > i.stmlms-menu-have-question::after {
    position: static !important;
    display: inline-block !important;
    color: currentColor !important;
    font-size: 13px !important;
    line-height: 1 !important;
    opacity: 1 !important;
    transform: none !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button > .bes-have-question-fallback-icon {
    font-style: normal !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 13px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button .bes-inline-icon,
body.bes-account-surgical-page .masterstudy-account-have-question__button > i.stmlms-menu-have-question ~ i.stmlms-menu-have-question,
body.bes-account-surgical-page .masterstudy-account-have-question__button > .bes-have-question-fallback-icon ~ .bes-have-question-fallback-icon {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__button:hover {
    background: linear-gradient(135deg, rgba(194,210,74,.22), rgba(255,255,255,.075)) !important;
    border-color: rgba(194,210,74,.34) !important;
    transform: translateY(-1px) !important;
}

body.bes-account-surgical-page .masterstudy-account-have-question__label {
    color: inherit !important;
}

/* Content region */
body.bes-account-surgical-page .masterstudy-account-container {
    position: relative !important;
    z-index: 2 !important;
    min-width: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}

body.bes-account-surgical-page .masterstudy-account-container::before {
    content: '';
    position: absolute;
    inset: -24px -24px auto auto;
    width: 220px;
    height: 220px;
    border-radius: 999px;
    border: 1px solid rgba(194,210,74,.16);
    opacity: .52;
    pointer-events: none;
    z-index: -1;
}

body.bes-account-surgical-page .bes-account-hero {
    position: relative;
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    gap: clamp(18px, 2vw, 28px);
    align-items: end;
    width: 100%;
    min-height: clamp(168px, 17vw, 228px);
    margin: 0 0 clamp(22px, 2.8vw, 34px);
    padding: clamp(26px, 3.6vw, 44px);
    border-radius: var(--bes-account-radius-xl);
    border: 1px solid rgba(194,210,74,.17);
    background:
        radial-gradient(circle at 12% 12%, rgba(194,210,74,.23), transparent 32%),
        radial-gradient(circle at 98% 8%, rgba(201,168,76,.18), transparent 28%),
        linear-gradient(135deg, rgba(21,30,16,.98), rgba(30,42,22,.96) 52%, rgba(38,51,32,.96));
    color: var(--bes-account-ivory);
    box-shadow: var(--bes-account-shadow-card);
    overflow: hidden;
}

body.bes-account-surgical-page .bes-account-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        linear-gradient(90deg, rgba(255,255,255,.06), transparent 36%),
        repeating-linear-gradient(135deg, rgba(255,255,255,.025) 0 1px, transparent 1px 18px);
    pointer-events: none;
}

body.bes-account-surgical-page .bes-account-hero::after {
    content: '';
    position: absolute;
    inset: auto 32px 0 32px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(194,210,74,.45), rgba(201,168,76,.34), transparent);
    pointer-events: none;
}

body.bes-account-surgical-page .bes-account-hero__main,
body.bes-account-surgical-page .bes-account-hero__actions {
    position: relative;
    z-index: 1;
}

body.bes-account-surgical-page .bes-account-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    min-height: 30px;
    margin: 0 0 12px;
    padding: 8px 12px;
    border-radius: 999px;
    border: 1px solid rgba(194,210,74,.22);
    background: rgba(255,255,255,.07);
    color: rgba(253,252,250,.78);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .16em;
    line-height: 1;
    text-transform: uppercase;
}

body.bes-account-surgical-page .bes-account-hero__eyebrow::before {
    content: '';
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: var(--bes-account-leaf);
    box-shadow: 0 0 0 5px rgba(194,210,74,.12);
}

body.bes-account-surgical-page .bes-account-hero__title {
    margin: 0 !important;
    color: var(--bes-account-ivory) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: clamp(38px, 5vw, 68px) !important;
    line-height: .94 !important;
    font-weight: 600 !important;
    letter-spacing: -.025em !important;
}

body.bes-account-surgical-page .bes-account-hero__text {
    max-width: 670px;
    margin: 14px 0 0;
    color: rgba(253,252,250,.72);
    font-size: clamp(14px, 1.15vw, 16px);
    line-height: 1.75;
}

body.bes-account-surgical-page .bes-account-hero__actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 10px;
}

body.bes-account-surgical-page .bes-account-hero__button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 44px;
    padding: 12px 16px;
    border-radius: 999px;
    border: 1px solid rgba(194,210,74,.24);
    background: rgba(255,255,255,.075);
    color: var(--bes-account-ivory) !important;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .12em;
    line-height: 1;
    text-transform: uppercase;
}

body.bes-account-surgical-page .bes-account-hero__button:hover {
    border-color: rgba(194,210,74,.46);
    background: rgba(194,210,74,.15);
    transform: translateY(-1px);
}

body.bes-account-surgical-page .bes-account-hero__button_primary {
    background: var(--bes-account-leaf);
    color: var(--bes-account-forest-deep) !important;
    border-color: var(--bes-account-leaf);
    box-shadow: 0 12px 26px rgba(194,210,74,.18);
}

body.bes-account-surgical-page .bes-account-hero__button_primary:hover {
    background: var(--bes-account-leaf-hover);
    border-color: var(--bes-account-leaf-hover);
}

/* Common panels, cards, forms, notices */
body.bes-account-surgical-page :where(
    .masterstudy-analytics-short-report-page,
    .masterstudy-analytics-short-report-page-stats,
    .masterstudy-instructor-courses__tabs,
    .masterstudy-instructor-courses,
    .masterstudy-account-gradebook,
    .masterstudy-account-settings,
    .masterstudy-account-orders,
    .masterstudy-account-wishlist,
    .masterstudy-account-certificates,
    .masterstudy-account-grades,
    .masterstudy-account-assignments,
    .masterstudy-account-announcement,
    .masterstudy-account-chat,
    .masterstudy-account-sales,
    .masterstudy-account-bundles,
    .masterstudy-account-enrolled-courses,
    .masterstudy-account-enrolled-quizzes,
    .masterstudy-account-enrolled-assignments,
    .stm-lms-wrapper,
    .stm_lms_user_info_top,
    .stm_lms_user_info_top__right,
    .stm_lms_user_courses,
    .stm_lms_user_quizzes,
    .stm-lms-user_create_announcement,
    .stm_lms_edit_account,
    .stm_lms_edit_socials
) {
    border-radius: var(--bes-account-radius-xl) !important;
    border: 1px solid var(--bes-account-border) !important;
    background: rgba(253,252,250,.82) !important;
    box-shadow: var(--bes-account-shadow-soft) !important;
    backdrop-filter: blur(18px) saturate(1.08);
    -webkit-backdrop-filter: blur(18px) saturate(1.08);
}

body.bes-account-surgical-page :where(
    .masterstudy-account-settings,
    .masterstudy-account-orders,
    .masterstudy-account-wishlist,
    .masterstudy-account-certificates,
    .masterstudy-account-grades,
    .masterstudy-account-assignments,
    .masterstudy-account-announcement,
    .masterstudy-account-chat,
    .masterstudy-account-sales,
    .masterstudy-account-bundles,
    .masterstudy-account-enrolled-courses,
    .masterstudy-account-enrolled-quizzes,
    .masterstudy-account-enrolled-assignments,
    .stm-lms-wrapper,
    .stm_lms_user_info_top,
    .stm_lms_user_courses,
    .stm_lms_user_quizzes,
    .stm-lms-user_create_announcement,
    .stm_lms_edit_account,
    .stm_lms_edit_socials
) {
    padding: clamp(22px, 2.6vw, 34px) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container .masterstudy-message, .masterstudy-account-container .stm_lms_message, .masterstudy-account-container .woocommerce-message, .masterstudy-account-container .woocommerce-info, .masterstudy-account-container .woocommerce-error) {
    border: 1px solid rgba(194,210,74,.24) !important;
    border-radius: 18px !important;
    background: linear-gradient(135deg, rgba(194,210,74,.13), rgba(253,252,250,.9)) !important;
    color: var(--bes-account-bark) !important;
    padding: 15px 18px !important;
    box-shadow: var(--bes-account-shadow-xs) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]), .masterstudy-account-container textarea, .masterstudy-account-container select) {
    min-height: 46px !important;
    width: 100%;
    border: 1px solid rgba(63,81,48,.18) !important;
    border-radius: 14px !important;
    background: rgba(253,252,250,.92) !important;
    color: var(--bes-account-bark) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.8) !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    line-height: 1.45 !important;
    padding: 11px 14px !important;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container textarea) {
    min-height: 132px !important;
    resize: vertical;
}

body.bes-account-surgical-page :where(.masterstudy-account-container input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]):focus, .masterstudy-account-container textarea:focus, .masterstudy-account-container select:focus) {
    border-color: rgba(63,81,48,.38) !important;
    background: var(--bes-account-ivory) !important;
    box-shadow: 0 0 0 4px rgba(194,210,74,.14), inset 0 1px 0 rgba(255,255,255,.85) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container label) {
    color: var(--bes-account-bark-soft) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    text-transform: uppercase !important;
}

/* Buttons */
body.bes-account-surgical-page :where(.masterstudy-button, .masterstudy-account-container .button, .masterstudy-account-container button, .masterstudy-account-container input[type="submit"], .masterstudy-account-container .elementor-button) {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    min-height: 44px !important;
    padding: 12px 18px !important;
    border-radius: 999px !important;
    border: 1px solid transparent !important;
    box-shadow: none !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    letter-spacing: .12em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
    transition: transform .22s var(--bes-account-ease), background .22s ease, border-color .22s ease, box-shadow .22s ease, color .22s ease !important;
}

body.bes-account-surgical-page :where(.masterstudy-button__title) {
    color: inherit !important;
    font: inherit !important;
    line-height: inherit !important;
}

body.bes-account-surgical-page :where(.masterstudy-button_style-primary, .masterstudy-account-container input[type="submit"], .masterstudy-account-container button[type="submit"], .masterstudy-account-container .button-primary) {
    background: var(--bes-account-olive) !important;
    color: var(--bes-account-ivory) !important;
    border-color: var(--bes-account-olive) !important;
    box-shadow: 0 12px 24px rgba(63,81,48,.18) !important;
}

body.bes-account-surgical-page :where(.masterstudy-button_style-secondary, .masterstudy-account-container .button:not(.button-primary), .masterstudy-account-container .elementor-button) {
    background: rgba(63,81,48,.07) !important;
    color: var(--bes-account-olive) !important;
    border-color: rgba(63,81,48,.16) !important;
}

body.bes-account-surgical-page :where(.masterstudy-button_style-primary:hover, .masterstudy-account-container input[type="submit"]:hover, .masterstudy-account-container button[type="submit"]:hover, .masterstudy-account-container .button-primary:hover) {
    background: var(--bes-account-olive-dark) !important;
    border-color: var(--bes-account-olive-dark) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 16px 32px rgba(63,81,48,.22) !important;
}

body.bes-account-surgical-page :where(.masterstudy-button_style-secondary:hover, .masterstudy-account-container .button:not(.button-primary):hover, .masterstudy-account-container .elementor-button:hover) {
    background: rgba(63,81,48,.12) !important;
    border-color: rgba(63,81,48,.28) !important;
    color: var(--bes-account-olive-dark) !important;
    transform: translateY(-1px) !important;
}

/* Analytics dashboard */
body.bes-account-surgical-page .masterstudy-analytics-short-report-page {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    gap: 16px !important;
    margin: 0 0 18px !important;
    padding: clamp(20px, 2.5vw, 30px) !important;
    overflow: visible !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: radial-gradient(circle at 8% 0, rgba(194,210,74,.18), transparent 40%);
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page__title {
    position: relative !important;
    margin: 0 !important;
    font-size: clamp(34px, 3.8vw, 52px) !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page__select {
    position: relative !important;
    z-index: 4 !important;
    margin-left: auto !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats {
    position: relative !important;
    margin: 0 0 clamp(20px, 2.8vw, 34px) !important;
    padding: clamp(18px, 2.5vw, 28px) !important;
    background: rgba(253,252,250,.70) !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    gap: clamp(12px, 1.6vw, 18px) !important;
    width: 100% !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__block {
    position: relative !important;
    min-height: 136px !important;
    border-radius: 22px !important;
    border: 1px solid rgba(63,81,48,.12) !important;
    background:
        linear-gradient(135deg, rgba(253,252,250,.95), rgba(247,244,238,.86)),
        radial-gradient(circle at 0 0, rgba(194,210,74,.12), transparent 56%) !important;
    box-shadow: 0 14px 28px rgba(21,30,16,.07) !important;
    overflow: hidden !important;
    transition: transform .24s var(--bes-account-ease), border-color .24s ease, box-shadow .24s ease !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__block::after {
    content: '';
    position: absolute;
    inset: auto 0 0 0;
    height: 3px;
    background: linear-gradient(90deg, var(--bes-account-leaf), var(--bes-account-gold));
    opacity: .75;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__block:hover {
    transform: translateY(-3px) !important;
    border-color: rgba(63,81,48,.23) !important;
    box-shadow: 0 20px 44px rgba(21,30,16,.11) !important;
}

body.bes-account-surgical-page .masterstudy-stats-block {
    position: relative !important;
    display: grid !important;
    grid-template-columns: 48px minmax(0, 1fr) !important;
    gap: 14px !important;
    align-items: start !important;
    min-height: 100% !important;
    padding: 22px 18px !important;
    background: transparent !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__icon {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 48px !important;
    height: 48px !important;
    border-radius: 16px !important;
    background: linear-gradient(135deg, rgba(63,81,48,.12), rgba(194,210,74,.16)) !important;
    color: var(--bes-account-olive) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.8) !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__icon::before,
body.bes-account-surgical-page .masterstudy-stats-block__icon::after {
    color: currentColor !important;
    font-size: 23px !important;
    line-height: 1 !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__icon .bes-stat-inline-icon {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__icon.bes-native-stat-icon {
    flex: 0 0 48px !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__icon.bes-native-stat-icon > :not(.bes-stat-inline-icon) {
    color: currentColor !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__content {
    min-width: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__title {
    color: var(--bes-account-bark-muted) !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    letter-spacing: .12em !important;
    line-height: 1.2 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__value {
    min-height: 34px !important;
    color: var(--bes-account-bark) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: clamp(28px, 3vw, 42px) !important;
    font-weight: 600 !important;
    letter-spacing: -.02em !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-stats-block__value:empty::before {
    content: '0';
    color: rgba(28,36,21,.36);
}


/* Select component */
body.bes-account-surgical-page .masterstudy-select {
    position: relative !important;
    min-width: 184px !important;
    font-family: var(--bes-account-font-body) !important;
    z-index: 20 !important;
}

body.bes-account-surgical-page .masterstudy-select__wrapper {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 10px !important;
    min-height: 46px !important;
    padding: 12px 14px !important;
    border-radius: 999px !important;
    border: 1px solid rgba(63,81,48,.16) !important;
    background: rgba(253,252,250,.92) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.9), 0 8px 20px rgba(21,30,16,.06) !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-select__placeholder {
    color: var(--bes-account-bark-soft) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    line-height: 1.2 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-select__caret {
    display: inline-flex !important;
    width: 20px !important;
    height: 20px !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.09) !important;
    position: relative !important;
    flex: 0 0 20px !important;
}

body.bes-account-surgical-page .masterstudy-select__caret::before {
    content: '';
    position: absolute;
    top: 7px;
    left: 6px;
    width: 8px;
    height: 8px;
    border-right: 2px solid var(--bes-account-olive);
    border-bottom: 2px solid var(--bes-account-olive);
    transform: rotate(45deg);
    transition: transform .2s var(--bes-account-ease);
}

body.bes-account-surgical-page .masterstudy-select.bes-account-select-open .masterstudy-select__caret::before,
body.bes-account-surgical-page .masterstudy-select.open .masterstudy-select__caret::before {
    transform: rotate(225deg) translate(-2px, -2px);
}

body.bes-account-surgical-page .masterstudy-select__clear {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-select__dropdown {
    position: absolute !important;
    top: calc(100% + 8px) !important;
    left: 0 !important;
    right: 0 !important;
    min-width: 100% !important;
    padding: 8px !important;
    border-radius: 17px !important;
    border: 1px solid rgba(63,81,48,.14) !important;
    background: rgba(253,252,250,.98) !important;
    box-shadow: 0 18px 46px rgba(21,30,16,.18) !important;
    overflow: hidden !important;
    z-index: 60 !important;
}

body.bes-account-surgical-page .masterstudy-select__options {
    display: flex !important;
    flex-direction: column !important;
    gap: 4px !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}

body.bes-account-surgical-page .masterstudy-select__option {
    display: flex !important;
    align-items: center !important;
    min-height: 36px !important;
    padding: 9px 11px !important;
    border-radius: 12px !important;
    color: var(--bes-account-bark-soft) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .06em !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-select__option:hover,
body.bes-account-surgical-page .masterstudy-select__option.selected {
    background: rgba(194,210,74,.16) !important;
    color: var(--bes-account-olive-dark) !important;
}

/* Instructor courses */
body.bes-account-surgical-page .masterstudy-instructor-courses__tabs {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    gap: 14px !important;
    margin: 0 0 18px !important;
    padding: 14px !important;
}

body.bes-account-surgical-page .masterstudy-tabs,
body.bes-account-surgical-page .masterstudy-tabs_style-buttons {
    display: flex !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
    border: 0 !important;
    background: transparent !important;
}

body.bes-account-surgical-page .masterstudy-tabs__item {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 38px !important;
    margin: 0 !important;
    padding: 10px 15px !important;
    border: 1px solid rgba(63,81,48,.13) !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.055) !important;
    color: var(--bes-account-bark-muted) !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    letter-spacing: .10em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-tabs__item:hover {
    color: var(--bes-account-olive-dark) !important;
    border-color: rgba(63,81,48,.24) !important;
    background: rgba(63,81,48,.09) !important;
}

body.bes-account-surgical-page .masterstudy-tabs__item_active,
body.bes-account-surgical-page .masterstudy-tabs__item.active {
    background: var(--bes-account-olive) !important;
    border-color: var(--bes-account-olive) !important;
    color: var(--bes-account-ivory) !important;
    box-shadow: 0 12px 24px rgba(63,81,48,.16) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses {
    position: relative !important;
    margin: 0 !important;
    padding: clamp(16px, 2vw, 24px) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__list {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(min(100%, 460px), 1fr)) !important;
    gap: clamp(16px, 2vw, 24px) !important;
}

body.bes-account-surgical-page .masterstudy-course-card {
    position: relative !important;
    width: 100% !important;
    min-width: 0 !important;
    border: 1px solid rgba(63,81,48,.14) !important;
    border-radius: 24px !important;
    background: var(--bes-account-ivory) !important;
    box-shadow: 0 14px 36px rgba(21,30,16,.08) !important;
    overflow: visible !important;
    transition: transform .25s var(--bes-account-ease), box-shadow .25s ease, border-color .25s ease !important;
}

body.bes-account-surgical-page .masterstudy-course-card:hover {
    transform: translateY(-4px) !important;
    border-color: rgba(63,81,48,.25) !important;
    box-shadow: 0 22px 56px rgba(21,30,16,.13) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__wrapper {
    display: grid !important;
    grid-template-columns: minmax(180px, 32%) minmax(0, 1fr) !important;
    gap: 0 !important;
    min-height: 260px !important;
    overflow: hidden !important;
    border-radius: inherit !important;
    background: transparent !important;
}

body.bes-account-surgical-page .masterstudy-course-card__image-link {
    position: relative !important;
    display: block !important;
    min-height: 260px !important;
    overflow: hidden !important;
    background: var(--bes-account-forest) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__image-link::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent, rgba(21,30,16,.26));
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-course-card__image,
body.bes-account-surgical-page .masterstudy-lazyload-image img {
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 260px !important;
    object-fit: cover !important;
    transform: scale(1.01);
    transition: transform .55s var(--bes-account-ease) !important;
}

body.bes-account-surgical-page .masterstudy-course-card:hover .masterstudy-course-card__image,
body.bes-account-surgical-page .masterstudy-course-card:hover .masterstudy-lazyload-image img {
    transform: scale(1.045) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info {
    display: flex !important;
    flex-direction: column !important;
    gap: 13px !important;
    min-width: 0 !important;
    padding: clamp(20px, 2.2vw, 30px) !important;
    background: transparent !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-category {
    display: inline-flex !important;
    width: max-content !important;
    max-width: 100% !important;
    margin: 0 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-category a {
    display: inline-flex !important;
    align-items: center !important;
    min-height: 28px !important;
    padding: 7px 10px !important;
    border-radius: 999px !important;
    background: rgba(194,210,74,.17) !important;
    color: var(--bes-account-olive-dark) !important;
    font-size: 10px !important;
    font-weight: 900 !important;
    letter-spacing: .12em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-title {
    display: block !important;
    color: var(--bes-account-bark) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-title h3 {
    margin: 0 !important;
    color: var(--bes-account-bark) !important;
    font-size: clamp(26px, 2.8vw, 40px) !important;
    line-height: 1.02 !important;
    font-weight: 600 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-title:hover h3 {
    color: var(--bes-account-olive) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__meta {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 9px !important;
    margin: 0 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__meta-block {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    min-height: 34px !important;
    padding: 8px 11px !important;
    border: 1px solid rgba(63,81,48,.10) !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.055) !important;
    color: var(--bes-account-bark-muted) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__meta-block i {
    color: var(--bes-account-olive) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__bottom {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) auto !important;
    gap: 12px !important;
    align-items: center !important;
    margin-top: auto !important;
    padding-top: 16px !important;
    border-top: 1px solid rgba(63,81,48,.10) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__rating {
    display: flex !important;
    align-items: center !important;
    gap: 3px !important;
    min-width: 0 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__rating-star {
    position: relative !important;
    display: inline-flex !important;
    width: 14px !important;
    height: 14px !important;
}

body.bes-account-surgical-page .masterstudy-course-card__rating-star::before {
    content: '★';
    color: var(--bes-account-gold) !important;
    font-size: 14px;
    line-height: 1;
}

body.bes-account-surgical-page .masterstudy-course-card__rating-count {
    margin-left: 5px !important;
    color: var(--bes-account-bark-muted) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__price,
body.bes-account-surgical-page .masterstudy-course-card__price-single {
    display: inline-flex !important;
    align-items: center !important;
    margin: 0 !important;
}

body.bes-account-surgical-page .masterstudy-course-card__price span {
    display: inline-flex !important;
    align-items: center !important;
    min-height: 34px !important;
    padding: 8px 12px !important;
    border-radius: 999px !important;
    background: var(--bes-account-forest) !important;
    color: var(--bes-account-ivory) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    letter-spacing: .02em !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions {
    grid-column: 1 / -1 !important;
    width: 100% !important;
    margin-top: 4px !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__content {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    width: 100% !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__column {
    display: flex !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__item {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    min-height: 32px !important;
    padding: 7px 10px !important;
    border: 1px solid rgba(63,81,48,.10) !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.04) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__title {
    color: var(--bes-account-bark-muted) !important;
    font-size: 10px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__value,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__status {
    color: var(--bes-account-bark-soft) !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__status_publish {
    color: var(--bes-account-olive-dark) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 38px !important;
    height: 38px !important;
    border: 1px solid rgba(63,81,48,.13) !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.06) !important;
    color: var(--bes-account-olive) !important;
    cursor: pointer !important;
    transition: transform .2s var(--bes-account-ease), background .2s ease, border-color .2s ease !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-btn:hover,
body.bes-account-surgical-page .masterstudy-course-card.bes-account-actions-open .masterstudy-instructor-course-actions__modal-btn {
    background: rgba(194,210,74,.18) !important;
    border-color: rgba(63,81,48,.24) !important;
    transform: translateY(-1px) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal {
    position: absolute !important;
    right: 18px !important;
    bottom: 18px !important;
    width: min(260px, calc(100% - 36px)) !important;
    padding: 10px !important;
    border: 1px solid rgba(63,81,48,.14) !important;
    border-radius: 18px !important;
    background: rgba(253,252,250,.98) !important;
    box-shadow: 0 22px 60px rgba(21,30,16,.20) !important;
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
    transform: translateY(8px) scale(.98) !important;
    transform-origin: right bottom !important;
    transition: opacity .22s ease, visibility .22s ease, transform .22s var(--bes-account-ease) !important;
    z-index: 30 !important;
}

body.bes-account-surgical-page .masterstudy-course-card.bes-account-actions-open .masterstudy-instructor-course-actions__modal,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal.active,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal.open,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal.show {
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
    transform: translateY(0) scale(1) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-status,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-featured,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-link {
    display: flex !important;
    align-items: center !important;
    gap: 9px !important;
    min-height: 38px !important;
    padding: 10px 11px !important;
    border-radius: 12px !important;
    color: var(--bes-account-bark-soft) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    line-height: 1.2 !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-status:hover,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-featured:hover,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-link:hover {
    background: rgba(194,210,74,.16) !important;
    color: var(--bes-account-olive-dark) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-divider {
    display: block !important;
    height: 1px !important;
    margin: 6px 4px !important;
    background: rgba(63,81,48,.10) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty {
    display: none;
    align-items: center !important;
    justify-content: center !important;
    min-height: 240px !important;
    padding: 24px !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty.show,
body.bes-account-surgical-page .masterstudy-instructor-courses__empty.active,
body.bes-account-surgical-page .masterstudy-instructor-courses__list:empty + .masterstudy-instructor-courses__pagination + .masterstudy-instructor-courses__loader + .masterstudy-instructor-courses__empty {
    display: flex !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty-block {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    gap: 12px !important;
    color: var(--bes-account-bark-muted) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty-icon {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 64px !important;
    height: 64px !important;
    border-radius: 22px !important;
    background: rgba(194,210,74,.16) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty-icon::before {
    content: '✦';
    color: var(--bes-account-olive);
    font-size: 26px;
}

/* Gradebook */
body.bes-account-surgical-page .masterstudy-account-gradebook {
    position: relative !important;
    padding: clamp(22px, 3vw, 38px) !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 92% 0, rgba(194,210,74,.18), transparent 34%);
    pointer-events: none;
}

body.bes-account-surgical-page .masterstudy-account-gradebook > * {
    position: relative;
    z-index: 1;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__title {
    margin: 0 0 clamp(18px, 2.5vw, 28px) !important;
    font-size: clamp(38px, 5vw, 64px) !important;
    line-height: .98 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__course {
    display: grid !important;
    grid-template-columns: minmax(220px, 320px) minmax(0, 1fr) !important;
    gap: clamp(16px, 2vw, 24px) !important;
    align-items: start !important;
    margin-bottom: clamp(20px, 2.8vw, 32px) !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__course-select {
    position: sticky !important;
    top: calc(var(--bes-account-adminbar-h) + 108px) !important;
    z-index: 5 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__course-select .masterstudy-select {
    min-width: 100% !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__course-stats {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 12px !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat {
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    gap: 12px !important;
    min-height: 116px !important;
    padding: 17px !important;
    border-radius: 20px !important;
    border: 1px solid rgba(63,81,48,.12) !important;
    background: rgba(253,252,250,.88) !important;
    box-shadow: 0 10px 26px rgba(21,30,16,.06) !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat::after {
    content: '';
    position: absolute;
    inset: auto 0 0 0;
    height: 3px;
    background: linear-gradient(90deg, var(--bes-account-sage), var(--bes-account-leaf));
    opacity: .72;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat-title {
    color: var(--bes-account-bark-muted) !important;
    font-size: 10px !important;
    font-weight: 900 !important;
    letter-spacing: .11em !important;
    line-height: 1.35 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat-value {
    color: var(--bes-account-bark) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: clamp(28px, 3vw, 42px) !important;
    font-weight: 600 !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat-value:empty::before {
    content: '–';
    color: rgba(28,36,21,.32);
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students {
    position: relative !important;
    min-height: 220px !important;
    border-radius: 24px !important;
    border: 1px solid rgba(63,81,48,.12) !important;
    background: rgba(253,252,250,.88) !important;
    box-shadow: 0 16px 36px rgba(21,30,16,.08) !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-skeleton-loader,
body.bes-account-surgical-page .masterstudy-skeleton-loader_table {
    position: absolute !important;
    inset: 0 !important;
    display: none !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

body.bes-account-surgical-page .masterstudy-datatable {
    width: 100% !important;
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch;
}

body.bes-account-surgical-page :where(.masterstudy-datatable table, .masterstudy-account-container table) {
    width: 100% !important;
    min-width: 720px !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
    color: var(--bes-account-bark) !important;
    background: transparent !important;
}

body.bes-account-surgical-page :where(.masterstudy-datatable thead, .masterstudy-account-container table thead) {
    background: linear-gradient(135deg, rgba(30,42,22,.98), rgba(63,81,48,.94)) !important;
    color: var(--bes-account-ivory) !important;
}

body.bes-account-surgical-page :where(.masterstudy-datatable th, .masterstudy-account-container table th) {
    padding: 15px 16px !important;
    border: 0 !important;
    color: rgba(253,252,250,.82) !important;
    font-size: 10px !important;
    font-weight: 900 !important;
    letter-spacing: .13em !important;
    line-height: 1.2 !important;
    text-align: left !important;
    text-transform: uppercase !important;
    white-space: nowrap !important;
}

body.bes-account-surgical-page :where(.masterstudy-datatable td, .masterstudy-account-container table td) {
    padding: 15px 16px !important;
    border-top: 1px solid rgba(63,81,48,.10) !important;
    color: var(--bes-account-bark-soft) !important;
    font-size: 13px !important;
    font-weight: 650 !important;
    line-height: 1.45 !important;
    vertical-align: middle !important;
}

body.bes-account-surgical-page :where(.masterstudy-datatable tbody tr, .masterstudy-account-container table tbody tr) {
    background: rgba(253,252,250,.82) !important;
    transition: background .2s ease !important;
}

body.bes-account-surgical-page :where(.masterstudy-datatable tbody tr:hover, .masterstudy-account-container table tbody tr:hover) {
    background: rgba(194,210,74,.08) !important;
}

/* Enterprise enquiry modal */
body.bes-account-surgical-page .masterstudy-enterprise-modal {
    position: fixed !important;
    inset: 0 !important;
    z-index: 99999 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: clamp(18px, 4vw, 48px) !important;
    background: rgba(21,30,16,.62) !important;
    backdrop-filter: blur(16px) saturate(1.1);
    -webkit-backdrop-filter: blur(16px) saturate(1.1);
    transition: opacity .24s ease, visibility .24s ease !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal[style*="opacity:0"] {
    pointer-events: none !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__wrapper {
    width: min(560px, 100%) !important;
    margin: 0 !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__container {
    position: relative !important;
    width: 100% !important;
    max-width: 100% !important;
    padding: clamp(20px, 3vw, 30px) !important;
    border-radius: 26px !important;
    border: 1px solid rgba(194,210,74,.18) !important;
    background: var(--bes-account-ivory) !important;
    box-shadow: 0 32px 100px rgba(0,0,0,.34) !important;
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__container::before {
    content: '';
    position: absolute;
    inset: 0 0 auto 0;
    height: 8px;
    background: linear-gradient(90deg, var(--bes-account-leaf), var(--bes-account-gold));
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__header {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 16px !important;
    margin: 0 0 18px !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__header-title {
    color: var(--bes-account-bark) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: clamp(28px, 4vw, 42px) !important;
    font-weight: 600 !important;
    line-height: 1 !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__header-close,
body.bes-account-surgical-page .masterstudy-enterprise-modal__close {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 38px !important;
    height: 38px !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.08) !important;
    cursor: pointer !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__header-close::before,
body.bes-account-surgical-page .masterstudy-enterprise-modal__close::before {
    content: '×';
    color: var(--bes-account-olive);
    font-size: 24px;
    line-height: 1;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__form-wrapper {
    display: grid !important;
    gap: 12px !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__form-field {
    margin: 0 !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__form-input,
body.bes-account-surgical-page .masterstudy-enterprise-modal__form-textarea {
    width: 100% !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__actions {
    display: flex !important;
    justify-content: flex-end !important;
    margin-top: 16px !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__success {
    text-align: center !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__success-icon-wrapper {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 74px !important;
    height: 74px !important;
    margin: 0 auto 16px !important;
    border-radius: 24px !important;
    background: rgba(194,210,74,.18) !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__success-icon::before {
    content: '✓';
    color: var(--bes-account-olive);
    font-size: 30px;
    font-weight: 900;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__success-title {
    color: var(--bes-account-bark) !important;
    font-family: var(--bes-account-font-display) !important;
    font-size: 32px !important;
    font-weight: 600 !important;
}

/* Bottom mobile navigation */
body.bes-account-surgical-page .masterstudy-account-mobile-menu {
    position: fixed !important;
    left: max(12px, env(safe-area-inset-left, 0px)) !important;
    right: max(12px, env(safe-area-inset-right, 0px)) !important;
    bottom: max(10px, env(safe-area-inset-bottom, 0px)) !important;
    z-index: 9990 !important;
    display: none !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    gap: 6px !important;
    min-height: var(--bes-account-mobile-bar-h) !important;
    padding: 8px !important;
    border-radius: 24px !important;
    border: 1px solid rgba(194,210,74,.18) !important;
    background: rgba(21,30,16,.94) !important;
    box-shadow: 0 20px 54px rgba(0,0,0,.28) !important;
    backdrop-filter: blur(18px) saturate(1.2);
    -webkit-backdrop-filter: blur(18px) saturate(1.2);
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu__link {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 5px !important;
    min-width: 0 !important;
    min-height: 58px !important;
    border-radius: 18px !important;
    color: rgba(253,252,250,.62) !important;
    font-size: 10px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu__link i {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 24px !important;
    height: 24px !important;
    color: rgba(194,210,74,.76) !important;
    font-size: 17px !important;
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu__item {
    color: inherit !important;
    font: inherit !important;
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu__link_active,
body.bes-account-surgical-page .masterstudy-account-mobile-menu__link.bes-account-route-active,
body.bes-account-surgical-page .masterstudy-account-mobile-menu__link[aria-current="page"] {
    background: rgba(194,210,74,.16) !important;
    color: var(--bes-account-ivory) !important;
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu__link_active i,
body.bes-account-surgical-page .masterstudy-account-mobile-menu__link.bes-account-route-active i,
body.bes-account-surgical-page .masterstudy-account-mobile-menu__link[aria-current="page"] i {
    color: var(--bes-account-leaf) !important;
}

body.bes-account-surgical-page #bes-account-sidebar-overlay {
    position: fixed;
    inset: 0;
    z-index: 9988;
    background: rgba(21,30,16,.58);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .26s ease, visibility .26s ease;
}

body.bes-account-surgical-page.bes-account-menu-open #bes-account-sidebar-overlay {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

/* Responsive behavior */
@media (max-width: 1280px) {
    body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__wrapper {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-gradebook__course-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    body.bes-account-surgical-page .masterstudy-course-card__wrapper {
        grid-template-columns: 210px minmax(0, 1fr) !important;
    }
}

@media (max-width: 1024px) {
    html body.bes-account-surgical-page {
        --bes-account-sidebar-w: min(380px, calc(100vw - 34px));
    }

    body.bes-account-surgical-page .masterstudy-account {
        display: block !important;
        width: min(100% - 28px, 920px) !important;
        max-width: min(100% - 28px, 920px) !important;
        padding-top: calc(var(--bes-account-header-h) + var(--bes-account-adminbar-h) + 22px) !important;
        padding-bottom: calc(var(--bes-account-mobile-bar-h) + 42px + env(safe-area-inset-bottom, 0px)) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-sidebar {
        position: fixed !important;
        top: calc(var(--bes-account-adminbar-h) + 14px) !important;
        left: 14px !important;
        bottom: 14px !important;
        z-index: 9989 !important;
        width: var(--bes-account-sidebar-w) !important;
        max-width: var(--bes-account-sidebar-w) !important;
        height: auto !important;
        max-height: calc(100dvh - var(--bes-account-adminbar-h) - 28px) !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
        transform: translateX(calc(-100% - 28px)) !important;
        transition: opacity .3s ease, visibility .3s ease, transform .36s var(--bes-account-ease) !important;
    }

    body.bes-account-surgical-page.bes-account-menu-open .masterstudy-account-sidebar,
    body.bes-account-surgical-page .masterstudy-account-sidebar.bes-account-sidebar-open {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
        transform: translateX(0) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-sidebar__wrapper {
        min-height: 100% !important;
        max-height: 100% !important;
    }

    body.bes-account-surgical-page .masterstudy-account-mobile-menu {
        display: grid !important;
    }

    body.bes-account-surgical-page .bes-account-hero {
        grid-template-columns: 1fr !important;
        align-items: start !important;
    }

    body.bes-account-surgical-page .bes-account-hero__actions {
        justify-content: flex-start !important;
    }

    body.bes-account-surgical-page .masterstudy-account-gradebook__course {
        grid-template-columns: 1fr !important;
    }

    body.bes-account-surgical-page .masterstudy-account-gradebook__course-select {
        position: relative !important;
        top: auto !important;
    }
}

@media (max-width: 760px) {
    html body.bes-account-surgical-page {
        --bes-account-header-h: 82px;
    }

    body.bes-account-surgical-page .masterstudy-account {
        width: min(100% - 20px, 680px) !important;
        max-width: min(100% - 20px, 680px) !important;
        padding-top: calc(var(--bes-account-header-h) + var(--bes-account-adminbar-h) + 18px) !important;
    }

    body.bes-account-surgical-page .bes-account-hero {
        min-height: 0 !important;
        padding: 24px !important;
        border-radius: 24px !important;
    }

    body.bes-account-surgical-page .bes-account-hero__title {
        font-size: clamp(36px, 12vw, 50px) !important;
    }

    body.bes-account-surgical-page .masterstudy-analytics-short-report-page {
        align-items: flex-start !important;
        flex-direction: column !important;
    }

    body.bes-account-surgical-page .masterstudy-analytics-short-report-page__select {
        width: 100% !important;
        margin-left: 0 !important;
    }

    body.bes-account-surgical-page .masterstudy-select {
        width: 100% !important;
        min-width: 0 !important;
    }

    body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__wrapper,
    body.bes-account-surgical-page .masterstudy-account-gradebook__course-stats {
        grid-template-columns: 1fr !important;
    }

    body.bes-account-surgical-page .masterstudy-course-card__wrapper {
        grid-template-columns: 1fr !important;
    }

    body.bes-account-surgical-page .masterstudy-course-card__image-link,
    body.bes-account-surgical-page .masterstudy-course-card__image,
    body.bes-account-surgical-page .masterstudy-lazyload-image img {
        min-height: 210px !important;
        max-height: 260px !important;
    }

    body.bes-account-surgical-page .masterstudy-course-card__bottom {
        grid-template-columns: 1fr !important;
        align-items: start !important;
    }

    body.bes-account-surgical-page .masterstudy-instructor-course-actions__content {
        align-items: flex-start !important;
        flex-direction: column !important;
    }

    body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal {
        right: 12px !important;
        left: 12px !important;
        width: auto !important;
    }

    body.bes-account-surgical-page :where(.masterstudy-datatable table, .masterstudy-account-container table) {
        min-width: 0 !important;
    }

    body.bes-account-surgical-page .masterstudy-datatable thead {
        display: none !important;
    }

    body.bes-account-surgical-page .masterstudy-datatable table,
    body.bes-account-surgical-page .masterstudy-datatable tbody,
    body.bes-account-surgical-page .masterstudy-datatable tr,
    body.bes-account-surgical-page .masterstudy-datatable td {
        display: block !important;
        width: 100% !important;
    }

    body.bes-account-surgical-page .masterstudy-datatable tr {
        margin: 12px !important;
        width: calc(100% - 24px) !important;
        border: 1px solid rgba(63,81,48,.12) !important;
        border-radius: 18px !important;
        overflow: hidden !important;
    }

    body.bes-account-surgical-page .masterstudy-datatable td {
        display: grid !important;
        grid-template-columns: minmax(110px, 38%) minmax(0, 1fr) !important;
        gap: 10px !important;
        border-top: 1px solid rgba(63,81,48,.08) !important;
    }

    body.bes-account-surgical-page .masterstudy-datatable td::before {
        content: attr(data-label);
        color: var(--bes-account-bark-muted);
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .10em;
        text-transform: uppercase;
    }
}

@media (max-width: 520px) {
    body.bes-account-surgical-page .masterstudy-account-sidebar {
        left: 10px !important;
        right: 10px !important;
        width: auto !important;
        max-width: none !important;
    }

    body.bes-account-surgical-page .masterstudy-account-profile {
        grid-template-columns: 54px minmax(0, 1fr) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-profile__avatar {
        width: 54px !important;
        height: 54px !important;
        min-width: 54px !important;
    }

    body.bes-account-surgical-page .masterstudy-instructor-courses__tabs {
        align-items: stretch !important;
        flex-direction: column !important;
    }

    body.bes-account-surgical-page .masterstudy-tabs {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    body.bes-account-surgical-page .masterstudy-tabs__item {
        width: 100% !important;
    }

    body.bes-account-surgical-page .masterstudy-instructor-courses__add-new-course-btn,
    body.bes-account-surgical-page .masterstudy-button {
        width: 100% !important;
    }

    body.bes-account-surgical-page .bes-account-hero__actions,
    body.bes-account-surgical-page .bes-account-hero__button {
        width: 100%;
    }
}

/* ==========================================================================
   V2030 final recalibration layer
   Scope remains locked to the User Account portal and its nested endpoints.
   ========================================================================== */
body.bes-account-surgical-page .masterstudy-account,
body.bes-account-surgical-page .masterstudy-account-container,
body.bes-account-surgical-page .masterstudy-account-sidebar,
body.bes-account-surgical-page .masterstudy-account-mobile-menu,
body.bes-account-surgical-page .bes-account-hero {
    -webkit-tap-highlight-color: transparent;
}

body.bes-account-surgical-page .masterstudy-account-container > * {
    max-width: 100% !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container img, .masterstudy-account-container video, .masterstudy-account-container iframe, .masterstudy-account-container svg) {
    max-width: 100% !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container iframe, .masterstudy-account-container video) {
    border-radius: var(--bes-account-radius-lg) !important;
    border: 1px solid var(--bes-account-border) !important;
    box-shadow: var(--bes-account-shadow-soft) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account p, .masterstudy-account li, .masterstudy-account span, .masterstudy-account div) {
    text-rendering: geometricPrecision;
}

body.bes-account-surgical-page :where(.masterstudy-account input, .masterstudy-account textarea, .masterstudy-account select) {
    min-height: 46px !important;
    border-radius: 14px !important;
    border: 1px solid var(--bes-account-border) !important;
    background: rgba(253,252,250,.88) !important;
    color: var(--bes-account-bark) !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 14px !important;
    line-height: 1.45 !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.7) !important;
    transition: border-color .22s var(--bes-account-ease-standard), box-shadow .22s var(--bes-account-ease-standard), background .22s var(--bes-account-ease-standard) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account input:not([type="checkbox"]):not([type="radio"]), .masterstudy-account textarea, .masterstudy-account select) {
    width: 100% !important;
    padding: 12px 14px !important;
}

body.bes-account-surgical-page :where(.masterstudy-account textarea) {
    min-height: 126px !important;
    resize: vertical !important;
}

body.bes-account-surgical-page :where(.masterstudy-account input:focus, .masterstudy-account textarea:focus, .masterstudy-account select:focus) {
    border-color: rgba(63,81,48,.42) !important;
    background: var(--bes-account-ivory) !important;
    box-shadow: 0 0 0 4px rgba(194,210,74,.13), inset 0 1px 0 rgba(255,255,255,.9) !important;
}

body.bes-account-surgical-page :where(.masterstudy-account label, .masterstudy-account .form-label, .masterstudy-account .masterstudy-form-builder__label) {
    color: var(--bes-account-bark-soft) !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    text-transform: uppercase !important;
}

body.bes-account-surgical-page .masterstudy-account :where(input[type="checkbox"], input[type="radio"]) {
    width: 18px !important;
    min-width: 18px !important;
    height: 18px !important;
    min-height: 18px !important;
    accent-color: var(--bes-account-olive) !important;
}

body.bes-account-surgical-page .masterstudy-account :where(input::placeholder, textarea::placeholder) {
    color: rgba(107,122,94,.72) !important;
}

body.bes-account-surgical-page .masterstudy-account-container :where(hr, .divider, .masterstudy-divider) {
    height: 1px !important;
    margin: 22px 0 !important;
    border: 0 !important;
    background: linear-gradient(90deg, transparent, rgba(63,81,48,.18), transparent) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_hidden.masterstudy-account-menu__list-item_active,
body.bes-account-surgical-page .masterstudy-account-menu__list-item_hidden.bes-account-route-active,
body.bes-account-surgical-page .masterstudy-account-menu__list-item_hidden[aria-current="page"],
body.bes-account-surgical-page .masterstudy-account-menu__list-item_hidden.bes-account-force-visible {
    display: grid !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item_messages i,
body.bes-account-surgical-page .masterstudy-account-menu__list-item_settings i {
    color: var(--bes-account-leaf-soft) !important;
}

body.bes-account-surgical-page :where(i[class^="stmlms-"], i[class*=" stmlms-"])::before {
    display: block !important;
    font-style: normal !important;
    font-weight: normal !important;
    font-variant: normal !important;
    text-transform: none !important;
    line-height: 1 !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
}

body.bes-account-surgical-page.bes-account-menu-open .masterstudy-account-mobile-menu__link[data-id="menu"] i,
body.bes-account-surgical-page.bes-account-menu-open .masterstudy-account-mobile-menu__link[href="#"] i {
    transform: rotate(90deg) !important;
}

body.bes-account-surgical-page .masterstudy-account-menu__list-item-badge:empty {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-account-mobile-menu {
    grid-template-columns: repeat(var(--bes-account-mobile-cols, 4), minmax(0, 1fr)) !important;
}

body.bes-account-surgical-page.bes-account-menu-open .masterstudy-account-mobile-menu__link[data-id="menu"],
body.bes-account-surgical-page.bes-account-menu-open .masterstudy-account-mobile-menu__link[href="#"] {
    background: rgba(194,210,74,.18) !important;
    color: var(--bes-account-ivory) !important;
}

body.bes-account-surgical-page .masterstudy-button_size-sm {
    min-height: 42px !important;
    padding: 0 16px !important;
    border-radius: 999px !important;
    font-size: 11px !important;
    letter-spacing: .11em !important;
}

body.bes-account-surgical-page .stm_lms_button,
body.bes-account-surgical-page .masterstudy-account-container .stm_lms_button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 46px !important;
    padding: 0 20px !important;
    border-radius: 999px !important;
    border: 1px solid rgba(63,81,48,.18) !important;
    background: var(--bes-account-olive) !important;
    color: var(--bes-account-ivory) !important;
    font-family: var(--bes-account-font-body) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    letter-spacing: .10em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
    box-shadow: 0 14px 26px rgba(63,81,48,.18) !important;
}

body.bes-account-surgical-page :where(.masterstudy-button[disabled], .masterstudy-button.disabled, .stm_lms_button[disabled], .stm_lms_button.disabled, button[disabled], input[type="submit"][disabled]) {
    cursor: not-allowed !important;
    opacity: .58 !important;
    filter: grayscale(.18) !important;
    transform: none !important;
}

body.bes-account-surgical-page .masterstudy-select__input {
    min-height: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
}

body.bes-account-surgical-page .masterstudy-select__clear,
body.bes-account-surgical-page .masterstudy-select__clear-icon {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 22px !important;
    height: 22px !important;
    min-width: 22px !important;
    border-radius: 999px !important;
    background: rgba(63,81,48,.08) !important;
    color: var(--bes-account-bark-muted) !important;
}

body.bes-account-surgical-page .masterstudy-select__dropdown,
body.bes-account-surgical-page .masterstudy-select.bes-account-select-open .masterstudy-select__dropdown,
body.bes-account-surgical-page .masterstudy-select.open .masterstudy-select__dropdown {
    z-index: 120 !important;
}

body.bes-account-surgical-page .masterstudy-select__option[aria-selected="true"],
body.bes-account-surgical-page .masterstudy-select__option.selected,
body.bes-account-surgical-page .masterstudy-select__option.is-selected {
    background: rgba(194,210,74,.16) !important;
    color: var(--bes-account-forest-deep) !important;
}

body.bes-account-surgical-page .masterstudy-analytics-loader.show,
body.bes-account-surgical-page .masterstudy-analytics-loader.active,
body.bes-account-surgical-page .masterstudy-instructor-courses__loader.show,
body.bes-account-surgical-page .masterstudy-instructor-courses__loader.active {
    display: grid !important;
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: auto !important;
    place-items: center !important;
    min-height: 120px !important;
    padding: 24px !important;
    border-radius: var(--bes-account-radius-lg) !important;
    border: 1px solid var(--bes-account-border) !important;
    background: linear-gradient(135deg, rgba(253,252,250,.72), rgba(247,244,238,.9)) !important;
    box-shadow: var(--bes-account-shadow-soft) !important;
}

body.bes-account-surgical-page .masterstudy-analytics-loader.show .masterstudy-analytics-loader__image,
body.bes-account-surgical-page .masterstudy-analytics-loader.active .masterstudy-analytics-loader__image,
body.bes-account-surgical-page .masterstudy-instructor-courses__loader.show .masterstudy-instructor-courses__loader-body,
body.bes-account-surgical-page .masterstudy-instructor-courses__loader.active .masterstudy-instructor-courses__loader-body,
body.bes-account-surgical-page .masterstudy-skeleton-loader__image {
    width: 42px !important;
    height: 42px !important;
    border-radius: 999px !important;
    border: 3px solid rgba(63,81,48,.12) !important;
    border-top-color: var(--bes-account-leaf) !important;
    animation: besAccountSpin .8s linear infinite !important;
}

@keyframes besAccountSpin {
    to { transform: rotate(360deg); }
}

body.bes-account-surgical-page .masterstudy-skeleton-loader,
body.bes-account-surgical-page .masterstudy-skeleton-loader_table {
    overflow: hidden !important;
}

body.bes-account-surgical-page .masterstudy-skeleton-loader::after,
body.bes-account-surgical-page .masterstudy-skeleton-loader_table::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(100deg, transparent 0%, rgba(255,255,255,.48) 45%, transparent 72%);
    transform: translateX(-100%);
    animation: besAccountShimmer 1.55s ease-in-out infinite;
}

@keyframes besAccountShimmer {
    to { transform: translateX(100%); }
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page__title,
body.bes-account-surgical-page .masterstudy-account-gradebook__title {
    max-width: min(100%, 760px) !important;
    text-wrap: balance;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__wrapper,
body.bes-account-surgical-page .masterstudy-account-gradebook__course-stats,
body.bes-account-surgical-page .masterstudy-instructor-courses__list {
    align-items: stretch !important;
}

body.bes-account-surgical-page .masterstudy-analytics-short-report-page-stats__block,
body.bes-account-surgical-page .masterstudy-account-gradebook__stat,
body.bes-account-surgical-page .masterstudy-course-card {
    contain: layout paint;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat {
    padding-right: 62px !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat::before {
    content: none !important;
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat .bes-grade-stat-visual {
    position: absolute !important;
    right: 16px !important;
    bottom: 16px !important;
    z-index: 2 !important;
    width: 34px !important;
    height: 34px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 12px !important;
    background: rgba(194,210,74,.13) !important;
    color: var(--bes-account-olive) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.72) !important;
    pointer-events: none !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat .bes-grade-stat-visual svg {
    display: block !important;
    width: 18px !important;
    height: 18px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 2 !important;
    stroke-linecap: round !important;
    stroke-linejoin: round !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__course-select {
    min-width: min(100%, 300px) !important;
}

body.bes-account-surgical-page .masterstudy-datatable:empty::before,
body.bes-account-surgical-page .masterstudy-account-container table:empty::before,
body.bes-account-surgical-page .masterstudy-instructor-courses__list:empty::before {
    content: 'No records are available yet';
    display: grid;
    place-items: center;
    min-height: 160px;
    padding: 28px;
    border-radius: var(--bes-account-radius-lg);
    border: 1px dashed rgba(63,81,48,.26);
    background: rgba(253,252,250,.58);
    color: var(--bes-account-bark-muted);
    font-size: 13px;
    font-weight: 800;
    letter-spacing: .08em;
    text-align: center;
    text-transform: uppercase;
}

body.bes-account-surgical-page .masterstudy-datatable :where(a, button),
body.bes-account-surgical-page .masterstudy-account-container table :where(a, button) {
    position: relative !important;
    z-index: 1 !important;
}

body.bes-account-surgical-page .masterstudy-datatable :where(.masterstudy-button, .stm_lms_button, button, .button),
body.bes-account-surgical-page .masterstudy-account-container table :where(.masterstudy-button, .stm_lms_button, button, .button) {
    min-height: 34px !important;
    padding: 0 12px !important;
    border-radius: 999px !important;
    font-size: 10px !important;
    letter-spacing: .08em !important;
    white-space: nowrap !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-top,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-list {
    display: grid !important;
    gap: 6px !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-link,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-status,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-featured {
    min-height: 38px !important;
}

body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-link i,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-status i,
body.bes-account-surgical-page .masterstudy-instructor-course-actions__modal-featured i {
    color: var(--bes-account-olive) !important;
}

body.bes-account-surgical-page .stmlms-course-modal-analytics::before { content: '◴' !important; }
body.bes-account-surgical-page .stmlms-course-modal-edit::before { content: '✎' !important; }
body.bes-account-surgical-page .stmlms-course-modal-grades::before { content: '★' !important; }
body.bes-account-surgical-page .stmlms-course-modal-menu::before { content: '⋯' !important; }

body.bes-account-surgical-page .masterstudy-course-card__image-link {
    isolation: isolate;
}

body.bes-account-surgical-page .masterstudy-course-card__image-link:focus-visible {
    outline: 2px solid var(--bes-account-leaf) !important;
    outline-offset: 4px !important;
}

body.bes-account-surgical-page .masterstudy-course-card__image-link img,
body.bes-account-surgical-page .masterstudy-course-card__image img,
body.bes-account-surgical-page .masterstudy-lazyload-image img {
    display: block !important;
    background: linear-gradient(135deg, rgba(194,210,74,.10), rgba(63,81,48,.08)) !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-title a {
    color: inherit !important;
}

body.bes-account-surgical-page .masterstudy-course-card__info-category:empty,
body.bes-account-surgical-page .masterstudy-course-card__rating-count:empty,
body.bes-account-surgical-page .masterstudy-course-card__price:empty {
    display: none !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__pagination,
body.bes-account-surgical-page .masterstudy-account-container :where(.pagination, .page-numbers, .masterstudy-pagination) {
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    margin-top: 24px !important;
}

body.bes-account-surgical-page .masterstudy-account-container :where(.pagination a, .pagination span, .page-numbers, .masterstudy-pagination a, .masterstudy-pagination span) {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 38px !important;
    height: 38px !important;
    padding: 0 12px !important;
    border-radius: 999px !important;
    border: 1px solid var(--bes-account-border) !important;
    background: rgba(253,252,250,.78) !important;
    color: var(--bes-account-bark-soft) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
}

body.bes-account-surgical-page .masterstudy-account-container :where(.pagination .current, .page-numbers.current, .masterstudy-pagination .current) {
    background: var(--bes-account-olive) !important;
    color: var(--bes-account-ivory) !important;
    border-color: var(--bes-account-olive) !important;
}

body.bes-account-surgical-page .masterstudy-instructor-courses__empty-text {
    max-width: 420px !important;
    margin: 12px auto 0 !important;
    color: var(--bes-account-bark-muted) !important;
    font-size: 14px !important;
    line-height: 1.7 !important;
    text-align: center !important;
}

body.bes-account-surgical-page :where(
    .masterstudy-account-settings,
    .masterstudy-account-orders,
    .masterstudy-account-wishlist,
    .masterstudy-account-certificates,
    .masterstudy-account-grades,
    .masterstudy-account-assignments,
    .masterstudy-account-announcement,
    .masterstudy-account-chat,
    .masterstudy-account-sales,
    .masterstudy-account-bundles,
    .masterstudy-account-enrolled-courses,
    .masterstudy-account-enrolled-quizzes,
    .masterstudy-account-enrolled-assignments,
    .masterstudy-account-students,
    .masterstudy-account-message,
    .masterstudy-account-orders__list,
    .masterstudy-account-settings__form
) :where(.masterstudy-form-builder, form, .woocommerce, .woocommerce-MyAccount-content) {
    width: 100% !important;
}

body.bes-account-surgical-page :where(.masterstudy-account-container .notice, .masterstudy-account-container .error, .masterstudy-account-container .success, .masterstudy-account-container .warning) {
    margin: 0 0 18px !important;
    padding: 15px 18px !important;
    border-radius: 16px !important;
    border: 1px solid var(--bes-account-border) !important;
    background: rgba(253,252,250,.78) !important;
    color: var(--bes-account-bark-soft) !important;
    font-size: 13px !important;
    line-height: 1.6 !important;
    box-shadow: var(--bes-account-shadow-xs) !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__form {
    display: grid !important;
    gap: 14px !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__form-field label {
    margin-bottom: 7px !important;
}

body.bes-account-surgical-page .masterstudy-enterprise-modal__actions .masterstudy-button,
body.bes-account-surgical-page .masterstudy-enterprise-modal__actions button {
    width: auto !important;
    min-width: 150px !important;
}

body.bes-account-surgical-page .bes-account-hero[data-bes-route="account"] .bes-account-hero__button_primary,
body.bes-account-surgical-page .bes-account-hero[data-bes-route="settings"] .bes-account-hero__button_primary {
    background: var(--bes-account-gold) !important;
    color: var(--bes-account-forest-deep) !important;
}

body.bes-account-surgical-page .bes-account-hero__button_menu {
    display: none;
}

@media (min-width: 1025px) {
    body.bes-account-surgical-page .masterstudy-account-sidebar__back {
        display: none !important;
    }
}

@media (max-width: 1024px) {
    body.bes-account-surgical-page .bes-account-hero__button_menu {
        display: inline-flex !important;
    }

    body.bes-account-surgical-page .masterstudy-account-sidebar {
        box-shadow: 0 28px 88px rgba(0,0,0,.32), inset 0 1px 0 rgba(255,255,255,.06) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-mobile-menu {
        max-width: min(680px, calc(100vw - 24px)) !important;
        margin-inline: auto !important;
    }
}

@media (max-width: 760px) {
    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations)) {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) thead) {
        display: none !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations), table:not(.shop_table):not(.variations) tbody, table:not(.shop_table):not(.variations) tr, table:not(.shop_table):not(.variations) td) {
        display: block !important;
        width: 100% !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) tr) {
        border-radius: 18px !important;
        border: 1px solid rgba(63,81,48,.12) !important;
        background: var(--bes-account-ivory) !important;
        overflow: hidden !important;
        box-shadow: 0 10px 22px rgba(21,30,16,.06) !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) td) {
        display: grid !important;
        grid-template-columns: minmax(104px, 38%) minmax(0, 1fr) !important;
        align-items: start !important;
        gap: 10px !important;
        min-height: 44px !important;
        padding: 12px 14px !important;
        border-top: 1px solid rgba(63,81,48,.08) !important;
        text-align: left !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) td)::before {
        content: attr(data-label);
        color: var(--bes-account-bark-muted);
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .10em;
        line-height: 1.35;
        text-transform: uppercase;
    }

    body.bes-account-surgical-page .masterstudy-enterprise-modal__container {
        width: min(100% - 24px, 620px) !important;
        max-height: calc(100dvh - var(--bes-account-adminbar-h) - 28px) !important;
        overflow-y: auto !important;
    }
}

@media (max-width: 520px) {
    html body.bes-account-surgical-page {
        --bes-account-mobile-bar-h: 72px;
    }

    body.bes-account-surgical-page .masterstudy-account-menu__list-item {
        min-height: 43px !important;
    }

    body.bes-account-surgical-page .masterstudy-account-mobile-menu {
        gap: 4px !important;
        padding: 7px !important;
        border-radius: 21px !important;
    }

    body.bes-account-surgical-page .masterstudy-account-mobile-menu__link {
        min-height: 54px !important;
        border-radius: 16px !important;
        font-size: 9px !important;
        letter-spacing: .06em !important;
    }

    body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) td) {
        grid-template-columns: 1fr !important;
        gap: 5px !important;
    }
}

body.bes-account-surgical-page :where(
    .stmlms-menu-dashboard,
    .stmlms-menu-add-course,
    .stmlms-menu-enrolled-courses,
    .stmlms-menu-enrolled-quizzes,
    .stmlms-menu-bundles,
    .stmlms-menu-assignments,
    .stmlms-menu-messages,
    .stmlms-menu-announcement,
    .stmlms-menu-analytics,
    .stmlms-menu-gradebook,
    .stmlms-menu-my-certificates,
    .stmlms-menu-my-grades,
    .stmlms-menu-students,
    .stmlms-menu-sales,
    .stmlms-menu-wishlist,
    .stmlms-menu-my-orders,
    .stmlms-menu-settings,
    .stmlms-menu-logout,
    .stmlms-menu-have-question,
    .stmlms-mobile-menu-home,
    .stmlms-mobile-menu-courses,
    .stmlms-mobile-menu-wishlist,
    .stmlms-mobile-menu-hamburger,
    .stmlms-cats
) {
    speak: never;
    flex: 0 0 auto !important;
}

@media (prefers-reduced-motion: reduce) {
    body.bes-account-surgical-page *,
    body.bes-account-surgical-page *::before,
    body.bes-account-surgical-page *::after {
        animation-duration: .001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: .001ms !important;
    }
}

@media print {
    body.bes-account-surgical-page {
        background: #fff !important;
    }

    body.bes-account-surgical-page .masterstudy-account {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
    }

    body.bes-account-surgical-page .masterstudy-account-sidebar,
    body.bes-account-surgical-page .masterstudy-account-mobile-menu,
    body.bes-account-surgical-page .bes-account-hero__actions,
    body.bes-account-surgical-page #bes-account-sidebar-overlay {
        display: none !important;
    }

    body.bes-account-surgical-page .bes-account-hero,
    body.bes-account-surgical-page :where(.masterstudy-analytics-short-report-page, .masterstudy-analytics-short-report-page-stats, .masterstudy-instructor-courses, .masterstudy-account-gradebook) {
        box-shadow: none !important;
        break-inside: avoid;
    }
}


/* V2030.2 icon-safe and gradebook table normalization layer. */
body.bes-account-surgical-page .masterstudy-account-gradebook__students,
body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(.dataTables_wrapper, .dataTables_scroll, .dataTables_scrollHead, .dataTables_scrollHeadInner) {
    border-radius: 22px 22px 0 0 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(.dataTables_scrollHead, .dataTables_scrollHeadInner) {
    overflow: hidden !important;
    background: linear-gradient(135deg, var(--bes-account-forest), var(--bes-account-olive)) !important;
    border-bottom: 1px solid rgba(194,210,74,.20) !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(table, table.dataTable),
body.bes-account-surgical-page .masterstudy-datatable :where(table, table.dataTable) {
    border: 0 !important;
    box-shadow: none !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(thead, thead tr),
body.bes-account-surgical-page .masterstudy-datatable :where(thead, thead tr),
body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) thead, table:not(.shop_table):not(.variations) thead tr) {
    background: linear-gradient(135deg, var(--bes-account-forest), var(--bes-account-olive)) !important;
    color: var(--bes-account-ivory) !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(thead th, table.dataTable thead th),
body.bes-account-surgical-page .masterstudy-datatable :where(thead th, table.dataTable thead th),
body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) thead th) {
    position: relative !important;
    overflow: hidden !important;
    background: linear-gradient(135deg, var(--bes-account-forest), var(--bes-account-olive)) !important;
    border-top: 0 !important;
    border-right: 1px solid rgba(253,252,250,.08) !important;
    border-bottom: 1px solid rgba(194,210,74,.18) !important;
    color: var(--bes-account-ivory) !important;
    opacity: 1 !important;
    text-shadow: none !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(thead th *, table.dataTable thead th *),
body.bes-account-surgical-page .masterstudy-datatable :where(thead th *, table.dataTable thead th *),
body.bes-account-surgical-page .masterstudy-account-container :where(table:not(.shop_table):not(.variations) thead th *) {
    color: inherit !important;
    opacity: 1 !important;
    text-shadow: none !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(thead th:first-child, table.dataTable thead th:first-child),
body.bes-account-surgical-page .masterstudy-datatable :where(thead th:first-child, table.dataTable thead th:first-child) {
    border-top-left-radius: 20px !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(thead th:last-child, table.dataTable thead th:last-child),
body.bes-account-surgical-page .masterstudy-datatable :where(thead th:last-child, table.dataTable thead th:last-child) {
    border-top-right-radius: 20px !important;
    border-right: 0 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(tbody td, table.dataTable tbody td),
body.bes-account-surgical-page .masterstudy-datatable :where(tbody td, table.dataTable tbody td) {
    background: rgba(253,252,250,.88) !important;
    border-right: 1px solid rgba(63,81,48,.09) !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(tbody td:last-child, table.dataTable tbody td:last-child),
body.bes-account-surgical-page .masterstudy-datatable :where(tbody td:last-child, table.dataTable tbody td:last-child) {
    border-right: 0 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__students :where(.sorting::before, .sorting::after, .sorting_asc::before, .sorting_asc::after, .sorting_desc::before, .sorting_desc::after),
body.bes-account-surgical-page .masterstudy-datatable :where(.sorting::before, .sorting::after, .sorting_asc::before, .sorting_asc::after, .sorting_desc::before, .sorting_desc::after) {
    color: var(--bes-account-leaf) !important;
    opacity: .9 !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat .masterstudy-account-gradebook__stat-value {
    max-width: calc(100% - 10px) !important;
    overflow-wrap: anywhere !important;
}

body.bes-account-surgical-page .masterstudy-account-gradebook__stat .bes-inline-icon,
body.bes-account-surgical-page .masterstudy-stats-block__icon .bes-inline-icon {
    font-style: normal !important;
    speak: never;
}

CSS;
    }
}

if (! function_exists('bes_account_surgical_js')) {
    function bes_account_surgical_js(): string {
        return <<<'JS'
(function () {
    'use strict';

    if (window.__besAccountSurgicalInjector) {
        return;
    }
    window.__besAccountSurgicalInjector = true;

    var BODY_CLASS = 'bes-account-surgical-page';
    var READY_CLASS = 'bes-account-ready';
    var MENU_OPEN_CLASS = 'bes-account-menu-open';
    var ROOT_SELECTOR = '.masterstudy-account';
    var SIDEBAR_SELECTOR = '.masterstudy-account-sidebar';
    var CONTAINER_SELECTOR = '.masterstudy-account-container';
    var MOBILE_MENU_SELECTOR = '.masterstudy-account-mobile-menu';
    var ROUTE_ACTIVE_CLASS = 'bes-account-route-active';
    var overlayId = 'bes-account-sidebar-overlay';
    var DEAD_LOADER_SELECTOR = '.ms_plugin_loader_bg_, .ms_lms_loader_';
    var scheduled = false;
    var observer = null;
    var bootCount = 0;

    var pageCopy = {
        dashboard: {
            title: 'Account Dashboard',
            eyebrow: 'Member workspace',
            text: 'Track courses, learning activity, communication, and account tools from one focused dashboard.'
        },
        account: {
            title: 'Account Workspace',
            eyebrow: 'Member portal',
            text: 'Use this account area to manage learning, teaching, purchases, communication, and profile details.'
        },
        analytics: {
            title: 'Analytics',
            eyebrow: 'Instructor insights',
            text: 'Review revenue, enrollments, student growth, reviews, certificates, and course performance with a cleaner account view.'
        },
        gradebook: {
            title: 'The Gradebook',
            eyebrow: 'Student progress',
            text: 'Select a course, scan learning progress, and review student performance in a structured table.'
        },
        courses: {
            title: 'My Courses',
            eyebrow: 'Learning library',
            text: 'Open enrolled courses, continue lessons, and keep your study path organized.'
        },
        quizzes: {
            title: 'My Quizzes',
            eyebrow: 'Assessment history',
            text: 'Review quiz activity, scores, and assessment progress with a calmer interface.'
        },
        assignments: {
            title: 'Assignments',
            eyebrow: 'Course tasks',
            text: 'Manage submitted work, review pending items, and follow course requirements.'
        },
        certificates: {
            title: 'Certificates',
            eyebrow: 'Achievements',
            text: 'Access earned certificates and learning credentials from your account.'
        },
        grades: {
            title: 'Grades',
            eyebrow: 'Learning record',
            text: 'Review grade summaries and course performance from your learning profile.'
        },
        messages: {
            title: 'Messages',
            eyebrow: 'Communication',
            text: 'Keep learning conversations, support messages, and instructor updates organized.'
        },
        announcement: {
            title: 'Announcements',
            eyebrow: 'Updates',
            text: 'Create, review, and manage course announcements from your instructor account.'
        },
        bundles: {
            title: 'Bundles',
            eyebrow: 'Course collections',
            text: 'Review bundled learning offers and grouped course access from one place.'
        },
        sales: {
            title: 'My Sales',
            eyebrow: 'Finance',
            text: 'Follow instructor sales activity and related financial records.'
        },
        orders: {
            title: 'My Orders',
            eyebrow: 'Purchases',
            text: 'Review payments, orders, and account purchase history.'
        },
        wishlist: {
            title: 'Wishlist',
            eyebrow: 'Saved courses',
            text: 'Return to courses you saved and continue planning your learning journey.'
        },
        settings: {
            title: 'Settings',
            eyebrow: 'Account details',
            text: 'Update profile details, account preferences, and public information.'
        },
        editcourse: {
            title: 'Course Builder',
            eyebrow: 'Instructor tools',
            text: 'Create or update course details with a cleaner authoring workspace.'
        },
        students: {
            title: 'Students',
            eyebrow: 'Enrollment management',
            text: 'Review enrolled students and manage course participation.'
        }
    };
    var svgIconMap = {
        default: { svg: '<path d="M12 5v14"></path><path d="M5 12h14"></path>' },
        grade_students: { svg: '<circle cx="9" cy="8" r="3"></circle><path d="M3.8 19c.55-2.95 2.45-4.55 5.2-4.55S13.65 16.05 14.2 19"></path><path d="M15.5 10.5a2.4 2.4 0 1 0 0-4.8"></path><path d="M16 14.8c2.2.28 3.65 1.7 4.15 4.2"></path>' },
        grade_lessons: { svg: '<path d="M7 5h10"></path><path d="M7 9.5h10"></path><path d="M7 14h7"></path><path d="M5 5h.01"></path><path d="M5 9.5h.01"></path><path d="M5 14h.01"></path><path d="M5 18.5h10"></path>' },
        grade_quizzes: { svg: '<circle cx="12" cy="12" r="8"></circle><path d="m8.5 12.3 2.35 2.35 4.9-5.25"></path>' },
        grade_assignments: { svg: '<path d="M8 5h8l2 2v12H6V7l2-2z"></path><path d="M9 11h6"></path><path d="M9 15h4"></path>' },
        grade_progress: { svg: '<path d="M5 19V5"></path><path d="M5 19h14"></path><path d="M8 16l3-4 3 2 4-7"></path>' },
        grade_subscription: { svg: '<path d="M5 7.5h14v9H5z"></path><path d="M8 11h4"></path><path d="M15 13.5h1.5"></path>' }
    };

    function removeBesIcons(container) {
        qa('.bes-inline-icon', container).forEach(function (node) {
            if (node.parentNode) node.parentNode.removeChild(node);
        });
    }

    function placeBesIcon(container, type, className) {
        if (!container) return;
        type = type || 'default';
        if (container.dataset.besInlineIconType === type && q('.bes-inline-icon', container)) return;
        removeBesIcons(container);
        container.dataset.besInlineIconType = type;
        container.setAttribute('aria-hidden', 'true');

        var definition = svgIconMap[type] || svgIconMap.default;
        var wrap = document.createElement('span');
        wrap.className = className + ' bes-inline-icon';

        if (definition.text) {
            wrap.className += ' bes-inline-icon-text';
            wrap.textContent = definition.text;
        } else {
            var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.setAttribute('viewBox', '0 0 24 24');
            svg.setAttribute('width', '24');
            svg.setAttribute('height', '24');
            svg.setAttribute('aria-hidden', 'true');
            svg.setAttribute('focusable', 'false');
            svg.innerHTML = definition.svg;
            wrap.appendChild(svg);
        }

        container.appendChild(wrap);
    }

    function docReady(callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
            return;
        }
        callback();
    }

    function q(selector, root) {
        return (root || document).querySelector(selector);
    }

    function qa(selector, root) {
        return Array.prototype.slice.call((root || document).querySelectorAll(selector));
    }

    function safeRemove(node) {
        if (node && node.parentNode) {
            node.parentNode.removeChild(node);
        }
    }

    function purgeDeadLoaders(scope) {
        var root = scope || document;
        var targets = [];

        if (root.nodeType === 1 && root.matches && root.matches(DEAD_LOADER_SELECTOR)) {
            targets.push(root);
        }

        qa(DEAD_LOADER_SELECTOR, root).forEach(function (node) {
            if (targets.indexOf(node) === -1) targets.push(node);
        });

        targets
            .sort(function (a, b) {
                if (a.classList && a.classList.contains('ms_plugin_loader_bg_')) return -1;
                if (b.classList && b.classList.contains('ms_plugin_loader_bg_')) return 1;
                return 0;
            })
            .forEach(function (node) {
                safeRemove(node);
            });

        if (targets.length) {
            document.documentElement.classList.add('bes-account-global-loader-purged');
        }
    }

    function text(node) {
        return (node && node.textContent ? node.textContent : '').replace(/\s+/g, ' ').trim();
    }

    function normPath(value) {
        value = (value || '').trim();
        if (!value) return '';
        if (value.charAt(0) === '#') return '#';
        try {
            var url = new URL(value, window.location.origin);
            var path = url.pathname.replace(/\/+$/, '/');
            return path || '/';
        } catch (e) {
            return '';
        }
    }

    function cleanTitle(value) {
        value = (value || '').replace(/\s+/g, ' ').trim();
        value = value.replace(/\s+[-|]\s+Bali\s+Eling\s+Spirit.*$/i, '').trim();
        value = value.replace(/\s+[-|]\s+Bali\s+Hatha\s+Yoga.*$/i, '').trim();
        return value;
    }

    function routeKey() {
        var path = window.location.pathname.toLowerCase().replace(/\/+$/, '/');
        if (/\/user-account\/?$/.test(path)) return 'dashboard';
        if (path.indexOf('/analytics') !== -1) return 'analytics';
        if (path.indexOf('/gradebook') !== -1) return 'gradebook';
        if (path.indexOf('/enrolled-courses') !== -1) return 'courses';
        if (path.indexOf('/enrolled-quizzes') !== -1) return 'quizzes';
        if (path.indexOf('/enrolled-assignments') !== -1) return 'assignments';
        if (path.indexOf('/assignments') !== -1) return 'assignments';
        if (path.indexOf('/my-certificates') !== -1) return 'certificates';
        if (path.indexOf('/my-grades') !== -1 || path.indexOf('/grades') !== -1) return 'grades';
        if (path.indexOf('/chat') !== -1 || path.indexOf('/messages') !== -1) return 'messages';
        if (path.indexOf('/announcement') !== -1) return 'announcement';
        if (path.indexOf('/bundles') !== -1) return 'bundles';
        if (path.indexOf('/sales') !== -1) return 'sales';
        if (path.indexOf('/my-orders') !== -1 || path.indexOf('/orders') !== -1) return 'orders';
        if (path.indexOf('/wishlist') !== -1) return 'wishlist';
        if (path.indexOf('/settings') !== -1) return 'settings';
        if (path.indexOf('/edit-course') !== -1 || path.indexOf('/add-course') !== -1) return 'editcourse';
        if (path.indexOf('/manage-students') !== -1 || path.indexOf('/enrolled-students') !== -1 || path.indexOf('/students') !== -1) return 'students';
        if (path.indexOf('/user-account/') !== -1) return 'account';
        return 'dashboard';
    }

    function currentMeta() {
        var key = routeKey();
        var meta = pageCopy[key] || pageCopy.dashboard;
        var activeLabel = text(q('.masterstudy-account-menu__list-item_active .masterstudy-account-menu__list-item-label'));
        var h1 = text(q('.masterstudy-account-container h1')) || text(q('.masterstudy-account-container h3'));
        var title = key === 'dashboard' ? (activeLabel || meta.title) : (h1 || activeLabel || meta.title);
        return {
            key: key,
            title: cleanTitle(title) || meta.title,
            eyebrow: meta.eyebrow,
            text: meta.text
        };
    }

    function setAdminBarHeight() {
        var bar = document.getElementById('wpadminbar');
        var adminHeight = bar ? Math.round(bar.getBoundingClientRect().height) : 0;
        var header = document.getElementById('bes-hdr') || document.querySelector('.site-header, header[role="banner"], .elementor-location-header');
        var headerHeight = 96;
        if (header) {
            var style = window.getComputedStyle(header);
            var rect = header.getBoundingClientRect();
            if (style.position === 'fixed' || style.position === 'sticky') {
                headerHeight = Math.max(74, Math.min(132, Math.round(rect.height || 96)));
            }
        }
        document.documentElement.style.setProperty('--bes-account-adminbar-h', adminHeight + 'px');
        document.body.style.setProperty('--bes-account-adminbar-h', adminHeight + 'px');
        document.documentElement.style.setProperty('--bes-account-header-h', headerHeight + 'px');
        document.body.style.setProperty('--bes-account-header-h', headerHeight + 'px');
    }

    function ensureBodyClass() {
        document.body.classList.add(BODY_CLASS);
    }

    function classifyPage(root) {
        if (!root) return;
        var key = routeKey();
        var classes = [
            'bes-account-dashboard',
            'bes-account-account',
            'bes-account-analytics',
            'bes-account-gradebook',
            'bes-account-courses',
            'bes-account-quizzes',
            'bes-account-assignments',
            'bes-account-certificates',
            'bes-account-grades',
            'bes-account-messages',
            'bes-account-announcement',
            'bes-account-bundles',
            'bes-account-sales',
            'bes-account-orders',
            'bes-account-wishlist',
            'bes-account-settings',
            'bes-account-editcourse',
            'bes-account-students',
            'bes-account-instructor',
            'bes-account-learner',
            'bes-account-has-courses',
            'bes-account-has-table'
        ];
        classes.forEach(function (className) { document.body.classList.remove(className); });
        document.body.classList.add('bes-account-' + key);
        if (q('.masterstudy-instructor-courses, .masterstudy-analytics-short-report-page', root)) {
            document.body.classList.add('bes-account-instructor');
        } else {
            document.body.classList.add('bes-account-learner');
        }
        if (q('.masterstudy-course-card, .stm_lms_courses__single', root)) {
            document.body.classList.add('bes-account-has-courses');
        }
        if (q('table, .masterstudy-datatable', root)) {
            document.body.classList.add('bes-account-has-table');
        }
    }

    function ensureOverlay() {
        var overlay = document.getElementById(overlayId);
        if (overlay) return overlay;
        overlay = document.createElement('div');
        overlay.id = overlayId;
        overlay.setAttribute('aria-hidden', 'true');
        document.body.appendChild(overlay);
        overlay.addEventListener('click', closeSidebar, false);
        return overlay;
    }

    function openSidebar() {
        ensureOverlay();
        document.body.classList.add(MENU_OPEN_CLASS);
        var sidebar = q(SIDEBAR_SELECTOR);
        if (sidebar) {
            sidebar.classList.add('bes-account-sidebar-open');
            sidebar.setAttribute('aria-hidden', 'false');
            var first = q('a, button, input, [tabindex]:not([tabindex="-1"])', sidebar);
            if (first && window.matchMedia('(max-width: 1024px)').matches) {
                setTimeout(function () { first.focus({ preventScroll: true }); }, 70);
            }
        }
    }

    function closeSidebar() {
        document.body.classList.remove(MENU_OPEN_CLASS);
        var sidebar = q(SIDEBAR_SELECTOR);
        if (sidebar) {
            sidebar.classList.remove('bes-account-sidebar-open');
            sidebar.setAttribute('aria-hidden', window.matchMedia('(max-width: 1024px)').matches ? 'true' : 'false');
        }
    }

    function wireSidebar(root) {
        ensureOverlay();
        var sidebar = q(SIDEBAR_SELECTOR, root || document);
        if (sidebar && !sidebar.dataset.besAccountReady) {
            sidebar.dataset.besAccountReady = 'true';
            if (!sidebar.id) sidebar.id = 'bes-account-sidebar';
            sidebar.setAttribute('role', 'navigation');
            sidebar.setAttribute('aria-label', 'Account navigation');
        }

        qa(MOBILE_MENU_SELECTOR + ' a, ' + MOBILE_MENU_SELECTOR + ' .masterstudy-account-mobile-menu__link').forEach(function (link) {
            if (link.dataset.besAccountWired) return;
            link.dataset.besAccountWired = 'true';
            if ((link.getAttribute('data-id') || '').toLowerCase() === 'menu' || normPath(link.getAttribute('href')) === '#') {
                link.setAttribute('role', 'button');
                link.setAttribute('aria-controls', 'bes-account-sidebar');
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (document.body.classList.contains(MENU_OPEN_CLASS)) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                }, false);
            }
        });

        qa('.masterstudy-account-sidebar__back').forEach(function (button) {
            if (button.dataset.besAccountWired) return;
            button.dataset.besAccountWired = 'true';
            button.setAttribute('role', 'button');
            button.setAttribute('tabindex', '0');
            button.setAttribute('aria-label', 'Close account menu');
            button.addEventListener('click', closeSidebar, false);
            button.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    closeSidebar();
                }
            }, false);
        });
    }

    function normalizeActiveLinks(root) {
        var current = normPath(window.location.href);
        var best = null;
        var bestLength = 0;
        var menuLinks = qa('.masterstudy-account-menu__list-item[href]', root || document);
        var mobileLinks = qa('.masterstudy-account-mobile-menu__link[href]', document);
        var allLinks = menuLinks.concat(mobileLinks);

        allLinks.forEach(function (link) {
            var href = link.getAttribute('href') || '';
            var path = normPath(href);
            link.classList.remove(ROUTE_ACTIVE_CLASS);
            link.classList.remove('bes-account-force-visible');
            if (link.getAttribute('aria-current') === 'page' && !link.classList.contains('masterstudy-account-menu__list-item_active') && !link.classList.contains('masterstudy-account-mobile-menu__link_active')) {
                link.removeAttribute('aria-current');
            }
            if (!path || path === '#') return;
            var normalizedPath = path.replace(/\/+$/, '/');
            if (current === normalizedPath || (normalizedPath !== '/' && current.indexOf(normalizedPath) === 0)) {
                if (normalizedPath.length > bestLength) {
                    best = link;
                    bestLength = normalizedPath.length;
                }
            }
        });

        if (!best) {
            best = q('.masterstudy-account-menu__list-item_active, .masterstudy-account-mobile-menu__link_active', root || document);
        }

        if (best) {
            var bestPath = normPath(best.getAttribute('href') || '');
            allLinks.forEach(function (link) {
                if (bestPath && normPath(link.getAttribute('href') || '') === bestPath) {
                    link.classList.add(ROUTE_ACTIVE_CLASS);
                    link.setAttribute('aria-current', 'page');
                    if (link.classList.contains('masterstudy-account-menu__list-item_hidden')) {
                        link.classList.add('bes-account-force-visible');
                    }
                }
            });
        }
    }

    function decorateMenu(root) {
        qa('.masterstudy-account-menu__list-item', root || document).forEach(function (item) {
            var label = text(q('.masterstudy-account-menu__list-item-label', item)) || text(item);
            if (label) {
                item.dataset.besAccountLabel = label.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            }
            if (!item.getAttribute('aria-label') && label) {
                item.setAttribute('aria-label', label);
            }
        });

        qa('.masterstudy-account-menu__list-section', root || document).forEach(function (section, index) {
            section.style.setProperty('--bes-section-index', index);
        });

        var mode = q('.masterstudy-account-menu__mode', root || document);
        var input = mode ? q('input[type="checkbox"]', mode) : null;
        if (mode && input) {
            mode.classList.toggle('bes-account-switch-active', !!input.checked);
            if (!input.dataset.besAccountWired) {
                input.dataset.besAccountWired = 'true';
                input.addEventListener('change', function () {
                    mode.classList.toggle('bes-account-switch-active', !!input.checked);
                }, false);
            }
        }
    }

    function createHero(root) {
        var container = q(CONTAINER_SELECTOR, root || document);
        if (!container) return;
        var meta = currentMeta();
        var existing = q('.bes-account-hero', container);
        if (existing && existing.dataset.besRoute === meta.key) {
            var existingTitle = q('.bes-account-hero__title', existing);
            var existingEyebrow = q('.bes-account-hero__eyebrow', existing);
            var existingText = q('.bes-account-hero__text', existing);
            if (existingTitle) existingTitle.textContent = meta.title;
            if (existingEyebrow) existingEyebrow.textContent = meta.eyebrow;
            if (existingText) existingText.textContent = meta.text;
            existing.setAttribute('aria-label', meta.title + ' overview');
            return;
        }
        if (existing) existing.parentNode.removeChild(existing);

        var profileLink = q('.masterstudy-account-profile__link');
        var activeLink = q('.masterstudy-account-menu__list-item_active, .masterstudy-account-menu__list-item.' + ROUTE_ACTIVE_CLASS);
        var addCourse = q('.masterstudy-instructor-courses__add-new-course-btn, a[href*="/edit-course/"]');
        var hero = document.createElement('section');
        hero.className = 'bes-account-hero';
        hero.dataset.besRoute = meta.key;
        hero.setAttribute('aria-label', meta.title + ' overview');

        var main = document.createElement('div');
        main.className = 'bes-account-hero__main';

        var eyebrow = document.createElement('div');
        eyebrow.className = 'bes-account-hero__eyebrow';
        eyebrow.textContent = meta.eyebrow;

        var title = document.createElement('h1');
        title.className = 'bes-account-hero__title';
        title.textContent = meta.title;

        var description = document.createElement('p');
        description.className = 'bes-account-hero__text';
        description.textContent = meta.text;

        main.appendChild(eyebrow);
        main.appendChild(title);
        main.appendChild(description);

        var actions = document.createElement('div');
        actions.className = 'bes-account-hero__actions';

        var menuButton = document.createElement('button');
        menuButton.type = 'button';
        menuButton.className = 'bes-account-hero__button bes-account-hero__button_menu';
        menuButton.textContent = 'Open menu';
        menuButton.setAttribute('aria-controls', 'bes-account-sidebar');
        menuButton.addEventListener('click', openSidebar, false);
        actions.appendChild(menuButton);

        if (profileLink && profileLink.href) {
            var profile = document.createElement('a');
            profile.className = 'bes-account-hero__button';
            profile.href = profileLink.href;
            profile.target = profileLink.target || '_blank';
            profile.rel = 'noopener noreferrer';
            profile.textContent = 'Public profile';
            actions.appendChild(profile);
        }

        if (addCourse && addCourse.href && (meta.key === 'dashboard' || meta.key === 'editcourse')) {
            var course = document.createElement('a');
            course.className = 'bes-account-hero__button bes-account-hero__button_primary';
            course.href = addCourse.href;
            course.target = addCourse.target || '_self';
            course.textContent = meta.key === 'editcourse' ? 'Course builder' : 'Add course';
            actions.appendChild(course);
        } else if (activeLink && activeLink.href) {
            var refresh = document.createElement('a');
            refresh.className = 'bes-account-hero__button bes-account-hero__button_primary';
            refresh.href = activeLink.href;
            refresh.textContent = 'Refresh view';
            actions.appendChild(refresh);
        }

        hero.appendChild(main);
        hero.appendChild(actions);
        container.insertBefore(hero, container.firstElementChild || null);
    }

    function normalizeHaveQuestion(root) {
        var scope = root || document;
        qa('.masterstudy-account-have-question__button', scope).forEach(function (button) {
            button.classList.add('bes-have-question-resolved');
            button.dataset.besHaveQuestionPattern = 'masterstudy-account-have-question__button';

            qa('.bes-inline-icon, .bes-stat-inline-icon', button).forEach(function (node) {
                safeRemove(node);
            });

            var nativeIcons = qa('i.stmlms-menu-have-question', button);
            var primaryIcon = nativeIcons[0] || null;
            var label = q('.masterstudy-account-have-question__label', button);

            nativeIcons.slice(1).forEach(function (icon) {
                safeRemove(icon);
            });

            if (!primaryIcon) {
                var fallback = q('.bes-have-question-fallback-icon', button);
                if (!fallback) {
                    fallback = document.createElement('span');
                    fallback.className = 'bes-have-question-fallback-icon';
                    fallback.textContent = '?';
                    if (label && label.parentNode === button) {
                        button.insertBefore(fallback, label);
                    } else {
                        button.insertBefore(fallback, button.firstChild || null);
                    }
                }
                primaryIcon = fallback;
            } else {
                qa('.bes-have-question-fallback-icon', button).forEach(function (fallback) {
                    safeRemove(fallback);
                });
                if (label && primaryIcon.nextElementSibling !== label && primaryIcon.parentNode === button) {
                    button.insertBefore(primaryIcon, label);
                }
            }

            primaryIcon.classList.add('bes-have-question-icon');
            primaryIcon.setAttribute('aria-hidden', 'true');
            primaryIcon.setAttribute('focusable', 'false');

            if (label) {
                label.textContent = text(label) || 'Have a question?';
            }

            if (!button.getAttribute('role')) button.setAttribute('role', 'button');
            if (!button.getAttribute('tabindex')) button.setAttribute('tabindex', '0');
        });
    }

    function enhanceStats(root) {
        qa('.masterstudy-stats-block', root || document).forEach(function (block) {
            var icon = q('.masterstudy-stats-block__icon', block);
            if (!icon) return;
            removeBesIcons(icon);
            icon.removeAttribute('data-bes-icon');
            icon.removeAttribute('data-bes-inline-icon-type');
            icon.classList.add('bes-native-stat-icon');
            icon.setAttribute('aria-hidden', 'true');
            var value = q('.masterstudy-stats-block__value', block);
            if (value && !text(value)) {
                value.setAttribute('aria-label', 'No data yet');
            }
        });

        qa('.masterstudy-analytics-short-report-page-stats__block', root || document).forEach(function (block, index) {
            block.style.setProperty('--bes-stat-index', index);
        });
    }

    function enhanceSelects(root) {
        qa('.masterstudy-select', root || document).forEach(function (select) {
            if (select.dataset.besAccountSelectReady) return;
            select.dataset.besAccountSelectReady = 'true';
            var wrapper = q('.masterstudy-select__wrapper', select);
            if (wrapper) {
                wrapper.setAttribute('role', 'button');
                wrapper.setAttribute('tabindex', wrapper.getAttribute('tabindex') || '0');
                wrapper.setAttribute('aria-haspopup', 'listbox');
                wrapper.addEventListener('click', function () {
                    setTimeout(function () {
                        select.classList.toggle('bes-account-select-open', !!q('.masterstudy-select__dropdown', select) && getComputedStyle(q('.masterstudy-select__dropdown', select)).display !== 'none');
                    }, 0);
                }, false);
                wrapper.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        wrapper.click();
                    }
                }, false);
            }
            qa('.masterstudy-select__option', select).forEach(function (option) {
                option.setAttribute('role', 'option');
                if (!option.dataset.besAccountWired) {
                    option.dataset.besAccountWired = 'true';
                    option.addEventListener('click', function () {
                        select.classList.remove('bes-account-select-open');
                    }, false);
                }
            });
        });

        if (!document.documentElement.dataset.besAccountSelectGlobalReady) {
            document.documentElement.dataset.besAccountSelectGlobalReady = 'true';
            document.addEventListener('click', function (event) {
                qa('.masterstudy-select.bes-account-select-open').forEach(function (select) {
                    if (!select.contains(event.target)) {
                        select.classList.remove('bes-account-select-open');
                    }
                });
            }, true);
        }
    }

    function wireCourseActions(root) {
        qa('.masterstudy-course-card', root || document).forEach(function (card) {
            var button = q('.masterstudy-instructor-course-actions__modal-btn', card);
            var modal = q('.masterstudy-instructor-course-actions__modal', card);
            if (!button || !modal || button.dataset.besAccountWired) return;
            button.dataset.besAccountWired = 'true';
            button.setAttribute('role', 'button');
            button.setAttribute('tabindex', '0');
            button.setAttribute('aria-haspopup', 'menu');
            button.setAttribute('aria-expanded', 'false');
            modal.setAttribute('role', 'menu');

            function toggle(event) {
                if (event) event.preventDefault();
                var isOpen = card.classList.toggle('bes-account-actions-open');
                button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                qa('.masterstudy-course-card').forEach(function (other) {
                    if (other !== card) {
                        other.classList.remove('bes-account-actions-open');
                        var otherButton = q('.masterstudy-instructor-course-actions__modal-btn', other);
                        if (otherButton) otherButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            button.addEventListener('click', toggle, false);
            button.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') toggle(event);
            }, false);
        });
    }

    function closeCourseActionsOnOutside(event) {
        if (event.target.closest('.masterstudy-course-card')) return;
        qa('.masterstudy-course-card.bes-account-actions-open').forEach(function (card) {
            card.classList.remove('bes-account-actions-open');
            var button = q('.masterstudy-instructor-course-actions__modal-btn', card);
            if (button) button.setAttribute('aria-expanded', 'false');
        });
    }

    function repairLazyImages(root) {
        qa('img[data-src]:not([src]), img.lazyload[data-src]', root || document).forEach(function (img) {
            var src = img.getAttribute('data-src');
            if (src && (!img.getAttribute('src') || img.getAttribute('src').indexOf('data:image') === 0)) {
                img.setAttribute('src', src);
            }
        });
    }

    function enhanceTables(root) {
        qa('.masterstudy-datatable table, .masterstudy-account-container table', root || document).forEach(function (table) {
            if (table.dataset.besAccountTableReady && table.dataset.besAccountColumnCount === String(qa('thead th', table).length)) return;
            var headers = qa('thead th', table).map(function (th, index) {
                th.classList.add('bes-account-table-head-cell');
                th.setAttribute('scope', th.getAttribute('scope') || 'col');
                th.style.removeProperty('color');
                th.style.removeProperty('background');
                th.style.removeProperty('background-color');
                return text(th).replace(/:$/, '') || 'Column ' + (index + 1);
            });
            table.dataset.besAccountTableReady = 'true';
            table.dataset.besAccountColumnCount = String(headers.length);
            qa('tbody tr', table).forEach(function (row) {
                qa('td', row).forEach(function (cell, index) {
                    if (headers[index] && !cell.getAttribute('data-label')) {
                        cell.setAttribute('data-label', headers[index]);
                    }
                });
            });
        });
    }

    function enhanceGradebook(root) {
        var gradebook = q('.masterstudy-account-gradebook', root || document);
        if (!gradebook) return;
        qa('.masterstudy-account-gradebook__stat', gradebook).forEach(function (stat, index) {
            stat.style.setProperty('--bes-grade-stat-index', index);
            var value = q('.masterstudy-account-gradebook__stat-value', stat);
            var iconType = 'default';
            ['bes-grade-stat-students', 'bes-grade-stat-lessons', 'bes-grade-stat-quizzes', 'bes-grade-stat-assignments', 'bes-grade-stat-progress', 'bes-grade-stat-subscription'].forEach(function (className) {
                stat.classList.remove(className);
            });
            if (value) {
                var valueClasses = ' ' + (value.className || '') + ' ';
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-students-count ') !== -1) {
                    stat.classList.add('bes-grade-stat-students');
                    iconType = 'grade_students';
                }
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-lessons ') !== -1) {
                    stat.classList.add('bes-grade-stat-lessons');
                    iconType = 'grade_lessons';
                }
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-quizzes ') !== -1) {
                    stat.classList.add('bes-grade-stat-quizzes');
                    iconType = 'grade_quizzes';
                }
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-assignments ') !== -1) {
                    stat.classList.add('bes-grade-stat-assignments');
                    iconType = 'grade_assignments';
                }
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-avg-progress ') !== -1) {
                    stat.classList.add('bes-grade-stat-progress');
                    iconType = 'grade_progress';
                }
                if (valueClasses.indexOf(' masterstudy-account-gradebook__stat-subs-enroll ') !== -1) {
                    stat.classList.add('bes-grade-stat-subscription');
                    iconType = 'grade_subscription';
                }
                if (!text(value)) {
                    value.setAttribute('aria-label', 'No gradebook data yet');
                }
            }
            placeBesIcon(stat, iconType, 'bes-grade-stat-visual');
        });
    }

    function wireModals(root) {
        qa('.masterstudy-enterprise-modal', root || document).forEach(function (modal) {
            if (modal.dataset.besAccountModalReady) return;
            modal.dataset.besAccountModalReady = 'true';
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');
            var title = q('.masterstudy-enterprise-modal__header-title', modal);
            if (title && !title.id) title.id = 'bes-enterprise-modal-title';
            if (title) modal.setAttribute('aria-labelledby', title.id);
        });
    }

    function updateModalState() {
        var open = false;
        qa('.masterstudy-enterprise-modal').forEach(function (modal) {
            var style = modal.getAttribute('style') || '';
            var computed = window.getComputedStyle(modal);
            var visible = style.indexOf('opacity:0') === -1 && computed.display !== 'none' && computed.visibility !== 'hidden' && computed.opacity !== '0';
            if (visible) open = true;
        });
        document.body.classList.toggle('bes-account-modal-open', open);
    }

    function wireEscape() {
        if (document.documentElement.dataset.besAccountEscapeReady) return;
        document.documentElement.dataset.besAccountEscapeReady = 'true';
        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') return;
            closeSidebar();
            qa('.masterstudy-course-card.bes-account-actions-open').forEach(function (card) {
                card.classList.remove('bes-account-actions-open');
            });
        }, false);
        document.addEventListener('click', closeCourseActionsOnOutside, true);
    }

    function stabilizeLayout(root) {
        var account = root || q(ROOT_SELECTOR);
        if (!account) return;

        var mobileMenu = q(MOBILE_MENU_SELECTOR, account) || q(MOBILE_MENU_SELECTOR);
        if (mobileMenu) {
            var mobileLinks = qa('.masterstudy-account-mobile-menu__link', mobileMenu);
            mobileMenu.style.setProperty('--bes-account-mobile-cols', String(Math.max(1, Math.min(5, mobileLinks.length || 4))));
            mobileLinks.forEach(function (link) {
                var label = text(q('.masterstudy-account-mobile-menu__item', link)) || text(link) || (link.getAttribute('data-id') || 'Account');
                if (!link.getAttribute('aria-label')) link.setAttribute('aria-label', label);
            });
        }

        qa('.masterstudy-course-card', account).forEach(function (card, index) {
            card.style.setProperty('--bes-course-index', index);
        });

        qa('.masterstudy-enterprise-modal__close, .masterstudy-enterprise-modal__header-close', account).forEach(function (button) {
            if (!button.getAttribute('aria-label')) button.setAttribute('aria-label', 'Close dialog');
            if (!button.getAttribute('role')) button.setAttribute('role', 'button');
            if (!button.getAttribute('tabindex')) button.setAttribute('tabindex', '0');
        });

        qa('.masterstudy-account-container > :not(.bes-account-hero)', account).forEach(function (section, index) {
            if (section.nodeType === 1) section.style.setProperty('--bes-content-index', index);
        });
    }

    function viewportFlags() {
        document.body.classList.toggle('bes-account-mobile-viewport', window.matchMedia('(max-width: 1024px)').matches);
        var sidebar = q(SIDEBAR_SELECTOR);
        if (sidebar && !document.body.classList.contains(MENU_OPEN_CLASS)) {
            sidebar.setAttribute('aria-hidden', window.matchMedia('(max-width: 1024px)').matches ? 'true' : 'false');
        }
    }

    function scrollFlags() {
        var scrolled = window.scrollY > 24;
        document.body.classList.toggle('bes-account-scrolled', scrolled);
        var root = q(ROOT_SELECTOR);
        if (root) root.classList.toggle('bes-account-root-scrolled', scrolled);
    }

    function run() {
        scheduled = false;
        purgeDeadLoaders(document);
        var root = q(ROOT_SELECTOR);
        if (!root) return;
        bootCount += 1;
        ensureBodyClass();
        setAdminBarHeight();
        classifyPage(root);
        decorateMenu(root);
        normalizeActiveLinks(root);
        wireSidebar(root);
        stabilizeLayout(root);
        createHero(root);
        enhanceStats(root);
        normalizeHaveQuestion(root);
        enhanceSelects(root);
        wireCourseActions(root);
        repairLazyImages(root);
        enhanceTables(root);
        enhanceGradebook(root);
        wireModals(root);
        updateModalState();
        wireEscape();
        viewportFlags();
        scrollFlags();
        document.body.classList.add(READY_CLASS);
        root.dataset.besAccountBootCount = String(bootCount);
    }

    function schedule() {
        if (scheduled) return;
        scheduled = true;
        window.requestAnimationFrame(run);
    }

    function observe() {
        if (observer || !document.body) return;
        observer = new MutationObserver(function (mutations) {
            var relevant = false;
            for (var i = 0; i < mutations.length; i += 1) {
                var mutation = mutations[i];
                if (mutation.type === 'attributes') {
                    if (mutation.target && mutation.target.closest && mutation.target.closest(ROOT_SELECTOR + ', .masterstudy-enterprise-modal')) {
                        relevant = true;
                        break;
                    }
                }
                if (mutation.addedNodes && mutation.addedNodes.length) {
                    for (var n = 0; n < mutation.addedNodes.length; n += 1) {
                        var node = mutation.addedNodes[n];
                        if (node.nodeType !== 1) continue;
                        if ((node.matches && node.matches(DEAD_LOADER_SELECTOR)) || (node.querySelector && node.querySelector(DEAD_LOADER_SELECTOR))) {
                            purgeDeadLoaders(node);
                            continue;
                        }
                        if ((node.matches && node.matches(ROOT_SELECTOR + ', .masterstudy-enterprise-modal, table, .masterstudy-course-card, .masterstudy-select, .masterstudy-account-have-question__button')) || (node.querySelector && node.querySelector(ROOT_SELECTOR + ', .masterstudy-enterprise-modal, table, .masterstudy-course-card, .masterstudy-select, .masterstudy-account-have-question__button'))) {
                            relevant = true;
                            break;
                        }
                    }
                }
                if (relevant) break;
            }
            if (relevant) schedule();
            updateModalState();
        });
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class', 'style', 'aria-hidden']
        });
    }

    docReady(function () {
        purgeDeadLoaders(document);
        run();
        observe();
        window.addEventListener('resize', function () {
            setAdminBarHeight();
            viewportFlags();
        }, { passive: true });
        window.addEventListener('scroll', scrollFlags, { passive: true });
        window.setTimeout(schedule, 120);
        window.setTimeout(schedule, 600);
        window.setTimeout(schedule, 1600);
    });
}());
JS;
    }
}
