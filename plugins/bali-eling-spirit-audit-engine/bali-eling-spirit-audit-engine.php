<?php
/**
 * Plugin Name: Bali Eling Spirit Audit Engine
 * Description: Developer-only structural audit and migration snapshot engine for the Bali Eling Spirit WordPress refactor.
 * Version: 0.2.2
 * Author: Bali Eling Spirit Engineering
 * Requires at least: 6.0
 * Requires PHP: 8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BES_AUDIT_VERSION', '0.2.2' );
define( 'BES_AUDIT_FILE', __FILE__ );
define( 'BES_AUDIT_DIR', plugin_dir_path( __FILE__ ) );
define( 'BES_AUDIT_URL', plugin_dir_url( __FILE__ ) );

require_once BES_AUDIT_DIR . 'includes/download-compat.php';
require_once BES_AUDIT_DIR . 'includes/class-bes-audit-engine.php';

add_action(
    'plugins_loaded',
    static function () {
        BES_Audit_Engine::instance();
    }
);
