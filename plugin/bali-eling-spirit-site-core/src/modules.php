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
);
