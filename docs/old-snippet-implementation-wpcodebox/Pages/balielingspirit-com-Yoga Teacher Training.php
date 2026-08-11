<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_yoga_teacher_training] Shortcode
 * ============================================================================
 *
 * Registers [bes_yoga_teacher_training] for the YTT page.
 * 100% aligned with BES v3 design system (Snippet 1):
 *   - Tailwind BES color tokens, font-display, font-body
 *   - tracking-nav / tracking-label / tracking-display
 *   - bes-reveal entrance animations, bes-fret dividers
 *   - bes-soc-orb / bes-ftr-link hover language
 *   - Zero new CSS — everything rides the existing stylesheet
 *
 * UNIQUE SECTIONS (11 total):
 *   0  Cinematic Hero — Sanskrit sutras, triple-accreditation badges, dual CTA
 *   1  Why This Place Is Different — 5 philosophy pillars with counter numbers
 *   2  The Taksu Section — unique "secret of Balinese teaching power"
 *   3  Practitioner Roadmap — horizontal path with 5 levels (50h → 500h)
 *   4  Full 200hr Curriculum — 4 Parwa/modules with expandable sub-chapters
 *   5  Sacred Texts You Will Study — ancient scriptures decoded
 *   6  Yoga Styles Mastered — style grid with depth callouts
 *   7  Who This Training Is For — wide profession grid
 *   8  Entry Requirements — clean checklist card
 *   9  Graduates Receive — benefits timeline
 *  10  FAQ
 *  11  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_yoga_teacher_training', 'bes_render_ytt');

