<?php

/**
 * ============================================================================
 * BALI ELING SPIRIT — [bes_ytt_200h_landing] Shortcode
 * ============================================================================
 *
 * Registers [bes_ytt_200h_landing] specifically for the YTT 200H Page.
 * 100% aligned with BES v3 design system:
 * - Tailwind BES color tokens, font-display, font-body
 * - tracking-nav / tracking-label / tracking-display
 * - bes-reveal entrance animations, bes-fret dividers
 *
 * UNIQUE SECTIONS (8 total):
 * 0  Cinematic Hero — 200H focus, triple-accreditation badges
 * 1  Who Is This For? — Pain points & Dream Outcomes
 * 2  The BES Difference — Unique Selling Propositions & Rituals
 * 3  The 200H Curriculum — 6 Pillars (Practice, Philosophy, Anatomy, etc.)
 * 4  Lead Instructor — Profile of Sri Bhagawan Sriprada Bhaskara
 * 5  What You Will Experience — The 25-Day Immersive Details
 * 6  Investment & Bonuses — Rp 28.990.000 All-in + 10H Sound Healing Bonus
 * 7  Closing CTA
 *
 * @package BaliElingSpirit
 * @version 1.1.0
 */

if (! defined('ABSPATH')) exit;

add_shortcode('bes_ytt_200h_landing', 'bes_render_ytt_200h');

