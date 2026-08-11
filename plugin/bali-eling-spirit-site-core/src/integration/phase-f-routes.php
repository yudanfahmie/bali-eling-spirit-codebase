<?php
/** Final pre-UAT compatibility hardening across already-built Phase B–F renderers. */
if ( ! defined( 'ABSPATH' ) ) exit;

function bes_site_core_phase_f_route_replacements() {
    return array(
        '/program-bahasa-indonesia/' => bes_site_core_program_route('tapa-brata','/eling-tapa-brata/'),
        '/meditation-course/' => bes_site_core_program_route('meditation','/yoga-teacher-training/eling-meditation-course/'),
        '/healing-therapy/' => bes_site_core_program_route('healing-therapy','/healing-therapy/'),
        '/eling-sanctuary-retreat/' => bes_site_core_program_route('retreats','/eling-sanctuary-retreat/'),
        '/corporate-services/' => bes_site_core_program_route('corporate-service','/corporate-services/'),
        '/yoga-teacher-training/' => bes_site_core_program_route('ytt','/yoga-teacher-training/'),
        '/eling-sound-healing-course/' => bes_site_core_program_route('sound-healing','/eling-sound-healing-course/'),
        '/bali-eling-spirit-50h-hybrid/' => bes_site_core_program_route('ytt-50h-hybrid','/bali-eling-spirit-50h-hybrid/'),
        '/bali-eling-spirit-50h/' => bes_site_core_program_route('ytt-50h','/bali-eling-spirit-50h/'),
        '/bali-eling-spirit-100h/' => bes_site_core_program_route('ytt-100h','/bali-eling-spirit-100h/'),
        '/bali-eling-spirit-200h-hybrid/' => bes_site_core_program_route('ytt-200h-hybrid','/bali-eling-spirit-200h-hybrid/'),
        '/bali-eling-spirit-200h/' => bes_site_core_program_route('ytt-200h','/bali-eling-spirit-200h/'),
        '/program/300-hour-yoga-teacher-training/' => bes_site_core_program_route('ytt-300h','/program/300-hour-yoga-teacher-training/'),
    );
}

function bes_site_core_phase_f_canonicalize_routes( $html ) {
    return strtr((string)$html,bes_site_core_phase_f_route_replacements());
}

function bes_site_core_phase_f_replace_element( $html, $tag, $marker, $replacement ) {
    $marker_pos=strpos($html,$marker); if(false===$marker_pos)return false;
    $start=strripos(substr($html,0,$marker_pos),'<'.$tag); if(false===$start)return false;
    $slice=substr($html,$start);
    if(!preg_match_all('#</?'.preg_quote($tag,'#').'\\b[^>]*>#i',$slice,$matches,PREG_OFFSET_CAPTURE))return false;
    $depth=0;
    foreach($matches[0] as $token){$markup=$token[0];$offset=(int)$token[1];if(0===stripos($markup,'</')){--$depth;if(0===$depth){$end=$start+$offset+strlen($markup);return substr($html,0,$start).$replacement.substr($html,$end);}}else{++$depth;}}
    return false;
}

function bes_site_core_phase_f_sanctuary_faq() {
    $faqs=array(
        array('q'=>'Apa saja kategori yang tersedia di Sanctuary?','a'=>'Sanctuary memiliki empat kategori utama: Healing & Therapy, Retreats, Tapa Brata, dan Corporate Service. Setiap kategori memiliki halaman khusus agar Sahabat dapat meninjau konteks dan detail yang memang tersedia untuk perjalanan tersebut.'),
        array('q'=>'Bagaimana memilih perjalanan Sanctuary yang sesuai?','a'=>'Mulailah dari kebutuhan Sahabat saat ini. Keempat kategori berdiri sebagai jalur yang berbeda dan tidak membentuk urutan tingkat yang wajib diikuti.'),
        array('q'=>'Apakah saya harus mengikuti kategori Sanctuary secara berurutan?','a'=>'Tidak. Tidak ada progresi wajib dari satu kategori ke kategori lain. Sahabat dapat mengeksplorasi lebih dari satu perjalanan sesuai kebutuhan dan ketentuan program yang dipilih.'),
        array('q'=>'Apakah saya perlu pengalaman yoga atau meditasi sebelumnya?','a'=>'Persyaratan dapat berbeda menurut kategori atau program. Silakan periksa halaman khusus perjalanan yang dipilih untuk melihat prasyarat atau ketentuan yang memang berlaku.'),
        array('q'=>'Apakah jadwal, format, dan fasilitas sama untuk semua kategori?','a'=>'Tidak. Jadwal, format, durasi, fasilitas, dan cakupan layanan dapat berbeda menurut perjalanan. Tidak ada satu daftar inklusi universal untuk seluruh kategori Sanctuary.'),
        array('q'=>'Kapan saya sebaiknya melakukan reservasi?','a'=>'Ketersediaan berbeda menurut perjalanan dan intake. Tinjau halaman program yang dipilih dan konfirmasikan melalui kanal yang tercantum pada perjalanan tersebut sebelum datang.'),
    );
    ob_start(); ?>
    <section class="bg-bes-ivory py-20 md:py-28" aria-label="Frequently asked questions"><div class="max-w-[1440px] mx-auto px-6 md:px-10"><div class="text-center mb-14"><p class="bes-reveal font-body font-bold text-[10px] uppercase tracking-nav text-bes-moss mb-4">Choosing &amp; Arriving</p><h2 class="bes-reveal font-display font-medium text-bes-bark text-4xl md:text-5xl tracking-display">Before You Choose</h2><p class="bes-reveal font-body font-light text-bes-bark-muted text-sm mt-4 max-w-xl mx-auto leading-relaxed">Pertanyaan umum tentang empat kategori Sanctuary. Detail program tetap berada pada halaman perjalanan masing-masing.</p></div><div class="max-w-3xl mx-auto space-y-4"><?php foreach($faqs as $faq): ?><div class="bes-reveal rounded-2xl border border-bes-sand overflow-hidden" style="background:linear-gradient(160deg,#fdfcfa,#f7f4ee)"><button class="w-full flex items-center justify-between gap-4 p-6 text-left group" aria-expanded="false" onclick="besFaqToggle(this)" type="button"><span class="font-display font-medium text-bes-bark text-lg group-hover:!text-bes-olive transition-colors duration-300"><?php echo esc_html($faq['q']); ?></span><span class="flex-shrink-0 w-7 h-7 rounded-lg bg-bes-forest/[.05] border border-bes-forest/[.08] flex items-center justify-center" aria-hidden="true"><i class="fa-solid fa-plus text-bes-bark-muted text-[10px] bes-faq-icon transition-transform duration-300"></i></span></button><div class="bes-faq-body max-h-0 overflow-hidden transition-all duration-400 ease-in-out"><p class="font-body font-light text-bes-bark-muted text-[14px] leading-relaxed px-6 pb-6"><?php echo esc_html($faq['a']); ?></p></div></div><?php endforeach; ?></div></div></section>
    <?php return ob_get_clean();
}

