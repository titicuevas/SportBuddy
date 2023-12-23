<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Nueva Superficie</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
            <p class="text-center text-base">{{ session('success') }}</p>
        </div>
    @endif

        <form action="{{ route('admin.superficie.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="tipo" class="block text-gray-600 text-sm font-semibold mb-2">Tipo de Superficie</label>
                <input type="text" name="tipo" id="tipo" class="w-full border rounded-md p-2 border-opacity-50"
                    required>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                    Agregar Superficie
                </button>
            </div>
        </form>

</x-administrador>
