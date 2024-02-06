<img src="https://i.ibb.co/ncgYQk4/1d241c09-0831-4925-9103-a5d6cccf059e.jpg" alt="1d241c09-0831-4925-9103-a5d6cccf059e" border="0">


 SportBuddy  
 
 Enrique Cuevas Garcia  
 
 Curso 2023/24
 
 # Descripción general del proyecto

SportBuddy es una aplicación diseñada para que los usuarios encuentren partidos de diferentes deportes y conozcan a nuevas personas para jugar esos partidos juntos. En SportBuddy, los usuarios pueden crear eventos deportivos y buscar compañeros para participar en ellos.

## Funcionalidad principal de la aplicación

El propósito principal de nuestra aplicación es facilitar la conexión entre usuarios interesados en realizar actividades deportivas en conjunto. Un usuario tiene la capacidad de crear eventos deportivos específicos, tales como "Partido de fútbol el martes por la tarde", y otros usuarios pueden inscribirse para participar en dichos eventos. Además del fútbol, la aplicación también admite una variedad de deportes como baloncesto, pádel, running y ciclismo. En esencia, nuestra aplicación se asemeja a Blablacar, pero está orientada específicamente a la organización y participación en eventos deportivos.


## Objetivos generales

    Objetivo: "Crear eventos para hacer deporte con diferentes personas".

    Casos de uso:

        Invitado : "registrarse", "ver eventos","ver competiciones".

        Usuarios: "iniciar sesion","cerrar sesion","crear evento","apuntarse al evento","editar perfil","borrar cuenta","buscar otros usuarios".

        Administrador: "iniciar sesion","cerrar sesion","crear evento","modificar el evento","modificar perfiles de usuarios","eliminar un usuario","borrar comentarios".

# Elemento de innovación

Implementar un mapa donde concrete el lugar exacto del evento,pago a traves de PayPal y tiempo de la ubicacion.

# Instrucciones de instalacion

¡Te damos la bienvenida al proyecto SportBuddy! A continuación, encontrarás instrucciones detalladas para configurar y desplegar el proyecto en tu entorno local.

Paso 1: Clonar proyecto e instalar la base de datos

```bash 
git clone https://github.com/titicuevas/SportBuddy
```



# Instalar PostgreSQL
```bash 
sudo apt install postgresql postgresql-client postgresql-contrib
```

Antes de proceder con las migraciones, es importante verificar que la base de datos PostgreSQL esté configurada correctamente. Asegúrate de haber creado un usuario nuevo y una base de datos para este propósito.

Ejecuta el siguiente comando para crear un nuevo usuario (serás solicitado a ingresar una contraseña para el nuevo usuario): 
```bash 
sudo -u postgres createuser -P enrique2
```
Crea una nueva base de datos asignada a este usuario ejecutando: 
```bash 
sudo -u postgres createdb -O enrique2 pruebaFinal
```
La contraseña que vamos a establecer es: enrique2

Paso 2 : Instalar composer y npm 
```bash 
sudo apt install composer
```

```bash 
sudo apt install npm
```

Paso 3 : Configuracion del proyecto

1. Antes de generar la clave, asegúrate de copiar el ejemplo del contenido del archivo .env que se muestra a continuación. Este archivo ya contiene algunas configuraciones predefinidas (excepto aquellas relacionadas con Paypal y Mailtrap).

.env.example que nos trae el fichero y dejarlo como .env

2.
```bash 
php artisan key:generate
```
3.Después de haber configurado el archivo .env, procede a ejecutar las migraciones de la base de datos:

```bash
 php artisan migrate
 ```
 4.Ejecutaremos los seeders que tenemos en la base de datos:

 ```bash
 php artisan db:seed
 ```

5. Si prefieres hacer las 2 cosas seguidas puedes usar este comando tambien. 

```bash
php artisan migrate:refresh --seed
```

## Configuracion del fichero `.env` editandolo a gusto del usuario.


```plaintext

APP_NAME=SportBuddy
APP_ENV=local
APP_KEY=base64:NIzI0H9p1HGQN0K1K2SAP5uc/fKHN7le9jvaoRKFY/c=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pruebaFinal
DB_USERNAME=enrique2
DB_PASSWORD=enrique2

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

Paypal Login Editar por el usuario

PAYPAL_CLIENT_ID=
PAYPAL_CLIENT_SECRET=

Editado email con mailtrap  por el usuario

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

Laravel Socket

LARAVEL_WEBSOCKETS_PORT=6001
LARAVEL_WEBSOCKETS_SSL=false


Editar por el usuario

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

**Para obtener la configuración necesaria para integrar PayPal en tu proyecto, incluyendo las credenciales API (Client ID y Secret), sigue estos pasos:

    1. Crea una cuenta PayPal.

   2. Accede al Panel de Desarrollador de PayPal. Aquí podrás gestionar tus aplicaciones y obtener las credenciales API necesarias.
        Para obtener tus credenciales API, primero necesitas crear una aplicación en el Panel de Desarrollador:
            Haz clic en "Crear Aplicación". Serás llevado a una página donde puedes nombrar tu nueva aplicación. El nombre que elijas te ayudará a identificar la aplicación en tu panel, pero no afecta la funcionalidad de la API.
            Selecciona la cuenta sandbox asociada que deseas usar para pruebas. PayPal proporciona cuentas sandbox que simulan el entorno de pago en vivo para pruebas de desarrollo.

    Obten tus Credenciales API

Una vez que hayas creado tu aplicación, serás redirigido a la página de detalles de la aplicación, donde encontrarás tus credenciales API. Inclúyelas en tu archivo .env de la siguiente manera:

PAYPAL_CLIENT_ID=
PAYPAL_SECRET=

**Para obtener la configuración necesaria para integrar Mailtrap en tu proyecto, sigue estos pasos:

    1.Crea una cuenta en Mailtrap si aún no tienes una.

    2.Inicia sesión en tu cuenta de Mailtrap.
    
    3.En el dashboard, haz clic en "SMTP Settings" en el menú lateral izquierdo.
    
    4.Copia el nombre de host, el puerto, el nombre de usuario y la contraseña proporcionados en la sección "SMTP Settings" de Mailtrap.
    
    5.Estas credenciales las puedes incluir en tu archivo .env de la siguiente manera:
    ```bash
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=tu_usuario_de_mailtrap
    MAIL_PASSWORD=tu_contraseña_de_mailtrap
    MAIL_ENCRYPTION=tls
    ```
# Ejecutar la aplicacion.

1. Ejecuta el comando `php artisan serve` para iniciar el servidor de desarrollo y `npm run dev` para el diseño.
2. Acceder a la aplicación en `http://localhost:8000`.
