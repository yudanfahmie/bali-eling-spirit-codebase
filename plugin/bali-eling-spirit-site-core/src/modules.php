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
);
