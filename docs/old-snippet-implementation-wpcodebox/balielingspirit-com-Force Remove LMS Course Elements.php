<?php
/**
 * ============================================================================
 * BES — Force Remove LMS Course Elements in All Viewports
 * ============================================================================
 *
 * Target:
 * Every front-end URL under:
 * /courses/
 *
 * Removes from every viewport:
 * #bes-audio-root
 * .whatsapp-widget
 *
 * Strategy:
 * 1. Start an output buffer on targeted course URLs and strip matching element
 *    blocks from the initial HTML when they are rendered server-side.
 * 2. Add an immediate no-media-query CSS guard in <head> to prevent flicker if
 *    a script injects either element before JavaScript removes it.
 * 3. Install an early MutationObserver in <head> and a late footer safety pass
 *    so dynamically injected widgets are removed from the live DOM on desktop,
 *    tablet, and mobile.
 *
 * This snippet replaces the previous responsive-only version.
 * ============================================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_lms_force_remove_elements_should_run' ) ) {
    /**
     * Front-end-only + /courses/ URL guard.
     */
    function bes_lms_force_remove_elements_should_run(): bool {
        if (
            is_admin() ||
            wp_doing_ajax() ||
            wp_doing_cron() ||
            ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ||
            ( defined( 'WP_CLI' ) && WP_CLI )
        ) {
            return false;
        }

        $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
        $path        = wp_parse_url( $request_uri, PHP_URL_PATH );
        $path        = '/' . ltrim( (string) $path, '/' );

        /**
         * Match:
         * /courses
         * /courses/
         * /courses/anything
         */
        return (bool) preg_match( '#^/courses(?:/|$)#i', $path );
    }
}

if ( ! function_exists( 'bes_lms_force_remove_elements_tag_is_target' ) ) {
    /**
     * Decide whether an opening tag belongs to one of the target widgets.
     */
    function bes_lms_force_remove_elements_tag_is_target( string $tag_html ): bool {
        if ( preg_match( '/\bid\s*=\s*(["\'])bes-audio-root\1/i', $tag_html ) ) {
            return true;
        }

        if ( ! preg_match( '/\bclass\s*=\s*(["\'])(.*?)\1/is', $tag_html, $class_match ) ) {
            return false;
        }

        return (bool) preg_match( '/(?:^|\s)whatsapp-widget(?:\s|$)/i', $class_match[2] );
    }
}

if ( ! function_exists( 'bes_lms_force_remove_elements_find_block_end' ) ) {
    /**
     * Find the end offset for a full HTML element block, accounting for nested
     * tags with the same name. Returns null when a safe closing tag is not found.
     */
    function bes_lms_force_remove_elements_find_block_end( string $html, string $tag_name, int $search_from ): ?int {
        $tag_name = preg_quote( $tag_name, '/' );
        $pattern  = '/<\/?' . $tag_name . '\b[^>]*>/i';
        $depth    = 1;
        $offset   = $search_from;

        while ( preg_match( $pattern, $html, $match, PREG_OFFSET_CAPTURE, $offset ) ) {
            $token      = $match[0][0];
            $token_pos  = $match[0][1];
            $token_end  = $token_pos + strlen( $token );
            $is_closing = isset( $token[1] ) && '/' === $token[1];
            $is_self    = preg_match( '/\/\s*>$/', $token );

            if ( $is_closing ) {
                $depth--;

                if ( 0 === $depth ) {
                    return $token_end;
                }
            } elseif ( ! $is_self ) {
                $depth++;
            }

            $offset = $token_end;
        }

        return null;
    }
}

if ( ! function_exists( 'bes_lms_force_remove_elements_strip_html' ) ) {
    /**
     * Strip target element blocks from initial HTML. This is intentionally scoped
     * to targeted course URLs only and keeps the rest of the document untouched.
     */
    function bes_lms_force_remove_elements_strip_html( string $html ): string {
        if ( '' === $html || false === stripos( $html, 'bes-audio-root' ) && false === stripos( $html, 'whatsapp-widget' ) ) {
            return $html;
        }

        $open_tag_pattern = '/<([a-z][a-z0-9:-]*)\b[^>]*(?:\bid\s*=\s*(["\'])bes-audio-root\2|\bclass\s*=\s*(["\'])[^"\']*(?:^|\s)whatsapp-widget(?:\s|$)[^"\']*\3)[^>]*>/i';
        $offset           = 0;

        while ( preg_match( $open_tag_pattern, $html, $match, PREG_OFFSET_CAPTURE, $offset ) ) {
            $open_tag   = $match[0][0];
            $start      = $match[0][1];
            $tag_name   = strtolower( $match[1][0] );
            $open_end   = $start + strlen( $open_tag );
            $is_void    = (bool) preg_match( '/^(area|base|br|col|embed|hr|img|input|link|meta|param|source|track|wbr)$/i', $tag_name );
            $is_self    = (bool) preg_match( '/\/\s*>$/', $open_tag );
            $remove_end = ( $is_void || $is_self ) ? $open_end : bes_lms_force_remove_elements_find_block_end( $html, $tag_name, $open_end );

            if ( null === $remove_end ) {
                $offset = $open_end;
                continue;
            }

            $html   = substr_replace( $html, '', $start, $remove_end - $start );
            $offset = max( 0, $start - 1 );
        }

        return $html;
    }
}

