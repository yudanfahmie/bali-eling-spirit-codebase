<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Home Content Master Shortcode
 * ============================================================================
 *
 * Shortcode: [bes_home_content]
 *
 * Purpose:
 * - Acts as the main wrapper for the homepage layout.
 * - Sequentially loads individual section shortcodes.
 * - Centralizes homepage rendering logic.
 *
 * Usage:
 * Place [bes_home_content] inside any page or post to render the homepage.
 * ============================================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access
}

/**
 * Register Home Content Shortcode
 */
add_shortcode( 'bes_home_content', 'bes_render_home_content' );

/**
 * Render Home Content
 *
 * @return string
 */
function bes_render_home_content() {

    // Start output buffering
    ob_start();
    ?>

    <main
        id="bes-home-main"
        class="w-full overflow-hidden bg-bes-parchment"
        role="main"
    >

        <?php
        /**
         * ============================================================
         * 1. Hero Section
         * ============================================================
         */
        echo do_shortcode( '[bes_home_hero]' );
        ?>


        <?php
        /**
         * ============================================================
         * 2. Introduction & Trust Elements
         * ============================================================
         */
        echo do_shortcode( '[bes_trust_bar]' );
        echo do_shortcode( '[bes_about_intro]' );
        echo do_shortcode( '[bes_pillars]' );
        ?>


        <?php
        /**
         * ============================================================
         * 3. Programs & Experiences
         * ============================================================
         */
        echo do_shortcode( '[bes_programs]' );
        echo do_shortcode( '[bes_ytt_section]' );
        echo do_shortcode( '[bes_experience]' );
        ?>


        <?php
        /**
         * ============================================================
         * 4. Testimonials & Wisdom
         * ============================================================
         */
        echo do_shortcode( '[bes_testimonials]' );
        ?>

        <?php
        /**
         * ============================================================
         * 5. Blog
         * ============================================================
         */
        echo do_shortcode( '[bes_blog_section]' );
        ?>


        <?php
        /**
         * ============================================================
         * 6. Contact & Call To Action
         * ============================================================
         */
        echo do_shortcode( '[bes_contact]' );
        ?>

        <?php
        /**
         * ============================================================
         * 7. Frequently Ask Questions
         * ============================================================
         */
        echo do_shortcode( '[bes_faqs]' );
        ?>

    </main>

    <?php

    // Return buffered output
    return ob_get_clean();
}