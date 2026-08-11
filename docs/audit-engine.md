# BES Current-State Audit Engine

## Purpose

The refactor starts by making the existing WordPress implementation observable. Bali Eling Spirit currently combines WordPress pages and menus, WooCommerce, an LMS, creative pages rendered through shortcodes, and renderer logic stored in WPCodeBox. The audit plugin captures those relationships before hierarchy or rendering behavior is changed.

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

The table schema is discovered at runtime rather than assuming specific columns. This is important because the audit should survive WPCodeBox schema changes.

With migration mode enabled, code-like fields are exported intact. With migration mode disabled, code-like values are replaced by their length and SHA-256 hash. Columns whose names look like passwords, tokens, secrets, licenses or private/API keys are omitted.

## UX / execution model

The admin experience is intentionally developer-first: one page, one primary action and one optional migration-code checkbox. The audit is executed as small sequential AJAX phases so the process avoids one long blocking request. A 3px progress bar advances through the real phases and each phase writes a JSON fragment to temporary server storage.

The final step packages all fragments into ZIP when `ZipArchive` is available, otherwise into one JSON file. The temporary audit directory is deleted immediately after download. If an AJAX phase fails, cleanup is attempted without adding another confirmation step.

## Data intentionally not captured

- WordPress database credentials or salts.
- WordPress user/password data.
- WooCommerce customers, orders, payment details or sessions.
- Arbitrary `wp_options` dumps.
- Password/token/secret/license/private-key-like WPCodeBox columns.

## Recommended migration sequence

1. Install and run this audit engine on the current site or staging clone.
2. Keep the resulting audit bundle outside this public repository unless the repository is made private.
3. Use `07-relationships.json` as the current information-architecture graph.
4. Map the incoming Canva client brief against that graph.
5. Classify WPCodeBox snippets into renderer/shortcode, PHP service, hook, asset, integration and obsolete code.
6. Move active behavior into a first-party Bali Eling Spirit plugin under version control.
7. Preserve shortcode names initially to keep current pages functional while implementation moves out of WPCodeBox.
8. Refactor shortcode APIs/page hierarchy only after behavior parity is verified.
9. Remove the WPCodeBox runtime dependency after the new plugin owns all required behavior.

## Target plugin architecture after audit

A sensible first-party plugin can evolve toward:

```text
bali-eling-spirit-core/
  bali-eling-spirit-core.php
  src/
    Shortcodes/
    Renderers/
    LMS/
    WooCommerce/
    Integrations/
    Assets/
    Support/
  assets/
  templates/
```

The first migration milestone should be behavioral parity, not aesthetic cleanup. Once snippets are version-controlled modules, the renderer can then be refactored safely alongside the new hierarchy and Canva design flow.