if ( ! function_exists( 'bes_lms_force_remove_elements_start_buffer' ) ) {
    /**
     * Server-side strip pass for static HTML output.
     */
    function bes_lms_force_remove_elements_start_buffer(): void {
        if ( ! bes_lms_force_remove_elements_should_run() ) {
            return;
        }

        ob_start( 'bes_lms_force_remove_elements_strip_html' );
    }
}
add_action( 'template_redirect', 'bes_lms_force_remove_elements_start_buffer', 0 );

if ( ! function_exists( 'bes_lms_force_remove_elements_hide_css' ) ) {
    /**
     * No media query. This applies to desktop, tablet, and mobile.
     */
    function bes_lms_force_remove_elements_hide_css(): void {
        if ( ! bes_lms_force_remove_elements_should_run() ) {
            return;
        }
        ?>
        <style id="bes-lms-force-remove-elements-css">
            #bes-audio-root,
            .whatsapp-widget {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                pointer-events: none !important;
                width: 0 !important;
                height: 0 !important;
                max-width: 0 !important;
                max-height: 0 !important;
                min-width: 0 !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                border: 0 !important;
                overflow: hidden !important;
                clip-path: inset(50%) !important;
                transform: scale(0) !important;
            }
        </style>
        <?php
    }
}
add_action( 'wp_head', 'bes_lms_force_remove_elements_hide_css', 0 );

if ( ! function_exists( 'bes_lms_force_remove_elements_head_js' ) ) {
    /**
     * Early live-DOM removal. This catches elements inserted after <head> starts.
     */
    function bes_lms_force_remove_elements_head_js(): void {
        if ( ! bes_lms_force_remove_elements_should_run() ) {
            return;
        }
        ?>
        <script id="bes-lms-force-remove-elements-head-js">
            (function () {
                'use strict';

                if (window.__besLmsForceRemoveCourseElements) {
                    return;
                }

                window.__besLmsForceRemoveCourseElements = true;

                var selector = '#bes-audio-root, .whatsapp-widget';
                var observer = null;
                var sweepTimer = null;
                var sweepCount = 0;
                var maxSweeps = 90;

                function removeElement(el) {
                    if (!el || !el.parentNode) {
                        return;
                    }

                    el.setAttribute('aria-hidden', 'true');
                    el.remove();
                }

                function removeFrom(root) {
                    root = root || document;

                    if (!root) {
                        return;
                    }

                    if (root.nodeType === 1 && root.matches && root.matches(selector)) {
                        removeElement(root);
                        return;
                    }

                    if (!root.querySelectorAll) {
                        return;
                    }

                    root.querySelectorAll(selector).forEach(removeElement);
                }

                function sweep() {
                    removeFrom(document);
                }

                function observe() {
                    var target = document.documentElement || document.body;

                    if (!target || observer) {
                        return;
                    }

                    observer = new MutationObserver(function (mutations) {
                        mutations.forEach(function (mutation) {
                            mutation.addedNodes.forEach(function (node) {
                                removeFrom(node);
                            });
                        });

                        sweep();
                    });

                    observer.observe(target, {
                        childList: true,
                        subtree: true
                    });
                }

                function startSweepWindow() {
                    if (sweepTimer) {
                        return;
                    }

                    sweepTimer = window.setInterval(function () {
                        sweepCount += 1;
                        sweep();

                        if (sweepCount >= maxSweeps) {
                            window.clearInterval(sweepTimer);
                            sweepTimer = null;
                        }
                    }, 250);
                }

                sweep();
                observe();
                startSweepWindow();

                document.addEventListener('DOMContentLoaded', function () {
                    sweep();
                    observe();
                    startSweepWindow();
                });

                window.addEventListener('load', function () {
                    sweep();
                    startSweepWindow();
                });
            })();
        </script>
        <?php
    }
}
add_action( 'wp_head', 'bes_lms_force_remove_elements_head_js', 1 );

if ( ! function_exists( 'bes_lms_force_remove_elements_footer_js' ) ) {
    /**
     * Late fallback. Useful for widgets injected after footer scripts run.
     */
    function bes_lms_force_remove_elements_footer_js(): void {
        if ( ! bes_lms_force_remove_elements_should_run() ) {
            return;
        }
        ?>
        <script id="bes-lms-force-remove-elements-footer-js">
            (function () {
                'use strict';

                var selector = '#bes-audio-root, .whatsapp-widget';

                function removeTargets() {
                    document.querySelectorAll(selector).forEach(function (el) {
                        el.setAttribute('aria-hidden', 'true');
                        el.remove();
                    });
                }

                removeTargets();
                window.setTimeout(removeTargets, 50);
                window.setTimeout(removeTargets, 250);
                window.setTimeout(removeTargets, 1000);
            })();
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'bes_lms_force_remove_elements_footer_js', 999 );
