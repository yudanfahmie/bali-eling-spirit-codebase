# TASK — BES Canva Revision: Precision Delta Plan

**Status:** READY FOR DEVELOPMENT WITH DATA GATES  
**Priority:** High  
**Strategy:** smallest safe delta, reuse > patch > add > defer  
**Primary objective:** implement the 2026 Canva/DOCX brief without redesigning the existing BES runtime, changing vendor systems, or creating unnecessary routes.

## 0. Source-of-truth order

Use all four sources together; none is sufficient alone.

1. `docs/bali-eling-spirit-audit-20260811-061200/` → **runtime baseline**: existing routes, pages, menus, shortcodes, plugins.
2. `docs/old-snippet-implementation-wpcodebox/` → **implementation baseline**: actual BES shortcode/hook/rendering code currently living in WPCodeBox.
3. `Website BES.docx` → **approved copy/catalog data**.
4. Canva `1.png`, `2.png`, `3.png` → **visual hierarchy, sitemap, interaction and layout intent**.

### Conflict rule

- Existing behavior/route questions → audit wins.
- Existing code/dependency questions → WPCodeBox source wins.
- Copy, price, schedule, catalog questions → DOCX wins **unless DOCX contradicts itself or the Canva sitemap**; then mark as a data gate and do not guess.
- Layout/interaction questions → Canva wins.
- Never alter an unrelated working surface to make implementation “cleaner”.

---

## 1. Engineering verdict

The correct implementation is **not a rebuild**.

```text
CURRENT
WP Page -> BES shortcode -> WPCodeBox snippet -> WordPress/vendor APIs

TARGET
WP Page -> SAME BES shortcode -> Bali Eling Spirit Site Core -> WordPress/vendor APIs
```

The site-core plugin is only the version-controlled runtime home for custom code previously stored in WPCodeBox. WooCommerce, MasterStudy, Elementor and other vendor plugins stay vendor-owned and unchanged.

### Anti-overhaul rules

- Preserve route and shortcode contracts wherever they already exist.
- Patch only surfaces named in the brief.
- Do not migrate all WPCodeBox snippets before starting this revision.
- Do not perform legacy URL cleanup during content rollout.
- Do not redesign global CSS/design tokens.
- Do not create a page when a dropdown, existing page, or modal satisfies the brief.
- Do not duplicate a migrated snippet in site-core + WPCodeBox at the same time.
- Do not invent copy, program data, schedules, prices, teachers, policies or contact routing.
- New code must use the existing BES visual language and shared utilities before adding new CSS/JS.

---

## 2. Baseline → expectation → minimum delta

| Surface | Current baseline | Expected brief | Minimum action | Class | Risk |
|---|---|---|---|---|---|
| Global header | `Global Assets` reads WordPress **Menu ID 48**, already builds parent/child dropdowns on desktop/mobile | Sanctuary + Academy dropdowns | **Update menu hierarchy; patch fallback only** | PATCH | Low |
| Global footer | Existing global renderer | Revised copy + Explore + Programs | Patch existing footer arrays/markup | PATCH | Low |
| Homepage | `/` = `[bes_home_content]`; preview = `[bes_home_content_v2]` | v2 retained; small 2026 deltas | Patch v2 only, then promote behind existing shortcode | PATCH | Low-Med |
| Sanctuary | `[bes_sanctuary_hub]` = old 3-depth retreat hub | 4 category gateway | Reuse shortcode; replace data/sections | ADAPT | Med |
| Healing & Therapy | No matching canonical gateway | Dedicated landing + 4 service popups + private-session child | Add one page/renderer + shared modal data | NEW | Med |
| Personal Session with Yogi | Existing related published content, no approved dedicated renderer | Dedicated parent landing + 4 private-session popups | Reuse existing WP route if suitable; new shortcode renderer | ADAPT | Med |
| Eling Sanctuary Retreat | Existing route + shortcode | New 2D1N / 3D2N copy/layout | Rewrite inside same contract | PATCH | Med |
| Tapa Brata | Existing implementation + historical duplicates | New 4D3N current experience | Patch active canonical renderer only | PATCH | Med |
| Corporate Service | No canonical approved renderer | Dedicated landing | Add one page/renderer | NEW | Med |
| YTT | Existing `[bes_yoga_teacher_training]` + detail renderers | 50H / 100H / 200H / 300H catalog | Reuse shell/routes; update data/sections; add only 100H if missing | ADAPT | Med |
| Meditation Course | Existing `[bes_meditation_course]` | Stage 1/2/3 + Complete Journey | Rewrite same shortcode; stages remain cards/sections | PATCH | Med |
| Sound Healing Course | No canonical course page | Dedicated Eling Sound Healing Course | Add one page/renderer | NEW | Med |
| Pasraman | Existing `/pasraman/` raw WP content | Canva-designed page + 4 approved programs | Keep route; move body to BES shortcode renderer | ADAPT | Med |
| About Us | Existing `[bes_about_us]` | No requested structural change | Leave untouched | KEEP | Low |
| Partnership | Existing published page | No supplied redesign copy | Leave untouched except nav/footer | KEEP | Low |
| Wisdom | Existing `[bes_blog_archive]` | No requested structural change | Leave untouched | KEEP | Low |
| Woo/LMS/account | Vendor runtime + custom BES integration snippets | No redesign request | Leave untouched | KEEP | High if touched |

