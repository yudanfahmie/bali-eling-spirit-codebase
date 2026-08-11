<?php
/**
 * ─────────────────────────────────────────────────────────────
 *  Shortcode : [bes_karma_retreat]
 *  Page      : /karma-retreat/
 *  Site      : Pasraman Bali Eling Spirit
 * ─────────────────────────────────────────────────────────────
 *  Relies on BES Tailwind design tokens already loaded by theme.
 *  Content-only — zero duplicate color / font declarations.
 * ─────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_karma_retreat', 'bes_karma_retreat_render' );

function bes_karma_retreat_render( $atts ) {

    $a = shortcode_atts([
        'wa'   => '6281228888873',
        'lang' => 'en',
    ], $atts, 'bes_karma_retreat' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I am interested in the Karma Retreat 5 Days 4 Nights. Please share more details.' );

    ob_start();
    ?>

    <!-- ─── Karma Retreat — scoped micro-styles (animation only) ─── -->
    <style>
    .bes-kr-fade{opacity:0;transform:translateY(24px);transition:opacity .7s cubic-bezier(.25,.46,.45,.94),transform .7s cubic-bezier(.25,.46,.45,.94)}
    .bes-kr-fade.in-view{opacity:1;transform:none}
    .bes-kr-scale{opacity:0;transform:scale(.96);transition:opacity .65s ease,transform .65s ease}
    .bes-kr-scale.in-view{opacity:1;transform:scale(1)}
    .bes-kr-zoom{overflow:hidden;border-radius:2px}
    .bes-kr-zoom img{transition:transform .65s cubic-bezier(.25,.46,.45,.94)}
    .bes-kr-zoom:hover img{transform:scale(1.045)}
    .bes-kr-divider{width:48px;height:2px}
    .bes-kr-card{transition:box-shadow .35s ease,transform .35s ease}
    .bes-kr-card:hover{box-shadow:0 8px 30px rgba(0,0,0,.08);transform:translateY(-3px)}
    </style>


    <div class="bes-karma-retreat font-body text-bes-forest-deep">


    <!-- ═══════════════════════════════════════
         1. HERO — SPLIT LAYOUT
    ═══════════════════════════════════════ -->
    <section class="relative bg-bes-forest-deep overflow-hidden">
        <div class="grid lg:grid-cols-2 min-h-[88vh]">

            <!-- Left: Text -->
            <div class="flex flex-col justify-center px-8 md:px-16 lg:px-20 py-20 lg:py-28 order-2 lg:order-1">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-5">
                    Pasraman Bali Eling Spirit &mdash; Private Program
                </p>
                <h1 class="font-display font-light text-5xl md:text-6xl lg:text-[4.2rem] text-bes-parchment tracking-display leading-tight mb-6">
                    Karma<br>Retreat
                </h1>
                <p class="font-display italic !text-bes-gold-soft text-xl md:text-2xl mb-6">
                    5 Days &middot; 4 Nights
                </p>
                <p class="text-base md:text-lg text-bes-cream/85 leading-relaxed max-w-lg mb-10">
                    Release the burdens your soul has carried across lifetimes.
                    In five focused days at the spiritual heart of Bali, uncover
                    the karmic patterns that shape your present and clear a
                    path toward deeper meaning, genuine healing, and
                    authentic self-understanding.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                              font-body font-semibold tracking-label uppercase text-sm px-9 py-3.5 rounded transition-all
                              duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        Book This Retreat
                    </a>
                    <a href="#kr-program"
                       class="inline-flex items-center gap-2 border border-bes-parchment/30 hover:border-bes-parchment/60
                              text-bes-parchment font-body font-medium tracking-label uppercase text-sm px-9 py-3.5
                              rounded transition-all duration-300">
                        Explore Program
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="relative min-h-[50vh] lg:min-h-full order-1 lg:order-2">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=960&h=1200&q=80&auto=format&fit=crop&crop=center"
                     onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=75&auto=format';"
                     alt="Meditation practice amid tropical greenery at sunrise in Bali"
                     class="absolute inset-0 w-full h-full object-cover" loading="eager" />
                <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/40 via-transparent to-transparent lg:bg-gradient-to-r lg:from-bes-forest-deep/30 lg:via-transparent"></div>

                <!-- Badge overlay -->
                <div class="absolute bottom-6 right-6 bg-bes-forest-deep/80 backdrop-blur-sm rounded px-5 py-3 text-center">
                    <p class="font-display text-2xl !text-bes-gold leading-none">5</p>
                    <p class="font-body text-[10px] text-bes-cream/70 tracking-label uppercase mt-0.5">Days</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         2. UNDERSTANDING KARMA — PHILOSOPHY
    ═══════════════════════════════════════ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="bes-kr-fade max-w-3xl mx-auto text-center mb-16">
                <p class="font-display italic text-bes-olive text-lg mb-1">कर्म &middot; कर्मफल</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Understanding Karma &amp; Karmaphala
                </h2>
                <div class="bes-kr-divider bg-bes-gold mx-auto mb-6"></div>
                <p class="text-base text-bes-bark leading-relaxed">
                    In Balinese Hindu philosophy, karma is not punishment. It is one of the five
                    <em>tattvas</em> &mdash; foundational truths alongside <em>brahman</em> (the divine source),
                    <em>atma</em> (soul), <em>samsara</em> (the cycle of rebirth), and <em>moksha</em>
                    (liberation). Every action, thought, and intention plants a seed.
                    <strong>Karmaphala</strong> is the fruit of that seed &mdash; the natural, inevitable
                    consequence that ripens across days, years, or lifetimes.
                </p>
            </div>

            <!-- Three-column concept cards -->
            <div class="grid md:grid-cols-3 gap-6 md:gap-8">
                <?php
                $concepts = [
                    [
                        'sanskrit' => 'Sañcita',
                        'en'       => 'Accumulated Karma',
                        'body'     => 'The total storehouse of all actions from every past life. This vast reservoir of unresolved cause and effect forms the invisible architecture of your present existence &mdash; influencing tendencies, fears, gifts, and recurring patterns you may not consciously understand.',
                        'img'      => 'https://images.unsplash.com/photo-1528715471579-d1bcf0ba5e83?w=600&h=400&q=80&auto=format&fit=crop&crop=center',
                        'alt'      => 'Ancient stone carvings symbolising accumulated spiritual history',
                    ],
                    [
                        'sanskrit' => 'Prārabdha',
                        'en'       => 'Present-Life Karma',
                        'body'     => 'The specific portion of accumulated karma that has ripened and now shapes your current lifetime &mdash; your family, your health, the challenges and opportunities before you. This is the karma you are actively experiencing right now, and the one most accessible to conscious work.',
                        'img'      => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&h=400&q=80&auto=format&fit=crop&crop=center',
                        'alt'      => 'Person in seated meditation surrounded by morning light',
                    ],
                    [
                        'sanskrit' => 'Āgāmi',
                        'en'       => 'Future Karma',
                        'body'     => 'The karma you are generating right now &mdash; through your choices, intentions, and actions in this very moment. This is the realm of agency and hope. The Karma Retreat teaches you to plant seeds of awareness, compassion, and clarity that will bear fruit in the days and lives ahead.',
                        'img'      => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=600&h=400&q=80&auto=format&fit=crop&crop=center',
                        'alt'      => 'Sunlight streaming through tropical forest canopy in Bali',
                    ],
                ];
                foreach ( $concepts as $c ) : ?>
                <div class="bes-kr-fade bes-kr-card bg-white/70 rounded overflow-hidden">
                    <div class="bes-kr-zoom aspect-[3/2]">
                        <img src="<?php echo esc_url( $c['img'] ); ?>"
                             onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');"
                             alt="<?php echo esc_attr( $c['alt'] ); ?>"
                             class="w-full h-full object-cover" loading="lazy" />
                    </div>
                    <div class="p-6">
                        <p class="font-display italic text-bes-olive text-sm mb-0.5"><?php echo $c['sanskrit']; ?></p>
                        <h3 class="font-display text-xl text-bes-forest-deep mb-2"><?php echo $c['en']; ?></h3>
                        <p class="text-sm text-bes-bark leading-relaxed"><?php echo $c['body']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         3. AT A GLANCE — HORIZONTAL STATS BAR
    ═══════════════════════════════════════ -->
    <section class="bg-bes-forest py-12 md:py-14">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="flex flex-wrap justify-center gap-x-12 gap-y-6 text-center">
                <?php
                $metrics = [
                    ['val' => '5',  'lbl' => 'Sunrise Hatha Yoga'],
                    ['val' => '4',  'lbl' => 'Sunset Yin Yoga'],
                    ['val' => '19', 'lbl' => 'Healing Meditations'],
                    ['val' => '4',  'lbl' => 'Sound Healings'],
                    ['val' => '2',  'lbl' => 'UNESCO Temple Visits'],
                ];
                foreach ( $metrics as $m ) : ?>
                <div class="bes-kr-fade">
                    <p class="font-display text-4xl md:text-5xl !text-bes-gold tracking-display leading-none">
                        <?php echo esc_html( $m['val'] ); ?>
                    </p>
                    <p class="font-body text-[11px] text-bes-cream/75 tracking-label uppercase mt-1.5">
                        <?php echo esc_html( $m['lbl'] ); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         4. THE FULL PROGRAM — TABBED GRID
    ═══════════════════════════════════════ -->
    <section id="kr-program" class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="bes-kr-fade text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Complete Program</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Everything Included in Your 5 Days
                </h2>
                <div class="bes-kr-divider bg-bes-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $program = [
                    [
                        'icon'  => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z',
                        'title' => '5 &times; Sunrise Bali Hatha Yoga',
                        'text'  => 'Every morning begins at dawn with the signature Bali Hatha Yoga system developed at the Pasraman. These sessions blend gentle, flowing movement with intentional breathwork to awaken the body&rsquo;s vital energy and prepare the mind for the inner work of the day.',
                    ],
                    [
                        'icon'  => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z',
                        'title' => '4 &times; Sunset Detox Yin Yoga',
                        'text'  => 'As the equatorial sun drops behind the jungle canopy, you settle into long-held yin postures that target deep connective tissue and meridian lines. These evening sessions release stored tension and prepare your body for restorative sleep.',
                    ],
                    [
                        'icon'  => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'title' => '19 &times; Healing &amp; Mindfulness Meditation',
                        'text'  => 'Guided meditations are woven through each day &mdash; morning intention-setting, mid-day mindfulness, and evening gratitude practice. The cumulative effect over five days builds a tangible shift in awareness that participants carry long after the retreat ends.',
                    ],
                    [
                        'icon'  => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z',
                        'title' => '4 &times; Sacred Sound Healing',
                        'text'  => 'Tibetan singing bowls, mantras, and carefully tuned frequencies move through the body during these immersive sessions. Sound healing dissolves stress at a cellular level, opens blocked energy channels, and restores a sense of deep vibrational equilibrium.',
                    ],
                    [
                        'icon'  => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
                        'title' => '1 &times; Mother Earth Purification',
                        'text'  => 'A traditional Balinese ceremony that connects your energy body directly with the earth&rsquo;s elemental forces. Through sacred offerings, mantras, and meditative communion with the natural surroundings, this ritual cleanses the energetic foundation of your being.',
                    ],
                    [
                        'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                        'title' => '2 &times; Sacred Temple Excursion',
                        'text'  => 'Journey to ancient temples in the Tampaksiring and Pejeng region &mdash; cultural heritage sites under UNESCO protection. Walk the sacred grounds, join in prayer, and absorb the concentrated spiritual presence of Bali&rsquo;s most revered holy places.',
                    ],
                    [
                        'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'title' => '2 &times; Transformative Workshops',
                        'text'  => '<em class="text-bes-forest">Manifestation with the Power of Mind</em> teaches focused intention as creative force. <em class="text-bes-forest">Discovering Your True Self through Meditation</em> guides you beyond technique into the direct experience of your authentic nature.',
                    ],
                    [
                        'icon'  => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z',
                        'title' => '1 &times; Private Consultation',
                        'text'  => 'A one-on-one session with the Pasraman master to map your personal challenges, identify karmic patterns, and design a continuing path. This private consultation tailors the entire retreat experience to your unique spiritual situation.',
                    ],
                    [
                        'icon'  => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                        'title' => 'Daily Guided Journaling',
                        'text'  => 'Each day, dedicated journaling time is structured into the schedule. You will record gratitude, insights, emotional breakthroughs, and the positive messages that emerge during meditation &mdash; creating a personal record of your transformation.',
                    ],
                    [
                        'icon'  => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'title' => '1-Hour Relaxing Spa Massage',
                        'text'  => 'A nurturing full-body massage mid-retreat to ease accumulated physical tension and support integration of the deep emotional processing taking place. Honouring the Balinese tradition that treats body and spirit as inseparable.',
                    ],
                    [
                        'icon'  => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636',
                        'title' => 'Digital Detox Protocol',
                        'text'  => 'Participants are guided to fast from social media and mobile devices for the duration of the retreat. This conscious disconnection creates space for genuine stillness, richer meditation, and an undistracted encounter with the present moment.',
                    ],
                ];
                foreach ( $program as $p ) : ?>
                <div class="bes-kr-fade bes-kr-card bg-white/60 rounded p-6 flex gap-4">
                    <div class="shrink-0 w-10 h-10 rounded-full bg-bes-leaf-soft/30 flex items-center justify-center mt-0.5">
                        <svg class="w-[18px] h-[18px] text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="<?php echo $p['icon']; ?>"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display text-lg text-bes-forest-deep mb-1"><?php echo $p['title']; ?></h3>
                        <p class="text-xs leading-relaxed text-bes-bark"><?php echo $p['text']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         5. PHOTO MOSAIC
    ═══════════════════════════════════════ -->
    <section class="bg-bes-cream py-14 md:py-18">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid grid-cols-6 grid-rows-2 gap-3 md:gap-4 h-[320px] md:h-[420px]">
                <?php
                $mosaic = [
                    ['src'=>'https://images.unsplash.com/photo-1545389336-cf090694435e?w=700&h=700&q=80&auto=format&fit=crop','alt'=>'Yoga practice in open-air bamboo pavilion','class'=>'col-span-3 row-span-2'],
                    ['src'=>'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=500&h=350&q=80&auto=format&fit=crop','alt'=>'Tibetan singing bowls during sound healing session','class'=>'col-span-3 row-span-1'],
                    ['src'=>'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=340&h=350&q=80&auto=format&fit=crop','alt'=>'Lush Bali rice terraces and tropical vegetation','class'=>'col-span-1 row-span-1'],
                    ['src'=>'https://images.unsplash.com/photo-1590490360182-c33d7f9d02a0?w=340&h=350&q=80&auto=format&fit=crop','alt'=>'Hands in prayer during Balinese ceremony','class'=>'col-span-1 row-span-1'],
                    ['src'=>'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=340&h=350&q=80&auto=format&fit=crop','alt'=>'Golden sunrise over tropical landscape','class'=>'col-span-1 row-span-1'],
                ];
                foreach ( $mosaic as $img ) : ?>
                <div class="bes-kr-scale bes-kr-zoom <?php echo $img['class']; ?>">
                    <img src="<?php echo esc_url( $img['src'] ); ?>"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');"
                         alt="<?php echo esc_attr( $img['alt'] ); ?>"
                         class="w-full h-full object-cover" loading="lazy" />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         6. DAY-BY-DAY — HORIZONTAL ACCORDION
    ═══════════════════════════════════════ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="bes-kr-fade text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Day by Day</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Your 5-Day Arc of Transformation
                </h2>
                <div class="bes-kr-divider bg-bes-gold mx-auto mb-6"></div>
                <p class="text-base text-bes-bark max-w-2xl mx-auto leading-relaxed">
                    Each day builds upon the last &mdash; a deliberate progression from
                    letting go, through deep inner work, to the emergence of a renewed and
                    lighter version of yourself.
                </p>
            </div>

            <?php
            $days = [
                [
                    'day'   => 'Day 1',
                    'title' => 'Arrival &amp; Opening',
                    'body'  => 'You arrive at Pasraman Bali Eling Spirit in Pejeng Kangin, near the cultural heart of Ubud. After a welcoming ceremony, you set your personal sankalpa &mdash; a focused intention for the days ahead. The first sunrise hatha yoga session reconnects you with your physical body, and an evening sound healing begins to soften the layers of accumulated tension. Journaling begins tonight: what are you carrying? What are you ready to release?',
                ],
                [
                    'day'   => 'Day 2',
                    'title' => 'Karmic Awareness',
                    'body'  => 'Morning yoga is followed by intensive healing meditation focused on observing &mdash; not judging &mdash; the karmic patterns running through your life. Where do recurring struggles appear? What inherited tendencies shape your reactions? The afternoon workshop on Manifestation with the Power of Mind introduces the principle that conscious intention can redirect the flow of future karma. A sunset yin session closes the day, grounding these insights into the body.',
                ],
                [
                    'day'   => 'Day 3',
                    'title' => 'Purification &amp; Pilgrimage',
                    'body'  => 'The midpoint of the retreat is devoted to purification. The Mother Earth Purification ceremony uses traditional Balinese mantras, sacred offerings, and meditative communion with the natural elements to cleanse your energetic foundation. In the afternoon, you travel to a UNESCO-protected sacred temple in the Tampaksiring region &mdash; walking ancient grounds, participating in prayer, and absorbing concentrated spiritual energy that accelerates the release process.',
                ],
                [
                    'day'   => 'Day 4',
                    'title' => 'Integration &amp; Insight',
                    'body'  => 'With the heaviest karmic material already surfaced and released, today shifts toward integration. Your private consultation with the Pasraman master maps the personal insights gathered over the preceding days and charts a practical path forward. The workshop on Discovering Your True Self through Meditation moves beyond technique into direct experience. A second temple excursion and your spa massage honour both the spiritual and physical dimensions of healing.',
                ],
                [
                    'day'   => 'Day 5',
                    'title' => 'Renewal &amp; Return',
                    'body'  => 'The final sunrise yoga carries a quality noticeably different from Day 1 &mdash; lighter, more expansive, more present. A closing meditation and gratitude ceremony marks the passage from the old to the new. You review your journal, recognise the distance you have travelled, and receive guidance for sustaining your practice at home. You leave the Pasraman carrying clearer energy, deeper self-understanding, and the tools to continue shaping your karma with intention.',
                ],
            ];
            foreach ( $days as $i => $d ) : ?>
            <div class="bes-kr-fade mb-4 last:mb-0" x-data="{open: <?php echo $i === 0 ? 'true' : 'false'; ?>}">
                <button class="kr-day-toggle w-full flex items-center gap-5 text-left bg-white/60 hover:bg-white/80 rounded px-6 py-4 transition-colors cursor-pointer"
                        data-index="<?php echo $i; ?>">
                    <span class="shrink-0 w-12 h-12 rounded-full bg-bes-forest flex items-center justify-center">
                        <span class="font-display text-base text-bes-parchment"><?php echo ( $i + 1 ); ?></span>
                    </span>
                    <span class="flex-1">
                        <span class="block font-body text-[11px] text-bes-olive tracking-nav uppercase"><?php echo $d['day']; ?></span>
                        <span class="block font-display text-xl text-bes-forest-deep"><?php echo $d['title']; ?></span>
                    </span>
                    <svg class="kr-day-chevron w-5 h-5 text-bes-bark-muted transition-transform duration-300 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="kr-day-body overflow-hidden transition-all duration-400 <?php echo $i === 0 ? '' : 'hidden'; ?>">
                    <div class="px-6 py-5 pl-[calc(1.5rem+3rem+1.25rem)]">
                        <p class="text-sm text-bes-bark leading-relaxed max-w-3xl"><?php echo $d['body']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ═══════════════════════════════════════
         7. TYPICAL DAY SCHEDULE
    ═══════════════════════════════════════ -->
    <section class="relative py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1558862107-d49ef2a04d72?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1558862107-d49ef2a04d72?w=1200&q=70&auto=format';"
                 alt="Bali terraced hillside landscape at golden hour"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/85"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 md:px-10">
            <div class="bes-kr-fade text-center mb-12">
                <p class="font-body !text-bes-gold-soft text-xs tracking-nav uppercase mb-2">Dawn to Dusk</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display">
                    A Typical Day
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 gap-x-14 gap-y-4">
                <?php
                $schedule = [
                    ['05:30','Morning stillness &amp; gentle wake'],
                    ['06:00','Sunrise Bali Hatha Yoga'],
                    ['07:30','Healing &amp; Mindfulness Meditation'],
                    ['08:30','Nourishing breakfast'],
                    ['09:30','Workshop / Ceremony / Excursion'],
                    ['12:00','Mindful lunch &amp; quiet rest'],
                    ['14:00','Guided meditation &amp; journaling'],
                    ['15:30','Sound healing / private session'],
                    ['17:00','Sunset Detox Yin Yoga'],
                    ['18:30','Evening gratitude meditation'],
                    ['19:30','Dinner'],
                    ['21:00','Noble silence &amp; rest'],
                ];
                foreach ( $schedule as $s ) : ?>
                <div class="bes-kr-fade flex items-baseline gap-4 border-b border-bes-cream/10 pb-2.5">
                    <span class="font-display text-base !text-bes-gold shrink-0 w-14"><?php echo $s[0]; ?></span>
                    <span class="text-sm text-bes-cream/85"><?php echo $s[1]; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <p class="bes-kr-fade text-center text-xs text-bes-cream/40 italic mt-8">
                Schedule adapts to ceremony dates, moon phases, and temple availability.
            </p>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         8. WHO IS THIS FOR + HOW IT FITS
    ═══════════════════════════════════════ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-14 md:gap-20">

                <!-- Left: Who it's for -->
                <div class="bes-kr-fade">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Is This Your Path?</p>
                    <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-6">
                        Who This Retreat Serves
                    </h2>
                    <div class="space-y-4">
                        <?php
                        $who = [
                            'You feel weighed down by recurring patterns &mdash; in relationships, health, career, or emotional life &mdash; and sense their roots go deeper than surface circumstances.',
                            'You are seeking <strong class="text-bes-forest-deep">spiritual awakening</strong> and a tangible connection with something beyond the material pace of daily existence.',
                            'You are processing grief, burnout, major life transitions, or chronic stress that conventional approaches have not resolved.',
                            'You want to understand the concept of <strong class="text-bes-forest-deep">karmaphala</strong> experientially, not just intellectually, and learn to plant seeds of positive intention going forward.',
                            'You are drawn to Balinese spiritual tradition and wish to experience authentic healing practices in their original cultural setting, near the sacred energy of Ubud.',
                        ];
                        foreach ( $who as $w ) : ?>
                        <div class="flex gap-3 items-start">
                            <svg class="w-5 h-5 text-bes-leaf shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            <p class="text-sm leading-relaxed text-bes-bark"><?php echo $w; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Right: Program Pathway -->
                <div class="bes-kr-fade">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Your Journey at Bali Eling Spirit</p>
                    <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-6">
                        Where Karma Retreat Fits
                    </h2>
                    <p class="text-sm text-bes-bark leading-relaxed mb-6">
                        Pasraman Bali Eling Spirit offers a layered progression of programs, each
                        building deeper than the last. The Karma Retreat occupies a pivotal middle
                        position &mdash; more immersive than a single-day experience, and an ideal
                        gateway to the most intensive transformation.
                    </p>

                    <!-- Pathway steps -->
                    <div class="space-y-3">
                        <?php
                        $path = [
                            ['name' => 'Healing Retreat',   'dur' => '5 hours',    'note' => 'Introduction &mdash; relieve fatigue, balance energy',                       'active' => false],
                            ['name' => 'Tapa Brata',        'dur' => '4 days',     'note' => 'Heal inner wounds, activate chakras, discover self',                        'active' => false],
                            ['name' => 'Karma Retreat',     'dur' => '5 days',     'note' => 'Release karmic burdens, find meaning, deep healing',                        'active' => true],
                            ['name' => 'Punarbawa Retreat', 'dur' => '7 days',     'note' => 'The most immersive &mdash; complete spiritual rebirth',                     'active' => false],
                        ];
                        foreach ( $path as $step ) : ?>
                        <div class="flex items-center gap-4 p-3 rounded <?php echo $step['active']
                            ? 'bg-bes-forest text-bes-parchment ring-2 ring-bes-gold/50'
                            : 'bg-white/50 text-bes-forest-deep'; ?>">
                            <div class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center <?php echo $step['active']
                                ? 'bg-bes-gold text-bes-forest-deep'
                                : 'bg-bes-sage/30 text-bes-forest'; ?>">
                                <?php if ( $step['active'] ) : ?>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                <?php else : ?>
                                    <span class="w-2 h-2 rounded-full <?php echo $step['active'] ? 'bg-bes-forest-deep' : 'bg-bes-forest/40'; ?>"></span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-display text-base leading-snug">
                                    <?php echo $step['name']; ?>
                                    <span class="font-body text-xs opacity-60 ml-1"><?php echo $step['dur']; ?></span>
                                </p>
                                <p class="text-xs opacity-70 leading-snug mt-0.5"><?php echo $step['note']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         9. LOCATION BAND
    ═══════════════════════════════════════ -->
    <section class="bg-bes-cream py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            <div class="bes-kr-fade grid md:grid-cols-5 gap-8 items-center">
                <div class="md:col-span-3">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Setting</p>
                    <h2 class="font-display text-2xl md:text-3xl text-bes-forest-deep tracking-display mb-4">
                        Pejeng Kangin, Ubud &mdash; Bali
                    </h2>
                    <p class="text-sm text-bes-bark leading-relaxed mb-4">
                        Pasraman Bali Eling Spirit sits in Banjar Umadawa, Pejeng Kangin,
                        Tampaksiring &mdash; the spiritual heartland of Gianyar Regency. Surrounded by
                        ancient rice terraces, sacred river valleys, and temple sites dating back
                        over a millennium, this is one of Bali&rsquo;s most concentrated zones of
                        spiritual energy. The Pasraman&rsquo;s location in the greater Ubud area
                        provides rich oxygen, dense jungle canopy, birdsong, and an environment
                        that naturally draws the mind inward.
                    </p>
                    <div class="p-4 bg-bes-leaf-soft/15 rounded border border-bes-sage/15 text-xs text-bes-bark leading-relaxed">
                        <strong class="text-bes-forest-deep">Address:</strong> Br. Umadawa, Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552<br>
                        <strong class="text-bes-forest-deep">Contact:</strong> +62 812 2888 8873 &middot; pasramanbalielingspirit@gmail.com<br>
                        <strong class="text-bes-forest-deep">Hours:</strong> 09:00 &ndash; 20:00 WITA
                    </div>
                </div>
                <div class="md:col-span-2 bes-kr-zoom rounded shadow-md">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&h=500&q=80&auto=format&fit=crop&crop=center"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');"
                         alt="Aerial view of lush Ubud Bali jungle landscape"
                         class="w-full h-[300px] md:h-[360px] object-cover" loading="lazy" />
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         10. FAQ
    ═══════════════════════════════════════ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="bes-kr-fade text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Before You Come</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Common Questions
                </h2>
                <div class="bes-kr-divider bg-bes-gold mx-auto"></div>
            </div>

            <?php
            $faqs = [
                [
                    'q' => 'Do I need yoga or meditation experience to join?',
                    'a' => 'Not at all. The Karma Retreat welcomes absolute beginners and experienced practitioners alike. All sessions are guided step by step, and practices are adapted to your individual capacity. What matters is sincerity and an open heart.',
                ],
                [
                    'q' => 'Is this a group retreat or a private experience?',
                    'a' => 'The Karma Retreat is a <strong>private program</strong> &mdash; tailored specifically to your needs. You can book individually or with a small group. You will receive personal guidance from the masters throughout the five days.',
                ],
                [
                    'q' => 'Where do I stay during the retreat?',
                    'a' => 'The Pasraman does not currently provide on-site accommodation. Participants who need overnight lodging are assisted in finding comfortable stays nearby in the Pejeng Kangin or Ubud area &mdash; villa-style options are available within minutes of the Pasraman grounds.',
                ],
                [
                    'q' => 'How is the Karma Retreat different from the Healing Retreat?',
                    'a' => 'The Healing Retreat is a single 5-hour session focused on immediate stress relief and energy rebalancing. The Karma Retreat is far more immersive &mdash; a 5-day deep dive into karmic patterns, spiritual awakening, and sustained transformation. It is often chosen as the natural next step after a Healing Retreat experience.',
                ],
                [
                    'q' => 'What should I bring?',
                    'a' => 'Comfortable yoga clothing (2&ndash;3 sets), a personal journal, traditional Balinese attire for ceremonies (sarong and sash &mdash; easily found locally), a towel, and a willingness to be present. All retreat materials and ceremonial supplies are provided by the Pasraman.',
                ],
                [
                    'q' => 'Can I extend into the Punarbawa Retreat afterward?',
                    'a' => 'Yes. Many participants feel called to continue after the Karma Retreat. The 7-day Punarbawa Retreat builds directly upon this experience and represents the most complete transformation program offered at the Pasraman. The team can help you plan a seamless extension.',
                ],
            ];
            foreach ( $faqs as $f ) : ?>
            <div class="bes-kr-fade mb-5 last:mb-0">
                <button class="kr-faq-btn w-full text-left flex items-start gap-3 cursor-pointer group border-b border-bes-sage/20 pb-5" aria-expanded="false">
                    <svg class="w-5 h-5 !text-bes-gold shrink-0 mt-0.5 transition-transform duration-300 group-[.is-open]:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14m-7-7h14"/></svg>
                    <span>
                        <span class="block font-display text-lg text-bes-forest-deep"><?php echo $f['q']; ?></span>
                        <span class="kr-faq-answer hidden block mt-2 text-sm text-bes-bark leading-relaxed"><?php echo $f['a']; ?></span>
                    </span>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
         11. FINAL CTA
    ═══════════════════════════════════════ -->
    <section class="bg-bes-forest-deep py-24 md:py-32 text-center">
        <div class="max-w-2xl mx-auto px-6 md:px-10">

            <p class="bes-kr-fade font-display italic !text-bes-gold-soft text-lg md:text-xl mb-4">
                &ldquo;The law of karma teaches that you are the architect of your own destiny.&rdquo;
            </p>

            <h2 class="bes-kr-fade font-display text-3xl md:text-5xl text-bes-parchment tracking-display mb-6 leading-tight">
                Five Days to Release<br>What No Longer Serves You
            </h2>

            <p class="bes-kr-fade font-body text-base md:text-lg text-bes-cream/85 leading-relaxed mb-10 max-w-xl mx-auto">
                Step into the Karma Retreat at Pasraman Bali Eling Spirit &mdash; and step
                out carrying lighter energy, clearer purpose, and the conscious ability
                to shape your future with intention.
            </p>

            <div class="bes-kr-fade flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2.5 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Book via WhatsApp
                </a>
                <a href="https://balielingspirit.org/en/our-programs-en/"
                   class="inline-flex items-center justify-center gap-2 border border-bes-parchment/30 hover:border-bes-parchment/60
                          text-bes-parchment font-body font-medium tracking-label uppercase text-sm px-10 py-4 rounded
                          transition-all duration-300 hover:bg-bes-parchment/5">
                    View All Programs
                </a>
            </div>
        </div>
    </section>


    </div><!-- /.bes-karma-retreat -->


    <!-- ─── JS: scroll reveal + day accordion + FAQ toggle (no deps) ─── -->
    <script>
    (function(){
        /* ── Scroll reveal ── */
        var fadeEls = document.querySelectorAll('.bes-kr-fade,.bes-kr-scale');
        if ('IntersectionObserver' in window) {
            var obs = new IntersectionObserver(function(entries){
                entries.forEach(function(e){
                    if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -30px 0px' });
            fadeEls.forEach(function(el){ obs.observe(el); });
        } else {
            fadeEls.forEach(function(el){ el.classList.add('in-view'); });
        }

        /* ── Day-by-day accordion ── */
        document.querySelectorAll('.kr-day-toggle').forEach(function(btn){
            btn.addEventListener('click', function(){
                var body    = this.nextElementSibling;
                var chevron = this.querySelector('.kr-day-chevron');
                var isOpen  = !body.classList.contains('hidden');

                /* close all */
                document.querySelectorAll('.kr-day-body').forEach(function(b){ b.classList.add('hidden'); });
                document.querySelectorAll('.kr-day-chevron').forEach(function(c){ c.style.transform = ''; });

                /* open clicked (if it was closed) */
                if (!isOpen) {
                    body.classList.remove('hidden');
                    if (chevron) chevron.style.transform = 'rotate(180deg)';
                }
            });
        });

        /* ── FAQ toggle ── */
        document.querySelectorAll('.kr-faq-btn').forEach(function(btn){
            btn.addEventListener('click', function(){
                var answer = this.querySelector('.kr-faq-answer');
                var open   = this.classList.toggle('is-open');
                this.setAttribute('aria-expanded', open);
                if (answer) answer.classList.toggle('hidden', !open);
            });
        });
    })();
    </script>

    <?php
    return ob_get_clean();
}