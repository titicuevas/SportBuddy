<x-administrador>

    @section('contenido')
        @if (session('success'))
            <div x-data="{ show: false }" x-show="show" x-init="() => {
                show = true;
                setTimeout(() => show = false, 5000);
            }"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md transition-all duration-300">
                <p class="text-center text-base">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-center mb-6">
            <h1 class="text-4xl text-blue-500">Editar Ubicación</h1>
        </div>

        <form action="{{ route('admin.ubicacion.update', $ubicacion->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-center mb-6">
                <h1 class="text-4xl text-blue-500">Editar Ubicación</h1>
            </div>

            <form action="{{ route('admin.ubicacion.update', $ubicacion->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campos del formulario -->
                <div class="mb-4 text-center">
                    <label for="nombre" class="block text-sm font-semibold mb-2 text-gray-600">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        value="{{ old('nombre', $ubicacion->nombre) }}" required>
                </div>

                <div class="mb-4 text-center">
                    <label for="direccion" class="block text-sm font-semibold mb-2 text-gray-600">Dirección</label>
                    <input type="text" name="direccion" id="direccion"
                        class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        value="{{ old('direccion', $ubicacion->direccion) }}" required>
                </div>

                <div class="mb-4 text-center">
                    <label for="enlace_maps" class="block text-sm font-semibold mb-2 text-gray-600">Enlace Maps</label>
                    <textarea name="enlace_maps" id="enlace_maps"
                        class="w-48 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        rows="4">{{ old('enlace_maps', $ubicacion->enlace_maps) }}</textarea>
                </div>

                <div class="mb-4 text-center">
                    <label for="imagen" class="block text-sm font-semibold mb-2 text-gray-600">Imagen</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*"
                        class="py-2 px-3 focus:outline-none focus:border-blue-500">
                    @if ($ubicacion->imagen)
                        <img src="{{ asset('storage/imagen/' . $ubicacion->imagen) }}" alt="Imagen Actual"
                            class="max-w-full h-auto mt-2">
                        <p class="text-gray-500 text-sm mt-1">Imagen actual: {{ $ubicacion->imagen }}</p>
                    @else
                        <p class="text-gray-500 text-sm mt-1">Sin imagen actual</p>
                    @endif
                </div>

                <!-- Botón para actualizar la ubicación -->
                <div class="mt-4 text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                        Actualizar Ubicación
                    </button>
                </div>
            </form>
        </x-administrador>
