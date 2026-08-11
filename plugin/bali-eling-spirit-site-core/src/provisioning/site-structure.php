<?php
/** Compact, repeat-safe Phase F site-structure provisioner. */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'BES_SITE_CORE_STRUCTURE_VERSION' ) ) {
    define( 'BES_SITE_CORE_STRUCTURE_VERSION', 3 );
}

function bes_site_core_structure_program_path( $key, $default ) {
    return function_exists('bes_site_core_program_path') ? bes_site_core_program_path($key,$default) : $default;
}

function bes_site_core_structure_pages() {
    return array(
        'sanctuary' => array('title'=>'Sanctuary','slug'=>'sanctuary','path'=>bes_site_core_structure_program_path('sanctuary','sanctuary'),'shortcode'=>'bes_sanctuary_hub'),
        'healing-therapy' => array('title'=>'Healing & Therapy','slug'=>'healing-therapy','path'=>bes_site_core_structure_program_path('healing-therapy','healing-therapy'),'shortcode'=>'bes_healing_therapy'),
        'eling-sanctuary-retreat' => array('title'=>'Eling Sanctuary Retreat','slug'=>'eling-sanctuary-retreat','path'=>bes_site_core_structure_program_path('retreats','eling-sanctuary-retreat'),'shortcode'=>'bes_eling_sanctuary_retreat'),
        'eling-tapa-brata' => array('title'=>'Eling Tapa Brata','slug'=>'eling-tapa-brata','path'=>bes_site_core_structure_program_path('tapa-brata','eling-tapa-brata'),'shortcode'=>'bes_eling_tapa_brata'),
        'corporate-services' => array('title'=>'Corporate Services','slug'=>'corporate-services','path'=>bes_site_core_structure_program_path('corporate-service','corporate-services'),'shortcode'=>'bes_corporate_services'),
        // Explicit approved migration: keep /eling-guiding/ but update title + body contract.
        'personal-session-yogi' => array('title'=>'Personal Session with Yogi','slug'=>'eling-guiding','path'=>bes_site_core_structure_program_path('personal-session','eling-guiding'),'shortcode'=>'bes_personal_session_yogi','migrate'=>true,'migrate_title'=>true),
        'yoga-teacher-training' => array('title'=>'Yoga Teacher Training','slug'=>'yoga-teacher-training','path'=>bes_site_core_structure_program_path('ytt','yoga-teacher-training'),'shortcode'=>'bes_yoga_teacher_training'),
        // Existing detail routes are validation targets; Phase F must not duplicate them.
        'ytt-50h-hybrid' => array('title'=>'50H Hybrid Yoga Teacher Training','slug'=>'bali-eling-spirit-50h-hybrid','path'=>bes_site_core_structure_program_path('ytt-50h-hybrid','bali-eling-spirit-50h-hybrid'),'shortcode'=>'bes_ytt_50h_hybrid_landing','create'=>false),
        'ytt-50h' => array('title'=>'50H Yoga Teacher Training','slug'=>'bali-eling-spirit-50h','path'=>bes_site_core_structure_program_path('ytt-50h','bali-eling-spirit-50h'),'shortcode'=>'bes_ytt_50h_landing','create'=>false),
        'ytt-100h' => array('title'=>'100H Yoga Teacher Training','slug'=>'bali-eling-spirit-100h','path'=>bes_site_core_structure_program_path('ytt-100h','bali-eling-spirit-100h'),'shortcode'=>'bes_ytt_100h_landing'),
        'ytt-200h-hybrid' => array('title'=>'200H Hybrid Yoga Teacher Training','slug'=>'bali-eling-spirit-200h-hybrid','path'=>bes_site_core_structure_program_path('ytt-200h-hybrid','bali-eling-spirit-200h-hybrid'),'shortcode'=>'bes_ytt_200h_hybrid_landing','create'=>false),
        'ytt-200h' => array('title'=>'200H Yoga Teacher Training','slug'=>'bali-eling-spirit-200h','path'=>bes_site_core_structure_program_path('ytt-200h','bali-eling-spirit-200h'),'shortcode'=>'bes_ytt_200h_landing','create'=>false),
        'meditation-course' => array('title'=>'Eling Meditation Course','slug'=>'eling-meditation-course','path'=>bes_site_core_structure_program_path('meditation','yoga-teacher-training/eling-meditation-course'),'parent'=>'yoga-teacher-training','shortcode'=>'bes_meditation_course'),
        'sound-healing-course' => array('title'=>'Eling Sound Healing Course','slug'=>'eling-sound-healing-course','path'=>bes_site_core_structure_program_path('sound-healing','eling-sound-healing-course'),'shortcode'=>'bes_sound_healing_course'),
        'pasraman' => array('title'=>'Pasraman Bali Eling Spirit','slug'=>'pasraman','path'=>bes_site_core_structure_program_path('pasraman','pasraman'),'shortcode'=>'bes_pasraman','migrate'=>true),
    );
}

