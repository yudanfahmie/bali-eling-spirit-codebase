<?php
/**
 * Compact Site Core module loader.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Return the explicit module ownership manifest.
 *
 * @return array<string,array<string,string>>
 */
function bes_site_core_modules() {
    $modules = require BES_SITE_CORE_DIR . 'src/modules.php';

    return is_array( $modules ) ? $modules : array();
}

/**
 * Load only modules whose cutover state is explicitly PLUGIN_LIVE.
 *
 * PLUGIN_SHADOW source is deliberately present but inert. This prevents the
 * site-core plugin from double-registering hooks/functions while WPCodeBox is
 * still authoritative.
 *
 * @return void
 */
function bes_site_core_load_modules() {
    foreach ( bes_site_core_modules() as $module ) {
        if ( ! is_array( $module ) || 'PLUGIN_LIVE' !== ( $module['state'] ?? '' ) ) {
            continue;
        }

        $relative_file = $module['file'] ?? '';
        if ( ! is_string( $relative_file ) || '' === $relative_file ) {
            continue;
        }

        $module_file = BES_SITE_CORE_DIR . 'src/' . ltrim( $relative_file, '/\\' );
        if ( is_readable( $module_file ) ) {
            require_once $module_file;
        }
    }
}
