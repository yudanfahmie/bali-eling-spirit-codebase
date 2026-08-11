<?php
/**
 * Site Core module ownership manifest.
 *
 * Runtime modules are fail-closed: only PLUGIN_LIVE and WPBOX_OFF entries may load.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'global-assets' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'global/global-assets.php',
        'legacy_owner' => 'WPCodeBox #24 — Global Assets (Preloader, Header, Footer)',
    ),
    'homepage' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'homepage/homepage.php',
        'legacy_owner' => 'WPCodeBox — Homepage / Homepage v2',
    ),
    'sanctuary-hub' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/sanctuary-hub.php',
        'legacy_owner' => 'WPCodeBox — Sanctuary [bes_sanctuary_hub]',
    ),
    'sanctuary-healing-therapy' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/healing-therapy.php',
        'legacy_owner' => 'NEW — no canonical WPCodeBox gateway owner',
    ),
    'sanctuary-personal-session-yogi' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/personal-session-yogi.php',
        'legacy_owner' => 'ADAPT — related WPCodeBox Eling Guiding remains runtime owner until Phase F',
    ),
    'sanctuary-eling-retreat' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/eling-sanctuary-retreat.php',
        'legacy_owner' => 'WPCodeBox — Eling Sanctuary Retreat [bes_eling_sanctuary_retreat]',
    ),
    'sanctuary-tapa-brata' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/tapa-brata.php',
        'legacy_owner' => 'WPCodeBox — Eling Tapa Brata [bes_eling_tapa_brata]',
    ),
    'sanctuary-corporate-services' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'sanctuary/corporate-services.php',
        'legacy_owner' => 'NEW — no canonical WPCodeBox renderer owner',
    ),
    'academy-ytt' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/yoga-teacher-training.php',
        'legacy_owner' => 'WPCodeBox — Yoga Teacher Training [bes_yoga_teacher_training]',
    ),
    'academy-ytt-50h' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/baseline/ytt-50h.php',
        'legacy_owner' => 'WPCodeBox — YTT 50H [bes_ytt_50h_landing]',
    ),
    'academy-ytt-50h-hybrid' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/ytt-50h-hybrid.php',
        'legacy_owner' => 'WPCodeBox — YTT 50H Hybrid [bes_ytt_50h_hybrid_landing]',
    ),
    'academy-ytt-100h' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/ytt-100h.php',
        'legacy_owner' => 'NEW — no canonical WPCodeBox 100H renderer owner',
    ),
    'academy-ytt-200h-hybrid' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/baseline/ytt-200h-hybrid.php',
        'legacy_owner' => 'WPCodeBox — YTT 200H Hybrid [bes_ytt_200h_hybrid_landing]',
    ),
    'academy-ytt-200h' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/baseline/ytt-200h.php',
        'legacy_owner' => 'WPCodeBox — YTT 200H [bes_ytt_200h_landing]',
    ),
    'academy-ytt-300h' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/baseline/ytt-300h.php',
        'legacy_owner' => 'WPCodeBox — 300 Hour Yoga Teacher Training [bes_300h_ytt]',
    ),
    'academy-meditation' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/meditation-course.php',
        'legacy_owner' => 'WPCodeBox — Eling Meditation Course [bes_meditation_course]',
    ),
    'academy-sound-healing' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'academy/sound-healing-course.php',
        'legacy_owner' => 'NEW — no canonical WPCodeBox Eling Sound Healing Course owner',
    ),
    'pasraman' => array(
        'state'        => 'PLUGIN_SHADOW',
        'file'         => 'pasraman/pasraman.php',
        'legacy_owner' => 'ADAPT — existing /pasraman/ is raw WordPress content with no canonical shortcode owner',
    ),
);
