#!/usr/bin/env bash
# Configura SportBuddy con SQLite local (desarrollo rápido, sin latencia de Supabase).
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
DB_FILE="$ROOT/database/database.sqlite"

echo "→ Creando base de datos SQLite en database/database.sqlite"
touch "$DB_FILE"

ENV_FILE="$ROOT/.env"
if [[ ! -f "$ENV_FILE" ]]; then
  cp "$ROOT/.env.example" "$ENV_FILE"
  echo "→ Creado .env desde .env.example"
fi

# Sustituir bloque DB por SQLite (solo si el usuario confirma o no hay DB_PASSWORD)
if grep -q '^DB_CONNECTION=pgsql' "$ENV_FILE" 2>/dev/null; then
  echo ""
  echo "Tu .env usa PostgreSQL/Supabase. Para desarrollo local rápido, cambia manualmente:"
  echo ""
  echo "  DB_CONNECTION=sqlite"
  echo "  DB_DATABASE=$DB_FILE"
  echo ""
  echo "(Comenta o elimina DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD, DB_SSLMODE)"
  echo ""
fi

cd "$ROOT"
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link 2>/dev/null || true

echo ""
echo "✓ Listo. Ejecuta: php artisan serve"
echo "  Usuarios de prueba (contraseña: 12345678):"
echo "    Admin: admin@gmail.com"
echo "    Usuario: enrique@gmail.com"
