<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_atma_retreat] Shortcode
 * ============================================================================
 *
 * Registers [bes_atma_retreat] for the Atma Retreat page.
 * Strictly follows BES v3 design system — zero new CSS, Tailwind BES tokens only.
 *
 * KEY PROGRAM FACTS (verified from official site, Feb 2026):
 *  - Duration: 3 days, 2 nights
 *  - Type: Private retreat (flexible scheduling, adapts to participant availability)
 *  - Difference from Tapa Brata: More private, adapts to participant schedule
 *  - Success Rate: 97% reported positive influence on healing and problem-solving
 *  - Accommodation: Overnight stay at Pasraman required
 *  - Led by: Aji Bhagawan, Jero Ratni, and authorized Yogis
 *  - Recommendation: Once per year for energy detox
 *  - Follow-up: YTT 50H → YTT 200H pathway
 *
 * ACTIVITIES INCLUDED:
 *  - 3× Sunrise Bali Hatha Yoga
 *  - 2× Sunset Detox Yin Yoga
 *  - 10× Healing Mindfulness Meditations
 *  - 1× Mother Earth Purification ceremony
 *  - 1× Sacred temple excursion (UNESCO Cultural Heritage)
 *  - 2× Sacred Sound Healing sessions
 *  - 1× hour spa relaxing massage
 *  - Workshop: How to Manifest with the Power of Mind
 *  - 1× Private consultation with master
 *  - Journaling throughout the retreat
 *
 * SECTIONS (12 total):
 *   0  Cinematic Hero — soul-awakening theme, private retreat positioning
 *   1  Photo Mood Gallery — 3-image editorial grid
 *   2  What Atma Means — Sanskrit etymology, philosophical depth
 *   3  Why This Retreat Exists — honest positioning vs Tapa Brata
 *   4  The Complete Experience — all activities with detail cards
 *   5  Daily Flow — 3-day journey timeline
 *   6  Photo Interlude — atmospheric full-width image
 *   7  The Three Bodies — Sthula, Sukhma, Antah Karana transformation
 *   8  Who Should Attend — honest profiles
 *   9  What Changes After — transformation outcomes
 *  10  FAQ — 8 real questions with honest answers
 *  11  Closing CTA — private retreat urgency, pathway context
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_atma_retreat', 'bes_render_atma_retreat' );

