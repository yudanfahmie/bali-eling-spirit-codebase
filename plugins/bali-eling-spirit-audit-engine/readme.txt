=== Bali Eling Spirit Audit Engine ===
Requires at least: 6.0
Requires PHP: 7.4
Stable tag: 0.1.0

Developer-only current-state audit engine for the Bali Eling Spirit WordPress refactor.

== Usage ==
1. Install/activate the plugin.
2. Open Tools > BES Audit Engine.
3. Keep “Include full page content + WPCodeBox snippet code” enabled for migration work.
4. Click Generate Audit Bundle.
5. Download the ZIP/JSON when the thin progress bar completes.

== Captured ==
* WordPress/runtime/theme fundamentals.
* Public pages/post types, parent hierarchy, templates, blocks, shortcodes and common builder signals.
* Menus, locations, items and destination objects.
* Active plugin inventory, WooCommerce page mapping and LMS signals.
* Runtime-registered shortcode callbacks.
* WPCodeBox tables using the current WordPress prefix: wpcb_snippets and wpcb_folders.
* Menu -> content -> shortcode relationship map and published pages absent from menus.

== Safety ==
The plugin is export-only and does not mutate pages, menus, snippets, orders, customers or LMS data. It does not export database credentials, WordPress auth salts, users, sessions or WooCommerce order/customer records. Secret-like WPCodeBox columns are omitted. Temporary files are removed after download.
