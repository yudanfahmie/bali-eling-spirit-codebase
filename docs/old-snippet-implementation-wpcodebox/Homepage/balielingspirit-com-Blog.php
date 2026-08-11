<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — Wisdom / Blog Carousel Section
 * ============================================================================
 * Shortcode: [bes_blog_section]
 * Design System: v3 Premium Overhaul (Forced UI Overrides)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_blog_section', 'bes_render_blog_section' );

function bes_render_blog_section() {
    // Fetch 9 latest posts
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
    );
    $blog_query = new WP_Query( $args );

    ob_start();
    ?>
    <section class="relative py-28 px-6 md:px-10 lg:px-20 bg-bes-forest overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none bes-fret mix-blend-overlay" style="background-position: center bottom; filter: invert(1);"></div>

        <div class="hidden md:block absolute top-0 left-0 w-16 lg:w-32 h-full bg-gradient-to-r from-bes-forest via-bes-forest/90 to-transparent z-10 pointer-events-none"></div>
        <div class="hidden md:block absolute top-0 right-0 w-16 lg:w-32 h-full bg-gradient-to-l from-bes-forest via-bes-forest/90 to-transparent z-10 pointer-events-none"></div>

        <div class="relative max-w-[1440px] mx-auto z-0">
            
            <div class="text-center mb-16 md:mb-20 bes-reveal">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="w-10 h-[1px] bg-gradient-to-r from-transparent to-bes-leaf/50"></span>
                    <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">Sacred Teachings</span>
                    <span class="w-10 h-[1px] bg-gradient-to-l from-transparent to-bes-leaf/50"></span>
                </div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight drop-shadow-sm">
                    Words of <em class="italic !text-bes-gold font-medium">Wisdom</em>
                </h2>
                <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    Explore our latest insights on dharma, healing, and spiritual sovereignty. Let these teachings guide your daily rituals.
                </p>
            </div>

            <div class="relative bes-reveal" style="transition-delay: 0.2s;">
                <div class="splide bes-wisdom-carousel pb-16">
                    <div class="splide__track !overflow-visible">
                        <ul class="splide__list">
                            
                            <?php if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                                <?php 
                                    // Get first category
                                    $categories = get_the_category();
                                    $cat_name = !empty($categories) ? $categories[0]->name : 'Wisdom';
                                ?>
                                <li class="splide__slide">
                                    <a href="<?php the_permalink(); ?>" class="group block h-full relative bg-[#1A2415] border border-white/[0.05] rounded-2xl overflow-hidden hover:border-bes-leaf/40 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(194,210,74,0.1)] flex flex-col">
                                        
                                        <div class="aspect-[4/3] overflow-hidden relative border-b border-white/[0.02]">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s] ease-out opacity-90 group-hover:opacity-100" />
                                            <?php else: ?>
                                                <div class="w-full h-full bg-bes-forest flex items-center justify-center group-hover:scale-105 transition-transform duration-[1.5s]">
                                                    <i class="fa-solid fa-leaf text-bes-leaf/20 text-4xl"></i>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#1A2415] via-transparent to-transparent opacity-90"></div>
                                            <div class="absolute bottom-4 left-5">
                                                <span class="text-[9px] font-bold uppercase tracking-[0.2em] !text-bes-gold bg-black/50 backdrop-blur-md border border-white/10 shadow-lg px-4 py-2 rounded-full">
                                                    <?php echo esc_html($cat_name); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-6 md:p-8 flex flex-col flex-1 relative z-10">
                                            <span class="text-bes-parchment/40 text-[10px] font-body uppercase tracking-[0.15em] mb-3 block">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </span>
                                            <h3 class="font-display text-2xl lg:text-[26px] text-bes-ivory mb-4 group-hover:!text-bes-leaf transition-colors duration-300 leading-snug line-clamp-2">
                                                <?php the_title(); ?>
                                            </h3>
                                            <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed mb-8 line-clamp-3">
                                                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                            </p>
                                            
                                            <div class="mt-auto border-t border-white/[0.04] pt-5">
                                                <span class="inline-flex items-center gap-2 text-[10.5px] font-bold uppercase tracking-[0.15em] text-bes-leaf group-hover:!text-bes-gold transition-colors duration-300">
                                                    Read Article <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-2 transition-transform duration-300"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); else: ?>
                                <li class="splide__slide">
                                    <p class="text-bes-parchment/50 font-body text-center p-10">No wisdom teachings found.</p>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <style>
        /* ====================================================================
           FORCED SMART OVERRIDES FOR SPLIDE
           Fixes theme conflicts causing arrows to bunch at the top.
        ==================================================================== */
        
        /* Ensures the container holding the arrows spans full height */
        .bes-wisdom-carousel .splide__arrows {
            position: absolute !important;
            top: 50% !important;
            left: 0 !important;
            width: 100% !important;
            transform: translateY(-50%) !important;
            z-index: 20 !important;
            pointer-events: none !important; /* Lets you click through empty space */
        }

        /* 1. Arrow Structural & Aesthetic Fixes */
        .bes-wisdom-carousel .splide__arrow {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important; /* Hard-force vertical center */
            background: rgba(26, 36, 21, 0.8) !important;
            backdrop-filter: blur(8px) !important;
            border: 1px solid rgba(194, 210, 74, 0.3) !important;
            color: #C2D24A !important;
            height: 3.5rem !important;
            width: 3.5rem !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.4s cubic-bezier(.4,0,.2,1) !important;
            opacity: 1 !important;
            pointer-events: auto !important; /* Re-enable clicks on arrows */
        }

        .bes-wisdom-carousel .splide__arrow:hover {
            background: #C2D24A !important;
            border-color: #C2D24A !important;
            color: #151E10 !important;
            transform: translateY(-50%) scale(1.1) !important; /* Keep Y center while scaling */
            box-shadow: 0 10px 25px -5px rgba(194,210,74,0.4) !important;
        }

        .bes-wisdom-carousel .splide__arrow svg {
            fill: currentColor !important;
            height: 1.25rem !important;
            width: 1.25rem !important;
            display: block !important;
        }
        
        /* Arrow Placement (Inside wrapper slightly on mobile, pushed out on desktop) */
        .bes-wisdom-carousel .splide__arrow--prev { left: -1rem !important; }
        .bes-wisdom-carousel .splide__arrow--next { right: -1rem !important; }

        @media (min-width: 1024px) {
            .bes-wisdom-carousel .splide__arrow--prev { left: -3.5rem !important; }
            .bes-wisdom-carousel .splide__arrow--next { right: -3.5rem !important; }
        }

        /* 2. Custom Pagination */
        .bes-wisdom-carousel .splide__pagination {
            position: absolute !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 10 !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            justify-content: center !important;
        }
        .bes-wisdom-carousel .splide__pagination__page {
            background: rgba(194, 210, 74, 0.2) !important;
            border: 1px solid transparent !important;
            border-radius: 50% !important;
            height: 8px !important;
            width: 8px !important;
            margin: 0 6px !important;
            padding: 0 !important;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
            display: inline-block !important;
        }
        .bes-wisdom-carousel .splide__pagination__page:hover {
            background: rgba(194, 210, 74, 0.6) !important;
        }
        .bes-wisdom-carousel .splide__pagination__page.is-active {
            background: #C2D24A !important;
            transform: scale(1.5) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 0 10px rgba(194,210,74,0.4) !important;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var initWisdomCarousel = function() {
            var el = document.querySelector('.bes-wisdom-carousel');
            if(el && typeof Splide !== 'undefined') {
                new Splide(el, {
                    type       : 'loop',
                    perPage    : 3,
                    gap        : '2.5rem',
                    autoplay   : true,
                    interval   : 6000,
                    speed      : 1000,
                    arrows     : true,
                    pagination : true,
                    easing     : 'cubic-bezier(.4,0,.2,1)',
                    breakpoints: {
                        1180: { perPage: 2, gap: '2rem' },
                        768:  { perPage: 1, gap: '1.5rem', padding: { left: 0, right: '3rem' } },
                        480:  { padding: { left: 0, right: '1.5rem' } }
                    }
                }).mount();
            } else {
                setTimeout(initWisdomCarousel, 150);
            }
        };
        initWisdomCarousel();
    });
    </script>
    <?php
    return ob_get_clean();
}