function bes_site_core_structure_menu() {
    return array(
        array('key'=>'about-us','title'=>'About Us','slug'=>'about-us'),
        array('key'=>'sanctuary','title'=>'Sanctuary','page'=>'sanctuary'),
        array('key'=>'healing-therapy','title'=>'Healing & Therapy','page'=>'healing-therapy','parent'=>'sanctuary'),
        array('key'=>'retreats','title'=>'Retreats','page'=>'eling-sanctuary-retreat','parent'=>'sanctuary'),
        array('key'=>'tapa-brata','title'=>'Tapa Brata','page'=>'eling-tapa-brata','parent'=>'sanctuary'),
        array('key'=>'corporate-service','title'=>'Corporate Service','page'=>'corporate-services','parent'=>'sanctuary'),
        array('key'=>'academy','title'=>'Academy','structural'=>true),
        array('key'=>'ytt','title'=>'Yoga Teacher Training','page'=>'yoga-teacher-training','parent'=>'academy'),
        array('key'=>'meditation','title'=>'Eling Meditation Course','page'=>'meditation-course','parent'=>'academy'),
        array('key'=>'sound-healing','title'=>'Eling Sound Healing Course','page'=>'sound-healing-course','parent'=>'academy'),
        array('key'=>'pasraman','title'=>'Pasraman','page'=>'pasraman'),
        array('key'=>'partnership','title'=>'Partnership','slug'=>'partnership'),
        array('key'=>'wisdom','title'=>'Wisdom','slug'=>'wisdom'),
    );
}

function bes_site_core_validate_structure_contract() {
    $errors = function_exists('bes_site_core_validate_program_facts') ? bes_site_core_validate_program_facts() : array('Program facts config unavailable.');
    $slugs = array(); $paths = array(); $keys = array(); $pages = bes_site_core_structure_pages();
    foreach ( $pages as $key => $page ) {
        if ( empty($page['title']) || empty($page['slug']) || empty($page['shortcode']) ) $errors[] = 'Incomplete page: '.$key;
        if ( isset($slugs[$page['slug']]) ) $errors[] = 'Duplicate page slug: '.$page['slug'];
        $slugs[$page['slug']] = true;
        $path = ! empty($page['path']) ? $page['path'] : $page['slug'];
        if ( isset($paths[$path]) ) $errors[] = 'Duplicate page path: '.$path;
        $paths[$path] = true;
    }
    foreach ( bes_site_core_structure_menu() as $item ) {
        if ( empty($item['key']) || empty($item['title']) ) $errors[] = 'Incomplete menu item.';
        if ( isset($keys[$item['key']]) ) $errors[] = 'Duplicate menu key: '.$item['key'];
        $keys[$item['key']] = true;
        if ( ! empty($item['page']) && ! isset($pages[$item['page']]) ) $errors[] = 'Unknown menu page target: '.$item['page'];
    }
    foreach ( bes_site_core_structure_menu() as $item ) {
        if ( ! empty($item['parent']) && ! isset($keys[$item['parent']]) ) $errors[] = 'Unknown menu parent: '.$item['parent'];
    }
    return array_values(array_unique($errors));
}

