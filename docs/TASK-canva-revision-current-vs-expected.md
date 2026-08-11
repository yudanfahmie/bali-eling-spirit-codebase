# TASK — Canva Revision: Current State → Expected State

**Status:** READY FOR DEVELOPMENT  
**Priority:** High  
**Strategy:** low effort / high impact, reuse before rewrite  
**Sources of truth:**
1. `docs/CANVA - Salinan dari Web Bahasa Indonesia/1.png`, `2.png`, `3.png` → layout, hierarchy, interaction intent.
2. `Website BES.docx` → exact new copy/content/catalog.
3. `docs/bali-eling-spirit-audit-20260811-061200/` → current WordPress runtime/routes.
4. `docs/old-snippet-implementation-wpcodebox/` → actual legacy BES renderer/source implementation.

---

## 1. Engineering decision

The new plugin is **not** a WooCommerce/MasterStudy replacement. It is the version-controlled runtime bundle for **BES custom snippets currently living in WPCodeBox**.

```text
WordPress
├── WooCommerce / MasterStudy / Elementor / vendor plugins (unchanged)
└── BES Snippet Plugin
    └── custom BES shortcodes, hooks, UI, integrations previously in WPCodeBox
```

### Rules
- Preserve existing shortcode names whenever a page already uses one.
- Do not copy vendor plugin source into BES plugin.
- Do not rebuild unaffected pages.
- Canva = visual/interaction reference; DOCX = copy/catalog truth.
- Reuse BES v3 global tokens/components/classes from current snippets.
- Use WordPress Media Library assets; remove external demo/hotlinked images when a revised section is touched.
- Never run the same migrated snippet simultaneously in WPCodeBox and plugin.
- Full WPCodeBox migration is incremental; **Canva implementation must not wait for all legacy snippets to migrate**.

---

## 2. Current state vs expected state

| Area | Current truth | Expected | Action |
|---|---|---|---|
| Homepage | `/` uses `[bes_home_content]`; `/homepage-v2/` uses `[bes_home_content_v2]` | Existing v2 visual retained with latest client revisions | **Reuse v2; patch only deltas** |
| Global header/footer | Custom renderer already exists in `Global Assets` snippet | New Sanctuary + Academy dropdowns; revised footer links/copy | **Modify existing global snippet** |
| Sanctuary | `[bes_sanctuary_hub]` is old “3 depths / 3 programs” architecture | 4 categories: Healing & Therapy, Retreats, Tapa Brata, Corporate Service | **Refactor existing renderer** |
| Healing & Therapy | No canonical hub | Dedicated landing + atomic program popups | **New renderer/page** |
| Personal Session with Yogi | Existing published program route/content, no dedicated BES renderer contract | Dedicated landing; 4 child session popups | **Reuse existing WP page; replace body with new shortcode** |
| Eling Sanctuary Retreat | Existing `[bes_eling_sanctuary_retreat]` | New Canva/DOCX copy/layout | **Rewrite content inside same shortcode contract** |
| Tapa Brata | Multiple legacy representations exist | One current canonical experience | **Update current shortcode route; defer redirect cleanup until SEO check** |
| Corporate Services | No current canonical renderer | Dedicated landing page | **New renderer/page** |
| YTT | Existing `[bes_yoga_teacher_training]`, but catalog/copy structure differs | 50H, 100H, 200H, 300H paths per DOCX | **Reuse shell/design system; replace data/content architecture** |
| Meditation Course | Existing `[bes_meditation_course]` | 3 stages + Complete Journey | **Rewrite same shortcode** |
| Sound Healing Course | No canonical course page | Dedicated Eling Sound Healing Course | **New renderer/page** |
| Pasraman | `/pasraman/` exists as raw WP content | Structured Canva page + 4 supplied programs | **Convert existing page to shortcode wrapper** |
| Partnership | Existing published page | No new page copy supplied | **KEEP; nav/footer only** |
| Wisdom | Existing `[bes_blog_archive]` | No structural change supplied | **KEEP** |
| About Us | Existing `[bes_about_us]` | No structural change supplied | **KEEP** |
| Woo/LMS/account | Vendor systems + custom BES snippets | No redesign requested here | **Do not touch beyond later 1:1 snippet migration** |

---

## 3. Target navigation

### Header
Logo remains Home. Keep Login / Sign Up control.

```text
About Us
Sanctuary ▼
  ├─ Healing & Therapy
  ├─ Retreats
  ├─ Tapa Brata
  └─ Corporate Service
Academy ▼
  ├─ Yoga Teacher Training
  ├─ Eling Meditation Course
  └─ Eling Sound Healing Course
Pasraman
Partnership
Wisdom
```

Implementation: extend the existing `BES_NAV_LINKS`/custom header renderer into nested items. Do **not** introduce a second navigation engine.

