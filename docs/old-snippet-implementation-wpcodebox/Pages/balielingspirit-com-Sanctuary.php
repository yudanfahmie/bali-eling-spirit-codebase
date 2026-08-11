<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_sanctuary_hub] Shortcode
 * ============================================================================
 *
 * Registers the [bes_sanctuary_hub] shortcode for the Sanctuary / Healing
 * Retreat HUB page. This page no longer holds the heavy per-program detail —
 * it introduces the Sanctuary concept and routes visitors to the dedicated
 * standalone page for each program (mirrors the YTT hub architecture).
 *
 * Fully aligned with the BES v3 design system:
 *   - Tailwind utility classes with BES color tokens (bes-*)
 *   - font-display (Cormorant Garamond) + font-body (Plus Jakarta Sans)
 *   - bes-reveal entrance animation utility
 *   - tracking-nav, tracking-label, tracking-display tokens
 *   - Zero new CSS declarations
 *
 * USAGE: Add [bes_sanctuary_hub] to the main Sanctuary page.
 *
 * SECTIONS:
 *   0 — Hero (dark, introduces the Sanctuary as a whole)
 *   1 — The Sanctuary Concept (the "why" — shared philosophy)
 *   2 — Choose Your Depth (the 3 program summary cards, the heart of the hub)
 *   3 — Which Program Is for You? (comparison / decision helper)
 *   4 — Shared Sanctuary Experience (what every program includes)
 *   5 — FAQ (hub-level questions only)
 *   6 — Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_sanctuary_hub', 'bes_render_sanctuary_hub' );

