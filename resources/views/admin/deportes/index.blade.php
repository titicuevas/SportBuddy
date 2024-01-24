<x-administrador>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="flex items-center justify-center mb-6">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                <p class="text-center text-xl">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="flex items-center justify-center mb-6">
        <h1 class="text-4xl text-blue-500">DEPORTES</h1>
    </div>

    <div class="overflow-x-auto mb-6 mx-auto max-w-2xl">
        <table class="min-w-full bg-white border-2 text-xl border-b-2 border-gray-500 ">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500">Nombre</th>

                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deportes as $deporte)
                    <tr>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $deporte->nombre }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">

                            <a href="{{ route('admin.deportes.edit', $deporte->id) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Editar
                            </a>
                            <br>
                            <br>
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
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex items-center text-xl  justify-center mt-4">
        <a href="{{ route('admin.deportes.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Crear Deporte
        </a>
    </div>
    {{ $deportes->links() }}

</x-administrador>