### Suggested route reuse
- About Us → `/about-us/`
- Sanctuary → `/sanctuary/`
- Healing & Therapy → new `/healing-therapy/`
- Retreats → existing `/eling-sanctuary-retreat/` while it is the only catalog retreat
- Tapa Brata → keep current menu-linked shortcode route during rollout; canonical cleanup later
- Corporate Service → new `/corporate-services/`
- Yoga Teacher Training → `/yoga-teacher-training/`
- Eling Meditation Course → existing `/yoga-teacher-training/eling-meditation-course/`
- Eling Sound Healing Course → new `/eling-sound-healing-course/`
- Pasraman → `/pasraman/`
- Partnership → `/partnership/`
- Wisdom → `/wisdom/`

No `/academy/` landing is required in phase 1 because the approved copy defines its three child experiences, not a separate Academy page. Academy can be a dropdown parent.

---

## 4. Implementation sequence

### P0 — BES snippet plugin foundation

Create `plugins/bali-eling-spirit-snippets/` as a thin deterministic loader.

First migration batch only:
- Global Assets / header / footer / shared design system.
- Homepage v2.
- Sanctuary hub.
- Healing/retreat/Tapa Brata renderers touched by this revision.
- YTT + Meditation Course renderers.
- Shared price/tax/helper code required by the above.

Keep unrelated LMS/account/404/blog administration snippets in WPCodeBox until their own parity migration.

**Important:** disable each WPCodeBox counterpart only after the plugin-loaded copy is verified.

### P0 — Shared catalog config

Add one small shared catalog/config file for values repeated across homepage, dropdowns, cards, modals and pages:

```text
program key
label
route
type: page | popup | parent
language
duration
schedule
price
CTA
```

Do not scatter current prices/schedules across multiple renderers. Keep the existing global tax-note behavior and avoid duplicate tax notes.

### P0 — Homepage patch, not rebuild

Use current `Homepage v2` as baseline.

Only change:
- replace requested hero/section photos with approved Media Library assets;
- Eling Sanctuary cards: **3 → 4**, add Corporate Service;
- Academy cards:
  - Yoga Teacher Training
  - Eling Meditation Course
  - Eling Sound Healing Course
- keep Pasraman, Voices of Transformation, Eling Pedia and Contact/Gateway structure unchanged;
- replace FAQ with the approved 2026 set from DOCX;
- remove Atma Retreat FAQ;
- revise footer copy + Explore + Programs lists exactly from DOCX.

**FAQ cancellation policy:** DOCX still contains `[X hari]`. Do not ship placeholder text. Omit FAQ #7 until official policy is supplied, or populate only after confirmation.

### P0 — Promote homepage with zero DB churn

Current front page already contains `[bes_home_content]`.

After v2 QA, make `[bes_home_content]` resolve to the approved production v2 renderer (or a thin wrapper around it). Keep `[bes_home_content_v2]` temporarily as preview alias.

Result: no front-page rebuild and no mass WP page edit. Rollback is only renderer registration reversal.

Remove/disable production dependence on `?preview-v2=true` and the v2 preview menu DOM-replacement logic once the real global header is updated.

---

## 5. Sanctuary implementation

### `/sanctuary/` — existing `[bes_sanctuary_hub]`
Refactor from “three retreat depths” into a four-category gateway:
1. Healing & Therapy
2. Retreats
3. Tapa Brata
4. Corporate Service

Reuse existing BES styling/component language; do not redesign from zero.

### `/healing-therapy/` — new `[bes_healing_therapy]`
Use DOCX copy and Canva layout.

Atomic cards open a reusable modal:
- Healing Retreat
- Sacred Morning Awakening
- Mother Earth Purifications
- Eling Sound Awakening

`Personal Session with Yogi` is **not** a modal; navigate to its dedicated page.

Existing standalone URLs for old atomic programs should remain valid during rollout. Do not delete them simply because the new UX uses a modal.

### Personal Session with Yogi
Reuse the existing published Personal Eling Session WP page instead of creating a duplicate route. Replace its content with a shortcode wrapper, e.g. `[bes_personal_session_yogi]`.

Child sessions use the same reusable modal component:
- Ruang Jiwa / Spiritual Counseling
- Sound Chakra Healing
- 7 Chakra Crystal Healing
- Eling Therapy

Do not confuse **7 Chakra Crystal Healing** with Pasraman **Pelukatan / 7 Chakra Water Purification**.

### Eling Sanctuary Retreat
Keep existing route + `[bes_eling_sanctuary_retreat]`; replace copy/content to the approved 2D1N / 3D2N experience.

No separate `Retreats` WP landing is needed while only one retreat is in the approved catalog.

### Tapa Brata
Reuse the active shortcode implementation and update to approved 4D3N copy. Multiple historical Tapa Brata URLs exist; do not delete/redirect during content implementation. Canonical/301 cleanup is a post-QA SEO task.

### Corporate Services
Create one dedicated page + shortcode, e.g. `[bes_corporate_services]`, using the supplied corporate copy and Canva structure.

---

## 6. Academy implementation

