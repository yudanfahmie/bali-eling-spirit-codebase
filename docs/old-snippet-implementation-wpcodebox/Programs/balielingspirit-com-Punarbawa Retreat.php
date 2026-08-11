<?php
/**
 * ─────────────────────────────────────────────────────────────
 *  Shortcode : [bes_punarbawa_retreat]
 *  Page      : /punarbawa-retreat/
 *  Site      : Pasraman Bali Eling Spirit
 * ─────────────────────────────────────────────────────────────
 *  Uses BES Tailwind design tokens already loaded by the theme.
 *  No duplicate color / font declarations — content only.
 * ─────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_punarbawa_retreat', 'bes_punarbawa_retreat_render' );

function bes_punarbawa_retreat_render( $atts ) {

    $a = shortcode_atts([
        'wa'   => '6281228888873',
        'lang' => 'en',
    ], $atts, 'bes_punarbawa_retreat' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I am interested in the Punarbawa Retreat 7 Days 6 Nights. Please share more details.' );

    ob_start();
    ?>

    <!-- ───── Punarbawa Retreat : scoped micro-styles (animation only) ───── -->
    <style>
    .bes-pr-reveal{opacity:0;transform:translateY(28px);transition:opacity .75s cubic-bezier(.22,1,.36,1),transform .75s cubic-bezier(.22,1,.36,1)}
    .bes-pr-reveal.is-vis{opacity:1;transform:translateY(0)}
    .bes-pr-img-wrap{overflow:hidden}
    .bes-pr-img-wrap img{transition:transform .7s cubic-bezier(.22,1,.36,1)}
    .bes-pr-img-wrap:hover img{transform:scale(1.05)}
    .bes-pr-line{display:flex;align-items:center;gap:.75rem;justify-content:center}
    .bes-pr-line::before,.bes-pr-line::after{content:'';flex:0 0 40px;height:1px;background:currentColor;opacity:.35}
    @keyframes besFadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
    .bes-pr-stagger>*{animation:besFadeUp .7s cubic-bezier(.22,1,.36,1) both}
    .bes-pr-stagger>*:nth-child(1){animation-delay:.1s}
    .bes-pr-stagger>*:nth-child(2){animation-delay:.25s}
    .bes-pr-stagger>*:nth-child(3){animation-delay:.4s}
    .bes-pr-stagger>*:nth-child(4){animation-delay:.55s}
    .bes-pr-stagger>*:nth-child(5){animation-delay:.7s}
    </style>


    <div class="bes-punarbawa font-body text-bes-forest-deep">

    <section class="relative min-h-[95vh] flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1920&auto=format&fit=crop"
                 alt="Sacred Balinese temple gates shrouded in morning mist"
                 class="w-full h-full object-cover object-center transform scale-105 duration-[20s] ease-out opacity-90" 
                 loading="eager" />
            
            <div class="absolute inset-0 bg-gradient-to-b from-bes-forest-deep/80 via-bes-forest-deep/40 to-bes-forest-deep/90"></div>
            
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,0,0,0)_0%,rgba(0,0,0,0.5)_100%)]"></div>
        </div>

        <div class="relative z-10 text-center px-6 max-w-4xl mx-auto bes-pr-stagger flex flex-col items-center mt-12">
            
            <div class="inline-flex items-center gap-4 mb-6 opacity-95">
                <span class="w-10 md:w-16 h-[1px] bg-bes-gold/50"></span>
                <p class="font-display !text-bes-gold tracking-[0.2em] text-sm md:text-base uppercase font-medium">
                    Pasraman Bali Eling Spirit
                </p>
                <span class="w-10 md:w-16 h-[1px] bg-bes-gold/50"></span>
            </div>

            <h1 class="font-display font-light text-6xl md:text-8xl text-bes-parchment tracking-tight leading-none mb-6 drop-shadow-lg">
                Punarbawa Retreat
            </h1>

            <div class="bes-pr-line flex items-center justify-center gap-3 mb-8">
                <span class="font-display italic !text-bes-gold-soft text-2xl md:text-3xl font-light tracking-wide">
                    7 Days <span class="!text-bes-gold/40 mx-2">&middot;</span> 6 Nights
                </span>
            </div>

            <p class="font-body text-bes-cream/95 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto mb-12 font-light tracking-wide drop-shadow-md">
                A sacred journey of spiritual rebirth &mdash; release the weight of past karma,
                awaken your True Self, and return home profoundly transformed.
            </p>

            <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
               class="group relative inline-flex items-center gap-3 bg-bes-gold text-bes-forest-deep
                      font-body font-semibold tracking-widest uppercase text-sm px-10 py-4 rounded-sm transition-all
                      duration-500 hover:bg-bes-gold-soft hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(212,175,55,0.4)] overflow-hidden">
                <div class="absolute inset-0 -translate-x-full bg-white/20 group-hover:translate-x-full transition-transform duration-700 ease-in-out"></div>
                
                <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110 duration-300 relative z-10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
                <span class="relative z-10">Reserve Your Journey</span>
            </a>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-3 opacity-70 hover:opacity-100 transition-opacity duration-300">
            <span class="font-display text-bes-parchment/60 text-[10px] tracking-[0.2em] uppercase">Discover</span>
            <div class="animate-bounce">
                <svg class="w-5 h-5 text-bes-parchment/80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
        
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  2 · THE MEANING OF PUNARBAWA                            ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bes-pr-reveal text-center mb-14">
                <p class="font-display italic text-bes-olive text-lg mb-2">पुनर्भव</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    What Is Punarbawa?
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                <!-- Image -->
                <div class="bes-pr-reveal bes-pr-img-wrap rounded-sm shadow-lg">
                    <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop"
                         alt="Person meditating in serene natural setting at sunrise"
                         class="w-full h-[420px] object-cover" loading="lazy" />
                </div>

                <!-- Text -->
                <div class="bes-pr-reveal">
                    <p class="text-base leading-relaxed text-bes-bark mb-5">
                        <strong class="text-bes-forest-deep font-semibold">Punarbawa</strong> (Sanskrit: <em>Punarbhava</em>)
                        translates to <strong class="text-bes-forest-deep font-semibold">&ldquo;renewed becoming&rdquo;</strong>
                        or <strong class="text-bes-forest-deep font-semibold">&ldquo;spiritual rebirth.&rdquo;</strong>
                        Rooted in the Hindu and Buddhist traditions of Bali, the concept describes
                        the transformative moment when a soul sheds the accumulated burdens of past karma
                        and steps forward into a purified state of awareness.
                    </p>
                    <p class="text-base leading-relaxed text-bes-bark mb-5">
                        In Balinese spirituality, life exists across two realms &mdash; <em>sekala</em> (the seen,
                        physical world) and <em>niskala</em> (the unseen, spiritual world). The Punarbawa Retreat
                        bridges both, guiding you through ancient healing practices that restore harmony between
                        body, mind, and spirit.
                    </p>
                    <p class="text-base leading-relaxed text-bes-bark">
                        Over seven days and six nights, this deeply private program at Pasraman Bali Eling Spirit
                        takes you through a carefully structured progression &mdash; from karmic release and
                        energy purification to present-moment awareness and the rediscovery of your life&rsquo;s
                        true purpose.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  3 · KEY NUMBERS AT A GLANCE                             ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

                <?php
                $stats = [
                    ['num' => '7',  'label' => 'Sunrise Hatha Yoga'],
                    ['num' => '27', 'label' => 'Healing Meditations'],
                    ['num' => '4',  'label' => 'Sound Healing Sessions'],
                    ['num' => '2',  'label' => 'UNESCO Temple Excursions'],
                ];
                foreach ( $stats as $s ) : ?>
                <div class="bes-pr-reveal">
                    <p class="font-display text-5xl md:text-6xl !text-bes-gold tracking-display mb-2">
                        <?php echo esc_html( $s['num'] ); ?>
                    </p>
                    <p class="font-body text-sm text-bes-cream/80 tracking-label uppercase">
                        <?php echo esc_html( $s['label'] ); ?>
                    </p>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  4 · FULL ACTIVITIES INCLUDED                            ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bes-pr-reveal text-center mb-16">
                <p class="font-body text-bes-olive text-sm tracking-label uppercase mb-2">Your 7-Day Program</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    What&rsquo;s Included
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-x-12 gap-y-10">

                <?php
                $activities = [
                    [
                        'icon'  => '<path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>',
                        'title' => '7 &times; Sunrise Bali Hatha Yoga',
                        'desc'  => 'Greet each dawn with a gentle yet strengthening Bali Hatha Yoga flow. The practice emphasises soft movements designed to awaken the body&rsquo;s prana (life force) while building inner strength &mdash; following the unique Bali Hatha style developed at the Pasraman.',
                    ],
                    [
                        'icon'  => '<path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>',
                        'title' => '6 &times; Sunset Detox Yin Yoga',
                        'desc'  => 'As the golden hour light filters through the jungle canopy, settle into deep yin stretches that target connective tissues, release trapped tension, and prepare the body for a night of restorative sleep.',
                    ],
                    [
                        'icon'  => '<path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                        'title' => '27 &times; Healing &amp; Mindfulness Meditation',
                        'desc'  => 'Multiple daily guided meditation sessions weave through the retreat &mdash; morning intention-setting, mid-day mindfulness, and evening gratitude practice. These sessions train present-moment awareness and cultivate lasting inner peace.',
                    ],
                    [
                        'icon'  => '<path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>',
                        'title' => '1 &times; Mother Earth Purification',
                        'desc'  => 'A deeply sacred Balinese ceremony connecting you directly with the elemental energies of the earth. Through offerings, mantras, and meditative communion with nature, this ritual cleanses the energy body at its foundation.',
                    ],
                    [
                        'icon'  => '<path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                        'title' => '2 &times; Sacred Temple Excursion',
                        'desc'  => 'Visit sacred temples in the Tampaksiring and Pejeng region &mdash; cultural heritage sites protected by UNESCO. Walk the ancient grounds, participate in prayer, and absorb the spiritual vibrations of Bali&rsquo;s most revered holy sites.',
                    ],
                    [
                        'icon'  => '<path d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>',
                        'title' => '4 &times; Sacred Sound Healing',
                        'desc'  => 'Tibetan singing bowls, sacred mantras, and resonant frequencies wash through the body during these immersive sound healing sessions &mdash; dissolving stress, opening blocked energy pathways, and restoring vibrational harmony to every cell.',
                    ],
                    [
                        'icon'  => '<path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>',
                        'title' => '1 &times; Private Consultation',
                        'desc'  => 'A personal one-on-one session with the Pasraman master to map your life challenges, uncover karmic patterns, and design a path forward. This private consultation tailors the retreat&rsquo;s teachings to your unique spiritual journey.',
                    ],
                    [
                        'icon'  => '<path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
                        'title' => '2 &times; Transformative Workshops',
                        'desc'  => '<em>Manifestation with the Power of Mind</em> &mdash; learn to harness focused intention as a creative force. <em>Discovering Your True Self through Meditation</em> &mdash; go beyond technique into the direct experience of your authentic nature.',
                    ],
                    [
                        'icon'  => '<path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        'title' => '1-Hour Spa Relaxing Massage',
                        'desc'  => 'A nurturing full-body massage to ease physical tension and integrate the deep emotional processing of the retreat. This session honours the Balinese healing tradition that treats body and spirit as one.',
                    ],
                    [
                        'icon'  => '<path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
                        'title' => 'Digital Detox Protocol',
                        'desc'  => 'Participants are guided to fast from social media and mobile devices throughout the retreat &mdash; creating space for genuine stillness, deeper meditation, and an undistracted connection with the present moment.',
                    ],
                ];
                foreach ( $activities as $i => $act ) : ?>
                <div class="bes-pr-reveal flex gap-5">
                    <div class="shrink-0 w-11 h-11 rounded-full bg-bes-leaf-soft/40 flex items-center justify-center mt-0.5">
                        <svg class="w-5 h-5 text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <?php echo $act['icon']; ?>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display text-xl text-bes-forest-deep mb-1.5"><?php echo $act['title']; ?></h3>
                        <p class="text-sm leading-relaxed text-bes-bark"><?php echo $act['desc']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  5 · PHOTO GALLERY BAND                                  ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                <?php
                $gallery = [
                    ['src' => 'https://images.unsplash.com/photo-1545389336-cf090694435e?w=600&q=80&auto=format&fit=crop', 'alt' => 'Yoga practice at sunrise in tropical pavilion'],
                    ['src' => 'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=600&q=80&auto=format&fit=crop', 'alt' => 'Tibetan singing bowls for sound healing therapy'],
                    ['src' => 'https://images.unsplash.com/photo-1518002054494-3a6f94352e9d?w=600&q=80&auto=format&fit=crop', 'alt' => 'Balinese temple ceremony with incense and offerings'],
                    ['src' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&q=80&auto=format&fit=crop', 'alt' => 'Meditation session in lush green nature setting'],
                ];
                foreach ( $gallery as $img ) : ?>
                <div class="bes-pr-reveal bes-pr-img-wrap rounded-sm aspect-square">
                    <img src="<?php echo esc_url( $img['src'] ); ?>"
                         alt="<?php echo esc_attr( $img['alt'] ); ?>"
                         class="w-full h-full object-cover" loading="lazy" />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  6 · YOUR 7-DAY JOURNEY — DAY-BY-DAY FLOW               ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bes-pr-reveal text-center mb-16">
                <p class="font-body text-bes-olive text-sm tracking-label uppercase mb-2">The Transformation Arc</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Your 7-Day Journey
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto mb-6"></div>
                <p class="text-base text-bes-bark max-w-2xl mx-auto leading-relaxed">
                    Each day of the Punarbawa Retreat unfolds intentionally &mdash; building upon the previous
                    to guide you from release to renewal, from introspection to illumination.
                </p>
            </div>

            <?php
            $days = [
                [
                    'day'   => 'Day 1',
                    'title' => 'Arrival &amp; Surrender',
                    'body'  => 'Arrive at Pasraman Bali Eling Spirit in Pejeng Kangin, near Ubud. After a welcoming ceremony and orientation, the day is dedicated to settling into the retreat environment, releasing expectations, and setting your personal sankalpa (intention). Your first sunset yin yoga gently opens the body for the week ahead.',
                ],
                [
                    'day'   => 'Day 2',
                    'title' => 'Karmic Release',
                    'body'  => 'The journey deepens with morning hatha yoga and the first intensive healing meditation session. The focus is on identifying and acknowledging the karmic burdens you carry &mdash; inherited patterns, unresolved trauma, and emotional weight. A sacred sound healing session in the afternoon begins to dissolve these layers.',
                ],
                [
                    'day'   => 'Day 3',
                    'title' => 'Mother Earth Purification',
                    'body'  => 'Today centres around the powerful Mother Earth Purification ceremony &mdash; a traditional Balinese ritual that connects your energy body to the primordial elements. Through mantras, offerings, and meditative communion with the natural surroundings, deep cleansing occurs at the foundation of your being.',
                ],
                [
                    'day'   => 'Day 4',
                    'title' => 'Sacred Temple Pilgrimage',
                    'body'  => 'Venture beyond the Pasraman to visit UNESCO-protected sacred temples in the Tampaksiring region. Walking these ancient grounds, participating in prayer, and absorbing the concentrated spiritual energy of these holy sites adds a powerful dimension to your transformation process.',
                ],
                [
                    'day'   => 'Day 5',
                    'title' => 'Workshops &amp; Self-Mastery',
                    'body'  => 'Today features the two transformative workshops: <em>Manifestation with the Power of Mind</em> explores how focused intention shapes reality, while <em>Discovering Your True Self through Meditation</em> moves beyond technique into direct self-realisation. A second sacred temple excursion completes the day.',
                ],
                [
                    'day'   => 'Day 6',
                    'title' => 'Integration &amp; Healing',
                    'body'  => 'As the retreat approaches its culmination, the focus shifts to integration. Your private consultation session with the master maps your personal insights and creates a continuing path. The spa massage honours your physical body, and a final sound healing session seals in the vibrational shifts of the week.',
                ],
                [
                    'day'   => 'Day 7',
                    'title' => 'Rebirth &amp; Return',
                    'body'  => 'The final sunrise yoga carries a different quality &mdash; lighter, more expansive, infused with the transformation of the preceding days. A closing ceremony of gratitude marks your Punarbawa: your renewed becoming. You depart carrying new energy, clarity, and the tools to sustain your practice at home.',
                ],
            ];
            foreach ( $days as $i => $d ) : ?>
            <div class="bes-pr-reveal relative flex gap-6 mb-10 last:mb-0 pl-2">
                <!-- Timeline dot & line -->
                <div class="shrink-0 flex flex-col items-center">
                    <div class="w-11 h-11 rounded-full bg-bes-forest flex items-center justify-center text-bes-parchment font-display text-sm">
                        <?php echo ( $i + 1 ); ?>
                    </div>
                    <?php if ( $i < count( $days ) - 1 ) : ?>
                    <div class="flex-1 w-px bg-bes-sage/40 mt-2"></div>
                    <?php endif; ?>
                </div>
                <!-- Content -->
                <div class="pb-8">
                    <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1"><?php echo $d['day']; ?></p>
                    <h3 class="font-display text-xl md:text-2xl text-bes-forest-deep tracking-display mb-2"><?php echo $d['title']; ?></h3>
                    <p class="text-sm leading-relaxed text-bes-bark"><?php echo $d['body']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  7 · DAILY RHYTHM                                        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=80&auto=format&fit=crop"
                 alt="Golden sunrise over lush Bali rice terraces"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/85"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6">
            <div class="bes-pr-reveal text-center mb-14">
                <p class="font-body !text-bes-gold-soft text-sm tracking-label uppercase mb-2">From Dawn to Dusk</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display mb-4">
                    A Typical Day
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-x-12 gap-y-6">
                <?php
                $schedule = [
                    ['time' => '05:30', 'act' => 'Wake &amp; Morning Stillness'],
                    ['time' => '06:00', 'act' => 'Sunrise Bali Hatha Yoga'],
                    ['time' => '07:30', 'act' => 'Healing &amp; Mindfulness Meditation'],
                    ['time' => '08:30', 'act' => 'Nourishing Breakfast'],
                    ['time' => '09:30', 'act' => 'Workshop / Ceremony / Excursion'],
                    ['time' => '12:00', 'act' => 'Mindful Lunch &amp; Rest'],
                    ['time' => '14:00', 'act' => 'Afternoon Meditation &amp; Journaling'],
                    ['time' => '15:30', 'act' => 'Sound Healing / Private Session'],
                    ['time' => '17:00', 'act' => 'Sunset Detox Yin Yoga'],
                    ['time' => '18:30', 'act' => 'Evening Gratitude Meditation'],
                    ['time' => '19:30', 'act' => 'Dinner'],
                    ['time' => '21:00', 'act' => 'Noble Silence &amp; Rest'],
                ];
                foreach ( $schedule as $s ) : ?>
                <div class="bes-pr-reveal flex items-baseline gap-4">
                    <span class="font-display text-lg !text-bes-gold shrink-0 w-16"><?php echo $s['time']; ?></span>
                    <span class="text-sm text-bes-cream/90"><?php echo $s['act']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="bes-pr-reveal text-center text-xs text-bes-cream/50 mt-10 italic">
                * Schedule may adjust based on ceremony dates, moon phases, and temple availability.
            </p>
        </div>
    </section>


    <section class="relative bg-bes-parchment py-20 md:py-32 overflow-hidden">
        
        <div class="absolute top-0 right-0 w-64 h-64 bg-bes-olive opacity-5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>

        <div class="relative max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">

                <div class="bes-pr-reveal order-2 md:order-1">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <span class="w-8 h-[1px] bg-bes-olive"></span>
                        <p class="font-body text-bes-olive text-sm font-semibold tracking-widest uppercase">Is This Your Path?</p>
                    </div>
                    
                    <h2 class="font-display text-4xl md:text-5xl text-bes-forest-deep tracking-tight leading-tight mb-8">
                        Who This Retreat<br>Is Designed For
                    </h2>

                    <div class="space-y-2">
                        <?php
                        $personas = [
                            'You feel burdened by unresolved pain, recurring patterns, or the weight of past experiences that conventional approaches haven&rsquo;t resolved.',
                            'You are seeking a <strong class="text-bes-forest-deep font-semibold">spiritual awakening</strong> &mdash; a deeper connection with your true self beyond daily routines and obligations.',
                            'You are processing grief, major life transitions, burnout, or chronic emotional exhaustion and need sacred space for genuine healing.',
                            'You want to understand your <strong class="text-bes-forest-deep font-semibold">karmic journey</strong> and release what no longer serves your highest growth.',
                            'You have completed a shorter program (Healing Retreat or Tapa Brata) and are ready for the next level of transformation.',
                            'You simply crave 7 days of silence, depth, and renewal in one of the world&rsquo;s most spiritually charged landscapes.',
                        ];
                        foreach ( $personas as $p ) : ?>
                        
                        <div class="group flex gap-4 items-start p-3 -ml-3 rounded-lg hover:bg-white/40 transition-colors duration-300">
                            <div class="bg-bes-leaf/10 p-1.5 rounded-full shrink-0 mt-0.5 group-hover:bg-bes-leaf/20 transition-colors duration-300">
                                <svg class="w-4 h-4 text-bes-leaf" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-base leading-relaxed text-bes-bark"><?php echo $p; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bes-pr-reveal relative order-1 md:order-2 px-4 md:px-0">
                    <div class="absolute inset-0 border-2 border-bes-olive/20 rounded-xl transform translate-x-4 translate-y-4 md:translate-x-6 md:translate-y-6 hidden sm:block"></div>
                    
                    <div class="relative bes-pr-img-wrap rounded-xl shadow-2xl overflow-hidden group">
                        <div class="absolute inset-0 bg-bes-forest-deep/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1000&auto=format&fit=crop"
                             alt="Hands in prayer position during meditation in tropical setting"
                             class="w-full h-[400px] md:h-[560px] object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" 
                             loading="lazy" />
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  9 · THE GUIDES                                          ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bes-pr-reveal text-center mb-16">
                <p class="font-body text-bes-olive text-sm tracking-label uppercase mb-2">Your Guides</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Led by Experienced Masters
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-10">

                <!-- Guide 1 -->
                <div class="bes-pr-reveal bg-white/60 rounded-sm p-8 shadow-sm">
                    <h3 class="font-display text-2xl text-bes-forest-deep mb-1">Sri Bhagawan Sriprada Bhaskara</h3>
                    <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-4">Founder &amp; Head Teacher</p>
                    <p class="text-sm leading-relaxed text-bes-bark mb-3">
                        A meditator for over 25 years and dedicated yoga practitioner for more than a decade,
                        Sri Bhagawan Sriprada is the founder of Pasraman Bali Eling Spirit. He holds a
                        500-hour Yoga Teacher Training certification and is the architect of the
                        <strong class="text-bes-forest-deep">Bali Hatha Yoga</strong> system &mdash; a practice
                        emphasising gentle movement paired with deep inner strength.
                    </p>
                    <p class="text-sm leading-relaxed text-bes-bark">
                        His lifelong pursuit of spiritual truth has led him to the conviction that yoga holds the power
                        to transform desires, attitudes, and the very meaning of one&rsquo;s existence. He personally
                        guides the Punarbawa Retreat&rsquo;s most sacred ceremonies and consultations.
                    </p>
                </div>

                <!-- Guide 2 -->
                <div class="bes-pr-reveal bg-white/60 rounded-sm p-8 shadow-sm">
                    <h3 class="font-display text-2xl text-bes-forest-deep mb-1">Jero Ratni</h3>
                    <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-4">Meditation Master &amp; Healer</p>
                    <p class="text-sm leading-relaxed text-bes-bark mb-3">
                        Introduced to meditation at the age of 13, Jero Ratni has spent a lifetime navigating
                        the inner landscape of consciousness. Her sensitivity to subtle energy, born from decades
                        of devoted practice, allows her to perceive and guide the transformation process with
                        remarkable precision and compassion.
                    </p>
                    <p class="text-sm leading-relaxed text-bes-bark">
                        She shares her wisdom through yoga, meditation, spiritual counselling,
                        <strong class="text-bes-forest-deep">Cognitive Alignment Therapy</strong>,
                        7-chakra balancing, and
                        <strong class="text-bes-forest-deep">Tibetan Singing Bowl healing</strong> &mdash;
                        a cornerstone of the Punarbawa sound healing sessions.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  10 · LOCATION & ENVIRONMENT                             ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6">

            <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                <!-- Image -->
                <div class="bes-pr-reveal bes-pr-img-wrap rounded-sm shadow-lg">
                    <img src="https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80&auto=format&fit=crop"
                         alt="Lush green rice terraces and tropical jungle near Ubud Bali"
                         class="w-full h-[420px] object-cover" loading="lazy" />
                </div>

                <!-- Text -->
                <div class="bes-pr-reveal">
                    <p class="font-body text-bes-olive text-sm tracking-label uppercase mb-2">The Setting</p>
                    <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-6">
                        Pejeng Kangin, Ubud &mdash; Bali
                    </h2>
                    <p class="text-base leading-relaxed text-bes-bark mb-5">
                        Pasraman Bali Eling Spirit is nestled in Banjar Umadawa, Pejeng Kangin,
                        in the Tampaksiring sub-district of Gianyar Regency &mdash; the spiritual heartland
                        of Bali, just minutes from the cultural centre of Ubud.
                    </p>
                    <p class="text-base leading-relaxed text-bes-bark mb-5">
                        Surrounded by ancient rice terraces, tropical forest, and sacred river valleys,
                        the Pasraman sits in an area revered for its concentrated spiritual energy.
                        The nearby Pejeng archaeological sites date back over a thousand years, and the
                        region&rsquo;s temples remain active centres of Balinese Hindu worship.
                    </p>
                    <p class="text-base leading-relaxed text-bes-bark">
                        The rich oxygen, birdsong, and pristine natural environment create the ideal
                        conditions for deep meditation, healing, and genuine self-discovery &mdash;
                        a living embodiment of the Balinese balance between <em>sekala</em> and <em>niskala</em>.
                    </p>

                    <div class="mt-6 p-4 bg-bes-leaf-soft/20 rounded-sm border border-bes-sage/20">
                        <p class="text-xs text-bes-bark leading-relaxed">
                            <strong class="text-bes-forest-deep">Address:</strong> Br. Umadawa, Pejeng Kangin,
                            Tampaksiring, Gianyar, Bali 80552<br>
                            <strong class="text-bes-forest-deep">Contact:</strong> +62 812 2888 8873<br>
                            <strong class="text-bes-forest-deep">Hours:</strong> 09.00 &ndash; 20.00 WITA
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  11 · PRACTICAL INFORMATION / FAQ                        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bes-pr-reveal text-center mb-14">
                <p class="font-body text-bes-olive text-sm tracking-label uppercase mb-2">Before You Come</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Good to Know
                </h2>
                <div class="w-16 h-px bg-bes-gold mx-auto"></div>
            </div>

            <?php
            $faqs = [
                [
                    'q' => 'Is prior yoga or meditation experience required?',
                    'a' => 'No. The Punarbawa Retreat welcomes all levels &mdash; from complete beginners to experienced practitioners. Every session is guided with care, and practices are adapted to your individual capacity. What matters most is sincerity and willingness to engage with the process.',
                ],
                [
                    'q' => 'Is the retreat private or group-based?',
                    'a' => 'The Punarbawa Retreat is a <strong>private program</strong>. It is tailored to your personal spiritual needs and can be booked individually or for a small group. You will receive personal guidance from the masters throughout.',
                ],
                [
                    'q' => 'Does the Pasraman provide accommodation?',
                    'a' => 'Currently, the Pasraman does not have on-site accommodation. Participants staying for the full 7 days are assisted in finding comfortable lodging nearby in the Pejeng Kangin or Ubud area. Several villa-style stays are available within minutes of the Pasraman.',
                ],
                [
                    'q' => 'What is the best preparation before arriving?',
                    'a' => 'Come with an open heart and a willingness to surrender to the process. Begin reducing social media use a few days before arrival. Light, comfortable clothing suitable for yoga and traditional Balinese attire for ceremonies is recommended. The Pasraman team will share a detailed preparation guide upon booking.',
                ],
                [
                    'q' => 'How does this relate to the other Bali Eling Spirit programs?',
                    'a' => 'The Punarbawa Retreat is the most immersive program offered &mdash; the culmination of the Pasraman&rsquo;s transformational journey. It is recommended for those who have experienced the Healing Retreat or Tapa Brata, though it is also open to newcomers ready for a deep dive. For shorter experiences, the Healing Retreat (5 hours) or Karma Retreat (5 days) may be appropriate starting points.',
                ],
                [
                    'q' => 'What should I bring?',
                    'a' => 'Comfortable yoga clothing (2&ndash;3 sets), a journal for recording insights and gratitude, traditional Balinese attire (sarong and sash &mdash; available locally), a towel, and an open mind. All retreat materials and ceremonial supplies are provided by the Pasraman.',
                ],
            ];
            foreach ( $faqs as $j => $f ) : ?>
            <div class="bes-pr-reveal mb-6 border-b border-bes-sage/20 pb-6 last:border-0 last:pb-0">
                <button class="w-full text-left flex items-start gap-3 group bes-faq-toggle cursor-pointer" aria-expanded="false">
                    <svg class="w-5 h-5 !text-bes-gold shrink-0 mt-0.5 transition-transform duration-300 group-[.is-open]:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14m-7-7h14"/>
                    </svg>
                    <h3 class="font-display text-lg text-bes-forest-deep"><?php echo $f['q']; ?></h3>
                </button>
                <div class="bes-faq-answer hidden pl-8 pt-3">
                    <p class="text-sm leading-relaxed text-bes-bark"><?php echo $f['a']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  12 · CTA — BOOK YOUR REBIRTH                           ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1558862107-d49ef2a04d72?w=1920&q=80&auto=format&fit=crop"
                 alt="Serene Bali landscape with terraced hills at golden hour"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-gradient-to-br from-bes-forest-deep/80 via-bes-forest/70 to-bes-forest-deep/85"></div>
        </div>

        <div class="relative z-10 text-center max-w-2xl mx-auto px-6 bes-pr-stagger">
            <p class="font-display italic !text-bes-gold-soft text-lg mb-3">
                &ldquo;Difficulties teach that goodness takes time to process.&rdquo;
            </p>
            <h2 class="font-display text-3xl md:text-5xl text-bes-parchment tracking-display mb-6">
                Begin Your<br>Punarbawa
            </h2>
            <p class="font-body text-bes-cream/90 text-base md:text-lg leading-relaxed mb-10 max-w-xl mx-auto">
                Seven days to release what no longer serves you. Seven days to rediscover
                who you truly are. Your renewed becoming awaits at Pasraman Bali Eling Spirit.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2.5 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                    </svg>
                    Book via WhatsApp
                </a>
                <a href="https://balielingspirit.org/en/our-programs-en/"
                   class="inline-flex items-center justify-center gap-2 border border-bes-parchment/40 hover:border-bes-parchment
                          text-bes-parchment font-body font-medium tracking-label uppercase text-sm px-10 py-4 rounded
                          transition-all duration-300 hover:bg-bes-parchment/10">
                    View All Programs
                </a>
            </div>
        </div>
    </section>

    </div><!-- /.bes-punarbawa -->


    <!-- ───── Scroll reveal + FAQ accordion (vanilla JS, no deps) ───── -->
    <script>
    (function(){
        /* Intersection Observer for .bes-pr-reveal */
        var els=document.querySelectorAll('.bes-pr-reveal');
        if('IntersectionObserver' in window){
            var io=new IntersectionObserver(function(entries){
                entries.forEach(function(e){
                    if(e.isIntersecting){e.target.classList.add('is-vis');io.unobserve(e.target);}
                });
            },{threshold:0.15,rootMargin:'0px 0px -40px 0px'});
            els.forEach(function(el){io.observe(el);});
        }else{
            els.forEach(function(el){el.classList.add('is-vis');});
        }

        /* FAQ toggles */
        document.querySelectorAll('.bes-faq-toggle').forEach(function(btn){
            btn.addEventListener('click',function(){
                var answer=this.nextElementSibling;
                var open=this.classList.toggle('is-open');
                this.setAttribute('aria-expanded',open);
                answer.classList.toggle('hidden',!open);
            });
        });
    })();
    </script>

    <?php
    return ob_get_clean();
}