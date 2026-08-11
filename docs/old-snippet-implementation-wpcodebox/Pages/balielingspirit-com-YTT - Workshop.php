<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_online_workshop] Shortcode
 * ============================================================================
 *
 * Registers [bes_online_workshop] for the short online workshop page.
 * 100% aligned with BES v3 design system.
 * Anti-dropshadow, sharp UI, "euphoria" glowing accents, English persuasive copy.
 *
 * UNIQUE SECTIONS:
 * 0  Cinematic Hero — Hook, "Level Up Your State"
 * 1  The Reality Check — Pain points & who it's for
 * 2  The Mini-Transformation — 4 core value pillars
 * 3  The 2-Hour Journey — Crisp vertical timeline
 * 4  Guided by Masters & What's Included
 * 5  The Shift — Anti-shadow testimonial blocks
 * 6  Your Investment — High-conversion, flat-design pricing card
 *
 * @package BaliElingSpirit
 * @version 1.0.1
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_online_workshop', 'bes_render_workshop');

function bes_render_workshop($atts)
{
    ob_start();
?>

    <section class="relative min-h-[90vh] flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ws-heading">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[600px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.09),transparent_60%)] mix-blend-screen"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_55%)] mix-blend-screen"></div>
            <div class="absolute inset-0 opacity-[0.02]" style="background-image:radial-gradient(rgba(255,255,255,.8) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-4xl mx-auto px-6 md:px-10 text-center py-28 z-10">
            <div class="bes-reveal mb-8 inline-flex items-center gap-2.5 bg-transparent border border-bes-leaf/30 rounded-full px-5 py-2">
                <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf animate-pulse"></span>
                <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf">Live Online Experience</span>
            </div>

            <h1 id="bes-ws-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[6rem] tracking-display leading-none mb-6">
                Level Up Your State.<br>
                <em class="font-light italic text-bes-leaf">In Just 2 Hours.</em>
            </h1>

            <p class="bes-reveal font-body font-light text-white/60 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                Hit pause. Reset your mind. Get high-impact insights and transformational practices in a bite-sized format—built entirely for your fast-paced modern life. No massive commitments required.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#bes-ws-pricing"
                    class="inline-flex items-center justify-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl border border-bes-leaf hover:bg-transparent hover:!text-bes-leaf transition-all duration-300 w-full sm:w-auto group">
                    <i class="fa-solid fa-bolt text-sm group-hover:scale-110 transition-transform" aria-hidden="true"></i>
                    Claim Your Spot
                </a>
                <a href="#bes-ws-flow"
                    class="inline-flex items-center justify-center gap-2.5 bg-transparent border border-white/10 !text-white/70 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:border-white/30 hover:!text-white transition-all duration-300 w-full sm:w-auto">
                    See The Curriculum
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
                        Time is tight, but your growth is non-negotiable.
                    </h2>
                    <p class="font-body font-light text-bes-bark-muted text-[14.5px] leading-relaxed">
                        We get it. Between back-to-back meetings, deadlines, and daily commitments, it feels impossible to just <em>breathe</em>. You crave peace and mental clarity, but you don't have the luxury of taking a week-long retreat right now.
                    </p>
                    
                    <ul class="space-y-4 pt-5 border-t border-bes-sand/60">
                        <?php
                        $pains = [
                            'You feel on the edge of burnout in your daily routine.',
                            'You struggle to stay consistent with your self-care practice.',
                            'You want deep, specific insights without the fluff.',
                            'You need a profound reset, but from the comfort of your own space.',
                        ];
                        foreach ($pains as $pain) : ?>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-arrow-right text-bes-moss text-[10px] mt-1.5" aria-hidden="true"></i>
                                <span class="font-body font-light text-bes-bark-muted text-[13.5px]"><?php echo esc_html($pain); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bes-reveal grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php
                    $audiences = [
                        ['icon' => 'fa-solid fa-briefcase', 'title' => 'Driven Professionals', 'desc' => 'For those navigating high-stress environments needing a quick, effective anchor.'],
                        ['icon' => 'fa-solid fa-seedling', 'title' => 'Mindfulness Seekers', 'desc' => 'Individuals hungry for authentic spiritual insights and fresh perspectives.'],
                        ['icon' => 'fa-solid fa-door-open', 'title' => 'Curious Beginners', 'desc' => 'A perfect, low-friction entry point to experience the renowned Eling method.'],
                        ['icon' => 'fa-solid fa-people-group', 'title' => 'Eling Alumni', 'desc' => 'The ideal space to maintain your practice consistency and stay connected.'],
                    ];
                    foreach ($audiences as $aud) : ?>
                        <div class="p-6 rounded-2xl border border-bes-sand bg-transparent hover:border-bes-moss/40 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.08] flex items-center justify-center mb-4">
                                <i class="<?php echo esc_attr($aud['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                            </div>
                            <h3 class="font-display font-medium text-bes-bark text-lg mb-2"><?php echo esc_html($aud['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[12.5px] leading-relaxed"><?php echo esc_html($aud['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Why This Format Works</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">The Mini-Transformation</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $usps = [
                    ['icon' => 'fa-solid fa-stopwatch', 'title' => '2 Hours of High Impact', 'desc' => 'Zero fluff. We dive straight into the core of the issue and deliver practical, immediate solutions.'],
                    ['icon' => 'fa-solid fa-laptop-house', 'title' => '100% Live & Online', 'desc' => 'Join from your living room or office desk. No traffic, no travel time. Just a solid internet connection.'],
                    ['icon' => 'fa-solid fa-layer-group', 'title' => 'Hyper-Relevant Themes', 'desc' => 'We don\'t do generic. Every session tackles a specific, modern-day challenge with ancient wisdom.'],
                    ['icon' => 'fa-solid fa-person-rays', 'title' => 'Action Over Theory', 'desc' => 'You won\'t just listen to a lecture. You will actively practice breathwork and guided meditation.'],
                ];
                foreach ($usps as $usp) : ?>
                    <div class="bes-reveal group p-7 rounded-2xl border border-white/10 hover:border-bes-gold/40 hover:bg-white/[.02] transition-all duration-300">
                        <i class="<?php echo esc_attr($usp['icon']); ?> text-bes-gold text-2xl mb-5 block opacity-70 group-hover:opacity-100 transition-opacity" aria-hidden="true"></i>
                        <h3 class="font-display font-medium text-white text-xl mb-3"><?php echo esc_html($usp['title']); ?></h3>
                        <p class="font-body font-light text-white/50 text-[13px] leading-relaxed"><?php echo esc_html($usp['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <section id="bes-ws-flow" class="bg-bes-cream py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 md:px-10">
            <div class="text-center mb-16">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Inside The Session</p>
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Your 2-Hour Journey</h2>
            </div>

            <div class="relative pl-6 md:pl-0">
                <div class="absolute left-[27px] md:left-1/2 md:-translate-x-1/2 top-0 bottom-0 w-px bg-bes-sand/80"></div>

                <?php
                $flows = [
                    ['time' => 'First 15 Mins', 'title' => 'Opening & Grounding', 'desc' => 'Release the tension of your day, center your scattered thoughts, and arrive fully in the present moment.', 'align' => 'md:text-right md:pr-12', 'pos' => 'md:justify-end'],
                    ['time' => 'Next 45 Mins', 'title' => 'Core Insights', 'desc' => 'A deep dive into the thematic philosophy. We break down ancient spiritual concepts into modern, actionable frameworks.', 'align' => 'md:text-left md:pl-12', 'pos' => 'md:justify-start'],
                    ['time' => 'Next 40 Mins', 'title' => 'Live Guided Practice', 'desc' => 'The shift happens here. Experience powerful breathwork, meditation, or reflection led live to physically clear blockages.', 'align' => 'md:text-right md:pr-12', 'pos' => 'md:justify-end'],
                    ['time' => 'Final 20 Mins', 'title' => 'Integration & Q&A', 'desc' => 'Open dialogue, shared experiences, and concrete takeaways you can apply the second you wake up tomorrow.', 'align' => 'md:text-left md:pl-12', 'pos' => 'md:justify-start'],
                ];
                
                foreach ($flows as $i => $flow) : 
                    $isEven = $i % 2 !== 0; 
                ?>
                    <div class="bes-reveal relative flex flex-col md:flex-row items-start md:items-center w-full mb-10 last:mb-0 group">
                        
                        <div class="hidden md:flex w-1/2 <?php echo esc_attr($flow['pos']); ?>">
                            <?php if (!$isEven) : ?>
                                <div class="<?php echo esc_attr($flow['align']); ?>">
                                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf"><?php echo esc_html($flow['time']); ?></span>
                                    <h3 class="font-display font-medium text-bes-bark text-2xl mt-1 mb-2 group-hover:!text-bes-leaf transition-colors duration-300"><?php echo esc_html($flow['title']); ?></h3>
                                    <p class="font-body font-light text-bes-bark-muted text-[13.5px]"><?php echo esc_html($flow['desc']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="absolute left-0 md:left-1/2 -translate-x-1/2 w-[11px] h-[11px] bg-bes-leaf border-2 border-bes-cream z-10 flex-shrink-0"></div>

                        <div class="hidden md:flex w-1/2 <?php echo esc_attr($flow['pos']); ?>">
                            <?php if ($isEven) : ?>
                                <div class="<?php echo esc_attr($flow['align']); ?>">
                                    <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf"><?php echo esc_html($flow['time']); ?></span>
                                    <h3 class="font-display font-medium text-bes-bark text-2xl mt-1 mb-2 group-hover:!text-bes-leaf transition-colors duration-300"><?php echo esc_html($flow['title']); ?></h3>
                                    <p class="font-body font-light text-bes-bark-muted text-[13.5px]"><?php echo esc_html($flow['desc']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="md:hidden pl-8 pb-4">
                            <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf"><?php echo esc_html($flow['time']); ?></span>
                            <h3 class="font-display font-medium text-bes-bark text-xl mt-1 mb-2"><?php echo esc_html($flow['title']); ?></h3>
                            <p class="font-body font-light text-bes-bark-muted text-[13px]"><?php echo esc_html($flow['desc']); ?></p>
                        </div>

                    </div>
                <?php endforeach; ?>
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
                        Every workshop is led by the core Yogi team at Bali Eling Spirit or select master guest facilitators. We don't just lecture; we facilitate experiences. Our approach seamlessly integrates profound spiritual wisdom into the gritty reality of your modern lifestyle.
                    </p>

                    <div class="bg-transparent border border-bes-leaf/30 rounded-2xl p-6">
                        <h4 class="font-body font-bold uppercase tracking-nav text-bes-leaf text-[11px] mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-cube text-bes-leaf/70"></i> What's Included
                        </h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf mt-1.5 flex-shrink-0"></span>
                                <span class="font-body font-light text-bes-bark text-[13px]">Exclusive access to the live, interactive online session.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf mt-1.5 flex-shrink-0"></span>
                                <span class="font-body font-light text-bes-bark text-[13px]">Full video replay (watch and re-practice anytime).</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf mt-1.5 flex-shrink-0"></span>
                                <span class="font-body font-light text-bes-bark text-[13px]">Downloadable PDF summary and self-practice playbook.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bes-reveal">
                    <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Impact</p>
                    <h2 class="font-display font-medium text-bes-bark text-3xl md:text-4xl tracking-display mb-8">Feel the Shift</h2>
                    
                    <div class="space-y-4">
                        <blockquote class="p-6 rounded-xl bg-transparent border border-bes-sand/80">
                            <p class="font-body font-light italic text-bes-bark-muted text-[13.5px] leading-relaxed mb-4">
                                "I genuinely didn't think a 2-hour online class could do much. I was wrong. The breathwork segment completely reset my stressed-out mind before a massive deadline."
                            </p>
                            <cite class="not-italic font-body font-bold text-[10px] uppercase tracking-label text-bes-bark/80 flex items-center gap-2">
                                <span class="w-4 h-px bg-bes-leaf"></span> Past Participant
                            </cite>
                        </blockquote>
                        <blockquote class="p-6 rounded-xl bg-transparent border border-bes-sand/80">
                            <p class="font-body font-light italic text-bes-bark-muted text-[13.5px] leading-relaxed mb-4">
                                "So practical and grounded. The insights weren't just spiritual fluff; I actually used the techniques to keep my cool during a tense client meeting the very next day."
                            </p>
                            <cite class="not-italic font-body font-bold text-[10px] uppercase tracking-label text-bes-bark/80 flex items-center gap-2">
                                <span class="w-4 h-px bg-bes-leaf"></span> Regular Attendee
                            </cite>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="bes-ws-pricing" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 bottom-0 w-[700px] h-[500px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_60%)] mix-blend-screen"></div>
        </div>

        <div class="relative max-w-lg mx-auto px-6 text-center z-10">
            <h2 class="bes-reveal font-display font-medium text-white text-4xl tracking-display mb-4">Begin Your Reset</h2>
            <p class="bes-reveal font-body font-light text-white/50 text-[14px] leading-relaxed mb-10">
                Registration for this month's workshop is officially open. We keep the interactive slots limited to ensure the highest quality experience for everyone.
            </p>

            <div class="bes-reveal bg-transparent border-2 border-bes-gold/30 rounded-2xl p-8 md:p-10 relative group hover:border-bes-gold/60 transition-colors duration-500">
                <div class="absolute inset-0 bg-bes-gold/5 blur-2xl -z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <p class="font-body font-bold text-[11px] uppercase tracking-nav text-bes-gold/80 mb-2">Your Investment</p>
                <div class="flex items-start justify-center gap-1 mb-8">
                    <span class="font-body font-medium text-white/60 text-lg mt-1">Rp</span>
                    <span class="font-display font-medium text-white text-6xl tracking-tight">199</span>
                    <span class="font-body font-medium text-white/60 text-lg mt-1">k</span>
                </div>

                <div class="h-px w-full bg-white/10 mb-8"></div>

                <a href="https://wa.me/6281228888873?text=Hi,%20I'm%20ready%20to%20register%20for%20the%20Online%20Workshop" target="_blank" rel="noopener noreferrer"
                    class="block w-full text-center bg-bes-gold text-bes-forest font-body font-bold text-[12px] uppercase tracking-label py-4 rounded-xl border border-bes-gold hover:bg-transparent hover:!text-bes-gold transition-all duration-300">
                    Secure Your Spot
                </a>
                
                <p class="font-body font-light text-[11.5px] text-white/40 mt-5">
                    Your secure access link will be sent via WhatsApp immediately upon confirmation.
                </p>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}