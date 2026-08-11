<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Luxury About Intro
 * ============================================================================
 * * Usage: [bes_about_intro]
 * * UPGRADES:
 * - Expanded, spiritually rich copywriting for a premium feel.
 * - Cinematic image mosaic with an organic gold glow backdrop.
 * - Frosted glass (backdrop-blur) floating quote box.
 * - Enhanced interactive CTA with a contained shine effect and tight SVG chevron.
 * - Safe line-heights applied to prevent custom font cropping.
 */

if ( ! function_exists( 'bes_about_intro_shortcode' ) ) {
    add_shortcode( 'bes_about_intro', 'bes_about_intro_shortcode' );

    function bes_about_intro_shortcode( $atts ) {
        ob_start();
        ?>
        
        <section id="about" class="relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest-deep overflow-hidden">
            
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-bes-gold/5 blur-[120px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/3" aria-hidden="true"></div>

            <div class="relative max-w-[1440px] mx-auto grid lg:grid-cols-12 gap-16 md:gap-20 items-center">

                <div class="lg:col-span-6 relative bes-reveal" style="transition-delay: 0.1s;">
                    <div class="absolute -inset-4 md:-inset-6 border border-bes-gold/10 rounded-2xl z-0 pointer-events-none"></div>
                    
                    <div class="relative z-10 grid grid-cols-2 gap-3 md:gap-5">
                        <div class="row-span-2 rounded-xl overflow-hidden shadow-2xl shadow-black/50 group relative" style="height: 520px;">
                            <div class="absolute inset-0 bg-bes-forest/20 z-10 group-hover:bg-transparent transition-colors duration-700"></div>
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80"
                                 alt="Sacred temple Bali" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out" loading="lazy" />
                        </div>
                        
                        <div class="rounded-xl overflow-hidden shadow-xl shadow-black/40 group relative" style="height: 250px;">
                            <div class="absolute inset-0 bg-bes-forest/20 z-10 group-hover:bg-transparent transition-colors duration-700"></div>
                            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=600&q=80"
                                 alt="Meditation practice" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out" loading="lazy" />
                        </div>
                        
                        <div class="rounded-xl overflow-hidden shadow-xl shadow-black/40 group relative" style="height: 250px;">
                            <div class="absolute inset-0 bg-bes-forest/20 z-10 group-hover:bg-transparent transition-colors duration-700"></div>
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&q=80"
                                 alt="Yoga alignment" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-out" loading="lazy" />
                        </div>

                        <div class="absolute -bottom-8 -right-4 md:-right-8 p-6 md:p-8 max-w-[280px] md:max-w-xs rounded-xl border border-bes-gold/20 shadow-2xl z-20 bes-reveal" 
                             style="background: rgba(21, 30, 16, 0.75); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); transition-delay: 0.4s;">
                            <p class="font-display italic !text-bes-gold text-lg md:text-xl leading-relaxed mb-3">
                                "Yogas citta vrtti nirodhah — Yoga is the stilling of the movements of the mind."
                            </p>
                            <div class="w-8 h-[1px] bg-bes-gold/40 mb-3"></div>
                            <p class="font-body text-[10px] tracking-[0.2em] uppercase text-bes-ivory/50 font-bold">
                                Patañjali Yoga Sūtra I.2
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 flex flex-col pt-10 lg:pt-0 lg:pl-8">
                    
                    <div class="flex items-center gap-4 mb-6 bes-reveal" style="transition-delay: 0.2s;">
                        <span class="w-12 h-[1px] bg-bes-gold"></span>
                        <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">
                            About Our Sanctuary
                        </span>
                    </div>
                    
                    <h2 class="font-display font-medium text-bes-ivory leading-[1.1] mb-8 bes-reveal" style="font-size: clamp(2.8rem, 4vw, 4rem); transition-delay: 0.3s;">
                        Your Divine Sanctuary<br>for Profound <em class="italic !text-bes-gold font-light">Transformation</em>
                    </h2>
                    
                    <div class="space-y-6 font-body text-bes-ivory/60 text-[15px] md:text-base leading-[1.8] font-light bes-reveal" style="transition-delay: 0.4s;">
                        <p>
                            Pasraman Bali Eling Spirit transcends the traditional retreat experience; it is an awakened portal for deep inner alchemy, holistic rebirth, and the luminous discovery of your True Self. Nestled in the spiritual embrace of Bali, we curate a sacred container where ancient yogic sciences, mindful meditation, and the noble path of Dharma converge.
                        </p>
                        <p>
                            Enveloped by the vibrating energy of Pejeng Kangin, Tampaksiring—the untouched cultural heartland of Gianyar—our sanctuary offers a safe haven to pause and realign. Under the compassionate guidance of master spiritual guides Jero Ratni, Aji Bhagawan, and an esteemed lineage of authorized mentors, our teachings are anchored in the authentic Balinese philosophy of <span class="text-bes-ivory font-medium">Tri Hita Karana</span>: the eternal rhythm bridging humanity, the natural world, and the Divine consciousness.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-y-8 gap-x-6 my-10 bes-reveal" style="transition-delay: 0.5s;">
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">Tri Hita</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Karana Philosophy</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">Catur</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Marga Yoga Path</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">11</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">Retreat Programs</div>
                        </div>
                        <div class="border-l-[1.5px] border-bes-gold/30 pl-5">
                            <div class="font-display text-3xl md:text-4xl !text-bes-gold leading-none mb-2">200 / 300H</div>
                            <div class="font-body text-[10px] font-bold tracking-[0.18em] uppercase text-bes-ivory/50">YTT Certified</div>
                        </div>
                    </div>

                    <div class="bes-reveal" style="transition-delay: 0.6s;">
                        <a href="#about-full" class="group relative inline-flex items-center gap-3 border border-bes-gold !text-bes-gold font-body text-[11px] font-bold tracking-[0.2em] uppercase px-8 py-4 rounded-sm overflow-hidden transition-all duration-500 hover:!text-bes-forest hover:border-bes-gold hover:shadow-[0_0_20px_rgba(201,168,76,0.2)] no-underline leading-normal">
                            
                            <span class="absolute inset-0 w-full h-full bg-bes-gold -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] -z-10"></span>
                            
                            <span class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full skew-x-12 group-hover:animate-[shine_1.5s_ease-in-out_infinite] -z-10"></span>
                            
                            <span>Our Story & Vision</span>
                            
                            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <style>
            @keyframes shine {
                100% { transform: translateX(150%) skewX(12deg); }
            }
        </style>

        <?php
        return ob_get_clean();
    }
}
?>