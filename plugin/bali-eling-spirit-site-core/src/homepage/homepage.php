<?php
/**
 * Batch B homepage adapter.
 * Homepage v2 remains byte-identical in homepage-v2.php; this file applies
 * only the approved 2026 catalog, FAQ, shortcode-alias and footer deltas.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
require_once __DIR__ . '/homepage-v2.php';

function bes_site_core_batch_b_sanctuary_cards() {
    return array(
        array('img_id'=>3337,'img_file'=>'ceEcf-scaled.webp','img'=>content_url('uploads/2026/07/ceEcf-scaled.webp'),'alt'=>'Healing and therapy ritual at Bali Eling Spirit','eyebrow'=>'01','title'=>'Healing &amp; Therapy','subtitle'=>'','link'=>'/healing-therapy/','delay'=>'0.1s'),
        array('img_id'=>3336,'img_file'=>'anVqu.webp','img'=>content_url('uploads/2026/07/anVqu.webp'),'alt'=>'Retreat experience in sacred water at Bali Eling Spirit','eyebrow'=>'02','title'=>'Retreats','subtitle'=>'','link'=>'/eling-sanctuary-retreat/','delay'=>'0.2s'),
        array('img_id'=>3338,'img_file'=>'JjnJV.webp','img'=>content_url('uploads/2026/07/JjnJV.webp'),'alt'=>'Tapa Brata Indonesian program meditation group at Bali Eling Spirit','eyebrow'=>'03','title'=>'Tapa Brata','subtitle'=>'Program Bahasa Indonesia','link'=>'/program-bahasa-indonesia/','delay'=>'0.3s'),
        // No new approved Media Library mapping exists for Corporate Service in Batch B.
        array('img_id'=>3337,'img_file'=>'ceEcf-scaled.webp','img'=>content_url('uploads/2026/07/ceEcf-scaled.webp'),'alt'=>'Corporate wellness experience at Bali Eling Spirit','eyebrow'=>'04','title'=>'Corporate Service','subtitle'=>'','link'=>'/corporate-services/','delay'=>'0.4s'),
    );
}

function bes_site_core_batch_b_academy_cards() {
    return array(
        array('img_id'=>3333,'img_file'=>'SYQLV.webp','img'=>content_url('uploads/2026/07/SYQLV.webp'),'alt'=>'Yoga Teacher Training practice at Bali Eling Spirit Academy','eyebrow'=>'01','title'=>'Yoga Teacher Training','subtitle'=>'','link'=>'/yoga-teacher-training/','delay'=>'0.1s'),
        array('img_id'=>3332,'img_file'=>'reNKZ.webp','img'=>content_url('uploads/2026/07/reNKZ.webp'),'alt'=>'Eling Meditation Course at Bali Eling Spirit Academy','eyebrow'=>'02','title'=>'Eling Meditation Course','subtitle'=>'','link'=>'/meditation-course/','delay'=>'0.2s'),
        array('img_id'=>3350,'img_file'=>'CYxia.webp','img'=>content_url('uploads/2026/07/CYxia.webp'),'alt'=>'Eling Sound Healing Course at Bali Eling Spirit Academy','eyebrow'=>'03','title'=>'Eling Sound Healing Course','subtitle'=>'','link'=>'/eling-sound-healing-course/','delay'=>'0.3s'),
    );
}

function bes_site_core_batch_b_faqs() {
    return array(
        array('q'=>'Apa itu Bali Eling Spirit?','a'=>'Bali Eling Spirit adalah ekosistem wellness holistik yang berlokasi di Bali, menghadirkan program yoga, meditasi, healing, retreat, dan edukasi yang berakar pada kearifan spiritual Bali dan filosofi Eling Living.'),
        array('q'=>'Di mana lokasi Bali Eling Spirit?','a'=>'Kami berlokasi di Banjar Umadawa, Pejeng Kangin, Tampaksiring, Gianyar, Bali 80552 tidak jauh dari Tirta Empul.'),
        array('q'=>'Apakah program Bali Eling Spirit terbuka untuk semua orang?','a'=>'Ya, sebagian besar program kami terbuka untuk umum tanpa syarat pengalaman khusus. Beberapa program memiliki prasyarat tertentu (lihat FAQ tentang Eling Therapy).'),
        array('q'=>'Pakaian apa yang sebaiknya dikenakan saat berkunjung?','a'=>'Kami menyarankan pakaian yang nyaman dan sopan, mudah bergerak untuk sesi yoga/meditasi, serta membawa pakaian ganti bila mengikuti ritual air (seperti Mother Earth Purifications atau 7 Chakra Water Purification).'),
        array('q'=>'Apakah perlu melakukan reservasi sebelum datang?','a'=>'Ya, sebagian besar program memerlukan reservasi terlebih dahulu, terutama sesi personal dengan Yogi dan program retreat menginap.'),
        array('q'=>'Bagaimana cara melakukan reservasi/booking?','a'=>'Anda dapat menghubungi kami langsung melalui WhatsApp untuk memilih program, tanggal, dan melakukan konfirmasi pemesanan.'),
        // Approved source intentionally retains this field-level data gate.
        array('q'=>'Apakah ada kebijakan pembatalan atau reschedule?','a'=>'Pembatalan atau perubahan jadwal dapat dilakukan dengan menghubungi kami minimal [X hari] sebelum tanggal program berlangsung. Ketentuan detail akan diinformasikan saat konfirmasi booking.'),
        array('q'=>'Apakah makanan yang disediakan vegetarian?','a'=>'Ya, program yang mencakup makanan (seperti retreat menginap dan pelatihan intensif) menyediakan menu vegetarian sehat.'),
        array('q'=>'Apa itu Healing Retreat?','a'=>'Healing Retreat adalah program retreat harian selama 5 jam yang memadukan yoga, breathwork, meditasi, ritual pembersihan air, dan sound healing untuk membantu Anda menemukan kembali kedamaian dan kejernihan pikiran.'),
        array('q'=>'Apa itu Tapa Brata?','a'=>'Tapa Brata adalah program retreat 4 hari 3 malam (disampaikan dalam Bahasa Indonesia dengan jadwal tetap) yang menggabungkan meditasi, yoga, disiplin diri, dan refleksi spiritual untuk transformasi diri yang lebih dalam.'),
        array('q'=>'Apa itu Corporate Service di Bali Eling Spirit?','a'=>'Corporate Service adalah program wellness yang dirancang khusus untuk perusahaan dan karyawan, membantu tim Anda menemukan keseimbangan dan ketenangan melalui pendekatan yoga, meditasi, dan healing.'),
        array('q'=>'Apa itu Pemurnian 7 Chakra?','a'=>'Pemurnian 7 Chakra adalah ritual pembersihan energi menggunakan air suci yang disiapkan melalui ritual tradisional, mantra, dan meditasi hening. Bertujuan membersihkan energi negatif dan memulihkan keseimbangan batin.'),
        array('q'=>'Apa syarat mengikuti Eling Therapy?','a'=>'Eling Therapy merupakan proses penyembuhan mendalam, sehingga peserta diwajibkan telah mengikuti minimal satu program healing retreat atau retreat lainnya beserta sesi konseling spiritual sebelum dapat mengikuti sesi ini.'),
        array('q'=>'Apakah saya dapat menginap di Bali Eling Spirit?','a'=>'Ya, tersedia program retreat menginap seperti Eling Sanctuary Retreat (2 hari 1 malam / 3 hari 2 malam) dan Tapa Brata (4 hari 3 malam).'),
        array('q'=>'Apakah Yoga Teacher Training (YTT) di Bali Eling Spirit bersertifikat?','a'=>'Ya, program YTT 200-Hour dan 300-Hour kami telah diakui secara internasional melalui Yoga Alliance (RYT 200 dan RYT 300).'),
        array('q'=>'Apakah program tersedia dalam Bahasa Inggris?','a'=>'Sebagian besar program tersedia dalam Bahasa Indonesia dan Inggris. Beberapa program tertentu, seperti Tapa Brata dan YTT versi Hybrid, disampaikan khusus dalam Bahasa Indonesia.'),
        array('q'=>'Apakah tersedia layanan jemput (pickup)?','a'=>'Ya, untuk program Healing Retreat tersedia layanan pickup gratis dari Sang Spa dan Sang Spa Tropical (perlu reservasi terlebih dahulu).'),
        array('q'=>'Apakah program Pasraman berbayar?','a'=>'Sebagian program Pasraman seperti Eling Sadhana, Eling Usada Retreat, dan Eling Bhakti Yoga bersifat donasi sukarela sebagai bentuk pelayanan komunitas, sementara Pemurnian 7 Chakra memiliki biaya tetap.'),
    );
}

/** Replace one balanced HTML element that contains a stable marker. */
function bes_site_core_batch_b_replace_element( $html, $tag, $marker, $replacement ) {
    $marker_pos = strpos($html,$marker);
    if (false === $marker_pos) return false;
    $start = strripos(substr($html,0,$marker_pos),'<'.$tag);
    if (false === $start) return false;
    $slice = substr($html,$start);
    if (!preg_match_all('#</?'.preg_quote($tag,'#').'\\b[^>]*>#i',$slice,$matches,PREG_OFFSET_CAPTURE)) return false;
    $depth=0;
    foreach ($matches[0] as $token) {
        $markup=$token[0]; $offset=(int)$token[1];
        if (0===stripos($markup,'</')) {
            --$depth;
            if (0===$depth) {
                $end=$start+$offset+strlen($markup);
                return substr($html,0,$start).$replacement.substr($html,$end);
            }
        } else { ++$depth; }
    }
    return false;
}

