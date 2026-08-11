<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Luxury Trust Bar
 * ============================================================================
 * * Usage: [bes_trust_bar]
 * * UPGRADES:
 * - Converted to an easy-to-use shortcode.
 * - Added ambient radial glow for a cinematic feel.
 * - Integrated `bes-reveal` for staggered fade-in on scroll.
 * - Added interactive hover rings and color transitions.
 * - Refined SVG strokes to inherit Tailwind text colors dynamically.
 */

if ( ! function_exists( 'bes_trust_bar_shortcode' ) ) {
    add_shortcode( 'bes_trust_bar', 'bes_trust_bar_shortcode' );

    function bes_trust_bar_shortcode( $atts ) {
        // Start output buffering
        ob_start();
        ?>
        
        <section class="relative py-12 md:py-16 bg-bes-forest overflow-hidden border-y border-white/[.04]">
            
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-bes-gold/5 blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>
            
            <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-bes-gold/30 to-transparent opacity-60"></div>

            <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
                <div class="flex flex-wrap justify-center items-start gap-10 md:gap-12 lg:gap-16">
                    
                    <div class="bes-reveal flex flex-col items-center text-center gap-4 group w-[130px] md:w-[150px]" style="transition-delay: 0.1s">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold group-hover:scale-110 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_20px_rgba(201,168,76,0.15)] transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="relative z-10">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 group-hover:!text-bes-gold transition-colors duration-300 leading-relaxed">
                            Est. Pejeng Kangin,<br>Bali
                        </span>
                    </div>

                    <div class="bes-reveal flex flex-col items-center text-center gap-4 group w-[130px] md:w-[150px]" style="transition-delay: 0.2s">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold group-hover:scale-110 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_20px_rgba(201,168,76,0.15)] transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="relative z-10">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 group-hover:!text-bes-gold transition-colors duration-300 leading-relaxed">
                            Yoga Alliance Accredited<br>(USA & India)
                        </span>
                    </div>

                    <div class="bes-reveal flex flex-col items-center text-center gap-4 group w-[130px] md:w-[150px]" style="transition-delay: 0.3s">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold group-hover:scale-110 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_20px_rgba(201,168,76,0.15)] transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="relative z-10">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 group-hover:!text-bes-gold transition-colors duration-300 leading-relaxed">
                            1,000+ Lives<br>Transformed
                        </span>
                    </div>

                    <div class="bes-reveal flex flex-col items-center text-center gap-4 group w-[130px] md:w-[150px]" style="transition-delay: 0.4s">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold group-hover:scale-110 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_20px_rgba(201,168,76,0.15)] transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="relative z-10">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 group-hover:!text-bes-gold transition-colors duration-300 leading-relaxed">
                            Authentic Balinese<br>Dharma Teachings
                        </span>
                    </div>

                    <div class="bes-reveal flex flex-col items-center text-center gap-4 group w-[130px] md:w-[150px]" style="transition-delay: 0.5s">
                        <div class="w-14 h-14 rounded-full border border-bes-gold/20 bg-bes-gold/5 flex items-center justify-center !text-bes-gold group-hover:scale-110 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_20px_rgba(201,168,76,0.15)] transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="relative z-10">
                                <circle cx="12" cy="12" r="5"/>
                                <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                            </svg>
                        </div>
                        <span class="font-body text-[9.5px] md:text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 group-hover:!text-bes-gold transition-colors duration-300 leading-relaxed">
                            11 Unique Retreat<br>Programs
                        </span>
                    </div>

                </div>
            </div>
            
            <div class="absolute inset-x-0 bottom-0 h-[1px] bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent opacity-60"></div>
        </section>

        <?php
        return ob_get_clean();
    }
}
?>