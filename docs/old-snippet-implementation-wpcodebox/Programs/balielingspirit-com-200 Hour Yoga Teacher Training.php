<?php
/**
 * ──────────────────────────────────────────────────────────────
 *  Shortcode : [bes_200h_ytt]
 *  Page      : /200-hour-yoga-teacher-training/
 *  Brand     : Eling Sanctuary · Bali Eling Spirit Group
 * ──────────────────────────────────────────────────────────────
 *  Program   : 200-Hour Foundational Yoga Teacher Training
 *  Duration  : 1 Month (4 weeks, residential)
 *  Structure : 4 Parwas (modules) × 50 hours each
 *  Prerequisite : None — open to complete beginners
 *  Certification: RYT-200 eligible upon completion
 *  Accreditation: Yoga Alliance (USA), World Yoga Federation,
 *                 Yoga Alliance International (India)
 *  Lead Faculty : Ida Sri Bhagawan Sriprada Bhaskara + senior
 *                 masters with decades of lineage practice
 *  Styles    : Bali Hatha Yoga, Vinyasa, Ashtanga, Yin Yoga
 *  Full 200H Curriculum (from official site):
 *    Parwa I  — Surya Namaskar & Asanas, Pranayama & Subtle Body,
 *               Meditation & Yoga Nidra
 *    Parwa II — Anatomy, Physiology & Biomechanics, Yoga History
 *               & Philosophy
 *    Parwa III— Yantra, Mudra & Bandhas, Chanting/Mantra/Agni Hotra,
 *               Yin Yoga & Restorative, Ethics of Yoga
 *    Parwa IV — Teaching Methodology, Alignment & Adjustment,
 *               Sequencing Krama, Professional Development,
 *               Teaching Practicum, Tri Hita Karana,
 *               Hindu Dharma Cosmology, Ayurveda/Jamu/Taru Pramana,
 *               Acro Yoga, Life Mastery & Goal Setting
 *  Facilities: Accommodation (AC, en-suite), 3× vegetarian meals,
 *              Pasraman uniform, modules + stationery, yoga mat,
 *              24-hour open kitchen
 *  Who can join: Professionals, entrepreneurs, students, housewives,
 *                spa therapists, life coaches, religious leaders,
 *                sports/spiritual teachers, hospitality workers,
 *                organisation leaders, migrant workers, civil servants
 *  Age: 15–60, both men and women, SMA/SMK minimum education
 *  WhatsApp  : +62 812 2888 8873
 *  Location  : Br. Umadawa, Pejeng Kangin, Tampaksiring,
 *              Gianyar, Bali
 * ──────────────────────────────────────────────────────────────
 *  BES Tailwind tokens loaded by theme — zero re-declaration.
 *  UI pattern: "Immersive editorial" — split-screen hero,
 *  manifesto column, stacked Parwa panels, persona cards,
 *  photo strip, compact schedule table. DISTINCT from ALL
 *  previous shortcodes (Tapa Brata, 300H, Karma, etc.).
 * ──────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_200h_ytt', 'bes_200h_ytt_render' );

function bes_200h_ytt_render( $atts ) {

    $a = shortcode_atts([
        'wa'    => '6281228888873',
        'price' => '2,450',
        'dates' => 'Monthly Intake',
    ], $atts, 'bes_200h_ytt' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I am interested in the 200-Hour Yoga Teacher Training at Pasraman Bali Eling Spirit. Could you share upcoming dates and enrollment details?' );

    ob_start();
    ?>

    <div class="bes-200ytt font-body text-bes-forest-deep overflow-hidden">


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  1 · HERO — SPLIT SCREEN (IMAGE LEFT, CONTENT RIGHT)      ║
         ║  Distinct: Not full-bleed overlay. 50/50 split.            ║
         ║  Image occupies left half, content panel on right.         ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="min-h-[96vh] grid lg:grid-cols-2 bg-bes-forest-deep">

        <!-- Left: full image -->
        <div class="relative overflow-hidden min-h-[50vh] lg:min-h-0">
            <img src="https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?w=960&h=1080&q=80&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1545389336-cf090694435e?w=960&h=1080&q=80&auto=format&fit=crop';"
                 alt="Yoga practitioners in morning practice at the Pasraman bamboo shala surrounded by tropical greenery"
                 class="w-full h-full object-cover" loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-bes-forest-deep/30 lg:bg-none"></div>

            <!-- Floating badge -->
            <div class="absolute top-6 left-6 bg-bes-gold text-bes-forest-deep text-[10px] font-semibold tracking-label uppercase px-4 py-2 rounded-full shadow-lg">
                Yoga Alliance Certified · RYT-200
            </div>
        </div>

        <!-- Right: content panel -->
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-16 py-16 lg:py-24">
            <div class="max-w-lg reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-5">
                    Pasraman Bali Eling Spirit &mdash; Your Divine Home to Transform
                </p>
                <h1 class="font-display font-light text-[2.6rem] md:text-[3.5rem] lg:text-[4rem] text-bes-parchment tracking-display leading-[1.05] mb-6">
                    200-Hour<br>
                    Yoga Teacher<br>
                    <span class="!text-bes-gold">Training</span>
                </h1>
                <p class="text-base md:text-lg text-bes-cream/80 leading-relaxed mb-8">
                    Whether your calling is to guide others or to profoundly heal yourself, this one-month
                    residential immersion builds an unshakeable foundation in Bali Hatha Yoga, classical philosophy,
                    and authentic spiritual practice &mdash; directly under the guidance of masters who have devoted
                    their lifetimes to this path.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mb-8">
                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep font-body
                              font-semibold tracking-label uppercase text-sm px-7 py-3.5 rounded transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        Begin Your Journey
                    </a>
                    <a href="#ytt-parwas"
                       class="inline-flex items-center justify-center gap-2 border border-bes-cream/20 hover:border-bes-cream/40
                              text-bes-cream font-body text-sm px-7 py-3.5 rounded transition-all duration-300">
                        Full Curriculum
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                </div>

                <!-- Micro-credentials -->
                <div class="flex flex-wrap gap-4 text-[10px] text-bes-cream/50 tracking-label uppercase">
                    <span>1 Month Residential</span>
                    <span class="text-bes-cream/20">&bull;</span>
                    <span>No Experience Required</span>
                    <span class="text-bes-cream/20">&bull;</span>
                    <span>All-Inclusive</span>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  2 · MANIFESTO — SINGLE COLUMN, LARGE OPENING LINE        ║
         ║  Distinct: Not centered. Left-aligned, editorial prose     ║
         ║  with oversized lead sentence. Magazine feel.              ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-36">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-6">Our Teaching Philosophy</p>

                <!-- Oversized lead sentence -->
                <p class="font-display text-[1.6rem] md:text-[2rem] text-bes-forest-deep tracking-display leading-[1.35] mb-8">
                    You do not need to touch your toes. You do not need a handstand. You do not need to meditate
                    for an hour without thinking. You only need the willingness to begin.
                </p>

                <div class="w-14 h-[2px] bg-bes-gold mb-8"></div>

                <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                    Many approach a 200-hour training seeking a certificate. At Pasraman Bali Eling Spirit, we believe
                    you cannot authentically guide others until you have navigated your own inner landscape with
                    honesty and courage. This training is designed as much for your personal transformation as it
                    is for your professional development &mdash; because the two are inseparable.
                </p>
                <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                    Over one month of intensive residential immersion, guided directly by <strong>Ida Sri Bhagawan
                    Sriprada Bhaskara</strong> and a faculty of masters who have practised yoga and spiritual
                    discipline for decades, you will deconstruct your physical practice and rebuild it from the
                    foundation up &mdash; with precise alignment, profound energetic awareness, and an understanding
                    of the three sacred body layers: <em>Sthula Sarira</em> (the physical body), <em>Sukshma Sarira</em>
                    (the subtle body of energy and emotion), and <em>Antah Karana Sarira</em> (the causal body of the soul).
                </p>
                <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95]">
                    The curriculum follows international standards set by Yoga Alliance, the World Yoga Federation,
                    and Yoga Alliance International &mdash; yet it is anchored in something no generic programme can
                    offer: the living wisdom of local Indonesian tradition, the healing power of Bali Hatha Yoga
                    that has been demonstrated to cure a remarkable range of physical and psychological conditions,
                    and the mysterious force the Balinese call <em>Taksu</em> &mdash; the spiritual charisma that
                    electrifies a truly authentic teacher. We provide the sacred container. You provide the courage
                    to enter.
                </p>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  3 · STATS — CIRCULAR BADGES IN A ROW                     ║
         ║  Distinct: Not stacked counters (300H), not horizontal     ║
         ║  bar (Tapa Brata). Circle badges with ring borders.        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-14 md:py-18">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                <?php
                $stats = [
                    ['num'=>'200','sub'=>'Hours','label'=>'Contact Training'],
                    ['num'=>'4','sub'=>'Parwa','label'=>'Progressive Modules'],
                    ['num'=>'22','sub'=>'Subjects','label'=>'Complete Curriculum'],
                    ['num'=>'3','sub'=>'Bodies','label'=>'Global Accreditations'],
                    ['num'=>'∞','sub'=>'','label'=>'Lifelong Mentorship'],
                ];
                foreach ( $stats as $idx => $s ) : ?>
                <div class="reveal-item opacity-0 scale-90 transition-all duration-700 ease-out text-center" style="transition-delay:<?php echo $idx * 80; ?>ms;">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full border-2 border-bes-gold/30 flex flex-col items-center justify-center mx-auto mb-2">
                        <span class="font-display text-2xl md:text-3xl !text-bes-gold leading-none"><?php echo $s['num']; ?></span>
                        <?php if ( $s['sub'] ) : ?>
                        <span class="text-[9px] text-bes-cream/50 tracking-label uppercase leading-none mt-0.5"><?php echo $s['sub']; ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="text-[9px] text-bes-cream/50 tracking-label uppercase leading-snug"><?php echo $s['label']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  4 · THE FOUR PARWAS — STACKED FULL-WIDTH PANELS          ║
         ║  Distinct: NOT zig-zag (old 200H/300H), NOT grid (new     ║
         ║  300H). Full-width stacked panels with big Parwa number    ║
         ║  on left, content center, image right. Each has distinct   ║
         ║  background tone.                                          ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section id="ytt-parwas" class="bg-bes-parchment">
        <div class="max-w-6xl mx-auto px-6 md:px-10 pt-24 md:pt-36 pb-8">
            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Sacred Structure</p>
                <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-3">
                    Four Parwas. One Transformation.
                </h2>
                <p class="text-base text-bes-bark leading-relaxed max-w-2xl">
                    The 200-hour curriculum is structured as four progressive <em>Parwas</em> (modules), each
                    50 hours of intensive study. Every Parwa can also be taken independently &mdash; building
                    toward full certification at your own pace, within a maximum of four years.
                </p>
            </div>
        </div>

        <?php
        $parwas = [
            [
                'num'    => 'Parwa I',
                'hours'  => '50 Hours · Week 1',
                'title'  => 'Technique, Training &amp; Practice',
                'focus'  => 'The Foundation of Movement &amp; Breath',
                'img'    => 'https://images.unsplash.com/photo-1545389336-cf090694435e?w=700&h=500&q=80&auto=format&fit=crop&crop=center',
                'alt'    => 'Yoga practitioner in Surya Namaskar sun salutation at dawn',
                'bg'     => 'bg-bes-parchment',
                'subjects'=> [
                    ['bold'=>'Surya Namaskar &amp; Asanas','text'=>'History, alignment, adjustment, and therapeutic benefits of every foundational posture — deconstructed, practised, and embodied through daily morning sessions of Bali Hatha and Vinyasa.'],
                    ['bold'=>'Pranayama &amp; Subtle Body','text'=>'Breathing architectures that shift your nervous system. Introduction to <em>Panca Maya Kosha</em> (the five sheaths) and the seven chakras — understanding energy as a practitioner, not just a concept.'],
                    ['bold'=>'Meditation &amp; Yoga Nidra','text'=>'The history and hands-on practice of mindfulness meditation and the profoundly restorative science of Yoga Nidra (psychic sleep). You will learn to guide both for yourself and for future students.'],
                ],
            ],
            [
                'num'    => 'Parwa II',
                'hours'  => '50 Hours · Week 2',
                'title'  => 'Anatomy, Physiology &amp; Science',
                'focus'  => 'Understanding the Architecture of the Human Body',
                'img'    => 'https://images.unsplash.com/photo-1574689049864-7585c5452d3a?w=700&h=500&q=80&auto=format&fit=crop&crop=center',
                'alt'    => 'Students studying anatomy and alignment in hands-on yoga adjustment workshop',
                'bg'     => 'bg-white',
                'subjects'=> [
                    ['bold'=>'Anatomy (10 Hours)','text'=>'The skeletal and muscular systems made practical for yoga. You will learn the anatomy of every major joint, the mechanics of safe movement, and how to identify misalignment in your students before it becomes injury.'],
                    ['bold'=>'Physiology &amp; Biomechanics (20 Hours)','text'=>'How the respiratory, circulatory, and nervous systems respond to asana, pranayama, and meditation. The science behind why Bali Hatha Yoga produces measurable healing outcomes — translated into language you can share confidently.'],
                    ['bold'=>'Yoga History &amp; Philosophy (5 Hours)','text'=>'From the Vedic origins through the Bhagavad Gita and Patanjali&rsquo;s Eight Limbs to the modern global movement. You will understand the lineage you are entering and the responsibility that comes with carrying this wisdom forward.'],
                ],
            ],
            [
                'num'    => 'Parwa III',
                'hours'  => '50 Hours · Week 3',
                'title'  => 'Energetic Mastery &amp; Ethics',
                'focus'  => 'The Subtle Toolkit &amp; Moral Compass',
                'img'    => 'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=700&h=500&q=80&auto=format&fit=crop&crop=center',
                'alt'    => 'Tibetan singing bowls used in sound healing and energetic practice at the Pasraman',
                'bg'     => 'bg-bes-parchment',
                'subjects'=> [
                    ['bold'=>'Yantra, Mudra &amp; Bandhas','text'=>'The sacred geometries, hand seals, and energetic locks that direct prana through the subtle body. These powerful techniques transform a basic yoga class into a genuine energetic experience.'],
                    ['bold'=>'Chanting, Mantra &amp; Agni Hotra','text'=>'The vibrational science of sacred sound. You will learn traditional mantras, participate in the Agni Hotra fire ceremony, and understand how chanting physically restructures the nervous system.'],
                    ['bold'=>'Yin Yoga &amp; Restorative + Ethics','text'=>'The contemplative and deeply therapeutic dimensions of yoga. Yin targets the fascial body and emotional storage; Restorative activates the parasympathetic nervous system. Combined with a thorough study of professional yoga ethics.'],
                ],
            ],
            [
                'num'    => 'Parwa IV',
                'hours'  => '50 Hours · Week 4',
                'title'  => 'The Complete Teacher',
                'focus'  => 'From Student to Guide. From Practice to Profession.',
                'img'    => 'https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?w=700&h=500&q=80&auto=format&fit=crop&crop=center',
                'alt'    => 'Yoga teacher training practicum — student confidently leading a class at the Pasraman shala',
                'bg'     => 'bg-white',
                'subjects'=> [
                    ['bold'=>'Teaching Methodology &amp; Practicum','text'=>'The art of intelligent sequencing (<em>Hatha-Vinyasa Krama</em>), clear verbal cueing, safe hands-on alignment and adjustment, and extensive supervised practicum sessions where you teach your peers and receive detailed faculty feedback.'],
                    ['bold'=>'Tri Hita Karana &amp; Balinese Wisdom','text'=>'The ancient Balinese philosophy of threefold harmony — with God, with nature, with others. Plus Hindu Dharma cosmology, the secrets of Balinese <em>Taksu</em>, and introductions to Ayurveda, traditional <em>Jamu</em> medicine, and <em>Taru Pramana</em> herbal healing.'],
                    ['bold'=>'Life Mastery &amp; Professional Development','text'=>'Acro Yoga for connection and trust-building. Goal setting, professional development in the global yoga industry, building your teaching identity, and the practical foundations for a sustainable, ethical career. You graduate ready — not just certified.'],
                ],
            ],
        ];

        foreach ( $parwas as $idx => $p ) : ?>
        <div class="<?php echo $p['bg']; ?> py-12 md:py-16 border-t border-bes-bark-muted/10">
            <div class="max-w-6xl mx-auto px-6 md:px-10">
                <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                    <!-- Left: Parwa identifier -->
                    <div class="lg:col-span-3 reveal-item opacity-0 -translate-x-6 transition-all duration-700 ease-out">
                        <span class="font-display text-6xl md:text-7xl text-bes-forest-deep/8 leading-none block"><?php echo str_pad($idx + 1, 2, '0', STR_PAD_LEFT); ?></span>
                        <p class="font-display text-lg !text-bes-gold tracking-display mt-1"><?php echo $p['num']; ?></p>
                        <p class="text-[10px] text-bes-olive tracking-label uppercase"><?php echo $p['hours']; ?></p>
                        <div class="hidden lg:block mt-6 rounded-lg overflow-hidden shadow-md group">
                            <img src="<?php echo esc_url( $p['img'] ); ?>"
                                 onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20','min-h-[160px]');"
                                 alt="<?php echo esc_attr( strip_tags( $p['alt'] ) ); ?>"
                                 class="w-full h-44 object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                        </div>
                    </div>

                    <!-- Right: content -->
                    <div class="lg:col-span-9 reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out" style="transition-delay:100ms;">
                        <h3 class="font-display text-2xl md:text-[1.75rem] text-bes-forest-deep tracking-display leading-snug mb-1"><?php echo $p['title']; ?></h3>
                        <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-6"><?php echo $p['focus']; ?></p>

                        <div class="space-y-5">
                            <?php foreach ( $p['subjects'] as $s ) : ?>
                            <div class="flex gap-4 items-start">
                                <div class="w-1.5 h-1.5 rounded-full bg-bes-gold mt-2.5 shrink-0"></div>
                                <div>
                                    <p class="text-sm text-bes-forest-deep font-semibold mb-1"><?php echo $s['bold']; ?></p>
                                    <p class="text-sm text-bes-bark leading-[1.8]"><?php echo $s['text']; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  5 · PHOTO STRIP — HORIZONTAL BAND OF IMAGES              ║
         ║  Distinct: Not mosaic (Tapa Brata), not full-width break   ║
         ║  (300H). A narrow horizontal strip of 5 equal images.      ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-0">
            <?php
            $strip_imgs = [
                ['src'=>'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&h=300&q=75&auto=format&fit=crop&crop=center','alt'=>'Morning yoga practice in a tropical shala'],
                ['src'=>'https://images.unsplash.com/photo-1608228079968-4b3df28f8f78?w=400&h=300&q=75&auto=format&fit=crop&crop=center','alt'=>'Tibetan singing bowls and sound healing ceremony'],
                ['src'=>'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?w=400&h=300&q=75&auto=format&fit=crop&crop=center','alt'=>'Golden sunrise over Bali rice terraces near the Pasraman'],
                ['src'=>'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&h=300&q=75&auto=format&fit=crop&crop=center','alt'=>'Group meditation practice in a serene natural setting'],
                ['src'=>'https://images.unsplash.com/photo-1575052814086-f385e2e2ad1b?w=400&h=300&q=75&auto=format&fit=crop&crop=center','alt'=>'Hands-on yoga adjustment and alignment training'],
            ];
            foreach ( $strip_imgs as $si ) : ?>
            <div class="overflow-hidden aspect-[4/3]">
                <img src="<?php echo esc_url( $si['src'] ); ?>"
                     onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');"
                     alt="<?php echo esc_attr( $si['alt'] ); ?>"
                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-700" loading="lazy" />
            </div>
            <?php endforeach; ?>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  6 · DAILY RHYTHM — COMPACT TABLE LAYOUT                  ║
         ║  Distinct: NOT timeline (old 200H/300H), NOT block grid    ║
         ║  (new 300H). Clean two-column table rows.                  ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-24 md:py-32">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-12">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-2">A Day in the Life</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display">
                    The Rhythm of Discovery
                </h2>
                <p class="text-sm text-bes-cream/60 max-w-lg mx-auto mt-3 leading-relaxed">
                    Physical intensity balanced with deep restorative practice and study.
                    Enough rigour to transform you, enough rest to sustain you.
                </p>
            </div>

            <div class="space-y-0">
                <?php
                $schedule = [
                    ['time'=>'06:00 – 08:00','title'=>'Morning Sadhana','desc'=>'Guided pranayama, meditation, and vigorous Bali Hatha Yoga asana practice to awaken the body and settle the mind.'],
                    ['time'=>'08:00 – 09:00','title'=>'Nourishing Breakfast','desc'=>'Fresh tropical fruits, plant-based bowls, Balinese herbal tea — satwik food to fuel the morning study.'],
                    ['time'=>'09:30 – 12:00','title'=>'Anatomy &amp; Alignment Lab','desc'=>'Deconstructing postures biomechanically, understanding safe movement, learning hands-on adjustment techniques.'],
                    ['time'=>'12:00 – 13:30','title'=>'Lunch &amp; Integration','desc'=>'Vegetarian meals from the Pasraman kitchen, plus time for journaling, personal reflection, and rest.'],
                    ['time'=>'14:00 – 16:00','title'=>'Philosophy &amp; Sacred Study','desc'=>'Yoga Sutras, Bhagavad Gita, Balinese cosmology, Tri Hita Karana. Understanding the wisdom lineage.'],
                    ['time'=>'16:00 – 18:00','title'=>'Practicum &amp; Workshops','desc'=>'Teaching practice with peer feedback, specialty workshops in Yin, Restorative, Chanting, or Agni Hotra ceremony.'],
                    ['time'=>'18:30 – 19:30','title'=>'Evening Satsang','desc'=>'Optional gathering for reflection, kirtan, or Yoga Nidra deep relaxation. The 24-hour kitchen remains open.'],
                ];
                foreach ( $schedule as $idx => $s ) : ?>
                <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out grid grid-cols-12 gap-4 py-4 border-b border-bes-cream/8 items-start" style="transition-delay:<?php echo $idx * 40; ?>ms;">
                    <div class="col-span-4 sm:col-span-3">
                        <p class="font-display text-sm !text-bes-gold leading-snug"><?php echo $s['time']; ?></p>
                    </div>
                    <div class="col-span-8 sm:col-span-9">
                        <p class="text-sm text-bes-cream font-semibold mb-0.5"><?php echo $s['title']; ?></p>
                        <p class="text-xs text-bes-cream/50 leading-relaxed"><?php echo $s['desc']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  7 · WHO IS THIS FOR — PERSONA CARDS                      ║
         ║  Distinct: Not checklist (old 200H/300H). Cards            ║
         ║  representing different types of people who attend.         ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">An Open Invitation</p>
                <h2 class="font-display text-3xl md:text-[2.4rem] text-bes-forest-deep tracking-display leading-snug mb-3">
                    This Training Is For You.
                </h2>
                <p class="text-base text-bes-bark leading-relaxed max-w-2xl">
                    No prior yoga experience is required. Whether you are 15 or 60, a complete beginner or a
                    seasoned practitioner, the Pasraman welcomes you. These are the people who come &mdash; and
                    leave transformed.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                $personas = [
                    [
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'title'=> 'The Seeker',
                        'who'  => 'Professionals, entrepreneurs, &amp; life coaches',
                        'text' => 'You feel the pull toward something deeper. Maybe your career is thriving but your soul feels hollow. You come to the mat not to teach, but to heal &mdash; and in healing yourself, you discover a gift you never expected.',
                    ],
                    [
                        'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'title'=> 'The Healer',
                        'who'  => 'Spa therapists, caregivers, &amp; spiritual guides',
                        'text' => 'You already work with bodies and energy. Now you want a systematic, internationally accredited framework to deepen your healing toolkit &mdash; learning anatomy, pranayama, and the subtle body from masters who live their practice.',
                    ],
                    [
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'title'=> 'The Student',
                        'who'  => 'University students, young adults, &amp; gap-year travellers',
                        'text' => 'You are at a crossroads. This training gives you direction, discipline, and a globally recognised qualification &mdash; plus an experience in Bali that will reshape how you see the world and your place in it. Ages 15 and up welcome.',
                    ],
                    [
                        'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                        'title'=> 'The Homemaker',
                        'who'  => 'Parents, housewives, &amp; community anchors',
                        'text' => 'You hold everything together for everyone else. This month is yours. Learn to practise yoga independently, teach meditation to your family, and return home with tools for holistic health that ripple outward through your entire household.',
                    ],
                    [
                        'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'title'=> 'The Career Changer',
                        'who'  => 'Teachers, civil servants, &amp; hospitality workers',
                        'text' => 'You are ready for something meaningful. With an RYT-200 certification accredited by three international bodies, you graduate with the credential and the confidence to teach yoga anywhere in the world &mdash; or to bring it into your current profession.',
                    ],
                    [
                        'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                        'title'=> 'The Future Teacher',
                        'who'  => 'Dedicated practitioners ready to guide others',
                        'text' => 'You have been practising and you know this is your path. This programme builds the anatomical precision, vocal confidence, and sequencing mastery to safely lead a room &mdash; plus the spiritual depth that separates a good teacher from a great one.',
                    ],
                ];
                foreach ( $personas as $idx => $pe ) :
                    $delay = min($idx * 80, 350);
                ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out bg-white rounded-lg p-6 border border-bes-parchment hover:shadow-lg hover:-translate-y-1 transition-all" style="transition-delay:<?php echo $delay; ?>ms;">
                    <div class="w-10 h-10 rounded-full bg-bes-gold/10 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $pe['icon']; ?>"/></svg>
                    </div>
                    <h4 class="font-display text-lg text-bes-forest-deep mb-0.5"><?php echo $pe['title']; ?></h4>
                    <p class="text-[10px] text-bes-olive tracking-label uppercase mb-3"><?php echo $pe['who']; ?></p>
                    <p class="text-xs text-bes-bark leading-[1.75]"><?php echo $pe['text']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  8 · WHAT'S INCLUDED — SPLIT CARD (LIST + HIGHLIGHT)      ║
         ║  Distinct: NOT alternating icon rows (300H). Single        ║
         ║  two-column card: practical list left, highlight right.    ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">All-Inclusive</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Everything Is Provided.
                </h2>
            </div>

            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <div class="grid md:grid-cols-5 gap-0 bg-white rounded-xl overflow-hidden shadow-lg border border-bes-parchment">

                    <!-- Left column: facilities -->
                    <div class="md:col-span-3 p-8 md:p-10">
                        <h3 class="font-display text-xl text-bes-forest-deep mb-6">Facilities &amp; Materials</h3>
                        <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4">
                            <?php
                            $facilities = [
                                'Accommodation (AC, en-suite bathroom)',
                                '3× vegetarian meals daily',
                                'Pasraman Bali Eling Spirit uniform',
                                'Comprehensive training modules',
                                'Goodie bag with stationery',
                                'Personal yoga mat',
                                '24-hour open kitchen access',
                                'Professional documentation photos',
                            ];
                            foreach ( $facilities as $f ) : ?>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-bes-forest shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-bes-bark"><?php echo $f; ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Right column: certification highlight -->
                    <div class="md:col-span-2 bg-bes-forest-deep p-8 md:p-10 text-bes-parchment flex flex-col justify-between">
                        <div>
                            <h3 class="font-display text-xl mb-4">Your Certification</h3>
                            <p class="text-sm text-bes-cream/70 leading-relaxed mb-6">
                                Upon successful graduation, you are eligible to register as an <strong class="!text-bes-gold">RYT-200</strong>
                                with three internationally recognised accreditation bodies:
                            </p>
                            <div class="space-y-3 mb-6">
                                <?php
                                $certs = ['Yoga Alliance (USA)','World Yoga Federation','Yoga Alliance International (India)'];
                                foreach ( $certs as $c ) : ?>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    <span class="text-sm"><?php echo $c; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-bes-cream/40 leading-relaxed">
                                You also become a lifelong member of the <em>Sisya Bhawana</em> community at Pasraman
                                Bali Eling Spirit &mdash; with unlimited access to ongoing mentorship and future programmes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  9 · SACRED EXPERIENCES — HORIZONTAL SCROLL STRIP          ║
         ║  Distinct: Small cards in a row for ceremonial elements.   ║
         ║  NOT activity grid (Tapa Brata).                           ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-12">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-2">Beyond the Mat</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Sacred Experiences Included
                </h2>
                <p class="text-sm text-bes-bark max-w-lg mx-auto mt-3">
                    These are not add-ons. They are woven into the fabric of your training.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $ceremonies = [
                    ['title'=>'Melukat Water Purification','text'=>'Traditional Balinese holy water cleansing ceremony. Physical and energetic purification at sacred water sources near the Pasraman. A profoundly moving ritual of release.','icon'=>'M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z'],
                    ['title'=>'Agni Hotra Fire Ceremony','text'=>'Ancient Vedic fire ritual at both the opening and closing of training. Offerings are made to the sacred flame as intentions are set and gratitude is expressed for the transformation undergone.','icon'=>'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z'],
                    ['title'=>'Tibetan Sound Healing','text'=>'Deep vibrational therapy using singing bowls, gongs, and tuning instruments. Sound waves penetrate the cellular level, releasing stored tension and recalibrating the nervous system.','icon'=>'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z'],
                    ['title'=>'7-Chakra Activation','text'=>'Guided purification ceremony combining holy water, sacred mantras, meditation energy, and crystal placements to cleanse and activate each of the seven primary energy centres.','icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                ];
                foreach ( $ceremonies as $idx => $c ) : ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out bg-white rounded-lg p-5 border border-bes-bark-muted/10" style="transition-delay:<?php echo $idx * 80; ?>ms;">
                    <svg class="w-7 h-7 !text-bes-gold mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $c['icon']; ?>"/></svg>
                    <h4 class="font-display text-sm text-bes-forest-deep leading-snug mb-2"><?php echo $c['title']; ?></h4>
                    <p class="text-xs text-bes-bark leading-[1.75]"><?php echo $c['text']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  10 · TESTIMONIALS — OFFSET OVERLAPPING CARDS              ║
         ║  Distinct: NOT equal 3-col (Tapa Brata), NOT large+2       ║
         ║  (300H). Two staggered testimonial cards with offset.      ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-12">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Voices from the Pasraman</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Their Words. Your Future.
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6 md:gap-8">
                <!-- Card 1 — slightly raised -->
                <div class="reveal-item opacity-0 -translate-x-6 transition-all duration-700 ease-out md:-mt-4">
                    <div class="bg-white rounded-xl p-7 shadow-md border border-bes-parchment relative">
                        <svg class="absolute -top-3 -left-2 w-8 h-8 !text-bes-gold/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-sm text-bes-bark leading-[1.8] mb-5 relative z-10">
                            An extraordinary experience. The journey was wonderful, the fellow participants were
                            so kind and supportive, and Aji and Bu Jro along with the yogi team were warm and
                            full of compassion. May all beings be happy.
                        </p>
                        <p class="font-display text-sm text-bes-forest-deep">Ergulina Mahadiarta</p>
                        <p class="text-[10px] text-bes-bark-muted tracking-wider uppercase">Pasraman Participant</p>
                    </div>
                </div>

                <!-- Card 2 — slightly lowered -->
                <div class="reveal-item opacity-0 translate-x-6 transition-all duration-700 ease-out md:mt-4" style="transition-delay:150ms;">
                    <div class="bg-white rounded-xl p-7 shadow-md border border-bes-parchment relative">
                        <svg class="absolute -top-3 -left-2 w-8 h-8 !text-bes-gold/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-sm text-bes-bark leading-[1.8] mb-5 relative z-10">
                            The class was truly amazing — it deeply awakened my spirituality which was almost fading.
                            Especially meditating in nature, the positive energy was immense with incredibly
                            pure oxygen. An unforgettable moment for all of us. Simply extraordinary.
                        </p>
                        <p class="font-display text-sm text-bes-forest-deep">Rostini Pho</p>
                        <p class="text-[10px] text-bes-bark-muted tracking-wider uppercase">Training Participant</p>
                    </div>
                </div>

                <!-- Card 3 — centered below -->
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out md:col-span-2 md:max-w-lg md:mx-auto" style="transition-delay:250ms;">
                    <div class="bg-white rounded-xl p-7 shadow-md border border-bes-parchment relative">
                        <svg class="absolute -top-3 -left-2 w-8 h-8 !text-bes-gold/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-sm text-bes-bark leading-[1.8] mb-5 relative z-10">
                            A great place that made me learn a lot to change myself completely. Everyone was very kind and
                            gave positive vibes. Truly a blessing to know this place — the healing retreat experience changed
                            the way I see myself. The energy stays with you long after you leave.
                        </p>
                        <p class="font-display text-sm text-bes-forest-deep">Tina Rosemayanti &amp; Aulia Wijayanti</p>
                        <p class="text-[10px] text-bes-bark-muted tracking-wider uppercase">Pasraman Alumni</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  11 · YOUR NEXT STEP — 200H → 300H PROGRESSION            ║
         ║  Distinct: Comparison card showing what comes next.        ║
         ║  Not used in any other shortcode.                          ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-12">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Lifelong Journey</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    This Is Just the Beginning.
                </h2>
                <p class="text-sm text-bes-bark max-w-lg mx-auto mt-3 leading-relaxed">
                    The 200-hour certification opens the door. Where you go from here is up to you.
                </p>
            </div>

            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out grid md:grid-cols-2 gap-0 rounded-xl overflow-hidden shadow-lg">

                <!-- Current: 200H -->
                <div class="bg-white p-8 md:p-10 border-b md:border-b-0 md:border-r border-bes-parchment">
                    <span class="inline-block bg-bes-gold text-bes-forest-deep text-[9px] font-semibold tracking-label uppercase px-3 py-1 rounded-full mb-4">Start Here</span>
                    <h3 class="font-display text-2xl text-bes-forest-deep tracking-display mb-2">200-Hour YTT</h3>
                    <p class="text-xs text-bes-olive tracking-label uppercase mb-4">1 Month · Foundational Certification</p>
                    <p class="text-sm text-bes-bark leading-[1.8] mb-5">
                        Build your complete foundation: alignment, anatomy, philosophy, teaching methodology,
                        Balinese spiritual practice. Graduate as an RYT-200 ready to practise independently
                        and teach yoga to family, friends, and community.
                    </p>
                    <p class="text-xs text-bes-olive italic">22 subjects across 4 progressive Parwas</p>
                </div>

                <!-- Next: 300H -->
                <div class="bg-bes-forest-deep p-8 md:p-10 text-bes-parchment">
                    <span class="inline-block border border-bes-gold/30 !text-bes-gold text-[9px] font-semibold tracking-label uppercase px-3 py-1 rounded-full mb-4">What Comes Next</span>
                    <h3 class="font-display text-2xl tracking-display mb-2">300-Hour Advanced YTT</h3>
                    <p class="text-xs text-bes-cream/50 tracking-label uppercase mb-4">1 Month · Mastery Certification · RYT-500</p>
                    <p class="text-sm text-bes-cream/70 leading-[1.8] mb-5">
                        Advance into yoga therapy, subtle body mastery, sacred scripture study, and
                        professional teaching leadership. Combined with your 200H, you achieve the highest
                        global standard: RYT-500.
                    </p>
                    <a href="/300-hour-yoga-teacher-training/"
                       class="inline-flex items-center gap-2 !text-bes-gold text-xs hover:underline">
                        Explore 300H Training
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  12 · FAQ                                                  ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Your Questions, Answered</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Frequently Asked Questions
                </h2>
            </div>

            <?php
            $faqs = [
                [
                    'q' => 'Do I need yoga experience to join the 200-hour training?',
                    'a' => 'No. The 200-hour programme is designed to welcome complete beginners alongside experienced practitioners. We recommend having a consistent physical activity practice of at least six months, but an open heart and willingness to learn are the only true prerequisites. Students of all backgrounds — professionals, parents, students, therapists, teachers — have completed this training successfully.',
                ],
                [
                    'q' => 'Can I take just one 50-hour Parwa at a time?',
                    'a' => 'Yes. The 200-hour curriculum is divided into four Parwas (modules) of 50 hours each. You may begin with Parwa I and return for subsequent modules at your own pace. The only requirement is that all four Parwas must be completed within a four-year window to receive the full 200-hour certification.',
                ],
                [
                    'q' => 'Is this training connected to a particular religion?',
                    'a' => 'No. While the training is deeply rooted in Balinese Hindu spiritual tradition and draws from ancient Vedic texts, it is built on universal foundations: yoga, meditation, and holistic self-awareness. Participants of all faiths and backgrounds are welcome and will find profound value in the experience.',
                ],
                [
                    'q' => 'What certification will I receive?',
                    'a' => 'Upon successful completion of all four Parwas (200 hours), you receive a Yoga Teacher Training certificate accredited by Yoga Alliance (USA), World Yoga Federation, and Yoga Alliance International (India). This allows you to register as an RYT-200 and teach yoga globally.',
                ],
                [
                    'q' => 'Do I need to be vegetarian?',
                    'a' => 'During training, all meals are satwik (sattvic) vegetarian — prepared without animal meat to support the energetic and spiritual demands of intensive practice. Outside of training, vegetarianism is a personal choice. Many participants find their dietary preferences naturally shift through the awareness cultivated during the programme.',
                ],
                [
                    'q' => 'Must I stay at the Pasraman for the entire month?',
                    'a' => 'Yes. Full residential immersion is required for the duration of your training. The Pasraman provides clean, air-conditioned accommodation with en-suite bathrooms, three daily meals, and a 24-hour open kitchen. The protected environment is essential to the depth of the experience.',
                ],
                [
                    'q' => 'What age range is accepted?',
                    'a' => 'The training is open to both men and women aged 15 to 60. Minimum education level is SMA/SMK equivalent. Students under 18 require written parental consent, and married participants require written spousal consent, as per Indonesian regulations.',
                ],
                [
                    'q' => 'Is there ongoing support after graduation?',
                    'a' => 'Absolutely. Upon completion, you become a lifelong member of the Sisya Bhawana community at Pasraman Bali Eling Spirit. You receive unlimited access to ongoing mentorship from the master faculty, participation in future programmes, and structured guidance as you develop your practice and teaching career.',
                ],
            ];
            foreach ( $faqs as $idx => $faq ) : ?>
            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out border-b border-bes-bark-muted/15 ytt200-faq-item" style="transition-delay:<?php echo $idx * 40; ?>ms;">
                <button class="w-full flex items-center justify-between py-5 text-left ytt200-faq-btn" aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>">
                    <span class="font-display text-base md:text-lg text-bes-forest-deep pr-4"><?php echo $faq['q']; ?></span>
                    <svg class="w-5 h-5 text-bes-olive shrink-0 transition-transform duration-300 ytt200-faq-icon <?php echo $idx === 0 ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="ytt200-faq-body overflow-hidden transition-all duration-300 <?php echo $idx === 0 ? 'max-h-96 pb-5' : 'max-h-0'; ?>">
                    <p class="text-sm text-bes-bark leading-[1.8]"><?php echo $faq['a']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  13 · FINAL CTA — FULL-BLEED IMAGE WITH CENTERED TEXT     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-28 md:py-40 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1552858725-2758b5fb1286?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1490730141103-6cac27aaab94?w=1400&q=70&auto=format&fit=crop';"
                 alt="Hands joined in Anjali Mudra during meditation at golden hour, embodying the spirit of yoga teacher training"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/88"></div>
        </div>

        <div class="relative z-10 text-center max-w-3xl mx-auto px-6 md:px-10">
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display italic !text-bes-gold-soft text-base md:text-lg mb-4">
                &ldquo;Difficulties teach that goodness takes time to process. Yoga is
                learning to accept imperfection in a perfect way.&rdquo;
            </p>
            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display text-3xl md:text-[3.5rem] text-bes-parchment tracking-display leading-[1.1] mb-5" style="transition-delay:100ms;">
                Your Transformation<br>
                Begins on the Mat.
            </h2>
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-base md:text-lg text-bes-cream/75 leading-relaxed mb-10 max-w-xl mx-auto" style="transition-delay:200ms;">
                Give yourself one month. One sacred container. One chance to build a foundation
                that will sustain your practice &mdash; and your life &mdash; for decades to come.
            </p>

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out flex flex-col sm:flex-row gap-4 justify-center" style="transition-delay:300ms;">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-3 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Begin Your 200H Journey
                </a>
                <a href="/yoga-teacher-training/"
                   class="inline-flex items-center justify-center gap-2 border border-bes-parchment/25 hover:border-bes-parchment/50
                          text-bes-parchment font-body text-sm px-8 py-4 rounded transition-all duration-300">
                    View All YTT Levels
                </a>
            </div>
            <p class="reveal-item opacity-0 transition-opacity duration-700 text-xs text-bes-cream/40 mt-6" style="transition-delay:400ms;">
                <?php echo esc_html( $a['dates'] ); ?> &middot; 1-month residential &middot; Br. Umadawa, Pejeng Kangin, Gianyar, Bali &middot; +62 812 2888 8873
            </p>
        </div>
    </section>


    </div><!-- /.bes-200ytt -->


    <!-- ─── JS: scroll reveal + FAQ accordion (vanilla, no deps) ─── -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        /* — Scroll reveal — */
        var io = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.classList.remove(
                        'opacity-0','translate-y-8','translate-y-6','translate-y-4',
                        'translate-x-12','-translate-x-12','translate-x-8','-translate-x-8',
                        'translate-x-6','-translate-x-6','scale-95','scale-90'
                    );
                    e.target.classList.add('opacity-100','translate-y-0','translate-x-0','scale-100');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.bes-200ytt .reveal-item').forEach(function(el){ io.observe(el); });

        /* — FAQ accordion — */
        document.querySelectorAll('.ytt200-faq-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var item = btn.closest('.ytt200-faq-item');
                var body = item.querySelector('.ytt200-faq-body');
                var icon = item.querySelector('.ytt200-faq-icon');
                var open = btn.getAttribute('aria-expanded') === 'true';

                document.querySelectorAll('.ytt200-faq-btn').forEach(function(b) {
                    b.setAttribute('aria-expanded','false');
                    b.closest('.ytt200-faq-item').querySelector('.ytt200-faq-body').classList.remove('max-h-96','pb-5');
                    b.closest('.ytt200-faq-item').querySelector('.ytt200-faq-body').classList.add('max-h-0');
                    b.closest('.ytt200-faq-item').querySelector('.ytt200-faq-icon').classList.remove('rotate-180');
                });

                if (!open) {
                    btn.setAttribute('aria-expanded','true');
                    body.classList.remove('max-h-0');
                    body.classList.add('max-h-96','pb-5');
                    icon.classList.add('rotate-180');
                }
            });
        });
    });
    </script>

    <?php
    return ob_get_clean();
}