**Rule:** `KEEP` items are regression-test targets, not development targets.

---

## 3. Navigation — use the engine already present

The current `Global Assets` snippet already:
- loads WordPress Menu ID `48`;
- builds a parent/child tree;
- renders desktop dropdowns;
- renders mobile expandable submenus.

Therefore **do not build a second navigation engine**.

### Menu 48 target

```text
About Us
Sanctuary
  ├─ Healing & Therapy
  ├─ Retreats
  ├─ Tapa Brata
  └─ Corporate Service
Academy
  ├─ Yoga Teacher Training
  ├─ Eling Meditation Course
  └─ Eling Sound Healing Course
Pasraman
Partnership
Wisdom
```

### Route strategy

- Sanctuary parent → existing `/sanctuary/`.
- Academy is a structural parent in phase 1. **Do not create `/academy/` only to satisfy the menu.** If it has no approved page, render the parent as a non-dead dropdown trigger rather than a fake `#` CTA.
- Healing & Therapy → new `/healing-therapy/`.
- Retreats → existing Eling Sanctuary Retreat route while it is the sole approved retreat catalog entry.
- Tapa Brata → current active route; defer duplicate/canonical cleanup.
- Corporate Service → new `/corporate-services/`.
- YTT → existing `/yoga-teacher-training/`.
- Meditation → existing meditation course route.
- Sound Healing Course → new `/eling-sound-healing-course/`.
- Pasraman, Partnership, Wisdom → existing routes.

Also update `BES_NAV_LINKS` only as a safe fallback; Menu 48 remains primary.

---

## 4. Canonical site-core plugin — incremental cutover, not big-bang migration

The deployment-owned plugin path is fixed:

```text
plugin/bali-eling-spirit-site-core/
├── bali-eling-spirit-site-core.php
├── assets/
├── src/
│   ├── config/
│   ├── global/
│   ├── homepage/
│   ├── sanctuary/
│   ├── academy/
│   └── pasraman/
└── templates/
```

The root `.cpanel.yml` deploys only this directory. The plural `plugins/` directory remains developer tooling/history and must not become a second production site-core path.

### First migration batch only

1. Global Assets / header / footer / shared design system.
2. Homepage v2 + production homepage wrapper.
3. Sanctuary + related program renderers touched by this brief.
4. YTT + Meditation renderers touched by this brief.
5. New Sound Healing / Corporate / Healing & Therapy / Personal Session / Pasraman renderers.
6. Shared price/tax/contact helpers required by those surfaces.

Everything else remains in WPCodeBox until its own parity migration.

### Cutover ledger

Maintain each moved module in one explicit state:

```text
WPBOX_ONLY -> PLUGIN_SHADOW -> PLUGIN_LIVE -> WPBOX_OFF
```

- `PLUGIN_SHADOW`: source exists under `plugin/bali-eling-spirit-site-core/` but is not loaded.
- `PLUGIN_LIVE`: site-core loads it only after the WPCodeBox counterpart is disabled.
- Never allow the same shortcode/function/hook module to be live in both places.
- Plugin activation must not automatically disable or rewrite WPCodeBox.

