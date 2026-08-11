<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

final class BES_Audit_Engine {
    private static $instance;
    private const CAP = 'manage_options';
    private const NONCE = 'bes_audit_engine';
    private const STALE_SECONDS = 21600;
    private const PHASES = array( 'environment', 'content', 'navigation', 'extensions', 'shortcodes', 'wpcodebox', 'relationships', 'finalize' );

    public static function instance(): self {
        if ( ! self::$instance ) { self::$instance = new self(); }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
        add_action( 'wp_ajax_bes_audit_run_phase', array( $this, 'run_phase' ) );
        add_action( 'wp_ajax_bes_audit_cleanup', array( $this, 'cleanup' ) );
        add_action( 'admin_post_bes_audit_download', array( $this, 'download' ) );
    }

    public function menu(): void {
        add_management_page( 'BES Audit Engine', 'BES Audit Engine', self::CAP, 'bes-audit-engine', array( $this, 'screen' ) );
    }

    public function assets( string $hook ): void {
        if ( 'tools_page_bes-audit-engine' !== $hook ) { return; }
        wp_enqueue_style( 'bes-audit-engine', BES_AUDIT_URL . 'assets/admin.css', array(), BES_AUDIT_VERSION );
        wp_enqueue_script( 'bes-audit-engine', BES_AUDIT_URL . 'assets/admin.js', array(), BES_AUDIT_VERSION, true );
        wp_localize_script( 'bes-audit-engine', 'BESAuditEngine', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( self::NONCE ),
            'phases' => self::PHASES,
            'labels' => array(
                'environment' => 'Reading WordPress environment',
                'content' => 'Mapping pages and structural content',
                'navigation' => 'Mapping menus and destinations',
                'extensions' => 'Inspecting WooCommerce, LMS and plugins',
                'shortcodes' => 'Indexing registered shortcodes',
                'wpcodebox' => 'Capturing WPCodeBox schema and snippets',
                'relationships' => 'Building menu → content → shortcode map',
                'finalize' => 'Packaging audit bundle',
            ),
        ) );
    }

    public function screen(): void {
        if ( ! current_user_can( self::CAP ) ) { return; }
        ?>
        <div class="wrap bes-audit-wrap"><div class="bes-audit-card">
            <div class="bes-kicker">Bali Eling Spirit · Developer Tool</div>
            <h1>Current-State Audit Engine</h1>
            <p class="bes-lead">Generate a portable snapshot of page hierarchy, menus, shortcode rendering, plugins, WooCommerce/LMS signals and WPCodeBox code before restructuring the site.</p>
            <label class="bes-option"><input id="bes-include-code" type="checkbox" checked> <strong>Include full page content + menu-linked content + WPCodeBox snippet code</strong><span>Recommended for migration. Secret-like database columns are omitted automatically.</span></label>
            <div class="bes-actions"><button id="bes-run-audit" class="button button-primary button-hero" type="button">Generate Audit Bundle</button><span id="bes-audit-status">Ready.</span></div>
            <div class="bes-progress"><i id="bes-progress-bar"></i></div>
            <div id="bes-audit-result" class="bes-result" hidden></div>
            <details><summary>Captured data</summary><div class="bes-grid"><span>Pages, parents, templates, blocks & builder signals</span><span>Menus and linked destinations</span><span>Registered & used shortcodes</span><span>Active plugins, WooCommerce & LMS signals</span><span>WPCodeBox snippets/folders with dynamic schema detection</span><span>Menu → content → shortcode relationship map</span></div></details>
        </div></div>
        <?php
    }

    public function run_phase(): void {
        $this->guard();
        $phase = sanitize_key( wp_unslash( $_POST['phase'] ?? '' ) );
        $audit_id = sanitize_key( wp_unslash( $_POST['auditId'] ?? '' ) );
        $include_code = ! empty( $_POST['includeCode'] );
        if ( ! in_array( $phase, self::PHASES, true ) ) { wp_send_json_error( array( 'message' => 'Unknown phase.' ), 400 ); }
        if ( ! $audit_id ) { $audit_id = sanitize_key( wp_generate_uuid4() ); }

        try {
            if ( 'environment' === $phase ) { $this->purge_stale(); }
            $dir = $this->ensure_dir( $audit_id );
            if ( 'environment' === $phase ) { $this->write( "$dir/01-environment.json", $this->environment() ); }
            if ( 'content' === $phase ) { $this->write( "$dir/02-content.json", $this->content( $include_code ) ); }
            if ( 'navigation' === $phase ) { $this->write( "$dir/03-navigation.json", $this->navigation( $include_code ) ); }
            if ( 'extensions' === $phase ) { $this->write( "$dir/04-extensions.json", $this->extensions() ); }
            if ( 'shortcodes' === $phase ) { $this->write( "$dir/05-shortcodes.json", $this->shortcodes() ); }
            if ( 'wpcodebox' === $phase ) { $this->write( "$dir/06-wpcodebox.json", $this->wpcodebox( $include_code ) ); }
            if ( 'relationships' === $phase ) { $this->write( "$dir/07-relationships.json", $this->relationships( $dir ) ); }
            if ( 'finalize' === $phase ) { wp_send_json_success( array_merge( array( 'auditId' => $audit_id ), $this->finalize( $audit_id, $dir, $include_code ) ) ); }
            wp_send_json_success( array( 'auditId' => $audit_id ) );
        } catch ( Throwable $e ) {
            wp_send_json_error( array( 'message' => $e->getMessage(), 'phase' => $phase ), 500 );
        }
    }

    public function cleanup(): void {
        $this->guard();
        $id = sanitize_key( wp_unslash( $_POST['auditId'] ?? '' ) );
        if ( $id ) { $this->rm( $this->dir( $id ) ); }
        wp_send_json_success();
    }

    public function download(): void {
        if ( ! current_user_can( self::CAP ) ) { wp_die( 'Unauthorized.', 403 ); }
        $id = sanitize_key( wp_unslash( $_GET['audit_id'] ?? '' ) );
        $nonce = sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ?? '' ) );
        if ( ! $id || ! wp_verify_nonce( $nonce, 'bes_audit_download_' . $id ) ) { wp_die( 'Invalid download request.', 403 ); }
        $dir = $this->dir( $id );
        $file = is_readable( "$dir/bundle.zip" ) ? "$dir/bundle.zip" : "$dir/bundle.json";
        if ( ! is_readable( $file ) ) { wp_die( 'Bundle not found or already downloaded.', 404 ); }
        $zip = str_ends_with( $file, '.zip' );
        nocache_headers();
        header( 'Content-Type: ' . ( $zip ? 'application/zip' : 'application/json' ) );
        header( 'Content-Disposition: attachment; filename="bali-eling-spirit-audit-' . gmdate( 'Ymd-His' ) . ( $zip ? '.zip' : '.json' ) . '"' );
        header( 'Content-Length: ' . filesize( $file ) );
        $sent = readfile( $file );
        if ( false !== $sent ) { $this->rm( $dir ); }
        exit;
    }

    private function guard(): void {
        if ( ! current_user_can( self::CAP ) ) { wp_send_json_error( array( 'message' => 'Unauthorized.' ), 403 ); }
        check_ajax_referer( self::NONCE, 'nonce' );
    }

    private function environment(): array {
        global $wpdb;
        $theme = wp_get_theme();
        return array(
            'generated_at_utc' => gmdate( 'c' ),
            'site' => array( 'name' => get_bloginfo( 'name' ), 'home_url' => home_url( '/' ), 'site_url' => site_url( '/' ), 'language' => get_bloginfo( 'language' ), 'timezone' => wp_timezone_string(), 'permalink' => get_option( 'permalink_structure' ), 'show_on_front' => get_option( 'show_on_front' ), 'page_on_front' => (int) get_option( 'page_on_front' ), 'page_for_posts' => (int) get_option( 'page_for_posts' ), 'multisite' => is_multisite() ),
            'runtime' => array( 'wordpress' => get_bloginfo( 'version' ), 'php' => PHP_VERSION, 'mysql' => $wpdb->db_version(), 'memory_limit' => ini_get( 'memory_limit' ), 'wp_memory_limit' => defined( 'WP_MEMORY_LIMIT' ) ? WP_MEMORY_LIMIT : null ),
            'theme' => array( 'name' => $theme->get( 'Name' ), 'version' => $theme->get( 'Version' ), 'stylesheet' => $theme->get_stylesheet(), 'template' => $theme->get_template(), 'is_child' => (bool) $theme->parent() ),
            'public_post_types' => $this->post_types(),
        );
    }

    private function content( bool $full ): array {
        $items = array();
        $query = new WP_Query( array(
            'post_type' => 'page',
            'post_status' => array( 'publish', 'draft', 'private', 'pending', 'future' ),
            'posts_per_page' => -1,
            'orderby' => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
            'no_found_rows' => true,
            'update_post_term_cache' => false,
            'suppress_filters' => true,
        ) );

        foreach ( $query->posts as $post ) {
            $body = (string) $post->post_content;
            $row = array(
                'id' => (int) $post->ID, 'post_type' => 'page', 'post_type_label' => 'Page',
                'title' => get_the_title( $post ), 'slug' => $post->post_name, 'status' => $post->post_status, 'parent_id' => (int) $post->post_parent,
                'menu_order' => (int) $post->menu_order, 'url' => get_permalink( $post ), 'template' => get_page_template_slug( $post->ID ) ?: 'default',
                'shortcodes' => $this->extract_shortcodes( $body ), 'blocks' => $this->blocks( $body ), 'builder_signals' => $this->builders( $post->ID, $body ),
                'content_length' => strlen( $body ), 'content_sha256' => hash( 'sha256', $body ), 'modified_gmt' => $post->post_modified_gmt,
            );
            if ( $full ) { $row['post_content'] = $body; }
            $items[] = $row;
        }
        wp_reset_postdata();

        return array(
            'include_full_content' => $full,
            'capture_scope' => array(
                'full_items' => array( 'page' ),
                'menu_linked_non_page_content' => 'captured in 03-navigation.json when include_code=true',
                'other_public_post_types' => 'summarized in 01-environment.json and 04-extensions.json to avoid loading product/LMS catalogs into one audit request',
            ),
            'items' => $items,
        );
    }

    private function navigation( bool $full ): array {
        $menus = array();
        foreach ( wp_get_nav_menus() as $menu ) {
            $rows = array();
            foreach ( (array) wp_get_nav_menu_items( $menu->term_id, array( 'post_status' => 'any' ) ) as $item ) {
                $post = $item->object_id ? get_post( (int) $item->object_id ) : null;
                $body = $post ? (string) $post->post_content : '';
                $row = array(
                    'id' => (int) $item->ID, 'title' => $item->title, 'url' => $item->url, 'parent_menu_id' => (int) $item->menu_item_parent,
                    'type' => $item->type, 'object' => $item->object, 'object_id' => (int) $item->object_id,
                    'linked_post_type' => $post ? $post->post_type : null, 'linked_post_title' => $post ? get_the_title( $post ) : null,
                    'linked_post_slug' => $post ? $post->post_name : null, 'linked_post_status' => $post ? $post->post_status : null,
                    'linked_shortcodes' => $post ? $this->extract_shortcodes( $body ) : array(),
                    'linked_content_length' => $post ? strlen( $body ) : 0,
                    'linked_content_sha256' => $post ? hash( 'sha256', $body ) : null,
                    'classes' => array_values( array_filter( (array) $item->classes ) ),
                );
                if ( $full && $post && 'attachment' !== $post->post_type ) { $row['linked_post_content'] = $body; }
                $rows[] = $row;
            }
            $locations = array();
            foreach ( get_nav_menu_locations() as $loc => $id ) { if ( (int) $id === (int) $menu->term_id ) { $locations[] = $loc; } }
            $menus[] = array( 'term_id' => (int) $menu->term_id, 'name' => $menu->name, 'slug' => $menu->slug, 'locations' => $locations, 'items' => $rows );
        }
        return array( 'include_linked_content' => $full, 'registered_locations' => get_registered_nav_menus(), 'menus' => $menus );
    }

    private function extensions(): array {
        if ( ! function_exists( 'get_plugins' ) ) { require_once ABSPATH . 'wp-admin/includes/plugin.php'; }
        $active = (array) get_option( 'active_plugins', array() );
        $network = is_multisite() ? array_keys( (array) get_site_option( 'active_sitewide_plugins', array() ) ) : array();
        $plugins = array();
        foreach ( get_plugins() as $file => $data ) { $plugins[] = array( 'file' => $file, 'name' => $data['Name'] ?? $file, 'version' => $data['Version'] ?? null, 'active' => in_array( $file, $active, true ), 'network_active' => in_array( $file, $network, true ) ); }
        $wc = array( 'active' => class_exists( 'WooCommerce' ), 'version' => defined( 'WC_VERSION' ) ? WC_VERSION : null, 'pages' => array() );
        if ( function_exists( 'wc_get_page_id' ) ) { foreach ( array( 'shop', 'cart', 'checkout', 'myaccount', 'terms' ) as $key ) { $id = (int) wc_get_page_id( $key ); $wc['pages'][ $key ] = array( 'id' => $id, 'title' => $id > 0 ? get_the_title( $id ) : null, 'url' => $id > 0 ? get_permalink( $id ) : null ); } }
        return array( 'plugins' => $plugins, 'woocommerce' => $wc, 'lms_signals' => $this->lms( $plugins ), 'public_post_types' => $this->post_types() );
    }

    private function shortcodes(): array {
        global $shortcode_tags;
        $rows = array(); $tags = is_array( $shortcode_tags ) ? $shortcode_tags : array(); ksort( $tags );
        foreach ( $tags as $tag => $cb ) { $rows[] = array( 'tag' => $tag, 'callback' => $this->callback( $cb ) ); }
        return array( 'registered' => $rows );
    }

    private function wpcodebox( bool $full ): array {
        global $wpdb;
        $result = array( 'detected' => false, 'include_code' => $full, 'tables' => array() );
        foreach ( array( 'snippets' => $wpdb->prefix . 'wpcb_snippets', 'folders' => $wpdb->prefix . 'wpcb_folders' ) as $key => $table ) {
            $exists = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table ) ) );
            if ( $exists !== $table ) { $result['tables'][ $key ] = array( 'name' => $table, 'exists' => false ); continue; }
            $result['detected'] = true;
            $columns = $wpdb->get_results( 'DESCRIBE `' . esc_sql( $table ) . '`', ARRAY_A );
            if ( $wpdb->last_error ) {
                $result['tables'][ $key ] = array( 'name' => $table, 'exists' => true, 'error' => 'Could not inspect table schema.' );
                continue;
            }
            $rows = $wpdb->get_results( 'SELECT * FROM `' . esc_sql( $table ) . '`', ARRAY_A );
            if ( $wpdb->last_error ) {
                $result['tables'][ $key ] = array( 'name' => $table, 'exists' => true, 'columns' => $columns, 'error' => 'Could not read table rows.' );
                continue;
            }
            $safe = array();
            foreach ( (array) $rows as $row ) { $safe[] = $this->safe_row( $row, $full ); }
            $result['tables'][ $key ] = array( 'name' => $table, 'exists' => true, 'columns' => $columns, 'row_count' => count( $safe ), 'rows' => $safe );
        }
        return $result;
    }

    private function relationships( string $dir ): array {
        $content = $this->read( "$dir/02-content.json" ); $nav = $this->read( "$dir/03-navigation.json" );
        $by_id = array(); foreach ( (array) ( $content['items'] ?? array() ) as $item ) { $by_id[ (int) $item['id'] ] = $item; }
        $rows = array(); $targets = array(); $usage = array();
        foreach ( (array) ( $nav['menus'] ?? array() ) as $menu ) { foreach ( (array) ( $menu['items'] ?? array() ) as $item ) {
            $id = (int) ( $item['object_id'] ?? 0 ); $page = $by_id[ $id ] ?? null; if ( $id ) { $targets[ $id ] = true; }
            $shortcodes = $page['shortcodes'] ?? ( $item['linked_shortcodes'] ?? array() ); foreach ( $shortcodes as $tag ) { $usage[ $tag ] = ( $usage[ $tag ] ?? 0 ) + 1; }
            $rows[] = array( 'menu' => $menu['name'] ?? null, 'menu_location' => $menu['locations'] ?? array(), 'menu_item_title' => $item['title'] ?? null, 'menu_item_url' => $item['url'] ?? null, 'destination_id' => $id ?: null, 'destination_type' => $page['post_type'] ?? ( $item['linked_post_type'] ?? null ), 'destination_title' => $page['title'] ?? ( $item['linked_post_title'] ?? null ), 'destination_slug' => $page['slug'] ?? ( $item['linked_post_slug'] ?? null ), 'shortcodes' => $shortcodes, 'builder_signals' => $page['builder_signals'] ?? array(), 'template' => $page['template'] ?? null );
        } }
        $orphans = array(); foreach ( $by_id as $id => $page ) { if ( 'page' === ( $page['post_type'] ?? '' ) && 'publish' === ( $page['status'] ?? '' ) && empty( $targets[ $id ] ) ) { $orphans[] = array( 'id' => $id, 'title' => $page['title'] ?? null, 'slug' => $page['slug'] ?? null, 'url' => $page['url'] ?? null ); } }
        arsort( $usage );
        return array( 'menu_to_content' => $rows, 'summary' => array( 'captured_pages' => count( $by_id ), 'menu_relationships' => count( $rows ), 'shortcode_usage_in_menu_targets' => $usage, 'published_pages_not_in_any_menu' => $orphans ) );
    }

    private function finalize( string $id, string $dir, bool $full ): array {
        $files = (array) glob( "$dir/*.json" ); sort( $files );
        $manifest = array(
            'engine' => 'Bali Eling Spirit Audit Engine', 'engine_version' => BES_AUDIT_VERSION,
            'generated_at_utc' => gmdate( 'c' ), 'include_code' => $full, 'site' => home_url( '/' ),
            'peak_memory_bytes' => memory_get_peak_usage( true ), 'files' => array_map( 'basename', $files ),
            'notes' => array(
                'No database credentials, auth salts, user passwords, WooCommerce orders/customers or session data are intentionally exported.',
                'Full item capture is focused on WordPress pages; non-page public post types are summarized to avoid loading large product/LMS catalogs in one request.',
                'Menu-linked non-page content is captured when include_code=true.',
                'WPCodeBox tables are discovered using the active WordPress table prefix.',
                'Password/token/secret/license/key-like WPCodeBox columns are omitted. Secrets embedded inside snippet source are not modified because that would corrupt migration code.',
            ),
        );
        $this->write( "$dir/00-manifest.json", $manifest );
        $files = (array) glob( "$dir/*.json" ); sort( $files );
        $zip_ready = false;
        if ( class_exists( 'ZipArchive' ) ) {
            $zip = new ZipArchive();
            if ( true === $zip->open( "$dir/bundle.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) {
                foreach ( $files as $file ) { $zip->addFile( $file, basename( $file ) ); }
                $zip_ready = $zip->close() && is_readable( "$dir/bundle.zip" ) && filesize( "$dir/bundle.zip" ) > 0;
            }
            if ( ! $zip_ready && file_exists( "$dir/bundle.zip" ) ) { @unlink( "$dir/bundle.zip" ); }
        }
        if ( $zip_ready ) { $filename = 'bali-eling-spirit-audit.zip'; }
        else {
            $bundle = array(); foreach ( $files as $file ) { $bundle[ basename( $file ) ] = $this->read( $file ); }
            $this->write( "$dir/bundle.json", $bundle ); $filename = 'bali-eling-spirit-audit.json';
        }
        return array( 'filename' => $filename, 'downloadUrl' => wp_nonce_url( admin_url( 'admin-post.php?action=bes_audit_download&audit_id=' . rawurlencode( $id ) ), 'bes_audit_download_' . $id ), 'manifest' => $manifest );
    }

    private function post_types(): array {
        $out = array();
        foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $name => $o ) {
            $c = wp_count_posts( $name );
            $out[] = array( 'name' => $name, 'label' => $o->labels->name ?? $name, 'rest_base' => $o->rest_base, 'hierarchical' => (bool) $o->hierarchical, 'has_archive' => $o->has_archive, 'rewrite' => $o->rewrite, 'published' => isset( $c->publish ) ? (int) $c->publish : 0 );
        }
        return $out;
    }

    private function lms( array $plugins ): array {
        $known = array( 'learndash' => array( 'sfwd-lms', 'learndash' ), 'tutor-lms' => array( 'tutor-lms', 'tutor' ), 'learnpress' => array( 'learnpress' ), 'lifterlms' => array( 'lifterlms' ), 'sensei' => array( 'sensei-lms', 'sensei' ), 'masterstudy' => array( 'masterstudy', 'stm-lms' ) ); $out = array();
        foreach ( $plugins as $p ) { if ( empty( $p['active'] ) && empty( $p['network_active'] ) ) { continue; } $hay = strtolower( $p['file'] . ' ' . $p['name'] ); foreach ( $known as $name => $needles ) { foreach ( $needles as $n ) { if ( false !== strpos( $hay, $n ) ) { $out[] = array( 'type' => 'plugin', 'lms' => $name, 'source' => $p['file'] ); break 2; } } } }
        foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $name => $o ) { $hay = strtolower( $name . ' ' . ( $o->labels->name ?? '' ) ); if ( preg_match( '/course|lesson|quiz|topic|sfwd-|lp_course|tutor|stm-courses/', $hay ) ) { $out[] = array( 'type' => 'post_type', 'lms' => 'unknown-or-custom', 'source' => $name ); } }
        return array_values( array_unique( $out, SORT_REGULAR ) );
    }

    private function extract_shortcodes( string $body ): array { preg_match_all( '/\[([A-Za-z0-9_-]+)(?:\s[^\]]*)?\]/', $body, $m ); $tags = array_values( array_unique( array_filter( $m[1] ?? array() ) ) ); sort( $tags ); return $tags; }
    private function blocks( string $body ): array { preg_match_all( '/<!--\s+wp:([a-z0-9\/-]+)/i', $body, $m ); $v = array_values( array_unique( $m[1] ?? array() ) ); sort( $v ); return $v; }
    private function builders( int $id, string $body ): array { $keys = array( '_elementor_data' => 'Elementor', '_et_pb_use_builder' => 'Divi', '_fl_builder_enabled' => 'Beaver Builder', 'bricks_page_content_2' => 'Bricks', '_bricks_page_content_2' => 'Bricks', 'breakdance_data' => 'Breakdance', '_oxygen_vsb_page_settings' => 'Oxygen' ); $out = array(); foreach ( $keys as $key => $label ) { if ( metadata_exists( 'post', $id, $key ) ) { $out[] = "$label:$key"; } } if ( str_contains( $body, '[vc_' ) ) { $out[] = 'WPBakery:shortcode'; } if ( str_contains( $body, '[et_pb_' ) ) { $out[] = 'Divi:shortcode'; } return array_values( array_unique( $out ) ); }
    private function callback( $cb ): string { if ( is_string( $cb ) ) { return $cb; } if ( is_array( $cb ) && 2 === count( $cb ) ) { return ( is_object( $cb[0] ) ? get_class( $cb[0] ) : (string) $cb[0] ) . '::' . (string) $cb[1]; } if ( $cb instanceof Closure ) { return 'Closure'; } return is_object( $cb ) ? get_class( $cb ) : gettype( $cb ); }
    private function safe_row( array $row, bool $full ): array { $safe = array(); foreach ( $row as $col => $value ) { $lc = strtolower( $col ); if ( preg_match( '/(^|_)(password|passwd|pwd|secret|token|license|licence|api_key|apikey|private_key|access_key|auth_key|credential|credentials|authorization|cookie|session)($|_)/', $lc ) ) { $safe[ $col ] = '[omitted-sensitive-column]'; continue; } $code = preg_match( '/(^|_)(code|content|snippet|css|scss|less|javascript|js|html|php|json)($|_)/', $lc ); if ( ! $full && $code && is_string( $value ) ) { $safe[ $col ] = array( 'omitted' => true, 'length' => strlen( $value ), 'sha256' => hash( 'sha256', $value ) ); } else { $safe[ $col ] = $value; } } return $safe; }
    private function root_dir(): string { return trailingslashit( get_temp_dir() ) . 'bes-audit-engine'; }
    private function dir( string $id ): string { return $this->root_dir() . '/' . $id; }
    private function ensure_dir( string $id ): string { $root = $this->root_dir(); $dir = $this->dir( $id ); if ( ! is_dir( $root ) && ! wp_mkdir_p( $root ) ) { throw new RuntimeException( 'Cannot create temp directory.' ); } if ( ! file_exists( "$root/index.html" ) ) { @file_put_contents( "$root/index.html", '', LOCK_EX ); } if ( ! file_exists( "$root/.htaccess" ) ) { @file_put_contents( "$root/.htaccess", "Options -Indexes\n<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n", LOCK_EX ); } if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) { throw new RuntimeException( 'Cannot create audit directory.' ); } return $dir; }
    private function purge_stale(): void { $root = $this->root_dir(); if ( ! is_dir( $root ) ) { return; } $cutoff = time() - self::STALE_SECONDS; foreach ( (array) scandir( $root ) as $item ) { if ( '.' === $item || '..' === $item || 'index.html' === $item || '.htaccess' === $item ) { continue; } $path = "$root/$item"; if ( is_dir( $path ) && @filemtime( $path ) < $cutoff ) { $this->rm( $path ); } } }
    private function write( string $file, array $data ): void { $json = wp_json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); if ( false === $json || false === file_put_contents( $file, $json, LOCK_EX ) ) { throw new RuntimeException( 'Cannot write audit data.' ); } }
    private function read( string $file ): array { if ( ! is_readable( $file ) ) { return array(); } $v = json_decode( (string) file_get_contents( $file ), true ); return is_array( $v ) ? $v : array(); }
    private function rm( string $dir ): void { if ( ! is_dir( $dir ) ) { return; } foreach ( (array) scandir( $dir ) as $item ) { if ( '.' === $item || '..' === $item ) { continue; } $path = "$dir/$item"; is_dir( $path ) ? $this->rm( $path ) : @unlink( $path ); } @rmdir( $dir ); }
}
