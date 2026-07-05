#!/usr/bin/env bash
# SportBuddy — preparar BD local o comprobar conexión Supabase
set -euo pipefail
cd "$(dirname "$0")/.."

echo "=== SportBuddy: setup base de datos ==="

if ! php -m | grep -qi pdo_pgsql; then
    echo "❌ Falta php8.3-pgsql. Ejecuta:"
    echo "   sudo apt install -y php8.3-pgsql php8.3-sqlite3"
    exit 1
fi

if [[ -z "$(grep '^DB_PASSWORD=' .env | cut -d= -f2-)" ]]; then
    echo "❌ DB_PASSWORD vacía en .env"
    echo "   Supabase → Project Settings → Database → Database password"
    exit 1
fi

php artisan config:clear
php artisan migrate --force
php artisan db:seed --force

echo ""
echo "✅ Base de datos migrada y con usuarios de prueba."
echo "   Admin:  admin@gmail.com / 12345678"
echo "   User:   enrique@gmail.com / 12345678"
