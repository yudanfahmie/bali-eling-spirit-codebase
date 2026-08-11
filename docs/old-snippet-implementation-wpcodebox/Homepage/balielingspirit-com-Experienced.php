<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — The Experience Section Shortcode (DARK VARIANT)
 * ============================================================================
 * Shortcode: [bes_experience]
 * Design System: v3 Premium Overhaul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_experience', 'bes_render_experience_section' );

function bes_render_experience_section() {
    ob_start();
    ?>
    <section class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>

        <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position: center top; filter: invert(1);"></div>

        <div class="relative max-w-[1440px] mx-auto">

            <div class="text-center mb-20 md:mb-28 bes-reveal">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                    <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">The Sacred Journey</span>
                    <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                </div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                    A Symphony of Spiritual Awakening <br class="hidden md:block">
                    <em class="italic !text-bes-gold font-medium">at Bali Eling Spirit</em>
                </h2>
                <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    Step beyond the veil of the mundane. Each breath, ritual, and dawn is meticulously curated to dissolve energetic blockages, awaken dormant prana, and honor your profound journey of self-transformation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16 lg:gap-y-24">

                <div class="group relative bes-reveal" style="transition-delay: 0.1s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">01</span>
                    
                    <div class="relative z-10">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=800&q=80"
                                 alt="Sunrise yoga over Balinese rice terraces" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Awaken the Prana:<br>Sunrise Hatha Yoga</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                As the first golden light kisses the dew-drenched rice terraces, surrender to the ancient rhythms of Balinese Hatha. Through guided pranayama and intentional asana, align your physical vessel with the awakening earth, cultivating profound inner stillness.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative bes-reveal" style="transition-delay: 0.2s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">02</span>
                    
                    <div class="relative z-10 pt-0 lg:pt-12">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=800&q=80"
                                 alt="Meditation and singing bowls" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:-rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Cellular Harmony:<br>Soundscapes & Stillness</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                Bathe in the ethereal frequencies of antique Tibetan singing bowls and sacred Balinese mantras. This immersive acoustic therapy dissolves energetic blockages, releasing deep-seated trauma and harmonizing your cellular vibration back to its divine state.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative bes-reveal" style="transition-delay: 0.3s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">03</span>
                    
                    <div class="relative z-10">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80"
                                 alt="Balinese Melukat water purification" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">The Water Cleansing:<br>Sacred Melukat Ritual</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                Step into UNESCO heritage sanctuaries veiled in incense and ancient chants. Under the guidance of authentic Mangku (priests), immerse yourself in holy spring waters—washing away karmic residue and inviting pure, unadulterated spiritual rebirth.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative bes-reveal" style="transition-delay: 0.1s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">04</span>
                    
                    <div class="relative z-10">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80"
                                 alt="Sattvic plant based wellness food" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Divine Nourishment:<br>Sattvic Gastronomy</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                Elevate your detox journey with our farm-to-temple culinary philosophy. Indulge in vibrant, plant-based masterpieces crafted from organic local harvests—specifically designed to purify the blood, ignite your <em>agni</em> (digestive fire), and nourish the soul.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative bes-reveal" style="transition-delay: 0.2s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">05</span>
                    
                    <div class="relative z-10 pt-0 lg:pt-12">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800&q=80"
                                 alt="Private spiritual consultation" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:-rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">Ancestral Whispers:<br>Private Master Counsel</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                Unlock the map of your unique dharma. Sit in quiet reverence with our esteemed lineage holders—Jero Ratni or Aji Bhagawan—for a deeply personalized transmission of wisdom, spiritual clairvoyance, and actionable life guidance.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative bes-reveal" style="transition-delay: 0.3s;">
                    <span class="absolute -top-12 -left-4 font-display text-8xl md:text-9xl !text-bes-gold opacity-[0.04] group-hover:opacity-[0.08] transition-opacity duration-700 pointer-events-none z-0">06</span>
                    
                    <div class="relative z-10">
                        <div class="overflow-hidden mb-6 rounded-t-full rounded-b-md shadow-2xl shadow-black/40 aspect-[4/5] border border-white/[0.02]">
                            <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?w=800&q=80"
                                 alt="Balinese spa and bodywork" 
                                 class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-[1.5s] ease-out opacity-90 group-hover:opacity-100"/>
                            <div class="absolute inset-0 bg-bes-forest-deep/40 group-hover:bg-transparent transition-colors duration-700"></div>
                        </div>
                        <div class="border-l-2 border-bes-gold/20 pl-5 ml-2 group-hover:border-bes-leaf transition-colors duration-500">
                            <h3 class="font-display text-2xl lg:text-3xl text-bes-ivory mb-3 group-hover:!text-bes-leaf transition-colors">The Sacred Touch:<br>Balinese Alchemy Spa</h3>
                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed">
                                Honor your body as a divine temple. Surrender to the hands of master therapists in a transcendental bodywork session. Utilizing warm, botanical-infused oils and ancient acupressure, release physical tension and awaken dormant life-force energy.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}