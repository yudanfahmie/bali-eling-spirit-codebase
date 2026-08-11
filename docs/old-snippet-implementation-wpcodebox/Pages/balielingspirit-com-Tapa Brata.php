<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [ytt50h_tapabrata_page] Shortcode
 * ============================================================================
 *
 * Standalone, premium landing page for the YTT 50-Hour Tapa Brata
 * certification — a four-day, three-night immersive training centred on
 * spiritual discipline (tapa), emotional release, and the recovery of the
 * authentic self, earning a 50-Hour Certificate of Completion.
 *
 * Depth 3 of 3 — The deepest offering in the Sanctuary architecture.
 * Positioned as a professional certification + transformational immersion
 * for spiritual seekers, practitioners, and individuals ready to reset.
 *
 * USAGE: Add [ytt50h_tapabrata_page] to the Tapa Brata landing page.
 *
 * SECTIONS:
 *   0  — Hero                    (certification identity & commitment)
 *   1  — The Tapa Brata Philosophy (the silent/focused aspect — USP)
 *   2  — The Transformation Arc  (4-day journey as 3 movements)
 *   3  — Curriculum / Syllabus   (8 training modules, academy-grade grid)
 *   4  — Daily Schedule          (4-day interactive accordion timeline)
 *   5  — Certification & Inclusions (credential value + what you receive)
 *   6  — Faculty Profile         (Bali Eling Spirit yogi & healer team)
 *   7  — Investment / Pricing    (single-tier with conversion reframes)
 *   8  — Testimonials            (emotional healing social proof)
 *   9  — FAQ                     (YTT-specific objections)
 *  10  — Closing CTA             (commitment call)
 *
 * Design system: BES v3 — Tailwind + bes-* tokens, font-display / font-body,
 * bes-reveal entrance animation, bes-fret ornament, tracking-nav /
 * tracking-label / tracking-display. Zero new CSS declarations — all styling
 * via existing utility classes and tokens.
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'ytt50h_tapabrata_page', 'bes_render_ytt50h_tapabrata' );

