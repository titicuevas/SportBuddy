<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Ubicación</h1>
        </div>

        <form action="{{ route('admin.ubicacion.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-semibold mb-2 text-gray-600">Nombre de la Ubicación</label>
                <input type="text" name="nombre" id="nombre" class="w-full border rounded-md p-2 border-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="direccion" class="block text-sm font-semibold mb-2 text-gray-600">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="w-full border rounded-md p-2 border-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="enlace_maps" class="block text-sm font-semibold mb-2 text-gray-600">Enlace de Google Maps</label>
                <input type="text" name="enlace_maps" id="enlace_maps" class="w-full border rounded-md p-2 border-opacity-50">
            </div>

            <div class="mb-4">
                <label for="iframe" class="block text-sm font-semibold mb-2 text-gray-600">Iframe</label>
                <textarea name="iframe" id="iframe" class="w-full border rounded-md p-2 border-opacity-50" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-sm font-semibold mb-2 text-gray-600">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="w-full border rounded-md p-2 border-opacity-50">
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Agregar Ubicación
                </button>
            </div>
        </form>

</x-administrador>
