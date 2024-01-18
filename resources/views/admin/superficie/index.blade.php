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
            <h1 class="text-4xl text-blue-500">SUPERFICIES</h1>
        </div>

        <div class="overflow-x-auto mx-auto max-w-2xl mb-6">
            <table class="w-full bg-white border text-xl  border-b-2 border-gray-500-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-xl border-b-2 border-gray-500">Tipo</th>
                        <th class="py-2 px-4 text-xl border-b-2 border-gray-500">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($superficies as $superficie)
                        <tr>
                            <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $superficie->tipo }}</td>
                            <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">
                                <br>
                                <a href="{{ route('admin.superficie.edit', $superficie->id) }}"

                                    class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Editar
                                </a>
                                <br>
                                <br>
                                <form action="{{ route('admin.superficie.destroy', $superficie->id) }}" method="post"
                                    onsubmit="return confirm('¿Estás seguro de borrar {{ $superficie->tipo }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        Borrar
                                    </button>
                                    <br>
                                    <br>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-center">
            <a href="{{ route('admin.superficie.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white text-xl py-2 px-4 rounded">
                Crear Superficie
            </a>
        </div>

    </x-administrador>
