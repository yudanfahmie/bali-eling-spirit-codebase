<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Location & Contact Shortcode (DARK VARIANT)
 * ============================================================================
 * Shortcode: [bes_contact]
 * Design System: v3 Premium Overhaul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_contact', 'bes_render_contact_section' );

function bes_render_contact_section() {
    ob_start();
    ?>
    <section id="contact" class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
        
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-bes-gold/5 rounded-full blur-[150px] pointer-events-none z-0"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-bes-leaf/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="absolute top-0 left-10 right-10 h-[1px] bg-gradient-to-r from-transparent via-white/[0.03] to-transparent pointer-events-none"></div>

        <div class="relative max-w-[1440px] mx-auto grid lg:grid-cols-2 gap-16 lg:gap-24 items-center z-10">

            <div class="pr-0 lg:pr-10">
                <div class="flex items-center gap-3 mb-6 bes-reveal" style="transition-delay: 0.1s;">
                    <span class="w-8 h-[1px] bg-bes-gold/40"></span>
                    <span class="font-body text-[10px] tracking-[0.3em] uppercase font-bold !text-bes-gold/90">The Gateway</span>
                </div>
                
                <h2 class="font-display font-light leading-tight mb-6 text-5xl lg:text-6xl text-bes-ivory bes-reveal" style="transition-delay: 0.2s;">
                    Return to Your<br>
                    <em class="italic !text-bes-gold font-medium">Sacred Home</em>
                </h2>
                
                <p class="font-body text-bes-parchment/60 text-[14.5px] leading-relaxed mb-12 bes-reveal" style="transition-delay: 0.3s;">
                    Hidden within the lush, pulsating heart of Bali’s spiritual epicenter. Surrounded by ancient energetic ley lines and just a breath away from the revered Tirta Empul Holy Spring Temple, our sanctuary is where your ultimate transformation takes root.
                </p>

                <div class="flex flex-col gap-2 mb-12 bes-reveal" style="transition-delay: 0.4s;">
                    
                    <div class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300">
                        <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 shadow-[0_0_15px_rgba(201,168,76,0)] group-hover:shadow-[0_0_15px_rgba(201,168,76,0.3)] flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-sm"></i>
                        </div>
                        <div class="pt-1">
                            <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">The Sanctuary</div>
                            <div class="font-body text-[13.5px] text-bes-parchment/50 leading-relaxed group-hover:!text-bes-parchment/80 transition-colors">Pejeng Kangin, Tampaksiring, Gianyar,<br>Bali 80552, Indonesia</div>
                        </div>
                    </div>

                    <a href="https://wa.me/6287825989117" target="_blank" rel="noopener" class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300 cursor-pointer">
                        <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 shadow-[0_0_15px_rgba(201,168,76,0)] group-hover:shadow-[0_0_15px_rgba(201,168,76,0.3)] flex-shrink-0">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                        </div>
                        <div class="pt-1">
                            <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Direct Counsel</div>
                            <div class="font-body text-[13.5px] text-bes-parchment/50 group-hover:!text-bes-leaf transition-colors">+62 878 2598 9117</div>
                        </div>
                    </a>

                    <a href="mailto:balielingspirit@elinggroup.com" class="group flex items-start gap-5 p-4 -ml-4 rounded-xl hover:bg-white/[0.02] border border-transparent hover:border-white/[0.05] transition-all duration-300 cursor-pointer">
                        <div class="w-12 h-12 rounded-full border border-bes-gold/20 flex items-center justify-center !text-bes-gold group-hover:bg-bes-gold group-hover:!text-bes-forest-deep transition-all duration-500 shadow-[0_0_15px_rgba(201,168,76,0)] group-hover:shadow-[0_0_15px_rgba(201,168,76,0.3)] flex-shrink-0">
                            <i class="fa-solid fa-envelope-open-text text-sm"></i>
                        </div>
                        <div class="pt-1">
                            <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Written Inquiries</div>
                            <div class="font-body text-[13.5px] text-bes-parchment/50 group-hover:!text-bes-gold transition-colors">balielingspirit@elinggroup.com</div>
                        </div>
                    </a>

                </div>

                <div class="flex flex-wrap items-center gap-5 bes-reveal" style="transition-delay: 0.5s;">
                    <a href="https://wa.me/6287825989117" target="_blank" rel="noopener"
                       class="group relative overflow-hidden bg-bes-leaf text-bes-forest-deep font-body text-[11px] font-bold tracking-[0.18em] uppercase px-8 py-4 rounded-xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-[0_4px_20px_rgba(194,210,74,0.15)] hover:shadow-[0_8px_30px_rgba(194,210,74,0.3)] flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span class="relative z-10">Begin Your Journey</span>
                    </a>
                    
                    <a href="mailto:balielingspirit@elinggroup.com"
                       class="group border border-bes-gold/30 !text-bes-gold font-body text-[11px] font-bold tracking-[0.18em] uppercase px-8 py-4 rounded-xl hover:bg-bes-gold hover:!text-bes-forest-deep transition-all duration-500 flex items-center gap-3">
                        <span class="relative z-10">Send Email</span>
                    </a>
                </div>
            </div>

            <div class="relative bes-reveal" style="transition-delay: 0.3s;">
                <div class="absolute -inset-4 bg-bes-leaf/10 blur-3xl rounded-full z-0 pointer-events-none"></div>
                
                <a href="https://maps.google.com/?q=Pasraman+Bali+Eling+Spirit" target="_blank" rel="noopener" class="block relative w-full h-[500px] lg:h-[600px] rounded-[2rem] overflow-hidden group border border-white/[0.05] z-10 shadow-2xl shadow-black/50">
                    
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1000&q=80"
                         alt="Bali Eling Spirit Landscape" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2.5s] ease-out opacity-80 group-hover:opacity-100"/>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/90 via-bes-forest-deep/40 to-transparent transition-opacity duration-700"></div>

                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none pb-20">
                        <div class="relative flex items-center justify-center">
                            <div class="absolute w-24 h-24 rounded-full border border-bes-gold/30 animate-[ping_3s_cubic-bezier(0,0,0.2,1)_infinite]"></div>
                            <div class="absolute w-16 h-16 rounded-full bg-bes-gold/20 animate-pulse"></div>
                            <div class="w-4 h-4 rounded-full bg-bes-gold shadow-[0_0_20px_#C9A84C]"></div>
                        </div>
                    </div>

                    <div class="absolute bottom-6 left-6 right-6 p-1">
                        <div class="relative overflow-hidden rounded-2xl p-6 md:p-8 border border-white/[0.08] backdrop-blur-xl bg-bes-forest-deep/60 group-hover:bg-bes-forest-deep/80 group-hover:-translate-y-2 transition-all duration-500 shadow-xl">
                            <div class="flex flex-col items-center text-center">
                                <h3 class="font-display text-3xl !text-bes-gold mb-1">Ashrama Pejeng</h3>
                                <div class="font-body text-bes-ivory text-[13px] mb-4">Tampaksiring, Gianyar, Bali</div>
                                <div class="w-12 h-[1px] bg-bes-gold/20 mb-4"></div>
                                <div class="font-body text-bes-leaf text-[9px] tracking-[0.2em] uppercase font-bold mb-5">Moments from Tirta Empul Temple</div>
                                
                                <div class="font-body !text-bes-gold text-[10px] tracking-[0.2em] uppercase font-bold flex items-center justify-center gap-2 group/btn">
                                    Open in Google Maps
                                    <i class="fa-solid fa-arrow-right-long text-sm group-hover/btn:translate-x-2 transition-transform duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean();
}