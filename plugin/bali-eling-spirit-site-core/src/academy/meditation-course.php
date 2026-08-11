<?php
/** Phase D adapter for canonical [bes_meditation_course]. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/baseline/meditation-course.php';

if ( ! function_exists( 'bes_site_core_render_meditation_course_phase_d' ) ) {
    function bes_site_core_render_meditation_course_phase_d( $atts ) {
        $html = bes_render_meditation_course( $atts );

        // Repair one malformed legacy tag without changing the existing stage architecture/content.
        return str_replace(
            '<<div class="text-center md:text-right">',
            '<div class="text-center md:text-right">',
            $html
        );
    }
}

remove_shortcode( 'bes_meditation_course' );
add_shortcode( 'bes_meditation_course', 'bes_site_core_render_meditation_course_phase_d' );
