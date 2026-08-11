<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_ytt_50h_hybrid_landing] Shortcode
 * ============================================================================
 *
 * Registers [bes_ytt_50h_hybrid_landing] specifically for the 50H Hybrid Page.
 * 100% aligned with BES v3 design system:
 * - Tailwind BES color tokens, font-display, font-body
 * - tracking-nav / tracking-label / tracking-display
 * - bes-reveal entrance animations, bes-fret dividers
 *
 * UNIQUE SECTIONS (7 total):
 * 0  Cinematic Hero — 50H Hybrid focus (LMS + 4D3N)
 * 1  Who Is This For? — Busy Professionals, Beginners, Pain Points & Outcomes
 * 2  The Hybrid Advantage — Flexibility, Affordability, Gentle Start
 * 3  The 2-Phase Curriculum — Online LMS (Theory) + 4D3N Offline (Practice)
 * 4  Lead Instructor — Profile of Sri Bhagawan Sriprada Bhaskara
 * 5  Investment & Bonuses — Rp 5.000.000 All-in
 * 6  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_ytt_50h_hybrid_landing', 'bes_render_ytt_50h_hybrid');

function bes_render_ytt_50h_hybrid($atts)
{
    ob_start();
?>

    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-heading">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_58%)]"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.04),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">
            <div class="bes-reveal mb-8 space-y-2">
                <p class="font-display font-light italic text-white/30 text-lg md:text-xl tracking-wide">
                    <em>Your Journey Begins Here</em>
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-sage/50">
                    Online Theory. 4-Day Bali Immersion.
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-sage/70">
                    Taught in Bahasa Indonesia
                </p>
            </div>

            <h1 id="bes-ytt-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-4">
                50H Hybrid YTT
            </h1>
            <h2 class="bes-reveal font-display font-light text-bes-sage text-4xl md:text-5xl lg:text-[4rem] tracking-display leading-none mb-8 italic">
                Flexible Learning. Deep Foundation.
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                The perfect stepping stone for busy professionals and dedicated beginners. Build a strong, structured foundation online at your own pace, then experience a transformative 4-Day, 3-Night Bali immersion.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="#bes-curriculum-50h"
                    class="inline-flex items-center gap-2.5 bg-bes-sage text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white transition-all duration-300 shadow-lg shadow-bes-sage/10 group">
                    <i class="fa-solid fa-seedling text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Explore the Pathway
                </a>
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                    Consult via WhatsApp
                </a>
            </div>
            <div class="bes-reveal h-[1px] w-48 mx-auto bg-gradient-to-r from-transparent via-bes-sage/40 to-transparent"></div>
        </div>
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>

    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Is the 50H Hybrid for you">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Challenge</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        You want to deepen your practice, but a full retreat feels out of reach.
                    </h2>

                    <div class="space-y-4">
                        <?php
                        $pains = [
                            "You are a busy professional or student who cannot take a full 7 to 25 days off for an in-person training.",
                            "You want to study yoga seriously, but need a flexible schedule to fit your lifestyle.",
                            "You find it difficult to stay consistent with self-study without a structured, guided system.",
                            "You feel intimidated by the intensity of a full immersion and prefer a gradual, manageable approach."
                        ];
                        foreach ($pains as $pain) : ?>
                            <div class="bes-reveal flex items-start gap-4 p-4 rounded-xl border border-bes-sand/50 bg-white/40">
                                <i class="fa-solid fa-calendar-xmark text-bes-olive mt-1 text-sm" aria-hidden="true"></i>
                                <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($pain); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bes-reveal relative rounded-3xl border border-bes-sage/20 overflow-hidden" style="background:linear-gradient(145deg,rgba(44,54,43,.9),rgba(25,31,24,1))">
                    <div class="h-[3px] bg-gradient-to-r from-bes-sage via-bes-moss to-transparent"></div>
                    <div class="p-10 md:p-12">
                        <h3 class="font-display font-light italic text-bes-sage text-3xl mb-8">The Perfect Start</h3>
                        <ul class="space-y-6">
                            <?php
                            $outcomes = [
                                ['icon' => 'fa-solid fa-laptop-house', 'text' => 'Study the core philosophy and theory online without disrupting your career.'],
                                ['icon' => 'fa-solid fa-spa',          'text' => 'Still experience the magic of a physical Bali retreat (just 4 Days, 3 Nights).'],
                                ['icon' => 'fa-solid fa-layer-group',  'text' => 'Build a solid, structured foundation safely and confidently.'],
                                ['icon' => 'fa-solid fa-scale-balanced', 'text' => 'Achieve harmony—balancing work, life, and your new spiritual journey.'],
                                ['icon' => 'fa-solid fa-arrow-up-right-dots', 'text' => 'Perfectly prepare yourself to seamlessly advance to the 100H or 200H levels later.'],
                            ];
                            foreach ($outcomes as $out) : ?>
                                <li class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-bes-sage/10 border border-bes-sage/20 flex items-center justify-center flex-shrink-0">
                                        <i class="<?php echo esc_attr($out['icon']); ?> text-bes-sage text-[11px]" aria-hidden="true"></i>
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

    <section class="bg-bes-cream py-20 md:py-24" aria-label="Why 50H Hybrid is advantageous">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Why This Format Works</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-3xl mx-auto">
                    Accessible. Affordable. Authentic.
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $usps = [
                    ['icon' => 'fa-solid fa-clock-rotate-left', 'title' => 'Self-Paced Learning', 'body' => 'No rush. Access the Learning Management System (LMS) anytime, anywhere, and replay modules until you fully grasp the concepts.'],
                    ['icon' => 'fa-solid fa-wallet', 'title' => 'Highly Accessible', 'body' => 'Significantly more affordable and less time-consuming than a full in-person training, making traditional yoga wisdom accessible to everyone.'],
                    ['icon' => 'fa-solid fa-om', 'title' => 'Genuine Immersion', 'body' => 'We don\'t sacrifice the spiritual essence. You still get a powerful 4-day physical immersion to correct alignment and experience deep rituals.'],
                ];
                foreach ($usps as $usp) : ?>
                    <div class="bes-reveal group flex flex-col items-center text-center gap-4 p-8 rounded-2xl border border-bes-sand hover:border-bes-sage/30 hover:bg-white transition-all duration-400">
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

    <section id="bes-curriculum-50h" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="50H Two Phase Curriculum">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.04),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-sage mb-4">Step-by-Step</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">The 50H Structure</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

                <div class="bes-reveal relative p-8 md:p-10 rounded-3xl border border-white/10" style="background:rgba(255,255,255,0.03)">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-bes-sage/10 rounded-bl-full blur-2xl"></div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-xl bg-bes-sage/20 border border-bes-sage/30 flex items-center justify-center">
                            <i class="fa-solid fa-laptop text-bes-sage text-lg"></i>
                        </div>
                        <div>
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-sage/70">Phase 1 (Self-Paced)</p>
                            <h3 class="font-display font-medium text-white text-2xl">Online LMS Theory</h3>
                        </div>
                    </div>
                    <p class="font-body font-light text-white/60 text-[14px] leading-relaxed mb-6">
                        Build your mental framework before stepping onto the mat in Bali. Engage with high-quality videos, modules, and personal reflections.
                    </p>
                    <ul class="space-y-4 border-t border-white/10 pt-6">
                        <?php
                        $online = [
                            'The History of Yoga',
                            'Foundational Yoga Philosophy',
                            'Pranayama & The Subtle Body',
                            'Mantra Internalization',
                            'Yoga Ethics & Modern Lifestyle'
                        ];
                        foreach ($online as $item) : ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-play text-bes-sage/60 text-[10px] mt-1.5"></i>
                                <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bes-reveal relative p-8 md:p-10 rounded-3xl border border-bes-moss/30" style="background:linear-gradient(145deg,rgba(118,138,107,0.1),transparent)">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-bes-moss/10 rounded-bl-full blur-2xl"></div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-xl bg-bes-moss/20 border border-bes-moss/30 flex items-center justify-center">
                            <i class="fa-solid fa-leaf text-bes-moss text-lg"></i>
                        </div>
                        <div>
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss/70">Phase 2 (4 Days, 3 Nights)</p>
                            <h3 class="font-display font-medium text-white text-2xl">Bali Weekend Retreat</h3>
                        </div>
                    </div>
                    <p class="font-body font-light text-white/60 text-[14px] leading-relaxed mb-6">
                        Join us for a focused, rejuvenating long weekend in Bali. We translate your online theory directly into physical practice and inner connection.
                    </p>
                    <ul class="space-y-4 border-t border-white/10 pt-6">
                        <?php
                        $offline = [
                            'Live Asana, Pranayama & Meditation Practice',
                            'Posture Alignment & Safe Adjustments',
                            'Basic Sequencing Practice',
                            'Deep Spiritual Experience & Excursion',
                            'Yin Yoga & Restorative Sound Healing',
                            'Community Connection & Self Reflection'
                        ];
                        foreach ($offline as $item) : ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-spa text-bes-moss/80 text-[10px] mt-1.5"></i>
                                <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-bes-ivory py-20 md:py-24" aria-label="Lead Instructor Profile">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-4 flex justify-center">
                    <div class="relative w-full max-w-sm aspect-[4/5] rounded-t-full border-4 border-bes-sand overflow-hidden flex flex-col items-center justify-end pb-8" style="background:linear-gradient(to top, #e8e3d8, #fdfcfa)">
                         <?php echo wp_get_attachment_image(1345, 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover z-0']); ?>
                         <div class="text-center z-10 bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-bes-sand">
                             <p class="font-display font-medium text-bes-bark text-xl">Sri Bhagawan</p>
                             <p class="font-display font-light text-bes-bark-muted text-sm">Sriprada Bhaskara</p>
                             </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Guiding Your Transformation</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Yoga as a Way of Life
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed mb-8">
                        Guided by <strong>Sri Bhagawan Sriprada Bhaskara</strong> and the experienced Yogis at Bali Eling Spirit, this program teaches yoga not just as physical exercise, but as a comprehensive way of living. We blend modern learning systems with ancient wisdom, ensuring the teachings are relevant to your modern lifestyle while retaining their deep spiritual roots.
                    </p>

                    <div class="bes-reveal bg-bes-forest/[.03] border border-bes-forest/[.06] p-5 rounded-xl flex items-center gap-4">
                        <i class="fa-solid fa-users text-bes-olive text-xl"></i>
                        <p class="font-body font-medium text-bes-bark-muted text-[13px] leading-relaxed">
                            <strong>Trusted by Hundreds:</strong> Join a thriving community of alumni who have successfully transformed their lives through the Bali Eling Spirit methodology.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="bes-50h-investment" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="50H Hybrid Pricing">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative max-w-5xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-sage mb-4">Begin Your Journey</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Program Investment</h2>
            </div>

            <div class="bes-reveal relative rounded-3xl border border-bes-sage/30 bg-black/30 backdrop-blur-md overflow-hidden shadow-2xl">
                <div class="h-[4px] bg-gradient-to-r from-bes-forest via-bes-sage to-bes-forest"></div>

                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-2 p-10 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center items-center text-center bg-white/[0.02]">
                        <h3 class="font-display font-light text-white/70 text-xl mb-2">50H Hybrid</h3>
                        <p class="font-display text-white text-4xl md:text-5xl font-medium mb-4">Rp 4.999.000</p>
                        <p class="font-body text-white/40 text-[13px] mb-8 leading-relaxed">
                            An incredibly accessible, high-value program with dual learning systems.
                        </p>

                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                            class="w-full inline-flex justify-center items-center gap-2.5 bg-bes-sage text-bes-forest-deep font-body font-bold text-[12px] uppercase tracking-label px-8 py-4 rounded-xl hover:bg-white transition-all duration-300">
                            Enroll in 50H
                        </a>
                    </div>

                    <div class="md:col-span-3 p-10 md:p-12">
                        <h4 class="font-body font-bold text-[11px] uppercase tracking-nav text-white/50 mb-6">All-Inclusive Package:</h4>
                        <ul class="space-y-4">
                            <?php
                            $inclusions = [
                                'Full Access to the Online LMS Platform (Replayable)',
                                '4 Days, 3 Nights In-Person Training Experience in Bali',
                                'Healthy Vegetarian Meals during the offline in-person training',
                                'Official YTT 50-Hour Certificate upon completion',
                                'Guided Excursions, Yin Yoga & Sound Healing',
                                'Lifelong Networking in the Global Eling Community'
                            ];
                            foreach ($inclusions as $inc) : ?>
                                <li class="flex items-center gap-3">
                                    <div class="w-5 h-5 rounded-full border border-bes-sage/40 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check text-bes-sage text-[9px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($inc); ?></span>
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
                    Start Your Yoga Journey
                </h2>
                <h3 class="font-display font-light italic text-bes-moss text-3xl md:text-4xl tracking-display mb-6">
                    with Total Flexibility.
                </h3>
                <p class="font-body font-light text-bes-bark-muted text-base mb-10 leading-relaxed">
                    Learn at your own pace, experience the magic of Bali, and transform your life without putting your career on hold.
                </p>

                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-bes-sage text-bes-forest font-body font-bold text-[12px] uppercase tracking-label px-10 py-5 rounded-2xl hover:bg-bes-leaf hover:!text-white hover:shadow-xl transition-all duration-300">
                    Join YTT 50H Hybrid Now
                </a>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}