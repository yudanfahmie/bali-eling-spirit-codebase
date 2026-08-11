# Contributing — Bali Eling Spirit

This repository contains both migration evidence/tooling and the production-deployable BES site-core plugin. Keep those concerns separate.

## Canonical production plugin path

All custom BES runtime code that is migrated from WPCodeBox must live under:

```text
plugin/bali-eling-spirit-site-core/
├── bali-eling-spirit-site-core.php
├── assets/
├── src/
└── templates/
```

Do not create a second production plugin path such as `plugins/bali-eling-spirit-snippets/` or `plugins/bali-eling-spirit-core/`.

The existing `plugins/bali-eling-spirit-audit-engine/` directory is developer tooling only. It is not part of the site-core deployment payload.

## Migration principle

The site-core plugin is the version-controlled runtime home for BES custom snippets previously stored in WPCodeBox. It does not contain or replace WooCommerce, MasterStudy, Elementor, or other vendor source code.

Preserve existing routes, shortcode names, hooks, and behavior first. Refactor only after parity is proven.

## Phase 1 safety rule

During reverse engineering:

- keep the site-core entry file inert;
- do not load migrated runtime modules yet;
- do not disable WPCodeBox snippets;
- record exact shortcode/hook dependencies and cutover ownership first;
- treat Canva/DOCX as expectation evidence, not permission to rewrite unrelated working surfaces.

## Cutover discipline

Each migrated unit follows:

```text
WPBOX_ONLY -> PLUGIN_SHADOW -> PLUGIN_LIVE -> WPBOX_OFF
```

Never allow the same shortcode/function/hook module to execute from both WPCodeBox and the site-core plugin.

## Deployment

cPanel deploys only `plugin/bali-eling-spirit-site-core/` using the root `.cpanel.yml` file. See `docs/deployment.md`.

Do not place audit exports, Canva source files, migration notes, or WPCodeBox archives inside the deployable plugin directory.

## Validation before a runtime change is marked ready

At minimum:

1. run PHP syntax checks on all changed PHP files;
2. verify no duplicate function/constant/shortcode registration;
3. verify the existing WordPress route and shortcode contract still resolve;
4. smoke-test desktop and mobile for touched public surfaces;
5. regression-test vendor flows when a migrated snippet previously hooked WooCommerce/MasterStudy;
6. document the exact WPCodeBox counterpart that becomes safe to disable.

## Scope control

Prefer `KEEP -> PATCH -> ADAPT -> NEW -> DEFER` in that order.

Do not introduce a second navigation engine, broad global CSS fixes for local problems, vendor source edits, unnecessary route changes, or new client copy that is not present in the approved brief.
