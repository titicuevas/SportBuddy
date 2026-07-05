# SportBuddy

Aplicación web para **organizar y encontrar partidos deportivos** (fútbol, pádel, baloncesto, etc.) y conectar con otros jugadores. Pensada como un “BlaBlaCar del deporte”: publicas un partido, otros se apuntan y coordináis pista, hora y ubicación.

**Stack:** Laravel 10 · PHP 8.2+ · Blade · Tailwind CSS · Vite · PostgreSQL (Supabase en producción)

---

## Qué incluye la app

### Usuarios
- Registro, login y verificación de email (Breeze)
- Dashboard con estadísticas y partidos próximos
- Listado de partidos disponibles e inscritos (con caché)
- Crear partido (ubicación, pista, deporte, hora, precio)
- Detalle de partido: mapa, clima (OpenWeather), inscripción/desapuntarse
- Chat por partido (jugadores inscritos + organizador)
- Comentarios en partidos
- Pago de pista con **PayPal** (redirección, no modal)
- Perfil de usuario y edición de cuenta

### Administración (`/admin`)
- Panel con estadísticas (usuarios, deportes, ubicaciones, superficies, pistas, partidos)
- CRUD de deportes, ubicaciones, superficies y pistas
- Gestión de usuarios
- Interfaz responsive (sidebar en escritorio, menú pantalla completa en móvil)

---

## Renovación 2026 (resumen de cambios)

| Área | Mejoras |
|------|---------|
| **UI/UX** | Landing, dashboard, tarjetas de partido, layout guest, footer, cookies |
| **Rendimiento** | Caché de partidos, estadísticas y clima; eager loading; índices en BD |
| **Admin** | Layout nuevo, formularios unificados, paginación corregida |
| **Chat** | Sistema por partido funcional (se eliminó código legacy roto) |
| **PayPal** | Flujo por redirección con `PayPalService` |
| **Tests** | 54 tests (auth, partidos, admin, mensajes, PayPal, clima…) |
| **Deploy** | `Dockerfile` para Railway + `railpack.json` de respaldo |

---

## Requisitos

- PHP 8.2+
- Composer
- Node.js 20+
- PostgreSQL **o** SQLite (recomendado en local)

---

## Instalación local

### Opción A — SQLite (recomendado, más rápido)

```bash
git clone https://github.com/titicuevas/SportBuddy.git
cd SportBuddy

cp .env.example .env
php artisan key:generate

# En .env:
# DB_CONNECTION=sqlite
# DB_DATABASE=/ruta/absoluta/a/SportBuddy/database/database.sqlite

touch database/database.sqlite
composer install
npm install && npm run build
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

En otra terminal (opcional, hot-reload de assets):

```bash
npm run dev
```

Abre [http://localhost:8000](http://localhost:8000).

**Script de ayuda:**

```bash
chmod +x scripts/setup-local.sh
./scripts/setup-local.sh
```

### Opción B — PostgreSQL / Supabase

Copia las credenciales de Supabase en `.env` (ver `.env.example`):

```env
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=...
DB_PASSWORD=...
DB_SSLMODE=require
```

> En desarrollo local, Supabase añade ~300 ms por consulta. Si la app se siente lenta, usa SQLite.

### Usuarios de prueba

Contraseña para todos: **`12345678`**

| Rol     | Email             |
|---------|-------------------|
| Admin   | admin@gmail.com   |
| Usuario | enrique@gmail.com |

El admin accede al panel desde el menú de usuario → **Modo Admin**.

---

## Variables de entorno

Plantilla completa en [`.env.example`](.env.example). Las más importantes:

| Variable | Uso |
|----------|-----|
| `APP_KEY` | `php artisan key:generate` |
| `APP_URL` | URL pública de la app |
| `DB_*` | Base de datos |
| `PAYPAL_CLIENT_ID`, `PAYPAL_CLIENT_SECRET`, `PAYPAL_MODE` | Pagos (sandbox o live) |
| `OPENWEATHER_API_KEY` | Pronóstico en detalle de partido |
| `MAIL_*` | Correo (en local: `MAIL_MAILER=log`) |
| `AUTO_VERIFY_EMAIL` | `true` en dev, `false` en producción |

### PayPal (sandbox)

1. Crea una app en el [Panel de desarrolladores de PayPal](https://developer.paypal.com/).
2. Copia Client ID y Secret en `.env`.
3. Usa `PAYPAL_MODE=sandbox` para pruebas.

### OpenWeather

1. Regístrate en [OpenWeather](https://openweathermap.org/api).
2. Añade la API key en `OPENWEATHER_API_KEY`.

---

## Tests

```bash
php artisan test
```

Suite actual: **54 tests** (auth, dashboard, partidos, admin, mensajes, PayPal mockeado, clima mockeado, modelos…).

---

## Despliegue en Railway

El proyecto incluye un **`Dockerfile`** que Railway detecta automáticamente. Usa PHP 8.2 preinstalado (no compila PHP con mise/railpack).

1. Conecta el repo de GitHub a Railway.
2. En **Settings → Build**, confirma que el builder es **Dockerfile**.
3. Configura las variables de entorno (mínimo):

```env
APP_KEY=base64:...          # obligatorio
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.up.railway.app

DB_CONNECTION=pgsql         # obligatorio (no uses mysql)
DB_HOST=...                 # host del pooler Supabase
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=...
DB_PASSWORD=...
DB_SSLMODE=require

TRUSTED_PROXIES=*

PAYPAL_CLIENT_ID=...
PAYPAL_CLIENT_SECRET=...
PAYPAL_MODE=sandbox

OPENWEATHER_API_KEY=...
```

> Si ves `could not find driver (Connection: mysql)` es que falta `DB_CONNECTION=pgsql` en Railway.

4. Despliega. El contenedor ejecuta migraciones y cachea config/rutas/vistas al arrancar.

**Respaldo:** si Railway usa Railpack en lugar del Dockerfile, `railpack.json` incluye las dependencias de compilación (`bison`, `re2c`, etc.).

**Subir variables desde tu `.env` local** (no commitees secretos):

```bash
npm i -g @railway/cli
railway login
railway link
./scripts/railway-sync-env.sh https://TU-APP.up.railway.app
```

---

## Estructura relevante

```
app/
  Http/Controllers/     # Partidos, PayPal, Admin, Dashboard…
  Services/             # PayPal, Weather, Stats, Mensajes
  Models/               # Partido, Ubicacion, Deporte, Pista…
resources/views/
  components/           # partido-card, administrador, admin-form-card…
  admin/                # Panel de administración
  partidos/             # Listado, crear, detalle
tests/                  # Feature + Unit
Dockerfile              # Despliegue Railway
```

---

## Autores

**Enrique Cuevas García** — Proyecto final DAW, curso 2023/24.

---

## Licencia

MIT (ver `composer.json`).
