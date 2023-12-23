<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Aquí puedes agregar tus metaetiquetas, hojas de estilo y scripts -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen bg-gray-200">
        <!-- Barra lateral izquierda -->
        <div class="bg-blue-800 text-white w-1/4 p-6">
            <h2 class="text-2xl font-semibold mb-4">Secciones</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Inicio
                    </a>
                </li>
                <br>


                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Usuarios
                    </a>
                </li>



                <br>
                <li>
                    <a href="{{ route('admin.deportes.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Deportes
                    </a>
                </li>
                <br>

                <li>

                    <a href="{{ route('admin.ubicacion.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Ubicacion
                    </a>
                </li>
                <br>
                <li>

                    <a href="{{ route('admin.superficie.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Superficie
                    </a>
                </li>
                <br>

                <li>

                    <a href="{{ route('admin.pista.index') }}"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Pista
                    </a>
                </li>

                <br>

                <div class="w-3/4 p-6 relative">
                    <button onclick="location.href='{{ route('dashboard') }}'"
                        class="absolute top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:bg-red-700 focus:outline-none transition duration-300">
                        Salir modo Admin
                    </button>



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
