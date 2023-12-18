<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Aquí puedes agregar tus metaetiquetas, hojas de estilo y scripts -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen bg-gray-200">
        <!-- Barra lateral izquierda -->
        <div class="bg-blue-800 text-white w-1/4 p-6">
            <h2 class="text-2xl font-semibold mb-4">Secciones</h2>
            <ul class="space-y-2">
                <li>
                    <a href="javascript:void(0);" onclick="cargarVista('ubicacion')"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Ubicación
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="cargarVista('users/lista')"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="cargarVista('deporte')"
                        class="block p-2 hover:bg-blue-700 focus:bg-blue-700 focus:outline-none rounded-md transition duration-300">
                        Deporte
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="w-3/4 p-6">
            <h1 class="text-4xl text-gray-800 mb-6 text-center">
                BIENVENIDO AL MODO ADMIN
            </h1>
            <!-- Aquí se incluirá la vista específica de cada sección -->
            <div id="contenido" class="bg-white p-6 rounded-lg shadow-md">

            </div>

            <div class="flex justify-center">

            </div>
        </div>
    </div>

    <!-- Aquí puedes agregar tus scripts al final del body -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Función para cargar la vista con Ajax
        function cargarVista(vista) {
            $.ajax({
                url: '{{ url('admin') }}/' + vista,
                type: 'GET',
                success: function(data) {
                    $('#contenido').html(data);
                },
                error: function(error) {
                    console.error('Error al cargar la vista:', error);
                }
            });
        }
    </script>
</body>

</html>
