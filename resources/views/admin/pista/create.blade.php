<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Pista</h1>
        </div>

        <form action="{{ route('admin.pista.store') }}" method="post">
            @csrf

            <div class="mb-4">
                <label for="ubicacion_id" class="block text-gray-600 text-sm font-semibold mb-2">Ubicación</label>
                <!-- Aquí debes agregar un campo de selección para elegir la ubicación -->
                <!-- Puedes usar un campo select o algún componente de selección -->
                <!-- Ejemplo: -->
                <select name="ubicacion_id" id="ubicacion_id" class="w-full border rounded-md p-2 border-opacity-50">
                    <!-- Opciones de ubicaciones -->
                </select>
            </div>

            <div class="mb-4">
                <label for="superficie_id" class="block text-gray-600 text-sm font-semibold mb-2">Superficie</label>
                <!-- Campo de selección para elegir la superficie -->
                <select name="superficie_id" id="superficie_id" class="w-full border rounded-md p-2 border-opacity-50">
                    <!-- Opciones de superficies -->
                </select>
            </div>

            <div class="mb-4">
                <label for="deporte_id" class="block text-gray-600 text-sm font-semibold mb-2">Deporte</label>
                <!-- Campo de selección para elegir el deporte -->
                <select name="deporte_id" id="deporte_id" class="w-full border rounded-md p-2 border-opacity-50">
                    <!-- Opciones de deportes -->
                </select>
            </div>

            <div class="mb-4">
                <label for="numero" class="block text-gray-600 text-sm font-semibold mb-2">Número de Pista</label>
                <input type="number" name="numero" id="numero" class="w-full border rounded-md p-2 border-opacity-50"
                    required>
            </div>

            <!-- Otros campos del formulario según sea necesario -->

            <div class="mb-4">
                <label for="tiene_luz" class="block text-gray-600 text-sm font-semibold mb-2">¿Tiene Luz?</label>
                <input type="checkbox" name="tiene_luz" id="tiene_luz" class="mr-2">
            </div>

            <div class="mb-4">
                <label for="precio_con_luz" class="block text-gray-600 text-sm font-semibold mb-2">Precio con Luz</label>
                <input type="number" name="precio_con_luz" id="precio_con_luz"
                    class="w-full border rounded-md p-2 border-opacity-50">
            </div>

            <div class="mb-4">
                <label for="precio_sin_luz" class="block text-gray-600 text-sm font-semibold mb-2">Precio sin Luz</label>
                <input type="number" name="precio_sin_luz" id="precio_sin_luz"
                    class="w-full border rounded-md p-2 border-opacity-50" required>
            </div>

            <div class="mt-4">

                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Agregar Pista
                </button>

            </div>
        </form>
    </x-administrador>
