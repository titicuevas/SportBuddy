<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Editar Pista</h1>
        </div>

        <form action="{{ route('admin.pista.update', $pista->id) }}" method="post" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="ubicacion_id" class="block text-gray-600 text-sm font-semibold mb-2">Ubicación</label>
                <select name="ubicacion_id" id="ubicacion_id" class="w-full border-gray-300 rounded-md p-2 border-opacity-50"
                    required>
                    @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id }}" {{ $pista->ubicacion_id == $ubicacion->id ? 'selected' : '' }}>
                            {{ $ubicacion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Superficie -->
            <div class="mb-4">
                <label for="superficie_id" class="block text-gray-600 text-sm font-semibold mb-2">Superficie</label>
                <select name="superficie_id" id="superficie_id"
                    class="w-full border-gray-300 rounded-md p-2 border-opacity-50" required>
                    @foreach ($superficies as $superficie)
                        <option value="{{ $superficie->id }}"
                            {{ $pista->superficie_id == $superficie->id ? 'selected' : '' }}>
                            {{ $superficie->tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deporte -->
            <div class="mb-4">
                <label for="deporte_id" class="block text-gray-600 text-sm font-semibold mb-2">Deporte</label>
                <select name="deporte_id" id="deporte_id" class="w-full border-gray-300 rounded-md p-2 border-opacity-50"
                    required>
                    @foreach ($deportes as $deporte)
                        <option value="{{ $deporte->id }}" {{ $pista->deporte_id == $deporte->id ? 'selected' : '' }}>
                            {{ $deporte->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Número de Pista -->
            <div class="mb-4">
                <label for="numero" class="block text-gray-600 text-sm font-semibold mb-2">Número de Pista</label>
                <input type="text" name="numero" id="numero" class="w-full border-gray-300 rounded-md p-2"
                    value="{{ $pista->numero }}" required>
            </div>

            <!-- Precio con Luz -->
            <div class="mb-4">
                <label for="precio_con_luz" class="block text-gray-600 text-sm font-semibold mb-2">Precio con Luz</label>
                <input type="text" name="precio_con_luz" id="precio_con_luz"
                    class="w-full border-gray-300 rounded-md p-2" value="{{ $pista->precio_con_luz }}">
            </div>

            <!-- Precio sin Luz -->
            <div class="mb-4">
                <label for="precio_sin_luz" class="block text-gray-600 text-sm font-semibold mb-2">Precio sin Luz</label>
                <input type="text" name="precio_sin_luz" id="precio_sin_luz"
                    class="w-full border-gray-300 rounded-md p-2" value="{{ $pista->precio_sin_luz }}" required>
            </div>

            <!-- Botón Guardar Cambios -->
            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </x-administrador>
