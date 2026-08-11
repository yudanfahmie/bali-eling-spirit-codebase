<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Privacy Policy
 * ============================================================================
 *
 * USAGE: [bes_privacy_policy]
 *
 * Uses BES v3 design tokens (colors, typography, Tailwind classes).
 * No additional CSS needed — all handled via existing bes_global_head().
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_privacy_policy', 'bes_privacy_policy_shortcode' );

function bes_privacy_policy_shortcode( $atts ) {
    $last_updated = 'February 26, 2026';
    ob_start();
    ?>

    <!-- ====== BES Privacy Policy Page ====== -->
    <div class="min-h-screen bg-bes-parchment">

        <!-- Hero Banner -->
        <div class="relative bg-bes-forest-deep overflow-hidden">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] pointer-events-none"
                 style="background:radial-gradient(ellipse,rgba(194,210,74,0.08),transparent 70%)"></div>
            <!-- Decorative fretwork -->
            <div class="absolute bottom-0 left-0 right-0 h-8 opacity-10"
                 style="background:repeating-linear-gradient(90deg,transparent 0px,transparent 18px,rgba(194,210,74,.5) 18px,rgba(194,210,74,.5) 19px,transparent 19px,transparent 37px)"></div>

            <div class="relative max-w-4xl mx-auto px-6 md:px-10 py-20 md:py-28 text-center">
                <div class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full bg-bes-leaf/10 border border-bes-leaf/20">
                    <i class="fa-solid fa-shield-halved text-bes-leaf text-xs" aria-hidden="true"></i>
                    <span class="text-bes-leaf text-[10px] font-body font-bold uppercase tracking-[0.2em]">Legal Document</span>
                </div>
                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-medium text-white mb-4 tracking-display">
                    Privacy Policy
                </h1>
                <p class="font-body text-white/40 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                    We honour your trust with the same sacred care we bring to every healing journey.
                </p>
                <div class="mt-8 inline-flex items-center gap-2 text-white/25 text-xs font-body">
                    <i class="fa-regular fa-calendar text-bes-leaf/40" aria-hidden="true"></i>
                    Last updated: <?php echo esc_html($last_updated); ?>
                </div>
            </div>
        </div>

        <!-- Sticky TOC + Content Layout -->
        <div class="max-w-6xl mx-auto px-5 md:px-10 py-14 lg:py-20">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">

                <!-- Sticky Table of Contents -->
                <aside class="lg:sticky lg:top-28 lg:w-64 xl:w-72 flex-shrink-0 w-full">
                    <div class="rounded-2xl border border-bes-sage/20 bg-white/70 backdrop-blur-sm p-6 shadow-sm">
                        <p class="font-display text-[11px] uppercase tracking-[0.2em] text-bes-bark/50 font-medium mb-4">Contents</p>
                        <nav class="space-y-1">
                            <?php
                            $toc = [
                                ['id' => 'overview',     'label' => 'Overview'],
                                ['id' => 'data-collect', 'label' => 'Data We Collect'],
                                ['id' => 'how-we-use',   'label' => 'How We Use Data'],
                                ['id' => 'sharing',      'label' => 'Sharing & Disclosure'],
                                ['id' => 'cookies',      'label' => 'Cookies & Tracking'],
                                ['id' => 'retention',    'label' => 'Data Retention'],
                                ['id' => 'your-rights',  'label' => 'Your Rights'],
                                ['id' => 'security',     'label' => 'Security'],
                                ['id' => 'children',     'label' => 'Children\'s Privacy'],
                                ['id' => 'international','label' => 'International Transfers'],
                                ['id' => 'updates',      'label' => 'Policy Updates'],
                                ['id' => 'contact',      'label' => 'Contact Us'],
                            ];
                            foreach ($toc as $t): ?>
                            <a href="#<?php echo esc_attr($t['id']); ?>"
                               class="flex items-center gap-2.5 text-[12px] font-body text-bes-bark-muted hover:!text-bes-olive transition-colors py-1.5 px-2 rounded-lg hover:bg-bes-leaf/5 group">
                                <span class="w-1 h-1 rounded-full bg-bes-sage/30 group-hover:bg-bes-leaf transition-colors flex-shrink-0"></span>
                                <?php echo esc_html($t['label']); ?>
                            </a>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 min-w-0 space-y-14">

                    <!-- Section: Overview -->
                    <section id="overview" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-circle-info text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Overview</h2>
                        </div>
                        <div class="prose prose-sm max-w-none font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>Bali Eling Spirit (referred to herein as "we," "us," or "our"), operating from Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552, Indonesia, is committed to protecting the privacy and personal data of all guests, retreat participants, yoga teacher training students, and website visitors ("you" or "your").</p>
                            <p>This Privacy Policy explains how we collect, use, store, disclose, and protect your personal information when you interact with our website at <strong>balielingspirit.com</strong>, book any of our programs, or communicate with us via any channel including email, WhatsApp, telephone, or social media platforms.</p>
                            <div class="rounded-xl bg-bes-leaf/6 border border-bes-leaf/15 p-5">
                                <p class="text-[13px] text-bes-bark font-medium flex items-start gap-2.5">
                                    <i class="fa-solid fa-leaf text-bes-leaf mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <span>By using our website or enrolling in any of our programs, you acknowledge and agree to the practices described in this Privacy Policy. If you do not agree, please discontinue use of our services and contact us to request deletion of any data already provided.</span>
                                </p>
                            </div>
                            <p>This policy is governed by the laws of the Republic of Indonesia, including <strong>Law No. 27 of 2022 on Personal Data Protection (UU PDP)</strong>, and where applicable, the European Union's General Data Protection Regulation (GDPR) for guests residing in the EU/EEA.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Data We Collect -->
                    <section id="data-collect" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-database text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Data We Collect</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-6">
                            <p>We collect personal data only to the extent necessary to provide our services, ensure your safety during retreats, and improve your experience with us. We collect data in the following categories:</p>

                            <div class="grid gap-4">
                                <?php
                                $data_types = [
                                    [
                                        'icon'  => 'fa-user',
                                        'title' => 'Identity & Contact Information',
                                        'items' => ['Full name and preferred name', 'Email address', 'Phone/WhatsApp number', 'Nationality and passport/ID details (required for retreat check-in under Indonesian law)', 'Emergency contact details'],
                                    ],
                                    [
                                        'icon'  => 'fa-heart-pulse',
                                        'title' => 'Health & Wellbeing Data (Special Category)',
                                        'items' => ['Medical history, conditions, and medications relevant to yoga or healing practices', 'Dietary requirements and allergies', 'Physical injuries or limitations', 'Mental health history where voluntarily disclosed', 'Yoga and meditation experience level'],
                                    ],
                                    [
                                        'icon'  => 'fa-credit-card',
                                        'title' => 'Booking & Financial Information',
                                        'items' => ['Program selections, dates, and accommodation preferences', 'Payment transaction references and receipts (we do not store full card numbers)', 'Bank transfer details for verification', 'Deposit and refund records'],
                                    ],
                                    [
                                        'icon'  => 'fa-globe',
                                        'title' => 'Technical & Usage Data',
                                        'items' => ['IP address and approximate geolocation', 'Browser type, device, and operating system', 'Pages visited, time spent, and click behaviour', 'Referral source (how you found our website)', 'Cookies and session identifiers'],
                                    ],
                                    [
                                        'icon'  => 'fa-comments',
                                        'title' => 'Communication Data',
                                        'items' => ['Content of emails, WhatsApp messages, and inquiry forms', 'Social media interactions (e.g., Instagram DMs, Facebook messages)', 'Testimonials and reviews (with your explicit consent)', 'Feedback and programme evaluation forms'],
                                    ],
                                ];
                                foreach ($data_types as $dt): ?>
                                <div class="rounded-xl border border-bes-sage/15 bg-white/50 p-5">
                                    <h3 class="font-display text-lg font-medium text-bes-bark mb-3 flex items-center gap-2.5">
                                        <i class="fa-solid <?php echo esc_attr($dt['icon']); ?> text-bes-leaf/70 text-sm" aria-hidden="true"></i>
                                        <?php echo esc_html($dt['title']); ?>
                                    </h3>
                                    <ul class="space-y-1.5">
                                        <?php foreach ($dt['items'] as $item): ?>
                                        <li class="flex items-start gap-2 text-[13px] text-bes-bark-muted">
                                            <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                            <?php echo esc_html($item); ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <p class="text-[13px] text-bes-bark-muted italic">Health and wellbeing data is a <strong class="text-bes-bark not-italic">special category</strong> of personal data under Indonesian Law UU PDP and the EU GDPR. We process this data only with your explicit, informed consent and strictly for the purpose of ensuring your safety during our programs.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: How We Use Data -->
                    <section id="how-we-use" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-gear text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">How We Use Your Data</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>We use your personal data for the following lawful purposes:</p>
                            <div class="space-y-3">
                                <?php
                                $uses = [
                                    ['basis' => 'Contract',          'color' => 'bg-emerald-50 border-emerald-200', 'dot' => 'bg-emerald-400', 'text' => 'Confirming and administering your retreat, yoga teacher training, or wellness program booking.'],
                                    ['basis' => 'Contract',          'color' => 'bg-emerald-50 border-emerald-200', 'dot' => 'bg-emerald-400', 'text' => 'Processing deposits, payments, and issuing receipts or certificates.'],
                                    ['basis' => 'Consent',           'color' => 'bg-blue-50 border-blue-200',   'dot' => 'bg-blue-400',    'text' => 'Sending newsletters, spiritual wisdom content, retreat updates, and promotional offers (you may opt out at any time).'],
                                    ['basis' => 'Consent',           'color' => 'bg-blue-50 border-blue-200',   'dot' => 'bg-blue-400',    'text' => 'Publishing testimonials, photographs, or videos featuring you on our website or social media.'],
                                    ['basis' => 'Legitimate Interest','color' => 'bg-amber-50 border-amber-200', 'dot' => 'bg-amber-400',   'text' => 'Responding to your enquiries promptly and providing customer support via email, WhatsApp, or phone.'],
                                    ['basis' => 'Legitimate Interest','color' => 'bg-amber-50 border-amber-200', 'dot' => 'bg-amber-400',   'text' => 'Improving our website experience through anonymous analytics and performance monitoring.'],
                                    ['basis' => 'Legal Obligation',  'color' => 'bg-red-50 border-red-200',     'dot' => 'bg-red-400',     'text' => 'Maintaining guest records as required by Indonesian immigration and tourism regulations.'],
                                    ['basis' => 'Legal Obligation',  'color' => 'bg-red-50 border-red-200',     'dot' => 'bg-red-400',     'text' => 'Complying with tax, financial reporting, and other statutory requirements under Indonesian law.'],
                                    ['basis' => 'Vital Interests',   'color' => 'bg-purple-50 border-purple-200','dot' => 'bg-purple-400',  'text' => 'Ensuring your safety during programs, including contacting emergency services or your nominated contact if required.'],
                                ];
                                foreach ($uses as $use): ?>
                                <div class="flex items-start gap-3 rounded-xl border <?php echo esc_attr($use['color']); ?> px-4 py-3">
                                    <span class="w-2 h-2 rounded-full <?php echo esc_attr($use['dot']); ?> mt-1.5 flex-shrink-0"></span>
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-0.5"><?php echo esc_html($use['basis']); ?></span>
                                        <p class="text-[13px] text-bes-bark-soft"><?php echo esc_html($use['text']); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Sharing -->
                    <section id="sharing" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-share-nodes text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Sharing &amp; Disclosure</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <div class="rounded-xl bg-bes-forest-deep/5 border border-bes-forest/10 p-5 mb-5">
                                <p class="text-[13px] font-medium text-bes-bark flex items-start gap-2">
                                    <i class="fa-solid fa-lock text-bes-leaf mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <strong>We do not sell, rent, or trade your personal data to any third party for commercial purposes.</strong> Period.
                                </p>
                            </div>
                            <p>We may share your data only in the following limited circumstances, and only with parties who are contractually bound to protect your information:</p>
                            <ul class="space-y-3 mt-2">
                                <?php
                                $sharing = [
                                    ['party' => 'Service Providers',      'desc' => 'Payment processors (e.g., Stripe, bank transfer platforms), email service providers (Mailchimp or equivalent), website hosting and analytics providers. All are bound by data processing agreements.'],
                                    ['party' => 'Yoga Alliance & Affiliates', 'desc' => 'For Yoga Teacher Training graduates, your name and certification details are submitted to Yoga Alliance International or equivalent certifying bodies upon successful completion, with your consent.'],
                                    ['party' => 'Indonesian Authorities', 'desc' => 'Government bodies including immigration (Imigrasi), local tourism boards, or health authorities when required by Indonesian law, court order, or legal obligation.'],
                                    ['party' => 'Emergency Services',     'desc' => 'Police, medical services, or your designated emergency contact in the event of a medical or safety emergency during your stay at our sanctuary.'],
                                    ['party' => 'Business Successors',   'desc' => 'In the event of a merger, acquisition, or sale of our business assets, personal data may be transferred to the successor entity, with notice provided to you.'],
                                ];
                                foreach ($sharing as $s): ?>
                                <li class="flex items-start gap-3 text-[13px]">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                    <div><strong class="text-bes-bark"><?php echo esc_html($s['party']); ?>:</strong> <?php echo esc_html($s['desc']); ?></div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Cookies -->
                    <section id="cookies" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-cookie-bite text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Cookies &amp; Tracking</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>Our website uses cookies and similar tracking technologies to enhance your browsing experience and understand how visitors interact with our content. Here is a breakdown of the cookies we use:</p>
                            <div class="overflow-x-auto rounded-xl border border-bes-sage/20">
                                <table class="w-full text-[12px] md:text-[13px] font-body">
                                    <thead>
                                        <tr class="bg-bes-forest-deep text-white">
                                            <th class="text-left px-4 py-3 font-medium tracking-wide">Type</th>
                                            <th class="text-left px-4 py-3 font-medium tracking-wide">Purpose</th>
                                            <th class="text-left px-4 py-3 font-medium tracking-wide">Duration</th>
                                            <th class="text-left px-4 py-3 font-medium tracking-wide">Opt-Out</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-bes-sage/10">
                                        <tr class="bg-white/50">
                                            <td class="px-4 py-3 font-medium text-bes-bark">Essential</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Session management, security, form functionality</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Session</td>
                                            <td class="px-4 py-3"><span class="text-red-500 text-[11px] font-bold">Not available</span></td>
                                        </tr>
                                        <tr class="bg-bes-parchment/50">
                                            <td class="px-4 py-3 font-medium text-bes-bark">Analytics</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Google Analytics 4 — anonymous usage statistics</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Up to 2 years</td>
                                            <td class="px-4 py-3"><span class="text-bes-leaf text-[11px] font-bold">Opt-out available</span></td>
                                        </tr>
                                        <tr class="bg-white/50">
                                            <td class="px-4 py-3 font-medium text-bes-bark">Marketing</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Meta Pixel, Google Ads — remarketing and conversion tracking</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">90 days</td>
                                            <td class="px-4 py-3"><span class="text-bes-leaf text-[11px] font-bold">Opt-out available</span></td>
                                        </tr>
                                        <tr class="bg-bes-parchment/50">
                                            <td class="px-4 py-3 font-medium text-bes-bark">Preferences</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">Remembering your language and display preferences</td>
                                            <td class="px-4 py-3 text-bes-bark-muted">1 year</td>
                                            <td class="px-4 py-3"><span class="text-bes-leaf text-[11px] font-bold">Opt-out available</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>You may manage your cookie preferences at any time through your browser settings, or via our cookie consent tool. Please note that disabling essential cookies may impair website functionality.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Retention -->
                    <section id="retention" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock-rotate-left text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Data Retention</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>We retain your personal data only for as long as necessary to fulfil the purposes for which it was collected, or as required by Indonesian law. Our general retention schedule is as follows:</p>
                            <ul class="space-y-3">
                                <?php
                                $retention = [
                                    ['type' => 'Booking & financial records', 'period' => '7 years', 'reason' => 'Indonesian tax law (UU Pajak) and financial reporting requirements.'],
                                    ['type' => 'Health & medical disclosures', 'period' => '5 years', 'reason' => 'Safety records and potential insurance or liability purposes.'],
                                    ['type' => 'YTT certification records',    'period' => 'Indefinitely', 'reason' => 'Alumni records and certificate verification on request.'],
                                    ['type' => 'Marketing communications',     'period' => 'Until opt-out', 'reason' => 'Removed within 10 business days of an unsubscribe request.'],
                                    ['type' => 'Website analytics data',       'period' => '26 months', 'reason' => 'Standard Google Analytics retention window.'],
                                    ['type' => 'General inquiries & email',    'period' => '3 years', 'reason' => 'Customer service history and potential dispute resolution.'],
                                ];
                                foreach ($retention as $r): ?>
                                <li class="flex items-start gap-3 text-[13px] rounded-xl border border-bes-sage/15 bg-white/40 px-4 py-3">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                    <div class="flex-1 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4">
                                        <span class="font-medium text-bes-bark sm:w-48 flex-shrink-0"><?php echo esc_html($r['type']); ?></span>
                                        <div class="flex items-start gap-2">
                                            <span class="inline-block px-2 py-0.5 rounded-md bg-bes-leaf/10 text-bes-olive text-[11px] font-bold flex-shrink-0"><?php echo esc_html($r['period']); ?></span>
                                            <span class="text-bes-bark-muted"><?php echo esc_html($r['reason']); ?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <p>After the applicable retention period, data is securely deleted or anonymised.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Your Rights -->
                    <section id="your-rights" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-scale-balanced text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Your Rights</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>Under Indonesian UU PDP and, where applicable, the EU GDPR, you have the following rights regarding your personal data. To exercise any right, contact us at <a href="mailto:info@balielingspirit.com" class="text-bes-olive underline underline-offset-2 hover:!text-bes-olive-dark transition-colors">info@balielingspirit.com</a>. We will respond within <strong class="text-bes-bark">30 days</strong>.</p>
                            <div class="grid sm:grid-cols-2 gap-3">
                                <?php
                                $rights = [
                                    ['icon' => 'fa-eye',           'title' => 'Right to Access',       'desc' => 'Request a copy of the personal data we hold about you.'],
                                    ['icon' => 'fa-pen-to-square', 'title' => 'Right to Rectify',      'desc' => 'Correct inaccurate or incomplete personal data.'],
                                    ['icon' => 'fa-trash-can',     'title' => 'Right to Erasure',      'desc' => 'Request deletion of your data where no legal obligation requires its retention.'],
                                    ['icon' => 'fa-hand',          'title' => 'Right to Object',       'desc' => 'Object to processing based on legitimate interests or for direct marketing.'],
                                    ['icon' => 'fa-pause',         'title' => 'Right to Restrict',     'desc' => 'Request restriction of processing while a dispute is resolved.'],
                                    ['icon' => 'fa-file-export',   'title' => 'Right to Portability',  'desc' => 'Receive your data in a machine-readable format (EU GDPR, where applicable).'],
                                    ['icon' => 'fa-rotate-left',   'title' => 'Right to Withdraw Consent', 'desc' => 'Withdraw consent at any time for processing based on consent.'],
                                    ['icon' => 'fa-flag',          'title' => 'Right to Complain',     'desc' => 'Lodge a complaint with Indonesia\'s BSSN or relevant EU supervisory authority.'],
                                ];
                                foreach ($rights as $r): ?>
                                <div class="rounded-xl border border-bes-sage/15 bg-white/40 p-4 flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid <?php echo esc_attr($r['icon']); ?> text-bes-leaf text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <p class="font-display text-[15px] font-medium text-bes-bark mb-0.5"><?php echo esc_html($r['title']); ?></p>
                                        <p class="text-[12px] text-bes-bark-muted"><?php echo esc_html($r['desc']); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Security -->
                    <section id="security" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-lock text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Security</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>We implement industry-standard technical and organisational security measures to protect your personal data against unauthorised access, loss, destruction, or alteration. These include:</p>
                            <ul class="space-y-2 text-[13px]">
                                <?php
                                $security = [
                                    'SSL/TLS encryption for all data transmitted via our website (HTTPS)',
                                    'Password-protected and access-controlled internal systems',
                                    'Restricted staff access to personal data on a need-to-know basis',
                                    'Regular security audits and vulnerability assessments of our website',
                                    'Secure deletion protocols for data that reaches end-of-retention',
                                    'Third-party service providers vetted for their own security certifications (e.g., PCI-DSS for payment processors)',
                                ];
                                foreach ($security as $s): ?>
                                <li class="flex items-start gap-2 text-bes-bark-muted">
                                    <i class="fa-solid fa-check text-bes-leaf mt-1 flex-shrink-0 text-[10px]" aria-hidden="true"></i>
                                    <?php echo esc_html($s); ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <p>Despite our best efforts, no method of internet transmission or electronic storage is 100% secure. In the event of a data breach that poses a risk to your rights and freedoms, we will notify you and the relevant Indonesian authority (BSSN) within 72 hours as required by UU PDP.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Children -->
                    <section id="children" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-child text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Children's Privacy</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>Our retreat programs and yoga teacher trainings are designed for adults aged 18 and over. We do not knowingly collect personal data from individuals under the age of 18 without verified parental or guardian consent.</p>
                            <p>If you are a parent or guardian and believe your child under 18 has submitted personal data to us, please contact us immediately at <a href="mailto:info@balielingspirit.com" class="text-bes-olive underline underline-offset-2 hover:!text-bes-olive-dark transition-colors">info@balielingspirit.com</a> and we will promptly delete such information.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: International Transfers -->
                    <section id="international" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-earth-asia text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">International Data Transfers</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>As a globally-attended sanctuary, your personal data may be processed by service providers located outside Indonesia (e.g., cloud hosting servers in Singapore or the EU, Yoga Alliance in the United States).</p>
                            <p>Where we transfer personal data internationally, we ensure appropriate safeguards are in place, including:</p>
                            <ul class="space-y-2 text-[13px]">
                                <li class="flex items-start gap-2 text-bes-bark-muted">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                    Standard contractual clauses approved by relevant data protection authorities (for EU data subjects)
                                </li>
                                <li class="flex items-start gap-2 text-bes-bark-muted">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                    Transfers only to countries or organisations with adequate data protection standards as assessed by Indonesia's BSSN or EU Commission
                                </li>
                                <li class="flex items-start gap-2 text-bes-bark-muted">
                                    <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                    Your explicit consent where required
                                </li>
                            </ul>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Updates -->
                    <section id="updates" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-rotate text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Policy Updates</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>We may update this Privacy Policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors. Material changes will be communicated via a notice on our website homepage and, where applicable, via email to registered guests and students.</p>
                            <p>We encourage you to review this page periodically. The "Last Updated" date at the top of this policy indicates when the most recent revision was made. Continued use of our website or services after any update constitutes your acknowledgement of the revised policy.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- Section: Contact -->
                    <section id="contact" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-leaf/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-envelope text-bes-leaf text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">Contact Us</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4">
                            <p>For any questions, requests, or concerns regarding this Privacy Policy or our data practices, please reach out to our Data Controller:</p>
                            <div class="rounded-2xl border border-bes-sage/20 bg-white/60 p-6 space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-building text-bes-leaf/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <div class="text-[13px]">
                                        <p class="font-medium text-bes-bark">Bali Eling Spirit (Pasraman Bali Eling Spirit)</p>
                                        <p class="text-bes-bark-muted">Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552, Indonesia</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-envelope text-bes-leaf/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <a href="mailto:info@balielingspirit.com" class="text-[13px] text-bes-olive hover:!text-bes-olive-dark transition-colors">info@balielingspirit.com</a>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-brands fa-whatsapp text-bes-leaf/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener" class="text-[13px] text-bes-olive hover:!text-bes-olive-dark transition-colors">+62 812 2888 8873</a>
                                </div>
                            </div>
                            <p class="text-[12px] text-bes-bark-muted italic">We aim to respond to all privacy-related requests within 30 days of receipt. For urgent data breach notifications, please mark your email subject: <strong class="text-bes-bark not-italic">URGENT – Data Privacy</strong>.</p>
                        </div>
                    </section>

                </main>
            </div>
        </div>

    </div><!-- /bes-privacy-policy -->

    <?php
    return ob_get_clean();
}