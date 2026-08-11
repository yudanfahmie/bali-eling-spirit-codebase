=== Bali Eling Spirit Audit Engine ===
Requires at least: 6.0
Requires PHP: 8.0
Stable tag: 0.2.2

Developer-only current-state audit engine for the Bali Eling Spirit WordPress refactor.

== Usage ==
1. Install/activate the plugin.
2. Open Tools > BES Audit Engine.
3. Keep “Include full page content + menu-linked content + WPCodeBox snippet code” enabled for migration work.
4. Click Generate Audit Bundle.
5. Download the ZIP/JSON when the thin progress bar completes.

== Captured ==
* WordPress/runtime/theme fundamentals.
* Full WordPress page hierarchy, templates, blocks, shortcodes and common builder signals.
* Other public post types are summarized by type/count instead of bulk-loading entire WooCommerce/LMS catalogs.
* Menu-linked non-page content is captured when migration code is enabled.
* Menus, locations, items and destination objects.
* Active plugin inventory, WooCommerce page mapping and LMS signals.
* Runtime-registered shortcode callbacks.
* WPCodeBox tables using the current WordPress prefix: wpcb_snippets and wpcb_folders.
* Menu -> content -> shortcode relationship map and published pages absent from menus.

== Robustness ==
* Audit phases run sequentially over AJAX instead of one long request.
* Each audit request has a 120-second browser-side safety timeout.
* HTTP 502/503/504 receives one automatic retry; other errors stop cleanly.
* Generated audit bundles expire after 2 hours and are cleaned opportunistically on subsequent admin/audit/download requests.
* A generated bundle can be downloaded repeatedly until it expires.
* Download requires an authenticated administrator but no separate download nonce.
* ZIP creation is verified and automatically falls back to JSON if ZIP creation is unavailable or fails.
* Temporary audit storage gets index/.htaccess guards where supported.
* Older HTML-escaped audit links remain compatible.

== Safety ==
The plugin is export-only and does not mutate pages, menus, snippets, orders, customers or LMS data. It does not export database credentials, WordPress auth salts, users, sessions or WooCommerce order/customer records. Secret-like WPCodeBox columns are omitted. Snippet source itself is preserved when migration code is enabled, because modifying code could break parity. Bundles remain available for repeated admin downloads for up to 2 hours, then are removed automatically on the next cleanup opportunity.
