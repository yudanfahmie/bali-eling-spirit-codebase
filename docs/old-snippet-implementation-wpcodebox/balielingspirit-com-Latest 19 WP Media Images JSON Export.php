<?php
/**
 * Sang Spa — Latest 19 WP Media Images JSON Export
 *
 * Safe usage:
 *   1) Install as a small MU plugin:
 *      wp-content/mu-plugins/sang-spa-get19images-json.php
 *      OR paste this into a trusted snippets plugin.
 *   2) Visit while logged in as an admin/editor with upload permissions:
 *      https://your-domain.com/?get19images=true
 *   3) A JSON file will download automatically.
 *
 * Optional token access for non-login usage:
 *   define('SANG_SPA_GET19IMAGES_TOKEN', 'replace-with-a-long-random-secret');
 *   Then visit:
 *      https://your-domain.com/?get19images=true&token=replace-with-a-long-random-secret
 *
 * This snippet is read-only. It does not edit, delete, or modify media records.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('sangspa_get19images_request_is_enabled')) {
    /**
     * Check whether the export endpoint was explicitly requested.
     */
    function sangspa_get19images_request_is_enabled(): bool
    {
        if (!isset($_GET['get19images'])) {
            return false;
        }

        $raw = sanitize_text_field(wp_unslash((string) $_GET['get19images']));
        $raw = strtolower(trim($raw));

        return in_array($raw, array('1', 'true', 'yes', 'download'), true);
    }
}

if (!function_exists('sangspa_get19images_user_can_export')) {
    /**
     * Allow either a logged-in privileged WP user or a configured secret token.
     */
    function sangspa_get19images_user_can_export(): bool
    {
        if (is_user_logged_in() && current_user_can('upload_files')) {
            return true;
        }

        if (defined('SANG_SPA_GET19IMAGES_TOKEN') && SANG_SPA_GET19IMAGES_TOKEN !== '') {
            $provided = isset($_GET['token']) ? sanitize_text_field(wp_unslash((string) $_GET['token'])) : '';
            return $provided !== '' && hash_equals((string) SANG_SPA_GET19IMAGES_TOKEN, $provided);
        }

        return false;
    }
}

if (!function_exists('sangspa_get19images_clean_output_buffers')) {
    /**
     * Prevent stray theme/plugin output from corrupting the downloaded JSON.
     */
    function sangspa_get19images_clean_output_buffers(): void
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
    }
}

if (!function_exists('sangspa_get19images_send_json')) {
    /**
     * Send JSON with safe download headers and exit.
     *
     * @param array<string,mixed> $payload
     */
    function sangspa_get19images_send_json(array $payload, int $status_code = 200, bool $download = true): void
    {
        sangspa_get19images_clean_output_buffers();

        status_header($status_code);
        nocache_headers();
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');

        if ($download) {
            $filename = 'wp-latest-19-images-' . gmdate('Ymd-His') . '.json';
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        }

        echo wp_json_encode(
            $payload,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
        exit;
    }
}

if (!function_exists('sangspa_get19images_filesize')) {
    /**
     * Return local file size in bytes when available.
     */
    function sangspa_get19images_filesize(string $file_path): ?int
    {
        if ($file_path === '' || !file_exists($file_path) || !is_readable($file_path)) {
            return null;
        }

        $size = filesize($file_path);
        return $size === false ? null : (int) $size;
    }
}

if (!function_exists('sangspa_get19images_collect_image')) {
    /**
     * Build one robust image metadata row.
     *
     * @return array<string,mixed>
     */
    function sangspa_get19images_collect_image(int $attachment_id): array
    {
        $file_path = get_attached_file($attachment_id);
        $file_path = is_string($file_path) ? $file_path : '';

        $metadata = wp_get_attachment_metadata($attachment_id);
        $metadata = is_array($metadata) ? $metadata : array();

        $full_src = wp_get_attachment_image_src($attachment_id, 'full');
        $full_url = is_array($full_src) && isset($full_src[0]) ? (string) $full_src[0] : (string) wp_get_attachment_url($attachment_id);

        $sizes = array();
        if (!empty($metadata['sizes']) && is_array($metadata['sizes'])) {
            foreach ($metadata['sizes'] as $size_name => $size_data) {
                $sizes[(string) $size_name] = array(
                    'url'       => wp_get_attachment_image_url($attachment_id, (string) $size_name),
                    'width'     => isset($size_data['width']) ? (int) $size_data['width'] : null,
                    'height'    => isset($size_data['height']) ? (int) $size_data['height'] : null,
                    'mime_type' => isset($size_data['mime-type']) ? (string) $size_data['mime-type'] : null,
                    'file'      => isset($size_data['file']) ? (string) $size_data['file'] : null,
                );
            }
        }

        $title = get_the_title($attachment_id);
        $caption = wp_get_attachment_caption($attachment_id);
        $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

        return array(
            'id'               => $attachment_id,
            'title'            => is_string($title) ? html_entity_decode($title, ENT_QUOTES, get_bloginfo('charset')) : '',
            'alt_text'         => is_string($alt_text) ? $alt_text : '',
            'caption'          => is_string($caption) ? wp_strip_all_tags($caption) : '',
            'filename'         => $file_path !== '' ? basename($file_path) : basename(wp_parse_url($full_url, PHP_URL_PATH) ?: ''),
            'mime_type'        => get_post_mime_type($attachment_id),
            'url'              => $full_url,
            'edit_url'         => get_edit_post_link($attachment_id, 'raw'),
            'width'            => isset($metadata['width']) ? (int) $metadata['width'] : null,
            'height'           => isset($metadata['height']) ? (int) $metadata['height'] : null,
            'filesize_bytes'   => sangspa_get19images_filesize($file_path),
            'uploaded_at_gmt'  => get_post_field('post_date_gmt', $attachment_id),
            'modified_at_gmt'  => get_post_field('post_modified_gmt', $attachment_id),
            'author_id'        => (int) get_post_field('post_author', $attachment_id),
            'sizes'            => $sizes,
        );
    }
}

if (!function_exists('sangspa_get19images_export_latest_media')) {
    /**
     * Query the 19 latest image attachments and return payload.
     *
     * @return array<string,mixed>
     */
    function sangspa_get19images_export_latest_media(): array
    {
        $query = new WP_Query(array(
            'post_type'              => 'attachment',
            'post_status'            => 'inherit',
            'post_mime_type'         => 'image',
            'posts_per_page'         => 19,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_meta_cache' => true,
            'update_post_term_cache' => false,
        ));

        $image_ids = array_map('intval', $query->posts);
        $images = array_map('sangspa_get19images_collect_image', $image_ids);

        return array(
            'success'          => true,
            'generated_at_gmt' => gmdate('c'),
            'site_url'         => home_url('/'),
            'request'          => array(
                'endpoint' => '/?get19images=true',
                'limit'    => 19,
                'orderby'  => 'date DESC',
            ),
            'count'            => count($images),
            'image_ids'        => $image_ids,
            'images'           => $images,
        );
    }
}

add_action('template_redirect', function (): void {
    if (!sangspa_get19images_request_is_enabled()) {
        return;
    }

    if (!sangspa_get19images_user_can_export()) {
        sangspa_get19images_send_json(array(
            'success' => false,
            'message' => 'Forbidden. Log in with media permissions or provide a valid token.',
        ), 403, false);
    }

    sangspa_get19images_send_json(sangspa_get19images_export_latest_media(), 200, true);
}, 0);
