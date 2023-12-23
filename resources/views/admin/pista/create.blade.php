<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Pista</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                <p class="text-center text-base">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Mensaje de error -->
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-red-500 text-white rounded-md shadow-md">
                <p class="text-center text-base">{{ session('error') }}</p>
            </div>
        @endif


        <form action="{{ route('admin.pista.store') }}" method="post">
            @csrf

            <div class="mb-4">
                <label for="ubicacion_id" class="block text-gray-600 text-sm font-semibold mb-2">Ubicación</label>
                <select name="ubicacion_id" id="ubicacion_id" class="w-full border rounded-md p-2 border-opacity-50">
                    @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="superficie_id" class="block text-gray-600 text-sm font-semibold mb-2">Superficie</label>
                <select name="superficie_id" id="superficie_id" class="w-full border rounded-md p-2 border-opacity-50">
                    @foreach ($superficies as $superficie)
                        <option value="{{ $superficie->id }}">{{ $superficie->tipo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="deporte_id" class="block text-gray-600 text-sm font-semibold mb-2">Deporte</label>
                <select name="deporte_id" id="deporte_id" class="w-full border rounded-md p-2 border-opacity-50">
                    @foreach ($deportes as $deporte)
                        <option value="{{ $deporte->id }}">{{ $deporte->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="numero" class="block text-gray-600 text-sm font-semibold mb-2">Número de Pista</label>
                <input type="number" name="numero" id="numero" class="w-full border rounded-md p-2 border-opacity-50"
                    required>
            </div>

            <!-- Otros campos del formulario según sea necesario -->

            {{-- <div class="mb-4">
                <label for="tiene_luz" class="block text-gray-600 text-sm font-semibold mb-2">¿Tiene Luz?</label>
                <input type="checkbox" name="tiene_luz" id="tiene_luz" class="mr-2">
            </div> --}}

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

                <a href="{{ route('admin.pista.index') }}"
                class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none">
                Volver
            </a>


            </div>
        </form>
    </x-administrador>