This is the primary anti-zigzag/anti-fatal control.

---

## 5. Shared program facts — one source inside BES

Create a small catalog config for facts repeated across cards, modals, menus and pages:

```text
key
label
route
interaction: page | modal | dropdown-parent
language
duration
schedule
price
tax_behavior
cta
contact_channel
```

Do **not** move full long-form page copy into one giant config. Only centralize repeated factual fields.

Benefits:
- one schedule/price edit updates every surface;
- homepage card and detail modal cannot drift;
- language and CTA routing are testable;
- tax note is rendered once rather than copied manually everywhere.

---

## 6. Homepage — strict delta patch

`Homepage v2` is the baseline. Do not rebuild it.

### Keep unchanged

- Hero structure/copy.
- Core Values structure/copy.
- Pasraman section structure.
- Voices of Transformation.
- Eling Pedia.
- Contact/Gateway.

### Change only

1. Sanctuary cards → exactly 4:
   - Healing & Therapy
   - Retreats
   - Tapa Brata
   - Corporate Service
2. Academy cards → exactly 3:
   - Yoga Teacher Training
   - Eling Meditation Course
   - Eling Sound Healing Course
3. Replace FAQ with current 2026 set; remove Atma Retreat.
4. Footer copy/navigation per DOCX.
5. Replace photos only where Canva explicitly marks photo replacement **and an approved Media Library asset can be mapped**. Do not alter otherwise-approved hero/layout to chase an image note blindly.

### Production promotion

After QA:
- keep WP front page unchanged;
- make `[bes_home_content]` resolve to approved v2 production renderer;
- keep `[bes_home_content_v2]` temporarily as preview alias;
- remove dependency on `?preview-v2=true` and client-side menu replacement only after Menu 48 is live and verified.

Rollback = restore old `[bes_home_content]` registration; no DB/page rebuild required.

---

## 7. Sanctuary execution

### `/sanctuary/` — reuse `[bes_sanctuary_hub]`

Replace the old “3 depths” catalog with four category cards:
1. Healing & Therapy
2. Retreats
3. Tapa Brata
4. Corporate Service

Keep existing BES design tokens/components. This is a content/IA refactor, not a new visual system.

### Healing & Therapy — new `[bes_healing_therapy]`

Dedicated landing, matching Canva/DOCX section order.

Modal services:
- Healing Retreat
- Sacred Morning Awakening
- Mother Earth Purifications
- Eling Sound Awakening

`Personal Session with Yogi` navigates to a dedicated landing page; it is not a modal.

Existing standalone legacy service URLs stay valid during rollout.

### Personal Session with Yogi — dedicated renderer

Reuse an existing suitable published route rather than creating a duplicate if baseline confirms one.

Child modal sessions:
- Ruang Jiwa / Spiritual Counseling
- Sound Chakra Healing
- 7 Chakra Crystal Healing
- Eling Therapy

Teacher/Yogi profile section must reuse verified profile data. If no approved profile data exists, do not fabricate profiles.

### Retreats

Keep existing Eling Sanctuary Retreat route + shortcode. Replace content with approved 2D1N / 3D2N experience.

No separate generic Retreats page is required while only one retreat is approved.

### Tapa Brata

Patch active shortcode/route to approved 4D3N experience. Do not delete duplicate historical pages in this task.

### Corporate Service

Add one dedicated page + shortcode using supplied Canva/DOCX structure.

---

## 8. Academy execution

### YTT — preserve `[bes_yoga_teacher_training]`

Reuse existing v3 UI components; replace the catalog/data architecture with:

- 50H Hybrid
- 50H Offline
- 100H Offline / Residential **NEW**
- 200H Hybrid
- 200H Offline
- 300H Offline

Reuse existing 50H/200H/300H detail pages and shortcode contracts where they already exist. Add only the missing 100H detail surface.

Workshop/YACEP is removed from primary Academy navigation but its old URL is not deleted during rollout.

### Meditation — preserve `[bes_meditation_course]`

One landing page with:
- Stage 1 — Foundation
- Stage 2 — Deepening
- Stage 3 — Transformation
- Complete Journey

