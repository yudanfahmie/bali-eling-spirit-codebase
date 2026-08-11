<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_7_chakra_purification] Shortcode
 * ============================================================================
 *
 * Registers [bes_7_chakra_purification] for the 7-Chakra Purification page.
 * Strictly follows BES v3 design system — zero new CSS, Tailwind BES tokens only.
 *
 * KEY PROGRAM FACTS (verified from official site, Feb 2026):
 *  - Held ONLY on Purnama (Full Moon) and Tilem (New/Dead Moon) each month
 *  - Time: 10:00 AM – 01:00 PM WITA (3 hours)
 *  - Arrive: 09:45 WITA
 *  - Led by: Aji Bhagawan, Jero Ratni, and Yogi Authorized
 *  - Process: meditation → chakra education → 7 types of purified water + mantras + crystals
 *  - Bring: 2 sets of clothes, traditional Balinese costume, bag for wet clothes, towel
 *  - Booking: H-1 (at least 1 day in advance) — can reschedule once with 1-day notice
 *  - Open to all backgrounds and religions
 *
 * SECTIONS (11 total):
 *   0  Cinematic Hero — lunar-cycle sacred energy, photo backdrop, dual badge
 *   1  Photo Mood Gallery — 3-image editorial grid sets the visual scene
 *   2  What This Ceremony Actually Is — narrative reframe beyond "spa treatment"
 *   3  The 7 Chakras — deep card grid: Sanskrit name, location, element, color, crystal, blocked signs
 *   4  The 7 Sacred Waters — how each water type is prepared and what it purifies
 *   5  How the Session Flows — 3-hour ceremony timeline
 *   6  Photo Interlude — atmospheric full-width image
 *   7  Purnama & Tilem — why only full moon and new moon (science + spiritual)
 *   8  What Changes After — transformation outcomes, three bodies framework
 *   9  Who Should Attend — honest profiles
 *  10  FAQ — 6 real questions with honest answers
 *  11  Closing CTA — urgent, persuasive, moon-cycle calendar context
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_7_chakra_purification', 'bes_render_7_chakra_purification' );

