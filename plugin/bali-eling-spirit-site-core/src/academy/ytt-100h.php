<?php
/**
 * Production-ready 100H Yoga Teacher Training landing.
 * Structure reuses the established BES/YTT hero, content, facts and CTA rhythm.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'bes_site_core_ytt_100h_fact' ) ) {
    function bes_site_core_ytt_100h_fact( $field, $default = null ) {
        return function_exists('bes_site_core_program_fact')
            ? bes_site_core_program_fact('ytt-100h',$field,$default)
            : $default;
    }
}

if ( ! function_exists( 'bes_site_core_render_ytt_100h' ) ) {
    function bes_site_core_render_ytt_100h( $atts = array() ) {
        $duration = bes_site_core_ytt_100h_fact('duration','100 Hours');
        $language = bes_site_core_ytt_100h_fact('language','Bahasa Indonesia / English');
        $price    = bes_site_core_ytt_100h_fact('price','IDR 16,724K ++');
        $ytt_url  = function_exists('bes_site_core_program_route')
            ? bes_site_core_program_route('ytt','/yoga-teacher-training/')
            : '/yoga-teacher-training/';

        $facts = array(
            array('icon'=>'fa-solid fa-house-chimney','label'=>'Training Type','value'=>'Offline / Residential'),
            array('icon'=>'fa-solid fa-clock','label'=>'Duration','value'=>$duration),
            array('icon'=>'fa-solid fa-language','label'=>'Language','value'=>$language),
            array('icon'=>'fa-solid fa-tag','label'=>'Investment','value'=>$price),
        );
        $path = array(
            array('n'=>'01','title'=>'Mulai dari 100 Jam Pertama','body'=>'Mulai perjalanan melalui 100 jam pertama dari kurikulum 200-Hour Yoga Teacher Training yang terstruktur.'),
            array('n'=>'02','title'=>'Bangun Dasar yang Kuat','body'=>'Gunakan tahap pertama ini untuk membangun foundation sebelum melanjutkan perjalanan training berikutnya.'),
            array('n'=>'03','title'=>'Lanjutkan Saat Sahabat Siap','body'=>'Ketika siap, lanjutkan 100 jam berikutnya untuk menyelesaikan jalur menuju 200-Hour Yoga Teacher Training certification.'),
        );

        ob_start(); ?>
        <main class="font-body overflow-hidden">
            <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-ytt-100h-heading">
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[520px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.08),transparent_58%)]"></div>
                    <div class="absolute bottom-0 right-0 w-[520px] h-[360px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.05),transparent_55%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>
                <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
                <div class="relative w-full max-w-5xl mx-auto px-6 md:px-10 text-center py-28 md:py-36">
                    <nav class="bes-reveal mb-8" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url($ytt_url)); ?>" class="font-body font-bold text-[10px] uppercase tracking-nav !text-white/30 hover:!text-bes-gold transition-colors">← Yoga Teacher Training</a>
                    </nav>
                    <div class="bes-reveal flex flex-wrap items-center justify-center gap-3 mb-8">
                        <span class="inline-flex items-center gap-2 bg-bes-gold/[.06] border border-bes-gold/[.18] rounded-full px-4 py-2">
                            <i class="fa-solid fa-house-chimney text-bes-gold text-[10px]" aria-hidden="true"></i>
                            <span class="font-body font-bold text-[9px] uppercase tracking-nav text-bes-gold/80">Offline · Residential</span>
                        </span>
                    </div>
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold/70 mb-5">Build Your Foundation. Continue When You're Ready.</p>
                    <h1 id="bes-ytt-100h-heading" class="bes-reveal font-display font-medium text-white text-5xl md:text-6xl lg:text-[5.5rem] tracking-display leading-none mb-7">100-Hour Yoga Teacher Training</h1>
                    <p class="bes-reveal font-body font-light text-white/55 text-base md:text-lg max-w-3xl mx-auto leading-relaxed mb-10">Untuk Sahabat yang ingin menuju 200-Hour Yoga Teacher Training dengan jalur yang lebih fleksibel. Program ini memungkinkan Sahabat memulai dari 100 jam pertama dalam kurikulum 200-Hour Yoga Teacher Training, lalu melanjutkan 100 jam berikutnya ketika sudah siap.</p>
                    <a href="#bes-ytt-100h-overview" class="bes-reveal inline-flex items-center gap-2.5 bg-bes-gold text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:opacity-90 transition-opacity">
                        <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i> Lihat Program 100H
                    </a>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section id="bes-ytt-100h-overview" class="bg-bes-parchment py-20 md:py-28" aria-label="100H program overview">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                        <div class="lg:col-span-7">
                            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">A Flexible Path Toward 200H</p>
                            <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-7">Bangun Dasar yang Kuat.<br>Lanjutkan Saat Sahabat Siap.</h2>
                            <div class="space-y-5 font-body font-light text-bes-bark-muted text-[15px] leading-relaxed">
                                <p class="bes-reveal">100-Hour Yoga Teacher Training dirancang bagi Sahabat yang ingin menyelesaikan 200-Hour Yoga Teacher Training tetapi membutuhkan jalur yang lebih fleksibel.</p>
                                <p class="bes-reveal">Tahap ini mencakup 100 jam pertama dari kurikulum 200-Hour yang terstruktur. Saat Sahabat siap, perjalanan dapat dilanjutkan dengan 100 jam berikutnya menuju penyelesaian 200-Hour Yoga Teacher Training certification.</p>
                            </div>
                        </div>
                        <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <?php foreach($facts as $fact): ?>
                                <div class="bes-reveal rounded-2xl border border-bes-sand bg-bes-ivory p-6">
                                    <div class="w-10 h-10 rounded-xl bg-bes-forest/[.04] border border-bes-forest/[.07] flex items-center justify-center mb-5">
                                        <i class="<?php echo esc_attr($fact['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                                    </div>
                                    <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-moss mb-2"><?php echo esc_html($fact['label']); ?></p>
                                    <p class="font-display font-medium text-bes-bark text-xl leading-snug"><?php echo esc_html($fact['value']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-bes-cream py-20 md:py-28" aria-labelledby="bes-ytt-100h-path-heading">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="text-center max-w-3xl mx-auto mb-14">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Your Training Path</p>
                        <h2 id="bes-ytt-100h-path-heading" class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Satu Tahap yang Dapat Dilanjutkan</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <?php foreach($path as $step): ?>
                            <article class="bes-reveal rounded-2xl border border-bes-sand bg-bes-ivory p-7 md:p-8">
                                <span class="font-display font-light text-bes-gold text-4xl"><?php echo esc_html($step['n']); ?></span>
                                <h3 class="font-display font-medium text-bes-bark text-2xl mt-5 mb-3"><?php echo esc_html($step['title']); ?></h3>
                                <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed"><?php echo esc_html($step['body']); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section id="bes-ytt-100h-investment" class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="100H investment">
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                <div class="relative max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold mb-4">Investment</p>
                    <h2 class="bes-reveal font-display font-medium text-white text-4xl md:text-5xl tracking-display mb-5"><?php echo esc_html($price); ?></h2>
                    <p class="bes-reveal font-body font-light text-white/45 text-sm leading-relaxed max-w-2xl mx-auto mb-8">Training Type: Offline / Residential · Duration: <?php echo esc_html($duration); ?> · Language: <?php echo esc_html($language); ?></p>
                    <a href="<?php echo esc_url(home_url($ytt_url)); ?>" class="bes-reveal inline-flex items-center gap-2.5 border border-white/10 bg-white/[.04] !text-white/75 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.08] hover:!text-white transition-colors">
                        Kembali ke Katalog YTT <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                    </a>
                    <!-- Approved source does not identify a final enrollment/contact destination for this new 100H page. -->
                </div>
            </section>
        </main>
        <?php return ob_get_clean();
    }
}

add_shortcode( 'bes_ytt_100h_landing', 'bes_site_core_render_ytt_100h' );
