#!/usr/bin/env bash
# Wrapper: php scripts/railway-sync-env.php "$@"
exec php "$(dirname "$0")/railway-sync-env.php" "$@"
