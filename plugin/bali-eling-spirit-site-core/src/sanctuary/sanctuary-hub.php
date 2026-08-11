<?php
/**
 * Phase C Sanctuary hub adapter.
 * The canonical WPCodeBox baseline stays byte-identical in baseline/sanctuary-hub.php.
 * Only old three-depth IA/data is adapted; unrelated baseline chrome/interactions remain.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
require_once __DIR__ . '/baseline/sanctuary-hub.php';

function bes_site_core_sanctuary_replace_next_div( $html, $marker, $replacement ) {
    $marker_pos = strpos( $html, $marker );
    if ( false === $marker_pos ) return false;
    $start = stripos( $html, '<div', $marker_pos + strlen( $marker ) );
    if ( false === $start ) return false;
    $slice = substr( $html, $start );
    if ( ! preg_match_all( '#</?div\\b[^>]*>#i', $slice, $matches, PREG_OFFSET_CAPTURE ) ) return false;
    $depth = 0;
    foreach ( $matches[0] as $token ) {
        $markup = $token[0]; $offset = (int) $token[1];
        if ( 0 === stripos( $markup, '</' ) ) {
            --$depth;
            if ( 0 === $depth ) {
                $end = $start + $offset + strlen( $markup );
                return substr( $html, 0, $start ) . $replacement . substr( $html, $end );
            }
        } else {
            ++$depth;
        }
    }
    return false;
}

function bes_site_core_sanctuary_hub_category_grid() {
    $cards = array(
        array( 'n'=>'01', 'title'=>'Healing & Therapy', 'href'=>'/healing-therapy/', 'icon'=>'fa-solid fa-hands-holding-heart', 'tag'=>'Healing & Therapy', 'accent'=>'from-bes-leaf to-transparent', 'glow'=>'from-bes-leaf/20 to-bes-leaf/5', 'dot'=>'bg-bes-leaf' ),
        array( 'n'=>'02', 'title'=>'Retreats', 'href'=>'/eling-sanctuary-retreat/', 'icon'=>'fa-solid fa-seedling', 'tag'=>'Retreats', 'accent'=>'from-bes-gold to-transparent', 'glow'=>'from-bes-gold/20 to-bes-gold/5', 'dot'=>'bg-bes-gold' ),
        array( 'n'=>'03', 'title'=>'Tapa Brata', 'href'=>'/eling-tapa-brata/', 'icon'=>'fa-solid fa-fire-flame-curved', 'tag'=>'Program Bahasa Indonesia', 'accent'=>'from-bes-sage to-transparent', 'glow'=>'from-bes-sage/20 to-bes-sage/5', 'dot'=>'bg-bes-sage' ),
        array( 'n'=>'04', 'title'=>'Corporate Service', 'href'=>'/corporate-services/', 'icon'=>'fa-solid fa-people-group', 'tag'=>'Corporate Service', 'accent'=>'from-bes-leaf to-transparent', 'glow'=>'from-bes-leaf/20 to-bes-leaf/5', 'dot'=>'bg-bes-leaf' ),
    );
    ob_start(); ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
        <?php foreach ( $cards as $card ) : ?>
            <article class="bes-reveal group relative rounded-2xl border border-white/[.05] overflow-hidden hover:border-white/10 transition-all duration-500 flex flex-col" style="background:rgba(38,51,32,0.4)">
                <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr( $card['glow'] ); ?> opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" aria-hidden="true"></div>
                <div class="h-[3px] w-full bg-gradient-to-r <?php echo esc_attr( $card['accent'] ); ?>" aria-hidden="true"></div>
                <div class="relative p-7 md:p-8 flex flex-col flex-1 min-h-[310px]">
                    <div class="flex items-center justify-between mb-7"><div class="flex items-center gap-2.5"><span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $card['dot'] ); ?>"></span><span class="font-body font-bold text-[10px] uppercase tracking-nav text-white/30"><?php echo esc_html( $card['tag'] ); ?></span></div><span class="font-body text-[9px] font-bold uppercase tracking-label text-white/20"><?php echo esc_html( $card['n'] ); ?></span></div>
                    <div class="w-11 h-11 rounded-xl bg-white/[.04] border border-white/[.06] flex items-center justify-center mb-6"><i class="<?php echo esc_attr( $card['icon'] ); ?> text-white/50 text-sm" aria-hidden="true"></i></div>
                    <h3 class="font-display font-medium text-white text-2xl md:text-[1.75rem] leading-tight mb-7"><?php echo esc_html( $card['title'] ); ?></h3>
                    <div class="mt-auto pt-2"><a href="<?php echo esc_url( $card['href'] ); ?>" class="inline-flex items-center justify-center w-full gap-2.5 bg-white/[.04] border border-white/10 !text-white/75 font-body font-bold text-[11px] uppercase tracking-label px-6 py-3.5 rounded-xl hover:bg-bes-leaf hover:!text-bes-forest hover:border-bes-leaf transition-all duration-300 group/cta"><span>Lihat Perjalanan</span><i class="fa-solid fa-arrow-right text-[10px] group-hover/cta:translate-x-0.5 transition-transform" aria-hidden="true"></i></a></div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php return ob_get_clean();
}

function bes_site_core_render_sanctuary_hub_phase_c() {
    $baseline = bes_render_sanctuary_hub( array() );
    $target = $baseline;

    $replacements = array(
        'Sanctuary &amp; Healing Retreats &nbsp;·&nbsp; Three Depths of the Same Path &nbsp;·&nbsp; Tampaksiring, Bali' => 'Eling Sanctuary &nbsp;·&nbsp; Bali Eling Spirit &nbsp;·&nbsp; Tampaksiring, Bali',
        'The Bali Eling Spirit Sanctuary holds three distinct retreat journeys — from a single morning of healing, to an immersive weekend of reconnection, to a four-day inner excavation. Different depths. One sanctuary. One intention: to bring you home to yourself.' => 'Masuki ruang suci transformasi diri yang mendalam. Setiap perjalanan dirancang dengan penuh kesadaran untuk melepaskan hambatan energi, mengembalikan keseimbangan spiritual, dan menyelaraskan tubuh, pikiran, serta jiwa.',
        'Explore the Three Programs' => 'Explore Sanctuary',
        '3 Journeys' => '4 Categories',
        '5 Hours – 4 Days' => 'Choose Your Journey',
        'One Sanctuary.<br>Three Ways to Arrive.' => 'One Sanctuary.<br>Four Ways to Arrive.',
        'What differs between the three programs is not the philosophy &mdash; it is the depth. Some arrive with only five hours and leave lighter than they thought possible. Others need a weekend to truly exhale. A smaller number come carrying something older, something heavier, and stay for four days to meet it honestly.' => 'Setiap perjalanan memiliki bentuk yang berbeda, namun tetap berakar pada niat yang sama: menghadirkan ruang untuk kembali terhubung dengan diri, menemukan keseimbangan, dan menjalani proses dengan penuh kesadaran.',
        'Read the three summaries below, trust what resonates, and the sanctuary will meet you there.' => 'Jelajahi empat kategori Sanctuary di bawah dan pilih perjalanan yang paling sesuai dengan kebutuhan Sahabat saat ini.',
        'Three Programs.<br>Meet Yourself Where You Are.' => 'Four Sanctuary Categories.<br>Meet Yourself Where You Are.',
        'the three sanctuary programs' => 'the Sanctuary categories',
        'Whichever Depth You Choose' => 'Whichever Journey You Choose',
        'These are the threads that run through all three programs.' => 'These are the shared values that hold every Sanctuary journey.',
        'Whether you have five hours or four days, the sanctuary holds the same promise: a space where you can finally put down what you have been carrying. Choose a program, or speak with the team first &mdash; either way, you have already started.' => 'Setiap perjalanan dimulai dari niat untuk berhenti sejenak, kembali hadir, dan memilih ruang yang paling sesuai dengan kebutuhan diri. Jelajahi kategori Sanctuary atau berbicara dengan tim kami terlebih dahulu.',
        'Compare the Three Programs' => 'Explore Sanctuary',
        'Which Depth Is Calling You?' => 'Which Journey Is Calling You?',
    );
    $target = str_replace( array_keys( $replacements ), array_values( $replacements ), $target );

    $grid = bes_site_core_sanctuary_hub_category_grid();
    $next = bes_site_core_sanctuary_replace_next_div( $target, '<!-- Program cards grid -->', $grid );
    if ( false === $next ) return $baseline;
    $target = $next;

    // The old three-column comparison cannot represent the approved four-category IA; retain it inert for rollback.
    $target = str_replace( '<section class="bg-bes-cream py-20 md:py-28" aria-label="Program comparison">', '<section class="hidden bg-bes-cream py-20 md:py-28" aria-label="Program comparison" data-bes-soft-deleted="legacy-three-depth-comparison">', $target );
    // The old "shared across all three retreats" promises do not apply to Corporate Service; keep markup inert rather than inventing universal inclusions.
    $target = str_replace( '<section class="relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Shared sanctuary experience">', '<section class="hidden relative bg-bes-forest py-20 md:py-28 overflow-hidden" aria-label="Shared sanctuary experience" data-bes-soft-deleted="legacy-three-depth-shared-experience">', $target );

    // Neutralize unresolved Healing Retreat duration/schedule wherever legacy rollback markup remains in output.
    $target = str_ireplace( array( '5 Hours', '5 hours', 'five hours', '8 AM – 1 PM' ), array( 'Half-Day', 'half-day', 'a half-day', 'daily except Mondays' ), $target );
    // Old booking lead-time is not approved for the 2026 catalog.
    $target = str_ireplace( array( 'book 2 days ahead', 'At minimum 2 days ahead for the Healing Retreat' ), array( 'reservation required', 'Please confirm availability with the Sanctuary team for each journey' ), $target );

    return $target;
}

remove_shortcode( 'bes_sanctuary_hub' );
add_shortcode( 'bes_sanctuary_hub', 'bes_site_core_render_sanctuary_hub_phase_c' );
