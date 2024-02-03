<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        body {
            font-family: 'sans-serif';
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Añade estilos específicos para pantallas más pequeñas si es necesario */

        @media only screen and (max-width: 768px) {

            /* Por ejemplo, puedes ajustar el tamaño de fuente o márgenes */
            body {
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Encabezado de la Página -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Contenido de la Página -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Pie de Página -->
    <footer class="mt-auto bg-white text-black p-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} SportBuddy</p>
            <p>Creado por: Enrique Cuevas Garcia</p>

            <!-- Iconos de redes sociales con enlaces que se abren en una nueva pestaña -->
            <div class="flex justify-center mt-4">
                <a href="https://twitter.com/" target="_blank" class="mx-2"><img
                        src="https://i.ibb.co/RzXRD4d/gorjeo-2.png" alt="gorjeo-2" border="0"></a>

                <a href="https://www.facebook.com/" target="_blank" class="mx-2"><img
                        src="https://i.ibb.co/dBTPDBm/instagram-1.png" alt="instagram-1" border="0"></a>

                <a href="https://www.instagram.com/" target="_blank" class="mx-2"><img
                        src="https://i.ibb.co/wCtRTFr/facebook-1.png" alt="facebook-1" border="0"></a>
            </div>

        </div>
    </footer>
</body>

</html>