function bes_site_core_validate_structure_shortcodes() {
    $out = array('available'=>array(),'missing'=>array(),'map'=>array());
    foreach ( bes_site_core_structure_pages() as $page ) {
        $exists = shortcode_exists($page['shortcode']);
        $out['map'][$page['shortcode']] = $exists;
        $out[$exists ? 'available' : 'missing'][] = $page['shortcode'];
    }
    $out['available'] = array_values(array_unique($out['available']));
    $out['missing'] = array_values(array_unique($out['missing']));
    return $out;
}

function bes_site_core_find_page( $page ) {
    $path = ! empty($page['path']) ? $page['path'] : $page['slug'];
    $found = get_page_by_path($path,OBJECT,'page');
    if ( $found || ! empty($page['path']) ) return $found;
    $matches = get_posts(array('post_type'=>'page','post_status'=>array('publish','draft','private','pending','future'),'name'=>$page['slug'],'posts_per_page'=>1,'no_found_rows'=>true));
    return $matches ? $matches[0] : null;
}

function bes_site_core_resolve_parent_id( $page, $resolved ) {
    if ( empty($page['parent']) ) return 0;
    foreach ( bes_site_core_structure_pages() as $key => $candidate ) {
        if ( $candidate['slug'] === $page['parent'] && ! empty($resolved[$key]) ) return (int)$resolved[$key];
    }
    $parent = get_page_by_path($page['parent'],OBJECT,'page');
    return $parent ? (int)$parent->ID : 0;
}

function bes_site_core_provision_pages( $shortcodes ) {
    $out = array('pages'=>array(),'created'=>0,'migrated'=>0,'retitled'=>0,'warnings'=>array(),'errors'=>array(),'skipped'=>array());
    foreach ( bes_site_core_structure_pages() as $key => $page ) {
        if ( empty($shortcodes['map'][$page['shortcode']]) ) {
            $out['warnings'][] = 'Skipped '.$page['slug'].': required shortcode ['.$page['shortcode'].'] is unavailable.';
            $out['skipped'][] = $key;
            continue;
        }

        $post = bes_site_core_find_page($page);
        if ( ! $post && isset($page['create']) && ! $page['create'] ) {
            $out['warnings'][] = 'Expected existing page missing: '.$page['path'];
            continue;
        }
        if ( ! $post ) {
            $id = wp_insert_post(array(
                'post_type'=>'page','post_status'=>'publish','post_title'=>$page['title'],'post_name'=>$page['slug'],
                'post_parent'=>bes_site_core_resolve_parent_id($page,$out['pages']),'post_content'=>'['.$page['shortcode'].']'
            ),true);
            if ( is_wp_error($id) ) { $out['errors'][] = $page['slug'].': '.$id->get_error_message(); continue; }
            $out['created']++; $out['pages'][$key]=(int)$id; continue;
        }

        $out['pages'][$key]=(int)$post->ID;
        $update = array('ID'=>$post->ID); $needs_update=false; $content_changed=false; $title_changed=false;
        if ( ! empty($page['migrate']) && trim((string)$post->post_content) !== '['.$page['shortcode'].']' ) {
            $update['post_content']='['.$page['shortcode'].']'; $needs_update=true; $content_changed=true;
        } elseif ( empty($page['migrate']) && ! has_shortcode((string)$post->post_content,$page['shortcode']) ) {
            $out['warnings'][] = 'Existing page needs shortcode review: '.$page['path'];
        }
        if ( ! empty($page['migrate_title']) && (string)$post->post_title !== $page['title'] ) {
            $update['post_title']=$page['title']; $needs_update=true; $title_changed=true;
        }
        if ( $needs_update ) {
            $updated = wp_update_post($update,true);
            if ( is_wp_error($updated) ) { $out['errors'][] = $page['slug'].': '.$updated->get_error_message(); continue; }
            if ( $content_changed ) $out['migrated']++;
            if ( $title_changed ) $out['retitled']++;
        }
    }
    return $out;
}

