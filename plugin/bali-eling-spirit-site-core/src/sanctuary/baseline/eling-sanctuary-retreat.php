<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_eling_sanctuary_retreat] Shortcode
 * ============================================================================
 *
 * Standalone dedicated landing page for the Eling Sanctuary Retreat program.
 * Part of the three-program Sanctuary Hub architecture; mirrors the hub's
 * design language while providing full program-specific detail.
 *
 * USAGE: Add [bes_eling_sanctuary_retreat] to the Eling Sanctuary Retreat page.
 *
 * SECTIONS:
 *   0 — Hero          (program identity & headline)
 *   1 — The Program   (the "why" — shared philosophy & transformation arc)
 *   2 — What You'll Experience (the 4-step journey: Release → Restore → Reconnect → Realign)
 *   3 — Program Components (the 5 practice pillars)
 *   4 — Daily Itinerary (2D1N & 3D2N schedule)
 *   5 — What's Included (facilities, meals, accommodation)
 *   6 — Pricing & Packages
 *   7 — Testimonials / Social Proof
 *   8 — FAQ
 *   9 — Closing CTA
 *
 * Design system: BES v3 — Tailwind + bes-* tokens, font-display / font-body,
 * bes-reveal entrance animation, tracking-nav / tracking-label / tracking-display.
 * Zero new CSS declarations — all styling via existing utility classes.
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_eling_sanctuary_retreat', 'bes_render_eling_sanctuary_retreat' );

