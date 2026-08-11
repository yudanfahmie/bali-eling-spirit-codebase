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
 * Load only modules whose cutover state keeps Site Core as runtime owner.
 *
 * PLUGIN_LIVE and WPBOX_OFF are executable. WPBOX_ONLY, PLUGIN_SHADOW, and
 * unknown or malformed states remain inert so the loader always fails closed.
 *
 * @return void
 */
function bes_site_core_load_modules() {
    $executable_states = array( 'PLUGIN_LIVE', 'WPBOX_OFF' );

    foreach ( bes_site_core_modules() as $module ) {
        if ( ! is_array( $module ) ) {
            continue;
        }

        $state = $module['state'] ?? '';
        if ( ! is_string( $state ) || ! in_array( $state, $executable_states, true ) ) {
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
