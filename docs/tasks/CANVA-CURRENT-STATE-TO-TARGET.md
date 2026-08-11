# BES — Canva Current State → Target Implementation Task

Status: **READY FOR DEVELOPMENT**  
Baseline: `main@340916d` + audit snapshot + latest WPCodeBox source push + Canva `1.png/2.png/3.png` + `Website BES.docx`

## 1. Engineering Decision

**Do not rebuild the website.** Existing WPCodeBox renderers are already modular, visually close to Canva, and cover most required pages. Implement the client revision as **catalog remap + copy/data update + reusable interaction layer + only a few net-new pages**.

Priority rule:

> reuse existing renderer → update data/copy → remap route/menu → add reusable popup → build new renderer only when no existing equivalent exists.

Do **not** combine this client revision with the WPCodeBox → first-party plugin migration. Reach visual/behavioral parity first; migrate source ownership in a separate release.

---

## 2. Source of Truth

Order of authority for this implementation:

1. `Website BES.docx` = approved program/catalog/copy behavior.
2. Canva `1.png`, `2.png`, `3.png` = visual composition, section order, popup/page intent, image direction.
3. `docs/old-snippet-implementation-wpcodebox/` = current renderer/codebase baseline.
4. audit JSON = WordPress page/menu/runtime inventory; useful for routing validation, but older than the latest snippet push.

Runtime mapping must be verified before release because the audit snapshot reports legacy `[bes_home_content]`, while the latest pushed implementation/user mapping identifies Homepage v2 as `[bes_home_content_v2]`.

---

## 3. Current State vs Target

| Area | Current engineering state | Target | Action |
|---|---|---|---|
| Homepage shell | `[bes_home_content_v2]` consolidated renderer exists | Canva revision | **KEEP + SURGERY** |
| Hero | already revised in Homepage v2 | approved / no change | **KEEP** |
| Core Values | already present | approved / no change | **KEEP** |
| Sanctuary homepage cards | 3-program legacy model | 4 cards: Healing & Therapy, Retreats, Tapa Brata, Corporate Service | **CHANGE DATA ONLY** |
| Academy homepage cards | stale Wellness Training / Workshop YACEP model | YTT, Eling Meditation Course, Eling Sound Healing Course | **CHANGE DATA ONLY** |
| Pasraman homepage section | exists | approved / no change | **KEEP** |
| Voices / Eling Pedia / Contact | exists | approved / no change | **KEEP** |
| FAQ | stale catalog incl. Atma Retreat | 18 FAQ 2026 | **REPLACE DATA** |
| Global header | `BES_NAV_LINKS` already = About, Sanctuary, Academy, Pasraman, Partnership, Wisdom | same target | **VERIFY ONLY** |
| Footer | legacy Explore/Programs list | revised Explore + current program catalog | **CHANGE DATA/COPY** |
| Sanctuary page | `[bes_sanctuary_hub]`, hard-coded 3-depth model | 4 top-level categories | **REMAP HUB** |
| Healing Retreat | `[bes_healing_retreat]` standalone exists | appears as Healing & Therapy popup item | **REUSE CONTENT/KEEP LEGACY URL** |
| Healing & Therapy parent | no dedicated equivalent | dedicated page + 4 popup experiences + Personal Session child | **NEW THIN RENDERER** |
| Personal Session with Yogi | no dedicated equivalent | dedicated page + 4 popup sessions | **NEW THIN RENDERER** |
| Eling Sanctuary Retreat | `[bes_eling_sanctuary_retreat]` exists | revised 2D1N / 3D2N content | **UPDATE DATA/COPY** |
| Tapa Brata | duplicate/parallel old implementations exist | one visible canonical experience | **CONSOLIDATE DISCOVERY, KEEP ALIASES** |
| Corporate Service | no dedicated equivalent | dedicated Corporate Services page | **NEW RENDERER** |
| YTT | `[bes_yoga_teacher_training]` rich page exists | revised YTT content | **UPDATE DATA/COPY** |
| Meditation Course | `[bes_meditation_course]` exists | Eling Meditation Course | **UPDATE DATA/COPY** |
| Sound Healing Course | no dedicated course renderer found | Eling Sound Healing Course | **NEW, REUSE COURSE SHELL** |
| Wisdom | `[bes_blog_archive]` exists | keep | **KEEP** |

---

## 4. Implementation Sequence

### P0 — Freeze canonical contracts

- [ ] Confirm production Homepage page uses `[bes_home_content_v2]`.
- [ ] Confirm active Global Assets snippet is the pushed `Global Assets (Preloader, Header, Footer)` implementation.
- [ ] Record canonical production routes before changing navigation.
- [ ] Keep every currently used shortcode registered during this revision.
- [ ] Do not delete legacy pages/snippets yet; remove them from discovery first.

**Acceptance:** no existing public URL or shortcode breaks while revision work starts.

