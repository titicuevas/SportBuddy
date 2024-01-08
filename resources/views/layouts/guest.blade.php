<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Cookie Banner Script -->
    <script>
        // Comprueba si las cookies de aceptación están presentes
        if (!document.cookie.includes("cookie_accepted=true")) {
            // Muestra el overlay y bloquea la interacción con la página
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("cookie-overlay").style.display = "block";
            });
        }

        // Función para aceptar las cookies
        function acceptCookies() {
            // Establece una cookie de aceptación que expira en 30 días
            document.cookie = "cookie_accepted=true; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000)
                .toUTCString();

            // Oculta el overlay
            document.getElementById("cookie-overlay").style.display = "none";
        }
    </script>
</head>

<body class="font-sans text-gray-900 antialiased">
    <!-- Cookie Overlay -->
    <div id="cookie-overlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 999; color: white; text-align: center; padding: 20px;">
        <p>Este sitio utiliza cookies para mejorar la experiencia del usuario. Al continuar, aceptas el uso de
            cookies.</p>
        <button onclick="acceptCookies()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Aceptar</button>

    </div>


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        {{ $slot }}
    </div>
</body>

</html>