function bes_site_core_page_url_from_contract( $item, $page_ids ) {
    if ( ! empty($item['page']) ) return ! empty($page_ids[$item['page']]) ? get_permalink($page_ids[$item['page']]) : '';
    if ( ! empty($item['slug']) ) { $page=get_page_by_path($item['slug'],OBJECT,'page'); return $page ? get_permalink($page) : ''; }
    return '';
}

function bes_site_core_find_menu_item( $items, $item, $page_ids, $url ) {
    $page_id = ! empty($item['page']) && ! empty($page_ids[$item['page']]) ? (int)$page_ids[$item['page']] : 0;
    foreach ( $items as $existing ) if ( $page_id && 'post_type' === $existing->type && (int)$existing->object_id === $page_id ) return $existing;
    $target = untrailingslashit($url);
    foreach ( $items as $existing ) if ( $target && untrailingslashit((string)$existing->url) === $target ) return $existing;
    foreach ( $items as $existing ) if ( 0 === strcasecmp(trim((string)$existing->title),$item['title']) ) return $existing;
    return null;
}

function bes_site_core_sync_menu_48( $page_ids ) {
    $out = array('status'=>'not-run','created'=>0,'updated'=>0,'deduplicated'=>0,'warnings'=>array(),'errors'=>array());
    $menu = wp_get_nav_menu_object(48);
    if ( ! $menu ) { $out['status']='missing-menu'; $out['errors'][]='Menu ID 48 was not found.'; return $out; }
    $items = wp_get_nav_menu_items(48,array('post_status'=>'any')); if ( ! is_array($items) ) $items=array();
    $ids=array(); $position=1;
    foreach ( bes_site_core_structure_menu() as $spec ) {
        if ( ! empty($spec['parent']) && empty($ids[$spec['parent']]) ) {
            $out['errors'][]='Skipped '.$spec['title'].': parent menu item '.$spec['parent'].' is unavailable.'; $position++; continue;
        }
        if ( ! empty($spec['page']) && empty($page_ids[$spec['page']]) ) {
            $out['errors'][]='Skipped '.$spec['title'].': managed page target '.$spec['page'].' is unavailable.'; $position++; continue;
        }
        $url = ! empty($spec['structural']) ? '' : bes_site_core_page_url_from_contract($spec,$page_ids);
        if ( empty($spec['structural']) && '' === $url ) {
            $out['errors'][]='Skipped '.$spec['title'].': destination could not be resolved.'; $position++; continue;
        }
        $parent = ! empty($spec['parent']) ? (int)$ids[$spec['parent']] : 0;
        $existing = bes_site_core_find_menu_item($items,$spec,$page_ids,$url);
        $args=array('menu-item-title'=>$spec['title'],'menu-item-status'=>'publish','menu-item-parent-id'=>$parent,'menu-item-position'=>$position);
        $position++;
        if ( ! empty($spec['structural']) ) {
            $args += array('menu-item-type'=>'custom','menu-item-url'=>'','menu-item-classes'=>'bes-menu-structural-parent');
        } elseif ( ! empty($spec['page']) ) {
            $args += array('menu-item-type'=>'post_type','menu-item-object'=>'page','menu-item-object-id'=>$page_ids[$spec['page']]);
        } else {
            $args += array('menu-item-type'=>'custom','menu-item-url'=>$url);
        }
        $menu_item_id=wp_update_nav_menu_item(48,$existing?$existing->ID:0,$args);
        if ( is_wp_error($menu_item_id) ) { $out['errors'][]=$spec['title'].': '.$menu_item_id->get_error_message(); continue; }
        $ids[$spec['key']]=(int)$menu_item_id; if($existing)$out['updated']++;else$out['created']++;
        $items=wp_get_nav_menu_items(48,array('post_status'=>'any')); if(!is_array($items))$items=array();
    }

    $items=wp_get_nav_menu_items(48,array('post_status'=>'any')); if(!is_array($items))$items=array();
    foreach ( bes_site_core_structure_menu() as $spec ) {
        if ( empty($ids[$spec['key']]) ) continue;
        $url=!empty($spec['structural'])?'':bes_site_core_page_url_from_contract($spec,$page_ids);
        $page_id=!empty($spec['page'])&&!empty($page_ids[$spec['page']])?(int)$page_ids[$spec['page']]:0;
        foreach($items as $existing){
            if((int)$existing->ID===(int)$ids[$spec['key']])continue;
            $same=$page_id&&'post_type'===$existing->type&&(int)$existing->object_id===$page_id;
            if(!$same&&$url)$same=untrailingslashit((string)$existing->url)===untrailingslashit($url);
            if(!$same&&!empty($spec['structural']))$same=0===strcasecmp(trim((string)$existing->title),$spec['title']);
            if($same){$deleted=wp_delete_post($existing->ID,true);if($deleted)$out['deduplicated']++;else$out['warnings'][]='Could not remove duplicate menu item: '.$spec['title'];}
        }
    }
    foreach($items as $existing){
        if(!empty($ids['academy'])&&(int)$existing->menu_item_parent===(int)$ids['academy']&&0===strcasecmp(trim((string)$existing->title),'Workshop')){
            if(!wp_delete_post($existing->ID,true))$out['warnings'][]='Could not remove Workshop from the primary Academy menu.';
        }
    }
    $out['status']=!empty($out['errors'])?'failed':(!empty($out['warnings'])?'concerns':'synchronized');
    return $out;
}