function bes_site_core_phase_f_render_homepage( $atts=array() ) {
    if(!function_exists('bes_site_core_render_homepage_batch_b'))return '';
    $html=bes_site_core_render_homepage_batch_b($atts);
    $old='Sebagian besar program tersedia dalam Bahasa Indonesia dan Inggris. Beberapa program tertentu, seperti Tapa Brata dan YTT versi Hybrid, disampaikan khusus dalam Bahasa Indonesia.';
    $safe='Bahasa pengantar berbeda menurut program dan intake. Silakan periksa detail program yang dipilih dan konfirmasi bahasa pengantar untuk intake tersebut sebelum melakukan pemesanan, khususnya untuk format Hybrid.';
    return bes_site_core_phase_f_canonicalize_routes(str_replace($old,$safe,$html));
}
remove_shortcode('bes_home_content_v2'); remove_shortcode('bes_home_content');
add_shortcode('bes_home_content_v2','bes_site_core_phase_f_render_homepage'); add_shortcode('bes_home_content','bes_site_core_phase_f_render_homepage');

function bes_site_core_phase_f_render_sanctuary_hub() {
    if(!function_exists('bes_site_core_render_sanctuary_hub_phase_c'))return '';
    $html=bes_site_core_phase_f_canonicalize_routes(bes_site_core_render_sanctuary_hub_phase_c());
    $html=str_replace('<div class="border-t border-bes-sand pt-6">','<div class="hidden border-t border-bes-sand pt-6" data-bes-soft-deleted="legacy-three-depth-shared-principles">',$html);
    $next=bes_site_core_phase_f_replace_element($html,'section','aria-label="Frequently asked questions"',bes_site_core_phase_f_sanctuary_faq());
    return false===$next?$html:$next;
}
remove_shortcode('bes_sanctuary_hub'); add_shortcode('bes_sanctuary_hub','bes_site_core_phase_f_render_sanctuary_hub');

function bes_site_core_phase_f_render_ytt( $atts=array() ) {
    return function_exists('bes_site_core_render_ytt_phase_d') ? bes_site_core_phase_f_canonicalize_routes(bes_site_core_render_ytt_phase_d($atts)) : '';
}
remove_shortcode('bes_yoga_teacher_training'); add_shortcode('bes_yoga_teacher_training','bes_site_core_phase_f_render_ytt');

function bes_site_core_phase_f_render_personal_session() {
    if(!function_exists('bes_site_core_render_personal_session_yogi'))return '';
    $html=bes_site_core_render_personal_session_yogi();
    $html=str_replace('https://wa.me/6287825899117',bes_site_core_contact_url('personal_session','https://wa.me/6287825899117'),$html);
    $next=bes_site_core_phase_f_replace_element($html,'section','Kenali Pendamping Perjalanan Sahabat','');
    return false===$next?$html:$next;
}
remove_shortcode('bes_personal_session_yogi'); add_shortcode('bes_personal_session_yogi','bes_site_core_phase_f_render_personal_session');

function bes_site_core_phase_f_footer() {
    if(!function_exists('bes_site_core_batch_b_footer'))return;
    ob_start(); bes_site_core_batch_b_footer(); $html=ob_get_clean();
    echo bes_site_core_phase_f_canonicalize_routes($html); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
function bes_site_core_phase_f_prepare_footer_routes() {
    if(!function_exists('bes_site_core_batch_b_footer'))return;
    remove_action('wp_footer','bes_site_core_batch_b_footer',10);
    add_action('wp_footer','bes_site_core_phase_f_footer',10);
}
add_action('wp','bes_site_core_phase_f_prepare_footer_routes',100);
