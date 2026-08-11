<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_surya_namaskar] Shortcode
 * ============================================================================
 *
 * Registers [bes_surya_namaskar] for the Surya Namaskar Daily Retreat page.
 * 100% aligned with BES v3 design system (Snippet 1):
 *   - Tailwind BES color tokens, font-display, font-body
 *   - tracking-nav / tracking-label / tracking-display
 *   - bes-reveal entrance animations, bes-fret dividers
 *   - Zero new CSS — rides the existing stylesheet entirely
 *
 * SECTIONS (10 total):
 *   0  Cinematic Hero — golden-hour sun energy, morning program badge
 *   1  What This Morning Is — narrative essence (not just exercise)
 *   2  The 12 Poses — visual sequence grid with Sanskrit names + purpose
 *   3  The 12 Solar Mantras — sacred name + meaning table
 *   4  Full Session Flow — timeline: pre-dawn to post-breakfast
 *   5  Why Morning Matters — science + spiritual case for sunrise practice
 *   6  What You Gain — three-body outcomes (physical / subtle / soul)
 *   7  Three Levels Taught — BES Surya Namaskar L1 / L2 / L3
 *   8  Who Should Come — honest profile grid
 *   9  FAQ
 *  10  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_surya_namaskar', 'bes_render_surya_namaskar' );