Do not create four new WP pages unless checkout/SEO later requires them.

### Eling Sound Healing Course

Add one dedicated page + shortcode, reusing BES components. No new design framework.

---

## 9. Pasraman

Keep `/pasraman/`; replace raw long-form body with a BES shortcode renderer.

Implement only approved supplied programs:
- Pelukatan / 7 Chakra Water Purification
- Eling Sadhana
- Eling Usada Retreat
- Eling Bhakti Yoga

`Program Komunitas` appears in the sitemap but has no complete approved copy. **DEFER — do not invent content.**

---

## 10. One modal engine only

Build one reusable program-detail modal; cards supply data.

Required behavior:
- open from card;
- close via button, backdrop and `Esc`;
- focus trap + focus return;
- body scroll lock;
- accessible title/ARIA;
- mobile-safe internal scrolling;
- CTA uses explicit contact/booking channel;
- one JS controller, not copied JS per modal/card.

Do not use modals for category parents or long-form experiences.

---

## 11. Data gates discovered by cross-audit

These must be resolved without blocking unrelated implementation.

### GATE A — Healing Retreat duration vs schedule

Brief says:
- Duration: **5 Hours**
- Schedule: **08.00–14.00**

That clock range is 6 hours. Current baseline previously uses a 5-hour window. **Do not silently choose one.** Build with a single config value and hold final publish of this field until confirmed.

### GATE B — 50H Hybrid language

Cross-source mismatch:
- Canva sitemap + FAQ indicate **Hybrid = Bahasa Indonesia**.
- YTT program copy block says `Bahasa Indonesia / English` for 50H.

Working interpretation: Hybrid should follow the sitemap/FAQ and be Bahasa Indonesia, but mark for final content confirmation before production.

### GATE C — FAQ cancellation policy

FAQ #7 still contains `[X hari]`.

- Never publish placeholder.
- Hide/omit that FAQ until official policy is supplied.

### GATE D — WhatsApp/contact routing

Existing snippets contain more than one WhatsApp number/channel. The brief specifies WhatsApp CTAs but does not resolve which number owns each journey.

- Do not normalize all numbers blindly.
- Centralize contact routing as named channels (`general`, `sanctuary`, `academy`, etc.) only after ownership is confirmed.
- Until then preserve existing verified route-specific contact behavior.

### GATE E — Program Komunitas

Sitemap contains it; DOCX lacks complete content. Defer.

These are **field-level gates**, not reasons to delay the rest of development.

---

## 12. Iteration engine — mandatory development loop

Every surface is implemented with the same short loop:

```text
1. BASELINE
   capture route + shortcode + screenshot + current CTA/dependencies

2. CLASSIFY
   KEEP | PATCH | ADAPT | NEW | DEFER

3. MINIMUM DELTA
   change only the requirement mapped to that surface

4. CONTRACT TEST
   shortcode, route, hooks, assets, CTA, no duplicate registration

5. VISUAL/CONTENT TEST
   Canva hierarchy + DOCX copy/data

6. REGRESSION TEST
   header/footer/mobile + unaffected vendor flows where relevant

7. FREEZE
   mark batch passed before touching the next area
```

If a requirement causes an unrelated surface to change, **stop and reassess** before adding another workaround.

### Stop conditions

Do not continue stacking fixes when any of these occurs:
- duplicate function/shortcode fatal;
- a new global CSS rule is needed only to repair a local page;
- a page requires editing vendor plugin source;
- route change causes unexplained 404/redirect chain;
- implementation requires maintaining both old and new menu engines;
- one data fact has different values on two revised surfaces;
- fix requires modifying an unrelated LMS/Woo/account surface.

Resolve root cause or revert the current batch first.

---

## 13. Batch plan + gates

### Batch A — plugin foundation + global runtime

**Do:** loader, module ledger, shared catalog/contact config, migrate Global Assets 1:1 into `plugin/bali-eling-spirit-site-core/`.  
**Then:** update Menu 48 hierarchy and fallback data.

**Pass when:** header/footer are visually unchanged except approved nav/footer delta; mobile dropdown works; no duplicate hooks.

### Batch B — homepage

