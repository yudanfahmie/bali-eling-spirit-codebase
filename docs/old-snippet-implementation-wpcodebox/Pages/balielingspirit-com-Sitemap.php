<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: HTML Sitemap
 * ============================================================================
 *
 * USAGE: [bes_sitemap]
 *
 * Renders a beautiful, organised HTML sitemap for visitors and SEO.
 * Dynamically pulls pages from WordPress where available, with clean fallbacks.
 * Uses BES v3 design tokens — no additional CSS required.
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_sitemap', 'bes_sitemap_shortcode' );

function bes_sitemap_shortcode( $atts ) {
    ob_start();

    /* ── Sitemap Data Structure ── */
    $sitemap = [
        [
            'section'     => 'Main Navigation',
            'icon'        => 'fa-house',
            'color'       => 'bes-leaf',
            'bg'          => 'bg-bes-leaf/10',
            'description' => 'Core pages of the Bali Eling Spirit website.',
            'pages'       => [
                ['label' => 'Home', 'href' => '/', 'desc' => 'Welcome to Bali Eling Spirit — your divine home to transform.'],
                ['label' => 'Healing & Retreat', 'href' => '/healing-retreat', 'desc' => 'Discover our signature healing retreat experiences rooted in Balinese tradition.'],
                ['label' => 'Yoga Teacher Training', 'href' => '/yoga-teacher-training', 'desc' => 'Yoga Alliance-registered 200-hour and 300-hour YTT programs in Bali.'],
                ['label' => 'Wisdom', 'href' => '/wisdom', 'desc' => 'Articles, teachings, and sacred wisdom from the Balinese Hindu Dharma tradition.'],
                ['label' => 'About Us', 'href' => '/about-us', 'desc' => 'The story, mission, and spiritual teachers behind Bali Eling Spirit.'],
            ],
        ],
        [
            'section'     => 'Healing Retreats',
            'icon'        => 'fa-person-praying',
            'color'       => 'bes-gold',
            'bg'          => 'bg-bes-gold/10',
            'description' => 'Immersive retreat programs combining Balinese healing, energy work, and spiritual ceremony.',
            'pages'       => [
                ['label' => 'Healing Retreat Overview',     'href' => '/healing-retreat',            'desc' => 'Full overview of our healing retreat offerings and what to expect.'],
                ['label' => 'Eling Tapa Brata',             'href' => '/eling-tapa-brata',           'desc' => 'A profound discipline-based inner journey for deep self-purification.'],
                ['label' => 'Sacred Morning Awakening',     'href' => '/sacred-morning-awakening',   'desc' => 'Greet the Balinese dawn with ceremony, yoga, and meditation at sunrise.'],
                ['label' => 'Karma Retreat',                'href' => '/karma-retreat',              'desc' => 'Heal karmic imprints through ritual, reflection, and Dharma teaching.'],
                ['label' => 'Punarbawa Retreat',            'href' => '/punarbawa-retreat',          'desc' => 'A rebirth experience — cleanse, renew, and realign with your true self.'],
                ['label' => 'Atma Retreat',                 'href' => '/atma-retreat',               'desc' => 'Journey to the soul — a deeply meditative and ceremonial retreat.'],
                ['label' => '7-Chakra Purification',        'href' => '/7-chakra-purification',      'desc' => 'Seven-day intensive chakra clearing and energy balancing journey.'],
                ['label' => 'Surya Namaskar Retreat',       'href' => '/surya-namaskar',             'desc' => 'Sun salutation immersion — honour the solar energy within and around you.'],
            ],
        ],
        [
            'section'     => 'Yoga Teacher Training',
            'icon'        => 'fa-certificate',
            'color'       => 'bes-olive',
            'bg'          => 'bg-bes-olive/10',
            'description' => 'Yoga Alliance International-registered teacher training programs in the living Balinese tradition.',
            'pages'       => [
                ['label' => 'YTT Overview',             'href' => '/yoga-teacher-training',            'desc' => 'An introduction to our Yoga Teacher Training philosophy and approach.'],
                ['label' => '200-Hour YTT',             'href' => '/200hr-ytt',                        'desc' => 'Comprehensive 200-hour Yoga Alliance RYT certification program in Bali.'],
                ['label' => '300-Hour YTT',             'href' => '/300hr-ytt',                        'desc' => 'Advanced 300-hour program for certified yoga teachers deepening their practice.'],
                ['label' => 'YTT Curriculum',           'href' => '/yoga-teacher-training#curriculum', 'desc' => 'Explore the modules, philosophy, asana, and methodology taught in our YTT.'],
                ['label' => 'YTT Testimonials',        'href' => '/yoga-teacher-training#testimonials','desc' => 'Hear from our global community of graduates about their transformation.'],
                ['label' => 'YTT FAQ',                  'href' => '/yoga-teacher-training#faq',        'desc' => 'Common questions about prerequisites, accommodation, schedules, and certification.'],
                ['label' => 'Apply for YTT',            'href' => '/yoga-teacher-training#apply',      'desc' => 'Begin your application for the next available 200-hour or 300-hour cohort.'],
            ],
        ],
        [
            'section'     => 'Wisdom & Teachings',
            'icon'        => 'fa-book-open',
            'color'       => 'bes-moss',
            'bg'          => 'bg-bes-moss/10',
            'description' => 'Sacred knowledge, spiritual insights, and Balinese Dharma teachings from our teachers.',
            'pages'       => [
                ['label' => 'Wisdom Blog', 'href' => '/wisdom', 'desc' => 'A growing library of articles on yoga, meditation, Balinese philosophy, and healing.'],
                ['label' => 'Podcast on Spotify', 'href' => 'https://open.spotify.com/show/5eqVplP40VtkHWRlSmsd9T', 'desc' => 'Listen to sacred teachings and conversations on the Bali Eling Spirit podcast.', 'external' => true],
            ],
        ],
        [
            'section'     => 'About & Community',
            'icon'        => 'fa-users',
            'color'       => 'bes-sage',
            'bg'          => 'bg-bes-sage/10',
            'description' => 'Learn about who we are, our spiritual lineage, and how to join our community.',
            'pages'       => [
                ['label' => 'About Bali Eling Spirit',  'href' => '/about-us',          'desc' => 'Our origin story, spiritual mission, and the Pasraman community we steward.'],
                ['label' => 'Our Teachers',             'href' => '/about-us#teachers', 'desc' => 'Meet the Balinese master teachers, healers, and facilitators who guide our programs.'],
                ['label' => 'Sanctuary & Location',     'href' => '/about-us#sanctuary','desc' => 'Explore our sacred property in Pejeng Kangin, Tampaksiring, Gianyar, Bali.'],
                ['label' => 'Testimonials',             'href' => '/about-us#testimonials','desc' => 'Stories of transformation from guests and students around the world.'],
                ['label' => 'Gallery',                  'href' => '/gallery',           'desc' => 'A visual journey through our sanctuary, ceremonies, and program moments.'],
            ],
        ],
        [
            'section'     => 'Book & Contact',
            'icon'        => 'fa-calendar-check',
            'color'       => 'bes-leaf',
            'bg'          => 'bg-bes-leaf/10',
            'description' => 'Ready to begin your sacred journey? Reach out to reserve your place.',
            'pages'       => [
                ['label' => 'Contact Us',            'href' => '/contact',               'desc' => 'Get in touch via our enquiry form, email, or WhatsApp.'],
                ['label' => 'Book via WhatsApp',     'href' => 'https://wa.me/6281228888873', 'desc' => 'Direct message our team on WhatsApp to begin your booking: +62 812 2888 8873.', 'external' => true],
                ['label' => 'Send an Email',         'href' => 'mailto:info@balielingspirit.com', 'desc' => 'Email us at info@balielingspirit.com for inquiries, bookings, and program questions.', 'external' => true],
                ['label' => 'Directions & Map',      'href' => '/contact#map',           'desc' => 'Find us in Pejeng Kangin, Tampaksiring, Gianyar — we can arrange airport transfer.'],
            ],
        ],
        [
            'section'     => 'Social Media',
            'icon'        => 'fa-share-nodes',
            'color'       => 'bes-moss',
            'bg'          => 'bg-bes-moss/10',
            'description' => 'Follow our journey and connect with our global spiritual community.',
            'pages'       => [
                ['label' => 'Facebook', 'href' => 'https://facebook.com/PasramanBaliElingSpirit', 'desc' => 'Join our Facebook community for event updates and live teachings.', 'external' => true],
                ['label' => 'Instagram', 'href' => 'https://instagram.com/bali.elingspirit', 'desc' => 'Daily inspiration, sanctuary beauty, and program snapshots on Instagram.', 'external' => true],
                ['label' => 'YouTube', 'href' => 'https://youtube.com/@PasramanBaliElingSpirit', 'desc' => 'Free yoga classes, guided meditations, and ceremony insights on our YouTube channel.', 'external' => true],
                ['label' => 'TikTok', 'href' => 'https://www.tiktok.com/@pasramanbalielingspirit', 'desc' => 'Short-form glimpses into daily sanctuary life and sacred practices.', 'external' => true],
                ['label' => 'Spotify Podcast', 'href' => 'https://open.spotify.com/show/5eqVplP40VtkHWRlSmsd9T', 'desc' => 'The Bali Eling Spirit podcast — wisdom conversations for the modern seeker.', 'external' => true],
            ],
        ],
        [
            'section'     => 'Legal & Policies',
            'icon'        => 'fa-file-shield',
            'color'       => 'bes-bark-muted',
            'bg'          => 'bg-bes-bark/5',
            'description' => 'Transparency and legal information governing your use of our website and services.',
            'pages'       => [
                ['label' => 'Privacy Policy',      'href' => '/privacy-policy', 'desc' => 'How we collect, use, protect, and manage your personal data (UU PDP & GDPR compliant).'],
                ['label' => 'Terms of Service',    'href' => '/terms',          'desc' => 'The terms and conditions governing bookings, participation, and use of our website.'],
                ['label' => 'Sitemap',             'href' => '/sitemap',        'desc' => 'You are here. A complete map of all pages on the Bali Eling Spirit website.'],
            ],
        ],
    ];

    ?>
    <!-- ====== BES HTML Sitemap Page ====== -->
    <div data-bes-header="dark" class="min-h-screen bg-bes-parchment">

        <!-- Hero Banner -->
        <div class="relative bg-bes-forest-deep overflow-hidden">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[260px] pointer-events-none"
                 style="background:radial-gradient(ellipse,rgba(194,210,74,0.07),transparent 70%)"></div>
            <div class="absolute bottom-0 left-0 right-0 h-8 opacity-10"
                 style="background:repeating-linear-gradient(90deg,transparent 0px,transparent 18px,rgba(194,210,74,.5) 18px,rgba(194,210,74,.5) 19px,transparent 19px,transparent 37px)"></div>

            <div class="relative max-w-4xl mx-auto px-6 md:px-10 py-20 md:py-28 text-center">
                <div class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full bg-bes-leaf/10 border border-bes-leaf/20">
                    <i class="fa-solid fa-sitemap text-bes-leaf text-xs" aria-hidden="true"></i>
                    <span class="text-bes-leaf text-[10px] font-body font-bold uppercase tracking-[0.2em]">Navigate With Clarity</span>
                </div>
                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-medium text-white mb-4 tracking-display">
                    Sitemap
                </h1>
                <p class="font-body text-white/40 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                    A complete guide to every corner of the Bali Eling Spirit website — find exactly what you're looking for.
                </p>
                <!-- Live page count badge -->
                <div class="mt-8 inline-flex items-center gap-3">
                    <?php
                    $total = 0;
                    foreach ($sitemap as $s) { $total += count($s['pages']); }
                    ?>
                    <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-bes-leaf animate-pulse"></span>
                        <span class="text-white/40 text-[11px] font-body font-medium"><?php echo $total; ?> pages across <?php echo count($sitemap); ?> sections</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Jump Row -->
        <div class="sticky top-[var(--bes-hdr-h,80px)] z-40 bg-white/80 backdrop-blur-md border-b border-bes-sage/15 shadow-sm">
            <div class="max-w-6xl mx-auto px-5 md:px-10">
                <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-hide no-scrollbar">
                    <span class="text-[10px] text-bes-bark-muted font-bold uppercase tracking-widest whitespace-nowrap mr-3 flex-shrink-0">Jump to:</span>
                    <?php foreach ($sitemap as $i => $s): ?>
                    <a href="#section-<?php echo $i; ?>"
                       class="flex-shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-body font-medium text-bes-bark-muted hover:!text-bes-olive hover:bg-bes-leaf/5 transition-all whitespace-nowrap">
                        <i class="fa-solid <?php echo esc_attr($s['icon']); ?> text-[9px] opacity-60" aria-hidden="true"></i>
                        <?php echo esc_html($s['section']); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <style>.no-scrollbar::-webkit-scrollbar{display:none}.no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}</style>

        <!-- Main Sitemap Grid -->
        <div class="max-w-6xl mx-auto px-5 md:px-10 py-14 lg:py-20">

            <!-- Overview Cards Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 mb-14">
                <?php foreach ($sitemap as $i => $s): ?>
                <a href="#section-<?php echo $i; ?>"
                   class="group rounded-xl border border-bes-sage/15 bg-white/50 hover:bg-white/80 hover:border-bes-leaf/20 hover:shadow-md transition-all duration-300 p-4 text-center flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-xl <?php echo esc_attr($s['bg']); ?> flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid <?php echo esc_attr($s['icon']); ?> text-<?php echo esc_attr($s['color']); ?> text-sm" aria-hidden="true"></i>
                    </div>
                    <span class="text-[10px] font-body font-bold text-bes-bark-muted group-hover:!text-bes-olive text-center leading-tight transition-colors"><?php echo esc_html($s['section']); ?></span>
                    <span class="text-[10px] text-bes-bark-muted/60"><?php echo count($s['pages']); ?> pages</span>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Full Sitemap Sections -->
            <div class="space-y-12">
                <?php foreach ($sitemap as $i => $s): ?>
                <section id="section-<?php echo $i; ?>" class="scroll-mt-28">

                    <!-- Section Header -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl <?php echo esc_attr($s['bg']); ?> flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid <?php echo esc_attr($s['icon']); ?> text-<?php echo esc_attr($s['color']); ?> text-sm" aria-hidden="true"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="font-display text-xl md:text-2xl font-medium text-bes-bark"><?php echo esc_html($s['section']); ?></h2>
                            <p class="text-[12px] text-bes-bark-muted font-body mt-0.5"><?php echo esc_html($s['description']); ?></p>
                        </div>
                        <span class="hidden sm:inline-flex items-center justify-center w-7 h-7 rounded-full bg-bes-sage/15 text-[11px] font-bold text-bes-bark-muted flex-shrink-0">
                            <?php echo count($s['pages']); ?>
                        </span>
                    </div>

                    <!-- Pages Grid -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <?php foreach ($s['pages'] as $p):
                            $is_external = !empty($p['external']);
                            $is_mailto   = strpos($p['href'], 'mailto:') === 0;
                            $icon        = $is_mailto ? 'fa-envelope' : ($is_external ? 'fa-arrow-up-right-from-square' : 'fa-chevron-right');
                            $target      = ($is_external && !$is_mailto) ? ' target="_blank" rel="noopener noreferrer"' : '';
                        ?>
                        <a href="<?php echo esc_url($p['href']); ?>"<?php echo $target; ?>
                           class="group flex items-start gap-3.5 rounded-xl border border-bes-sage/12 bg-white/40 hover:bg-white/80 hover:border-bes-leaf/20 hover:shadow-md transition-all duration-300 p-4">
                            <div class="w-8 h-8 rounded-lg <?php echo esc_attr($s['bg']); ?> flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid <?php echo esc_attr($icon); ?> text-<?php echo esc_attr($s['color']); ?> text-[9px]" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-body font-semibold text-[13px] text-bes-bark group-hover:!text-bes-olive transition-colors mb-0.5 leading-tight">
                                    <?php echo esc_html($p['label']); ?>
                                    <?php if ($is_external && !$is_mailto): ?>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[8px] text-bes-bark-muted ml-1 opacity-50" aria-label="external link" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </p>
                                <p class="text-[11px] text-bes-bark-muted leading-relaxed font-body"><?php echo esc_html($p['desc']); ?></p>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($i < count($sitemap) - 1): ?>
                    <div class="mt-12 h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>
                    <?php endif; ?>

                </section>
                <?php endforeach; ?>
            </div>

            <!-- Bottom CTA strip -->
            <div class="mt-16 rounded-2xl border border-bes-sage/20 overflow-hidden"
                 style="background:linear-gradient(135deg,<?php echo BES_COLORS['forest_92']; ?>,<?php echo BES_COLORS['forest']; ?>)">
                <div class="relative p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="absolute inset-0 opacity-[0.03]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                    <div class="relative text-center md:text-left">
                        <h3 class="font-display text-2xl md:text-3xl font-medium text-white mb-2">Can't find what you're looking for?</h3>
                        <p class="text-[13px] text-white/40 font-body">Our team is always happy to answer your questions and help you find the right program.</p>
                    </div>
                    <div class="relative flex flex-col sm:flex-row gap-3 flex-shrink-0">
                        <a href="mailto:info@balielingspirit.com"
                           class="inline-flex items-center gap-2 bg-white/[.06] border border-white/[.08] text-white text-[11px] font-bold uppercase tracking-label px-5 py-2.5 rounded-full hover:bg-white/10 transition-all">
                            <i class="fa-solid fa-envelope text-xs" aria-hidden="true"></i> Email Us
                        </a>
                        <a href="https://wa.me/6281228888873" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 bg-bes-leaf text-bes-forest text-[11px] font-bold uppercase tracking-label px-5 py-2.5 rounded-full hover:bg-bes-leaf-hover transition-all">
                            <i class="fa-brands fa-whatsapp text-xs" aria-hidden="true"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer note -->
            <p class="mt-8 text-center text-[11px] text-bes-bark-muted font-body">
                Sitemap last updated: <?php echo date('F j, Y'); ?> &nbsp;&middot;&nbsp;
                <a href="https://balielingspirit.com/sitemap.xml" class="text-bes-olive hover:!text-bes-olive-dark transition-colors underline underline-offset-2" target="_blank" rel="noopener">View XML Sitemap</a> (for search engines)
            </p>

        </div>
    </div><!-- /bes-sitemap -->

    <?php
    return ob_get_clean();
}