<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])




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

            /* Puedes ajustar estilos adicionales para tamaños de pantalla más pequeños aquí */
            #sidebar {
                width: 100%;
            }

            .w-3/4 {
                width: 100%;
            }
        }
    </style>





</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen bg-gray-200">
        <!-- Barra lateral izquierda -->


        <div id="sidebar" class="bg-blue-800 text-white w-1/4 p-6">
            <div class="text-center bg-gray-200 rounded-md">
                <div class="inline-block">
                    <h2 class="text-4xl font-semibold mb-4 text-black">Secciones</h2>
                </div>
            </div>


            <ul class="space-y-2">
                <br>
                <div class="border-b-8 mb-8"></div>
                <br>

                <li>
                    <a href="{{ route('admin.index') }}"
                        class="block p-4 {{ request()->routeIs('admin.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Inicio
                    </a>
                </li>
                <br>

                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="block p-2 {{ request()->routeIs('admin.users.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Usuarios
                    </a>
                </li>

                <br>
                <li>
                    <a href="{{ route('admin.deportes.index') }}"
                        class="block p-2 {{ request()->routeIs('admin.deportes.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Deportes
                    </a>
                </li>
                <br>

                <li>
                    <a href="{{ route('admin.ubicacion.index') }}"
                        class="block p-2 {{ request()->routeIs('admin.ubicacion.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Ubicacion
                    </a>
                </li>
                <br>
                <li>
                    <a href="{{ route('admin.superficie.index') }}"
                        class="block p-2 {{ request()->routeIs('admin.superficie.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Superficie
                    </a>
                </li>
                <br>

                <li>
                    <a href="{{ route('admin.pista.index') }}"
                        class="block p-2 {{ request()->routeIs('admin.pista.index') ? 'bg-blue-700' : 'hover:bg-blue-700' }} focus:bg-blue-700 text-center text-3xl focus:outline-none rounded-md transition duration-300">
                        Pista
                    </a>
                </li>

                <br>

                <div class="border-b-8  mb-8"></div>
                <div class="w-3/5 p-6 relative flex items-center justify-center">
                    <button onclick="location.href='{{ route('dashboard') }}'"
                        class="absolute top-4 right-4 bg-red-500 text-white text-3xl px-4 py-2 rounded-md hover:bg-red-700 focus:bg-red-700 focus:outline-none transition duration-300">
                        Salir
                    </button>
                </div>
            </ul>
        </div>


        <!-- Contenido principal -->
        <div class="w-3/4 p-6">
            <h1 class="text-4xl text-gray-800 mb-6 text-center">
                BIENVENIDO AL MODO ADMIN
            </h1>






            <div id="contenido" class="bg-white p-6 rounded-lg shadow-md">
                {{-- Contenido de la vista --}}


                {{ $slot }}

            </div>

            <div class="flex justify-center">

            </div>
        </div>
    </div>




</body>



</html>
