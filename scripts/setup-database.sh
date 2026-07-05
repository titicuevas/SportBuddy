#!/usr/bin/env bash
# SportBuddy — configuración de base de datos
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

info()  { echo -e "${GREEN}▸${NC} $*"; }
warn()  { echo -e "${YELLOW}▸${NC} $*"; }
error() { echo -e "${RED}✖${NC} $*"; exit 1; }

need_extension() {
    php -m 2>/dev/null | grep -qi "^$1$" || return 0
    return 1
}

check_php_drivers() {
    local missing=()
    need_extension "pdo_sqlite" && missing+=("php8.3-sqlite3")
    need_extension "pdo_pgsql"  && missing+=("php8.3-pgsql")

    if ((${#missing[@]} > 0)); then
        warn "Faltan extensiones PHP: ${missing[*]}"
        echo ""
        echo "  Instálalas con:"
        echo "    sudo apt update && sudo apt install -y ${missing[*]}"
        echo ""
        echo "  Luego vuelve a ejecutar este script."
        exit 1
    fi
}

use_sqlite() {
    info "Configurando SQLite local..."
    if [[ -f .env ]]; then
        sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
        grep -q '^DB_DATABASE=' .env \
            && sed -i 's|^DB_DATABASE=.*|DB_DATABASE=database/database.sqlite|' .env \
            || echo 'DB_DATABASE=database/database.sqlite' >> .env
    fi
    touch database/database.sqlite
}

use_docker_postgres() {
    info "Levantando PostgreSQL con Docker..."
    command -v docker >/dev/null 2>&1 || error "Docker no está instalado."

    export DB_CONNECTION=pgsql
    export DB_HOST=127.0.0.1
    export DB_PORT=5432
    export DB_DATABASE=sportbuddy
    export DB_USERNAME=postgres
    export DB_PASSWORD=postgres

    docker compose up -d postgres

    info "Esperando a que PostgreSQL esté listo..."
    for i in {1..30}; do
        docker compose exec -T postgres pg_isready -U postgres -d sportbuddy >/dev/null 2>&1 && break
        sleep 1
    done

    if [[ -f .env ]]; then
        sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=pgsql/' .env
        sed -i 's/^#*DB_HOST=.*/DB_HOST=127.0.0.1/' .env
        sed -i 's/^#*DB_PORT=.*/DB_PORT=5432/' .env
        sed -i 's/^#*DB_DATABASE=.*/DB_DATABASE=sportbuddy/' .env
        sed -i 's/^#*DB_USERNAME=.*/DB_USERNAME=postgres/' .env
        sed -i 's/^#*DB_PASSWORD=.*/DB_PASSWORD=postgres/' .env
        grep -q '^DB_SSLMODE=' .env || echo 'DB_SSLMODE=prefer' >> .env
        sed -i 's/^DB_SSLMODE=.*/DB_SSLMODE=prefer/' .env
    fi
}

use_supabase() {
    info "Configuración Supabase (PostgreSQL en la nube)"
    echo ""
    echo "  1. Crea un proyecto gratis en https://supabase.com"
    echo "  2. Ve a Project Settings → Database → Connection string (URI)"
    echo "  3. Usa la conexión DIRECTA (puerto 5432), no el pooler para migrar"
    echo ""
    read -rp "  Host (ej: db.xxxxx.supabase.co): " SB_HOST
    read -rp "  Contraseña de la base de datos: " -s SB_PASS
    echo ""
    read -rp "  Base de datos [postgres]: " SB_DB
    SB_DB=${SB_DB:-postgres}

    if [[ -f .env ]]; then
        sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=pgsql/' .env
        sed -i "s|^#*DB_HOST=.*|DB_HOST=${SB_HOST}|" .env
        sed -i 's/^#*DB_PORT=.*/DB_PORT=5432/' .env
        sed -i "s|^#*DB_DATABASE=.*|DB_DATABASE=${SB_DB}|" .env
        sed -i 's/^#*DB_USERNAME=.*/DB_USERNAME=postgres/' .env
        sed -i "s|^#*DB_PASSWORD=.*|DB_PASSWORD=${SB_PASS}|" .env
        grep -q '^DB_SSLMODE=' .env || echo 'DB_SSLMODE=require' >> .env
        sed -i 's/^DB_SSLMODE=.*/DB_SSLMODE=require/' .env
    fi
}

migrate_and_seed() {
    php artisan config:clear
    php artisan migrate:fresh --seed --force
    info "Base de datos lista con usuarios de prueba."
    echo ""
    echo "  Admin:  admin@gmail.com / 12345678"
    echo "  User:   enrique@gmail.com / 12345678"
}

echo ""
echo "╔══════════════════════════════════════╗"
echo "║   SportBuddy — Setup base de datos   ║"
echo "╚══════════════════════════════════════╝"
echo ""
echo "  1) SQLite local (rápido, solo desarrollo)"
echo "  2) PostgreSQL con Docker (recomendado en local)"
echo "  3) Supabase (recomendado para demo / TFG / producción)"
echo ""
read -rp "Elige opción [2]: " CHOICE
CHOICE=${CHOICE:-2}

check_php_drivers

case "$CHOICE" in
    1) use_sqlite ;;
    2) use_docker_postgres ;;
    3) use_supabase ;;
    *) error "Opción no válida" ;;
esac

migrate_and_seed