function bes_render_sanctuary_hub( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — HERO (introduces the Sanctuary as a whole)
         ================================================================ -->
    <section class="relative min-h-[80vh] flex items-end overflow-hidden bg-bes-forest-deep pb-0"
             aria-labelledby="bes-sanc-hero-heading">

        <!-- Atmospheric glows -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_60%)]"></div>
            <div class="absolute bottom-1/3 right-0 w-[500px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.04),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Top fretwork -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <!-- Foreground -->
        <div class="relative w-full max-w-[1440px] mx-auto px-6 md:px-10 pt-28 md:pt-36 pb-20 md:pb-28">
            <div class="max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-5">
                    Sanctuary &amp; Healing Retreats &nbsp;·&nbsp; Three Depths of the Same Path &nbsp;·&nbsp; Tampaksiring, Bali
                </p>

                <h1 id="bes-sanc-hero-heading"
                    class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">
                    A Sacred Pause<br>for the <em class="not-italic text-bes-leaf">Life You Carry</em>.
                </h1>

                <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl leading-relaxed mb-10">
                    The Bali Eling Spirit Sanctuary holds three distinct retreat journeys — from a single morning of healing, to an immersive weekend of reconnection, to a four-day inner excavation. Different depths. One sanctuary. One intention: to bring you home to yourself.
                </p>

                <!-- CTA row -->
                <div class="bes-reveal flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="#bes-sanc-programs"
                       class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                        <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform" aria-hidden="true"></i>
                        Explore the Three Programs
                    </a>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 font-body font-bold text-[11px] uppercase tracking-label !text-white/40 hover:!text-white transition-colors duration-300">
                        <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                        Speak with the Sanctuary Team
                    </a>
                </div>
            </div>

            <!-- At-a-glance meta strip -->
            <div class="bes-reveal mt-14 grid grid-cols-2 md:grid-cols-4 gap-px bg-white/[.04] rounded-2xl overflow-hidden border border-white/[.04]">
                <?php
                $meta = [
                    [ 'icon' => 'fa-solid fa-layer-group',   'label' => 'Programs',  'value' => '3 Journeys' ],
                    [ 'icon' => 'fa-solid fa-clock',         'label' => 'From',      'value' => '5 Hours – 4 Days' ],
                    [ 'icon' => 'fa-solid fa-seedling',      'label' => 'Approach',  'value' => 'Release · Restore · Realign' ],
                    [ 'icon' => 'fa-solid fa-location-dot',  'label' => 'Location',  'value' => 'Bali Eling Spirit' ],
                ];
                foreach ( $meta as $m ) : ?>
                <div class="flex items-center gap-3 px-5 py-5 bg-bes-forest/60">
                    <div class="w-9 h-9 rounded-xl bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center flex-shrink-0">
                        <i class="<?php echo esc_attr($m['icon']); ?> text-bes-leaf text-[11px]" aria-hidden="true"></i>
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
         SECTION 1 — THE SANCTUARY CONCEPT (the shared "why")
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="The sanctuary concept">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        Eling &mdash; The Shared Foundation
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        One Sanctuary.<br>Three Ways to Arrive.
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            <em class="not-italic text-bes-olive font-normal">Eling</em> is a Balinese word for awareness &mdash; the quiet return to the self beneath the noise. Every retreat offered here, short or long, is built on that single intention: to create the space where you can hear yourself again.
                        </p>
                        <p class="bes-reveal">
                            What differs between the three programs is not the philosophy &mdash; it is the depth. Some arrive with only five hours and leave lighter than they thought possible. Others need a weekend to truly exhale. A smaller number come carrying something older, something heavier, and stay for four days to meet it honestly.
                        </p>
                        <p class="bes-reveal">
                            You do not need to choose perfectly. You need only to choose truthfully. Read the three summaries below, trust what resonates, and the sanctuary will meet you there.
                        </p>
                    </div>
                </div>

                <!-- Intent card -->
                <div class="lg:col-span-5 lg:pt-14">
                    <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <div class="h-[3px] w-full bg-gradient-to-r from-bes-leaf via-bes-gold to-transparent"></div>
                        <div class="p-8 md:p-10">
                            <blockquote class="mb-7">
                                <span class="block font-display font-light text-bes-bark text-2xl md:text-3xl leading-snug italic mb-4">
                                    &ldquo;The sanctuary does not fix you. It simply holds the space where you remember you were never broken.&rdquo;
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label text-bes-moss">
                                    &mdash; Sanctuary Intention
                                </cite>
                            </blockquote>

                            <!-- Shared principles -->
                            <div class="border-t border-bes-sand pt-6">
                                <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted mb-4">Shared Across All Programs</p>
                                <?php
                                $shared = [
                                    'Authentic Balinese spiritual practices',
                                    'Gentle, non-judgmental guidance',
                                    'All levels &mdash; beginner-friendly',
                                    'Nature-held sanctuary environment',
                                    'Vegetarian meals, prepared with care',
                                ];
                                foreach ( $shared as $s ) : ?>
                                <div class="flex items-center gap-3 py-2 border-b border-bes-sand last:border-0">
                                    <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf flex-shrink-0"></span>
                                    <span class="font-body text-[13px] text-bes-bark-muted"><?php echo wp_kses_post($s); ?></span>
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
         SECTION 2 — CHOOSE YOUR DEPTH (the 3 program summary cards)
         ================================================================ -->
    <section id="bes-sanc-programs" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden"
             aria-label="The three sanctuary programs">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-1/4 w-[500px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_65%)]"></div>
            <div class="absolute left-0 bottom-0 w-[400px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.04),transparent_65%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]"
                 style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <!-- Header -->
            <div class="mb-14 md:mb-16 max-w-3xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">Choose Your Depth</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5">
                    Three Programs.<br>Meet Yourself Where You Are.
                </h2>
                <p class="bes-reveal font-body font-light !text-white/40 text-sm md:text-base leading-relaxed">
                    Each program is complete in itself &mdash; a full offering, not a sampler for the next one. Choose based on what your life can hold right now, and what your heart already knows it needs.
                </p>
            </div>

            <!-- Program cards grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-6">

                <?php
                $programs = [
                    /* -------- PROGRAM 1: HEALING RETREAT -------- */
                    [
                        'tag'         => 'Entry Point',
                        'icon'        => 'fa-solid fa-sun',
                        'title'       => 'Healing Retreat',
                        'tagline'     => 'Five Hours That Can Shift Something',
                        'duration'    => '5 Hours &nbsp;·&nbsp; Half-Day',
                        'schedule'    => 'Daily · 8 AM – 1 PM · Closed Mondays',
                        'price'       => 'From IDR 1.559K++',
                        'summary'     => 'A single morning designed for the life that cannot stop. Yoga, breathwork, meditation, a traditional cleansing ritual, and sound healing &mdash; delivered in a window short enough for the busiest traveler and deep enough to genuinely land.',
                        'highlights'  => [
                            'High impact, low commitment',
                            'Perfect for travelers &amp; beginners',
                            'Includes breakfast, lunch &amp; pickup',
                            'Daily availability &mdash; book 2 days ahead',
                        ],
                        'best_for'    => 'You have a busy life, limited time, or you\'re testing the waters of retreat for the first time.',
                        'href'        => '/healing-retreat',
                        'cta_label'   => 'View Healing Retreat',
                        'accent_bar'  => 'from-bes-leaf to-transparent',
                        'accent_glow' => 'from-bes-leaf/20 to-bes-leaf/5',
                        'dot'         => 'bg-bes-leaf',
                        'depth_label' => 'Depth 1 of 3',
                    ],
                    /* -------- PROGRAM 2: ELING SANCTUARY RETREAT -------- */
                    [
                        'tag'         => 'The Middle Way',
                        'icon'        => 'fa-solid fa-seedling',
                        'title'       => 'Eling Sanctuary Retreat',
                        'tagline'     => 'Release &middot; Restore &middot; Reconnect &middot; Realign',
                        'duration'    => '2D1N or 3D2N &nbsp;·&nbsp; Immersive',
                        'schedule'    => 'Tuesday or Friday starts',
                        'price'       => 'From IDR 2.989K++',
                        'summary'     => 'A sacred pause for the exhausted but not yet broken &mdash; deeper than a spa weekend, gentler than a silent retreat. Two or three days of yoga, breathwork, meditation, sound healing and spiritual reflection in a space built for the art of letting go.',
                        'highlights'  => [
                            'Short immersive &mdash; 2 or 3 days',
                            'Body–mind–soul approach',
                            'Retreat accommodation &amp; vegetarian meals',
                            'Flexible between Healing &amp; Tapa Brata',
                        ],
                        'best_for'    => 'You are carrying mental fatigue and emotional heaviness, and you need more than a morning but are not ready for a deep retreat.',
                        'href'        => '/eling-sanctuary-retreat',
                        'cta_label'   => 'View Sanctuary Retreat',
                        'accent_bar'  => 'from-bes-gold to-transparent',
                        'accent_glow' => 'from-bes-gold/20 to-bes-gold/5',
                        'dot'         => 'bg-bes-gold',
                        'depth_label' => 'Depth 2 of 3',
                    ],
                    /* -------- PROGRAM 3: TAPA BRATA -------- */
                    [
                        'tag'         => 'Deepest Immersion',
                        'icon'        => 'fa-solid fa-fire-flame-curved',
                        'title'       => 'Tapa Brata',
                        'tagline'     => 'Release the Past. Return to the Self.',
                        'duration'    => '4 Days &nbsp;·&nbsp; 3 Nights',
                        'schedule'    => 'Scheduled intakes · Intimate group',
                        'price'       => 'IDR 4.999.000',
                        'summary'     => 'A deliberately deep spiritual retreat for those meeting old wounds. Four days of meditation, yoga, <em class="not-italic">tapa</em> (self-discipline), silent reflection and emotional release &mdash; held in a safe and supportive container for real transformation.',
                        'highlights'  => [
                            'Deep emotional &amp; spiritual healing',
                            'Silent reflection &amp; sharing circles',
                            'Full 4D3N accommodation &amp; guidance',
                            'Special privileges at Eling Sanctuary',
                        ],
                        'best_for'    => 'You are carrying something old &mdash; unresolved grief, trauma, loss of meaning &mdash; and you are ready to meet it honestly.',
                        'href'        => '/tapa-brata',
                        'cta_label'   => 'View Tapa Brata',
                        'accent_bar'  => 'from-bes-sage to-transparent',
                        'accent_glow' => 'from-bes-sage/20 to-bes-sage/5',
                        'dot'         => 'bg-bes-sage',
                        'depth_label' => 'Depth 3 of 3',
                    ],
                ];

                foreach ( $programs as $p ) : ?>

                <article class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden hover:border-white/10 transition-all duration-500 flex flex-col"
                         style="background:rgba(38,51,32,0.4)">

                    <!-- Hover accent glow -->
                    <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr($p['accent_glow']); ?> opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" aria-hidden="true"></div>

                    <!-- Top accent bar -->
                    <div class="h-[3px] w-full bg-gradient-to-r <?php echo esc_attr($p['accent_bar']); ?>" aria-hidden="true"></div>

                    <div class="relative p-7 md:p-8 flex flex-col flex-1">

                        <!-- Depth badge + tag -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr($p['dot']); ?> flex-shrink-0"></span>
                                <span class="font-body font-bold text-[10px] uppercase tracking-nav text-white/30"><?php echo esc_html($p['tag']); ?></span>
                            </div>
                            <span class="font-body text-[9px] font-bold uppercase tracking-label text-white/20">
                                <?php echo esc_html($p['depth_label']); ?>
                            </span>
                        </div>

                        <!-- Icon -->
                        <div class="w-11 h-11 rounded-xl bg-white/[.04] border border-white/[.06] flex items-center justify-center mb-5">
                            <i class="<?php echo esc_attr($p['icon']); ?> text-white/50 text-sm" aria-hidden="true"></i>
                        </div>

                        <!-- Title & tagline -->
                        <h3 class="font-display font-medium text-white text-2xl md:text-[1.75rem] mb-1 leading-tight">
                            <?php echo esc_html($p['title']); ?>
                        </h3>
                        <p class="font-body italic font-light text-white/45 text-[13px] mb-5">
                            <?php echo wp_kses_post($p['tagline']); ?>
                        </p>

                        <!-- Meta row -->
                        <div class="flex flex-col gap-2 mb-5 pb-5 border-b border-white/[.05]">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-clock text-bes-leaf/60 text-[10px] w-3" aria-hidden="true"></i>
                                <span class="font-body text-[12px] !text-white/60"><?php echo wp_kses_post($p['duration']); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-calendar text-bes-leaf/60 text-[10px] w-3" aria-hidden="true"></i>
                                <span class="font-body text-[12px] !text-white/60"><?php echo esc_html($p['schedule']); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-tag text-bes-leaf/60 text-[10px] w-3" aria-hidden="true"></i>
                                <span class="font-body text-[12px] !text-white/60"><?php echo esc_html($p['price']); ?></span>
                            </div>
                        </div>

                        <!-- Summary -->
                        <p class="font-body font-light text-white/50 text-[13.5px] leading-relaxed mb-5">
                            <?php echo wp_kses_post($p['summary']); ?>
                        </p>

                        <!-- Highlights -->
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-white/25 mb-3">Highlights</p>
                        <ul class="space-y-1.5 mb-6" role="list">
                            <?php foreach ( $p['highlights'] as $h ) : ?>
                            <li class="flex items-start gap-2.5">
                                <span class="w-1 h-1 rounded-full bg-bes-leaf/60 mt-1.5 flex-shrink-0"></span>
                                <span class="font-body text-[12.5px] text-white/55 leading-snug"><?php echo wp_kses_post($h); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Best for (inset) -->
                        <div class="rounded-xl bg-white/[.03] border border-white/[.05] p-4 mb-6">
                            <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-leaf/70 mb-1.5">Best For</p>
                            <p class="font-body text-[12.5px] font-light text-white/55 leading-relaxed">
                                <?php echo esc_html($p['best_for']); ?>
                            </p>
                        </div>

                        <!-- CTA (pushed to bottom) -->
                        <div class="mt-auto pt-2">
                            <a href="<?php echo esc_url($p['href']); ?>"
                               class="inline-flex items-center justify-center w-full gap-2.5 bg-white/[.04] border border-white/10 !text-white/75 font-body font-bold text-[11px] uppercase tracking-label px-6 py-3.5 rounded-xl hover:bg-bes-leaf hover:!text-bes-forest hover:border-bes-leaf transition-all duration-300 group/cta">
                                <span><?php echo esc_html($p['cta_label']); ?></span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover/cta:translate-x-0.5 transition-transform" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
                </article>

                <?php endforeach; ?>
            </div>

            <!-- Soft footer line under grid -->
            <p class="bes-reveal mt-12 text-center font-body font-light text-white/30 text-sm">
                Not sure which program fits?
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                   class="text-bes-leaf hover:!text-white transition-colors duration-300 font-medium">
                    Message the Sanctuary team on WhatsApp
                </a>
                &mdash; they will guide you honestly.
            </p>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — WHICH PROGRAM IS FOR YOU? (decision helper)
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Program comparison">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14 max-w-2xl mx-auto">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">At a Glance</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-5">
                    Which Depth Is Calling You?
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm md:text-base leading-relaxed">
                    A side-by-side honest look. Follow what resonates, not what sounds impressive.
                </p>
            </div>

            <!-- Comparison table -->
            <div class="bes-reveal max-w-5xl mx-auto rounded-2xl border border-bes-sand overflow-hidden"
                 style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">

                <?php
                $compare_rows = [
                    [
                        'label'   => 'Time Commitment',
                        'healing' => '5 hours (1 morning)',
                        'eling'   => '2–3 days',
                        'tapa'    => '4 days, 3 nights',
                    ],
                    [
                        'label'   => 'Depth of Work',
                        'healing' => 'Reset &amp; relaxation',
                        'eling'   => 'Release &amp; realignment',
                        'tapa'    => 'Deep emotional healing',
                    ],
                    [
                        'label'   => 'Ideal For',
                        'healing' => 'Travelers, busy professionals, first-timers',
                        'eling'   => 'Burned-out seekers needing a real pause',
                        'tapa'    => 'Those ready to meet old wounds',
                    ],
                    [
                        'label'   => 'Experience Level',
                        'healing' => 'Complete beginners welcome',
                        'eling'   => 'All levels',
                        'tapa'    => 'All levels &mdash; with emotional readiness',
                    ],
                    [
                        'label'   => 'Investment',
                        'healing' => 'From IDR 1.559K++',
                        'eling'   => 'IDR 2.989K – 3.989K++',
                        'tapa'    => 'IDR 4.999.000',
                    ],
                ];
                ?>

                <!-- Header row -->
                <div class="grid grid-cols-4 gap-0 bg-bes-forest/[.04] border-b border-bes-sand">
                    <div class="p-4 md:p-5"></div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-leaf mb-1">Entry Point</p>
                        <p class="font-display font-medium text-bes-bark text-sm md:text-base">Healing Retreat</p>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-gold mb-1">Middle Way</p>
                        <p class="font-display font-medium text-bes-bark text-sm md:text-base">Eling Sanctuary</p>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-moss mb-1">Deepest</p>
                        <p class="font-display font-medium text-bes-bark text-sm md:text-base">Tapa Brata</p>
                    </div>
                </div>

                <!-- Body rows -->
                <?php foreach ( $compare_rows as $idx => $row ) : ?>
                <div class="grid grid-cols-4 gap-0 <?php echo $idx < count($compare_rows) - 1 ? 'border-b border-bes-sand' : ''; ?>">
                    <div class="p-4 md:p-5 bg-bes-forest/[.02]">
                        <span class="font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted"><?php echo esc_html($row['label']); ?></span>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <span class="font-body text-[12.5px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($row['healing']); ?></span>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <span class="font-body text-[12.5px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($row['eling']); ?></span>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <span class="font-body text-[12.5px] text-bes-bark-muted leading-snug"><?php echo wp_kses_post($row['tapa']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Footer CTA row -->
                <div class="grid grid-cols-4 gap-0 border-t border-bes-sand bg-bes-forest/[.03]">
                    <div class="p-4 md:p-5"></div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <a href="/healing-retreat"
                           class="inline-flex items-center gap-1.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-olive hover:!text-bes-leaf transition-colors duration-300">
                            Details
                            <i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <a href="/eling-sanctuary-retreat"
                           class="inline-flex items-center gap-1.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-olive hover:!text-bes-leaf transition-colors duration-300">
                            Details
                            <i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="p-4 md:p-5 border-l border-bes-sand">
                        <a href="/tapa-brata"
                           class="inline-flex items-center gap-1.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-olive hover:!text-bes-leaf transition-colors duration-300">
                            Details
                            <i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — SHARED SANCTUARY EXPERIENCE (what every program includes)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Shared sanctuary experience">

        <div class="absolute right-0 top-0 bottom-0 w-[400px] bg-[radial-gradient(ellipse_at_right,rgba(194,210,74,0.04),transparent_60%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
             style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="mb-12 md:mb-14 max-w-2xl">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">What You'll Find Here</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">
                    Whichever Depth You Choose
                </h2>
                <p class="bes-reveal font-body font-light !text-white/40 text-sm md:text-base leading-relaxed">
                    Every journey at Bali Eling Spirit is held by the same sanctuary foundations &mdash; the same teachers, the same land, the same gentle authenticity. These are the threads that run through all three programs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $experience = [
                    [
                        'icon'  => 'fa-solid fa-hands-praying',
                        'n'     => '01',
                        'title' => 'Authentic Balinese Practice',
                        'body'  => 'Every session &mdash; yoga, breathwork, sound healing, cleansing ritual &mdash; is rooted in lineage-held Balinese spiritual tradition, not a wellness interpretation of it.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-heart',
                        'n'     => '02',
                        'title' => 'Gentle, Non-Judgmental Guidance',
                        'body'  => 'The Bali Eling Spirit team meets you where you are. No pressure to share more than feels right, no performance of spirituality, no shame if you cry &mdash; or if you don\'t.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-leaf',
                        'n'     => '03',
                        'title' => 'Held by Nature',
                        'body'  => 'The sanctuary itself is part of the healing. Held by rice fields, trees, and the rhythms of the land, the space does quiet work on you before the first session even begins.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-bowl-food',
                        'n'     => '04',
                        'title' => 'Nourishing Vegetarian Meals',
                        'body'  => 'Food prepared mindfully, seasoned with care. What you eat is part of the practice, not a break from it.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-user-check',
                        'n'     => '05',
                        'title' => 'Beginner-Friendly, Always',
                        'body'  => 'You do not need to have done yoga before. You do not need to know how to meditate. You need only a sincere willingness to show up &mdash; the team takes care of the rest.',
                    ],
                    [
                        'icon'  => 'fa-solid fa-circle-nodes',
                        'n'     => '06',
                        'title' => 'Body &middot; Mind &middot; Soul',
                        'body'  => 'Holistic by design. The body moves, the mind softens, the inner self is invited back &mdash; on whichever timescale your program allows.',
                    ],
                ];
                foreach ( $experience as $o ) : ?>

                <div class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden transition-all duration-500 hover:border-bes-leaf/20"
                     style="background:rgba(38,51,32,0.35)">
                    <div class="absolute top-0 right-0 w-36 h-36 bg-[radial-gradient(circle,rgba(194,210,74,0.05),transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" aria-hidden="true"></div>
                    <div class="relative p-6 md:p-7">
                        <div class="flex items-center justify-between mb-5">
                            <span class="font-display font-light text-white/10 text-5xl leading-none"><?php echo esc_html($o['n']); ?></span>
                            <div class="w-10 h-10 rounded-xl bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center">
                                <i class="<?php echo esc_attr($o['icon']); ?> text-bes-leaf text-[11px]" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-medium text-white text-xl mb-2"><?php echo wp_kses_post($o['title']); ?></h3>
                        <p class="font-body font-light text-white/45 text-[13px] leading-relaxed"><?php echo wp_kses_post($o['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — FAQ (hub-level questions only)
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Choosing &amp; Arriving</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">
                    Before You Choose
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 max-w-xl mx-auto leading-relaxed">
                    Questions about the Sanctuary as a whole. Program-specific details live on each program's dedicated page.
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <?php
                $faqs = [
                    [
                        'q' => 'Which program should I start with?',
                        'a' => 'Start where your life can hold you. The Healing Retreat (5 hours) is the honest entry point &mdash; low commitment, high clarity. The Eling Sanctuary Retreat (2–3 days) is for those who need a deeper exhale. Tapa Brata (4 days) is for those ready to meet what they have been avoiding. If you are uncertain, message the team on WhatsApp &mdash; they will guide you honestly, even if the answer is "not yet."',
                    ],
                    [
                        'q' => 'Can I do the programs in sequence &mdash; Healing first, then Sanctuary, then Tapa Brata?',
                        'a' => 'Yes, and many people do exactly that. The three programs are designed as complete experiences in themselves, but they also form a natural progression. Starting with Healing and returning later for deeper immersion is a beautiful path, and the team will remember you when you come back.',
                    ],
                    [
                        'q' => 'Do I need yoga or meditation experience?',
                        'a' => 'No. Every program at Bali Eling Spirit is beginner-friendly by design. The team works with what you bring &mdash; which may be nothing, which is perfectly enough.',
                    ],
                    [
                        'q' => 'Is this a religious program? Do I need to be Hindu or spiritual?',
                        'a' => 'The practices are rooted in Balinese-Hindu tradition, but the programs are genuinely open to people of all backgrounds and none. Participants from many religions, and from no religious background at all, have found the work deeply meaningful. Take what resonates. Leave what doesn\'t.',
                    ],
                    [
                        'q' => 'Are the programs private or in a group?',
                        'a' => 'Group size varies by program. The Healing Retreat runs as a small group. The Sanctuary Retreat and Tapa Brata are kept deliberately intimate. Private arrangements are available for any program on request &mdash; reach out to the team directly.',
                    ],
                    [
                        'q' => 'How far in advance should I book?',
                        'a' => 'At minimum 2 days ahead for the Healing Retreat; earlier is strongly recommended for Sanctuary Retreat and Tapa Brata, as intakes are small and dates are limited. We also suggest confirming with us first &mdash; the teachers occasionally undertake dharma yatras (spiritual journeys), and we want your visit to align with their presence.',
                    ],
                    [
                        'q' => 'What is included in each program?',
                        'a' => 'Every program includes the sanctuary experience, vegetarian meals, and guided sessions. The Healing Retreat also includes pickup service. The Sanctuary Retreat and Tapa Brata include accommodation for 1–3 nights. Full specifics are on each program\'s dedicated page.',
                    ],
                ];

                foreach ( $faqs as $idx => $faq ) : ?>

                <div class="bes-reveal rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <button
                        class="w-full flex items-center justify-between gap-4 p-6 text-left group"
                        aria-expanded="false"
                        onclick="besFaqToggle(this)"
                        type="button">
                        <span class="font-display font-medium text-bes-bark text-lg group-hover:!text-bes-olive transition-colors duration-300">
                            <?php echo esc_html($faq['q']); ?>
                        </span>
                        <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center transition-all duration-300 group-hover:bg-bes-leaf/10 group-hover:border-bes-leaf/20"
                              aria-hidden="true">
                            <i class="fa-solid fa-plus text-bes-bark-muted text-[10px] bes-faq-icon transition-transform duration-300"></i>
                        </span>
                    </button>
                    <div class="bes-faq-body max-h-0 overflow-hidden transition-all duration-400 ease-in-out">
                        <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed px-6 pb-6">
                            <?php echo esc_html($faq['a']); ?>
                        </p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — CLOSING CTA
         ================================================================ -->
    <section class="bg-bes-forest-deep py-16 md:py-24" aria-label="Begin your sanctuary journey">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal relative rounded-2xl border border-white/[.05] overflow-hidden py-14 px-8 md:px-14 text-center"
                 style="background:linear-gradient(135deg,rgba(38,51,32,.65),rgba(30,42,22,.9))">

                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[600px] h-[280px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.07),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]"
                         style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>

                <div class="relative">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">The Sanctuary Is Ready When You Are</p>
                    <h2 class="font-display font-medium text-white text-3xl md:text-4xl lg:text-5xl tracking-display mb-4 max-w-2xl mx-auto">
                        Recharge. Reflect.<br>Reconnect.
                    </h2>
                    <p class="font-body font-light !text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                        Whether you have five hours or four days, the sanctuary holds the same promise: a space where you can finally put down what you have been carrying. Choose a program, or speak with the team first &mdash; either way, you have already started.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="#bes-sanc-programs"
                           class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                            <i class="fa-solid fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform" aria-hidden="true"></i>
                            Compare the Three Programs
                        </a>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 bg-transparent !text-white/60 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.04] hover:border-white/20 hover:!text-white transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-sm" aria-hidden="true"></i>
                            WhatsApp the Sanctuary
                        </a>
                    </div>

                    <!-- Trust line -->
                    <p class="font-body text-[11px] text-white/20 tracking-wide mt-8">
                        All levels welcome &nbsp;·&nbsp; Small, intimate groups &nbsp;·&nbsp; Beginner friendly &nbsp;·&nbsp; Tampaksiring, Bali
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================================
         INLINE JS — FAQ accordion (identical to healing retreat page,
         safe to load twice; function redeclare-guarded)
         ================================================================ -->
    <script>
    if (typeof besFaqToggle !== 'function') {
        function besFaqToggle(btn) {
            var body = btn.nextElementSibling;
            var icon = btn.querySelector('.bes-faq-icon');
            var isOpen = btn.getAttribute('aria-expanded') === 'true';

            /* Close all other FAQs on same page */
            document.querySelectorAll('[onclick="besFaqToggle(this)"]').forEach(function(b) {
                if (b !== btn) {
                    b.setAttribute('aria-expanded', 'false');
                    b.nextElementSibling.style.maxHeight = null;
                    var ic = b.querySelector('.bes-faq-icon');
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
                if (icon) { icon.style.transform = 'rotate(45deg)'; icon.style.color = '#C2D24A'; }
            }
        }
    }
    </script>

    <?php
    return ob_get_clean();
}