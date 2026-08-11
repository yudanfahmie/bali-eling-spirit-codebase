#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PLUGIN="bali-eling-spirit-audit-engine"
SRC="$ROOT/plugins/$PLUGIN"
DIST="$ROOT/dist"
OUT="$DIST/$PLUGIN-v0.1.0.zip"

mkdir -p "$DIST"
rm -f "$OUT"
cd "$ROOT/plugins"
zip -qr "$OUT" "$PLUGIN" -x "*/.DS_Store"

echo "Built: $OUT"
unzip -t "$OUT"