function bes_render_ytt_200h($atts)
{
    ob_start();
?>

    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-heading">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_58%)]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[350px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">
            <div class="bes-reveal mb-8 space-y-2">
                <p class="font-display font-light italic text-white/30 text-lg md:text-xl tracking-wide">
                    <em>"Atha yoga-anusasanam"</em>
                </p>
                <p class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-leaf/50">
                    "Now, the discipline of yoga begins." - Yoga Sutra Patanjali 1.1
                </p>
            </div>

            <div class="bes-reveal flex justify-center mb-6">
                <div class="inline-flex items-center gap-2 bg-bes-gold/[.08] border border-bes-gold/[.22] rounded-full px-4 py-1.5">
                    <i class="fa-solid fa-language text-bes-gold text-[11px]" aria-hidden="true"></i>
                    <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-gold/85">Available in Bahasa Indonesia &amp; English</span>
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
                200H Yoga Teacher
            </h1>
            <h2 class="bes-reveal font-display font-light text-bes-leaf text-4xl md:text-5xl lg:text-[4.5rem] tracking-display leading-none mb-8 italic">
                Training Immersion
            </h2>

            <p class="bes-reveal font-body font-light text-white/50 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                A life-changing 25-day journey to form conscious, authentic yoga teachers. Deepen your practice, transcend the physical, and root yourself in traditional Balinese spiritual wisdom.
            </p>

            <div class="bes-reveal flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="#bes-investment"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-all duration-300 shadow-lg shadow-bes-leaf/10 group">
                    <i class="fa-solid fa-arrow-down text-sm group-hover:translate-y-1 transition-transform" aria-hidden="true"></i>
                    View Program Investment
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

    <section class="bg-bes-parchment py-20 md:py-28 overflow-hidden" aria-label="Is this program for you">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">The Calling</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-8">
                        Are you ready for more than just physical movement?
                    </h2>
                    
                    <div class="space-y-4">
                        <?php
                        $pains = [
                            "You feel stuck in your personal yoga practice and want to seriously level up.",
                            "You want to teach, but lack the confidence and structural knowledge to guide others safely.",
                            "Your yoga experience remains purely physical, missing the profound spiritual connection.",
                            "You are searching for clarity, purpose, and a more conscious way of living.",
                            "You lack deep understanding of ancient philosophy, proper anatomy, and effective teaching methodologies."
                        ];
                        foreach ($pains as $pain) : ?>
                            <div class="bes-reveal flex items-start gap-4 p-4 rounded-xl border border-bes-sand/50 bg-white/40">
                                <i class="fa-solid fa-arrow-right-long text-bes-olive mt-1 text-sm" aria-hidden="true"></i>
                                <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($pain); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bes-reveal relative rounded-3xl border border-bes-leaf/20 overflow-hidden" style="background:linear-gradient(145deg,rgba(38,51,32,.9),rgba(21,30,16,1))">
                    <div class="h-[3px] bg-gradient-to-r from-bes-gold via-bes-leaf to-transparent"></div>
                    <div class="p-10 md:p-12">
                        <h3 class="font-display font-light italic text-bes-gold text-3xl mb-8">The Dream Outcome</h3>
                        <ul class="space-y-6">
                            <?php
                            $outcomes = [
                                ['icon' => 'fa-solid fa-certificate', 'text' => 'Become a Certified 200H Yoga Teacher recognized globally.'],
                                ['icon' => 'fa-solid fa-om',          'text' => 'Develop a holistic understanding of yoga uniting body, mind, and soul.'],
                                ['icon' => 'fa-solid fa-chalkboard-user', 'text' => 'Command the room and teach classes with undeniable confidence.'],
                                ['icon' => 'fa-solid fa-seedling',    'text' => 'Experience a profound life transformation: clarity, purpose, and inner peace.'],
                                ['icon' => 'fa-solid fa-people-group', 'text' => 'Enter a lifelong global community dedicated to conscious living.'],
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

    <section class="bg-bes-cream py-20 md:py-28" aria-label="Why this program is unique">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display max-w-3xl mx-auto">
                    Why Choose Bali Eling Spirit?
                </h2>
                <p class="bes-reveal font-body font-light text-bes-bark-muted text-base max-w-2xl mx-auto mt-4 leading-relaxed">
                    This is not just a certification factory. We integrate classical global standards with authentic Balinese spiritual rituals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $usps = [
                    ['icon' => 'fa-solid fa-leaf', 'title' => 'Bali Hatha Yoga Method', 'body' => 'Master our signature method designed to align physical health with energetic balance.'],
                    ['icon' => 'fa-solid fa-yin-yang', 'title' => 'Classical meets Balinese', 'body' => 'A unique integration of classical Indian yoga roots with profound Balinese spirituality.'],
                    ['icon' => 'fa-solid fa-globe', 'title' => 'Triple Certification', 'body' => 'Graduate with credentials recognized by Yoga Alliance USA, YAI, and World Yoga Federation.'],
                      ['icon' => 'fa-solid fa-moon', 'title' => '25-Day Immersive Training', 'body' => 'Step away from daily life for deep transformation, inner work, and pure focus.'],
                    ['icon' => 'fa-solid fa-fire', 'title' => 'Sacred Spiritual Rituals', 'body' => 'Experience authentic Melukat (water purification), Agni Hotra (fire ritual), and Sound Healing.'],
                    ['icon' => 'fa-solid fa-users', 'title' => 'Small Batch & Personal', 'body' => 'We limit class sizes to ensure you receive highly personalized guidance from our Masters.'],
                ];
                foreach ($usps as $usp) : ?>
                    <div class="bes-reveal group flex flex-col gap-4 p-8 rounded-2xl border border-bes-sand hover:border-bes-leaf/20 hover:shadow-lg transition-all duration-400" style="background:linear-gradient(145deg,#fdfcfa,#f7f4ee)">
                        <div class="w-12 h-12 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center mb-2">
                            <i class="<?php echo esc_attr($usp['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-bes-bark text-xl"><?php echo esc_html($usp['title']); ?></h3>
                        <p class="font-body font-light text-bes-bark-muted text-[13.5px] leading-relaxed"><?php echo esc_html($usp['body']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Curriculum Pillars">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute right-0 top-0 w-[600px] h-[400px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.07),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>

        <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="text-center mb-14">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Complete Syllabus</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">The 6 Pillars of Learning</h2>
                <p class="bes-reveal font-body font-light text-white/50 text-base max-w-2xl mx-auto">Everything you need to transform from practitioner to confident professional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $pillars = [
                    [
                        'name' => 'Yoga Practice',
                        'desc' => 'Master Asana alignments, adjustments, and sequencing. Deep dive into Pranayama, Breathwork, Meditation, and Yoga Nidra.',
                        'icon' => 'fa-solid fa-person-praying'
                    ],
                    [
                        'name' => 'Yoga Philosophy',
                        'desc' => 'Study the Yoga Sutras of Patanjali, Bhagavad Gita, and explore concepts like Atman, Dharma, Karma, and Balinese Tri Hita Karana.',
                        'icon' => 'fa-solid fa-book-open'
                    ],
                    [
                        'name' => 'Anatomy & Physiology',
                        'desc' => 'Understand bodily systems (muscular, skeletal, respiratory), the biomechanics of movement, and crucial injury prevention techniques.',
                        'icon' => 'fa-solid fa-bone'
                    ],
                    [
                        'name' => 'Teaching Methodology',
                        'desc' => 'Learn exactly how to structure a class, the art of cueing, hands-on adjustments, and undergo practical teaching exams with feedback.',
                        'icon' => 'fa-solid fa-chalkboard-user'
                    ],
                    [
                        'name' => 'Professional Development',
                        'desc' => 'Find your voice with public speaking training, learn personal branding as a teacher, and master advanced class design.',
                        'icon' => 'fa-solid fa-briefcase'
                    ],
                    [
                        'name' => 'Spiritual Transformation',
                        'desc' => 'Experience profound inner work through Journaling, Sound Healing Journeys, Melukat purification, and Agni Hotra fire rituals.',
                        'icon' => 'fa-solid fa-fire-flame-curved'
                    ]
                ];
                foreach ($pillars as $idx => $p) : ?>
                    <div class="bes-reveal group relative p-8 rounded-2xl border border-white/[.08] overflow-hidden" style="background:rgba(255,255,255,0.03)">
                        <div class="absolute top-0 right-0 p-6 opacity-10 font-display text-6xl text-white font-bold"><?php echo $idx + 1; ?></div>
                        <div class="w-12 h-12 rounded-xl bg-bes-gold/10 border border-bes-gold/20 flex items-center justify-center mb-6">
                            <i class="<?php echo esc_attr($p['icon']); ?> text-bes-gold text-lg" aria-hidden="true"></i>
                        </div>
                        <h3 class="font-display font-medium text-white text-xl mb-3"><?php echo esc_html($p['name']); ?></h3>
                        <p class="font-body font-light text-white/60 text-[13.5px] leading-relaxed"><?php echo esc_html($p['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Lead Instructor Profile">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md aspect-[4/5] rounded-t-full border-4 border-bes-sand overflow-hidden flex flex-col items-center justify-end pb-10" style="background:linear-gradient(to top, #e8e3d8, #fdfcfa)">
                         <?php echo wp_get_attachment_image(1345, 'large', false, ['class' => 'absolute inset-0 w-full h-full object-cover z-0']); ?>
                         <div class="text-center z-10 bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-bes-sand">
                             <p class="font-display font-medium text-bes-bark text-xl">Sri Bhagawan</p>
                             <p class="font-display font-light text-bes-bark-muted">Sriprada Bhaskara</p>
                         </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Learn From The Source</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">
                        Guided by Spiritual Masters
                    </h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed mb-8">
                        This program is deeply supervised by the spiritual guidance of <strong>Sri Bhagawan Sriprada Bhaskara</strong> and the dedicated Yogis at Bali Eling Spirit. 
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php
                        $creds = [
                            'International Standards (Yoga Alliance, YAI, WYF)',
                            'Decades of lived practitioner experience',
                            'Holistic approach uniting physical, mental, and spiritual',
                            'Focused on true personal transformation, not just certification'
                        ];
                        foreach ($creds as $cred) : ?>
                            <div class="bes-reveal flex items-center gap-3 p-4 rounded-xl border border-bes-leaf/10 bg-bes-leaf/[.02]">
                                <i class="fa-solid fa-check text-bes-leaf text-sm"></i>
                                <span class="font-body font-medium text-bes-bark-muted text-[13px]"><?php echo esc_html($cred); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="bes-investment" class="relative bg-bes-forest-deep py-20 md:py-28 overflow-hidden" aria-label="Program Pricing and Investment">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 w-[700px] h-[300px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_60%)]"></div>
            <div class="absolute inset-0 opacity-[0.015]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
        </div>
        <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>

        <div class="relative max-w-5xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Join The Next Cohort</p>
                <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Program Investment</h2>
            </div>

            <div class="bes-reveal relative rounded-3xl border border-bes-gold/30 bg-black/40 backdrop-blur-md overflow-hidden shadow-2xl">
                <div class="h-[4px] bg-gradient-to-r from-bes-leaf via-bes-gold to-bes-leaf"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-2 p-10 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center items-center text-center">
                        <h3 class="font-display font-light text-white/70 text-xl mb-2">All-In Program</h3>
                        <p class="font-display text-bes-gold text-4xl md:text-5xl font-medium mb-2">Rp 28.990.000</p>
                        <p class="font-body text-white/40 text-xs mb-8">Limited seats available to ensure personalized guidance.</p>
                        
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                            class="w-full inline-flex justify-center items-center gap-2.5 bg-bes-gold text-black font-body font-bold text-[12px] uppercase tracking-label px-8 py-4 rounded-xl hover:bg-white transition-all duration-300">
                            Register Now
                        </a>
                        
                        <div class="mt-6 flex items-start gap-2 text-left bg-bes-leaf/10 p-3 rounded-lg border border-bes-leaf/20">
                            <i class="fa-solid fa-tag text-bes-leaf mt-1 text-xs"></i>
                            <p class="font-body text-[11px] text-white/70 leading-tight">
                                <strong class="text-bes-leaf">Promo:</strong> Special ±10% discount for Bali ID (KTP Bali) holders OR the first 5 registrants!
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-3 p-10 md:p-12">
                        <h4 class="font-body font-bold text-[11px] uppercase tracking-nav text-white/50 mb-6">What You Get:</h4>
                        <ul class="space-y-4 mb-8">
                            <?php
                            $inclusions = [
                                'Triple International Certification (200H)',
                                'Intensive 25-Day Training',
                                '24 Nights Ashram-style Accommodation',
                                '3x Healthy Vegetarian Meals per day',
                                'Exclusive Training Modules, Notebook & Welcome Kit',
                                'Professional Career Pathway as a Yoga Teacher',
                                'Graduation Ceremony & Global Community Access'
                            ];
                            foreach ($inclusions as $inc) : ?>
                                <li class="flex items-center gap-3">
                                    <div class="w-5 h-5 rounded-full border border-bes-leaf/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-check text-bes-leaf text-[9px]" aria-hidden="true"></i>
                                    </div>
                                    <span class="font-body font-light text-white/80 text-[14px]"><?php echo esc_html($inc); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="bg-bes-forest/50 border border-bes-gold/20 rounded-xl p-4 flex items-center gap-4">
                            <i class="fa-solid fa-gift text-bes-gold text-2xl"></i>
                            <div>
                                <p class="font-body font-bold text-bes-gold text-[10px] uppercase tracking-nav">Exclusive Bonus</p>
                                <p class="font-body text-white/90 text-sm">Free Access to our <strong>10-Hour Sound Healing Course</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bg-bes-ivory py-20 md:py-24" aria-label="Final Call to Action">
        <div class="max-w-[1440px] mx-auto px-6 md:px-10 text-center">
            <div class="bes-reveal max-w-3xl mx-auto">
                <h2 class="font-display font-medium text-bes-bark text-4xl md:text-5xl lg:text-6xl tracking-display mb-4">
                    Start Your Journey.
                </h2>
                <h3 class="font-display font-light italic text-bes-moss text-3xl md:text-4xl tracking-display mb-6">
                    Teach & Live Yoga.
                </h3>
                <p class="font-body font-light text-bes-bark-muted text-base mb-10 leading-relaxed">
                    Become a Certified Yoga Teacher & Transform Your Life today.
                </p>

                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2.5 bg-bes-leaf text-white font-body font-bold text-[12px] uppercase tracking-label px-10 py-5 rounded-2xl hover:bg-bes-forest hover:shadow-xl transition-all duration-300">
                    Join YTT 200H – Limited Seats
                </a>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}