function bes_render_ytt50h_tapabrata( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — HERO
         ================================================================ -->
    <section class="relative min-h-[88vh] flex items-end overflow-hidden bg-bes-forest-deep pb-0"
             aria-labelledby="bes-tb-hero-heading">

        <!-- Atmospheric glows -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.09),transparent_60%)]"></div>
            <div class="absolute bottom-1/3 left-0 w-[500px] h-[450px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.035),transparent_55%)]"></div>
            <div class="absolute bottom-0 right-1/4 w-[420px] h-[380px] bg-[radial-gradient(ellipse,rgba(150,180,120,0.03),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.02]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Top fretwork -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <!-- Foreground -->
        <div class="relative w-full max-w-[1440px] mx-auto px-6 md:px-10 pt-28 md:pt-36 pb-20 md:pb-28">

            <!-- Breadcrumb nav back to hub -->
            <nav class="bes-reveal mb-8" aria-label="Breadcrumb">
                <a href="/sanctuary"
                   class="inline-flex items-center gap-2 font-body font-bold text-[10px] uppercase tracking-nav !text-white/30 hover:!text-bes-gold transition-colors duration-300 group">
                    <i class="fa-solid fa-arrow-left text-[9px] group-hover:-translate-x-0.5 transition-transform" aria-hidden="true"></i>
                    Sanctuary Hub
                </a>
                <span class="mx-3 text-white/15 text-[10px]" aria-hidden="true">/</span>
                <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold">YTT 50H Tapa Brata</span>
            </nav>

            <div class="max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-5">
                    50-Hour Certification &nbsp;·&nbsp; Depth 3 of 3 &nbsp;·&nbsp; Tampaksiring, Bali
                </p>

                <h1 id="bes-tb-hero-heading"
                    class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-[1.05] mb-6">
                    Release the Past.<br>
                    Reclaim the Self.<br>
                    <em class="not-italic text-bes-gold">Earn the Certification.</em>
                </h1>

                <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl leading-relaxed mb-10">
                    <strong class="font-bold text-white/75">Tapa Brata</strong> is a four-day, three-night immersion into the ancient discipline of <em class="not-italic text-bes-gold/80">tapa</em> &mdash; sacred self-discipline &mdash; engineered as a 50-hour certificate program for those ready to clear what has been carried for too long, and to re-emerge with both transformation and credential.
                </p>

                <!-- CTA row -->
                <div class="bes-reveal flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="#bes-tb-investment"
                       class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                        <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform" aria-hidden="true"></i>
                        Reserve Your Place
                    </a>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 font-body font-bold text-[11px] uppercase tracking-label !text-white/40 hover:!text-white transition-colors duration-300">
                        <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                        Speak With Admissions
                    </a>
                </div>
            </div>

            <!-- At-a-glance meta strip -->
            <div class="bes-reveal mt-14 grid grid-cols-2 md:grid-cols-4 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                <?php
                $meta = [
                    [ 'icon' => 'fa-solid fa-graduation-cap', 'label' => 'Credential', 'value' => '50-Hour Certificate' ],
                    [ 'icon' => 'fa-solid fa-moon',           'label' => 'Duration',   'value' => '4 Days / 3 Nights' ],
                    [ 'icon' => 'fa-solid fa-bed',            'label' => 'Format',     'value' => 'Residential Immersion' ],
                    [ 'icon' => 'fa-solid fa-tag',            'label' => 'Investment', 'value' => 'IDR 4.999K' ],
                ];
                foreach ( $meta as $m ) : ?>
                <div class="flex items-center gap-3 px-5 py-5 bg-bes-forest/60">
                    <div class="w-9 h-9 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.12] flex items-center justify-center flex-shrink-0">
                        <i class="<?php echo esc_attr($m['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                    </div>
                    <div>
                        <span class="block font-body text-[9px] uppercase tracking-label text-white/25 font-bold"><?php echo esc_html($m['label']); ?></span>
                        <span class="block font-body text-[13px] text-white/80 font-medium mt-0.5"><?php echo esc_html($m['value']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — THE TAPA BRATA PHILOSOPHY
         (the silent/focused aspect — USP)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="The Tapa Brata philosophy">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        The Philosophy
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        This Is Not a Retreat.<br>
                        <em class="not-italic text-bes-olive">It Is a Discipline.</em>
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            <em class="not-italic text-bes-bark font-medium">Tapa</em> is the Sanskrit word for sacred heat &mdash; the deliberate, chosen friction of practice that burns away what is no longer yours to carry. <em class="not-italic text-bes-bark font-medium">Brata</em> is the vow: the decision to stay in it, even when staying is uncomfortable. Together they describe a tradition older than modern wellness and entirely different in its intent.
                        </p>
                        <p class="bes-reveal">
                            Tapa Brata is not designed to make you feel better for a weekend. It is designed to help you release unresolved grief, emotional residue, and inherited patterns &mdash; the weight that a soft retreat cannot reach. The container is intentionally focused: extended silence, sustained meditation, disciplined practice, and direct emotional release work.
                        </p>
                        <p class="bes-reveal">
                            By the time you receive your 50-Hour Certification, something will have shifted that a workshop cannot touch. That is the point.
                        </p>
                    </div>

                    <!-- Pain points block -->
                    <div class="bes-reveal mt-8 rounded-2xl border border-bes-sand p-6"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-4">This Program Is for You If:</p>
                        <?php
                        $pain_points = [
                            'You carry unresolved wounds &mdash; trauma, loss, or disappointment &mdash; that polite self-care has not reached',
                            'You feel emotions you have pushed down for years beginning to ask for release',
                            'You have arrived at a quiet sense of emptiness or lost meaning, and know it is time to answer it',
                            'Your mind is overworked, your life is unbalanced, and surface fixes are no longer enough',
                            'You want to begin again &mdash; from your own centre &mdash; with real clarity and a credential that reflects the depth of the work',
                        ];
                        foreach ( $pain_points as $item ) : ?>
                        <div class="flex items-start gap-3 py-2.5 border-b border-bes-sand last:border-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold flex-shrink-0 mt-1.5"></span>
                            <span class="font-body text-[13px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($item); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Quote card — the silent/focused aspect -->
                <div class="lg:col-span-5 lg:pt-14">
                    <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                        <div class="p-8 md:p-10">
                            <blockquote class="mb-7">
                                <span class="block font-display font-light text-bes-bark text-2xl md:text-3xl leading-snug italic mb-4">
                                    &ldquo;Tapa Brata is the vow to stay present with what has been avoided &mdash; long enough for it to transform.&rdquo;
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label text-bes-moss">
                                    &mdash; Bali Eling Spirit &middot; Faculty
                                </cite>
                            </blockquote>

                            <!-- Four pillars of the discipline -->
                            <div class="border-t border-bes-sand pt-6">
                                <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted mb-5">The Four Disciplines of Tapa Brata</p>
                                <?php
                                $disciplines = [
                                    [ 'num' => '01', 'label' => 'Silence', 'body' => 'Extended periods of noble silence to quiet the habitual mind' ],
                                    [ 'num' => '02', 'label' => 'Focus',   'body' => 'Sustained single-point attention across meditation, asana, and inquiry' ],
                                    [ 'num' => '03', 'label' => 'Release', 'body' => 'Emotional release practices held within a safe, facilitated container' ],
                                    [ 'num' => '04', 'label' => 'Vow',     'body' => 'A personal commitment chosen at arrival and carried through completion' ],
                                ];
                                foreach ( $disciplines as $d ) : ?>
                                <div class="flex items-start gap-4 py-3 border-b border-bes-sand last:border-0">
                                    <span class="font-display font-light text-bes-olive/50 text-sm flex-shrink-0 mt-0.5"><?php echo esc_html($d['num']); ?></span>
                                    <div class="flex-1 min-w-0">
                                        <span class="block font-body font-bold text-[11px] uppercase tracking-label text-bes-bark mb-0.5"><?php echo esc_html($d['label']); ?></span>
                                        <span class="font-body text-[12px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($d['body']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 2 — THE TRANSFORMATION ARC (3 movements)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden"
             aria-label="The transformation arc">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-0 top-1/3 w-[500px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_65%)]"></div>
            <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_65%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-14 md:mb-16 max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">The Journey</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5">
                    Four Days.<br>Three Movements.<br>One Return.
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    The programme is structured as a complete arc &mdash; purification, confrontation, integration. Each day prepares the ground for the next. Nothing is arbitrary. By the end of day four you are not the same person who arrived, and the certificate is a record of the work you did to get there.
                </p>
            </div>

            <!-- 3-step arc -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <?php
                $arc = [
                    [
                        'step'    => '01',
                        'label'   => 'Purify',
                        'title'   => 'Lay Down the Load',
                        'body'    => 'Day one is arrival, orientation, and the first breath of silence. Grounding practices, the first sitting, and the formal taking of the vow. The goal is simple: stop carrying for a moment, and notice the weight.',
                        'accent'  => 'border-bes-gold/20',
                        'dot'     => 'bg-bes-gold',
                        'glow'    => 'rgba(201,168,76,0.05)',
                    ],
                    [
                        'step'    => '02',
                        'label'   => 'Release',
                        'title'   => 'Meet What Surfaces',
                        'body'    => 'Days two and three are the deep work. Sustained meditation, guided emotional release, silent reflection, sharing circles, and the sacred friction of tapa itself. This is where the old patterns loosen their grip. This is also why it is not a weekend.',
                        'accent'  => 'border-bes-leaf/20',
                        'dot'     => 'bg-bes-leaf',
                        'glow'    => 'rgba(194,210,74,0.05)',
                    ],
                    [
                        'step'    => '03',
                        'label'   => 'Integrate',
                        'title'   => 'Return as Yourself',
                        'body'    => 'Day four closes the container. The vow is released, insights are integrated, and a simple ceremony marks the work. You receive your 50-Hour Certification and a clear sense of what to carry forward &mdash; and what stays behind.',
                        'accent'  => 'border-bes-sage/20',
                        'dot'     => 'bg-bes-sage',
                        'glow'    => 'rgba(150,180,120,0.05)',
                    ],
                ];
                foreach ( $arc as $a ) : ?>

                <div class="bes-reveal group relative rounded-2xl border <?php echo esc_attr($a['accent']); ?> overflow-hidden hover:border-opacity-60 transition-all duration-500"
                     style="background:rgba(38,51,32,0.40)">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                         style="background:radial-gradient(ellipse at top left,<?php echo esc_attr($a['glow']); ?>,transparent 70%)"></div>
                    <div class="relative p-7">
                        <!-- Step number -->
                        <div class="flex items-center gap-3 mb-5">
                            <span class="font-display font-light text-white/10 text-4xl leading-none"><?php echo esc_html($a['step']); ?></span>
                            <span class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr($a['dot']); ?>"></span>
                                <span class="font-body font-bold text-[10px] uppercase tracking-nav text-white/30"><?php echo esc_html($a['label']); ?></span>
                            </span>
                        </div>
                        <h3 class="font-display font-medium text-white text-xl mb-3"><?php echo wp_kses_post($a['title']); ?></h3>
                        <p class="font-body font-light text-white/45 text-[13px] leading-relaxed"><?php echo wp_kses_post($a['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <!-- Dream outcomes strip -->
            <div class="bes-reveal mt-12 md:mt-16">
                <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-6 text-center">What You Leave With</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                    <?php
                    $outcomes = [
                        [ 'icon' => 'fa-solid fa-feather',      'label' => 'Released Burden' ],
                        [ 'icon' => 'fa-solid fa-compass',      'label' => 'Recovered Self' ],
                        [ 'icon' => 'fa-solid fa-mountain-sun', 'label' => 'Deep Inner Peace' ],
                        [ 'icon' => 'fa-solid fa-arrows-to-eye','label' => 'Clear Direction' ],
                        [ 'icon' => 'fa-solid fa-scroll',       'label' => '50H Certificate' ],
                    ];
                    foreach ( $outcomes as $o ) : ?>
                    <div class="flex flex-col items-center text-center gap-2 px-4 py-6 bg-bes-forest/60">
                        <div class="w-10 h-10 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.12] flex items-center justify-center">
                            <i class="<?php echo esc_attr($o['icon']); ?> text-bes-gold text-[12px]" aria-hidden="true"></i>
                        </div>
                        <span class="font-body text-[12px] text-white/70 font-medium"><?php echo esc_html($o['label']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — CURRICULUM / SYLLABUS GRID
         (premium academy-style modules)
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Curriculum and syllabus">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <!-- Header row -->
            <div class="mb-12 md:mb-14 grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Syllabus</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-4">
                        Eight Modules.<br>
                        <em class="not-italic text-bes-olive">Fifty Hours of Training.</em>
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed max-w-xl">
                        A complete curriculum designed by Bali Eling Spirit &mdash; rooted in authentic Balinese-Hindu healing tradition, structured with the rigour of a modern certification.
                    </p>
                </div>
                <div class="lg:col-span-5">
                    <div class="bes-reveal grid grid-cols-3 gap-px bg-bes-sand rounded-2xl overflow-hidden border border-bes-sand">
                        <?php
                        $tally = [
                            [ 'n' => '50', 'l' => 'Training Hours' ],
                            [ 'n' => '08', 'l' => 'Core Modules' ],
                            [ 'n' => '04', 'l' => 'Immersive Days' ],
                        ];
                        foreach ( $tally as $t ) : ?>
                        <div class="flex flex-col items-center text-center px-3 py-5 bg-white">
                            <span class="font-display font-medium text-bes-bark text-3xl md:text-4xl leading-none mb-1"><?php echo esc_html($t['n']); ?></span>
                            <span class="font-body font-bold text-[9px] uppercase tracking-label text-bes-moss"><?php echo esc_html($t['l']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Module grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php
                $modules = [
                    [
                        'icon'  => 'fa-solid fa-book-open',
                        'n'     => '01',
                        'hours' => '6 Hours',
                        'title' => 'Foundations of Tapa',
                        'sub'   => 'Philosophy &amp; Lineage',
                        'body'  => 'The origin, meaning, and living practice of tapa within Balinese-Hindu tradition. The vow, the container, and why sacred discipline is the doorway.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-person-praying',
                        'n'     => '02',
                        'hours' => '8 Hours',
                        'title' => 'Meditation &amp; Inner Awareness',
                        'sub'   => 'Daily Seated Practice',
                        'body'  => 'Sustained meditation methodology &mdash; posture, breath, object of attention. Building the capacity to stay with what arises, without escape.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-wind',
                        'n'     => '03',
                        'hours' => '8 Hours',
                        'title' => 'Yoga Asana &amp; Pranayama',
                        'sub'   => 'Body&ndash;Mind Integration',
                        'body'  => 'Daily asana practice and pranayama techniques &mdash; used here as preparation for release work. The body is the first gate; we train it to open.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-heart-pulse',
                        'n'     => '04',
                        'hours' => '8 Hours',
                        'title' => 'Emotional Release Practices',
                        'sub'   => 'Trauma-Aware Facilitation',
                        'body'  => 'Guided practices for releasing stored emotional weight &mdash; grief, anger, fear, longing. Held in a safe, attuned container. Not performance. Real work.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-feather-pointed',
                        'n'     => '05',
                        'hours' => '6 Hours',
                        'title' => 'Silent Reflection &amp; Self-Inquiry',
                        'sub'   => 'Svadhyaya &amp; Journaling',
                        'body'  => 'Structured contemplative periods and written self-inquiry. Silence as an instrument &mdash; not deprivation, but clarity. The place where honesty returns.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-people-group',
                        'n'     => '06',
                        'hours' => '5 Hours',
                        'title' => 'Sharing Circle Facilitation',
                        'sub'   => 'The Witnessed Heart',
                        'body'  => 'The art of holding and being held in sacred group space. How to speak the unspeakable, how to listen without fixing. A portable, life-long skill.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-om',
                        'n'     => '07',
                        'hours' => '5 Hours',
                        'title' => 'Spiritual Contemplation',
                        'sub'   => 'Balinese-Hindu Wisdom',
                        'body'  => 'Teachings drawn from the living tradition of Bali &mdash; karma, dharma, the return to essence. Context for the inner work, not dogma.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-droplet',
                        'n'     => '08',
                        'hours' => '4 Hours',
                        'title' => 'Energy Clearing &amp; Purification',
                        'sub'   => 'Melukat &amp; Closing Rites',
                        'body'  => 'Authentic Balinese purification rituals held in tradition. The embodied act of release. The ceremony that seals the journey and opens the next.',
                    ],
                ];
                foreach ( $modules as $m ) : ?>

                <article class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden transition-all duration-500 hover:border-bes-gold/30 hover:-translate-y-0.5"
                         style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="absolute top-0 right-0 w-36 h-36 bg-[radial-gradient(circle,rgba(201,168,76,0.06),transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" aria-hidden="true"></div>
                    <div class="relative p-6 md:p-7 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-5">
                            <span class="font-display font-light text-bes-bark/10 text-5xl leading-none"><?php echo esc_html($m['n']); ?></span>
                            <div class="w-10 h-10 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center">
                                <i class="<?php echo esc_attr($m['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                            </div>
                        </div>
                        <span class="font-body font-bold text-[9px] uppercase tracking-label text-bes-gold/80 mb-2"><?php echo esc_html($m['hours']); ?></span>
                        <h3 class="font-display font-medium text-bes-bark text-lg mb-1 leading-tight"><?php echo wp_kses_post($m['title']); ?></h3>
                        <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-3"><?php echo wp_kses_post($m['sub']); ?></p>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed flex-1"><?php echo wp_kses_post($m['body']); ?></p>
                    </div>
                </article>

                <?php endforeach; ?>
            </div>

            <!-- Curriculum footnote -->
            <p class="bes-reveal mt-10 font-body text-[12px] font-light text-bes-bark-muted/70 leading-relaxed max-w-3xl">
                * Module hours include formal instruction, guided practice, and supervised integration time. Complete attendance across all modules is a prerequisite for the 50-Hour Certification.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — DAILY SCHEDULE (4-day interactive accordion)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Daily schedule">

        <div class="absolute right-0 top-0 bottom-0 w-[400px] bg-[radial-gradient(ellipse_at_right,rgba(201,168,76,0.04),transparent_60%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
             style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">The Daily Rhythm</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">
                    Four Days,<br>Hour by Hour
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    A representative rhythm of the programme. Tap each day to open its schedule. Exact timings are confirmed in the pre-arrival brief and may be adjusted to honour the group's process.
                </p>
            </div>

            <div class="max-w-4xl space-y-3">
                <?php
                $days = [
                    [
                        'day'      => 'Day 01',
                        'title'    => 'Arrival, Orientation &amp; the Vow',
                        'tagline'  => 'Lay down the load. Take the container.',
                        'sessions' => [
                            [ 't' => '14:00', 'a' => 'Arrival &amp; check-in',                    'd' => 'Welcome, accommodation settlement, sanctuary orientation, light refreshments.' ],
                            [ 't' => '16:00', 'a' => 'Opening circle &amp; intention setting',    'd' => 'Introductions, programme overview, the formal taking of the vow of tapa.' ],
                            [ 't' => '17:30', 'a' => 'Grounding meditation',                      'd' => 'First seated practice. Body scan, breath awareness, arrival into silence.' ],
                            [ 't' => '19:00', 'a' => 'Vegetarian dinner &amp; noble silence',     'd' => 'Evening silence begins and is carried through the night.' ],
                            [ 't' => '20:30', 'a' => 'Evening reflection &amp; rest',             'd' => 'Journaling prompt, early rest. The work begins tomorrow at first light.' ],
                        ],
                    ],
                    [
                        'day'      => 'Day 02',
                        'title'    => 'Foundations &amp; First Release',
                        'tagline'  => 'The body leads. The mind follows. The heart unlocks.',
                        'sessions' => [
                            [ 't' => '06:00', 'a' => 'Morning meditation',                         'd' => 'Extended seated practice before the sun. The day begins in silence.' ],
                            [ 't' => '07:30', 'a' => 'Yoga asana &amp; pranayama',                 'd' => 'Mindful movement and breathwork &mdash; preparing the vessel for release.' ],
                            [ 't' => '09:00', 'a' => 'Breakfast &amp; reflection period',         'd' => 'Mindful meal in silence, journaling, integration walk in the sanctuary grounds.' ],
                            [ 't' => '10:30', 'a' => 'Foundations of Tapa &mdash; teaching',      'd' => 'Philosophy, lineage, and the structure of the discipline. Context for the work.' ],
                            [ 't' => '12:30', 'a' => 'Vegetarian lunch &amp; rest',               'd' => 'Nourishment and silence. The body integrates.' ],
                            [ 't' => '14:30', 'a' => 'Emotional release practice &mdash; I',     'd' => 'Guided somatic and breath-based release work. Safe container, attuned facilitation.' ],
                            [ 't' => '17:00', 'a' => 'Sharing circle',                             'd' => 'The first witnessed opening. Speaking and being heard without interruption.' ],
                            [ 't' => '19:00', 'a' => 'Dinner &amp; evening silence',              'd' => 'The day is held. Processing continues in stillness.' ],
                            [ 't' => '20:30', 'a' => 'Night meditation &amp; rest',               'd' => 'Closing seated practice. The day is sealed.' ],
                        ],
                    ],
                    [
                        'day'      => 'Day 03',
                        'title'    => 'The Deep Work',
                        'tagline'  => 'Meet what surfaces. Let it move.',
                        'sessions' => [
                            [ 't' => '06:00', 'a' => 'Morning meditation &amp; silent walk',      'd' => 'Extended sit followed by a walking meditation through the sanctuary.' ],
                            [ 't' => '07:30', 'a' => 'Yoga &amp; pranayama',                      'd' => 'Deeper breath practices. The nervous system stabilises for what is coming.' ],
                            [ 't' => '09:00', 'a' => 'Breakfast &amp; svadhyaya journaling',      'd' => 'Structured self-inquiry prompts. Writing by hand, honestly.' ],
                            [ 't' => '10:30', 'a' => 'Spiritual contemplation &mdash; teaching', 'd' => 'Karma, dharma, and the return to essence. Wisdom for the process.' ],
                            [ 't' => '12:30', 'a' => 'Lunch &amp; rest',                          'd' => 'Silent meal. The afternoon is the threshold.' ],
                            [ 't' => '14:30', 'a' => 'Emotional release practice &mdash; II',    'd' => 'The deepest release session of the programme. Full facilitated support.' ],
                            [ 't' => '17:00', 'a' => 'Sharing circle &amp; integration',         'd' => 'The witnessed heart. What has moved is acknowledged and held.' ],
                            [ 't' => '19:00', 'a' => 'Dinner in silence',                         'd' => 'Quiet meal. The body is tired in a new way. This is correct.' ],
                            [ 't' => '20:30', 'a' => 'Candlelit meditation &amp; rest',           'd' => 'A soft close. The vow has almost done its work.' ],
                        ],
                    ],
                    [
                        'day'      => 'Day 04',
                        'title'    => 'Purification, Integration &amp; Certification',
                        'tagline'  => 'Return as yourself. Carry what is yours.',
                        'sessions' => [
                            [ 't' => '06:00', 'a' => 'Final morning meditation',                  'd' => 'The last seated practice of the programme. Noticing who is arriving to the cushion now.' ],
                            [ 't' => '07:30', 'a' => 'Yoga &amp; gentle movement',                'd' => 'Soft, integrative practice. The body is listened to, not pushed.' ],
                            [ 't' => '09:00', 'a' => 'Breakfast &amp; integration dialogue',      'd' => 'Silence is released. The first conscious words of the programme.' ],
                            [ 't' => '10:30', 'a' => 'Melukat &mdash; cleansing ritual',          'd' => 'Authentic Balinese purification ceremony. Traditional, embodied, complete.' ],
                            [ 't' => '12:30', 'a' => 'Celebration lunch',                         'd' => 'Shared meal with the group and faculty. The container softens.' ],
                            [ 't' => '14:00', 'a' => 'Closing circle &amp; integration plan',     'd' => 'What stays, what goes, what is carried forward. A written integration plan.' ],
                            [ 't' => '15:30', 'a' => 'Certification ceremony',                    'd' => 'Formal presentation of the 50-Hour Certificate of Completion.' ],
                            [ 't' => '16:30', 'a' => 'Departure',                                 'd' => 'Complimentary return transfer available. You leave as someone slightly new.' ],
                        ],
                    ],
                ];
                foreach ( $days as $idx => $day ) : ?>

                <div class="bes-reveal rounded-2xl border border-white/[.06] overflow-hidden"
                     style="background:rgba(38,51,32,0.40)">
                    <button
                        type="button"
                        class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left group"
                        aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>"
                        onclick="besTbDayToggle(this)">
                        <div class="flex items-center gap-5 min-w-0">
                            <span class="font-display font-light text-bes-gold/40 text-2xl md:text-3xl leading-none flex-shrink-0"><?php echo esc_html($day['day']); ?></span>
                            <div class="min-w-0 text-left">
                                <span class="block font-display font-medium text-white text-[17px] md:text-lg leading-tight mb-1"><?php echo wp_kses_post($day['title']); ?></span>
                                <span class="block font-body text-[12px] font-light text-white/40 italic truncate"><?php echo wp_kses_post($day['tagline']); ?></span>
                            </div>
                        </div>
                        <span class="flex-shrink-0 w-9 h-9 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center transition-all duration-300 group-hover:bg-bes-gold/15"
                              aria-hidden="true">
                            <i class="fa-solid fa-plus text-bes-gold text-[11px] bes-tb-day-icon transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="bes-tb-day-body overflow-hidden transition-all duration-500 ease-in-out"
                         style="<?php echo $idx === 0 ? '' : 'max-height:0;'; ?>">
                        <div class="border-t border-white/[.06]">
                            <?php foreach ( $day['sessions'] as $s ) : ?>
                            <div class="flex items-start gap-5 px-6 py-4 border-b border-white/[.04] last:border-0">
                                <span class="flex-shrink-0 font-body font-bold text-[12px] text-bes-gold/70 min-w-[55px] mt-0.5 tracking-label"><?php echo esc_html($s['t']); ?></span>
                                <div class="flex-1 min-w-0">
                                    <span class="block font-display font-medium text-white text-[15px] mb-1"><?php echo wp_kses_post($s['a']); ?></span>
                                    <span class="block font-body text-[12px] font-light text-white/45 leading-relaxed"><?php echo wp_kses_post($s['d']); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <p class="bes-reveal mt-8 font-body text-[12px] font-light text-white/25 leading-relaxed max-w-3xl">
                * Schedule is representative. Session order and timing are finalised by faculty in response to the group's process. Noble silence is held from the evening of Day 01 through the morning of Day 04. Complimentary pickup from Sang Spa &amp; Sang Spa Tropical.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — CERTIFICATION & INCLUSIONS
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Certification and inclusions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start mb-14">

                <!-- Certification highlight card -->
                <div class="lg:col-span-5">
                    <div class="bes-reveal relative rounded-2xl border border-bes-gold/30 overflow-hidden"
                         style="background:linear-gradient(145deg,#fdfcfa,#f4ebd4)">
                        <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-olive to-bes-gold"></div>
                        <div class="p-8 md:p-10">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-11 h-11 rounded-xl bg-bes-gold/15 border border-bes-gold/25 flex items-center justify-center">
                                    <i class="fa-solid fa-certificate text-bes-gold text-[13px]" aria-hidden="true"></i>
                                </div>
                                <span class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss">The Credential</span>
                            </div>

                            <h3 class="font-display font-medium text-bes-bark text-3xl md:text-[34px] leading-tight mb-4">
                                50-Hour Certificate of Completion
                            </h3>
                            <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-7">
                                On successful completion, each participant receives a formal 50-Hour Certificate issued by Bali Eling Spirit &mdash; documenting the full curriculum, hours of practice, and participation in the Tapa Brata tradition.
                            </p>

                            <div class="border-t border-bes-sand pt-5 space-y-3">
                                <?php
                                $cert = [
                                    'Full 50-hour training documented',
                                    'Signed by Bali Eling Spirit faculty',
                                    'Suitable for continuing education evidence',
                                    'Recognition of tapa lineage completion',
                                ];
                                foreach ( $cert as $c ) : ?>
                                <div class="flex items-start gap-2.5">
                                    <i class="fa-solid fa-check text-bes-gold text-[10px] mt-1 flex-shrink-0" aria-hidden="true"></i>
                                    <span class="font-body text-[13px] font-light text-bes-bark-muted"><?php echo esc_html($c); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Intro copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Everything Included</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        Arrive, Be Received,<br>
                        <em class="not-italic text-bes-olive">Leave Whole.</em>
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed mb-6">
                        A single all-inclusive investment. From the moment transfer is arranged through the certification ceremony on the final afternoon, every element of your experience is held by the sanctuary.
                    </p>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm leading-relaxed">
                        The Tapa Brata container is intentionally intimate &mdash; small cohort sizes preserve depth of facilitation and the integrity of the work.
                    </p>
                </div>

            </div>

            <!-- Inclusions grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $included = [
                    [
                        'icon'  => 'fa-solid fa-bed',
                        'title' => '4 Days &amp; 3 Nights Accommodation',
                        'body'  => 'Private or shared accommodation within the Bali Eling Spirit sanctuary &mdash; designed for rest, stillness, and integration.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-bowl-food',
                        'title' => 'All Meals Included',
                        'body'  => 'Mindfully prepared vegetarian meals for the full duration &mdash; breakfast, lunch, and dinner. Eating is held as part of the practice.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-graduation-cap',
                        'title' => 'Complete 50-Hour Curriculum',
                        'body'  => 'All eight core modules &mdash; meditation, yoga, emotional release, self-inquiry, spiritual contemplation, purification, and more.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-user-shield',
                        'title' => 'Faculty-Led Facilitation',
                        'body'  => 'Daily guidance from the Bali Eling Spirit team of yogis and healers, with one-to-one check-ins as the process requires.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-certificate',
                        'title' => '50-Hour Certificate',
                        'body'  => 'Formal Certificate of Completion presented during the closing ceremony on Day 4, issued by Bali Eling Spirit.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-spa',
                        'title' => 'Full Sanctuary Access',
                        'body'  => 'Complete access to the Eling Sanctuary grounds, temples, and facilities throughout your stay.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-gift',
                        'title' => 'Special Privileges',
                        'body'  => 'Priority access and reserved rates for continued Eling Sanctuary services beyond the programme dates.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-van-shuttle',
                        'title' => 'Sang Spa Pickup',
                        'body'  => 'Complimentary round-trip transfer from Sang Spa &amp; Sang Spa Tropical. Arrive without logistics.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-book',
                        'title' => 'Integration Materials',
                        'body'  => 'Printed journal and curated practice guide to support the integration of the work in the weeks following.',
                    ],
                ];
                foreach ( $included as $item ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden hover:border-bes-gold/30 transition-all duration-500"
                     style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="p-6 md:p-7">
                        <div class="w-11 h-11 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center mb-5 group-hover:bg-bes-gold/10 transition-colors duration-300">
                            <i class="<?php echo esc_attr($item['icon']); ?> text-bes-gold text-[13px]" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-lg mb-2 leading-tight"><?php echo wp_kses_post($item['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo wp_kses_post($item['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — FACULTY PROFILE
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="The faculty">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-5">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Faculty</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Taught by<br>
                        <em class="not-italic text-bes-olive">Bali Eling Spirit</em><br>
                        Yogis &amp; Healers.
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed mb-5">
                        The Tapa Brata faculty is a small team of Balinese yogis and healers working within a living lineage &mdash; not a marketed aesthetic, but an actual tradition carried forward.
                    </p>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed mb-5">
                        Their approach is experiential and embodied. The teaching is direct. The container is safe. The expectation is that you show up, stay, and do the work. In return, you are given genuine attention &mdash; the kind that has become rare, even in places that claim to offer it.
                    </p>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        This is not a certificate factory. This is a small number of people, trained deeply, passing something on.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php
                        $approach = [
                            [
                                'icon'  => 'fa-solid fa-om',
                                'title' => 'Rooted in Lineage',
                                'body'  => 'Trained within authentic Balinese-Hindu healing tradition &mdash; the practices taught here are the practices they live.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-compass',
                                'title' => 'Experiential Pedagogy',
                                'body'  => 'You will do more than you will be told. The practice is the teaching. Lectures are the frame, not the content.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-hand-holding-heart',
                                'title' => 'Trauma-Informed',
                                'body'  => 'Faculty are trained to hold emotional release work with attunement, safety, and an exit for anyone who needs one.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-user-group',
                                'title' => 'Intimate Cohorts',
                                'body'  => 'Intentionally small group sizes to preserve the depth of facilitation and the quality of each participant&rsquo;s process.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-seedling',
                                'title' => 'Empathic &amp; Unhurried',
                                'body'  => 'No spiritual performance, no intimidation, no rushing. You are met where you are, and not where someone wishes you were.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-circle-nodes',
                                'title' => 'Holistic Scope',
                                'body'  => 'Body, mind, and spirit addressed as a single integrated system &mdash; because that is how they actually function.',
                            ],
                        ];
                        foreach ( $approach as $a ) : ?>
                        <div class="bes-reveal rounded-2xl border border-bes-sand p-6"
                             style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                            <div class="w-10 h-10 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center mb-4">
                                <i class="<?php echo esc_attr($a['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                            </div>
                            <h3 class="font-display font-medium text-bes-bark text-lg mb-2 leading-tight"><?php echo wp_kses_post($a['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo wp_kses_post($a['body']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — INVESTMENT / PRICING
         ================================================================ -->
    <section id="bes-tb-investment" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Investment">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[800px] h-[350px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.08),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 md:mb-14 max-w-2xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">The Investment</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5">
                    One Commitment.<br>
                    <em class="not-italic text-bes-gold">Everything Included.</em>
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    A single transparent tier. Accommodation, full curriculum, all meals, ceremonies, sanctuary access, pickup, and the 50-Hour Certification &mdash; no upsells, no hidden modules.
                </p>
            </div>

            <!-- Pricing card -->
            <div class="max-w-2xl mx-auto">

                <article class="bes-reveal group relative rounded-2xl border border-bes-gold/30 overflow-hidden hover:border-bes-gold/50 transition-all duration-500 flex flex-col"
                         style="background:rgba(38,51,32,0.60)">
                    <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/15 to-bes-leaf/5 opacity-50 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="relative p-8 md:p-10 flex flex-col flex-1">

                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/80">The Tapa Brata Immersion</p>
                            <span class="font-body font-bold text-[9px] uppercase tracking-label bg-bes-gold/15 border border-bes-gold/25 text-bes-gold rounded-full px-3 py-1">
                                Limited Cohort
                            </span>
                        </div>
                        <h3 class="font-display font-medium text-white text-3xl mb-1">YTT 50H Tapa Brata</h3>
                        <p class="font-body font-light text-white/40 text-sm mb-6">4 Days &amp; 3 Nights &nbsp;·&nbsp; Residential &nbsp;·&nbsp; Tampaksiring, Bali</p>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-2 pb-2">
                            <span class="font-display font-medium text-white text-5xl md:text-6xl leading-none">IDR 4.999K</span>
                        </div>
                        <p class="font-body text-[12px] font-light text-white/30 mb-6 pb-6 border-b border-white/[.06]">
                            per participant &nbsp;·&nbsp; full programme &nbsp;·&nbsp; all-inclusive
                        </p>

                        <!-- Includes -->
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/30 mb-3">Your Full Inclusions</p>
                        <ul class="space-y-2.5 mb-8 flex-1" role="list">
                            <?php
                            $pkg = [
                                '4 Days &amp; 3 Nights residential immersion',
                                'Complete 50-hour curriculum &mdash; 8 modules',
                                'Deep emotional healing &amp; release journey',
                                'All meals (vegetarian, mindfully prepared)',
                                'Accommodation within the Eling Sanctuary',
                                'Faculty-led facilitation &amp; 1:1 check-ins',
                                'Melukat &mdash; traditional cleansing ceremony',
                                'Integration materials &amp; practice guide',
                                '50-Hour Certificate of Completion',
                                'Full sanctuary access throughout',
                                'Special privileges for Eling Sanctuary services',
                                'Complimentary pickup from Sang Spa',
                            ];
                            foreach ( $pkg as $line ) : ?>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-bes-gold text-[9px] mt-1.5 flex-shrink-0" aria-hidden="true"></i>
                                <span class="font-body text-[13px] font-light text-white/70 leading-snug"><?php echo wp_kses_post($line); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20mendaftar%20YTT%2050H%20Tapa%20Brata"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center flex-1 gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/15 group/cta">
                                <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                                Reserve Your Place
                            </a>
                            <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20bertanya%20tentang%20YTT%2050H%20Tapa%20Brata"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                                <i class="fa-solid fa-message text-xs" aria-hidden="true"></i>
                                Ask Admissions
                            </a>
                        </div>

                        <!-- Reframing copy -->
                        <p class="font-body text-[11px] font-light text-white/30 text-center mt-6 leading-relaxed">
                            &ldquo;Lepaskan Beban Masa Lalu, Temukan Dirimu Kembali&rdquo;<br>
                            <span class="text-white/20">Release the weight of the past. Return to the self.</span>
                        </p>
                    </div>
                </article>

            </div>

            <!-- Cross-depth link to lighter programmes -->
            <p class="bes-reveal mt-10 text-center font-body font-light text-white/30 text-sm max-w-2xl mx-auto leading-relaxed">
                Not sure you are ready for the deepest depth? Start with the
                <a href="/healing-retreat" class="text-bes-gold hover:!text-white transition-colors duration-300 font-medium">Healing Retreat (5 hours)</a>
                or the
                <a href="/eling-sanctuary-retreat" class="text-bes-gold hover:!text-white transition-colors duration-300 font-medium">Eling Sanctuary Retreat (2&ndash;3 days)</a>.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — TESTIMONIALS
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Testimonials">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 max-w-xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">From Past Cohorts</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">
                    They Came Heavy.<br>
                    <em class="not-italic text-bes-olive">They Left Light.</em>
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 leading-relaxed">
                    Real words from graduates of the Tapa Brata immersion.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php
                $testimonials = [
                    [
                        'quote'  => 'I finally released burdens I had been holding quietly for years. By the third day, something I had never been able to name had a shape. By the fourth, it was gone.',
                        'name'   => 'Tapa Brata Graduate',
                        'detail' => 'YTT 50H &mdash; 4D3N Immersion',
                    ],
                    [
                        'quote'  => 'This programme helped me rediscover who I actually am underneath a decade of performing. The silence was the hardest part, and then it was the gift.',
                        'name'   => 'Tapa Brata Graduate',
                        'detail' => 'YTT 50H &mdash; 4D3N Immersion',
                    ],
                    [
                        'quote'  => 'I arrived with many wounds and went home with a much lighter heart. The certificate is on my wall. The real thing is in how I breathe now.',
                        'name'   => 'Tapa Brata Graduate',
                        'detail' => 'YTT 50H &mdash; 4D3N Immersion',
                    ],
                ];
                foreach ( $testimonials as $t ) : ?>

                <figure class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                        style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                    <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold to-transparent"></div>
                    <div class="p-7">
                        <!-- Stars -->
                        <div class="flex gap-0.5 mb-5" aria-label="5 out of 5 stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                            <i class="fa-solid fa-star text-bes-gold text-[11px]" aria-hidden="true"></i>
                            <?php endfor; ?>
                        </div>
                        <blockquote class="mb-5">
                            <p class="font-body font-light text-bes-bark text-[14px] leading-relaxed italic">
                                &ldquo;<?php echo esc_html($t['quote']); ?>&rdquo;
                            </p>
                        </blockquote>
                        <figcaption>
                            <span class="block font-body font-bold text-[12px] text-bes-bark"><?php echo esc_html($t['name']); ?></span>
                            <span class="block font-body text-[11px] text-bes-bark-muted mt-0.5"><?php echo wp_kses_post($t['detail']); ?></span>
                        </figcaption>
                    </div>
                </figure>

                <?php endforeach; ?>
            </div>

            <p class="bes-reveal text-center mt-8 font-body text-[11px] font-light text-bes-bark-muted/60 italic">
                * Participant names withheld for the privacy of the healing process. Quotes reflect actual graduate feedback.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — FAQ
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Before You Commit</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">
                    Common Questions
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 max-w-xl mx-auto leading-relaxed">
                    Questions specific to the YTT 50H Tapa Brata programme. Hub-level questions live on the Sanctuary page.
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <?php
                $faqs = [
                    [
                        'q' => 'What exactly does the 50-Hour Certificate confer?',
                        'a' => 'The certificate formally documents your completion of 50 hours of structured training across the eight Tapa Brata modules. It is issued by Bali Eling Spirit, signed by the faculty who led your cohort, and reflects the full programme &mdash; instruction, guided practice, and supervised integration. It is suitable for continuing education evidence, for your own personal record of the work, and as recognition of completion within the Tapa Brata lineage.',
                    ],
                    [
                        'q' => 'Do I need yoga, meditation, or prior retreat experience?',
                        'a' => 'No prior experience is required. The foundations of each practice are taught from the ground up. What is required is sincerity, a willingness to stay with discomfort, and the readiness to honour the vow of tapa for four days. The programme is genuinely accessible to first-time practitioners who arrive committed.',
                    ],
                    [
                        'q' => 'Is this a Yoga Alliance certification or a different type?',
                        'a' => 'This is a 50-Hour Certificate of Completion issued directly by Bali Eling Spirit within our lineage. It documents the specific curriculum and practice hours completed. If you are seeking a particular external accreditation, please speak with admissions before booking so we can confirm alignment with your goals.',
                    ],
                    [
                        'q' => 'How intense is the silence? Is it really all four days?',
                        'a' => 'Noble silence is held from the evening of Day 1 through the morning of Day 4. It is not a vow of absolute silence with the faculty &mdash; essential communication, 1:1 check-ins, sharing circles, and teaching sessions are spoken. What the silence excludes is casual conversation and phone use. Most participants find it challenging at first and deeply precious by the second day.',
                    ],
                    [
                        'q' => 'What emotional release work actually happens? Is it safe?',
                        'a' => 'The release practices combine breath, movement, sound, and guided facilitation. They are trauma-aware, offered with explicit consent, and always with an available exit. You are never pushed. Faculty are trained to hold intensity safely, and there is always a step-back option if a particular practice is not for you on a given day.',
                    ],
                    [
                        'q' => 'Can I participate if I am managing a mental health condition?',
                        'a' => 'Please disclose relevant context to admissions during booking. Tapa Brata is powerful work and not a substitute for clinical care. For many conditions, the programme can complement professional support beautifully; for others, or in specific phases, a gentler format is a better fit. We have the Healing Retreat (5 hours) and the Eling Sanctuary Retreat (2&ndash;3 days) for exactly this reason.',
                    ],
                    [
                        'q' => 'What should I pack?',
                        'a' => 'Comfortable layers for practice, a journal, a water bottle, modest attire appropriate for ceremony, and essential personal items. A detailed pre-arrival pack is shared on confirmation. Phones are requested to be kept on airplane mode for the duration of the silence &mdash; not confiscated, just set aside.',
                    ],
                    [
                        'q' => 'How is this different from the Healing Retreat and the Eling Sanctuary Retreat?',
                        'a' => 'The Healing Retreat is 5 hours &mdash; a gateway morning. The Eling Sanctuary Retreat is 2&ndash;3 days &mdash; a mid-depth residential experience. Tapa Brata is the deepest and longest: four days, three nights, with certification. The three programmes serve different seasons of a life. The team can help you choose what fits where you are.',
                    ],
                    [
                        'q' => 'What is the cohort size and cancellation policy?',
                        'a' => 'Cohorts are intentionally small to preserve facilitation depth. Cancellation terms and deposit details are shared on enquiry and confirmed in your booking. Reach out via WhatsApp for the current intake dates and terms.',
                    ],
                    [
                        'q' => 'Is the programme religious?',
                        'a' => 'The container is rooted in Balinese-Hindu healing tradition and includes a traditional cleansing rite (melukat). It is genuinely open to people of all backgrounds &mdash; religious, spiritual, agnostic, or none. What is asked is not belief, but sincere presence and respect for the tradition holding the space.',
                    ],
                ];

                foreach ( $faqs as $idx => $faq ) : ?>

                <div class="bes-reveal rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <button
                        class="w-full flex items-center justify-between gap-4 p-6 text-left group"
                        aria-expanded="false"
                        onclick="besTbFaqToggle(this)"
                        type="button">
                        <span class="font-display font-medium text-bes-bark text-lg group-hover:!text-bes-olive transition-colors duration-300 leading-snug">
                            <?php echo esc_html($faq['q']); ?>
                        </span>
                        <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center transition-all duration-300 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/20"
                              aria-hidden="true">
                            <i class="fa-solid fa-plus text-bes-bark-muted text-[10px] bes-tb-faq-icon transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="bes-tb-faq-body max-h-0 overflow-hidden transition-all duration-400 ease-in-out">
                        <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed px-6 pb-6">
                            <?php echo esc_html($faq['a']); ?>
                        </p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <!-- Back to hub link -->
            <div class="bes-reveal text-center mt-12">
                <a href="/sanctuary"
                   class="inline-flex items-center gap-2 font-body font-bold text-[11px] uppercase tracking-label text-bes-moss hover:!text-bes-bark transition-colors duration-300">
                    <i class="fa-solid fa-arrow-left text-[10px]" aria-hidden="true"></i>
                    Back to Sanctuary Hub &mdash; Compare All Three Programmes
                </a>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 10 — CLOSING CTA
         ================================================================ -->
    <section class="bg-bes-forest-deep py-16 md:py-24" aria-label="Begin your immersion">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal relative rounded-2xl border border-white/[.05] overflow-hidden py-14 px-8 md:px-14 text-center"
                 style="background:linear-gradient(135deg,rgba(38,51,32,.65),rgba(30,42,22,.92))">

                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[320px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.09),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]"
                         style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>

                <div class="relative">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">The Vow Is Waiting</p>
                    <h2 class="font-display font-medium text-white text-3xl md:text-4xl lg:text-5xl tracking-display mb-4 max-w-2xl mx-auto leading-tight">
                        It Is Time to Heal.<br>
                        <em class="not-italic text-bes-gold">It Is Time to Begin Again.</em>
                    </h2>
                    <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                        Join Tapa Brata &mdash; a limited, intimate experience for those ready to release the past and return to the self. Earn your 50-Hour Certification. Carry the work forward.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="#bes-tb-investment"
                           class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                            <i class="fa-solid fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"></i>
                            Reserve Your Place
                        </a>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            Message Admissions
                        </a>
                    </div>

                    <p class="font-body text-[11px] text-white/25 tracking-wide mt-8">
                        Limited &amp; intimate &nbsp;·&nbsp; 50-Hour Certification &nbsp;·&nbsp; 4 Days / 3 Nights &nbsp;·&nbsp; Tampaksiring, Bali
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         INLINE JS — Schedule day accordion + FAQ accordion
         (guarded against double-declaration across page re-renders)
         ================================================================ -->
    <script>
    /* --- Daily Schedule accordion --- */
    if (typeof besTbDayToggle !== 'function') {
        function besTbDayToggle(btn) {
            var body  = btn.nextElementSibling;
            var icon  = btn.querySelector('.bes-tb-day-icon');
            var open  = btn.getAttribute('aria-expanded') === 'true';

            /* Close siblings for an accordion feel */
            document.querySelectorAll('[onclick="besTbDayToggle(this)"]').forEach(function(b){
                if (b !== btn) {
                    b.setAttribute('aria-expanded','false');
                    var bd = b.nextElementSibling;
                    if (bd) bd.style.maxHeight = '0px';
                    var ic = b.querySelector('.bes-tb-day-icon');
                    if (ic) { ic.style.transform = ''; }
                }
            });

            if (open) {
                btn.setAttribute('aria-expanded','false');
                body.style.maxHeight = '0px';
                if (icon) icon.style.transform = '';
            } else {
                btn.setAttribute('aria-expanded','true');
                body.style.maxHeight = body.scrollHeight + 'px';
                if (icon) icon.style.transform = 'rotate(45deg)';
            }
        }

        /* Initialise the first day as open on load */
        document.addEventListener('DOMContentLoaded', function(){
            var first = document.querySelector('[onclick="besTbDayToggle(this)"]');
            if (first) {
                var body = first.nextElementSibling;
                var icon = first.querySelector('.bes-tb-day-icon');
                if (body) body.style.maxHeight = body.scrollHeight + 'px';
                if (icon) icon.style.transform = 'rotate(45deg)';
            }
        });
    }

    /* --- FAQ accordion --- */
    if (typeof besTbFaqToggle !== 'function') {
        function besTbFaqToggle(btn) {
            var body  = btn.nextElementSibling;
            var icon  = btn.querySelector('.bes-tb-faq-icon');
            var open  = btn.getAttribute('aria-expanded') === 'true';

            document.querySelectorAll('[onclick="besTbFaqToggle(this)"]').forEach(function(b){
                if (b !== btn) {
                    b.setAttribute('aria-expanded','false');
                    b.nextElementSibling.style.maxHeight = null;
                    var ic = b.querySelector('.bes-tb-faq-icon');
                    if (ic) { ic.style.transform = ''; ic.style.color = ''; }
                }
            });

            if (open) {
                btn.setAttribute('aria-expanded','false');
                body.style.maxHeight = null;
                if (icon) { icon.style.transform = ''; icon.style.color = ''; }
            } else {
                btn.setAttribute('aria-expanded','true');
                body.style.maxHeight = body.scrollHeight + 'px';
                if (icon) { icon.style.transform = 'rotate(45deg)'; icon.style.color = '#C9A84C'; }
            }
        }
    }
    </script>

    <?php
    return ob_get_clean();
}