function bes_render_eling_sanctuary_retreat( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — HERO
         ================================================================ -->
    <section class="relative min-h-[85vh] flex items-end overflow-hidden bg-bes-forest-deep pb-0"
             aria-labelledby="bes-esr-hero-heading">

        <!-- Atmospheric glows -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[520px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_60%)]"></div>
            <div class="absolute bottom-1/4 right-0 w-[500px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]"
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
                <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold">Eling Sanctuary Retreat</span>
            </nav>

            <div class="max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-5">
                    Eling Sanctuary Retreat &nbsp;·&nbsp; Depth 2 of 3 &nbsp;·&nbsp; Tampaksiring, Bali
                </p>

                <h1 id="bes-esr-hero-heading"
                    class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">
                    Release. Restore.<br>
                    <em class="not-italic text-bes-gold">Return to Yourself.</em>
                </h1>

                <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl leading-relaxed mb-10">
                    A sacred pause for the exhausted but not yet broken. Two or three days of yoga, breathwork, meditation, sound healing, and spiritual reflection — held in a nature sanctuary built for the quiet work of letting go.
                </p>

                <!-- CTA row -->
                <div class="bes-reveal flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="#bes-esr-pricing"
                       class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                        <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform" aria-hidden="true"></i>
                        View Packages &amp; Pricing
                    </a>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 font-body font-bold text-[11px] uppercase tracking-label !text-white/40 hover:!text-white transition-colors duration-300">
                        <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                        Ask the Sanctuary Team
                    </a>
                </div>
            </div>

            <!-- At-a-glance meta strip -->
            <div class="bes-reveal mt-14 grid grid-cols-2 md:grid-cols-4 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                <?php
                $meta = [
                    [ 'icon' => 'fa-solid fa-clock',        'label' => 'Duration',   'value' => '2D1N or 3D2N' ],
                    [ 'icon' => 'fa-solid fa-calendar',     'label' => 'Starts',     'value' => 'Tue or Fri' ],
                    [ 'icon' => 'fa-solid fa-tag',          'label' => 'Investment', 'value' => 'From IDR 2.989K++' ],
                    [ 'icon' => 'fa-solid fa-seedling',     'label' => 'Approach',   'value' => 'Release · Restore · Realign' ],
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
         SECTION 1 — THE PROGRAM (the "why")
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="About the program">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        A Sacred Pause — The Middle Way
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Deeper Than a Spa Weekend.<br>
                        Gentler Than a Silent Retreat.
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            The Eling Sanctuary Retreat was built for a particular kind of exhaustion — not the tiredness that sleep fixes, but the kind that has settled into your bones. The burnout behind the busy schedule. The emotional heaviness you've been carrying politely, alone, for too long.
                        </p>
                        <p class="bes-reveal">
                            Two or three days isn't long. But in a sanctuary held by nature, guided by authentic Balinese spiritual practice, with nothing to do except show up for yourself — it is long enough to change something.
                        </p>
                        <p class="bes-reveal">
                            <em class="not-italic text-bes-olive font-normal">Eling</em> means awareness in Balinese — the quiet return to the self beneath the noise. That is what this retreat holds as its single intention: to give you back the space to hear yourself again.
                        </p>
                    </div>

                    <!-- Ideal for block -->
                    <div class="bes-reveal mt-8 rounded-2xl border border-bes-sand p-6"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-4">This Retreat Is For You If…</p>
                        <?php
                        $for_you = [
                            'You are experiencing burnout, mental fatigue, or emotional heaviness',
                            'You need more than a morning of healing, but arent ready for a deep 4-day immersion',
                            'You want to pause, reflect, and reset — in a real sanctuary, not a hotel spa',
                            'You are a spiritual seeker ready to reconnect with your inner self',
                            'Youre a traveler who wants a retreat experience that genuinely lands',
                        ];
                        foreach ( $for_you as $item ) : ?>
                        <div class="flex items-start gap-3 py-2.5 border-b border-bes-sand last:border-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold flex-shrink-0 mt-1.5"></span>
                            <span class="font-body text-[13px] text-bes-bark-muted leading-snug"><?php echo esc_html($item); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Quote card -->
                <div class="lg:col-span-5 lg:pt-14">
                    <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                        <div class="p-8 md:p-10">
                            <blockquote class="mb-7">
                                <span class="block font-display font-light text-bes-bark text-2xl md:text-3xl leading-snug italic mb-4">
                                    &ldquo;You do not need to fix yourself before arriving. You only need to arrive.&rdquo;
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label text-bes-moss">
                                    &mdash; Eling Sanctuary Retreat
                                </cite>
                            </blockquote>

                            <!-- Quick-glance features -->
                            <div class="border-t border-bes-sand pt-6">
                                <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted mb-4">What You'll Find Here</p>
                                <?php
                                $features = [
                                    'Short immersive — 2 or 3 days',
                                    'Body–mind–soul holistic approach',
                                    'Retreat accommodation &amp; vegetarian meals',
                                    'Authentic Balinese spiritual practices',
                                    'Gentle, non-judgmental guidance',
                                    'All levels — beginner friendly',
                                ];
                                foreach ( $features as $f ) : ?>
                                <div class="flex items-center gap-3 py-2 border-b border-bes-sand last:border-0">
                                    <span class="w-1.5 h-1.5 rounded-full bg-bes-gold flex-shrink-0"></span>
                                    <span class="font-body text-[13px] text-bes-bark-muted"><?php echo wp_kses_post($f); ?></span>
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
         SECTION 2 — THE 4-STEP TRANSFORMATION ARC
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden"
             aria-label="The transformation journey">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-0 top-1/3 w-[500px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_65%)]"></div>
            <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_65%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-14 md:mb-16 max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Your Journey</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5">
                    Four Movements.<br>One Unfolding.
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    The retreat is not a series of activities. It is a carefully held arc — designed so that each phase builds on the last, and the whole adds up to more than its parts.
                </p>
            </div>

            <!-- 4-step arc -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php
                $arc = [
                    [
                        'step'    => '01',
                        'label'   => 'Release',
                        'title'   => 'Let It Go',
                        'body'    => 'The body holds what the mind has refused to process. The opening sessions — yoga, breathwork, and movement — create the safety to begin to let it down.',
                        'accent'  => 'border-bes-gold/20',
                        'dot'     => 'bg-bes-gold',
                        'glow'    => 'rgba(201,168,76,0.05)',
                    ],
                    [
                        'step'    => '02',
                        'label'   => 'Restore',
                        'title'   => 'Fill Back Up',
                        'body'    => 'Once something has been released, there is space. Sound healing, deep meditation, and the sanctuary environment itself do the work of restoration.',
                        'accent'  => 'border-bes-leaf/20',
                        'dot'     => 'bg-bes-leaf',
                        'glow'    => 'rgba(194,210,74,0.05)',
                    ],
                    [
                        'step'    => '03',
                        'label'   => 'Reconnect',
                        'title'   => 'Come Home',
                        'body'    => 'Beneath the exhaustion and the noise, there is a self that has been waiting patiently. Spiritual reflection and inner awareness practices guide you back to it.',
                        'accent'  => 'border-bes-sage/20',
                        'dot'     => 'bg-bes-sage',
                        'glow'    => 'rgba(150,180,120,0.05)',
                    ],
                    [
                        'step'    => '04',
                        'label'   => 'Realign',
                        'title'   => 'Move Forward',
                        'body'    => 'Integration sessions on the final day translate the inner work into clarity: what you are releasing for good, and what you are taking back into your life.',
                        'accent'  => 'border-white/10',
                        'dot'     => 'bg-white/40',
                        'glow'    => 'rgba(255,255,255,0.02)',
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
                        <h3 class="font-display font-medium text-white text-xl mb-3"><?php echo esc_html($a['title']); ?></h3>
                        <p class="font-body font-light text-white/45 text-[13px] leading-relaxed"><?php echo esc_html($a['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <!-- Connecting arrow line (decorative, desktop only) -->
            <div class="bes-reveal hidden lg:flex items-center justify-between mt-6 px-4 pointer-events-none" aria-hidden="true">
                <?php for ( $i = 0; $i < 3; $i++ ) : ?>
                <div class="flex-1 h-px bg-gradient-to-r from-bes-gold/20 to-bes-leaf/20 mx-6"></div>
                <?php endfor; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — PROGRAM COMPONENTS (the 5 practice pillars)
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Program components">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">What You'll Practice</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-4">
                    Five Pillars of the Sanctuary
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed">
                    Each practice serves the arc. Together, they form a complete container for healing — physical, mental, and spiritual.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $pillars = [
                    [
                        'icon'  => 'fa-solid fa-person-praying',
                        'n'     => '01',
                        'title' => 'Yoga &amp; Mindful Movement',
                        'body'  => 'Gentle, beginner-friendly yoga sequences designed to open the body and signal to the nervous system that it is safe to soften. No prior yoga experience needed — the movement meets you where you are.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-wind',
                        'n'     => '02',
                        'title' => 'Breathwork &amp; Energy Balancing',
                        'body'  => 'Breathwork is the fastest and most direct tool for shifting how the body holds emotion. Guided sessions work with the breath to release trapped energy and restore natural vitality.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-eye',
                        'n'     => '03',
                        'title' => 'Meditation &amp; Inner Awareness',
                        'body'  => 'Sitting practices that develop the capacity to observe the mind without being carried away by it — creating the inner quiet in which clarity and self-awareness naturally arise.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-music',
                        'n'     => '04',
                        'title' => 'Sound Healing',
                        'body'  => 'Traditional sound instruments create resonance that the body receives directly, bypassing the analytical mind. Sound sessions offer one of the deepest forms of rest available in the program.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-book-open',
                        'n'     => '05',
                        'title' => 'Spiritual Reflection &amp; Integration',
                        'body'  => 'Guided contemplation, journaling prompts, and group sharing circles that help translate experience into insight — so the work done on retreat does not evaporate when you return to daily life.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-leaf',
                        'n'     => '06',
                        'title' => 'The Sanctuary Itself',
                        'body'  => 'Bali Eling Spirit is a nature-held environment in Tampaksiring — the land, the air, the unhurried pace are themselves part of the practice. You do not need to manufacture peace here; it is already present.',
                    ],
                ];
                foreach ( $pillars as $p ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden transition-all duration-500 hover:border-bes-gold/30"
                     style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="absolute top-0 right-0 w-36 h-36 bg-[radial-gradient(circle,rgba(201,168,76,0.05),transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" aria-hidden="true"></div>
                    <div class="relative p-6 md:p-7">
                        <div class="flex items-center justify-between mb-5">
                            <span class="font-display font-light text-bes-bark/10 text-5xl leading-none"><?php echo esc_html($p['n']); ?></span>
                            <div class="w-10 h-10 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center">
                                <i class="<?php echo esc_attr($p['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-xl mb-2"><?php echo wp_kses_post($p['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo esc_html($p['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — DAILY ITINERARY (2D1N & 3D2N)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Program schedule">

        <div class="absolute right-0 top-0 bottom-0 w-[400px] bg-[radial-gradient(ellipse_at_right,rgba(201,168,76,0.04),transparent_60%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
             style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">How the Days Unfold</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">
                    Your Sanctuary Schedule
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    A representative day-by-day guide. Exact timings are set with the team. All programs start Tuesday or Friday.
                </p>
            </div>

            <!-- Package tabs — 2D1N / 3D2N -->
            <div class="bes-reveal flex gap-3 mb-8" role="tablist" aria-label="Itinerary options">
                <a href="javascript:void(0);" onclick="besItinTab(this,'2d1n')" id="tab-2d1n"
                        class="bes-itin-tab inline-block cursor-pointer select-none font-body font-bold text-[11px] uppercase tracking-label px-6 py-3 rounded-xl border border-bes-gold bg-bes-gold text-bes-forest transition-all duration-300"
                        role="tab" aria-selected="true" aria-controls="itin-2d1n">
                    2D 1N Package
                </a>
                <a href="javascript:void(0);" onclick="besItinTab(this,'3d2n')" id="tab-3d2n"
                        class="bes-itin-tab inline-block cursor-pointer select-none font-body font-bold text-[11px] uppercase tracking-label px-6 py-3 rounded-xl border border-white/[.08] !text-white/40 hover:border-bes-gold/30 hover:!text-white/70 transition-all duration-300"
                        role="tab" aria-selected="false" aria-controls="itin-3d2n">
                    3D 2N Package
                </a>
            </div>

            <?php
            $itinerary = [
                '2d1n' => [
                    [
                        'day'   => 'Day 1 — Tuesday or Friday',
                        'title' => 'Arrive &amp; Release',
                        'sessions' => [
                            [ 'time' => '14:00',       'act' => 'Check-in & orientation — settle into the sanctuary, meet the team' ],
                            [ 'time' => '15:30',       'act' => 'Opening ceremony & intention setting' ],
                            [ 'time' => '16:00–17:30', 'act' => 'Yoga & mindful movement — the body begins to soften' ],
                            [ 'time' => '18:00',       'act' => 'Vegetarian dinner — nourishment as practice' ],
                            [ 'time' => '19:30',       'act' => 'Sound healing — deep restoration through resonance' ],
                            [ 'time' => '21:00',       'act' => 'Free time & rest — the sanctuary holds the silence' ],
                        ],
                    ],
                    [
                        'day'   => 'Day 2 — Morning & Checkout',
                        'title' => 'Restore, Realign &amp; Return',
                        'sessions' => [
                            [ 'time' => '06:00',       'act' => 'Morning yoga & breathwork — greet the day from the inside' ],
                            [ 'time' => '07:30',       'act' => 'Vegetarian breakfast' ],
                            [ 'time' => '09:00–11:00', 'act' => 'Meditation & inner awareness — finding the quiet centre' ],
                            [ 'time' => '11:00–12:00', 'act' => 'Spiritual reflection & integration — translating insight into life' ],
                            [ 'time' => '12:00',       'act' => 'Farewell lunch' ],
                            [ 'time' => '13:00',       'act' => 'Checkout — leave lighter than you arrived' ],
                        ],
                    ],
                ],
                '3d2n' => [
                    [
                        'day'   => 'Day 1 — Tuesday or Friday',
                        'title' => 'Arrive &amp; Release',
                        'sessions' => [
                            [ 'time' => '14:00',       'act' => 'Check-in & orientation — settle into the sanctuary, meet the team' ],
                            [ 'time' => '15:30',       'act' => 'Opening ceremony & intention setting' ],
                            [ 'time' => '16:00–17:30', 'act' => 'Yoga & mindful movement — initial softening of the body' ],
                            [ 'time' => '18:00',       'act' => 'Vegetarian dinner' ],
                            [ 'time' => '19:30',       'act' => 'Sound healing — first layer of restoration' ],
                            [ 'time' => '21:00',       'act' => 'Rest & silence' ],
                        ],
                    ],
                    [
                        'day'   => 'Day 2 — Full Immersion',
                        'title' => 'Restore &amp; Reconnect',
                        'sessions' => [
                            [ 'time' => '06:00',       'act' => 'Morning yoga — deeper movement, longer holds' ],
                            [ 'time' => '07:30',       'act' => 'Vegetarian breakfast' ],
                            [ 'time' => '09:00–11:00', 'act' => 'Breathwork & energy balancing — the emotional body' ],
                            [ 'time' => '11:30–13:00', 'act' => 'Meditation & inner awareness — the mind begins to still' ],
                            [ 'time' => '13:00',       'act' => 'Lunch & free time — rest, walk, be' ],
                            [ 'time' => '16:00–17:30', 'act' => 'Spiritual reflection — journaling, contemplation, sharing circle' ],
                            [ 'time' => '18:00',       'act' => 'Vegetarian dinner' ],
                            [ 'time' => '19:30',       'act' => 'Sound healing — deepened by a full day of practice' ],
                            [ 'time' => '21:00',       'act' => 'Rest & integration' ],
                        ],
                    ],
                    [
                        'day'   => 'Day 3 — Morning &amp; Checkout',
                        'title' => 'Realign &amp; Return',
                        'sessions' => [
                            [ 'time' => '06:00',       'act' => 'Morning yoga & breathwork' ],
                            [ 'time' => '07:30',       'act' => 'Vegetarian breakfast' ],
                            [ 'time' => '09:00–11:00', 'act' => 'Integration session — clarity, intention, and what comes next' ],
                            [ 'time' => '11:00–12:00', 'act' => 'Closing ceremony — sealing the work done' ],
                            [ 'time' => '12:00',       'act' => 'Farewell lunch' ],
                            [ 'time' => '13:00',       'act' => 'Checkout — leave with a compass, not just a memory' ],
                        ],
                    ],
                ],
            ];
            foreach ( $itinerary as $pkg_key => $days ) : ?>

            <div id="itin-<?php echo esc_attr($pkg_key); ?>"
                 class="bes-itin-panel <?php echo $pkg_key === '2d1n' ? '' : 'hidden'; ?>"
                 role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($pkg_key); ?>">
                <div class="space-y-5">
                    <?php foreach ( $days as $d ) : ?>
                    <div class="bes-reveal rounded-2xl border border-white/[.05] overflow-hidden"
                         style="background:rgba(38,51,32,0.40)">
                        <!-- Day header -->
                        <div class="px-6 py-4 border-b border-white/[.05] flex items-center justify-between">
                            <div>
                                <span class="block font-body font-bold text-[9px] uppercase tracking-label text-bes-gold/70 mb-0.5"><?php echo wp_kses_post($d['day']); ?></span>
                                <span class="font-display font-medium text-white text-lg"><?php echo wp_kses_post($d['title']); ?></span>
                            </div>
                        </div>
                        <!-- Sessions -->
                        <div class="divide-y divide-white/[.04]">
                            <?php foreach ( $d['sessions'] as $s ) : ?>
                            <div class="flex items-start gap-4 px-6 py-3.5">
                                <span class="flex-shrink-0 font-body font-bold text-[11px] text-bes-gold/60 min-w-[70px] mt-0.5"><?php echo esc_html($s['time']); ?></span>
                                <span class="font-body text-[13px] font-light text-white/55 leading-snug"><?php echo esc_html($s['act']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php endforeach; ?>

            <p class="bes-reveal mt-8 font-body text-[12px] font-light text-white/25 leading-relaxed">
                * Schedule is representative. Exact timings confirmed with the team upon booking. Schedules may vary slightly based on group needs.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — WHAT'S INCLUDED
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="What is included">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Everything Provided</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-5">
                    What Your Retreat Includes
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed">
                    Arrive and be received. Everything you need is already here.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php
                $included = [
                    [
                        'icon'  => 'fa-solid fa-bed',
                        'title' => 'Retreat Accommodation',
                        'body'  => '1 night (2D1N) or 2 nights (3D2N) in the sanctuary. Simple, clean, and conducive to rest.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-bowl-food',
                        'title' => 'All Vegetarian Meals',
                        'body'  => 'Every meal during the retreat — breakfast, lunch, and dinner — prepared mindfully with wholesome, nourishing ingredients.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-hands-praying',
                        'title' => 'All Healing Sessions',
                        'body'  => 'Yoga, breathwork, meditation, sound healing, spiritual reflection, and integration — all guided, all included.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-spa',
                        'title' => 'Sanctuary Access',
                        'body'  => 'Full use of Bali Eling Spirit facilities during your stay — the grounds, the gardens, the spaces for rest.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-user-shield',
                        'title' => 'Personal Guidance',
                        'body'  => 'Attentive, non-judgmental support from the Bali Eling Spirit team throughout your stay.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-certificate',
                        'title' => 'Program Materials',
                        'body'  => 'Reflection guides and integration materials to support the inner work during and after the retreat.',
                    ],
                ];
                foreach ( $included as $item ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden hover:border-bes-gold/30 transition-all duration-500"
                     style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="p-6 md:p-7">
                        <div class="w-11 h-11 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center mb-5 group-hover:bg-bes-gold/10 transition-colors duration-300">
                            <i class="<?php echo esc_attr($item['icon']); ?> text-bes-gold text-[13px]" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-xl mb-2"><?php echo esc_html($item['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo esc_html($item['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — PRICING & PACKAGES
         ================================================================ -->
    <section id="bes-esr-pricing" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Pricing and packages">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 md:mb-14 max-w-2xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Choose Your Duration</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5">
                    Two Packages.<br>One Sanctuary.
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    Choose based on what your life can hold right now. Both packages are complete in themselves.
                </p>
            </div>

            <!-- Pricing cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-4xl mx-auto">

                <!-- 2D1N -->
                <article class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden hover:border-bes-gold/20 transition-all duration-500 flex flex-col"
                         style="background:rgba(38,51,32,0.45)">
                    <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/10 to-bes-gold/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold to-transparent"></div>
                    <div class="relative p-8 md:p-10 flex flex-col flex-1">
                        <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/70 mb-4">Shorter Immersion</p>
                        <h3 class="font-display font-medium text-white text-3xl mb-1">2 Days / 1 Night</h3>
                        <p class="font-body font-light text-white/40 text-sm mb-6">Tuesday or Friday check-in</p>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-6 pb-6 border-b border-white/[.06]">
                            <span class="font-display font-medium text-white text-4xl">IDR 2.989K</span>
                            <span class="font-body text-white/40 text-sm">++</span>
                        </div>

                        <!-- Includes -->
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/25 mb-3">Includes</p>
                        <ul class="space-y-2 mb-8 flex-1" role="list">
                            <?php
                            $pkg2d = [
                                '2 days / 1 night retreat experience',
                                'All healing &amp; spiritual sessions',
                                '1 night sanctuary accommodation',
                                'All vegetarian meals (dinner + 2× breakfast)',
                                'Sound healing session',
                                'Full sanctuary access',
                                'Personal guidance &amp; reflection materials',
                            ];
                            foreach ( $pkg2d as $line ) : ?>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-bes-gold/60 text-[9px] mt-1.5 flex-shrink-0" aria-hidden="true"></i>
                                <span class="font-body text-[12.5px] font-light text-white/55 leading-snug"><?php echo wp_kses_post($line); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20bergabung%20dengan%20Eling%20Sanctuary%20Retreat%202D1N"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center w-full gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:opacity-90 transition-all duration-300 group/cta mt-auto">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            Book 2D1N Package
                        </a>
                    </div>
                </article>

                <!-- 3D2N — "Recommended" -->
                <article class="bes-reveal group relative rounded-2xl border border-bes-gold/25 overflow-hidden hover:border-bes-gold/40 transition-all duration-500 flex flex-col"
                         style="background:rgba(38,51,32,0.55)">
                    <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/15 to-bes-leaf/5 opacity-50 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="relative p-8 md:p-10 flex flex-col flex-1">

                        <!-- Recommended badge -->
                        <div class="flex items-center justify-between mb-4">
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/70">Deeper Immersion</p>
                            <span class="font-body font-bold text-[9px] uppercase tracking-label bg-bes-gold/15 border border-bes-gold/25 text-bes-gold rounded-full px-3 py-1">
                                Recommended
                            </span>
                        </div>
                        <h3 class="font-display font-medium text-white text-3xl mb-1">3 Days / 2 Nights</h3>
                        <p class="font-body font-light text-white/40 text-sm mb-6">Tuesday or Friday check-in</p>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-6 pb-6 border-b border-white/[.06]">
                            <span class="font-display font-medium text-white text-4xl">IDR 3.989K</span>
                            <span class="font-body text-white/40 text-sm">++</span>
                        </div>

                        <!-- Includes -->
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/25 mb-3">Everything in 2D1N, Plus</p>
                        <ul class="space-y-2 mb-8 flex-1" role="list">
                            <?php
                            $pkg3d = [
                                '3 days / 2 nights deeper immersion',
                                'Additional full-day practice on Day 2',
                                '2 nights sanctuary accommodation',
                                'All vegetarian meals throughout',
                                '2× sound healing sessions',
                                'Extended spiritual reflection &amp; sharing circle',
                                'Full integration &amp; closing ceremony on Day 3',
                                'Full sanctuary access',
                                'Personal guidance &amp; reflection materials',
                            ];
                            foreach ( $pkg3d as $line ) : ?>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-bes-gold text-[9px] mt-1.5 flex-shrink-0" aria-hidden="true"></i>
                                <span class="font-body text-[12.5px] font-light text-white/60 leading-snug"><?php echo wp_kses_post($line); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20bergabung%20dengan%20Eling%20Sanctuary%20Retreat%203D2N"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center w-full gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/15 group/cta mt-auto">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            Book 3D2N Package
                        </a>
                    </div>
                </article>

            </div>

            <!-- Private option note -->
            <p class="bes-reveal mt-8 text-center font-body font-light text-white/30 text-sm">
                Private retreat arrangements available on request —
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                   class="text-bes-gold hover:!text-white transition-colors duration-300 font-medium">
                    speak with the team directly.
                </a>
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — TESTIMONIALS / SOCIAL PROOF
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Testimonials">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 max-w-xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">From Those Who Stayed</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">
                    What Participants Say
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php
                $testimonials = [
                    [
                        'quote'  => 'I felt so much lighter and gained clarity after this retreat. I arrived carrying months of pressure and left feeling like myself again.',
                        'name'   => 'Retreat Participant',
                        'detail' => '2D1N, Eling Sanctuary Retreat',
                    ],
                    [
                        'quote'  => 'The most peaceful place to reconnect with yourself. The team holds the space with so much care — you feel completely safe to let go.',
                        'name'   => 'Retreat Participant',
                        'detail' => '3D2N, Eling Sanctuary Retreat',
                    ],
                    [
                        'quote'  => 'I was skeptical about short retreats but this changed everything. Two days and I came away with a completely different relationship to my stress.',
                        'name'   => 'Retreat Participant',
                        'detail' => '2D1N, Eling Sanctuary Retreat',
                    ],
                ];
                foreach ( $testimonials as $t ) : ?>

                <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
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
                        <div>
                            <span class="block font-body font-bold text-[12px] text-bes-bark"><?php echo esc_html($t['name']); ?></span>
                            <span class="block font-body text-[11px] text-bes-bark-muted mt-0.5"><?php echo esc_html($t['detail']); ?></span>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — FAQ
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Before You Book</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">
                    Common Questions
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 max-w-xl mx-auto leading-relaxed">
                    Questions about the Eling Sanctuary Retreat specifically. Hub-level questions live on the Sanctuary page.
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <?php
                $faqs = [
                    [
                        'q' => 'What is the difference between the 2D1N and 3D2N packages?',
                        'a' => 'Both packages are complete retreats — the 2D1N is ideal if your schedule allows only a weekend away, and it delivers genuine depth in two days. The 3D2N adds a full middle day of immersion that allows the inner work to go further. If you have the time and feel you are carrying something heavy, the 3D2N is recommended.',
                    ],
                    [
                        'q' => 'Do I need yoga or meditation experience?',
                        'a' => 'No experience is necessary. The program is designed to be accessible to complete beginners. The team works with what you bring — the instruction is practical, hands-on, and supportive.',
                    ],
                    [
                        'q' => 'What should I bring?',
                        'a' => 'Comfortable clothing for yoga and movement, a journal if you have one, and a genuine willingness to slow down. The sanctuary provides everything else. A detailed packing list is shared upon booking.',
                    ],
                    [
                        'q' => 'How is this different from the Healing Retreat?',
                        'a' => 'The Healing Retreat (5 hours) is a morning program — high-impact, no accommodation, excellent for visitors and those testing the waters. The Eling Sanctuary Retreat is a residential immersion of 2–3 days. The depth, the continuity, and the lived experience of staying overnight are different in quality. If you have already done the Healing Retreat and want to go further, this is the natural next step.',
                    ],
                    [
                        'q' => 'How is this different from Tapa Brata?',
                        'a' => 'Tapa Brata (4 days, 3 nights) is the deepest offering — it is designed for participants ready to meet something old and unresolved. The Eling Sanctuary Retreat is gentler and shorter, more focused on rest and restoration than deep emotional excavation. It is a meaningful retreat; Tapa Brata is a transformational one. Both are valuable. Different circumstances call for different depths.',
                    ],
                    [
                        'q' => 'How far in advance should I book?',
                        'a' => 'We recommend booking at least 5–7 days in advance. The programs run in small groups and intake dates are limited. We also suggest confirming with the team directly to ensure alignment with the teachers\' schedule.',
                    ],
                    [
                        'q' => 'Is the program religious? Do I need to be spiritual?',
                        'a' => 'The practices are rooted in Balinese-Hindu tradition. The retreat is genuinely open to people of all backgrounds — religious, spiritual, agnostic, or none. What is asked of you is not belief, but sincere presence.',
                    ],
                ];

                foreach ( $faqs as $idx => $faq ) : ?>

                <div class="bes-reveal rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <button
                        class="w-full flex items-center justify-between gap-4 p-6 text-left group"
                        aria-expanded="false"
                        onclick="besEsrFaqToggle(this)"
                        type="button">
                        <span class="font-display font-medium text-bes-bark text-lg group-hover:!text-bes-olive transition-colors duration-300">
                            <?php echo esc_html($faq['q']); ?>
                        </span>
                        <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center transition-all duration-300 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/20"
                              aria-hidden="true">
                            <i class="fa-solid fa-plus text-bes-bark-muted text-[10px] bes-esr-faq-icon transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="bes-esr-faq-body max-h-0 overflow-hidden transition-all duration-400 ease-in-out">
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
                    Back to Sanctuary Hub — Compare All Three Programs
                </a>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — CLOSING CTA
         ================================================================ -->
    <section class="bg-bes-forest-deep py-16 md:py-24" aria-label="Begin your retreat">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal relative rounded-2xl border border-white/[.05] overflow-hidden py-14 px-8 md:px-14 text-center"
                 style="background:linear-gradient(135deg,rgba(38,51,32,.65),rgba(30,42,22,.9))">

                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[600px] h-[280px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.08),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]"
                         style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>

                <div class="relative">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Your Pause Awaits</p>
                    <h2 class="font-display font-medium text-white text-3xl md:text-4xl lg:text-5xl tracking-display mb-4 max-w-2xl mx-auto">
                        Recharge. Reflect.<br>
                        <em class="not-italic text-bes-gold">Reconnect.</em>
                    </h2>
                    <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                        Whether you choose two days or three, the sanctuary holds the same promise: a space where you can put down what you have been carrying — and remember who you are beneath it.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="#bes-esr-pricing"
                           class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                            <i class="fa-solid fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"></i>
                            View Packages
                        </a>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            WhatsApp the Sanctuary
                        </a>
                    </div>

                    <p class="font-body text-[11px] text-white/20 tracking-wide mt-8">
                        All levels welcome &nbsp;·&nbsp; Small intimate groups &nbsp;·&nbsp; Beginner friendly &nbsp;·&nbsp; Tampaksiring, Bali
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         INLINE JS — Itinerary tab switcher + FAQ accordion
         ================================================================ -->
    <script>
    /* --- Itinerary tab switcher --- */
    if (typeof besItinTab !== 'function') {
        function besItinTab(btn, pkg) {
            document.querySelectorAll('.bes-itin-panel').forEach(function(p) { p.classList.add('hidden'); });
            document.querySelectorAll('.bes-itin-tab').forEach(function(b) {
                b.classList.remove('bg-bes-gold', 'text-bes-forest', 'border-bes-gold');
                b.classList.add('text-white/40', 'border-white/[.08]');
                b.setAttribute('aria-selected', 'false');
            });
            var panel = document.getElementById('itin-' + pkg);
            if (panel) panel.classList.remove('hidden');
            btn.classList.add('bg-bes-gold', 'text-bes-forest', 'border-bes-gold');
            btn.classList.remove('text-white/40', 'border-white/[.08]');
            btn.setAttribute('aria-selected', 'true');
        }
    }

    /* --- FAQ accordion --- */
    if (typeof besEsrFaqToggle !== 'function') {
        function besEsrFaqToggle(btn) {
            var body = btn.nextElementSibling;
            var icon = btn.querySelector('.bes-esr-faq-icon');
            var isOpen = btn.getAttribute('aria-expanded') === 'true';

            document.querySelectorAll('[onclick="besEsrFaqToggle(this)"]').forEach(function(b) {
                if (b !== btn) {
                    b.setAttribute('aria-expanded', 'false');
                    b.nextElementSibling.style.maxHeight = null;
                    var ic = b.querySelector('.bes-esr-faq-icon');
                    if (ic) { ic.style.transform = ''; ic.style.color = ''; }
                }
            });

            if (isOpen) {
                btn.setAttribute('aria-expanded', 'false');
                body.style.maxHeight = null;
                if (icon) { icon.style.transform = ''; icon.style.color = ''; }
            } else {
                btn.setAttribute('aria-expanded', 'true');
                body.style.maxHeight = body.scrollHeight + 'px';
                if (icon) { icon.style.transform = 'rotate(45deg)'; icon.style.color = '#C9A84C'; }
            }
        }
    }
    </script>

    <?php
    return ob_get_clean();
}