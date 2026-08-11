<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_ytt_50h_landing] Shortcode
 * ============================================================================
 *
 * Registers [bes_ytt_50h_landing] specifically for the 50H On-Site Page.
 * 100% aligned with BES v3 design system:
 * - Tailwind BES color tokens, font-display, font-body
 * - tracking-nav / tracking-label / tracking-display
 * - bes-reveal entrance animations, bes-fret dividers
 *
 * UNIQUE SECTIONS (7 total):
 * 0  Cinematic Hero — 7-Day Retreat focus, 50H Foundation
 * 1  Who Is This For? — Stress, Burnout, Beginners & Dream Outcomes
 * 2  The Immersion Advantage — Way of Life, Sadhana, Immersive Retreat
 * 3  The 7-Day Curriculum — Philosophy, Vedic Cosmology, Tri Hita Karana
 * 4  Instructor & Community — Profile + Real Alumni Testimonials
 * 5  Investment & Bonuses — Rp 8.699.000 All-in (Uniform, Mat, Meals)
 * 6  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_ytt_50h_landing', 'bes_render_ytt_50h');

function bes_render_ytt_50h($atts)
{
    ob_start();
?>

    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-heading">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_58%)]"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">
            <div class="bes-reveal mb-8 space-y-2">
                <p class="font-display font-light italic text-white/30 text-lg md:text-xl tracking-wide">
                    <em>Awaken Your Inner Peace</em>
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50">
                    7 Days. 50 Hours. A Lifetime of Impact.
                </p>
            </div>

            <div class="bes-reveal flex flex-wrap items-center justify-center gap-3 mb-10">
                <div class="inline-flex items-center gap-2 bg-bes-leaf/[.06] border border-bes-leaf/[.14] rounded-full px-4 py-2">
                    <i class="fa-solid fa-leaf text-bes-leaf text-[10px]" aria-hidden="true"></i>
                    <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/70">Foundational Immersion</span>
                </div>
            </div>

            <h1 id="bes-ytt-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-4">
                50-Hour Yoga Teacher
            </h1>
            <h2 class="bes-reveal font-display font-light text-bes-leaf text-4xl md:text-5xl lg:text-[4rem] tracking-display leading-none mb-8 italic">
                Training (YTT 50H)
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                A highly transformative 7-day immersion designed for beginners, busy professionals, and spiritual seekers. Step away from the noise, reconnect with your true self, and experience yoga as a profound way of life.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="#bes-50h-investment"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                    <i class="fa-solid fa-arrow-down text-sm group-hover:translate-y-1 transition-transform" aria-hidden="true"></i>
                    View Retreat Details
                </a>
                <a href="https://wa.me/6287825899117" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                    Ask Program Consultant
                </a>
            </div>
            <div class="bes-reveal h-[1px] w-48 mx-auto bg-gradient-to-r from-transparent via-bes-leaf/40 to-transparent"></div>
        </div>
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>

    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Is the 50H Retreat for you">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Calling</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Are you feeling disconnected from your own life?
                    </h2>
                    
                    <div class="space-y-4">
                        <?php
                        $pains = [
                            "You are exhausted, stressed, and overthinking due to a relentless daily routine.",
                            "You feel a loss of direction or profound disconnection from your inner self.",
                            "Your body feels unbalanced, carrying tension, low energy, and a lack of flexibility.",
                            "You want a spiritual practice, but lack the structure or environment to cultivate it.",
                            "You only know yoga as a physical workout, missing out on its power as a holistic way of life."
                        ];
                        foreach ($pains as $pain) : ?>
                            <div class="bes-reveal flex items-start gap-4 p-4 rounded-xl border border-bes-sand/50 bg-white/40">
                                <i class="fa-solid fa-cloud-rain text-bes-olive mt-1 text-sm" aria-hidden="true"></i>
                                <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($pain); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bes-reveal relative rounded-3xl border border-bes-leaf/20 overflow-hidden" style="background:linear-gradient(145deg,rgba(38,51,32,.9),rgba(21,30,16,1))">
                    <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="p-10 md:p-12">
                        <h3 class="font-display font-light italic text-bes-gold text-3xl mb-8">The Awakening</h3>
                        <ul class="space-y-6">
                            <?php
                            $outcomes = [
                                ['icon' => 'fa-solid fa-heart-pulse', 'text' => 'Rebuild a body that feels healthy, strong, and deeply balanced.'],
                                ['icon' => 'fa-solid fa-wind',        'text' => 'Clear the mental fog and achieve a calm, quiet, and focused mind.'],
                                ['icon' => 'fa-solid fa-eye',         'text' => 'Develop profound self-awareness and reconnect with your true essence.'],
                                ['icon' => 'fa-solid fa-seedling',    'text' => 'Establish a consistent, meaningful yoga practice you can take home.'],
                                ['icon' => 'fa-solid fa-stairs',      'text' => 'Lay the perfect groundwork to advance to 100H or 200H training later.'],
                            ];
                            foreach ($outcomes as $out) : ?>
                                <li class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-bes-leaf/10 border border-bes-leaf/20 flex items-center justify-center flex-shrink-0">
                                        <i class="<?php echo esc_attr($out['icon']); ?> text-bes-leaf text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($out['text']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-bes-cream py-20 md:py-28" aria-label="Why this 7-day retreat is unique">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">A Holistic Journey</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-3xl mx-auto">
                    More Than Just Physical Movement
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $usps = [
                    ['icon' => 'fa-solid fa-spa', 'title' => 'Bali Hatha Approach', 'body' => 'Learn our signature, deeply healing methodology rooted in authentic Balinese spiritual traditions.'],
                    ['icon' => 'fa-solid fa-campground', 'title' => 'Immersive Environment', 'body' => 'Step away from distractions. Our retreat camp setting provides the absolute quiet required for true inner healing.'],
                    ['icon' => 'fa-solid fa-hands-holding-circle', 'title' => 'Personal Guidance', 'body' => 'We reject mass-teaching. You will receive reflective, highly personalized attention to nurture your specific spiritual growth.'],
                ];
                foreach ($usps as $usp) : ?>
                    <div class="bes-reveal group flex flex-col items-center text-center gap-4 p-8 rounded-2xl border border-bes-sand hover:border-bes-leaf/20 hover:bg-white transition-all duration-400">
                        <div class="w-14 h-14 rounded-full bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center mb-2">
                            <i class="<?php echo esc_attr($usp['icon']); ?> text-bes-olive text-lg" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-xl"><?php echo esc_html($usp['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13.5px] leading-relaxed"><?php echo esc_html($usp['body']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="7-Day Curriculum">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-0 w-[600px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">The Immersion Syllabus</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">What You Will Master in 7 Days</h2>
                <p class="bes-reveal font-body font-light text-white/50 text-base max-w-2xl mx-auto">A beautifully structured balance of physical practice, intellectual philosophy, and spiritual experience.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $modules = [
                    ['title' => 'Asana & Surya Namaskara', 'desc' => 'Foundational postures and sun salutations taught with absolute precision and safety.'],
                    ['title' => 'Pranayama & Subtle Body', 'desc' => 'Discover the architecture of breath and the energetic pathways that govern your vitality.'],
                    ['title' => 'Meditation Techniques', 'desc' => 'Learn to quiet the mind through structured, guided meditation in nature.'],
                    ['title' => 'Philosophy & History', 'desc' => 'Understand the roots of yoga, shifting it from a workout to a comprehensive way of life.'],
                    ['title' => 'Alignment & Adjustment', 'desc' => 'Learn how to correct your own postures and move your body with biomechanical intelligence.'],
                    ['title' => 'Bali Hatha Sequencing', 'desc' => 'Experience the flow of our signature healing sequences.'],
                    ['title' => 'Tri Hita Karana & Cosmology', 'desc' => 'Deep dive into Balinese local wisdom and ancient Vedic perspectives on the universe.'],
                    ['title' => 'Guided Excursions', 'desc' => 'Connect with the sacred land of Bali through organized spiritual journeys.'],
                ];
                foreach ($modules as $mod) : ?>
                    <div class="bes-reveal group relative p-6 rounded-2xl border border-white/[.08] overflow-hidden" style="background:rgba(255,255,255,0.03)">
                        <div class="flex items-start gap-3 mb-3">
                            <i class="fa-solid fa-circle-check text-bes-gold/50 text-xs mt-1"></i>
                            <h3 class="font-display font-medium text-white text-[17px] leading-snug"><?php echo esc_html($mod['title']); ?></h3>
                        </div>
                        <p class="font-body font-light text-white/50 text-[13px] leading-relaxed ml-6"><?php echo esc_html($mod['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Lead Instructor and Testimonials">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                
                <div class="lg:col-span-5">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Spiritual Guidance</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Yoga as Sadhana
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed mb-6">
                        Under the spiritual supervision of <strong>Sri Bhagawan Sriprada Bhaskara</strong>, this program treats yoga as a true spiritual practice (Sadhana). 
                    </p>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed mb-8">
                        We don't just teach modern physical routines; we integrate authentic daily spiritual practices, ensuring your 50H certification meets international standards while remaining deeply rooted in ancient wisdom.
                    </p>
                    
                    <div class="bes-reveal flex items-center gap-3 p-4 rounded-xl border border-bes-leaf/20 bg-bes-leaf/[.05]">
                        <i class="fa-solid fa-globe text-bes-leaf text-lg"></i>
                        <span class="font-body font-medium text-bes-bark text-[13px]">Curriculum aligns with Yoga Alliance & Global Federations.</span>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-6">
                    <h3 class="bes-reveal font-display font-light italic text-bes-moss text-2xl mb-6">What Our Alumni Say</h3>
                    
                    <div class="bes-reveal bg-white p-8 rounded-2xl border border-bes-sand shadow-sm relative">
                        <i class="fa-solid fa-quote-left text-bes-sand text-3xl absolute top-6 left-6 opacity-30"></i>
                        <p class="font-body font-light text-bes-bark-muted text-[15px] leading-relaxed relative z-10 pl-8">
                            "An absolutely incredible experience… the friends I met were so kind and supportive, and the guiding yogis were full of genuine love."
                        </p>
                    </div>

                    <div class="bes-reveal bg-white p-8 rounded-2xl border border-bes-sand shadow-sm relative">
                        <i class="fa-solid fa-quote-left text-bes-sand text-3xl absolute top-6 left-6 opacity-30"></i>
                        <p class="font-body font-light text-bes-bark-muted text-[15px] leading-relaxed relative z-10 pl-8">
                            "Meditating out in nature provided such an immense wave of positive energy. It truly awakened my spirituality in ways I didn't expect."
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="bes-50h-investment" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Program Pricing">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative max-w-5xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Secure Your Space</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Training Investment</h2>
            </div>

            <div class="bes-reveal relative rounded-3xl border border-bes-leaf/30 bg-black/40 backdrop-blur-md overflow-hidden shadow-2xl">
                <div class="h-[4px] bg-gradient-to-r from-bes-gold via-bes-leaf to-bes-gold"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-2 p-10 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center items-center text-center">
                        <h3 class="font-display font-light text-white/70 text-xl mb-2">7-Day All-In Program</h3>
                        <p class="font-display text-bes-leaf text-4xl md:text-5xl font-medium mb-4">Rp 8.699.000</p>
                        <p class="font-body text-white/40 text-[13px] mb-8 leading-relaxed">
                            A completely immersive, worry-free experience where everything is provided for you.
                        </p>
                        
                        <a href="https://wa.me/6287825899117" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                            Register Now
                        </a>
                    </div>

                    <div class="md:col-span-3 p-10 md:p-12">
                        <h4 class="font-body font-bold text-[11px] uppercase tracking-nav text-white/50 mb-6">Your Retreat Includes:</h4>
                        <ul class="space-y-4">
                            <?php
                            $inclusions = [
                                'Full 7 Days of Immersive Training & Accommodation',
                                'Official YTT 50-Hour Certification upon completion',
                                'Healthy Vegetarian Meals (3x a day)',
                                'Exclusive Training Module & High-Quality Yoga Mat',
                                'Eling Academy Uniform & Welcome Goodie Bag',
                                'Seamless pathway to advance into the 100H & 200H programs',
                                'Lifelong access to our supportive spiritual community'
                            ];
                            foreach ($inclusions as $inc) : ?>
                                <li class="flex items-start gap-3">
                                    <div class="w-5 h-5 mt-0.5 rounded-full border border-bes-leaf/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check text-bes-leaf text-[9px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-white/80 text-[14px] leading-relaxed"><?php echo esc_html($inc); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bg-bes-parchment py-20 md:py-24" aria-label="Final Call to Action">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10 text-center">
            <div class="bes-reveal max-w-3xl mx-auto">
                <h2 class="font-display font-medium text-bes-bark text-4xl md:text-5xl lg:text-6xl tracking-display mb-4">
                    Reconnect with Your Soul.
                </h2>
                <h3 class="font-display font-light italic text-bes-moss text-3xl md:text-4xl tracking-display mb-6">
                    In Just 7 Days.
                </h3>
                <p class="font-body font-light text-bes-bark-muted text-base mb-10 leading-relaxed">
                    Register today, begin your deeply rewarding yoga journey, and rediscover the balance you've been searching for.
                </p>

                <a href="https://wa.me/6287825899117" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-white font-body font-bold text-[12px] uppercase tracking-label px-10 py-5 rounded-2xl hover:bg-bes-forest hover:shadow-xl transition-all duration-300">
                    Secure Your Limited Seat
                </a>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}