### Yoga Teacher Training — existing `[bes_yoga_teacher_training]`
Do not preserve the current long-form curriculum structure just because code already exists. Keep reusable visual components/tokens, but rebuild the page data/section order from DOCX.

Approved catalog:
- 50H Hybrid
- 50H Offline
- **100H Offline — new**
- 200H Hybrid
- 200H Offline
- 300H Offline

Reuse current 50H/200H/300H landing routes/shortcodes where they already exist. Add a 100H detail page only because it is a real new catalog item.

Remove Workshop/YACEP from primary Academy navigation; preserve the old route until later cleanup.

### Eling Meditation Course — existing `[bes_meditation_course]`
Rewrite around:
- Stage 1 Foundation
- Stage 2 Deepening
- Stage 3 Transformation
- Complete Journey

No separate WP page per stage is required unless a later checkout/SEO requirement appears. Cards can remain within the course landing.

### Eling Sound Healing Course
Create a dedicated page + shortcode, e.g. `[bes_sound_healing_course]`, using DOCX sections and existing BES design language.

---

## 7. Pasraman

Convert existing `/pasraman/` from raw article content to a shortcode-driven page, e.g. `[bes_pasraman]`.

Implement only programs with supplied approved copy:
- Pelukatan / 7 Chakra Water Purification
- Eling Sadhana
- Eling Usada Retreat
- Eling Bhakti Yoga

The sitemap image also mentions `Program Komunitas`, but DOCX does not provide a complete approved content block. Do not invent it; add when copy is supplied.

---

## 8. Footer

Update existing global footer only.

### Explore
- Home
- About Us
- Sanctuary
- Academy
- Pasraman
- Partnership
- Wisdom

### Programs
- Healing & Therapy
- Retreats
- Tapa Brata
- Corporate Service
- Yoga Teacher Training
- Eling Meditation Course
- Eling Sound Healing Course

Remove obsolete generic links `Online Course`, `Workshop`, and duplicate `Sanctuary` from Programs.

Use approved footer sentence from DOCX. `Get in Touch` stays unchanged.

---

## 9. Reusable modal requirement

Build **one** modal implementation for program details; feed it catalog/content data.

Minimum behavior:
- open from card;
- close button + backdrop + `Esc`;
- focus return to triggering card;
- body scroll lock;
- accessible title/ARIA;
- mobile-safe height with internal scroll;
- CTA to existing WhatsApp/booking flow;
- no duplicated modal JS per card.

Do not use a modal for category parents or long-form pages.

---

## 10. Explicit non-goals for this task

- No WooCommerce source migration/rewrite.
- No MasterStudy source migration/rewrite.
- No LMS/account redesign.
- No full Elementor cleanup.
- No deletion of legacy pages during content rollout.
- No mass permalink change.
- No migration of all WPCodeBox snippets as a prerequisite.
- No new copy generated by developer/AI where DOCX is silent.

---

## 11. Acceptance criteria

- [ ] Revised pages match Canva hierarchy and use DOCX copy without silent rewriting.
- [ ] Homepage production path works without `?preview-v2=true`.
- [ ] Existing front page shortcode contract remains valid.
- [ ] Sanctuary and Academy dropdowns work on desktop + mobile + keyboard.
- [ ] Homepage Sanctuary has 4 cards; Academy has exactly 3 approved cards.
- [ ] Healing & Therapy atomic services use one modal engine.
- [ ] Personal Session with Yogi is a dedicated page with 4 modal services.
- [ ] YTT catalog includes 50H/100H/200H/300H as specified.
- [ ] Meditation Course has 3 stages + Complete Journey.
- [ ] Pasraman contains only approved supplied programs.
- [ ] Footer navigation matches approved lists.
- [ ] No `[X hari]`, lorem ipsum, dead `#` CTA, old “Wellness Training”, or “Workshop YACEP” remains in revised surfaces.
- [ ] No touched revised surface hotlinks Unsplash/demo assets.
- [ ] No duplicate shortcode/function registration between plugin and WPCodeBox.
- [ ] No PHP warning/fatal or browser console error on revised pages.
- [ ] Existing WooCommerce, MasterStudy, login/account and course flows remain unchanged.
- [ ] Existing old URLs remain 200 or have an explicitly reviewed redirect; zero accidental 404s.
- [ ] Mobile QA at ~390px and desktop QA at ~1366/1440px completed against Canva.

---

## 12. Recommended development order

```text
1. BES snippet plugin loader
2. Shared catalog + modal
3. Global header/footer dropdown patch
4. Homepage v2 delta patch → promote behind [bes_home_content]
5. Sanctuary hub
6. Healing & Therapy + Personal Session
7. Retreat / Tapa Brata / Corporate Services
8. YTT + Meditation + Sound Healing Course
9. Pasraman
10. Cross-route QA + only then legacy/canonical cleanup
```

**Definition of done:** client-approved information architecture and copy are live using the existing BES design/runtime foundation, with the smallest practical number of new pages/renderers and without coupling the rollout to a full WPCodeBox or vendor-plugin migration.