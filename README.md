# Bali Eling Spirit Codebase

Engineering repository for the Bali Eling Spirit WordPress restructure, Canva revision, and WPCodeBox → first-party plugin migration.

## Current objective

Reverse-engineer the current WordPress runtime, compare it against the approved Canva/DOCX brief, then move only the required BES custom snippets from WPCodeBox into the production site-core plugin while preserving existing shortcode/route behavior.

WooCommerce, MasterStudy, Elementor, and other vendor plugins remain vendor-owned. The BES plugin only becomes the version-controlled home for Bali Eling Spirit custom code that previously lived in WPCodeBox.

## Repository layout

```text
.cpanel.yml                         # cPanel deployment contract
CONTRIBUTING.md                     # development + cutover rules

plugin/
  bali-eling-spirit-site-core/      # ONLY production-deployable BES plugin
    bali-eling-spirit-site-core.php # intentionally inert before cutover
    assets/
    src/
    templates/

plugins/
  bali-eling-spirit-audit-engine/   # developer audit tooling; not site-core payload

scripts/
  build-audit-plugin.sh

.github/workflows/
  build-audit-plugin.yml

docs/
  deployment.md
  TASK-canva-revision-current-vs-expected.md
  audit-engine.md
  bali-eling-spirit-audit-20260811-061200/
  old-snippet-implementation-wpcodebox/
  CANVA - Salinan dari Web Bahasa Indonesia/
```

> `plugin/` (singular) is the canonical production deployment surface. Existing `plugins/` content is retained for tooling/history and must not be treated as the site-core deployment directory.

## Deployment

cPanel deploys only:

```text
plugin/bali-eling-spirit-site-core/
```

into the WordPress plugin folder configured by the root `.cpanel.yml`.

The default deployment target is:

```text
$HOME/public_html/wp-content/plugins/bali-eling-spirit-site-core/
```

If production uses another WordPress document root, change only `DEPLOYPATH` in `.cpanel.yml`. See [`docs/deployment.md`](docs/deployment.md).

## Phase 1 — reverse engineering first

Before runtime migration, validate:

- current WordPress pages/routes and shortcode contracts;
- exact WPCodeBox implementation file for every relevant shortcode/hook;
- global assets/header/footer dependencies;
- current Homepage vs Homepage v2 behavior;
- baseline → Canva/DOCX expectation delta;
- minimum initial migration set;
- duplicate/load-order/contact/data risks.

The site-core skeleton is intentionally inert during this phase. Do not disable WPCodeBox snippets yet.

## Cutover model

Each migrated runtime unit follows:

```text
WPBOX_ONLY -> PLUGIN_SHADOW -> PLUGIN_LIVE -> WPBOX_OFF
```

A module must never execute simultaneously from WPCodeBox and the site-core plugin.

The intended operator flow after implementation is validated:

```text
identify exact old snippets
→ disable only those WPCodeBox snippets
→ deploy/install/activate site-core
→ test revised surfaces + regressions
→ rollback by deactivating replacement and re-enabling old snippets if required
```

## Audit Engine

The separate **Bali Eling Spirit Audit Engine** captures the current WordPress implementation before migration. It exports environment, content, navigation, extension, shortcode, WPCodeBox and relationship data.

Build its installable ZIP with:

```bash
bash scripts/build-audit-plugin.sh
```

The audit engine and its build workflow are developer tooling and are not part of the cPanel site-core payload.

## Development contract

Read these before implementation:

- [`CONTRIBUTING.md`](CONTRIBUTING.md)
- [`docs/deployment.md`](docs/deployment.md)
- [`docs/TASK-canva-revision-current-vs-expected.md`](docs/TASK-canva-revision-current-vs-expected.md)
- [`docs/audit-engine.md`](docs/audit-engine.md)

The primary development rule is **reuse before rewrite**: preserve contracts, make the smallest verified delta, and keep every cutover independently reversible.
