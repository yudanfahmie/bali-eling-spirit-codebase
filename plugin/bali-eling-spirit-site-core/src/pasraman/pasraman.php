<?php
/**
 * Phase E canonical Pasraman renderer.
 * Public route contract remains /pasraman/; Phase F owns page-shell assignment.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_site_core_render_pasraman' ) ) {
    function bes_site_core_render_pasraman( $atts = array() ) {
        $programs = array(
            array(
                'eyebrow' => '01',
                'title'   => 'Pelukatan / 7 Chakra Water Purification',
                'meta'    => 'Purnama & Tilem · 3 Hours',
                'body'    => 'Ritual pemurnian dengan air suci, mantra, meditasi, dan kearifan Bali. Program ini mengikuti praktik 7-Chakra Purification yang sudah ada di Bali Eling Spirit.',
                'route'   => '/7-chakra-purification/',
                'icon'    => 'fa-solid fa-water',
            ),
            array(
                'eyebrow' => '02',
                'title'   => 'Eling Sadhana',
                'meta'    => 'Donasi Sukarela',
                'body'    => '',
                'route'   => '',
                'icon'    => 'fa-solid fa-person-praying',
            ),
            array(
                'eyebrow' => '03',
                'title'   => 'Eling Usada Retreat',
                'meta'    => 'Donasi Sukarela',
                'body'    => '',
                'route'   => '',
                'icon'    => 'fa-solid fa-leaf',
            ),
            array(
                'eyebrow' => '04',
                'title'   => 'Eling Bhakti Yoga',
                'meta'    => 'Donasi Sukarela',
                'body'    => '',
                'route'   => '',
                'icon'    => 'fa-solid fa-hands-praying',
            ),
        );

        ob_start();
        ?>
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
                        <h1 id="bes-pasraman-heading" class="bes-reveal font-display font-medium text-bes-ivory text-5xl md:text-6xl lg:text-7xl tracking-display leading-tight mb-7">Ruang Belajar, Praktik Spiritual, dan Transformasi Diri</h1>
                        <p class="bes-reveal font-body font-light text-bes-parchment/70 text-base md:text-lg max-w-3xl leading-relaxed">Pasraman Bali Eling Spirit adalah ruang pembelajaran dan praktik di Pejeng Kangin, Tampaksiring, Gianyar, Bali. Dalam tradisi Bali-Hindu, pasraman dipahami sebagai sekolah hidup: pengetahuan dipraktikkan perlahan, guru membimbing sesuai kebutuhan peserta, dan disiplin terhubung dengan kehidupan sehari-hari.</p>
                    </div>
                </div>
                <div class="bes-fret absolute bottom-0 inset-x-0" aria-hidden="true"></div>
            </section>

            <section class="bg-bes-parchment py-20 md:py-28" aria-label="Pasraman context">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
                        <div class="lg:col-span-7">
                            <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Makna Eling</p>
                            <h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display leading-tight mb-6">Praktik yang Menyentuh Tubuh, Pikiran, Perasaan, dan Kesadaran Batin</h2>
                            <p class="bes-reveal font-body font-light text-bes-bark-muted text-[15px] leading-relaxed">Bali Eling Spirit menggunakan kerangka Sthula Sarira, Sukhma Sarira, dan Antah Karana Sarira untuk memahami dimensi fisik, pikiran dan perasaan, serta kesadaran batin. Praktik di Pasraman dapat melibatkan yoga, pranayama, meditasi, refleksi Dharma, sound healing, dan ritual pemurnian sesuai program yang diikuti.</p>
                        </div>
                        <div class="lg:col-span-5 bes-reveal rounded-2xl border border-bes-sand bg-bes-ivory p-7 md:p-8">
                            <p class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Living School</p>
                            <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed">Pasraman menempatkan praktik, pengamatan diri, disiplin, dan pelayanan sebagai bagian dari proses belajar. Pengunjung dari latar belakang berbeda dapat mengikuti program dengan tetap menghormati tradisi lokal, fasilitator, peserta lain, dan batas masing-masing program.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-bes-cream py-20 md:py-28" aria-labelledby="bes-pasraman-programs-heading">
                <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                    <div class="text-center max-w-3xl mx-auto mb-14 md:mb-16">
                        <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Program Pasraman</p>
                        <h2 id="bes-pasraman-programs-heading" class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Empat Program yang Disediakan</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6">
                        <?php foreach ( $programs as $program ) : ?>
                            <article class="bes-reveal group rounded-2xl border border-bes-sand bg-bes-ivory overflow-hidden hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5 transition-all duration-300 flex flex-col">
                                <div class="p-7 md:p-8 flex flex-col flex-1 min-h-[260px]">
                                    <div class="flex items-start justify-between gap-4 mb-8">
                                        <div class="w-11 h-11 rounded-xl border border-bes-sand bg-bes-cream flex items-center justify-center">
                                            <i class="<?php echo esc_attr( $program['icon'] ); ?> text-bes-olive text-sm" aria-hidden="true"></i>
                                        </div>
                                        <span class="font-body font-bold text-[10px] uppercase tracking-nav text-bes-gold"><?php echo esc_html( $program['eyebrow'] ); ?></span>
                                    </div>
                                    <h3 class="font-display font-medium text-bes-bark text-2xl md:text-3xl leading-tight mb-3"><?php echo esc_html( $program['title'] ); ?></h3>
                                    <p class="font-body font-bold text-[10px] uppercase tracking-label text-bes-moss mb-5"><?php echo esc_html( $program['meta'] ); ?></p>
                                    <?php if ( '' !== $program['body'] ) : ?>
                                        <p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed mb-7"><?php echo esc_html( $program['body'] ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( '' !== $program['route'] ) : ?>
                                        <a href="<?php echo esc_url( home_url( $program['route'] ) ); ?>" class="mt-auto inline-flex items-center justify-between gap-3 border border-bes-forest/[.08] rounded-xl px-5 py-3.5 font-body font-bold text-[10px] uppercase tracking-label text-bes-bark-muted hover:bg-bes-forest hover:!text-bes-leaf transition-all duration-300">
                                            <span>Lihat Detail</span><i class="fa-solid fa-arrow-right text-[9px]" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="relative bg-bes-forest py-20 md:py-24 overflow-hidden" aria-label="Pasraman visit guidance">
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image:radial-gradient(rgba(255,255,255,.5) 1px,transparent 1px);background-size:24px 24px"></div>
                <div class="relative max-w-4xl mx-auto px-6 md:px-10 text-center">
                    <p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-leaf mb-4">Sebelum Berkunjung</p>
                    <h2 class="bes-reveal font-display font-medium text-bes-ivory text-4xl md:text-5xl tracking-display mb-6">Datang dengan Niat yang Jelas dan Waktu yang Cukup</h2>
                    <p class="bes-reveal font-body font-light text-bes-parchment/70 text-[15px] leading-relaxed">Jadwal guru, upacara, retreat, dan kegiatan komunitas dapat memengaruhi ketersediaan Pasraman. Setiap program perlu dipahami menurut jadwal, prasyarat, intensitas, serta ketentuan yang berlaku pada program tersebut.</p>
                </div>
            </section>
        </main>
        <?php
        return ob_get_clean();
    }
}

add_shortcode( 'bes_pasraman', 'bes_site_core_render_pasraman' );
