# Bali Eling Spirit Site Core — Cutover Ledger

## Purpose

Explicit ownership control for BES custom runtime moved from WPCodeBox into `plugin/bali-eling-spirit-site-core/`.

States: `WPBOX_ONLY` → `PLUGIN_SHADOW` → `PLUGIN_LIVE` → `WPBOX_OFF`. The loader executes only `PLUGIN_LIVE` and `WPBOX_OFF`; Site Core never disables or rewrites WPCodeBox automatically.

## Current implementation state — Phase A–F + pre-UAT hardening

| Area | Site Core owner | State | Notes |
|---|---|---|---|
| Shared program/contact facts | `src/config/program-facts.php` | `PLUGIN_LIVE` | Canonical repeated routes and verified contact channels; unresolved fields remain null/gated. |
| Global Assets | `src/global/global-assets-fallback.php` → existing `src/global/global-assets.php` | `PLUGIN_SHADOW` | Existing Global Assets implementation stays byte-identical; the shadow wrapper only corrects fallback hierarchy/routes. Operational owner cutover remains UAT work. |
| Homepage | `src/homepage/homepage.php` | `PLUGIN_LIVE` | Approved card catalog, FAQ delta, canonical routes, footer delta. |
| Sanctuary | `src/sanctuary/*` | `PLUGIN_LIVE` | Four-category hub + approved related renderers. |
| Academy | `src/academy/*` | `PLUGIN_LIVE` | YTT catalog, Meditation, 100H gated surface, Sound Healing gated surface. |
| Pasraman | `src/pasraman/pasraman.php` | `PLUGIN_LIVE` | Four approved supplied programs; Program Komunitas deferred. |
| Phase F compatibility | `src/integration/phase-f-routes.php` | `PLUGIN_LIVE` | Keeps homepage/footer shortcode/action aliases without output-level route rewriting. |
| Site structure provisioner | `src/provisioning/site-structure.php` | bootstrap | Schema 3; shortcode-before-mutation gate, safe completion marker, code-only stale-version run, Menu 48 sync. |

## Canonical Menu 48 contract

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

Menu ID `48` remains authoritative. Academy remains structural; no `/academy/` page is provisioned merely for navigation. Global Assets fallback wrapper mirrors this hierarchy only when Menu 48 is empty.

## Canonical route decisions

- Sanctuary → `/sanctuary/`
- Healing & Therapy → `/healing-therapy/`
- Retreats → `/eling-sanctuary-retreat/`
- Tapa Brata → `/eling-tapa-brata/`
- Corporate Service → `/corporate-services/`
- Personal Session with Yogi → existing `/eling-guiding/` (title/body migrated explicitly; slug retained)
- Yoga Teacher Training → `/yoga-teacher-training/`
- Meditation → `/yoga-teacher-training/eling-meditation-course/`
- Sound Healing → `/eling-sound-healing-course/`
- 300H primary destination → `/program/300-hour-yoga-teacher-training/`
- Pasraman → `/pasraman/`

## Retained data gates

- Healing Retreat: `5 Hours` vs `08:00–14:00` remains neutral.
- 50H Hybrid language remains unresolved; no categorical public claim.
- Cancellation placeholder `[X hari]` must never be published.
- Contact channels remain route-specific; no global WhatsApp normalization.
- Corporate contact remains gated unless an approved source identifies ownership.
- Program Komunitas remains deferred.
- 100H, Sound Healing, and Pasraman descriptive additions remain source-gated where approved copy is unavailable.

## Global Assets cutover boundary

`global-assets` remains `PLUGIN_SHADOW`. Before changing ownership, operational UAT must confirm the WPCodeBox counterpart is disabled and validate desktop/mobile navigation, header/footer, account links, WooCommerce, MasterStudy-touched pages, and frontend PHP logs. Do not run both global owners simultaneously.

## Rollback

If a Site Core runtime module regresses: return it to `PLUGIN_SHADOW`, re-enable the exact legacy WPCodeBox counterpart if applicable, clear caches, and re-run UAT. No database rebuild or vendor-source edit is required.

## UAT status

Repository hardening is complete enough for deployment testing. **WordPress/browser UAT remains pending.**
