<?php
/**
 * Phase D canonical Eling Sound Healing Course renderer.
 * Target route for Phase F provisioning: /eling-sound-healing-course/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_site_core_render_sound_healing_course' ) ) {
    function bes_site_core_render_sound_healing_course( $atts = array() ) {
        ob_start();
        ?>
        <main class="font-body overflow-hidden">
            <section class="relative min-h-[82vh] flex items-end overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-sound-course-heading">
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[520px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.07),transparent_60%)]"></div>
                    <div class="absolute bottom-0 right-0 w-[500px] h-[360px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.05),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>
                <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
                <div class="relative w-full max-w-[1440px] mx-auto px-6 md:px-10 pt-32 pb-20 md:pb-28">
                    <div class="max-w-3xl">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-5">Academy</p>
                        <h1 id="bes-sound-course-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">Eling Sound Healing Course</h1>
                        <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg leading-relaxed max-w-2xl">Eling Sound Healing Course at Bali Eling Spirit Academy.</p>
                    </div>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section class="bg-bes-parchment py-20 md:py-28" aria-label="Eling Sound Healing Course overview">
                <div class="max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <div class="bes-reveal w-12 h-12 mx-auto rounded-xl border border-bes-sand bg-bes-cream flex items-center justify-center mb-7"><i class="fa-solid fa-wave-square text-bes-olive" aria-hidden="true"></i></div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Eling Sound Healing Course</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Eling Sound Healing Course</h2>
                    <!-- Price, dates, certification, accreditation, faculty, curriculum, booking policy and contact ownership are intentionally not rendered without approved facts. -->
                </div>
            </section>
        </main>
        <?php
        return ob_get_clean();
    }
}

add_shortcode( 'bes_sound_healing_course', 'bes_site_core_render_sound_healing_course' );
