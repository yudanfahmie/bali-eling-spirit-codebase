<?php 

/**
 * Intercept URL parameter to output the 6 latest photos as JSON.
 * Trigger via: yourdomain.com/?6latest=true (works on any page route)
 */
add_action( 'init', 'wp_custom_latest_photos_endpoint' );

function wp_custom_latest_photos_endpoint() {
    // 1. Listen for the exact GET parameter
    if ( isset( $_GET['6latest'] ) && $_GET['6latest'] === 'true' ) {
        
        // 2. Query for the 6 latest image attachments
        $args = [
            'post_type'              => 'attachment',
            'post_mime_type'         => 'image',      // Strictly images only
            'post_status'            => 'inherit',
            'posts_per_page'         => 6,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'no_found_rows'          => true,         // Performance tweak: skips pagination counting
            'ignore_sticky_posts'    => true,
        ];

        $photos = get_posts( $args );
        $results = [];

        // 3. Format the data into a detailed array
        if ( ! empty( $photos ) ) {
            foreach ( $photos as $photo ) {
                // Fetch the core image metadata (width, height, file size)
                $meta = wp_get_attachment_metadata( $photo->ID );
                
                $results[] = [
                    'id'          => $photo->ID,
                    'title'       => $photo->post_title,
                    'caption'     => $photo->post_excerpt,
                    'alt_text'    => get_post_meta( $photo->ID, '_wp_attachment_image_alt', true ),
                    'format'      => $photo->post_mime_type, // e.g., image/jpeg, image/webp
                    'url'         => wp_get_attachment_url( $photo->ID ),
                    'upload_date' => $photo->post_date,
                    'dimensions'  => isset( $meta['width'], $meta['height'] ) ? "{$meta['width']}x{$meta['height']}" : 'unknown',
                    'filesize'    => isset( $meta['filesize'] ) ? size_format( $meta['filesize'] ) : 'unknown',
                ];
            }
        }

        // 4. Output the array securely as JSON and halt WordPress execution
        wp_send_json( $results );
    }
}