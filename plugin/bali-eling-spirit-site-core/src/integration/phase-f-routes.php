<?php
/**
 * Phase F cross-module route reconciliation.
 *
 * Keeps historical implementations intact while making the staged homepage
 * output resolve to the final canonical destinations selected in Phase F.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_site_core_phase_f_reconcile_urls' ) ) {
    function bes_site_core_phase_f_reconcile_urls( $html ) {
        return strtr(
            (string) $html,
            array(
                '/program-bahasa-indonesia/' => '/eling-tapa-brata/',
                '/meditation-course/' => '/yoga-teacher-training/eling-meditation-course/',
            )
        );
    }
}

if ( ! function_exists( 'bes_site_core_phase_f_render_homepage' ) ) {
    function bes_site_core_phase_f_render_homepage( $atts = array() ) {
        if ( ! function_exists( 'bes_site_core_render_homepage_batch_b' ) ) {
            return '';
        }

        return bes_site_core_phase_f_reconcile_urls( bes_site_core_render_homepage_batch_b( $atts ) );
    }
}

remove_shortcode( 'bes_home_content_v2' );
remove_shortcode( 'bes_home_content' );
add_shortcode( 'bes_home_content_v2', 'bes_site_core_phase_f_render_homepage' );
add_shortcode( 'bes_home_content', 'bes_site_core_phase_f_render_homepage' );

if ( ! function_exists( 'bes_site_core_phase_f_footer' ) ) {
    function bes_site_core_phase_f_footer() {
        if ( ! function_exists( 'bes_site_core_batch_b_footer' ) ) {
            return;
        }

        ob_start();
        bes_site_core_batch_b_footer();
        $footer = ob_get_clean();
        echo bes_site_core_phase_f_reconcile_urls( $footer ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

if ( ! function_exists( 'bes_site_core_phase_f_prepare_footer_routes' ) ) {
    function bes_site_core_phase_f_prepare_footer_routes() {
        if ( ! function_exists( 'bes_site_core_batch_b_footer' ) ) {
            return;
        }

        remove_action( 'wp_footer', 'bes_site_core_batch_b_footer', 10 );
        add_action( 'wp_footer', 'bes_site_core_phase_f_footer', 10 );
    }
}
add_action( 'wp', 'bes_site_core_phase_f_prepare_footer_routes', 100 );
