<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_about_us] Shortcode
 * ============================================================================
 *
 * Registers the [bes_about_us] shortcode for the About Us page.
 * Fully aligned with the BES v3 design system (Snippet 1):
 *   - Uses Tailwind utility classes with BES color tokens (bes-*)
 *   - Uses font-display (Cormorant Garamond) + font-body (Plus Jakarta Sans)
 *   - Uses bes-reveal entrance animation utility
 *   - Uses tracking-nav, tracking-label, tracking-display tokens
 *   - Zero new CSS declarations — everything rides the existing stylesheet
 *
 * USAGE: Add [bes_about_us] to any page/post via Gutenberg or Classic editor.
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_about_us', 'bes_render_about_us' );

function bes_render_about_us( $atts ) {
    ob_start();
    ?>

    <!-- ================================================================
         SECTION 0 — HERO BANNER (cinematic, full-width)
         ================================================================ -->
    <section class="relative min-h-[72vh] flex items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-about-hero-heading">

        <!-- Layered radial glows — matches footer glow language -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.07),transparent_65%)]"></div>
            <div class="absolute bottom-0 right-1/4 w-[400px] h-[300px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.05),transparent_60%)]"></div>
            <!-- Dot texture overlay — mirrors footer pattern -->
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <!-- Fretwork top strip (reuses footer class) -->
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative max-w-4xl mx-auto px-6 md:px-10 text-center py-24 md:py-32">
            <!-- Eyebrow label — same pattern as nav tracking-nav -->
            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-6 opacity-0" style="transition-delay:.1s">
                Pasraman Bali Eling Spirit &nbsp;·&nbsp; Pejeng Kangin, Bali
            </p>

            <h1 id="bes-about-hero-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-6">
                A Place That<br><em class="not-italic text-bes-leaf">Remembers</em> Who You Are
            </h1>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-xl mx-auto leading-relaxed">
                Nested in the sacred highlands of Tampaksiring, we exist not to teach you something new — but to help you unlearn what was never truly yours.
            </p>

            <!-- Decorative divider — gradient line matching footer -->
            <div class="bes-reveal mt-10 h-[1px] w-32 mx-auto bg-gradient-to-r from-transparent via-bes-leaf/40 to-transparent"></div>
        </div>

        <!-- Fretwork bottom strip -->
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <!-- ================================================================
         SECTION 1 — THE ORIGIN STORY (two-column: text + accent card)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Our origin story">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Left — body copy -->
                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        Where It Began
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Born from a Personal<br>Journey Inward
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            Long before Pasraman Bali Eling Spirit became what it is today, there was a man who sat quietly with his restlessness. Sri Bhagawan Sriprada Bhaskara — founder, teacher, and the living pulse of this place — did not arrive at this work through a tidy inheritance. He arrived through over two and a half decades of committed meditation, years of testing what actually moves the needle inside a human being, and a bone-deep desire to share whatever light he found.
                        </p>
                        <p class="bes-reveal">
                            The word <em>pasraman</em> itself tells you something. In Balinese-Hindu tradition, it describes an ashram — not a hotel, not a wellness spa, not a weekend escape. A pasraman is where real learning happens: slow, intimate, guided by a master, shaped by the specific student in front of you. That is precisely the spirit Bhagawan carried when he formally opened the gates in February 2018, first as a yoga teacher school, then expanding as more people showed up carrying burdens that yoga alone could not name.
                        </p>
                        <p class="bes-reveal">
                            His wife, Jero Ratni, joined not as a supporting cast member but as an equal architect. Her own encounter with meditation had already unlocked gifts she describes simply as <em>sensitivity to energy</em> — the ability to sit with someone's pain without flinching from it. She brought that sensitivity into practical form: spiritual counseling, Cognitive Alignment Therapy, 7-Chakra balancing, Tibetan Singing Bowl frequency healing. Together, Bhagawan and Jero Ratni built something that is harder to commodify than a five-star retreat: a home where people can be seen as they actually are.
                        </p>
                    </div>
                </div>

                <!-- Right — accent card with quote -->
                <div class="lg:col-span-5 lg:pt-14">
                    <div class="bes-reveal relative rounded-2xl border border-bes-sand overflow-hidden"
                         style="background:linear-gradient(145deg,#f2ede4,#fdfcfa)">
                        <!-- Top accent bar -->
                        <div class="h-[3px] w-full bg-gradient-to-r from-bes-leaf via-bes-gold to-transparent"></div>

                        <div class="p-8 md:p-10">
                            <!-- Pull quote -->
                            <blockquote class="mb-7">
                                <span class="block font-display font-light text-bes-bark text-2xl md:text-3xl leading-snug italic mb-4">
                                    "Eling means to remember. And the deepest remembering is remembering your own true nature."
                                </span>
                                <cite class="not-italic font-body text-[11px] font-bold uppercase tracking-label text-bes-moss">
                                    — Ida Sri Bhagawan Sriprada Bhaskara
                                </cite>
                            </blockquote>

                            <!-- Stats row -->
                            <div class="border-t border-bes-sand pt-6 grid grid-cols-2 gap-6">
                                <div>
                                    <span class="block font-display font-medium text-bes-bark text-4xl tracking-display">25<span class="text-bes-leaf">+</span></span>
                                    <span class="block font-body text-[11px] text-bes-bark-muted uppercase tracking-label mt-1">Years of Meditation Practice</span>
                                </div>
                                <div>
                                    <span class="block font-display font-medium text-bes-bark text-4xl tracking-display">500<span class="text-bes-leaf">hr</span></span>
                                    <span class="block font-body text-[11px] text-bes-bark-muted uppercase tracking-label mt-1">International YTT Certified</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Secondary accent — "Since 2018" badge -->
                    <div class="bes-reveal mt-5 flex items-center gap-4 px-6 py-4 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.06]">
                        <div class="w-10 h-10 rounded-full bg-bes-leaf/10 border border-bes-leaf/20 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-seedling text-bes-leaf text-xs" aria-hidden="true"></i>
                        </div>
                        <p class="font-body text-[13px] text-bes-bark-muted leading-snug">
                            Serving students &amp; seekers since <strong class="text-bes-bark font-semibold">February 2018</strong>, Tampaksiring, Gianyar.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 2 — WHAT ELING MEANS (dark section, on-brand)
         ================================================================ -->
    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="The meaning of Eling">

        <!-- Radial glow — mirrors footer glow language -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_65%)] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px" aria-hidden="true"></div>

        <div class="max-w-[1440px] mx-auto px-6 md:px-10 text-center">
            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">
                The Name, Unpacked
            </p>
            <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-6">
                Why We Are Called <em class="not-italic text-bes-leaf">Eling</em>
            </h2>
            <p class="bes-reveal font-body font-light text-white/45 text-base max-w-2xl mx-auto mb-14 leading-relaxed">
                In the Balinese and Javanese philosophical tradition, <em>eling</em> carries a weight that the English word "remember" barely holds. It is not nostalgia. It is a present-tense awakening to what you have always already been.
            </p>

            <!-- Three pillars -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

                <?php
                $pillars = [
                    [
                        'icon'    => 'fa-solid fa-eye',
                        'number'  => '01',
                        'title'   => 'Eling Raga',
                        'sub'     => 'Awareness of the Body',
                        'body'    => 'Before the mind can settle, the body must be honestly inhabited. We begin every program here — in the physical form, through Bali Hatha Yoga and pranayama, learning that the breath is always the first teacher. Nothing is rushed. Nothing is forced.',
                    ],
                    [
                        'icon'    => 'fa-solid fa-heart',
                        'number'  => '02',
                        'title'   => 'Eling Hati',
                        'sub'     => 'Remembering the Heart',
                        'body'    => 'Much of what holds people back lives not in the mind but in the chest — old griefs, calcified shame, the weight of things unsaid. Our healing work creates space where those layers can be touched, named, and finally released at a pace that each person sets for themselves.',
                    ],
                    [
                        'icon'    => 'fa-solid fa-infinity',
                        'number'  => '03',
                        'title'   => 'Eling Jiwa',
                        'sub'     => 'Reunion with the Soul',
                        'body'    => 'The deepest layer of the work — the recognition that underneath all the accumulated noise of a life is something that has never been wounded. Meditation, Dharma teaching, and the energy of this land conspire to bring that recognition forward.',
                    ],
                ];
                foreach ( $pillars as $p ) : ?>
                <div class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden transition-all duration-500 hover:border-bes-leaf/20 hover:bg-white/[.02]"
                     style="background:rgba(38,51,32,0.4)">
                    <!-- Leaf glow on hover -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-[radial-gradient(circle,rgba(194,210,74,0.06),transparent_70%)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="relative p-7 md:p-8">
                        <!-- Number + icon row -->
                        <div class="flex items-center justify-between mb-6">
                            <span class="font-display font-light text-white/10 text-6xl leading-none"><?php echo $p['number']; ?></span>
                            <div class="w-11 h-11 rounded-xl bg-bes-leaf/[.08] border border-bes-leaf/[.12] flex items-center justify-center">
                                <i class="<?php echo esc_attr($p['icon']); ?> text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-medium text-white text-2xl mb-1"><?php echo esc_html($p['title']); ?></h3>
                        <p class="font-body text-[10px] font-bold uppercase tracking-nav text-bes-leaf/60 mb-4"><?php echo esc_html($p['sub']); ?></p>
                        <p class="font-body font-light text-white/45 text-[14px] leading-relaxed"><?php echo esc_html($p['body']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 3 — THE LAND & SETTING
         ================================================================ -->
    <section class="bg-bes-cream py-20 md:py-28" aria-label="Our sacred location">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left — decorative geography block -->
                <div class="lg:col-span-5 order-2 lg:order-1">
                    <div class="bes-reveal relative">
                        <!-- Stacked card effect -->
                        <div class="absolute -bottom-3 -right-3 w-full h-full rounded-2xl bg-bes-leaf/[.06] border border-bes-leaf/[.08]"></div>
                        <div class="absolute -bottom-1.5 -right-1.5 w-full h-full rounded-2xl bg-bes-forest/[.04] border border-bes-forest/[.06]"></div>

                        <div class="relative rounded-2xl overflow-hidden border border-bes-sand"
                             style="background:linear-gradient(160deg,#263320,#1E2A16)">
                            <div class="h-[3px] bg-gradient-to-r from-bes-leaf via-bes-gold to-transparent"></div>
                            <div class="p-8 md:p-10">

                                <!-- Location details list -->
                                <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf/70 mb-5">Sacred Geography</p>

                                <?php
                                $geo = [
                                    [ 'icon' => 'fa-solid fa-mountain-sun', 'label' => 'Village',   'value' => 'Pejeng Kangin, Tampaksiring' ],
                                    [ 'icon' => 'fa-solid fa-map-pin',      'label' => 'Regency',   'value' => 'Gianyar, Bali — Indonesia' ],
                                    [ 'icon' => 'fa-solid fa-wind',         'label' => 'Elevation', 'value' => 'Highland forest, Sayan ridge' ],
                                    [ 'icon' => 'fa-solid fa-water',        'label' => 'Nearby',    'value' => 'Ancient temple springs of Tampaksiring' ],
                                ];
                                foreach ( $geo as $g ) : ?>
                                <div class="flex items-center gap-4 py-3.5 border-b border-white/[.04] last:border-0">
                                    <div class="w-8 h-8 rounded-lg bg-bes-leaf/[.06] flex items-center justify-center flex-shrink-0">
                                        <i class="<?php echo esc_attr($g['icon']); ?> text-bes-leaf/50 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <span class="block font-body text-[9px] uppercase tracking-label text-white/25 font-bold"><?php echo esc_html($g['label']); ?></span>
                                        <span class="block font-body text-[13px] text-white/65 mt-0.5"><?php echo esc_html($g['value']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right — copy -->
                <div class="lg:col-span-7 order-1 lg:order-2">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">
                        The Land Itself is a Teacher
                    </p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Rooted in the Highlands<br>of Tampaksiring
                    </h2>

                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-base leading-relaxed">
                        <p class="bes-reveal">
                            There is a reason the Balinese have long considered Tampaksiring among the most sacred districts on the island. The water here — filtered through ancient volcanic stone before surfacing at the royal bathing temples of Tirta Empul — carries a quality that is not merely poetic. Participants consistently report that simply arriving in this part of Bali shifts something. The altitude clears the head. The canopy insulates sound. The air, genuinely, is different.
                        </p>
                        <p class="bes-reveal">
                            We did not choose this location arbitrarily. The land chose the work, and the work chose the land. The rice terraces that step down beyond our practice space are not décor — they are a living demonstration of the Balinese philosophy of <em>Tri Hita Karana</em>: harmony between people, between the community, and between humanity and the divine. Every program that unfolds here is quietly in conversation with that philosophy.
                        </p>
                        <p class="bes-reveal">
                            The Pasraman does not currently offer on-site accommodation, and we think that is worth being honest about. It is not an oversight waiting to be fixed. Many participants have shared that the daily drive or walk through the village — passing offerings being laid, hearing temple bells — has itself become part of the practice. When accommodation within the grounds finally arrives, it will be built to honor, not override, that rhythm.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 4 — THE MASTERS (founders, intimate portrait)
         ================================================================ -->
    <section class="bg-bes-parchment py-20 md:py-28" aria-label="Our founders and teachers">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <!-- Section header -->
            <div class="text-center mb-14 md:mb-20">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Heart Behind the Practice</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">The Guides</h2>
            </div>

            <!-- Two masters side by side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                <!-- Bhagawan -->
                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="h-[3px] bg-gradient-to-r from-bes-leaf via-bes-gold to-transparent"></div>
                    <div class="p-8 md:p-10">
                        <!-- Avatar placeholder with initials -->
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-bes-olive to-bes-forest flex items-center justify-center mb-6 border border-bes-leaf/20">
                            <span class="font-display font-medium text-bes-leaf text-2xl">B</span>
                        </div>

                        <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-2">Founder &amp; Head Teacher</p>
                        <h3 class="font-display font-medium text-bes-bark text-2xl md:text-3xl mb-1">Ida Sri Bhagawan</h3>
                        <p class="font-display italic text-bes-bark-muted text-lg mb-6">Sriprada Bhaskara</p>

                        <div class="space-y-4 font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-7">
                            <p>
                                When you spend twenty-five years sitting with yourself in meditation — genuinely, without performance — you begin to see things differently. Bhagawan will tell you that yoga was not something he came to because it was fashionable. He came to it because nothing else was honest enough. He completed his 500-hour international Yoga Teacher Training and emerged not just certified, but changed.
                            </p>
                            <p>
                                He designed the Bali Hatha Yoga methodology that anchors all programs here — a form that deliberately favors gentleness over acrobatics, recognizing that the nervous system heals not through effort but through sustained safety. His teaching has guided hundreds of students since 2018, many of whom describe their experience simply: <em>"he sees what you came in carrying without you having to say a word."</em>
                            </p>
                        </div>

                        <!-- Credential pills -->
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $bada = ['500hr YTT', '25yr Meditator', 'Bali Hatha Yoga Creator', 'Dharma Teacher'];
                            foreach ($bada as $b): ?>
                            <span class="font-body text-[10px] font-bold uppercase tracking-label bg-bes-forest/[.05] border border-bes-forest/[.08] text-bes-bark-muted px-3 py-1.5 rounded-full"><?php echo esc_html($b); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Jero Ratni -->
                <div class="bes-reveal group relative rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)">
                    <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="p-8 md:p-10">
                        <!-- Avatar placeholder -->
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-bes-gold/30 to-bes-olive flex items-center justify-center mb-6 border border-bes-gold/20">
                            <span class="font-display font-medium !text-bes-gold text-2xl">J</span>
                        </div>

                        <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-2">Co-Founder &amp; Healing Practitioner</p>
                        <h3 class="font-display font-medium text-bes-bark text-2xl md:text-3xl mb-1">Jero Ratni</h3>
                        <p class="font-display italic text-bes-bark-muted text-lg mb-6">Practitioner &amp; Spiritual Guide</p>

                        <div class="space-y-4 font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-7">
                            <p>
                                Jero Ratni arrived at this work through her own interior reckoning. Meditation opened something in her she describes with characteristic directness as <em>sensitivity</em> — a felt knowing of where another person's energy is stuck, knotted, or simply not yet allowed to flow. Rather than suppress that sensitivity, she apprenticed it into form: into certifications, into practice, into a healing language others could receive.
                            </p>
                            <p>
                                Her work spans spiritual counseling, Cognitive Alignment Therapy, 7-Chakra balancing, and sound healing with Tibetan Singing Bowls. She brings a rare quality to the retreat space: she does not rush toward resolution. She is willing to simply be present with whatever arises, which is, in the end, the most healing thing one person can offer another.
                            </p>
                        </div>

                        <!-- Credential pills -->
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $jada = ['Spiritual Counselor', 'CAT Practitioner', '7-Chakra Healer', 'Tibetan Bowl Therapy'];
                            foreach ($jada as $j): ?>
                            <span class="font-body text-[10px] font-bold uppercase tracking-label bg-bes-forest/[.05] border border-bes-forest/[.08] text-bes-bark-muted px-3 py-1.5 rounded-full"><?php echo esc_html($j); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 5 — OUR PHILOSOPHY (dark, immersive)
         ================================================================ -->
    <section class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Our philosophy">

        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Sticky header column -->
                <div class="lg:col-span-4 lg:sticky lg:top-28">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">How We Think</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        The Philosophy<br>We Work From
                    </h2>
                    <p class="bes-reveal font-body font-light text-white/40 text-sm leading-relaxed">
                        Three convictions shape every program, every session, and every cup of herbal tea offered here.
                    </p>

                    <div class="bes-reveal mt-8 h-[1px] w-24 bg-gradient-to-r from-bes-leaf/40 to-transparent"></div>
                </div>

                <!-- Philosophy items -->
                <div class="lg:col-span-8 space-y-6">

                    <?php
                    $phils = [
                        [
                            'n' => '1',
                            'icon' => 'fa-solid fa-leaf',
                            'title' => 'Healing is Personal — and Inward',
                            'body' => 'We do not heal people here. We create conditions where people can heal themselves — and we are rigorous about this distinction. The Master guides. The land holds. The practices provide structure. But the actual work of transformation is done by the individual, in their own interior, at a depth that no teacher can reach on their behalf. This is not a limitation of our programs. It is their entire premise.',
                        ],
                        [
                            'n' => '2',
                            'icon' => 'fa-solid fa-circle-nodes',
                            'title' => 'The Three Bodies Are One Conversation',
                            'body' => 'In our teaching we refer to Sthula Sarira (the physical body), Sukhma Sarira (the subtle body — mind and feelings), and Antah Karana Sarira (the causal body — the soul). The reason most wellness approaches produce only temporary relief is that they address one layer while ignoring the other two. We move through all three, always. A session that begins with physical yoga may end somewhere profoundly emotional. That is not a side-effect. That is the point.',
                        ],
                        [
                            'n' => '3',
                            'icon' => 'fa-solid fa-hands-praying',
                            'title' => 'Open to All, Rooted in One',
                            'body' => 'Every program here is open to participants of all backgrounds, religions, and prior experience levels. We do not require you to be Hindu, to identify as spiritual, or to believe anything specific. What we do offer is a tradition — rooted in Balinese-Hindu philosophy, Dharma teaching, and the lineage practices passed through Bhagawan\'s own initiation. You are warmly invited to receive whatever resonates and let the rest pass by.',
                        ],
                    ];
                    foreach ( $phils as $ph ) : ?>

                    <div class="bes-reveal group relative rounded-2xl border border-white/[.04] overflow-hidden transition-all duration-500 hover:border-bes-leaf/15"
                         style="background:rgba(38,51,32,0.35)">
                        <div class="absolute top-0 left-0 w-[3px] h-full bg-gradient-to-b from-bes-leaf/0 via-bes-leaf/40 to-bes-leaf/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="relative p-7 md:p-8 flex gap-5 md:gap-7">
                            <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-bes-leaf/[.07] border border-bes-leaf/[.12] flex items-center justify-center mt-0.5">
                                <i class="<?php echo esc_attr($ph['icon']); ?> text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-medium text-white text-xl md:text-2xl mb-3"><?php echo esc_html($ph['title']); ?></h3>
                                <p class="font-body font-light text-white/45 text-[14px] leading-relaxed"><?php echo esc_html($ph['body']); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 6 — WHAT MAKES US DIFFERENT (light, numbered list)
         ================================================================ -->
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="What makes us different">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Honesty Before Marketing</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-2xl mx-auto">We Are Not For Everyone — And That Is by Design</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                <?php
                $diffs = [
                    [
                        'n'     => '01',
                        'title' => 'We Ask More of You',
                        'body'  => 'Every program involves some degree of internal confrontation. You may be asked to journal, to sit in silence, to observe yourself without judgment. If you are looking for a passive spa experience, we will warmly recommend one. If you are ready to do the actual work, come.',
                    ],
                    [
                        'n'     => '02',
                        'title' => 'Small Groups, Real Attention',
                        'body'  => 'We do not scale by filling rooms. Groups are kept deliberately small so that Bhagawan and Jero Ratni can maintain genuine contact with each participant. If you have been to retreats where you felt invisible, you will notice the difference.',
                    ],
                    [
                        'n'     => '03',
                        'title' => 'The Curriculum Is Living',
                        'body'  => 'The team at Pasraman regularly undertakes their own dharma yatras — spiritual journeys that bring new understanding back into the teaching. What you receive here has not been frozen into a product. It is still breathing.',
                    ],
                    [
                        'n'     => '04',
                        'title' => 'Service Is Part of the Path',
                        'body'  => 'For those who feel called, karma seva — voluntary service — is offered. You can contribute through cooking, cleaning, or teaching (if certified). This is not a transactional add-on. In the Balinese tradition, giving and receiving are the same energy moving in different directions.',
                    ],
                ];
                foreach ( $diffs as $d ) : ?>

                <div class="bes-reveal group flex gap-5 p-6 md:p-7 rounded-2xl border border-bes-sand hover:border-bes-leaf/20 hover:bg-bes-leaf/[.02] transition-all duration-400">
                    <span class="font-display font-light text-bes-leaf/20 text-4xl leading-none flex-shrink-0 group-hover:!text-bes-leaf/35 transition-colors duration-300"><?php echo esc_html($d['n']); ?></span>
                    <div>
                        <h3 class="font-display font-medium text-bes-bark text-xl mb-2"><?php echo esc_html($d['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($d['body']); ?></p>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ================================================================
         SECTION 7 — CLOSING CTA STRIP (mirrors footer newsletter strip)
         ================================================================ -->
    <section class="bg-bes-forest-deep py-16 md:py-20" aria-label="Get in touch">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="bes-reveal relative rounded-2xl border border-white/[.05] overflow-hidden py-12 px-8 md:px-14 text-center"
                 style="background:linear-gradient(135deg,rgba(38,51,32,.6),rgba(30,42,22,.85))">

                <!-- Glow -->
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute left-1/2 top-0 -translate-x-1/2 w-[500px] h-[200px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_60%)]"></div>
                </div>

                <div class="relative">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">The door is open</p>
                    <h2 class="font-display font-medium text-white text-3xl md:text-4xl lg:text-5xl tracking-display mb-4 max-w-2xl mx-auto">
                        Your Journey Inward<br>Can Begin Any Time
                    </h2>
                    <p class="font-body font-light text-white/40 text-base max-w-xl mx-auto mb-10 leading-relaxed">
                        Reach out to ask which program fits where you are right now. The team will respond honestly — including if this particular moment is not the right one for you to visit.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                            <i class="fa-brands fa-whatsapp text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                            Chat with Us on WhatsApp
                        </a>
                        <a href="/healing-retreat"
                           class="inline-flex items-center gap-2.5 bg-transparent text-white/70 border border-white/[.1] font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.05] hover:border-white/20 hover:!text-white transition-all duration-300">
                            <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                            Explore Programs
                        </a>
                    </div>

                    <!-- Social proof micro-line -->
                    <p class="font-body text-[11px] text-white/20 tracking-wide mt-8">
                        Open to all backgrounds &amp; traditions &nbsp;·&nbsp; Small group sizes &nbsp;·&nbsp; Tampaksiring, Bali
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}