/** Replace the next balanced HTML element after a stable marker. */
function bes_site_core_batch_b_replace_next_element( $html, $tag, $marker, $replacement ) {
    $marker_pos=strpos($html,$marker);
    if (false===$marker_pos) return false;
    $start=stripos($html,'<'.$tag,$marker_pos+strlen($marker));
    if (false===$start) return false;
    $slice=substr($html,$start);
    if (!preg_match_all('#</?'.preg_quote($tag,'#').'\\b[^>]*>#i',$slice,$matches,PREG_OFFSET_CAPTURE)) return false;
    $depth=0;
    foreach ($matches[0] as $token) {
        $markup=$token[0]; $offset=(int)$token[1];
        if (0===stripos($markup,'</')) {
            --$depth;
            if (0===$depth) {
                $end=$start+$offset+strlen($markup);
                return substr($html,0,$start).$replacement.substr($html,$end);
            }
        } else { ++$depth; }
    }
    return false;
}

function bes_site_core_batch_b_render_card_grid( array $cards, $variant ) {
    $academy='academy'===$variant;
    $grid=$academy?'grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8':'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 md:gap-8 mb-12 md:mb-16';
    $feedback=$academy?'988862-section-4':'988860-section-3';
    $height=$academy?'360px':'420px';
    $shadow=$academy?'shadow-xl shadow-black/50':'shadow-xl shadow-black/40';
    $overlay=$academy?'absolute inset-0 bg-[#1a0a02]/45 z-10 group-hover:bg-[#1a0a02]/20 transition-colors duration-[1s]':'absolute inset-0 bg-bes-forest/55 z-10 group-hover:bg-bes-forest/20 transition-colors duration-[1s]';
    $gradient=$academy?'background: linear-gradient(to top, rgba(18, 7, 1, 0.94) 0%, rgba(18, 7, 1, 0.26) 55%, rgba(18, 7, 1, 0.08) 100%);':'background: linear-gradient(to top, rgba(21, 30, 16, 0.92) 0%, rgba(21, 30, 16, 0.22) 55%, rgba(21, 30, 16, 0.08) 100%);';
    ob_start(); ?>
    <div class="<?php echo esc_attr($grid); ?>" data-bes-feedback="<?php echo esc_attr($feedback); ?>">
    <?php foreach ($cards as $card) :
        $url=$card['link'];
        if ($url && bes_v2_is_internal_url($url) && bes_v2_is_preview_active()) $url=bes_v2_append_preview_param($url); ?>
        <article class="relative rounded-2xl overflow-hidden group <?php echo esc_attr($shadow); ?> bes-reveal" style="min-height:<?php echo esc_attr($height); ?>;transition-delay:<?php echo esc_attr($card['delay']); ?>;">
            <?php if ($url) : ?><a href="<?php echo esc_url($url); ?>" class="absolute inset-0 z-40" aria-label="<?php echo esc_attr(wp_strip_all_tags($card['title'].' '.$card['subtitle'])); ?>"></a><?php endif; ?>
            <div class="<?php echo esc_attr($overlay); ?>"></div>
            <?php echo bes_v2_get_full_media_image_html($card,array('class'=>'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s] ease-out','loading'=>'lazy','decoding'=>'async')); ?>
            <div class="absolute inset-0 z-20 pointer-events-none" style="<?php echo esc_attr($gradient); ?>"></div>
            <div class="absolute inset-x-0 bottom-0 z-30 p-7 md:p-8 flex flex-col justify-end">
                <div class="font-body text-[9px] font-bold tracking-[0.24em] uppercase !text-bes-gold opacity-80 mb-3"><?php echo esc_html($card['eyebrow']); ?></div>
                <h3 class="font-display text-3xl md:text-[34px] text-bes-ivory mb-1 font-medium leading-tight"><?php echo wp_kses_post($card['title']); ?></h3>
                <?php if (!empty($card['subtitle'])) : ?><p class="font-body text-[10px] md:text-[11px] font-bold tracking-[0.18em] uppercase !text-bes-gold leading-snug"><?php echo esc_html($card['subtitle']); ?></p><?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
    </div><?php
    return ob_get_clean();
}

