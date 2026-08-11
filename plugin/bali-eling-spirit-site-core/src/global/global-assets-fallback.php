<?php
/**
 * Global Assets fallback adapter.
 * The historical WPCodeBox-compatible implementation remains intact in baseline/global-assets.php.
 * Menu ID 48 remains authoritative; this adapter only supplies deterministic fallback data when it is empty.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
require_once __DIR__ . '/global-assets.php';

function bes_site_core_global_fallback_menu_specs() {
    return array(
        array('key'=>'about-us','title'=>'About Us','url'=>'/about-us/'),
        array('key'=>'sanctuary','title'=>'Sanctuary','url'=>bes_site_core_program_route('sanctuary','/sanctuary/')),
        array('key'=>'healing-therapy','title'=>'Healing & Therapy','url'=>bes_site_core_program_route('healing-therapy','/healing-therapy/'),'parent'=>'sanctuary'),
        array('key'=>'retreats','title'=>'Retreats','url'=>bes_site_core_program_route('retreats','/eling-sanctuary-retreat/'),'parent'=>'sanctuary'),
        array('key'=>'tapa-brata','title'=>'Tapa Brata','url'=>bes_site_core_program_route('tapa-brata','/eling-tapa-brata/'),'parent'=>'sanctuary'),
        array('key'=>'corporate-service','title'=>'Corporate Service','url'=>bes_site_core_program_route('corporate-service','/corporate-services/'),'parent'=>'sanctuary'),
        array('key'=>'academy','title'=>'Academy','url'=>''),
        array('key'=>'ytt','title'=>'Yoga Teacher Training','url'=>bes_site_core_program_route('ytt','/yoga-teacher-training/'),'parent'=>'academy'),
        array('key'=>'meditation','title'=>'Eling Meditation Course','url'=>bes_site_core_program_route('meditation','/yoga-teacher-training/eling-meditation-course/'),'parent'=>'academy'),
        array('key'=>'sound-healing','title'=>'Eling Sound Healing Course','url'=>bes_site_core_program_route('sound-healing','/eling-sound-healing-course/'),'parent'=>'academy'),
        array('key'=>'pasraman','title'=>'Pasraman','url'=>bes_site_core_program_route('pasraman','/pasraman/')),
        array('key'=>'partnership','title'=>'Partnership','url'=>'/partnership/'),
        array('key'=>'wisdom','title'=>'Wisdom','url'=>'/wisdom/'),
    );
}

function bes_site_core_global_menu_48_fallback( $items, $menu, $args = array() ) {
    if ( ! empty($items) || is_wp_error($items) ) return $items;
    $menu_id = is_object($menu) && isset($menu->term_id) ? (int)$menu->term_id : (int)$menu;
    if ( 48 !== $menu_id ) return $items;

    $built=array(); $ids=array(); $next=900001;
    foreach ( bes_site_core_global_fallback_menu_specs() as $spec ) {
        $item=new stdClass();
        $item->ID=$next++;
        $item->title=$spec['title'];
        $item->url=$spec['url'];
        $item->menu_item_parent=!empty($spec['parent'])&&!empty($ids[$spec['parent']])?$ids[$spec['parent']]:0;
        $item->type='custom';
        $item->object='custom';
        $item->object_id=0;
        $ids[$spec['key']]=$item->ID;
        $built[]=$item;
    }
    return $built;
}
add_filter('wp_get_nav_menu_items','bes_site_core_global_menu_48_fallback',10,3);

function bes_site_core_global_fallback_program_links() {
    return array(
        array('label'=>'Healing &amp; Therapy','href'=>bes_site_core_program_route('healing-therapy','/healing-therapy/')),
        array('label'=>'Retreats','href'=>bes_site_core_program_route('retreats','/eling-sanctuary-retreat/')),
        array('label'=>'Tapa Brata','href'=>bes_site_core_program_route('tapa-brata','/eling-tapa-brata/')),
        array('label'=>'Corporate Service','href'=>bes_site_core_program_route('corporate-service','/corporate-services/')),
        array('label'=>'Yoga Teacher Training','href'=>bes_site_core_program_route('ytt','/yoga-teacher-training/')),
        array('label'=>'Eling Meditation Course','href'=>bes_site_core_program_route('meditation','/yoga-teacher-training/eling-meditation-course/')),
        array('label'=>'Eling Sound Healing Course','href'=>bes_site_core_program_route('sound-healing','/eling-sound-healing-course/')),
    );
}

function bes_site_core_global_patch_footer_programs( $html ) {
    $marker='>Programs</h3>';
    $marker_pos=strpos($html,$marker);
    if(false===$marker_pos)return $html;
    $start=stripos($html,'<ul',$marker_pos+strlen($marker));
    $end=false===$start?false:stripos($html,'</ul>',$start);
    if(false===$start||false===$end)return $html;
    $end+=5;
    ob_start(); ?><ul class="space-y-3"><?php foreach(bes_site_core_global_fallback_program_links() as $p): ?><li><a href="<?php echo esc_url($p['href']); ?>" class="bes-ftr-link text-[13px] text-white/40 hover:!text-bes-leaf transition-all group pb-1"><span class="w-1 h-1 rounded-full bg-bes-leaf/20 group-hover:bg-bes-leaf group-hover:shadow-[0_0_6px_rgba(194,210,74,.3)] transition-all flex-shrink-0"></span><span><?php echo wp_kses_post($p['label']); ?></span><span class="bes-keris-stripe w-8 bg-gradient-to-r from-bes-leaf/80 to-transparent"></span></a></li><?php endforeach; ?></ul><?php $replacement=ob_get_clean();
    return substr($html,0,$start).$replacement.substr($html,$end);
}

function bes_site_core_global_fallback_footer() {
    if(!function_exists('bes_footer'))return;
    ob_start(); bes_footer(); $html=ob_get_clean();
    echo bes_site_core_global_patch_footer_programs($html); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function bes_site_core_global_prepare_fallback_footer() {
    // Homepage/Phase F already owns a canonical footer when those modules are present.
    if(function_exists('bes_site_core_batch_b_footer')||function_exists('bes_site_core_phase_f_footer'))return;
    if(!function_exists('bes_footer'))return;
    remove_action('wp_footer','bes_footer',10);
    add_action('wp_footer','bes_site_core_global_fallback_footer',10);
}
add_action('wp','bes_site_core_global_prepare_fallback_footer',110);