### P1 — Homepage + global shell — highest impact / lowest effort

Edit existing Homepage v2; do not rebuild its layout.

- [ ] Keep Hero, Core Values, Pasraman, Voices, Eling Pedia, Contact untouched except asset/copy defects discovered during QA.
- [ ] Sanctuary cards → exactly:
  1. Healing & Therapy
  2. Retreats
  3. Tapa Brata
  4. Corporate Service
- [ ] Academy cards → exactly:
  1. Yoga Teacher Training
  2. Eling Meditation Course
  3. Eling Sound Healing Course
- [ ] Replace FAQ dataset with the 18 approved FAQ items; remove Atma Retreat.
- [ ] Footer intro copy → approved `Website BES.docx` version.
- [ ] Footer Explore → Home, About Us, Sanctuary, Academy, Pasraman, Partnership, Wisdom.
- [ ] Footer Programs → Healing & Therapy, Retreats, Tapa Brata, Corporate Service, Yoga Teacher Training, Eling Meditation Course, Eling Sound Healing Course.
- [ ] Remove visible `Online Course`, generic duplicate `Sanctuary`, stale `Workshop`, `Wellness Training`, `Workshop YACEP` from current catalog/navigation.
- [ ] Keep Get in Touch unchanged.

**Do not touch:** Homepage visual engine, animation system, Tailwind/BES design tokens, preloader, WooCommerce layer.

### P2 — Sanctuary IA

Refactor `[bes_sanctuary_hub]` from **3 depths** to **4 categories** without rebuilding the visual shell.

Target cards:

| Card | Behavior |
|---|---|
| Healing & Therapy | `/healing-therapy/` |
| Retreats | direct to current Eling Sanctuary Retreat route; do not create an empty Retreats hub while it has one active retreat |
| Tapa Brata | canonical Tapa Brata route |
| Corporate Service | `/corporate-service/` |

#### Healing & Therapy — new thin page

Create `[bes_healing_therapy]` using existing BES v3 layout primitives.

Sections follow Canva/DOCX:
- Hero
- empathy section
- gentle path section
- Discover Your Healing Journey
- Why Heal with BES
- closing CTA

Journey cards:
- Healing Retreat → popup
- Sacred Morning Awakening → popup
- Mother Earth Purifications → popup
- Eling Sound Awakening → popup
- Personal Session with Yogi → **dedicated page**, not popup

**Implementation rule:** build **one reusable modal component**, populated by PHP data arrays. Do not build four separate modal engines.

Reuse current program/snippet content where it matches approved copy, but `Website BES.docx` wins on naming, schedule, pricing, inclusions and CTA.

#### Personal Session with Yogi — new thin page

Create `[bes_personal_session_yogi]`.

Cards, all using the same reusable modal engine:
- Ruang Jiwa / Spiritual Counseling
- Sound Chakra Healing
- 7 Chakra Crystal Healing
- Eling Therapy

Keep the Eling Therapy prerequisite visible: participant must have completed at least one Healing Retreat or another retreat containing spiritual counseling.

#### Existing Retreat / Tapa Brata pages

- [ ] `[bes_eling_sanctuary_retreat]`: retain renderer; replace copy/data with approved 2D1N and 3D2N offer.
- [ ] Tapa Brata: choose one canonical public route/rendering source; update to approved 4D3N content.
- [ ] Keep old Tapa Brata shortcode/route as compatibility alias or redirect only after parity is confirmed.
- [ ] Remove Atma/Karma/Punarbawa and other retired programs from visible navigation/catalog; do not delete code in this release.

#### Corporate Service — new page

Create `[bes_corporate_service]` with Canva section order:
- Hero
- workplace problem
- holistic workplace wellbeing approach
- Corporate Experiences
- Why Partner with BES
- designed around organization
- closing CTA

Reuse existing BES cards, dark/cream section rhythm, typography and CTA styles. No new design system.

### P3 — Academy

- [ ] Keep `[bes_yoga_teacher_training]`; update copy/data only.
- [ ] Keep `[bes_meditation_course]`; rename presentation/catalog to **Eling Meditation Course** and update approved content.
- [ ] Create `[bes_sound_healing_course]` by reusing/extracting the Meditation/YTT page shell; do not start from blank markup.
- [ ] Remove stale Workshop/Online Course items from primary discovery unless the client explicitly reintroduces them.
- [ ] Preserve old routes until redirect mapping is reviewed.

### P4 — Pasraman / Partnership / Wisdom

- [ ] Homepage Pasraman section: no redesign.
- [ ] Verify `/pasraman/` exists and is routed to a real page. If missing, create a lightweight Pasraman hub from the approved DOCX content using existing hub/card primitives.
- [ ] Verify `/partnership/` exists before production nav switch. Do not invent partnership content absent an approved spec.
- [ ] Wisdom: keep existing `[bes_blog_archive]` implementation.

---

## 5. Shared Engineering Changes

