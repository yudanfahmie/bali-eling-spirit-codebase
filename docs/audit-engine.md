# BES Current-State Audit Engine

## Purpose

The refactor starts by making the existing WordPress implementation observable. Bali Eling Spirit currently combines WordPress pages and menus, WooCommerce, an LMS, creative pages rendered through shortcodes, and renderer/custom behavior stored in WPCodeBox. The audit plugin captures those relationships before hierarchy or rendering behavior is changed.

## Bundle layout

| File | Purpose |
|---|---|
| `00-manifest.json` | Audit metadata and export notes. |
| `01-environment.json` | WordPress, PHP, MySQL, theme and front-page fundamentals. |
| `02-content.json` | Public content, hierarchy, templates, shortcodes, Gutenberg blocks and builder fingerprints. |
| `03-navigation.json` | Menus, locations, menu items and linked WordPress objects. |
| `04-extensions.json` | Plugins, WooCommerce page mapping and LMS signals. |
| `05-shortcodes.json` | Runtime-registered shortcode tags and callback names. |
| `06-wpcodebox.json` | Dynamic WPCodeBox table schema and rows. |
| `07-relationships.json` | Menu → content → shortcode/builder map plus orphan-page summary. |

## WPCodeBox collection

The engine uses the current WordPress table prefix and checks for:

- `{prefix}wpcb_snippets`
- `{prefix}wpcb_folders`

The table schema is discovered at runtime rather than assuming specific columns. With migration mode enabled, code-like fields are exported intact. With migration mode disabled, code-like values are replaced by their length and SHA-256 hash. Columns whose names look like passwords, tokens, secrets, licenses or private/API keys are omitted.

## UX / execution model

The admin experience is intentionally developer-first: one page, one primary action and one optional migration-code checkbox. The audit executes as small sequential AJAX phases instead of one long blocking request.

The final step packages all fragments into ZIP when `ZipArchive` is available, otherwise into one JSON file. Generated bundles remain repeat-downloadable for up to two hours and stale audit bundles are cleaned opportunistically after expiry.

## Data intentionally not captured

- WordPress database credentials or salts.
- WordPress user/password data.
- WooCommerce customers, orders, payment details or sessions.
- Arbitrary `wp_options` dumps.
- Password/token/secret/license/private-key-like WPCodeBox columns.

## Recommended migration sequence

1. Run the audit engine on the current site/staging clone.
2. Treat the audit as runtime baseline and `docs/old-snippet-implementation-wpcodebox/` as implementation baseline.
3. Cross-map Canva/DOCX expectation against the actual page → shortcode → snippet graph.
4. Reverse-engineer shortcode, hook, global-asset and cross-snippet dependencies before moving code.
5. Classify every relevant snippet as KEEP, PATCH/ADAPT, MIGRATE NOW, DEPENDENCY, LEGACY, PREVIEW ONLY or DEFER.
6. Move only validated BES custom behavior into the canonical site-core plugin.
7. Preserve existing shortcode/route contracts during initial migration.
8. Disable a WPCodeBox counterpart only after its plugin replacement is ready and validated.
9. Refactor internals only after parity and client-facing revision are stable.

## Canonical production plugin architecture

Deployment requires this repository path:

```text
plugin/
  bali-eling-spirit-site-core/
    bali-eling-spirit-site-core.php
    assets/
    src/
    templates/
```

The site-core plugin is the runtime home for **BES custom snippets migrated from WPCodeBox**. It is not a copy or replacement of WooCommerce, MasterStudy, Elementor, or other vendor plugins. A BES snippet may hook those vendors, but vendor source remains external.

The existing `plugins/bali-eling-spirit-audit-engine/` folder remains separate developer tooling and is not part of the cPanel site-core deployment payload.

The first migration milestone is behavioral parity and precise client-delta implementation, not broad architectural cleanup.
