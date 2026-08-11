<?php
/**
 * Phase D canonical 100H Yoga Teacher Training renderer.
 * Target route for Phase F provisioning: /bali-eling-spirit-100h/
 * Approved facts currently limited to 100H + Offline / Residential.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_site_core_render_ytt_100h' ) ) {
    function bes_site_core_render_ytt_100h( $atts = array() ) {
        ob_start();
        ?>
        <main class="font-body overflow-hidden">
            <section class="relative min-h-[82vh] flex items-end overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-100h-heading">
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[520px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_60%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>
                <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
                <div class="relative w-full max-w-[1440px] mx-auto px-6 md:px-10 pt-32 pb-20 md:pb-28">
                    <nav class="bes-reveal mb-8" aria-label="Breadcrumb"><a href="/yoga-teacher-training/" class="font-body font-bold text-[10px] uppercase tracking-nav !text-white/30 hover:!text-bes-gold transition-colors">← Yoga Teacher Training</a></nav>
                    <div class="max-w-3xl">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-5">Academy · Yoga Teacher Training</p>
                        <h1 id="bes-ytt-100h-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">100-Hour Yoga Teacher Training</h1>
                        <div class="bes-reveal inline-flex items-center gap-2.5 rounded-full border border-bes-gold/25 bg-bes-gold/[.06] px-5 py-2.5">
                            <i class="fa-solid fa-house-chimney text-bes-gold text-xs" aria-hidden="true"></i>
                            <span class="font-body font-bold text-[10px] uppercase tracking-label text-bes-gold">Offline · Residential</span>
                        </div>
                    </div>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section class="bg-bes-parchment py-20 md:py-28" aria-label="100H program overview">
                <div class="max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">100H Training Path</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-6">Offline Residential Training</h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed">100H Offline / Residential Yoga Teacher Training at Bali Eling Spirit Academy.</p>
                    <!-- Pricing, dates, curriculum, certification, faculty, language and booking policy are intentionally omitted until approved source values are available. -->
                </div>
            </section>
        </main>
        <?php
        return ob_get_clean();
    }
}

add_shortcode( 'bes_ytt_100h_landing', 'bes_site_core_render_ytt_100h' );
