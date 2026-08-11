<?php
/**
 * ============================================================================
 * BALI ELING SPIRIT — The Wisdom Archive (FAQ Section)
 * ============================================================================
 * Shortcode: [bes_faqs]
 * Design System: v3 Premium Overhaul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'bes_faqs', 'bes_render_faqs_section' );

function bes_render_faqs_section() {
    // 26 Real FAQs deeply researched from Bali Eling Spirit Programs
    $all_faqs = [
        // --- GENERAL & ACCOMMODATION ---
        ['q' => 'What is Pasraman Bali Eling Spirit?', 'a' => 'We are a spiritual sanctuary in Bali focused on holistic transformation through yoga, meditation, life mastery, and Sanatana Dharma teachings to help you discover your True Self.'],
        ['q' => 'Where are you located?', 'a' => 'We are located at Br. Umadawa Pejeng Kangin, Gianyar, Bali. A serene and sacred environment perfectly situated for deep spiritual healing.'],
        ['q' => 'Are your programs open to everyone?', 'a' => 'Yes, all programs at Pasraman are open to participants of all backgrounds and religions. Our teachings are universally based on yoga, meditation, and spiritual mastery.'],
        ['q' => 'What should I wear when visiting?', 'a' => 'We highly recommend casual, modest, and comfortable clothing (such as yoga attire) that respects our sacred spiritual environment.'],
        ['q' => 'Do I need to make a reservation before coming?', 'a' => 'Yes, to ensure our master healers and priests are available, all retreats and programs require an advance reservation of at least 1 day (H-1).'],
        ['q' => 'Can I stay overnight at the Pasraman?', 'a' => 'Accommodation is exclusively provided for participants of our intensive overnight programs like Tapa Brata and Atma Retreat. We do not offer public daily accommodation.'],
        ['q' => 'Is the food provided vegetarian?', 'a' => 'Yes, all meals provided during our retreats are highly nutritious, sattvic, and plant-based (vegetarian) to support your body\'s physical and energetic purification.'],
        
        // --- DAILY RETREATS (HEALING, SURYA NAMASKAR) ---
        ['q' => 'What is the Healing Retreat?', 'a' => 'A 5-hour daily retreat running from 8 AM to 1 PM, designed to relieve fatigue, clear energy imbalances, and restore a connection with your true self through yoga, sound healing, and a sacred Melukat.'],
        ['q' => 'Is the Healing Retreat a private session?', 'a' => 'No, the standard Healing Retreat is a shared group experience. You will join and share positive vibrations with other participants who booked on the same day.'],
        ['q' => 'What is the Surya Namaskar Retreat?', 'a' => 'A 3-hour daily retreat designed for busy individuals. It includes karma alignment meditation, Bali Hatha Yoga, Pranayama, and Sound Healing, but does not include the Melukat water purification.'],
        ['q' => 'What happens in a Sacred Sound Healing session?', 'a' => 'We utilize antique Tibetan singing bowls and sacred Balinese mantras. The frequencies help dissolve energetic blockages, release trauma, and harmonize your cellular vibration.'],
        ['q' => 'Do I need prior yoga or meditation experience?', 'a' => 'Not at all. Our programs are lovingly guided by experienced instructors who will support you exactly where you are on your spiritual journey.'],
        ['q' => 'Can I request a specific instructor or Yogi?', 'a' => 'Yes, you can request a specific instructor for your session, provided our Pasraman schedule permits on your chosen date.'],

        // --- INTENSIVE RETREATS (TAPA BRATA, ATMA) ---
        ['q' => 'What is Tapa Brata?', 'a' => 'A profound 4-day, 3-night intensive retreat designed to heal deep inner wounds, release trauma, and naturally activate your Chakras and Kundalini Energy.'],
        ['q' => 'Why do I need to stay overnight for Tapa Brata?', 'a' => 'Staying at the Pasraman protects your body, mind, and soul from external negative distractions, allowing you to focus entirely on your spiritual asceticism in a high-vibration environment.'],
        ['q' => 'What is the Atma Retreat?', 'a' => 'Atma Retreat is a highly personalized, private alternative to Tapa Brata for those who need flexibility or cannot join the regular schedule. It offers a 3-day deep spiritual healing experience.'],
        ['q' => 'Will I definitely be healed after taking Tapa Brata?', 'a' => 'Our Tapa Brata and Atma Retreats boast a 97% success rate in significantly accelerating physical and emotional healing, problem-solving, and expanding spiritual awareness.'],
        ['q' => 'How often should I do Tapa Brata or Atma Retreat?', 'a' => 'We highly recommend participating once a year to continuously detoxify negative energies absorbed by your body, heart, and mind from daily life.'],
        
        // --- PURIFICATION & MOON RITUALS ---
        ['q' => 'What is the difference between Eling Retreat and Healing Retreat?', 'a' => 'The Eling Retreat is exclusively held on "Tilem" (Dead Moon) to release intense negative energy, whereas the Healing Retreat is available to book every day.'],
        ['q' => 'What is the 7-Chakra Purification?', 'a' => 'A powerful self-cleansing ritual using seven types of holy water, mantras, and crystals to cleanse and align the meridian chakras in your body.'],
        ['q' => 'When does the 7-Chakra Purification take place?', 'a' => 'This specific alignment program is exclusively held during the high-energy days of Purnama (Full Moon) and Tilem (Dead Moon) each month.'],
        ['q' => 'Is it true we visit UNESCO heritage sites?', 'a' => 'Yes, select programs like the Healing Retreat and Punarbawa Retreat include sacred excursions to a UNESCO-protected temple for the Melukat purification ritual.'],
        ['q' => 'Can I reschedule my retreat if something comes up?', 'a' => 'Yes, you may reschedule your program exactly once, provided you notify our Humas (Public Relations) team at least 1 day in advance.'],
        ['q' => 'Are your Yoga Teacher Trainings (YTT) certified?', 'a' => 'Yes, our 50-Hour and 200-Hour Eling Yoga Teacher Trainings are comprehensive, professional programs designed to build independent healing capabilities and deep Dharma awareness.'],
        ['q' => 'What should I bring to a retreat?', 'a' => 'Bring comfortable clothing, a personal journal for reflection, and an open heart. We provide modules, stationery, and uniforms (for intensive retreats) in your goodie bag.'],
        ['q' => 'What is the ultimate goal of Pasraman Bali Eling Spirit?', 'a' => 'Our vision is to help you find your identity to achieve Mokshartam Jagaditha Ya Ca Iti Dharma—ultimate spiritual liberation and harmony in the physical world.']
    ];

    // Split into two columns mathematically to ensure flawless responsive flow
    $col1 = array_slice($all_faqs, 0, 13);
    $col2 = array_slice($all_faqs, 13);

    ob_start();
    ?>
    <section class="relative py-24 md:py-32 px-6 md:px-10 lg:px-20 bg-bes-forest-deep overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-40 bg-gradient-to-b from-black/20 to-transparent pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-bes-forest to-transparent pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none bes-fret" style="background-position: center top; filter: invert(1);"></div>

        <div class="relative max-w-[1280px] mx-auto">
            
            <div class="text-center mb-16 md:mb-24 bes-reveal">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                    <span class="font-body text-[10px] uppercase tracking-[0.3em] font-bold text-bes-leaf">Clarity & Guidance</span>
                    <span class="w-8 h-[1px] bg-bes-leaf/30"></span>
                </div>
                <h2 class="font-display font-light text-4xl md:text-5xl lg:text-6xl text-bes-ivory mb-6 leading-tight">
                    Inquiries of the <em class="italic !text-bes-gold font-medium">Soul</em>
                </h2>
                <p class="font-body text-bes-parchment/70 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    Everything you need to know before embarking on your sacred journey. Find answers about our healing retreats, Tapa Brata, accommodations, and spiritual rituals.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 items-start bes-reveal" style="transition-delay: 0.2s;">
                
                <div class="flex flex-col gap-4">
                    <?php foreach ($col1 as $index => $faq) : ?>
                        <div class="bes-faq-item bg-black/20 border border-white/[0.04] rounded-2xl overflow-hidden transition-colors duration-500 hover:border-bes-leaf/30">
                            <button class="bes-faq-btn w-full flex items-center justify-between gap-6 p-6 text-left focus:outline-none bes-focus group" aria-expanded="false">
                                <span class="font-display text-lg md:text-xl text-bes-ivory font-medium group-hover:!text-bes-leaf transition-colors duration-300">
                                    <?php echo esc_html($faq['q']); ?>
                                </span>
                                <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center flex-shrink-0 group-hover:border-bes-leaf/50 transition-colors duration-300 bg-white/[0.02]">
                                    <i class="fa-solid fa-plus text-bes-leaf/70 text-sm bes-faq-icon transition-transform duration-500"></i>
                                </div>
                            </button>
                            <div class="bes-faq-content max-h-0 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] bg-bes-forest/30">
                                <div class="p-6 pt-0 font-body text-[14px] text-bes-parchment/60 leading-relaxed">
                                    <?php echo esc_html($faq['a']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="flex flex-col gap-4">
                    <?php foreach ($col2 as $index => $faq) : ?>
                        <div class="bes-faq-item bg-black/20 border border-white/[0.04] rounded-2xl overflow-hidden transition-colors duration-500 hover:border-bes-leaf/30">
                            <button class="bes-faq-btn w-full flex items-center justify-between gap-6 p-6 text-left focus:outline-none bes-focus group" aria-expanded="false">
                                <span class="font-display text-lg md:text-xl text-bes-ivory font-medium group-hover:!text-bes-leaf transition-colors duration-300">
                                    <?php echo esc_html($faq['q']); ?>
                                </span>
                                <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center flex-shrink-0 group-hover:border-bes-leaf/50 transition-colors duration-300 bg-white/[0.02]">
                                    <i class="fa-solid fa-plus text-bes-leaf/70 text-sm bes-faq-icon transition-transform duration-500"></i>
                                </div>
                            </button>
                            <div class="bes-faq-content max-h-0 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] bg-bes-forest/30">
                                <div class="p-6 pt-0 font-body text-[14px] text-bes-parchment/60 leading-relaxed">
                                    <?php echo esc_html($faq['a']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="mt-16 text-center bes-reveal" style="transition-delay: 0.3s;">
                <p class="font-body text-bes-parchment/50 text-sm mb-6">Still seeking answers for your journey?</p>
                <a href="https://wa.me/6281228888873" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 px-8 py-3.5 rounded-full border border-bes-leaf text-bes-forest bg-bes-leaf font-body text-[11px] uppercase tracking-label font-bold hover:bg-transparent hover:!text-bes-leaf transition-all duration-300 shadow-[0_0_20px_rgba(194,210,74,0.15)] hover:shadow-[0_0_30px_rgba(194,210,74,0.3)]">
                    <i class="fa-brands fa-whatsapp text-sm"></i> Speak with Program Consultant
                </a>
            </div>

        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqBtns = document.querySelectorAll('.bes-faq-btn');
        
        faqBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.bes-faq-icon');
                const isOpen = this.getAttribute('aria-expanded') === 'true';

                // Optional: To make it act like a strict accordion (closing others), uncomment below:
                /*
                faqBtns.forEach(otherBtn => {
                    if (otherBtn !== btn && otherBtn.getAttribute('aria-expanded') === 'true') {
                        otherBtn.setAttribute('aria-expanded', 'false');
                        otherBtn.nextElementSibling.style.maxHeight = null;
                        otherBtn.querySelector('.bes-faq-icon').style.transform = 'rotate(0deg)';
                        otherBtn.querySelector('.bes-faq-icon').classList.replace('fa-minus', 'fa-plus');
                    }
                });
                */

                if (isOpen) {
                    // Close it
                    this.setAttribute('aria-expanded', 'false');
                    content.style.maxHeight = null;
                    icon.style.transform = 'rotate(0deg)';
                    icon.classList.replace('fa-minus', 'fa-plus');
                } else {
                    // Open it
                    this.setAttribute('aria-expanded', 'true');
                    content.style.maxHeight = content.scrollHeight + "px";
                    icon.style.transform = 'rotate(180deg)';
                    icon.classList.replace('fa-plus', 'fa-minus');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}