<?php
/** Small canonical catalog/contact facts shared by active BES surfaces. */
if ( ! defined( 'ABSPATH' ) ) exit;

function bes_site_core_program_facts() {
    static $facts = null;
    if ( null !== $facts ) return $facts;

    $blank = array(
        'key' => '', 'label' => '', 'route' => '', 'interaction' => 'page',
        'language' => null, 'duration' => null, 'schedule' => null, 'price' => null,
        'tax_behavior' => null, 'cta' => null, 'contact_channel' => null,
    );

    $rows = array(
        'sanctuary' => array('label'=>'Sanctuary','route'=>'/sanctuary/','cta'=>'Explore Sanctuary','contact_channel'=>'sanctuary'),
        'healing-therapy' => array('label'=>'Healing & Therapy','route'=>'/healing-therapy/','cta'=>'Lihat Healing & Therapy','contact_channel'=>'sanctuary'),
        'retreats' => array('label'=>'Retreats','route'=>'/eling-sanctuary-retreat/','cta'=>'Lihat Retreats','contact_channel'=>'sanctuary'),
        'tapa-brata' => array('label'=>'Tapa Brata','route'=>'/eling-tapa-brata/','language'=>'Bahasa Indonesia','duration'=>'4 Days · 3 Nights','cta'=>'Lihat Tapa Brata'),
        'corporate-service' => array('label'=>'Corporate Service','route'=>'/corporate-services/','cta'=>'Lihat Corporate Service'),
        'personal-session' => array('label'=>'Personal Session with Yogi','route'=>'/eling-guiding/','cta'=>'Jadwalkan Sesi Personal','contact_channel'=>'personal_session'),
        'ytt' => array('label'=>'Yoga Teacher Training','route'=>'/yoga-teacher-training/','cta'=>'View Program'),
        // DATA GATE: Hybrid language is intentionally null until the source conflict is resolved.
        'ytt-50h-hybrid' => array('label'=>'50H Hybrid','route'=>'/bali-eling-spirit-50h-hybrid/'),
        'ytt-50h' => array('label'=>'50H Offline','route'=>'/bali-eling-spirit-50h/'),
        'ytt-100h' => array('label'=>'100H Offline / Residential','route'=>'/bali-eling-spirit-100h/'),
        'ytt-200h-hybrid' => array('label'=>'200H Hybrid','route'=>'/bali-eling-spirit-200h-hybrid/'),
        'ytt-200h' => array('label'=>'200H Offline','route'=>'/bali-eling-spirit-200h/'),
        // Existing MEC/vendor route remains the Phase F primary destination.
        'ytt-300h' => array('label'=>'300H Offline','route'=>'/program/300-hour-yoga-teacher-training/'),
        'meditation' => array('label'=>'Eling Meditation Course','route'=>'/yoga-teacher-training/eling-meditation-course/'),
        'sound-healing' => array('label'=>'Eling Sound Healing Course','route'=>'/eling-sound-healing-course/'),
        'pasraman' => array('label'=>'Pasraman','route'=>'/pasraman/'),
        'pelukatan' => array('label'=>'Pelukatan / 7 Chakra Water Purification','route'=>'/7-chakra-purification/'),
    );

    $facts = array();
    foreach ( $rows as $key => $row ) {
        $facts[$key] = array_merge($blank, $row, array('key'=>$key));
    }
    return $facts;
}

function bes_site_core_program_fact( $key, $field, $default = null ) {
    $facts = bes_site_core_program_facts();
    return isset($facts[$key]) && array_key_exists($field,$facts[$key]) && null !== $facts[$key][$field]
        ? $facts[$key][$field]
        : $default;
}

function bes_site_core_program_route( $key, $default = '' ) {
    return (string) bes_site_core_program_fact($key,'route',$default);
}

function bes_site_core_program_path( $key, $default = '' ) {
    return trim(bes_site_core_program_route($key,$default),'/');
}

function bes_site_core_contact_channels() {
    return array(
        // Verified from current route-specific implementations. Do not globally normalize.
        'general' => 'https://wa.me/6287825989117',
        'sanctuary' => 'https://wa.me/6281228888873',
        'personal_session' => 'https://wa.me/6287825899117',
    );
}

function bes_site_core_contact_url( $channel, $default = '' ) {
    $channels = bes_site_core_contact_channels();
    return isset($channels[$channel]) ? $channels[$channel] : $default;
}

function bes_site_core_validate_program_facts() {
    $errors = array(); $routes = array();
    foreach ( bes_site_core_program_facts() as $key => $fact ) {
        if ( $key !== $fact['key'] || '' === $fact['label'] || '' === $fact['route'] ) $errors[] = 'Incomplete program fact: '.$key;
        if ( '' !== $fact['route'] && '/' !== substr($fact['route'],0,1) ) $errors[] = 'Non-canonical route: '.$key;
        if ( isset($routes[$fact['route']]) ) $errors[] = 'Duplicate program route: '.$fact['route'];
        $routes[$fact['route']] = true;
    }
    return $errors;
}
