<?php
/**
 * Plugin Name: Bali Eling Spirit Site Core
 * Plugin URI:  https://balielingspirit.com
 * Description: First-party site functionality for Bali Eling Spirit.
 * Version:     0.1.0
 * Author:      Bali Eling Spirit
 * Text Domain: bali-eling-spirit-site-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'BES_SITE_CORE_DIR' ) ) {
    define( 'BES_SITE_CORE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'BES_SITE_CORE_FILE' ) ) {
    define( 'BES_SITE_CORE_FILE', __FILE__ );
}

require_once BES_SITE_CORE_DIR . 'src/loader.php';

bes_site_core_load_modules();

require_once BES_SITE_CORE_DIR . 'src/provisioning/site-structure.php';
bes_site_core_register_structure_provisioning();