function bes_site_core_batch_b_render_faq_section() {
    $faqs=bes_site_core_batch_b_faqs(); $split=(int)ceil(count($faqs)/2);
    $columns=array(array_slice($faqs,0,$split),array_slice($faqs,$split));
    ob_start(); ?>
    <section class="relative py-24 md:py-32 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden" data-bes-feedback="988978-988980-988982-section-9">
        <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-bes-forest to-transparent pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position:center top;filter:invert(1);"></div>
        <div class="relative max-w-[1280px] mx-auto">
            <div class="text-center mb-16 md:mb-20 bes-reveal">
                <div class="flex items-center justify-center gap-3 mb-5"><span class="w-8 h-[1px] bg-bes-leaf/30"></span><span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">Panduan Perjalanan</span><span class="w-8 h-[1px] bg-bes-leaf/30"></span></div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">FAQ</h2>
                <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">Temukan jawaban atas berbagai pertanyaan yang sering diajukan sebelum memulai perjalanan bersama Bali Eling Spirit. Mulai dari program, reservasi, hingga hal-hal yang perlu Anda persiapkan.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 items-start bes-reveal" style="transition-delay:0.2s;">
            <?php foreach ($columns as $column) : ?><div class="flex flex-col gap-4"><?php foreach ($column as $faq) : ?>
                <div class="bes-faq-item-v2 bg-black/20 border border-white/[0.04] rounded-2xl overflow-hidden transition-colors duration-500 hover:border-bes-leaf/30">
                    <button class="bes-faq-btn-v2 w-full flex items-center justify-between gap-6 p-6 text-left focus:outline-none group" aria-expanded="false"><span class="font-display text-lg md:text-xl text-bes-ivory font-medium group-hover:!text-bes-leaf transition-colors duration-300"><?php echo esc_html($faq['q']); ?></span><div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center flex-shrink-0 group-hover:border-bes-leaf/50 transition-colors duration-300 bg-white/[0.02]"><i class="fa-solid fa-plus text-bes-leaf/70 text-sm bes-faq-icon-v2 transition-transform duration-500"></i></div></button>
                    <div class="bes-faq-content-v2 max-h-0 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] bg-bes-forest/30"><div class="p-6 pt-0 font-body text-[14px] text-bes-parchment/60 leading-relaxed"><?php echo esc_html($faq['a']); ?></div></div>
                </div>
            <?php endforeach; ?></div><?php endforeach; ?>
            </div>
            <div class="mt-16 text-center bes-reveal" style="transition-delay:0.3s;"><p class="font-body text-bes-parchment/50 text-sm mb-6">Butuh informasi lebih lanjut? Silakan hubungi kami.</p><a href="https://wa.me/6287825989117" target="_blank" rel="noopener" class="inline-flex items-center gap-3 px-8 py-3.5 rounded-full border border-bes-leaf text-bes-forest bg-bes-leaf font-body text-[11px] uppercase tracking-[0.2em] font-bold hover:bg-transparent hover:!text-bes-leaf transition-all duration-300"><i class="fa-brands fa-whatsapp text-sm"></i> Hubungi Kami</a></div>
        </div>
    </section><?php return ob_get_clean();
}

