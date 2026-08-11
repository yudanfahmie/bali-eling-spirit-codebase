# Bali Eling Spirit Site Core — Cutover Ledger

## Purpose

This ledger is the explicit ownership control for BES custom runtime moved from WPCodeBox into `plugin/bali-eling-spirit-site-core/`.

Allowed states:

- `WPBOX_ONLY` — WPCodeBox remains authoritative; no replacement source is present in Site Core. Site Core does not execute the module.
- `PLUGIN_SHADOW` — replacement source exists in Site Core but the loader does not execute it.
- `PLUGIN_LIVE` — Site Core owns and executes the runtime module during cutover validation, after the exact WPCodeBox counterpart has been disabled.
- `WPBOX_OFF` — Site Core continues executing the runtime module and the legacy WPCodeBox counterpart has been confirmed inactive. This is the terminal ownership state; it does **not** stop the Site Core module.

The loader executes only `PLUGIN_LIVE` and `WPBOX_OFF`. `WPBOX_ONLY`, `PLUGIN_SHADOW`, unknown states, malformed states and missing states remain fail-closed and are never executed.

The Site Core plugin never disables, deletes, rewrites, or mutates WPCodeBox automatically.

## Current Batch A ownership

| Module | WPCodeBox owner | Site Core source | State | Runtime owner now |
|---|---|---|---|---|
| Global Assets | `#24 Global Assets (Preloader, Header, Footer)` | `src/global/global-assets.php` | `PLUGIN_SHADOW` | WPCodeBox #24 |

The shadow source is copied unchanged from `docs/old-snippet-implementation-wpcodebox/balielingspirit-com-Global Assets (Preloader, Header, Footer).php`. The module manifest is the executable gate: `src/modules.php`. Global Assets remains deliberately inert while it is `PLUGIN_SHADOW`.

## Global Assets ownership map

WPCodeBox #24 is an enabled, always-running PHP snippet. Its existing public behavior includes:

- global design tokens, fonts, Tailwind runtime, Font Awesome, Splide CSS and shared CSS;
- `wp_head` global output;
- route-scoped WooCommerce cart/checkout body classes and presentation CSS;
- WooCommerce cart/checkout DOM classification/empty-state presentation and ornament output;
- global preloader on `wp_body_open`;
- adaptive fixed header on `wp_body_open`;
- WordPress Menu ID `48` lookup and parent/child desktop + mobile rendering;
- logged-in/logged-out header and mobile account links;
- global footer using Menu ID `48` with fallback data;
- global frontend JS for header contrast detection, scrolling, mobile drawer, desktop touch dropdowns, mobile submenu accordion, active-link treatment, and reveal utilities.

No shortcode is registered by this module. The runtime shortcode inventory therefore stays WPCodeBox/vendor-owned in Batch A.

## Navigation ownership and Batch A boundary

Menu ID `48` remains the authoritative navigation data source. Site Core does not create a second menu, register a replacement renderer, or mutate WordPress menu rows on activation.

Approved target hierarchy:

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

Verified route strategy from the revision plan:

- Sanctuary → existing `/sanctuary/`.
- Academy → structural parent; no `/academy/` page is to be created merely for navigation.
- Healing & Therapy → future approved `/healing-therapy/` surface.
- Retreats → the existing Eling Sanctuary Retreat route while it is the sole approved retreat catalog entry.
- Tapa Brata → current active route; duplicate cleanup is deferred.
- Corporate Service → future approved `/corporate-services/` surface.
- Yoga Teacher Training → existing `/yoga-teacher-training/`.
- Eling Meditation Course → existing meditation course route.
- Eling Sound Healing Course → future approved `/eling-sound-healing-course/` surface.
- Pasraman, Partnership and Wisdom → existing routes.

The audited Menu ID `48` does not yet contain the complete approved hierarchy. The current Global Assets fallback also contains legacy flat links, including `/academy`. Those are **cutover blockers**, not reasons to mutate production data in Batch A. The renderer already supports parent/child Menu 48 data; the actual menu and fallback should be patched only when the required later-batch routes exist and the result can be exercised in runtime.

**Navigation phase status:** renderer capability = ready; production menu data = deferred until destination routes are real. This does not block later content-batch development and does not authorize dummy routes, dead `#` CTAs, or premature Menu 48 changes.

## Cutover procedure for Global Assets

Do not change `global-assets` to `PLUGIN_LIVE` until every item below is true:

1. Re-read current `main` and confirm the shadow source still matches the intended WPCodeBox owner.
2. Confirm WPCodeBox snippet #24 is the exact active counterpart.
3. Update Menu ID `48` to the approved hierarchy without creating a second navigation system.
4. Patch the fallback in the canonical Global Assets owner only after all fallback destinations are real and verified.
5. Resolve structural Academy-parent behavior so `#` is not a dead navigation CTA.
6. Disable WPCodeBox snippet #24 manually/operationally.
7. Change the module state to `PLUGIN_LIVE` in one focused Site Core change. Site Core now owns and executes the module during cutover validation.
8. Validate desktop + mobile navigation, header/footer, account links, Woo cart/checkout, LMS-touched pages, and frontend PHP logs.
9. Change the ownership state to `WPBOX_OFF` only after the old snippet is confirmed inactive and parity is verified. Site Core continues executing the module in this terminal state.

Never perform steps 6 and 7 in reverse order; that would create duplicate global functions/hooks.

## Rollback

If any regression appears while a module is in either `PLUGIN_LIVE` or `WPBOX_OFF`:

1. Change the module back to `PLUGIN_SHADOW` so Site Core stops loading it.
2. Re-enable the exact legacy WPCodeBox counterpart.
3. Clear relevant page/cache layers.
4. Re-run the regression checks before attempting another cutover.

Rollback order is therefore:

```text
WPBOX_OFF / PLUGIN_LIVE
→ PLUGIN_SHADOW
→ re-enable exact legacy WPCodeBox counterpart
```

Never run both implementations simultaneously. No database rebuild, vendor modification, route rewrite, or plugin reinstall is required for this rollback path.

## Data gates retained

Batch A does not resolve these source contradictions:

- Healing Retreat duration (`5 Hours`) versus `08:00–14:00` schedule.
- 50H Hybrid language (`Bahasa Indonesia` versus `Indonesia / English`).
- cancellation FAQ placeholder `[X hari]`.
- multiple WhatsApp/contact routes with unresolved ownership.
- Program Komunitas lacking complete approved copy.

## Batch A validation boundary

Repository validation can prove that the loader fails closed and that the shadow module is not double-registered. It cannot prove live WordPress parity without staging/production execution. Until that runtime exercise exists, Global Assets intentionally remains `PLUGIN_SHADOW`.

## Phase status

```text
Batch A: ENGINEERING COMPLETE / SHADOW READY
Production cutover: PENDING
```

The loader architecture, ownership ledger, exact Global Assets shadow replacement and deployment contract are ready. Duplicate runtime is prevented by keeping Global Assets in `PLUGIN_SHADOW` while WPCodeBox #24 remains the runtime owner. It is safe to begin Batch B development after this engineering closure, but Global Assets production ownership has **not** been switched from WPCodeBox.
