<?php
/**
 * ─────────────────────────────────────────────────────────────
 * Shortcode : [bes_eling_guiding]
 * Page      : /eling-guiding/
 * Brand     : Eling Sanctuary · Bali Eling Spirit
 * ─────────────────────────────────────────────────────────────
 * 1-on-1 spiritual mentorship, intuitive reading, and dharma 
 * discovery rooted in authentic Balinese philosophy.
 * ─────────────────────────────────────────────────────────────
 * BES Tailwind design tokens loaded by theme — no re-declaration.
 * STRICTLY uses utility classes; no inline styles or <style> tags.
 * ─────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_eling_guiding', 'bes_eling_guiding_render' );

function bes_eling_guiding_render( $atts ) {

    $a = shortcode_atts([
        'wa'    => '6287825899117',
        'price' => 'USD 120', 
    ], $atts, 'bes_eling_guiding' );

    $wa_link = 'https://wa.me/' . esc_attr( $a['wa'] )
             . '?text=' . rawurlencode( 'Om Swastiastu. I am seeking profound clarity and would like to book an Eling Guiding (1-on-1 Mentorship) session. Please let me know your availability.' );

    ob_start();
    ?>

    <div class="bes-eling-guiding font-body text-bes-forest-deep overflow-hidden">

    <section class="relative min-h-[95vh] flex items-end overflow-hidden bg-bes-forest-deep">
        
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1528315651810-18861df4b420?w=1920&h=1080&q=80&auto=format&fit=crop&crop=center"
                 alt="Sunlight illuminating a peaceful sanctuary space"
                 class="w-full h-full object-cover opacity-50" loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-t from-bes-forest-deep via-bes-forest-deep/80 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full pb-20 pt-40 md:pt-56 px-6 md:px-10">
            <div class="max-w-7xl mx-auto grid xl:grid-cols-12 gap-12 items-end">
                
                <div class="xl:col-span-8 reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                    <p class="font-body !text-bes-gold text-xs md:text-sm tracking-nav uppercase mb-5 flex items-center gap-3">
                        <span class="w-8 h-[1px] bg-bes-gold block"></span>
                        Eling Sanctuary &mdash; 1-on-1 Spiritual Mentorship
                    </p>
                    <h1 class="font-display font-light text-[3rem] md:text-6xl lg:text-[5rem] text-bes-parchment tracking-display leading-[1.05] mb-8">
                        Remember Who You <br class="hidden md:block"> Were Before The World <br class="hidden md:block"> Told You Who To Be.
                    </h1>
                    <p class="text-lg md:text-xl text-bes-cream/90 leading-relaxed max-w-2xl mb-0">
                        <em>Eling</em> means "to remember." Rooted in ancestral Balinese wisdom, our intuitive 1-on-1 mentorship bypasses the conscious mind to decipher your karmic blueprint, sever generational traumas, and guide you back to your absolute, sovereign truth.
                    </p>
                </div>

                <div class="xl:col-span-4 bg-white/5 backdrop-blur-xl border border-bes-gold/20 rounded-xl p-8 text-center xl:text-left reveal-item opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out shadow-2xl">
                    <p class="font-body text-xs !text-bes-gold tracking-label uppercase mb-2">Energy Exchange</p>
                    <p class="font-display text-4xl md:text-5xl text-bes-parchment tracking-display leading-none mb-2">
                        <?php echo esc_html( $a['price'] ); ?>
                    </p>
                    <p class="text-xs text-bes-cream/60 mb-6 uppercase tracking-wider">Per 90-Minute Session</p>
                    
                    <ul class="text-sm text-bes-cream/90 mb-8 space-y-3 text-left">
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Intuitive Soul Reading
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Karmic Blockage Clearing
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Available In-Person &amp; Online
                        </li>
                    </ul>

                    <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="block w-full bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep font-body font-semibold 
                              tracking-label uppercase text-sm text-center px-6 py-4 rounded transition-all duration-300 hover:shadow-[0_0_20px_rgba(212,175,55,0.4)]">
                        Apply For Mentorship
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-bes-ivory py-24 md:py-32 border-b border-bes-parchment/50">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-3">The Symptoms of Misalignment</p>
                <h2 class="font-display text-3xl md:text-[2.8rem] text-bes-forest-deep tracking-display leading-tight mb-6">
                    You Are Not Broken. You Are Simply Wandering in the Wrong World.
                </h2>
                <p class="text-base md:text-lg text-bes-bark leading-relaxed">
                    When the soul is out of alignment with its <em>Dharma</em> (cosmic purpose), the physical and emotional bodies sound the alarm. Eling Guiding is designed for those experiencing:
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $symptoms = [
                    ['title' => 'Chronic Burnout', 'desc' => 'Exhaustion that sleep cannot fix. A deep spiritual fatigue from living a life that looks successful on paper but feels empty in reality.'],
                    ['title' => 'Ancestral Loops', 'desc' => 'Finding yourself repeating the exact same destructive relationship, financial, or emotional patterns that plagued your parents or ancestors.'],
                    ['title' => 'The Void of Purpose', 'desc' => 'A haunting sensation that you are meant for something profound, yet feeling completely paralyzed on how to access or monetize that gift.'],
                    ['title' => 'Spiritual Bypassing', 'desc' => 'You have read the books, done the yoga, and attended the retreats—yet the core visceral pain or anxiety remains untouched in your body.']
                ];
                foreach ($symptoms as $index => $symp) :
                    $delay = $index * 150;
                ?>
                <div class="bg-white p-8 rounded-lg shadow-sm border border-bes-parchment reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out" style="transition-delay: <?php echo $delay; ?>ms;">
                    <div class="w-10 h-10 border border-bes-gold rounded-full flex items-center justify-center !text-bes-gold mb-6 font-display text-xl">
                        <?php echo $index + 1; ?>
                    </div>
                    <h3 class="font-display text-xl text-bes-forest-deep mb-3"><?php echo $symp['title']; ?></h3>
                    <p class="text-sm text-bes-bark leading-relaxed"><?php echo $symp['desc']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="bg-bes-parchment py-24 md:py-32 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-bes-gold/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>

        <div class="max-w-4xl mx-auto px-6 md:px-10 text-center relative z-10">
            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-100 ease-out font-display text-3xl md:text-[2.8rem] text-bes-forest-deep tracking-display leading-tight mb-8">
                Western Modalities Treat the Mind as a Puzzle.<br>Balinese Wisdom Treats the Soul as a Compass.
            </h2>
            <div class="reveal-item opacity-0 transition-opacity duration-1000 delay-300 w-16 h-[2px] bg-bes-gold mx-auto mb-10"></div>
            
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-200 ease-out text-base md:text-lg text-bes-bark leading-[1.85] max-w-3xl mx-auto mb-8">
                In Bali, we understand the universe through the lens of <strong>Sekala</strong> (the seen, material world) and <strong>Niskala</strong> (the unseen, energetic world). Most modern therapy only addresses the <em>Sekala</em>—analyzing your actions, thoughts, and environment. 
            </p>
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-300 ease-out text-base md:text-lg text-bes-bark leading-[1.85] max-w-3xl mx-auto font-medium">
                <strong>Eling Guiding penetrates the Niskala.</strong> Our guides do not just listen to your words; they map the silent frequencies of your aura, your chakras, and your ancestral lineage. By bypassing the ego’s defensive noise, we help you hear the exact wisdom your soul is desperately trying to speak.
            </p>
        </div>
    </section>

    <section class="bg-bes-forest-deep py-24 md:py-32 text-bes-cream">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="reveal-item opacity-0 -translate-x-10 transition-all duration-1000 ease-out relative">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&h=1000&q=80&auto=format&fit=crop" 
                         alt="Balinese temple architecture and spiritual offerings" 
                         class="rounded-xl shadow-2xl object-cover w-full h-[500px] md:h-[650px]" loading="lazy">
                    <div class="absolute -bottom-8 -right-8 bg-bes-gold text-bes-forest-deep p-8 rounded-lg shadow-xl hidden md:block max-w-xs">
                        <p class="font-display text-2xl mb-2">Tri Hita Karana</p>
                        <p class="font-body text-xs leading-relaxed">The Balinese holy trinity of harmony: Connection to God (Spirit), Connection to Humans (Community), and Connection to Nature.</p>
                    </div>
                </div>
                <div class="reveal-item opacity-0 translate-x-10 transition-all duration-1000 delay-200 ease-out">
                    <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-4">Our Lineage</p>
                    <h2 class="font-display text-3xl md:text-5xl text-bes-parchment tracking-display leading-tight mb-6">
                        Authentic Guidance,<br>Not Just Life Coaching.
                    </h2>
                    <p class="text-base text-bes-cream/80 leading-[1.8] mb-6">
                        Eling Sanctuary is not a corporate wellness center. We are grounded in genuine Balinese spiritual lineages. Your guide is trained in esoteric traditions passed down through generations of <em>Mangkus</em> (Balinese priests) and traditional healers.
                    </p>
                    <p class="text-base text-bes-cream/80 leading-[1.8] mb-8">
                        We hold a profoundly grounded container for your heaviest shadows. Whether you are dealing with grief, massive life transitions, or spiritual awakenings, we offer a sanctuary where your rawest self is not judged, but revered and realigned.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 border-t border-bes-cream/10 pt-8">
                        <div>
                            <p class="font-display text-3xl !text-bes-gold mb-1">100%</p>
                            <p class="text-xs uppercase tracking-widest text-bes-cream/50">Confidential Container</p>
                        </div>
                        <div>
                            <p class="font-display text-3xl !text-bes-gold mb-1">No</p>
                            <p class="text-xs uppercase tracking-widest text-bes-cream/50">Spiritual Bypassing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-20">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Methodology</p>
                <h2 class="font-display text-3xl md:text-[2.8rem] text-bes-forest-deep tracking-display leading-tight">
                    Four Layers of Profound Clarity
                </h2>
            </div>

            <?php
            $layers = [
                [
                    'num'   => '01',
                    'title' => 'Intuitive Reading & Soul Mapping',
                    'sub'   => 'Seeing Beyond the Surface',
                    'body'  => 'Your session begins with absolute stillness and an energetic assessment. Before you explain the details of your current struggles, our guides read your subtle energetic field (aura and chakras) to identify deeply rooted karmic patterns. This establishes a profound baseline of truth, allowing us to address the root cause of your pain rather than chasing symptoms.',
                    'img'   => 'https://images.unsplash.com/photo-1518002054494-3a6f94352e9d?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Quiet space with singing bowls representing intuitive listening',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => '02',
                    'title' => 'Unearthing the Blockages',
                    'sub'   => 'Shadow Work & Emotional Evacuation',
                    'body'  => 'Once the energetic map is laid out, we engage in deeply guided dialogue. We compassionately interrogate limiting beliefs, ancestral traumas, and inner-child wounds that are creating friction in your current reality. In this confidential container, you are finally permitted to give a voice to the grief, rage, or fear you have hidden from the world.',
                    'img'   => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Two people in deep, compassionate conversation',
                    'dir'   => 'reverse',
                ],
                [
                    'num'   => '03',
                    'title' => 'Dharma Discovery',
                    'sub'   => 'Aligning with Your Cosmic Duty',
                    'body'  => 'With the dense energies acknowledged and cleared, the focus shifts to ascension. What is your <em>Dharma</em>—your true path and life purpose? Eling Guiding helps you crystallize your unique gifts, teaching you to definitively tell the difference between the loud voice of the ego (rooted in fear) and the quiet whisper of your intuition (rooted in truth).',
                    'img'   => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Looking out toward the horizon representing future clarity',
                    'dir'   => 'normal',
                ],
                [
                    'num'   => '04',
                    'title' => 'Integration & Actionable Blueprint',
                    'sub'   => 'Grounding the Spiritual into the Physical',
                    'body'  => 'A breakthrough is only useful if it changes how you live on Monday morning. We conclude the session by grounding your spiritual insights into tangible, real-world actions. You will leave with bespoke meditation practices, breathwork routines, or boundary-setting strategies to ensure your energetic shift becomes your permanent reality.',
                    'img'   => 'https://images.unsplash.com/photo-1606293926075-69a00dbfde81?w=750&h=900&q=80&auto=format&fit=crop&crop=center',
                    'alt'   => 'Hands holding mala beads in mindful integration',
                    'dir'   => 'reverse',
                ],
            ];

            foreach ( $layers as $i => $layer ) :
                $img_order = $layer['dir'] === 'reverse' ? 'lg:order-1' : 'lg:order-2';
                $txt_order = $layer['dir'] === 'reverse' ? 'lg:order-2' : 'lg:order-1';
                $slide_dir_cls = $layer['dir'] === 'reverse' ? '-translate-x-12' : 'translate-x-12';
            ?>
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-24 last:mb-0">
                
                <div class="<?php echo $img_order; ?> reveal-item opacity-0 scale-95 transition-all duration-1000 ease-out shadow-2xl rounded-xl overflow-hidden group relative">
                    <div class="absolute inset-0 bg-bes-forest-deep/10 group-hover:bg-transparent transition-colors duration-700 z-10"></div>
                    <img src="<?php echo esc_url( $layer['img'] ); ?>" 
                         alt="<?php echo esc_attr( $layer['alt'] ); ?>"
                         class="w-full h-[450px] md:h-[550px] object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy" />
                </div>

                <div class="<?php echo $txt_order; ?> reveal-item opacity-0 <?php echo $slide_dir_cls; ?> transition-all duration-1000 delay-150 ease-out">
                    <div class="flex items-baseline gap-5 mb-6">
                        <span class="font-display text-[3rem] md:text-[4rem] !text-bes-gold/30 leading-none tracking-display whitespace-nowrap"><?php echo $layer['num']; ?></span>
                        <div>
                            <h3 class="font-display text-2xl md:text-[2rem] text-bes-forest-deep tracking-display leading-tight"><?php echo $layer['title']; ?></h3>
                            <p class="font-body text-xs text-bes-olive tracking-wider uppercase mt-2 font-semibold"><?php echo $layer['sub']; ?></p>
                        </div>
                    </div>
                    <p class="text-base md:text-lg text-bes-bark leading-[1.8]"><?php echo $layer['body']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </section>

    <section class="bg-bes-parchment py-24 md:py-32 relative">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center mb-16 reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out">
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display">Echoes of Awakening</h2>
                <p class="text-sm text-bes-olive mt-2 uppercase tracking-widest">Real transformations from our global family</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $testimonials = [
                    ['quote' => 'I spent a decade in Western therapy analyzing my pain. In one 90-minute session at Eling, I finally understood its energetic root and released it. Profoundly life-altering.', 'name' => 'Sarah M.', 'loc' => 'London, UK (Virtual Session)'],
                    ['quote' => 'The intuitive reading was so accurate it moved me to tears immediately. They saw parts of my soul I had kept hidden even from myself. I finally know what my purpose is.', 'name' => 'David T.', 'loc' => 'Sydney, AU (In-Person)'],
                    ['quote' => 'This is not standard coaching. This is deep, ancestral unblocking. The heavy fog of burnout I carried for 5 years lifted within days of our session.', 'name' => 'Elena R.', 'loc' => 'Berlin, DE (Virtual Session)'],
                ];
                foreach ($testimonials as $index => $test) :
                    $delay = $index * 200;
                ?>
                <div class="bg-white/60 backdrop-blur-sm p-8 rounded-lg shadow-sm border border-bes-cream/50 reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out" style="transition-delay: <?php echo $delay; ?>ms;">
                    <svg class="w-8 h-8 !text-bes-gold/40 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="text-bes-bark italic leading-relaxed mb-6 font-medium">"<?php echo $test['quote']; ?>"</p>
                    <p class="font-display text-bes-forest-deep text-lg"><?php echo $test['name']; ?></p>
                    <p class="text-xs text-bes-olive uppercase tracking-widest"><?php echo $test['loc']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="bg-bes-cream py-20 md:py-32">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            
            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-4">
                    How We Connect
                </h2>
                <p class="text-base text-bes-bark max-w-2xl mx-auto leading-relaxed">
                    Energy knows no time or distance. Whether you are physically sitting with us in the jungles of Bali or connecting from your living room across the globe, the energetic transmission remains intensely potent. Choose the format that serves you best.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                
                <div class="reveal-item opacity-0 -translate-x-6 transition-all duration-700 ease-out bg-white rounded-xl p-10 border border-bes-parchment shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-bes-leaf-soft/10 rounded-full blur-2xl group-hover:bg-bes-leaf-soft/20 transition-all"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-bes-leaf-soft/30 rounded-full flex items-center justify-center mb-8">
                            <svg class="w-7 h-7 text-bes-forest" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep mb-4">At Eling Sanctuary</h3>
                        <p class="text-sm text-bes-bark leading-relaxed mb-8 h-24">
                            Meet your guide in our private, energetically cleansed shala surrounded by the sacred nature of Tampaksiring, Bali. Allows for direct aura cleansing, physical grounding, and optional integration with sacred sound instruments.
                        </p>
                        <ul class="space-y-4 mb-10 border-t border-bes-parchment pt-6">
                            <li class="flex items-center gap-3 text-sm font-medium text-bes-forest-deep">
                                <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                90-Minute Intensive Deep Dive
                            </li>
                            <li class="flex items-center gap-3 text-sm font-medium text-bes-forest-deep">
                                <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Direct Physical Energetic Clearing
                            </li>
                        </ul>
                        <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-white bg-bes-forest px-6 py-3 rounded hover:bg-bes-forest-deep transition-colors w-full justify-center">
                            Book In-Person &rarr;
                        </a>
                    </div>
                </div>

                <div class="reveal-item opacity-0 translate-x-6 transition-all duration-700 delay-150 ease-out bg-white rounded-xl p-10 border border-bes-parchment shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-bes-gold/10 rounded-full blur-2xl group-hover:bg-bes-gold/20 transition-all"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-bes-gold/10 rounded-full flex items-center justify-center mb-8">
                            <svg class="w-7 h-7 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-display text-2xl md:text-3xl text-bes-forest-deep mb-4">Virtual Mentorship</h3>
                        <p class="text-sm text-bes-bark leading-relaxed mb-8 h-24">
                            For our global community, or those seeking ongoing integration support after returning home. We hold the exact same profound energetic space via Zoom, focusing heavily on intuitive reading and actionable spiritual guidance.
                        </p>
                        <ul class="space-y-4 mb-10 border-t border-bes-parchment pt-6">
                            <li class="flex items-center gap-3 text-sm font-medium text-bes-forest-deep">
                                <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                90-Minute Virtual Session via Zoom
                            </li>
                            <li class="flex items-center gap-3 text-sm font-medium text-bes-forest-deep">
                                <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Global Timezone Accommodation
                            </li>
                        </ul>
                        <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-bes-forest border-2 border-bes-forest px-6 py-3 rounded hover:bg-bes-forest hover:!text-white transition-colors w-full justify-center">
                            Book Online &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="relative py-32 md:py-48 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600282136009-1a986cb003b5?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 alt="Traditional Balinese architecture and serenity"
                 class="w-full h-full object-cover scale-105" loading="lazy" />
            <div class="absolute inset-0 bg-bes-forest-deep/95"></div>
        </div>

        <div class="relative z-10 text-center max-w-3xl mx-auto px-6 md:px-10">
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-body !text-bes-gold tracking-[0.2em] uppercase text-sm mb-4">
                Your Dharma Awaits
            </p>
            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-100 ease-out font-display text-4xl md:text-[4rem] text-bes-parchment tracking-display leading-[1.1] mb-8">
                Are You Ready to Remember?
            </h2>
            <p class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-200 ease-out text-lg md:text-xl text-bes-cream/80 leading-relaxed mb-12 max-w-2xl mx-auto">
                Stop living from a place of reaction, exhaustion, and unhealed ancestral wounds. Take the brave first step toward profound clarity and book your mentorship session today.
            </p>

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 delay-300 ease-out flex justify-center">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-3 bg-bes-gold hover:bg-bes-gold-soft text-bes-forest-deep 
                          font-body font-bold tracking-widest uppercase text-sm px-12 py-5 rounded transition-all 
                          duration-300 hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:-translate-y-1">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    Begin Your Dialogue
                </a>
            </div>
            <p class="reveal-item opacity-0 transition-opacity duration-1000 delay-500 mt-6 text-xs text-bes-cream/40 uppercase tracking-widest">
                Spaces are limited to preserve energetic integrity.
            </p>
        </div>
    </section>

    </div><script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-8', 'translate-y-6', 'translate-x-12', '-translate-x-12', '-translate-x-10', 'translate-x-10', '-translate-x-8', 'translate-x-8', '-translate-x-6', 'translate-x-6', 'scale-95');
                    entry.target.classList.add('opacity-100', 'translate-y-0', 'translate-x-0', 'scale-100');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal-item').forEach(el => {
            observer.observe(el);
        });
    });
    </script>

    <?php
    return ob_get_clean();
}