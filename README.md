# Bali Eling Spirit Codebase

Engineering archive for the Bali Eling Spirit WordPress restructure and renderer migration.

## Current objective

Capture the current WordPress implementation before changing the client-facing hierarchy. The site combines WordPress pages/menus, WooCommerce, an LMS, creative pages rendered by shortcodes, and renderer logic currently managed in WPCodeBox.

## Repository layout

```text
plugins/
  bali-eling-spirit-audit-engine/   # developer current-state audit plugin
scripts/
  build-audit-plugin.sh             # packages an installable ZIP
.github/workflows/
  build-audit-plugin.yml            # syntax-check + ZIP artifact build
docs/
  audit-engine.md                   # audit contract + migration strategy
```

## Phase 1 — Current-state audit

Install the **Bali Eling Spirit Audit Engine**, activate it, then open:

**Tools → BES Audit Engine**

The UX is intentionally simple: one primary button, an optional migration-code checkbox, and a thin progress bar. Internally the audit runs as small sequential AJAX phases instead of one long request.

The bundle captures:

- WordPress/runtime/theme fundamentals;
- pages/public post types, hierarchy and templates;
- shortcode and builder usage per content item;
- WordPress menus and destination mapping;
- active plugins, WooCommerce page IDs and LMS signals;
- registered shortcode callbacks;
- WPCodeBox `wpcb_snippets` / `wpcb_folders` data using the current table prefix;
- a relationship map: **menu → page/content → shortcode/builder**.

For migration work, leave **Include full page content + WPCodeBox snippet code** enabled.

### Build an installable ZIP

```bash
bash scripts/build-audit-plugin.sh
```

The GitHub Actions workflow also builds the ZIP artifact automatically whenever the audit plugin changes, and can be run manually with `workflow_dispatch`.

> **Important:** this repository is currently public. Keep generated audit bundles containing real page content or WPCodeBox code outside this repository unless it is made private.

## Phase 2 — Client information architecture

The incoming Canva brief will be mapped against the current audit graph instead of rebuilding blindly. That makes it possible to classify existing pages/features as retain, move, consolidate, rename, replace or retire.

## Phase 3 — WPCodeBox → first-party plugin

The target is a version-controlled Bali Eling Spirit plugin containing the current renderer behavior as explicit modules instead of database-managed snippets. The migration should preserve current shortcode behavior first, then refactor internals once parity is confirmed.

See [`docs/audit-engine.md`](docs/audit-engine.md) for the audit bundle contract and recommended migration sequence.
