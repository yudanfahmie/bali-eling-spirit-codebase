<?php
/**
 * ==============================================================================
 * BALI ELING SPIRIT — Blog Archive & Filtering Engine
 * ==============================================================================
 * Shortcode: [bes_blog_archive]
 * Description: Masonry/Grid blog layout with GSAP real-time category & search filtering.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. SETUP: Archive Query
add_action('pre_get_posts', 'bes_modify_archive_query');
function bes_modify_archive_query($query) {
    if (!is_admin() && $query->is_main_query() && (is_archive() || is_search() || is_home())) {
        $query->set('posts_per_page', 100); 
    }
}

// 2. RENDER ENGINE
function bes_render_archive_engine($atts = [], $is_archive_mode = false) {
    
    // --- Configuration ---
    $init_display_count = 6; 

    if ($is_archive_mode) {
        global $wp_query;
        $query = $wp_query;
        // Titles setup...
        if (is_search()) {
            $section_subtitle = 'Search Results';
            $section_title = 'Seeking: <em class="italic text-bes-gold font-medium">&ldquo;' . get_search_query() . '&rdquo;</em>';
        } elseif (is_category()) {
            $section_subtitle = 'Category';
            $section_title = single_cat_title('', false);
        } else {
            $section_subtitle = 'Sacred Teachings';
            $section_title = 'Words of <em class="italic text-bes-gold font-medium">Wisdom</em>';
        }
    } else {
        // Shortcode setup...
        $atts = shortcode_atts(array(
            'category' => '', 
            'count'    => -1, 
            'init'     => 6
        ), $atts);
        $init_display_count = intval($atts['init']);

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $atts['count'],
            'post_status'    => 'publish',
        );
        if (!empty($atts['category'])) {
            $args['category_name'] = $atts['category'];
        }
        $query = new WP_Query($args);
        
        $section_subtitle = 'Sacred Teachings';
        $section_title = 'Words of <em class="italic text-bes-gold font-medium">Wisdom</em>';
    }

    ob_start();
    
    $unique_id = uniqid('bes_blog_');
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        /* --- LAYOUT --- */
        .bes-masonry-col { 
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2.5rem;
            width: 100%;
        }
        @media (min-width: 768px) { .bes-masonry-col { grid-template-columns: repeat(2, 1fr); gap: 2rem; } }
        @media (min-width: 1024px) { .bes-masonry-col { grid-template-columns: repeat(3, 1fr); gap: 2.5rem; } }

        /* --- CARD STATES (For GSAP) --- */
        .bes-blog-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            opacity: 0; 
            transform: translateY(30px);
            will-change: transform, opacity;
            backface-visibility: hidden; 
        }

        /* --- LOGIC CLASSES --- */
        .bes-filtered-out { display: none !important; } 
        .bes-hidden-queue { display: none !important; } 
        .page-header { display: none; } /* Hide default theme headers if hijacking archive */

        /* --- CONTROLS SECTION --- */
        .bes-controls-wrapper {
            display: flex; flex-direction: column; gap: 20px;
            margin-bottom: 40px; padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        @media (min-width: 768px) {
            .bes-controls-wrapper { flex-direction: row; align-items: center; justify-content: space-between; }
        }

        /* --- SEARCH BOX --- */
        .bes-search-wrapper { 
            position: relative; 
            width: 100%; 
            max-width: 320px; 
            display: flex;
            align-items: center;
        }
        .bes-search-input {
            width: 100%;
            box-sizing: border-box !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 99px !important;
            padding: 12px 20px 12px 48px !important; /* Force padding to clear the icon */
            color: #F4F1EB !important;
            font-family: inherit;
            font-size: 0.9rem;
            line-height: 1.5 !important;
            outline: none;
            transition: all 0.3s ease;
        }
        .bes-search-input::placeholder { 
            color: rgba(244, 241, 235, 0.3); 
            opacity: 1; /* Prevents Firefox from fading the placeholder too much */
        }
        .bes-search-input:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: #C2D24A !important;
            box-shadow: 0 0 0 4px rgba(194, 210, 74, 0.1) !important;
        }
        .bes-search-icon {
            position: absolute; 
            left: 20px; 
            top: 50%;
            transform: translateY(-50%);
            color: rgba(244, 241, 235, 0.4); 
            pointer-events: none;
            z-index: 2;
            font-size: 14px; /* Lock icon size to prevent theme scaling */
        }

        /* --- TABS --- */
        .bes-tabs-wrapper { display: flex; flex-wrap: wrap; gap: 10px; }
        .bes-tab-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(244, 241, 235, 0.6);
            padding: 8px 20px;
            border-radius: 99px;
            font-size: 0.75rem; 
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-weight: 700;
            cursor: pointer; 
            transition: all 0.3s ease;
        }
        .bes-tab-btn:hover { 
            background: rgba(255, 255, 255, 0.05); 
            color: #F4F1EB; 
            border-color: rgba(255,255,255,0.3);
        }
        .bes-tab-btn.active {
            background: #C2D24A; /* bes-leaf */
            border-color: #C2D24A; 
            color: #151E10; /* bes-forest-deep */
            box-shadow: 0 4px 15px rgba(194, 210, 74, 0.2);
        }
        
        .bes-load-wrapper { display: none; opacity: 0; }
        .bes-no-results { display: none; text-align: center; padding: 60px 20px; color: rgba(244,241,235,0.5); }
    </style>

    <section class="relative py-20 md:py-28 px-6 md:px-10 lg:px-20 bg-bes-forest overflow-hidden" id="root-<?php echo $unique_id; ?>">
        
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none bes-fret mix-blend-overlay" style="background-position: center bottom; filter: invert(1);"></div>

        <div class="max-w-[1440px] mx-auto relative z-10">
            
            <div class="mb-16 md:mb-20">
                <div class="flex items-center gap-3 mb-5">
                    <span class="w-8 h-[1px] bg-gradient-to-r from-transparent to-bes-leaf/50"></span>
                    <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">
                        <?php echo esc_html($section_subtitle); ?>
                    </span>
                </div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory leading-tight drop-shadow-sm">
                    <?php echo $section_title; ?>
                </h2>
            </div>

            <div class="bes-controls-wrapper font-body">
                
                <div class="bes-tabs-wrapper">
                <?php 
                if (!$is_archive_mode && empty($atts['category'])) {
                    $args_cats = array('orderby' => 'count', 'order' => 'DESC', 'hide_empty' => 1);
                    $categories_list = get_categories($args_cats);
                    
                    if (!empty($categories_list)) {
                        echo '<a href="javascript:void(0);" class="bes-tab-btn active inline-block cursor-pointer select-none" onclick="BesBlogManager.setCategory(\''. $unique_id .'\', \'all\', this)">All</a>';
                        foreach ($categories_list as $category) {
                            if($category->count > 0) {
                                echo '<a href="javascript:void(0);" class="bes-tab-btn inline-block cursor-pointer select-none !text-white/40" onclick="BesBlogManager.setCategory(\''. $unique_id .'\', \''. esc_attr($category->slug) .'\', this)">' . esc_html($category->name) . '</a>';
                            }
                        }
                    }
                }
                ?>
                </div>

                <div class="bes-search-wrapper">
                    <i class="fa-solid fa-magnifying-glass bes-search-icon"></i>
                    <input type="text" 
                           class="bes-search-input" 
                           placeholder="Search teachings..." 
                           oninput="BesBlogManager.search('<?php echo $unique_id; ?>', this.value)">
                </div>

            </div>

            <?php if ($query->have_posts()) : ?>
                <div class="bes-masonry-col" id="container-<?php echo $unique_id; ?>">
                    <?php 
                    $i = 0;
                    while ($query->have_posts()) : $query->the_post(); 
                        $i++;
                        $isHidden = $i > $init_display_count ? 'bes-hidden-queue' : ''; 
                        
                        $categories = get_the_category();
                        $cat_name = !empty($categories) ? $categories[0]->name : 'Wisdom';
                        $post_cat_slugs = [];
                        foreach($categories as $c) { $post_cat_slugs[] = $c->slug; }
                        $data_cats = implode(' ', $post_cat_slugs);
                        
                        $search_string = strtolower(get_the_title() . ' ' . strip_tags(get_the_excerpt()));
                    ?>
                        <article class="bes-blog-card <?php echo $isHidden; ?> group block relative bg-[#1A2415] border border-white/[0.05] rounded-2xl overflow-hidden hover:border-bes-leaf/40 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(194,210,74,0.1)]" 
                                 data-cats="<?php echo esc_attr($data_cats); ?>"
                                 data-search="<?php echo esc_attr($search_string); ?>">
                            
                            <a href="<?php the_permalink(); ?>" class="flex flex-col h-full">
                                
                                <div class="aspect-[4/3] overflow-hidden relative border-b border-white/[0.02] flex-shrink-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.5s] ease-out opacity-90 group-hover:opacity-100" />
                                    <?php else: ?>
                                        <div class="w-full h-full bg-bes-forest flex items-center justify-center group-hover:scale-105 transition-transform duration-[1.5s]">
                                            <i class="fa-solid fa-leaf text-bes-leaf/20 text-4xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#1A2415] via-transparent to-transparent opacity-90"></div>
                                    <div class="absolute bottom-4 left-5">
                                        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-bes-gold bg-black/50 backdrop-blur-md border border-white/10 shadow-lg px-4 py-2 rounded-full">
                                            <?php echo esc_html($cat_name); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6 md:p-8 flex flex-col flex-1 relative z-10">
                                    <span class="text-bes-parchment/40 text-[10px] font-body uppercase tracking-[0.15em] mb-3 block">
                                        <?php echo get_the_date('M j, Y'); ?>
                                    </span>
                                    <h3 class="font-display text-2xl lg:text-[26px] text-bes-ivory mb-4 group-hover:text-bes-leaf transition-colors duration-300 leading-snug line-clamp-2">
                                        <?php the_title(); ?>
                                    </h3>
                                    <p class="font-body text-bes-parchment/60 text-[13.5px] leading-relaxed mb-8 line-clamp-3">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                    </p>
                                    
                                    <div class="mt-auto border-t border-white/[0.04] pt-5">
                                        <span class="inline-flex items-center gap-2 text-[10.5px] font-bold uppercase tracking-[0.15em] text-bes-leaf group-hover:text-bes-gold transition-colors duration-300">
                                            Read Article <i class="fa-solid fa-arrow-right-long text-[10px] group-hover:translate-x-2 transition-transform duration-300"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div id="no-results-<?php echo $unique_id; ?>" class="bes-no-results font-body">
                    <i class="fa-solid fa-seedling text-4xl mb-4 text-bes-leaf/40"></i>
                    <p class="text-lg">No teachings found matching your search.</p>
                </div>

                <div class="mt-16 text-center bes-load-wrapper" id="load-wrapper-<?php echo $unique_id; ?>">
                    <a href="javascript:void(0);" onclick="BesBlogManager.loadMore('<?php echo $unique_id; ?>')" 
                            class="group inline-flex cursor-pointer select-none items-center gap-3 px-8 py-4 border border-bes-leaf text-bes-leaf font-bold uppercase tracking-[0.2em] text-[10px] rounded-full hover:bg-bes-leaf hover:text-[#151E10] transition-all duration-300">
                        <span>Load More</span>
                        <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform"></i>
                    </a>
                </div>

            <?php else : ?>
                <div class="text-center py-20 text-bes-parchment/50 font-body">No wisdom teachings available yet.</div>
            <?php endif; ?>

        </div>
    </section>

    <script>
    var BesBlogManager = (function() {
        
        const BATCH_SIZE = <?php echo $init_display_count; ?>;
        const state = {};

        function init(id) {
            state[id] = { category: 'all', query: '' };
            const container = document.getElementById('container-' + id);
            if(!container) return;

            const visibleItems = container.querySelectorAll('.bes-blog-card:not(.bes-hidden-queue)');
            
            gsap.to(visibleItems, {
                duration: 0.8, autoAlpha: 1, y: 0, stagger: 0.1, ease: "power3.out"
            });

            checkLoadMoreVisibility(id);
        }

        function setCategory(id, catSlug, btn) {
            const btnGroup = btn.parentElement;
            btnGroup.querySelectorAll('.bes-tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            state[id].category = catSlug;
            runMasterFilter(id);
        }

        let debounceTimer;
        function search(id, val) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                state[id].query = val.toLowerCase().trim();
                runMasterFilter(id);
            }, 300);
        }

        function runMasterFilter(id) {
            const container = document.getElementById('container-' + id);
            const noResults = document.getElementById('no-results-' + id);
            if(!container) return;

            const activeCat = state[id].category;
            const activeQuery = state[id].query;

            const allItems = Array.from(container.children);
            gsap.killTweensOf(allItems);

            const tl = gsap.timeline();

            tl.to(allItems, {
                duration: 0.3, autoAlpha: 0, scale: 0.98, ease: "power2.in"
            });

            tl.add(() => {
                let shownCounter = 0;
                let matchCount = 0;

                allItems.forEach(item => {
                    const itemCats = item.getAttribute('data-cats') || '';
                    const itemSearch = item.getAttribute('data-search') || '';
                    
                    const isCatMatch = (activeCat === 'all') || itemCats.includes(activeCat);
                    const isSearchMatch = (activeQuery === '') || itemSearch.includes(activeQuery);
                    
                    if (isCatMatch && isSearchMatch) {
                        item.classList.remove('bes-filtered-out');
                        matchCount++;

                        if (shownCounter < BATCH_SIZE) {
                            item.classList.remove('bes-hidden-queue');
                            gsap.set(item, { display: 'flex', y: 30, scale: 0.95 });
                        } else {
                            item.classList.add('bes-hidden-queue');
                            gsap.set(item, { display: 'none' });
                        }
                        shownCounter++;
                    } else {
                        item.classList.add('bes-filtered-out');
                        item.classList.add('bes-hidden-queue');
                        gsap.set(item, { display: 'none' });
                    }
                });

                if(matchCount === 0) {
                    noResults.style.display = 'block';
                    container.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    container.style.display = 'grid'; 
                }

                checkLoadMoreVisibility(id);
            });

            tl.add(() => {
                const newVisible = container.querySelectorAll('.bes-blog-card:not(.bes-hidden-queue):not(.bes-filtered-out)');
                if(newVisible.length > 0) {
                    gsap.to(newVisible, {
                        duration: 0.6, autoAlpha: 1, y: 0, scale: 1, stagger: 0.05, ease: "back.out(1.2)"
                    });
                }
            });
        }

        function loadMore(id) {
            const container = document.getElementById('container-' + id);
            const queueItems = Array.from(container.children).filter(item => {
                return item.classList.contains('bes-hidden-queue') && 
                      !item.classList.contains('bes-filtered-out');
            });

            if (queueItems.length === 0) return;
            const nextBatch = queueItems.slice(0, BATCH_SIZE);

            nextBatch.forEach(item => {
                item.classList.remove('bes-hidden-queue');
                gsap.set(item, { display: 'flex', autoAlpha: 0, y: 30 });
            });

            gsap.to(nextBatch, {
                duration: 0.6, autoAlpha: 1, y: 0, stagger: 0.1, ease: "power3.out",
                onStart: () => checkLoadMoreVisibility(id)
            });
        }

        function checkLoadMoreVisibility(id) {
            const container = document.getElementById('container-' + id);
            const btnWrapper = document.getElementById('load-wrapper-' + id);
            const hiddenRemaining = container.querySelectorAll('.bes-blog-card.bes-hidden-queue:not(.bes-filtered-out)');
            
            if (hiddenRemaining.length > 0) {
                btnWrapper.style.display = 'block';
                gsap.to(btnWrapper, { autoAlpha: 1, duration: 0.3 });
            } else {
                gsap.to(btnWrapper, { 
                    autoAlpha: 0, 
                    duration: 0.3, 
                    onComplete: () => btnWrapper.style.display = 'none' 
                });
            }
        }

        return { init, loadMore, setCategory, search };
    })();

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => BesBlogManager.init('<?php echo $unique_id; ?>'), 100);
    });
    </script>

    <?php
    if (!$is_archive_mode) wp_reset_postdata();
    return ob_get_clean();
}

// 3. SHORTCODE
add_shortcode('bes_blog_archive', 'bes_blog_archive_shortcode');
function bes_blog_archive_shortcode($atts) {
    return bes_render_archive_engine($atts, false);
}

// 4. ARCHIVE HIJACK
add_action('loop_start', 'bes_hijack_main_loop');
function bes_hijack_main_loop($query) {
    if (!is_admin() && $query->is_main_query() && (is_archive() || is_search() || is_home())) {
        $query->set('posts_per_page', 100); 
        
        remove_action('loop_start', 'bes_hijack_main_loop');
        echo bes_render_archive_engine([], true);
        
        $query->posts = [];
        $query->post_count = 0;
    }
}
?>