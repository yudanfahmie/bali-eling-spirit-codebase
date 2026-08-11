<?php 

// 1. Inject GTM into <head> with highest priority
add_action( 'wp_head', 'insert_gtm_head', 1 );
function insert_gtm_head() {
    ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WZM86KLD');</script>
    <?php
}

// 2. Inject GTM immediately after opening <body> 
// (Requires the theme to support the standard wp_body_open hook)
add_action( 'wp_body_open', 'insert_gtm_body', 1 );
function insert_gtm_body() {
    ?>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZM86KLD"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php
}

// 3. Robust "Nuclear" Cache Buster
// Run by visiting your wp-admin with ?nuke_cache=true appended to the URL.
add_action( 'admin_init', 'force_nuclear_cache_purge' );
function force_nuclear_cache_purge() {
    if ( isset( $_GET['nuke_cache'] ) && $_GET['nuke_cache'] === 'true' ) {
        
        // Native Object Cache
        wp_cache_flush();
        
        // WP Rocket
        if ( function_exists( 'rocket_clean_domain' ) ) { 
            rocket_clean_domain(); 
        }
        
        // LiteSpeed Cache
        if ( class_exists( 'Litespeed_Cache_API' ) || defined( 'LITESPEED_PLUGIN_DIR' ) ) { 
            do_action( 'litespeed_purge_all' ); 
        }
        
        // W3 Total Cache
        if ( function_exists( 'w3tc_flush_all' ) ) { 
            w3tc_flush_all(); 
        }
        
        // Autoptimize
        if ( class_exists( 'autoptimizeCache' ) ) { 
            autoptimizeCache::clearall(); 
        }
        
        die( 'Nuclear Cache Purge Complete. Close this tab and refresh the live site.' );
    }
}