### Reusable popup engine

Create one reusable modal renderer, e.g.:

```php
bes_render_program_modal( $program_key, $program_data );
```

Requirements:
- data-driven EN/ID content
- accessible dialog semantics
- ESC / close button / backdrop close
- focus return to triggering card
- mobile-safe scroll
- CTA can resolve to WhatsApp or booking route
- no AJAX required for static program details

### Central route/contact config

When touching related files, stop scattering new hard-coded values.

Centralize at minimum:
- canonical route per catalog item
- official WhatsApp number
- reusable CTA link builder

`Global Assets` currently defines official contact as `+6287825989117`; several older page snippets still contain `6281228888873`. **Do not propagate both.** Validate the production number once and use one config value for all revised CTAs.

### URL/media hygiene

For touched code only:
- use `home_url()` / route helper instead of staging/domain literals
- use WP Media attachment resolution where available
- no new Unsplash dependency when the client supplied/referenced WP media assets
- preserve old URLs until canonical redirect decision is explicit

---

## 6. Files / Shortcodes Expected to Change

Primary existing sources:

```text
docs/old-snippet-implementation-wpcodebox/
├── balielingspirit-com-Homepage v2.php
├── balielingspirit-com-Global Assets (Preloader, Header, Footer).php
└── Pages/
    ├── balielingspirit-com-Sanctuary.php
    ├── balielingspirit-com-Healing Retreat.php
    ├── balielingspirit-com-Eling Sanctuary Retreat.php
    ├── balielingspirit-com-Tapa Brata.php
    ├── balielingspirit-com-Yoga Teacher Training.php
    └── balielingspirit-com-YTT- Meditation Course.php
```

Net-new renderer contracts proposed:

```text
[bes_healing_therapy]
[bes_personal_session_yogi]
[bes_corporate_service]
[bes_sound_healing_course]
```

Do not rename existing production shortcodes during this release.

---

## 7. Explicit Non-Goals

- No theme rewrite.
- No Elementor rebuild of shortcode pages.
- No LMS/WooCommerce refactor unless a revised page directly depends on it.
- No design-system rewrite.
- No deletion of old WPCodeBox snippets during parity work.
- No WPCodeBox → plugin migration in the same release.
- No new custom database tables.
- No AJAX/API architecture for static popup content.

---

## 8. QA / Acceptance Criteria

### Functional
- [ ] Homepage renders without PHP/JS console errors.
- [ ] Header/footer show target 2026 IA on desktop + mobile.
- [ ] Every homepage catalog card resolves to a valid target.
- [ ] Sanctuary exposes exactly 4 top-level categories.
- [ ] Healing & Therapy has 4 working detail popups + dedicated Personal Session page.
- [ ] Personal Session page has 4 working session popups.
- [ ] YTT, Meditation, Sound Healing and Corporate pages have valid CTAs.
- [ ] Existing WooCommerce/LMS flows unaffected.
- [ ] Old shortcode pages still render until explicit retirement.

### Content
- [ ] Atma Retreat absent from visible FAQ/catalog.
- [ ] Wellness Training / Workshop YACEP / generic Online Course removed from new IA.
- [ ] Schedules, prices, inclusions and prerequisites match `Website BES.docx`.
- [ ] EN/ID copy is not mixed accidentally within one locale view.

### Visual
- [ ] Reuse current BES dark forest / cream rhythm, rounded organic imagery, cards and lime CTA language shown in Canva.
- [ ] Mobile cards and modals do not overflow.
- [ ] No duplicate section styling introduced where current primitives already exist.

### Performance
- [ ] Popup details are rendered locally/data-driven; no unnecessary network fetch.
- [ ] No duplicate loading of global CSS/font/icon libraries introduced by new pages.
- [ ] New page renderers do not query full post/product/course collections without pagination/limits.

---

## 9. Publish Blockers — only two

1. FAQ #7 still contains `[X hari]`. Implement the FAQ now but keep that one policy copy behind a clearly marked placeholder until the official cancellation/reschedule window is supplied.
2. Confirm which WhatsApp number is production-canonical before final CTA QA (`+6287825989117` in Global Assets vs older `6281228888873` literals).

Neither blocker should stop development of the rest of the revision.

---

## 10. Deployment / Rollback

1. Implement against the current v2/shortcode architecture.
2. QA through preview/staging first.
3. Switch navigation/catalog visibility only after target pages exist.
4. Keep legacy shortcodes/pages active for one parity cycle.
5. Add redirects only after target route validation.
6. After client acceptance, start a **separate** WPCodeBox → `bali-eling-spirit-core` migration preserving the same shortcode contracts.

## Definition of Done

The site matches the Canva/DOCX **information architecture, catalog, content intent and interactions** while preserving the existing BES renderer/design system; only missing capabilities are newly built, legacy behavior remains rollback-safe, and no unrelated platform refactor is bundled into the release.
