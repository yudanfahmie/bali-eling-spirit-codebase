<?php
/**
 * BES LMS Course Player Surgical Fix
 *
 * Surgical override for MasterStudy course-player lesson pages.
 * Load this AFTER any previous BES LMS styling snippet. It does not rebuild the
 * template. It only tightens the existing header, sidebar, lesson title/content,
 * bottom navigation, and removes MasterStudy loaders reliably.
 *
 * @package BaliElingSpirit
 * @version 1.4.2
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('bes_lms_surgical_tokens')) {
    /**
     * Pull from the global BES palette when available, with safe fallbacks.
     */
    function bes_lms_surgical_tokens(): array {
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

if (! function_exists('bes_lms_surgical_css_value')) {
    /**
     * Permit only simple CSS color values expected from the token map.
     */
    function bes_lms_surgical_css_value(array $tokens, string $key): string {
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

if (! function_exists('bes_lms_surgical_should_target')) {
    /**
     * Reusable conditional targeting for MasterStudy course-player lesson screens.
     */
    function bes_lms_surgical_should_target(): bool {
        if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
            return false;
        }

        $request_uri = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
        $path        = wp_parse_url($request_uri, PHP_URL_PATH) ?: '';

        $path_regex = (string) apply_filters(
            'bes_lms_surgical_course_player_path_regex',
            '~^/courses/[^/]+/[0-9]+/?$~'
        );

        $query_trigger = isset($_GET['curriculum_open']) || isset($_GET['lesson_id']) || isset($_GET['lecture_id']);
        $path_trigger  = (bool) preg_match($path_regex, $path);

        $post_types = (array) apply_filters('bes_lms_surgical_course_player_post_types', [
            'stm-lessons',
            'stm-quizzes',
            'stm-assignments',
            'stm-lms-assignments',
            'stm-google-meets',
            'stm-zoom',
        ]);

        $post_trigger = function_exists('is_singular') && is_singular($post_types);
        $should       = $path_trigger || $query_trigger || $post_trigger;

        return (bool) apply_filters('bes_lms_surgical_should_target', $should, $path, get_post_type());
    }
}

add_filter('body_class', function (array $classes): array {
    if (bes_lms_surgical_should_target()) {
        $classes[] = 'bes-lms-surgical-course-player';
    }

    return array_values(array_unique($classes));
}, 20);

if (! function_exists('bes_lms_surgical_elementor_asset_handles')) {
    /**
     * Elementor is not required inside the MasterStudy course-player shell.
     * On targeted lesson pages we remove Elementor frontend assets instead of
     * faking Elementor context, which avoids elementorFrontendConfig failures
     * during lesson reloads and keeps the LMS flow isolated to MasterStudy.
     */
    function bes_lms_surgical_elementor_asset_handles(): array {
        return (array) apply_filters('bes_lms_surgical_elementor_asset_handles', [
            'elementor-admin-bar',
            'elementor-animations',
            'elementor-app-loader',
            'elementor-common',
            'elementor-dialog',
            'elementor-frontend',
            'elementor-frontend-css',
            'elementor-frontend-modules',
            'elementor-global',
            'elementor-icons',
            'elementor-post',
            'elementor-pro-frontend',
            'elementor-pro-webpack-runtime',
            'elementor-waypoints',
            'elementor-webpack-runtime',
            'eicons',
            'elementor-sticky',
            'elementor-motion-fx',
            'elementor-frontend-legacy',
        ]);
    }
}

if (! function_exists('bes_lms_surgical_is_elementor_asset')) {
    function bes_lms_surgical_is_elementor_asset(string $handle, string $src = ''): bool {
        $handle_l = strtolower($handle);
        $src_l    = strtolower($src);

        foreach (bes_lms_surgical_elementor_asset_handles() as $blocked_handle) {
            if ($handle_l === strtolower((string) $blocked_handle)) {
                return true;
            }
        }

        if (strpos($handle_l, 'elementor') !== false || strpos($handle_l, 'eicons') !== false) {
            return true;
        }

        return strpos($src_l, 'elementor') !== false || strpos($src_l, 'eicons') !== false;
    }
}

if (! function_exists('bes_lms_surgical_dequeue_elementor_assets')) {
    function bes_lms_surgical_dequeue_elementor_assets(): void {
        if (! bes_lms_surgical_should_target()) {
            return;
        }

        foreach (bes_lms_surgical_elementor_asset_handles() as $handle) {
            $handle = (string) $handle;
            wp_dequeue_script($handle);
            wp_deregister_script($handle);
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        }

        global $wp_scripts, $wp_styles;

        if ($wp_scripts && isset($wp_scripts->registered) && is_array($wp_scripts->registered)) {
            foreach ($wp_scripts->registered as $handle => $asset) {
                $src = (is_object($asset) && isset($asset->src)) ? (string) $asset->src : '';
                if (bes_lms_surgical_is_elementor_asset((string) $handle, $src)) {
                    wp_dequeue_script((string) $handle);
                    wp_deregister_script((string) $handle);
                }
            }
        }

        if ($wp_styles && isset($wp_styles->registered) && is_array($wp_styles->registered)) {
            foreach ($wp_styles->registered as $handle => $asset) {
                $src = (is_object($asset) && isset($asset->src)) ? (string) $asset->src : '';
                if (bes_lms_surgical_is_elementor_asset((string) $handle, $src)) {
                    wp_dequeue_style((string) $handle);
                    wp_deregister_style((string) $handle);
                }
            }
        }
    }
}

if (! function_exists('bes_lms_surgical_strip_elementor_markup')) {
    function bes_lms_surgical_strip_elementor_markup(string $html): string {
        if ($html === '' || (stripos($html, 'elementor') === false && stripos($html, 'eicons') === false)) {
            return $html;
        }

        $patterns = [
            '~<script\b(?=[^>]*(?:src|id)=["\'][^"\']*(?:elementor|eicons)[^"\']*["\'])[^>]*>.*?</script>~is',
            '~<link\b(?=[^>]*(?:href|id)=["\'][^"\']*(?:elementor|eicons)[^"\']*["\'])[^>]*>~is',
            '~<style\b(?=[^>]*id=["\'][^"\']*(?:elementor|eicons)[^"\']*["\'])[^>]*>.*?</style>~is',
            '~<script\b(?![^>]*\bsrc=)[^>]*>[^<]*(?:elementorFrontendConfig|elementorCommonConfig|ElementorProFrontendConfig|elementorModules|elementorFrontend)[\s\S]*?</script>~is',
        ];

        $stripped = preg_replace($patterns, '', $html);

        return is_string($stripped) ? $stripped : $html;
    }
}

if (! function_exists('bes_lms_surgical_start_elementor_buffer')) {
    function bes_lms_surgical_start_elementor_buffer(): void {
        if (! bes_lms_surgical_should_target()) {
            return;
        }

        bes_lms_surgical_dequeue_elementor_assets();
        ob_start('bes_lms_surgical_strip_elementor_markup');
    }
}

add_action('template_redirect', 'bes_lms_surgical_start_elementor_buffer', 0);
add_action('wp_enqueue_scripts', 'bes_lms_surgical_dequeue_elementor_assets', PHP_INT_MAX);
add_action('wp_print_scripts', 'bes_lms_surgical_dequeue_elementor_assets', 0);
add_action('wp_print_footer_scripts', 'bes_lms_surgical_dequeue_elementor_assets', 0);
add_action('wp_print_styles', 'bes_lms_surgical_dequeue_elementor_assets', 0);

add_filter('script_loader_tag', function (string $tag, string $handle, string $src): string {
    if (bes_lms_surgical_should_target() && bes_lms_surgical_is_elementor_asset($handle, $src)) {
        return '';
    }

    return $tag;
}, 0, 3);

add_filter('style_loader_tag', function (string $html, string $handle, string $href, string $media): string {
    if (bes_lms_surgical_should_target() && bes_lms_surgical_is_elementor_asset($handle, $href)) {
        return '';
    }

    return $html;
}, 0, 4);

add_action('wp_enqueue_scripts', function (): void {
    if (! bes_lms_surgical_should_target()) {
        return;
    }

    $handle  = 'bes-lms-course-player-surgical-fix';
    $version = '1.4.2';
    $tokens  = bes_lms_surgical_tokens();

    wp_register_style($handle, false, [], $version);
    wp_enqueue_style($handle);
    wp_add_inline_style($handle, bes_lms_surgical_css($tokens));

    wp_register_script($handle, '', [], $version, true);
    wp_enqueue_script($handle);
    wp_add_inline_script($handle, bes_lms_surgical_js(), 'after');
}, 9999);

if (! function_exists('bes_lms_surgical_css')) {
    function bes_lms_surgical_css(array $tokens): string {
        $forest      = bes_lms_surgical_css_value($tokens, 'forest');
        $forest_deep = bes_lms_surgical_css_value($tokens, 'forest_deep');
        $forest_92   = bes_lms_surgical_css_value($tokens, 'forest_92');
        $forest_80   = bes_lms_surgical_css_value($tokens, 'forest_80');
        $olive       = bes_lms_surgical_css_value($tokens, 'olive');
        $olive_dark  = bes_lms_surgical_css_value($tokens, 'olive_dark');
        $olive_light = bes_lms_surgical_css_value($tokens, 'olive_light');
        $moss        = bes_lms_surgical_css_value($tokens, 'moss');
        $sage        = bes_lms_surgical_css_value($tokens, 'sage');
        $leaf        = bes_lms_surgical_css_value($tokens, 'leaf');
        $leaf_hover  = bes_lms_surgical_css_value($tokens, 'leaf_hover');
        $leaf_soft   = bes_lms_surgical_css_value($tokens, 'leaf_soft');
        $leaf_glow   = bes_lms_surgical_css_value($tokens, 'leaf_glow');
        $gold        = bes_lms_surgical_css_value($tokens, 'gold');
        $gold_soft   = bes_lms_surgical_css_value($tokens, 'gold_soft');
        $parchment   = bes_lms_surgical_css_value($tokens, 'parchment');
        $ivory       = bes_lms_surgical_css_value($tokens, 'ivory');
        $sand        = bes_lms_surgical_css_value($tokens, 'sand');
        $cream       = bes_lms_surgical_css_value($tokens, 'cream');
        $bark        = bes_lms_surgical_css_value($tokens, 'bark');
        $bark_soft   = bes_lms_surgical_css_value($tokens, 'bark_soft');
        $bark_muted  = bes_lms_surgical_css_value($tokens, 'bark_muted');

        return <<<CSS
/* ==========================================================================
   BES LMS Course Player Surgical Fix
   Scope: body.bes-lms-surgical-course-player only.
   Purpose: tidy existing MasterStudy UI without rebuilding template markup.
   ========================================================================== */
body.bes-lms-surgical-course-player {
    --bes-lms-fix-forest: var(--bes-forest, {$forest});
    --bes-lms-fix-forest-deep: var(--bes-forest-deep, {$forest_deep});
    --bes-lms-fix-forest-92: var(--bes-forest-92, {$forest_92});
    --bes-lms-fix-forest-80: var(--bes-forest-80, {$forest_80});
    --bes-lms-fix-olive: var(--bes-olive, {$olive});
    --bes-lms-fix-olive-dark: var(--bes-olive-dark, {$olive_dark});
    --bes-lms-fix-olive-light: var(--bes-olive-light, {$olive_light});
    --bes-lms-fix-moss: var(--bes-moss, {$moss});
    --bes-lms-fix-sage: var(--bes-sage, {$sage});
    --bes-lms-fix-leaf: var(--bes-leaf, {$leaf});
    --bes-lms-fix-leaf-hover: var(--bes-leaf-hover, {$leaf_hover});
    --bes-lms-fix-leaf-soft: var(--bes-leaf-soft, {$leaf_soft});
    --bes-lms-fix-leaf-glow: var(--bes-leaf-glow, {$leaf_glow});
    --bes-lms-fix-gold: var(--bes-gold, {$gold});
    --bes-lms-fix-gold-soft: var(--bes-gold-soft, {$gold_soft});
    --bes-lms-fix-parchment: var(--bes-parchment, {$parchment});
    --bes-lms-fix-ivory: var(--bes-ivory, {$ivory});
    --bes-lms-fix-sand: var(--bes-sand, {$sand});
    --bes-lms-fix-cream: var(--bes-cream, {$cream});
    --bes-lms-fix-bark: var(--bes-bark, {$bark});
    --bes-lms-fix-bark-soft: var(--bes-bark-soft, {$bark_soft});
    --bes-lms-fix-bark-muted: var(--bes-bark-muted, {$bark_muted});
    --bes-lms-fix-font-body: var(--bes-font-body, 'Plus Jakarta Sans', 'Helvetica Neue', Arial, sans-serif);
    --bes-lms-fix-font-display: var(--bes-font-display, 'Cormorant Garamond', Georgia, 'Times New Roman', serif);
    --bes-lms-fix-sidebar-w: clamp(310px, 18.7vw, 360px);
    --bes-lms-fix-header-h: 74px;
    --bes-lms-fix-radius-sm: var(--bes-radius-sm, 10px);
    --bes-lms-fix-radius-md: var(--bes-radius-md, 14px);
    --bes-lms-fix-radius-lg: var(--bes-radius-lg, 20px);
    --bes-lms-fix-shadow-soft: 0 14px 36px rgba(21, 30, 16, .10);
    --bes-lms-fix-shadow-card: 0 22px 58px rgba(21, 30, 16, .12);
    --bes-lms-fix-ease: cubic-bezier(.22, 1, .36, 1);
    --bes-lms-fix-ease-standard: cubic-bezier(.4, 0, .2, 1);
    background: linear-gradient(90deg, var(--bes-lms-fix-cream), var(--bes-lms-fix-ivory) 38%, var(--bes-lms-fix-parchment));
    color: var(--bes-lms-fix-bark);
    font-family: var(--bes-lms-fix-font-body);
}

body.bes-lms-surgical-course-player .masterstudy-loader,
body.bes-lms-surgical-course-player .masterstudy-loader_global {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-course-player-header, .masterstudy-course-player-curriculum, .masterstudy-course-player-content, .masterstudy-course-player-discussions) *,
body.bes-lms-surgical-course-player :where(.masterstudy-course-player-header, .masterstudy-course-player-curriculum, .masterstudy-course-player-content, .masterstudy-course-player-discussions) *::before,
body.bes-lms-surgical-course-player :where(.masterstudy-course-player-header, .masterstudy-course-player-curriculum, .masterstudy-course-player-content, .masterstudy-course-player-discussions) *::after {
    box-sizing: border-box;
}

/* Header: compact, legible, and aligned. */
body.bes-lms-surgical-course-player .masterstudy-course-player-header {
    min-height: var(--bes-lms-fix-header-h) !important;
    height: var(--bes-lms-fix-header-h) !important;
    padding: 0 28px !important;
    gap: 14px !important;
    background: linear-gradient(135deg, rgba(21, 30, 16, .97), rgba(30, 42, 22, .96)) !important;
    border-bottom: 1px solid rgba(194, 210, 74, .16) !important;
    box-shadow: 0 10px 30px rgba(21, 30, 16, .18) !important;
    color: var(--bes-lms-fix-ivory) !important;
    backdrop-filter: blur(16px) saturate(1.18);
    -webkit-backdrop-filter: blur(16px) saturate(1.18);
}

body.admin-bar.bes-lms-surgical-course-player .masterstudy-course-player-header {
    top: 32px !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header::after {
    content: '';
    position: absolute;
    inset: auto 0 0 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(194, 210, 74, .38), rgba(201, 168, 76, .26), transparent);
    pointer-events: none;
}


/* Remove MasterStudy's default vertical header dividers. These were showing as ghost separators beside the back/curriculum/dark-mode/discussions controls. */
body.bes-lms-surgical-course-player :where(
    .masterstudy-course-player-header__back,
    .masterstudy-course-player-header__curriculum,
    .masterstudy-course-player-header__navigation,
    .masterstudy-course-player-header__dark-mode,
    .masterstudy-course-player-header__discussions
) {
    border-left: 0 !important;
    border-right: 0 !important;
    box-shadow: none !important;
    background-image: none !important;
}

body.bes-lms-surgical-course-player :where(
    .masterstudy-course-player-header__back,
    .masterstudy-course-player-header__curriculum,
    .masterstudy-course-player-header__navigation,
    .masterstudy-course-player-header__dark-mode,
    .masterstudy-course-player-header__discussions
)::before,
body.bes-lms-surgical-course-player :where(
    .masterstudy-course-player-header__back,
    .masterstudy-course-player-header__curriculum,
    .masterstudy-course-player-header__navigation,
    .masterstudy-course-player-header__dark-mode,
    .masterstudy-course-player-header__discussions
)::after {
    content: none !important;
    display: none !important;
    width: 0 !important;
    height: 0 !important;
    border: 0 !important;
    background: none !important;
    box-shadow: none !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-back-link, .masterstudy-dark-mode-button, .masterstudy-course-player-header__discussions-toggler, .masterstudy-switch-button)::before,
body.bes-lms-surgical-course-player :where(.masterstudy-back-link, .masterstudy-dark-mode-button, .masterstudy-course-player-header__discussions-toggler, .masterstudy-switch-button)::after {
    border-color: transparent !important;
    box-shadow: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header__back,
body.bes-lms-surgical-course-player .masterstudy-course-player-header__curriculum,
body.bes-lms-surgical-course-player .masterstudy-course-player-header__dark-mode,
body.bes-lms-surgical-course-player .masterstudy-course-player-header__discussions {
    flex: 0 0 auto !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header__course {
    min-width: 0 !important;
    flex: 1 1 auto !important;
    display: grid !important;
    align-content: center !important;
    gap: 1px !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header__course-label {
    margin: 0 !important;
    color: rgba(253, 252, 250, .52) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 10px !important;
    font-weight: 800 !important;
    letter-spacing: .18em !important;
    line-height: 1.15 !important;
    text-transform: uppercase !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header__course-title {
    max-width: 100% !important;
    overflow: hidden !important;
    color: var(--bes-lms-fix-ivory) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 14px !important;
    font-weight: 800 !important;
    line-height: 1.28 !important;
    text-decoration: none !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    transition: color .22s var(--bes-lms-fix-ease-standard) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-header__course-title:hover {
    color: var(--bes-lms-fix-leaf) !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-back-link, .masterstudy-switch-button, .masterstudy-dark-mode-button, .masterstudy-course-player-header__discussions-toggler) {
    min-height: 42px !important;
    border-radius: 999px !important;
    border: 1px solid rgba(194, 210, 74, .20) !important;
    background: rgba(255, 255, 255, .055) !important;
    color: rgba(253, 252, 250, .88) !important;
    box-shadow: none !important;
    transform: translateZ(0) !important;
    transition: transform .22s var(--bes-lms-fix-ease), background .22s var(--bes-lms-fix-ease-standard), border-color .22s var(--bes-lms-fix-ease-standard), color .22s var(--bes-lms-fix-ease-standard) !important;
}

body.bes-lms-surgical-course-player .masterstudy-switch-button {
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 0 18px !important;
}

body.bes-lms-surgical-course-player .masterstudy-switch-button__title,
body.bes-lms-surgical-course-player .masterstudy-course-player-header__discussions-toggler__title {
    color: inherit !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 13px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
    letter-spacing: .01em !important;
}

body.bes-lms-surgical-course-player .masterstudy-switch-button__burger span {
    background: currentColor !important;
    opacity: .82 !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-back-link, .masterstudy-switch-button, .masterstudy-dark-mode-button, .masterstudy-course-player-header__discussions-toggler):hover {
    transform: translateY(-1px) !important;
    border-color: rgba(194, 210, 74, .45) !important;
    background: rgba(194, 210, 74, .12) !important;
    color: var(--bes-lms-fix-leaf) !important;
}

body.bes-lms-surgical-course-player :where(a, button, input, textarea, [role='button'], .masterstudy-switch-button):focus-visible {
    outline: 2px solid var(--bes-lms-fix-leaf) !important;
    outline-offset: 3px !important;
    border-radius: 12px !important;
}

/* Page canvas: disable the previous oversized decorative blob and keep calm reading space. */
body.bes-lms-surgical-course-player .masterstudy-course-player-content {
    min-height: calc(100dvh - var(--bes-lms-fix-header-h)) !important;
    background:
        radial-gradient(circle at 100% 0%, rgba(216, 228, 140, .14), transparent 30rem),
        linear-gradient(90deg, var(--bes-lms-fix-cream), var(--bes-lms-fix-ivory) 44%, var(--bes-lms-fix-parchment)) !important;
    overflow-x: visible !important;
    overflow-y: visible !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-content::before {
    display: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper {
    width: min(100% - 40px, 960px) !important;
    max-width: 960px !important;
    margin-inline: auto !important;
    padding: clamp(34px, 5.2vw, 72px) 0 34px !important;
}

/* Title block: restore the missing H1 and remove the giant empty card. */
body.bes-lms-surgical-course-player .masterstudy-course-player-content__header {
    display: block !important;
    overflow: visible !important;
    min-height: 0 !important;
    margin: 0 0 22px !important;
    padding: 0 !important;
    border: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-content__header::before,
body.bes-lms-surgical-course-player .masterstudy-course-player-content__header::after {
    display: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type {
    display: inline-flex !important;
    align-items: center !important;
    width: auto !important;
    max-width: 100% !important;
    min-height: 26px !important;
    margin: 0 0 14px !important;
    padding: 6px 11px !important;
    border: 1px solid rgba(63, 81, 48, .14) !important;
    border-radius: 999px !important;
    background: rgba(216, 228, 140, .22) !important;
    color: var(--bes-lms-fix-olive-dark) !important;
    box-shadow: none !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    letter-spacing: .13em !important;
    line-height: 1 !important;
    text-transform: uppercase !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type::before {
    content: '' !important;
    display: inline-block !important;
    width: 6px !important;
    height: 6px !important;
    margin-right: 8px !important;
    border-radius: 999px !important;
    background: var(--bes-lms-fix-leaf) !important;
    box-shadow: 0 0 0 4px rgba(194, 210, 74, .18) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content > .masterstudy-course-player-content__wrapper > .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    max-width: 960px !important;
    margin: 0 !important;
    padding: 0 !important;
    color: var(--bes-lms-fix-bark) !important;
    font-family: var(--bes-lms-fix-font-display) !important;
    font-size: clamp(36px, 4.1vw, 58px) !important;
    font-weight: 600 !important;
    letter-spacing: -.028em !important;
    line-height: 1.17 !important;
    padding-bottom: .12em !important;
    text-wrap: balance;
    position: relative !important;
    z-index: 2 !important;
    height: auto !important;
    min-height: 1em !important;
    overflow: visible !important;
    clip: auto !important;
    clip-path: none !important;
    transform: none !important;
}

/* Lesson body: refined sheet, lighter than the previous heavy card. */
body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
    margin: 0 !important;
    padding: clamp(28px, 3.6vw, 44px) clamp(28px, 4vw, 48px) !important;
    border: 1px solid rgba(235, 230, 220, .92) !important;
    border-radius: var(--bes-lms-fix-radius-lg) !important;
    background: rgba(253, 252, 250, .92) !important;
    box-shadow: var(--bes-lms-fix-shadow-card) !important;
    color: var(--bes-lms-fix-bark-soft) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: clamp(15px, .9vw, 17px) !important;
    line-height: 1.82 !important;
    backdrop-filter: blur(10px) saturate(1.03) !important;
    -webkit-backdrop-filter: blur(10px) saturate(1.03) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p, ul, ol, blockquote) {
    max-width: 76ch !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson p {
    margin: 0 0 1.15em !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h2, h3, h4) {
    max-width: 26ch !important;
    margin: 1.22em 0 .45em !important;
    color: var(--bes-lms-fix-bark) !important;
    font-family: var(--bes-lms-fix-font-display) !important;
    font-weight: 700 !important;
    letter-spacing: -.018em !important;
    line-height: 1.08 !important;
    text-wrap: balance;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h2 {
    font-size: clamp(27px, 2.6vw, 39px) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h3 {
    font-size: clamp(22px, 2vw, 31px) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(ul, ol) {
    padding-left: 1.25em !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson li {
    margin: .28em 0 !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson a {
    color: var(--bes-lms-fix-olive-dark) !important;
    font-weight: 700 !important;
    text-decoration-color: rgba(194, 210, 74, .7) !important;
    text-decoration-thickness: 2px !important;
    text-underline-offset: 3px !important;
}

/* Sidebar: compact, tidy, no text collisions, current item clearly framed. */
body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum {
    width: var(--bes-lms-fix-sidebar-w) !important;
    max-width: min(100vw, 390px) !important;
    background: linear-gradient(180deg, var(--bes-lms-fix-forest-deep), var(--bes-lms-fix-forest) 46%, #182611) !important;
    border-right: 1px solid rgba(194, 210, 74, .14) !important;
    box-shadow: 12px 0 34px rgba(21, 30, 16, .18) !important;
    color: var(--bes-lms-fix-ivory) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__wrapper {
    scrollbar-width: thin !important;
    scrollbar-color: rgba(194, 210, 74, .52) rgba(255,255,255,.04) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__wrapper::-webkit-scrollbar {
    width: 6px !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__wrapper::-webkit-scrollbar-thumb {
    background: rgba(194, 210, 74, .46) !important;
    border-radius: 999px !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-header,
body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
    padding: 22px 22px 18px !important;
    border-bottom: 1px solid rgba(255,255,255,.07) !important;
    background: rgba(255,255,255,.025) !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title,
body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-title {
    margin: 0 !important;
    color: var(--bes-lms-fix-ivory) !important;
    font-family: var(--bes-lms-fix-font-display) !important;
    font-size: 22px !important;
    font-weight: 600 !important;
    letter-spacing: -.014em !important;
    line-height: 1.14 !important;
    text-wrap: balance;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress {
    margin-top: 16px !important;
}

body.bes-lms-surgical-course-player .masterstudy-progress__bars,
body.bes-lms-surgical-course-player .masterstudy-progress__bar-empty {
    height: 5px !important;
    border-radius: 999px !important;
    background: rgba(255,255,255,.13) !important;
    overflow: hidden !important;
}

body.bes-lms-surgical-course-player .masterstudy-progress__bar-filled {
    height: 100% !important;
    border-radius: inherit !important;
    background: linear-gradient(90deg, var(--bes-lms-fix-leaf), var(--bes-lms-fix-gold)) !important;
    box-shadow: 0 0 18px rgba(194, 210, 74, .24) !important;
}

body.bes-lms-surgical-course-player .masterstudy-progress__bottom,
body.bes-lms-surgical-course-player .masterstudy-progress__title,
body.bes-lms-surgical-course-player .masterstudy-progress__percent {
    margin-top: 9px !important;
    color: rgba(253, 252, 250, .68) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 13px !important;
    font-weight: 700 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion {
    padding: 10px 10px 20px !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__wrapper {
    overflow: hidden !important;
    margin: 10px 0 !important;
    border: 1px solid rgba(255,255,255,.075) !important;
    border-radius: 18px !important;
    background: rgba(255,255,255,.035) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.045) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__wrapper_opened {
    border-color: rgba(194, 210, 74, .20) !important;
    background: rgba(255,255,255,.047) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__section {
    display: flex !important;
    align-items: center !important;
    min-height: 54px !important;
    gap: 10px !important;
    padding: 15px 16px !important;
    border-bottom: 1px solid rgb(255 255 255 / 0%) !important;
    background: rgb(255 255 255 / 0%) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__section-title {
    min-width: 0 !important;
    flex: 1 1 auto !important;
    margin: 0 !important;
    overflow-wrap: anywhere !important;
    color: var(--bes-lms-fix-ivory) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 14px !important;
    font-weight: 800 !important;
    letter-spacing: .01em !important;
    line-height: 1.3 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__section-count {
    flex: 0 0 auto !important;
    color: rgba(253, 252, 250, .62) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__toggler {
    flex: 0 0 26px !important;
    width: 26px !important;
    height: 26px !important;
    border-radius: 999px !important;
    background: rgba(255,255,255,.08) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list {
    gap: 0 !important;
    padding: 6px !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__item {
    margin: 0 !important;
}


/* Remove sidebar ghost separators from the original accordion stylesheet. Spacing now comes from item cards instead of long hairline borders. */
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__item,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper {
    border-top: 0 !important;
    border-bottom: 0 !important;
    box-shadow: none !important;
    background-image: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__item::before,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__item::after,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list::before,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list::after,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link::after,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper::before,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper::after,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper::before,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper::after {
    content: none !important;
    display: none !important;
    border: 0 !important;
    background: none !important;
    box-shadow: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link {
    position: relative !important;
    display: block !important;
    margin: 4px 0 !important;
    padding: 13px 13px 12px 16px !important;
    border: 1px solid transparent !important;
    border-radius: 14px !important;
    background: transparent !important;
    color: rgba(253, 252, 250, .74) !important;
    text-decoration: none !important;
    box-shadow: none !important;
    transition: transform .2s var(--bes-lms-fix-ease), background .2s var(--bes-lms-fix-ease-standard), border-color .2s var(--bes-lms-fix-ease-standard), color .2s var(--bes-lms-fix-ease-standard) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link::before {
    content: '' !important;
    position: absolute !important;
    inset: 10px auto 10px 0 !important;
    width: 3px !important;
    border-radius: 999px !important;
    background: transparent !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link:not(.masterstudy-curriculum-accordion__link_disabled):hover {
    transform: translateY(-1px) !important;
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(194, 210, 74, .075) !important;
    color: var(--bes-lms-fix-ivory) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link_current {
    border-color: rgba(194, 210, 74, .38) !important;
    background: linear-gradient(135deg, rgba(194, 210, 74, .18), rgba(201, 168, 76, .08)) !important;
    color: var(--bes-lms-fix-ivory) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link_current::before {
    background: var(--bes-lms-fix-leaf) !important;
    box-shadow: 0 0 14px rgba(194, 210, 74, .36) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link_disabled {
    opacity: .5 !important;
    filter: saturate(.75) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper {
    display: flex !important;
    align-items: flex-start !important;
    gap: 10px !important;
    min-width: 0 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper {
    justify-content: space-between !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title {
    min-width: 0 !important;
    flex: 1 1 auto !important;
    overflow-wrap: anywhere !important;
    color: inherit !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 13px !important;
    font-weight: 800 !important;
    line-height: 1.38 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__check,
body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__locked {
    flex: 0 0 auto !important;
    margin-top: 1px !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper {
    align-items: center !important;
    margin-top: 9px !important;
    padding-left: 0 !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__image {
    flex: 0 0 16px !important;
    width: 16px !important;
    height: 16px !important;
    opacity: .8 !important;
    filter: saturate(.85) brightness(1.2) !important;
}

body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta {
    min-width: 0 !important;
    color: rgba(253, 252, 250, .50) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: .01em !important;
    line-height: 1.2 !important;
}

/* Navigation: sticky bottom bar with smooth backdrop. */
body.bes-lms-surgical-course-player .masterstudy-course-player-navigation {
    position: sticky !important;
    bottom: 0 !important;
    z-index: 90 !important;
    inset: auto auto 0 auto !important;
    margin: 22px 0 0 !important;
    padding: 0 !important;
    border: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr) !important;
    align-items: center !important;
    gap: 14px !important;
    width: 100% !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev {
    justify-self: start !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next {
    justify-self: end !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
    justify-self: center !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    min-height: 34px !important;
    padding: 0 14px !important;
    border: 1px solid rgba(63, 81, 48, .10) !important;
    border-radius: 999px !important;
    background: rgba(253, 252, 250, .72) !important;
    color: var(--bes-lms-fix-olive-dark) !important;
    box-shadow: 0 8px 18px rgba(21, 30, 16, .05) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 13px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status::before {
    content: '' !important;
    width: 8px !important;
    height: 8px !important;
    border-radius: 999px !important;
    background: var(--bes-lms-fix-leaf) !important;
    box-shadow: 0 0 0 4px rgba(194, 210, 74, .15) !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button) {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 42px !important;
    min-width: 116px !important;
    padding: 0 20px !important;
    border: 1px solid rgba(63, 81, 48, .22) !important;
    border-radius: 999px !important;
    background: linear-gradient(135deg, var(--bes-lms-fix-forest), var(--bes-lms-fix-olive-dark)) !important;
    color: var(--bes-lms-fix-ivory) !important;
    box-shadow: 0 12px 26px rgba(63, 81, 48, .18) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    letter-spacing: .09em !important;
    line-height: 1 !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    transition: transform .22s var(--bes-lms-fix-ease), background .22s var(--bes-lms-fix-ease-standard), border-color .22s var(--bes-lms-fix-ease-standard), box-shadow .22s var(--bes-lms-fix-ease-standard) !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button):hover {
    transform: translateY(-2px) !important;
    border-color: rgba(194, 210, 74, .54) !important;
    background: linear-gradient(135deg, var(--bes-lms-fix-olive), var(--bes-lms-fix-forest)) !important;
    box-shadow: 0 16px 34px rgba(63, 81, 48, .24), 0 0 0 4px rgba(194, 210, 74, .10) !important;
}

body.bes-lms-surgical-course-player .masterstudy-nav-button__title {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

body.bes-lms-surgical-course-player .masterstudy-course-player-lesson__submit-trigger {
    display: none !important;
}

/* Discussions panel receives the same tidy language, but only when opened. */
body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
body.bes-lms-surgical-course-player .masterstudy-discussions {
    border-color: rgba(235, 230, 220, .92) !important;
    border-radius: var(--bes-lms-fix-radius-lg) !important;
    background: rgba(253, 252, 250, .96) !important;
    box-shadow: var(--bes-lms-fix-shadow-soft) !important;
    color: var(--bes-lms-fix-bark-soft) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
}

body.bes-lms-surgical-course-player :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea) {
    border: 1px solid rgba(63, 81, 48, .16) !important;
    border-radius: 14px !important;
    background: var(--bes-lms-fix-ivory) !important;
    color: var(--bes-lms-fix-bark) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
}

/* Responsive: keep MasterStudy behavior, only tighten sizes. */
@media (max-width: 1180px) {
    body.bes-lms-surgical-course-player {
        --bes-lms-fix-sidebar-w: min(340px, 88vw);
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper {
        width: min(100% - 34px, 860px) !important;
    }
}

@media (max-width: 1024px) {
    body.bes-lms-surgical-course-player .masterstudy-course-player-header {
        padding-inline: 16px !important;
        gap: 10px !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-header__course-label {
        display: none !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper {
        width: min(100% - 28px, 760px) !important;
        padding-top: 32px !important;
    }
}

@media (max-width: 782px) {
    body.admin-bar.bes-lms-surgical-course-player .masterstudy-course-player-header {
        top: 46px !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-header {
        min-height: 68px !important;
        height: 68px !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-header__course {
        display: none !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-content__header h1 {
        font-size: clamp(32px, 9vw, 42px) !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
        padding: 24px 22px !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        grid-template-columns: 1fr !important;
    }

    body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev,
    body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next,
    body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
        justify-self: stretch !important;
    }

    body.bes-lms-surgical-course-player :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button),
    body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
        width: 100% !important;
    }
}

@media (prefers-reduced-motion: reduce), (update: slow) {
    body.bes-lms-surgical-course-player *,
    body.bes-lms-surgical-course-player *::before,
    body.bes-lms-surgical-course-player *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: .01ms !important;
    }
}

@supports not (color: color-mix(in srgb, white, black)) {
    body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
    body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
    body.bes-lms-surgical-course-player .masterstudy-discussions {
        background: rgba(253, 252, 250, .96) !important;
    }
}

/* --------------------------------------------------------------------------
   FINAL SURGICAL OVERLAY v1.3
   Fixes the title overlap, removes lingering dividers, normalizes progress,
   adds token-based animated apple bullets, and smooths dark mode.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-content > .masterstudy-course-player-content__wrapper {
    display: block !important;
    position: relative !important;
    isolation: isolate !important;
    background: transparent !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header {
    display: flow-root !important;
    position: relative !important;
    inset: auto !important;
    float: none !important;
    clear: both !important;
    width: 100% !important;
    height: auto !important;
    min-height: 0 !important;
    max-height: none !important;
    margin: 0 0 clamp(20px, 2.2vw, 30px) !important;
    padding: 0 !important;
    overflow: visible !important;
    transform: none !important;
    contain: layout paint !important;
    z-index: 3 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1.bes-lms-repaired-title {
    display: block !important;
    position: static !important;
    inset: auto !important;
    float: none !important;
    clear: both !important;
    width: min(100%, 960px) !important;
    max-width: 960px !important;
    height: auto !important;
    min-height: 0 !important;
    max-height: none !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: visible !important;
    transform: none !important;
    color: var(--bes-lms-fix-bark) !important;
    font-family: var(--bes-lms-fix-font-display) !important;
    font-size: clamp(36px, 3.25vw, 52px) !important;
    font-weight: 600 !important;
    letter-spacing: -.026em !important;
    line-height: 1.17 !important;
    padding-bottom: .12em !important;
    text-wrap: balance !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type {
    position: relative !important;
    float: none !important;
    clear: both !important;
    margin-bottom: 13px !important;
    z-index: 1 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
    position: relative !important;
    clear: both !important;
    z-index: 1 !important;
    margin-top: 0 !important;
    max-width: 100% !important;
}

/* Kill the last ghost dividers without flattening useful card shapes. */
html body.bes-lms-surgical-course-player :where(
    .masterstudy-course-player-header__back,
    .masterstudy-course-player-header__curriculum,
    .masterstudy-course-player-header__navigation,
    .masterstudy-course-player-header__dark-mode,
    .masterstudy-course-player-header__discussions,
    .masterstudy-course-player-curriculum__title-wrapper,
    .masterstudy-course-player-curriculum__progress,
    .masterstudy-progress__bottom,
    .masterstudy-curriculum-accordion__list,
    .masterstudy-curriculum-accordion__item,
    .masterstudy-curriculum-accordion__title-wrapper,
    .masterstudy-curriculum-accordion__meta-wrapper
) {
    border-top-color: transparent !important;
    border-bottom-color: transparent !important;
    border-left-color: transparent !important;
    border-right-color: transparent !important;
    outline: 0 !important;
    box-shadow: none !important;
    background-image: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
    border-bottom: 0 !important;
    padding-bottom: 10px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress {
    margin-top: 18px !important;
    padding: 13px 14px 14px !important;
    border: 1px solid rgba(194, 210, 74, .13) !important;
    border-radius: 16px !important;
    background: rgba(255, 255, 255, .045) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, .045) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__bottom {
    display: block !important;
    margin-top: 10px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__title,
html body.bes-lms-surgical-course-player .masterstudy-progress__title.bes-lms-progress-title-fixed {
    display: inline-flex !important;
    align-items: baseline !important;
    flex-wrap: nowrap !important;
    width: 100% !important;
    max-width: 100% !important;
    white-space: nowrap !important;
    gap: 4px !important;
    color: rgba(253, 252, 250, .74) !important;
    line-height: 1.2 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__percent,
html body.bes-lms-surgical-course-player .bes-lms-progress-symbol {
    display: inline !important;
    width: auto !important;
    min-width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    color: var(--bes-lms-fix-leaf) !important;
    font-weight: 900 !important;
    line-height: inherit !important;
    vertical-align: baseline !important;
}

html body.bes-lms-surgical-course-player .bes-lms-progress-symbol {
    margin-left: -3px !important;
}

/* Token-based minimalist apple SVG bullets for lesson content. */
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(ul, ol) {
    list-style: none !important;
    display: grid !important;
    gap: .48rem !important;
    margin: .9em 0 1.45em !important;
    padding-left: 0 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(ul, ol) > li {
    position: relative !important;
    min-height: 1.62rem !important;
    margin: 0 !important;
    padding-left: 2rem !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(ul, ol) > li::before {
    content: '' !important;
    position: absolute !important;
    left: .08rem !important;
    top: .43em !important;
    width: 1.06rem !important;
    height: 1.06rem !important;
    background: linear-gradient(135deg, var(--bes-lms-fix-leaf), var(--bes-lms-fix-gold)) !important;
    -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='black' d='M15.2 2.6c1.2-.8 2.7-.9 3.9-.6-.1 1.4-.8 2.8-2 3.6-1 .7-2.3.9-3.6.7.1-1.4.6-2.7 1.7-3.7Z'/%3E%3Cpath fill='black' d='M12 7.2c.9 0 1.5-.5 2.5-.5 2.5 0 4.3 2 4.3 4.9 0 4.2-2.9 8.8-5.5 8.8-.7 0-1.1-.3-1.7-.3-.6 0-1 .3-1.7.3-2.5 0-5.1-4.1-5.1-8.2 0-3.3 2.1-5.5 4.6-5.5 1 0 1.7.5 2.6.5Z'/%3E%3C/svg%3E") !important;
    mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='black' d='M15.2 2.6c1.2-.8 2.7-.9 3.9-.6-.1 1.4-.8 2.8-2 3.6-1 .7-2.3.9-3.6.7.1-1.4.6-2.7 1.7-3.7Z'/%3E%3Cpath fill='black' d='M12 7.2c.9 0 1.5-.5 2.5-.5 2.5 0 4.3 2 4.3 4.9 0 4.2-2.9 8.8-5.5 8.8-.7 0-1.1-.3-1.7-.3-.6 0-1 .3-1.7.3-2.5 0-5.1-4.1-5.1-8.2 0-3.3 2.1-5.5 4.6-5.5 1 0 1.7.5 2.6.5Z'/%3E%3C/svg%3E") !important;
    -webkit-mask-repeat: no-repeat !important;
    mask-repeat: no-repeat !important;
    -webkit-mask-position: center !important;
    mask-position: center !important;
    -webkit-mask-size: contain !important;
    mask-size: contain !important;
    transform-origin: 50% 70% !important;
    filter: drop-shadow(0 4px 8px rgba(63, 81, 48, .12)) !important;
    transition: transform .28s var(--bes-lms-fix-ease), filter .28s var(--bes-lms-fix-ease-standard), opacity .28s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-surgical-ready .masterstudy-course-player-lesson :where(ul, ol) > li::before {
    animation: besLmsAppleBulletIn .62s var(--bes-lms-fix-ease) both !important;
    animation-delay: calc(var(--bes-lms-bullet-index, 0) * 55ms) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(ul, ol) > li:hover::before {
    transform: translateY(-1px) rotate(-7deg) scale(1.09) !important;
    filter: drop-shadow(0 8px 14px rgba(194, 210, 74, .20)) !important;
}

@keyframes besLmsAppleBulletIn {
    from { opacity: 0; transform: translateY(5px) scale(.72) rotate(-12deg); }
    to { opacity: 1; transform: translateY(0) scale(1) rotate(0deg); }
}

/* Dark mode bridge: MasterStudy may toggle different classes, so JS adds .bes-lms-force-dark too. */
html body.bes-lms-surgical-course-player.bes-lms-force-dark,
html body.bes-lms-surgical-course-player.dark-mode,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode-enabled,
html[data-theme='dark'] body.bes-lms-surgical-course-player {
    background: linear-gradient(90deg, #11190d, var(--bes-lms-fix-forest-deep) 42%, #10180c) !important;
    color: rgba(253, 252, 250, .84) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode-enabled .masterstudy-course-player-content,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content {
    background:
        radial-gradient(circle at 100% 0%, rgba(194, 210, 74, .10), transparent 28rem),
        linear-gradient(90deg, #11190d, var(--bes-lms-fix-forest-deep) 44%, #10180c) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson :where(h2, h3, h4),
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-lesson :where(h2, h3, h4),
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-lesson :where(h2, h3, h4),
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h2, h3, h4) {
    color: var(--bes-lms-fix-ivory) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode-enabled .masterstudy-course-player-lesson,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
    border-color: rgba(194, 210, 74, .16) !important;
    background: rgba(21, 30, 16, .78) !important;
    color: rgba(253, 252, 250, .74) !important;
    box-shadow: 0 22px 58px rgba(0, 0, 0, .22) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content__header-lesson-type,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-content__header-lesson-type,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-content__header-lesson-type,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type {
    border-color: rgba(194, 210, 74, .20) !important;
    background: rgba(194, 210, 74, .12) !important;
    color: var(--bes-lms-fix-leaf-soft) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-navigation__status,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(255,255,255,.055) !important;
    color: var(--bes-lms-fix-leaf-soft) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-discussions,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-discussions,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-discussions,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-discussions {
    border-color: rgba(194, 210, 74, .16) !important;
    background: rgba(21, 30, 16, .88) !important;
    color: rgba(253, 252, 250, .76) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html body.bes-lms-surgical-course-player.dark-mode :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html body.bes-lms-surgical-course-player.masterstudy-dark-mode :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html[data-theme='dark'] body.bes-lms-surgical-course-player :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea) {
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(255, 255, 255, .06) !important;
    color: var(--bes-lms-fix-ivory) !important;
}


/* --------------------------------------------------------------------------
   Dark mode hard patch: do not rely only on MasterStudy's own class toggle.
   JS applies these bridge classes instantly, persists the preference, and keeps
   the native MasterStudy button visually pressed. Covers wrappers, lesson text,
   navigation, discussions, generated titles, and late-injected fragments.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player,
html body.bes-lms-surgical-course-player .masterstudy-course-player-header,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-discussions,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button {
    transition:
        background .34s var(--bes-lms-fix-ease-standard),
        background-color .34s var(--bes-lms-fix-ease-standard),
        border-color .34s var(--bes-lms-fix-ease-standard),
        box-shadow .34s var(--bes-lms-fix-ease-standard),
        color .28s var(--bes-lms-fix-ease-standard),
        filter .28s var(--bes-lms-fix-ease-standard),
        opacity .28s var(--bes-lms-fix-ease-standard),
        transform .22s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button {
    position: relative !important;
    width: 46px !important;
    min-width: 46px !important;
    padding: 0 !important;
    cursor: pointer !important;
    isolation: isolate !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::after {
    content: '' !important;
    display: block !important;
    position: absolute !important;
    border-radius: 999px !important;
    pointer-events: none !important;
    transition:
        transform .30s var(--bes-lms-fix-ease),
        background .30s var(--bes-lms-fix-ease-standard),
        box-shadow .30s var(--bes-lms-fix-ease-standard),
        opacity .25s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::before {
    inset: 7px !important;
    background: rgba(255, 255, 255, .12) !important;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,.08) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::after {
    top: 50% !important;
    left: 11px !important;
    width: 18px !important;
    height: 18px !important;
    transform: translateY(-50%) !important;
    background: var(--bes-lms-fix-leaf) !important;
    box-shadow: 0 0 0 4px rgba(194, 210, 74, .14), 0 6px 13px rgba(0, 0, 0, .18) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark,
html body.bes-lms-surgical-course-player.bes-lms-is-dark,
html body.bes-lms-surgical-course-player.bes-lms-dark-on,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player,
html[data-theme='dark'] body.bes-lms-surgical-course-player {
    background: linear-gradient(90deg, #10180c, var(--bes-lms-fix-forest-deep) 42%, #0d150a) !important;
    color: rgba(253, 252, 250, .84) !important;
    color-scheme: dark !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-header,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-header,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-header,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-header,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-header {
    background: linear-gradient(135deg, rgba(12, 19, 9, .98), rgba(21, 30, 16, .97)) !important;
    border-bottom-color: rgba(194, 210, 74, .22) !important;
    box-shadow: 0 12px 34px rgba(0, 0, 0, .32) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button {
    border-color: rgba(194, 210, 74, .52) !important;
    background: rgba(194, 210, 74, .13) !important;
    color: var(--bes-lms-fix-leaf) !important;
    box-shadow: 0 0 0 4px rgba(194, 210, 74, .08) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button::before,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button::before,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active::before,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::before,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::before {
    background: rgba(194, 210, 74, .20) !important;
    box-shadow: inset 0 0 0 1px rgba(194, 210, 74, .28) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button::after,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button::after,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active::after,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::after,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button::after {
    transform: translate(12px, -50%) !important;
    background: var(--bes-lms-fix-gold-soft) !important;
    box-shadow: 0 0 0 4px rgba(232, 213, 160, .16), 0 8px 16px rgba(0, 0, 0, .28) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-content,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content {
    background:
        radial-gradient(circle at 100% 0%, rgba(194, 210, 74, .12), transparent 30rem),
        radial-gradient(circle at 0% 85%, rgba(201, 168, 76, .08), transparent 28rem),
        linear-gradient(90deg, #10180c, var(--bes-lms-fix-forest-deep) 44%, #0d150a) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
    border-color: rgba(194, 210, 74, .18) !important;
    background: linear-gradient(180deg, rgba(21, 30, 16, .88), rgba(18, 27, 13, .82)) !important;
    color: rgba(253, 252, 250, .78) !important;
    box-shadow: 0 24px 64px rgba(0, 0, 0, .30) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-force-dark h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson :where(h2, h3, h4, h5, h6, strong),
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-is-dark h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson :where(h2, h3, h4, h5, h6, strong),
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-dark-on h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson :where(h2, h3, h4, h5, h6, strong),
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h2, h3, h4, h5, h6, strong),
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player h1.bes-lms-repaired-title,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h2, h3, h4, h5, h6, strong) {
    color: var(--bes-lms-fix-ivory) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson :where(p, li, blockquote, span),
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson :where(p, li, blockquote, span),
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson :where(p, li, blockquote, span),
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p, li, blockquote, span),
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p, li, blockquote, span) {
    color: rgba(253, 252, 250, .76) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson a,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson a,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson a,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson a,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson a {
    color: var(--bes-lms-fix-leaf-soft) !important;
    text-decoration-color: rgba(194, 210, 74, .72) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content__header-lesson-type,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-content__header-lesson-type,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-content__header-lesson-type,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type {
    border-color: rgba(194, 210, 74, .25) !important;
    background: rgba(194, 210, 74, .13) !important;
    color: var(--bes-lms-fix-leaf-soft) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-navigation__status,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(255, 255, 255, .06) !important;
    color: var(--bes-lms-fix-leaf-soft) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-discussions,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-discussions,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-discussions__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-discussions,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-discussions,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-discussions__wrapper,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-discussions {
    border-color: rgba(194, 210, 74, .17) !important;
    background: rgba(21, 30, 16, .90) !important;
    color: rgba(253, 252, 250, .76) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html body.bes-lms-surgical-course-player.bes-lms-is-dark :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html body.bes-lms-surgical-course-player.bes-lms-dark-on :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea),
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player :where(.masterstudy-discussions__input, .masterstudy-discussions__textarea) {
    border-color: rgba(194, 210, 74, .20) !important;
    background: rgba(255, 255, 255, .06) !important;
    color: var(--bes-lms-fix-ivory) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-curriculum-accordion__image,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-curriculum-accordion__image,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-curriculum-accordion__image,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__image,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__image {
    filter: saturate(.95) brightness(1.28) !important;
}



/* --------------------------------------------------------------------------
   FINAL RENDER STABILIZER v1.3.2
   Covers native MasterStudy active-button dark state, fixes invisible dark H1,
   tightens the sidebar title block, moves the current lesson stripe inward,
   and centers the dark toggle without relying on MasterStudy's CSS cascade.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-header__dark-mode {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 78px !important;
    min-width: 78px !important;
    padding: 0 !important;
    margin: 0 !important;
    overflow: visible !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 68px !important;
    min-width: 68px !important;
    max-width: 68px !important;
    height: 42px !important;
    min-height: 42px !important;
    max-height: 42px !important;
    padding: 0 !important;
    margin: 0 !important;
    border: 0 !important;
    border-radius: 999px !important;
    overflow: visible !important;
    line-height: 1 !important;
    cursor: pointer !important;
    isolation: isolate !important;
    background: transparent !important;
    background-image: none !important;
    box-shadow: none !important;
    -webkit-tap-highlight-color: transparent !important;
    touch-action: manipulation !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.masterstudy-dark-mode-button_active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.masterstudy-dark-mode-button_active::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.bes-lms-dark-button-active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.bes-lms-dark-button-active::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.is-active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.is-active::after,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.active::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-ready.active::after {
    content: none !important;
    display: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button > :not(.bes-lms-dark-switch),
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button > :not(.bes-lms-dark-switch) *,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button:not(.bes-lms-dark-toggle-ready) span,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button:not(.bes-lms-dark-toggle-ready) i,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button:not(.bes-lms-dark-toggle-ready) svg {
    display: none !important;
    opacity: 0 !important;
    visibility: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch * {
    visibility: visible !important;
    opacity: 1 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch {
    position: relative !important;
    display: block !important;
    width: 64px !important;
    height: 36px !important;
    border-radius: 999px !important;
    overflow: visible !important;
    transform: translateZ(0) scale(1) !important;
    transition: transform .22s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button:active .bes-lms-dark-switch,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-pulse .bes-lms-dark-switch {
    transform: translateZ(0) scale(.965) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__track {
    position: absolute !important;
    inset: 0 !important;
    display: block !important;
    width: 64px !important;
    height: 36px !important;
    border-radius: 999px !important;
    overflow: hidden !important;
    background:
        radial-gradient(circle at 25% 28%, rgba(255,255,255,.80), transparent 0 3px, transparent 4px),
        linear-gradient(135deg, rgba(255,255,255,.20), rgba(194,210,74,.13)),
        rgba(255,255,255,.07) !important;
    border: 1px solid rgba(253,252,250,.18) !important;
    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.12),
        inset 0 -10px 18px rgba(21,30,16,.20),
        0 8px 18px rgba(0,0,0,.16) !important;
    transition: background .36s var(--bes-lms-fix-ease-standard), border-color .36s var(--bes-lms-fix-ease-standard), box-shadow .36s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__track::before {
    content: '' !important;
    position: absolute !important;
    inset: -14px -9px auto auto !important;
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    background: radial-gradient(circle, rgba(194,210,74,.30), rgba(194,210,74,0) 68%) !important;
    opacity: .70 !important;
    transform: translate3d(-26px, 22px, 0) !important;
    transition: transform .42s var(--bes-lms-fix-ease), opacity .34s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__stars {
    position: absolute !important;
    inset: 8px 10px 8px auto !important;
    display: block !important;
    width: 20px !important;
    height: 18px !important;
    opacity: 0 !important;
    transform: translateY(4px) scale(.82) !important;
    transition: opacity .30s var(--bes-lms-fix-ease-standard), transform .40s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__stars::before,
html body.bes-lms-surgical-course-player .bes-lms-dark-switch__stars::after {
    content: '' !important;
    position: absolute !important;
    border-radius: 50% !important;
    background: rgba(253,252,250,.88) !important;
    box-shadow: 9px 6px 0 -1px rgba(253,252,250,.78), 3px 13px 0 -1.5px rgba(253,252,250,.72) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__stars::before {
    top: 1px !important;
    left: 2px !important;
    width: 3px !important;
    height: 3px !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__stars::after {
    top: 5px !important;
    left: 13px !important;
    width: 2px !important;
    height: 2px !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__sun,
html body.bes-lms-surgical-course-player .bes-lms-dark-switch__moon {
    position: absolute !important;
    top: 50% !important;
    z-index: 1 !important;
    display: inline-flex !important;
    width: 16px !important;
    height: 16px !important;
    align-items: center !important;
    justify-content: center !important;
    color: rgba(253,252,250,.74) !important;
    transform: translateY(-50%) scale(1) !important;
    transition: opacity .28s var(--bes-lms-fix-ease-standard), color .28s var(--bes-lms-fix-ease-standard), transform .32s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__sun {
    left: 10px !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__moon {
    right: 10px !important;
    opacity: .48 !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__sun svg,
html body.bes-lms-surgical-course-player .bes-lms-dark-switch__moon svg {
    display: block !important;
    width: 16px !important;
    height: 16px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 2 !important;
    stroke-linecap: round !important;
    stroke-linejoin: round !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__knob {
    position: absolute !important;
    top: 4px !important;
    left: 4px !important;
    z-index: 3 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 28px !important;
    height: 28px !important;
    border-radius: 999px !important;
    background: linear-gradient(180deg, #FFF8CE 0%, var(--bes-lms-fix-gold-soft) 100%) !important;
    color: #8D6A16 !important;
    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.82),
        0 2px 5px rgba(0,0,0,.18),
        0 8px 18px rgba(21,30,16,.20) !important;
    transform: translate3d(0, 0, 0) !important;
    transition: transform .44s cubic-bezier(.34,1.56,.64,1), background .34s var(--bes-lms-fix-ease-standard), color .34s var(--bes-lms-fix-ease-standard), box-shadow .34s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__knob svg {
    position: absolute !important;
    display: block !important;
    width: 16px !important;
    height: 16px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 2 !important;
    stroke-linecap: round !important;
    stroke-linejoin: round !important;
    transition: opacity .22s var(--bes-lms-fix-ease-standard), transform .32s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__knob-moon {
    opacity: 0 !important;
    transform: rotate(-45deg) scale(.78) !important;
}

html body.bes-lms-surgical-course-player .bes-lms-dark-switch__knob-sun {
    opacity: 1 !important;
    transform: rotate(0deg) scale(1) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button:hover .bes-lms-dark-switch__track {
    border-color: rgba(194, 210, 74, .40) !important;
    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.16),
        inset 0 -10px 18px rgba(21,30,16,.18),
        0 10px 22px rgba(0,0,0,.18),
        0 0 0 5px rgba(194,210,74,.08) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__track,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__track,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__track,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__track {
    background:
        radial-gradient(circle at 70% 24%, rgba(253,252,250,.28), transparent 0 2px, transparent 3px),
        linear-gradient(135deg, #111A0D 0%, #1E2A16 54%, #2F3F26 100%) !important;
    border-color: rgba(194,210,74,.34) !important;
    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.08),
        inset 0 -12px 20px rgba(0,0,0,.20),
        0 10px 24px rgba(0,0,0,.28),
        0 0 0 5px rgba(194,210,74,.09) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__track::before,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__track::before,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__track::before,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__track::before {
    opacity: 1 !important;
    transform: translate3d(4px, 14px, 0) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__stars,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__stars,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__stars,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__stars {
    opacity: 1 !important;
    transform: translateY(0) scale(1) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob {
    transform: translate3d(28px, 0, 0) !important;
    background: linear-gradient(180deg, #F6E7AF 0%, #C9A84C 100%) !important;
    color: #172010 !important;
    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.60),
        0 3px 8px rgba(0,0,0,.32),
        0 0 0 5px rgba(201,168,76,.12) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun {
    opacity: 0 !important;
    transform: rotate(45deg) scale(.72) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon {
    opacity: 1 !important;
    transform: rotate(0deg) scale(1) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__sun,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__sun {
    opacity: .36 !important;
    transform: translateY(-50%) scale(.82) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__moon,
html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__moon {
    opacity: .92 !important;
    color: rgba(253,252,250,.88) !important;
    transform: translateY(-50%) scale(1) !important;
}

@keyframes besLmsDarkTogglePulse {
    0% { transform: translateZ(0) scale(1); }
    45% { transform: translateZ(0) scale(.94); }
    100% { transform: translateZ(0) scale(1); }
}

html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-toggle-pulse .bes-lms-dark-switch {
    animation: besLmsDarkTogglePulse .32s var(--bes-lms-fix-ease) both !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
    padding: 18px 20px 14px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-title {
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: clamp(15px, 1.05vw, 18px) !important;
    font-weight: 800 !important;
    letter-spacing: -.012em !important;
    line-height: 1.28 !important;
    max-width: 26ch !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress {
    margin-top: 14px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion {
    padding-left: 14px !important;
    padding-right: 14px !important;
    padding-bottom: 150px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list {
    padding: 8px !important;
    overflow: visible !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link {
    margin: 5px 0 !important;
    padding: 13px 13px 12px 28px !important;
    overflow: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link::before {
    left: 10px !important;
    top: 12px !important;
    bottom: 12px !important;
    width: 4px !important;
    inset: 12px auto 12px 10px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper {
    margin-top: 8px !important;
    gap: 9px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__image {
    width: 15px !important;
    height: 15px !important;
    flex-basis: 15px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title {
    opacity: 1 !important;
    filter: none !important;
    mix-blend-mode: normal !important;
    text-shadow: none !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-force-dark h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-is-dark h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.bes-lms-dark-on h1.bes-lms-repaired-title,
html body.bes-lms-surgical-course-player.dark-mode .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.masterstudy-dark-mode-enabled .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.masterstudy-course-player_dark .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player.masterstudy-course-player_dark-mode .masterstudy-course-player-content__header > h1,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-dark-mode-button.masterstudy-dark-mode-button_active) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-dark-mode-button.bes-lms-dark-button-active) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-dark-mode-button.is-active) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-course-player-content.bes-lms-force-dark) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark-mode) body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1 {
    color: #FDFCFA !important;
    opacity: 1 !important;
    visibility: visible !important;
    filter: none !important;
    mix-blend-mode: normal !important;
    -webkit-text-fill-color: #FDFCFA !important;
    text-shadow: 0 3px 26px rgba(0, 0, 0, .30) !important;
}

html:has(.masterstudy-dark-mode-button.masterstudy-dark-mode-button_active) body.bes-lms-surgical-course-player,
html:has(.masterstudy-dark-mode-button.bes-lms-dark-button-active) body.bes-lms-surgical-course-player,
html:has(.masterstudy-dark-mode-button.is-active) body.bes-lms-surgical-course-player,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark) body.bes-lms-surgical-course-player,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark-mode) body.bes-lms-surgical-course-player {
    background: linear-gradient(90deg, #10180c, var(--bes-lms-fix-forest-deep) 42%, #0d150a) !important;
    color-scheme: dark !important;
}

html:has(.masterstudy-dark-mode-button.masterstudy-dark-mode-button_active) body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html:has(.masterstudy-dark-mode-button.bes-lms-dark-button-active) body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html:has(.masterstudy-dark-mode-button.is-active) body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark) body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark-mode) body.bes-lms-surgical-course-player .masterstudy-course-player-content {
    background:
        radial-gradient(circle at 100% 0%, rgba(194, 210, 74, .12), transparent 30rem),
        radial-gradient(circle at 0% 85%, rgba(201, 168, 76, .08), transparent 28rem),
        linear-gradient(90deg, #10180c, var(--bes-lms-fix-forest-deep) 44%, #0d150a) !important;
}

html:has(.masterstudy-dark-mode-button.masterstudy-dark-mode-button_active) body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html:has(.masterstudy-dark-mode-button.bes-lms-dark-button-active) body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html:has(.masterstudy-dark-mode-button.is-active) body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark) body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
html:has(.masterstudy-course-player-content.masterstudy-course-player-content_dark-mode) body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
    border-color: rgba(194, 210, 74, .18) !important;
    background: linear-gradient(180deg, rgba(21, 30, 16, .88), rgba(18, 27, 13, .82)) !important;
    color: rgba(253, 252, 250, .78) !important;
    box-shadow: 0 24px 64px rgba(0, 0, 0, .30) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-title {
        font-size: 17px !important;
        line-height: 1.25 !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
        padding-top: 16px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title {
        font-size: 12.5px !important;
        line-height: 1.36 !important;
    }
}


/* --------------------------------------------------------------------------
   FINAL RENDER STABILIZER v1.3.4
   Adds breathing room above the sidebar course title and replaces the native
   dark-mode dot with a custom SVG slider that cannot be clipped by theme CSS.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__content > .masterstudy-course-player-curriculum__title-wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
    padding-top: clamp(30px, 4.2vh, 44px) !important;
    padding-bottom: 18px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-header + .masterstudy-course-player-curriculum__content > .masterstudy-course-player-curriculum__title-wrapper {
    margin-top: 0 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-title {
    text-shadow: 0 1px 0 rgba(0,0,0,.08) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-header__dark-mode {
        width: 70px !important;
        min-width: 70px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active {
        width: 62px !important;
        min-width: 62px !important;
        max-width: 62px !important;
        height: 40px !important;
        min-height: 40px !important;
        max-height: 40px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch,
    html body.bes-lms-surgical-course-player .bes-lms-dark-switch__track {
        width: 58px !important;
        height: 34px !important;
    }

    html body.bes-lms-surgical-course-player .bes-lms-dark-switch__knob {
        width: 26px !important;
        height: 26px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.bes-lms-dark-button-active .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.masterstudy-dark-mode-button_active .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.is-active .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button.active .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[aria-pressed='true'] .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
    html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
    html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,
    html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob {
        transform: translate3d(24px, 0, 0) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__content > .masterstudy-course-player-curriculum__title-wrapper,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
        padding-top: 34px !important;
    }
}



/* --------------------------------------------------------------------------
   v1.3.4 — Typography no-crop hardening
   --------------------------------------------------------------------------
   Cormorant Garamond descenders can visually extend below the line box on some
   browser/font combinations. Keep the luxury heading shape, but provide real
   paint room so letters such as g, y, j, and Q never get clipped.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-content,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title {
    overflow-y: visible !important;
    clip: auto !important;
    clip-path: none !important;
    mask-image: none !important;
    -webkit-mask-image: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header {
    contain: none !important;
    padding-bottom: clamp(8px, .75vw, 14px) !important;
    margin-bottom: clamp(18px, 2.1vw, 28px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title {
    line-height: 1.17 !important;
    padding-bottom: .13em !important;
    margin-bottom: -.05em !important;
    overflow: visible !important;
    text-decoration-skip-ink: auto !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type {
    flex-shrink: 0 !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
    html body.bes-lms-surgical-course-player h1.bes-lms-repaired-title {
        line-height: 1.19 !important;
        padding-bottom: .15em !important;
    }
}


/* --------------------------------------------------------------------------
   v1.3.5 — Lesson content heading stabilizer
   --------------------------------------------------------------------------
   MasterStudy/theme CSS was constraining lesson headings to ~26ch, causing
   large section titles inside the lesson body to wrap too early and sometimes
   look boxed/cropped. This keeps the luxury serif style while letting every
   content heading use the full lesson sheet width with real descender room.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6).bes-lms-lesson-heading-fixed {
    display: block !important;
    position: relative !important;
    float: none !important;
    clear: both !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    height: auto !important;
    min-height: 0 !important;
    max-height: none !important;
    overflow: visible !important;
    contain: none !important;
    clip: auto !important;
    clip-path: none !important;
    mask-image: none !important;
    -webkit-mask-image: none !important;
    white-space: normal !important;
    word-break: normal !important;
    overflow-wrap: normal !important;
    hyphens: manual !important;
    text-wrap: balance !important;
    color: var(--bes-lms-fix-bark) !important;
    font-family: var(--bes-lms-fix-font-display) !important;
    font-weight: 700 !important;
    letter-spacing: -.022em !important;
    line-height: 1.16 !important;
    padding-top: .04em !important;
    padding-bottom: .18em !important;
    margin-inline: 0 !important;
    text-shadow: none !important;
    -webkit-text-fill-color: currentColor !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h2,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h2.bes-lms-lesson-heading-fixed {
    font-size: clamp(29px, 2.7vw, 42px) !important;
    line-height: 1.15 !important;
    margin: clamp(28px, 3.2vw, 42px) 0 clamp(10px, 1.1vw, 16px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h3,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h3.bes-lms-lesson-heading-fixed {
    font-size: clamp(24px, 2.05vw, 34px) !important;
    line-height: 1.17 !important;
    margin: clamp(24px, 2.5vw, 34px) 0 clamp(8px, .9vw, 13px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h4, h5, h6),
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h4, h5, h6).bes-lms-lesson-heading-fixed {
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: clamp(16px, 1.1vw, 20px) !important;
    font-weight: 800 !important;
    letter-spacing: .02em !important;
    line-height: 1.35 !important;
    margin: clamp(18px, 2vw, 26px) 0 8px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h2::after,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h3::after {
    content: '' !important;
    display: block !important;
    width: clamp(52px, 8vw, 96px) !important;
    height: 2px !important;
    margin-top: .42em !important;
    border-radius: 999px !important;
    background: linear-gradient(90deg, var(--bes-lms-fix-leaf), var(--bes-lms-fix-gold), transparent) !important;
    opacity: .70 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6) + :where(p, ul, ol, blockquote) {
    margin-top: 0 !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6),
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6) {
    color: var(--bes-lms-fix-ivory) !important;
    -webkit-text-fill-color: var(--bes-lms-fix-ivory) !important;
    text-shadow: 0 2px 22px rgba(0, 0, 0, .28) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1, h2, h3, h4, h5, h6) {
        text-wrap: pretty !important;
        overflow-wrap: anywhere !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson h2 {
        font-size: clamp(28px, 7vw, 38px) !important;
        line-height: 1.18 !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    html body.bes-lms-surgical-course-player,
    html body.bes-lms-surgical-course-player *,
    html body.bes-lms-surgical-course-player *::before,
    html body.bes-lms-surgical-course-player *::after {
        transition-duration: .01ms !important;
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
    }
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1.bes-lms-repaired-title {
        font-size: clamp(31px, 8vw, 42px) !important;
    }
}


/* --------------------------------------------------------------------------
   v1.3.6 — Video lesson polish + curriculum toggle rescue
   --------------------------------------------------------------------------
   The previous sidebar width override was stronger than MasterStudy's own
   collapsed state. These rules give the toggle a dedicated BES state, respect
   likely native collapsed classes, and make video/progress lessons render as a
   premium full-width learning panel without fighting the plugin.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum {
    flex: 0 0 var(--bes-lms-fix-sidebar-w) !important;
    min-width: var(--bes-lms-fix-sidebar-w) !important;
    transform: translate3d(0, 0, 0) !important;
    opacity: 1 !important;
    visibility: visible !important;
    transition:
        flex-basis .34s var(--bes-lms-fix-ease),
        min-width .34s var(--bes-lms-fix-ease),
        width .34s var(--bes-lms-fix-ease),
        max-width .34s var(--bes-lms-fix-ease),
        opacity .24s var(--bes-lms-fix-ease-standard),
        transform .34s var(--bes-lms-fix-ease),
        border-color .24s var(--bes-lms-fix-ease-standard),
        box-shadow .24s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-switch-button[data-id='masterstudy-curriculum-switcher'],
html body.bes-lms-surgical-course-player [data-id='masterstudy-curriculum-switcher'] {
    cursor: pointer !important;
    user-select: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

html body.bes-lms-surgical-course-player .masterstudy-switch-button[data-id='masterstudy-curriculum-switcher'].bes-lms-switch-pulse {
    animation: besLmsCurriculumSwitchPulse .28s var(--bes-lms-fix-ease) both !important;
}

@keyframes besLmsCurriculumSwitchPulse {
    0% { transform: translateZ(0) scale(1); }
    46% { transform: translateZ(0) scale(.96); }
    100% { transform: translateZ(0) scale(1); }
}

html body.bes-lms-surgical-course-player.bes-lms-curriculum-collapsed .masterstudy-course-player-curriculum,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content.bes-lms-curriculum-collapsed > .masterstudy-course-player-curriculum,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content.masterstudy-course-player-content_curriculum-hidden > .masterstudy-course-player-curriculum,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content.masterstudy-course-player-content_curriculum-closed > .masterstudy-course-player-curriculum,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content.masterstudy-course-player-content_curriculum-collapsed > .masterstudy-course-player-curriculum,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum.bes-lms-curriculum-is-collapsed,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum.masterstudy-course-player-curriculum_hidden,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum.masterstudy-course-player-curriculum_closed,
html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum.masterstudy-course-player-curriculum_collapsed {
    flex: 0 0 0 !important;
    width: 0 !important;
    min-width: 0 !important;
    max-width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    border-right-width: 0 !important;
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
    overflow: hidden !important;
    transform: translate3d(-22px, 0, 0) !important;
    box-shadow: none !important;
}

html body.bes-lms-surgical-course-player.bes-lms-curriculum-collapsed .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content.bes-lms-curriculum-collapsed > .masterstudy-course-player-content__wrapper {
    width: min(100% - 56px, 960px) !important;
    max-width: 960px !important;
    margin-left: auto !important;
    margin-right: auto !important;
}

html body.bes-lms-surgical-course-player .masterstudy-switch-button[data-id='masterstudy-curriculum-switcher'].bes-lms-switch-collapsed {
    background: rgba(255, 255, 255, .08) !important;
    border-color: rgba(194, 210, 74, .34) !important;
    color: var(--bes-lms-fix-leaf-soft) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-switch-button[data-id='masterstudy-curriculum-switcher'].bes-lms-switch-collapsed .masterstudy-switch-button__burger span {
    opacity: .95 !important;
}

html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
    width: min(100% - 48px, 960px) !important;
    max-width: 960px !important;
}

html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__header > h1,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper .masterstudy-course-player-content__header > h1 {
    max-width: 960px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video {
    width: 100% !important;
    max-width: 100% !important;
    margin: clamp(4px, .8vw, 10px) 0 clamp(24px, 2.6vw, 38px) !important;
    padding: 0 !important;
    overflow: visible !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__container {
    position: relative !important;
    width: 100% !important;
    overflow: visible !important;
}

html body.bes-lms-surgical-course-player .masterstudy-plyr-video-player,
html body.bes-lms-surgical-course-player .plyr__video-embed,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__container > iframe,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__container > video {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    aspect-ratio: 16 / 9 !important;
    min-height: clamp(220px, 42vw, 560px) !important;
    overflow: hidden !important;
    border: 1px solid rgba(63, 81, 48, .18) !important;
    border-radius: clamp(18px, 1.9vw, 26px) !important;
    background: #0d150a !important;
    box-shadow: 0 24px 62px rgba(21, 30, 16, .16), inset 0 1px 0 rgba(255,255,255,.06) !important;
    isolation: isolate !important;
}

html body.bes-lms-surgical-course-player .masterstudy-plyr-video-player::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    z-index: 1 !important;
    pointer-events: none !important;
    border-radius: inherit !important;
    box-shadow: inset 0 0 0 1px rgba(253,252,250,.04), inset 0 -48px 90px rgba(0,0,0,.22) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-plyr-video-player iframe,
html body.bes-lms-surgical-course-player .masterstudy-plyr-video-player video,
html body.bes-lms-surgical-course-player .plyr__video-embed iframe,
html body.bes-lms-surgical-course-player .plyr__video-embed video {
    position: absolute !important;
    inset: 0 !important;
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 0 !important;
    border: 0 !important;
    border-radius: inherit !important;
    background: #0d150a !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress {
    margin-top: 18px !important;
    padding: 16px 18px 17px !important;
    border: 1px solid rgba(63, 81, 48, .13) !important;
    border-radius: 18px !important;
    background: linear-gradient(180deg, rgba(253,252,250,.92), rgba(247,244,238,.84)) !important;
    box-shadow: 0 14px 34px rgba(21, 30, 16, .08), inset 0 1px 0 rgba(255,255,255,.64) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-title {
    display: flex !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 7px 9px !important;
    margin: 0 0 12px !important;
    color: var(--bes-lms-fix-bark-soft) !important;
    font-family: var(--bes-lms-fix-font-body) !important;
    font-size: 13px !important;
    font-weight: 800 !important;
    line-height: 1.35 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-user,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-required {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 44px !important;
    min-height: 24px !important;
    padding: 3px 9px !important;
    border-radius: 999px !important;
    background: rgba(194, 210, 74, .18) !important;
    color: var(--bes-lms-fix-olive-dark) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-required {
    background: rgba(201, 168, 76, .16) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-separator {
    color: var(--bes-lms-fix-bark-muted) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-bar {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    height: 10px !important;
    overflow: hidden !important;
    border-radius: 999px !important;
    background: rgba(63, 81, 48, .12) !important;
    box-shadow: inset 0 1px 2px rgba(21, 30, 16, .10) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-bar::after {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    border-radius: inherit !important;
    box-shadow: inset 0 0 0 1px rgba(63, 81, 48, .08) !important;
    pointer-events: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-bar-value {
    display: block !important;
    height: 100% !important;
    min-width: 0 !important;
    border-radius: inherit !important;
    background: linear-gradient(90deg, var(--bes-lms-fix-leaf), var(--bes-lms-fix-gold)) !important;
    box-shadow: 0 0 16px rgba(194, 210, 74, .28) !important;
    transition: width .42s var(--bes-lms-fix-ease) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-plyr-video-player,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-plyr-video-player,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-plyr-video-player,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-plyr-video-player,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-plyr-video-player {
    border-color: rgba(194, 210, 74, .18) !important;
    box-shadow: 0 28px 72px rgba(0, 0, 0, .32), inset 0 1px 0 rgba(255,255,255,.05) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson-video__progress,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson-video__progress,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson-video__progress,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress {
    border-color: rgba(194, 210, 74, .16) !important;
    background: linear-gradient(180deg, rgba(21, 30, 16, .86), rgba(18, 27, 13, .78)) !important;
    box-shadow: 0 18px 42px rgba(0, 0, 0, .22), inset 0 1px 0 rgba(255,255,255,.05) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson-video__progress-title,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson-video__progress-title,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson-video__progress-title,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-title,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-title {
    color: rgba(253, 252, 250, .78) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-lesson-video__progress-bar,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-lesson-video__progress-bar,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-lesson-video__progress-bar,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-bar,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress-bar {
    background: rgba(255, 255, 255, .09) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player.bes-lms-curriculum-collapsed .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
        width: min(100% - 28px, 100%) !important;
        max-width: 100% !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-plyr-video-player,
    html body.bes-lms-surgical-course-player .plyr__video-embed {
        min-height: auto !important;
        aspect-ratio: 16 / 9 !important;
        border-radius: 18px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson-video__progress {
        padding: 14px !important;
        border-radius: 16px !important;
    }
}


/* --------------------------------------------------------------------------
   v1.3.7 — Bottom navigation position stabilizer
   --------------------------------------------------------------------------
   MasterStudy omits the middle status node on video lessons until completion.
   With CSS grid auto-placement, the Next/Complete button was falling into the
   middle column instead of the right edge. Explicit grid columns keep Previous,
   optional Status, and Next stable on text, video, and late-rendered lessons.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson > .masterstudy-course-player-navigation {
    display: block !important;
    position: sticky !important;
    bottom: 0 !important;
    z-index: 90 !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    clear: both !important;
    float: none !important;
    align-self: stretch !important;
    justify-self: stretch !important;
    margin: clamp(26px, 3.2vw, 42px) 0 0 !important;
    padding: clamp(18px, 2vw, 26px) clamp(16px, 2vw, 24px) clamp(18px, 2vw, 26px) !important;
    border-top: 1px solid rgba(63, 81, 48, .10) !important;
    background: linear-gradient(180deg, rgba(253, 252, 250, 0) 0%, rgba(253, 252, 250, .92) 18%, rgba(253, 252, 250, .98) 100%) !important;
    backdrop-filter: blur(8px) saturate(1.05) !important;
    -webkit-backdrop-filter: blur(8px) saturate(1.05) !important;
    transition: background .34s var(--bes-lms-fix-ease-standard), border-color .34s var(--bes-lms-fix-ease-standard) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
    display: grid !important;
    grid-template-columns: minmax(126px, max-content) minmax(0, 1fr) minmax(126px, max-content) !important;
    grid-template-areas: 'prev status next' !important;
    align-items: center !important;
    justify-items: stretch !important;
    gap: clamp(12px, 2vw, 24px) !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev {
    grid-area: prev !important;
    grid-column: 1 !important;
    justify-self: start !important;
    align-self: center !important;
    min-width: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
    grid-area: status !important;
    grid-column: 2 !important;
    justify-self: center !important;
    align-self: center !important;
    max-width: 100% !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next {
    grid-area: next !important;
    grid-column: 3 !important;
    justify-self: end !important;
    align-self: center !important;
    min-width: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 8px !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-hint,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev .masterstudy-hint {
    flex: 0 0 auto !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev .masterstudy-nav-button,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-nav-button {
    width: auto !important;
    max-width: 100% !important;
    white-space: nowrap !important;
    flex: 0 0 auto !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-nav-button_style-primary,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-nav-button_type-next {
    min-width: clamp(160px, 12vw, 208px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev .masterstudy-nav-button_style-secondary,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev .masterstudy-nav-button_type-prev {
    min-width: clamp(128px, 9vw, 156px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next:empty,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev:empty,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status:empty {
    display: none !important;
}

html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper .masterstudy-course-player-navigation {
    margin-top: clamp(30px, 3.8vw, 48px) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson > .masterstudy-course-player-navigation {
        padding: 16px 12px 16px !important;
        margin-top: 24px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        grid-template-columns: 1fr !important;
        grid-template-areas:
            'status'
            'next'
            'prev' !important;
        gap: 10px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next {
        grid-column: 1 !important;
        justify-self: stretch !important;
        width: 100% !important;
        max-width: 100% !important;
        justify-content: stretch !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev .masterstudy-nav-button,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-nav-button,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
        width: 100% !important;
        min-width: 0 !important;
    }
}

/* Sticky navigation dark mode background */
html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-navigation,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation {
    background: linear-gradient(180deg, rgba(21, 30, 16, 0) 0%, rgba(21, 30, 16, .92) 18%, rgba(21, 30, 16, .98) 100%) !important;
    border-top-color: rgba(194, 210, 74, .12) !important;
}

/* --------------------------------------------------------------------------
   v1.3.8 — Bottom navigation/footer separation
   --------------------------------------------------------------------------
   The footer is present on the LMS lesson shell, so the lesson navigation must
   stay in normal document flow. A sticky bottom bar looked correct on tall text
   lessons but floated over the footer and clipped the Complete & Next button on
   short video lessons. This final override keeps the same grid/button logic but
   removes sticky positioning and gives the navigation its own calm card.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
    padding-bottom: clamp(42px, 5.2vw, 78px) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson > .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper .masterstudy-course-player-navigation {
    display: block !important;
    position: relative !important;
    inset: auto !important;
    top: auto !important;
    right: auto !important;
    bottom: auto !important;
    left: auto !important;
    z-index: 3 !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    clear: both !important;
    float: none !important;
    margin: clamp(24px, 3vw, 38px) 0 0 !important;
    padding: 0 !important;
    border: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    overflow: visible !important;
    transform: none !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
    position: relative !important;
    overflow: visible !important;
    min-height: 76px !important;
    padding: clamp(14px, 1.45vw, 18px) clamp(14px, 1.8vw, 22px) !important;
    border: 1px solid rgba(63, 81, 48, .13) !important;
    border-radius: clamp(18px, 1.8vw, 24px) !important;
    background: rgba(253, 252, 250, .88) !important;
    box-shadow: 0 18px 42px rgba(21, 30, 16, .08), inset 0 1px 0 rgba(255, 255, 255, .64) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__prev,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next,
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__status {
    overflow: visible !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__next .masterstudy-hint {
    position: relative !important;
    z-index: 5 !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-navigation,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-navigation,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation {
    background: transparent !important;
    border-top-color: transparent !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark .masterstudy-course-player-navigation__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-is-dark .masterstudy-course-player-navigation__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-dark-on .masterstudy-course-player-navigation__wrapper,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper,
html[data-bes-lms-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper,
html[data-theme='dark'] body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(21, 30, 16, .70) !important;
    box-shadow: 0 18px 42px rgba(0, 0, 0, .22), inset 0 1px 0 rgba(255, 255, 255, .05) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
        padding-bottom: 42px !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        min-height: 0 !important;
        padding: 12px !important;
        border-radius: 18px !important;
    }
}

/* --------------------------------------------------------------------------
   v1.3.9 — Ghost-space eliminator + container-width standardization
   --------------------------------------------------------------------------
   ROOT CAUSE (identified from live HTML inspection):
   .masterstudy-course-player-discussions is rendered with position:fixed by
   discussions.css (loaded after this stylesheet). MasterStudy's own CSS hides
   it via transform:translateX(100%), pushing it 100% of its width off the
   right edge of the screen. The previous v1.3.9 attempt overrode that
   transform with translate3d(22px,0,0), which accidentally dragged the fixed
   panel ~318 px back into the visible viewport — creating the ghost strip.

   The correct fix is display:none which removes position:fixed elements from
   ALL rendering contexts (layout, paint, stacking context) regardless of what
   any later stylesheet does to transform, width, or flex properties. A single
   display:none !important with high specificity is sufficient and cannot be
   undone by discussions.css's lower-specificity rules.

   The open-state restore uses four known MasterStudy modifier-class patterns
   so the panel slides in correctly when the Discussions button is clicked.
   -------------------------------------------------------------------------- */

/* ── 1. Kill the right-side ghost column (nuclear display:none approach) ─── */

/*
 * CLOSED STATE — unconditionally remove the panel from all rendering.
 * display:none on a position:fixed element collapses it from the stacking
 * context entirely; no transform, width, or flex rule can bring it back.
 * Specificity: (0,2,2) — beats any plain class selector in discussions.css.
 */
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
}

/*
 * OPEN STATE — restore the panel when MasterStudy adds an open-state class.
 * Specificity: (0,3,2) — beats the closed-state rule above due to extra class.
 * Covers all known MasterStudy modifier class patterns.
 */
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions.masterstudy-course-player-discussions_opened,
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions.masterstudy-course-player-discussions_active,
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions.masterstudy-course-player-discussions_visible,
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions.masterstudy-course-player-discussions_shown,
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions[class*="_open"],
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions[class*="-open"],
html body.bes-lms-surgical-course-player .masterstudy-course-player-discussions[class*="open"] {
    display: block !important;
    visibility: visible !important;
    pointer-events: auto !important;
}

/* ── 2. Align navigation card width to the content wrapper ───────────────── */
/*
 * .masterstudy-course-player-navigation is a sibling of content__wrapper
 * (confirmed from live DOM). Its inner __wrapper card uses width:100% which
 * resolves to the full content column — wider than the centered 960 px content
 * above it. Applying the same min(100%-40px,960px) + margin-inline:auto
 * constraint mirrors the content__wrapper breakpoints exactly.
 */
html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
    width: min(100% - 40px, 960px) !important;
    max-width: 960px !important;
    margin-inline: auto !important;
}

@media (max-width: 1180px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        width: min(100% - 34px, 860px) !important;
        max-width: 860px !important;
    }
}

@media (max-width: 1024px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        width: min(100% - 28px, 760px) !important;
        max-width: 760px !important;
    }
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        width: calc(100% - 24px) !important;
        max-width: 100% !important;
    }
}


/* --------------------------------------------------------------------------
   v1.4.1 — 1200px responsive audit: sidebar progress + content gutters
   --------------------------------------------------------------------------
   Root cause of the 1200px crop:
   1. The curriculum progress card relied on inherited title-wrapper padding.
      Later MasterStudy and surgical rules could narrow the wrapper while the
      card still painted to the sidebar boundary.
   2. The right lesson wrapper used a fixed centered width model. At mid-size
      desktop widths, the wrapper could resolve flush against the sidebar rather
      than creating real padding inside the available content column.

   The fix below gives both columns their own intrinsic rhythm. The sidebar
   gets a protected inner pad and the content column gets a real flex item with
   responsive padding. This keeps the main layout stable when the curriculum is
   open, closed, or rendered by MasterStudy after our initial stylesheet.
   -------------------------------------------------------------------------- */
html body.bes-lms-surgical-course-player {
    --bes-lms-fix-content-gutter: clamp(26px, 3vw, 44px);
    --bes-lms-fix-content-max: 1120px;
    --bes-lms-fix-sidebar-pad: clamp(16px, 1.65vw, 22px);
    --bes-lms-fix-adminbar-h: 0 !important;
}

@media (min-width: 783px) {
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content {
        display: flex !important;
        align-items: stretch !important;
        width: 100% !important;
        min-width: 0 !important;
        overflow-x: hidden !important;
        overflow-y: visible !important;
        margin-bottom: -50px;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum {
        flex: 0 0 var(--bes-lms-fix-sidebar-w) !important;
        width: var(--bes-lms-fix-sidebar-w) !important;
        min-width: var(--bes-lms-fix-sidebar-w) !important;
        max-width: min(34vw, 390px) !important;
        overflow: hidden !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content > .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
        flex: 1 1 0 !important;
        width: auto !important;
        max-width: none !important;
        min-width: 0 !important;
        margin: 0 !important;
        padding: clamp(34px, 5.2vw, 72px) var(--bes-lms-fix-content-gutter) clamp(42px, 5.2vw, 78px) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation {
        width: min(100%, var(--bes-lms-fix-content-max)) !important;
        max-width: var(--bes-lms-fix-content-max) !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header {
        margin-bottom: clamp(20px, 2.2vw, 30px) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1.bes-lms-repaired-title {
        width: 100% !important;
        max-width: 100% !important;
        overflow-wrap: normal !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
        box-sizing: border-box !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper {
        width: 100% !important;
        max-width: 100% !important;
        margin-inline: 0 !important;
    }
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__content {
    box-sizing: border-box !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    overflow-x: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
    box-sizing: border-box !important;
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    padding: clamp(18px, 2vw, 22px) var(--bes-lms-fix-sidebar-pad) 18px !important;
    overflow: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress {
    box-sizing: border-box !important;
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    margin: clamp(14px, 1.45vw, 18px) 0 0 !important;
    overflow: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress,
html body.bes-lms-surgical-course-player .masterstudy-progress__bars,
html body.bes-lms-surgical-course-player .masterstudy-progress__bar-empty,
html body.bes-lms-surgical-course-player .masterstudy-progress__bottom,
html body.bes-lms-surgical-course-player .masterstudy-progress__title {
    box-sizing: border-box !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__bars,
html body.bes-lms-surgical-course-player .masterstudy-progress__bar-empty {
    display: block !important;
    overflow: hidden !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__bar-filled {
    max-width: 100% !important;
}

html body.bes-lms-surgical-course-player .masterstudy-progress__title,
html body.bes-lms-surgical-course-player .masterstudy-progress__title.bes-lms-progress-title-fixed {
    display: flex !important;
    align-items: baseline !important;
    flex-wrap: wrap !important;
    gap: 2px 4px !important;
    white-space: normal !important;
    overflow-wrap: normal !important;
}

@media (min-width: 783px) and (max-width: 1280px) {
    html body.bes-lms-surgical-course-player {
        --bes-lms-fix-content-gutter: clamp(28px, 3vw, 38px);
        --bes-lms-fix-content-max: 100%;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1.bes-lms-repaired-title {
        font-size: clamp(38px, 3.8vw, 50px) !important;
        line-height: 1.18 !important;
    }
}

@media (min-width: 783px) and (max-width: 1100px) {
    html body.bes-lms-surgical-course-player {
        --bes-lms-fix-content-gutter: clamp(22px, 2.8vw, 30px);
        --bes-lms-fix-sidebar-pad: 16px;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header > h1.bes-lms-repaired-title {
        font-size: clamp(34px, 4vw, 44px) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson {
        padding-inline: clamp(24px, 3vw, 36px) !important;
    }
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player {
        --bes-lms-fix-content-gutter: 16px;
        --bes-lms-fix-sidebar-pad: 18px;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-content > .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
    html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        //padding-inline: var(--bes-lms-fix-content-gutter) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper {
        padding-inline: var(--bes-lms-fix-sidebar-pad) !important;
    }

    html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress {
        margin-top: 14px !important;
    }
}

CSS;
    }
}

if (! function_exists('bes_lms_surgical_js')) {
    function bes_lms_surgical_js(): string {
        return <<<'JS'
(function () {
    'use strict';

    if (window.__besLmsSurgicalFix) {
        return;
    }

    window.__besLmsSurgicalFix = true;

    var BODY_CLASS = 'bes-lms-surgical-course-player';
    var READY_CLASS = 'bes-lms-surgical-ready';
    var PLAYER_SELECTOR = '.masterstudy-course-player-header, .masterstudy-course-player-content, .masterstudy-course-player-curriculum';
    var LOADER_SELECTOR = '.masterstudy-loader, .masterstudy-loader_global';
    var lessonPath = /^\/courses\/[^/]+\/\d+\/?$/.test(window.location.pathname);
    var pollTimer = null;
    var pollCount = 0;
    var CURRICULUM_RUNTIME_STYLE_ID = 'bes-lms-curriculum-runtime-rescue';

    function installCurriculumRuntimeStyle() {
        if (document.getElementById(CURRICULUM_RUNTIME_STYLE_ID)) {
            return;
        }

        var style = document.createElement('style');
        style.id = CURRICULUM_RUNTIME_STYLE_ID;
        style.textContent = [
            'html body.bes-lms-surgical-course-player{--bes-lms-fix-header-h:74px;--bes-lms-fix-adminbar-h:0px;--bes-lms-fix-mobile-sidebar-w:min(92vw,390px);--bes-lms-real-vh:1vh}',
            'html body.bes-lms-surgical-course-player{--bes-lms-fix-light-bg:linear-gradient(90deg,var(--bes-lms-fix-cream),var(--bes-lms-fix-ivory) 44%,var(--bes-lms-fix-parchment));--bes-lms-fix-light-card:linear-gradient(180deg,rgba(253,252,250,.96),rgba(247,244,238,.90));--bes-lms-fix-light-text:var(--bes-lms-fix-bark);--bes-lms-fix-light-body:rgba(54,72,82,.90)}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light,html.bes-lms-force-light-html body.bes-lms-surgical-course-player,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player,html[data-theme="light"] body.bes-lms-surgical-course-player{background:var(--bes-lms-fix-light-bg)!important;color:var(--bes-lms-fix-light-text)!important;color-scheme:light!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-content,html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-content,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content,html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content{background:radial-gradient(circle at 100% 0%,rgba(216,228,140,.14),transparent 30rem),var(--bes-lms-fix-light-bg)!important;color:var(--bes-lms-fix-light-body)!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-content__header>h1,html body.bes-lms-surgical-course-player.bes-lms-force-light h1.bes-lms-repaired-title,html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1,html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1{color:var(--bes-lms-fix-bark)!important;-webkit-text-fill-color:var(--bes-lms-fix-bark)!important;text-shadow:none!important;filter:none!important;mix-blend-mode:normal!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-lesson,html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson{background:var(--bes-lms-fix-light-card)!important;border-color:rgba(63,81,48,.14)!important;color:var(--bes-lms-fix-light-body)!important;box-shadow:0 22px 58px rgba(21,30,16,.10)!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-lesson :where(h1,h2,h3,h4,h5,h6,strong),html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1,h2,h3,h4,h5,h6,strong),html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1,h2,h3,h4,h5,h6,strong),html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(h1,h2,h3,h4,h5,h6,strong){color:var(--bes-lms-fix-bark)!important;-webkit-text-fill-color:var(--bes-lms-fix-bark)!important;text-shadow:none!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-lesson :where(p,li,blockquote,span),html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p,li,blockquote,span),html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p,li,blockquote,span),html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-lesson :where(p,li,blockquote,span){color:var(--bes-lms-fix-light-body)!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-course-player-content__header-lesson-type,html.bes-lms-force-light-html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type,html[data-theme="light"] body.bes-lms-surgical-course-player .masterstudy-course-player-content__header-lesson-type{background:rgba(194,210,74,.16)!important;border-color:rgba(63,81,48,.13)!important;color:var(--bes-lms-fix-olive-dark)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"],html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button{background:transparent!important;color:rgba(253,252,250,.84)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__track,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__track,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__track{background:radial-gradient(circle at 25% 28%,rgba(255,255,255,.80),transparent 0 3px,transparent 4px),linear-gradient(135deg,rgba(255,255,255,.20),rgba(194,210,74,.13)),rgba(255,255,255,.07)!important;border-color:rgba(253,252,250,.18)!important;box-shadow:inset 0 1px 1px rgba(255,255,255,.12),inset 0 -10px 18px rgba(21,30,16,.20),0 8px 18px rgba(0,0,0,.16)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__knob,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__knob,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob{transform:translate3d(0,0,0)!important;background:linear-gradient(180deg,#FFF8CE 0%,var(--bes-lms-fix-gold-soft) 100%)!important;color:#8D6A16!important;box-shadow:inset 0 1px 1px rgba(255,255,255,.82),0 2px 5px rgba(0,0,0,.18),0 8px 18px rgba(21,30,16,.20)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__knob-sun,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-sun{opacity:1!important;transform:rotate(0deg) scale(1)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__knob-moon,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__knob-moon{opacity:0!important;transform:rotate(-45deg) scale(.78)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__stars,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__stars,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__stars{opacity:0!important;transform:translateY(4px) scale(.82)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__sun,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__sun,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__sun{opacity:1!important;transform:translateY(-50%) scale(1)!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-dark-mode-button[data-bes-lms-theme="light"] .bes-lms-dark-switch__moon,html body.bes-lms-surgical-course-player.bes-lms-force-light .masterstudy-dark-mode-button .bes-lms-dark-switch__moon,html[data-bes-lms-theme="light"] body.bes-lms-surgical-course-player .masterstudy-dark-mode-button .bes-lms-dark-switch__moon{opacity:.48!important;transform:translateY(-50%) scale(1)!important}',
            'html body.admin-bar.bes-lms-surgical-course-player{--bes-lms-fix-adminbar-h:32px}',
            '@media(max-width:782px){html body.bes-lms-surgical-course-player{--bes-lms-fix-header-h:68px}html body.admin-bar.bes-lms-surgical-course-player{--bes-lms-fix-adminbar-h:46px}}',
            /* v1.4.2 mobile scroll rescue: this state marker used to set overflow:hidden on html/body.
             * On iOS Safari that can freeze the page when the curriculum drawer is opened.
             * Keep horizontal overflow guarded, but leave vertical scrolling available and let the
             * curriculum wrapper handle its own momentum scrolling. */
            'html.bes-lms-curriculum-scroll-lock,html.bes-lms-curriculum-scroll-lock body.bes-lms-surgical-course-player{height:auto!important;min-height:100%!important;overflow-x:hidden!important;overflow-y:auto!important;position:static!important;overscroll-behavior-y:auto!important;touch-action:pan-y!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-content{display:flex!important;align-items:stretch!important;min-width:0!important;overflow-x:hidden!important;isolation:isolate}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper{flex:1 1 auto!important;min-width:0!important}',
            'html body.bes-lms-surgical-course-player{--bes-lms-fix-content-gutter:clamp(26px,3vw,44px);--bes-lms-fix-content-max:1120px;--bes-lms-fix-sidebar-pad:clamp(16px,1.65vw,22px)}',
            '@media(min-width:783px){html body.bes-lms-surgical-course-player .masterstudy-course-player-content>.masterstudy-course-player-content__wrapper,html body.bes-lms-surgical-course-player.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper{flex:1 1 0!important;width:auto!important;max-width:none!important;min-width:0!important;margin:0!important;padding:clamp(34px,5.2vw,72px) var(--bes-lms-fix-content-gutter) clamp(42px,5.2vw,78px)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header,html body.bes-lms-surgical-course-player .masterstudy-course-player-lesson,html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation{width:min(100%,var(--bes-lms-fix-content-max))!important;max-width:var(--bes-lms-fix-content-max)!important;margin-left:auto!important;margin-right:auto!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1,html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1.bes-lms-repaired-title{width:100%!important;max-width:100%!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation__wrapper{width:100%!important;max-width:100%!important;margin-inline:0!important}}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__content{box-sizing:border-box!important;width:100%!important;max-width:100%!important;min-width:0!important;overflow-x:hidden!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper{box-sizing:border-box!important;display:block!important;width:100%!important;max-width:100%!important;min-width:0!important;padding:clamp(18px,2vw,22px) var(--bes-lms-fix-sidebar-pad) 18px!important;overflow:hidden!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__progress{box-sizing:border-box!important;display:block!important;width:100%!important;max-width:100%!important;min-width:0!important;margin:clamp(14px,1.45vw,18px) 0 0!important;overflow:hidden!important}html body.bes-lms-surgical-course-player .masterstudy-progress,html body.bes-lms-surgical-course-player .masterstudy-progress__bars,html body.bes-lms-surgical-course-player .masterstudy-progress__bar-empty,html body.bes-lms-surgical-course-player .masterstudy-progress__bottom,html body.bes-lms-surgical-course-player .masterstudy-progress__title{box-sizing:border-box!important;width:100%!important;max-width:100%!important;min-width:0!important}html body.bes-lms-surgical-course-player .masterstudy-progress__title,html body.bes-lms-surgical-course-player .masterstudy-progress__title.bes-lms-progress-title-fixed{display:flex!important;align-items:baseline!important;flex-wrap:wrap!important;gap:2px 4px!important;white-space:normal!important;overflow-wrap:normal!important}',
            '@media(min-width:783px) and (max-width:1280px){html body.bes-lms-surgical-course-player{--bes-lms-fix-content-gutter:clamp(28px,3vw,38px);--bes-lms-fix-content-max:100%}html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1,html body.bes-lms-surgical-course-player .masterstudy-course-player-content__header>h1.bes-lms-repaired-title{font-size:clamp(38px,3.8vw,50px)!important;line-height:1.18!important}}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum{box-sizing:border-box!important;flex:0 0 var(--bes-lms-fix-sidebar-w)!important;width:var(--bes-lms-fix-sidebar-w)!important;min-width:var(--bes-lms-fix-sidebar-w)!important;max-width:min(100vw,390px)!important;height:calc(100dvh - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;max-height:calc(100dvh - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;align-self:stretch!important;overflow:hidden!important;z-index:24!important;transform:translate3d(0,0,0)!important;opacity:1!important;visibility:visible!important;pointer-events:auto!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__wrapper{display:block!important;width:100%!important;height:100%!important;max-height:100%!important;min-height:0!important;overflow-x:hidden!important;overflow-y:auto!important;-webkit-overflow-scrolling:touch!important;overscroll-behavior:contain!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__content,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__wrapper,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__item,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__link{box-sizing:border-box!important;width:100%!important;max-width:100%!important;min-width:0!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__wrapper,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__list{overflow:visible!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title-wrapper,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta-wrapper{min-width:0!important;max-width:100%!important}',
            'html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__title,html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion__meta{min-width:0!important;max-width:100%!important;overflow-wrap:anywhere!important;word-break:normal!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-curriculum-collapsed:not(.bes-lms-curriculum-open) .masterstudy-course-player-curriculum,html body.bes-lms-surgical-course-player .masterstudy-course-player-content.bes-lms-curriculum-collapsed:not([data-bes-lms-curriculum="open"])>.masterstudy-course-player-curriculum{flex:0 0 0!important;width:0!important;min-width:0!important;max-width:0!important;margin:0!important;padding:0!important;border-right-width:0!important;opacity:0!important;visibility:hidden!important;pointer-events:none!important;overflow:hidden!important;transform:translate3d(-22px,0,0)!important;box-shadow:none!important}',
            'html body.bes-lms-surgical-course-player.bes-lms-curriculum-open .masterstudy-course-player-curriculum,html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum[data-bes-lms-curriculum="open"]{flex:0 0 var(--bes-lms-fix-sidebar-w)!important;width:var(--bes-lms-fix-sidebar-w)!important;min-width:var(--bes-lms-fix-sidebar-w)!important;max-width:min(100vw,390px)!important;padding:0!important;border-right-width:1px!important;opacity:1!important;visibility:visible!important;pointer-events:auto!important;overflow:hidden!important;transform:translate3d(0,0,0)!important}',
            '@media(max-width:1180px){html body.bes-lms-surgical-course-player{--bes-lms-fix-sidebar-w:clamp(286px,30vw,340px)}}',
            '@media(max-width:1024px) and (min-width:783px){html body.bes-lms-surgical-course-player{--bes-lms-fix-sidebar-w:clamp(294px,31vw,330px)}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__title-wrapper{padding-left:16px!important;padding-right:16px!important}html body.bes-lms-surgical-course-player .masterstudy-curriculum-accordion{padding-left:10px!important;padding-right:10px!important}}',
            '@media(max-width:782px){html body.bes-lms-surgical-course-player .masterstudy-course-player-content{display:block!important;overflow-x:hidden!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-content::after{content:""!important;position:fixed!important;inset:calc(var(--bes-lms-fix-header-h) + var(--bes-lms-fix-adminbar-h)) 0 0 0!important;background:rgba(10,14,7,.46)!important;backdrop-filter:blur(6px)!important;-webkit-backdrop-filter:blur(6px)!important;opacity:0!important;visibility:hidden!important;pointer-events:none!important;transition:opacity .26s var(--bes-lms-fix-ease-standard),visibility .26s var(--bes-lms-fix-ease-standard)!important;z-index:9996!important}html body.bes-lms-surgical-course-player.bes-lms-curriculum-open .masterstudy-course-player-content::after{opacity:1!important;visibility:visible!important;pointer-events:auto!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum{position:fixed!important;top:calc(var(--bes-lms-fix-header-h) + var(--bes-lms-fix-adminbar-h))!important;left:0!important;right:auto!important;bottom:0!important;z-index:9997!important;flex:none!important;width:var(--bes-lms-fix-mobile-sidebar-w)!important;min-width:0!important;max-width:var(--bes-lms-fix-mobile-sidebar-w)!important;height:calc(100dvh - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;max-height:calc(100dvh - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;margin:0!important;opacity:0!important;visibility:hidden!important;pointer-events:none!important;transform:translate3d(-105%,0,0)!important;box-shadow:24px 0 52px rgba(0,0,0,.28)!important}html body.bes-lms-surgical-course-player.bes-lms-curriculum-open .masterstudy-course-player-curriculum,html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum[data-bes-lms-curriculum="open"]{flex:none!important;width:var(--bes-lms-fix-mobile-sidebar-w)!important;min-width:0!important;max-width:var(--bes-lms-fix-mobile-sidebar-w)!important;opacity:1!important;visibility:visible!important;pointer-events:auto!important;transform:translate3d(0,0,0)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-header{display:flex!important;align-items:center!important;justify-content:space-between!important;position:sticky!important;top:0!important;z-index:2!important;padding:16px 18px!important;background:linear-gradient(180deg,rgba(21,30,16,.98),rgba(30,42,22,.94))!important;border-bottom:1px solid rgba(194,210,74,.16)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-close{display:inline-flex!important;position:relative!important;align-items:center!important;justify-content:center!important;flex:0 0 38px!important;width:38px!important;height:38px!important;border-radius:999px!important;background:rgba(255,255,255,.08)!important;border:1px solid rgba(194,210,74,.22)!important;cursor:pointer!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-close::before,html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-close::after{content:""!important;position:absolute!important;width:16px!important;height:2px!important;border-radius:999px!important;background:rgba(253,252,250,.9)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-close::before{transform:rotate(45deg)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__mobile-close::after{transform:rotate(-45deg)!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-content__wrapper{width:min(100% - 28px,100%)!important;max-width:100%!important}}',
            /* v1.4.2 iOS/Chrome mobile fix: avoid a fixed overlay swallowing touch scroll and
             * use a JS-updated viewport unit so the drawer height tracks Safari's dynamic toolbar. */
            '@media(max-width:782px){html body.bes-lms-surgical-course-player.bes-lms-curriculum-open .masterstudy-course-player-content::after{pointer-events:none!important;touch-action:pan-y!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum{height:calc((var(--bes-lms-real-vh,1vh) * 100) - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;max-height:calc((var(--bes-lms-real-vh,1vh) * 100) - var(--bes-lms-fix-header-h) - var(--bes-lms-fix-adminbar-h))!important;touch-action:pan-y!important;overscroll-behavior:contain!important}html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum__wrapper{height:100%!important;max-height:100%!important;overflow-x:hidden!important;overflow-y:auto!important;-webkit-overflow-scrolling:touch!important;touch-action:pan-y!important;overscroll-behavior:contain!important}}'
        ].join('\n');

        (document.head || document.documentElement).appendChild(style);
    }

    function installLegacyHeaderSafetyStubs() {
        if (!document.body || document.getElementById('bes-hdr')) {
            return;
        }

        var hiddenStyle = 'display:none!important;visibility:hidden!important;opacity:0!important;pointer-events:none!important;width:0!important;height:0!important;overflow:hidden!important;position:absolute!important;left:-99999px!important;top:-99999px!important;';

        function ensure(id, tagName, parent) {
            var node = document.getElementById(id);
            if (node) {
                return node;
            }

            node = document.createElement(tagName || 'div');
            node.id = id;
            node.className = 'bes-lms-legacy-header-stub';
            node.setAttribute('aria-hidden', 'true');
            node.style.cssText = hiddenStyle;
            (parent || document.body).appendChild(node);
            return node;
        }

        var header = ensure('bes-hdr', 'header', document.body);
        ensure('bes-hdr-inner', 'div', header);
        ensure('bes-scroll-prog', 'div', header);
        ensure('bes-drawer', 'nav', document.body);
        ensure('bes-backdrop', 'div', document.body);
        ensure('bes-burger', 'button', document.body);
        ensure('bes-drawer-x', 'button', document.body);
        ensure('bes-bl1', 'span', document.body);
        ensure('bes-bl2', 'span', document.body);
        ensure('bes-bl3', 'span', document.body);
    }

    installLegacyHeaderSafetyStubs();
    installCurriculumRuntimeStyle();

    function removeLoaders(root) {
        root = root || document;

        if (root.nodeType === 1 && root.matches && root.matches(LOADER_SELECTOR)) {
            root.remove();
            return;
        }

        if (!root.querySelectorAll) {
            return;
        }

        root.querySelectorAll(LOADER_SELECTOR).forEach(function (loader) {
            loader.remove();
        });
    }

    function hasPlayer() {
        return lessonPath || !!document.querySelector(PLAYER_SELECTOR);
    }

    function cleanDocumentTitle(title) {
        title = (title || '').replace(/\s+/g, ' ').trim();
        title = title.replace(/\s+[-|]\s+Bali\s+Eling\s+Spirit.*$/i, '').trim();
        title = title.replace(/\s+[-|]\s+Bali\s+Hatha\s+Yoga.*$/i, '').trim();
        return title;
    }

    function findLessonTitle() {
        var current = document.querySelector('.masterstudy-curriculum-accordion__link_current .masterstudy-curriculum-accordion__title');
        if (current && current.textContent.trim()) {
            return current.textContent.trim();
        }

        var h1 = document.querySelector('.masterstudy-course-player-content__header h1');
        if (h1 && h1.textContent.trim()) {
            return h1.textContent.trim();
        }

        return cleanDocumentTitle(document.title) || 'Course Lesson';
    }

    function forceVisibleTitle(h1) {
        if (!h1) {
            return;
        }

        h1.classList.add('bes-lms-repaired-title');
        h1.removeAttribute('hidden');
        h1.removeAttribute('aria-hidden');

        var styles = {
            display: 'block',
            visibility: 'visible',
            opacity: '1',
            position: 'static',
            height: 'auto',
            minHeight: '1em',
            maxHeight: 'none',
            lineHeight: '1.17',
            paddingBottom: '.13em',
            marginBottom: '-.05em',
            overflow: 'visible',
            clip: 'auto',
            clipPath: 'none',
            transform: 'none',
            margin: '0',
            zIndex: '2'
        };

        Object.keys(styles).forEach(function (property) {
            h1.style.setProperty(property, styles[property], 'important');
        });
    }

    function repairLessonTitle() {
        var wrapper = document.querySelector('.masterstudy-course-player-content__wrapper');
        if (!wrapper) {
            return;
        }

        var header = wrapper.querySelector('.masterstudy-course-player-content__header');
        var lesson = wrapper.querySelector('.masterstudy-course-player-lesson');

        if (!header) {
            header = document.createElement('div');
            header.className = 'masterstudy-course-player-content__header bes-lms-generated-title-header';
            wrapper.insertBefore(header, lesson || wrapper.firstChild);
        }

        var h1 = header.querySelector('h1');
        var title = findLessonTitle();

        if (!h1) {
            h1 = document.createElement('h1');
            h1.className = 'bes-lms-repaired-title';
            h1.textContent = title;

            var lessonType = header.querySelector('.masterstudy-course-player-content__header-lesson-type');
            if (lessonType && lessonType.nextSibling) {
                header.insertBefore(h1, lessonType.nextSibling);
            } else {
                header.appendChild(h1);
            }
        } else if (!h1.textContent.trim()) {
            h1.textContent = title;
        }

        forceVisibleTitle(h1);
    }



    function normalizeProgressLabels(root) {
        root = root || document;
        if (!root.querySelectorAll) {
            return;
        }

        root.querySelectorAll('.masterstudy-progress__title').forEach(function (title) {
            var percent = title.querySelector('.masterstudy-progress__percent');
            if (!percent) {
                return;
            }

            title.classList.add('bes-lms-progress-title-fixed');
            percent.textContent = (percent.textContent || '').replace('%', '').trim();

            Array.prototype.slice.call(title.childNodes).forEach(function (node) {
                if (node.nodeType === 3 && node.nodeValue && node.nodeValue.indexOf('%') !== -1) {
                    node.nodeValue = node.nodeValue.replace(/%/g, '');
                }
            });

            if (!title.querySelector('.bes-lms-progress-symbol')) {
                var symbol = document.createElement('span');
                symbol.className = 'bes-lms-progress-symbol';
                symbol.textContent = '%';
                percent.insertAdjacentElement('afterend', symbol);
            }
        });
    }

    function indexLessonBullets(root) {
        root = root || document;
        if (!root.querySelectorAll) {
            return;
        }

        root.querySelectorAll('.masterstudy-course-player-lesson ul').forEach(function (list) {
            list.querySelectorAll(':scope > li').forEach(function (item, index) {
                item.style.setProperty('--bes-lms-bullet-index', String(Math.min(index, 10)));
            });
        });
    }

    function stabilizeLessonHeadings(root) {
        root = root || document;
        if (!root.querySelectorAll) {
            return;
        }

        root.querySelectorAll('.masterstudy-course-player-lesson h1, .masterstudy-course-player-lesson h2, .masterstudy-course-player-lesson h3, .masterstudy-course-player-lesson h4, .masterstudy-course-player-lesson h5, .masterstudy-course-player-lesson h6').forEach(function (heading) {
            heading.classList.add('bes-lms-lesson-heading-fixed');
            heading.removeAttribute('hidden');
            heading.removeAttribute('aria-hidden');

            var level = heading.tagName ? heading.tagName.toLowerCase() : '';
            var lineHeight = level === 'h2' ? '1.15' : (level === 'h3' ? '1.17' : '1.24');
            var styles = {
                display: 'block',
                position: 'relative',
                float: 'none',
                clear: 'both',
                width: '100%',
                maxWidth: '100%',
                minWidth: '0',
                height: 'auto',
                maxHeight: 'none',
                overflow: 'visible',
                lineHeight: lineHeight,
                paddingBottom: '.18em',
                marginLeft: '0',
                marginRight: '0',
                whiteSpace: 'normal',
                wordBreak: 'normal',
                overflowWrap: 'normal',
                clip: 'auto',
                clipPath: 'none',
                transform: 'none'
            };

            Object.keys(styles).forEach(function (property) {
                heading.style.setProperty(property, styles[property], 'important');
            });
        });
    }


    var CURRICULUM_STORAGE_KEY = 'bes_lms_course_player_curriculum_collapsed';
    var curriculumStateReady = false;
    var CONTENT_NATIVE_COLLAPSED_CLASSES = [
        'masterstudy-course-player-content_curriculum-hidden',
        'masterstudy-course-player-content_curriculum-closed',
        'masterstudy-course-player-content_curriculum-collapsed'
    ];
    var CURRICULUM_NATIVE_COLLAPSED_CLASSES = [
        'masterstudy-course-player-curriculum_hidden',
        'masterstudy-course-player-curriculum_closed',
        'masterstudy-course-player-curriculum_collapsed'
    ];

    function isMobileCurriculumLayout() {
        try {
            return !!(window.matchMedia && window.matchMedia('(max-width: 782px)').matches);
        } catch (error) {
            return window.innerWidth <= 782;
        }
    }

    function setMobileViewportUnit() {
        if (!document.documentElement) {
            return;
        }

        var viewportHeight = window.innerHeight || 0;
        if (window.visualViewport && window.visualViewport.height) {
            viewportHeight = window.visualViewport.height;
        }

        if (viewportHeight > 0) {
            document.documentElement.style.setProperty('--bes-lms-real-vh', (viewportHeight * 0.01) + 'px');
        }
    }

    function removeClassNames(node, names) {
        if (!node || !node.classList) {
            return;
        }
        names.forEach(function (name) {
            node.classList.remove(name);
        });
    }

    function clearNativeHiddenStyles(node) {
        if (!node || !node.style) {
            return;
        }
        ['display', 'visibility', 'opacity', 'pointerEvents', 'transform', 'width', 'minWidth', 'maxWidth'].forEach(function (prop) {
            if (node.style[prop]) {
                node.style[prop] = '';
            }
        });
        node.removeAttribute('hidden');
    }

    function updateCurriculumScrollLock(open) {
        var shouldMarkMobileOpen = !!open && isMobileCurriculumLayout();

        setMobileViewportUnit();

        /* v1.4.2 mobile scroll rescue:
         * This class is now only an open-state marker. We intentionally do not lock
         * html/body with overflow:hidden because iOS Safari can then lose the only
         * scrollable ancestor when the fixed curriculum drawer is opened. */
        document.documentElement.classList.toggle('bes-lms-curriculum-scroll-lock', shouldMarkMobileOpen);
        if (document.body) {
            document.body.classList.toggle('bes-lms-curriculum-scroll-lock', shouldMarkMobileOpen);
            document.body.classList.toggle('bes-lms-curriculum-mobile-open', shouldMarkMobileOpen);

            if (shouldMarkMobileOpen) {
                document.documentElement.style.removeProperty('overflow');
                document.documentElement.style.removeProperty('height');
                document.documentElement.style.removeProperty('position');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('height');
                document.body.style.removeProperty('position');
            }
        }
    }

    function syncCurriculumNativeState(elements, collapsed) {
        elements = elements || getCurriculumElements();

        if (!collapsed) {
            removeClassNames(elements.content, CONTENT_NATIVE_COLLAPSED_CLASSES);
            removeClassNames(elements.curriculum, CURRICULUM_NATIVE_COLLAPSED_CLASSES);
            clearNativeHiddenStyles(elements.curriculum);
        }

        if (elements.content) {
            elements.content.classList.toggle('bes-lms-curriculum-open', !collapsed);
        }
        if (elements.curriculum) {
            elements.curriculum.classList.toggle('bes-lms-curriculum-is-open', !collapsed);
        }
    }

    function safeSessionStorage(action, key, value) {
        try {
            if (!window.sessionStorage) {
                return null;
            }
            if (action === 'get') {
                return window.sessionStorage.getItem(key);
            }
            if (action === 'set') {
                window.sessionStorage.setItem(key, value);
            }
        } catch (error) {}
        return null;
    }

    function getCurriculumElements() {
        return {
            body: document.body,
            content: document.querySelector('.masterstudy-course-player-content'),
            curriculum: document.querySelector('.masterstudy-course-player-curriculum'),
            switcher: document.querySelector('[data-id="masterstudy-curriculum-switcher"], .masterstudy-switch-button'),
            mobileClose: document.querySelector('.masterstudy-course-player-curriculum__mobile-close')
        };
    }

    function hasNativeCollapsedSignal(elements) {
        elements = elements || getCurriculumElements();
        var haystack = [
            elements.content ? elements.content.className : '',
            elements.curriculum ? elements.curriculum.className : '',
            elements.switcher ? elements.switcher.className : ''
        ].join(' ').toLowerCase();

        return /(curriculum[-_ ]?(hidden|closed|collapsed)|hidden[-_ ]?curriculum|closed[-_ ]?curriculum|collapsed[-_ ]?curriculum)/.test(haystack);
    }

    function readInitialCurriculumState() {
        try {
            var params = new URLSearchParams(window.location.search || '');
            if (params.get('curriculum_open') === 'yes' || params.get('curriculum_open') === 'true' || params.get('curriculum_open') === '1') {
                return false;
            }
        } catch (error) {}

        var stored = safeSessionStorage('get', CURRICULUM_STORAGE_KEY);
        if (stored === 'collapsed') {
            return true;
        }
        if (stored === 'open') {
            return false;
        }

        if (isMobileCurriculumLayout()) {
            return true;
        }

        return hasNativeCollapsedSignal();
    }

    function pulseCurriculumSwitcher(switcher) {
        if (!switcher || !switcher.classList) {
            return;
        }

        switcher.classList.remove('bes-lms-switch-pulse');
        void switcher.offsetWidth;
        switcher.classList.add('bes-lms-switch-pulse');
        window.setTimeout(function () {
            switcher.classList.remove('bes-lms-switch-pulse');
        }, 340);
    }

    function setCurriculumCollapsed(collapsed, options) {
        if (!document.body) {
            return;
        }

        options = options || {};
        collapsed = !!collapsed;
        var elements = getCurriculumElements();

        syncCurriculumNativeState(elements, collapsed);
        document.body.classList.toggle('bes-lms-curriculum-collapsed', collapsed);
        document.body.classList.toggle('bes-lms-curriculum-open', !collapsed);
        if (elements.content) {
            elements.content.classList.toggle('bes-lms-curriculum-collapsed', collapsed);
            elements.content.classList.toggle('bes-lms-curriculum-open', !collapsed);
            elements.content.setAttribute('data-bes-lms-curriculum', collapsed ? 'collapsed' : 'open');
        }
        if (elements.curriculum) {
            elements.curriculum.classList.toggle('bes-lms-curriculum-is-collapsed', collapsed);
            elements.curriculum.classList.toggle('bes-lms-curriculum-is-open', !collapsed);
            elements.curriculum.setAttribute('aria-hidden', collapsed ? 'true' : 'false');
            elements.curriculum.setAttribute('data-bes-lms-curriculum', collapsed ? 'collapsed' : 'open');
        }
        if (elements.switcher) {
            elements.switcher.classList.toggle('bes-lms-switch-collapsed', collapsed);
            elements.switcher.setAttribute('role', 'button');
            elements.switcher.setAttribute('tabindex', '0');
            elements.switcher.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
            elements.switcher.setAttribute('aria-pressed', collapsed ? 'false' : 'true');
            elements.switcher.setAttribute('aria-label', collapsed ? 'Show curriculum' : 'Hide curriculum');
            elements.switcher.setAttribute('title', collapsed ? 'Show curriculum' : 'Hide curriculum');
        }

        if (options.persist) {
            safeSessionStorage('set', CURRICULUM_STORAGE_KEY, collapsed ? 'collapsed' : 'open');
        }

        updateCurriculumScrollLock(!collapsed);

        window.setTimeout(function () {
            try {
                window.dispatchEvent(new Event('resize'));
            } catch (error) {}
        }, 60);
    }

    function installCurriculumToggle(root) {
        root = root || document;
        if (!document.body || !root.querySelectorAll) {
            return;
        }

        var elements = getCurriculumElements();
        if (!elements.curriculum || !elements.switcher) {
            return;
        }

        elements.switcher.classList.add('bes-lms-curriculum-toggle-ready');
        elements.switcher.setAttribute('role', 'button');
        elements.switcher.setAttribute('tabindex', '0');

        if (!curriculumStateReady) {
            curriculumStateReady = true;
            setCurriculumCollapsed(readInitialCurriculumState(), { persist: false });
        } else {
            setCurriculumCollapsed(document.body.classList.contains('bes-lms-curriculum-collapsed'), { persist: false });
        }
    }

    function decorateVideoLesson(root) {
        root = root || document;
        if (!document.body || !root.querySelectorAll) {
            return;
        }

        var video = document.querySelector('.masterstudy-course-player-lesson-video');
        var wrapper = document.querySelector('.masterstudy-course-player-content__wrapper');
        document.body.classList.toggle('bes-lms-video-lesson', !!video);
        if (wrapper) {
            wrapper.classList.toggle('bes-lms-video-wrapper', !!video);
        }

        if (!video) {
            return;
        }

        video.classList.add('bes-lms-video-ready');
        video.querySelectorAll('iframe').forEach(function (iframe) {
            if (!iframe.hasAttribute('title')) {
                iframe.setAttribute('title', findLessonTitle() + ' video');
            }
            iframe.setAttribute('loading', 'lazy');
        });

        video.querySelectorAll('.masterstudy-course-player-lesson-video__progress').forEach(function (progress) {
            progress.classList.add('bes-lms-video-progress-ready');
        });
    }


    var DARK_STORAGE_KEY = 'bes_lms_course_player_dark_mode';
    var DARK_COOKIE_NAME = 'bes_lms_dark_mode';
    var DARK_BODY_CLASSES = [
        'bes-lms-force-dark',
        'bes-lms-is-dark',
        'bes-lms-dark-on',
        'masterstudy-dark-mode',
        'masterstudy-dark-mode-enabled',
        'dark-mode'
    ];
    var DARK_HTML_CLASSES = ['bes-lms-force-dark-html'];
    var LIGHT_BODY_CLASSES = [
        'bes-lms-force-light',
        'bes-lms-is-light',
        'bes-lms-light-on'
    ];
    var LIGHT_HTML_CLASSES = ['bes-lms-force-light-html'];
    var NATIVE_DARK_ROOT_CLASSES = [
        'masterstudy-course-player-content_dark',
        'masterstudy-course-player-content_dark-mode',
        'masterstudy-course-player_dark',
        'masterstudy-course-player_dark-mode',
        'masterstudy-dark-mode',
        'masterstudy-dark-mode-enabled',
        'dark-mode'
    ];
    var DARK_BUTTON_CLASSES = [
        'bes-lms-dark-button-active',
        'masterstudy-dark-mode-button_active',
        'is-active',
        'active'
    ];
    var DARK_BUTTON_SELECTOR = '.masterstudy-dark-mode-button';
    var DARK_TOGGLE_SELECTOR = '.masterstudy-dark-mode-button, .masterstudy-course-player-header__dark-mode';
    var DARK_TOGGLE_BOUND_KEY = '__besLmsDarkToggleBound';
    var darkSyncBusy = false;
    var darkAudioContext = null;
    var darkLastToggleAt = 0;
    var DARK_SWITCH_MARKUP = '' +
        '<span class="bes-lms-dark-switch" aria-hidden="true">' +
            '<span class="bes-lms-dark-switch__track">' +
                '<span class="bes-lms-dark-switch__sun"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"></path></svg></span>' +
                '<span class="bes-lms-dark-switch__moon"><svg viewBox="0 0 24 24"><path d="M21 12.8A8.5 8.5 0 1 1 11.2 3a6.8 6.8 0 0 0 9.8 9.8z"></path></svg></span>' +
                '<span class="bes-lms-dark-switch__stars"></span>' +
                '<span class="bes-lms-dark-switch__knob">' +
                    '<svg class="bes-lms-dark-switch__knob-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"></circle><path d="M12 3v2M12 19v2M5.64 5.64l1.41 1.41M16.95 16.95l1.41 1.41M3 12h2M19 12h2M5.64 18.36l1.41-1.41M16.95 7.05l1.41-1.41"></path></svg>' +
                    '<svg class="bes-lms-dark-switch__knob-moon" viewBox="0 0 24 24"><path d="M20.8 13.2A7.8 7.8 0 1 1 10.8 3.2a6.1 6.1 0 0 0 10 10z"></path></svg>' +
                '</span>' +
            '</span>' +
        '</span>';

    function renderDarkModeButton(button) {
        if (!button || !button.querySelectorAll) {
            return;
        }

        if (button.classList && !button.classList.contains('masterstudy-dark-mode-button')) {
            button.classList.add('masterstudy-dark-mode-button', 'bes-lms-dark-button-generated');
        }

        if (button.tagName && button.tagName.toLowerCase() === 'button') {
            button.setAttribute('type', 'button');
            button.disabled = false;
        }

        button.removeAttribute('disabled');
        button.removeAttribute('aria-disabled');
        button.style.setProperty('pointer-events', 'auto', 'important');

        if (!button.querySelector('.bes-lms-dark-switch')) {
            button.innerHTML = DARK_SWITCH_MARKUP;
        }

        button.classList.add('bes-lms-dark-toggle-ready');
    }

    function getDarkAudioContext() {
        var Context = window.AudioContext || window.webkitAudioContext;
        if (!Context) {
            return null;
        }

        if (!darkAudioContext) {
            darkAudioContext = new Context();
        }

        if (darkAudioContext.state === 'suspended') {
            darkAudioContext.resume().catch(function () {});
        }

        return darkAudioContext;
    }

    function playDarkToggleSound(enabled) {
        try {
            var context = getDarkAudioContext();
            if (!context) {
                return;
            }

            var now = context.currentTime;
            var master = context.createGain();
            master.gain.setValueAtTime(0.0001, now);
            master.gain.exponentialRampToValueAtTime(0.105, now + 0.012);
            master.gain.exponentialRampToValueAtTime(0.0001, now + 0.18);
            master.connect(context.destination);

            [enabled ? 540 : 360, enabled ? 780 : 250].forEach(function (frequency, index) {
                var osc = context.createOscillator();
                var gain = context.createGain();
                osc.type = index === 0 ? 'triangle' : 'sine';
                osc.frequency.setValueAtTime(frequency, now + (index * 0.035));
                gain.gain.setValueAtTime(index === 0 ? 0.46 : 0.24, now + (index * 0.035));
                gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.16 + (index * 0.035));
                osc.connect(gain);
                gain.connect(master);
                osc.start(now + (index * 0.035));
                osc.stop(now + 0.19 + (index * 0.035));
            });
        } catch (error) {}
    }

    function pulseDarkButton(button) {
        if (!button || !button.classList) {
            return;
        }

        button.classList.remove('bes-lms-dark-toggle-pulse');
        void button.offsetWidth;
        button.classList.add('bes-lms-dark-toggle-pulse');
        window.setTimeout(function () {
            button.classList.remove('bes-lms-dark-toggle-pulse');
        }, 360);
    }

    function safeLocalStorage(method, key, value) {
        try {
            if (!window.localStorage) {
                return null;
            }

            if (method === 'get') {
                return window.localStorage.getItem(key);
            }

            if (method === 'set') {
                window.localStorage.setItem(key, value);
            }
        } catch (error) {}

        return null;
    }

    function getCookie(name) {
        try {
            var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/[.$?*|{}()\[\]\\/+^]/g, '\\$&') + '=([^;]*)'));
            return match ? decodeURIComponent(match[1]) : null;
        } catch (error) {
            return null;
        }
    }


    function setCookie(name, value) {
        try {
            document.cookie = name + '=' + encodeURIComponent(value) + '; path=/; max-age=31536000; SameSite=Lax';
        } catch (error) {}
    }

    function readPersistedDarkPreference() {
        var stored = safeLocalStorage('get', DARK_STORAGE_KEY);
        if (stored === 'dark' || stored === '1' || stored === 'true' || stored === 'on') {
            return true;
        }
        if (stored === 'light' || stored === '0' || stored === 'false' || stored === 'off') {
            return false;
        }

        var cookie = getCookie(DARK_COOKIE_NAME);
        if (cookie === 'dark' || cookie === '1' || cookie === 'true' || cookie === 'on') {
            return true;
        }
        if (cookie === 'light' || cookie === '0' || cookie === 'false' || cookie === 'off') {
            return false;
        }

        return null;
    }

    function persistDarkPreference(enabled) {
        var value = enabled ? 'dark' : 'light';
        safeLocalStorage('set', DARK_STORAGE_KEY, value);
        setCookie(DARK_COOKIE_NAME, value);
    }

    function hasDarkSignal(value) {
        value = String(value || '').toLowerCase();
        return /(^|\s)(dark|dark-mode|bes-lms-force-dark|bes-lms-is-dark|bes-lms-dark-on|masterstudy-dark-mode|masterstudy-dark-mode-enabled|masterstudy-course-player_dark|masterstudy-course-player_dark-mode|masterstudy-course-player-content_dark|masterstudy-course-player-content_dark-mode|masterstudy-dark-mode-button_active|bes-lms-dark-button-active)(\s|$)/.test(value);
    }

    function hasExplicitLightSignal() {
        var body = document.body;
        var html = document.documentElement;
        return !!(
            (body && (
                body.classList.contains('bes-lms-force-light') ||
                body.classList.contains('bes-lms-is-light') ||
                body.getAttribute('data-bes-lms-theme') === 'light'
            )) ||
            (html && (
                html.classList.contains('bes-lms-force-light-html') ||
                html.getAttribute('data-bes-lms-theme') === 'light' ||
                html.getAttribute('data-theme') === 'light'
            ))
        );
    }

    function isMasterStudyDark() {
        var body = document.body;
        var html = document.documentElement;
        var darkButton = document.querySelector('.masterstudy-dark-mode-button');
        var modeData = window.mode_data || {};
        var dataFlag = String(modeData.dark_mode || '').toLowerCase();
        var classHaystack = [
            body ? body.className : '',
            html ? html.className : '',
            darkButton ? darkButton.className : '',
            document.querySelector('.masterstudy-course-player-content') ? document.querySelector('.masterstudy-course-player-content').className : ''
        ].join(' ');

        if (hasExplicitLightSignal()) {
            return false;
        }

        return dataFlag === '1' || dataFlag === 'true' || dataFlag === 'on' || dataFlag === 'dark' ||
            hasDarkSignal(classHaystack) ||
            (html && (html.getAttribute('data-theme') === 'dark' || html.getAttribute('data-bes-lms-theme') === 'dark')) ||
            (body && (body.getAttribute('data-theme') === 'dark' || body.getAttribute('data-bes-lms-theme') === 'dark'));
    }

    function isDomDark() {
        var persisted = readPersistedDarkPreference();
        if (persisted !== null) {
            return persisted;
        }

        return isMasterStudyDark();
    }

    function toggleClasses(element, classes, enabled) {
        if (!element || !element.classList) {
            return;
        }

        classes.forEach(function (className) {
            element.classList.toggle(className, enabled);
        });
    }

    function setAttributeIfChanged(element, attribute, value) {
        if (!element) {
            return;
        }

        if (value === null) {
            if (element.hasAttribute(attribute)) {
                element.removeAttribute(attribute);
            }
            return;
        }

        if (element.getAttribute(attribute) !== String(value)) {
            element.setAttribute(attribute, String(value));
        }
    }

    function preserveAndSetThemeAttribute(html, enabled) {
        if (!html) {
            return;
        }

        /* Keep MasterStudy/theme CSS selectors deterministic on the lesson page. */
        setAttributeIfChanged(html, 'data-theme', enabled ? 'dark' : 'light');
    }

    function applyDarkMode(enabled, options) {
        if (!document.body) {
            return;
        }

        options = options || {};
        enabled = !!enabled;
        darkSyncBusy = true;

        var body = document.body;
        var html = document.documentElement;
        var darkButton = document.querySelector('.masterstudy-dark-mode-button');
        var themedRoots = document.querySelectorAll('.masterstudy-course-player-header, .masterstudy-course-player-content, .masterstudy-course-player-curriculum, .masterstudy-course-player-discussions');

        toggleClasses(body, DARK_BODY_CLASSES, enabled);
        toggleClasses(html, DARK_HTML_CLASSES, enabled);
        toggleClasses(body, LIGHT_BODY_CLASSES, !enabled);
        toggleClasses(html, LIGHT_HTML_CLASSES, !enabled);
        setAttributeIfChanged(body, 'data-bes-lms-theme', enabled ? 'dark' : 'light');
        setAttributeIfChanged(html, 'data-bes-lms-theme', enabled ? 'dark' : 'light');
        preserveAndSetThemeAttribute(html, enabled);

        themedRoots.forEach(function (root) {
            root.classList.toggle('bes-lms-force-dark', enabled);
            root.classList.toggle('bes-lms-is-dark', enabled);
            root.classList.toggle('bes-lms-force-light', !enabled);
            root.classList.toggle('bes-lms-is-light', !enabled);
            if (!enabled) {
                removeClassNames(root, NATIVE_DARK_ROOT_CLASSES);
                root.style.removeProperty('background');
                root.style.removeProperty('background-color');
                root.style.removeProperty('color');
            }
            setAttributeIfChanged(root, 'data-bes-lms-theme', enabled ? 'dark' : 'light');
        });

        if (!enabled) {
            removeClassNames(body, NATIVE_DARK_ROOT_CLASSES);
            removeClassNames(html, NATIVE_DARK_ROOT_CLASSES);
        }

        if (darkButton) {
            renderDarkModeButton(darkButton);
            toggleClasses(darkButton, DARK_BUTTON_CLASSES, enabled);
            setAttributeIfChanged(darkButton, 'aria-pressed', enabled ? 'true' : 'false');
            setAttributeIfChanged(darkButton, 'aria-label', enabled ? 'Disable dark mode' : 'Enable dark mode');
            setAttributeIfChanged(darkButton, 'title', enabled ? 'Disable dark mode' : 'Enable dark mode');
            setAttributeIfChanged(darkButton, 'data-bes-lms-theme', enabled ? 'dark' : 'light');
            setAttributeIfChanged(darkButton, 'role', 'button');
            if (!darkButton.hasAttribute('tabindex')) {
                darkButton.setAttribute('tabindex', '0');
            }
        }

        if (window.mode_data && typeof window.mode_data === 'object') {
            window.mode_data.dark_mode = enabled ? '1' : '';
        }

        if (options.persist) {
            persistDarkPreference(enabled);
        }

        window.setTimeout(function () {
            darkSyncBusy = false;
        }, 0);
    }

    function syncDarkMode(forcedState, options) {
        if (!document.body) {
            return;
        }

        var persisted = readPersistedDarkPreference();
        var nextState = typeof forcedState === 'boolean'
            ? forcedState
            : (persisted !== null ? persisted : isMasterStudyDark());

        applyDarkMode(nextState, options || {});
    }

    function closestDarkToggle(target) {
        if (!target) {
            return null;
        }

        if (target.closest) {
            return target.closest(DARK_TOGGLE_SELECTOR);
        }

        while (target && target.nodeType === 1) {
            if (target.matches && target.matches(DARK_TOGGLE_SELECTOR)) {
                return target;
            }
            target = target.parentElement;
        }

        return null;
    }

    function resolveDarkModeButton(target) {
        var toggle = closestDarkToggle(target);
        if (!toggle) {
            return null;
        }

        if (toggle.matches && toggle.matches(DARK_BUTTON_SELECTOR)) {
            return toggle;
        }

        return toggle.querySelector ? (toggle.querySelector(DARK_BUTTON_SELECTOR) || toggle) : toggle;
    }

    function stopDarkToggleEvent(event) {
        if (!event) {
            return;
        }

        event.preventDefault();
        /* BES-FIX v1.4.2-dark: this lesson shell now owns the visible theme state.
           MasterStudy can add transient active/dark classes after the click event,
           which creates a split state where the switch shows light while the page
           remains dark. Stop the native click path and keep the preference in the
           BES storage/cookie bridge instead. */
        if (typeof event.stopImmediatePropagation === 'function') {
            event.stopImmediatePropagation();
        } else if (typeof event.stopPropagation === 'function') {
            event.stopPropagation();
        }
    }

    function runDarkModeToggle(button, event) {
        if (!button) {
            return false;
        }

        if (event) {
            if (event.__besLmsDarkToggleHandled) {
                stopDarkToggleEvent(event);
                return true;
            }
            event.__besLmsDarkToggleHandled = true;
        }

        var now = Date.now ? Date.now() : new Date().getTime();
        if (now - darkLastToggleAt < 180) {
            stopDarkToggleEvent(event);
            return true;
        }
        darkLastToggleAt = now;

        stopDarkToggleEvent(event);
        renderDarkModeButton(button);

        var nextState = !isDomDark();
        playDarkToggleSound(nextState);
        pulseDarkButton(button);
        syncDarkMode(nextState, { persist: true, fromUser: true });

        window.setTimeout(function () {
            syncDarkMode(nextState, { persist: true });
        }, 80);
        window.setTimeout(function () {
            syncDarkMode(nextState, { persist: true });
        }, 360);

        return true;
    }

    /* Global click handler. It takes ownership of the visual theme switch so
       native transient classes cannot leave the content in the opposite theme. */
    function handleDarkModeClick(event) {
        var button = resolveDarkModeButton(event && event.target);
        if (!button) {
            return;
        }

        if (event && event.__besLmsDarkToggleHandled) {
            stopDarkToggleEvent(event);
            return;
        }
        if (event) {
            event.__besLmsDarkToggleHandled = true;
            stopDarkToggleEvent(event);
        }

        var now = Date.now ? Date.now() : new Date().getTime();
        if (now - darkLastToggleAt < 180) {
            return;
        }
        darkLastToggleAt = now;

        renderDarkModeButton(button);
        var nextState = !isDomDark();
        playDarkToggleSound(nextState);
        pulseDarkButton(button);
        syncDarkMode(nextState, { persist: true, fromUser: true });

        window.setTimeout(function () {
            syncDarkMode(nextState, { persist: true });
        }, 80);
        window.setTimeout(function () {
            syncDarkMode(nextState, { persist: true });
        }, 360);
    }

    /* Element-bound keydown handler — Space/Enter keyboard activation. Stops the
       event here because keyboard events on a non-native-button element should not
       also trigger a click; we handle it ourselves. */
    function handleDarkModeKeydown(event) {
        if (!event || (event.key !== 'Enter' && event.key !== ' ')) {
            return;
        }

        var button = resolveDarkModeButton(event.target);
        if (!button) {
            return;
        }

        /* Prevent page scroll on Space and stop double-fire. */
        event.preventDefault();
        if (typeof event.stopPropagation === 'function') {
            event.stopPropagation();
        }

        var now = Date.now ? Date.now() : new Date().getTime();
        if (now - darkLastToggleAt < 180) {
            return;
        }
        darkLastToggleAt = now;

        renderDarkModeButton(button);
        var nextState = !isDomDark();
        playDarkToggleSound(nextState);
        pulseDarkButton(button);
        syncDarkMode(nextState, { persist: true, fromUser: true });
    }

    function bindDarkToggleEventTarget(target) {
        if (!target || target[DARK_TOGGLE_BOUND_KEY]) {
            return;
        }

        target[DARK_TOGGLE_BOUND_KEY] = true;
        target.addEventListener('keydown', handleDarkModeKeydown, true);
    }

    function installDarkModeToggle(root) {
        root = root || document;
        if (!root.querySelectorAll) {
            return;
        }

        root.querySelectorAll(DARK_TOGGLE_SELECTOR).forEach(function (target) {
            var button = resolveDarkModeButton(target);
            if (!button) {
                return;
            }

            renderDarkModeButton(button);
            setAttributeIfChanged(button, 'role', 'button');
            if (!button.hasAttribute('tabindex')) {
                button.setAttribute('tabindex', '0');
            }
            setAttributeIfChanged(button, 'aria-pressed', isDomDark() ? 'true' : 'false');
            setAttributeIfChanged(button, 'data-bes-lms-theme', isDomDark() ? 'dark' : 'light');
            button.classList.add('bes-lms-dark-toggle-ready');

            bindDarkToggleEventTarget(target);
            bindDarkToggleEventTarget(button);
        });
    }

    function settleDarkModeClick(previousState) {
        var masterState = isMasterStudyDark();
        var nextState = masterState === previousState ? !previousState : masterState;
        syncDarkMode(nextState, { persist: true });
    }

    function markReady() {
        if (!document.body || !hasPlayer()) {
            return;
        }

        installLegacyHeaderSafetyStubs();
        setMobileViewportUnit();
        document.body.classList.add(BODY_CLASS);
        document.documentElement.classList.add('bes-lms-surgical-html-ready');
        removeLoaders(document);
        repairLessonTitle();
        stabilizeLessonHeadings(document);
        normalizeProgressLabels(document);
        indexLessonBullets(document);
        decorateVideoLesson(document);
        installCurriculumToggle(document);
        installDarkModeToggle(document);
        syncDarkMode();

        window.requestAnimationFrame(function () {
            repairLessonTitle();
            stabilizeLessonHeadings(document);
            decorateVideoLesson(document);
            installCurriculumToggle(document);
            document.body.classList.add(READY_CLASS);
        });
    }

    function inspectNode(node) {
        if (!node || node.nodeType !== 1) {
            return;
        }

        removeLoaders(node);
        stabilizeLessonHeadings(node);
        normalizeProgressLabels(node);
        indexLessonBullets(node);
        decorateVideoLesson(node);
        installCurriculumToggle(node);
        installDarkModeToggle(node);
        syncDarkMode();

        if ((node.matches && node.matches(PLAYER_SELECTOR)) || (node.querySelector && node.querySelector(PLAYER_SELECTOR))) {
            markReady();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', markReady, { once: true });
    } else {
        markReady();
    }

    window.addEventListener('load', markReady, { once: true });

    document.addEventListener('click', function (event) {
        var target = event.target;
        var switcher = target && target.closest ? target.closest('[data-id="masterstudy-curriculum-switcher"], .masterstudy-course-player-curriculum__mobile-close') : null;
        if (!switcher) {
            return;
        }

        event.preventDefault();
        if (typeof event.stopImmediatePropagation === 'function') {
            event.stopImmediatePropagation();
        } else {
            event.stopPropagation();
        }

        var collapsed;
        if (switcher.classList && switcher.classList.contains('masterstudy-course-player-curriculum__mobile-close')) {
            collapsed = true;
        } else {
            collapsed = !document.body.classList.contains('bes-lms-curriculum-collapsed');
        }

        setCurriculumCollapsed(collapsed, { persist: true, fromUser: true });
        pulseCurriculumSwitcher(document.querySelector('[data-id="masterstudy-curriculum-switcher"], .masterstudy-switch-button'));
    }, true);

    document.addEventListener('keydown', function (event) {
        var switcher = event.target && event.target.closest ? event.target.closest('[data-id="masterstudy-curriculum-switcher"], .masterstudy-course-player-curriculum__mobile-close') : null;
        if (!switcher || (event.key !== 'Enter' && event.key !== ' ')) {
            return;
        }

        event.preventDefault();
        if (typeof event.stopImmediatePropagation === 'function') {
            event.stopImmediatePropagation();
        } else {
            event.stopPropagation();
        }

        var collapsed = !document.body.classList.contains('bes-lms-curriculum-collapsed');
        if (switcher.classList && switcher.classList.contains('masterstudy-course-player-curriculum__mobile-close')) {
            collapsed = true;
        }
        setCurriculumCollapsed(collapsed, { persist: true, fromUser: true });
        pulseCurriculumSwitcher(document.querySelector('[data-id="masterstudy-curriculum-switcher"], .masterstudy-switch-button'));
    }, true);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && document.body && document.body.classList.contains('bes-lms-curriculum-open') && isMobileCurriculumLayout()) {
            setCurriculumCollapsed(true, { persist: true, fromUser: true });
        }
    });

    document.addEventListener('click', function (event) {
        if (!document.body || !document.body.classList.contains('bes-lms-curriculum-open') || !isMobileCurriculumLayout()) {
            return;
        }

        var target = event.target;
        var elements = getCurriculumElements();
        var clickedToggle = target && target.closest ? target.closest('[data-id="masterstudy-curriculum-switcher"], .masterstudy-course-player-curriculum__mobile-close') : null;
        if (clickedToggle || (elements.curriculum && elements.curriculum.contains(target))) {
            return;
        }

        /* v1.4.2: the dim layer no longer captures pointer events, so close the
         * mobile drawer in capture phase and prevent the underlying lesson link
         * or button from firing on the same tap. */
        event.preventDefault();
        if (typeof event.stopImmediatePropagation === 'function') {
            event.stopImmediatePropagation();
        } else {
            event.stopPropagation();
        }
        setCurriculumCollapsed(true, { persist: true, fromUser: true });
    }, true);

    window.addEventListener('resize', function () {
        setMobileViewportUnit();
        if (!document.body) {
            return;
        }
        updateCurriculumScrollLock(document.body.classList.contains('bes-lms-curriculum-open'));
    }, { passive: true });

    window.addEventListener('orientationchange', function () {
        window.setTimeout(setMobileViewportUnit, 80);
        window.setTimeout(setMobileViewportUnit, 260);
    }, { passive: true });

    if (window.visualViewport) {
        window.visualViewport.addEventListener('resize', setMobileViewportUnit, { passive: true });
        window.visualViewport.addEventListener('scroll', setMobileViewportUnit, { passive: true });
    }


    window.addEventListener('click', handleDarkModeClick, true);
    document.addEventListener('click', handleDarkModeClick, true);

    window.addEventListener('keydown', handleDarkModeKeydown, true);
    document.addEventListener('keydown', handleDarkModeKeydown, true);

    var observer = new MutationObserver(function (mutations) {
        if (darkSyncBusy) {
            return;
        }

        mutations.forEach(function (mutation) {
            if (mutation.type === 'attributes') {
                var target = mutation.target;
                var targetIsDarkButton = !!(target && target.matches && target.matches('.masterstudy-dark-mode-button'));
                var targetIsThemeRoot = !!(target && target.matches && target.matches('html, body, .masterstudy-course-player-header, .masterstudy-course-player-content, .masterstudy-course-player-curriculum, .masterstudy-course-player-discussions'));

                if (targetIsDarkButton || targetIsThemeRoot) {
                    syncDarkMode(undefined, { persist: false });
                } else {
                    syncDarkMode();
                }
                return;
            }

            mutation.addedNodes.forEach(inspectNode);
        });
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class', 'data-theme', 'data-bes-lms-theme'],
        childList: true,
        subtree: true
    });

    pollTimer = window.setInterval(function () {
        pollCount += 1;
        markReady();

        if (pollCount >= 32) {
            window.clearInterval(pollTimer);
        }
    }, 250);
}());
JS;
    }
}
/* --------------------------------------------------------------------------
 * BES LMS Final Safe Clone Sticky Navigation
 * Desktop alignment fix: the bottom clone follows the real lesson card edges.
 * -------------------------------------------------------------------------- */

if (! function_exists('bes_lms_final_safe_clone_nav_css')) {
    function bes_lms_final_safe_clone_nav_css(): string {
        return <<<'CSS'
html body.bes-lms-surgical-course-player {
    --bes-lms-final-sticky-left: 0px;
    --bes-lms-final-sticky-right: 0px;
    --bes-lms-final-sticky-pad-left: clamp(24px, 3vw, 48px);
    --bes-lms-final-sticky-pad-right: clamp(24px, 3vw, 48px);
    --bes-lms-final-sticky-height: 96px;
}

html body.bes-lms-surgical-course-player footer.relative.bg-bes-forest-deep.text-white.overflow-hidden[role="contentinfo"],
html body.bes-lms-surgical-course-player .bes-lms-global-footer-suppressed {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    min-height: 0 !important;
    max-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    pointer-events: none !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-navigation.bes-lms-final-sticky-nav-source {
    display: block !important;
    position: static !important;
    inset: auto !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    width: 100% !important;
    height: 0 !important;
    min-height: 0 !important;
    max-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    box-shadow: none !important;
    overflow: hidden !important;
    transform: none !important;
}

html body.bes-lms-surgical-course-player.bes-lms-final-sticky-nav-active {
    padding-bottom: calc(var(--bes-lms-final-sticky-height, 96px) + env(safe-area-inset-bottom, 0px) + 18px) !important;
}

html body.bes-lms-surgical-course-player.bes-lms-final-sticky-nav-active .masterstudy-course-player-content > .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-final-sticky-nav-active.bes-lms-video-lesson .masterstudy-course-player-content__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-final-sticky-nav-active .masterstudy-course-player-content__wrapper.bes-lms-video-wrapper {
    padding-bottom: calc(var(--bes-lms-final-sticky-height, 96px) + clamp(38px, 4vw, 72px)) !important;
}

html body.bes-lms-surgical-course-player .masterstudy-course-player-curriculum {
    position: relative !important;
    z-index: 24 !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell {
    position: fixed !important;
    left: var(--bes-lms-final-sticky-left, 0px) !important;
    right: var(--bes-lms-final-sticky-right, 0px) !important;
    bottom: 0 !important;
    z-index: 23 !important;
    display: block !important;
    box-sizing: border-box !important;
    padding: 0 0 max(10px, env(safe-area-inset-bottom, 0px)) !important;
    margin: 0 !important;
    border: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    filter: none !important;
    pointer-events: none !important;
    transform: translateZ(0) !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell,
html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell *,
html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell *::before,
html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell *::after {
    box-sizing: border-box !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation.bes-lms-final-sticky-nav-clone {
    display: block !important;
    position: relative !important;
    inset: auto !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    height: auto !important;
    min-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    filter: none !important;
    overflow: visible !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
    transform: none !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper {
    display: grid !important;
    grid-template-columns: minmax(124px, max-content) minmax(0, 1fr) minmax(124px, max-content) !important;
    grid-template-areas: "prev status next" !important;
    align-items: center !important;
    gap: clamp(10px, 1.4vw, 22px) !important;
    width: 100% !important;
    max-width: 100% !important;
    min-height: 72px !important;
    margin: 0 !important;
    padding: 12px var(--bes-lms-final-sticky-pad-right, clamp(24px, 3vw, 48px)) 12px var(--bes-lms-final-sticky-pad-left, clamp(24px, 3vw, 48px)) !important;
    border: 1px solid rgba(63, 81, 48, .14) !important;
    border-bottom: 0 !important;
    border-radius: 18px 18px 0 0 !important;
    background: rgba(253, 252, 250, .98) !important;
    box-shadow: none !important;
    filter: none !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
    bottom: -12px;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__prev {
    grid-area: prev !important;
    justify-self: start !important;
    min-width: 0 !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status {
    grid-area: status !important;
    justify-self: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 9px !important;
    max-width: 100% !important;
    min-height: 36px !important;
    margin: 0 !important;
    padding: 0 16px !important;
    border: 1px solid rgba(63, 81, 48, .12) !important;
    border-radius: 999px !important;
    background: rgba(216, 228, 140, .25) !important;
    color: var(--bes-lms-fix-olive-dark, #344528) !important;
    box-shadow: none !important;
    filter: none !important;
    font-family: var(--bes-lms-fix-font-body, "Plus Jakarta Sans", Arial, sans-serif) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
    letter-spacing: .08em !important;
    text-align: center !important;
    text-transform: uppercase !important;
    white-space: nowrap !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status::before {
    content: '' !important;
    display: inline-block !important;
    width: 8px !important;
    height: 8px !important;
    border-radius: 999px !important;
    background: var(--bes-lms-fix-leaf, #C2D24A) !important;
    box-shadow: none !important;
    flex: 0 0 auto !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__next {
    grid-area: next !important;
    justify-self: end !important;
    min-width: 0 !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(.masterstudy-course-player-navigation__prev, .masterstudy-course-player-navigation__next) {
    display: flex !important;
    align-items: center !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button, button, [role="button"]) {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 124px !important;
    min-height: 44px !important;
    margin: 0 !important;
    padding: 0 20px !important;
    border: 1px solid rgba(63, 81, 48, .24) !important;
    border-radius: 999px !important;
    background: var(--bes-lms-fix-forest, #1E2A16) !important;
    color: var(--bes-lms-fix-ivory, #FDFCFA) !important;
    box-shadow: none !important;
    filter: none !important;
    font-family: var(--bes-lms-fix-font-body, "Plus Jakarta Sans", Arial, sans-serif) !important;
    font-size: 12px !important;
    font-weight: 900 !important;
    letter-spacing: .09em !important;
    line-height: 1 !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
    transition: background .2s ease, border-color .2s ease, transform .2s ease !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button, button, [role="button"]):hover {
    transform: translateY(-1px) !important;
    border-color: rgba(194, 210, 74, .58) !important;
    background: var(--bes-lms-fix-olive-dark, #344528) !important;
    box-shadow: none !important;
}

html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(a, button, [role="button"]):focus-visible {
    outline: 2px solid var(--bes-lms-fix-leaf, #C2D24A) !important;
    outline-offset: 3px !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-is-dark #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper,
html body.bes-lms-surgical-course-player.bes-lms-dark-on #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper,
html.bes-lms-force-dark-html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper,
html[data-bes-lms-theme="dark"] body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper,
html[data-theme="dark"] body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper {
    border-color: rgba(194, 210, 74, .18) !important;
    background: rgba(21, 30, 16, .98) !important;
    box-shadow: none !important;
}

html body.bes-lms-surgical-course-player.bes-lms-force-dark #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.bes-lms-is-dark #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status,
html body.bes-lms-surgical-course-player.bes-lms-dark-on #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status,
html[data-theme="dark"] body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status {
    border-color: rgba(194, 210, 74, .22) !important;
    background: rgba(194, 210, 74, .13) !important;
    color: var(--bes-lms-fix-leaf-soft, #D8E48C) !important;
}

@media (max-width: 782px) {
    html body.bes-lms-surgical-course-player {
        --bes-lms-final-sticky-left: 0px;
        --bes-lms-final-sticky-right: 0px;
        --bes-lms-final-sticky-pad-left: 12px;
        --bes-lms-final-sticky-pad-right: 12px;
    }

    html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell {
        left: 0 !important;
        right: 0 !important;
        padding: 0 12px max(12px, env(safe-area-inset-bottom, 0px)) !important;
    }

    html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__wrapper {
        gap: 10px !important;
        //min-height: 0 !important;
        padding: 12px !important;
        border-radius: 18px 18px 0 0 !important;
    }

    html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(.masterstudy-course-player-navigation__prev, .masterstudy-course-player-navigation__next, .masterstudy-course-player-navigation__status) {
        justify-self: stretch !important;
        width: 100% !important;
    }

    html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell :where(.masterstudy-course-player-navigation__prev a, .masterstudy-course-player-navigation__next a, .masterstudy-nav-button, button, [role="button"]),
    html body.bes-lms-surgical-course-player #bes-lms-final-sticky-nav-shell .masterstudy-course-player-navigation__status {
        width: 100% !important;
        min-width: 0 !important;
        font-size: 9px !important;
        min-height: auto !important;
    }
}
CSS;
    }
}

if (! function_exists('bes_lms_final_safe_clone_nav_js')) {
    function bes_lms_final_safe_clone_nav_js(): string {
        return <<<'JS'
(function () {
    'use strict';

    if (window.__besLmsFinalSafeCloneNavigation) {
        return;
    }

    window.__besLmsFinalSafeCloneNavigation = true;

    var BODY_CLASS = 'bes-lms-surgical-course-player';
    var ACTIVE_CLASS = 'bes-lms-final-sticky-nav-active';
    var SOURCE_CLASS = 'bes-lms-final-sticky-nav-source';
    var CLONE_CLASS = 'bes-lms-final-sticky-nav-clone';
    var SHELL_ID = 'bes-lms-final-sticky-nav-shell';
    var DESKTOP_MIN = 783;
    var NAV_SELECTOR = '.masterstudy-course-player-navigation';
    var FOOTER_SELECTOR = 'footer.relative.bg-bes-forest-deep.text-white.overflow-hidden[role="contentinfo"]';
    var CLICKABLE_SELECTOR = 'a[href], button, [role="button"], input[type="button"], input[type="submit"]';

    var state = {
        source: null,
        shell: null,
        signature: '',
        sourceObserver: null,
        raf: 0,
        metricRaf: 0,
        bootCount: 0
    };

    function shouldRun() {
        return !!document.body && document.body.classList.contains(BODY_CLASS);
    }

    function toArray(list) {
        return Array.prototype.slice.call(list || []);
    }

    function parsePx(value) {
        var number = parseFloat(value);
        return Number.isFinite(number) ? number : 0;
    }

    function isVisibleElement(element) {
        if (!element) {
            return false;
        }

        var rect = element.getBoundingClientRect();
        var styles = window.getComputedStyle(element);

        return styles.display !== 'none' && styles.visibility !== 'hidden' && rect.width > 24 && rect.height >= 0;
    }

    function getSourceNavigation() {
        var existing = document.querySelector(NAV_SELECTOR + '.' + SOURCE_CLASS);

        if (existing && !existing.closest('#' + SHELL_ID)) {
            return existing;
        }

        var candidates = toArray(document.querySelectorAll(NAV_SELECTOR));

        for (var i = 0; i < candidates.length; i += 1) {
            var nav = candidates[i];

            if (nav.closest('#' + SHELL_ID) || nav.classList.contains(CLONE_CLASS)) {
                continue;
            }

            return nav;
        }

        return null;
    }

    function getClickableControls(root) {
        return toArray(root ? root.querySelectorAll(CLICKABLE_SELECTOR) : []).filter(function (control) {
            return !control.closest('.masterstudy-course-player-navigation__status');
        });
    }

    function navigationSignature(source) {
        if (!source) {
            return '';
        }

        return source.textContent.replace(/\s+/g, ' ').trim() + '|' + getClickableControls(source).map(function (control) {
            return [
                control.tagName,
                control.getAttribute('href') || '',
                control.getAttribute('class') || '',
                control.getAttribute('aria-disabled') || '',
                control.disabled ? 'disabled' : 'enabled',
                control.textContent.replace(/\s+/g, ' ').trim()
            ].join(':');
        }).join('|');
    }

    function getShell() {
        if (state.shell && document.body.contains(state.shell)) {
            return state.shell;
        }

        var shell = document.getElementById(SHELL_ID);

        if (!shell) {
            shell = document.createElement('div');
            shell.id = SHELL_ID;
            shell.setAttribute('aria-label', 'Course navigation');
            document.body.appendChild(shell);
        }

        if (!shell.dataset.besLmsFinalBound) {
            shell.addEventListener('click', handleCloneClick, true);
            shell.addEventListener('keydown', handleCloneKeydown, true);
            shell.dataset.besLmsFinalBound = 'true';
        }

        state.shell = shell;
        return shell;
    }

    function scrubClone(clone) {
        clone.classList.add(CLONE_CLASS);
        clone.classList.remove(SOURCE_CLASS);
        clone.removeAttribute('id');
        clone.removeAttribute('hidden');
        clone.removeAttribute('aria-hidden');
        clone.removeAttribute('data-bes-lms-final-source');
        clone.setAttribute('data-bes-lms-final-clone', 'true');

        toArray(clone.querySelectorAll('[id]')).forEach(function (element) {
            element.removeAttribute('id');
        });

        toArray(clone.querySelectorAll('[aria-hidden="true"]')).forEach(function (element) {
            element.removeAttribute('aria-hidden');
        });
    }

    function bridgeControls(source, clone) {
        var base = Date.now().toString(36);
        var sourceControls = getClickableControls(source);
        var cloneControls = getClickableControls(clone);

        sourceControls.forEach(function (sourceControl, index) {
            var cloneControl = cloneControls[index];

            if (!cloneControl) {
                return;
            }

            var key = sourceControl.getAttribute('data-bes-lms-final-nav-key');

            if (!key) {
                key = 'nav-' + base + '-' + index;
                sourceControl.setAttribute('data-bes-lms-final-nav-key', key);
            }

            cloneControl.setAttribute('data-bes-lms-final-nav-key', key);
            cloneControl.setAttribute('tabindex', sourceControl.getAttribute('tabindex') || '0');
        });
    }

    function resolveSourceControl(cloneControl) {
        var key = cloneControl && cloneControl.getAttribute('data-bes-lms-final-nav-key');
        var source = state.source || getSourceNavigation();

        if (!key || !source) {
            return null;
        }

        var controls = getClickableControls(source);

        for (var i = 0; i < controls.length; i += 1) {
            if (controls[i].getAttribute('data-bes-lms-final-nav-key') === key) {
                return controls[i];
            }
        }

        return null;
    }

    function isDisabled(control) {
        if (!control) {
            return true;
        }

        return control.disabled ||
            control.getAttribute('aria-disabled') === 'true' ||
            control.classList.contains('disabled') ||
            control.classList.contains('masterstudy-button_disabled') ||
            control.classList.contains('masterstudy-nav-button_disabled');
    }

    function activateCloneControl(event, forcedControl) {
        var target = forcedControl || (event.target && event.target.closest ? event.target.closest(CLICKABLE_SELECTOR) : null);

        if (!target || !target.closest || !target.closest('#' + SHELL_ID + ' .' + CLONE_CLASS)) {
            return;
        }

        var sourceControl = resolveSourceControl(target);

        if (!sourceControl) {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        if (typeof event.stopImmediatePropagation === 'function') {
            event.stopImmediatePropagation();
        }

        if (isDisabled(sourceControl)) {
            return;
        }

        sourceControl.click();
    }

    function handleCloneClick(event) {
        activateCloneControl(event);
    }

    function handleCloneKeydown(event) {
        if (event.key !== 'Enter' && event.key !== ' ') {
            return;
        }

        var target = event.target && event.target.closest ? event.target.closest(CLICKABLE_SELECTOR) : null;

        if (!target) {
            return;
        }

        activateCloneControl(event, target);
    }

    function getVisibleSidebarRight() {
        var sidebars = toArray(document.querySelectorAll('.masterstudy-course-player-curriculum'));
        var right = 0;

        sidebars.forEach(function (sidebar) {
            if (!isVisibleElement(sidebar)) {
                return;
            }

            var rect = sidebar.getBoundingClientRect();

            if (rect.right > 0 && rect.left < (document.documentElement.clientWidth || window.innerWidth || 0)) {
                right = Math.max(right, Math.round(rect.right));
            }
        });

        return right;
    }

    function getAnchorMetrics() {
        var viewportWidth = document.documentElement.clientWidth || window.innerWidth || 0;
        var preferred = [
            '.masterstudy-course-player-lesson',
            '.masterstudy-course-player-content__header',
            '.masterstudy-course-player-content__wrapper'
        ];

        for (var i = 0; i < preferred.length; i += 1) {
            var element = document.querySelector(preferred[i]);

            if (!element || !isVisibleElement(element)) {
                continue;
            }

            var rect = element.getBoundingClientRect();
            var styles = window.getComputedStyle(element);
            var padLeft = parsePx(styles.paddingLeft);
            var padRight = parsePx(styles.paddingRight);
            var left = Math.round(rect.left);
            var right = Math.round(viewportWidth - rect.right);
            var innerPadLeft = 0;
            var innerPadRight = 0;

            if (element.classList.contains('masterstudy-course-player-lesson')) {
                innerPadLeft = padLeft;
                innerPadRight = padRight;
            } else if (element.classList.contains('masterstudy-course-player-content__wrapper')) {
                left = Math.round(rect.left + padLeft);
                right = Math.round(viewportWidth - (rect.right - padRight));
            }

            if (rect.width > 80) {
                return {
                    left: Math.max(0, left),
                    right: Math.max(0, right),
                    padLeft: Math.max(0, Math.round(innerPadLeft)),
                    padRight: Math.max(0, Math.round(innerPadRight))
                };
            }
        }

        return null;
    }

    function applyMetrics(source, shell) {
        if (state.metricRaf) {
            window.cancelAnimationFrame(state.metricRaf);
        }

        state.metricRaf = window.requestAnimationFrame(function () {
            var viewportWidth = document.documentElement.clientWidth || window.innerWidth || 0;
            var root = document.documentElement;

            if (viewportWidth >= DESKTOP_MIN) {
                var metrics = getAnchorMetrics();
                var sidebarRight = getVisibleSidebarRight();

                if (metrics) {
                    if (sidebarRight > 0 && metrics.left < sidebarRight) {
                        metrics.left = sidebarRight;
                    }

                    root.style.setProperty('--bes-lms-final-sticky-left', metrics.left + 'px');
                    root.style.setProperty('--bes-lms-final-sticky-right', metrics.right + 'px');
                    root.style.setProperty('--bes-lms-final-sticky-pad-left', metrics.padLeft + 'px');
                    root.style.setProperty('--bes-lms-final-sticky-pad-right', metrics.padRight + 'px');
                } else if (sidebarRight > 0) {
                    root.style.setProperty('--bes-lms-final-sticky-left', sidebarRight + 'px');
                    root.style.setProperty('--bes-lms-final-sticky-right', '0px');
                    root.style.setProperty('--bes-lms-final-sticky-pad-left', 'clamp(24px, 3vw, 48px)');
                    root.style.setProperty('--bes-lms-final-sticky-pad-right', 'clamp(24px, 3vw, 48px)');
                }
            } else {
                root.style.setProperty('--bes-lms-final-sticky-left', '0px');
                root.style.setProperty('--bes-lms-final-sticky-right', '0px');
                root.style.setProperty('--bes-lms-final-sticky-pad-left', '12px');
                root.style.setProperty('--bes-lms-final-sticky-pad-right', '12px');
            }

            var height = shell ? Math.ceil(shell.getBoundingClientRect().height) : 0;

            if (height > 0) {
                root.style.setProperty('--bes-lms-final-sticky-height', height + 'px');
            }
        });
    }

    function observeSource(source) {
        if (state.source === source && state.sourceObserver) {
            return;
        }

        if (state.sourceObserver) {
            state.sourceObserver.disconnect();
            state.sourceObserver = null;
        }

        state.source = source;

        if (!source || !window.MutationObserver) {
            return;
        }

        state.sourceObserver = new MutationObserver(function (mutations) {
            var meaningful = mutations.some(function (mutation) {
                return mutation.type !== 'attributes' ||
                    !/^data-bes-lms-final-nav-key$|^aria-hidden$|^data-bes-lms-final-source$/.test(mutation.attributeName || '');
            });

            if (meaningful) {
                scheduleRun();
            }
        });

        state.sourceObserver.observe(source, {
            attributes: true,
            childList: true,
            characterData: true,
            subtree: true
        });
    }

    function installStickyNavigation() {
        var source = getSourceNavigation();

        if (!source) {
            return;
        }

        source.classList.add(SOURCE_CLASS);
        source.setAttribute('aria-hidden', 'true');
        source.setAttribute('data-bes-lms-final-source', 'true');

        observeSource(source);

        var shell = getShell();
        var signature = navigationSignature(source);
        var clone = shell.querySelector('.' + CLONE_CLASS);

        if (!clone || state.signature !== signature || state.source !== source) {
            shell.textContent = '';
            clone = source.cloneNode(true);
            scrubClone(clone);
            bridgeControls(source, clone);
            shell.appendChild(clone);
            state.signature = signature;
        } else {
            bridgeControls(source, clone);
        }

        document.body.classList.add(ACTIVE_CLASS);
        applyMetrics(source, shell);
    }

    function suppressGlobalFooter(root) {
        var scope = root && root.querySelectorAll ? root : document;
        var footers = [];

        if (scope.matches && scope.matches(FOOTER_SELECTOR)) {
            footers.push(scope);
        }

        footers = footers.concat(toArray(scope.querySelectorAll(FOOTER_SELECTOR)));

        footers.forEach(function (footer) {
            footer.classList.add('bes-lms-global-footer-suppressed');
            footer.setAttribute('hidden', 'hidden');
            footer.setAttribute('aria-hidden', 'true');
            footer.style.setProperty('display', 'none', 'important');
            footer.style.setProperty('visibility', 'hidden', 'important');
            footer.style.setProperty('height', '0', 'important');
            footer.style.setProperty('overflow', 'hidden', 'important');
        });
    }

    function run() {
        if (!shouldRun()) {
            return;
        }

        suppressGlobalFooter(document);
        installStickyNavigation();
    }

    function scheduleRun() {
        if (state.raf) {
            window.cancelAnimationFrame(state.raf);
        }

        state.raf = window.requestAnimationFrame(run);
    }

    function boot() {
        run();
        window.setTimeout(run, 60);
        window.setTimeout(run, 180);
        window.setTimeout(run, 420);
        window.setTimeout(run, 900);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot, { once: true });
    } else {
        boot();
    }

    window.addEventListener('load', boot, { once: true });
    window.addEventListener('resize', scheduleRun, { passive: true });
    window.addEventListener('orientationchange', boot, { passive: true });
    window.addEventListener('pageshow', boot, { passive: true });

    if (window.ResizeObserver) {
        var resizeObserver = new ResizeObserver(scheduleRun);
        ['.masterstudy-course-player-lesson', '.masterstudy-course-player-content__header', '.masterstudy-course-player-content__wrapper', '.masterstudy-course-player-curriculum'].forEach(function (selector) {
            var element = document.querySelector(selector);

            if (element) {
                resizeObserver.observe(element);
            }
        });
    }

    if (window.MutationObserver) {
        var observer = new MutationObserver(function (mutations) {
            var needsRun = false;

            mutations.forEach(function (mutation) {
                toArray(mutation.addedNodes).forEach(function (node) {
                    if (!node || node.nodeType !== 1) {
                        return;
                    }

                    suppressGlobalFooter(node);

                    if ((node.matches && node.matches(NAV_SELECTOR)) || (node.querySelector && node.querySelector(NAV_SELECTOR))) {
                        needsRun = true;
                    }
                });

                if (mutation.type === 'attributes' && /class|style|data-theme|data-bes-lms-theme/.test(mutation.attributeName || '')) {
                    needsRun = true;
                }
            });

            if (needsRun) {
                scheduleRun();
            } else {
                applyMetrics(state.source, state.shell);
            }
        });

        observer.observe(document.documentElement, {
            attributes: true,
            childList: true,
            subtree: true,
            attributeFilter: ['class', 'style', 'data-theme', 'data-bes-lms-theme']
        });
    }

    var bootTimer = window.setInterval(function () {
        state.bootCount += 1;
        run();

        if (state.bootCount >= 40) {
            window.clearInterval(bootTimer);
        }
    }, 250);
}());
JS;
    }
}

add_action('wp_enqueue_scripts', function (): void {
    if (! function_exists('bes_lms_surgical_should_target') || ! bes_lms_surgical_should_target()) {
        return;
    }

    $handle  = 'bes-lms-final-safe-clone-sticky-navigation';
    $version = '2.0.0';

    wp_register_style($handle, false, [], $version);
    wp_enqueue_style($handle);
    wp_add_inline_style($handle, bes_lms_final_safe_clone_nav_css());

    wp_register_script($handle, '', [], $version, true);
    wp_enqueue_script($handle);
    wp_add_inline_script($handle, bes_lms_final_safe_clone_nav_js(), 'after');
}, PHP_INT_MAX);
