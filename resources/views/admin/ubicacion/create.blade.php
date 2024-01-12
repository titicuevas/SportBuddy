<x-administrador>



    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Ubicación</h1>
        </div>


         <!-- Mensaje de éxito -->
         @if (session('success'))
         <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
             <p class="text-center text-base">{{ session('success') }}</p>
         </div>
     @endif

     <div class="flex items-center justify-center">
        <form action="{{ route('admin.ubicacion.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 text-center">
                <label for="nombre" class="block text-sm font-semibold mb-2 text-gray-600">Nombre de la Ubicación</label>
                <input type="text" name="nombre" id="nombre" class="w-48 border rounded-md p-2 border-opacity-50" required>
            </div>

            <div class="mb-4 text-center">
                <label for="direccion" class="block text-sm font-semibold mb-2 text-gray-600">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="w-48 border rounded-md p-2 border-opacity-50" required>
            </div>

            <div class="mb-4 text-center">
                <label for="enlace_maps" class="block text-sm font-semibold mb-2 text-gray-600">Enlace de Google Maps</label>
                <input type="text" name="enlace_maps" id="enlace_maps" class="w-48 border rounded-md p-2 border-opacity-50">
            </div>

            <div class="mb-4 text-center">
                <label for="iframe" class="block text-sm font-semibold mb-2 text-gray-600">Iframe</label>
                <textarea name="iframe" id="iframe" class="w-48 border rounded-md p-2 border-opacity-50" rows="4"></textarea>
            </div>

            <div class="mb-4 text-center">
                <label for="imagen" class="block text-sm font-semibold mb-2 text-gray-600">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="w-48 border rounded-md p-2 border-opacity-50">
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Agregar Ubicación
                </button>
            </div>
        </form>
    </div>

    </x-administrador>
