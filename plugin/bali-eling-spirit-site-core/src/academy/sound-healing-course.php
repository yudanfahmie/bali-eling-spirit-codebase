<?php
/**
 * Production-ready Eling Sound Healing Course landing.
 * Reuses established BES Academy hero, card grids, facts and CTA section rhythm.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'bes_site_core_sound_course_fact' ) ) {
    function bes_site_core_sound_course_fact( $field, $default = null ) {
        return function_exists('bes_site_core_program_fact')
            ? bes_site_core_program_fact('sound-healing',$field,$default)
            : $default;
    }
}

if ( ! function_exists( 'bes_site_core_render_sound_healing_course' ) ) {
    function bes_site_core_render_sound_healing_course( $atts = array() ) {
        $price = bes_site_core_sound_course_fact('price','IDR 3,499K');
        $tax   = bes_site_core_sound_course_fact('tax_behavior','12.5% government tax');

        $receives = array(
            array('icon'=>'fa-solid fa-hands-holding-circle','title'=>'Experienced Guidance','body'=>'Bimbingan dari sound healing practitioners yang berpengalaman.'),
            array('icon'=>'fa-solid fa-bowl-food','title'=>'Hands-on Sacred Instruments','body'=>'Praktik langsung menggunakan Tibetan Singing Bowls dan berbagai sacred sound instruments lainnya.'),
            array('icon'=>'fa-solid fa-wave-square','title'=>'Foundations & Energy Awareness','body'=>'Pemahaman dasar mengenai sound healing, energy awareness, dan vibrational therapy.'),
            array('icon'=>'fa-solid fa-people-group','title'=>'Individual & Group Practice','body'=>'Teknik praktis untuk individual maupun group sound healing sessions.'),
            array('icon'=>'fa-solid fa-certificate','title'=>'Certificate of Completion','body'=>'Certificate of Completion setelah menyelesaikan program.'),
            array('icon'=>'fa-solid fa-leaf','title'=>'Vegetarian Lunch','body'=>'Makan siang vegetarian yang sehat setiap hari selama program.'),
        );
        $explore = array(
            array('title'=>'Sound Healing Foundations','body'=>'Memahami prinsip dan dasar-dasar sound healing.'),
            array('title'=>'Tibetan Singing Bowls','body'=>'Mendapatkan pengalaman praktik langsung menggunakan Tibetan Singing Bowls dan sacred sound instruments lainnya.'),
            array('title'=>'Energy Awareness','body'=>'Mengembangkan awareness terhadap energy dan vibration melalui experiential practice.'),
            array('title'=>'Individual Sessions','body'=>'Mempelajari teknik praktis untuk memfasilitasi sound healing session bagi diri sendiri maupun orang lain.'),
            array('title'=>'Group Sessions','body'=>'Mengenal pendekatan praktis untuk menciptakan sound healing experience dalam setting kelompok.'),
        );
        $for_you = array(
            'Memahami dasar-dasar sound healing.',
            'Mengeksplorasi sound, vibration, dan sacred frequency melalui pengalaman langsung.',
            'Mempelajari penggunaan Tibetan Singing Bowls dan sound instruments lainnya.',
            'Mengembangkan keterampilan praktis untuk individual maupun group sound healing sessions.',
            'Membangun kepercayaan diri untuk memfasilitasi sound healing session bagi diri sendiri maupun orang lain.',
        );

        ob_start(); ?>
        <main class="font-body overflow-hidden">
            <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-sound-course-heading">
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[520px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_58%)]"></div>
                    <div class="absolute bottom-0 right-0 w-[520px] h-[360px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.06),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>
                <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
                <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-5">Bali Eling Spirit Academy</p>
                    <h1 id="bes-sound-course-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-7">Eling Sound Healing Course</h1>
                    <h2 class="bes-reveal font-display font-light italic text-bes-leaf text-3xl md:text-4xl mb-8">Mengenal Kekuatan Transformatif dari Sound</h2>
                    <p class="bes-reveal font-body font-light text-white/55 text-base md:text-lg max-w-3xl mx-auto leading-relaxed mb-10">Mengenal sound, vibration, dan sacred frequency sebagai bagian dari praktik untuk mendukung healing, inner balance, dan kesadaran diri. Berakar pada ancient wisdom dan dipelajari melalui pengalaman langsung, course ini membantu Sahabat membangun pemahaman dan kepercayaan diri untuk memfasilitasi sound healing session bagi diri sendiri maupun orang lain.</p>
                    <a href="#bes-sound-course-overview" class="bes-reveal inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-colors">
                        <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i> Jelajahi Course
                    </a>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section id="bes-sound-course-overview" class="bg-bes-parchment py-20 md:py-28" aria-label="Why sound healing">
                <div class="max-w-[1200px] mx-auto px-6 md:px-10 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                    <div>
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Why Sound Healing?</p>
                        <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-7">Ketika Sound Menjadi Bagian dari Perjalanan Menuju Inner Balance</h2>
                        <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed">Sound bukan hanya sesuatu yang kita dengarkan. Melalui vibration dan frequency, sound dapat menjadi bagian dari praktik untuk mengeksplorasi relaksasi, energy awareness, dan inner balance. Eling Sound Healing Course mengajak Sahabat memahami dasar-dasar sound healing sekaligus mengalami praktiknya secara langsung.</p>
                    </div>
                    <div class="bes-reveal rounded-2xl border border-bes-sand bg-bes-ivory p-8 md:p-10">
                        <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Our Approach</p>
                        <h3 class="font-display font-medium text-bes-bark text-3xl mb-5">Berakar pada Ancient Wisdom.<br>Dipelajari melalui Pengalaman.</h3>
                        <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed">Course ini memadukan ancient wisdom dengan experiential practice. Bukan hanya mempelajari teori, Sahabat juga akan mengalami secara langsung bagaimana sound, vibration, dan sacred frequency digunakan dalam praktik untuk membangun pemahaman yang lebih mendalam dan kepercayaan diri dalam memfasilitasi session.</p>
                    </div>
                </div>
            </section>

            <section class="bg-bes-cream py-20 md:py-28" aria-labelledby="bes-sound-receive-heading">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="text-center max-w-3xl mx-auto mb-14">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">What You'll Receive</p>
                        <h2 id="bes-sound-receive-heading" class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Yang Akan Sahabat Dapatkan</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <?php foreach($receives as $item): ?>
                            <article class="bes-reveal rounded-2xl border border-bes-sand bg-bes-ivory p-7">
                                <div class="w-11 h-11 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center mb-6"><i class="<?php echo esc_attr($item['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i></div>
                                <h3 class="font-display font-medium text-bes-bark text-2xl mb-3"><?php echo esc_html($item['title']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-[13.5px] leading-relaxed"><?php echo esc_html($item['body']); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-labelledby="bes-sound-explore-heading">
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                <div class="relative max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="text-center max-w-3xl mx-auto mb-14">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">What You'll Explore</p>
                        <h2 id="bes-sound-explore-heading" class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display">Mengenal Bahasa Sound dan Vibration</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <?php foreach($explore as $item): ?>
                            <article class="bes-reveal rounded-2xl border border-white/[.07] bg-white/[.03] p-6">
                                <h3 class="font-display font-medium text-white text-xl mb-3"><?php echo esc_html($item['title']); ?></h3>
                                <p class="font-body font-light text-white/45 text-[13px] leading-relaxed"><?php echo esc_html($item['body']); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="bg-bes-ivory py-20 md:py-28">
                <div class="max-w-[1200px] mx-auto px-6 md:px-10 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
                    <div>
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">From Learning to Facilitating</p>
                        <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-6">Belajar. Mengalami. Memfasilitasi.</h2>
                        <p class="bes-reveal font-body font-light text-bes-bark-muted leading-relaxed">Sound healing bukan hanya tentang memahami cara menggunakan instrumen. Sahabat juga diajak untuk belajar hadir sepenuhnya, mengalami vibration, dan membangun kepercayaan diri dalam memfasilitasi sebuah session. Melalui experiential practice, course ini membantu Sahabat bergerak dari memahami dasar hingga memiliki bekal untuk memfasilitasi sound healing session bagi diri sendiri maupun orang lain.</p>
                    </div>
                    <div>
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Who Is This For?</p>
                        <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-6">Apakah Perjalanan Ini untuk Sahabat?</h2>
                        <ul class="space-y-3">
                            <?php foreach($for_you as $item): ?>
                                <li class="bes-reveal flex items-start gap-3 rounded-xl border border-bes-sand bg-bes-parchment p-4">
                                    <i class="fa-solid fa-circle-check text-bes-leaf text-xs mt-1" aria-hidden="true"></i>
                                    <span class="font-body font-light text-bes-bark-muted text-[13.5px] leading-relaxed"><?php echo esc_html($item); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="bes-sound-investment" class="bg-bes-forest-deep py-20 md:py-28" aria-label="Sound Healing Course investment">
                <div class="max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">Your Investment</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-4">Mulai Perjalanan Sound Healing Sahabat</h2>
                    <p class="bes-reveal font-display font-medium text-bes-leaf text-4xl mb-4"><?php echo esc_html($price); ?></p>
                    <p class="bes-reveal font-body font-light text-white/40 text-sm max-w-2xl mx-auto mb-9">Harga yang tercantum menggunakan satuan ribuan Rupiah Indonesia (IDR) dan dikenakan pajak pemerintah sebesar 12,5%.</p>
                    <a href="#bes-sound-course-overview" class="bes-reveal inline-flex items-center gap-2.5 border border-white/10 bg-white/[.04] !text-white/75 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.08] hover:!text-white transition-colors">
                        Jelajahi Course <i class="fa-solid fa-arrow-up text-xs" aria-hidden="true"></i>
                    </a>
                    <!-- Approved source provides CTA labels but no final enrollment/contact destination. -->
                </div>
            </section>

            <section class="bg-bes-parchment py-16 md:py-24">
                <div class="max-w-3xl mx-auto px-6 text-center">
                    <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-5">Mengenal Lebih Dalam melalui Sound</h2>
                    <p class="bes-reveal font-body font-light text-bes-bark-muted leading-relaxed">Jelajahi wisdom di balik sound, rasakan pengalaman vibration, dan bangun kepercayaan diri untuk memfasilitasi sound healing session bagi diri sendiri maupun orang lain.</p>
                </div>
            </section>
        </main>
        <?php return ob_get_clean();
    }
}

add_shortcode( 'bes_sound_healing_course', 'bes_site_core_render_sound_healing_course' );
