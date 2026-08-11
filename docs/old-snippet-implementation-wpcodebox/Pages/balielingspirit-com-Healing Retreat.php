<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_healing_retreat] Shortcode
 * ============================================================================
 *
 * Standalone dedicated landing page for the Healing Retreat program (5 Hours).
 * Part of the three-program Sanctuary Hub architecture; mirrors the hub's
 * design language while providing full program-specific detail.
 *
 * Depth 1 of 3 — The gateway experience. High-impact, low-commitment.
 * Ideal for travelers, busy professionals, beginners, and those who need
 * a genuine reset in half a day without an overnight commitment.
 *
 * USAGE: Add [bes_healing_retreat] to the Healing Retreat page.
 *
 * SECTIONS:
 *   0 — Hero              (program identity & headline)
 *   1 — The Philosophy    (why this short-format retreat — pain points)
 *   2 — The Transformation (the 3-movement arc: Arrive → Release → Return)
 *   3 — Program Components (the 5 healing modalities)
 *   4 — Daily Itinerary   (the 5-hour flow, 08:00–14:00 WITA)
 *   5 — What's Included   (facilities, meals, transfer)
 *   6 — Instructor Profile (the Bali Eling Spirit approach)
 *   7 — Pricing & Packages
 *   8 — Testimonials / Social Proof
 *   9 — FAQ
 *  10 — Closing CTA
 *
 * Design system: BES v3 — Tailwind + bes-* tokens, font-display / font-body,
 * bes-reveal entrance animation, tracking-nav / tracking-label / tracking-display.
 * Zero new CSS declarations — all styling via existing utility classes.
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_healing_retreat', 'bes_render_healing_retreat' );