function bes_site_core_structure_is_applied( $result ) {
    return empty($result['contract_errors'])
        && empty($result['shortcodes']['missing'])
        && empty($result['pages']['errors'])
        && empty($result['menu']['errors'])
        && 'missing-menu' !== ($result['menu']['status'] ?? 'missing-menu');
}

function bes_site_core_provision_structure( $source='manual' ) {
    $result=array('version'=>BES_SITE_CORE_STRUCTURE_VERSION,'source'=>sanitize_key($source),'contract_errors'=>bes_site_core_validate_structure_contract());
    if($result['contract_errors']){ $result['applied']=false; update_option('bes_site_core_structure_status',$result,false); return $result; }
    $result['shortcodes']=bes_site_core_validate_structure_shortcodes();
    $result['pages']=bes_site_core_provision_pages($result['shortcodes']);
    $result['menu']=bes_site_core_sync_menu_48($result['pages']['pages']);
    if($result['pages']['created'])flush_rewrite_rules(false);
    $result['applied']=bes_site_core_structure_is_applied($result);
    update_option('bes_site_core_structure_status',$result,false); update_option('bes_site_core_structure_notice_pending',1,false);
    return $result;
}

function bes_site_core_store_structure_version_if_applied( $result ) {
    if ( ! empty($result['applied']) ) { update_option('bes_site_core_structure_version',BES_SITE_CORE_STRUCTURE_VERSION,false); return true; }
    return false;
}