function bes_site_core_render_homepage_batch_b() {
    $baseline=bes_render_home_content_v2(); $target=$baseline;
    $ops=array(
        array('div','data-bes-feedback="988860-section-3"',bes_site_core_batch_b_render_card_grid(bes_site_core_batch_b_sanctuary_cards(),'sanctuary')),
        array('div','data-bes-feedback="988862-section-4"',bes_site_core_batch_b_render_card_grid(bes_site_core_batch_b_academy_cards(),'academy')),
        array('section','data-bes-feedback="988978-988980-988982-section-9"',bes_site_core_batch_b_render_faq_section()),
    );
    foreach ($ops as $op) { $next=bes_site_core_batch_b_replace_element($target,$op[0],$op[1],$op[2]); if (false===$next) return $baseline; $target=$next; }
    return $target;
}

function bes_site_core_batch_b_footer_links(array $items) {
    ob_start(); ?><ul class="space-y-3"><?php foreach ($items as $item) : ?><li><a href="<?php echo esc_url($item['href']); ?>" class="bes-ftr-link text-[13px] text-white/40 hover:!text-bes-leaf transition-all group pb-1"><span class="w-1 h-1 rounded-full bg-bes-leaf/20 group-hover:bg-bes-leaf group-hover:shadow-[0_0_6px_rgba(194,210,74,.3)] transition-all flex-shrink-0"></span><span><?php echo esc_html($item['label']); ?></span><span class="bes-keris-stripe w-8 bg-gradient-to-r from-bes-leaf/80 to-transparent"></span></a></li><?php endforeach; ?></ul><?php return ob_get_clean();
}