function bes_render_healing_retreat( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — HERO
         ================================================================ -->
    <section class="relative min-h-[85vh] flex items-end overflow-hidden bg-bes-forest-deep pb-0"
             aria-labelledby="bes-hr-hero-heading">

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
                <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold">Healing Retreat</span>
            </nav>

            <div class="max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-5">
                    Healing Retreat &nbsp;·&nbsp; Depth 1 of 3 &nbsp;·&nbsp; Tampaksiring, Bali
                </p>

                <h1 id="bes-hr-hero-heading"
                    class="bes-reveal font-display font-medium text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">
                    Take a Break.<br>
                    <em class="not-italic text-bes-gold">Heal in Just 5 Hours.</em>
                </h1>

                <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl leading-relaxed mb-10">
                    A short but powerful healing experience for the exhausted, the curious, and the in-between. Five hours of yoga, breathwork, meditation, cleansing ritual, and sound healing &mdash; the complete Balinese healing arc, distilled into a single sanctuary morning.
                </p>

                <!-- CTA row -->
                <div class="bes-reveal flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="#bes-hr-pricing"
                       class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                        <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform" aria-hidden="true"></i>
                        Book Your Healing Day
                    </a>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 font-body font-bold text-[11px] uppercase tracking-label !text-white/40 hover:!text-white transition-colors duration-300">
                        <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                        Ask the Sanctuary Team
                    </a>
                </div>
            </div>

            <!-- At-a-glance meta strip -->
            <div class="bes-reveal mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                <?php
                $meta = [
                    [ 'icon' => 'fa-solid fa-clock',        'label' => 'Duration',   'value' => '5 Hours' ],
                    [ 'icon' => 'fa-solid fa-calendar',     'label' => 'Available',  'value' => 'Daily (Except Mon)' ],
                    [ 'icon' => 'fa-solid fa-bowl-food',    'label' => 'Meals',      'value' => 'Free Vegetarian Breakfast & Lunch' ],
                    [ 'icon' => 'fa-solid fa-van-shuttle',  'label' => 'Additional Facility', 'value' => 'Free Pick-Up & Drop at Sang Spa' ],
                ];
                foreach ( $meta as $m ) : ?>
                <div class="flex items-center gap-3 px-5 py-5 bg-bes-forest/60 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.12] flex items-center justify-center flex-shrink-0">
                        <i class="<?php echo esc_attr($m['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block font-body text-[9px] uppercase tracking-label text-white/25 font-bold"><?php echo esc_html($m['label']); ?></span>
                        <span class="block font-body text-[13px] text-white/80 font-medium mt-0.5 leading-snug break-words"><?php echo esc_html($m['value']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — THE PHILOSOPHY (pain points — why this exists)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Why this retreat exists">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        The Gateway Experience
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        You Don't Have a Week.<br>
                        You Have One Morning.<br>
                        <em class="not-italic text-bes-olive">It's Enough.</em>
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            Most retreats ask for days you don't have. A long weekend. A full week. Time off, logistics, permission. Meanwhile the exhaustion compounds, the inbox grows, the quiet keeps getting postponed.
                        </p>
                        <p class="bes-reveal">
                            The Healing Retreat was built for the gap between &ldquo;I should really do something&rdquo; and &ldquo;I actually have four days free.&rdquo; Five hours. One sanctuary morning. The full Balinese healing arc &mdash; yoga, breathwork, meditation, cleansing, sound &mdash; held together with intention.
                        </p>
                        <p class="bes-reveal">
                            It is not a spa. It is not a workshop. It is a real retreat in miniature, designed so that when you leave at 14:00, something in you has actually shifted &mdash; not just been distracted for a while.
                        </p>
                    </div>

                    <!-- Pain points block -->
                    <div class="bes-reveal mt-8 rounded-2xl border border-bes-sand p-6"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-4">Does This Sound Like You?</p>
                        <?php
                        $pain_points = [
                            'Stress &amp; fatigue from daily life is starting to feel normal',
                            'You don&rsquo;t have time for a long retreat &mdash; but you need something real',
                            'Your mind is full and you&rsquo;ve forgotten how to actually relax',
                            'You feel disconnected from yourself in a way you can&rsquo;t quite name',
                            'You want a pause, but you don&rsquo;t know where to start',
                        ];
                        foreach ( $pain_points as $item ) : ?>
                        <div class="flex items-start gap-3 py-2.5 border-b border-bes-sand last:border-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold flex-shrink-0 mt-1.5"></span>
                            <span class="font-body text-[13px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($item); ?></span>
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
                                    &ldquo;Five hours is not a long time. But it is long enough to remember you have a self.&rdquo;
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label text-bes-moss">
                                    &mdash; Healing Retreat
                                </cite>
                            </blockquote>

                            <!-- Quick-glance features -->
                            <div class="border-t border-bes-sand pt-6">
                                <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted mb-4">What Makes This Work</p>
                                <?php
                                $features = [
                                    'Short retreat &mdash; high impact, low commitment',
                                    'Five complete Balinese healing modalities',
                                    'Breakfast &amp; vegetarian lunch included',
                                'Complimentary pick-up and drop-off at Sang Spa',
                                    'Beginner-friendly &mdash; no experience needed',
                                    'Daily availability &mdash; book when you can',
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
         SECTION 2 — THE 3-MOVEMENT TRANSFORMATION ARC
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
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">What You'll Experience</p>
                <h2 class="bes-reveal font-display font-medium text-white text-3xl sm:text-4xl md:text-5xl tracking-display mb-5">
                    Three Movements.<br>One Morning.
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    The day is built as a complete arc &mdash; arrival, release, return. Each modality serves the next. Nothing is filler. By lunchtime, you are a different shape of yourself.
                </p>
            </div>

            <!-- 3-step arc -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <?php
                $arc = [
                    [
                        'step'    => '01',
                        'label'   => 'Arrive',
                        'title'   => 'Ground Into the Sanctuary',
                        'body'    => 'The morning opens with arrival &amp; grounding &mdash; letting the pace of your outside life fall away. The sanctuary environment begins its quiet work before any session does.',
                        'accent'  => 'border-bes-gold/20',
                        'dot'     => 'bg-bes-gold',
                        'glow'    => 'rgba(201,168,76,0.05)',
                    ],
                    [
                        'step'    => '02',
                        'label'   => 'Release',
                        'title'   => 'Let the Body Lead',
                        'body'    => 'Gentle yoga, breathwork, meditation, and cleansing ritual move in sequence &mdash; each one deepening what came before. The body softens, the mind follows, the emotions catch up.',
                        'accent'  => 'border-bes-leaf/20',
                        'dot'     => 'bg-bes-leaf',
                        'glow'    => 'rgba(194,210,74,0.05)',
                    ],
                    [
                        'step'    => '03',
                        'label'   => 'Return',
                        'title'   => 'Leave Lighter',
                        'body'    => 'Sound healing and integration seal the work. Over vegetarian lunch, you begin to feel what shifted. You leave with something you did not arrive with &mdash; and without something you did.',
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
                <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-6 text-center">What You'll Leave With</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                    <?php
                    $outcomes = [
                        [ 'icon' => 'fa-solid fa-leaf',         'label' => 'Genuine Calm' ],
                        [ 'icon' => 'fa-solid fa-brain',        'label' => 'Clearer Mind' ],
                        [ 'icon' => 'fa-solid fa-heart',        'label' => 'Softer Body' ],
                        [ 'icon' => 'fa-solid fa-compass',      'label' => 'Reconnection' ],
                        [ 'icon' => 'fa-solid fa-sun',          'label' => 'Restored Energy' ],
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
         SECTION 3 — PROGRAM COMPONENTS (5 healing modalities)
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Program components">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">What You'll Practice</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display mb-4">
                    Five Modalities.<br>One Complete Arc.
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed">
                    Each practice is chosen for what it does and where it sits in the sequence. Nothing is optional. Nothing is redundant.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $pillars = [
                    [
                        'icon'  => 'fa-solid fa-person-praying',
                        'n'     => '01',
                        'title' => 'Yoga Session',
                        'sub'   => 'Gentle &amp; Mindful',
                        'body'  => 'Soft, beginner-friendly movement to open the body and signal to your nervous system that it is safe to exhale. No experience required &mdash; the practice meets you where you are.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-wind',
                        'n'     => '02',
                        'title' => 'Breathwork',
                        'sub'   => 'Release &amp; Balance',
                        'body'  => 'Guided breathing techniques to release trapped tension and rebalance the emotional body. The fastest, most direct path into a different state &mdash; no equipment, no belief required.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-eye',
                        'n'     => '03',
                        'title' => 'Meditation',
                        'sub'   => 'Inner Calm &amp; Awareness',
                        'body'  => 'A seated practice designed to settle the mind and return you to the self beneath the noise. The stillness built here carries you through the rest of the day.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-droplet',
                        'n'     => '04',
                        'title' => 'Cleansing Ritual',
                        'sub'   => 'Traditional Purification',
                        'body'  => 'An authentic Balinese purification ritual &mdash; an intentional act of letting go, held in the tradition it comes from. Not performance. Not spectacle. The real thing.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-music',
                        'n'     => '05',
                        'title' => 'Sound Healing',
                        'sub'   => 'Deep Relaxation',
                        'body'  => 'Traditional sound instruments create resonance that the body receives directly, bypassing the analytical mind. Often the deepest rest most participants have experienced in months.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-leaf',
                        'n'     => '06',
                        'title' => 'The Sanctuary Itself',
                        'sub'   => 'Bali Eling Spirit',
                        'body'  => 'The nature-held environment of Tampaksiring is part of the practice. You are not trying to manufacture peace here. The land is already holding it for you.',
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
                        <h3 class="font-display font-medium text-bes-bark text-xl mb-1"><?php echo wp_kses_post($p['title']); ?></h3>
                        <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-3"><?php echo wp_kses_post($p['sub']); ?></p>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo wp_kses_post($p['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — DAILY ITINERARY (5-hour flow timeline)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Program schedule">

        <div class="absolute right-0 top-0 bottom-0 w-[400px] bg-[radial-gradient(ellipse_at_right,rgba(201,168,76,0.04),transparent_60%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
             style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">How the Morning Unfolds</p>
                <h2 class="bes-reveal font-display font-medium text-white text-3xl sm:text-4xl md:text-5xl tracking-display mb-4">
                    Your Five-Hour Flow
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    Available Tuesday through Sunday. The full arc runs from arrival to integration, giving your body, mind, and energy enough time to soften, release, and return.
                </p>
            </div>

            <!-- Timeline -->
            <div class="max-w-4xl">
                <div class="bes-reveal rounded-2xl border border-white/[.05] overflow-hidden"
                     style="background:rgba(38,51,32,0.40)">

                    <!-- Day header -->
                    <div class="px-5 sm:px-6 py-5 border-b border-white/[.05] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="min-w-0">
                            <span class="block font-body font-bold text-[9px] uppercase tracking-label text-bes-gold/70 mb-0.5">ONE DAY &mdash; TUESDAY THROUGH SUNDAY</span>
                            <span class="font-display font-medium text-white text-lg">From Arrival to Integration</span>
                        </div>
                        <span class="self-start sm:self-auto font-body font-bold text-[10px] uppercase tracking-label bg-bes-gold/15 border border-bes-gold/25 text-bes-gold rounded-full px-3 py-1">
                            + 5 HOURS TOTAL
                        </span>
                    </div>

                    <!-- Sessions -->
                    <?php
                    $itinerary = [
                        [ 'time' => '08:00',       'act' => 'Arrival &amp; Grounding', 'desc' => 'Check in, receive a warm welcome, and gently settle into the sanctuary. A comforting herbal spiced tea is served to awaken the senses, warm the body, and prepare you for the journey ahead.' ],
                        [ 'time' => '08:15',       'act' => 'Ritual Karmic Cleansing', 'desc' => 'A sacred intention-setting ritual to release emotional burdens, past traumas, limiting energies, and unwanted karmic patterns, while planting heartfelt intentions for the transformation you wish to embrace.' ],
                        [ 'time' => '08:30',       'act' => 'Sacred Morning Awakening', 'desc' => 'Begin the day with a gentle practice of yoga, conscious breathwork (pranayama), and guided meditation. This harmonious sequence awakens the body, calms the mind, balances your energy, and cultivates a deep sense of inner presence.' ],
                        [ 'time' => '10:00',       'act' => 'Healthy Breakfast', 'desc' => 'Enjoy a nourishing vegetarian breakfast prepared with fresh, wholesome ingredients. Mindfully crafted to replenish your body and sustain your energy throughout the day&rsquo;s journey.' ],
                        [ 'time' => '10:30',       'act' => 'Mother Earth Purification', 'desc' => 'Journey to the sacred Pura Mengening for a traditional Balinese water purification ritual (Melukat). Surrounded by nature and blessed spring waters, this ancient ceremony invites you to cleanse, renew, and reconnect with your authentic self.' ],
                        [ 'time' => '12:00',       'act' => 'Eling Sound Awakening', 'desc' => 'Traditional sound healing instruments gently resonate through the body, encouraging profound relaxation, energetic balance, and inner harmony while awakening your natural state of wellbeing.' ],
                        [ 'time' => '13:00',       'act' => 'Integration &amp; Vegetarian Lunch', 'desc' => 'Share a slow, mindful vegetarian lunch as you integrate the morning&rsquo;s experiences, allowing space for reflection, gratitude, and a deeper awareness of your personal transformation.' ],
                        [ 'time' => '14:00',       'act' => 'Complete &amp; Return', 'desc' => 'Leave the sanctuary feeling lighter, clearer, and more deeply connected to yourself. Complimentary return transfer is provided for your comfort.' ],
                    ];
                    foreach ( $itinerary as $s ) : ?>
                    <div class="flex flex-col sm:flex-row sm:items-start gap-2 sm:gap-5 px-5 sm:px-6 py-5 border-b border-white/[.04] last:border-0">
                        <span class="flex-shrink-0 font-body font-bold text-[12px] text-bes-gold/70 sm:min-w-[60px] mt-0.5 tracking-label"><?php echo esc_html($s['time']); ?></span>
                        <div class="flex-1 min-w-0">
                            <span class="block font-display font-medium text-white text-[16px] leading-snug mb-1"><?php echo wp_kses_post($s['act']); ?></span>
                            <span class="block font-body text-[13px] font-light text-white/50 leading-relaxed"><?php echo wp_kses_post($s['desc']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <p class="bes-reveal mt-8 font-body text-[12px] font-light text-white/25 leading-relaxed">
                * Schedule is representative. Exact session order and timing confirmed with the team upon booking. Free pick-up and drop-off at Sang Spa is complimentary.
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
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display mb-5">
                    What Your Day Includes
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed">
                    Arrive and be received. From the moment you are picked up to the moment you leave, everything is already here.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php
                $included = [
                    [
                        'icon'  => 'fa-solid fa-hands-praying',
                        'title' => 'All Five Healing Sessions',
                        'body'  => 'Yoga, breathwork, meditation, cleansing ritual, and sound healing &mdash; the complete arc, all guided, all included.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-bowl-food',
                        'title' => 'Breakfast &amp; Lunch',
                        'body'  => 'Both meals provided &mdash; mindfully prepared, vegetarian, nourishing. Eating is part of the practice here, not an afterthought.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-van-shuttle',
                        'title' => 'Free Pick-Up &amp; Drop at Sang Spa',
                        'body'  => 'Complimentary pick-up and drop-off at Sang Spa. Arrive without logistics. Leave without them either.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-spa',
                        'title' => 'Sanctuary Access',
                        'body'  => 'Full use of the Bali Eling Spirit grounds and facilities for the duration of the program.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-user-shield',
                        'title' => 'Personal Guidance',
                        'body'  => 'Attentive, non-judgmental support from the Bali Eling Spirit team of yogis and healers throughout your day.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-certificate',
                        'title' => 'Complete Experience',
                        'body'  => 'Not a workshop, not a spa day &mdash; a genuine short-format retreat with everything needed to make the five hours land.',
                    ],
                ];
                foreach ( $included as $item ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden hover:border-bes-gold/30 transition-all duration-500"
                     style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="p-6 md:p-7">
                        <div class="w-11 h-11 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center mb-5 group-hover:bg-bes-gold/10 transition-colors duration-300">
                            <i class="<?php echo esc_attr($item['icon']); ?> text-bes-gold text-[13px]" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-xl mb-2"><?php echo wp_kses_post($item['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo wp_kses_post($item['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — INSTRUCTOR PROFILE / APPROACH
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Who guides you">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <div class="lg:col-span-5">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Who Holds the Space</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Guided by the<br>
                        <em class="not-italic text-bes-olive">Bali Eling Spirit</em><br>
                        Team.
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed mb-5">
                        Yogis and healers trained in authentic Balinese tradition, working with a contemporary sensibility. Their approach is intentionally gentle &mdash; no intimidation, no spiritual performance, no rushing.
                    </p>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        What you get is attention. The kind that is becoming rare.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php
                        $approach = [
                            [
                                'icon'  => 'fa-solid fa-hand-holding-heart',
                                'title' => 'Gentle &amp; Nurturing',
                                'body'  => 'The guidance is soft. You are never pushed beyond what your body is ready for &mdash; the work happens in the softening, not the striving.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-user-plus',
                                'title' => 'Beginner-Friendly',
                                'body'  => 'Designed from the ground up for people with no prior retreat experience. If this is your first time, you are in exactly the right place.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-compass',
                                'title' => 'Experience-Based',
                                'body'  => 'The focus is on what you feel, not what you learn. No long lectures, no theory &mdash; the practice is the teaching.',
                            ],
                            [
                                'icon'  => 'fa-solid fa-om',
                                'title' => 'Authentic Balinese Tradition',
                                'body'  => 'The techniques are rooted in Bali&rsquo;s living healing lineage &mdash; complete, coherent, and held in the place they come from.',
                            ],
                        ];
                        foreach ( $approach as $a ) : ?>
                        <div class="bes-reveal rounded-2xl border border-bes-sand p-6"
                             style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                            <div class="w-10 h-10 rounded-xl bg-bes-gold/[.07] border border-bes-gold/[.15] flex items-center justify-center mb-4">
                                <i class="<?php echo esc_attr($a['icon']); ?> text-bes-gold text-[11px]" aria-hidden="true"></i>
                            </div>
                            <h3 class="font-display font-medium text-bes-bark text-lg mb-2"><?php echo wp_kses_post($a['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo wp_kses_post($a['body']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — PRICING & PACKAGE
         ================================================================ -->
    <section id="bes-hr-pricing" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Pricing">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 md:mb-14 max-w-2xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Your Investment</p>
                <h2 class="bes-reveal font-display font-medium text-white text-3xl sm:text-4xl md:text-5xl tracking-display mb-5">
                    One Morning.<br>One Price.<br>
                    <em class="not-italic text-bes-gold">Everything Included.</em>
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm md:text-base leading-relaxed">
                    A single transparent package. Book for yourself, with a partner, or bring a friend &mdash; the sanctuary welcomes both.
                </p>
            </div>

            <!-- Pricing card -->
            <div class="max-w-2xl mx-auto">

                <article class="bes-reveal group relative rounded-2xl border border-bes-gold/25 overflow-hidden hover:border-bes-gold/40 transition-all duration-500 flex flex-col"
                         style="background:rgba(38,51,32,0.55)">
                    <div class="absolute inset-0 bg-gradient-to-br from-bes-gold/15 to-bes-leaf/5 opacity-50 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="h-[3px] w-full bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="relative p-8 md:p-10 flex flex-col flex-1">

                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/70">The Gateway Package</p>
                            <span class="font-body font-bold text-[9px] uppercase tracking-label bg-bes-gold/15 border border-bes-gold/25 text-bes-gold rounded-full px-3 py-1">
                                Daily Availability
                            </span>
                        </div>
                        <h3 class="font-display font-medium text-white text-2xl sm:text-3xl mb-1">Healing Retreat &mdash; 5 Hours</h3>
                        <p class="font-body font-light text-white/40 text-sm mb-6">Tuesday through Sunday &nbsp;·&nbsp; 08:00&ndash;14:00 WITA</p>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-2 pb-2">
                            <span class="font-display font-medium text-white text-4xl sm:text-5xl">IDR 1.559K</span>
                            <span class="font-body text-white/40 text-sm">++</span>
                        </div>
                        <p class="font-body text-[12px] font-light text-white/30 mb-6 pb-6 border-b border-white/[.06]">
                            per person &nbsp;·&nbsp; exclusive of tax &amp; service
                        </p>

                        <!-- Includes -->
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/25 mb-3">Full Inclusions</p>
                        <ul class="space-y-2.5 mb-8 flex-1" role="list">
                            <?php
                            $pkg = [
                                '5-hour complete healing retreat experience',
                                'Yoga session (gentle &amp; mindful)',
                                'Breathwork session (release &amp; balance)',
                                'Meditation session (inner calm &amp; awareness)',
                                'Traditional Balinese cleansing ritual',
                                'Sound healing (deep relaxation)',
                                'Breakfast &amp; lunch (vegetarian)',
                                'Free pick-up and drop-off at Sang Spa',
                                'Full sanctuary access',
                                'Personal guidance from Bali Eling Spirit team',
                            ];
                            foreach ( $pkg as $line ) : ?>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-bes-gold text-[9px] mt-1.5 flex-shrink-0" aria-hidden="true"></i>
                                <span class="font-body text-[13px] font-light text-white/65 leading-snug"><?php echo wp_kses_post($line); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20bergabung%20dengan%20Healing%20Retreat%205%20Jam"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center flex-1 gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/15 group/cta">
                                <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                                Book Your Healing Day
                            </a>
                            <a href="https://wa.me/6281228888873?text=Halo,%20saya%20ingin%20bertanya%20tentang%20Healing%20Retreat"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-6 py-4 rounded-xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                                <i class="fa-solid fa-message text-xs" aria-hidden="true"></i>
                                Ask First
                            </a>
                        </div>
                    </div>
                </article>

            </div>

            <!-- Upgrade nudge to next-depth programs -->
            <p class="bes-reveal mt-10 text-center font-body font-light text-white/30 text-sm max-w-2xl mx-auto leading-relaxed">
                Ready to go deeper? Explore the
                <a href="/eling-sanctuary-retreat" class="text-bes-gold hover:!text-white transition-colors duration-300 font-medium">Eling Sanctuary Retreat (2&ndash;3 days)</a>
                or the
                <a href="/tapa-brata" class="text-bes-gold hover:!text-white transition-colors duration-300 font-medium">Tapa Brata immersion (4 days, 3 nights)</a>.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — TESTIMONIALS / SOCIAL PROOF
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Testimonials">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12 max-w-xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">From Those Who Came</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display">
                    Short. But Powerful.
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 leading-relaxed">
                    Perfect for busy people. Perfect for travelers. Perfect for anyone who thinks they don't have time.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php
                $testimonials = [
                    [
                        'quote'  => 'In just a few hours, I felt so much lighter and calmer. I came in carrying stress from weeks of work and left feeling like I had room to breathe again.',
                        'name'   => 'Retreat Participant',
                        'detail' => 'Healing Retreat &mdash; 5 Hours',
                    ],
                    [
                        'quote'  => 'A deeply calming experience &mdash; perfect for recharging energy in the middle of a holiday. I did not expect five hours to land the way it did.',
                        'name'   => 'Retreat Participant',
                        'detail' => 'Healing Retreat &mdash; 5 Hours',
                    ],
                    [
                        'quote'  => 'I was skeptical that a half-day could be meaningful. By lunch I was in tears, in the good way. The sound healing alone was worth the trip.',
                        'name'   => 'Retreat Participant',
                        'detail' => 'Healing Retreat &mdash; 5 Hours',
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
                            <span class="block font-body text-[11px] text-bes-bark-muted mt-0.5"><?php echo wp_kses_post($t['detail']); ?></span>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — FAQ
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Before You Book</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-3xl sm:text-4xl md:text-5xl tracking-display">
                    Common Questions
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 max-w-xl mx-auto leading-relaxed">
                    Questions about the Healing Retreat specifically. Hub-level questions live on the Sanctuary page.
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <?php
                $faqs = [
                    [
                        'q' => 'Is five hours really enough to feel a difference?',
                        'a' => 'Yes &mdash; and that surprises most people. The program is designed as a complete arc, not a loose collection of activities. The sessions build on each other, and the sanctuary environment does its own quiet work. Most participants leave noticeably shifted. It is not the same as a 3-day retreat, but it is a real experience, not a sampler.',
                    ],
                    [
                        'q' => 'Do I need yoga or meditation experience?',
                        'a' => 'No experience is necessary. The program is designed from the ground up for beginners. The yoga is gentle, the meditation is guided, and the team works with what you bring. If you are completely new to any of this, the Healing Retreat is one of the best possible entry points.',
                    ],
                    [
                        'q' => 'What should I wear and bring?',
                        'a' => 'Comfortable clothing you can move in &mdash; for yoga and breathwork. A water bottle if you like. Most people also like to bring a small journal for the integration period. The sanctuary provides everything else, including a mat. A detailed pre-arrival note is shared upon booking.',
                    ],
                    [
                        'q' => 'When is the Healing Retreat available?',
                        'a' => 'The program runs daily except Monday, from 08:00 to 14:00 WITA. It is the most accessible of the three Sanctuary programs &mdash; designed to fit into a travel itinerary or a regular week without major reorganisation.',
                    ],
                    [
                        'q' => 'How does the transfer work?',
                        'a' => 'Free pick-up and drop-off is provided at Sang Spa. If you are staying elsewhere, reach out to the team via WhatsApp and they will confirm the most comfortable arrangement with you.',
                    ],
                    [
                        'q' => 'How is this different from the Eling Sanctuary Retreat?',
                        'a' => 'The Healing Retreat is a 5-hour morning program &mdash; no overnight stay, high-impact but short. The Eling Sanctuary Retreat is a 2- or 3-day residential immersion with accommodation, and goes noticeably deeper because of the continuity and the time. This is an excellent first step; the Eling Sanctuary Retreat is the natural next depth.',
                    ],
                    [
                        'q' => 'How is this different from Tapa Brata?',
                        'a' => 'Tapa Brata is the deepest program &mdash; 4 days, 3 nights &mdash; designed for participants ready to work with something old and unresolved. The Healing Retreat is gentle, restorative, and beginner-friendly. Different programs for different seasons of life. The team can help you choose.',
                    ],
                    [
                        'q' => 'Can I book for a couple or a small group?',
                        'a' => 'Yes &mdash; the Healing Retreat welcomes solo participants, couples, and small groups. Private arrangements can also be made on request. Message the team on WhatsApp to confirm availability for your preferred date.',
                    ],
                    [
                        'q' => 'Is the program religious?',
                        'a' => 'The practices are rooted in Balinese-Hindu healing tradition. The retreat is genuinely open to people of all backgrounds &mdash; religious, spiritual, agnostic, or none. What is asked of you is not belief, but sincere presence.',
                    ],
                ];

                foreach ( $faqs as $idx => $faq ) : ?>

                <div class="bes-reveal rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <button
                        class="w-full flex items-center justify-between gap-4 p-6 text-left group"
                        aria-expanded="false"
                        onclick="besHrFaqToggle(this)"
                        type="button">
                        <span class="font-display font-medium text-bes-bark text-lg group-hover:!text-bes-olive transition-colors duration-300">
                            <?php echo esc_html($faq['q']); ?>
                        </span>
                        <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center transition-all duration-300 group-hover:bg-bes-gold/10 group-hover:border-bes-gold/20"
                              aria-hidden="true">
                            <i class="fa-solid fa-plus text-bes-bark-muted text-[10px] bes-hr-faq-icon transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="bes-hr-faq-body max-h-0 overflow-hidden transition-all duration-400 ease-in-out">
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
                    Back to Sanctuary Hub &mdash; Compare All Three Programs
                </a>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 10 — CLOSING CTA
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
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">One Morning Is Enough</p>
                    <h2 class="font-display font-medium text-white text-3xl md:text-4xl lg:text-5xl tracking-display mb-4 max-w-2xl mx-auto">
                        Escape the Noise.<br>
                        <em class="not-italic text-bes-gold">Find Your Calm.</em>
                    </h2>
                    <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                        Recharge your body, mind, and soul &mdash; in the time it would take to sit through a meeting that didn't need to happen.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="#bes-hr-pricing"
                           class="inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-bes-gold/10 group">
                            <i class="fa-solid fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"></i>
                            Book Your Healing Day
                        </a>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            WhatsApp the Sanctuary
                        </a>
                    </div>

                    <p class="font-body text-[11px] text-white/20 tracking-wide mt-8">
                        Beginner friendly &nbsp;·&nbsp; All levels welcome &nbsp;·&nbsp; Daily except Monday &nbsp;·&nbsp; Tampaksiring, Bali
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         INLINE JS — FAQ accordion
         ================================================================ -->
    <script>
    /* --- FAQ accordion --- */
    if (typeof besHrFaqToggle !== 'function') {
        function besHrFaqToggle(btn) {
            var body = btn.nextElementSibling;
            var icon = btn.querySelector('.bes-hr-faq-icon');
            var isOpen = btn.getAttribute('aria-expanded') === 'true';

            document.querySelectorAll('[onclick="besHrFaqToggle(this)"]').forEach(function(b) {
                if (b !== btn) {
                    b.setAttribute('aria-expanded', 'false');
                    b.nextElementSibling.style.maxHeight = null;
                    var ic = b.querySelector('.bes-hr-faq-icon');
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
