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
            <h1 class="text-4xl text-blue-500">Editar Superficie</h1>
        </div>

        <form action="{{ route('admin.superficie.update', $superficie->id) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Campos del formulario -->
            <div class="mb-4 text-center">
                <label for="tipo" class="block text-xl font-semibold mb-2 text-gray-600">Tipo</label>
                <input type="text" name="tipo" id="tipo"
                    class="w-48 border rounded-md py-2 text-xl px-3 focus:outline-none focus:border-blue-500"
                    value="{{ old('tipo', $superficie->tipo) }}" required>
            </div>

            <!-- Botón para actualizar la superficie -->
            <div class="mt-4 text-center">
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md text-xl hover:bg-blue-700 focus:outline-none">
                    Actualizar Superficie
                </button>
            </div>
        </form>
    </x-administrador>
