<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Nueva Superficie</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                <p class="text-center text-base">{{ session('error') }}</p>
            </div>
        @endif


        <!-- Mostrar mensajes de error de validación -->
        @if ($errors->has('tipo'))
            <div class="text-red-500 text-center text-sm mt-2">
                {{ $errors->first('tipo') }}
            </div>
        @endif


        <div class="flex items-center justify-center">
            <form action="{{ route('admin.superficie.store') }}" method="post">
                @csrf
                <div class="mb-4 text-center">
                    <label for="tipo" class="block text-gray-600 text-sm font-semibold mb-2">Tipo de Superficie</label>
                    <input type="text" name="tipo" id="tipo" class="w-48 border rounded-md p-2 border-opacity-50"
                        required>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                        Agregar Superficie
                    </button>
                </div>
            </form>
        </div>

    </x-administrador>