function bes_render_surya_namaskar( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — CINEMATIC HERO
         ================================================================ -->
    <section class="relative min-h-[85vh] flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-sn-heading">

        <!-- Layered sunrise-inspired glows — gold dominates here -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.1),transparent_55%)]"></div>
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_60%)]"></div>
            <div class="absolute bottom-0 inset-x-0 h-48 bg-gradient-to-t from-bes-forest-deep to-transparent"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Fretwork strip top -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">

            <!-- Morning program badge -->
            <div class="bes-reveal inline-flex items-center gap-2.5 bg-bes-gold/[.08] border border-bes-gold/[.20] rounded-full px-5 py-2 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-bes-gold animate-pulse flex-shrink-0"></span>
                <span class="font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold">Daily Morning Program &nbsp;·&nbsp; Sunrise to Breakfast</span>
            </div>

            <!-- Sanskrit invocation -->
            <p class="bes-reveal font-display font-light italic text-white/25 text-xl md:text-2xl mb-3">
                "Sūryāya namaḥ"
            </p>
            <p class="bes-reveal font-body font-bold text-[9px] uppercase tracking-nav !text-bes-gold/40 mb-8">
                Salutation to the Sun — the source of all life and consciousness
            </p>

            <h1 id="bes-sn-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[6rem] tracking-display leading-none mb-3">
                Surya Namaskar
            </h1>
            <h2 class="bes-reveal font-display font-light italic !text-bes-gold text-3xl md:text-4xl tracking-display leading-none mb-8">
                The Daily Retreat
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                Twelve sacred postures. Twelve solar mantras. Meditation, pranayama, sound healing, and a nourishing breakfast — woven into one morning practice that resets every system in your body and remembers the rhythm your life was always meant to have.
            </p>

            <!-- CTA pair -->
            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-gold-soft hover:!text-bes-bark transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                    <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Join This Morning
                </a>
                <a href="#bes-sn-flow"
                   class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-solid fa-sun text-xs" aria-hidden="true"></i>
                    See the Full Flow
                </a>
            </div>

            <!-- Divider -->
            <div class="bes-reveal h-[1px] w-48 mx-auto bg-gradient-to-r from-transparent via-bes-gold/40 to-transparent"></div>
        </div>

        <!-- Fretwork strip bottom -->
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — WHAT THIS PRACTICE ACTUALLY IS
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="The essence of Surya Namaskar">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Body copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Before You Assume It Is Exercise</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Not a Workout.<br>An Act of<br><em class="not-italic text-bes-olive">Worship</em>.
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            The mistake most people make with Surya Namaskar is treating it as a warm-up — twelve quick rounds before the real yoga begins. What the ancient practitioners understood, and what Bhagawan's teaching restores, is that Surya Namaskar <em>is</em> the real yoga. It is a complete act of devotion: a moving prayer in twelve postures, each one addressed to a different name of the sun deity, each one aligned with a specific breath and a specific chakra awakening.
                        </p>
                        <p class="bes-reveal">
                            When practiced at sunrise — facing east, as the first light touches the highlands of Tampaksiring — the sequence is not a metaphor. The body literally receives prana from the sun at the moment of maximum energetic transmission. The nervous system is still quiet. The mind has not yet filled with the noise of the day. What you put into yourself in those minutes stays with you in a way that an evening practice simply cannot replicate.
                        </p>
                        <p class="bes-reveal">
                            At Pasraman Bali Eling Spirit, the daily Surya Namaskar program surrounds that core practice with everything that makes it complete: meditation before to prepare the interior space, pranayama to open the channels, sacred sound healing to clear what the movement stirred up, and a wholesome breakfast to ground the energy back into the physical body. You arrive in the early morning, and you leave — full, still, luminous — by mid-morning. The rest of the day runs differently.
                        </p>
                    </div>
                </div>

                <!-- Right — accent card -->
                <div class="lg:col-span-5 lg:pt-10">
                    <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                        <div class="p-8 md:p-10">

                            <!-- Core program facts -->
                            <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted mb-5">The Program at a Glance</p>
                            <?php
                            $facts = [
                                [ 'icon' => 'fa-solid fa-sun',         'label' => 'Format',    'value' => 'Daily Morning Retreat'            ],
                                [ 'icon' => 'fa-regular fa-clock',     'label' => 'Duration',  'value' => 'Sunrise to approx. 10:00 AM'     ],
                                [ 'icon' => 'fa-solid fa-calendar',    'label' => 'Schedule',  'value' => 'Available every day (check dates)' ],
                                [ 'icon' => 'fa-solid fa-users',       'label' => 'Group',     'value' => 'Small group, all levels welcome'  ],
                                [ 'icon' => 'fa-solid fa-bowl-rice',   'label' => 'Includes',  'value' => 'Healthy satwik breakfast'         ],
                                [ 'icon' => 'fa-solid fa-location-dot','label' => 'Location',  'value' => 'Pasraman, Tampaksiring, Bali'     ],
                            ];
                            foreach ( $facts as $f ) : ?>
                            <div class="flex items-center gap-4 py-3 border-b border-bes-sand last:border-0">
                                <div class="w-8 h-8 rounded-lg bg-bes-gold/[.08] border border-bes-gold/[.15] flex items-center justify-center flex-shrink-0">
                                    <i class="<?php echo esc_attr($f['icon']); ?> !text-bes-gold/70 text-[10px]" aria-hidden="true"></i>
                                </div>
                                <div class="flex-1 flex items-center justify-between gap-4">
                                    <span class="font-body font-bold text-[9px] uppercase tracking-label text-bes-bark-muted/50"><?php echo esc_html($f['label']); ?></span>
                                    <span class="font-body font-medium text-bes-bark text-[13px] text-right"><?php echo esc_html($f['value']); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 2 — THE 12 POSES (visual grid with Sanskrit + purpose)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="The twelve postures">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-1/4 w-[500px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">The Sacred Sequence</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">The 12 Postures</h2>
                <p class="bes-reveal font-body font-light text-white/40 text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    Each posture carries a Sanskrit name, a breath instruction, a chakra connection, and a mantra. At the Pasraman all three levels — and what lies beneath each position — are taught in full.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $poses = [
                    [ 'n' => '01', 'sanskrit' => 'Pranamasana',     'english' => 'Prayer Pose',        'breath' => 'Exhale',  'chakra' => 'Anahata',    'action' => 'Centre & still the mind. Hands in namaskara mudra at the heart.' ],
                    [ 'n' => '02', 'sanskrit' => 'Hasta Uttanasana','english' => 'Raised Arms Pose',   'breath' => 'Inhale',  'chakra' => 'Vishuddha',  'action' => 'Open the chest, stretch the spine upward, receive solar energy.' ],
                    [ 'n' => '03', 'sanskrit' => 'Hasta Padasana',  'english' => 'Hand to Foot Pose',  'breath' => 'Exhale',  'chakra' => 'Svadhisthana','action' => 'Forward fold. Lengthen the hamstrings, compress the abdominal organs.' ],
                    [ 'n' => '04', 'sanskrit' => 'Ashwa Sanchalanasana','english' => 'Equestrian Pose','breath' => 'Inhale',  'chakra' => 'Ajna',       'action' => 'Right leg back, left knee bent. Opens the hip flexors and stimulates the third eye.' ],
                    [ 'n' => '05', 'sanskrit' => 'Dandasana',       'english' => 'Stick Pose',         'breath' => 'Exhale',  'chakra' => 'Vishuddha',  'action' => 'Full plank. Spine aligned, core engaged. Builds structural strength.' ],
                    [ 'n' => '06', 'sanskrit' => 'Ashtanga Namaskara','english' => 'Eight-Limb Salute','breath' => 'Hold',    'chakra' => 'Manipura',   'action' => 'Eight points of contact with the earth. Surrender. Activation of solar plexus.' ],
                    [ 'n' => '07', 'sanskrit' => 'Bhujangasana',    'english' => 'Cobra Pose',         'breath' => 'Inhale',  'chakra' => 'Svadhisthana','action' => 'Backbend from the floor. Opens the heart, stimulates kidney and adrenal energy.' ],
                    [ 'n' => '08', 'sanskrit' => 'Adho Mukha Svanasana','english' => 'Downward Dog',   'breath' => 'Exhale',  'chakra' => 'Vishuddha',  'action' => 'Inverted V. Decompresses the spine. Blood flows toward the brain.' ],
                    [ 'n' => '09', 'sanskrit' => 'Ashwa Sanchalanasana','english' => 'Equestrian (L)', 'breath' => 'Inhale',  'chakra' => 'Ajna',       'action' => 'Left leg back now. Mirror of pose 4. Completes the bilateral hip opening.' ],
                    [ 'n' => '10', 'sanskrit' => 'Hasta Padasana',  'english' => 'Hand to Foot',       'breath' => 'Exhale',  'chakra' => 'Svadhisthana','action' => 'Return forward fold. The body now more open than when you began.' ],
                    [ 'n' => '11', 'sanskrit' => 'Hasta Uttanasana','english' => 'Raised Arms',        'breath' => 'Inhale',  'chakra' => 'Vishuddha',  'action' => 'Rise and extend. The spine full of space. Heart lifted to the sun.' ],
                    [ 'n' => '12', 'sanskrit' => 'Pranamasana',     'english' => 'Prayer Pose',        'breath' => 'Exhale',  'chakra' => 'Anahata',    'action' => 'Return to the beginning — but different. One cycle complete. One more to begin.' ],
                ];
                foreach ( $poses as $p ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-white/[.04] hover:border-bes-gold/25 transition-all duration-400 overflow-hidden flex flex-col"
                     style="background:rgba(38,51,32,0.4)">
                    <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-bes-gold/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400"></div>
                    <div class="p-6 md:p-7 flex flex-col gap-2 flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-display font-light text-white/10 text-4xl leading-none"><?php echo esc_html($p['n']); ?></span>
                            <span class="font-body font-bold text-[10px] uppercase tracking-label px-2.5 py-1 rounded-full
                                <?php echo $p['breath'] === 'Inhale' ? 'bg-bes-leaf/[.08] text-bes-leaf/70 border border-bes-leaf/[.20]' : ($p['breath'] === 'Exhale' ? 'bg-bes-gold/[.08] !text-bes-gold/70 border border-bes-gold/[.20]' : 'bg-white/[.04] text-white/40 border border-white/[.10]'); ?>">
                                <?php echo esc_html($p['breath']); ?>
                            </span>
                        </div>
                        
                        <div>
                            <h3 class="font-display font-medium text-white text-xl leading-tight group-hover:!text-bes-gold/90 transition-colors duration-300"><?php echo esc_html($p['sanskrit']); ?></h3>
                            <p class="font-body font-light !text-bes-gold/60 text-sm italic mt-0.5"><?php echo esc_html($p['english']); ?></p>
                        </div>

                        <p class="font-body font-light text-white/50 text-[13px] leading-relaxed my-3 flex-grow">
                            <?php echo esc_html($p['action']); ?>
                        </p>

                        <div class="mt-auto pt-4 border-t border-white/[.06]">
                            <p class="font-body font-bold text-[10px] uppercase tracking-label text-white/30">
                                Chakra: <span class="text-white/60 font-medium"><?php echo esc_html($p['chakra']); ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <p class="bes-reveal mt-12 text-center font-body font-light text-white/30 text-sm leading-relaxed max-w-2xl mx-auto">
                One complete round = postures 1–12. A standard session at Pasraman includes multiple rounds across three levels (L1, L2, L3), building in pace and depth. Each level is taught and guided — no prior experience required to join.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — THE 12 SOLAR MANTRAS
         ================================================================ -->
    <section class="bg-bes-forest py-20 md:py-24" aria-label="The twelve solar mantras">

        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">The Sacred Names of the Sun</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">The 12 Surya Mantras</h2>
                <p class="bes-reveal font-body font-light text-white/40 text-base max-w-2xl mx-auto leading-relaxed">
                    Each posture of Surya Namaskar corresponds to one of the twelve names of Surya Devata — the sun deity. Chanting or silently holding these mantras transforms the physical sequence into a living prayer. At the Pasraman these are taught as an integral part of the practice, not an optional extra.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $mantras = [
                    [ 'n'=>'01', 'mantra'=>'Om Mitrāya Namaḥ',      'name'=>'Mitra',     'meaning'=>'The Universal Friend — the sun as companion to all living things, giving warmth without discrimination.' ],
                    [ 'n'=>'02', 'mantra'=>'Om Ravaye Namaḥ',        'name'=>'Ravi',      'meaning'=>'The Shining One — the radiance that illuminates the outer and inner world simultaneously.' ],
                    [ 'n'=>'03', 'mantra'=>'Om Sūryāya Namaḥ',       'name'=>'Surya',     'meaning'=>'The Supreme Light — the power that activates all living processes on earth.' ],
                    [ 'n'=>'04', 'mantra'=>'Om Bhānave Namaḥ',       'name'=>'Bhanu',     'meaning'=>'The One Who Illuminates — the light that dispels not just darkness but ignorance.' ],
                    [ 'n'=>'05', 'mantra'=>'Om Khagāya Namaḥ',       'name'=>'Khaga',     'meaning'=>'The One Who Moves Through the Sky — the ceaseless, effortless movement of the celestial.' ],
                    [ 'n'=>'06', 'mantra'=>'Om Pūṣṇe Namaḥ',         'name'=>'Pushna',    'meaning'=>'The Nourisher — the source that feeds and strengthens every living creature.' ],
                    [ 'n'=>'07', 'mantra'=>'Om Hiraṇyagarbhāya Namaḥ','name'=>'Hiranyagarbha','meaning'=>'The Golden Womb — the cosmic creative principle from which all form emerges.' ],
                    [ 'n'=>'08', 'mantra'=>'Om Marīcaye Namaḥ',      'name'=>'Marichi',   'meaning'=>'The Ray of Light — precision and penetration; the focused beam that reaches what is hidden.' ],
                    [ 'n'=>'09', 'mantra'=>'Om Ādityāya Namaḥ',      'name'=>'Aditya',    'meaning'=>'The Son of Aditi (Infinite Consciousness) — the sun as an expression of limitless awareness.' ],
                    [ 'n'=>'10', 'mantra'=>'Om Savitre Namaḥ',       'name'=>'Savitri',   'meaning'=>'The Stimulator and Purifier — the awakening force that animates all action and growth.' ],
                    [ 'n'=>'11', 'mantra'=>'Om Arkāya Namaḥ',        'name'=>'Arka',      'meaning'=>'The One Worthy of Praise — the recognition that light itself deserves gratitude.' ],
                    [ 'n'=>'12', 'mantra'=>'Om Bhāskarāya Namaḥ',    'name'=>'Bhaskara',  'meaning'=>'The One Who Leads to Enlightenment — the sun as the final pointer toward inner awakening.' ],
                ];
                foreach ( $mantras as $m ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-white/[.04] hover:border-bes-gold/20 transition-all duration-400 overflow-hidden flex flex-col"
                     style="background:rgba(30,42,22,0.5)">
                    <div class="p-6 md:p-7 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="font-display font-light text-white/10 text-4xl leading-none flex-shrink-0"><?php echo esc_html($m['n']); ?></span>
                            <div>
                                <p class="font-body font-bold text-[11px] uppercase tracking-nav !text-bes-gold/60"><?php echo esc_html($m['name']); ?></p>
                            </div>
                        </div>
                        <p class="font-display font-medium text-white/90 text-lg md:text-xl italic mb-3 group-hover:!text-bes-gold/90 transition-colors duration-300"><?php echo esc_html($m['mantra']); ?></p>
                        <p class="font-body font-light text-white/50 text-sm leading-relaxed mt-auto"><?php echo esc_html($m['meaning']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <div class="bes-reveal mt-12 max-w-2xl mx-auto text-center">
                <div class="inline-flex items-start gap-4 p-6 rounded-2xl border border-bes-gold/[.15] bg-bes-gold/[.06]">
                    <i class="fa-solid fa-lightbulb !text-bes-gold/60 text-base mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                    <p class="font-body font-light text-white/50 text-sm leading-relaxed text-left">
                        Note that the twelfth mantra honors <strong class="text-white/70 font-semibold">Bhaskara</strong> — "the one who leads to enlightenment." This is the name carried by the Pasraman's founder, Ida Sri Bhagawan Sriprada <strong class="text-white/70 font-semibold">Bhaskara</strong>. The sequence and the teacher meet at the last salutation.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — FULL SESSION FLOW (timeline)
         ================================================================ -->
    <section id="bes-sn-flow" class="bg-bes-cream py-20 md:py-28" aria-label="Full session flow">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Morning by Morning</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">How the Session Flows</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm max-w-xl mx-auto mt-4 leading-relaxed">
                    The Surya Namaskar daily program is not just the sun salutation sequence. It is a complete morning ritual — each element preparing for or completing the next.
                </p>
            </div>

            <!-- Timeline -->
            <div class="max-w-3xl mx-auto">
                <div class="relative">
                    <!-- Vertical line -->
                    <div class="absolute left-[27px] md:left-[35px] top-2 bottom-2 w-[1px] bg-gradient-to-b from-bes-gold/40 via-bes-gold/15 to-transparent" aria-hidden="true"></div>

                    <?php
                    $flow = [
                        [
                            'time'  => 'Pre-Sunrise',
                            'title' => 'Arrival & Inner Preparation',
                            'icon'  => 'fa-solid fa-moon',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> '!text-bes-gold/60',
                            'body'  => 'Arrive before the sun breaks. Receive a welcome herbal drink. Remove the noise of the journey. The transition from ordinary time to sacred time is already part of the practice — it begins when you step through the gate.',
                        ],
                        [
                            'time'  => 'Sunrise',
                            'title' => 'Opening Meditation',
                            'icon'  => 'fa-solid fa-spa',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> '!text-bes-gold/60',
                            'body'  => 'A seated meditation practice that opens the interior space before the body begins to move. The mind is brought to stillness, awareness drawn inward. In this state, the subsequent movement becomes something it cannot be when the mind is still running yesterday.',
                        ],
                        [
                            'time'  => 'Sunrise',
                            'title' => 'Pranayama — Breath Activation',
                            'icon'  => 'fa-solid fa-wind',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> 'text-bes-leaf/60',
                            'body'  => 'A structured pranayama sequence — specific techniques selected for morning practice to open the nadis (energy channels) and increase lung capacity before the movement sequence begins. This is not box breathing or generic breathwork; it is precisely calibrated for the time of day and the program that follows.',
                        ],
                        [
                            'time'  => 'Early Morning',
                            'title' => 'Surya Namaskar — Three Levels',
                            'icon'  => 'fa-solid fa-sun',
                            'color' => 'bg-bes-forest border-bes-gold/[.15] group-hover:border-bes-gold/35',
                            'icolor'=> '!text-bes-gold',
                            'body'  => 'The heart of the session. Facing east as the sun rises over the Tampaksiring highlands, the guide leads the group through Surya Namaskar Level 1 (foundational, slower pace with alignment focus), Level 2 (flowing rhythm, mantra integration), and Level 3 (dynamic, building heat and prana). All three are taught — beginners move at their pace, experienced practitioners deepen theirs.',
                            'featured' => true,
                        ],
                        [
                            'time'  => 'Mid-Morning',
                            'title' => 'Sacred Sound Healing',
                            'icon'  => 'fa-solid fa-circle-nodes',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> 'text-bes-leaf/60',
                            'body'  => 'After the sequence, participants lie in savasana (or sit in meditation) while Tibetan Singing Bowls are played in a specific pattern around the body. The movement has opened channels; the sound moves through them. Many participants describe this as the most unexpectedly powerful element of the entire morning.',
                        ],
                        [
                            'time'  => 'Mid-Morning',
                            'title' => 'Integration & Journaling Space',
                            'icon'  => 'fa-solid fa-book-open',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> '!text-bes-gold/50',
                            'body'  => 'A quiet window before breakfast. Bring a journal — this is when the insights that arose during movement and sound settle into language you can carry home. The Pasraman team is present for any questions, but no instruction is given. This silence is intentional.',
                        ],
                        [
                            'time'  => 'Post-Practice',
                            'title' => 'Healthy Satwik Breakfast',
                            'icon'  => 'fa-solid fa-bowl-rice',
                            'color' => 'bg-bes-forest border-white/[.06] group-hover:border-bes-gold/20',
                            'icolor'=> '!text-bes-gold/60',
                            'body'  => 'A wholesome vegetarian breakfast — prepared with care and served without rush. After fasted morning practice, this meal lands differently. The body has been working. The food is actually received. Eating after Surya Namaskar, according to both Ayurvedic tradition and basic physiology, is the most productive time for nutrient absorption in the entire day.',
                        ],
                    ];
                    foreach ( $flow as $step ) : ?>

                    <div class="bes-reveal relative flex gap-6 md:gap-8 pb-8 last:pb-0 group">
                        <!-- Node -->
                        <div class="relative z-10 flex-shrink-0 w-14 h-14 md:w-[70px] md:h-[70px] rounded-2xl <?php echo esc_attr($step['color']); ?> border flex flex-col items-center justify-center transition-all duration-400">
                            <i class="<?php echo esc_attr($step['icon']); ?> <?php echo esc_attr($step['icolor']); ?> text-sm mb-0.5" aria-hidden="true"></i>
                            <span class="font-body font-bold text-[8px] uppercase tracking-label text-white/20 text-center leading-none px-1"><?php echo esc_html($step['time']); ?></span>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 pt-1 pb-4 border-b border-bes-sand last:border-0 <?php echo !empty($step['featured']) ? 'relative' : ''; ?>">
                            <?php if ( !empty($step['featured']) ) : ?>
                            <span class="inline-flex items-center gap-1.5 bg-bes-gold/10 border border-bes-gold/20 !text-bes-gold font-body font-bold text-[8px] uppercase tracking-label px-2.5 py-1 rounded-full mb-2">
                                <i class="fa-solid fa-star text-[7px]" aria-hidden="true"></i> Core Practice
                            </span>
                            <?php endif; ?>
                            <h3 class="font-display font-medium text-bes-bark text-xl md:text-2xl mb-2"><?php echo esc_html($step['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($step['body']); ?></p>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — WHY MORNING MATTERS (science + spiritual)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-24 overflow-hidden" aria-label="Why morning practice matters">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[800px] h-[300px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">Not Arbitrary — Precise</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Why It Must Be Morning</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $whys = [
                    [
                        'icon'  => 'fa-solid fa-lungs',
                        'type'  => 'Physiological',
                        'title' => 'Peak Oxygen Absorption',
                        'body'  => 'Research published in peer-reviewed physiology journals confirms that combined pranayama and Surya Namaskar practice significantly improves pulmonary function — lung vital capacity, tidal volume, and expiratory reserve. These effects are amplified when the practice occurs in the early morning before the day\'s pollution and mental load accumulate. The highland air of Tampaksiring, clean and cool, makes this effect measurable.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-brain',
                        'type'  => 'Neurological',
                        'title' => 'Cortisol at Its Natural Peak',
                        'body'  => 'The body\'s cortisol follows a natural cycle — highest in the early morning, declining through the day. Surya Namaskar practiced at this peak works with the body\'s own energy curve rather than against it. The result is vitality that sustains through the day, not a temporary spike followed by a crash. Evening practice cannot achieve this because the hormonal window is simply different.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-fire-flame-simple',
                        'type'  => 'Metabolic',
                        'title' => 'Fasted Movement for Deep Detox',
                        'body'  => 'Practiced before eating — which is the traditional prescription — Surya Namaskar triggers the body\'s detoxification pathways through copious oxygenation, spinal compression and decompression, and forward bends that stimulate the digestive organs. The liver, kidney, and lymphatic system all benefit from the sequence performed on an empty stomach. The breakfast that follows is then absorbed optimally.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-sun',
                        'type'  => 'Solar Physics',
                        'title' => 'Receiving Direct Solar Prana',
                        'body'  => 'The ancient texts are precise: face east, practice at sunrise. This is not poetry. The specific wavelength of light at dawn — before full ultraviolet intensity — penetrates the skin differently than midday sun. Vitamin D synthesis begins. The pineal gland, which governs circadian rhythm and melatonin production, responds to the specific quality of early-morning light in ways that affect mood, sleep, and energy for the full 24 hours that follow.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-heart-pulse',
                        'type'  => 'Cardiovascular',
                        'title' => 'A Heart Workout With Soul',
                        'body'  => 'A sustained, dynamic round of Surya Namaskar brings the heart rate to 80–85% of maximum HR — providing genuine cardiovascular conditioning without the impact-stress of running. For anyone who cannot sustain high-impact exercise, this makes the sun salutation a complete and accessible cardiac health practice. With repeated rounds and the addition of mantras, the meditative focus amplifies the physical benefit.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-yin-yang',
                        'type'  => 'Spiritual Timing',
                        'title' => 'Brahma Muhurta — The Creator\'s Hour',
                        'body'  => 'The Vedic tradition names the period 90 minutes before sunrise as Brahma Muhurta — the hour of Brahma, the creator. In this window the mind is naturally in its most sattvic (pure) state, the veil between outer and inner experience is thinnest, and spiritual practice carries its maximum power. Bhagawan\'s teaching at the Pasraman honors this timing explicitly: not as superstition, but as accumulated wisdom about when the human system is most open to transformation.',
                    ],
                ];
                foreach ( $whys as $w ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-white/[.04] hover:border-bes-gold/20 transition-all duration-400 overflow-hidden"
                     style="background:rgba(38,51,32,0.35)">
                    <div class="p-7 md:p-8">
                        <div class="flex items-start gap-4 mb-5">
                            <div class="w-11 h-11 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.12] flex items-center justify-center flex-shrink-0">
                                <i class="<?php echo esc_attr($w['icon']); ?> !text-bes-gold/70 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <span class="block font-body font-bold text-[9px] uppercase tracking-nav !text-bes-gold/40 mb-0.5"><?php echo esc_html($w['type']); ?></span>
                                <h3 class="font-display font-medium text-white text-xl leading-tight"><?php echo esc_html($w['title']); ?></h3>
                            </div>
                        </div>
                        <p class="font-body font-light text-white/40 text-[13.5px] leading-relaxed"><?php echo esc_html($w['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — THREE-BODY OUTCOMES (physical / subtle / soul)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-24" aria-label="What you gain">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">What Actually Changes</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Outcomes Across All Three Bodies</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm max-w-xl mx-auto mt-4 leading-relaxed">
                    Following the BES framework of Sthula Sarira, Sukhma Sarira, and Antah Karana Sarira — the physical body, subtle body, and soul.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <?php
                $bodies = [
                    [
                        'label'   => 'Sthula Sarira',
                        'sub'     => 'Physical Body',
                        'icon'    => 'fa-solid fa-person-rays',
                        'color'   => 'from-bes-leaf/8 border-bes-leaf/20',
                        'dot'     => 'bg-bes-leaf',
                        'icolor'  => 'text-bes-leaf',
                        'items'   => [
                            'Improved spinal flexibility and decompression',
                            'Stronger core and postural muscles',
                            'Enhanced lung capacity and oxygen utilization',
                            'Cardiovascular conditioning (80–85% max HR)',
                            'Metabolic activation, improved digestion',
                            'Skin clarity from improved circulation',
                            'Relief from insomnia and sleep disturbance',
                            'Hormonal regulation, reduced cortisol spikes',
                        ],
                    ],
                    [
                        'label'   => 'Sukhma Sarira',
                        'sub'     => 'Mind & Feeling Body',
                        'icon'    => 'fa-solid fa-circle-nodes',
                        'color'   => 'from-bes-gold/8 border-bes-gold/20',
                        'dot'     => 'bg-bes-gold',
                        'icolor'  => '!text-bes-gold',
                        'items'   => [
                            'Calmed and clarified mental activity',
                            'Reduced emotional reactivity throughout the day',
                            'Left-right brain hemispheric balance',
                            'Opened chakra energy — especially Anahata (heart)',
                            'Reduced anxiety, mood stabilization',
                            'Heightened sensory awareness and presence',
                            'Increased creative and intuitive capacity',
                            'Sustainable energy without stimulant dependency',
                        ],
                    ],
                    [
                        'label'   => 'Antah Karana Sarira',
                        'sub'     => 'Soul & Causal Body',
                        'icon'    => 'fa-solid fa-star-of-david',
                        'color'   => 'from-bes-sage/8 border-bes-sage/20',
                        'dot'     => 'bg-bes-sage',
                        'icolor'  => 'text-bes-sage',
                        'items'   => [
                            'Deepened capacity for sustained meditation',
                            'Mantra-activated connection to Surya Devata',
                            'Gratitude as a felt experience, not a concept',
                            'Recognition of the body as a sacred instrument',
                            'Opening to the quality of kundalini energy',
                            'Dissolution of the boundary between prayer and movement',
                            'Alignment with natural rhythms (solar, lunar, seasonal)',
                            'Progressive spiritual clarity with regular practice',
                        ],
                    ],
                ];
                foreach ( $bodies as $b ) : ?>

                <div class="bes-reveal relative rounded-2xl border overflow-hidden bg-gradient-to-b <?php echo esc_attr($b['color']); ?> to-transparent"
                     style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">
                    <div class="h-[3px] bg-gradient-to-r from-<?php echo strpos($b['dot'],'leaf') !== false ? 'bes-leaf' : (strpos($b['dot'],'gold') !== false ? 'bes-gold' : 'bes-sage'); ?>/40 to-transparent"></div>
                    <div class="p-7 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-11 h-11 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center flex-shrink-0">
                                <i class="<?php echo esc_attr($b['icon']); ?> <?php echo esc_attr($b['icolor']); ?> text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-medium text-bes-bark text-xl"><?php echo esc_html($b['label']); ?></h3>
                                <p class="font-body text-[10px] uppercase tracking-label text-bes-bark-muted/50 font-bold"><?php echo esc_html($b['sub']); ?></p>
                            </div>
                        </div>
                        <ul class="space-y-2.5">
                            <?php foreach ( $b['items'] as $item ) : ?>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr($b['dot']); ?> mt-2 flex-shrink-0"></span>
                                <span class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo esc_html($item); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — THREE LEVELS TAUGHT AT BES
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Three levels of Surya Namaskar">

        <div class="absolute right-0 top-0 w-[500px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">The BES Method</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Three Levels — One Practice</h2>
                <p class="bes-reveal font-body font-light text-white/50 text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    Bhagawan teaches three distinct levels of Surya Namaskar — not as separate classes, but as integrated layers of a single session. Every participant works at their own level simultaneously.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 max-w-[1100px] mx-auto">
                <?php
                $levels = [
                    [
                        'level'   => 'Level 1',
                        'sub'     => 'Foundation',
                        'icon'    => 'fa-solid fa-seedling',
                        'badge'   => 'Beginners Welcome',
                        'pace'    => 'Slow, held postures',
                        'focus'   => 'Alignment, breath-awareness, building safe foundation',
                        'mantra'  => 'Silent or whispered — learning the names',
                        'for'     => 'Anyone joining for the first time, those with physical limitations, practitioners who want to go deep into individual poses rather than flow.',
                        'color'   => 'border-bes-sage/25 group-hover:border-bes-sage/60',
                        'dot'     => 'bg-bes-sage',
                        'badge_s' => 'bg-bes-sage/10 text-white/70 border-bes-sage/30',
                    ],
                    [
                        'level'   => 'Level 2',
                        'sub'     => 'Flow',
                        'icon'    => 'fa-solid fa-water',
                        'badge'   => 'Most Participants',
                        'pace'    => 'Rhythmic flow, breath-linked',
                        'focus'   => 'Mantra integration, chakra awareness, generating internal heat',
                        'mantra'  => 'Spoken aloud in rhythm with the movement',
                        'for'     => 'Those with any yoga background, returning participants, anyone who has completed Level 1 once and feels ready to move with the breath rather than pause between poses.',
                        'color'   => 'border-bes-leaf/40 group-hover:border-bes-leaf/70',
                        'dot'     => 'bg-bes-leaf',
                        'badge_s' => 'bg-bes-leaf/20 text-white border-bes-leaf/40',
                        'featured'=> true,
                    ],
                    [
                        'level'   => 'Level 3',
                        'sub'     => 'Dynamic',
                        'icon'    => 'fa-solid fa-fire',
                        'badge'   => 'Advanced Practice',
                        'pace'    => 'Dynamic, heat-building, sustained',
                        'focus'   => 'Kundalini activation, taksu development, meditation-in-movement',
                        'mantra'  => 'Internal, continuous — mantra as breath itself',
                        'for'     => 'Established practitioners, YTT participants, those who have practiced the sequence regularly and want to enter the meditative depth that speed and sustained repetition create.',
                        'color'   => 'border-bes-gold/25 group-hover:border-bes-gold/60',
                        'dot'     => 'bg-bes-gold',
                        'badge_s' => 'bg-bes-gold/10 text-white/70 border-bes-gold/30',
                    ],
                ];
                foreach ( $levels as $lv ) : ?>

                <div class="bes-reveal group relative flex flex-col rounded-3xl border <?php echo esc_attr($lv['color']); ?> overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/40 <?php echo !empty($lv['featured']) ? 'ring-2 ring-bes-leaf/30 bg-gradient-to-b from-bes-leaf/[.05] to-transparent' : ''; ?>"
                     style="background:rgba(38,51,32,0.4)">

                    <?php if ( !empty($lv['featured']) ) : ?>
                    <div class="absolute top-0 inset-x-0 flex justify-center z-10">
                        <span class="font-body font-bold text-[10px] uppercase tracking-widest bg-bes-leaf text-bes-forest px-4 py-1.5 rounded-b-lg shadow-md">Most Popular</span>
                    </div>
                    <?php endif; ?>

                    <div class="p-8 md:p-10 flex flex-col flex-grow">
                        <div class="flex items-start justify-between mb-6 <?php echo !empty($lv['featured']) ? 'mt-4' : ''; ?>">
                            <div class="w-12 h-12 rounded-xl bg-white/[.04] border border-white/[.1] flex items-center justify-center">
                                <i class="<?php echo esc_attr($lv['icon']); ?> !text-bes-gold/70 text-lg group-hover:!text-bes-gold group-hover:scale-110 transition-all duration-300" aria-hidden="true"></i>
                            </div>
                            <span class="inline-flex items-center gap-2 border rounded-full px-3 py-1.5 <?php echo esc_attr($lv['badge_s']); ?> font-body font-bold text-[10px] uppercase tracking-nav">
                                <span class="w-2 h-2 rounded-full <?php echo esc_attr($lv['dot']); ?> flex-shrink-0"></span>
                                <?php echo esc_html($lv['badge']); ?>
                            </span>
                        </div>

                        <p class="font-body font-bold text-[11px] uppercase tracking-widest text-white/40 mb-2"><?php echo esc_html($lv['level']); ?></p>
                        <h3 class="font-display font-medium text-white text-3xl mb-8 group-hover:!text-bes-gold transition-colors duration-300"><?php echo esc_html($lv['sub']); ?></h3>

                        <div class="space-y-4 mb-8">
                            <?php
                            $attrs = [
                                [ 'l' => 'Pace',    'v' => $lv['pace']   ],
                                [ 'l' => 'Focus',   'v' => $lv['focus']  ],
                                [ 'l' => 'Mantra',  'v' => $lv['mantra'] ],
                            ];
                            foreach ( $attrs as $a ) : ?>
                            <div class="flex items-start gap-4">
                                <span class="font-body font-bold text-[10px] uppercase tracking-widest text-white/40 w-16 flex-shrink-0 mt-1"><?php echo esc_html($a['l']); ?></span>
                                <span class="font-body font-light text-white/70 text-sm leading-relaxed"><?php echo esc_html($a['v']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-auto border-t border-white/[.08] pt-6 group-hover:border-white/[.15] transition-colors duration-300">
                            <p class="font-body font-bold text-[10px] uppercase tracking-widest !text-bes-gold/60 mb-3">Suited For</p>
                            <p class="font-body font-light text-white/60 text-sm leading-relaxed"><?php echo esc_html($lv['for']); ?></p>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — WHO SHOULD COME
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-24" aria-label="Who this program is for">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Come As You Are</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        Who<br>Belongs<br>Here
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        The Surya Namaskar daily program is structured so that a complete beginner and a long-term practitioner can practice in the same session and both leave having received exactly what they needed.
                    </p>
                    <div class="bes-reveal mt-8 h-[1px] w-16 bg-gradient-to-r from-bes-leaf/40 to-transparent"></div>
                </div>

                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
                        <?php
                        $profiles = [
                            [
                                'icon'  => 'fa-solid fa-person-running',
                                'title' => 'The Burned-Out Professional',
                                'body'  => 'You are managing everything and slowly losing contact with yourself. One morning of this practice gives your nervous system a rest that a weekend of Netflix cannot. The sequence metabolizes stress hormones in a way that passive rest does not.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-leaf',
                                'title' => 'The Curious Beginner',
                                'body'  => 'You have heard about yoga, maybe tried it once, but never felt guided properly or spiritually included. Level 1 is genuinely for you. The guides here teach people — not performances. No one will make you feel out of place for not knowing what you are doing.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-person-praying',
                                'title' => 'The Established Practitioner',
                                'body'  => 'You have a regular practice but it has become mechanical. Practicing under Bhagawan\'s guidance, with the mantra layer and the three-level structure, will reanimate the sequence you think you know. Level 3 will challenge you in ways that do not involve acrobatics.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-moon',
                                'title' => 'The Insomnia Sufferer',
                                'body'  => 'The combination of pranayama, movement, and sound healing has a clinically understood effect on the nervous system — it shifts autonomic state from sympathetic (fight-or-flight) to parasympathetic (rest-and-digest). Participants with chronic sleep issues consistently report improvement within days of consistent morning practice.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-heart',
                                'title' => 'The Spiritual Seeker',
                                'body'  => 'You want practice that goes somewhere beyond physical health — something that addresses the deeper hunger. The mantra layer, the Brahma Muhurta timing, and the sacred geography of this land make the practice genuinely devotional rather than merely disciplined.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-graduation-cap',
                                'title' => 'The YTT Student or Graduate',
                                'body'  => 'The Surya Namaskar daily retreat is both a standalone program and a direct complement to the YTT curriculum. Practicing here after your training deepens your living understanding of what you were taught in the classroom. Many graduates return specifically for this.',
                            ],
                        ];
                        foreach ( $profiles as $pr ) : ?>

                        <div class="bes-reveal group flex flex-col gap-5 p-6 md:p-7 rounded-2xl border border-bes-sand hover:border-bes-leaf/30 hover:shadow-lg hover:shadow-bes-sand/50 hover:bg-white transition-all duration-400 h-full"
                             style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                            <div class="w-12 h-12 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.06] flex items-center justify-center flex-shrink-0 group-hover:bg-bes-leaf/[.08] group-hover:border-bes-leaf/[.15] transition-colors duration-300">
                                <i class="<?php echo esc_attr($pr['icon']); ?> text-bes-olive text-base group-hover:!text-bes-leaf transition-colors duration-300" aria-hidden="true"></i>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <h3 class="font-display font-medium text-bes-bark text-xl mb-3 leading-tight"><?php echo esc_html($pr['title']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-sm leading-relaxed"><?php echo esc_html($pr['body']); ?></p>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — FAQ
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>
        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Sticky left -->
                <div class="lg:col-span-4 lg:sticky lg:top-28">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">Good Questions</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        Before You<br>Come
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/40 text-sm leading-relaxed mb-8">
                        What most people wonder before attending for the first time — answered honestly.
                    </p>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="bes-reveal inline-flex items-center gap-2.5 bg-bes-gold/[.08] border border-bes-gold/[.18] !text-bes-gold font-body font-bold text-[11px] uppercase tracking-label px-6 py-3.5 rounded-xl hover:bg-bes-gold hover:!text-bes-forest transition-all duration-300 group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Ask via WhatsApp
                    </a>
                </div>

                <!-- FAQ list -->
                <div class="lg:col-span-8 space-y-4">
                    <?php
                    $faqs = [
                        [
                            'q' => 'Do I need to know Surya Namaskar before attending?',
                            'a' => 'No. The session begins at Level 1 precisely so that first-time participants can be properly guided through each of the twelve postures before the pace increases. The guide watches every body in the space — if your position needs an adjustment, you will receive quiet, respectful guidance. Come not knowing anything. This is actually the optimal state to arrive in.',
                        ],
                        [
                            'q' => 'What time exactly does the session start and how long does it run?',
                            'a' => 'The session begins at or before sunrise — the precise start time varies with the season. Please confirm the current start time when booking via WhatsApp. The full program including meditation, pranayama, the Surya Namaskar sequence, sound healing, and breakfast runs until approximately 10:00 AM. Plan your morning accordingly and do not book anything immediately after.',
                        ],
                        [
                            'q' => 'Should I eat before coming?',
                            'a' => 'No. This is not a guideline for discomfort — it is essential to the practice. Surya Namaskar was designed to be practiced on an empty stomach so that the forward bends and twists can apply proper pressure to the digestive organs and the pranayama can move freely through an uncompressed chest. Arriving with an empty stomach is part of the preparation. The nourishing breakfast at the end is the reward — and it is received by a system that is genuinely ready to absorb it.',
                        ],
                        [
                            'q' => 'What do I wear and bring?',
                            'a' => 'Comfortable, modest, lightweight clothing you can move freely in. Natural fibers are preferred — cotton or linen breathe better during the sequence than synthetics. Bring a yoga mat if you have one (the Pasraman has mats available). Bring water. Bring a journal if you keep one — the integration space after sound healing is when insights want to become words. Leave your phone on silent or in your bag.',
                        ],
                        [
                            'q' => 'Can I attend if I have a physical limitation or injury?',
                            'a' => 'Please contact the Pasraman team via WhatsApp before attending and describe your specific situation. In many cases, Level 1 can be adapted for common conditions. The guides are trained to offer modifications. There are some acute injuries for which the session should be postponed — the team will tell you honestly rather than accommodate you into something harmful.',
                        ],
                        [
                            'q' => 'Is this a religious ceremony or can anyone attend?',
                            'a' => 'Anyone can attend, from any background, without adopting any belief system. The mantras are Sanskrit; their meaning will be explained. You are free to chant them, hold them in silence, or simply let the sound wash over you. The Balinese spiritual context is present and beautiful. What is not present is any requirement to believe anything before you arrive.',
                        ],
                    ];
                    foreach ( $faqs as $faq ) : ?>

                    <div class="bes-reveal group rounded-2xl border border-white/[.04] hover:border-bes-gold/15 transition-all duration-300 overflow-hidden"
                         style="background:rgba(38,51,32,0.35)">
                        <div class="p-6 md:p-7 flex items-start gap-4">
                            <div class="w-7 h-7 rounded-lg bg-bes-gold/[.07] border border-bes-gold/[.12] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-question !text-bes-gold text-[10px]" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="font-body font-semibold text-white/80 text-[15px] mb-3 leading-snug"><?php echo esc_html($faq['q']); ?></h3>
                                <p class="font-body font-light text-white/40 text-[13px] leading-relaxed"><?php echo esc_html($faq['a']); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 10 — CLOSING CTA
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-24 overflow-hidden" aria-label="Book the Surya Namaskar program">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 top-0 -translate-x-1/2 w-[900px] h-[450px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_52%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="h-[1px] absolute top-0 inset-x-0 bg-gradient-to-r from-transparent via-bes-gold/30 to-transparent"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal max-w-3xl mx-auto text-center">

                <!-- Sun icon -->
                <div class="w-16 h-16 mx-auto mb-8 rounded-2xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center">
                    <i class="fa-solid fa-sun !text-bes-gold text-2xl" aria-hidden="true"></i>
                </div>

                <p class="font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">
                    The Sun Rises Every Morning. Will You?
                </p>
                <h2 class="font-display font-medium text-white text-4xl md:text-5xl lg:text-6xl tracking-display mb-3">
                    Surya Namaskar
                </h2>
                <h3 class="font-display font-light italic !text-bes-gold text-3xl md:text-4xl tracking-display mb-6">
                    Daily Retreat
                </h3>
                <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                    Contact the Pasraman team to confirm availability and your preferred morning. No preparation needed. Come empty — of food, of agenda, of expectation — and let the practice fill you.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-gold-soft hover:!text-bes-bark transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Book via WhatsApp
                    </a>
                    <a href="/healing-retreat"
                       class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                        <i class="fa-solid fa-spa text-xs" aria-hidden="true"></i>
                        Try the Full Healing Retreat
                    </a>
                </div>

                <!-- Trust micro-line -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 text-[11px] text-white/20 font-body tracking-wide">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check !text-bes-gold/40 text-[9px]" aria-hidden="true"></i>All levels welcome</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check !text-bes-gold/40 text-[9px]" aria-hidden="true"></i>Healthy breakfast included</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check !text-bes-gold/40 text-[9px]" aria-hidden="true"></i>3 levels taught simultaneously</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check !text-bes-gold/40 text-[9px]" aria-hidden="true"></i>Tampaksiring highland air</span>
                </div>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}
