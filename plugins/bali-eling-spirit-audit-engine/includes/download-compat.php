<?php
/**
 * Relaxed download controller + short-lived bundle cleanup.
 *
 * Developer-purpose behavior:
 * - download requires an authenticated administrator only;
 * - no separate download nonce is required;
 * - the same generated bundle can be downloaded repeatedly;
 * - generated bundles expire automatically after two hours;
 * - old wp_nonce_url() / HTML-escaped audit links remain compatible.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

const BES_AUDIT_BUNDLE_TTL = 7200;

function bes_audit_normalize_download_query(): void {
    if ( isset( $_GET['audit_id'] ) ) {
        return;
    }

    foreach ( $_GET as $key => $value ) {
        if ( ! is_string( $key ) ) {
            continue;
        }

        $normalized = html_entity_decode( $key, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
        $normalized = preg_replace( '/^(?:(?:amp|#038|038);)+/i', '', $normalized );

        if ( 'audit_id' === $normalized ) {
            $_GET['audit_id'] = $value;
            return;
        }
    }
}

function bes_audit_temp_root(): string {
    return trailingslashit( get_temp_dir() ) . 'bes-audit-engine';
}

function bes_audit_remove_dir( string $dir ): void {
    if ( ! is_dir( $dir ) ) {
        return;
    }

    foreach ( (array) scandir( $dir ) as $item ) {
        if ( '.' === $item || '..' === $item ) {
            continue;
        }

        $path = $dir . '/' . $item;
        if ( is_dir( $path ) ) {
            bes_audit_remove_dir( $path );
        } else {
            @unlink( $path );
        }
    }

    @rmdir( $dir );
}

function bes_audit_purge_expired_bundles(): void {
    $root = bes_audit_temp_root();
    if ( ! is_dir( $root ) ) {
        return;
    }

    $cutoff = time() - BES_AUDIT_BUNDLE_TTL;

    foreach ( (array) scandir( $root ) as $item ) {
        if ( in_array( $item, array( '.', '..', 'index.html', '.htaccess' ), true ) ) {
            continue;
        }

        $dir = $root . '/' . $item;
        if ( ! is_dir( $dir ) ) {
            continue;
        }

        $bundle = is_file( $dir . '/bundle.zip' ) ? $dir . '/bundle.zip' : $dir . '/bundle.json';
        $stamp  = is_file( $bundle ) ? @filemtime( $bundle ) : @filemtime( $dir );

        if ( $stamp && $stamp < $cutoff ) {
            bes_audit_remove_dir( $dir );
        }
    }
}

function bes_audit_download_bundle_relaxed(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized.', 403 );
    }

    bes_audit_normalize_download_query();
    bes_audit_purge_expired_bundles();

    $id = sanitize_key( wp_unslash( $_GET['audit_id'] ?? '' ) );
    if ( ! $id ) {
        wp_die( 'Audit bundle not found.', 404 );
    }

    $dir  = bes_audit_temp_root() . '/' . $id;
    $file = is_readable( $dir . '/bundle.zip' ) ? $dir . '/bundle.zip' : $dir . '/bundle.json';

    if ( ! is_readable( $file ) ) {
        wp_die( 'Audit bundle not found or expired.', 404 );
    }

    $zip = str_ends_with( $file, '.zip' );

    nocache_headers();
    header( 'Content-Type: ' . ( $zip ? 'application/zip' : 'application/json' ) );
    header( 'Content-Disposition: attachment; filename="bali-eling-spirit-audit-' . gmdate( 'Ymd-His' ) . ( $zip ? '.zip' : '.json' ) . '"' );
    header( 'Content-Length: ' . filesize( $file ) );
    header( 'X-BES-Bundle-TTL: 7200' );

    readfile( $file );
    exit;
}

add_action(
    'plugins_loaded',
    static function (): void {
        if ( ! class_exists( 'BES_Audit_Engine' ) ) {
            return;
        }

        $engine = BES_Audit_Engine::instance();
        remove_action( 'admin_post_bes_audit_download', array( $engine, 'download' ) );
        add_action( 'admin_post_bes_audit_download', 'bes_audit_download_bundle_relaxed', 10 );
    },
    20
);

add_action(
    'admin_init',
    static function (): void {
        // Cheap opportunistic cleanup; no cron or extra configuration required.
        bes_audit_purge_expired_bundles();
    },
    5
);
