<?php
/**
 * Phase D adapter for [bes_ytt_50h_hybrid_landing].
 * The baseline remains intact; only the disputed language assertion is gated.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/baseline/ytt-50h-hybrid.php';

if ( ! function_exists( 'bes_site_core_render_ytt_50h_hybrid_phase_d' ) ) {
    function bes_site_core_render_ytt_50h_hybrid_phase_d( $atts ) {
        $html = bes_render_ytt_50h_hybrid( $atts );

        // DATA GATE: source conflict (Bahasa Indonesia vs Bahasa Indonesia / English).
        // Remove only the explicit language line; all other baseline content stays unchanged.
        $html = preg_replace(
            '#<p class="font-body font-bold text-\[9px\] uppercase tracking-nav text-bes-sage/70">\s*Taught in Bahasa Indonesia\s*</p>#',
            '<!-- DATA GATE: 50H Hybrid language pending final confirmation. -->',
            $html,
            1
        );

        return is_string( $html ) ? $html : bes_render_ytt_50h_hybrid( $atts );
    }
}

remove_shortcode( 'bes_ytt_50h_hybrid_landing' );
add_shortcode( 'bes_ytt_50h_hybrid_landing', 'bes_site_core_render_ytt_50h_hybrid_phase_d' );
