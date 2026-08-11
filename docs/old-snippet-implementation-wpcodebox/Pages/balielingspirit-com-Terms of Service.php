<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Shortcode: Terms of Service
 * ============================================================================
 *
 * USAGE: [bes_terms_of_service]
 *
 * Uses BES v3 design tokens (colors, typography, Tailwind classes).
 * No additional CSS needed — all handled via existing bes_global_head().
 *
 * @package BaliElingSpirit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_terms_of_service', 'bes_terms_of_service_shortcode' );

function bes_terms_of_service_shortcode( $atts ) {
    $last_updated = 'February 26, 2026';
    ob_start();
    ?>

    <!-- ====== BES Terms of Service Page ====== -->
    <div data-bes-header="dark" class="min-h-screen bg-bes-parchment">

        <!-- Hero Banner -->
        <div class="relative bg-bes-forest-deep overflow-hidden">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] pointer-events-none"
                 style="background:radial-gradient(ellipse,rgba(201,168,76,0.07),transparent 70%)"></div>
            <div class="absolute bottom-0 left-0 right-0 h-8 opacity-10"
                 style="background:repeating-linear-gradient(90deg,transparent 0px,transparent 18px,rgba(194,210,74,.5) 18px,rgba(194,210,74,.5) 19px,transparent 19px,transparent 37px)"></div>

            <div class="relative max-w-4xl mx-auto px-6 md:px-10 py-20 md:py-28 text-center">
                <div class="inline-flex items-center gap-2 mb-5 px-4 py-1.5 rounded-full bg-bes-gold/10 border border-bes-gold/20">
                    <i class="fa-solid fa-file-contract text-bes-gold text-xs" aria-hidden="true"></i>
                    <span class="text-bes-gold text-[10px] font-body font-bold uppercase tracking-[0.2em]">Legal Document</span>
                </div>
                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-medium text-white mb-4 tracking-display">
                    Terms of Service
                </h1>
                <p class="font-body text-white/40 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                    Please read these terms carefully before booking any program or using our website.
                </p>
                <div class="mt-8 inline-flex items-center gap-2 text-white/25 text-xs font-body">
                    <i class="fa-regular fa-calendar text-bes-gold/40" aria-hidden="true"></i>
                    Last updated: <?php echo esc_html($last_updated); ?>
                </div>
            </div>
        </div>

        <!-- Acceptance Banner -->
        <div class="bg-bes-olive-dark/10 border-b border-bes-sage/20">
            <div class="max-w-6xl mx-auto px-5 md:px-10 py-4">
                <p class="text-[12px] text-bes-bark-soft font-body text-center">
                    <i class="fa-solid fa-circle-check text-bes-leaf mr-1.5" aria-hidden="true"></i>
                    By booking any program or using this website, you agree to be bound by these Terms of Service and our <a href="/privacy-policy" class="text-bes-olive underline underline-offset-2">Privacy Policy</a>.
                </p>
            </div>
        </div>

        <!-- TOC + Content Layout -->
        <div class="max-w-6xl mx-auto px-5 md:px-10 py-14 lg:py-20">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">

                <!-- Sticky TOC -->
                <aside class="lg:sticky lg:top-28 lg:w-64 xl:w-72 flex-shrink-0 w-full">
                    <div class="rounded-2xl border border-bes-sage/20 bg-white/70 backdrop-blur-sm p-6 shadow-sm">
                        <p class="font-display text-[11px] uppercase tracking-[0.2em] text-bes-bark/50 font-medium mb-4">Contents</p>
                        <nav class="space-y-1">
                            <?php
                            $toc = [
                                ['id' => 'acceptance',   'label' => 'Acceptance of Terms'],
                                ['id' => 'services',     'label' => 'Our Services'],
                                ['id' => 'booking',      'label' => 'Bookings & Payments'],
                                ['id' => 'cancellation', 'label' => 'Cancellation & Refunds'],
                                ['id' => 'conduct',      'label' => 'Participant Conduct'],
                                ['id' => 'health',       'label' => 'Health & Safety'],
                                ['id' => 'ytt',          'label' => 'Yoga Teacher Training'],
                                ['id' => 'ip',           'label' => 'Intellectual Property'],
                                ['id' => 'liability',    'label' => 'Limitation of Liability'],
                                ['id' => 'indemnity',    'label' => 'Indemnification'],
                                ['id' => 'photography',  'label' => 'Photography & Media'],
                                ['id' => 'force',        'label' => 'Force Majeure'],
                                ['id' => 'governing',    'label' => 'Governing Law'],
                                ['id' => 'contact-tos',  'label' => 'Contact'],
                            ];
                            foreach ($toc as $t): ?>
                            <a href="#<?php echo esc_attr($t['id']); ?>"
                               class="flex items-center gap-2.5 text-[12px] font-body text-bes-bark-muted hover:!text-bes-olive transition-colors py-1.5 px-2 rounded-lg hover:bg-bes-gold/5 group">
                                <span class="w-1 h-1 rounded-full bg-bes-sage/30 group-hover:bg-bes-gold transition-colors flex-shrink-0"></span>
                                <?php echo esc_html($t['label']); ?>
                            </a>
                            <?php endforeach; ?>
                        </nav>
                    </div>

                    <!-- Download prompt -->
                    <div class="mt-4 rounded-xl border border-bes-sage/15 bg-white/50 p-4 text-center">
                        <p class="text-[11px] text-bes-bark-muted mb-2 font-body">Need a copy for your records?</p>
                        <button onclick="window.print()" class="inline-flex items-center gap-1.5 text-[11px] font-bold text-bes-olive hover:!text-bes-olive-dark transition-colors uppercase tracking-wide">
                            <i class="fa-solid fa-print text-[10px]" aria-hidden="true"></i> Print / Save as PDF
                        </button>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 min-w-0 space-y-14">

                    <!-- 1. Acceptance -->
                    <section id="acceptance" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-handshake text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">1. Acceptance of Terms</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>These Terms of Service ("Terms") constitute a legally binding agreement between you ("Guest," "Student," or "Participant") and <strong class="text-bes-bark">Bali Eling Spirit / Pasraman Bali Eling Spirit</strong>, a spiritual wellness sanctuary located at Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552, Indonesia.</p>
                            <p>By: (a) accessing or using our website at <strong class="text-bes-bark">balielingspirit.com</strong>, (b) submitting a booking inquiry or deposit payment, or (c) participating in any retreat, yoga teacher training, workshop, or wellness program we offer — you expressly acknowledge that you have read, understood, and agree to be bound by these Terms in their entirety.</p>
                            <p>If you do not agree to any part of these Terms, please do not proceed with a booking or use our website. You may contact us at <a href="mailto:info@balielingspirit.com" class="text-bes-olive underline underline-offset-2">info@balielingspirit.com</a> to discuss your concerns before committing.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 2. Services -->
                    <section id="services" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-spa text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">2. Our Services</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>Bali Eling Spirit offers the following categories of programs and services:</p>
                            <div class="grid sm:grid-cols-2 gap-3">
                                <?php
                                $services = [
                                    ['icon' => 'fa-person-praying', 'title' => 'Healing Retreats', 'desc' => 'Immersive Balinese spiritual healing experiences including traditional ceremony, energy work, and meditation.'],
                                    ['icon' => 'fa-certificate',    'title' => 'Yoga Teacher Training', 'desc' => '200-hour and 300-hour Yoga Alliance-registered YTT programs in the Balinese Hindu Dharma tradition.'],
                                    ['icon' => 'fa-sun',            'title' => 'Signature Programs', 'desc' => 'Eling Tapa Brata, Sacred Morning Awakening, Karma Retreat, Punarbawa, Atma Retreat, 7-Chakra Purification, and Surya Namaskar.'],
                                    ['icon' => 'fa-house',          'title' => 'Accommodation', 'desc' => 'On-site accommodation is included in most programs. Details are provided in individual program descriptions.'],
                                    ['icon' => 'fa-utensils',       'title' => 'Meals & Ceremonial Offerings', 'desc' => 'Traditional Balinese vegetarian and vegan meals are included in retreat packages unless otherwise stated.'],
                                    ['icon' => 'fa-hands',          'title' => 'Day Programs & Workshops', 'desc' => 'Single-day or short-format workshops open to non-residential participants, subject to availability.'],
                                ];
                                foreach ($services as $s): ?>
                                <div class="rounded-xl border border-bes-sage/15 bg-white/40 p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid <?php echo esc_attr($s['icon']); ?> text-bes-gold/70 text-[11px]" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <p class="font-display text-[15px] font-medium text-bes-bark mb-1"><?php echo esc_html($s['title']); ?></p>
                                            <p class="text-[12px] text-bes-bark-muted leading-relaxed"><?php echo esc_html($s['desc']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <p>We reserve the right to modify, discontinue, or substitute any program or service with reasonable notice. Program descriptions on our website are subject to change; the version in effect at the time of your booking confirmation shall apply.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 3. Bookings & Payments -->
                    <section id="booking" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-credit-card text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">3. Bookings &amp; Payments</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-5 text-[14px]">

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">3.1 Booking Process</h3>
                                <p>All bookings must be made through our official channels: our website contact/inquiry form, WhatsApp (+62 812 2888 8873), or email (info@balielingspirit.com). A booking is only confirmed upon receipt of a written confirmation email from Bali Eling Spirit and payment of the applicable deposit.</p>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">3.2 Deposit Requirements</h3>
                                <p>A non-refundable deposit is required to secure your place in any program. Deposit amounts vary by program:</p>
                                <div class="mt-3 rounded-xl border border-bes-sage/20 overflow-hidden">
                                    <table class="w-full text-[12px] md:text-[13px] font-body">
                                        <thead>
                                            <tr class="bg-bes-olive text-white">
                                                <th class="text-left px-4 py-3 font-medium">Program Type</th>
                                                <th class="text-left px-4 py-3 font-medium">Deposit Required</th>
                                                <th class="text-left px-4 py-3 font-medium">Balance Due</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-bes-sage/10">
                                            <tr class="bg-white/50">
                                                <td class="px-4 py-3 text-bes-bark font-medium">200-hr / 300-hr YTT</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">USD $500 or 30% (whichever greater)</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">30 days before program start</td>
                                            </tr>
                                            <tr class="bg-bes-parchment/50">
                                                <td class="px-4 py-3 text-bes-bark font-medium">Multi-Week Retreats</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">USD $300 or 30%</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">30 days before start</td>
                                            </tr>
                                            <tr class="bg-white/50">
                                                <td class="px-4 py-3 text-bes-bark font-medium">Short Retreats (1–6 nights)</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">USD $150 or 50%</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">14 days before start</td>
                                            </tr>
                                            <tr class="bg-bes-parchment/50">
                                                <td class="px-4 py-3 text-bes-bark font-medium">Day Programs</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">100% at time of booking</td>
                                                <td class="px-4 py-3 text-bes-bark-muted">—</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">3.3 Payment Methods &amp; Currency</h3>
                                <p>We accept payment by international bank transfer (USD, EUR, AUD, SGD), credit/debit card via our payment gateway, and Indonesian bank transfer (IDR). All program prices on our website are quoted in US Dollars (USD) unless otherwise stated. Currency conversion rates are applied at the time of payment and are subject to your bank's or payment processor's fees, which are borne by you.</p>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">3.4 Pricing &amp; Tax</h3>
                                <p>All prices are inclusive of applicable Indonesian Value Added Tax (PPN) unless explicitly stated otherwise. Prices displayed on the website are subject to change without prior notice. The price confirmed at the time of your deposit payment is locked for your booking, provided balance payment is received by the due date.</p>
                            </div>

                            <div class="rounded-xl bg-amber-50 border border-amber-200 p-4">
                                <p class="text-[13px] text-amber-800 flex items-start gap-2.5">
                                    <i class="fa-solid fa-triangle-exclamation text-amber-500 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <span><strong>Important:</strong> Failure to pay the remaining balance by the due date may result in automatic cancellation of your booking and forfeiture of your deposit. We will attempt to contact you before cancelling.</span>
                                </p>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 4. Cancellation & Refunds -->
                    <section id="cancellation" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-rotate-left text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">4. Cancellation &amp; Refunds</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-5 text-[14px]">

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-3">4.1 Cancellation by Participant</h3>
                                <p class="mb-3">All cancellation requests must be submitted in writing via email to <a href="mailto:info@balielingspirit.com" class="text-bes-olive underline underline-offset-2">info@balielingspirit.com</a>. The following refund schedule applies, calculated from the date we receive your written cancellation request:</p>
                                <div class="rounded-xl border border-bes-sage/20 overflow-hidden">
                                    <table class="w-full text-[12px] md:text-[13px] font-body">
                                        <thead>
                                            <tr class="bg-bes-forest-deep text-white">
                                                <th class="text-left px-4 py-3 font-medium">Notice Period</th>
                                                <th class="text-left px-4 py-3 font-medium">Refund (excl. deposit)</th>
                                                <th class="text-left px-4 py-3 font-medium">Credit Transfer</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-bes-sage/10">
                                            <tr class="bg-white/50">
                                                <td class="px-4 py-3 font-medium text-bes-bark">60+ days before start</td>
                                                <td class="px-4 py-3"><span class="text-emerald-600 font-bold">90% refund</span></td>
                                                <td class="px-4 py-3 text-bes-bark-muted">Available</td>
                                            </tr>
                                            <tr class="bg-bes-parchment/50">
                                                <td class="px-4 py-3 font-medium text-bes-bark">30–59 days before start</td>
                                                <td class="px-4 py-3"><span class="text-amber-600 font-bold">50% refund</span></td>
                                                <td class="px-4 py-3 text-bes-bark-muted">Available</td>
                                            </tr>
                                            <tr class="bg-white/50">
                                                <td class="px-4 py-3 font-medium text-bes-bark">14–29 days before start</td>
                                                <td class="px-4 py-3"><span class="text-orange-600 font-bold">25% refund</span></td>
                                                <td class="px-4 py-3 text-bes-bark-muted">Available</td>
                                            </tr>
                                            <tr class="bg-bes-parchment/50">
                                                <td class="px-4 py-3 font-medium text-bes-bark">Less than 14 days</td>
                                                <td class="px-4 py-3"><span class="text-red-600 font-bold">No refund</span></td>
                                                <td class="px-4 py-3 text-bes-bark-muted">Subject to availability</td>
                                            </tr>
                                            <tr class="bg-white/50">
                                                <td class="px-4 py-3 font-medium text-bes-bark">Deposit (all cases)</td>
                                                <td class="px-4 py-3"><span class="text-red-600 font-bold">Non-refundable</span></td>
                                                <td class="px-4 py-3 text-bes-bark-muted">—</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">4.2 Credit Transfer (Deferral)</h3>
                                <p>Where indicated above, you may request to transfer your booking credit to a future program date (within 18 months of the original program date). Credit transfers are subject to availability of your chosen future program and a credit transfer administration fee of USD $75. Credits are non-transferable to third parties.</p>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">4.3 Cancellation by Bali Eling Spirit</h3>
                                <p>We reserve the right to cancel any program due to insufficient enrolment, unforeseen circumstances (including natural disasters, government directives, or facility issues), or any reason beyond our reasonable control. In such cases, you will be offered:</p>
                                <ul class="mt-2 space-y-1.5">
                                    <li class="flex items-start gap-2 text-[13px] text-bes-bark-muted">
                                        <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                        A full refund of all amounts paid (including deposit), or
                                    </li>
                                    <li class="flex items-start gap-2 text-[13px] text-bes-bark-muted">
                                        <span class="w-1 h-1 rounded-full bg-bes-leaf/50 mt-2 flex-shrink-0"></span>
                                        Transfer of your full payment to a future program of equal value at no additional charge.
                                    </li>
                                </ul>
                                <p class="mt-2 text-[13px]">We are not liable for any costs incurred by you as a result of our cancellation, including flights, visas, accommodation outside our sanctuary, or travel insurance.</p>
                            </div>

                            <div>
                                <h3 class="font-display text-lg font-medium text-bes-bark mb-2">4.4 Early Departure</h3>
                                <p>If you choose to leave a program early for any reason, no refund will be issued for unused program days. We strongly encourage you to obtain comprehensive travel insurance covering trip interruption.</p>
                            </div>

                            <div class="rounded-xl bg-bes-leaf/6 border border-bes-leaf/15 p-4">
                                <p class="text-[13px] text-bes-bark flex items-start gap-2">
                                    <i class="fa-solid fa-umbrella text-bes-leaf mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <span><strong>Travel Insurance:</strong> We strongly recommend all participants obtain comprehensive travel insurance covering cancellation, medical emergencies, evacuation, and personal liability before booking any program with us. This is a condition of participation for YTT programs.</span>
                                </p>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 5. Participant Conduct -->
                    <section id="conduct" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-person text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">5. Participant Conduct &amp; Sanctuary Guidelines</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>Bali Eling Spirit is a sacred spiritual sanctuary. We are committed to maintaining an environment of respect, safety, and spiritual integrity for all participants, staff, and the surrounding Balinese community. As a participant, you agree to:</p>
                            <div class="grid sm:grid-cols-2 gap-3">
                                <?php
                                $conduct_do = [
                                    'Respect the sacred nature of all ceremonies, teachings, and spaces within the sanctuary',
                                    'Treat all participants, teachers, staff, and community members with kindness and dignity',
                                    'Honour the Balinese Hindu traditions and cultural sensitivities of our locale',
                                    'Follow the daily schedule and program structure as directed by your teacher or retreat leader',
                                    'Maintain silence during designated quiet periods, meditation sessions, and ceremonies',
                                    'Dress modestly and appropriately for a spiritual environment (covered shoulders and knees in ceremonial spaces)',
                                    'Report any safety concerns, accidents, or medical symptoms to staff immediately',
                                    'Respect the boundaries of sacred areas and private spaces on the property',
                                ];
                                $conduct_dont = [
                                    'Consume alcohol, recreational drugs, or non-prescribed substances on our premises or during any program',
                                    'Smoke anywhere except designated outdoor areas',
                                    'Engage in any sexual behaviour with other participants or staff during the program',
                                    'Use mobile phones, laptops, or electronic devices during yoga sessions, meditations, or ceremonies',
                                    'Record teachers, ceremonies, or fellow participants without explicit written consent',
                                    'Engage in verbal or physical aggression, harassment, or discriminatory behaviour of any kind',
                                    'Remove or damage any property belonging to the sanctuary, Balinese temples, or community',
                                    'Bring weapons, illegal substances, or hazardous materials onto the property',
                                ];
                                ?>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                                    <p class="font-display text-[13px] font-medium text-emerald-800 mb-3 flex items-center gap-2">
                                        <i class="fa-solid fa-check-circle text-emerald-500" aria-hidden="true"></i> You agree to:
                                    </p>
                                    <ul class="space-y-2">
                                        <?php foreach ($conduct_do as $item): ?>
                                        <li class="flex items-start gap-2 text-[12px] text-emerald-800">
                                            <i class="fa-solid fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]" aria-hidden="true"></i>
                                            <?php echo esc_html($item); ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                                    <p class="font-display text-[13px] font-medium text-red-800 mb-3 flex items-center gap-2">
                                        <i class="fa-solid fa-ban text-red-500" aria-hidden="true"></i> You must not:
                                    </p>
                                    <ul class="space-y-2">
                                        <?php foreach ($conduct_dont as $item): ?>
                                        <li class="flex items-start gap-2 text-[12px] text-red-800">
                                            <i class="fa-solid fa-xmark text-red-500 mt-0.5 flex-shrink-0 text-[10px]" aria-hidden="true"></i>
                                            <?php echo esc_html($item); ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="rounded-xl bg-bes-forest-deep/5 border border-bes-forest/10 p-4">
                                <p class="text-[13px] text-bes-bark flex items-start gap-2">
                                    <i class="fa-solid fa-gavel text-bes-olive mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                                    <span><strong>Removal from Program:</strong> Bali Eling Spirit reserves the right to remove any participant who violates these conduct guidelines, engages in disruptive or unsafe behaviour, or creates a hostile environment for others. In such cases, no refund will be provided, and the participant may be required to vacate accommodation immediately at their own expense.</span>
                                </p>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 6. Health & Safety -->
                    <section id="health" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-heart-pulse text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">6. Health &amp; Safety</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>Your safety and wellbeing are our highest priority. To participate in any of our programs, you agree to the following health and safety conditions:</p>
                            <ul class="space-y-3">
                                <?php
                                $health = [
                                    '<strong class="text-bes-bark">Full health disclosure:</strong> You must disclose all pre-existing medical conditions, injuries, medications, and mental health history that may affect your ability to safely participate in yoga, meditation, or energy healing practices on your registration form. Failure to disclose may result in your exclusion from specific activities.',
                                    '<strong class="text-bes-bark">Medical fitness:</strong> By participating, you confirm that you are physically and mentally fit to engage in the activities offered by the program you have enrolled in. If in doubt, consult your physician before booking.',
                                    '<strong class="text-bes-bark">Assumption of risk:</strong> Yoga, meditation, and energy healing practices involve inherent physical and emotional risk. You voluntarily assume all risks associated with participation, including but not limited to muscle strains, falls, emotional release, or spiritual experiences.',
                                    '<strong class="text-bes-bark">Pregnancy:</strong> Pregnant participants must inform us at the time of booking. Certain programs and practices may not be appropriate during pregnancy. Our teachers will provide safe modifications, but final participation responsibility rests with you and your healthcare provider.',
                                    '<strong class="text-bes-bark">Emergency protocols:</strong> You agree to follow all emergency protocols and instructions given by Bali Eling Spirit staff in the event of any safety or medical incident.',
                                    '<strong class="text-bes-bark">Infectious illness:</strong> You agree not to attend if you are experiencing symptoms of any contagious illness. If symptoms develop during the program, you must inform staff immediately and may be required to isolate.',
                                ];
                                foreach ($health as $h): ?>
                                <li class="flex items-start gap-2 text-[13px] text-bes-bark-muted">
                                    <span class="w-1 h-1 rounded-full bg-bes-gold/60 mt-2 flex-shrink-0"></span>
                                    <span><?php echo $h; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 7. YTT Specific -->
                    <section id="ytt" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-certificate text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">7. Yoga Teacher Training Terms</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>In addition to the general Terms above, the following specific conditions apply to all 200-hour and 300-hour Yoga Teacher Training (YTT) programs offered by Bali Eling Spirit:</p>
                            <ul class="space-y-3">
                                <?php
                                $ytt = [
                                    ['t' => 'Attendance requirement', 'd' => 'A minimum of 95% attendance is required for certification. Absences must be communicated in advance. Missed sessions may be made up at the teacher\'s discretion with make-up assignments.'],
                                    ['t' => 'Assessment & graduation', 'd' => 'Students must complete all written assessments, practicum teaching sessions, and final examinations to receive their certificate. Students who do not meet requirements may be offered an extended timeline or incomplete certificate.'],
                                    ['t' => 'Certification registration', 'd' => 'Upon graduation, we will submit your certification to Yoga Alliance International. Students are responsible for registering their own RYT membership with Yoga Alliance and paying associated membership fees directly to Yoga Alliance.'],
                                    ['t' => 'Course materials', 'd' => 'All written course materials, manuals, and digital resources provided are for your personal use only. They remain the intellectual property of Bali Eling Spirit and may not be reproduced, shared, or used commercially.'],
                                    ['t' => 'Student behaviour', 'd' => 'YTT students are considered full-time residents for the duration of the training. All sanctuary conduct guidelines apply 24/7. Disciplinary issues may result in removal from the program without refund.'],
                                    ['t' => 'Prerequisites', 'd' => 'The 300-hour YTT requires prior completion of a 200-hour YTT from any Yoga Alliance-registered school. Students must provide evidence of their 200-hour certification prior to program commencement.'],
                                ];
                                foreach ($ytt as $y): ?>
                                <li class="flex items-start gap-3 text-[13px] rounded-xl border border-bes-sage/15 bg-white/40 px-4 py-3">
                                    <span class="w-1 h-1 rounded-full bg-bes-gold/60 mt-2 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-bes-bark"><?php echo esc_html($y['t']); ?>:</strong>
                                        <span class="text-bes-bark-muted ml-1"><?php echo esc_html($y['d']); ?></span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 8. Intellectual Property -->
                    <section id="ip" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-copyright text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">8. Intellectual Property</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>All content on the Bali Eling Spirit website, including but not limited to text, photographs, videos, course materials, logos, graphic designs, and teaching methodologies, is the exclusive intellectual property of Bali Eling Spirit and/or its licensed teachers and contributors, and is protected under Indonesian Copyright Law (UU No. 28 of 2014 on Copyright) and international copyright conventions.</p>
                            <p>You may not reproduce, republish, redistribute, transmit, display, modify, create derivative works from, or otherwise exploit any content from our website or programs without our prior written consent. Limited personal, non-commercial use for reference purposes is permitted.</p>
                            <p>The name <strong class="text-bes-bark">Bali Eling Spirit</strong>, <strong class="text-bes-bark">Pasraman Bali Eling Spirit</strong>, our logo, and associated brand marks are trademarks or protected trade names. Their use without written authorisation is strictly prohibited.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 9. Limitation of Liability -->
                    <section id="liability" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-scale-balanced text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">9. Limitation of Liability</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <div class="rounded-xl bg-amber-50 border border-amber-200 p-5 mb-4">
                                <p class="text-[12px] text-amber-800 font-medium uppercase tracking-wider mb-2">Please read carefully</p>
                                <p class="text-[13px] text-amber-900">To the maximum extent permitted by applicable Indonesian law, Bali Eling Spirit, its directors, teachers, staff, volunteers, and agents shall not be liable for any indirect, incidental, consequential, punitive, or special damages arising out of or in connection with your participation in our programs or use of our website.</p>
                            </div>
                            <p>Specifically, and without limitation, we are not liable for:</p>
                            <ul class="space-y-2 text-[13px]">
                                <?php
                                $liabilities = [
                                    'Personal injury, illness, death, or property damage arising from participation in any yoga, meditation, energy healing, or ceremonial activity, except where caused by our gross negligence',
                                    'Loss or theft of personal property during your stay at our sanctuary',
                                    'Any claims arising from undisclosed medical conditions or contraindicated participation',
                                    'Travel-related costs including flights, visas, accommodation outside our sanctuary, or travel insurance in the event of program cancellation or your inability to attend',
                                    'Actions of third-party service providers, transportation companies, or external venues',
                                    'Content, accuracy, or availability of third-party websites linked from our website',
                                    'Spiritual, emotional, or psychological experiences arising from meditation, breathwork, or ceremonial practices',
                                ];
                                foreach ($liabilities as $l): ?>
                                <li class="flex items-start gap-2 text-bes-bark-muted">
                                    <span class="w-1 h-1 rounded-full bg-bes-gold/50 mt-2 flex-shrink-0"></span>
                                    <?php echo esc_html($l); ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <p>Our total aggregate liability to you for any claims arising under these Terms shall not exceed the total amount paid by you for the specific program giving rise to the claim.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 10. Indemnification -->
                    <section id="indemnity" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-shield-halved text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">10. Indemnification</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>You agree to indemnify, defend, and hold harmless Bali Eling Spirit, its founders, directors, teachers, employees, and agents from and against any and all claims, liabilities, damages, losses, costs, and expenses (including reasonable legal fees) arising out of or in connection with:</p>
                            <ul class="space-y-2 text-[13px]">
                                <li class="flex items-start gap-2 text-bes-bark-muted"><span class="w-1 h-1 rounded-full bg-bes-gold/50 mt-2 flex-shrink-0"></span>Your violation of these Terms or our Sanctuary Guidelines</li>
                                <li class="flex items-start gap-2 text-bes-bark-muted"><span class="w-1 h-1 rounded-full bg-bes-gold/50 mt-2 flex-shrink-0"></span>Your participation in any program while knowingly unfit to do so</li>
                                <li class="flex items-start gap-2 text-bes-bark-muted"><span class="w-1 h-1 rounded-full bg-bes-gold/50 mt-2 flex-shrink-0"></span>Your infringement of any third-party rights, including intellectual property</li>
                                <li class="flex items-start gap-2 text-bes-bark-muted"><span class="w-1 h-1 rounded-full bg-bes-gold/50 mt-2 flex-shrink-0"></span>Any claim brought by a third party resulting from your conduct during a program</li>
                            </ul>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 11. Photography -->
                    <section id="photography" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-camera text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">11. Photography &amp; Media</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>By participating in our programs, you acknowledge that Bali Eling Spirit may capture photographs and video footage during retreat and training activities for use in our marketing materials, website, and social media platforms.</p>
                            <p>If you do not wish to be photographed or filmed, please notify us in writing before your program begins. We will make reasonable efforts to accommodate your request, though we cannot guarantee exclusion from all group photos or venue shots.</p>
                            <p>You grant Bali Eling Spirit a non-exclusive, royalty-free, worldwide licence to use any images or testimonials you voluntarily share with us via social media tags, reviews, or direct submission for promotional purposes, unless you subsequently withdraw that consent in writing.</p>
                            <p>Personal photography and video recording by participants is permitted in designated areas of the sanctuary. Recording of teachers, teachings, ceremonies, or fellow participants without explicit consent is strictly prohibited.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 12. Force Majeure -->
                    <section id="force" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-cloud-bolt text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">12. Force Majeure</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>Bali Eling Spirit shall not be liable for any failure or delay in performing our obligations where such failure or delay results from events beyond our reasonable control, including without limitation: natural disasters (earthquakes, volcanic eruptions, floods, as are particular risks in Bali), pandemics or public health emergencies, government travel advisories or border closures, acts of war or terrorism, power or telecommunications failures, or any other force majeure event.</p>
                            <p>In such circumstances, we will use reasonable efforts to reschedule affected programs and offer participants credits or refunds in accordance with our cancellation policy to the extent practically possible.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 13. Governing Law -->
                    <section id="governing" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-landmark text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">13. Governing Law &amp; Dispute Resolution</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>These Terms of Service are governed by and construed in accordance with the laws of the <strong class="text-bes-bark">Republic of Indonesia</strong>. Any disputes arising from or in connection with these Terms shall be subject to the exclusive jurisdiction of the courts of <strong class="text-bes-bark">Gianyar Regency, Bali, Indonesia</strong>.</p>
                            <p>We encourage all participants to first attempt to resolve any concerns or disputes directly with us through good-faith dialogue. Please contact us at <a href="mailto:info@balielingspirit.com" class="text-bes-olive underline underline-offset-2">info@balielingspirit.com</a> and we will make every effort to find an amicable resolution within 30 days.</p>
                            <p>If resolution cannot be reached, disputes may be referred to mediation under the Indonesian National Board of Mediation (BANI) before pursuing litigation.</p>
                        </div>
                    </section>

                    <div class="h-px bg-gradient-to-r from-transparent via-bes-sage/20 to-transparent"></div>

                    <!-- 14. Contact -->
                    <section id="contact-tos" class="scroll-mt-28">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-bes-gold/10 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-envelope text-bes-gold text-sm" aria-hidden="true"></i>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium text-bes-bark">14. Contact Us</h2>
                        </div>
                        <div class="font-body text-bes-bark-soft leading-relaxed space-y-4 text-[14px]">
                            <p>For any questions regarding these Terms of Service, please contact:</p>
                            <div class="rounded-2xl border border-bes-sage/20 bg-white/60 p-6 space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-building text-bes-gold/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <div class="text-[13px]">
                                        <p class="font-medium text-bes-bark">Bali Eling Spirit (Pasraman Bali Eling Spirit)</p>
                                        <p class="text-bes-bark-muted">Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552, Indonesia</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-envelope text-bes-gold/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <a href="mailto:info@balielingspirit.com" class="text-[13px] text-bes-olive hover:!text-bes-olive-dark transition-colors">info@balielingspirit.com</a>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-bes-forest-deep/5 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-brands fa-whatsapp text-bes-gold/60 text-[11px]" aria-hidden="true"></i>
                                    </div>
                                    <a href="https://wa.me/6281228888873" target="_blank" rel="noopener" class="text-[13px] text-bes-olive hover:!text-bes-olive-dark transition-colors">+62 812 2888 8873</a>
                                </div>
                            </div>
                            <p class="text-[12px] text-bes-bark-muted italic">These Terms were last reviewed and updated on <?php echo esc_html($last_updated); ?>. Bali Eling Spirit reserves the right to amend these Terms at any time. Material amendments will be communicated via our website homepage and email. Continued participation in our programs after any amendment constitutes acceptance of the revised Terms.</p>
                        </div>
                    </section>

                </main>
            </div>
        </div>

    </div><!-- /bes-terms-of-service -->

    <?php
    return ob_get_clean();
}