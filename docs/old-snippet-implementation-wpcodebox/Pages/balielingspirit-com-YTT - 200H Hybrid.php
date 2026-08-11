<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_ytt_200h_hybrid_landing] Shortcode
 * ============================================================================
 *
 * Registers [bes_ytt_200h_hybrid_landing] specifically for the Hybrid Page.
 * 100% aligned with BES v3 design system:
 * - Tailwind BES color tokens, font-display, font-body
 * - tracking-nav / tracking-label / tracking-display
 * - bes-reveal entrance animations, bes-fret dividers
 *
 * UNIQUE SECTIONS (7 total):
 * 0  Cinematic Hero — Hybrid focus, triple-accreditation badges
 * 1  Who Is This For? — Busy Professionals, Pain Points & Dream Outcomes
 * 2  The Hybrid Advantage — Flexibility meets traditional immersion
 * 3  The 2-Phase Curriculum — Online LMS (Theory) + 12-Day Offline (Practice)
 * 4  Lead Instructor — Profile of Sri Bhagawan Sriprada Bhaskara
 * 5  Investment & Bonuses — Rp 15.000.000 Hybrid + 10H Sound Healing Bonus
 * 6  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_ytt_200h_hybrid_landing', 'bes_render_ytt_200h_hybrid');

function bes_render_ytt_200h_hybrid($atts)
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
                    <em>The Modern Path to Ancient Wisdom</em>
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50">
                    Online Theory. Offline Transformation.
                </p>
            </div>

            <div class="bes-reveal flex justify-center mb-6">
                <div class="inline-flex items-center gap-2 bg-bes-gold/[.08] border border-bes-gold/[.22] rounded-full px-4 py-1.5">
                    <i class="fa-solid fa-language text-bes-gold text-[11px]" aria-hidden="true"></i>
                    <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-gold/85">Taught in Bahasa Indonesia</span>
                </div>
            </div>

            <div class="bes-reveal flex flex-wrap items-center justify-center gap-3 mb-10">
                <?php
                $accs = [
                    ['icon' => 'fa-solid fa-certificate', 'name' => 'Yoga Alliance USA',          'short' => 'RYS 200 Registered'],
                    ['icon' => 'fa-solid fa-globe',       'name' => 'World Yoga Federation',       'short' => 'WYF Accredited'],
                    ['icon' => 'fa-solid fa-medal',       'name' => 'Yoga Alliance International', 'short' => 'YAI India'],
                ];
                foreach ($accs as $acc) : ?>
                    <div class="inline-flex items-center gap-2 bg-bes-leaf/[.06] border border-bes-leaf/[.14] rounded-full px-4 py-2">
                        <i class="<?php echo esc_attr($acc['icon']); ?> text-bes-leaf text-[10px]" aria-hidden="true"></i>
                        <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/70"><?php echo esc_html($acc['short']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <h1 id="bes-ytt-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-4">
                200H Hybrid YTT
            </h1>
            <h2 class="bes-reveal font-display font-light text-bes-leaf text-4xl md:text-5xl lg:text-[4rem] tracking-display leading-none mb-8 italic">
                Flexible Learning. Maximum Impact.
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                Designed for busy professionals and dedicated practitioners. Master the theory at your own pace online, then join us in Bali for a powerful 12-day intensive immersion.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="#bes-curriculum-hybrid"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                    <i class="fa-solid fa-laptop-code text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    See How It Works
                </a>
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-white/[.04] border border-white/[.08] text-white/65 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.07] hover:!text-white transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i>
                    Consult via WhatsApp
                </a>
            </div>
            <div class="bes-reveal h-[1px] w-48 mx-auto bg-gradient-to-r from-transparent via-bes-leaf/40 to-transparent"></div>
        </div>
        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>

    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Is the Hybrid program for you">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Challenge</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        You want the certification, but can't leave life behind for a month.
                    </h2>
                    
                    <div class="space-y-4">
                        <?php
                        $pains = [
                            "You are a professional or entrepreneur who cannot step away from work for 25 full days.",
                            "You want to be a certified yoga teacher, but you need realistic flexibility.",
                            "You are traveling from abroad or out of town and need to minimize your time & expenses in Bali.",
                            "You've tried self-learning, but without a system and physical immersion, it feels incomplete."
                        ];
                        foreach ($pains as $pain) : ?>
                            <div class="bes-reveal flex items-start gap-4 p-4 rounded-xl border border-bes-sand/50 bg-white/40">
                                <i class="fa-solid fa-clock text-bes-olive mt-1 text-sm" aria-hidden="true"></i>
                                <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($pain); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bes-reveal relative rounded-3xl border border-bes-moss/20 overflow-hidden" style="background:linear-gradient(145deg,rgba(44,54,43,.9),rgba(25,31,24,1))">
                    <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-moss to-transparent"></div>
                    <div class="p-10 md:p-12">
                        <h3 class="font-display font-light italic text-bes-gold text-3xl mb-8">The Perfect Balance</h3>
                        <ul class="space-y-6">
                            <?php
                            $outcomes = [
                                ['icon' => 'fa-solid fa-certificate', 'text' => 'Earn the exact same globally recognized 200H Certification.'],
                                ['icon' => 'fa-solid fa-laptop-house', 'text' => 'Study the heavy theory at your own pace, fitting it around your career.'],
                                   ['icon' => 'fa-solid fa-plane-arrival', 'text' => 'Only 12 days required in Bali for the intensive physical and spiritual in-person training.'],
                                ['icon' => 'fa-solid fa-scale-balanced', 'text' => 'Maintain perfect balance between your modern professional life and your spiritual journey.'],
                            ];
                            foreach ($outcomes as $out) : ?>
                                <li class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-bes-moss/20 border border-bes-moss/30 flex items-center justify-center flex-shrink-0">
                                        <i class="<?php echo esc_attr($out['icon']); ?> text-bes-moss text-[11px]" aria-hidden="true"></i>
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

    <section class="bg-bes-cream py-20 md:py-24" aria-label="Why Hybrid is advantageous">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Smart Learning</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-3xl mx-auto">
                    The Best of Both Worlds
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $usps = [
                    ['icon' => 'fa-solid fa-repeat', 'title' => 'Replayable Theory', 'body' => 'Philosophy and Anatomy require focus. Our LMS lets you rewind, review, and absorb complex concepts on your schedule.'],
                    ['icon' => 'fa-solid fa-piggy-bank', 'title' => 'Cost & Time Efficient', 'body' => 'Reduce your accommodation and travel expenses by compressing the in-person requirement to just 12 days in Bali.'],
                    ['icon' => 'fa-solid fa-spa', 'title' => 'Uncompromised Depth', 'body' => 'You still receive the authentic Bali Hatha Yoga approach, the deep spiritual rituals, and the rigorous teaching exams.'],
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

    <section id="bes-curriculum-hybrid" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Two Phase Curriculum">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-0 bottom-0 w-[600px] h-[400px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">How It Works</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">The Hybrid Structure</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                <div class="bes-reveal relative p-8 md:p-10 rounded-3xl border border-white/10" style="background:rgba(255,255,255,0.03)">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-bes-leaf/10 rounded-bl-full blur-2xl"></div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-xl bg-bes-leaf/20 border border-bes-leaf/30 flex items-center justify-center">
                            <i class="fa-solid fa-laptop text-bes-leaf text-lg"></i>
                        </div>
                        <div>
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf/70">Phase 1 (Self-Paced)</p>
                            <h3 class="font-display font-medium text-white text-2xl">Online LMS Immersion</h3>
                        </div>
                    </div>
                    <p class="font-body font-light text-white/60 text-[14px] leading-relaxed mb-6">
                        Complete this before arriving in Bali. Access high-quality videos, modules, and evaluations. Study anywhere, anytime.
                    </p>
                    <ul class="space-y-4 border-t border-white/10 pt-6">
                        <?php
                        $online = [
                            'Yoga Philosophy (Sutras, Gita, Dharmic Concepts)',
                            'Anatomy & Physiology (Biomechanics & Systems)',
                            'Basic Teaching Methodology',
                            'Introduction to Sequencing',
                            'Mantra Internalization & Chanting',
                            'Yoga Ethics & Modern Lifestyle Integration'
                        ];
                        foreach ($online as $item) : ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-play text-bes-leaf/60 text-[10px] mt-1.5"></i>
                                <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bes-reveal relative p-8 md:p-10 rounded-3xl border border-bes-gold/20" style="background:linear-gradient(145deg,rgba(201,168,76,0.1),transparent)">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-bes-gold/10 rounded-bl-full blur-2xl"></div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-xl bg-bes-gold/20 border border-bes-gold/30 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-bes-gold text-lg"></i>
                        </div>
                        <div>
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/70">Phase 2 (12 Days)</p>
                            <h3 class="font-display font-medium text-white text-2xl">Bali Intensive In-Person Training</h3>
                        </div>
                    </div>
                    <p class="font-body font-light text-white/60 text-[14px] leading-relaxed mb-6">
                        Arrive in Bali prepared. We skip the basic theory lectures and immediately dive into deep physical practice, teaching labs, and spiritual work.
                    </p>
                    <ul class="space-y-4 border-t border-white/10 pt-6">
                        <?php
                        $offline = [
                            'Advanced Asana Practice & Alignment',
                            'Adjustment & Hands-On Teaching Techniques',
                            'Teaching Practicum (Peer & Real Class Experience)',
                            'Pranayama, Meditation & Inner Work',
                            'Spiritual Rituals & Cultural Excursion',
                            'Professional Essentials, Final Assessment & Graduation'
                        ];
                        foreach ($offline as $item) : ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-fire text-bes-gold/80 text-[10px] mt-1.5"></i>
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
                        Bridging Technology & Ancient Wisdom
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed mb-8">
                        The Hybrid program is meticulously designed by <strong>Sri Bhagawan Sriprada Bhaskara</strong> and the Bali Eling Spirit team. We seamlessly integrate modern LMS technology with the irreplaceable power of in-person spiritual transmission, ensuring you become a deeply authentic, well-rounded teacher.
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bes-reveal flex items-center gap-3 p-4 rounded-xl bg-bes-forest/[.03] border border-bes-forest/[.06]">
                            <i class="fa-solid fa-graduation-cap text-bes-olive text-sm"></i>
                            <span class="font-body font-medium text-bes-bark-muted text-[13px]">Yoga Alliance International Standard</span>
                        </div>
                        <div class="bes-reveal flex items-center gap-3 p-4 rounded-xl bg-bes-forest/[.03] border border-bes-forest/[.06]">
                            <i class="fa-solid fa-yin-yang text-bes-olive text-sm"></i>
                            <span class="font-body font-medium text-bes-bark-muted text-[13px]">Holistic & Spiritual-Based Approach</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="bes-hybrid-investment" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Hybrid Pricing">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative max-w-5xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">A High-Value Pathway</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Program Investment</h2>
            </div>

            <div class="bes-reveal relative rounded-3xl border border-white/20 bg-black/30 backdrop-blur-md overflow-hidden shadow-2xl">
                <div class="h-[4px] bg-gradient-to-r from-bes-moss via-bes-leaf to-bes-moss"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-2 p-10 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center items-center text-center bg-white/[0.02]">
                        <h3 class="font-display font-light text-white/70 text-xl mb-2">Hybrid 200H</h3>
                        <p class="font-display text-white text-4xl md:text-5xl font-medium mb-4">Rp 14.999.000</p>
                        <p class="font-body text-white/40 text-[13px] mb-8 leading-relaxed">
                            A highly efficient investment, saving you weeks of accommodation costs while maintaining premium standards.
                        </p>
                        
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                            class="w-full inline-flex justify-center items-center gap-2.5 bg-white text-bes-forest-deep font-body font-bold text-[12px] uppercase tracking-label px-8 py-4 rounded-xl hover:bg-bes-leaf transition-all duration-300">
                            Enroll in Hybrid
                        </a>
                    </div>

                    <div class="md:col-span-3 p-10 md:p-12">
                        <h4 class="font-body font-bold text-[11px] uppercase tracking-nav text-white/50 mb-6">Everything Included:</h4>
                        <ul class="space-y-4 mb-8">
                            <?php
                            $inclusions = [
                                'Lifetime Access to the Online LMS Platform',
                                'International 200H Certificate upon graduation',
                                '12-Day Intensive In-Person Training Experience in Bali',
                                'Healthy Vegetarian Meals during offline training',
                                'Comprehensive Modules & Teaching Toolkit',
                                'Access to Eling Academy Global Alumni Community'
                            ];
                            foreach ($inclusions as $inc) : ?>
                                <li class="flex items-center gap-3">
                                    <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check text-white/70 text-[9px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($inc); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="bg-bes-leaf/10 border border-bes-leaf/20 rounded-xl p-4 flex items-center gap-4">
                            <i class="fa-solid fa-gift text-bes-leaf text-2xl"></i>
                            <div>
                                <p class="font-body font-bold text-bes-leaf text-[10px] uppercase tracking-nav">Bonus Gift</p>
                                <p class="font-body text-white/90 text-sm">Free Access to our <strong>10-Hour Sound Healing Course</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bg-bes-parchment py-20 md:py-24" aria-label="Final Call to Action">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10 text-center">
            <div class="bes-reveal max-w-3xl mx-auto">
                <h2 class="font-display font-medium text-bes-bark text-4xl md:text-5xl lg:text-6xl tracking-display mb-4">
                    Become a Certified Yoga Teacher
                </h2>
                <h3 class="font-display font-light italic text-bes-moss text-3xl md:text-4xl tracking-display mb-6">
                    with Flexible Learning.
                </h3>
                <p class="font-body font-light text-bes-bark-muted text-base mb-10 leading-relaxed">
                    Start your 200H journey today. Build your foundation online, and finalize your transformation in Bali.
                </p>

                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-white font-body font-bold text-[12px] uppercase tracking-label px-10 py-5 rounded-2xl hover:bg-bes-forest hover:shadow-xl transition-all duration-300">
                    Start Your Hybrid Journey
                </a>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}