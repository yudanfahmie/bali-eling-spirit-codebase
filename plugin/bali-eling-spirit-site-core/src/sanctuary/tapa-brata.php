<?php
/**
 * Phase C Tapa Brata renderer.
 * Preserves the canonical [bes_eling_tapa_brata] shortcode for /eling-tapa-brata/.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bes_site_core_render_eling_tapa_brata_phase_c() {
    $wa = 'https://wa.me/6281228888873'; // Preserve existing Tapa Brata/Sanctuary route-specific channel.
    $pillars = array(
        array( 'icon' => 'fa-solid fa-person-praying', 'title' => 'Meditasi', 'body' => 'Ruang hening untuk melatih kesadaran dan kembali mendengarkan diri.' ),
        array( 'icon' => 'fa-solid fa-seedling', 'title' => 'Yoga', 'body' => 'Gerak dan napas untuk membantu tubuh kembali seimbang dan hadir.' ),
        array( 'icon' => 'fa-solid fa-fire-flame-curved', 'title' => 'Disiplin Diri', 'body' => 'Praktik tapa untuk menyederhanakan, melepaskan, dan menata kembali arah hidup.' ),
        array( 'icon' => 'fa-solid fa-hands-praying', 'title' => 'Refleksi Spiritual', 'body' => 'Proses batin untuk melihat pengalaman hidup dengan kesadaran yang lebih jernih.' ),
    );

    ob_start();
    ?>
    <main class="font-body overflow-hidden">
        <section class="relative min-h-[88vh] flex items-end overflow-hidden bg-bes-forest-deep" aria-labelledby="bes-tapa-heading">
            <div class="bes-fret absolute top-0 inset-x-0" aria-hidden="true"></div>
            <div class="relative max-w-[1440px] mx-auto w-full px-6 md:px-10 pt-32 pb-20 md:pb-28">
                <nav class="bes-reveal mb-8" aria-label="Breadcrumb"><a href="/sanctuary/" class="text-[10px] uppercase tracking-nav font-bold !text-white/30 hover:!text-bes-gold transition-colors">← Sanctuary</a></nav>
                <div class="max-w-3xl">
                    <p class="bes-reveal text-[10px] uppercase tracking-nav font-bold text-bes-gold mb-5">Tapa Brata · Program Bahasa Indonesia</p>
                    <h1 id="bes-tapa-heading" class="bes-reveal font-display text-5xl md:text-6xl lg:text-7xl text-white leading-tight mb-6">Perjalanan Menuju<br><em class="not-italic text-bes-gold">Transformasi Diri</em></h1>
                    <p class="bes-reveal text-white/55 text-base md:text-lg leading-relaxed max-w-2xl mb-9">Tapa Brata adalah perjalanan spiritual 4 hari 3 malam yang menggabungkan meditasi, yoga, disiplin diri, dan refleksi spiritual untuk membantu Sahabat melepaskan beban masa lalu, menemukan kembali kejernihan, dan kembali terhubung dengan diri sejati.</p>
                    <a href="#bes-tapa-details" class="bes-reveal inline-flex bg-bes-gold text-bes-forest font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-xl hover:opacity-90 transition-opacity">Jelajahi Tapa Brata</a>
                </div>
            </div>
        </section>

        <section class="bg-bes-parchment py-20 md:py-28">
            <div class="max-w-[1200px] mx-auto px-6 md:px-10 grid lg:grid-cols-2 gap-12 lg:gap-20">
                <div><p class="bes-reveal text-[10px] uppercase tracking-nav font-bold text-bes-moss mb-4">Tentang Tapa Brata</p><h2 class="bes-reveal font-display text-4xl md:text-5xl text-bes-bark mb-6">Berhenti. Melepaskan. Mengingat Kembali Diri.</h2><p class="bes-reveal text-bes-bark-muted leading-relaxed">Tapa Brata menghadirkan ruang yang lebih dalam bagi Sahabat yang siap menjalani proses transformasi melalui latihan kesadaran, disiplin diri, dan refleksi yang terarah.</p></div>
                <div><p class="bes-reveal text-[10px] uppercase tracking-nav font-bold text-bes-moss mb-4">Pendekatan</p><h2 class="bes-reveal font-display text-4xl md:text-5xl text-bes-bark mb-6">Empat Hari dalam Ruang yang Terjaga</h2><p class="bes-reveal text-bes-bark-muted leading-relaxed">Program dijalankan dalam jadwal intake yang telah ditentukan dan menggunakan Bahasa Indonesia. Setiap tahap diarahkan untuk mendukung kehadiran, refleksi, dan proses batin secara utuh.</p></div>
            </div>
        </section>

        <section id="bes-tapa-details" class="bg-bes-forest py-20 md:py-28">
            <div class="max-w-[1440px] mx-auto px-6 md:px-10">
                <div class="mb-12"><p class="bes-reveal text-[10px] uppercase tracking-nav font-bold text-bes-gold mb-4">Perjalanan 4D3N</p><h2 class="bes-reveal font-display text-4xl md:text-5xl text-white mb-4">Praktik yang Menopang Perjalanan</h2></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <?php foreach ( $pillars as $pillar ) : ?>
                        <article class="bes-reveal rounded-2xl border border-white/[.06] bg-white/[.03] p-6 min-h-[240px]">
                            <span class="w-10 h-10 rounded-xl bg-bes-gold/[.08] border border-bes-gold/[.14] flex items-center justify-center mb-6"><i class="<?php echo esc_attr( $pillar['icon'] ); ?> text-bes-gold" aria-hidden="true"></i></span>
                            <h3 class="font-display text-2xl text-white mb-3"><?php echo esc_html( $pillar['title'] ); ?></h3>
                            <p class="text-sm text-white/45 leading-relaxed"><?php echo esc_html( $pillar['body'] ); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="bes-reveal mt-8 rounded-2xl border border-white/[.06] bg-white/[.03] p-7 md:p-9 grid md:grid-cols-3 gap-6">
                    <div><p class="text-[9px] uppercase tracking-label font-bold text-bes-gold/70 mb-1">Durasi</p><p class="text-white/80">4 Hari 3 Malam</p></div>
                    <div><p class="text-[9px] uppercase tracking-label font-bold text-bes-gold/70 mb-1">Jadwal</p><p class="text-white/80">Jadwal program tetap · konfirmasi intake berikutnya</p></div>
                    <div><p class="text-[9px] uppercase tracking-label font-bold text-bes-gold/70 mb-1">Investasi</p><p class="text-white/80">IDR 4.999K++</p></div>
                </div>
            </div>
        </section>

        <section class="bg-bes-forest-deep py-16 md:py-24">
            <div class="max-w-3xl mx-auto px-6 text-center">
                <h2 class="bes-reveal font-display text-4xl text-white mb-4">Saat Sahabat Siap Menjalani Proses yang Lebih Dalam</h2>
                <p class="bes-reveal text-white/45 mb-8">Hubungi tim Sanctuary untuk menanyakan intake Tapa Brata berikutnya dan persiapan sebelum program.</p>
                <a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener noreferrer" class="bes-reveal inline-flex items-center gap-2 bg-bes-gold text-bes-forest font-bold text-[11px] uppercase tracking-label px-8 py-4 rounded-xl"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i>Tanyakan Jadwal Tapa Brata</a>
            </div>
        </section>
    </main>
    <?php
    return ob_get_clean();
}

remove_shortcode( 'bes_eling_tapa_brata' );
add_shortcode( 'bes_eling_tapa_brata', 'bes_site_core_render_eling_tapa_brata_phase_c' );
