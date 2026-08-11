<?php
/**
 * ──────────────────────────────────────────────────────────────
 *  Shortcode : [bes_300h_ytt]
 *  Page      : /300-hour-yoga-teacher-training/
 *  Brand     : Eling Sanctuary · Bali Eling Spirit Group
 * ──────────────────────────────────────────────────────────────
 *  Program   : 300-Hour Advanced Yoga Teacher Training
 *  Duration  : 4 Weeks (28 days residential)
 *  Prerequisite : 200-Hour YTT Certification
 *  Certification: RYT-500 eligible upon completion
 *  Accreditation: Yoga Alliance (USA), World Yoga Federation,
 *                 Yoga Alliance International (India)
 *  Lead Faculty : Ida Sri Bhagawan Sriprada Bhaskara + senior
 *                 masters with decades of practice lineage
 *  Styles    : Bali Hatha Yoga, Vinyasa, Ashtanga, Yin Yoga
 *  Texts     : Bhagavad Gita, Yoga Sutra Patanjali, Hatha Yoga
 *              Pradipika, Gerandha Samhita, Goraksha Samhita,
 *              Siwa Tatwa
 *  Facilities: Accommodation (AC, en-suite), 3× vegetarian meals,
 *              Pasraman uniform, training manual + modules,
 *              yoga mat, 24-hour open kitchen, ceremony access
 *  WhatsApp  : +62 812 2888 8873
 *  Location  : Br. Umadawa, Pejeng Kangin, Tampaksiring,
 *              Gianyar, Bali
 * ──────────────────────────────────────────────────────────────
 *  BES Tailwind tokens loaded by theme — zero re-declaration.
 *  UI pattern: "Academic prospectus" — horizontal curriculum
 *  modules, credential ribbon, teacher profiles, stacked
 *  counters. DISTINCT from all previous shortcodes.
 * ──────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_300h_ytt', 'bes_300h_ytt_render' );

function bes_300h_ytt_render( $atts ) {

    $a = shortcode_atts([
        'wa'    => '6281228888873',
        'price' => '2,850',
        'dates' => 'By Request',
    ], $atts, 'bes_300h_ytt' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I hold a 200HR certification and I am interested in the 300-Hour Advanced Yoga Teacher Training at Pasraman Bali Eling Spirit. Could you share upcoming dates and enrollment details?' );

    ob_start();
    ?>

    <div class="bes-300ytt font-body text-bes-forest-deep overflow-hidden">


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  1 · HERO — OVERSIZED TYPOGRAPHIC WITH CREDENTIAL STRIP   ║
         ║  Distinct: No price card. Giant display type, credential   ║
         ║  badges below headline. Feels like a university page.      ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative min-h-[96vh] flex items-center overflow-hidden bg-bes-forest-deep">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1545389336-cf090694435e?w=1920&h=1080&q=80&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1400&q=70&auto=format&fit=crop';"
                 alt="Yoga practitioners in an open-air bamboo shala at dawn surrounded by tropical forest and golden morning light"
                 class="w-full h-full object-cover opacity-40" loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-r from-bes-forest-deep via-bes-forest-deep/85 to-bes-forest-deep/50"></div>
        </div>

        <div class="relative z-10 w-full py-24 md:py-32 px-6 md:px-10">
            <div class="max-w-6xl mx-auto">

                <!-- Oversized headline block -->
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out max-w-4xl">
                    <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-5">
                        Pasraman Bali Eling Spirit &mdash; Advanced Certification
                    </p>
                    <h1 class="font-display font-light text-[3rem] md:text-[4.5rem] lg:text-[6rem] text-bes-parchment tracking-display leading-[1.0] mb-6">
                        300-Hour<br>
                        <span class="!text-bes-gold">Yoga Teacher</span><br>
                        Training
                    </h1>
                    <p class="text-lg md:text-xl text-bes-cream/80 leading-relaxed max-w-2xl mb-8">
                        You have mastered the foundation. Now, master the alchemy. Under the lifelong guidance of
                        <strong class="text-bes-cream">Ida Sri Bhagawan Sriprada Bhaskara</strong> and masters who have practised
                        spiritual discipline for decades, transform from a competent instructor into a vessel of
                        authentic healing wisdom.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep font-body
                                  font-semibold tracking-label uppercase text-sm px-8 py-4 rounded transition-colors duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                            Apply for Enrollment
                        </a>
                        <a href="#ytt-curriculum"
                           class="inline-flex items-center gap-2 border border-bes-parchment/30 hover:border-bes-parchment/60
                                  text-bes-parchment font-body text-sm px-8 py-4 rounded transition-all duration-300">
                            View Full Curriculum
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Credential strip — horizontal badges -->
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out flex flex-wrap gap-6 items-center border-t border-bes-cream/10 pt-6" style="transition-delay:300ms;">
                    <span class="text-[10px] text-bes-cream/40 tracking-label uppercase">Accredited by</span>
                    <?php
                    $creds = [
                        'Yoga Alliance (USA)',
                        'World Yoga Federation',
                        'Yoga Alliance International (India)',
                    ];
                    foreach ( $creds as $c ) : ?>
                    <span class="inline-flex items-center gap-1.5 text-xs text-bes-cream/70 border border-bes-cream/15 rounded-full px-4 py-1.5">
                        <svg class="w-3.5 h-3.5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <?php echo $c; ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  2 · PHILOSOPHY — ASYMMETRIC TWO-COL WITH PULL QUOTE      ║
         ║  Distinct: Large pull-quote left column, body right.       ║
         ║  Sanskrit sutra opening. No center alignment.              ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-36">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">

                <!-- Left: pull-quote column -->
                <div class="lg:col-span-5 reveal-item opacity-0 -translate-x-8 transition-all duration-1000 ease-out">
                    <p class="font-display italic text-bes-olive/60 text-base mb-4">Yoga Sutra I.1</p>
                    <blockquote class="font-display text-[1.75rem] md:text-[2.2rem] text-bes-forest-deep tracking-display leading-[1.25] mb-5">
                        &ldquo;Atha yoga-anuśāsanam&rdquo;<br>
                        <span class="text-xl md:text-2xl text-bes-olive/80">Now, the discipline<br>of Yoga begins.</span>
                    </blockquote>
                    <div class="w-12 h-[2px] bg-bes-gold mb-5"></div>
                    <p class="font-display italic text-bes-olive text-sm leading-relaxed">
                        &ldquo;Difficulties teach that goodness takes time to process. Yoga is learning
                        to accept imperfection in a perfect way, and the time it takes is a lifetime.&rdquo;
                        <br><span class="text-bes-bark-muted not-italic text-xs mt-1 block">&mdash; Jero Ratni, Co-Founder, Pasraman Bali Eling Spirit</span>
                    </p>
                </div>

                <!-- Right: philosophical body text -->
                <div class="lg:col-span-7 reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out">
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                        Your 200-hour training taught you alignment, cueing, and the mechanics of guiding a safe
                        physical class. That was <em>Sekala</em> &mdash; the visible world of form and technique. The
                        300-hour training at Pasraman Bali Eling Spirit takes you into <em>Niskala</em> &mdash; the invisible
                        realm of energy, consciousness, and the subtle body that the Balinese Hindu tradition has
                        mapped with extraordinary precision over centuries.
                    </p>
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                        Here, you will study directly under <strong>Ida Sri Bhagawan Sriprada Bhaskara</strong> and
                        a faculty of masters who have devoted their entire lives to spiritual discipline &mdash; not as a
                        career choice, but as a calling carried through lineage and decades of dedicated practice.
                        You will examine the body through three sacred layers: <em>Sthula Sarira</em> (the physical body),
                        <em>Sukshma Sarira</em> (the subtle or energetic body), and <em>Antah Karana Sarira</em>
                        (the causal body of the soul) &mdash; what the modern world simplifies as Body, Mind, and Soul.
                    </p>
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95]">
                        Over four intensive residential weeks, you will bridge ancient wisdom from the Bhagavad Gita,
                        Patanjali&rsquo;s Yoga Sutras, the Hatha Yoga Pradipika, the Gherandha Samhita, the Goraksha
                        Samhita, and the Siwa Tatwa with modern anatomical science, advanced teaching methodology,
                        and the unique healing power of Bali Hatha Yoga &mdash; a practice that has been clinically demonstrated
                        to produce measurable healing outcomes across a wide range of physical and psychological conditions.
                        The destination is not a certificate. It is mastery.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  3 · STATS — VERTICAL STACKED COUNTERS ON DARK BAND       ║
         ║  Distinct: NOT horizontal row. 5-column vertical blocks    ║
         ║  with dividers. More "data dashboard" feel.                ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 divide-x divide-bes-cream/10">
                <?php
                $stats = [
                    ['num'=>'300','unit'=>'hours','label'=>'Contact Training'],
                    ['num'=>'28','unit'=>'days','label'=>'Residential Immersion'],
                    ['num'=>'3','unit'=>'bodies','label'=>'Accreditations Worldwide'],
                    ['num'=>'6','unit'=>'texts','label'=>'Sacred Source Scriptures'],
                    ['num'=>'RYT-500','unit'=>'','label'=>'Yoga Alliance Eligible'],
                ];
                foreach ( $stats as $idx => $s ) : ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center py-4 px-3" style="transition-delay:<?php echo $idx * 80; ?>ms;">
                    <p class="font-display text-3xl md:text-4xl !text-bes-gold tracking-display leading-none"><?php echo $s['num']; ?></p>
                    <?php if ( $s['unit'] ) : ?>
                    <p class="font-body text-[10px] text-bes-cream/40 tracking-label uppercase"><?php echo $s['unit']; ?></p>
                    <?php endif; ?>
                    <p class="font-body text-[10px] text-bes-cream/60 tracking-label uppercase mt-2 leading-snug"><?php echo $s['label']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  4 · CURRICULUM — NUMBERED CARD GRID (2×3)                ║
         ║  Distinct: Flat numbered module cards in grid,             ║
         ║  NOT zig-zag, NOT accordion, NOT timeline.                 ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section id="ytt-curriculum" class="bg-bes-parchment py-24 md:py-36">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Advanced Syllabus</p>
                <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-4">
                    Six Pillars of Mastery
                </h2>
                <p class="text-base text-bes-bark leading-relaxed max-w-2xl">
                    Building upon the comprehensive foundation of the 200-hour curriculum, the advanced
                    training is structured into six deeply immersive modules &mdash; each designed to develop
                    a specific dimension of mastery.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $modules = [
                    [
                        'num'   => '01',
                        'title' => 'Advanced Asana &amp; Bali Hatha Yoga',
                        'tags'  => 'Surya Namaskar · Vinyasa Krama · Ashtanga · Yin',
                        'body'  => 'Move far beyond the standard sequences. You will deconstruct complex apex postures through biomechanical analysis, master the art of <em>Vinyasa Krama</em> (intelligent progression), and study the distinctive Bali Hatha Yoga tradition that has been clinically proven to produce measurable healing outcomes. This module integrates classical Hatha, dynamic Vinyasa, disciplined Ashtanga, and contemplative Yin into a unified, deeply embodied teaching practice.',
                        'accent'=> 'border-t-4 border-t-bes-gold',
                    ],
                    [
                        'num'   => '02',
                        'title' => 'Functional Anatomy &amp; Yoga Therapy',
                        'tags'  => 'Biomechanics · Fascia · Nervous System · Trauma-Informed',
                        'body'  => 'Deep study of the physical architecture: myofascial meridians, the polyvagal nervous system, biomechanical principles of movement, and the body&rsquo;s stress-response mechanisms. You will learn to modify practices safely for injuries, chronic pain, anxiety, and specific populations, and to apply hands-on adjustments that are therapeutic, respectful, and trauma-informed.',
                        'accent'=> 'border-t-4 border-t-bes-forest',
                    ],
                    [
                        'num'   => '03',
                        'title' => 'The Subtle Body &amp; Energetic Healing',
                        'tags'  => 'Pranayama · Chakras · Nadis · Koshas · Sound Medicine',
                        'body'  => 'The signature offering of Pasraman Bali Eling Spirit. Master advanced Pranayama ratios and breathing architectures. Study the subtle anatomy &mdash; the seven chakras, the network of 72,000 nadis, the five koshas (sheaths), and the Kundalini pathway &mdash; to diagnose and clear energetic blockages in both yourself and your students. Integrate Tibetan singing bowl sound healing into your therapeutic toolkit.',
                        'accent'=> 'border-t-4 border-t-bes-olive',
                    ],
                    [
                        'num'   => '04',
                        'title' => 'Philosophy &amp; Sacred Texts',
                        'tags'  => 'Bhagavad Gita · Yoga Sutras · Hatha Pradipika · Siwa Tatwa',
                        'body'  => 'An immersion into the living wisdom of the source texts. You will study the Bhagavad Gita, Patanjali&rsquo;s Yoga Sutras, the Hatha Yoga Pradipika, Gherandha Samhita, Goraksha Samhita, and the Balinese Siwa Tatwa &mdash; not as historical artefacts but as practical manuals for navigating consciousness, karma, dharma, and the mechanics of spiritual evolution in the modern world.',
                        'accent'=> 'border-t-4 border-t-bes-bark',
                    ],
                    [
                        'num'   => '05',
                        'title' => 'Advanced Teaching Methodology',
                        'tags'  => 'Sequencing · Voice · Adjustment · Practicum',
                        'body'  => 'The transition from practitioner to master teacher. Refine your authentic teaching voice &mdash; cadence, tone, silence, presence. Learn advanced class theming, multi-level sequencing for diverse bodies, and the art of reading a room energetically. Extensive supervised practicum sessions with detailed feedback from senior faculty prepare you to lead with authority and compassion.',
                        'accent'=> 'border-t-4 border-t-bes-sage',
                    ],
                    [
                        'num'   => '06',
                        'title' => 'Balinese Spiritual Wisdom &amp; Life Mastery',
                        'tags'  => 'Tri Hita Karana · Taksu · Ayurveda · Ethics',
                        'body'  => 'Study the Balinese philosophy of <em>Tri Hita Karana</em> (harmony with God, harmony with nature, harmony with others) and the mysterious concept of <em>Taksu</em> &mdash; the Balinese spiritual charisma that electrifies authentic teachers. Modules on Ayurvedic principles, traditional Balinese <em>Jamu</em> and <em>Taru Pramana</em> herbal medicine, professional ethics, retreat leadership, and building a sustainable career complete the training.',
                        'accent'=> 'border-t-4 border-t-bes-gold',
                    ],
                ];
                foreach ( $modules as $idx => $m ) :
                    $delay = min($idx * 100, 400);
                ?>
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out bg-white rounded-lg p-7 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all <?php echo $m['accent']; ?>" style="transition-delay:<?php echo $delay; ?>ms;">
                    <span class="font-display text-5xl text-bes-forest-deep/8 leading-none block mb-3"><?php echo $m['num']; ?></span>
                    <h3 class="font-display text-lg text-bes-forest-deep leading-snug mb-1"><?php echo $m['title']; ?></h3>
                    <p class="font-body text-[10px] text-bes-olive tracking-label uppercase mb-4"><?php echo $m['tags']; ?></p>
                    <p class="text-xs text-bes-bark leading-[1.8]"><?php echo $m['body']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  5 · FULL-WIDTH IMAGE BREAK                               ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative h-[40vh] md:h-[50vh] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1920&h=700&q=80&auto=format&fit=crop&crop=center"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1400&q=70&auto=format&fit=crop';"
             alt="Yoga practitioners in deep meditation under ancient Balinese trees at the Pasraman"
             class="w-full h-full object-cover" loading="lazy" />
        <div class="absolute inset-0 bg-bes-forest-deep/40 flex items-center justify-center px-6">
            <blockquote class="reveal-item opacity-0 scale-95 transition-all duration-1000 ease-out text-center max-w-2xl">
                <p class="font-display text-2xl md:text-4xl text-bes-parchment tracking-display leading-snug">
                    &ldquo;Yogas citta vrtti nirodhah&rdquo;
                </p>
                <p class="font-body text-sm md:text-base text-bes-cream/80 mt-3">
                    Yoga is the cessation of the fluctuations of the mind. &mdash; Yoga Sutra I.2
                </p>
            </blockquote>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  6 · A DAY IN THE LIFE — HORIZONTAL BLOCKS                ║
         ║  Distinct: NOT vertical timeline. Horizontal scroll-       ║
         ║  friendly blocks with alternating bg tones.                ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-2">A Day in the Life</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    The Rhythm of Mastery
                </h2>
                <p class="text-base text-bes-bark max-w-xl mx-auto leading-relaxed mt-3">
                    Intensely rigorous yet deeply nourishing. Every hour is designed to immerse you fully in study,
                    practice, and personal integration.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $schedule = [
                    ['time'=>'05:30 – 07:30','title'=>'Pranayama, Meditation &amp; Kriya','desc'=>'Advanced subtle body practices and cleansing techniques in the powerful Brahma Muhurta pre-dawn hours when atmospheric prana is at its peak.','bg'=>'bg-bes-forest-deep text-bes-parchment','timecol'=>'!text-bes-gold'],
                    ['time'=>'07:30 – 09:30','title'=>'Master Asana Practice','desc'=>'Rigorous physical practice integrating Bali Hatha, Vinyasa flow, Ashtanga sequences, and Yin — progressively building toward complex apex postures.','bg'=>'bg-bes-forest/90 text-bes-parchment','timecol'=>'!text-bes-gold-soft'],
                    ['time'=>'09:30 – 10:30','title'=>'Nourishing Breakfast','desc'=>'Satwik vegetarian meals prepared fresh at the Pasraman. Plant-based, high-vibrational foods specifically designed to support the energetic demands of intensive training.','bg'=>'bg-white text-bes-forest-deep','timecol'=>'text-bes-olive'],
                    ['time'=>'10:30 – 13:00','title'=>'Anatomy &amp; Biomechanics Lab','desc'=>'Hands-on deconstruction of postures. Therapeutic applications, fascial anatomy, adjustment technique workshops, and trauma-informed modification practices.','bg'=>'bg-bes-parchment text-bes-forest-deep','timecol'=>'text-bes-olive'],
                    ['time'=>'13:00 – 14:30','title'=>'Lunch &amp; Integration','desc'=>'Time for digestion, journaling, personal reflection, and integration of the morning&rsquo;s physical and intellectual work before the afternoon session.','bg'=>'bg-white text-bes-forest-deep','timecol'=>'text-bes-olive'],
                    ['time'=>'14:30 – 16:30','title'=>'Philosophy &amp; Sacred Texts','desc'=>'Deep study of the Bhagavad Gita, Yoga Sutras, Hatha Pradipika, and Siwa Tatwa. Teaching methodology, sequencing theory, and finding your authentic voice.','bg'=>'bg-bes-forest-deep text-bes-parchment','timecol'=>'!text-bes-gold'],
                    ['time'=>'16:30 – 18:30','title'=>'Practicum &amp; Workshops','desc'=>'Supervised teaching practice with detailed faculty feedback, or specialty workshops: sound healing, Agni Hotra fire ceremony, Melukat water purification, chakra cleansing.','bg'=>'bg-bes-forest/90 text-bes-parchment','timecol'=>'!text-bes-gold-soft'],
                    ['time'=>'19:00 – 20:00','title'=>'Evening Satsang or Rest','desc'=>'Optional evening gathering for spiritual discussion, chanting, or restorative practices. The 24-hour open kitchen ensures you are nourished whenever you need.','bg'=>'bg-bes-parchment text-bes-forest-deep','timecol'=>'text-bes-olive'],
                ];
                foreach ( $schedule as $idx => $s ) :
                    $delay = min($idx * 60, 350);
                ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out <?php echo $s['bg']; ?> rounded-lg p-5" style="transition-delay:<?php echo $delay; ?>ms;">
                    <p class="font-display text-sm <?php echo $s['timecol']; ?> mb-2"><?php echo $s['time']; ?></p>
                    <h4 class="font-body font-semibold text-sm tracking-wide mb-2"><?php echo $s['title']; ?></h4>
                    <p class="text-xs leading-[1.7] opacity-75"><?php echo $s['desc']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  7 · THE MASTERS — TEACHER PROFILES                       ║
         ║  Distinct: Unique section not used in any other shortcode. ║
         ║  Large lead card + supporting cards.                       ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Your Faculty</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Learn from Lifetimes of Practice
                </h2>
                <p class="text-base text-bes-bark max-w-2xl mx-auto leading-relaxed mt-3">
                    At Pasraman Bali Eling Spirit, yoga is not taught by those who chose it as a profession &mdash;
                    it is transmitted by those who were called to it through lineage, decades of devoted practice,
                    and a spiritual commitment that defines every aspect of their lives.
                </p>
            </div>

            <!-- Lead teacher — large card -->
            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out mb-8">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg grid md:grid-cols-12 gap-0">
                    <div class="md:col-span-4 bg-bes-sage/10">
                        <img src="https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?w=600&h=700&q=80&auto=format&fit=crop&crop=top"
                             onerror="this.style.display='none';this.parentElement.classList.add('min-h-[300px]','bg-bes-sage/20');"
                             alt="Senior yoga master in traditional practice representing Ida Sri Bhagawan Sriprada Bhaskara"
                             class="w-full h-full object-cover min-h-[300px]" loading="lazy" />
                    </div>
                    <div class="md:col-span-8 p-8 md:p-10 flex flex-col justify-center">
                        <p class="font-body !text-bes-gold text-xs tracking-label uppercase mb-2">Lead Master &amp; Spiritual Director</p>
                        <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep tracking-display mb-4">Ida Sri Bhagawan Sriprada Bhaskara</h3>
                        <p class="text-sm text-bes-bark leading-[1.85] mb-4">
                            Ida Sri Bhagawan Sriprada Bhaskara is the spiritual anchor of Pasraman Bali Eling Spirit and the
                            primary guide for all advanced yoga training. With a lineage that extends through generations of
                            Balinese spiritual leadership and decades of personal practice in classical yoga, meditation, and
                            sacred healing arts, Bhagawan brings a depth of authentic transmission that cannot be replicated
                            in commercial training environments. Every participant in the 300-hour program receives direct,
                            personal guidance from Bhagawan &mdash; a privilege that profoundly elevates the training experience
                            and ensures that the ancient wisdom is transmitted with its full spiritual integrity intact.
                        </p>
                        <p class="text-xs text-bes-olive leading-relaxed">
                            Areas of mastery: Bali Hatha Yoga, Pranayama, Meditation, Chakra Activation, Kundalini Awakening,
                            Sacred Scripture Study, Spiritual Counseling, Yoga Philosophy, Balinese Healing Traditions
                        </p>
                    </div>
                </div>
            </div>

            <!-- Supporting faculty -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $faculty = [
                    [
                        'title' => 'Jero Ratni',
                        'role'  => 'Co-Founder &amp; Healing Guide',
                        'desc'  => 'Jero Ratni co-founded the Pasraman with a vision of making authentic spiritual transformation accessible to all. Her expertise in inner child healing, emotional detoxification, and Balinese water purification ceremonies adds a uniquely nurturing dimension to the training.',
                        'img'   => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=400&q=80&auto=format&fit=crop&crop=top',
                    ],
                    [
                        'title' => 'Senior Yogi Faculty',
                        'role'  => 'Authorised Master Teachers',
                        'desc'  => 'A dedicated team of certified, authorised yogis and yoginis who have practised spiritual disciplines for years under the guidance of Bhagawan. They lead daily asana sessions, supervise practicum, provide hands-on adjustment training, and offer personalised mentorship.',
                        'img'   => 'https://images.unsplash.com/photo-1575052814086-f385e2e2ad1b?w=400&h=400&q=80&auto=format&fit=crop&crop=center',
                    ],
                    [
                        'title' => 'Guest Specialists',
                        'role'  => 'Sound Healing &amp; Ayurveda',
                        'desc'  => 'Visiting specialists in Tibetan sound healing, traditional Ayurvedic medicine, and Balinese herbal wisdom (<em>Jamu</em> and <em>Taru Pramana</em>) complement the core faculty, ensuring a truly comprehensive and multidimensional training experience.',
                        'img'   => 'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=400&h=400&q=80&auto=format&fit=crop&crop=center',
                    ],
                ];
                foreach ( $faculty as $idx => $f ) : ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-shadow" style="transition-delay:<?php echo $idx * 120; ?>ms;">
                    <img src="<?php echo esc_url( $f['img'] ); ?>"
                         onerror="this.style.display='none';this.parentElement.querySelector('.ytt-card-body').classList.add('pt-8');"
                         alt="<?php echo esc_attr( strip_tags( $f['title'] ) ); ?> — Pasraman Bali Eling Spirit faculty"
                         class="w-full h-48 object-cover" loading="lazy" />
                    <div class="p-6 ytt-card-body">
                        <p class="font-body text-[10px] text-bes-olive tracking-label uppercase mb-1"><?php echo $f['role']; ?></p>
                        <h4 class="font-display text-lg text-bes-forest-deep mb-2"><?php echo $f['title']; ?></h4>
                        <p class="text-xs text-bes-bark leading-[1.75]"><?php echo $f['desc']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  8 · WHAT'S INCLUDED — ALTERNATING ICON ROWS              ║
         ║  Distinct: 2-column icon rows with alternating bg.         ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-24 md:py-32">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Your Investment Includes</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Everything You Need. Nothing You Don&rsquo;t.
                </h2>
            </div>

            <div class="space-y-3">
                <?php
                $inclusions = [
                    ['icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                     'title'=>'28 Nights Accommodation','text'=>'Clean, air-conditioned rooms with en-suite bathrooms at the Pasraman. Designed for rest and recovery after intensive daily training.'],
                    ['icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                     'title'=>'3× Daily Vegetarian Meals','text'=>'Satwik, plant-based nutrition prepared fresh. Plus 24-hour access to the open kitchen for tea, fruits, and light snacks.'],
                    ['icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                     'title'=>'Comprehensive Training Manual','text'=>'Detailed modules covering advanced anatomy, philosophy, sequencing templates, and Balinese spiritual teachings. Plus stationery and goodie bag.'],
                    ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                     'title'=>'Internationally Recognised Certification','text'=>'Upon graduation, you are eligible to register as RYT-500 with Yoga Alliance (USA), World Yoga Federation, and Yoga Alliance International (India).'],
                    ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                     'title'=>'Sacred Ceremonies &amp; Healing','text'=>'Opening and closing Agni Hotra fire ceremonies, traditional Melukat water purification, 7-Chakra Purification with crystals and mantras, and Tibetan sound healing sessions.'],
                    ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                     'title'=>'Lifelong Mentorship &amp; Community','text'=>'Become a member of the Sisya Bhawana community at the Pasraman. Access to ongoing learning, mentorship, and future programs is unlimited according to your certification level.'],
                    ['icon'=>'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
                     'title'=>'Professional Documentation','text'=>'High-quality photographs of your training journey for your portfolio and professional profile. Pasraman uniform and yoga mat also provided.'],
                ];
                foreach ( $inclusions as $idx => $inc ) :
                    $bg = $idx % 2 === 0 ? 'bg-white/70' : 'bg-bes-ivory/50';
                ?>
                <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out <?php echo $bg; ?> rounded-lg p-5 flex gap-5 items-start" style="transition-delay:<?php echo min($idx * 50, 250); ?>ms;">
                    <div class="w-10 h-10 rounded-full bg-bes-leaf-soft/20 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-[18px] h-[18px] text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $inc['icon']; ?>"/></svg>
                    </div>
                    <div>
                        <h4 class="font-body font-semibold text-sm text-bes-forest-deep mb-1"><?php echo $inc['title']; ?></h4>
                        <p class="text-xs text-bes-bark leading-[1.75]"><?php echo $inc['text']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  9 · THE PATHWAY — VISUAL PROGRESSION LADDER              ║
         ║  Distinct: Horizontal step progression from 50H → 300H.   ║
         ║  Unique section type across all shortcodes.                ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-2">The Complete Journey</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display">
                    Your Pathway to RYT-500
                </h2>
                <p class="text-base text-bes-cream/60 max-w-xl mx-auto mt-3 leading-relaxed">
                    The Pasraman structures its yoga education as a progressive journey. Each stage builds upon the last.
                    The 300-Hour is the culminating phase.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $pathway = [
                    ['level'=>'YTT 50H','sub'=>'Parwa I','weeks'=>'1 week','focus'=>'Surya Namaskar, Asanas, Pranayama, Subtle Body, Meditation, Yoga Nidra','status'=>'Foundation'],
                    ['level'=>'YTT 100H','sub'=>'Parwa I + II','weeks'=>'2 weeks','focus'=>'+ Anatomy, Physiology, Biomechanics, Yantra, Mudra, Bandha, Yin &amp; Restorative Yoga','status'=>'Deepening'],
                    ['level'=>'YTT 200H','sub'=>'All Parwas','weeks'=>'1 month','focus'=>'+ Teaching Methodology, Sequencing, Ayurveda, Acro Yoga, Life Mastery, Professional Development','status'=>'Certification'],
                    ['level'=>'YTT 300H','sub'=>'Advanced','weeks'=>'1 month','focus'=>'+ Yoga Therapy, Advanced Subtle Body, Sacred Texts, Balinese Healing, Master Practicum','status'=>'Mastery'],
                ];
                foreach ( $pathway as $idx => $p ) :
                    $is_current = $idx === 3;
                    $card_bg    = $is_current ? 'bg-bes-gold/15 border-bes-gold/40' : 'bg-bes-cream/5 border-bes-cream/10';
                    $num_col    = $is_current ? '!text-bes-gold' : 'text-bes-cream/30';
                    $title_col  = $is_current ? '!text-bes-gold' : 'text-bes-cream/80';
                ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out border <?php echo $card_bg; ?> rounded-lg p-5 relative" style="transition-delay:<?php echo $idx * 100; ?>ms;">
                    <?php if ( $is_current ) : ?>
                    <span class="absolute -top-3 left-4 bg-bes-gold text-bes-forest-deep text-[9px] font-semibold tracking-label uppercase px-3 py-0.5 rounded-full">You Are Here</span>
                    <?php endif; ?>
                    <p class="font-display text-2xl <?php echo $title_col; ?> tracking-display mb-1"><?php echo $p['level']; ?></p>
                    <p class="text-[10px] text-bes-cream/40 tracking-label uppercase mb-3"><?php echo $p['sub']; ?> &middot; <?php echo $p['weeks']; ?></p>
                    <p class="text-xs text-bes-cream/60 leading-[1.7] mb-3"><?php echo $p['focus']; ?></p>
                    <span class="inline-block text-[9px] tracking-label uppercase px-2.5 py-1 rounded-full border <?php echo $is_current ? 'border-bes-gold/30 !text-bes-gold' : 'border-bes-cream/15 text-bes-cream/40'; ?>"><?php echo $p['status']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  10 · PREREQUISITES — SPLIT WITH IMAGE                    ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <!-- Image -->
                <div class="reveal-item opacity-0 scale-95 transition-all duration-1000 ease-out rounded-lg overflow-hidden shadow-xl group">
                    <img src="https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=750&h=550&q=80&auto=format&fit=crop&crop=center"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20','min-h-[350px]');"
                         alt="Yoga teacher training students practising together in the open-air shala at Pasraman Bali Eling Spirit"
                         class="w-full h-[350px] md:h-[450px] object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy" />
                </div>

                <!-- Prerequisites text -->
                <div class="reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-3">Entry Requirements</p>
                    <h2 class="font-display text-3xl md:text-[2.4rem] text-bes-forest-deep tracking-display leading-snug mb-5">
                        Who Is This Training For?
                    </h2>
                    <p class="text-base text-bes-bark leading-[1.85] mb-6">
                        The 300-Hour program is an advanced, intensive certification. It requires a solid foundational
                        understanding so we can immediately explore higher-level concepts, subtle body work, and
                        advanced teaching methodology without pausing for basic terminology. This training
                        is open to all &mdash; professionals, entrepreneurs, educators, therapists, students, and
                        dedicated practitioners from any background.
                    </p>

                    <div class="space-y-4 mb-8">
                        <?php
                        $prereqs = [
                            ['bold'=>'200-Hour YTT Certification','text'=>'You must hold a certificate from a recognised yoga school (any style, any country). This is verified during enrollment.'],
                            ['bold'=>'Teaching Experience Recommended','text'=>'At least 6 months to 1 year of teaching experience is highly recommended, though deeply committed practitioners seeking personal advancement are welcome.'],
                            ['bold'=>'Ages 15 to 60','text'=>'Open to both men and women. Students under 18 require written parental consent; married participants require written spousal consent (Indonesian regulatory requirement).'],
                            ['bold'=>'Willingness to Be Quarantined','text'=>'You must be prepared for full residential immersion at the Pasraman for the entire 28-day duration. This is essential to the depth and integrity of the training.'],
                            ['bold'=>'Courage to Heal','text'=>'You cannot guide others through transformation without facing your own shadows. Be prepared for deep emotional and spiritual introspection alongside the technical curriculum.'],
                        ];
                        foreach ( $prereqs as $pr ) : ?>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bes-forest shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <p class="text-sm text-bes-bark leading-relaxed"><strong class="text-bes-forest-deep"><?php echo $pr['bold']; ?>:</strong> <?php echo $pr['text']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  11 · TESTIMONIALS — LARGE SINGLE-QUOTE STYLE             ║
         ║  Distinct: One large featured quote + 2 smaller below.    ║
         ║  NOT 3-column grid like other shortcodes.                  ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">From Our Community</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    What They Say About Us
                </h2>
            </div>

            <!-- Large featured quote -->
            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out bg-white border border-bes-parchment rounded-lg p-8 md:p-12 text-center mb-6 relative overflow-hidden">
                <div class="absolute -left-6 -top-6 w-24 h-24 bg-bes-gold/5 blur-2xl rounded-full"></div>
                <svg class="w-10 h-10 !text-bes-gold/25 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="font-display text-lg md:text-xl text-bes-forest-deep leading-[1.7] mb-6 max-w-2xl mx-auto relative z-10">
                    An extraordinary experience to be at the Pasraman. The journey was wonderful, the fellow
                    participants were so kind and supportive, and Aji and Bu Jro along with the yogi team were
                    warm and full of compassion. The teaching changed not just how I practise yoga &mdash; it changed
                    how I understand life itself.
                </p>
                <p class="font-display text-base text-bes-forest-deep">Ergulina Mahadiarta</p>
                <p class="text-xs text-bes-bark-muted tracking-wider uppercase">Pasraman Participant</p>
            </div>

            <!-- Two smaller quotes -->
            <div class="grid md:grid-cols-2 gap-5">
                <?php
                $quotes = [
                    [
                        'text' => 'The class I attended was truly amazing. It deeply awakened my spiritual awareness which had nearly faded. Especially during meditation in nature — the positive energy was immense, with incredibly clean oxygen. An unforgettable moment.',
                        'name' => 'Rostini Pho',
                        'from' => 'Training Participant',
                    ],
                    [
                        'text' => 'Truly a blessing to have found this place. Every step was guided with care, and it ended with a bright smile. I love this place, the atmosphere, and the people. The masters led us toward alignment in a way that was both structured and deeply personal.',
                        'name' => 'A. Kurniawan',
                        'from' => 'Pasraman Alumni',
                    ],
                ];
                foreach ( $quotes as $idx => $q ) : ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out bg-white/70 border border-bes-parchment rounded-lg p-6" style="transition-delay:<?php echo $idx * 150; ?>ms;">
                    <p class="text-sm text-bes-bark leading-[1.8] mb-4"><?php echo $q['text']; ?></p>
                    <p class="font-display text-sm text-bes-forest-deep"><?php echo $q['name']; ?></p>
                    <p class="text-[10px] text-bes-bark-muted tracking-wider uppercase"><?php echo $q['from']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  12 · FAQ — CLEAN EXPAND/COLLAPSE                         ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Frequently Asked</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Questions &amp; Answers
                </h2>
            </div>

            <?php
            $faqs = [
                [
                    'q' => 'Do I need a 200-hour certification to enroll?',
                    'a' => 'Yes. The 300-hour program builds directly upon the 200-hour curriculum. You must hold a valid 200-Hour YTT certificate from any recognised yoga school worldwide. If you do not yet have this, Pasraman Bali Eling Spirit offers its own 200-hour program that can be completed prior to the advanced training.',
                ],
                [
                    'q' => 'Is this training tied to a specific religion?',
                    'a' => 'No. While the training is deeply rooted in Balinese Hindu spiritual tradition and draws from ancient Vedic texts, it is not tied to any particular belief system. The foundation is universal: yoga, meditation, spiritual mastery, and life mastery. Participants of all faiths, backgrounds, and nationalities are welcome and will find value in the experience.',
                ],
                [
                    'q' => 'What certification will I receive?',
                    'a' => 'Upon successful graduation, you will receive a 300-Hour Advanced YTT certificate accredited by Yoga Alliance (USA), World Yoga Federation, and Yoga Alliance International (India). Combined with your existing 200-hour certification, you become eligible to register globally as an RYT-500 — the highest standard teacher certification.',
                ],
                [
                    'q' => 'Must I stay at the Pasraman for the entire 28 days?',
                    'a' => 'Yes. Full residential immersion is required for the entire duration. The calm, energetically protected environment of the Pasraman is essential to the depth and effectiveness of the training. The facilities include air-conditioned rooms with en-suite bathrooms, three vegetarian meals per day, and a 24-hour open kitchen.',
                ],
                [
                    'q' => 'Do I need to be vegetarian?',
                    'a' => 'During training, you will be provided with satwik (sattvic) vegetarian meals — food prepared without animal meat, designed to support the energetic and spiritual demands of intensive practice. Outside of training, vegetarianism is a personal choice. Many participants find that the awareness cultivated through the training naturally shifts their dietary preferences.',
                ],
                [
                    'q' => 'Is ongoing mentorship available after graduation?',
                    'a' => 'Absolutely. Upon completion, you become a member of the Sisya Bhawana community at Pasraman Bali Eling Spirit. This grants you unlimited access to ongoing learning, mentorship from the master faculty, and participation in future programs according to your certification level. This is lifelong guidance — not a transactional relationship.',
                ],
                [
                    'q' => 'When is the next intake?',
                    'a' => 'The 300-hour training is offered by request. Specific dates are arranged in consultation with the Pasraman to ensure optimal group size and seasonal conditions. Contact us via WhatsApp to discuss the next available intake and to begin the enrollment process.',
                ],
            ];
            foreach ( $faqs as $idx => $faq ) : ?>
            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out border-b border-bes-bark-muted/15 ytt-faq-item" style="transition-delay:<?php echo $idx * 50; ?>ms;">
                <button class="w-full flex items-center justify-between py-5 text-left ytt-faq-btn" aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>">
                    <span class="font-display text-base md:text-lg text-bes-forest-deep pr-4"><?php echo $faq['q']; ?></span>
                    <svg class="w-5 h-5 text-bes-olive shrink-0 transition-transform duration-300 ytt-faq-icon <?php echo $idx === 0 ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="ytt-faq-body overflow-hidden transition-all duration-300 <?php echo $idx === 0 ? 'max-h-96 pb-5' : 'max-h-0'; ?>">
                    <p class="text-sm text-bes-bark leading-[1.8]"><?php echo $faq['a']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  13 · FINAL CTA — CINEMATIC CLOSE                        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-28 md:py-40 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1400&q=70&auto=format&fit=crop';"
                 alt="Spectacular sunrise over the sacred rice terraces of Tampaksiring near Pasraman Bali Eling Spirit"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/88"></div>
        </div>

        <div class="relative z-10 text-center max-w-3xl mx-auto px-6 md:px-10">
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display italic !text-bes-gold-soft text-base md:text-lg mb-4">
                &ldquo;Yoga is learning to accept imperfection in a perfect way,
                and the time it takes is a lifetime.&rdquo;
            </p>
            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display text-3xl md:text-[3.5rem] text-bes-parchment tracking-display leading-[1.1] mb-6" style="transition-delay:100ms;">
                Step Into Mastery.<br>
                The Lineage Awaits You.
            </h2>
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-base md:text-lg text-bes-cream/75 leading-relaxed mb-10 max-w-xl mx-auto" style="transition-delay:200ms;">
                Spaces for the 300-Hour Advanced Training are deliberately limited to preserve the
                deeply personalised mentorship that makes this program transformative. Enroll today
                and join the next generation of master teachers.
            </p>

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out flex flex-col sm:flex-row gap-4 justify-center" style="transition-delay:300ms;">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-3 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Apply for 300H YTT
                </a>
                <a href="/yoga-teacher-training/"
                   class="inline-flex items-center justify-center gap-2 border border-bes-parchment/25 hover:border-bes-parchment/50
                          text-bes-parchment font-body text-sm px-8 py-4 rounded transition-all duration-300">
                    Explore All YTT Levels
                </a>
            </div>
            <p class="reveal-item opacity-0 transition-opacity duration-700 text-xs text-bes-cream/40 mt-6" style="transition-delay:400ms;">
                By request &middot; 28-day residential &middot; Br. Umadawa, Pejeng Kangin, Gianyar, Bali &middot; +62 812 2888 8873
            </p>
        </div>
    </section>


    </div><!-- /.bes-300ytt -->


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
                        'translate-x-6','-translate-x-6','scale-95'
                    );
                    e.target.classList.add('opacity-100','translate-y-0','translate-x-0','scale-100');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.bes-300ytt .reveal-item').forEach(function(el){ io.observe(el); });

        /* — FAQ accordion — */
        document.querySelectorAll('.ytt-faq-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var item = btn.closest('.ytt-faq-item');
                var body = item.querySelector('.ytt-faq-body');
                var icon = item.querySelector('.ytt-faq-icon');
                var open = btn.getAttribute('aria-expanded') === 'true';

                document.querySelectorAll('.ytt-faq-btn').forEach(function(b) {
                    b.setAttribute('aria-expanded','false');
                    b.closest('.ytt-faq-item').querySelector('.ytt-faq-body').classList.remove('max-h-96','pb-5');
                    b.closest('.ytt-faq-item').querySelector('.ytt-faq-body').classList.add('max-h-0');
                    b.closest('.ytt-faq-item').querySelector('.ytt-faq-icon').classList.remove('rotate-180');
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