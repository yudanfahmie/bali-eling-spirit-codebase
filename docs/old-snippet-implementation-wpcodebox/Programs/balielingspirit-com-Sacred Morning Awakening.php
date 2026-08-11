<?php
/**
 * ─────────────────────────────────────────────────────────────
 *  Shortcode : [bes_sacred_morning]
 *  Page      : /sacred-morning-awakening/
 *  Brand     : Eling Sanctuary · Bali Eling Spirit
 * ─────────────────────────────────────────────────────────────
 *  Daily immersive morning program: yoga, pranayama, meditation,
 *  sound healing & nourishing breakfast.
 *  IDR 379.000 (+12 % tax) · Available daily except Mondays.
 * ─────────────────────────────────────────────────────────────
 *  BES Tailwind design tokens loaded by theme — no re-declaration.
 * ─────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_sacred_morning', 'bes_sacred_morning_render' );

function bes_sacred_morning_render( $atts ) {

    $a = shortcode_atts([
        'wa'    => '6287825899117',
        'price' => '379.000',
    ], $atts, 'bes_sacred_morning' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I would like to book the Sacred Morning Awakening session. Please confirm availability.' );

    ob_start();
    ?>

    <!-- ─── Sacred Morning Awakening — scoped animation styles ─── -->
    <style>
    .sma-enter{opacity:0;transform:translateY(30px);transition:opacity .75s cubic-bezier(.4,0,.2,1),transform .75s cubic-bezier(.4,0,.2,1)}
    .sma-enter.seen{opacity:1;transform:none}
    .sma-slide-r{opacity:0;transform:translateX(-36px);transition:opacity .7s ease,transform .7s ease}
    .sma-slide-r.seen{opacity:1;transform:none}
    .sma-slide-l{opacity:0;transform:translateX(36px);transition:opacity .7s ease,transform .7s ease}
    .sma-slide-l.seen{opacity:1;transform:none}
    .sma-zoom{overflow:hidden;border-radius:2px}
    .sma-zoom img{transition:transform .6s cubic-bezier(.4,0,.2,1)}
    .sma-zoom:hover img{transform:scale(1.04)}
    .sma-stripe{position:relative}
    .sma-stripe::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;border-radius:2px}
    @keyframes smaSunrise{0%{background-position:0% 80%}50%{background-position:100% 20%}100%{background-position:0% 80%}}
    </style>


    <div class="bes-sacred-morning font-body text-bes-forest-deep">


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  1 · HERO — FULL-WIDTH GOLDEN SUNRISE             ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section data-bes-header="light" class="relative min-h-[94vh] flex items-end overflow-hidden">

        <!-- Background -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1476673160081-cf065607f449?w=1920&h=1080&q=80&auto=format&fit=crop&crop=bottom"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1476673160081-cf065607f449?w=1200&q=70&auto=format';"
                 alt="Golden sunrise light breaking through tropical foliage in Bali"
                 class="w-full h-full object-cover" loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep/90 via-bes-forest-deep/40 to-transparent"></div>
        </div>

        <!-- Content — pushed to bottom -->
        <div class="relative z-10 w-full pb-16 pt-40 md:pt-56 px-6 md:px-10">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-10 items-end">

                <!-- Left 2/3 — headline -->
                <div class="lg:col-span-2">
                    <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-4">
                        Eling Sanctuary &mdash; Daily Immersive Program
                    </p>
                    <h1 class="font-display font-light text-[2.8rem] md:text-6xl lg:text-[4.5rem] text-bes-parchment tracking-display leading-[1.1] mb-5">
                        Sacred Morning<br>Awakening
                    </h1>
                    <p class="text-lg md:text-xl text-bes-cream/90 leading-relaxed max-w-2xl mb-0">
                        Before the world begins its noise, there exists a golden window of
                        stillness. Step into it. This immersive morning journey weaves together
                        Bali Hatha Yoga, sacred pranayama, guided meditation, and Tibetan
                        sound healing &mdash; concluding with a nourishing breakfast that
                        honours the body you have just awakened.
                    </p>
                </div>

                <!-- Right 1/3 — floating price card -->
                <div class="bg-white/10 backdrop-blur-md border border-bes-parchment/20 rounded p-7 text-center lg:text-left">
                    <p class="font-body text-xs !text-bes-gold tracking-label uppercase mb-1">Starting From</p>
                    <p class="font-display text-4xl md:text-5xl text-bes-parchment tracking-display leading-none mb-1">
                        IDR <?php echo esc_html( $a['price'] ); ?>
                    </p>
                    <p class="text-xs text-bes-cream/50 mb-5">per person &middot; +12 % tax</p>
                    <p class="text-xs text-bes-cream/70 mb-4">
                        <svg class="inline w-3.5 h-3.5 mr-1 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Available <strong class="text-bes-cream">daily except Mondays</strong>
                    </p>
                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="block w-full bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep font-body font-semibold
                              tracking-label uppercase text-sm text-center px-6 py-3.5 rounded transition-all duration-300
                              hover:shadow-lg hover:shadow-bes-gold/25">
                        Book Your Morning
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  2 · WHY THIS MORNING MATTERS — INTRO              ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-4xl mx-auto px-6 md:px-10 text-center">

            <p class="sma-enter font-display italic text-bes-olive text-lg mb-2">सूर्य नमस्कार</p>
            <h2 class="sma-enter font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-6">
                Most People Rush Through Their Mornings.<br>
                This Is the Opposite of Rushing.
            </h2>
            <div class="w-14 h-[2px] bg-bes-gold mx-auto mb-8"></div>

            <p class="sma-enter text-base md:text-lg text-bes-bark leading-[1.85] max-w-3xl mx-auto mb-6">
                There is a reason every ancient tradition honours the first hours of daylight.
                The mind is clearest before the clutter of the day settles in. The body is most
                responsive before it stiffens under routine. The spirit is most receptive when
                the world around you is still quiet enough to actually hear it.
            </p>
            <p class="sma-enter text-base md:text-lg text-bes-bark leading-[1.85] max-w-3xl mx-auto mb-6">
                The <strong class="text-bes-forest-deep">Sacred Morning Awakening</strong> at Eling Sanctuary
                harnesses this irreplaceable window. Over a few concentrated hours each morning, you are
                guided through a carefully sequenced progression &mdash; from gentle movement that
                coaxes the body awake, through breathwork that clears the nervous system, into
                meditation that opens the inner landscape, and finally into the resonant frequencies
                of sacred sound healing that integrate everything your body has just experienced.
            </p>
            <p class="sma-enter text-base md:text-lg text-bes-bark leading-[1.85] max-w-3xl mx-auto">
                You leave not just relaxed, but fundamentally re-oriented. Participants consistently
                report that the quality of their entire day &mdash; their decisions, their emotional
                balance, their sense of presence &mdash; shifts measurably after a single session.
                After three or four mornings, the shift becomes something closer to lasting change.
            </p>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  3 · THE MORNING JOURNEY — EDITORIAL ZIG-ZAG       ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="sma-enter text-center mb-20">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Your Morning, Unfolded</p>
                <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug">
                    Four Phases of Awakening
                </h2>
            </div>

            <?php
            $phases = [
                [
                    'num'   => '01',
                    'title' => 'Bali Hatha Yoga &amp; Sun Salutation',
                    'sub'   => 'Movement · Warmth · Vitality',
                    'body'  => 'Your session opens as the tropical dawn is still breaking. The signature Bali Hatha Yoga system &mdash; developed over more than a decade at the Pasraman &mdash; blends gentle yet purposeful postures with the ancient <em>Surya Namaskar</em> (Sun Salutation) sequence. Surya Namaskar is one of the oldest and most revered practices in all of yoga: twelve linked asanas dedicated to <em>Surya</em>, the Hindu solar deity, designed to honour the source of all life on earth while simultaneously awakening every major muscle group, joint, and energy channel in the body. You do not need to be flexible or experienced. The instructor meets you exactly where you are and guides each breath, each transition, with care. What you will notice is a warmth building from the inside out &mdash; not just physical heat, but a kind of inner illumination that makes the rest of the morning feel entirely different from ordinary waking.',
                    'img'   => 'https://images.unsplash.com/photo-1545389336-cf090694435e?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Sunrise yoga practice in open tropical bamboo pavilion',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => '02',
                    'title' => 'Sacred Pranayama',
                    'sub'   => 'Breath · Clarity · Calm',
                    'body'  => 'Once the body has been warmed and opened, the practice narrows its focus to the single most powerful tool you carry with you every moment of your life: your breath. Pranayama &mdash; from the Sanskrit <em>prana</em> (life force) and <em>ayama</em> (extension) &mdash; is the ancient science of controlled breathing. In Balinese spiritual tradition, the breath is understood as the bridge between the physical world (<em>sekala</em>) and the unseen world (<em>niskala</em>). Through guided techniques, you learn to lengthen your inhale, deepen your exhale, and access a state of nervous system regulation that most people never experience in ordinary life. The effect is tangible within minutes: mental chatter quiets, the heart rate settles into a steady rhythm, and a profound clarity begins to emerge &mdash; as if someone has gently wiped a fogged window and the view beyond is suddenly, startlingly sharp.',
                    'img'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Person practising mindful breathing in serene natural morning light',
                    'dir'   => 'reverse',
                ],
                [
                    'num'   => '03',
                    'title' => 'Guided Healing Meditation',
                    'sub'   => 'Stillness · Presence · Insight',
                    'body'  => 'With the body awakened and the breath refined, your system is now optimally prepared for the deepest layer of the morning practice: meditation. This is not the kind of meditation where you sit and struggle to stop thinking. The facilitators at Eling Sanctuary use a guided approach rooted in decades of Balinese contemplative tradition, leading you gently inward through layers of awareness until you arrive at a state of genuine stillness. In this stillness, something remarkable often happens: insights arise without effort. Emotional knots soften. A sense of spaciousness opens up that feels qualitatively different from ordinary relaxation. Participants frequently describe it as the first time they have truly felt <em>present</em> &mdash; not thinking about the past, not planning the future, but simply inhabiting the richness of this exact moment.',
                    'img'   => 'https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Peaceful meditation during golden hour with tropical surroundings',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => '04',
                    'title' => 'Tibetan Sound Healing &amp; Nourishing Breakfast',
                    'sub'   => 'Resonance · Integration · Nourishment',
                    'body'  => 'The journey concludes with an experience that many guests call the highlight of their entire stay in Bali. As you lie in deep relaxation, the resonant tones of Tibetan singing bowls are played around and upon your body. Each bowl is tuned to specific frequencies that correspond to the body&rsquo;s energy centres, and the vibrations travel through tissue, bone, and fluid in a way that no other modality can replicate. Stress dissolves at a cellular level. Blocked energy pathways open. The entire nervous system recalibrates into a state of deep coherence. When the last tone fades, you rise slowly and make your way to a thoughtfully prepared breakfast &mdash; wholesome, plant-forward Balinese cuisine designed to honour the body you have just awakened and nourish it for the day ahead. You sit, you eat mindfully, and you notice that the world around you looks and feels subtly but unmistakably different.',
                    'img'   => 'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Tibetan singing bowls arranged for a sacred sound healing ceremony',
                    'dir'   => 'reverse',
                ],
            ];

            foreach ( $phases as $i => $p ) :
                $img_order = $p['dir'] === 'reverse' ? 'lg:order-1' : 'lg:order-2';
                $txt_order = $p['dir'] === 'reverse' ? 'lg:order-2' : 'lg:order-1';
                $slide_cls = $p['dir'] === 'reverse' ? 'sma-slide-l' : 'sma-slide-r';
            ?>
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-24 last:mb-0">

                <!-- Image -->
                <div class="<?php echo $img_order; ?> sma-enter sma-zoom shadow-lg">
                    <img src="<?php echo esc_url( $p['img'] ); ?>"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');this.parentElement.style.minHeight='380px';"
                         alt="<?php echo esc_attr( $p['alt'] ); ?>"
                         class="w-full h-[380px] md:h-[480px] object-cover" loading="lazy" />
                </div>

                <!-- Text -->
                <div class="<?php echo $txt_order; ?> <?php echo $slide_cls; ?>">
                    <div class="flex items-baseline gap-4 mb-4">
                        <span class="font-display text-6xl !text-bes-gold/25 leading-none tracking-display"><?php echo $p['num']; ?></span>
                        <div>
                            <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep tracking-display leading-snug"><?php echo $p['title']; ?></h3>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mt-0.5"><?php echo $p['sub']; ?></p>
                        </div>
                    </div>
                    <p class="text-sm md:text-base text-bes-bark leading-[1.85]"><?php echo $p['body']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  4 · BEFORE & AFTER — TRANSFORMATION CONTRAST      ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="sma-enter text-center mb-14">
                <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display mb-3">
                    What Changes in a Single Morning
                </h2>
                <p class="text-base text-bes-cream/70 max-w-xl mx-auto leading-relaxed">
                    You arrive carrying the residue of yesterday. You leave carrying the clarity of now.
                    Here is what participants consistently report after one session.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 md:gap-8">

                <!-- BEFORE column -->
                <div class="sma-enter bg-bes-forest-92/60 rounded p-8">
                    <p class="font-display text-lg text-bes-cream/50 mb-5">Before</p>
                    <?php
                    $before = [
                        'Restless mind, scattered attention, difficulty being present',
                        'Shallow breathing, tightness in the chest and shoulders',
                        'Emotional residue from unresolved stress or poor sleep',
                        'A vague sense of disconnection from your own body',
                        'Low energy masked by caffeine and routine autopilot',
                    ];
                    foreach ( $before as $b ) : ?>
                    <div class="flex gap-3 items-start mb-3 last:mb-0">
                        <svg class="w-4 h-4 text-bes-bark-muted shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 12H4"/></svg>
                        <p class="text-sm text-bes-cream/60 leading-relaxed"><?php echo $b; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- AFTER column -->
                <div class="sma-enter bg-bes-gold/10 border border-bes-gold/20 rounded p-8">
                    <p class="font-display text-lg !text-bes-gold mb-5">After</p>
                    <?php
                    $after = [
                        'Grounded focus, heightened awareness, a tangible sense of presence',
                        'Deep, full breathing that the body continues naturally all day',
                        'Emotional lightness and a clear, quiet inner space',
                        'Renewed connection between body, breath, and consciousness',
                        'Genuine sustained energy that feels earned, not borrowed',
                    ];
                    foreach ( $after as $af ) : ?>
                    <div class="flex gap-3 items-start mb-3 last:mb-0">
                        <svg class="w-4 h-4 !text-bes-gold shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        <p class="text-sm text-bes-cream/90 leading-relaxed"><?php echo $af; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  5 · GUEST VOICES                                   ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="sma-enter text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Voices from the Mat</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    What Guests Say
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <?php
                $reviews = [
                    [
                        'text'   => 'I&rsquo;ve joined both Healing Retreat and Surya Namaskar &mdash; both helped me through my spiritual awakening. The programs, the loving yogis, and the energy helped me find answers I&rsquo;d long searched for. Truly healing.',
                        'name'   => 'Mandy Mirahsari',
                        'origin' => 'Retreat Participant',
                    ],
                    [
                        'text'   => 'So grateful for today&rsquo;s experience. It was a truly spiritual and renewing morning. The meditation, yoga, sound healing, and water cleansing were beautifully arranged. The food was great, and the staff made it unforgettable.',
                        'name'   => 'Monica Wahib',
                        'origin' => 'Healing Session Guest',
                    ],
                    [
                        'text'   => 'A sacred place where I could reconnect with my inner child. The meditation, yoga, and sound healing brought deep healing. Truly a must-try experience for anyone visiting Bali who wants something beyond the surface.',
                        'name'   => 'Krystya Darma',
                        'origin' => 'Morning Awakening Guest',
                    ],
                ];
                foreach ( $reviews as $r ) : ?>
                <div class="sma-enter bg-white/70 rounded p-7">
                    <svg class="w-8 h-8 !text-bes-gold/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p class="text-sm text-bes-bark leading-[1.8] mb-5"><?php echo $r['text']; ?></p>
                    <div>
                        <p class="font-display text-base text-bes-forest-deep"><?php echo $r['name']; ?></p>
                        <p class="text-xs text-bes-bark-muted"><?php echo $r['origin']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  6 · WHO IS THIS FOR                                ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- Image -->
                <div class="sma-enter sma-zoom shadow-lg">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=600&q=80&auto=format&fit=crop&crop=center"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');this.parentElement.style.minHeight='340px';"
                         alt="Group meditation practice in tropical open-air setting"
                         class="w-full h-[360px] md:h-[440px] object-cover" loading="lazy" />
                </div>

                <!-- Text -->
                <div class="sma-enter">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-3">Is This for You?</p>
                    <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-6">
                        Perfect Whether You Have<br>One Morning or Many
                    </h2>

                    <p class="text-base text-bes-bark leading-[1.85] mb-8">
                        The Sacred Morning Awakening was designed to be accessible to absolutely everyone.
                        You do not need yoga experience, spiritual knowledge, or any special preparation.
                        All you need is the willingness to slow down for a few hours and give yourself
                        permission to feel something real. Here are some of the people who benefit most:
                    </p>

                    <div class="space-y-5">
                        <?php
                        $personas = [
                            [
                                'bold' => 'Travellers passing through Ubud',
                                'text' => 'who want a single transformative morning experience without committing to a multi-day retreat. You are visiting Bali and you want one truly meaningful wellness experience to take home with you.',
                            ],
                            [
                                'bold' => 'First-time yoga and meditation practitioners',
                                'text' => 'who are curious but perhaps intimidated by longer or more intensive programs. The Sacred Morning Awakening is the gentlest possible entry point into Balinese spiritual practice.',
                            ],
                            [
                                'bold' => 'Experienced practitioners seeking depth',
                                'text' => 'who want to experience the Bali Hatha Yoga system, traditional pranayama, and Tibetan singing bowl healing in an authentic cultural setting &mdash; guided by facilitators with decades of combined practice.',
                            ],
                            [
                                'bold' => 'Anyone carrying stress, fatigue, or emotional heaviness',
                                'text' => 'who needs a reset. Even one session can interrupt the cycle of accumulated tension and create genuine space for the body and mind to recalibrate.',
                            ],
                            [
                                'bold' => 'Guests considering a deeper retreat',
                                'text' => 'who want to experience the energy and approach of Eling Sanctuary before committing to the Healing Retreat, Karma Retreat, or Punarbawa Retreat. Consider this your introduction.',
                            ],
                        ];
                        foreach ( $personas as $pp ) : ?>
                        <div class="sma-stripe pl-5" style="--tw-border-opacity:1">
                            <div class="absolute left-0 top-0 w-[3px] h-full bg-bes-gold/40 rounded"></div>
                            <p class="text-sm text-bes-bark leading-[1.8]">
                                <strong class="text-bes-forest-deep"><?php echo $pp['bold']; ?></strong>
                                <?php echo $pp['text']; ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  7 · PRACTICAL DETAILS — CLEAN GRID                 ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-20 md:py-28">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="sma-enter text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Before You Arrive</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Everything You Need to Know
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $details = [
                    ['icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',                       'title'=>'Schedule',        'text'=>'Available <strong>daily except Mondays</strong>. Morning session begins at sunrise. Advance booking is recommended to secure your spot.'],
                    ['icon'=>'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'title'=>'Price',           'text'=>'<strong>IDR ' . esc_html( $a['price'] ) . '</strong> per person. Price does not include 12&nbsp;% tax. Special pricing available for Bali residents with valid ID.'],
                    ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',                              'title'=>'Location',        'text'=>'Eling Sanctuary, near Pasraman Bali Eling Spirit. <strong>Br. Umadawa, Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552</strong>. Minutes from central Ubud.'],
                    ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',                                                                              'title'=>'Experience Level', 'text'=>'<strong>All levels welcome.</strong> Complete beginners and experienced yogis both find depth here. Every movement is guided and adapted to your capacity.'],
                    ['icon'=>'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z M15 13a3 3 0 11-6 0 3 3 0 016 0z', 'title'=>'Photography',    'text'=>'For the comfort of all participants, photography is not permitted during sessions. Capture the feeling, not the frame.'],
                    ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',                     'title'=>'What to Bring',   'text'=>'Comfortable clothing you can move in. The sanctuary provides mats, props, and everything else you need. Bring only yourself and an open heart.'],
                ];
                foreach ( $details as $d ) : ?>
                <div class="sma-enter bg-white/60 rounded p-6">
                    <div class="w-10 h-10 rounded-full bg-bes-leaf-soft/30 flex items-center justify-center mb-4">
                        <svg class="w-[18px] h-[18px] text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $d['icon']; ?>"/></svg>
                    </div>
                    <h3 class="font-display text-lg text-bes-forest-deep mb-1.5"><?php echo $d['title']; ?></h3>
                    <p class="text-xs text-bes-bark leading-relaxed"><?php echo $d['text']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  8 · COMPANION PROGRAM — ELING SOUND AWAKENING      ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            <div class="sma-enter bg-white/70 rounded p-8 md:p-10 grid md:grid-cols-5 gap-8 items-center">
                <div class="md:col-span-3">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Also Available</p>
                    <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep tracking-display mb-3">
                        Eling Sound Awakening
                    </h3>
                    <p class="text-sm text-bes-bark leading-[1.8] mb-4">
                        Prefer an evening practice? The <strong class="text-bes-forest-deep">Eling Sound Awakening</strong>
                        is a companion session focused on deep sound healing and meditative restoration.
                        Available daily except Mondays at <strong>IDR 349.000</strong> (+12 % tax).
                        Combine both sessions for a complete day of transformation.
                    </p>
                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 text-bes-forest font-body font-semibold text-sm hover:!text-bes-leaf transition-colors">
                        Enquire about both programs
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="md:col-span-2 sma-zoom shadow-md">
                    <img src="https://images.unsplash.com/photo-1518002054494-3a6f94352e9d?w=600&h=400&q=80&auto=format&fit=crop&crop=center"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');this.parentElement.style.minHeight='200px';"
                         alt="Sound healing with candles and singing bowls in warm ambient light"
                         class="w-full h-[220px] md:h-[260px] object-cover" loading="lazy" />
                </div>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  9 · YOUR PATHWAY DEEPER                            ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="sma-enter text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">When One Morning Is Not Enough</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    Continue the Journey
                </h2>
                <p class="text-base text-bes-bark max-w-2xl mx-auto leading-relaxed">
                    The Sacred Morning Awakening is a complete experience on its own. But for many
                    participants, it becomes the spark that ignites a desire for deeper transformation.
                    Eling Sanctuary offers a layered path of increasingly immersive programs.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <?php
                $deeper = [
                    ['name'=>'Healing Retreat',   'dur'=>'5 hours',  'desc'=>'A half-day immersion into yoga, meditation, sound healing, and energy purification. The natural next step after the morning session.','url'=>'https://balielingspirit.org/en/program/healing-retreat-en/'],
                    ['name'=>'Tapa Brata',        'dur'=>'4 days',   'desc'=>'Heal inner wounds, activate the seven chakras, open your positive aura, and discover your authentic self across four transformative days.','url'=>'https://balielingspirit.org/en/our-programs-en/'],
                    ['name'=>'Karma Retreat',      'dur'=>'5 days',   'desc'=>'Release the accumulated weight of past karma, find the meaning of life, and undergo deep spiritual healing through sincerity and surrender.','url'=>'/karma-retreat/'],
                    ['name'=>'Punarbawa Retreat',  'dur'=>'7 days',   'desc'=>'The most immersive program offered &mdash; a complete spiritual rebirth through yoga, healing, self-introspection, and sacred ceremony.','url'=>'/punarbawa-retreat/'],
                ];
                foreach ( $deeper as $dp ) : ?>
                <a href="<?php echo esc_url( $dp['url'] ); ?>"
                   class="sma-enter group block bg-white/60 hover:bg-white rounded p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                    <div class="flex items-baseline justify-between mb-2">
                        <h3 class="font-display text-xl text-bes-forest-deep group-hover:!text-bes-forest transition-colors"><?php echo $dp['name']; ?></h3>
                        <span class="font-body text-xs text-bes-olive tracking-label uppercase"><?php echo $dp['dur']; ?></span>
                    </div>
                    <p class="text-xs text-bes-bark leading-relaxed"><?php echo $dp['desc']; ?></p>
                    <span class="inline-flex items-center gap-1 text-xs text-bes-leaf font-semibold mt-3 group-hover:gap-2 transition-all">
                        Learn more
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔═══════════════════════════════════════════════════╗
         ║  10 · FINAL CTA                                     ║
         ╚═══════════════════════════════════════════════════╝ -->
    <section class="relative py-28 md:py-36 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1200&q=70&auto=format';"
                 alt="Golden sunlight filtering through dense tropical canopy in Bali"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-gradient-to-br from-bes-forest-deep/85 via-bes-forest/75 to-bes-forest-deep/90"></div>
        </div>

        <div class="relative z-10 text-center max-w-2xl mx-auto px-6 md:px-10">
            <p class="sma-enter font-display italic !text-bes-gold-soft text-lg md:text-xl mb-4">
                &ldquo;The quietest hours hold the loudest truths.&rdquo;
            </p>
            <h2 class="sma-enter font-display text-3xl md:text-5xl text-bes-parchment tracking-display leading-[1.15] mb-6">
                Tomorrow Morning,<br>You Could Wake Up<br>Differently
            </h2>
            <p class="sma-enter text-base md:text-lg text-bes-cream/85 leading-relaxed mb-10 max-w-xl mx-auto">
                One morning at Eling Sanctuary is enough to remind your body what
                stillness feels like, to remind your mind what clarity sounds like,
                and to remind your spirit that it has been waiting for exactly this.
            </p>

            <div class="sma-enter flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2.5 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/25">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Reserve Your Morning &mdash; IDR <?php echo esc_html( $a['price'] ); ?>
                </a>
            </div>
            <p class="sma-enter text-xs text-bes-cream/40 mt-4">
                Available daily except Mondays &middot; +62 878 2589 9117
            </p>
        </div>
    </section>


    </div><!-- /.bes-sacred-morning -->


    <!-- ─── JS: scroll reveal (vanilla, no deps) ─── -->
    <script>
    (function(){
        var items = document.querySelectorAll('.sma-enter,.sma-slide-r,.sma-slide-l');
        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function(entries){
                entries.forEach(function(e){
                    if (e.isIntersecting) { e.target.classList.add('seen'); io.unobserve(e.target); }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            items.forEach(function(el){ io.observe(el); });
        } else {
            items.forEach(function(el){ el.classList.add('seen'); });
        }
    })();
    </script>

    <?php
    return ob_get_clean();
}