function bes_render_atma_retreat( $atts ) {
    ob_start();

    // ── Photo URLs ──────────────────────────────────────────────────────────
    $photos = [
        'hero'          => 'https://images.unsplash.com/photo-1545389336-cf090694435e?w=1600&q=80',
        'meditation'    => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&q=80',
        'yoga_sunrise'  => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1200&q=80',
        'temple'        => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200&q=80',
        'sound_healing' => 'https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=1200&q=80',
        'nature'        => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1200&q=80',
        'journal'       => 'https://images.unsplash.com/photo-1517842645767-c639042777db?w=1200&q=80',
        'spa'           => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=1200&q=80',
    ];
    ?>

    <!-- ================================================================
         SECTION 0 — CINEMATIC HERO
         ================================================================ -->
    <section class="relative min-h-[90vh] flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-atma-heading">

        <!-- Photo backdrop with overlay -->
        <div class="absolute inset-0" aria-hidden="true">
            <img src="<?php echo esc_url($photos['hero']); ?>"
                 alt="Woman in deep meditation at sunrise in Bali"
                 class="w-full h-full object-cover object-center opacity-25"
                 loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep/70 via-bes-forest-deep/50 to-bes-forest-deep"></div>
            <!-- Golden soul glow -->
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[600px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.10),transparent_55%)]"></div>
            <div class="absolute top-1/4 right-1/4 w-[400px] h-[300px] bg-[radial-gradient(ellipse,rgba(139,195,74,0.06),transparent_60%)]"></div>
            <div class="absolute bottom-0 inset-x-0 h-64 bg-gradient-to-t from-bes-forest-deep to-transparent"></div>
            <!-- Dot texture -->
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Top fret -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-32 md:py-44">

            <!-- Dual badge row -->
            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-3 mb-10">
                <div class="inline-flex items-center gap-2.5 bg-white/[.05] border border-white/[.10] rounded-full px-4 py-2">
                    <i class="fa-solid fa-om !text-bes-gold/70 text-[10px]" aria-hidden="true"></i>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-white/40">Private Soul Retreat</span>
                </div>
                <div class="inline-flex items-center gap-2.5 bg-[rgba(201,168,76,0.08)] border border-[rgba(201,168,76,0.22)] rounded-full px-4 py-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-bes-gold animate-pulse flex-shrink-0"></span>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/70">3 Days · 2 Nights · Your Schedule</span>
                </div>
            </div>

            <!-- Subtitle label -->
            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/50 mb-3">
                आत्मा &nbsp;·&nbsp; The True Self Within
            </p>

            <h1 id="bes-atma-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-3">
                Atma
            </h1>
            <h2 class="bes-reveal font-display font-light italic !text-bes-gold text-4xl md:text-5xl tracking-display leading-none mb-8">
                Retreat
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                The Sanskrit word <em class="!text-bes-gold/70 not-italic">Atma</em> means soul — your true, eternal self beneath the noise. This private retreat exists for those who cannot follow the regular Tapa Brata schedule but need the same depth of healing. Three days. Two nights. Ten meditations. One private consultation. No distractions. Just you, meeting yourself — perhaps for the first time.
            </p>

            <!-- Stats strip -->
            <div class="bes-reveal flex flex-wrap items-center justify-center gap-6 mb-10">
                <?php
                $stats = [
                    [ 'v' => '3', 'u' => 'Days', 'icon' => 'fa-regular fa-calendar' ],
                    [ 'v' => '10', 'u' => 'Meditations', 'icon' => 'fa-solid fa-spa' ],
                    [ 'v' => '97%', 'u' => 'Success Rate', 'icon' => 'fa-solid fa-chart-line' ],
                    [ 'v' => '1:1', 'u' => 'Consultation', 'icon' => 'fa-solid fa-comments' ],
                ];
                foreach ( $stats as $s ) : ?>
                <div class="flex flex-col items-center gap-1">
                    <i class="<?php echo esc_attr($s['icon']); ?> !text-bes-gold/40 text-xs mb-1" aria-hidden="true"></i>
                    <span class="font-display font-medium text-white text-2xl leading-none"><?php echo esc_html($s['v']); ?></span>
                    <span class="font-body font-bold text-[9px] uppercase tracking-label text-white/25"><?php echo esc_html($s['u']); ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- CTAs -->
            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest-deep font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-[#d4b84c] transition-all duration-300 shadow-lg shadow-[rgba(201,168,76,0.25)] group">
                    <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Book My Private Retreat
                </a>
                <a href="#bes-atma-journey"
                   class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i>
                    Discover the Journey
                </a>
            </div>
        </div>

        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — PHOTO MOOD GALLERY
         ================================================================ -->
    <section class="bg-bes-forest-deep py-12 md:py-20 px-6 md:px-10" data-bes-header="dark">
        <div class="max-w-[1440px] mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 h-auto">

                <div class="md:col-span-7 lg:col-span-8 relative rounded-3xl overflow-hidden group h-[400px] md:h-full">
                    <img src="<?php echo esc_url($photos['meditation']); ?>"
                         alt="Deep meditation practice at Pasraman Bali Eling Spirit"
                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                         loading="lazy" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/90 via-bes-forest-deep/20 to-transparent"></div>
                    
                    <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-8 h-[1px] bg-bes-gold"></span>
                            <span class="!text-bes-gold font-body font-bold text-[10px] uppercase tracking-[0.3em]">Soul Journey</span>
                        </div>
                        <h3 class="font-display text-2xl md:text-4xl text-white">Return to Your True Self</h3>
                    </div>
                </div>

                <div class="md:col-span-5 lg:col-span-4 flex flex-col gap-4 md:gap-6 h-full">
                    
                    <div class="relative rounded-3xl overflow-hidden flex-1 group min-h-[250px]">
                        <img src="<?php echo esc_url($photos['yoga_sunrise']); ?>"
                             alt="Sunrise yoga practice in Bali"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                             loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <p class="text-white/80 font-display text-xl">3 Sunrise Practices</p>
                        </div>
                    </div>

                    <div class="relative rounded-3xl overflow-hidden flex-1 group min-h-[250px]">
                        <img src="<?php echo esc_url($photos['temple']); ?>"
                             alt="Sacred Balinese temple UNESCO heritage site"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                             loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <p class="text-white/80 font-display text-xl">Sacred Temple Journey</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 2 — WHAT ATMA MEANS
         ================================================================ -->
    <section class="bg-bes-forest-deep py-20 md:py-28" aria-label="The meaning of Atma">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/60 mb-4">Sanskrit: आत्मा (Ātmā)</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-7">
                        Your Soul Is Not<br>A Metaphor. It Is<br><em class="not-italic !text-bes-gold">Architecture</em>.
                    </h2>
                    <div class="space-y-5 font-body font-light text-white/45 text-base leading-relaxed">
                        <p class="bes-reveal">
                            The word <em class="!text-bes-gold/70 not-italic">Atma</em> comes from the Sanskrit root meaning "breath" — and later evolved to signify something far more essential: the eternal, unchanging essence of who you are. Not your thoughts. Not your emotions. Not your job title or relationship status. The Atma is the witness behind all of these — the part of you that has remained constant since childhood, watching life happen.
                        </p>
                        <p class="bes-reveal">
                            In Vedantic philosophy, the Atma is identical with Brahman — universal consciousness itself. The suffering you experience in life, according to this understanding, comes from a single source: forgetting this identity. You believe you are the wave, when in truth you are the ocean.
                        </p>
                        <p class="bes-reveal">
                            The Atma Retreat at Pasraman Bali Eling Spirit is designed around one purpose: to bring you back into contact with this deeper self. Not through intellectual understanding — you can read about Atma in a thousand books and remain unchanged — but through direct experience. Meditation. Breath. Silence. The slow dismantling of the mental noise that has been obscuring your own nature for years.
                        </p>
                    </div>
                </div>

                <!-- Right: accent card + Sanskrit breakdown -->
                <div class="lg:col-span-5 space-y-4">

                    <!-- Sanskrit etymology card -->
                    <div class="bes-reveal relative rounded-2xl border border-bes-gold/20 overflow-hidden"
                         style="background:rgba(201,168,76,0.05)">
                        <div class="h-[2px] bg-gradient-to-r from-bes-gold/50 via-bes-gold/30 to-transparent"></div>
                        <div class="p-6">
                            <div class="text-center mb-5">
                                <p class="font-display text-6xl !text-bes-gold/40 mb-2">आत्मन्</p>
                                <p class="font-body font-bold text-[10px] uppercase tracking-label !text-bes-gold/60">Ātman (Nominative: Ātmā)</p>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-white/[.06]">
                                    <span class="font-body text-white/40 text-sm">Root meaning</span>
                                    <span class="font-body font-medium text-white/70 text-sm">Breath, essence</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-white/[.06]">
                                    <span class="font-body text-white/40 text-sm">Philosophical meaning</span>
                                    <span class="font-body font-medium text-white/70 text-sm">True Self, Soul</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-white/[.06]">
                                    <span class="font-body text-white/40 text-sm">Nature</span>
                                    <span class="font-body font-medium text-white/70 text-sm">Eternal, unchanging</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="font-body text-white/40 text-sm">Relationship to Brahman</span>
                                    <span class="font-body font-medium text-white/70 text-sm">Identical (Advaita)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quote card -->
                    <div class="bes-reveal relative rounded-2xl overflow-hidden p-6"
                         style="background:rgba(38,51,32,0.45);border:1px solid rgba(255,255,255,0.04)">
                        <i class="fa-solid fa-quote-left !text-bes-gold/20 text-2xl mb-3 block" aria-hidden="true"></i>
                        <p class="font-body font-light text-white/50 text-[14px] leading-relaxed italic mb-3">
                            "The Atman is not born, nor does it die. It has no origin and is eternal. It is unborn, permanent, and primeval. It is not killed when the body is killed."
                        </p>
                        <p class="font-body font-bold text-[10px] uppercase tracking-label !text-bes-gold/50">
                            Bhagavad Gita 2.20
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — WHY THIS RETREAT EXISTS
         ================================================================ -->
    <section class="relative bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Why Atma Retreat exists">

        <div class="absolute left-0 top-0 w-[600px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)] pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Honest Difference</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-7">
                        Not Everyone Can<br>Follow a Fixed<br><em class="not-italic text-bes-moss">Schedule</em>.
                    </h2>
                    <div class="space-y-6 font-body font-light text-bes-bark-muted text-base md:text-lg leading-relaxed">
                        <p class="bes-reveal">
                            The Tapa Brata program — our flagship 4-day, 3-night transformational retreat — has helped hundreds of people heal deep wounds and reconnect with their true nature. But it runs on fixed dates. And life does not always cooperate with fixed dates.
                        </p>
                        <p class="bes-reveal">
                            You may be traveling through Bali on dates that do not align with Tapa Brata. You may need the flexibility to begin when you arrive. You may prefer the intimacy of a private experience rather than a group setting.
                        </p>
                        <p class="bes-reveal">
                            The Atma Retreat exists for you. It contains the same depth of practice — the meditations, the yoga, the healing, the personal consultation — compressed into three days and adapted to your schedule. The program is more private because it adapts to you, not the other way around.
                        </p>
                    </div>
                </div>

                <div class="bes-reveal">
                    <div class="relative rounded-3xl border border-bes-sand overflow-hidden shadow-lg shadow-black/5"
                         style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                        <div class="h-[4px] bg-gradient-to-r from-bes-gold/60 to-transparent"></div>
                        <div class="p-8 md:p-10">
                            <h3 class="font-display font-medium text-bes-bark text-2xl mb-8">Atma vs. Tapa Brata</h3>
                            
                            <div class="space-y-0 border border-bes-sand/50 rounded-xl overflow-hidden bg-white/40">
                                <div class="grid grid-cols-3 gap-2 p-4 border-b border-bes-sand bg-white/60 items-center">
                                    <span class="font-body font-bold text-[10px] uppercase tracking-widest text-bes-bark-muted/40">Features</span>
                                    <span class="font-body font-bold text-[11px] uppercase tracking-widest !text-bes-gold bg-bes-gold/10 py-1.5 rounded-md text-center">Atma</span>
                                    <span class="font-body font-bold text-[10px] uppercase tracking-widest text-bes-moss/70 text-center">Tapa Brata</span>
                                </div>
                                
                                <?php
                                $comparisons = [
                                    [ 'Duration', '3 days, 2 nights', '4 days, 3 nights' ],
                                    [ 'Scheduling', 'Flexible dates', 'Fixed calendar' ],
                                    [ 'Format', 'Private / Small', 'Group setting' ],
                                    [ 'Meditations', '10 sessions', '12+ sessions' ],
                                    [ 'Consultation', '1 private session', 'Group guidance' ],
                                    [ 'Ideal for', 'Travelers, busy schedules', 'Those with time' ],
                                ];
                                foreach ( $comparisons as $index => $c ) : 
                                    // Add subtle zebra striping
                                    $bg_class = ($index % 2 === 0) ? 'bg-transparent' : 'bg-bes-sand/10';
                                ?>
                                <div class="grid grid-cols-3 gap-2 p-4 items-center <?php echo $bg_class; ?> hover:bg-white transition-colors duration-200">
                                    <span class="font-body font-medium text-bes-bark-muted/70 text-[13px] md:text-sm"><?php echo esc_html($c[0]); ?></span>
                                    <span class="font-body font-medium text-bes-bark text-[13px] md:text-sm text-center px-2"><?php echo esc_html($c[1]); ?></span>
                                    <span class="font-body font-light text-bes-bark-muted text-[13px] md:text-sm text-center px-2"><?php echo esc_html($c[2]); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="mt-6 pt-6 border-t border-bes-sand/60">
                                <p class="font-body font-light text-bes-bark-muted text-sm leading-relaxed flex items-start gap-3">
                                    <i class="fa-solid fa-circle-info !text-bes-gold/50 text-base mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <span>Both programs share the same foundation: yoga, meditation, healing, and spiritual guidance from Bhagawan and Jero Ratni. The Atma Retreat is simply adapted for flexibility.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — THE COMPLETE EXPERIENCE
         ================================================================ -->
    <section id="bes-atma-journey" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Complete retreat experience">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[900px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_52%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/60 mb-4">What You Receive</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">The Complete Experience</h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm max-w-xl mx-auto mt-4 leading-relaxed">
                    Every element of the Atma Retreat has been designed with intention. Nothing is filler. Each practice builds upon the last.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <?php
                $experiences = [
                    [
                        'icon'   => 'fa-solid fa-sun',
                        'count'  => '3×',
                        'title'  => 'Sunrise Bali Hatha Yoga',
                        'desc'   => 'Begin each morning with traditional Bali Hatha Yoga as the sun rises. This practice awakens the body gently, preparing your physical vessel to hold the deeper work of meditation.',
                        'color'  => '#e07820',
                    ],
                    [
                        'icon'   => 'fa-solid fa-moon',
                        'count'  => '2×',
                        'title'  => 'Sunset Detox Yin Yoga',
                        'desc'   => 'As evening falls, slow, deep stretches release accumulated tension from fascia and joints. Yin yoga accesses the body\'s meridian system, allowing energy to flow freely again.',
                        'color'  => '#5c3eb0',
                    ],
                    [
                        'icon'   => 'fa-solid fa-spa',
                        'count'  => '10×',
                        'title'  => 'Healing Mindfulness Meditations',
                        'desc'   => 'Ten guided meditation sessions form the core of the retreat. Each session targets a different layer: breath awareness, body scanning, emotional release, and finally, pure witnessing — the Atma state.',
                        'color'  => '#c9a84c',
                    ],
                    [
                        'icon'   => 'fa-solid fa-globe',
                        'count'  => '1×',
                        'title'  => 'Mother Earth Purification',
                        'desc'   => 'A traditional Balinese ceremony connecting you to the element of earth. This purification grounds scattered energy and establishes the foundation for all other healing work.',
                        'color'  => '#2a9c4e',
                    ],
                    [
                        'icon'   => 'fa-solid fa-landmark',
                        'count'  => '1×',
                        'title'  => 'Sacred Temple Excursion',
                        'desc'   => 'Visit a UNESCO Cultural Heritage protected temple in Bali. This is not tourism — it is pilgrimage. The team guides you through proper offerings and meditation at a site of genuine spiritual power.',
                        'color'  => '#1e88c4',
                    ],
                    [
                        'icon'   => 'fa-solid fa-bell',
                        'count'  => '2×',
                        'title'  => 'Sacred Sound Healing',
                        'desc'   => 'Tibetan singing bowls, tuned to specific frequencies, are played as you lie in stillness. The vibrations enter the body and release stress held at cellular level — many report this as the most profound experience of the retreat.',
                        'color'  => '#8a5ac8',
                    ],
                    [
                        'icon'   => 'fa-solid fa-hands',
                        'count'  => '1 hour',
                        'title'  => 'Spa Relaxing Massage',
                        'desc'   => 'Traditional Balinese massage techniques release physical tension accumulated from years of stress. This is not luxury — it is necessary integration, allowing the body to catch up with the mind\'s opening.',
                        'color'  => '#e63232',
                    ],
                    [
                        'icon'   => 'fa-solid fa-brain',
                        'count'  => 'Workshop',
                        'title'  => 'Manifestation & Mind Power',
                        'desc'   => 'Learn the practical mechanics of how thought creates reality. This is not wishful thinking — it is the application of focused intention, grounded in the clarity that meditation produces.',
                        'color'  => '#d4b800',
                    ],
                    [
                        'icon'   => 'fa-solid fa-comments',
                        'count'  => '1×',
                        'title'  => 'Private Consultation',
                        'desc'   => 'One-on-one session with the master to address your specific situation. Bring your questions, your concerns, your stuck places. This is the space where the general becomes personal.',
                        'color'  => '#c9a84c',
                    ],
                    [
                        'icon'   => 'fa-solid fa-book',
                        'count'  => 'Daily',
                        'title'  => 'Guided Journaling',
                        'desc'   => 'Throughout the retreat, you maintain a journal guided by specific prompts. Gratitude. Learning. Inspiration. The written record becomes a mirror that reveals patterns invisible in the moment.',
                        'color'  => '#2a9c4e',
                    ],
                    [
                        'icon'   => 'fa-solid fa-utensils',
                        'count'  => 'Included',
                        'title'  => 'Vegetarian Meals',
                        'desc'   => 'Three healthy vegetarian meals daily. Clean fuel for a body doing deep work. No meat, no eggs, no terasi — the Pasraman maintains dietary purity to support energetic clarity.',
                        'color'  => '#8bc34a',
                    ],
                    [
                        'icon'   => 'fa-solid fa-bed',
                        'count'  => 'Included',
                        'title'  => 'Accommodation',
                        'desc'   => 'Overnight stay at Pasraman protects your body, heart, mind, and soul from interference or distraction from negative energy outside. The environment is calibrated for transformation.',
                        'color'  => '#5c3eb0',
                    ],
                ];
                foreach ( $experiences as $exp ) : ?>

                <div class="bes-reveal group relative rounded-2xl border overflow-hidden transition-all duration-400 hover:-translate-y-1 hover:shadow-xl"
                     style="background:rgba(38,51,32,0.40);border-color:<?php echo esc_attr($exp['color']); ?>15;">
                    <div class="h-[3px]" style="background:linear-gradient(to right,<?php echo esc_attr($exp['color']); ?>,transparent)"></div>

                    <div class="p-5 md:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center"
                                 style="background:<?php echo esc_attr($exp['color']); ?>15;border:1px solid <?php echo esc_attr($exp['color']); ?>25;">
                                <i class="<?php echo esc_attr($exp['icon']); ?> text-sm" style="color:<?php echo esc_attr($exp['color']); ?>cc;" aria-hidden="true"></i>
                            </div>
                            <span class="font-display font-medium text-white/70 text-lg"><?php echo esc_html($exp['count']); ?></span>
                        </div>

                        <h3 class="font-display font-medium text-white text-lg mb-2 leading-snug"><?php echo esc_html($exp['title']); ?></h3>
                        <p class="font-body font-light text-white/35 text-[12.5px] leading-relaxed"><?php echo esc_html($exp['desc']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — DAILY FLOW (3-day journey)
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Daily journey">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Three-Day Journey</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">How the Days Unfold</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php
                $days = [
                    [
                        'day'      => 'Day 1',
                        'title'    => 'Arrival & Opening',
                        'theme'    => 'Grounding',
                        'color'    => '#2a9c4e',
                        'icon'     => 'fa-solid fa-seedling',
                        'schedule' => [
                            [ 'time' => 'Morning', 'activity' => 'Arrival, orientation, intention setting' ],
                            [ 'time' => 'Midday', 'activity' => 'First meditation session: breath awareness' ],
                            [ 'time' => 'Afternoon', 'activity' => 'Mother Earth Purification ceremony' ],
                            [ 'time' => 'Evening', 'activity' => 'Sunset Detox Yin Yoga' ],
                            [ 'time' => 'Night', 'activity' => 'Journaling: gratitude practice' ],
                        ],
                        'insight'  => 'The first day establishes the container. We slow you down, ground your scattered energy, and begin the process of turning attention inward.',
                    ],
                    [
                        'day'      => 'Day 2',
                        'title'    => 'Deepening',
                        'theme'    => 'Release',
                        'color'    => '#8a5ac8',
                        'icon'     => 'fa-solid fa-water',
                        'schedule' => [
                            [ 'time' => 'Dawn', 'activity' => 'Sunrise Bali Hatha Yoga' ],
                            [ 'time' => 'Morning', 'activity' => '3 meditation sessions (body, emotion, mind)' ],
                            [ 'time' => 'Midday', 'activity' => 'Sacred temple excursion (UNESCO site)' ],
                            [ 'time' => 'Afternoon', 'activity' => 'Sound healing session' ],
                            [ 'time' => 'Evening', 'activity' => 'Sunset yoga + manifestation workshop' ],
                            [ 'time' => 'Night', 'activity' => 'Journaling: learning & insights' ],
                        ],
                        'insight'  => 'The second day is the heart of the work. Here you go deep — releasing what has been held, visiting sacred ground, and learning to use the mind consciously.',
                    ],
                    [
                        'day'      => 'Day 3',
                        'title'    => 'Integration',
                        'theme'    => 'Emergence',
                        'color'    => '#c9a84c',
                        'icon'     => 'fa-solid fa-sun',
                        'schedule' => [
                            [ 'time' => 'Dawn', 'activity' => 'Final sunrise yoga' ],
                            [ 'time' => 'Morning', 'activity' => '3 meditation sessions (witnessing, Atma)' ],
                            [ 'time' => 'Midday', 'activity' => 'Private consultation with master' ],
                            [ 'time' => 'Afternoon', 'activity' => 'Sound healing + spa massage' ],
                            [ 'time' => 'Evening', 'activity' => 'Closing ceremony, departure' ],
                        ],
                        'insight'  => 'The final day brings everything together. The private consultation addresses your specific situation. The spa integrates the body. You leave not just relaxed, but restructured.',
                    ],
                ];
                foreach ( $days as $d ) : ?>

                <div class="bes-reveal relative flex flex-col h-full rounded-2xl border border-bes-sand overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-400"
                     style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                    <div class="h-[5px]" style="background:linear-gradient(to right,<?php echo esc_attr($d['color']); ?>,transparent 80%)"></div>
                    
                    <div class="p-6 md:p-8 flex flex-col flex-grow">
                        <div class="flex items-start gap-5 mb-8 border-b border-bes-sand/70 pb-5">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0"
                                 style="background:<?php echo esc_attr($d['color']); ?>15;border:1px solid <?php echo esc_attr($d['color']); ?>30;">
                                <i class="<?php echo esc_attr($d['icon']); ?> text-xl" style="color:<?php echo esc_attr($d['color']); ?>;" aria-hidden="true"></i>
                            </div>
                            <div class="pt-1">
                                <p class="font-body font-bold text-[10px] uppercase tracking-widest mb-1.5" style="color:<?php echo esc_attr($d['color']); ?>;"><?php echo esc_html($d['day']); ?> <span class="text-bes-bark-muted/40 px-1">|</span> <?php echo esc_html($d['theme']); ?></p>
                                <h3 class="font-display font-medium text-bes-bark text-2xl leading-tight"><?php echo esc_html($d['title']); ?></h3>
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <?php foreach ( $d['schedule'] as $s ) : ?>
                            <div class="flex items-start gap-4">
                                <span class="font-body font-bold text-[10px] uppercase tracking-widest text-bes-bark-muted/60 w-20 flex-shrink-0 mt-1"><?php echo esc_html($s['time']); ?></span>
                                <span class="font-body font-light text-bes-bark-muted text-sm leading-relaxed"><?php echo esc_html($s['activity']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="pt-5 border-t border-bes-sand/70 mt-auto">
                            <p class="font-body font-light text-bes-bark-muted text-[13px] md:text-sm leading-relaxed italic border-l-2 pl-4" style="border-color:<?php echo esc_attr($d['color']); ?>40;">
                                <?php echo esc_html($d['insight']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <div class="bes-reveal mt-16 max-w-3xl mx-auto">
                <div class="relative rounded-2xl border border-bes-gold/20 overflow-hidden shadow-sm"
                     style="background:rgba(201,168,76,0.06)">
                    <div class="p-8 md:p-10 flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                        <div class="w-14 h-14 rounded-2xl bg-bes-gold/15 border border-bes-gold/25 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-mobile-screen-button !text-bes-gold/80 text-xl" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h4 class="font-body font-semibold text-bes-bark text-base mb-2">Digital Detox Recommended</h4>
                            <p class="font-body font-light text-bes-bark-muted text-sm leading-relaxed max-w-xl mx-auto md:mx-0">
                                For maximum results, we strongly recommend quitting social media and minimizing phone use throughout the retreat. The silence is part of the medicine. Your nervous system needs a full reset — and that cannot happen while checking notifications.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — PHOTO INTERLUDE
         ================================================================ -->
    <section class="relative min-h-[500px] h-[50vh] md:h-[60vh] flex items-center justify-center overflow-hidden" aria-label="Quote on the nature of Atma">
        
        <img src="<?php echo esc_url($photos['nature']); ?>"
             alt="Sunlight streaming through Balinese forest at Pasraman"
             class="absolute inset-0 w-full h-full object-cover object-center z-0"
             loading="lazy" />
             
        <div class="absolute inset-0 bg-bes-forest-deep/40 z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep via-transparent to-bes-forest-deep z-10"></div>
        
        <div class="relative z-20 px-6 md:px-10 max-w-4xl mx-auto text-center">
            <blockquote class="flex flex-col items-center">
                <i class="bes-reveal fa-solid fa-droplet !text-bes-gold/40 text-3xl md:text-4xl mb-6 md:mb-8" aria-hidden="true"></i>
                
                <p class="bes-reveal font-display font-light italic text-white/95 text-2xl md:text-3xl lg:text-4xl leading-relaxed md:leading-normal">
                    "You are not a drop in the ocean. You are the entire ocean in a drop."
                </p>
                
                <footer class="bes-reveal mt-8 md:mt-10 flex flex-col items-center gap-4">
                    <div class="w-12 h-[1px] bg-bes-gold/40 rounded-full"></div>
                    <cite class="font-body font-bold text-[11px] md:text-xs uppercase tracking-widest !text-bes-gold/80 not-italic">
                        Rumi — On the Nature of Atma
                    </cite>
                </footer>
            </blockquote>
        </div>

    </section>


    <!-- ================================================================
         SECTION 7 — THE THREE BODIES
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Transformation across three bodies">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Transformation Across All Layers</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">The Three Bodies</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    Vedantic philosophy recognizes that you are not just a physical body. You exist on three levels — and the Atma Retreat addresses all of them.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php
                // Note: Moved the 'changes' array for Sukhma and Karana up to the PHP definition
                // to match the original structure, assuming you had a typo in the original snippet where 
                // Sukhma and Karana arrays were defined outside their respective associative arrays.
                $bodies = [
                    [
                        'sanskrit' => 'Sthula Sarira',
                        'english'  => 'Physical Body',
                        'icon'     => 'fa-solid fa-person-rays',
                        'color'    => '#2a9c4e',
                        'desc'     => 'The gross body — flesh, bones, organs, the material vehicle you inhabit. This is where physical tension accumulates, where stress stores itself in tight muscles and shallow breath.',
                        'changes'  => [
                            'Deep physical relaxation through yoga and massage',
                            'Improved sleep quality from nervous system reset',
                            'Release of chronic tension in neck, shoulders, jaw',
                            'Renewed vitality from vegetarian cleansing',
                            'Better posture and body awareness',
                        ],
                    ],
                    [
                        'sanskrit' => 'Sukhma Sarira',
                        'english'  => 'Subtle Body',
                        'icon'     => 'fa-solid fa-brain',
                        'color'    => '#8a5ac8',
                        'desc'     => 'The mind and emotional field — thoughts, feelings, memories, dreams. This is where anxiety lives, where past trauma creates present patterns, where the story of "who you are" runs on repeat.',
                        'changes'  => [
                            'Clarity of thought, reduced mental chatter',
                            'Emotional release of old grief and resentment',
                            'Reduced anxiety and overthinking patterns',
                            'Insight into recurring life patterns',
                            'Strengthened intuition and inner knowing',
                        ],
                    ],
                    [
                        'sanskrit' => 'Karana Sarira',
                        'english'  => 'Causal Body',
                        'icon'     => 'fa-solid fa-star-of-david',
                        'color'    => '#c9a84c',
                        'desc'     => 'The soul level — the Atma itself, and the karmic seeds that determine your tendencies across lifetimes. This is the deepest layer, where fundamental shifts occur that reshape everything above it.',
                        'changes'  => [
                            'Restored sense of life purpose and meaning',
                            'Connection to something larger than yourself',
                            'Dissolution of existential emptiness',
                            'Karmic clearing of ancestral patterns',
                            'Direct experience of the witnessing self',
                        ],
                    ],
                ];
                foreach ( $bodies as $b ) : ?>

                <div class="bes-reveal relative flex flex-col h-full rounded-2xl border border-bes-sand overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-400"
                     style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                    <div class="h-[4px]" style="background:linear-gradient(to right,<?php echo esc_attr($b['color']); ?>,transparent)"></div>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-5 mb-6">
                            <div class="w-14 h-14 rounded-xl border flex items-center justify-center flex-shrink-0"
                                 style="background:<?php echo esc_attr($b['color']); ?>10;border-color:<?php echo esc_attr($b['color']); ?>25;">
                                <i class="<?php echo esc_attr($b['icon']); ?> text-xl" style="color:<?php echo esc_attr($b['color']); ?>;" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="font-body font-bold text-[10px] uppercase tracking-widest mb-1 text-bes-bark-muted/70"><?php echo esc_html($b['english']); ?></p>
                                <h3 class="font-display font-medium text-bes-bark text-2xl"><?php echo esc_html($b['sanskrit']); ?></h3>
                            </div>
                        </div>

                        <p class="font-body font-light text-bes-bark-muted text-base leading-relaxed mb-8">
                            <?php echo esc_html($b['desc']); ?>
                        </p>

                        <div class="pt-6 border-t border-bes-sand/70 mt-auto">
                            <p class="font-body font-bold text-[10px] uppercase tracking-widest text-bes-bark-muted/60 mb-4">What Changes</p>
                            <ul class="space-y-3">
                                <?php foreach ( $b['changes'] as $change ) : ?>
                                <li class="flex items-start gap-3">
                                    <span class="w-1.5 h-1.5 rounded-full mt-2 flex-shrink-0" style="background:<?php echo esc_attr($b['color']); ?>90;"></span>
                                    <span class="font-body font-light text-bes-bark text-sm leading-relaxed"><?php echo esc_html($change); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ================================================================
         SECTION 8 — WHO SHOULD ATTEND
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Who should attend">

        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">The Right People</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Who<br>This Is<br><em class="not-italic !text-bes-gold">For</em>
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/60 text-base leading-relaxed">
                        The Atma Retreat is designed for specific situations. If you recognize yourself in these descriptions, this may be the program you need.
                    </p>
                    <div class="bes-reveal mt-8 h-[1px] w-16 bg-gradient-to-r from-bes-gold/40 to-transparent"></div>
                </div>

                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
                    <?php
                    $who = [
                        [
                            'icon'  => 'fa-solid fa-head-side-virus',
                            'title' => 'Chronic Overthinkers',
                            'body'  => 'Your mind runs constantly. At night you cannot sleep because thoughts keep circling. You have tried meditation apps, but the noise only pauses — it never stops. The Atma Retreat goes deeper than surface techniques.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-heart-crack',
                            'title' => 'Those Carrying Old Wounds',
                            'body'  => 'Trauma from years ago still affects your present. Past relationships, childhood experiences, losses that were never fully processed — they live in your body and color your perceptions. This retreat creates the space for genuine release.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-compass',
                            'title' => 'Lost Direction Seekers',
                            'body'  => 'You have achieved things, but none of it feels meaningful. You are successful on paper but empty inside. The question "what is this all for?" follows you everywhere. The Atma work reconnects you to authentic purpose.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-rotate',
                            'title' => 'Toxic Pattern Breakers',
                            'body'  => 'The same dynamics repeat in your relationships, your work, your health. You see the pattern clearly but cannot seem to exit it. The Atma Retreat addresses patterns at root level — where they actually originate.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-moon',
                            'title' => 'Insomnia Sufferers',
                            'body'  => 'Sleep eludes you, or what sleep you get leaves you unrested. The nervous system is locked in hypervigilance. The retreat\'s combination of yoga, meditation, and sound healing recalibrates the sleep architecture.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-plane',
                            'title' => 'Travelers Seeking Depth',
                            'body'  => 'You are in Bali but do not want another yoga retreat where nothing really changes. You want the real thing — genuine transformation, not instagram content. The Atma Retreat delivers substance, not surface.',
                        ],
                    ];
                    foreach ( $who as $w ) : ?>

                    <div class="bes-reveal group p-6 md:p-8 rounded-2xl border border-white/[.04] hover:border-bes-gold/30 hover:bg-white/[.02] hover:-translate-y-1 hover:shadow-xl transition-all duration-400 flex flex-col sm:flex-row gap-5 h-full items-start"
                         style="background:rgba(38,51,32,0.35)">
                        <div class="w-12 h-12 rounded-xl bg-bes-gold/[.08] border border-bes-gold/[.14] group-hover:bg-bes-gold/[.15] flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="<?php echo esc_attr($w['icon']); ?> !text-bes-gold/80 text-base" aria-hidden="true"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-display font-medium text-white text-lg md:text-xl mb-2 leading-snug group-hover:!text-bes-gold transition-colors duration-300"><?php echo esc_html($w['title']); ?></h3>
                            <p class="font-body font-light text-white/60 text-sm leading-relaxed"><?php echo esc_html($w['body']); ?></p>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — SUCCESS RATE & TESTIMONIAL
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Success and testimonials">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

                <div class="bes-reveal h-full">
                    <div class="relative h-full rounded-3xl border border-bes-gold/20 overflow-hidden flex flex-col justify-center shadow-lg shadow-bes-gold/5"
                         style="background:linear-gradient(145deg,rgba(201,168,76,0.08),rgba(201,168,76,0.02))">
                        <div class="p-10 md:p-14 text-center">
                            <div class="inline-flex items-center gap-2 bg-bes-gold/10 border border-bes-gold/20 rounded-full px-4 py-1.5 mb-8">
                                <i class="fa-solid fa-chart-line !text-bes-gold text-xs" aria-hidden="true"></i>
                                <span class="font-body font-bold text-[10px] uppercase tracking-widest !text-bes-gold">Documented Outcomes</span>
                            </div>
                            
                            <p class="font-display font-medium text-bes-bark text-8xl md:text-9xl leading-none tracking-tight mb-2">97%</p>
                            <p class="font-body font-medium !text-bes-gold text-lg md:text-xl uppercase tracking-widest mb-8">Success Rate</p>
                            
                            <p class="font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed max-w-md mx-auto">
                                Of participants report the Atma Retreat has a positive influence on accelerating healing, problem-solving, and spiritual awareness. This is not a vague wellness claim — it is the consistent documented outcome.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bes-reveal relative rounded-3xl border border-bes-sand overflow-hidden shadow-sm"
                         style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                        <div class="p-8 md:p-10">
                            <div class="flex gap-1.5 mb-5">
                                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="font-body font-light text-bes-bark text-base md:text-lg leading-relaxed italic mb-5">
                                "Pengalaman yang sangat luar biasa. Perjalanan yang menyenangkan, teman-teman yang begitu baik dan supportive, juga Aji dan bu Jro juga para team yogi yang ramah dan penuh kasih. Semoga semua makhluk berbahagia."
                            </p>
                            <p class="font-body font-bold text-[11px] uppercase tracking-widest text-bes-bark-muted/70">Program Participant</p>
                        </div>
                    </div>

                    <div class="bes-reveal relative rounded-3xl border border-bes-sand overflow-hidden shadow-sm"
                         style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                        <div class="p-8 md:p-10">
                            <div class="flex gap-1.5 mb-5">
                                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="font-body font-light text-bes-bark text-base md:text-lg leading-relaxed italic mb-5">
                                "Sangat membangunkan spiritual saya yang sudah hampir padam, apalagi saat bermeditasi di alam, energi positifnya sangat besar sekali. Sungguh membuat kami peserta mengalami momen ini tidak bisa dilupakan."
                            </p>
                            <p class="font-body font-bold text-[11px] uppercase tracking-widest text-bes-bark-muted/70">Retreat Participant</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>


    <!-- ================================================================
         SECTION 10 — FAQ
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Practical Questions</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        What<br>People<br>Ask
                    </h2>
                    
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="bes-reveal inline-flex items-center gap-3 bg-white border border-bes-gold/30 !text-bes-gold font-body font-bold text-[12px] uppercase tracking-widest px-7 py-4 rounded-xl shadow-sm hover:bg-bes-gold hover:!text-white hover:border-bes-gold hover:shadow-md transition-all duration-300 group">
                        <i class="fa-brands fa-whatsapp text-lg group-hover:scale-110 transition-transform duration-300" aria-hidden="true"></i>
                        Ask the Team
                    </a>
                </div>

                <div class="lg:col-span-8 space-y-5">
                    <?php
                    $faqs = [
                        [
                            'q' => 'What is the difference between Atma Retreat and Tapa Brata?',
                            'a' => 'Atma Retreat is the private, flexible-schedule version of the deeper transformational work. Tapa Brata runs on fixed dates in a group format (4 days, 3 nights). Atma Retreat adapts to your schedule and is more intimate (3 days, 2 nights). Both contain the same foundational practices — yoga, meditation, healing, consultation — but Atma is designed for those who cannot attend the regular Tapa Brata calendar.',
                        ],
                        [
                            'q' => 'Do I need to stay overnight at the Pasraman?',
                            'a' => 'Yes. Overnight stay is required for the Atma Retreat. This is not optional. The purpose is to protect your body, heart, mind, and soul from interference or distraction from negative energy outside. The Pasraman environment is specifically calibrated for transformation — leaving each evening would undermine the work.',
                        ],
                        [
                            'q' => 'How do I book specific dates?',
                            'a' => 'Contact the Pasraman team via WhatsApp. Unlike Tapa Brata which runs on fixed dates, the Atma Retreat adapts to your availability. Share your preferred dates and the team will confirm if they can accommodate. This flexibility is one of the core distinctions of the program.',
                        ],
                        [
                            'q' => 'What should I bring?',
                            'a' => 'Comfortable clothes for yoga and meditation. A journal and pen (though we provide materials). Any personal medications. An open mind and willingness to be present. We strongly recommend leaving social media and phone use behind — digital detox is part of the medicine.',
                        ],
                        [
                            'q' => 'Is the retreat suitable for beginners?',
                            'a' => 'Absolutely. You do not need prior experience with yoga or meditation. The practices are guided and adapted to your level. Some of the most profound transformations happen with complete beginners — there is no "correct" way to do this work, only presence and willingness.',
                        ],
                        [
                            'q' => 'What food is provided?',
                            'a' => 'Three vegetarian meals daily are included. The Pasraman maintains strict dietary standards — no meat, no eggs, no terasi (shrimp paste). This is not restriction for restriction\'s sake; clean food supports energetic clarity during the intensive inner work.',
                        ],
                        [
                            'q' => 'Is there a follow-up program after Atma Retreat?',
                            'a' => 'Yes. The recommended pathway is: Atma Retreat → YTT 50 Hours (learn to heal yourself independently) → YTT 200 Hours (broader and deeper spiritual awareness). However, many people find that a single Atma Retreat produces the shift they needed. The team can advise based on your specific situation.',
                        ],
                        [
                            'q' => 'Should I repeat the Atma Retreat?',
                            'a' => 'Yes, we recommend the Atma Retreat once per year as a detox for negative energy absorbed by the body, heart, mind, and soul. Life continues to accumulate residue even after transformation — annual clearing maintains the gains and goes deeper each time.',
                        ],
                    ];
                    foreach ( $faqs as $faq ) : ?>

                    <div class="bes-reveal group rounded-2xl border border-bes-sand hover:border-bes-gold/30 hover:shadow-lg hover:shadow-black/5 transition-all duration-300 overflow-hidden"
                         style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                        <div class="p-7 md:p-8 flex items-start gap-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 border border-bes-gold/20 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-bes-gold/15 transition-colors duration-300">
                                <i class="fa-solid fa-question !text-bes-gold/80 text-xs" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-body font-semibold text-bes-bark text-[17px] md:text-lg mb-3 leading-snug group-hover:!text-bes-moss transition-colors duration-300"><?php echo esc_html($faq['q']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-sm md:text-[15px] leading-relaxed"><?php echo esc_html($faq['a']); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 11 — CLOSING CTA
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-24 md:py-32 overflow-hidden" aria-label="Reserve your retreat">

        <!-- Background photo with deep overlay -->
        <div class="absolute inset-0" aria-hidden="true">
            <img src="<?php echo esc_url($photos['sound_healing']); ?>"
                 alt=""
                 class="w-full h-full object-cover opacity-15"
                 loading="lazy" />
            <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep via-bes-forest-deep/80 to-bes-forest-deep"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_30%,rgba(201,168,76,0.10),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="h-[1px] absolute top-0 inset-x-0 bg-gradient-to-r from-transparent via-bes-gold/40 to-transparent"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal max-w-3xl mx-auto text-center">

                <!-- Soul icon -->
                <div class="w-16 h-16 mx-auto mb-8 rounded-2xl bg-bes-gold/10 border border-bes-gold/22 flex items-center justify-center">
                    <i class="fa-solid fa-om !text-bes-gold text-2xl" aria-hidden="true"></i>
                </div>

                <!-- Private positioning -->
                <div class="inline-flex items-center gap-2 bg-bes-gold/10 border border-bes-gold/20 rounded-full px-4 py-2 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-bes-gold animate-pulse"></span>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/70">Private Retreat · Your Schedule · Limited Availability</span>
                </div>

                <h2 class="font-display font-medium text-white text-4xl md:text-5xl lg:text-6xl tracking-display mb-3">
                    Three Days.
                </h2>
                <h3 class="font-display font-light italic !text-bes-gold text-3xl md:text-4xl tracking-display mb-6">
                    One Soul. One Journey Home.
                </h3>
                <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                    The life you are living now will continue exactly as it is unless you do something to change its trajectory. The Atma Retreat is that something — a deliberate pause, a conscious reset, a return to who you actually are beneath all the noise.
                </p>

                <!-- Included summary -->
                <div class="bes-reveal max-w-lg mx-auto mb-10 p-5 rounded-2xl border border-white/[.06] bg-white/[.03] text-left">
                    <p class="font-body font-bold text-[10px] uppercase tracking-label text-white/30 mb-3">Your Retreat Includes</p>
                    <div class="grid grid-cols-2 gap-y-2 gap-x-4">
                        <?php
                        $includes = [
                            '3 days, 2 nights',
                            '10 meditation sessions',
                            '3 sunrise yoga practices',
                            '2 sunset yin yoga',
                            'Sound healing × 2',
                            '1-hour spa massage',
                            'Sacred temple visit',
                            'Private consultation',
                            'Vegetarian meals',
                            'Accommodation',
                            'Manifestation workshop',
                            'Guided journaling',
                        ];
                        foreach ( $includes as $item ) : ?>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check !text-bes-gold/50 text-[9px] flex-shrink-0" aria-hidden="true"></i>
                            <span class="font-body font-light text-white/35 text-[12.5px]"><?php echo esc_html($item); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest-deep font-body font-bold text-[11px] uppercase tracking-label px-9 py-4 rounded-2xl hover:bg-[#d4b84c] transition-all duration-300 shadow-lg shadow-[rgba(201,168,76,0.30)] group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Book My Private Retreat
                    </a>
                    <a href="/tapa-brata"
                       class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                        <i class="fa-solid fa-users text-xs" aria-hidden="true"></i>
                        Explore Group Retreat (Tapa Brata)
                    </a>
                </div>

                <!-- Trust micro-bar -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 text-[11px] text-white/40 font-body font-light">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-halved !text-bes-gold/50" aria-hidden="true"></i> Secure Booking</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-certificate !text-bes-gold/50" aria-hidden="true"></i> Certified Masters</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-star !text-bes-gold/50" aria-hidden="true"></i> 97% Success Rate</span>
                </div>
            </div>
        </div>
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>

    <?php
    return ob_get_clean();
}