function bes_render_ytt($atts)
{
    ob_start();
?>

    <!-- ================================================================
         SECTION 0 — CINEMATIC HERO
         ================================================================ -->
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-heading">

        <!-- Layered atmospheric glows -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_58%)]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Fretwork top -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">

            <!-- Sanskrit sutra — eyebrow -->
            <div class="bes-reveal mb-8 space-y-2">
                <p class="font-display font-light italic text-white/30 text-lg md:text-xl tracking-wide">
                    <em>"Atha yoga-anusasanam"</em>
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50">
                    "Now, the discipline of yoga begins." - Yoga Sutra Patanjali 1.1
                </p>
            </div>

            <!-- ============================================================
                 Accreditation row — 6 official certification marks.
                 Order is locked to the client spec (left-to-right, 1..6).
                 Logos are pulled live from the WP Media Library by ID,
                 so editors can swap an image via Media › Replace without
                 ever touching this template.

                 Visual standardisation: every badge sits inside an identical
                 circular white "coin." This normalises the mixed source art
                 (some PNGs ship with their own background, others are fully
                 transparent), so the row reads as one cohesive badge wall
                 regardless of the artwork each accrediting body provides.
                 ============================================================ -->
            <div class="bes-reveal mb-10">
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50 text-center mb-5">
                    Internationally Accredited
                </p>

                <?php
                $bes_accreditations = [
                    ['id' => 3006, 'label' => 'RYS 200',  'body' => 'Yoga Alliance USA'],
                    ['id' => 3001, 'label' => 'RYS 300',  'body' => 'Yoga Alliance USA'],
                    ['id' => 3002, 'label' => '200 CYS',  'body' => 'World Yoga Federation'],
                    ['id' => 3003, 'label' => '500 CYS',  'body' => 'World Yoga Federation'],
                    ['id' => 3004, 'label' => 'CYS-200',  'body' => 'Yoga Alliance International'],
                    ['id' => 3005, 'label' => 'YACEP',    'body' => 'Yoga Alliance USA'],
                ];
                ?>

                <div class="flex flex-wrap items-start justify-center gap-x-4 gap-y-5 md:gap-x-6">
                    <?php foreach ($bes_accreditations as $acc) :
                        // Safe-guard: skip silently if the media item was deleted/replaced with a non-image
                        if (! wp_attachment_is_image($acc['id'])) continue;

                        $alt_text  = $acc['body'] . ' — ' . $acc['label'] . ' Accredited';
                        // object-cover + rounded-full on the <img> itself clips any baked-in
                        // square/black backgrounds (RYS 200/300, 200/500 CYS) into a true circle,
                        // so every logo reads as a uniform circular coin regardless of source artwork.
                        $img_attrs = [
                            'class'    => 'w-full h-full object-cover rounded-full',
                            'alt'      => esc_attr($alt_text),
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                        ];
                    ?>
                        <div class="group flex flex-col items-center gap-2.5"
                            title="<?php echo esc_attr($acc['body'] . ' · ' . $acc['label']); ?>">
                            <!-- Circular white "coin" — uniform shape regardless of source PNG bg/transparency.
                                 No inner padding: the <img> is itself clipped to a circle (object-cover + rounded-full),
                                 so any baked-in square or dark background is cropped away cleanly at the rim. -->
                            <div class="w-[88px] h-[88px] md:w-[100px] md:h-[100px] lg:w-[104px] lg:h-[104px] rounded-full bg-white flex items-center justify-center ring-1 ring-white/10 group-hover:ring-bes-leaf/50 shadow-md shadow-black/20 group-hover:shadow-lg group-hover:shadow-bes-leaf/15 group-hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                                <?php echo wp_get_attachment_image($acc['id'], 'medium', false, $img_attrs); ?>
                            </div>
                            <span class="font-body font-bold text-[8px] uppercase tracking-nav text-bes-leaf/40 group-hover:text-bes-leaf/80 transition-colors duration-300">
                                <?php echo esc_html($acc['label']); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <h1 id="bes-ytt-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[6rem] tracking-display leading-none mb-4">
                Yoga Teacher
            </h1>
            <h2 class="bes-reveal font-display font-light text-bes-leaf text-4xl md:text-5xl lg:text-[5rem] tracking-display leading-none mb-8 italic">
                Training
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-4">
                An immersive international-standard yoga training designed not only for future teachers, but for anyone seeking personal transformation through the path of yoga — with internationally recognized certification rooted in classical yoga and Balinese spiritual wisdom.
            </p>

            <!-- Second Sutra -->
            <p class="bes-reveal font-display font-light italic text-white/20 text-base mb-10">
                "Yogas citta vrtti nirodhah" — Yoga is the cessation of the fluctuations of the mind.
            </p>

            <!-- Training paths quick-select -->
            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="#bes-ytt-roadmap"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                    <i class="fa-solid fa-route text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    View Training Paths
                </a>
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] !text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                    Ask Program Consultant
                </a>
            </div>

            <!-- Gradient divider -->
            <div class="bes-reveal h-[1px] w-48 mx-auto bg-gradient-to-r from-transparent via-bes-leaf/40 to-transparent"></div>
        </div>

        <!-- Fretwork bottom -->
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — FIVE REASONS THIS TRAINING IS DIFFERENT
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Why train here">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14 md:mb-18">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Before You Compare Schools</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-3xl mx-auto">
                    The Things That Make This Training Genuinely Different
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $reasons = [
                    [
                        'n'     => '01',
                        'icon'  => 'fa-solid fa-layer-group',
                        'title' => 'A Fully Immersive Transformational Experience',
                        'body'  => 'More than physical practice, this program offers a holistic inner journey — guiding you through healing, self-awareness, and the cultivation of true personal mastery.',
                    ],
                    [
                        'n'     => '02',
                        'icon'  => 'fa-solid fa-person',
                        'title' => 'Training Through All Three Bodies',
                        'body'  => 'The curriculum works simultaneously through Sthula Sarira (physical), Suksma Sarira (mind and feeling), and Antah Karana Sarira (soul). Most YTT programs address the first. Very few address all three. This one does not consider the training complete until all three are engaged.',
                    ],
                    [
                        'n'     => '03',
                        'icon'  => 'fa-solid fa-scroll',
                        'title' => 'Learn from Teachers Who Live the Practice',
                        'body'  => 'Our teachers are not just certified - they are devoted practitioners who live what they teach every day. Guided by a lineage holder with a lots of experience, you learn from those who embody the path.',
                    ],
                    [
                        'n'     => '04',
                        'icon'  => 'fa-solid fa-heart-pulse',
                        'title' => 'A Proven Method Rooted in Bali Hatha Yoga',
                        'body'  => 'Developed by Sri Bhagawan Sripada Bhaskara, the Bali Hatha Yoga method offers a distinctive approach that goes beyond conventional practice. It has supported many individuals in achieving a deeper balance between mind, body, and soul — not through intensity, but through awareness, breath, and inner alignment.',
                    ],
                    [
                        'n'     => '05',
                        'icon'  => 'fa-solid fa-infinity',
                        'title' => 'A Lifelong Path, Not Just a Certification',
                        'body'  => 'Graduation is not the end — it is the beginning. You become part of a conscious community dedicated to living a harmonious and balanced life, Eling Living, with continued guidance, support, and connection long after the training ends.',
                    ],
                    [
                        'n'     => '06',
                        'icon'  => 'fa-solid fa-earth-asia',
                        'title' => 'Local Roots, Universal Standards',
                        'body'  => 'The curriculum meets Yoga Alliance (USA), World Yoga Federation, and Yoga Alliance International (India) standards. Your certificate is recognized globally. But the wisdom that fills those hours comes from a specific place — this land, this lineage — and that specificity is the thing no other school can replicate.',
                    ],
                ];
                foreach ($reasons as $r) : ?>

                    <div class="bes-reveal group flex flex-col gap-5 p-7 md:p-8 rounded-2xl border border-bes-sand hover:border-bes-leaf/20 hover:shadow-lg hover:shadow-black/5 transition-all duration-400"
                        style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center">
                                <i class="<?php echo esc_attr($r['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                            </div>
                            <span class="font-display font-light text-bes-bark/10 text-4xl leading-none group-hover:!text-bes-leaf/15 transition-colors duration-300"><?php echo $r['n']; ?></span>
                        </div>
                        <div>
                            <h3 class="font-display font-medium text-bes-bark text-xl mb-2"><?php echo esc_html($r['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[13.5px] leading-relaxed"><?php echo esc_html($r['body']); ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 2 — THE SECRET OF TAKSU (unique to this school)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="The Study of Bali Hatha Yoga">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-0 w-[600px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav !text-bes-gold mb-4">
                        Where practice becomes inner transformation
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        The Study of <em class="not-italic !text-bes-gold">Bali Hatha Yoga</em>
                    </h2>

                    <div class="space-y-5 font-body font-light text-white/50 text-base leading-relaxed">
                        <p class="bes-reveal">
                            Bali Hatha Yoga is not merely a practice — it is a path born from deep inner search, discipline, and lived spiritual experience. Developed by Sri Bhagawan Sriprada Bhaskara, this system integrates traditional wisdom with modern understanding, uniting anatomy, physiology, and biomechanics with the subtle layers of human existence — from body to energy, mind, and inner awareness.
                        </p>
                        <p class="bes-reveal">
                            At its core, Bali Hatha Yoga is the practice of returning — to balance, to awareness, and ultimately to one’s true self. Through the union of Ha (sun, heat, masculine) and Tha (moon, cooling, feminine), practitioners cultivate harmony within, building a body that is strong, flexible, and energetically aligned.
                        </p>
                        <p class="bes-reveal">
                            Structured in a vinyasa-based flow, the practice rises with intensity and softens into stillness, guiding both activation and integration. More than learning postures, this study invites a deeper understanding of oneself — supporting not only physical health, but clarity, purpose, and inner transformation.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bes-reveal relative rounded-2xl border border-bes-gold/[.18] overflow-hidden"
                        style="background:linear-gradient(145deg,rgba(38,51,32,.6),rgba(21,30,16,.8))">
                        <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                        <div class="p-8 md:p-10">

                            <blockquote class="mb-8">
                                <span class="block font-display font-light italic text-white text-2xl md:text-3xl leading-snug mb-4">
                                    "Bali Hatha Yoga is the practice of returning to the true self — by harmonizing body, energy, mind, and consciousness into one unified experience."
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label !text-bes-gold/60">
                                    — Teaching Principle, Bali Eling Spirit
                                </cite>
                            </blockquote>

                            <div class="border-t border-white/[.06] pt-6 space-y-3">
                                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-white/25 mb-4">What the Bali Hatha Yoga Curriculum Develops</p>
                                <?php
                                $bali_hatha_points = [
                                    'Integration of physical, energetic, mental, and spiritual layers (kosha system)',
                                    'Balance between opposing energies (ha–tha) within the body',
                                    'Awareness of prana, breath, and internal flow of energy',
                                    'Structured vinyasa progression: activation, peak, and integration',
                                    'Foundation in asana, pranayama, pratyahara, and dharana',
                                    'Alignment between discipline (tapa), self-awareness, and life purpose'
                                ];
                                foreach ($bali_hatha_points as $t) : ?>
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-bes-gold/50 flex-shrink-0"></span>
                                        <span class="font-body font-light text-white/45 text-[13px]"><?php echo esc_html($t); ?></span>
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
         SECTION 3 — PRACTITIONER ROADMAP (5 levels)
         ================================================================ -->
    <section id="bes-ytt-roadmap" class="bg-bes-cream py-20 md:py-28" aria-label="Training roadmap">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Your Path, Step by Step</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">The Practitioner Roadmap</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-xl mx-auto mt-4 leading-relaxed">
                    You do not have to begin at 200 hours. The path is modular — each level is meaningful on its own, and each one is the natural foundation for the next.
                </p>
            </div>

            <!-- Roadmap cards — horizontal scroll on mobile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                <?php
                $levels = [
                    // [
                    //     'hours'   => '50hr',
                    //     'parwa'   => 'ON-SITE IMMERSION',
                    //     'title'   => 'Practitioner Foundation',
                    //     'focus'   => 'Deepen your personal practice and build strong roots in core yoga techniques.',
                    //     'outcome' => 'Cultivate self-practice & share the basics with loved ones',
                    //     'slug'    => 'bali-eling-spirit-50h',
                    //     'color'   => 'border-bes-sage/30',
                    //     'dot'     => 'bg-bes-sage',
                    //     'badge'   => 'bg-bes-sage/10 text-bes-bark-muted border-bes-sage/20',
                    // ],
                    [
                        'hours'   => '50hr Hybrid',
                        'parwa'   => 'FLEXIBLE LEARNING',
                        'title'   => 'Hybrid Foundation',
                        'focus'   => 'Online foundational theory combined with an intensive on-site experience in Bali.',
                        'outcome' => 'Begin your spiritual journey from anywhere, at your own pace',
                        'slug'    => 'bali-eling-spirit-50h-hybrid',
                        'color'   => 'border-bes-moss/30',
                        'dot'     => 'bg-bes-moss',
                        'badge'   => 'bg-bes-moss/10 text-bes-bark-muted border-bes-moss/20',
                    ],
                    [
                        'hours'   => '200hr Hybrid',
                        'parwa'   => 'FLEXIBLE CERTIFICATION',
                        'title'   => 'Hybrid Teacher Training',
                        'focus'   => 'Complete foundational theory online, followed by an intensive practical immersion in Bali.',
                        'outcome' => 'Flexible path to international certification',
                        'slug'    => 'bali-eling-spirit-200h-hybrid',
                        'color'   => 'border-bes-olive/30',
                        'dot'     => 'bg-bes-olive',
                        'badge'   => 'bg-bes-olive/10 text-bes-bark border-bes-olive/25',
                    ],
                    [
                        'hours'   => '200hr',
                        'parwa'   => 'FULL IMMERSION',
                        'title'   => 'Certified Yoga Teacher',
                        'focus'   => 'Transform your passion into a profession with our internationally recognized standard.',
                        'outcome' => 'Teach professionally worldwide with profound Bhakti spirit',
                        'slug'    => 'bali-eling-spirit-200h',
                        'color'   => 'border-bes-leaf/40',
                        'dot'     => 'bg-bes-leaf',
                        'badge'   => 'bg-bes-leaf/10 text-bes-bark border-bes-leaf/25',
                        'featured' => true,
                    ],
                ];
                foreach ($levels as $lv) : ?>

                    <div class="bes-reveal relative flex flex-col rounded-2xl border <?php echo esc_attr($lv['color']); ?> overflow-hidden transition-all duration-400 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/8 <?php echo !empty($lv['featured']) ? 'ring-1 ring-bes-leaf/20' : ''; ?>"
                        style="background:linear-gradient(160deg,#fdfcfa,#f2ede4)">

                        <?php if (!empty($lv['featured'])) : ?>
                            <!-- Featured flag -->
                            <div class="absolute top-3 right-3 z-10">
                                <span class="font-body font-bold text-[8px] uppercase tracking-label bg-bes-leaf text-bes-forest px-2.5 py-1 rounded-full">Most Popular</span>
                            </div>
                        <?php endif; ?>

                        <div class="p-6 flex flex-col gap-4 flex-1">
                            <!-- Hour badge -->
                            <div class="inline-flex self-start items-center gap-1.5 border rounded-full px-3 py-1.5 <?php echo esc_attr($lv['badge']); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr($lv['dot']); ?> flex-shrink-0"></span>
                                <span class="font-body font-bold text-[9px] uppercase tracking-nav"><?php echo esc_html($lv['hours']); ?></span>
                            </div>

                            <div class="flex-1">
                                <p class="font-body text-[9px] uppercase tracking-nav text-bes-bark-muted/60 font-bold mb-1"><?php echo esc_html($lv['parwa']); ?></p>
                                <h3 class="font-display font-medium text-bes-bark text-xl leading-tight mb-3"><?php echo esc_html($lv['title']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-[12px] leading-relaxed mb-3"><?php echo esc_html($lv['focus']); ?></p>

                                <?php
                                $lv_language_note = '';
                                if (in_array($lv['slug'], ['bali-eling-spirit-50h-hybrid', 'bali-eling-spirit-200h-hybrid'], true)) {
                                    $lv_language_note = 'Taught in Bahasa Indonesia';
                                } elseif ($lv['slug'] === 'bali-eling-spirit-200h') {
                                    $lv_language_note = 'Available in Bahasa Indonesia & English';
                                }
                                ?>

                                <?php if ($lv_language_note) : ?>
                                    <div class="flex items-start gap-2 mb-3 rounded-xl border border-bes-forest/[.06] bg-bes-forest/[.025] px-3 py-2">
                                        <i class="fa-solid fa-language text-bes-olive text-[11px] mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                        <span class="font-body font-semibold text-bes-bark-muted text-[11.5px] leading-snug"><?php echo esc_html($lv_language_note); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="flex items-start gap-2">
                                    <i class="fa-solid fa-arrow-right text-bes-leaf text-[9px] mt-1 flex-shrink-0" aria-hidden="true"></i>
                                    <span class="font-body font-light text-bes-bark-muted text-[12px] leading-snug italic"><?php echo esc_html($lv['outcome']); ?></span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <a href="<?php echo esc_url(home_url('/' . $lv['slug'] . '/')); ?>"
                                    class="block text-center font-body font-bold text-[9px] uppercase tracking-label py-3 rounded-xl border border-bes-leaf bg-bes-leaf text-bes-forest hover:bg-bes-leaf-hover transition-all duration-300">
                                    More Details
                                </a>
                                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                                    class="block text-center font-body font-bold text-[9px] uppercase tracking-label py-3 rounded-xl border border-bes-forest/[.08] text-bes-bark-muted hover:bg-bes-forest hover:!text-bes-leaf hover:border-bes-forest transition-all duration-300">
                                    Enquire
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Early bird note -->
            <div class="bes-reveal mt-8 flex items-center gap-3 justify-center text-center">
                <i class="fa-solid fa-tag !text-bes-gold text-sm" aria-hidden="true"></i>
                <p class="font-body text-[13px] text-bes-bark-muted">
                    <strong class="text-bes-bark font-semibold">Early bird discount: 10%</strong> for the first 5 registrants who pay full at least one month before training begins or Bali ID Card holder.
                </p>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — FULL 200HR CURRICULUM (4 Parwa / Modules)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="200 hour curriculum">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">International Standard Curriculum</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">
                    200 Hours — Four Parwa
                </h2>
                <p class="bes-reveal font-body font-light text-white/40 text-sm max-w-2xl mx-auto mt-4 leading-relaxed">
                    The 200-hour certification is divided into four Parwa (modules) of 50 hours each, built sequentially. Each Parwa is its own coherent body of knowledge — completing all four earns your internationally recognized YTT 200hr certificate.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                $parwas = [
                    [
                        'num'     => 'I',
                        'hours'   => 'DAYS 1–7',
                        'focus'   => 'The Foundation & Bali Hatha Awakening',
                        'desc'    => 'Establishing your roots, purifying the self, and mastering the foundational sequences.',
                        'color'   => 'from-bes-sage/10',
                        'icon'    => 'fa-solid fa-om',
                        'chapters' => [
                            [
                                'num'  => 'Adhyaya I',
                                'name' => 'Purification & Philosophy',
                                'body' => 'Begin with a deep self-cleansing and deep dive into the History of Yoga, Patanjali\'s Yoga Sutra (Samadhi Pada) , and Balinese Dharmic philosophy.',
                            ],
                            [
                                'num'  => 'Adhyaya II',
                                'name' => 'Bali Hatha Yoga Asana Labs',
                                'body' => 'Daily intensive Yoga sessions covering the complete sequence of Bali Hatha Yoga practices including Meditation, Asana, Pranayama and completed with a 7 Chakra Water Purification ritual.',
                            ],
                            [
                                'num'  => 'Adhyaya III',
                                'name' => 'First Milestone',
                                'body' => 'Expand your practice with Yin Yoga, Sound Healing, and Mandala-making. The week concludes with a comprehensive Bali Hatha Yoga practice exam and the 50-Hour YTT milestone.',
                            ],
                        ],
                    ],
                    [
                        'num'     => 'II',
                        'hours'   => 'DAYS 8-14',
                        'focus'   => 'The Inner Vessel & Subtle Body',
                        'desc'    => 'Understanding the profound mechanics of the human body and the architecture of breath.',
                        'color'   => 'from-bes-moss/10',
                        'icon'    => 'fa-solid fa-bone',
                        'chapters' => [
                            [
                                'num'  => 'Adhyaya IV',
                                'name' => 'Anatomy, Physiology & Biomechanics',
                                'body' => 'A dedicated session exploring the physical body. Understand the musculoskeletal system, nervous system responses, and biomechanics that make yoga truly therapeutic and safe.',
                            ],
                            [
                                'num'  => 'Adhyaya V',
                                'name' => 'Pranayama & Sadhana',
                                'body' => 'Explore Patanjali\'s advanced Yoga Sutras, deeply structured meditation techniques, and the energy architecture of pranayama.',
                            ],
                            [
                                'num'  => 'Adhyaya VI',
                                'name' => 'Introduction to Teaching',
                                'body' => 'Begin your journey as a yoga teacher into teaching methodology, learn the fundamental skills to guide others, and end the week with deeply nourishing, restorative yoga.',
                            ],
                        ],
                    ],
                    [
                        'num'     => 'III',
                        'hours'   => 'DAYS 15–21',
                        'focus'   => 'The Teacher\'s Craft & Professional Growth',
                        'desc'    => 'Stepping into your power, finding your voice, and navigating the modern yoga landscape.',
                        'color'   => 'from-bes-leaf/10',
                        'icon'    => 'fa-solid fa-chalkboard-user',
                        'chapters' => [
                            [
                                'num'  => 'Adhyaya VII',
                                'name' => 'Finding Your Voice',
                                'body' => 'A comprehensive class on Self-Development, Communication, Interpersonal Skills, and Public Speaking specifically designed to guide yoga classes.',
                            ],
                            [
                                'num'  => 'Adhyaya VIII',
                                'name' => 'Advanced Practice & Philosophy',
                                'body' => 'Expand your physical boundaries with Acro Yoga and delve into the higher philosophical realms of Patanjali\'s Yoga Sutras.',
                            ],
                            [
                                'num'  => 'Adhyaya IX',
                                'name' => 'The Business of Yoga',
                                'body' => 'Practical preparation for your career. Learn about Personal Branding, Marketing, Yoga Ethics, and the essentials of Business & Administration for Yoga Teachers. The week concludes with Group Teaching Practice and a Mentoring Circle.',
                            ],
                        ],
                    ],
                    [
                        'num'     => 'IV',
                        'hours'   => 'DAYS 22-25',
                        'focus'   => 'Integration, Ayurveda & Mastery',
                        'desc'    => 'The final polishing of your skills, holistic integration, and the rite of passage into teaching.',
                        'color'   => 'from-bes-gold/10',
                        'icon'    => 'fa-solid fa-star-and-crescent',
                        'chapters' => [
                            [
                                'num'  => 'Adhyaya X',
                                'name' => 'Ayurveda & Sacred Arts',
                                'body' => 'Expand your holistic toolkit with practical Ayurveda classes, Yantra & Mudra explorations, and the meditative art of Mandala creation.',
                            ],
                            [
                                'num'  => 'Adhyaya XI',
                                'name' => 'Student-Led Practice',
                                'body' => 'Fully embrace the role of teacher by leading your peers. Experience Karma Yoga and lead sessions in Meditation, Yin Yoga, and Sound Healing.',
                            ],
                            [
                                'num'  => 'Adhyaya XII',
                                'name' => 'Final Stage',
                                'body' => 'Synthesize 200 hours of knowledge through a final Written Exam, and a conclusive Teaching Practice Exam. Celebrate your transformation at the Closing Ceremony.',
                            ],
                        ],
                    ],
                ];
                foreach ($parwas as $p) : ?>

                    <div class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden transition-all duration-500 hover:border-bes-leaf/15"
                        style="background:rgba(38,51,32,0.35)">
                        <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr($p['color']); ?> to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative p-7 md:p-8">
                            <!-- Header -->
                            <div class="flex items-center gap-4 mb-6 pb-5 border-b border-white/[.05]">
                                <div class="w-12 h-12 rounded-2xl bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center flex-shrink-0">
                                    <i class="<?php echo esc_attr($p['icon']); ?> text-bes-leaf text-base" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50">Parwa <?php echo esc_html($p['num']); ?> &nbsp;·&nbsp; <?php echo esc_html($p['hours']); ?></p>
                                    <h3 class="font-display font-medium text-white text-xl"><?php echo $p['focus']; ?></h3>
                                </div>
                            </div>

                            <!-- Chapters -->
                            <div class="space-y-5">
                                <?php foreach ($p['chapters'] as $ch) : ?>
                                    <div class="group/ch">
                                        <div class="flex items-start gap-3 mb-1.5">
                                            <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/40 mt-0.5 flex-shrink-0 w-20"><?php echo esc_html($ch['num']); ?></span>
                                            <h4 class="font-body font-semibold text-white/75 text-[13px] group-hover/ch:text-white transition-colors duration-200"><?php echo esc_html($ch['name']); ?></h4>
                                        </div>
                                        <div class="ml-[92px]">
                                            <p class="font-body font-light text-white/35 text-[13px] leading-relaxed"><?php echo esc_html($ch['body']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Duration note -->
            <div class="bes-reveal mt-8 text-center max-w-3xl mx-auto">
                <p class="font-body font-light text-white/40 text-sm leading-relaxed">
                    Full 200hr program runs <strong class="text-white/60 font-semibold">25 days</strong>. Includes authentic Balinese purification rituals, deeply immersive classes, and comprehensive training materials. Total training encompasses 200 hours.
                </p>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — SACRED TEXTS YOU WILL STUDY
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-24" aria-label="Sacred texts in the curriculum">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Source Texts</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Ancient Scriptures. Living Practice.</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-[13.5px] max-w-3xl mx-auto mt-5 leading-relaxed">
                    Philosophy is the heartbeat of your practice. Our curriculum meets global standards by exploring the true definition of yoga, key Sanskrit terms, and the profound relationship between asana, pranayama, and meditation. We study these major texts not as history, but as an active mirror—encouraging deep self-reflection on how ancient philosophy translates into your modern practice and teaching.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                <?php
                $texts = [
                    [
                        'title'  => 'Bhagavad Gita',
                        'period' => 'C. 400-200 BCE',
                        'icon'   => 'fa-solid fa-yin-yang',
                        'color'  => 'border-bes-gold/20 hover:border-bes-gold/40',
                        'dot'    => 'bg-bes-gold/60',
                        'desc'   => 'The epic dialogue between Arjuna and Krishna—the most complete articulation of yoga as a philosophy of action, devotion, and knowledge. The foundational paths of Jnana Yoga, Karma Yoga, Bhakti Yoga, and Raja Yoga emerge here.',
                        'why'    => 'Teaches you to act without attachment and prompts vital self-reflection on your duty (Dharma) as a teacher.',
                    ],
                    [
                        'title'  => 'Yoga Sutra of Patanjali',
                        'period' => 'C. 400 CE',
                        'icon'   => 'fa-solid fa-scroll',
                        'color'  => 'border-bes-leaf/20 hover:border-bes-leaf/40',
                        'dot'    => 'bg-bes-leaf/60',
                        'desc'   => 'The definitive text outlining the core definition of yoga and its key terms. Through 196 aphorisms, it maps the structure of the mind, the obstacles to practice, and the eight-limbed path (Ashtanga).',
                        'why'    => 'Gives you the conceptual skeleton that makes sense of everything else—uniting asana, pranayama, and meditation into one coherent whole.',
                    ],
                    [
                        'title'  => 'Hatha Yoga Pradipika',
                        'period' => 'C. 15TH CENTURY CE',
                        'icon'   => 'fa-solid fa-person-rays',
                        'color'  => 'border-bes-sage/25 hover:border-bes-sage/50',
                        'dot'    => 'bg-bes-sage/60',
                        'desc'   => 'The primary manual of classical Hatha Yoga. It provides systematic instructions on asanas, pranayama, mudra, bandha, and the cleansing practices (Shatkarma).',
                        'why'    => 'Clearly defines the relationship between physical postures and breathwork, linking bodily practice explicitly to spiritual awakening.',
                    ],
                    [
                        'title'  => 'The Upanishads',
                        'period' => 'C. 800-500 BCE',
                        'icon'   => 'fa-solid fa-book-open',
                        'color'  => 'border-bes-moss/25 hover:border-bes-moss/45',
                        'dot'    => 'bg-bes-moss/60',
                        'desc'   => 'The philosophical core of yogic thought. These mystical texts explore the ultimate nature of reality (Brahman) and the inner self (Atman), shifting yoga from external rituals to internal liberation.',
                        'why'    => 'Provides the ultimate framework for self-reflection, bridging the gap between ancient philosophy and your personal spiritual experience.',
                    ],
                    [
                        'title'  => 'Balinese Wisdom',
                        'period' => 'LIVING TRADITION',
                        'icon'   => 'fa-solid fa-spa',
                        'color'  => 'border-bes-olive/25 hover:border-bes-olive/50',
                        'dot'    => 'bg-bes-olive/60',
                        'desc'   => 'The metaphysical principles and Dharmic philosophy preserved as a living, breathing tradition in Bali. It explores concepts like Tri Hita Karana (harmony with God, humanity, and nature) and the profound nature of consciousness.',
                        'why'    => 'Uniquely Eling. It provides a culturally immersive framework for self-reflection, showing how local spiritual wisdom elevates and grounds your global teaching practice.',
                    ],
                ];
                $i = 0;
                foreach ($texts as $tx) :
                    $grid_class = 'sm:col-span-1 lg:col-span-2';
                    if ($i === 3) {
                        $grid_class .= ' lg:col-start-2';
                    }
                ?>

                    <div class="bes-reveal group rounded-2xl border <?php echo esc_attr($tx['color']); ?> <?php echo $grid_class; ?> transition-all duration-400 overflow-hidden hover:shadow-lg hover:shadow-black/6"
                        style="background:linear-gradient(145deg,#fdfcfa,#f2ede4)">
                        <div class="p-6 md:p-7">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center flex-shrink-0">
                                    <i class="<?php echo esc_attr($tx['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="font-display font-medium text-bes-bark text-xl md:text-2xl leading-tight mb-1"><?php echo esc_html($tx['title']); ?></h3>
                                    <p class="font-body text-[10px] uppercase tracking-label text-bes-bark-muted/50 font-bold mt-0.5"><?php echo esc_html($tx['period']); ?></p>
                                </div>
                            </div>
                            <p class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed mb-4"><?php echo esc_html($tx['desc']); ?></p>
                            <div class="flex items-start gap-2 pt-3 border-t border-bes-sand">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr($tx['dot']); ?> mt-1.5 flex-shrink-0"></span>
                                <p class="font-body font-light text-bes-bark-muted text-[12px] italic leading-snug"><?php echo esc_html($tx['why']); ?></p>
                            </div>
                        </div>
                    </div>

                <?php $i++;
                endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — YOGA STYLES MASTERED
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-24 overflow-hidden" aria-label="Yoga styles in the curriculum">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-0 bottom-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">What You Will Train In</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Four Essential Yoga Disciplines</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $styles = [
                    [
                        'name'   => 'Bali Hatha Yoga',
                        'icon'   => 'fa-solid fa-leaf',
                        'badge'  => 'Signature Method',
                        'color'  => 'border-bes-leaf/25 group-hover:border-bes-leaf/50',
                        'dot'    => 'text-bes-leaf',
                        'desc'   => 'The original methodology of the Pasraman. Gentle, breath-first movement that has been documented to support healing from physical disease. Works through all three bodies simultaneously.',
                    ],
                    [
                        'name'   => 'Classical Yoga',
                        'icon'   => 'fa-solid fa-om',
                        'badge'  => 'The Root',
                        'color'  => 'border-bes-sage/25 group-hover:border-bes-sage/45',
                        'dot'    => 'text-bes-sage',
                        'desc'   => 'The unmodified traditional forms from which all other styles derive. Understanding the classical root teaches you why modern styles do what they do — and which departures are innovations versus errors.',
                    ],
                    [
                        'name'   => 'Vinyasa',
                        'icon'   => 'fa-solid fa-wind',
                        'badge'  => 'Flow',
                        'color'  => 'border-bes-moss/25 group-hover:border-bes-moss/45',
                        'dot'    => 'text-bes-moss',
                        'desc'   => 'Breath-synchronized movement — the most commercially taught yoga style worldwide. Mastering vinyasa transitions, sequencing logic, and safe advancement from beginner to intermediate flow.',
                    ],
                    // [
                    //     'name'   => 'Ashtanga Yoga',
                    //     'icon'   => 'fa-solid fa-fire',
                    //     'badge'  => 'Discipline',
                    //     'color'  => 'border-bes-gold/25 group-hover:border-bes-gold/45',
                    //     'dot'    => '!text-bes-gold',
                    //     'desc'   => 'The Mysore-tradition system of fixed sequences — Primary Series and beyond. The discipline of Ashtanga teaches self-practice, breath-count methodology, and the relationship between consistent effort and genuine transformation.',
                    // ],
                    [
                        'name'   => 'Yin Yoga',
                        'icon'   => 'fa-solid fa-moon',
                        'badge'  => 'Stillness',
                        'color'  => 'border-bes-gold/15 group-hover:border-bes-gold/35',
                        'dot'    => '!text-bes-gold/70',
                        'desc'   => 'Long-hold passive poses targeting connective tissue and the meridian lines of traditional Chinese medicine. Yin is how you teach students who cannot do active practice — and how every student recovers from it.',
                    ],
                ];
                foreach ($styles as $st) : ?>

                    <div class="bes-reveal group relative rounded-2xl border <?php echo esc_attr($st['color']); ?> transition-all duration-400 overflow-hidden flex flex-col"
                        style="background:rgba(38,51,32,0.35)">
                        <div class="p-6 flex flex-col gap-4 flex-1">
                            <div class="flex items-center gap-3">
                                <i class="<?php echo esc_attr($st['icon']); ?> <?php echo esc_attr($st['dot']); ?> text-base" aria-hidden="true"></i>
                                <span class="font-body font-bold text-[9px] uppercase tracking-nav text-white/25"><?php echo esc_html($st['badge']); ?></span>
                            </div>
                            <h3 class="font-display font-medium text-white text-xl leading-tight"><?php echo esc_html($st['name']); ?></h3>
                            <p class="font-body font-light text-white/40 text-[13px] leading-relaxed flex-1"><?php echo esc_html($st['desc']); ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — WHO THIS TRAINING IS FOR
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-24" aria-label="Who can participate">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <div class="lg:col-span-4">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">No Single Profile Required</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        This Training<br>Is Not Only<br>for Yogis
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-sm leading-relaxed mb-6">
                        The Pasraman explicitly welcomes people from every life context. The following are the professions and backgrounds that the training is specifically suited for — the list reflects who actually shows up and benefits.
                    </p>
                    <div class="bes-reveal flex items-center gap-3 p-4 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.06]">
                        <div class="w-9 h-9 rounded-lg bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-user-plus text-bes-leaf text-sm" aria-hidden="true"></i>
                        </div>
                        <p class="font-body font-light text-bes-bark-muted text-[13px]">Ages <strong class="text-bes-bark font-semibold">16-60</strong>. Both men and women. Min. senior high school education.</p>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        <?php
                        $profs = [
                            ['icon' => 'fa-solid fa-briefcase',          'label' => 'Professionals'],
                            ['icon' => 'fa-solid fa-rocket',             'label' => 'Entrepreneurs'],
                            ['icon' => 'fa-solid fa-user-tie',           'label' => 'Civil Servants'],
                            ['icon' => 'fa-solid fa-graduation-cap',     'label' => 'Students'],
                            // Updated from fa-house-heart to fa-house-user to fix the blank icon issue
                            ['icon' => 'fa-solid fa-house-user',         'label' => 'Homemakers'],
                            ['icon' => 'fa-solid fa-hand-sparkles',      'label' => 'Spa Therapists'],
                            ['icon' => 'fa-solid fa-comments',           'label' => 'Life Coaches'],
                            ['icon' => 'fa-solid fa-pray',               'label' => 'Religious Leaders'],
                            ['icon' => 'fa-solid fa-hotel',              'label' => 'Tourism & Hotel Staff'],
                            ['icon' => 'fa-solid fa-people-group',       'label' => 'Organization Leaders'],
                            ['icon' => 'fa-solid fa-dumbbell',           'label' => 'Sports Teachers'],
                            ['icon' => 'fa-solid fa-earth-asia',         'label' => 'Migrant Workers'],
                            ['icon' => 'fa-solid fa-stethoscope',        'label' => 'Healthcare Workers'],
                            ['icon' => 'fa-solid fa-seedling',           'label' => 'Spiritual Seekers'],
                            ['icon' => 'fa-solid fa-landmark',           'label' => 'Community Leaders'],
                            ['icon' => 'fa-solid fa-person-rays',        'label' => 'Anyone Ready to Grow'],
                        ];
                        foreach ($profs as $prof) : ?>
                            <div class="bes-reveal group flex items-center gap-3 p-3.5 rounded-xl border border-bes-sand hover:border-bes-leaf/20 hover:bg-bes-leaf/[.02] transition-all duration-300"
                                style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                                <div class="w-8 h-8 rounded-lg bg-bes-forest/[.04] border border-bes-forest/[.06] flex items-center justify-center flex-shrink-0">
                                    <i class="<?php echo esc_attr($prof['icon']); ?> text-bes-olive text-[11px]" aria-hidden="true"></i>
                                </div>
                                <span class="font-body font-medium text-bes-bark-muted text-[12px] leading-tight group-hover:!text-bes-bark transition-colors duration-200"><?php echo esc_html($prof['label']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 8 — ENTRY REQUIREMENTS + WHAT GRADUATES RECEIVE
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-24" aria-label="Requirements and graduate benefits">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                <!-- Requirements -->
                <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(145deg,#fdfcfa,#f2ede4)">
                    <div class="h-[3px] bg-gradient-to-r from-bes-forest via-bes-olive to-transparent"></div>
                    <div class="p-8 md:p-10">
                        <div class="flex items-center gap-3 mb-7">
                            <div class="w-10 h-10 rounded-xl bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center">
                                <i class="fa-solid fa-clipboard-list text-bes-olive text-sm" aria-hidden="true"></i>
                            </div>
                            <h3 class="font-display font-medium text-bes-bark text-2xl">Entry Requirements</h3>
                        </div>
                        <ul class="space-y-3">
                            <?php
                            $reqs = [
                                'Open to men and women equally',
                                'Minimum age: 16 years / Maximum: 60 years',
                                'Minimum education: Senior High School (SMA/SMK) or equivalent',
                                'Written parental consent for students under 18',
                                'Written partner consent for those who are married',
                                'Readiness to camp or stay during the training period',
                                'Commitment to follow Pasraman standards and schedules',
                                'Completed registration form — filled honestly and completely',
                                'Training investment settled before start date',
                            ];
                            foreach ($reqs as $req) : ?>
                                <li class="flex items-start gap-3">
                                    <div class="w-5 h-5 rounded-full border border-bes-leaf/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-check text-bes-leaf text-[8px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-bes-bark-muted text-[13px] leading-relaxed"><?php echo esc_html($req); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- What Graduates Receive -->
                <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(145deg,#fdfcfa,#f2ede4)">
                    <div class="h-[3px] bg-gradient-to-r from-bes-leaf via-bes-gold to-transparent"></div>
                    <div class="p-8 md:p-10">
                        <div class="flex items-center gap-3 mb-7">
                            <div class="w-10 h-10 rounded-xl bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center">
                                <i class="fa-solid fa-award text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h3 class="font-display font-medium text-bes-bark text-2xl">What You Receive</h3>
                        </div>
                        <ul class="space-y-3">
                            <?php
                            $benefits = [
                                ['head' => 'Internationally Recognized Certificate', 'body' => 'Yoga Alliance USA, World Yoga Federation, and Yoga Alliance International — all three accreditations.'],
                                ['head' => 'Guidance from Expert Master Teachers', 'body' => 'Learn directly from our highly experienced faculty. Every session is led by dedicated masters who are deeply rooted in the Eling tradition, ensuring an authentic and profound transmission of knowledge under the blessing of our lineage.'],
                                ['head' => 'Structured Path to Next Level', 'body' => 'Your certificate establishes the starting point for 300hr and 500hr training — globally standardized and seamlessly progressive.'],
                                ['head' => 'Satwik Meals During Training', 'body' => 'Vegetarian food three times daily, plus full support access throughout the training residency.'],
                                ['head' => 'Comprehensive Teaching Capacity', 'body' => 'Gain the absolute confidence and structural knowledge to safely guide others. You will master the delivery of Yoga Asana, Pranayama, and Meditation, creating a transformative space for your future students.'],
                            ];
                            foreach ($benefits as $b) : ?>
                                <li class="flex items-start gap-3">
                                    <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf mt-2 flex-shrink-0"></span>
                                    <div>
                                        <strong class="block font-body font-semibold text-bes-bark text-[13px] mb-0.5"><?php echo esc_html($b['head']); ?></strong>
                                        <span class="font-body font-light text-bes-bark-muted text-[12.5px] leading-relaxed"><?php echo esc_html($b['body']); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 9 — FAQ
         ================================================================ -->
    <section class="bg-bes-forest-deep py-20 md:py-28" aria-label="Frequently asked questions">
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Sticky left -->
                <div class="lg:col-span-4 lg:sticky lg:top-28">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">Before You Register</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-5">
                        Questions<br>Answered
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/40 text-sm leading-relaxed mb-8">
                        Anything not here — contact the Eling Academy team directly. We give honest answers, including "that program might not be right for you yet."
                    </p>
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                        class="bes-reveal inline-flex items-center gap-2.5 bg-bes-leaf/[.08] border border-bes-leaf/[.18] !text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-6 py-3.5 rounded-xl hover:bg-bes-leaf hover:!text-bes-forest transition-all duration-300 group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Ask via WhatsApp
                    </a>
                </div>

                <!-- FAQ list -->
                <div class="lg:col-span-8 space-y-4">
                    <?php
                    $faqs = [
                        [
                            'q' => 'Do I need prior yoga experience to join the 200hr training?',
                            'a' => 'No — and this is important. The training begins from the correct foundations, regardless of what you have or have not practiced before. What matters far more than existing ability is your sincerity and willingness to do the inner work alongside the physical. Bhagawan reads the readiness of each participant, not their existing flexibility.',
                        ],
                        [
                            'q' => 'Is the training only for people who want to become professional yoga teachers?',
                            'a' => 'No. Many graduates never teach professionally but describe the training as the most significant personal development investment of their lives. The curriculum builds the capacity to heal yourself, to understand your own body and mind deeply, and to share practice with family and close community. "Becoming a teacher" in the traditional sense — the deeper sense — is what happens here, whether or not you ever stand in front of a class.',
                        ],
                        [
                            'q' => 'What language is the training taught in?',
                            'a' => 'The primary language of instruction is Indonesian (Bahasa Indonesia), with English support available. International participants are welcomed; if your primary language is neither, please contact the admin team to discuss interpretation arrangements before registering.',
                        ],
                        [
                            'q' => 'Is the certificate recognized internationally?',
                            'a' => 'Yes. The curriculum meets the standards of Yoga Alliance (USA), World Yoga Federation, and Yoga Alliance International (India) — three of the most widely accepted accreditation bodies in global yoga. If you intend to teach internationally or continue to 300hr/500hr training, you are building on a recognized foundation.',
                        ],
                        [
                            'q' => 'What does the vegetarian food policy mean in practice?',
                            'a' => 'During the training residency, meals provided are satwik — vegetarian, prepared with the intention of supporting clarity of mind and lightness of body. You are not required to commit to vegetarianism as a permanent life choice. The Pasraman\'s view is that genuine awareness, when cultivated through practice, naturally moves people toward more conscious eating — but that shift comes from insight, not rule.',
                        ],
                        [
                            'q' => 'Can I do just the 50hr Parwa I without committing to the full 200hr?',
                            'a' => 'Yes. Each Parwa is a self-contained module with its own certificate. Many participants complete Parwa I to establish a personal practice, discover what the Pasraman is, and then decide whether they want to continue. The curriculum is designed so that no step is a precondition for experiencing real value.',
                        ],
                        /* [
                            'q' => 'What is the sisya bhawana membership and what does it include?',
                            'a' => 'Sisya bhawana is the traditional student community of the Pasraman. As a graduate and member, you have unlimited access to continued learning at your certified level — meaning you can return, revisit, deepen, and stay connected to the teaching and the community long after your training dates end. This is not a subscription; it is a relationship.',
                        ],
                        */
                    ];
                    foreach ($faqs as $faq) : ?>

                        <div class="bes-reveal group rounded-2xl border border-white/[.04] overflow-hidden transition-all duration-300 hover:border-bes-leaf/15"
                            style="background:rgba(38,51,32,0.35)">
                            <div class="p-6 md:p-7">
                                <div class="flex items-start gap-4">
                                    <div class="w-7 h-7 rounded-lg bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-question text-bes-leaf text-[10px]" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-body font-semibold text-white/80 text-[15px] mb-3 leading-snug"><?php echo esc_html($faq['q']); ?></h3>
                                        <p class="font-body font-light text-white/40 text-[13px] leading-relaxed"><?php echo esc_html($faq['a']); ?></p>
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
         SECTION 10 — CLOSING CTA
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-24 overflow-hidden" aria-label="Register for Yoga Teacher Training">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 top-0 -translate-x-1/2 w-[900px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="h-[1px] absolute top-0 inset-x-0 bg-gradient-to-r from-transparent via-bes-leaf/30 to-transparent"></div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal max-w-3xl mx-auto text-center">

                <div class="w-16 h-16 mx-auto mb-8 rounded-2xl bg-bes-leaf/[.07] border border-bes-leaf/[.15] flex items-center justify-center">
                    <i class="fa-solid fa-person-praying text-bes-leaf text-2xl" aria-hidden="true"></i>
                </div>

                <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">
                    Begin the Right Way
                </p>
                <h2 class="font-display font-medium text-white text-4xl md:text-5xl lg:text-6xl tracking-display mb-2">
                    Your Divine Home
                </h2>
                <h3 class="font-display font-light italic text-bes-leaf text-3xl md:text-4xl tracking-display mb-6">
                    to Transform
                </h3>
                <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                    Whether you begin with 50 hours or commit to the full 200, the path here is built on something that outlasts any certificate: a genuine encounter with yourself, guided by teachers who have walked the same road.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                        <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                        Register via WhatsApp
                    </a>
                    <a href="mailto:info@balielingspirit.com"
                        class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] !text-white/60 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                        <i class="fa-solid fa-envelope text-xs" aria-hidden="true"></i>
                        Email Enquiry
                    </a>
                </div>

                <!-- Accreditation re-confirm -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 text-[11px] text-white/20 font-body tracking-wide">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-certificate text-bes-leaf/40 text-[9px]" aria-hidden="true"></i>Yoga Alliance USA</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-globe text-bes-leaf/40 text-[9px]" aria-hidden="true"></i>World Yoga Federation</span>
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-medal text-bes-leaf/40 text-[9px]" aria-hidden="true"></i>Yoga Alliance International</span>
                </div>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}
