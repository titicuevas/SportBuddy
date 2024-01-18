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
            // Muestra el overlay oscuro y bloquea la interacción con la página
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("dark-overlay").style.display = "block";
                document.getElementById("cookie-overlay").style.display = "block";
            });
        }

        // Función para aceptar las cookies
        function acceptCookies() {
            // Establece una cookie de aceptación que expira en 30 días
            document.cookie = "cookie_accepted=true; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000)
                .toUTCString();

            // Oculta el overlay oscuro y el banner de cookies
            document.getElementById("dark-overlay").style.display = "none";
            document.getElementById("cookie-overlay").style.display = "none";
        }
    </script>
</head>

<body class="font-sans text-gray-900 antialiased">
   
    {{ $slot }}
    </div>
</body>

<!-- Footer -->
<footer class="mt-auto bg-white text-black p-4">
    <div class="container mx-auto text-center">
        <p>&copy; {{ date('Y') }} SportBuddy</p>
        <p>Creado por: Enrique Cuevas Garcia</p>

        <!-- Iconos de redes sociales -->
        <div class="flex justify-center mt-4">

            <a href="https://twitter.com/" class="mx-2"><img src="https://i.ibb.co/RzXRD4d/gorjeo-2.png"
                    alt="gorjeo-2" border="0"></a>

            <a href="https://www.facebook.com/" class="mx-2"><img src="https://i.ibb.co/dBTPDBm/instagram-1.png"
                    alt="instagram-1" border="0"></a>
            <a href="https://www.instagram.com/" class="mx-2"><img src="https://i.ibb.co/wCtRTFr/facebook-1.png"
                    alt="facebook-1" border="0"></a>
        </div>

        <!-- Enlaces "Politicas sobre las 🍪" y "Politicas sobre la Privacidad" -->
        <div x-data="{ openWindow: (url) => window.open(url, '_blank', 'width=600,height=600') }" class="flex justify-center mt-8">
            <a href="{{ route('politicas.cookies.privacidad') }}"
                class="text-gray-500 px-6 py-3 rounded hover:bg-gray-600 mr-4"
                x-on:click.prevent="openWindow('{{ route('politicas.cookies.privacidad') }}')">Politicas sobre las
                🍪</a>
            <a href="{{ route('politicas.privacidad') }}" class="text-gray-500 px-6 py-3 rounded hover:bg-gray-600"
                x-on:click.prevent="openWindow('{{ route('politicas.privacidad') }}')">Politicas sobre la Privacidad</a>
        </div>




    </div>
</footer>


</html>
