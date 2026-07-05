#!/usr/bin/env bash
set -euo pipefail

# Railway/Supabase: si solo viene DATABASE_URL de Postgres, forzar pgsql
if [ -z "${DB_CONNECTION:-}" ] && [ -n "${DATABASE_URL:-}" ]; then
    case "${DATABASE_URL}" in
        postgres:*|postgresql:*)
            export DB_CONNECTION=pgsql
            ;;
    esac
fi

DB_CONNECTION="${DB_CONNECTION:-pgsql}"

if [ "$DB_CONNECTION" = "mysql" ] && ! php -m 2>/dev/null | grep -q pdo_mysql; then
    echo "ERROR: DB_CONNECTION=mysql pero esta imagen solo incluye pdo_pgsql (PostgreSQL)."
    echo "Configura en Railway: DB_CONNECTION=pgsql y las variables DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD."
    exit 1
fi

if [ "$DB_CONNECTION" = "pgsql" ] && ! php -m 2>/dev/null | grep -q pdo_pgsql; then
    echo "ERROR: DB_CONNECTION=pgsql pero falta la extensión pdo_pgsql."
    exit 1
fi

if [ -z "${APP_KEY:-}" ]; then
    echo "ERROR: Falta APP_KEY. Ejecuta 'php artisan key:generate --show' en local y añádela en Railway."
    exit 1
fi

echo "→ DB: ${DB_CONNECTION}"
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link --force 2>/dev/null || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
