<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Luxury Programs Grid
 * ============================================================================
 * * Usage: [bes_programs]
 * * UPGRADES:
 * - Profound, soul-stirring copywriting for every program.
 * - Cinematic image zoom and overlay-fade on hover (`group` mechanics).
 * - "Most Transformative" tag features a glowing, animated sweeping light.
 * - Advanced interactive CTA buttons with directional hover mechanics.
 * - Daily Programs box transformed into a frosted-glass luxury panel.
 */

if ( ! function_exists( 'bes_programs_shortcode' ) ) {
    add_shortcode( 'bes_programs', 'bes_programs_shortcode' );

    function bes_programs_shortcode( $atts ) {
        ob_start();
        ?>
        
        <section id="programs" class="relative py-24 md:py-32 px-6 lg:px-10 bg-bes-forest-deep overflow-hidden">
            
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-bes-gold/5 blur-[150px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/3" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-bes-leaf/5 blur-[120px] rounded-full pointer-events-none -translate-x-1/2 translate-y-1/2" aria-hidden="true"></div>

            <div class="relative max-w-[1440px] mx-auto z-10">

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-16 md:mb-20 bes-reveal">
                    <div class="max-w-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="w-12 h-[1px] bg-bes-gold"></span>
                            <span class="font-body text-[10px] md:text-xs font-bold tracking-[0.28em] uppercase !text-bes-gold">
                                Curated Programs
                            </span>
                        </div>
                        <h2 class="font-display font-medium text-bes-ivory leading-[1.1]" style="font-size: clamp(2.8rem, 4vw, 4rem);">
                            Healing &amp; Retreat<br>
                            <em class="italic !text-bes-gold font-light">Awakenings</em>
                        </h2>
                    </div>
                    <div class="lg:max-w-md lg:pb-3">
                        <p class="font-body text-[15px] text-bes-ivory/60 leading-relaxed font-light">
                            Step into a sacred vessel of profound transformation. Each journey is meticulously designed to dissolve energetic blockages, restore spiritual equilibrium, and realign your body, mind, and soul with the Divine source.
                        </p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-5 gap-6 md:gap-8 mb-6 md:mb-8">
                    
                    <div class="lg:col-span-3 relative rounded-2xl overflow-hidden group shadow-2xl shadow-black/50 bes-reveal" style="min-height: 480px; transition-delay: 0.1s;">
                        
                        <div class="absolute inset-0 bg-bes-forest z-10 group-hover:bg-transparent transition-colors duration-[1s]"></div>
                        <img src="https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?w=1200&q=80"
                             alt="Tapa Brata Meditation" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s] ease-out"/>
                        
                        <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.95) 0%, rgba(21, 30, 16, 0.6) 40%, transparent 80%);"></div>
                        
                        <div class="absolute inset-0 z-30 p-8 md:p-12 flex flex-col justify-end">
                            
                            <div class="mb-4">
                                <span class="inline-block border border-bes-gold/30 bg-bes-forest/40 backdrop-blur-md px-3 py-1.5 font-body text-[9px] font-bold tracking-[0.2em] uppercase !text-bes-gold rounded-sm">
                                    4 Days · 3 Nights · Deep Immersive
                                </span>
                            </div>
                            
                            <h3 class="font-display text-4xl md:text-[42px] text-bes-ivory mb-4 font-medium leading-none">Tapa Brata</h3>
                            
                            <p class="font-body text-[14px] text-bes-ivory/70 leading-[1.8] mb-6 max-w-xl font-light">
                                A profound vessel for healing deep emotional wounds, generational trauma, and anxiety. Anchored in ancestral Balinese traditions and elevated by modern awareness. Experience rigorous 7-Chakra activation, Kundalini awakening, threefold daily meditations, and intimate spiritual counsel.
                            </p>
                            
                            <div class="flex flex-wrap gap-x-4 gap-y-2 mb-8 items-center">
                                <span class="font-body text-[9px] font-bold tracking-widest uppercase text-bes-leaf">7-Chakra Purge</span>
                                <span class="text-bes-leaf/50">·</span>
                                <span class="font-body text-[9px] font-bold tracking-widest uppercase text-bes-leaf">Vibrational Sound</span>
                                <span class="text-bes-leaf/50">·</span>
                                <span class="font-body text-[9px] font-bold tracking-widest uppercase text-bes-leaf">Karmic Detox</span>
                                <span class="text-bes-leaf/50">·</span>
                                <span class="font-body text-[9px] font-bold tracking-widest uppercase text-bes-leaf">Soul Counsel</span>
                            </div>
                            
                            <a href="https://wa.me/6281228888873" target="_blank" class="group/btn relative inline-flex items-center gap-3 border border-bes-gold !text-bes-gold font-body text-[11px] font-bold tracking-[0.2em] uppercase px-8 py-4 rounded-sm overflow-hidden transition-all duration-500 hover:!text-bes-forest hover:border-bes-gold w-fit">
                                <span class="absolute inset-0 w-full h-full bg-bes-gold -translate-x-full group-hover/btn:translate-x-0 transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] -z-10"></span>
                                <span>Enquire Now</span>
                                <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1 transition-transform duration-300" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="absolute top-6 left-6 z-30 border border-bes-gold/40 px-4 py-2 overflow-hidden" style="background: rgba(21, 30, 16, 0.85); backdrop-filter: blur(8px);">
                            <span class="absolute inset-0 w-[200%] h-full bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent -translate-x-full animate-[shimmer_3s_infinite] pointer-events-none"></span>
                            <span class="font-body text-[9px] font-bold tracking-[0.25em] uppercase !text-bes-gold relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-star text-[8px]"></i> Most Transformative
                            </span>
                        </div>
                    </div>

                    <div class="lg:col-span-2 flex flex-col gap-6 md:gap-8">
                        
                        <div class="relative rounded-2xl overflow-hidden group flex-1 shadow-xl shadow-black/40 bes-reveal" style="min-height: 230px; transition-delay: 0.2s;">
                            <div class="absolute inset-0 bg-bes-forest/80 z-10 group-hover:bg-transparent transition-colors duration-[1s]"></div>
                            <img src="https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=800&q=80"
                                 alt="Eling Sanctuary Retreat" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out"/>
                            <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.95) 0%, transparent 70%);"></div>
                            
                            <div class="absolute inset-0 z-30 p-6 flex flex-col justify-end">
                                <div class="mb-2">
                                    <span class="inline-block border border-bes-gold/20 bg-bes-forest/40 backdrop-blur-md px-2.5 py-1 font-body text-[8px] font-bold tracking-[0.2em] uppercase text-white/70 rounded-sm">6 Days · 5 Nights</span>
                                </div>
                                <h3 class="font-display text-2xl md:text-[28px] text-bes-ivory mb-2 font-medium">Eling Sanctuary Retreat</h3>
                                <p class="font-body text-[12px] text-bes-ivory/60 leading-[1.7] mb-4 font-light">
                                    Step into absolute mindfulness. Immerse yourself in guided Vipassana, walking meditations in lush nature, and sacred breathwork to awaken pure consciousness.
                                </p>
                                <a href="https://wa.me/6281228888873" target="_blank" class="font-body text-[9px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit group/link">
                                    Discover Journey <span class="transform group-hover/link:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden group flex-1 shadow-xl shadow-black/40 bes-reveal" style="min-height: 230px; transition-delay: 0.3s;">
                            <div class="absolute inset-0 bg-bes-forest/80 z-10 group-hover:bg-transparent transition-colors duration-[1s]"></div>
                            <img src="https://images.unsplash.com/photo-1545389336-cf090694435e?w=800&q=80"
                                 alt="Healing Retreat" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out"/>
                            <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.95) 0%, transparent 70%);"></div>
                            
                            <div class="absolute inset-0 z-30 p-6 flex flex-col justify-end">
                                <div class="mb-2">
                                    <span class="inline-block border border-bes-gold/20 bg-bes-forest/40 backdrop-blur-md px-2.5 py-1 font-body text-[8px] font-bold tracking-[0.2em] uppercase text-white/70 rounded-sm">5 Hours · Day Program</span>
                                </div>
                                <h3 class="font-display text-2xl md:text-[28px] text-bes-ivory mb-2 font-medium">Healing Retreat</h3>
                                <p class="font-body text-[12px] text-bes-ivory/60 leading-[1.7] mb-4 font-light">
                                    A potent half-day immersion. Through pranayama detox and emotional release therapy, shed toxic frequencies and return home vibrating with pure light.
                                </p>
                                <a href="#" class="font-body text-[9px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit group/link">
                                    Discover Journey <span class="transform group-hover/link:translate-x-1 transition-transform">→</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="hidden md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-16 md:mb-20">
                    
                    <?php 
                    $sub_programs = [
                        [
                            'img'   => 'https://images.unsplash.com/photo-1536623975707-c4b3b2af565d?w=600&q=80',
                            'badge' => 'Rebirth Ceremony',
                            'title' => 'Punarbawa',
                            'desc'  => 'A profound cellular-level rebirth. Sever ancestral trauma loops, heal past-life wounds, and realign seamlessly with your highest soul purpose.',
                            'delay' => '0.1s'
                        ],
                        [
                            'img'   => 'https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=600&q=80',
                            'badge' => 'Deep Soul Quest',
                            'title' => 'Atma Retreat',
                            'desc'  => 'Descend into the absolute core of the self—the Atman. Features advanced prolonged silence, sensory withdrawal, and the sacred Agni Hotra fire rite.',
                            'delay' => '0.2s'
                        ],
                        [
                            'img'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&q=80',
                            'badge' => 'Mindful Awakening',
                            'title' => 'Eling Retreat',
                            'desc'  => '‘Eling’ signifies absolute awareness. A gentle yet profound return to the present moment via conscious breathwork, walking meditation, and Dharma teachings.',
                            'delay' => '0.3s'
                        ],
                        [
                            'img'   => 'https://images.unsplash.com/photo-1616699002805-0741e1e4a9c5?w=600&q=80',
                            'badge' => 'Energy Cleansing',
                            'title' => '7-Chakra Rite',
                            'desc'  => 'The sacred Pelukatan ceremony. Submerge in holy waters while ancient mantras dissolve energetic stagnation, realigning your 7 spiritual wheels.',
                            'delay' => '0.4s'
                        ]
                    ];

                    foreach ($sub_programs as $p) : ?>
                    <div class="relative rounded-2xl overflow-hidden group shadow-xl shadow-black/40 bes-reveal" style="min-height: 340px; transition-delay: <?php echo $p['delay']; ?>;">
                        <div class="absolute inset-0 bg-bes-forest/80 z-10 group-hover:bg-transparent transition-colors duration-[1s]"></div>
                        <img src="<?php echo $p['img']; ?>" alt="<?php echo $p['title']; ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out"/>
                        <div class="absolute inset-0 z-20 pointer-events-none" style="background: linear-gradient(to top, rgba(21, 30, 16, 0.95) 0%, transparent 60%);"></div>
                        
                        <div class="absolute inset-0 z-30 p-6 flex flex-col justify-end transform transition-transform duration-500 group-hover:translate-y-[-8px]">
                            <div class="mb-3">
                                <span class="inline-block border border-bes-gold/20 bg-bes-forest/40 backdrop-blur-md px-2.5 py-1 font-body text-[8px] font-bold tracking-[0.2em] uppercase text-white/70 rounded-sm"><?php echo $p['badge']; ?></span>
                            </div>
                            <h3 class="font-display text-[26px] text-bes-ivory mb-2 font-medium"><?php echo $p['title']; ?></h3>
                            <p class="font-body text-[12px] text-bes-ivory/60 leading-[1.7] mb-4 font-light opacity-90 group-hover:opacity-100 transition-opacity">
                                <?php echo $p['desc']; ?>
                            </p>
                            <a href="#" class="font-body text-[9px] font-bold tracking-[0.2em] uppercase !text-bes-gold hover:!text-bes-ivory transition-colors flex items-center gap-2 w-fit group/link">
                                Explore <span class="transform group-hover/link:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="relative rounded-2xl border border-bes-gold/20 p-8 md:p-12 overflow-hidden shadow-2xl bes-reveal" style="background: rgba(30, 42, 22, 0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); transition-delay: 0.5s;">
                    
                    <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-bes-leaf/10 blur-[80px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/2"></div>
                    
                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                        <div class="lg:max-w-md">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="w-8 h-[1px] bg-bes-gold"></span>
                                <span class="font-body text-[9px] font-bold tracking-[0.28em] uppercase !text-bes-gold">Virtual Sanctuary</span>
                            </div>
                            <h3 class="font-display text-3xl md:text-[34px] text-bes-ivory mb-3 font-medium">Program Online Session</h3>
                            <p class="font-body text-[14px] text-bes-ivory/60 leading-relaxed font-light">
                                Experience profound energetic recalibration from anywhere in the world. Join our transformative online sessions designed for deep healing and continuous spiritual growth.
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            <?php 
                            $daily = ['Meditation Course', 'Eling Caring', 'Virtual Breathwork', 'Online Dharma Talk', 'Spiritual Consultation', 'Remote Energy Healing'];
                            foreach($daily as $d): ?>
                                <span class="border border-bes-ivory/10 bg-bes-ivory/5 px-4 py-2.5 rounded-sm font-body text-[10px] font-bold tracking-[0.15em] uppercase text-bes-ivory/80 hover:bg-bes-gold/10 hover:border-bes-gold/30 hover:!text-bes-gold transition-all duration-300 cursor-default">
                                    <?php echo $d; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <style>
            @keyframes shimmer {
                100% { transform: translateX(100%); }
            }
        </style>

        <?php
        return ob_get_clean();
    }
}
?>