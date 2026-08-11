<?php
/**
 * ──────────────────────────────────────────────────────────────
 *  Shortcode : [bes_eling_tapa_brata]
 *  Page      : /eling-tapa-brata/
 *  Brand     : Eling Sanctuary · Bali Eling Spirit Group
 * ──────────────────────────────────────────────────────────────
 *  Program   : Eling Tapa Brata
 *  Duration  : 4 Days / 3 Nights
 *  Schedule  : Every month (monthly cycle)
 *  Purpose   : Heal inner wounds, trauma, sadness, anxiety.
 *              Activate chakras, open positive aura, improve
 *              health, discover the true self.
 *  Activities: Sharing Circle, 7-Chakra Purification, Guided
 *              Meditation 3× daily, Digestive Detox, Emotional
 *              Detox, Eling Walking, Yoga Asana & Pranayama,
 *              Sacred site meditation, Spiritual Workshop,
 *              Personal counseling with Jero Ratni, Aji Bhagawan,
 *              and authorized yogis.
 *  Facilities: Accommodation, 3× vegetarian meals, Pasraman
 *              uniform, goodie bag (modules + stationery),
 *              professional documentation photos, personality test.
 *  Follow-up : YTT 50H → YTT 200H
 *  WhatsApp  : +62 812 2888 8873
 *  Location  : Br. Umadawa, Pejeng Kangin, Tampaksiring,
 *              Gianyar, Bali
 * ──────────────────────────────────────────────────────────────
 *  BES Tailwind design tokens loaded by theme — zero re-declaration.
 *  Uses reveal-item pattern with Tailwind utility classes only.
 * ──────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_eling_tapa_brata', 'bes_eling_tapa_brata_render' );

function bes_eling_tapa_brata_render( $atts ) {

    $a = shortcode_atts([
        'wa'    => '6281228888873',
        'price' => '4.850.000',
    ], $atts, 'bes_eling_tapa_brata' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Hello, I would like to inquire about the Eling Tapa Brata 4-Day Retreat. Could you share the next available dates and any preparation guidance?' );

    ob_start();
    ?>

    <div class="bes-tapa-brata font-body text-bes-forest-deep overflow-hidden">


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  1 · HERO — FULL-VIEWPORT CINEMATIC WITH PRICE CARD       ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative min-h-[94vh] flex items-end overflow-hidden bg-bes-forest-deep">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1920&h=1080&q=80&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1448375240586-882707db888b?w=1400&q=70&auto=format&fit=crop';"
                 alt="Deep tranquil tropical forest canopy with golden light filtering through ancient trees — representing the sacred silence of Tapa Brata"
                 class="w-full h-full object-cover opacity-80" loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep via-bes-forest-deep/60 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full pb-16 pt-40 md:pt-56 px-6 md:px-10">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-10 items-end">

                <!-- Headline -->
                <div class="lg:col-span-2 reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                    <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-4">
                        Eling Sanctuary &mdash; 4-Day Immersive Silent Retreat
                    </p>
                    <h1 class="font-display font-light text-[2.8rem] md:text-6xl lg:text-[5rem] text-bes-parchment tracking-display leading-[1.05] mb-6">
                        Eling Tapa Brata
                    </h1>
                    <p class="text-lg md:text-xl text-bes-cream/90 leading-relaxed max-w-2xl mb-0">
                        To hear your truest self, you must first quiet the entire world around you. Step into a
                        profound four-day journey of sacred silence, inner child healing, seven-chakra activation,
                        and spiritual awakening. Release the accumulated weight of trauma, overthinking, and
                        unresolved karma &mdash; and walk the ancient path toward <em>Punarbawa</em>, your
                        complete spiritual rebirth.
                    </p>
                </div>

                <!-- Price card -->
                <div class="bg-bes-forest-deep/40 backdrop-blur-md border border-bes-gold/20 rounded p-7 text-center lg:text-left reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out" style="transition-delay:200ms;">
                    <p class="font-body text-xs !text-bes-gold tracking-label uppercase mb-1">4 Days, 3 Nights</p>
                    <p class="font-display text-4xl md:text-5xl text-bes-parchment tracking-display leading-none mb-1">
                        IDR <?php echo esc_html( $a['price'] ); ?>
                    </p>
                    <p class="text-xs text-bes-cream/50 mb-4">per person &middot; all-inclusive</p>
                    <p class="text-xs text-bes-cream/80 mb-2 flex items-center justify-center lg:justify-start gap-2">
                        <svg class="w-4 h-4 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Guided Silence &amp; Energy Healing
                    </p>
                    <p class="text-xs text-bes-cream/60 mb-5 flex items-center justify-center lg:justify-start gap-2">
                        <svg class="w-4 h-4 !text-bes-gold/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Held every month at the Pasraman
                    </p>
                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="block w-full bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep font-body font-semibold
                              tracking-label uppercase text-sm text-center px-6 py-3.5 rounded transition-colors duration-300">
                        Begin Your Healing
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  2 · PHILOSOPHY — WHAT IS TAPA BRATA?                     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-36">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">

                <!-- Left: heading + Sanskrit -->
                <div class="lg:col-span-5 reveal-item opacity-0 -translate-x-8 transition-all duration-1000 ease-out">
                    <p class="font-display italic text-bes-olive text-lg mb-2">तप · ब्रत</p>
                    <h2 class="font-display text-3xl md:text-[2.5rem] text-bes-forest-deep tracking-display leading-[1.15] mb-5">
                        The Fire That<br>Purifies the Soul<br>and the Vow That<br>Holds It Steady
                    </h2>
                    <div class="w-12 h-[2px] bg-bes-gold mb-6"></div>
                    <p class="font-display italic text-bes-olive text-sm leading-relaxed">
                        &ldquo;Difficulties teach that goodness takes time to process. Yoga is learning
                        to accept imperfection in a perfect way, and the time it takes is a lifetime.&rdquo;
                        <br><span class="text-bes-bark-muted not-italic text-xs">&mdash; Jero Ratni, Founder</span>
                    </p>
                </div>

                <!-- Right: deep philosophical explanation -->
                <div class="lg:col-span-7 reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out">
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                        In the Balinese Hindu spiritual tradition, <em>Tapa</em> (तप) refers to ascetic discipline
                        &mdash; the inner fire of self-purification that burns away ignorance, attachment, and
                        accumulated negativity. It is not punishment or deprivation. It is the sacred heat generated
                        when a person willingly turns their energy inward, away from the constant pull of external
                        desire and distraction, and allows that concentrated focus to dissolve everything that is
                        not essential, everything that is not authentically them.
                    </p>
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95] mb-6">
                        <em>Brata</em> (ब्रत) is the sacred vow that makes Tapa possible. It is the commitment
                        to withdraw from worldly stimulation &mdash; from speech, from digital connection, from
                        the constant performance that modern life demands &mdash; and to hold that withdrawal
                        with unwavering steadiness for the duration of the practice. Together, <em>Tapa Brata</em>
                        forms a vessel of extraordinary power: a four-day container within which the deepest
                        emotional wounds, the most stubborn karmic patterns, and the most carefully hidden
                        traumas can finally surface, be acknowledged, and be released.
                    </p>
                    <p class="text-base md:text-[1.05rem] text-bes-bark leading-[1.95]">
                        This program is inspired by local Indonesian ancestral wisdom, packaged in contemporary
                        methods so that it can be followed by all participants regardless of background or belief
                        system. The foundation is universal: yoga, meditation, spiritual mastery, and life mastery.
                        The destination is <strong>Punarbawa</strong> &mdash; the Balinese concept of complete
                        spiritual rebirth &mdash; the shedding of old karmic weight and the emergence of your
                        most authentic, most radiant, most truthful self.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  3 · AT A GLANCE — HORIZONTAL STATS                      ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-14 md:py-16">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="flex flex-wrap justify-center gap-x-14 gap-y-6 text-center">
                <?php
                $stats = [
                    ['num'=>'4',  'label'=>'Days of Sacred<br>Immersion'],
                    ['num'=>'3',  'label'=>'Meditation Sessions<br>Every Day'],
                    ['num'=>'7',  'label'=>'Chakras Purified<br>&amp; Activated'],
                    ['num'=>'97%','label'=>'Participant<br>Success Rate'],
                    ['num'=>'1',  'label'=>'Personal Counseling<br>with Master Teachers'],
                ];
                foreach ( $stats as $s ) : ?>
                <div class="reveal-item opacity-0 scale-95 transition-all duration-700 ease-out">
                    <p class="font-display text-4xl md:text-5xl !text-bes-gold tracking-display leading-none"><?php echo $s['num']; ?></p>
                    <p class="font-body text-[10px] text-bes-cream/60 tracking-label uppercase mt-2 max-w-[120px] mx-auto leading-snug"><?php echo $s['label']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  4 · THE FOUR DAYS — ZIG-ZAG EDITORIAL WITH IMAGES       ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-24 md:py-36">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-20">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Path to Punarbawa</p>
                <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug">
                    Four Days of Inner Alchemy
                </h2>
            </div>

            <?php
            $phases = [
                [
                    'num'   => 'Day 1',
                    'title' => 'Detachment &amp; Purification',
                    'sub'   => 'Melukat · Digital Surrender · The Vow of Silence',
                    'body'  => 'Your transformation begins with a deliberate act of separation from the outside world. All digital devices are surrendered upon arrival &mdash; phones, tablets, laptops, every screen that has been mediating your relationship with reality. In these first hours, as the habitual reaching for your phone gradually subsides, something remarkable begins to happen: the mind starts to slow down on its own, without being forced. You undergo a traditional Balinese Water Purification ceremony (<em>Melukat</em>) at the Pasraman &mdash; a sacred cleansing procession using holy water, mantras, and meditation energy to dissolve the energetic attachments and residual negativity you have been carrying, much of it without even knowing. As the tropical evening settles over the sanctuary, you take the sacred vow of <em>Tapa Brata</em>, entering a period of noble silence that will hold you for the next three days. Without the obligation to speak, to perform, to respond, to manage the impression you make on others &mdash; your energy instantly and palpably shifts inward. The excavation has begun.',
                    'img'   => 'https://images.unsplash.com/photo-1590001155093-a3c66ab0c3ff?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Sacred Balinese water purification ceremony with flowing holy spring water and tropical flowers',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => 'Day 2',
                    'title' => 'Meeting the Inner Child',
                    'sub'   => 'Shadow Work · Emotional Release · Guided Introspection',
                    'body'  => 'In the protected quietude of Day 2, with the external noise stripped away and the nervous system settling into an unfamiliar but deeply nourishing calm, the barriers of the conscious mind begin to lower. Under the expert care of Jero Ratni, Aji Bhagawan, and the authorized yogis who have guided thousands of participants through this process, you navigate deep, sustained meditative states to encounter the part of yourself that has been waiting the longest to be heard: your inner child. This is where the core wounds live &mdash; feelings of inadequacy, abandonment, past traumas, unvoiced grief, and the silent agreements you made as a child about who you were allowed to be. By holding space for this vulnerable, long-neglected part of yourself in total silence &mdash; without the usual distractions, defences, or rationalizations &mdash; a profound emotional release occurs. Tears are common, welcome, and deeply cleansing. Some participants experience waves of relief they have never felt in decades of conventional therapy. The silence is not emptiness. It is the safest container many have ever known.',
                    'img'   => 'https://images.unsplash.com/photo-1513628253939-010e64ac66cd?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Person seated in deep contemplative meditation amid tranquil natural surroundings representing inner child healing',
                    'dir'   => 'reverse',
                ],
                [
                    'num'   => 'Day 3',
                    'title' => '7-Chakra Activation &amp; Kundalini',
                    'sub'   => 'Energy Healing · Pranayama · Sound Vibration · Aura Expansion',
                    'body'  => 'With the emotional debris cleared and the inner child acknowledged and held, your energetic body is now primed for the most physically transformative phase of the retreat: the systematic activation of your seven major chakras and the awakening of dormant Kundalini energy. Through intensive breathwork (<em>pranayama</em>), Bali Hatha Yoga, sacred site meditation in nature, and Tibetan singing bowl sound healing using the traditional 7-Chakra Purification ceremony &mdash; which combines holy water, mantras, meditation energy, and crystals &mdash; each energy centre is methodically cleansed, unblocked, and activated from root to crown. You will literally feel the shift happening: stagnant, heavy energy dissolving and being replaced by a radiant, flowing vitality that many participants describe as unlike anything they have ever experienced. Your personal aura, once dimmed and contracted by years of accumulated stress, unprocessed grief, and unresolved karmic residue, is cleansed, expanded, and elevated to a frequency that others will notice long before you tell them what you have done.',
                    'img'   => 'https://images.unsplash.com/photo-1608228079968-c7681ea8b7e2?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Tibetan singing bowls and crystals arranged for seven-chakra purification and energy healing ceremony',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => 'Day 4',
                    'title' => 'Punarbawa &mdash; The Rebirth',
                    'sub'   => 'Integration · Sharing Circle · Awakening · Return',
                    'body'  => 'The final morning of Tapa Brata breaks the noble silence. And in that first spoken breath, you will know: you are not the same person who arrived four days ago. The culmination of the journey is <em>Punarbawa</em> &mdash; complete spiritual rebirth. Through a guided Sharing Circle, you articulate your experience aloud for the first time, hearing your own voice describe the transformation with a clarity and emotion that surprises even you. Your facilitators &mdash; Jero Ratni, Aji Bhagawan, and the yogi team &mdash; gently guide the integration process, helping you ground your newly activated energy and translate the profound internal shifts into practical tools you can carry back into the noise and demands of everyday life. You receive your professional documentation photos, your personality test results, and the modules that will serve as ongoing references for the independent meditation and self-healing practices you have now mastered. You leave the Pasraman with a spirit that feels physically lighter, an aura that radiates a warmth others will instinctively feel, and a connection to your authentic self that no amount of external distraction can easily sever.',
                    'img'   => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Breathtaking golden sunrise breaking over a calm ocean horizon symbolising Punarbawa spiritual rebirth and new beginnings',
                    'dir'   => 'reverse',
                ],
            ];

            foreach ( $phases as $i => $p ) :
                $img_order = $p['dir'] === 'reverse' ? 'lg:order-1' : 'lg:order-2';
                $txt_order = $p['dir'] === 'reverse' ? 'lg:order-2' : 'lg:order-1';
                $slide_cls = $p['dir'] === 'reverse' ? '-translate-x-12' : 'translate-x-12';
            ?>
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-28 last:mb-0">

                <!-- Image -->
                <div class="<?php echo $img_order; ?> reveal-item opacity-0 scale-95 transition-all duration-1000 ease-out shadow-xl rounded overflow-hidden group">
                    <img src="<?php echo esc_url( $p['img'] ); ?>"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');this.parentElement.style.minHeight='400px';"
                         alt="<?php echo esc_attr( $p['alt'] ); ?>"
                         class="w-full h-[400px] md:h-[520px] object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy" />
                </div>

                <!-- Text -->
                <div class="<?php echo $txt_order; ?> reveal-item opacity-0 <?php echo $slide_cls; ?> transition-all duration-1000 ease-out" style="transition-delay:150ms;">
                    <div class="flex items-baseline gap-4 mb-5">
                        <span class="font-display text-[2.5rem] md:text-5xl !text-bes-gold/30 leading-none tracking-display whitespace-nowrap"><?php echo $p['num']; ?></span>
                        <div>
                            <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep tracking-display leading-snug"><?php echo $p['title']; ?></h3>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mt-1"><?php echo $p['sub']; ?></p>
                        </div>
                    </div>
                    <p class="text-sm md:text-base text-bes-bark leading-[1.9]"><?php echo $p['body']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  5 · COMPLETE PROGRAM ACTIVITIES — 3-COL GRID             ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Everything That Happens</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    The Complete Program
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php
                $activities = [
                    ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                     'title'=>'Sharing Circle','text'=>'Open and close the retreat with a guided community circle where participants share intentions, breakthroughs, and gratitude in a sacred, judgment-free container facilitated by master teachers.'],
                    ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                     'title'=>'7-Chakra Purification','text'=>'A powerful self-cleansing ceremony using holy water, sacred mantras, meditation energy, and crystals to systematically purify and activate each of the seven major energy centres from root to crown.'],
                    ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                     'title'=>'Meditation 3× Daily','text'=>'Three structured meditation sessions each day guided by experienced practitioners. Morning meditation builds focus, midday meditation processes emotions, and evening meditation integrates the day&rsquo;s inner work.'],
                    ['icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                     'title'=>'Digestive Detox System','text'=>'A carefully designed dietary protocol using nourishing vegetarian meals to cleanse the digestive tract, eliminate accumulated toxins, and restore the body&rsquo;s natural capacity for energy absorption and vitality.'],
                    ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z',
                     'title'=>'Emotional Detox','text'=>'Guided processes to identify, surface, and safely release stored negative emotions &mdash; suppressed grief, unresolved anger, chronic anxiety, and the emotional residue of trauma that the body has been carrying for years or decades.'],
                    ['icon'=>'M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3',
                     'title'=>'Sacred Site Meditation','text'=>'Leave the retreat space to meditate at carefully selected sacred sites in nature around the Pasraman. The energetic vibrations of these locations dramatically amplify the depth and effectiveness of your meditation practice.'],
                    ['icon'=>'M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 017.74-3.342',
                     'title'=>'Spiritual Workshop','text'=>'Immersive teachings covering the sacred layers of the body, the origins of consciousness, how to transform negative thought patterns into positive spiritual energy, and how to build a reality of lasting abundance and authentic happiness.'],
                    ['icon'=>'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                     'title'=>'Eling Walking, Yoga &amp; Pranayama','text'=>'Daily movement practices combining mindful walking meditation (<em>Eling Walking</em>), Bali Hatha Yoga postures, and structured breathwork techniques to maintain physical vitality and support the energetic processes unfolding within.'],
                    ['icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                     'title'=>'Personal Spiritual Counseling','text'=>'One-on-one sessions with <strong>Jero Ratni</strong>, <strong>Aji Bhagawan</strong>, or one of the authorized yogis. Deeply personalized guidance addressing your specific wounds, questions, and spiritual trajectory &mdash; impossible to replicate in a group setting alone.'],
                ];
                foreach ( $activities as $idx => $act ) :
                    $delay = min($idx * 80, 400);
                ?>
                <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out bg-white/60 border border-bes-parchment rounded p-6 hover:-translate-y-1 hover:shadow-lg transition-transform" style="transition-delay:<?php echo $delay; ?>ms;">
                    <div class="w-10 h-10 rounded-full bg-bes-leaf-soft/30 flex items-center justify-center mb-4">
                        <svg class="w-[18px] h-[18px] text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $act['icon']; ?>"/></svg>
                    </div>
                    <h3 class="font-display text-lg text-bes-forest-deep mb-2"><?php echo $act['title']; ?></h3>
                    <p class="text-xs text-bes-bark leading-[1.75]"><?php echo $act['text']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  6 · WHAT YOU WILL LEARN — DARK SECTION                   ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-24 md:py-32">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="grid lg:grid-cols-2 gap-14 items-start">

                <!-- Left: heading -->
                <div class="reveal-item opacity-0 -translate-x-8 transition-all duration-1000 ease-out">
                    <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-3">Wisdom You Take Home</p>
                    <h2 class="font-display text-3xl md:text-4xl text-bes-parchment tracking-display leading-snug mb-5">
                        Knowledge That<br>Outlasts the Retreat
                    </h2>
                    <p class="text-base text-bes-cream/70 leading-relaxed">
                        Tapa Brata is not a temporary escape. It is designed to permanently expand your
                        understanding of yourself, your energy, and the spiritual mechanics that govern
                        your daily reality. Here is what the teachings include.
                    </p>
                </div>

                <!-- Right: learning items -->
                <div class="reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out space-y-5">
                    <?php
                    $learnings = [
                        'Recognize the origins of your birth in this world and the deeper purpose that brought your soul to this specific lifetime, body, and set of circumstances',
                        'Understand the sacred layers of the body &mdash; physical, energetic, mental, and spiritual &mdash; and how their alignment is integral to success in every area of life',
                        'Master practical exercises that build a holistically healthy and balanced life: physical, emotional, and spiritual health operating as one unified system',
                        'Learn precisely how to transform persistent negative thought patterns into positive spiritual energy and redirect that energy toward constructive outcomes',
                        'Discover how to build a positive life reality and cultivate the conditions for consistent good fortune through conscious intention and karmic awareness',
                        'Acquire the foundational skills of authentic self-healing (<em>self-healing</em>) that can be practised independently, anywhere in the world, for the rest of your life',
                    ];
                    foreach ( $learnings as $l ) : ?>
                    <div class="flex gap-4 items-start">
                        <svg class="w-5 h-5 !text-bes-gold shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-bes-cream/85 leading-[1.8]"><?php echo $l; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  7 · BEFORE / AFTER — TRANSFORMATION CONTRAST             ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-5xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-3">
                    The Alchemy of Silence
                </h2>
                <p class="text-base text-bes-bark max-w-xl mx-auto leading-relaxed">
                    Tapa Brata does not merely relax you. It rewires your nervous system,
                    recalibrates your energetic body, and restructures your relationship with yourself.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Before -->
                <div class="reveal-item opacity-0 -translate-x-6 transition-all duration-700 ease-out bg-bes-bark-muted/5 border border-bes-bark-muted/15 rounded-lg p-8">
                    <p class="font-display text-xl text-bes-bark-muted mb-6 border-b border-bes-bark-muted/20 pb-3">The Weight You Carry In</p>
                    <?php
                    $before = [
                        'Overthinking, insomnia, and a mind that never stops generating anxiety about the future or regret about the past',
                        'Repeating destructive emotional patterns &mdash; in relationships, in career, in health &mdash; rooted in childhood wounds you may not even consciously remember',
                        'Blocked chakras manifesting as persistent physical fatigue, creative stagnation, chronic tension, and a pervasive sense that something is fundamentally &ldquo;off&rdquo;',
                        'Feeling disconnected from intuition, from authentic purpose, and from the spiritual dimension of existence that gives everything else its meaning',
                        'Insecurity, toxic relational cycles, and the sense of having lost direction in life',
                    ];
                    foreach ( $before as $b ) : ?>
                    <div class="flex gap-3 items-start mb-4 last:mb-0">
                        <svg class="w-4 h-4 text-bes-bark-muted shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <p class="text-sm text-bes-bark/70 leading-relaxed"><?php echo $b; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- After -->
                <div class="reveal-item opacity-0 translate-x-6 transition-all duration-700 ease-out bg-bes-gold/5 border border-bes-gold/20 rounded-lg p-8 relative overflow-hidden" style="transition-delay:150ms;">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-bes-gold/10 blur-3xl rounded-full"></div>
                    <p class="font-display text-xl text-bes-forest-deep mb-6 border-b border-bes-gold/20 pb-3 relative z-10">What You Carry Out (Punarbawa)</p>
                    <?php
                    $after = [
                        'A peaceful and genuinely grateful heart &mdash; not as a concept, but as a lived, physical experience that persists well beyond the retreat',
                        'Deep acknowledgment, release, and healing of the inner child&rsquo;s accumulated pain, and a new capacity to love yourself without condition',
                        'Freely flowing life-force (<em>Prana</em>) through fully activated chakras, manifesting as physical vitality, creative energy, and emotional resilience you can actually feel',
                        'A luminous, expanded aura and deep alignment with your life&rsquo;s authentic truth &mdash; so palpable that others notice the change before you explain it',
                        'Concrete solutions to the problems you have been carrying, and the ability to perform correct meditation independently for the rest of your life',
                    ];
                    foreach ( $after as $af ) : ?>
                    <div class="flex gap-3 items-start mb-4 last:mb-0 relative z-10">
                        <svg class="w-4 h-4 !text-bes-gold shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <p class="text-sm text-bes-forest-deep leading-relaxed"><?php echo $af; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  8 · PHOTO MOSAIC — IMMERSION GALLERY                     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid grid-cols-6 gap-2 md:gap-3">
                <?php
                $mosaic = [
                    ['src'=>'https://images.unsplash.com/photo-1545389336-cf090694435e?w=700&h=500&q=80&auto=format&fit=crop','alt'=>'Sunrise yoga practice in tropical bamboo pavilion','span'=>'col-span-3 md:col-span-4','h'=>'h-[200px] md:h-[300px]'],
                    ['src'=>'https://images.unsplash.com/photo-1600618528240-fb9fc964b853?w=500&h=500&q=80&auto=format&fit=crop','alt'=>'Tibetan singing bowls for sound healing ceremony','span'=>'col-span-3 md:col-span-2','h'=>'h-[200px] md:h-[300px]'],
                    ['src'=>'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&h=400&q=80&auto=format&fit=crop','alt'=>'Nourishing vegetarian meals prepared with care','span'=>'col-span-2','h'=>'h-[160px] md:h-[220px]'],
                    ['src'=>'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&h=400&q=80&auto=format&fit=crop','alt'=>'Morning breathwork and pranayama in natural light','span'=>'col-span-2','h'=>'h-[160px] md:h-[220px]'],
                    ['src'=>'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=400&q=80&auto=format&fit=crop','alt'=>'Sacred Bali rice terrace landscape near the Pasraman','span'=>'col-span-2','h'=>'h-[160px] md:h-[220px]'],
                ];
                foreach ( $mosaic as $m ) : ?>
                <div class="<?php echo $m['span']; ?> reveal-item opacity-0 scale-95 transition-all duration-700 ease-out overflow-hidden rounded group">
                    <img src="<?php echo esc_url( $m['src'] ); ?>"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20');"
                         alt="<?php echo esc_attr( $m['alt'] ); ?>"
                         class="w-full <?php echo $m['h']; ?> object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  9 · GUEST VOICES — TESTIMONIALS                          ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Echoes of Healing</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Voices of Rebirth
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $reviews = [
                    [
                        'text' => 'The four days of silence broke me open in the best way possible. Meeting my inner child was the hardest and most beautiful thing I have ever done. I left feeling literally lighter, as if a physical weight had been lifted from my chest that I did not know I was carrying.',
                        'name' => 'Elena R.',
                        'from' => 'Tapa Brata Alumni',
                    ],
                    [
                        'text' => 'I came to Bali searching for healing, but I did not truly understand what that word meant until Eling Sanctuary. The chakra activation on Day 3 and the sheer energetic power of the environment allowed me to process grief I had carried silently for more than twenty years.',
                        'name' => 'Markus T.',
                        'from' => 'Retreat Participant',
                    ],
                    [
                        'text' => 'This is not your standard yoga retreat. This is deep, authentic Balinese spiritual work guided by people who have devoted their entire lives to it. By the time Punarbawa arrived on the final morning, my entire perspective on my life, my karma, and my future had fundamentally shifted.',
                        'name' => 'Sarah L.',
                        'from' => 'Tapa Brata Alumni',
                    ],
                ];
                foreach ( $reviews as $idx => $r ) :
                    $delay = $idx * 150;
                ?>
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out bg-white/60 border border-bes-parchment rounded p-8 hover:-translate-y-1 hover:shadow-lg transition-transform" style="transition-delay:<?php echo $delay; ?>ms;">
                    <svg class="w-8 h-8 !text-bes-gold/30 mb-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p class="text-sm text-bes-bark leading-[1.8] mb-6"><?php echo $r['text']; ?></p>
                    <div>
                        <p class="font-display text-base text-bes-forest-deep"><?php echo $r['name']; ?></p>
                        <p class="text-xs text-bes-bark-muted tracking-wider uppercase"><?php echo $r['from']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  10 · PREPARATION + ESSENTIALS — SPLIT LAYOUT             ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-24 md:py-36">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-16 items-start">

                <!-- Left: preparation guidance -->
                <div class="reveal-item opacity-0 -translate-x-8 transition-all duration-1000 ease-out">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-3">Preparation</p>
                    <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-6">
                        Are You Ready<br>for the Silence?
                    </h2>
                    <p class="text-base text-bes-bark leading-[1.85] mb-8">
                        The Tapa Brata retreat demands genuine courage. It is designed for those who are
                        ready to look inward without the crutch of external validation, digital
                        distraction, or social performance. The Pasraman provides a profoundly safe,
                        expertly guided container &mdash; but you must bring the willingness to
                        surrender completely to the process.
                    </p>

                    <div class="space-y-4 mb-8">
                        <?php
                        $protocols = [
                            ['bold'=>'Complete Digital Detox','text'=>'All devices are handed over upon arrival. This is non-negotiable and is one of the most critical elements of the retreat&rsquo;s extraordinary effectiveness.'],
                            ['bold'=>'Noble Silence','text'=>'Verbal communication is suspended from the end of Day 1 through the morning of Day 4. Written notes for essential needs only. This silence conserves an immense amount of energy that is then redirected toward healing.'],
                            ['bold'=>'Dietary Purification','text'=>'Three nourishing vegetarian meals per day, specifically designed to support chakra activation, digestive cleansing, and elevated vibrational frequency throughout the retreat.'],
                            ['bold'=>'Residential Stay Required','text'=>'Participants must remain at the Pasraman for the full duration. The calm environment protects the body, heart, mind, and soul from interference or distraction from negative external energy.'],
                        ];
                        foreach ( $protocols as $pr ) : ?>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bes-forest shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-sm text-bes-bark leading-relaxed"><strong class="text-bes-forest-deep"><?php echo $pr['bold']; ?>:</strong> <?php echo $pr['text']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Right: retreat essentials card -->
                <div class="reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out bg-white/60 rounded-lg p-8 md:p-10 border border-bes-olive-light/20 shadow-lg sticky top-8">
                    <h3 class="font-display text-2xl text-bes-forest-deep mb-6">Retreat Essentials</h3>

                    <div class="space-y-5">
                        <div>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1">Duration</p>
                            <p class="text-base text-bes-forest-deep font-semibold">4 Days / 3 Nights</p>
                        </div>
                        <div class="w-full h-px bg-bes-bark-muted/15"></div>
                        <div>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1">Schedule</p>
                            <p class="text-sm text-bes-bark leading-relaxed">Held <strong>every month</strong> at Pasraman Bali Eling Spirit. Specific dates announced monthly via WhatsApp.</p>
                        </div>
                        <div class="w-full h-px bg-bes-bark-muted/15"></div>
                        <div>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1">All-Inclusive Facilities</p>
                            <p class="text-sm text-bes-bark leading-relaxed">Accommodation, all spiritual teachings &amp; ceremonies, Melukat purification, daily yoga &amp; meditation (3× daily), sound healing, 3× vegetarian meals per day, Pasraman uniform, goodie bag with modules &amp; stationery, professional documentation photos, and personality test.</p>
                        </div>
                        <div class="w-full h-px bg-bes-bark-muted/15"></div>
                        <div>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1">Investment</p>
                            <p class="font-display text-2xl text-bes-forest-deep tracking-display">IDR <?php echo esc_html( $a['price'] ); ?></p>
                            <p class="text-xs text-bes-bark-muted">per person &middot; all-inclusive</p>
                        </div>
                        <div class="w-full h-px bg-bes-bark-muted/15"></div>
                        <div>
                            <p class="font-body text-xs text-bes-olive tracking-label uppercase mb-1">Next Step After Tapa Brata</p>
                            <p class="text-sm text-bes-bark leading-relaxed">YTT 50H (independent self-healing mastery) &rarr; YTT 200H (broader &amp; deeper spiritual awareness)</p>
                        </div>

                        <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                           class="block w-full bg-bes-forest hover:bg-bes-forest-deep text-bes-parchment font-body font-semibold
                                  tracking-label uppercase text-xs text-center px-6 py-4 rounded transition-colors duration-300 mt-2">
                            Check Available Dates
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  11 · FAQ — ACCORDION                                     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-20 md:py-28">
        <div class="max-w-3xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Common Questions</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">
                    Before You Begin
                </h2>
            </div>

            <?php
            $faqs = [
                [
                    'q' => 'Who is Tapa Brata designed for?',
                    'a' => 'Anyone experiencing overthinking, trauma, toxic relational patterns, excessive anxiety, insomnia, insecurity, or the persistent feeling of having lost direction in life. It is also profoundly beneficial for those who simply want to recognise their deepest identity and break free from the cycle of bad habits that have been causing harm to themselves and their families.',
                ],
                [
                    'q' => 'Do I need to follow a specific belief system?',
                    'a' => 'No. This program is not tied to any particular religion or belief system. The foundation of all teaching at the Pasraman is universal: yoga, meditation, spiritual mastery, and life mastery. Participants of all faiths and backgrounds — and those with no religious affiliation at all — have found transformative value in the Tapa Brata experience.',
                ],
                [
                    'q' => 'What is the success rate?',
                    'a' => 'The participant success rate for Tapa Brata is 97%. The retreat has a documented and deeply positive influence on accelerating healing processes, accelerating problem-solving in participants&rsquo; personal and professional lives, and accelerating spiritual awareness and growth.',
                ],
                [
                    'q' => 'Why must I stay at the Pasraman the entire time?',
                    'a' => 'The calm, energetically protected environment of Pasraman Bali Eling Spirit allows your body, heart, mind, and soul to remain shielded from interference or distraction from negative external energy. The vibrations at the Pasraman have an enormous and measurable influence on the success of the Tapa Brata process — which is why this program is only offered at this specific location.',
                ],
                [
                    'q' => 'Should I do Tapa Brata more than once?',
                    'a' => 'Yes. It is highly recommended to undertake Tapa Brata at least once per year as a comprehensive detox of negative energy absorbed by the body, heart, mind, and soul over the preceding twelve months. Many alumni return annually and report that each experience reaches deeper than the last.',
                ],
                [
                    'q' => 'Is there a continuation pathway after Tapa Brata?',
                    'a' => 'Absolutely. The recommended next step is YTT 50H (Yoga Teacher Training, 50 hours), which develops your capacity to heal yourself independently. Beyond that, YTT 200H provides a broader and deeper spiritual awareness and the skills to guide others on their own healing journey.',
                ],
                [
                    'q' => 'Will I really be healed?',
                    'a' => 'Tapa Brata creates the conditions — the silence, the guidance, the energetic environment, the structured process — within which healing naturally occurs. The 97% success rate speaks for itself: participants consistently report accelerated healing, resolution of long-standing problems, and a level of spiritual awakening that persists long after they leave.',
                ],
            ];
            foreach ( $faqs as $idx => $faq ) : ?>
            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out border-b border-bes-bark-muted/15 tb-faq-item" style="transition-delay:<?php echo $idx * 60; ?>ms;">
                <button class="w-full flex items-center justify-between py-5 text-left tb-faq-btn" aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>">
                    <span class="font-display text-base md:text-lg text-bes-forest-deep pr-4"><?php echo $faq['q']; ?></span>
                    <svg class="w-5 h-5 text-bes-olive shrink-0 transition-transform duration-300 tb-faq-icon <?php echo $idx === 0 ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="tb-faq-body overflow-hidden transition-all duration-300 <?php echo $idx === 0 ? 'max-h-96 pb-5' : 'max-h-0'; ?>">
                    <p class="text-sm text-bes-bark leading-[1.8]"><?php echo $faq['a']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  12 · FINAL CTA — CINEMATIC CLOSE                        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-28 md:py-40 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=1400&q=70&auto=format&fit=crop';"
                 alt="Peaceful Balinese meditation setting at golden hour representing the inner harmony achieved through Tapa Brata"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/90"></div>
        </div>

        <div class="relative z-10 text-center max-w-2xl mx-auto px-6 md:px-10">
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display italic !text-bes-gold-soft text-lg md:text-xl mb-4">
                &ldquo;The soul that is not silent cannot hear the voice of God.&rdquo;
            </p>
            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display text-4xl md:text-[3.5rem] text-bes-parchment tracking-display leading-[1.1] mb-6" style="transition-delay:100ms;">
                Your Rebirth<br>Awaits in<br>the Silence
            </h2>
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-base md:text-lg text-bes-cream/80 leading-relaxed mb-10 max-w-xl mx-auto" style="transition-delay:200ms;">
                Stop running from the noise. Turn inward. Heal the wounded parts of your soul that have
                been waiting years for your attention. Activate the dormant energy that has always been
                within you. And step into the truest, most radiant version of the person you were always
                meant to become.
            </p>

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out flex flex-col sm:flex-row gap-4 justify-center" style="transition-delay:300ms;">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="whitespace-nowrap inline-flex items-center justify-center gap-3 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep
                          font-body font-semibold tracking-label uppercase text-sm px-10 py-4 rounded transition-all
                          duration-300 hover:shadow-lg hover:shadow-bes-gold/20">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Apply for Tapa Brata &mdash; IDR <?php echo esc_html( $a['price'] ); ?>
                </a>
                <a href="/our-programs/"
                   class="whitespace-nowrap inline-flex items-center justify-center gap-2 border border-bes-parchment/25 hover:border-bes-parchment/50
                          text-bes-parchment font-body text-sm px-8 py-4 rounded transition-all duration-300">
                    View All Programs
                </a>
            </div>
            <p class="reveal-item opacity-0 transition-opacity duration-700 text-xs text-bes-cream/40 mt-5" style="transition-delay:400ms;">
                Held monthly &middot; Br. Umadawa, Pejeng Kangin, Gianyar, Bali &middot; +62 812 2888 8873
            </p>
        </div>
    </section>


    </div><!-- /.bes-tapa-brata -->


    <!-- ─── JS: scroll reveal + FAQ accordion (vanilla, no deps) ─── -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        /* — Scroll Reveal — */
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
        document.querySelectorAll('.reveal-item').forEach(function(el){ io.observe(el); });

        /* — FAQ Accordion — */
        document.querySelectorAll('.tb-faq-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var item = btn.closest('.tb-faq-item');
                var body = item.querySelector('.tb-faq-body');
                var icon = item.querySelector('.tb-faq-icon');
                var open = btn.getAttribute('aria-expanded') === 'true';

                /* Close all */
                document.querySelectorAll('.tb-faq-btn').forEach(function(b) {
                    b.setAttribute('aria-expanded','false');
                    b.closest('.tb-faq-item').querySelector('.tb-faq-body').classList.remove('max-h-96','pb-5');
                    b.closest('.tb-faq-item').querySelector('.tb-faq-body').classList.add('max-h-0');
                    b.closest('.tb-faq-item').querySelector('.tb-faq-icon').classList.remove('rotate-180');
                });

                /* Toggle current */
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