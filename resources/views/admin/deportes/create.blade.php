<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Deporte</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-red-500 text-white rounded-md shadow-md">
                <p class="text-center text-base">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Mostrar mensajes de error de validación -->
        @if($errors->has('nombre'))
            <div class="text-red-500 text-center text-sm mt-2">
                {{ $errors->first('nombre') }}
            </div>
        @endif




        <form action="{{ route('admin.deportes.store') }}" method="post">
            @csrf
            <div class="mb-4 text-center">
                <label for="nombre" class="block text-xl font-semibold mb-2 text-gray-600">Nombre del Deporte</label>
                <input type="text" name="nombre" id="nombre"
                    class="w-48  text-xl border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
            </div>

            

            <div class="mt-4 text-center">
                <button type="submit"
                    class="bg-blue-500 text-white text-xl py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Agregar Deporte
                </button>
            </div>
        </form>

    </x-administrador>
