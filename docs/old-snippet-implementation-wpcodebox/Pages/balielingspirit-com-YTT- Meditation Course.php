<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_meditation_course] Shortcode
 * ============================================================================
 *
 * Registers [bes_meditation_course] for the 3-Stage Meditation Journey page.
 * Features a sharp, anti-shadow, "euphoria" UI with premium English copy.
 *
 * UNIQUE SECTIONS:
 * 0  Hero — High-impact hook, "Quiet the Noise"
 * 1  The Reality Check — Why meditation matters now
 * 2  The 3-Stage Journey — Overview of Foundation, Deepening, Transformation
 * 3  Curriculum Deep Dive — 3-column sharp syllabus breakdown
 * 4  Guides & Impact — Instructors and anti-shadow testimonials
 * 5  Your Investment — 3-column flat-design pricing grid
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_meditation_course', 'bes_render_meditation_course');

function bes_render_meditation_course($atts)
{
    ob_start();
?>

    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-med-heading">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_60%)] mix-blend-screen"></div>
            <div class="absolute bottom-0 right-0 w-[700px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)] mix-blend-screen"></div>
            <div class="absolute inset-0 opacity-[0.02]" style="background-image:radial-gradient(rgba(255,255,255,.8) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 z-10">
            <div class="bes-reveal mb-3 inline-flex items-center gap-2.5 bg-transparent border border-bes-leaf/30 rounded-full px-5 py-2">
                <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf animate-pulse"></span>
                <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf">In-Person Offline Journey</span>
            </div>

            <div class="bes-reveal mb-8 inline-flex items-center gap-2 bg-bes-gold/[.08] border border-bes-gold/[.22] rounded-full px-4 py-1.5">
                <i class="fa-solid fa-language text-bes-gold text-[11px]" aria-hidden="true"></i>
                <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-gold/85">Taught in Bahasa Indonesia</span>
            </div>

            <h1 id="bes-med-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[6.5rem] tracking-display leading-none mb-6">
                Quiet the Noise.<br>
                <em class="font-light italic text-bes-leaf">Master Your Mind.</em>
            </h1>

            <p class="bes-reveal font-body font-light text-white/60 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                A progressive, three-stage meditation journey. Whether you are battling a restless mind, seeking deeper focus, or ready for profound emotional healing, this is your structured path to inner stillness.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#bes-med-pricing"
                    class="inline-flex items-center justify-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl border border-bes-leaf hover:bg-transparent hover:!text-bes-leaf transition-all duration-300 w-full sm:w-auto group">
                    <i class="fa-solid fa-seedling text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Start Your Journey
                </a>
                <a href="#bes-med-stages"
                    class="inline-flex items-center justify-center gap-2.5 bg-transparent border border-white/10 !text-white/70 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:border-white/30 hover:!text-white transition-all duration-300 w-full sm:w-auto">
                    Explore The 3 Stages
                </a>
            </div>
        </div>

        <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
    </section>


    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="bes-reveal space-y-6">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-2">The Reality Check</p>
                    <h2 class="font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight">
                        You can't stop your thoughts, but you can change where you stand.
                    </h2>
                    <p class="font-body font-light text-bes-bark-muted text-[14.5px] leading-relaxed">
                        Most people fail at meditation because they try to force their minds to go blank. That's not how the brain works. Whether you're a beginner battling overthinking, or a practitioner hitting a plateau, you need a method—not just a cushion to sit on.
                    </p>

                    <ul class="space-y-4 pt-5 border-t border-bes-sand/60">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-arrow-right text-bes-moss text-[10px] mt-1.5" aria-hidden="true"></i>
                            <span class="font-body font-light text-bes-bark-muted text-[13.5px]">Your mind is constantly racing, making it impossible to focus or sleep.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-arrow-right text-bes-moss text-[10px] mt-1.5" aria-hidden="true"></i>
                            <span class="font-body font-light text-bes-bark-muted text-[13.5px]">You've tried meditating, but you just can't seem to make it a consistent habit.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-arrow-right text-bes-moss text-[10px] mt-1.5" aria-hidden="true"></i>
                            <span class="font-body font-light text-bes-bark-muted text-[13.5px]">You're craving a deeper sense of meaning, emotional healing, and genuine presence.</span>
                        </li>
                    </ul>
                </div>

                <div class="bes-reveal grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-6 rounded-2xl border border-bes-sand bg-transparent hover:border-bes-moss/40 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-10 h-10 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.08] flex items-center justify-center mb-4">
                            <i class="fa-solid fa-brain text-bes-olive text-sm" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-lg mb-2">Neuroscience Meets Spirit</h3>
                        <p class="font-body font-light text-bes-bark-muted text-[12.5px] leading-relaxed">We combine ancient Balinese spiritual wisdom with a modern, scientific understanding of the brain.</p>
                    </div>
                    <div class="p-6 rounded-2xl border border-bes-sand bg-transparent hover:border-bes-moss/40 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-10 h-10 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.08] flex items-center justify-center mb-4">
                            <i class="fa-solid fa-stairs text-bes-olive text-sm" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-lg mb-2">Structured Progression</h3>
                        <p class="font-body font-light text-bes-bark-muted text-[12.5px] leading-relaxed">No guesswork. A clear, three-stage path from complete beginner to advanced transformational practice.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="bes-med-stages" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">

            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">The Pathway</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Your Journey, Stage by Stage</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $stages = [
                    [
                        'num' => '01',
                        'title' => 'Foundation',
                        'subtitle' => 'For Beginners & Stressed Professionals',
                        'goal' => 'Build the habit. Stop overthinking. Start here.',
                        'color' => 'border-bes-sage/30 hover:border-bes-sage/70',
                        'text' => 'text-bes-sage'
                    ],
                    [
                        'num' => '02',
                        'title' => 'Deepening',
                        'subtitle' => 'For Foundation Alumni & Practitioners',
                        'goal' => 'Move beyond the basics. Access profound focus.',
                        'color' => 'border-bes-moss/30 hover:border-bes-moss/70',
                        'text' => 'text-bes-moss'
                    ],
                    [
                        'num' => '03',
                        'title' => 'Transformation',
                        'subtitle' => 'For Advanced Seekers',
                        'goal' => 'Real emotional healing. Integrate it into your life.',
                        'color' => 'border-bes-gold/30 hover:border-bes-gold/70',
                        'text' => 'text-bes-gold'
                    ],
                ];
                foreach ($stages as $st) : ?>
                    <div class="bes-reveal group p-8 rounded-2xl border <?php echo esc_attr($st['color']); ?> bg-transparent transition-all duration-400 flex flex-col relative overflow-hidden">
                        <span class="absolute top-4 right-6 font-display font-light text-white/5 text-7xl group-hover:!text-white/10 transition-colors pointer-events-none"><?php echo esc_html($st['num']); ?></span>

                        <p class="font-body font-bold text-[9px] uppercase tracking-nav <?php echo esc_attr($st['text']); ?> mb-3">Stage <?php echo esc_html($st['num']); ?></p>
                        <h3 class="font-display font-medium text-white text-2xl md:text-3xl mb-1"><?php echo esc_html($st['title']); ?></h3>
                        <p class="font-body font-light text-white/40 text-[11px] uppercase tracking-wide mb-6"><?php echo esc_html($st['subtitle']); ?></p>

                        <p class="font-body font-light text-white/70 text-[14px] leading-relaxed mt-auto border-t border-white/10 pt-5">
                            "<?php echo esc_html($st['goal']); ?>"
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <section class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Curriculum</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">What You Will Learn</h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted mt-4 text-[14px]">Each stage is an intensive 2-Day (10 Hour) offline workshop.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bes-reveal border border-bes-sand rounded-2xl p-6 md:p-8 bg-transparent">
                    <h3 class="font-display font-medium text-bes-bark text-2xl mb-4">Stage 1: Foundation</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-sage mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">The Science of Stillness</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Definitions, philosophy, and the neuroscience behind the power of the mind.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-sage mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">The Mechanics</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Mastering posture (Asana) and breath control (Pranayama) as the gateway to meditation.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-sage mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">Active Practice</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Grounding techniques, guided breath meditation, and body-awareness exercises.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bes-reveal border border-bes-sand rounded-2xl p-6 md:p-8 bg-transparent">
                    <h3 class="font-display font-medium text-bes-bark text-2xl mb-4">Stage 2: Deepening</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-moss mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">Dharana & Dhyana</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Transitioning from active concentration into a true, effortless meditative state.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-moss mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">The Layers of Self</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Understanding the physical vs. subtle body (Stula & Suksma Sarira) and Inner Awareness.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-moss mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">Advanced Techniques</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Exploring mantra, visualization, and deep self-awareness meditation.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bes-reveal border border-bes-sand rounded-2xl p-6 md:p-8 bg-transparent">
                    <h3 class="font-display font-medium text-bes-bark text-2xl mb-4">Stage 3: Integration</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">Emotional Healing</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Using deep meditation for self-healing, releasing trauma, and energy body awareness.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">The Concept of Samadhi</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">Touching the edges of ultimate consciousness and profound inner stillness.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-bes-gold mt-1.5 flex-shrink-0"></span>
                            <div>
                                <h4 class="font-body font-semibold text-bes-bark text-[13px]">Life Integration</h4>
                                <p class="font-body font-light text-bes-bark-muted text-[12px]">How to bring this profound state of peace into your daily work, relationships, and life.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="bg-bes-ivory py-20 md:py-28 border-t border-bes-sand/40">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

                <div class="bes-reveal">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Your Guides</p>
                    <h2 class="font-display font-medium text-bes-bark text-3xl md:text-4xl tracking-display mb-6">Guided by True Practitioners</h2>
                    <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-8">
                        The entire journey is guided by the core Yogi team at Bali Eling Spirit. Our approach is intensely practical, experiential, and deeply grounded. We bridge the gap between ancient spiritual concepts and modern scientific understanding, ensuring your practice is both authentic and highly effective.
                    </p>
                    <div class="inline-flex items-center gap-3 border border-bes-leaf/30 rounded-full px-5 py-2.5">
                        <i class="fa-solid fa-users text-bes-leaf text-sm"></i>
                        <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-bark">Includes Exclusive Community Access</span>
                    </div>
                </div>

                <div class="bes-reveal">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Impact</p>
                    <h2 class="font-display font-medium text-bes-bark text-3xl md:text-4xl tracking-display mb-8">Words from the Journey</h2>

                    <div class="space-y-4">
                        <blockquote class="p-6 rounded-xl bg-transparent border border-bes-sand/80">
                            <p class="font-body font-light italic text-bes-bark-muted text-[13.5px] leading-relaxed mb-4">
                                "I used to think my brain was just too busy to meditate. Stage 1 completely changed my framework. I finally understand the mechanics, and my sleep has improved dramatically."
                            </p>
                            <cite class="not-italic font-body font-bold text-[10px] uppercase tracking-label text-bes-bark/80 flex items-center gap-2">
                                <span class="w-4 h-px bg-bes-leaf"></span> Stage 1 Alumni
                            </cite>
                        </blockquote>
                        <blockquote class="p-6 rounded-xl bg-transparent border border-bes-sand/80">
                            <p class="font-body font-light italic text-bes-bark-muted text-[13.5px] leading-relaxed mb-4">
                                "Moving into Stage 3 was a deeply emotional experience. It wasn't just about focusing anymore; it was about genuine healing. Truly transformative."
                            </p>
                            <cite class="not-italic font-body font-bold text-[10px] uppercase tracking-label text-bes-bark/80 flex items-center gap-2">
                                <span class="w-4 h-px bg-bes-leaf"></span> Advanced Practitioner
                            </cite>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="bes-med-pricing" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[800px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.06),transparent_60%)] mix-blend-screen"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10 z-10">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">Commit to Your Growth</h2>
                <p class="bes-reveal font-body font-light text-white/50 text-[14px] leading-relaxed">
                    Select your entry point. Note that completing Stage 1 is highly recommended before advancing to the deeper stages.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bes-reveal bg-transparent border border-bes-sage/40 hover:border-bes-sage rounded-2xl p-8 relative group transition-colors duration-500 flex flex-col">
                    <p class="font-body font-bold text-[11px] uppercase tracking-nav text-bes-sage mb-2">Stage 1</p>
                    <h3 class="font-display font-medium text-white text-2xl mb-6">Foundation</h3>

                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="font-body font-medium text-white/60 text-sm">Rp</span>
                        <span class="font-display font-medium text-white text-4xl tracking-tight">2.199.999</span>
                    </div>

                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-regular fa-clock text-bes-sage/50"></i> 2 Days (10 Hours) Offline</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-book-open text-bes-sage/50"></i> Theory & Active Practice</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-users text-bes-sage/50"></i> Beginner Friendly</li>
                    </ul>

                    <a href="https://wa.me/6281228888873?text=Hi,%20I%20want%20to%20register%20for%20Meditation%20Stage%201" target="_blank" rel="noopener noreferrer"
                        class="block w-full text-center bg-transparent text-bes-sage font-body font-bold text-[11px] !text-white/70 uppercase tracking-label py-3.5 rounded-xl border border-bes-sage hover:bg-bes-sage hover:!text-bes-forest transition-all duration-300">
                        Begin Here
                    </a>
                </div>

                <div class="bes-reveal bg-transparent border-2 border-bes-moss/60 hover:border-bes-moss rounded-2xl p-8 relative group transition-colors duration-500 flex flex-col">
                    <div class="absolute inset-0 bg-bes-moss/5 blur-xl -z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <p class="font-body font-bold text-[11px] uppercase tracking-nav text-bes-moss mb-2">Stage 2</p>
                    <h3 class="font-display font-medium text-white text-2xl mb-6">Deepening</h3>

                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="font-body font-medium text-white/60 text-sm">Rp</span>
                        <span class="font-display font-medium text-white text-4xl tracking-tight">2.399.000</span>
                    </div>

                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-regular fa-clock text-bes-moss/50"></i> 2 Days (10 Hours) Offline</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-om text-bes-moss/50"></i> Dharana & Dhyana Practice</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-arrow-up-right-dots text-bes-moss/50"></i> Intermediate Level</li>
                    </ul>

                    <a href="https://wa.me/6281228888873?text=Hi,%20I%20want%20to%20register%20for%20Meditation%20Stage%202" target="_blank" rel="noopener noreferrer"
                        class="block w-full text-center bg-bes-moss text-bes-forest font-body font-bold text-[11px] uppercase tracking-label py-3.5 rounded-xl border border-bes-moss hover:bg-transparent hover:!text-bes-moss transition-all !text-white/70 duration-300">
                        Deepen Practice
                    </a>
                </div>

                <div class="bes-reveal bg-transparent border border-bes-gold/40 hover:border-bes-gold rounded-2xl p-8 relative group transition-colors duration-500 flex flex-col">
                    <p class="font-body font-bold text-[11px] uppercase tracking-nav text-bes-gold mb-2">Stage 3</p>
                    <h3 class="font-display font-medium text-white text-2xl mb-6">Transformation</h3>

                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="font-body font-medium text-white/60 text-sm">Rp</span>
                        <span class="font-display font-medium text-white text-4xl tracking-tight">2.599.000</span>
                    </div>

                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-regular fa-clock text-bes-gold/50"></i> 2 Days (10 Hours) Offline</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-heart-pulse text-bes-gold/50"></i> Deep Emotional Healing</li>
                        <li class="flex items-center gap-2 font-body font-light text-white/60 text-[12px]"><i class="fa-solid fa-fire-flame-curved text-bes-gold/50"></i> Advanced Integration</li>
                    </ul>

                    <a href="https://wa.me/6281228888873?text=Hi,%20I%20want%20to%20register%20for%20Meditation%20Stage%203" target="_blank" rel="noopener noreferrer"
                        class="block w-full text-center bg-transparent text-bes-gold font-body font-bold text-[11px] !text-white/70 uppercase tracking-label py-3.5 rounded-xl border border-bes-gold hover:bg-bes-gold hover:!text-bes-forest transition-all duration-300">
                        Experience Shift
                    </a>
                </div>

            </div>

            <div class="bes-reveal mt-10 max-w-4xl mx-auto bg-transparent border-2 border-white/20 hover:border-white/40 rounded-3xl p-8 md:p-12 relative overflow-hidden transition-all duration-500 flex flex-col md:flex-row items-center justify-between gap-8 group">
                <div class="absolute inset-0 bg-white/5 blur-xl -z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <div class="text-center md:text-left">
                    <p class="font-body font-bold text-[11px] uppercase tracking-nav text-white/60 mb-2">Complete Journey</p>
                    <h3 class="font-display font-medium text-white text-3xl mb-4">Stage 1-3 Bundle</h3>
                    <div class="flex items-center gap-6 justify-center md:justify-start font-body font-light text-white/70 text-[13px]">
                        <span class="flex items-center gap-2"><i class="fa-regular fa-clock text-white/40"></i> 6 Days Total</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-infinity text-white/40"></i> Full Transformation</span>
                    </div>
                </div>

                <<div class="text-center md:text-right">
                    <div class="flex items-baseline justify-center md:justify-end gap-1 mb-4">
                        <span class="font-body font-medium text-white/60 text-base">Rp</span>
                        <span class="font-display font-medium text-white text-5xl tracking-tight">5.999.000</span>
                    </div>
                    <a href="https://wa.me/6281228888873?text=Hi,%20I%20want%20to%20register%20for%20Meditation%20Stage%201-3%20Bundle" target="_blank" rel="noopener noreferrer"
                        class="inline-block bg-white text-bes-forest-deep font-body font-bold text-[12px] uppercase tracking-label px-10 py-4 rounded-xl border border-white hover:bg-transparent hover:!text-white transition-all duration-300">
                        Commit Fully
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}