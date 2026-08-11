<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Testimonials Section Shortcode (DARK VARIANT)
 * ============================================================================
 * Shortcode: [bes_testimonials]
 * Design System: v3 Premium Overhaul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_testimonials', 'bes_render_testimonials_section' );

function bes_render_testimonials_section() {
    ob_start();
    ?>
    <section class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-bes-leaf/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="absolute top-0 left-10 right-10 h-[1px] bg-gradient-to-r from-transparent via-white/[0.05] to-transparent pointer-events-none"></div>

        <div class="relative max-w-[1440px] mx-auto z-10">

            <div class="text-center mb-20 md:mb-24 bes-reveal">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="w-8 h-[1px] bg-bes-gold/30"></span>
                    <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold !text-bes-gold/80">Voices of the Sangha</span>
                    <span class="w-8 h-[1px] bg-bes-gold/30"></span>
                </div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                    Echoes of <em class="italic !text-bes-gold font-medium">Awakening</em>
                </h2>
                <p class="font-body text-bes-parchment/60 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    Do not merely take our word. Read the profound reflections of those who have walked the sacred path before you, shedding layers of the past and stepping into their divine truth.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24">

                <div class="group relative p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04] hover:bg-white/[0.04] hover:border-bes-gold/30 hover:shadow-2xl hover:shadow-bes-gold/5 transition-all duration-500 bes-reveal" style="transition-delay: 0.1s;">
                    <span class="absolute -top-4 right-6 font-display text-[120px] text-white/[0.03] group-hover:!text-bes-gold/[0.05] transition-colors duration-500 pointer-events-none leading-none z-0">"</span>
                    
                    <div class="relative z-10">
                        <div class="flex gap-1.5 mb-6">
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                        </div>
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10 group-hover:!text-bes-parchment transition-colors duration-500">
                            "Pengalaman yang sangat luar biasa bisa berada di Pasraman dan mengikuti Tapa Brata 4 hari. Perjalanan yang menyenangkan, teman-teman yang begitu baik dan supportive."
                        </p>
                        <div class="flex items-center gap-4 mt-auto border-t border-white/[0.05] pt-6">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-bes-olive to-bes-forest-92 flex items-center justify-center !text-bes-gold font-display text-xl shadow-inner border border-white/[0.05]">A</div>
                            <div>
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Alumni Tapa Brata</div>
                                <div class="font-body text-[10px] tracking-[0.2em] uppercase text-bes-leaf/70">Bali, Indonesia</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04] hover:bg-white/[0.04] hover:border-bes-gold/30 hover:shadow-2xl hover:shadow-bes-gold/5 transition-all duration-500 bes-reveal" style="transition-delay: 0.2s;">
                    <span class="absolute -top-4 right-6 font-display text-[120px] text-white/[0.03] group-hover:!text-bes-gold/[0.05] transition-colors duration-500 pointer-events-none leading-none z-0">"</span>
                    
                    <div class="relative z-10">
                        <div class="flex gap-1.5 mb-6">
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                        </div>
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10 group-hover:!text-bes-parchment transition-colors duration-500">
                            "I've joined both Healing Retreat & Surya Namaskar — both helped me through my spiritual awakening. The team is dedicated, loving, and deeply knowledgeable."
                        </p>
                        <div class="flex items-center gap-4 mt-auto border-t border-white/[0.05] pt-6">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-bes-olive to-bes-forest-92 flex items-center justify-center !text-bes-gold font-display text-xl shadow-inner border border-white/[0.05]">M</div>
                            <div>
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Monica Wahib</div>
                                <div class="font-body text-[10px] tracking-[0.2em] uppercase text-bes-leaf/70">Healing Retreat Alumni</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative p-8 md:p-10 rounded-2xl bg-white/[0.02] border border-white/[0.04] hover:bg-white/[0.04] hover:border-bes-gold/30 hover:shadow-2xl hover:shadow-bes-gold/5 transition-all duration-500 bes-reveal" style="transition-delay: 0.3s;">
                    <span class="absolute -top-4 right-6 font-display text-[120px] text-white/[0.03] group-hover:!text-bes-gold/[0.05] transition-colors duration-500 pointer-events-none leading-none z-0">"</span>
                    
                    <div class="relative z-10">
                        <div class="flex gap-1.5 mb-6">
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                            <i class="fa-solid fa-star text-[10px] !text-bes-gold"></i>
                        </div>
                        <p class="font-display italic text-xl md:text-2xl text-bes-ivory leading-snug mb-10 group-hover:!text-bes-parchment transition-colors duration-500">
                            "Kelas Tapa Brata yang saya ikuti sangat menakjubkan — sangat membangunkan spiritual saya yang sudah hampir padam. Energi positifnya luar biasa."
                        </p>
                        <div class="flex items-center gap-4 mt-auto border-t border-white/[0.05] pt-6">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-bes-olive to-bes-forest-92 flex items-center justify-center !text-bes-gold font-display text-xl shadow-inner border border-white/[0.05]">R</div>
                            <div>
                                <div class="font-body text-xs font-bold tracking-widest uppercase text-bes-ivory mb-1">Retreat Participant</div>
                                <div class="font-body text-[10px] tracking-[0.2em] uppercase text-bes-leaf/70">Tapa Brata, Bali</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="relative pt-16 border-t border-gradient-to-r from-transparent via-bes-gold/20 to-transparent bes-reveal">
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-bes-gold/30 to-transparent"></div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-6 divide-x divide-white/[0.02]">
                    
                    <div class="text-center group">
                        <div class="font-display text-5xl md:text-6xl !text-bes-gold font-light mb-2 group-hover:scale-110 transition-transform duration-500">1,000<span class="text-3xl md:text-4xl align-top text-bes-leaf">+</span></div>
                        <div class="font-body text-[10px] tracking-[0.25em] uppercase font-bold text-bes-parchment/50 group-hover:!text-bes-ivory transition-colors">Souls Awakened</div>
                    </div>
                    
                    <div class="text-center group">
                        <div class="font-display text-5xl md:text-6xl !text-bes-gold font-light mb-2 group-hover:scale-110 transition-transform duration-500">11</div>
                        <div class="font-body text-[10px] tracking-[0.25em] uppercase font-bold text-bes-parchment/50 group-hover:!text-bes-ivory transition-colors">Sacred Pathways</div>
                    </div>
                    
                    <div class="text-center group border-l border-white/[0.05] lg:border-none">
                        <div class="font-display text-5xl md:text-6xl !text-bes-gold font-light mb-2 group-hover:scale-110 transition-transform duration-500">3</div>
                        <div class="font-body text-[10px] tracking-[0.25em] uppercase font-bold text-bes-parchment/50 group-hover:!text-bes-ivory transition-colors">Global Alliances</div>
                    </div>
                    
                    <div class="text-center group">
                        <div class="font-display text-5xl md:text-6xl !text-bes-gold font-light mb-2 group-hover:scale-110 transition-transform duration-500">4.9<span class="text-3xl md:text-4xl align-top text-bes-leaf">★</span></div>
                        <div class="font-body text-[10px] tracking-[0.25em] uppercase font-bold text-bes-parchment/50 group-hover:!text-bes-ivory transition-colors">Divine Resonance</div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean();
}