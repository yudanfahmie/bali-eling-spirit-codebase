<?php
/**
 * Download query compatibility layer.
 *
 * wp_nonce_url() returns an HTML-escaped URL. In JSON/DOM/security-plugin
 * pipelines the query separators can occasionally arrive at PHP as keys such
 * as `amp;audit_id` / `amp;_wpnonce`. Normalize those keys before the main
 * download controller verifies the request.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'admin_post_bes_audit_download',
    static function (): void {
        if ( isset( $_GET['audit_id'], $_GET['_wpnonce'] ) ) {
            return;
        }

        foreach ( $_GET as $key => $value ) {
            if ( ! is_string( $key ) ) {
                continue;
            }

            $normalized = html_entity_decode( $key, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
            $normalized = preg_replace( '/^(?:(?:amp|#038|038);)+/i', '', $normalized );

            if ( 'audit_id' === $normalized && ! isset( $_GET['audit_id'] ) ) {
                $_GET['audit_id'] = $value;
            }

            if ( '_wpnonce' === $normalized && ! isset( $_GET['_wpnonce'] ) ) {
                $_GET['_wpnonce'] = $value;
            }
        }
    },
    1
);
