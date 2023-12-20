<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Nueva Superficie</h1>
        </div>

        {{-- Mostrar mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded-md">
                {{ session('success') }}
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
