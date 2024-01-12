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
            <h1 class="text-4xl text-blue-500">DEPORTES</h1>
        </div>

        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deportes as $deporte)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $deporte->nombre }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <form action="{{ route('admin.deportes.destroy', $deporte->id) }}" method="post"
                                    onsubmit="return confirm('¿Estás seguro de borrar {{ $deporte->nombre }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>

        </div>
        @endforeach
        </tbody>
        <div class="flex items-center justify-center">
            <a href="{{ route('admin.deportes.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Crear Deporte
            </a>
    </x-administrador>
