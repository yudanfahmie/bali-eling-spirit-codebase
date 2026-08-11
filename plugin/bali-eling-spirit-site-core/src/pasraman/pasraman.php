<?php
/**
 * Canonical Pasraman renderer.
 * Uses the existing BES card/grid language and approved Website BES.docx copy.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'bes_site_core_render_pasraman' ) ) {
    function bes_site_core_render_pasraman( $atts = array() ) {
        $pelukatan_route = function_exists('bes_site_core_program_route')
            ? bes_site_core_program_route('pelukatan','/7-chakra-purification/')
            : '/7-chakra-purification/';

        $programs = array(
            array(
                'eyebrow'=>'01',
                'title'=>'Pelukatan 7 Chakra',
                'tagline'=>'Purnama & Tilem',
                'meta'=>'3 Jam · IDR 150K · Pajak 12,5%',
                'body'=>'Rasakan perjalanan batin melalui ritual Pelukatan 7 Chakra yang memadukan praktik penyucian secara menyeluruh. Menggunakan air suci yang telah dipersiapkan melalui ritual tradisional, lantunan mantra, dan meditasi hening, pengalaman ini mengajak Sahabat melepaskan energi negatif, membangkitkan kembali intuisi, serta menemukan kejernihan, keseimbangan, dan ketenangan batin.',
                'route'=>$pelukatan_route,
                'icon'=>'fa-solid fa-water',
            ),
            array(
                'eyebrow'=>'02',
                'title'=>'Eling Sadhana',
                'tagline'=>'Ruang Bersama untuk Berdoa, Bermeditasi, dan Bertumbuh',
                'meta'=>'90 Menit · Senin 18.00–19.30 WITA · Donasi',
                'body'=>'Eling Sadhana adalah program meditasi bersama bagi Sahabat di Bali dan sekitarnya, yang dipandu oleh Yogi Team Bali Eling Spirit dalam suasana yang tenang dan suportif. Sebagai bentuk pelayanan, pertemuan ini menjadi ruang untuk menyatukan hati dalam doa sekaligus menumbuhkan perjalanan spiritual, mendoakan kesejahteraan seluruh makhluk, dan menjaga keharmonisan semesta.',
                'route'=>'',
                'icon'=>'fa-solid fa-person-praying',
            ),
            array(
                'eyebrow'=>'03',
                'title'=>'Eling Usada Retreat',
                'tagline'=>'Ruang untuk Kembali Terhubung, Menata Diri, dan Bertumbuh',
                'meta'=>'120 Menit · Sabtu 15.00–17.00 WITA · Donasi',
                'body'=>'Eling Usada Retreat adalah program khusus dari Pasraman Bali Eling Spirit bagi Sahabat yang sedang menjalani perjalanan personal growth, self-discovery, atau emotional healing menuju kehidupan yang lebih utuh. Melalui guided meditation, yoga asana, dan sound healing, retreat ini menghadirkan ruang yang mendukung untuk kembali terhubung dengan diri yang lebih dalam, menata kembali keseimbangan batin, dan menjalani hidup dengan kesadaran yang lebih utuh.',
                'route'=>'',
                'icon'=>'fa-solid fa-leaf',
            ),
            array(
                'eyebrow'=>'04',
                'title'=>'Eling Bhakti Yoga',
                'tagline'=>'Berlatih Yoga. Memperdalam Perjalanan Spiritual.',
                'meta'=>'60 Menit · Rabu & Minggu 15.00–16.00 WITA · Donasi',
                'body'=>'Eling Bhakti Yoga adalah program yoga bersama bagi Sahabat di Bali dan sekitarnya, yang dipandu oleh Yogi Team Bali Eling Spirit dalam suasana yang tenang dan terbuka. Sebagai bentuk pelayanan tanpa pamrih, program ini mengajak Sahabat memperdalam perjalanan spiritual melalui praktik yoga—bukan hanya untuk tubuh, tetapi juga sebagai jalan untuk menumbuhkan kesadaran dan pertumbuhan batin.',
                'route'=>'',
                'icon'=>'fa-solid fa-hands-praying',
            ),
        );

        ob_start(); ?>
        <main class="font-body text-bes-bark overflow-hidden">
            <section class="relative min-h-[82vh] flex items-end overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-pasraman-heading">
                <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[540px] bg-[radial-gradient(ellipse,rgba(194,210,74,0.08),transparent_60%)]"></div>
                    <div class="absolute bottom-0 right-0 w-[620px] h-[420px] bg-[radial-gradient(ellipse,rgba(201,168,76,0.05),transparent_58%)]"></div>
                    <div class="absolute inset-0 opacity-[0.018]" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                </div>
                <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
                <div class="relative w-full max-w-[1440px] mx-auto px-6 md:px-10 pt-32 pb-20 md:pb-28">
                    <div class="max-w-4xl">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-5">Pasraman Bali Eling Spirit</p>
                        <h1 id="bes-pasraman-heading" class="bes-reveal font-display font-medium text-bes-ivory text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-7">Ruang untuk Belajar, Bertumbuh, Melayani, dan Kembali Terhubung</h1>
                        <p class="bes-reveal font-body font-light text-bes-parchment/70 text-base md:text-lg max-w-3xl leading-relaxed mb-9">Pasraman Bali Eling Spirit adalah ruang bagi siapa pun yang ingin menumbuhkan kesadaran diri sekaligus memberikan manfaat yang berarti bagi sesama. Berakar pada kearifan budaya Bali dan filosofi Eling Living, Pasraman memadukan praktik spiritual, kebersamaan, dan pelayanan sebagai bagian dari perjalanan personal growth yang bermakna.</p>
                        <a href="#bes-pasraman-programs" class="bes-reveal inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-bes-leaf-hover transition-colors">Lihat Program Pasraman <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section class="bg-bes-parchment py-20 md:py-28" aria-label="About Pasraman">
                <div class="max-w-[1200px] mx-auto px-6 md:px-10 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                    <div>
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">About Pasraman</p>
                        <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">Perjalanan untuk Belajar, Bertumbuh, dan Melayani</h2>
                    </div>
                    <div class="space-y-5 font-body font-light text-bes-bark-muted text-[15px] leading-relaxed">
                        <p class="bes-reveal">Perjalanan spiritual bukan hanya tentang melihat ke dalam diri. Perjalanan ini juga tentang belajar menjalani hidup dengan kesadaran yang lebih utuh, kembali terhubung dengan sesama, dan menjadikan pertumbuhan diri sebagai sesuatu yang dapat memberikan manfaat bagi sekitar.</p>
                        <p class="bes-reveal">Di Pasraman Bali Eling Spirit, setiap langkah menjadi kesempatan untuk belajar, berbagi, dan memberikan kembali. Melalui bimbingan spiritual, kegiatan komunitas, dan berbagai praktik yang bermakna, Pasraman menghadirkan ruang di mana personal growth dapat menjadi bagian dari kehidupan yang lebih harmonis bagi diri sendiri, komunitas, dan alam.</p>
                    </div>
                </div>
            </section>

            <section id="bes-pasraman-programs" class="bg-bes-cream py-20 md:py-28" aria-labelledby="bes-pasraman-programs-heading">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="text-center max-w-3xl mx-auto mb-14 md:mb-16">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Program Pasraman</p>
                        <h2 id="bes-pasraman-programs-heading" class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display mb-5">Temukan Perjalananmu di Pasraman</h2>
                        <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed">Setiap program menghadirkan cara yang berbeda untuk belajar, kembali terhubung, dan bertumbuh. Apakah Sahabat tertarik pada ritual pelukatan, meditasi bersama, retreat yang mendukung perjalanan batin, atau praktik yoga, selalu ada ruang untuk memulai dari tempatmu berada saat ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6">
                        <?php foreach($programs as $program): ?>
                            <article class="bes-reveal group rounded-2xl border border-bes-sand bg-bes-ivory overflow-hidden hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5 transition-all duration-300 flex flex-col">
                                <div class="p-7 md:p-8 flex flex-col flex-1 min-h-[330px]">
                                    <div class="flex items-start justify-between gap-4 mb-7">
                                        <div class="w-11 h-11 rounded-xl border border-bes-sand bg-bes-cream flex items-center justify-center"><i class="<?php echo esc_attr($program['icon']); ?> text-bes-olive text-sm" aria-hidden="true"></i></div>
                                        <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold"><?php echo esc_html($program['eyebrow']); ?></span>
                                    </div>
                                    <h3 class="font-display font-medium text-bes-bark text-2xl md:text-3xl leading-tight mb-2"><?php echo esc_html($program['title']); ?></h3>
                                    <p class="font-display italic text-bes-olive text-lg leading-snug mb-4"><?php echo esc_html($program['tagline']); ?></p>
                                    <p class="font-body font-bold text-[9px] uppercase tracking-label text-bes-moss mb-5"><?php echo esc_html($program['meta']); ?></p>
                                    <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-7"><?php echo esc_html($program['body']); ?></p>
                                    <?php if('' !== $program['route']): ?>
                                        <a href="<?php echo esc_url(home_url($program['route'])); ?>" class="mt-auto inline-flex items-center justify-between gap-3 border border-bes-forest/[.08] rounded-xl px-5 py-3.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted hover:bg-bes-forest hover:!text-bes-leaf transition-all duration-300">
                                            <span>Kenali Pengalamannya</span><i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="relative bg-bes-forest py-20 md:py-24 overflow-hidden" aria-label="Find your Pasraman journey">
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                <div class="relative max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">Find Your Journey</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-ivory text-4xl md:text-5xl tracking-display mb-6">Dari Mana Perjalananmu Dimulai?</h2>
                    <p class="bes-reveal font-body font-light text-bes-parchment/70 text-[15px] leading-relaxed mb-8">Tidak ada satu cara yang sama untuk memulai perjalanan spiritual. Apa pun yang membawa Sahabat ke sini, mulailah dari tempatmu berada saat ini dan pilih praktik yang paling dekat dengan perjalananmu.</p>
                    <a href="#bes-pasraman-programs" class="bes-reveal inline-flex items-center gap-2.5 border border-white/10 bg-white/[.04] !text-white/75 font-body font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-2xl hover:bg-white/[.08] hover:!text-white transition-colors">Lihat Program <i class="fa-solid fa-arrow-up text-xs" aria-hidden="true"></i></a>
                </div>
            </section>
        </main>
        <?php return ob_get_clean();
    }
}

add_shortcode( 'bes_pasraman', 'bes_site_core_render_pasraman' );
