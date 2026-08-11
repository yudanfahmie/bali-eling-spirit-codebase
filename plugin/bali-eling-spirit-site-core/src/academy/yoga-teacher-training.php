<?php
/**
 * Phase D adapter for the canonical [bes_yoga_teacher_training] Academy landing.
 * Keeps the legacy BES v3 renderer intact and replaces only its primary roadmap
 * with the approved six-program catalog.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/baseline/yoga-teacher-training.php';

if ( ! function_exists( 'bes_site_core_render_ytt_catalog_phase_d' ) ) {
    function bes_site_core_render_ytt_catalog_phase_d() {
        $programs = array(
            array(
                'label'  => '50H Hybrid',
                'format' => 'Hybrid',
                'route'  => '/bali-eling-spirit-50h-hybrid/',
                'accent' => 'bes-sage',
                'icon'   => 'fa-solid fa-laptop-house',
            ),
            array(
                'label'  => '50H Offline',
                'format' => 'Offline',
                'route'  => '/bali-eling-spirit-50h/',
                'accent' => 'bes-leaf',
                'icon'   => 'fa-solid fa-seedling',
            ),
            array(
                'label'  => '100H Offline / Residential',
                'format' => 'Offline · Residential',
                'route'  => '/bali-eling-spirit-100h/',
                'accent' => 'bes-gold',
                'icon'   => 'fa-solid fa-house-chimney',
            ),
            array(
                'label'  => '200H Hybrid',
                'format' => 'Hybrid',
                'route'  => '/bali-eling-spirit-200h-hybrid/',
                'accent' => 'bes-moss',
                'icon'   => 'fa-solid fa-laptop-file',
            ),
            array(
                'label'  => '200H Offline',
                'format' => 'Offline',
                'route'  => '/bali-eling-spirit-200h/',
                'accent' => 'bes-leaf',
                'icon'   => 'fa-solid fa-person-praying',
            ),
            array(
                'label'  => '300H Offline',
                'format' => 'Offline',
                'route'  => '/program/300-hour-yoga-teacher-training/',
                'accent' => 'bes-gold',
                'icon'   => 'fa-solid fa-award',
            ),
        );

        ob_start();
        ?>
        <section id="bes-ytt-roadmap" class="bg-bes-cream py-20 md:py-28" aria-label="Yoga Teacher Training catalog">
            <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                <div class="text-center mb-14">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Choose Your Training Path</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Yoga Teacher Training</h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-2xl mx-auto mt-4 leading-relaxed">Explore the approved Bali Eling Spirit training catalog and continue to the dedicated program surface for details.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                    <?php foreach ( $programs as $program ) : ?>
                        <article class="bes-reveal group rounded-2xl border border-bes-sand overflow-hidden bg-bes-ivory hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5 transition-all duration-300 flex flex-col">
                            <div class="h-[3px] bg-gradient-to-r from-<?php echo esc_attr( $program['accent'] ); ?> to-transparent" aria-hidden="true"></div>
                            <div class="p-6 md:p-7 flex flex-col flex-1 min-h-[250px]">
                                <div class="w-11 h-11 rounded-xl border border-bes-sand bg-bes-cream flex items-center justify-center mb-7">
                                    <i class="<?php echo esc_attr( $program['icon'] ); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                                </div>
                                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-moss mb-2"><?php echo esc_html( $program['format'] ); ?></p>
                                <h3 class="font-display font-medium text-bes-bark text-2xl leading-tight mb-6"><?php echo esc_html( $program['label'] ); ?></h3>
                                <a href="<?php echo esc_url( home_url( $program['route'] ) ); ?>" class="mt-auto inline-flex items-center justify-between gap-3 border border-bes-forest/[.08] rounded-xl px-5 py-3.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted hover:bg-bes-forest hover:!text-bes-leaf transition-all duration-300">
                                    <span>View Program</span><i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- DATA GATE: 50H Hybrid language remains intentionally absent from the catalog until final source confirmation. -->
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}

if ( ! function_exists( 'bes_site_core_render_ytt_phase_d' ) ) {
    function bes_site_core_render_ytt_phase_d( $atts ) {
        $baseline = bes_render_ytt( $atts );
        $needle   = '<section id="bes-ytt-roadmap" class="bg-bes-cream py-20 md:py-28" aria-label="Training roadmap">';

        if ( false === strpos( $baseline, $needle ) ) {
            return $baseline;
        }

        $legacy = '<section id="bes-ytt-roadmap-legacy" class="hidden bg-bes-cream py-20 md:py-28" aria-label="Legacy training roadmap" data-bes-soft-deleted="legacy-ytt-roadmap">';
        return str_replace( $needle, bes_site_core_render_ytt_catalog_phase_d() . $legacy, $baseline );
    }
}

remove_shortcode( 'bes_yoga_teacher_training' );
add_shortcode( 'bes_yoga_teacher_training', 'bes_site_core_render_ytt_phase_d' );