/** Preserve the Global Assets footer chrome/Get in Touch; replace copy/lists only. */
function bes_site_core_batch_b_transform_footer($baseline) {
    $old='Sebuah sanctuary spiritual wellness yang berakar pada kearifan autentik Bali, melestarikan warisan suci melalui yoga, meditasi, dan ajaran Dharma untuk menghadirkan kehidupan yang lebih sadar, seimbang, dan harmonis.';
    $new='Tempat Anda bertransformasi, menemukan jati diri, dan membangun keseimbangan hidup melalui yoga, meditasi, dan Dharma. Berakar pada kearifan spiritual Bali.';
    $wa=(defined('BES_CONTACT')&&is_array(BES_CONTACT)&&!empty(BES_CONTACT['whatsapp']))?preg_replace('/\\D+/','',(string)BES_CONTACT['whatsapp']):'';
    ob_start(); ?><p class="text-sm leading-relaxed text-white/40 max-w-[360px] font-body font-light"><?php echo esc_html($new); ?></p><?php if ($wa) : ?><a href="https://wa.me/<?php echo esc_attr($wa); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 mt-5 text-[10.5px] font-bold uppercase tracking-[0.16em] text-bes-leaf hover:!text-bes-ivory transition-colors"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i><span>Hubungi via WhatsApp</span></a><?php endif; ?><?php $brand=ob_get_clean();
    $target=bes_site_core_batch_b_replace_element($baseline,'p',$old,$brand); if (false===$target) return $baseline;
    $target=str_replace('>Menu</h3>','>Explore</h3>',$target,$count); if (1!==$count) return $baseline;
    $explore=array(
        array('label'=>'Home','href'=>'/'),array('label'=>'About Us','href'=>'/about-us/'),array('label'=>'Sanctuary','href'=>'/sanctuary/'),array('label'=>'Academy','href'=>'/#academy'),array('label'=>'Pasraman','href'=>'/pasraman/'),array('label'=>'Partnership','href'=>'/partnership/'),array('label'=>'Wisdom','href'=>'/wisdom/'),
    );
    $target=bes_site_core_batch_b_replace_next_element($target,'ul','>Explore</h3>',bes_site_core_batch_b_footer_links($explore)); if (false===$target) return $baseline;
    $programs=array(
        array('label'=>'Healing & Therapy','href'=>'/healing-therapy/'),array('label'=>'Retreats','href'=>'/eling-sanctuary-retreat/'),array('label'=>'Tapa Brata','href'=>'/program-bahasa-indonesia/'),array('label'=>'Corporate Service','href'=>'/corporate-services/'),array('label'=>'Yoga Teacher Training','href'=>'/yoga-teacher-training/'),array('label'=>'Eling Meditation Course','href'=>'/meditation-course/'),array('label'=>'Eling Sound Healing Course','href'=>'/eling-sound-healing-course/'),
    );
    $target=bes_site_core_batch_b_replace_next_element($target,'ul','>Programs</h3>',bes_site_core_batch_b_footer_links($programs));
    return false===$target?$baseline:$target;
}

function bes_site_core_batch_b_footer() {
    if (!function_exists('bes_footer')) return;
    ob_start(); bes_footer(); $baseline=ob_get_clean();
    echo bes_site_core_batch_b_transform_footer($baseline); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function bes_site_core_batch_b_prepare_footer() {
    static $prepared=false;
    if ($prepared||!function_exists('bes_footer')) return;
    remove_action('wp_footer','bes_footer',10);
    add_action('wp_footer','bes_site_core_batch_b_footer',10);
    $prepared=true;
}

/* Staged only: modules.php keeps Homepage in PLUGIN_SHADOW until real cutover. */
remove_shortcode('bes_home_content_v2');
add_shortcode('bes_home_content_v2','bes_site_core_render_homepage_batch_b');
add_shortcode('bes_home_content','bes_site_core_render_homepage_batch_b');
add_action('wp','bes_site_core_batch_b_prepare_footer',99);