**Do:** patch only approved v2 deltas; promote through `[bes_home_content]` after preview QA.

**Pass when:** `/` uses approved layout without preview query flag; old homepage can be restored by registration rollback.

### Batch C — Sanctuary

**Do:** hub → Healing & Therapy → Personal Session → Retreat/Tapa → Corporate.

**Pass when:** all category routes/CTAs resolve, modal engine is shared, no old route accidentally disappears.

### Batch D — Academy

**Do:** YTT catalog → 100H addition → Meditation → Sound Healing Course.

**Pass when:** all catalog labels/languages/prices/routes match approved data and old YTT routes remain valid.

### Batch E — Pasraman

**Do:** convert existing page to shortcode renderer using only supplied programs.

**Pass when:** no Program Komunitas content is invented and existing `/pasraman/` route remains unchanged.

### Batch F — production cross-regression

**Do:** purge page/cache layer after cutover; route crawl; desktop/mobile visual compare; check error logs/console.

**Pass when:** no accidental 404, no duplicate registration, no vendor-flow regression.

---

## 14. QA matrix

### Runtime

- [ ] PHP lint passes for every plugin file.
- [ ] No duplicate shortcode/function/hook registration.
- [ ] No PHP warnings/notices/fatals on revised routes.
- [ ] No browser console errors.
- [ ] Cache purge performed after menu/renderer cutover.

### Contracts

- [ ] Existing route retained whenever marked PATCH/ADAPT.
- [ ] Existing shortcode names retained whenever a contract exists.
- [ ] Old URLs remain 200 or have an explicitly reviewed redirect.
- [ ] WooCommerce, MasterStudy, login/account/course flows remain unchanged.

### Content/data

- [ ] DOCX copy not silently rewritten.
- [ ] One canonical price/schedule/language value per program.
- [ ] No `[X hari]` or other placeholders.
- [ ] No obsolete `Wellness Training` / `Workshop YACEP` on revised primary surfaces.
- [ ] No Atma Retreat FAQ.
- [ ] No invented Program Komunitas or Yogi profile content.
- [ ] Tax note appears once per applicable price, not duplicated.

### Navigation

- [ ] Menu 48 is the production source.
- [ ] Sanctuary dropdown has exactly 4 children.
- [ ] Academy dropdown has exactly 3 children.
- [ ] Structural Academy parent is not a dead CTA.
- [ ] Desktop hover/focus and mobile expand/collapse work.

### Visual

Canva references are 1366px wide, so use 1366/1440 desktop as the primary visual baseline.

- [ ] Desktop ~1366/1440px checked section-by-section.
- [ ] Mobile ~390px checked.
- [ ] Cards, corner radii, shadows, spacing and image treatment remain within existing BES v3 language.
- [ ] Touched surfaces use approved/owned Media Library assets rather than Unsplash/demo hotlinks.

### CTA

- [ ] Every CTA resolves to a real route/modal/contact action.
- [ ] No dead `#` user-action CTA.
- [ ] Booking/contact number is intentionally mapped, not copied accidentally from another program.

---

## 15. Rollback model

Rollback must remain local to the latest batch.

- Site-core module fails → disable that module and restore its WPCodeBox counterpart.
- Homepage fails → restore old `[bes_home_content]` registration.
- Menu fails → restore previous Menu 48 hierarchy; no renderer rewrite required.
- New page fails → remove from nav; existing routes remain untouched.
- Data conflict → hide only the unresolved field/FAQ/CTA, not the whole page.

Do not use database-wide restore as the normal rollback mechanism.

---

## 16. Definition of done

The task is complete when the approved 2026 IA/copy is live using the existing BES runtime/design foundation with:

- the smallest practical number of new pages;
- existing shortcode/route contracts preserved;
- one shared modal engine;
- one source for repeated program facts;
- Menu 48 as the real navigation source;
- touched WPCodeBox snippets migrated incrementally into `plugin/bali-eling-spirit-site-core/`;
- unrelated vendor/LMS/Woo/account code untouched;
- unresolved brief contradictions explicitly gated rather than guessed;
- each implementation batch independently reversible.

**Development principle:** if a change does not directly close a documented current-vs-expected gap, it is out of scope for this rollout.
