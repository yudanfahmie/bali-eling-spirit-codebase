<?php
/**
 * ──────────────────────────────────────────────────────────────
 *  Version   : 2.1.0 (visual fallback + CTA audit)
 *  Shortcode : [bes_events]
 *  Page      : /events/
 *  Brand     : Eling Sanctuary · Bali Eling Spirit Group
 * ──────────────────────────────────────────────────────────────
 *  Real Events (from official calendar):
 *  ────────────────────────────────────
 *  MONTHLY (Recurring):
 *    · Pelukatan 7 Chakra (Purnama) — Full Moon, 10:00–13:00
 *    · Pelukatan 7 Chakra (Tilem)   — New Moon, 10:00–13:00
 *    · Eling Tapa Brata             — 4 days/3 nights, monthly
 *  WEEKLY (Free):
 *    · Yoga Reguler — Every Wednesday & Sunday, 15:00 WITA
 *  PERIODIC:
 *    · YTT 50H  (1 week), YTT 200H (1 month), YTT 300H (1 month)
 *  ────────────────────────────────────
 *  Pelukatan uses 7 types of holy water purified with special
 *  mantras, meditation energy & crystals. Led by Aji Bhagawan,
 *  Jero Ratni, and authorized Yogi. Open to all religions.
 *  ────────────────────────────────────
 *  All programs at Pasraman:
 *    Pelukatan 7 Chakra, Healing Retreat (5h), Eling Retreat
 *    (Tilem, 5h), Atma Retreat, Eling Mindfulness, Eling Sunset
 *    Yoga, Karma Retreat (5d), Punarbawa Retreat (7d), Tapa Brata
 *    (4d), YTT 50/100/200/300H, Transform by Request, Surya
 *    Namaskar, Yoga Reguler (free)
 *  ────────────────────────────────────
 *  WhatsApp  : +62 812 2888 8873
 *  Location  : Br. Umadawa, Pejeng Kangin, Tampaksiring,
 *              Gianyar, Bali
 * ──────────────────────────────────────────────────────────────
 *  BES Tailwind tokens loaded by theme — zero re-declaration.
 *  UI pattern: "Lunar calendar editorial" — moon-cycle themed
 *  recurring event cards, program constellation grid, free yoga
 *  highlight, manifesto quote. DISTINCT from ALL previous
 *  shortcodes.
 * ──────────────────────────────────────────────────────────────
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_events', 'bes_events_render' );

function bes_events_render( $atts ) {

    $a = shortcode_atts([
        'wa' => '6281228888873',
    ], $atts, 'bes_events' );

    // WhatsApp requires digits only. Sanitising here prevents malformed or unsafe shortcode values.
    $wa_number = preg_replace( '/[^0-9]/', '', (string) $a['wa'] );
    if ( empty( $wa_number ) ) {
        $wa_number = '6281228888873';
    }

    $wa_link = 'https://wa.me/' . $wa_number
             . '?text=' . rawurlencode( 'Hello, I would like to know more about upcoming events and programs at Pasraman Bali Eling Spirit.' );

    $wa_pelukatan = 'https://wa.me/' . $wa_number
             . '?text=' . rawurlencode( 'Hello, I am interested in joining the next Pelukatan 7 Chakra ceremony. Could you share the upcoming Purnama/Tilem dates?' );

    $wa_tapabrata = 'https://wa.me/' . $wa_number
             . '?text=' . rawurlencode( 'Hello, I am interested in the next Eling Tapa Brata (4-day silent retreat). Could you share upcoming dates?' );

    $wa_yoga_free = 'https://wa.me/' . $wa_number
             . '?text=' . rawurlencode( 'Hello, I would like to join the free Yoga Reguler session at Pasraman. Could you confirm the next Wednesday or Sunday class?' );

    $wa_private = 'https://wa.me/' . $wa_number
             . '?text=' . rawurlencode( 'Hello, I am interested in hosting a private retreat or group event at Pasraman Bali Eling Spirit. Could you share details?' );

    ob_start();
    ?>

    <div class="bes-events font-body text-bes-forest-deep overflow-hidden">

    <!-- Scoped visual fallbacks: these do not depend on Tailwind opacity variants being generated. -->
    <style id="bes-events-visual-fallbacks">
        .bes-events {
            --bes-events-deep: #102016;
            --bes-events-deep-hover: #1b3324;
            --bes-events-gold: #cfae45;
            --bes-events-gold-hover: #dfc364;
            --bes-events-ivory: #f7f3eb;
            --bes-events-cream: #fffaf0;
            --bes-events-focus: #f2cf65;
        }

        .bes-events a { text-decoration: none; }
        .bes-events #sacred-calendar,
        .bes-events #all-programs { scroll-margin-top: 96px; }

        /* Reliable overlays when slash-opacity Tailwind utilities are purged or unavailable. */
        .bes-events .bes-hero-overlay {
            background:
                linear-gradient(180deg, rgba(16,32,22,.70) 0%, rgba(16,32,22,.32) 44%, rgba(16,32,22,.96) 100%),
                radial-gradient(circle at 50% 44%, rgba(0,0,0,.04) 0%, rgba(0,0,0,.38) 100%);
        }
        .bes-events .bes-final-overlay {
            background:
                linear-gradient(180deg, rgba(10,24,16,.68) 0%, rgba(10,24,16,.78) 42%, rgba(10,24,16,.97) 100%),
                radial-gradient(circle at 50% 38%, rgba(10,24,16,.28) 0%, rgba(10,24,16,.76) 78%);
        }
        .bes-events .bes-final-copy,
        .bes-events .bes-final-copy h2,
        .bes-events .bes-final-copy p {
            color: var(--bes-events-cream) !important;
            text-shadow: 0 2px 18px rgba(0,0,0,.55);
        }
        .bes-events .bes-final-copy .bes-muted-copy {
            color: rgba(255,250,240,.68) !important;
        }

        /* CTA system: explicit foreground/background prevents invisible labels. */
        .bes-events .bes-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            min-height: 46px;
            border: 1px solid transparent;
            border-radius: .3rem;
            padding: .85rem 1.75rem;
            font: inherit;
            font-size: .78rem;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: .12em;
            text-transform: uppercase;
            cursor: pointer;
            opacity: 1 !important;
            visibility: visible !important;
            transition: background-color .25s ease, border-color .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
            -webkit-tap-highlight-color: transparent;
        }
        .bes-events .bes-btn svg {
            color: currentColor !important;
            stroke: currentColor;
            flex: 0 0 auto;
        }
        .bes-events .bes-btn--gold {
            background: var(--bes-events-gold) !important;
            border-color: var(--bes-events-gold) !important;
            color: var(--bes-events-deep) !important;
        }
        .bes-events .bes-btn--gold:hover {
            background: var(--bes-events-gold-hover) !important;
            border-color: var(--bes-events-gold-hover) !important;
            color: var(--bes-events-deep) !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(0,0,0,.20);
        }
        .bes-events .bes-btn--dark {
            background: var(--bes-events-deep) !important;
            border-color: var(--bes-events-deep) !important;
            color: var(--bes-events-ivory) !important;
        }
        .bes-events .bes-btn--dark:hover {
            background: var(--bes-events-deep-hover) !important;
            border-color: var(--bes-events-deep-hover) !important;
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(16,32,22,.22);
        }
        .bes-events .bes-btn--outline-light {
            background: rgba(10,24,16,.28) !important;
            border-color: rgba(255,250,240,.55) !important;
            color: #fffaf0 !important;
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
        }
        .bes-events .bes-btn--outline-light:hover {
            background: rgba(255,250,240,.12) !important;
            border-color: rgba(255,250,240,.90) !important;
            color: #fff !important;
            transform: translateY(-1px);
        }
        .bes-events .bes-btn:focus-visible,
        .bes-events a:focus-visible {
            outline: 3px solid var(--bes-events-focus);
            outline-offset: 3px;
        }
        .bes-events .bes-btn[aria-disabled="true"] {
            pointer-events: none;
            opacity: .55 !important;
        }

        @media (max-width: 639px) {
            .bes-events .bes-btn { width: 100%; padding-inline: 1.25rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .bes-events *, .bes-events *::before, .bes-events *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
            .bes-events .reveal-item {
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
    <noscript><style>.bes-events .reveal-item{opacity:1!important;transform:none!important}</style></noscript>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  1 · HERO — DARK CINEMATIC WITH MOON PHASE MOTIF          ║
         ║  Distinct: Centered text with lunar cycle iconography      ║
         ║  above the headline. Not split-screen, not grid.           ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden bg-bes-forest-deep">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1528495612343-9ca9f4a4de28?w=1920&h=1080&q=80&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1400&q=70&auto=format&fit=crop';"
                 alt="Sacred ceremony gathering with candles and offerings at Pasraman Bali Eling Spirit at twilight"
                 class="w-full h-full object-cover opacity-35" loading="eager" />
            <div class="bes-hero-overlay absolute inset-0"></div>
        </div>

        <div class="relative z-10 text-center px-6 md:px-10 py-24 max-w-3xl mx-auto">

            <!-- Moon phase icons -->
            <div class="reveal-item opacity-0 scale-90 transition-all duration-700 ease-out flex items-center justify-center gap-3 mb-8">
                <span class="!text-bes-gold/40 text-2xl">&#9790;</span>
                <span class="!text-bes-gold/50 text-2xl">&#9789;</span>
                <span class="!text-bes-gold text-3xl">&#9790;</span>
                <span class="!text-bes-gold/50 text-2xl">&#9789;</span>
                <span class="!text-bes-gold/40 text-2xl">&#9790;</span>
            </div>

            <div class="reveal-item opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <p class="font-body !text-bes-gold text-xs tracking-nav uppercase mb-5">
                    Pasraman Bali Eling Spirit &mdash; Sacred Calendar
                </p>
                <h1 class="font-display font-light text-[2.8rem] md:text-[4rem] lg:text-[5rem] text-bes-parchment tracking-display leading-[1.05] mb-6">
                    Events &amp;<br>Sacred Gatherings
                </h1>
                <p class="text-base md:text-lg text-bes-cream/80 leading-relaxed max-w-xl mx-auto mb-10">
                    Our calendar follows the ancient rhythm of the moon. Every Purnama (Full Moon) and
                    Tilem (New Moon), the Pasraman opens its gates for sacred Pelukatan ceremonies,
                    transformational retreats, and community practice. Your seat in the circle is waiting.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#sacred-calendar"
                       class="bes-btn bes-btn--gold" aria-label="Jump to the sacred calendar section">
                        View Sacred Calendar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                    <a href="#all-programs"
                       class="bes-btn bes-btn--outline-light" aria-label="Jump to all Pasraman programs">
                        All Programs
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  2 · JERO RATNI MANIFESTO QUOTE — FULL-WIDTH BAND         ║
         ║  Distinct: Not a section with header. A single impactful   ║
         ║  quote on a warm background. Unique element.               ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-gold/10 py-14 md:py-20">
        <div class="max-w-3xl mx-auto px-6 md:px-10 text-center">
            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-1000 ease-out">
                <svg class="w-8 h-8 !text-bes-gold/40 mx-auto mb-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="font-display text-xl md:text-2xl text-bes-forest-deep tracking-display leading-[1.45] mb-4">
                    All the dreams and aspirations that have been your purpose &mdash; the universe has already
                    prepared them. You have only one task to carry out consistently:
                    <span class="!text-bes-gold italic">make yourself worthy of receiving them.</span>
                </p>
                <p class="text-xs text-bes-bark-muted tracking-wider uppercase">&mdash; Jero Ratni, Co-Founder</p>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  3 · THE SACRED CALENDAR — RECURRING LUNAR EVENTS          ║
         ║  Distinct: Three large event "poster" cards in a row.      ║
         ║  Each represents a recurring monthly event with moon        ║
         ║  phase icon. NOT horizontal event cards with image left.    ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section id="sacred-calendar" class="bg-bes-ivory py-24 md:py-36">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-16">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Lunar Rhythm</p>
                <h2 class="font-display text-3xl md:text-[2.6rem] text-bes-forest-deep tracking-display leading-snug mb-3">
                    Monthly Sacred Events
                </h2>
                <p class="text-base text-bes-bark leading-relaxed max-w-2xl mx-auto">
                    These ceremonies recur every month, following the ancient Balinese lunar calendar.
                    The Pasraman opens for Pelukatan on every Full Moon and New Moon, and
                    Tapa Brata runs once each monthly cycle.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <!-- Pelukatan Purnama -->
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out group">
                    <div class="bg-bes-forest-deep rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
                        <div class="relative h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1590001155093-a3c66ab0c3ff?w=600&h=400&q=80&auto=format&fit=crop&crop=center"
                                 onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/30');"
                                 alt="Holy water purification ceremony under full moonlight at the Pasraman sacred spring"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-70" loading="lazy" />
                            <div class="absolute top-4 left-4 flex items-center gap-2">
                                <span class="!text-bes-gold text-xl">&#9789;</span>
                                <span class="text-[10px] !text-bes-gold tracking-label uppercase font-semibold">Full Moon</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block bg-bes-gold/15 !text-bes-gold text-[10px] font-semibold tracking-label uppercase px-3 py-1 rounded-full mb-3">Every Purnama</span>
                            <h3 class="font-display text-xl text-bes-parchment tracking-display leading-snug mb-2">Pelukatan 7 Chakra</h3>
                            <p class="text-xs text-bes-cream/60 mb-1">10:00 AM &ndash; 1:00 PM &middot; 3 Hours</p>
                            <p class="text-sm text-bes-cream/70 leading-[1.75] mb-5">
                                Sacred self-cleansing ceremony using seven types of holy water purified with
                                special mantras, meditation energy, and crystals. Led directly by Aji Bhagawan,
                                Jero Ratni, and authorised Yogi. Begins with meditation and an explanation of the
                                seven chakra meridians &mdash; from the base of the spine to the crown.
                            </p>
                            <a href="<?php echo esc_url( $wa_pelukatan ); ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 !text-bes-gold text-xs font-semibold tracking-label uppercase hover:underline">
                                Reserve Your Spot
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pelukatan Tilem -->
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out group" style="transition-delay:100ms;">
                    <div class="bg-bes-forest-deep rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
                        <div class="relative h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400&q=80&auto=format&fit=crop&crop=center"
                                 onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/30');"
                                 alt="Meditative candlelit ceremony during Tilem new moon at the Pasraman"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-70" loading="lazy" />
                            <div class="absolute top-4 left-4 flex items-center gap-2">
                                <span class="text-bes-cream/60 text-xl">&#9790;</span>
                                <span class="text-[10px] text-bes-cream/60 tracking-label uppercase font-semibold">New Moon</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block bg-bes-cream/10 text-bes-cream/70 text-[10px] font-semibold tracking-label uppercase px-3 py-1 rounded-full mb-3">Every Tilem</span>
                            <h3 class="font-display text-xl text-bes-parchment tracking-display leading-snug mb-2">Pelukatan 7 Chakra</h3>
                            <p class="text-xs text-bes-cream/60 mb-1">10:00 AM &ndash; 1:00 PM &middot; 3 Hours</p>
                            <p class="text-sm text-bes-cream/70 leading-[1.75] mb-5">
                                The same sacred Pelukatan ceremony, attuned to the Tilem (New Moon) energy &mdash;
                                a time of introspection, release, and letting go. The dark moon amplifies the
                                power of clearing stagnant energy and negative karmic patterns from the subtle body,
                                creating space for renewal.
                            </p>
                            <a href="<?php echo esc_url( $wa_pelukatan ); ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 !text-bes-gold text-xs font-semibold tracking-label uppercase hover:underline">
                                Reserve Your Spot
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tapa Brata -->
                <div class="reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out group" style="transition-delay:200ms;">
                    <div class="bg-bes-forest-deep rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
                        <div class="relative h-52 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=600&h=400&q=80&auto=format&fit=crop&crop=center"
                                 onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/30');"
                                 alt="Deep forest meditation setting representing the sacred silence of Tapa Brata retreat"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-70" loading="lazy" />
                            <div class="absolute top-4 left-4 flex items-center gap-2">
                                <svg class="w-5 h-5 !text-bes-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                                <span class="text-[10px] !text-bes-gold tracking-label uppercase font-semibold">Monthly Cycle</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block bg-bes-gold/15 !text-bes-gold text-[10px] font-semibold tracking-label uppercase px-3 py-1 rounded-full mb-3">Every Month &middot; 4 Days</span>
                            <h3 class="font-display text-xl text-bes-parchment tracking-display leading-snug mb-2">Eling Tapa Brata</h3>
                            <p class="text-xs text-bes-cream/60 mb-1">4 Days / 3 Nights &middot; Noble Silence Retreat</p>
                            <p class="text-sm text-bes-cream/70 leading-[1.75] mb-5">
                                The immersive silent retreat. Complete digital detox, 7-chakra purification,
                                guided meditation three times daily, emotional and digestive detox, inner child
                                healing, sacred site meditation, and personal spiritual counseling. 97% documented
                                participant success rate.
                            </p>
                            <a href="<?php echo esc_url( $wa_tapabrata ); ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 !text-bes-gold text-xs font-semibold tracking-label uppercase hover:underline">
                                Join Next Intake
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Practical note -->
            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out mt-8 bg-bes-gold/5 border border-bes-gold/15 rounded-lg p-5 flex flex-col md:flex-row gap-4 items-start md:items-center">
                <svg class="w-6 h-6 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <div>
                    <p class="text-sm text-bes-forest-deep font-semibold mb-1">For Pelukatan: What to Bring</p>
                    <p class="text-xs text-bes-bark leading-relaxed">Two sets of clothing, traditional Balinese costume (kebaya/udeng available for loan), a bag for wet clothes, and a towel. All ceremonies are open to participants of all religions and backgrounds. The foundation is yoga, meditation, and universal spiritual awareness.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  4 · FREE COMMUNITY YOGA — HIGHLIGHT BAND                 ║
         ║  Distinct: A warm highlight section for the free           ║
         ║  program. Unique — no other shortcode has this.            ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-forest-deep py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out grid md:grid-cols-12 gap-8 items-center">

                <div class="md:col-span-7">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-block bg-green-500/20 text-green-300 text-[10px] font-bold tracking-label uppercase px-3 py-1 rounded-full">Free &middot; No Charge</span>
                        <span class="text-xs text-bes-cream/40">Donation-based / Punia</span>
                    </div>
                    <h2 class="font-display text-2xl md:text-3xl text-bes-parchment tracking-display leading-snug mb-3">
                        Yoga Reguler &mdash; Open to Everyone
                    </h2>
                    <p class="text-sm text-bes-cream/70 leading-[1.8] mb-4">
                        Every <strong class="text-bes-cream">Wednesday</strong> and <strong class="text-bes-cream">Sunday</strong>
                        at <strong class="text-bes-cream">3:00 PM WITA</strong>, the Pasraman opens its shala for free
                        community yoga guided by certified master yogis with years of experience. No registration required.
                        No experience required. Everyone is welcome. Simply come as you are.
                    </p>
                    <a href="<?php echo esc_url( $wa_yoga_free ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 !text-bes-gold text-xs font-semibold tracking-label uppercase hover:underline">
                        Confirm Attendance
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="md:col-span-5 flex justify-center md:justify-end">
                    <div class="grid grid-cols-2 gap-3 text-center">
                        <div class="bg-bes-cream/5 border border-bes-cream/10 rounded-lg px-6 py-5">
                            <p class="font-display text-3xl !text-bes-gold leading-none">Wed</p>
                            <p class="text-[10px] text-bes-cream/50 tracking-label uppercase mt-1">3:00 PM</p>
                        </div>
                        <div class="bg-bes-cream/5 border border-bes-cream/10 rounded-lg px-6 py-5">
                            <p class="font-display text-3xl !text-bes-gold leading-none">Sun</p>
                            <p class="text-[10px] text-bes-cream/50 tracking-label uppercase mt-1">3:00 PM</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  5 · UPCOMING SCHEDULE — CLEAN EVENT LIST                  ║
         ║  Distinct: Compact date-aligned rows, not poster cards.    ║
         ║  A real calendar listing with exact dates from the site.   ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-24 md:py-32">
        <div class="max-w-4xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">Upcoming Schedule</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-3">
                    What&rsquo;s Next
                </h2>
                <p class="text-sm text-bes-bark max-w-lg">
                    Exact dates follow the Balinese lunar calendar and may shift slightly each cycle.
                    Contact us via WhatsApp to confirm current dates.
                </p>
            </div>

            <div class="space-y-0">
                <?php
                $upcoming = [
                    ['date'=>'Mar 3','type'=>'Pelukatan 7 Chakra','sub'=>'Purnama (Full Moon)','time'=>'10:00 AM – 1:00 PM','cat'=>'Ceremony','catbg'=>'bg-bes-gold/10 !text-bes-gold'],
                    ['date'=>'Mar 12–15','type'=>'Eling Tapa Brata','sub'=>'4-Day Silent Retreat','time'=>'4 Days / 3 Nights','cat'=>'Retreat','catbg'=>'bg-bes-forest/10 text-bes-forest'],
                    ['date'=>'Mar 18','type'=>'Pelukatan 7 Chakra','sub'=>'Tilem (New Moon)','time'=>'10:00 AM – 1:00 PM','cat'=>'Ceremony','catbg'=>'bg-bes-gold/10 !text-bes-gold'],
                    ['date'=>'Mar 22 – Apr 15','type'=>'200-Hour Yoga Teacher Training','sub'=>'English Language Intake','time'=>'1 Month Residential','cat'=>'YTT','catbg'=>'bg-bes-olive/10 text-bes-olive'],
                    ['date'=>'Apr 2','type'=>'Pelukatan 7 Chakra','sub'=>'Purnama (Full Moon)','time'=>'10:00 AM – 1:00 PM','cat'=>'Ceremony','catbg'=>'bg-bes-gold/10 !text-bes-gold'],
                    ['date'=>'Apr 9–12','type'=>'Eling Tapa Brata','sub'=>'4-Day Silent Retreat','time'=>'4 Days / 3 Nights','cat'=>'Retreat','catbg'=>'bg-bes-forest/10 text-bes-forest'],
                    ['date'=>'Apr 17','type'=>'Pelukatan 7 Chakra','sub'=>'Tilem (New Moon)','time'=>'10:00 AM – 1:00 PM','cat'=>'Ceremony','catbg'=>'bg-bes-gold/10 !text-bes-gold'],
                ];
                foreach ( $upcoming as $idx => $ev ) : ?>
                <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out grid grid-cols-12 gap-3 md:gap-5 py-5 border-b border-bes-bark-muted/15 items-center" style="transition-delay:<?php echo $idx * 40; ?>ms;">
                    <div class="col-span-3 sm:col-span-2">
                        <p class="font-display text-sm md:text-base text-bes-forest-deep leading-tight"><?php echo $ev['date']; ?></p>
                    </div>
                    <div class="col-span-6 sm:col-span-7">
                        <p class="text-sm md:text-base text-bes-forest-deep font-semibold leading-snug"><?php echo $ev['type']; ?></p>
                        <p class="text-xs text-bes-bark mt-0.5"><?php echo $ev['sub']; ?> &middot; <?php echo $ev['time']; ?></p>
                    </div>
                    <div class="col-span-3 text-right">
                        <span class="inline-block <?php echo $ev['catbg']; ?> text-[9px] font-semibold tracking-label uppercase px-2.5 py-1 rounded-full"><?php echo $ev['cat']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out mt-8 text-center">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="bes-btn bes-btn--dark" aria-label="Confirm an event date through WhatsApp">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Confirm Any Date via WhatsApp
                </a>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  6 · ALL PROGRAMS — CONSTELLATION GRID                     ║
         ║  Distinct: Full program universe as a compact grid of      ║
         ║  mini-cards. NOT used in any other shortcode. This is      ║
         ║  the master index of everything the Pasraman offers.       ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section id="all-programs" class="bg-bes-cream py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-center mb-14">
                <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-2">The Complete Universe</p>
                <h2 class="font-display text-3xl md:text-4xl text-bes-forest-deep tracking-display mb-3">
                    All Programs at the Pasraman
                </h2>
                <p class="text-sm text-bes-bark max-w-xl mx-auto">
                    From a single afternoon to a full month of residential training. Every
                    programme is guided by master faculty and held at the Pasraman.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                $programs = [
                    ['title'=>'Pelukatan 7 Chakra','dur'=>'3 hours','freq'=>'Every Purnama &amp; Tilem','link'=>'/pelukatan-7-chakra/','desc'=>'Sacred water purification with mantras, crystals, and meditation energy. 7 chakra meridian alignment.'],
                    ['title'=>'Healing Retreat','dur'=>'5 hours','freq'=>'By request','link'=>'/healing-retreat/','desc'=>'Half-day to relieve fatigue, balance energy, and restore connection with your true self.'],
                    ['title'=>'Eling Retreat','dur'=>'5 hours','freq'=>'Every Tilem','link'=>'/eling-retreat/','desc'=>'A 5-hour programme held during the new moon to release negative energy toward harmony and balance.'],
                    ['title'=>'Eling Tapa Brata','dur'=>'4 days / 3 nights','freq'=>'Monthly','link'=>'/eling-tapa-brata/','desc'=>'Immersive silent retreat: digital detox, inner child healing, chakra activation, guided meditation, Punarbawa.'],
                    ['title'=>'Karma Retreat','dur'=>'5 days / 4 nights','freq'=>'By request','link'=>'/karma-retreat/','desc'=>'Release burdens, find meaning, achieve healing and sincerity through extended spiritual immersion.'],
                    ['title'=>'Punarbawa Retreat','dur'=>'7 days / 6 nights','freq'=>'By request','link'=>'/punarbawa-retreat/','desc'=>'The deepest transformation programme: spiritual rebirth through yoga, healing, and extended self-introspection.'],
                    ['title'=>'YTT 50 Hour','dur'=>'1 week','freq'=>'Periodic','link'=>'/yoga-teacher-training/','desc'=>'First Parwa of the 200-hour curriculum: Surya Namaskar, Asanas, Pranayama, Subtle Body, Meditation, Yoga Nidra.'],
                    ['title'=>'YTT 200 Hour','dur'=>'1 month','freq'=>'Periodic','link'=>'/200-hour-yoga-teacher-training/','desc'=>'Complete foundational certification: 22 subjects, 4 Parwas, Yoga Alliance accredited. RYT-200 eligible.'],
                    ['title'=>'YTT 300 Hour','dur'=>'1 month','freq'=>'By request','link'=>'/300-hour-yoga-teacher-training/','desc'=>'Advanced mastery: yoga therapy, subtle body, sacred texts, Balinese healing, master practicum. RYT-500 eligible.'],
                    ['title'=>'Eling Mindfulness','dur'=>'Afternoon session','freq'=>'By request','link'=>'/programs/','desc'=>'Afternoon meditation at the Pasraman for achieving peace, reducing stress, and welcoming your inner self.'],
                    ['title'=>'Eling Sunset Yoga','dur'=>'Afternoon session','freq'=>'By request','link'=>'/programs/','desc'=>'Yoga in the late afternoon to improve health, relax the mind, and feel the beauty of the Balinese sunset.'],
                    ['title'=>'Transform by Request','dur'=>'Custom duration','freq'=>'Individual','link'=>'/programs/','desc'=>'Individual transformation programme tailored to your specific needs. Positive change across all aspects of life.'],
                ];
                foreach ( $programs as $idx => $pr ) :
                    $delay = min($idx * 50, 350);
                ?>
                <a href="<?php echo esc_url( $pr['link'] ); ?>"
                   class="reveal-item opacity-0 translate-y-4 transition-all duration-500 ease-out block bg-white rounded-lg p-5 border border-bes-parchment hover:shadow-lg hover:border-bes-gold/30 hover:-translate-y-0.5 transition-all group" style="transition-delay:<?php echo $delay; ?>ms;">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <h4 class="font-display text-sm text-bes-forest-deep leading-snug group-hover:!text-bes-gold transition-colors"><?php echo $pr['title']; ?></h4>
                        <svg class="w-4 h-4 text-bes-bark-muted shrink-0 mt-0.5 group-hover:!text-bes-gold transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                    </div>
                    <p class="text-[10px] text-bes-olive tracking-label uppercase mb-2"><?php echo $pr['dur']; ?> &middot; <?php echo $pr['freq']; ?></p>
                    <p class="text-xs text-bes-bark leading-[1.7]"><?php echo $pr['desc']; ?></p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  7 · HOST YOUR OWN — SPLIT WITH IMAGE                     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <div class="reveal-item opacity-0 scale-95 transition-all duration-1000 ease-out rounded-xl overflow-hidden shadow-xl group order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=750&h=550&q=80&auto=format&fit=crop&crop=center"
                         onerror="this.style.display='none';this.parentElement.classList.add('bg-bes-sage/20','min-h-[350px]');"
                         alt="Group of retreat participants in the open-air yoga shala at Pasraman Bali Eling Spirit"
                         class="w-full h-[350px] md:h-[450px] object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy" />
                </div>

                <div class="reveal-item opacity-0 translate-x-8 transition-all duration-1000 ease-out order-1 lg:order-2">
                    <p class="font-body text-bes-olive text-xs tracking-nav uppercase mb-3">For Facilitators &amp; Groups</p>
                    <h2 class="font-display text-3xl md:text-[2.4rem] text-bes-forest-deep tracking-display leading-snug mb-5">
                        Host Your Own<br>Retreat or Ceremony
                    </h2>
                    <p class="text-base text-bes-bark leading-[1.85] mb-5">
                        Are you a facilitator, wellness brand, or community leader looking for a deeply supportive,
                        energetically charged space to host your group? The Pasraman is available for private bookings &mdash;
                        a sanctuary of profound peace in the sacred Tampaksiring region, just minutes from central Ubud.
                    </p>
                    <p class="text-base text-bes-bark leading-[1.85] mb-8">
                        We customise every group experience with bespoke offerings: private Melukat ceremonies,
                        sound healing sessions, traditional Balinese healing rituals, vegetarian catering from our kitchen,
                        and integration of our master faculty into your programme design.
                    </p>

                    <div class="space-y-3 mb-8">
                        <?php
                        $hosting = [
                            'Open-air bamboo shala (accommodates up to 25 mats)',
                            'Custom high-vibrational vegetarian catering',
                            'Integration of Aji Bhagawan, Jero Ratni, or senior yogis',
                            'Private Melukat, sound healing &amp; Agni Hotra ceremonies',
                            'Accommodation &amp; full residential support available',
                        ];
                        foreach ( $hosting as $h ) : ?>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 !text-bes-gold shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-bes-bark"><?php echo $h; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?php echo esc_url( $wa_private ); ?>" target="_blank" rel="noopener noreferrer"
                       class="bes-btn bes-btn--dark" aria-label="Ask about hosting a private retreat through WhatsApp">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        Inquire About Hosting
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  8 · PRACTICAL INFO — COMPACT STRIP                       ║
         ║  Distinct: Horizontal info badges. Not FAQ, not cards.     ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-parchment py-12 md:py-16 border-t border-bes-bark-muted/10">
        <div class="max-w-5xl mx-auto px-6 md:px-10">
            <div class="reveal-item opacity-0 translate-y-4 transition-all duration-700 ease-out grid sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                <?php
                $info = [
                    ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z','label'=>'Location','value'=>'Br. Umadawa, Pejeng Kangin, Gianyar, Bali'],
                    ['icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z','label'=>'Contact','value'=>'+62 812 2888 8873'],
                    ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z','label'=>'Open Hours','value'=>'09:00 – 20:00 WITA Daily'],
                    ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','label'=>'Email','value'=>'pasramanbalielingspirit@gmail.com'],
                ];
                foreach ( $info as $i ) : ?>
                <div class="flex flex-col items-center">
                    <svg class="w-5 h-5 !text-bes-gold mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo $i['icon']; ?>"/></svg>
                    <p class="text-[10px] text-bes-olive tracking-label uppercase mb-1"><?php echo $i['label']; ?></p>
                    <p class="text-xs text-bes-bark leading-snug"><?php echo $i['value']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  9 · SOCIAL PROOF + FOLLOW CTA                            ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="bg-bes-ivory py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-6 md:px-10">
            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="font-display text-2xl text-bes-forest-deep tracking-display mb-3">Stay Connected</h3>
                    <p class="text-sm text-bes-bark leading-relaxed mb-5">
                        Pop-up events, community gatherings, and special ceremonies are announced first on our
                        social channels. Follow us to stay in the loop and never miss a sacred gathering.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://instagram.com/bali.elingspirit" target="_blank" rel="noopener noreferrer" aria-label="Open Bali Eling Spirit on Instagram"
                           class="bes-btn bes-btn--dark">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            Instagram
                        </a>
                        <a href="https://youtube.com/@PasramanBaliElingSpirit" target="_blank" rel="noopener noreferrer" aria-label="Open Pasraman Bali Eling Spirit on YouTube"
                           class="bes-btn bes-btn--dark">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                        <a href="https://www.tiktok.com/@pasramanbalielingspirit" target="_blank" rel="noopener noreferrer" aria-label="Open Pasraman Bali Eling Spirit on TikTok"
                           class="bes-btn bes-btn--dark">
                            TikTok
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 border border-bes-parchment shadow-sm">
                    <p class="text-sm text-bes-bark leading-[1.8] mb-3">
                        &ldquo;An extraordinary experience to be at the Pasraman. The journey was wonderful, the
                        fellow participants were so kind and supportive, and Aji and Bu Jro along with the yogi
                        team were warm and full of compassion.&rdquo;
                    </p>
                    <p class="font-display text-sm text-bes-forest-deep">Ergulina Mahadiarta</p>
                    <p class="text-[10px] text-bes-bark-muted tracking-wider uppercase">Pasraman Participant</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ╔══════════════════════════════════════════════════════════╗
         ║  10 · FINAL CTA — CINEMATIC CLOSE                        ║
         ╚══════════════════════════════════════════════════════════╝ -->
    <section class="relative py-28 md:py-40 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1515377543232-a279fa2641f6?w=1920&h=900&q=75&auto=format&fit=crop&crop=center"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1400&q=70&auto=format&fit=crop';"
                 alt="Full moon rising over the Pasraman temple grounds with ceremonial lights"
                 class="w-full h-full object-cover" loading="lazy" />
            <div class="bes-final-overlay absolute inset-0"></div>
        </div>

        <div class="bes-final-copy relative z-10 text-center max-w-3xl mx-auto px-6 md:px-10">
            <!-- Moon phase -->
            <div class="reveal-item opacity-0 scale-90 transition-all duration-700 ease-out flex items-center justify-center gap-2 mb-6">
                <span class="!text-bes-gold/30 text-lg">&#9790;</span>
                <span class="!text-bes-gold/50 text-xl">&#9789;</span>
                <span class="!text-bes-gold text-2xl">&#9790;</span>
                <span class="!text-bes-gold/50 text-xl">&#9789;</span>
                <span class="!text-bes-gold/30 text-lg">&#9790;</span>
            </div>

            <h2 class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out font-display text-3xl md:text-[3.5rem] text-bes-parchment tracking-display leading-[1.1] mb-5" style="transition-delay:100ms;">
                Join the Circle.<br>
                The Moon Is Calling.
            </h2>
            <p class="bes-muted-copy reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out text-base md:text-lg leading-relaxed mb-10 max-w-xl mx-auto" style="transition-delay:200ms;">
                Whether for a single sacred afternoon or a month of immersive transformation,
                your place at the Pasraman is waiting. Step into a space where every gathering
                is held with reverence.
            </p>

            <div class="reveal-item opacity-0 translate-y-6 transition-all duration-700 ease-out flex flex-col sm:flex-row gap-4 justify-center" style="transition-delay:300ms;">
                <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer"
                   class="bes-btn bes-btn--gold" aria-label="Contact Pasraman Bali Eling Spirit through WhatsApp">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    Contact the Pasraman
                </a>
                <a href="/programs/"
                   class="bes-btn bes-btn--outline-light" aria-label="Explore all Pasraman programs">
                    Explore All Programs
                </a>
            </div>
            <p class="bes-muted-copy reveal-item opacity-0 transition-opacity duration-700 text-xs mt-6" style="transition-delay:400ms;">
                Open daily 09:00 – 20:00 &middot; Br. Umadawa, Pejeng Kangin, Gianyar, Bali &middot; +62 812 2888 8873
            </p>
        </div>
    </section>


    </div><!-- /.bes-events -->


    <!-- ─── JS: scroll reveal (vanilla, no deps) ─── -->
    <script>
    (function() {
        function revealNow(el) {
            el.classList.remove(
                'opacity-0','translate-y-8','translate-y-6','translate-y-4',
                'translate-x-12','-translate-x-12','translate-x-8','-translate-x-8',
                'translate-x-6','-translate-x-6','scale-95','scale-90'
            );
            el.classList.add('opacity-100','translate-y-0','translate-x-0','scale-100');
        }

        function initBesEvents() {
            var root = document.querySelector('.bes-events');
            if (!root) return;

            var revealItems = root.querySelectorAll('.reveal-item');
            if (!('IntersectionObserver' in window)) {
                revealItems.forEach(revealNow);
            } else {
                var io = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            revealNow(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
                revealItems.forEach(function(el) { io.observe(el); });
            }

            root.querySelectorAll('a[href^="#"]').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    var target = root.querySelector(link.getAttribute('href'));
                    if (!target) return;
                    event.preventDefault();
                    target.scrollIntoView({
                        behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
                        block: 'start'
                    });
                    if (history.replaceState) history.replaceState(null, '', link.getAttribute('href'));
                });
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initBesEvents, { once: true });
        } else {
            initBesEvents();
        }
    })();
    </script>

    <?php
    return ob_get_clean();
}