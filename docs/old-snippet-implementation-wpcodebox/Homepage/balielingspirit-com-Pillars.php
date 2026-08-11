<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Luxury Pillars (Tri Hita Karana)
 * ============================================================================
 * * Usage: [bes_pillars]
 * * UPGRADES:
 * - Richer, more evocative copywriting for a profound spiritual tone.
 * - Glassmorphism cards with glowing hover states and vertical lift.
 * - Interconnected visual line behind the pillars to symbolize "harmony".
 * - Staggered entrance animations via `bes-reveal`.
 * - Safe typography line-heights applied.
 */

if ( ! function_exists( 'bes_pillars_shortcode' ) ) {
    add_shortcode( 'bes_pillars', 'bes_pillars_shortcode' );

    function bes_pillars_shortcode( $atts ) {
        ob_start();
        ?>
        
        <section class="relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest overflow-hidden border-t border-white/[.04]">
            
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-bes-leaf/5 blur-[120px] rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2" aria-hidden="true"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-bes-gold/5 blur-[150px] rounded-full pointer-events-none translate-x-1/3 translate-y-1/3" aria-hidden="true"></div>

            <div class="relative max-w-[1440px] mx-auto z-10">
                
                <div class="text-center max-w-2xl mx-auto mb-16 md:mb-24 bes-reveal">
                    <div class="flex items-center justify-center gap-4 mb-6">
                        <span class="w-8 h-[1px] bg-bes-gold/50"></span>
                        <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.25em] uppercase !text-bes-gold">
                            Tri Hita Karana
                        </span>
                        <span class="w-8 h-[1px] bg-bes-gold/50"></span>
                    </div>
                    
                    <h2 class="font-display font-medium text-bes-ivory leading-tight mb-6" style="font-size: clamp(2.4rem, 4vw, 3.6rem);">
                        Three Pillars of <em class="italic !text-bes-gold font-light">Sacred Balance</em>
                    </h2>
                    
                    <p class="font-body text-[15px] text-bes-ivory/60 leading-relaxed font-light">
                        The ancient Balinese philosophy breathing life into every ritual, meditation, and awakening at our sanctuary. True peace is found when these three realms align.
                    </p>
                </div>

                <div class="relative grid lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
                    
                    <div class="hidden lg:block absolute top-[44px] left-[15%] right-[15%] h-[1px] bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent z-0"></div>

                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center transition-all duration-500 hover:-translate-y-2 group bes-reveal" 
                         style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); transition-delay: 0.1s;">
                        
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-b from-bes-gold/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_30px_rgba(201,168,76,0.15)] transition-all duration-500">
                            <div class="absolute inset-2 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" class="!text-bes-gold relative z-10 group-hover:scale-110 transition-transform duration-500">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                            </svg>
                        </div>
                        
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Pawongan</h3>
                        
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Sacred Fellowship</div>
                        
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">
                            Harmony between humans. We hold a profound space for authentic community, compassionate guidance, and soul-to-soul connection that transcends all earthly boundaries.
                        </p>
                    </div>

                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center transition-all duration-500 hover:-translate-y-2 group bes-reveal" 
                         style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); transition-delay: 0.2s;">
                        
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-b from-bes-gold/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_30px_rgba(201,168,76,0.15)] transition-all duration-500">
                            <div class="absolute inset-2 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="!text-bes-gold relative z-10 group-hover:scale-110 transition-transform duration-500">
                                <path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Palemahan</h3>
                        
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Earthly Harmony</div>
                        
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">
                            Harmony with nature. Immerse yourself in practices set amidst vibrating Balinese landscapes, healing rivers, emerald rice terraces, and ancient holy temple grounds.
                        </p>
                    </div>

                    <div class="relative z-10 p-8 md:p-10 rounded-2xl border border-bes-gold/10 text-center transition-all duration-500 hover:-translate-y-2 group bes-reveal" 
                         style="background: rgba(21, 30, 16, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); transition-delay: 0.3s;">
                        
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-b from-bes-gold/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative w-[88px] h-[88px] mx-auto mb-8 flex items-center justify-center rounded-full bg-bes-forest-deep border border-bes-gold/20 group-hover:border-bes-gold/50 group-hover:shadow-[0_0_30px_rgba(201,168,76,0.15)] transition-all duration-500">
                            <div class="absolute inset-2 rounded-full border border-bes-gold/0 group-hover:border-bes-gold/30 group-hover:animate-[spin_4s_linear_infinite] transition-all duration-500"></div>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="!text-bes-gold relative z-10 group-hover:scale-110 transition-transform duration-500">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                        
                        <h3 class="font-display text-2xl md:text-[28px] !text-bes-gold mb-4 font-medium tracking-wide">Parahyangan</h3>
                        
                        <div class="font-body text-[10px] font-bold tracking-[0.2em] uppercase text-bes-ivory/40 mb-5">Divine Communion</div>
                        
                        <p class="font-body text-[14px] text-bes-ivory/60 leading-[1.8] font-light">
                            Harmony with the Divine. Awaken your spirit through sacred rituals, deep Chakra ceremonies, and Dharma teachings that illuminate the path to your highest self.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <?php
        return ob_get_clean();
    }
}
?>