<?php
/**
 * Bali Eling Spirit Single Post Override
 * Scope: Single Post
 * Logic: Smart Like AJAX + Ambient GSAP Hero + Golden Shimmer + Discussion System
 */

add_action("template_redirect", function () {
    // -----------------------------------------------------------
    // 1. SMART LIKE LOGIC HANDLER
    // -----------------------------------------------------------
    if (isset($_POST['bes_action']) && $_POST['bes_action'] === 'smart_like') {
        $post_id = intval($_POST['post_id']);
        $current_likes = (int) get_post_meta($post_id, '_bes_likes', true);
        $new_likes = $current_likes + 1;
        update_post_meta($post_id, '_bes_likes', $new_likes);
        wp_send_json_success(['count' => $new_likes]); 
    }

    if (!is_singular("post")) { return; }

    // -----------------------------------------------------------
    // 2. DATA PREP
    // -----------------------------------------------------------
    $post_id = get_the_ID();
    // Default to bes-forest dark fallback if no thumbnail
    $hero = get_the_post_thumbnail_url($post_id, "full") ?: "https://via.placeholder.com/1920x1080/151E10/151E10";
    $cats = get_the_category($post_id);
    $cat_name = !empty($cats) ? $cats[0]->name : "Wisdom";
    $cat_link = !empty($cats) ? get_category_link($cats[0]->term_id) : "#";
    $author_id = get_post_field("post_author", $post_id);
    $author_name = get_the_author_meta("display_name", $author_id);
    $author_img = get_avatar_url($author_id, ["size" => 96]);
    $tags = get_the_tags($post_id);
    $published_date = get_the_date('M d, Y');
    $like_count = (int) get_post_meta($post_id, '_bes_likes', true);
    $current_user = wp_get_current_user();

    get_header();
    ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
    /* =========================================
       1. AMBIENT GOLDEN SHIMMER & PANELS
       ========================================= */
    @keyframes goldenShimmer {
        0% { background-position: 0% 50%; }
        100% { background-position: 200% 50%; }
    }

    .bes-glass-panel {
        background: rgba(38, 51, 32, 0.4); /* bes-forest-92 / bes-olive baseline */
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.04);
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.3);
        border-radius: 20px;
    }

    /* ====================================================
       2. EDITORIAL CONTENT FORMATTING
       ==================================================== */
    
    .bes-content {
        color: rgba(232, 227, 213, 0.85); /* bes-parchment with opacity */
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.125rem;
        line-height: 1.85;
    }

    /* Force Golden Shimmer on Headings */
    .bes-content h2, 
    .bes-content h3, 
    .bes-content h4 { 
        font-family: 'Cormorant Garamond', serif !important;
        font-weight: 500 !important;
        letter-spacing: 0.01em !important;
        margin-top: 2.5em !important;
        margin-bottom: 0.8em !important;
        width: fit-content !important;
        position: relative !important;
        
        background: linear-gradient(
            90deg, 
            #C9A84C 0%,   /* bes-gold */
            #FDFCFA 25%,  /* bes-ivory */
            #C9A84C 50%, 
            #FDFCFA 75%, 
            #C9A84C 100% 
        ) !important;
        background-size: 200% auto !important;
        color: transparent !important;
        -webkit-background-clip: text !important;
        background-clip: text !important;
        animation: goldenShimmer 6s linear infinite !important;
        border: none !important;
    }

    /* Elegant Divider under Headings */
    .bes-content h2::after,
    .bes-content h3::after {
        content: "" !important;
        position: absolute !important;
        left: 0 !important;
        bottom: -6px !important; 
        width: 100% !important; 
        height: 1px !important; 
        background: linear-gradient(
            90deg, 
            rgba(201, 168, 76, 0) 0%, 
            rgba(201, 168, 76, 0.6) 50%, 
            rgba(201, 168, 76, 0) 100%
        ) !important;
    }

    .bes-content h2 { font-size: 2.5rem !important; line-height: 1.2 !important; }
    .bes-content h3 { font-size: 1.85rem !important; line-height: 1.3 !important; }
    .bes-content h4 { font-size: 1.4rem !important; line-height: 1.4 !important; }

    /* Paragraphs & Lists */
    .bes-content p { margin-bottom: 1.75em !important; }
    .bes-content a { color: #C2D24A !important; font-weight: 500; text-decoration: none; border-bottom: 1px solid rgba(194, 210, 74, 0.3); transition: border-color 0.3s ease; }
    .bes-content a:hover { border-color: #C2D24A !important; }
    .bes-content ul, .bes-content ol { margin-bottom: 1.75em !important; padding-left: 1.5em !important; }
    .bes-content li { margin-bottom: 0.5em !important; }
    .bes-content li::marker { color: #C2D24A !important; }

    /* Blockquotes */
    .bes-content blockquote {
        margin: 3rem 0 !important;
        padding: 2rem 2.5rem !important;
        background: rgba(201, 168, 76, 0.04) !important;
        border-left: 2px solid #C9A84C !important;
        border-radius: 0 16px 16px 0 !important;
        font-style: italic !important;
        font-family: 'Cormorant Garamond', serif !important;
        font-size: 1.4rem !important;
        color: #FDFCFA !important;
    }
    .bes-content blockquote p { margin-bottom: 0 !important; }

    /* Images */
    .bes-content img {
        border-radius: 12px !important;
        margin: 3rem auto !important;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.4) !important;
        border: 1px solid rgba(255,255,255,0.04) !important;
    }

    /* Heart Animation */
    .heart-active i { color: #C9A84C !important; transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .heart-active { border-color: rgba(201, 168, 76, 0.4) !important; background: rgba(201, 168, 76, 0.1) !important; }
    
    .swiper-wrapper { display: flex; }
    .swiper-slide { height: auto; display: flex; }
    
    /* Comment Nesting Lines */
    .nested-comment {
        border-left: 1px solid rgba(194, 210, 74, 0.15); /* bes-leaf */
        padding-left: 1.5rem;
        margin-top: 1rem;
    }
    @media (max-width: 768px) {
        .nested-comment { padding-left: 0.75rem; border-left: 1px solid rgba(194, 210, 74, 0.1); }
    }
    </style>

    <div id="bes-progress" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-bes-leaf to-bes-gold z-[9999]" style="width:0%"></div>

    <main class="min-h-screen relative w-full bg-bes-forest">
    
        <header class="relative w-full h-[85vh] overflow-hidden flex items-center justify-center z-10">
            <div class="absolute inset-0 z-0 overflow-hidden">
                <img src="<?php echo esc_url($hero); ?>" class="bes-hero-img w-full h-full object-cover opacity-50 scale-100">
                <div class="absolute inset-0 bg-bes-forest/40 mix-blend-multiply"></div>
                <div class="absolute bottom-0 left-0 right-0 h-[80%] bg-gradient-to-b from-transparent via-bes-forest/90 to-bes-forest"></div>
                
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative z-20 w-full max-w-[1440px] px-6 text-center pb-16">
                <div class="flex flex-wrap items-center justify-center gap-4 mb-8">
                     <a href="<?php echo esc_url($cat_link); ?>" class="bg-bes-forest-80/50 border border-bes-leaf/20 text-bes-leaf text-[10px] font-bold uppercase px-5 py-2 rounded-full tracking-label backdrop-blur-md hover:bg-bes-leaf hover:text-bes-forest transition-all duration-300">
                        <?php echo esc_html($cat_name); ?>
                    </a>
                </div>
                
                <h1 class="font-display font-medium text-4xl md:text-6xl lg:text-7xl leading-[1.15] text-bes-ivory mb-10 drop-shadow-lg max-w-5xl mx-auto">
                    <?php the_title(); ?>
                </h1>

                <div class="flex flex-wrap items-center justify-center gap-6 md:gap-12 pt-8 border-t border-white/[0.05] max-w-3xl mx-auto">
                    <div class="flex items-center gap-4 text-left">
                        <img src="<?php echo $author_img; ?>" class="w-12 h-12 rounded-full border border-bes-leaf/30">
                        <div>
                            <p class="font-body text-[9px] uppercase tracking-label text-bes-parchment/50 font-bold mb-0.5">Guided By</p>
                            <span class="font-body text-bes-ivory font-bold text-sm"><?php echo $author_name; ?></span>
                        </div>
                    </div>
                    <div class="flex flex-col text-left">
                         <p class="font-body text-[9px] uppercase tracking-label text-bes-parchment/50 font-bold mb-0.5">Revealed</p>
                         <span class="font-body text-bes-ivory font-bold text-sm"><?php echo $published_date; ?></span>
                    </div>
                    <div class="flex flex-col text-left ml-auto md:ml-0">
                        <button id="bes-like-btn" class="group flex items-center gap-3 bg-white/[0.02] border border-white/10 px-6 py-2.5 rounded-full hover:border-bes-gold/50 hover:bg-white/[0.05] transition-all cursor-pointer">
                            <i class="fa-solid fa-heart text-bes-parchment/40 group-hover:text-bes-gold transition-colors text-lg"></i>
                            <div class="flex flex-col items-start leading-none">
                                <span class="font-body text-[9px] uppercase tracking-label text-bes-parchment/50 font-bold mb-0.5">Resonate</span>
                                <span id="bes-like-count" data-val="<?php echo $like_count; ?>" class="font-body text-bes-ivory font-bold text-sm">
                                    <?php echo number_format_i18n($like_count); ?>
                                </span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <article class="relative z-20 w-full max-w-3xl mx-auto px-6 -mt-20 pb-16">
            
            <?php if(has_excerpt()): ?>
                <div class="bes-glass-panel p-8 md:p-10 mb-16 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-bes-gold/5 to-bes-leaf/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="relative z-10 text-xl md:text-2xl font-display text-bes-ivory leading-relaxed italic text-center">
                        <i class="fa-solid fa-quote-left text-bes-gold/40 text-3xl block mb-4 mx-auto"></i>
                        <?php echo get_the_excerpt(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bes-content">
                <?php the_content(); ?>
            </div>

            <?php if ($tags): ?>
            <div class="mt-20 pt-10 border-t border-white/[0.05]">
                <div class="flex flex-wrap gap-3">
                    <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="font-body text-[10px] font-bold uppercase tracking-label text-bes-parchment/70 hover:text-bes-forest bg-bes-forest-80 hover:bg-bes-leaf px-5 py-2.5 rounded-full transition-all border border-white/5 hover:border-transparent">
                            <?php echo $tag->name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </article>

        <div class="relative w-full h-[120px] overflow-hidden z-10 pointer-events-none flex items-center justify-center opacity-70">
             <div class="absolute w-[70%] max-w-3xl h-[1px] bg-gradient-to-r from-transparent via-bes-gold/30 to-transparent"></div>
             <div class="bg-bes-forest px-6 relative z-10">
                 <i class="fa-solid fa-seedling text-bes-gold/60 text-xl"></i>
             </div>
        </div>

        <section class="relative z-20 w-full max-w-3xl mx-auto px-6 mb-24">
            <h3 class="font-display font-medium text-3xl text-bes-ivory mb-10 flex items-center justify-center">
                Thoughts & Reflections
            </h3>

            <div id="bes-comment-form-container" class="bes-glass-panel p-6 md:p-8 mb-16 transition-all">
                <?php if ( comments_open() ) : ?>
                    <div id="reply-info-badge" class="hidden mb-6 bg-bes-leaf/10 border border-bes-leaf/20 rounded-xl p-4 flex justify-between items-center">
                        <div class="text-sm text-bes-leaf font-body">
                            <i class="fa-solid fa-reply mr-2"></i> Replying to <span id="reply-to-name" class="font-bold text-bes-ivory">Unknown</span>
                        </div>
                        <button onclick="cancelReply()" class="text-[10px] text-red-400 hover:text-red-300 font-bold uppercase tracking-widest">Cancel</button>
                    </div>

                    <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform" class="flex flex-col gap-6">
                        
                        <?php if ( is_user_logged_in() ) : ?>
                            <div class="flex items-center gap-3 mb-2">
                                <?php echo get_avatar($current_user->ID, 40, '', '', ['class' => 'rounded-full border border-bes-leaf/30']); ?>
                                <p class="font-body text-sm text-bes-parchment/60">Sharing as <span class="text-bes-leaf font-bold"><?php echo $current_user->display_name; ?></span>.</p>
                            </div>
                        <?php else : ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 font-body">
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-bes-parchment/50 tracking-label mb-2 block pl-1">Your Name</label>
                                    <input type="text" name="author" placeholder="How shall we address you?" class="w-full bg-bes-forest-80/50 border border-white/10 rounded-xl px-5 py-3.5 text-bes-ivory placeholder-bes-parchment/30 focus:outline-none focus:border-bes-leaf focus:bg-bes-forest-92 transition-all" required>
                                </div>
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-bes-parchment/50 tracking-label mb-2 block pl-1">Email</label>
                                    <input type="email" name="email" placeholder="Kept private" class="w-full bg-bes-forest-80/50 border border-white/10 rounded-xl px-5 py-3.5 text-bes-ivory placeholder-bes-parchment/30 focus:outline-none focus:border-bes-leaf focus:bg-bes-forest-92 transition-all" required>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="font-body">
                            <label class="text-[10px] uppercase font-bold text-bes-parchment/50 tracking-label mb-2 block pl-1">Your Reflection</label>
                             <textarea name="comment" id="comment" rows="4" placeholder="Share your thoughts with the community..." class="w-full bg-bes-forest-80/50 border border-white/10 rounded-xl px-5 py-3.5 text-bes-ivory placeholder-bes-parchment/30 focus:outline-none focus:border-bes-leaf focus:bg-bes-forest-92 transition-all resize-y" required></textarea>
                        </div>
                        
                        <div class="flex justify-between items-center pt-2 mt-2 font-body">
                            <p class="text-[10px] uppercase tracking-wide text-bes-parchment/40"><i class="fa-solid fa-leaf text-[9px] mr-1.5"></i> Sacred Space</p>
                            <button type="submit" class="group relative overflow-hidden bg-transparent border border-bes-leaf text-bes-leaf hover:bg-bes-leaf hover:text-bes-forest text-[11px] font-bold uppercase tracking-label py-3 px-8 rounded-full transition-all duration-300">
                                <span class="relative z-10 flex items-center">Share Reflection <i class="fa-solid fa-arrow-right ml-2.5 group-hover:translate-x-1 transition-transform"></i></span>
                            </button>
                        </div>
                        
                        <input type="hidden" name="comment_post_ID" value="<?php echo $post_id; ?>" id="comment_post_ID">
                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                        <?php do_action( 'comment_form', $post_id ); ?>
                    </form>
                <?php else : ?>
                    <div class="text-center py-6">
                        <p class="text-bes-parchment/50 font-body text-sm"><i class="fa-solid fa-moon mr-2 text-bes-gold/50"></i>Reflections are currently closed for this teaching.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-6">
                <?php 
                $all_comments = get_comments([
                    'post_id' => $post_id, 
                    'status' => 'approve', 
                    'orderby' => 'comment_date',
                    'order' => 'ASC'
                ]); 

                $comments_by_parent = [];
                foreach ($all_comments as $c) {
                    $comments_by_parent[$c->comment_parent][] = $c;
                }

                function bes_render_comments($parent_id, $depth, $comments_array, $author_id) {
                    if (!isset($comments_array[$parent_id])) return;

                    foreach ($comments_array[$parent_id] as $comment) {
                        $wrapper_class = ($depth > 1) ? 'nested-comment' : '';
                        $is_author = ($comment->user_id == $author_id);
                        $comment_author_name = get_comment_author($comment);
                        ?>
                        
                        <div class="w-full <?php echo $wrapper_class; ?> relative mb-6">
                            <div class="flex gap-4 md:gap-5">
                                <div class="flex-shrink-0 pt-1 hidden md:block">
                                    <?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full border border-white/5 opacity-80']); ?>
                                </div>

                                <div class="flex-grow">
                                    <div class="bg-bes-forest-92/60 border border-white/[0.03] rounded-2xl p-5 md:p-6 hover:bg-bes-forest-92 transition-all duration-300 relative group">
                                        
                                        <div class="flex justify-between items-start mb-3 font-body">
                                            <div class="flex items-center gap-3">
                                                <div class="md:hidden">
                                                    <?php echo get_avatar($comment, 32, '', '', ['class' => 'rounded-full border border-white/5']); ?>
                                                </div>
                                                <div>
                                                    <span class="font-display font-medium text-bes-ivory text-xl tracking-tight leading-none"><?php echo $comment_author_name; ?></span>
                                                    <?php if ($is_author): ?>
                                                        <span class="ml-2 px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-bes-gold/10 text-bes-gold border border-bes-gold/20 align-middle">Guide</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <span class="text-[10px] uppercase font-bold text-bes-parchment/40 tracking-wider"><?php echo get_comment_date('M d, Y', $comment); ?></span>
                                        </div>

                                        <div class="text-bes-parchment/70 text-sm md:text-[15px] leading-relaxed mb-4 font-body">
                                            <?php comment_text($comment); ?>
                                        </div>

                                        <?php if (comments_open() && $depth < 4): ?>
                                            <div class="flex justify-end">
                                                <button onclick="replyToComment('<?php echo $comment->comment_ID; ?>', '<?php echo esc_js($comment_author_name); ?>')" 
                                                        class="font-body text-[10px] font-bold uppercase tracking-label text-bes-parchment/50 hover:text-bes-leaf transition-colors flex items-center gap-1.5">
                                                    <i class="fa-solid fa-reply"></i> Reply
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            if ($depth < 4) {
                                bes_render_comments($comment->comment_ID, $depth + 1, $comments_array, $author_id);
                            }
                            ?>
                        </div>
                        <?php
                    }
                }

                if (!empty($comments_by_parent)) {
                    bes_render_comments(0, 1, $comments_by_parent, $author_id);
                } else {
                    ?>
                    <div class="flex flex-col items-center justify-center py-16 border border-dashed border-white/5 rounded-3xl opacity-60">
                        <i class="fa-solid fa-spa text-3xl text-bes-leaf/30 mb-4"></i>
                        <p class="text-bes-parchment/50 font-body text-sm text-center px-6">The space is quiet. Be the first to share your reflection.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>

        <section class="bg-bes-forest-deep border-t border-white/[0.03] pb-24 relative z-20">
            <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position: center bottom; filter: invert(1);"></div>

            <div class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 relative z-10">
                <div class="flex justify-between items-end mb-12">
                    <h2 class="font-display text-3xl md:text-4xl font-light text-bes-ivory">Related <em class="italic text-bes-gold font-medium">Teachings</em></h2>
                    <div class="flex gap-2">
                        <button class="swiper-prev w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-bes-parchment/50 hover:border-bes-leaf hover:bg-bes-leaf hover:text-bes-forest transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="swiper-next w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-bes-parchment/50 hover:border-bes-leaf hover:bg-bes-leaf hover:text-bes-forest transition-all"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                
                <div class="swiper bes-related-swiper w-full !overflow-visible">
                    <div class="swiper-wrapper">
                        <?php
                        $related = new WP_Query([
                            "post_type" => "post",
                            "posts_per_page" => 6,
                            "post__not_in" => [$post_id],
                            "category__in" => !empty($cats) ? wp_list_pluck($cats, 'term_id') : [],
                        ]);
                        if (!$related->have_posts()) {
                            $related = new WP_Query([ "post_type" => "post", "posts_per_page" => 6, "post__not_in" => [$post_id] ]);
                        }
                        while ($related->have_posts()): $related->the_post(); 
                            $rel_img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                            $rel_likes = (int) get_post_meta(get_the_ID(), '_bes_likes', true);
                        ?>
                            <div class="swiper-slide">
                                <article class="w-full h-full group cursor-pointer bg-bes-forest border border-white/[0.04] rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:border-bes-leaf/40 hover:shadow-[0_20px_40px_-15px_rgba(194,210,74,0.1)] flex flex-col">
                                    <a href="<?php the_permalink(); ?>" class="block aspect-[4/3] relative overflow-hidden flex-shrink-0 border-b border-white/[0.02]">
                                        <div class="absolute inset-0 bg-gradient-to-t from-bes-forest via-transparent to-transparent opacity-90 z-10"></div>
                                        <?php if($rel_img): ?>
                                            <img src="<?php echo esc_url($rel_img); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[1.5s] ease-out opacity-90 group-hover:opacity-100">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-bes-forest flex items-center justify-center group-hover:scale-105 transition-transform duration-[1.5s]"><i class="fa-solid fa-leaf text-bes-leaf/20 text-4xl"></i></div>
                                        <?php endif; ?>
                                        <div class="absolute top-4 right-4 z-20 bg-black/40 backdrop-blur-md border border-white/10 rounded-full px-3 py-1.5 flex items-center gap-2">
                                            <i class="fa-solid fa-heart text-[10px] text-bes-gold"></i>
                                            <span class="font-body text-[10px] font-bold text-bes-ivory"><?php echo number_format_i18n($rel_likes); ?></span>
                                        </div>
                                    </a>
                                    <div class="p-6 md:p-8 flex flex-col flex-1 relative z-10">
                                        <span class="text-bes-parchment/40 text-[10px] font-body uppercase tracking-label mb-3 block">
                                            <?php echo get_the_date('M j, Y'); ?>
                                        </span>
                                        <h4 class="font-display text-2xl text-bes-ivory mb-6 line-clamp-2 group-hover:text-bes-leaf transition-colors leading-snug"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        
                                        <div class="mt-auto border-t border-white/[0.04] pt-5">
                                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 font-body text-[10.5px] font-bold text-bes-leaf uppercase tracking-label group-hover:text-bes-gold transition-colors">
                                                Read Article <i class="fa-solid fa-arrow-right-long text-[10px] transition-transform group-hover:translate-x-1.5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
    // ==========================================
    // JS: REPLY FUNCTIONALITY
    // ==========================================
    function replyToComment(id, name) {
        const parentInput = document.getElementById('comment_parent');
        const formContainer = document.getElementById('bes-comment-form-container');
        const badge = document.getElementById('reply-info-badge');
        const nameSpan = document.getElementById('reply-to-name');
        const textArea = document.getElementById('comment');

        if(parentInput && formContainer) {
            parentInput.value = id;
            nameSpan.innerText = name;
            badge.classList.remove('hidden');
            formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => { textArea.focus(); }, 500);
        }
    }

    function cancelReply() {
        document.getElementById('comment_parent').value = '0';
        document.getElementById('reply-info-badge').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // ==========================================
        // 1. AMBIENT HERO ANIMATION (Breathing Effect)
        // ==========================================
        const heroTimeline = gsap.timeline({ repeat: -1, yoyo: true });
        heroTimeline
            .to(".bes-hero-img", { 
                scale: 1.05, 
                duration: 30, 
                ease: "sine.inOut" 
            }, 0);

        // ==========================================
        // 2. SMART LIKE LOGIC
        // ==========================================
        const animateValue = (obj, start, end, duration) => {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerText = Math.floor(progress * (end - start) + start).toLocaleString();
                if (progress < 1) window.requestAnimationFrame(step);
                else obj.innerText = end.toLocaleString();
            };
            window.requestAnimationFrame(step);
        }

        const likeBtn = document.getElementById('bes-like-btn');
        const likeCount = document.getElementById('bes-like-count');
        const postId = <?php echo $post_id; ?>;
        const storageKey = 'bes_liked_' + postId;

        if (localStorage.getItem(storageKey) === 'true') {
            likeBtn.classList.add('heart-active');
            likeBtn.disabled = true; 
            likeBtn.style.cursor = 'default';
        }

        likeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (localStorage.getItem(storageKey) === 'true') return;

            likeBtn.classList.add('heart-active');
            gsap.fromTo(likeBtn, {scale: 0.95}, {scale: 1.05, duration: 0.15, repeat: 3, yoyo: true});

            let currentVal = parseInt(likeCount.getAttribute('data-val')) || 0;
            let newVal = currentVal + 1;
            animateValue(likeCount, currentVal, newVal, 800);
            localStorage.setItem(storageKey, 'true');

            const formData = new FormData();
            formData.append('bes_action', 'smart_like');
            formData.append('post_id', postId);

            fetch(window.location.href, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => { if(data.success) likeCount.setAttribute('data-val', data.data.count); });
        });

        // ==========================================
        // 3. UTILS (Scroll & Swiper)
        // ==========================================
        const bar = document.getElementById('bes-progress');
        window.addEventListener('scroll', () => {
            const h = document.documentElement, st = h.scrollTop || document.body.scrollTop, sh = h.scrollHeight || document.body.scrollHeight;
            bar.style.width = (st / (sh - h.clientHeight)) * 100 + '%';
        });

        if(typeof Splide !== 'undefined') {
             // Fallback handling if splide is used globally, but here we use Swiper
        }

        new Swiper('.bes-related-swiper', {
            slidesPerView: 1.1,
            spaceBetween: 24,
            navigation: { nextEl: '.swiper-next', prevEl: '.swiper-prev' },
            breakpoints: { 
                640: { slidesPerView: 2.1, spaceBetween: 24 }, 
                1024: { slidesPerView: 3, spaceBetween: 32 } 
            }
        });
    });
    </script>

    <?php
    get_footer();
    exit;
});