function bes_site_core_activate_structure() { bes_site_core_store_structure_version_if_applied(bes_site_core_provision_structure('activation')); }
function bes_site_core_maybe_provision_structure() {
    if((int)get_option('bes_site_core_structure_version',0)>=BES_SITE_CORE_STRUCTURE_VERSION)return;
    if(get_transient('bes_site_core_structure_provision_lock'))return;
    set_transient('bes_site_core_structure_provision_lock',1,5*MINUTE_IN_SECONDS);
    $applied=bes_site_core_store_structure_version_if_applied(bes_site_core_provision_structure('version-update'));
    if($applied)delete_transient('bes_site_core_structure_provision_lock');
}
function bes_site_core_manual_provision_structure() {
    if(!current_user_can('manage_options'))wp_die(esc_html__('You are not allowed to provision the Bali Eling Spirit site structure.','bali-eling-spirit-site-core'));
    check_admin_referer('bes_site_core_provision_structure'); delete_transient('bes_site_core_structure_provision_lock');
    bes_site_core_store_structure_version_if_applied(bes_site_core_provision_structure('manual'));
    wp_safe_redirect(add_query_arg('bes_site_core_provisioned','1',wp_get_referer()?:admin_url('tools.php?page=bes-site-structure'))); exit;
}
function bes_site_core_structure_status_summary( $status ) {
    $created=isset($status['pages']['created'])?(int)$status['pages']['created']:0; $migrated=isset($status['pages']['migrated'])?(int)$status['pages']['migrated']:0; $retitled=isset($status['pages']['retitled'])?(int)$status['pages']['retitled']:0;
    $menu=$status['menu']['status']??'not-run'; $missing=isset($status['shortcodes']['missing'])?count($status['shortcodes']['missing']):0; $applied=!empty($status['applied'])?'yes':'no';
    return sprintf('Pages created: %d · migrated: %d · retitled: %d · Menu 48: %s · Missing shortcodes: %d · Applied: %s',$created,$migrated,$retitled,$menu,$missing,$applied);
}
function bes_site_core_structure_admin_notice() {
    if(!current_user_can('manage_options')||!get_option('bes_site_core_structure_notice_pending',0))return;
    $status=get_option('bes_site_core_structure_status',array()); if(!is_array($status))return; delete_option('bes_site_core_structure_notice_pending');
    $concerns=empty($status['applied'])||!empty($status['pages']['warnings'])||!empty($status['menu']['warnings']);
    echo '<div class="notice '.($concerns?'notice-warning':'notice-success').' is-dismissible"><p><strong>Bali Eling Spirit Site Structure</strong></p><p>'.esc_html(bes_site_core_structure_status_summary($status)).'</p><p><a href="'.esc_url(admin_url('tools.php?page=bes-site-structure')).'">View status / validate again</a></p></div>';
}
function bes_site_core_structure_admin_menu(){add_management_page('BES Site Structure','BES Site Structure','manage_options','bes-site-structure','bes_site_core_structure_tools_page');}
function bes_site_core_structure_tools_page(){
    if(!current_user_can('manage_options'))return; $status=get_option('bes_site_core_structure_status',array()); $status=is_array($status)?$status:array();
    echo '<div class="wrap"><h1>Bali Eling Spirit Site Structure</h1><p>Provisioning schema: <strong>'.esc_html((string)BES_SITE_CORE_STRUCTURE_VERSION).'</strong></p>';
    if($status)echo '<p>'.esc_html(bes_site_core_structure_status_summary($status)).'</p>';
    echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'"><input type="hidden" name="action" value="bes_site_core_provision_structure">';wp_nonce_field('bes_site_core_provision_structure');submit_button('Validate & Provision Site Structure','primary','submit',false);echo '</form></div>';
}
function bes_site_core_register_structure_provisioning(){
    if(defined('BES_SITE_CORE_FILE'))register_activation_hook(BES_SITE_CORE_FILE,'bes_site_core_activate_structure');
    // Cheap version check on normal requests; actual provisioning runs only while stale.
    add_action('init','bes_site_core_maybe_provision_structure',99);
    add_action('admin_post_bes_site_core_provision_structure','bes_site_core_manual_provision_structure');
    add_action('admin_notices','bes_site_core_structure_admin_notice'); add_action('admin_menu','bes_site_core_structure_admin_menu');
}