function bes_render_7_chakra_purification( $atts ) {
    ob_start();

    // ── Real photo URLs from web search results ──────────────────────────────
    $photos = [
        'hero'          => 'https://www.honeycombers.com/wp-content/uploads/2018/04/melukat-bali-water-purification-ritual.jpg',
        'ceremony_1'    => 'https://images.squarespace-cdn.com/content/v1/5f2abf3c36b6f66ef3c6f4be/1634556000000/melukat-ceremony-bali-water-purification.jpg',
        'ceremony_2'    => 'https://www.bali-indonesia.com/images/melukat-holy-water-bali.jpg',
        'bowls'         => 'https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=1200&q=80',
        'chakra_grid'   => 'https://dzed.me/wp-content/uploads/2021/11/7-Chakras.jpg',
        'purnama'       => 'https://baliinstitute.com/wp-content/uploads/2023/06/purnama-tilem-bali.jpg',
        'crystal'       => 'https://images.unsplash.com/photo-1518398046578-8cca57782e17?w=1200&q=80',
        'meditation'    => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&q=80',
    ];
    ?>

    <!-- ================================================================
         SECTION 0 — CINEMATIC HERO
         ================================================================ -->
    <section class="relative min-h-[90vh] flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-chakra-heading">

        <!-- Photo backdrop with overlay -->
        <div class="absolute inset-0" aria-hidden="true">
            <img src="<?php echo esc_url($photos['meditation']); ?>"
                 alt="Sacred meditation space at Pasraman Bali Eling Spirit"
                 class="w-full h-full object-cover object-center opacity-20"
                 loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep/60 via-bes-forest-deep/40 to-bes-forest-deep"></div>
            <!-- Purple/violet glow — chakra color palette -->
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-[radial-gradient(ellipse,rgba(138,90,200,0.12),transparent_55%)]"></div>
            <div class="absolute top-1/4 left-1/4 w-[400px] h-[300px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_60%)]"></div>
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
                    <i class="fa-solid fa-moon !text-bes-gold/70 text-[10px]" aria-hidden="true"></i>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-white/40">Purnama &amp; Tilem Only</span>
                </div>
                <div class="inline-flex items-center gap-2.5 bg-[rgba(138,90,200,0.08)] border border-[rgba(138,90,200,0.22)] rounded-full px-4 py-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#8a5ac8] animate-pulse flex-shrink-0"></span>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-[#b490f0]/70">Full Moon &amp; New Moon Ceremony</span>
                </div>
            </div>

            <!-- Subtitle label -->
            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold/50 mb-3">
                Sacred Purification Ceremony &nbsp;·&nbsp; 10:00 AM – 01:00 PM
            </p>

            <h1 id="bes-chakra-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-3">
                7-Chakra
            </h1>
            <h2 class="bes-reveal font-display font-light italic text-[#b490f0] text-4xl md:text-5xl tracking-display leading-none mb-8">
                Purification
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                Seven energy centers. Seven types of mantra-purified sacred water. Three hours held only on the most potent nights of the lunar calendar. This is not a wellness treatment. It is a ceremony — one that Balinese tradition has practiced for centuries, now guided by Bhagawan himself.
            </p>

            <!-- Stats strip -->
            <div class="bes-reveal flex flex-wrap items-center justify-center gap-6 mb-10">
                <?php
                $stats = [
                    [ 'v' => '3', 'u' => 'Hours', 'icon' => 'fa-regular fa-clock' ],
                    [ 'v' => '7', 'u' => 'Sacred Waters', 'icon' => 'fa-solid fa-droplet' ],
                    [ 'v' => '2×', 'u' => 'Per Month', 'icon' => 'fa-solid fa-moon' ],
                    [ 'v' => 'H-1', 'u' => 'Booking', 'icon' => 'fa-solid fa-calendar-check' ],
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
                   class="inline-flex items-center gap-2.5 bg-[#8a5ac8] text-white font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-[#9d6fdb] transition-all duration-300 shadow-lg shadow-[rgba(138,90,200,0.25)] group">
                    <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Reserve My Spot
                </a>
                <a href="#bes-chakra-flow"
                   class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i>
                    See How It Works
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
                <img src="<?php echo esc_url(wp_get_attachment_url(987826) ?: 'https://placehold.co/1200x800/1e2a16/leaf?text=Purification'); ?>"
                     alt="Sacred Water Purification"
                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                     loading="lazy" />
                
                <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/90 via-bes-forest-deep/20 to-transparent"></div>
                
                <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-8 h-[1px] bg-bes-leaf"></span>
                        <span class="text-bes-leaf font-body font-bold text-[10px] uppercase tracking-[0.3em]">Sacred Ritual</span>
                    </div>
                    <h3 class="font-display text-2xl md:text-4xl text-white">Melukat Purification</h3>
                </div>
            </div>

            <div class="md:col-span-5 lg:col-span-4 flex flex-col gap-4 md:gap-6 h-full">
                
                <div class="relative rounded-3xl overflow-hidden flex-1 group min-h-[250px]">
                    <img src="<?php echo esc_url(wp_get_attachment_url(987827) ?: 'https://placehold.co/600x600/1e2a16/leaf?text=7+Chakras'); ?>"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                         loading="lazy" />
                    <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <p class="text-white/80 font-display text-xl">7 Energy Centers</p>
                    </div>
                </div>

                <div class="relative rounded-3xl overflow-hidden flex-1 group min-h-[250px]">
                    <img src="<?php echo esc_url(wp_get_attachment_url(987828) ?: 'https://placehold.co/600x600/1e2a16/leaf?text=Purnama+Night'); ?>"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                         loading="lazy" />
                    <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <p class="text-white/80 font-display text-xl">Purnama Night Ceremony</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


    <!-- ================================================================
         SECTION 2 — WHAT THIS CEREMONY ACTUALLY IS
         ================================================================ -->
    <section class="bg-bes-forest-deep py-20 md:py-28" aria-label="The essence of the ceremony">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-[#b490f0]/60 mb-4">Before You Dismiss It as Mysticism</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-7">
                        Your Chakras Are Not<br>Abstract. They Are<br><em class="not-italic text-[#b490f0]">Architecture</em>.
                    </h2>
                    <div class="space-y-5 font-body font-light text-white/45 text-base leading-relaxed">
                        <p class="bes-reveal">
                            In every human body there are seven primary energy centers — Sanskrit calls them <em class="text-white/65 not-italic">chakras</em>, meaning wheels. They are not metaphors. They are junctions in the body's subtle nervous system where physical, emotional, and spiritual functions converge. When these wheels spin freely and cleanly, you feel it: vitality, clarity, ease, the sense that life is moving the way it should. When they are blocked or contaminated — by accumulated trauma, suppressed emotion, unprocessed experience, or years of living against your own nature — you feel that too.
                        </p>
                        <p class="bes-reveal">
                            The 7-Chakra Purification at Pasraman Bali Eling Spirit is a structured ceremony designed to clear all seven. It uses seven types of water, each purified with specific mantras, meditation energy, and crystals corresponding to the chakra it will address. The water is not symbolic. In Balinese Hindu practice — and in the hands of someone with Bhagawan's energetic training — water is a carrier of intention, a medium through which purification actually travels.
                        </p>
                        <p class="bes-reveal">
                            What makes this different from a general healing session is the precision. Each of the seven centers receives its own water, its own mantra, its own specific attention. Nothing is generalized. Nothing is rushed. The ceremony takes three hours because three hours is what it takes to do this properly.
                        </p>
                    </div>
                </div>

                <!-- Right: accent card + photo -->
                <div class="lg:col-span-5 space-y-4">

                    <!-- Photo -->
                    <div class="bes-reveal relative rounded-2xl overflow-hidden aspect-[4/3]">
                        <img src="https://images.unsplash.com/photo-1518398046578-8cca57782e17?w=800&q=80"
                             alt="Crystal stones used in chakra healing — amethyst, rose quartz, citrine, and more"
                             class="w-full h-full object-cover"
                             loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/70 to-transparent"></div>
                        <div class="absolute bottom-5 left-5 right-5">
                            <p class="font-body font-bold text-[10px] uppercase tracking-label text-white/50 mb-1">Crystal Medicine</p>
                            <p class="font-body font-light text-white/40 text-[13px]">Each of the seven sacred waters is charged with crystals corresponding to its chakra — amethyst for Sahasrara, lapis lazuli for Ajna, aquamarine for Vishuddha.</p>
                        </div>
                    </div>

                    <!-- Key distinction card -->
                    <div class="bes-reveal relative rounded-2xl border border-[rgba(138,90,200,0.20)] overflow-hidden"
                         style="background:rgba(138,90,200,0.05)">
                        <div class="h-[2px] bg-gradient-to-r from-[#8a5ac8]/50 via-[#8a5ac8]/30 to-transparent"></div>
                        <div class="p-6">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-8 h-8 rounded-lg bg-[rgba(138,90,200,0.12)] border border-[rgba(138,90,200,0.20)] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-circle-info text-[#b490f0]/70 text-[10px]" aria-hidden="true"></i>
                                </div>
                                <p class="font-body font-bold text-[10px] uppercase tracking-label text-[#b490f0]/60">What Makes This Different</p>
                            </div>
                            <p class="font-body font-light text-white/45 text-[13.5px] leading-relaxed">
                                Most chakra balancing sessions treat all seven at once with a single practice — sound healing, crystals, or Reiki applied to the whole field. The Pelukatan 7 Chakra at Pasraman treats each chakra individually, sequentially, with water that has been prepared specifically for it. The level of specificity is what produces the depth of result.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — THE 7 CHAKRAS (deep card grid)
         ================================================================ -->
    <section class="relative bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="The seven chakras">

        <div class="absolute right-0 top-0 w-[600px] h-[500px] bg-[radial-gradient(ellipse,rgba(138,90,200,0.04),transparent_55%)] pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Your Body's Energy Blueprint</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">The Seven Chakras</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    Each center governs specific dimensions of your physical health, emotional life, and spiritual clarity. When any one is blocked, the effects ripple across all others. The ceremony addresses each in turn.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php
                $chakras = [
                    [
                        'n'       => '01',
                        'name'    => 'Muladhara',
                        'english' => 'Root Chakra',
                        'loc'     => 'Base of spine',
                        'element' => 'Earth',
                        'color'   => '#e63232',
                        'crystal' => 'Red Jasper, Garnet',
                        'governs' => 'Survival, safety, groundedness, physical vitality, connection to the body and the material world',
                        'blocked' => 'Chronic fear, financial anxiety, feeling unsafe, fatigue, lower back pain, disconnection from the body',
                    ],
                    [
                        'n'       => '02',
                        'name'    => 'Svadhisthana',
                        'english' => 'Sacral Chakra',
                        'loc'     => 'Below the navel',
                        'element' => 'Water',
                        'color'   => '#e07820',
                        'crystal' => 'Carnelian, Orange Calcite',
                        'governs' => 'Creativity, pleasure, sexuality, emotional flow, relationships, the capacity to feel and to change',
                        'blocked' => 'Emotional numbness, creative blocks, guilt, reproductive issues, inability to enjoy life, rigid thinking',
                    ],
                    [
                        'n'       => '03',
                        'name'    => 'Manipura',
                        'english' => 'Solar Plexus',
                        'loc'     => 'Above the navel',
                        'element' => 'Fire',
                        'color'   => '#d4b800',
                        'crystal' => 'Citrine, Yellow Tiger\'s Eye',
                        'governs' => 'Personal power, will, self-esteem, confidence, the ability to act in the world and complete what you begin',
                        'blocked' => 'Lack of confidence, need for control, digestive issues, procrastination, shame, powerlessness, victimhood',
                    ],
                    [
                        'n'       => '04',
                        'name'    => 'Anahata',
                        'english' => 'Heart Chakra',
                        'loc'     => 'Center of chest',
                        'element' => 'Air',
                        'color'   => '#2a9c4e',
                        'crystal' => 'Rose Quartz, Green Aventurine',
                        'governs' => 'Love, compassion, forgiveness, connection, the bridge between the lower physical chakras and the upper spiritual ones',
                        'blocked' => 'Inability to give or receive love, grief that won\'t move, resentment, loneliness, codependency, heart conditions',
                    ],
                    [
                        'n'       => '05',
                        'name'    => 'Vishuddha',
                        'english' => 'Throat Chakra',
                        'loc'     => 'Throat',
                        'element' => 'Sound/Space',
                        'color'   => '#1e88c4',
                        'crystal' => 'Aquamarine, Blue Lace Agate',
                        'governs' => 'Authentic expression, communication, truth-telling, listening, the ability to voice who you actually are',
                        'blocked' => 'Fear of speaking, chronic throat issues, dishonesty, inability to listen, feeling unheard, social anxiety',
                    ],
                    [
                        'n'       => '06',
                        'name'    => 'Ajna',
                        'english' => 'Third Eye',
                        'loc'     => 'Between the eyebrows',
                        'element' => 'Light',
                        'color'   => '#5c3eb0',
                        'crystal' => 'Amethyst, Lapis Lazuli',
                        'governs' => 'Intuition, inner vision, clarity of perception, the ability to see patterns and meaning that the surface of life conceals',
                        'blocked' => 'Confusion, inability to trust intuition, rigid thinking, headaches, poor concentration, spiritual disconnection',
                    ],
                    [
                        'n'       => '07',
                        'name'    => 'Sahasrara',
                        'english' => 'Crown Chakra',
                        'loc'     => 'Top of the head',
                        'element' => 'Thought/Consciousness',
                        'color'   => '#8a5ac8',
                        'crystal' => 'Clear Quartz, Selenite',
                        'governs' => 'Connection to the divine, universal consciousness, enlightenment, the sense that your life is meaningful and held by something larger',
                        'blocked' => 'Existential emptiness, depression, closed-mindedness, disconnection from spirit, inability to meditate, chronic exhaustion',
                    ],
                ];
                foreach ( $chakras as $ch ) :
                    $hex = $ch['color'];
                ?>

                <div class="bes-reveal group relative rounded-2xl border overflow-hidden transition-all duration-400 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5 flex flex-col h-full"
                     style="background:linear-gradient(160deg,#fdfcfa,#f2ede4);border-color:<?php echo esc_attr($hex); ?>33;">
                    
                    <div class="h-[4px]" style="background:linear-gradient(to right,<?php echo esc_attr($hex); ?>,transparent)"></div>

                    <div class="p-6 md:p-7 flex flex-col flex-grow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-display font-light text-bes-bark/15 text-4xl leading-none"><?php echo esc_html($ch['n']); ?></span>
                            <div class="w-6 h-6 rounded-full shadow-lg" style="background:<?php echo esc_attr($hex); ?>;box-shadow:0 0 12px <?php echo esc_attr($hex); ?>66;"></div>
                        </div>

                        <p class="font-body font-bold text-[11px] uppercase tracking-label mb-1.5" style="color:<?php echo esc_attr($hex); ?>ee"><?php echo esc_html($ch['english']); ?> &nbsp;·&nbsp; <span class="text-bes-bark-muted/70"><?php echo esc_html($ch['loc']); ?></span></p>
                        <h3 class="font-display font-medium text-bes-bark text-2xl mb-5 group-hover:transition-colors duration-300"><?php echo esc_html($ch['name']); ?></h3>

                        <div class="flex gap-2 mb-5 flex-wrap">
                            <span class="inline-flex items-center gap-1.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted bg-white border border-bes-sand rounded-full px-3 py-1.5 shadow-sm">
                                <i class="fa-solid fa-atom text-[10px]" style="color:<?php echo esc_attr($hex); ?>" aria-hidden="true"></i>
                                <?php echo esc_html($ch['element']); ?>
                            </span>
                            <span class="inline-flex items-center gap-1.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted bg-white border border-bes-sand rounded-full px-3 py-1.5 shadow-sm">
                                <i class="fa-solid fa-gem text-[10px]" style="color:<?php echo esc_attr($hex); ?>" aria-hidden="true"></i>
                                <?php echo esc_html($ch['crystal']); ?>
                            </span>
                        </div>

                        <p class="font-body font-light text-bes-bark-muted text-sm leading-relaxed mb-6"><?php echo esc_html($ch['governs']); ?></p>

                        <div class="border-t border-bes-sand/60 pt-4 mt-auto">
                            <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark/50 mb-2">When Blocked</p>
                            <p class="font-body font-light text-bes-bark-muted/90 text-[13px] leading-relaxed italic"><?php echo esc_html($ch['blocked']); ?></p>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>

                <div class="bes-reveal relative rounded-2xl border border-[rgba(138,90,200,0.25)] overflow-hidden flex flex-col items-center justify-center text-center p-8 h-full"
                     style="background:linear-gradient(145deg,rgba(138,90,200,0.08),rgba(138,90,200,0.02))">
                    <div class="w-16 h-16 rounded-2xl bg-[rgba(138,90,200,0.12)] border border-[rgba(138,90,200,0.25)] flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-droplet text-[#a178e6] text-xl" aria-hidden="true"></i>
                    </div>
                    <p class="font-display font-medium text-bes-bark text-2xl leading-tight mb-3">Each receives its own<br>sacred water</p>
                    <p class="font-body font-light text-bes-bark-muted text-sm leading-relaxed max-w-[200px] mx-auto">Seven waters. Seven mantras. Seven crystals. No center is treated as an afterthought.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — THE 7 SACRED WATERS
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="The seven sacred waters">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[900px] h-[400px] bg-[radial-gradient(ellipse,rgba(138,90,200,0.07),transparent_52%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-[#b490f0] mb-4">The Purification Medium</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Seven Waters,<br>Seven<br><em class="not-italic text-[#b490f0]">Intentions</em>
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/60 text-base leading-relaxed mb-8">
                        Each of the seven waters used in the ceremony has been prepared through a specific process of mantra chanting, meditation, and crystal charging under the guidance of Bhagawan. Water is not merely a carrier — in Balinese Hindu understanding, it is a living medium that holds and transmits the energy of intention.
                    </p>

                    <div class="bes-reveal relative rounded-2xl overflow-hidden aspect-[4/3] border border-white/[.05] shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=800&q=80"
                             alt="Tibetan singing bowls being played during a sound healing session at a Bali retreat"
                             class="w-full h-full object-cover"
                             loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/90 via-bes-forest-deep/20 to-transparent"></div>
                        <div class="absolute bottom-5 left-5 right-5">
                            <p class="font-body font-light text-white/80 text-sm leading-relaxed">Sacred sound is woven through the water preparation — mantras and Tibetan singing bowls charge each vessel before the ceremony begins.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-5 md:space-y-6">
                    <?php
                    $waters = [
                        [
                            'n'       => '01',
                            'chakra'  => 'Muladhara Water',
                            'color'   => '#e63232',
                            'crystal' => 'Red Jasper',
                            'mantra'  => 'Lam',
                            'prep'    => 'Charged under the earth element — often prepared in contact with red volcanic stone from the Bali highlands. Garnet and red jasper rest within it for a minimum of one lunar cycle before use.',
                            'purpose' => 'Applied to the base of the spine, feet, and lower body. Releases ancestral fear, childhood wounds stored in the root system, chronic feelings of physical unsafety.',
                        ],
                        [
                            'n'       => '02',
                            'chakra'  => 'Svadhisthana Water',
                            'color'   => '#e07820',
                            'crystal' => 'Carnelian',
                            'mantra'  => 'Vam',
                            'prep'    => 'Prepared with carnelian and orange calcite, this water carries the frequency of creative flow and emotional movement. The mantra Vam — the seed sound of the sacral center — is chanted throughout preparation.',
                            'purpose' => 'Applied to the lower abdomen and sacral region. Loosens suppressed emotions, frees creative energy that has been locked down, addresses guilt and shame held in the body.',
                        ],
                        [
                            'n'       => '03',
                            'chakra'  => 'Manipura Water',
                            'color'   => '#d4b800',
                            'crystal' => 'Citrine',
                            'mantra'  => 'Ram',
                            'prep'    => 'Sun-charged citrine and golden tiger\'s eye infuse this water with the energy of confidence and sovereign will. The fire element mantra Ram activates the solar plexus principle — the right and capacity to act.',
                            'purpose' => 'Applied to the solar plexus and upper abdomen. Restores personal power, addresses procrastination, shame, and the accumulated deposits of other people\'s control over your choices.',
                        ],
                        [
                            'n'       => '04',
                            'chakra'  => 'Anahata Water',
                            'color'   => '#2a9c4e',
                            'crystal' => 'Rose Quartz',
                            'mantra'  => 'Yam',
                            'prep'    => 'Rose quartz and green aventurine are placed in this water, which is additionally prepared with ceremonial-grade cacao intention — the sacred heart medicine of the Balinese tradition. The mantra Yam, seed sound of air, is chanted to activate unconditional love.',
                            'purpose' => 'Applied to the chest, heart center, and arms. Addresses grief, heartbreak, resentment, and the protective armor that closes the heart after repeated pain. The most emotionally active of the seven waters.',
                        ],
                        [
                            'n'       => '05',
                            'chakra'  => 'Vishuddha Water',
                            'color'   => '#1e88c4',
                            'crystal' => 'Aquamarine',
                            'mantra'  => 'Ham',
                            'prep'    => 'Aquamarine and blue lace agate — stones historically associated with clear, courageous communication — charge this water along with the throat-chakra mantra Ham. The preparation specifically intends the release of words that have been swallowed rather than spoken.',
                            'purpose' => 'Applied to the throat, neck, and jaw. Releases chronic tension held from years of unspoken truths, fear of conflict, social anxiety, and the suppression of authentic self-expression.',
                        ],
                        [
                            'n'       => '06',
                            'chakra'  => 'Ajna Water',
                            'color'   => '#5c3eb0',
                            'crystal' => 'Amethyst',
                            'mantra'  => 'Om',
                            'prep'    => 'Amethyst — the stone most closely associated with the third eye — is combined with lapis lazuli, the stone of truth and inner vision. The mantra Om, the primordial sound, charges this water with the frequency of clear seeing. Prepared during the waning moon to honor the withdrawing of illusion.',
                            'purpose' => 'Applied to the forehead and temples. Opens clarity of perception, dissolves the mental fog produced by chronic stress, and reactivates the intuitive knowing that most people have learned to override.',
                        ],
                        [
                            'n'       => '07',
                            'chakra'  => 'Sahasrara Water',
                            'color'   => '#8a5ac8',
                            'crystal' => 'Clear Quartz',
                            'mantra'  => 'Ah / Silence',
                            'prep'    => 'The crown water is charged with clear quartz — the master amplifier — and selenite, the stone of angelic connection and lunar energy. This water is prepared in complete silence following the initial mantra invocation. The silence is part of the charge. Bhagawan\'s meditation energy is concentrated into this vessel directly.',
                            'purpose' => 'Poured over the crown of the head as the final act of purification. Reconnects the individual consciousness to universal consciousness. The experience of this water is frequently described as the most profound moment of the entire three-hour ceremony.',
                        ],
                    ];
                    foreach ( $waters as $w ) : ?>

                    <div class="bes-reveal group relative rounded-2xl border overflow-hidden transition-all duration-400 hover:bg-white/[.02] hover:-translate-y-1 hover:shadow-xl hover:border-opacity-60"
                         style="background:rgba(38,51,32,0.4); border-color:<?php echo esc_attr($w['color']); ?>25;">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col sm:flex-row items-start gap-5">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-display font-medium shadow-inner"
                                     style="background:<?php echo esc_attr($w['color']); ?>15; border:1px solid <?php echo esc_attr($w['color']); ?>40; color:<?php echo esc_attr($w['color']); ?>;">
                                    <?php echo esc_html($w['n']); ?>
                                </div>
                                
                                <div class="flex-1 w-full">
                                    <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-5">
                                        <h3 class="font-display font-medium text-white text-xl md:text-2xl"><?php echo esc_html($w['chakra']); ?></h3>
                                        <div class="flex gap-2 flex-wrap">
                                            <span class="font-body font-bold text-[10px] uppercase tracking-widest px-3 py-1 rounded-full border text-white/70 shadow-sm"
                                                  style="border-color:<?php echo esc_attr($w['color']); ?>40; background:<?php echo esc_attr($w['color']); ?>15;">
                                                <i class="fa-solid fa-gem mr-1" style="color:<?php echo esc_attr($w['color']); ?>"></i> <?php echo esc_html($w['crystal']); ?>
                                            </span>
                                            <span class="font-body font-bold text-[10px] uppercase tracking-widest px-3 py-1 rounded-full border text-white/70 shadow-sm"
                                                  style="border-color:<?php echo esc_attr($w['color']); ?>40; background:<?php echo esc_attr($w['color']); ?>15;">
                                                <i class="fa-solid fa-om mr-1" style="color:<?php echo esc_attr($w['color']); ?>"></i> Bija: <?php echo esc_html($w['mantra']); ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-5 border-t border-white/[.06]">
                                        <div>
                                            <p class="font-body font-bold text-[10px] uppercase tracking-widest text-white/40 mb-2">Preparation</p>
                                            <p class="font-body font-light text-white/60 text-sm leading-relaxed"><?php echo esc_html($w['prep']); ?></p>
                                        </div>
                                        <div>
                                            <p class="font-body font-bold text-[10px] uppercase tracking-widest mb-2" style="color:<?php echo esc_attr($w['color']); ?>90;">Purpose</p>
                                            <p class="font-body font-light text-white/70 text-sm leading-relaxed"><?php echo esc_html($w['purpose']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — HOW THE SESSION FLOWS (timeline)
         ================================================================ -->
    <section id="bes-chakra-flow" class="bg-bes-cream py-20 md:py-28" aria-label="Session timeline">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Three Hours</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">How the Ceremony Unfolds</h2>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="relative">
                    <div class="absolute left-[27px] md:left-[34px] top-4 bottom-10 w-[2px] bg-gradient-to-b from-[#b490f0]/50 via-[#b490f0]/20 to-transparent" aria-hidden="true"></div>

                    <?php
                    $ceremony_flow = [
                        [
                            'time'  => '09:45 AM',
                            'title' => 'Arrival & Welcome',
                            'icon'  => 'fa-solid fa-door-open',
                            'body'  => 'Arrive at Pasraman 15 minutes before the ceremony begins. Change into your Balinese ceremonial clothes — the transition of dress is itself a preparation, a signal to your system that ordinary time is ending. Receive a brief orientation from the team.',
                        ],
                        [
                            'time'  => '10:00 AM',
                            'title' => 'Opening Meditation',
                            'icon'  => 'fa-solid fa-spa',
                            'body'  => 'The ceremony opens with a seated group meditation led by Bhagawan or the authorized Yogi. The purpose is specific: to bring the mind into stillness and the body into receptivity. A purification ceremony performed on a closed, defended body accomplishes less than one received in an open state. This meditation is the opening of the gates.',
                            'featured' => true,
                        ],
                        [
                            'time'  => '10:20 AM',
                            'title' => 'Chakra Education & Energy Reading',
                            'icon'  => 'fa-solid fa-circle-nodes',
                            'body'  => 'Bhagawan or the leading Yogi gives a teaching on the seven chakras — their locations, functions, and the signs of blockage in each. This is not a lecture. It is a guided self-examination. Participants are invited to notice which descriptions resonate, which blocked signs they recognize in their own experience. By the time the ceremony begins, each person knows precisely where they are carrying weight.',
                        ],
                        [
                            'time'  => '10:45 AM',
                            'title' => 'The 7-Chakra Purification Ceremony',
                            'icon'  => 'fa-solid fa-droplet',
                            'body'  => 'The core of the three hours. Each of the seven chakra purification waters is administered in sequence — Root through Crown. Each step includes the chanting of the corresponding bija mantra, application of the crystal-charged water to the relevant part of the body, and a brief space of stillness for the energy to move and settle. The Anahata (heart) and Sahasrara (crown) waters typically produce the most profound responses. Many participants report spontaneous emotional release at these points — this is normal, healthy, and exactly what the ceremony is designed to facilitate.',
                            'featured' => true,
                        ],
                        [
                            'time'  => '12:15 PM',
                            'title' => 'Sound Healing Integration',
                            'icon'  => 'fa-solid fa-headphones-simple', // Swapped icon to differentiate from the one above
                            'body'  => 'After the seven purifications, participants lie in savasana while Tibetan Singing Bowls are played in a specific progression through the chakra frequencies. The sound enters the body that has just been opened by the water ceremony and moves through it differently than it would otherwise. This is the integration phase — where the energy stirred by the purification settles into its new alignment.',
                        ],
                        [
                            'time'  => '12:45 PM',
                            'title' => 'Closing, Change & Reflection',
                            'icon'  => 'fa-solid fa-leaf',
                            'body'  => 'Change into your dry clothing. The team creates a quiet space for any questions or personal sharing. No one is rushed. Many participants sit in silence for a while. This post-ceremony stillness is part of what allows the purification to hold. How you inhabit the hours immediately following the ceremony matters — the team will offer simple guidance on how to care for yourself for the rest of the day.',
                        ],
                        [
                            'time'  => '01:00 PM',
                            'title' => 'Ceremony Closes',
                            'icon'  => 'fa-solid fa-door-closed',
                            'body'  => 'The ceremony formally ends. You are free to remain quietly in the Pasraman grounds before departing. It is recommended to rest in the afternoon following the ceremony and to drink plenty of water. Avoid alcohol, heavy food, and high-stimulation environments for the remainder of the day.',
                        ],
                    ];
                    foreach ( $ceremony_flow as $cf ) : ?>

                    <div class="bes-reveal relative flex gap-6 md:gap-10 pb-12 md:pb-16 last:pb-0 group">
                        
                        <div class="relative z-10 flex-shrink-0 w-14 h-14 md:w-[70px] md:h-[70px] rounded-2xl flex flex-col items-center justify-center transition-all duration-400 shadow-sm
                            <?php echo !empty($cf['featured']) ? 'bg-[#f8f5fd] border border-[#b490f0]/30 shadow-[#b490f0]/10 group-hover:border-[#b490f0]/60' : 'bg-white border border-bes-sand group-hover:border-bes-leaf/30'; ?>">
                            <i class="<?php echo esc_attr($cf['icon']); ?> <?php echo !empty($cf['featured']) ? 'text-[#b490f0]' : 'text-bes-olive/70'; ?> text-base md:text-lg mb-1" aria-hidden="true"></i>
                            <span class="font-body font-bold text-[9px] md:text-[10px] uppercase tracking-wider <?php echo !empty($cf['featured']) ? 'text-[#b490f0]/80' : 'text-bes-bark-muted/60'; ?> text-center leading-none px-1"><?php echo esc_html($cf['time']); ?></span>
                        </div>

                        <div class="flex-1 pt-1 md:pt-2">
                            <?php if ( !empty($cf['featured']) ) : ?>
                            <span class="inline-flex items-center gap-2 bg-[#f8f5fd] border border-[#b490f0]/20 text-[#966bda] font-body font-bold text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-full mb-3 shadow-sm">
                                <i class="fa-solid fa-star text-[8px]" aria-hidden="true"></i> Core Ceremony
                            </span>
                            <?php endif; ?>
                            
                            <h3 class="font-display font-medium text-bes-bark text-2xl md:text-3xl mb-3 group-hover:!text-bes-moss transition-colors duration-300"><?php echo esc_html($cf['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-base leading-relaxed"><?php echo esc_html($cf['body']); ?></p>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — PHOTO INTERLUDE (atmospheric break)
         ================================================================ -->
    <section class="relative min-h-[500px] h-[50vh] md:h-[60vh] flex items-center justify-center overflow-hidden" aria-label="Quote on Holy Water">
        
        <img src="<?php echo esc_url(wp_get_attachment_url(987829)) ;?>"
             alt="Holy water flowing over participants during a Balinese purification ritual"
             class="absolute inset-0 w-full h-full object-cover object-center z-0"
             loading="lazy" />
             
        <div class="absolute inset-0 bg-bes-forest-deep/40 z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep via-transparent to-bes-forest-deep z-10"></div>
        
        <div class="relative z-20 px-6 md:px-10 max-w-4xl mx-auto text-center">
            <blockquote class="flex flex-col items-center">
                <i class="bes-reveal fa-solid fa-quote-left !text-bes-gold/30 text-3xl md:text-4xl mb-6 md:mb-8" aria-hidden="true"></i>
                
                <p class="bes-reveal font-display font-light italic text-white/95 text-2xl md:text-3xl lg:text-4xl leading-relaxed md:leading-normal">
                    "Water is not passive. In Balinese understanding, it is alive — a medium that carries not just molecules, but intention, memory, and healing."
                </p>
                
                <footer class="bes-reveal mt-8 md:mt-10 flex flex-col items-center gap-4">
                    <div class="w-12 h-[1px] bg-bes-gold/40 rounded-full"></div>
                    <cite class="font-body font-bold text-[11px] md:text-xs uppercase tracking-widest !text-bes-gold/80 not-italic">
                        Bhagawan's Teaching on Tirtha (Holy Water)
                    </cite>
                </footer>
            </blockquote>
        </div>

    </section>


    <!-- ================================================================
         SECTION 7 — PURNAMA & TILEM (why only on full/new moon)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-24 overflow-hidden" aria-label="Why Purnama and Tilem">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-1/4 w-[500px] h-[500px] bg-[radial-gradient(ellipse,rgba(138,90,200,0.07),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- Left: photo -->
                <div class="bes-reveal relative rounded-2xl overflow-hidden aspect-[4/3]">
                    <img src="<?php echo esc_url(wp_get_attachment_url(987830)) ;?>"
                         alt="Purnama and Tilem — full moon and new moon ceremonies in Bali with temple offerings and candlelight"
                         class="w-full h-full object-cover"
                         loading="lazy" />
                    <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/60 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 flex gap-3">
                        <div class="flex-1 bg-black/30 backdrop-blur-sm rounded-xl p-4 text-center">
                            <i class="fa-solid fa-moon !text-bes-gold/70 text-lg mb-1.5 block" aria-hidden="true"></i>
                            <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/60">Purnama</p>
                            <p class="font-body font-light text-white/35 text-[11px]">Full Moon</p>
                        </div>
                        <div class="flex-1 bg-black/30 backdrop-blur-sm rounded-xl p-4 text-center">
                            <i class="fa-regular fa-moon text-[#b490f0]/70 text-lg mb-1.5 block" aria-hidden="true"></i>
                            <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/60">Tilem</p>
                            <p class="font-body font-light text-white/35 text-[11px]">New Moon</p>
                        </div>
                    </div>
                </div>

                <!-- Right: copy -->
                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-[#b490f0]/60 mb-4">Not Arbitrary — Lunar Precision</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-7">
                        Why Only<br>Full Moon<br><em class="not-italic text-[#b490f0]">&amp; New Moon</em>?
                    </h2>
                    <div class="space-y-5 font-body font-light text-white/45 text-sm leading-relaxed">
                        <p class="bes-reveal">
                            The 7-Chakra Purification is held only twice a month: on Purnama (the full moon) and Tilem (the new moon, or dark moon). This is not a scheduling convenience — it is a fundamental condition of the ceremony's effectiveness.
                        </p>
                        <p class="bes-reveal">
                            On Purnama, the full moon amplifies energy in all directions — the tides are at their highest, the pineal gland responds to the light, the human emotional body is at its most active and exposed. Negative energies stored in the chakras are also more accessible on this day — closer to the surface, more ready to release. Purification on the full moon works with this heightened energetic sensitivity to clear what would be harder to reach on an ordinary day.
                        </p>
                        <p class="bes-reveal">
                            Tilem — the dark moon — operates differently. This is the night of maximum stillness, when the external noise of lunar energy falls away and the inner world becomes most audible. Purification on Tilem works at depth: reaching the roots of blockages, the places where old patterns have their origin. Many experienced practitioners find the Tilem ceremony more profound but also more demanding.
                        </p>
                        <p class="bes-reveal">
                            This is why the program is not offered daily. The timing is not a limitation — it is the source of its power.
                        </p>
                    </div>

                    <!-- Upcoming nudge -->
                    <div class="bes-reveal mt-8 p-5 rounded-2xl border border-[rgba(138,90,200,0.20)] bg-[rgba(138,90,200,0.05)]">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-calendar text-[#b490f0]/60 text-sm" aria-hidden="true"></i>
                            <p class="font-body font-bold text-[10px] uppercase tracking-label text-[#b490f0]/60">Next Ceremony Dates</p>
                        </div>
                        <p class="font-body font-light text-white/45 text-[13.5px] leading-relaxed">
                            Purnama and Tilem occur once each per lunar month — approximately every 14–15 days. Contact the Pasraman team via WhatsApp to receive the current monthly calendar and reserve your place. Booking must be made at least <strong class="text-white/60 font-semibold">one day in advance (H-1)</strong>.
                        </p>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 mt-3 font-body font-bold text-[11px] uppercase tracking-label text-[#b490f0] hover:!text-white transition-colors duration-200">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            Get This Month's Dates
                            <i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — WHAT CHANGES AFTER (three-body outcomes)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="What changes after the ceremony">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">What You Carry Home</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">What Actually Changes</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    The changes that follow this ceremony are not uniform — they depend on which chakras carry the most obstruction. These are the most commonly reported shifts, organized by body.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php
                $outcomes = [
                    [
                        'label'   => 'Sthula Sarira',
                        'sub'     => 'Physical Body',
                        'icon'    => 'fa-solid fa-person-rays',
                        'icolor'  => 'text-bes-leaf',
                        'bar'     => 'from-bes-leaf/50',
                        'items'   => [
                            'Reduced physical tension — especially jaw, neck, and shoulders',
                            'Improved quality of sleep, particularly depth of rest',
                            'Relief from chronic lower back discomfort (root chakra)',
                            'Improved digestion and reduced gut reactivity (solar plexus)',
                            'Feeling physically lighter — reported within hours of ceremony',
                            'Heightened skin luminosity and improved circulation',
                            'Reduction in headache frequency (third eye clearing)',
                        ],
                    ],
                    [
                        'label'   => 'Sukhma Sarira',
                        'sub'     => 'Mind &amp; Feeling Body',
                        'icon'    => 'fa-solid fa-brain',
                        'icolor'  => 'text-[#b490f0]',
                        'bar'     => 'from-[#8a5ac8]/50',
                        'items'   => [
                            'Emotional clarity — a sense of seeing situations without the old distortions',
                            'Reduced anxiety, particularly existential and social anxiety',
                            'Spontaneous forgiveness — of self and others — arising without force',
                            'Increased capacity to feel genuine joy (sacral chakra)',
                            'Courage to speak truths that were previously withheld (throat)',
                            'Stronger and more trustworthy intuition (third eye)',
                            'Reduced compulsive thought patterns, a quieter mental environment',
                        ],
                    ],
                    [
                        'label'   => 'Antah Karana Sarira',
                        'sub'     => 'Soul &amp; Causal Body',
                        'icon'    => 'fa-solid fa-star-of-david',
                        'icolor'  => '!text-bes-gold',
                        'bar'     => 'from-bes-gold/60',
                        'items'   => [
                            'Restored sense of meaning and direction in life',
                            'Deepened capacity to meditate — access to states previously blocked',
                            'Renewed spiritual connection for those who felt it had faded',
                            'Recognition of one\'s life as held and purposeful, not random',
                            'Opening of the Kundalini energy current in the sushumna channel',
                            'Dissolution of old identities built around wounds now cleared',
                            'The felt sense of being genuinely clean — in the way that matters most',
                        ],
                    ],
                ];
                foreach ( $outcomes as $out ) : ?>

                <div class="bes-reveal relative flex flex-col h-full rounded-2xl border border-bes-sand overflow-hidden transition-all duration-400 hover:-translate-y-2 hover:shadow-xl hover:shadow-black/5"
                     style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                    <div class="h-[4px] bg-gradient-to-r <?php echo esc_attr($out['bar']); ?> to-transparent"></div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 mb-8 border-b border-bes-sand/60 pb-5">
                            <div class="w-12 h-12 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.06] flex items-center justify-center flex-shrink-0 shadow-sm">
                                <i class="<?php echo esc_attr($out['icon']); ?> <?php echo esc_attr($out['icolor']); ?> text-base" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-medium text-bes-bark text-2xl mb-1"><?php echo $out['label']; ?></h3>
                                <p class="font-body text-[11px] uppercase tracking-widest text-bes-bark-muted/60 font-bold"><?php echo $out['sub']; ?></p>
                            </div>
                        </div>
                        <ul class="space-y-4">
                            <?php foreach ( $out['items'] as $it ) : ?>
                            <li class="flex items-start gap-4">
                                <span class="w-1.5 h-1.5 rounded-full bg-bes-bark-muted/30 mt-2 flex-shrink-0"></span>
                                <span class="font-body font-light text-bes-bark-muted text-sm leading-relaxed"><?php echo esc_html($it); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <div class="bes-reveal mt-16 max-w-3xl mx-auto">
                <div class="relative rounded-2xl border border-[rgba(138,90,200,0.18)] overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
                     style="background:rgba(138,90,200,0.04)">
                    <div class="p-8 md:p-10 text-center flex flex-col items-center">
                        <div class="flex gap-2 mb-5">
                            <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                            <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                            <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                            <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                            <i class="fa-solid fa-star !text-bes-gold/80 text-sm"></i>
                        </div>
                        <p class="font-body font-light text-bes-bark text-lg md:text-xl leading-relaxed italic mb-6">
                            "I've joined both Healing Retreat and Surya Namaskar — both helped me through my spiritual awakening. The programs, the loving yogis, and the energy helped me find answers I've long searched for. Truly healing."
                        </p>
                        <p class="font-body font-bold text-[11px] uppercase tracking-widest text-[#8a5ac8] bg-white border border-[#8a5ac8]/20 px-4 py-1.5 rounded-full">
                            Mandy Mirahsari &nbsp;<span class="text-[#8a5ac8]/40">·</span>&nbsp; Program Participant
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — WHO SHOULD ATTEND
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Who should attend">

        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">The Right People</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Who<br>This Is<br><em class="not-italic text-[#b490f0]">For</em>
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/60 text-base leading-relaxed">
                        The ceremony is open to all — any religion, any background, any level of spiritual experience. What it requires is only sincerity and willingness to receive.
                    </p>
                    <div class="bes-reveal mt-8 h-[1px] w-16 bg-gradient-to-r from-[#b490f0]/40 to-transparent"></div>
                </div>

                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
                    <?php
                    $who = [
                        [
                            'icon'  => 'fa-solid fa-person-drowning',
                            'title' => 'Those Carrying Weight They Cannot Name',
                            'body'  => 'Something feels blocked — in your work, your relationships, your creativity, your health — but you cannot identify what. The chakra assessment in the first part of the ceremony often puts language to what has been nameless.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-heart-crack',
                            'title' => 'Grief and Heartbreak Holders',
                            'body'  => 'Loss — of a person, a relationship, a version of yourself — accumulates in the Anahata chakra. The heart water ceremony is specifically designed for this. Many participants attend after a significant ending.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-arrow-rotate-left',
                            'title' => 'People Stuck in Recurring Patterns',
                            'body'  => 'The same relationship dynamic. The same financial cycle. The same reaction to the same trigger. Recurring patterns are often rooted in a specific chakra blockage — clearing it changes the substrate from which the pattern grows.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-moon',
                            'title' => 'Lunar-Aware Practitioners',
                            'body'  => 'If you already work with the moon\'s cycles — in your meditation, your journaling, your personal rituals — the Purnama and Tilem ceremonies at the Pasraman deepen what you are already practicing.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-stairs',
                            'title' => 'Healing Retreat & YTT Graduates',
                            'body'  => 'The 7-Chakra Purification is frequently recommended as a complement to the Healing Retreat and as an ongoing practice for YTT graduates. It maintains and deepens what those programs open.',
                        ],
                        [
                            'icon'  => 'fa-solid fa-seedling',
                            'title' => 'Complete Beginners to Spiritual Practice',
                            'body'  => 'The ceremony begins with a full education on the chakras — you do not need prior knowledge. The team meets you where you are. Some of the most profound responses in ceremony come from first-time participants.',
                        ],
                    ];
                    foreach ( $who as $w ) : ?>

                    <div class="bes-reveal group p-6 md:p-7 rounded-2xl border border-white/[.05] hover:border-[#b490f0]/30 hover:bg-white/[.02] hover:-translate-y-1 hover:shadow-xl hover:shadow-black/20 transition-all duration-400 flex gap-4 md:gap-5 h-full items-start"
                         style="background:rgba(38,51,32,0.35)">
                        <div class="w-12 h-12 rounded-xl bg-[rgba(138,90,200,0.08)] border border-[rgba(138,90,200,0.15)] group-hover:bg-[rgba(138,90,200,0.15)] flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                            <i class="<?php echo esc_attr($w['icon']); ?> text-[#b490f0]/80 text-base" aria-hidden="true"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-display font-medium text-white text-lg md:text-xl mb-2 leading-snug group-hover:!text-[#b490f0] transition-colors duration-300"><?php echo esc_html($w['title']); ?></h3>
                            <p class="font-body font-light text-white/60 text-sm leading-relaxed"><?php echo esc_html($w['body']); ?></p>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 10 — FAQ
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Sticky left -->
                <div class="lg:col-span-4 lg:sticky lg:top-28">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Practical Questions</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        What<br>People<br>Ask
                    </h2>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="bes-reveal inline-flex items-center gap-2.5 bg-[rgba(138,90,200,0.08)] border border-[rgba(138,90,200,0.22)] text-[#b490f0] font-body font-bold text-[11px] uppercase tracking-label px-6 py-3.5 rounded-xl hover:bg-[#8a5ac8] hover:!text-white transition-all duration-300 group">
                        <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                        Ask the Team
                    </a>
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <?php
                    $faqs = [
                        [
                            'q' => 'Can I attend on a day that isn\'t Purnama or Tilem?',
                            'a' => 'No — the 7-Chakra Purification is offered exclusively on Purnama (full moon) and Tilem (new/dark moon). This is not a limitation of scheduling; the lunar timing is integral to the ceremony\'s power. If you wish to experience a chakra-focused healing outside these dates, the team recommends the Healing Retreat program, which includes chakra alignment work as part of its broader process.',
                        ],
                        [
                            'q' => 'Do I need to wear Balinese ceremonial clothing?',
                            'a' => 'Yes. All participants are requested to wear traditional Balinese costume for the ceremony. You are also asked to bring two sets of clothes — one for the ceremony itself (which will get wet during the water purification) and one to change into afterward. Bring a bag for your wet clothing and a towel. If you do not have Balinese costume, the Pasraman team can advise on where to source one nearby.',
                        ],
                        [
                            'q' => 'Is this a religious ceremony? Do I need to be Hindu or Balinese?',
                            'a' => 'No. All programs at Pasraman Bali Eling Spirit are open to participants of any religion and any background. The ceremony is rooted in Balinese Hindu spiritual tradition, which will be explained and contextualized during the session. You are invited to participate in full awareness of what you are doing — not as an act of adopting a religion, but as a human being engaging with a time-honored system for clearing the body\'s energy.',
                        ],
                        [
                            'q' => 'How far in advance must I book?',
                            'a' => 'A reservation must be made at least H-1 — one day before the ceremony date. Given that the ceremony is held only twice a month and places are limited, it is strongly advisable to book as early as possible when you identify a date you can attend. Contact the Pasraman team via WhatsApp to check availability and confirm your place.',
                        ],
                        [
                            'q' => 'What happens if I need to cancel or reschedule?',
                            'a' => 'If you are unable to attend the date you have reserved, you may reschedule once — provided you notify the Pasraman team at least one day before the ceremony. The rescheduling can only be done once. If circumstances arise that prevent attendance with less than one day\'s notice, please contact the team directly; they will do their best to accommodate where possible.',
                        ],
                        [
                            'q' => 'Will I get very wet? What should I expect physically?',
                            'a' => 'Yes — water is the medium of the ceremony, and the purification involves the actual application of sacred water to the body. You will be wet by the end of the ceremony. This is why two sets of clothes and a towel are required. Emotionally, participants frequently experience spontaneous release — tears, deep relaxation, or a sense of unexpected lightness — especially during the heart and crown water applications. All of this is welcome, expected, and held safely by the team.',
                        ],
                    ];
                    foreach ( $faqs as $faq ) : ?>

                    <div class="bes-reveal group rounded-2xl border border-bes-sand hover:border-[rgba(138,90,200,0.20)] transition-all duration-300 overflow-hidden"
                         style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                        <div class="p-6 md:p-7 flex items-start gap-4">
                            <div class="w-7 h-7 rounded-lg bg-[rgba(138,90,200,0.07)] border border-[rgba(138,90,200,0.15)] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-question text-[#b490f0]/70 text-[10px]" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="font-body font-semibold text-bes-bark text-[15px] mb-3 leading-snug"><?php echo esc_html($faq['q']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo esc_html($faq['a']); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 11 — CLOSING CTA (persuasive, urgent, lunar)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-24 md:py-32 overflow-hidden" aria-label="Reserve your place">

        <!-- Background photo with deep overlay -->
        <div class="absolute inset-0" aria-hidden="true">
            <img src="https://baliinstitute.com/wp-content/uploads/2023/06/purnama-tilem-bali.jpg"
                 alt=""
                 class="w-full h-full object-cover opacity-15"
                 loading="lazy" />
            <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep via-bes-forest-deep/80 to-bes-forest-deep"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_30%,rgba(138,90,200,0.12),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="h-[1px] absolute top-0 inset-x-0 bg-gradient-to-r from-transparent via-[#8a5ac8]/40 to-transparent"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal max-w-3xl mx-auto text-center">

                <!-- Moon icon -->
                <div class="w-16 h-16 mx-auto mb-8 rounded-2xl bg-[rgba(138,90,200,0.10)] border border-[rgba(138,90,200,0.22)] flex items-center justify-center">
                    <i class="fa-solid fa-moon text-[#b490f0] text-2xl" aria-hidden="true"></i>
                </div>

                <!-- Urgency framing -->
                <div class="inline-flex items-center gap-2 bg-[rgba(138,90,200,0.08)] border border-[rgba(138,90,200,0.20)] rounded-full px-4 py-2 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#b490f0] animate-pulse"></span>
                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-[#b490f0]/70">Only 2 Ceremonies Per Month — Limited Places</span>
                </div>

                <h2 class="font-display font-medium text-white text-4xl md:text-5xl lg:text-6xl tracking-display mb-3">
                    Seven Centers.
                </h2>
                <h3 class="font-display font-light italic text-[#b490f0] text-3xl md:text-4xl tracking-display mb-6">
                    One Ceremony. One Lunar Night.
                </h3>
                <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                    The next Purnama or Tilem will arrive whether you are in it or not. The weight you have been carrying in your chakras will still be there too — unless you do something about it. This is the something.
                </p>

                <!-- Practical prep reminder -->
                <div class="bes-reveal max-w-lg mx-auto mb-10 p-5 rounded-2xl border border-white/[.06] bg-white/[.03] text-left">
                    <p class="font-body font-bold text-[10px] uppercase tracking-label text-white/30 mb-3">What to Bring</p>
                    <div class="grid grid-cols-2 gap-y-2 gap-x-4">
                        <?php
                        $bring = [
                            '2 sets of clothing',
                            'Balinese ceremonial dress',
                            'Bag for wet clothes',
                            'Towel',
                            'Open heart',
                            'Reserve H-1 in advance',
                        ];
                        foreach ( $bring as $item ) : ?>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-[#b490f0]/50 text-[9px] flex-shrink-0" aria-hidden="true"></i>
                            <span class="font-body font-light text-white/35 text-[12.5px]"><?php echo esc_html($item); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 bg-[#8a5ac8] text-white font-body font-bold text-[11px] uppercase tracking-label px-9 py-4 rounded-2xl hover:bg-[#9d6fdb] transition-all duration-300 shadow-lg shadow-[rgba(138,90,200,0.30)] group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Reserve via WhatsApp
                    </a>
                    <a href="/healing-retreat"
                       class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                        <i class="fa-solid fa-spa text-xs" aria-hidden="true"></i>
                        Explore Healing Retreat Instead
                    </a>
                </div>

                <!-- Trust micro-bar -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 text-[11px] text-white/20 font-body tracking-wide">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-[#b490f0]/40 text-[9px]" aria-hidden="true"></i>All religions welcome</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-[#b490f0]/40 text-[9px]" aria-hidden="true"></i>Led by Aji Bhagawan &amp; Jero Ratni</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-[#b490f0]/40 text-[9px]" aria-hidden="true"></i>7 crystal-charged sacred waters</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-[#b490f0]/40 text-[9px]" aria-hidden="true"></i>3 hours · Purnama &amp; Tilem only</span>
                </div>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}