<?php
/**
 * Plugin Name: Bali Eling Spirit Site Core
 * Description: Version-controlled runtime home for Bali Eling Spirit custom site snippets migrated from WPCodeBox.
 * Version: 0.0.1-dev
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Author: Bali Eling Spirit
 * Text Domain: bali-eling-spirit-site-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'BES_SITE_CORE_VERSION' ) ) {
    define( 'BES_SITE_CORE_VERSION', '0.0.1-dev' );
}

if ( ! defined( 'BES_SITE_CORE_FILE' ) ) {
    define( 'BES_SITE_CORE_FILE', __FILE__ );
}

if ( ! defined( 'BES_SITE_CORE_DIR' ) ) {
    define( 'BES_SITE_CORE_DIR', plugin_dir_path( __FILE__ ) );
}

/*
 * Intentionally inert during reverse engineering.
 * Runtime modules will only be loaded after the Phase 1 cutover registry
 * proves which WPCodeBox counterparts can be replaced safely.
 */
