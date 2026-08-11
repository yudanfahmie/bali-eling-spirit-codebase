<?php
/**
 * Comprehensive Site Go-Live & Diagnostics Fetcher
 * Endpoint: /?fetch-site-deployment-data=YOUR_SECRET_TOKEN
 */
add_action('template_redirect', 'extract_site_deployment_data');

function extract_site_deployment_data() {
    // SECURITY: Replace 'YOUR_SECRET_TOKEN' with a strong, randomized string.
    // Example usage: /?fetch-site-deployment-data=8f9a2b3c4d5e
    $secret_token = '8f9a2b3c4d5e'; 

    if (!isset($_GET['fetch-site-deployment-data']) || $_GET['fetch-site-deployment-data'] !== $secret_token) {
        return; // Abort if the token is missing or invalid
    }

    global $wpdb;

    // 1. Fundamental Data Tracing
    // Fetch the registration date of the first user (usually the admin during WP install)
    $first_user = $wpdb->get_var("SELECT user_registered FROM {$wpdb->users} ORDER BY ID ASC LIMIT 1");

    // Fetch the date of the first published post or page (excluding auto-drafts)
    $first_post = $wpdb->get_var("SELECT post_date FROM {$wpdb->posts} WHERE post_status IN ('publish', 'inherit') AND post_type IN ('post', 'page') ORDER BY ID ASC LIMIT 1");

    // Fetch the date of the first uploaded media attachment
    $first_attachment = $wpdb->get_var("SELECT post_date FROM {$wpdb->posts} WHERE post_type = 'attachment' ORDER BY ID ASC LIMIT 1");

    // Fetch the last modification date of the Homepage (strong indicator of final pre-live revisions)
    $homepage_id = get_option('page_on_front');
    $homepage_modified = $homepage_id ? $wpdb->get_var($wpdb->prepare("SELECT post_modified FROM {$wpdb->posts} WHERE ID = %d", $homepage_id)) : null;

    // Fetch the first WooCommerce order (if applicable, best indicator for e-commerce go-live)
    $first_order = null;
    if (class_exists('WooCommerce')) {
        $first_order = $wpdb->get_var("SELECT post_date FROM {$wpdb->posts} WHERE post_type = 'shop_order' AND post_status != 'trash' ORDER BY ID ASC LIMIT 1");
    }

    // 2. Go-Live & Warranty Calculation
    // Priority: If it's an e-commerce site, the first order is highly definitive.
    // Otherwise, fallback to the first published content or the first registered user.
    if ($first_order) {
        $baseline_date = $first_order;
    } elseif ($homepage_modified && strtotime($homepage_modified) > strtotime($first_post)) {
        // If the homepage was heavily modified after initial content, it usually marks the live transition
        $baseline_date = $homepage_modified;
    } else {
        $baseline_date = $first_post ? $first_post : $first_user; 
    }
    
    $go_live_timestamp = strtotime($baseline_date);
    
    // Precision calculation: +1 Month for the maintenance/warranty period
    $maintenance_end_timestamp = strtotime('+1 month', $go_live_timestamp);

    // 3. Data Compilation in JSON Format
    $active_theme = wp_get_theme();
    $data = [
        'status' => 'success',
        'project_info' => [
            'site_name'    => get_bloginfo('name'),
            'live_url'     => site_url(),
            'admin_email'  => get_option('admin_email'),
            'timezone'     => wp_timezone_string(),
        ],
        'deep_trace_timestamps' => [
            'first_admin_registered'  => $first_user,
            'first_content_published' => $first_post,
            'first_media_uploaded'    => $first_attachment,
            'homepage_last_modified'  => $homepage_modified,
            'first_ecommerce_order'   => $first_order,
        ],
        'contract_timeline' => [
            'estimated_go_live_date'   => date('Y-m-d H:i:s', $go_live_timestamp),
            'warranty_end_date'        => date('Y-m-d H:i:s', $maintenance_end_timestamp),
            'current_warranty_status'  => time() > $maintenance_end_timestamp ? 'EXPIRED' : 'ACTIVE',
        ],
        'system_environment' => [
            'server_time'  => current_time('mysql'),
            'php_version'  => phpversion(),
            'wp_version'   => get_bloginfo('version'),
            'active_theme' => $active_theme->get('Name') . ' (v' . $active_theme->get('Version') . ')'
        ]
    ];

    // Clear output buffers to prevent JSON corruption from other plugins or whitespace
    if (ob_get_length()) {
        ob_clean();
    }

    // Headers to force JSON file download
    $domain = parse_url(site_url(), PHP_URL_HOST);
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="deployment-trace-' . $domain . '.json"');

    // Output JSON in a highly readable format (Pretty Print) for the engineer
    echo wp_json_encode($data, JSON_PRETTY_PRINT);
    
    // Terminate script execution immediately
    exit;
}