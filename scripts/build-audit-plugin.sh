#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PLUGIN="bali-eling-spirit-audit-engine"
SRC="$ROOT/plugins/$PLUGIN"
DIST="$ROOT/dist"
VERSION="$(sed -n 's/^[[:space:]]*\*[[:space:]]*Version:[[:space:]]*//p' "$SRC/$PLUGIN.php" | head -n 1 | tr -d '\r')"

if [[ -z "$VERSION" ]]; then
  echo "Could not determine plugin version." >&2
  exit 1
fi

OUT="$DIST/$PLUGIN-v$VERSION.zip"
mkdir -p "$DIST"
rm -f "$OUT"

cd "$ROOT/plugins"
zip -qr "$OUT" "$PLUGIN" -x "*/.DS_Store" "*/.git/*"

echo "Built: $OUT"
unzip -t "$OUT"
