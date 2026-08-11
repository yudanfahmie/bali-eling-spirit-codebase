<?php 

/**
 * Resolve specific 404 URLs from logs and 301 redirect them to their correct destinations.
 */
add_action( 'template_redirect', 'sas_resolve_logged_404_redirects' );

function sas_resolve_logged_404_redirects() {
    // Do not run on the WordPress admin dashboard
    if ( is_admin() ) {
        return;
    }

    // Safely get the requested path, convert to lowercase, and strip leading/trailing slashes
    $raw_path     = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    $current_path = strtolower( trim( (string) $raw_path, '/' ) );

    // Define the redirect map: 'missing-path' => '/new-destination/'
    $redirect_map = [
        // 1. Contact 404 variations -> /contact/
        'contact-us'                     => '/contact/',
        'kontakt.html'                   => '/contact/',
        'contactez-nous'                 => '/contact/',
        'contatti'                       => '/contact/',
        'contacto'                       => '/contact/',
        'contactos'                      => '/contact/',
        'kontakt'                        => '/contact/',
        'impressum'                      => '/contact/', // Kept from previous log
        
        // 2. Erroneous EN home path -> Home
        'en/enhome'                      => '/',
        
        // 3. Old Media Yoga Path -> /yoga-teacher-training/
        'media/definisi-pengertian-yoga' => '/yoga-teacher-training/',
        
        // 4. Old Retreats Path -> /healing-retreat/
        'retreats'                       => '/healing-retreat/',

        // 5. Checkout variations -> /checkout/
        'checkout-2'                     => '/checkout/',

        // 6. Old Courses Path -> /sanctuary/
        'courses-page'                   => '/sanctuary/',

        'blog-verify'                    => '/wisdom',
        'enhancecp'                      => '/',
        'batch/v1'                       => '/',
        'our-events'                     => '/events',
        'events/yoga-teacher-training-200-hour' => '/200hr-ytt',
    ];

    // If the current path matches a key in our map, perform the redirect
    if ( array_key_exists( $current_path, $redirect_map ) ) {
        // Build the target URL dynamically based on the site's home URL
        $target_path = $redirect_map[ $current_path ];
        $target_url  = home_url( $target_path );
        
        // Perform a safe 301 (Permanent) redirect
        wp_safe_redirect( $target_url, 301 );
        exit;
    }
}