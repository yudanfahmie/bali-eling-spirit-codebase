# BES Site Core — cPanel Deployment Contract

## Deployable surface

Only this directory is production-deployable:

```text
plugin/bali-eling-spirit-site-core/
```

Repository evidence/tooling such as `docs/`, Canva assets, WPCodeBox archives, audit bundles, and `plugins/bali-eling-spirit-audit-engine/` must not be copied into WordPress production by the cPanel deployment task.

## Repository contract

```text
repo/
├── .cpanel.yml
└── plugin/
    └── bali-eling-spirit-site-core/
        ├── bali-eling-spirit-site-core.php
        ├── assets/
        ├── src/
        └── templates/
```

The root `.cpanel.yml` currently deploys to:

```text
/home/markascl/balielingspirit.com/wp-content/plugins/bali-eling-spirit-site-core/
```

If the production WordPress document root changes, deployment should change only `DEPLOYPATH` in `.cpanel.yml`. The repository plugin path and WordPress plugin folder name stay canonical.

## Deployment behavior

The cPanel task:

1. resolves the production plugin destination;
2. creates the destination directory when absent;
3. copies only the contents of `plugin/bali-eling-spirit-site-core/` into that destination.

The task intentionally does not deploy the entire repository.

## Current safety state

The site-core entry file now uses a fail-closed module loader. Modules in `PLUGIN_SHADOW` remain present in the repository but are not executed, so installing or activating Site Core must not replace or duplicate an active WPCodeBox runtime snippet.

Runtime modules may only be loaded after the cutover registry identifies the corresponding WPCodeBox snippet, the old counterpart is disabled, and the replacement is ready for parity validation.

## Operator cutover model

For a migrated batch:

```text
1. plugin code is complete and validated
2. exact old WPCodeBox counterparts are identified
3. operator disables only those counterparts
4. switch the matching site-core module to PLUGIN_LIVE and deploy/activate
5. smoke-test revised routes + regression surfaces
6. rollback if needed: return the module to PLUGIN_SHADOW and re-enable the old WPCodeBox counterpart
```

Do not use a database-wide restore as the normal rollback path.

## cPanel notes

cPanel Git deployment requires a checked-in root `.cpanel.yml`, at least one branch, and a clean repository state before deployment. The deployment commands are executed in sequence by cPanel Git Version Control.
