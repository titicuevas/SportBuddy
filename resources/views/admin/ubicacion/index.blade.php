<x-administrador>
    @section('contenido')



        @if (session('success') || session('error'))
            <div x-data="{ show: false }" x-show="show" x-init="() => {
                show = true;
                setTimeout(() => show = false, 5000);
            }"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2
        @if (session('success'))
bg-green-500
@else
text-white
@endif
        rounded-md shadow-md transition-all duration-300">
                <p class="text-center text-base">{{ session('success') ?? session('error') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-center mb-6">
            <h1 class="text-4xl text-blue-500">UBICACIONES</h1>
        </div>

        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-500">
                <thead>
                    <tr>
                        <th class="py-2 px-4  text-xl border-gray-500 border-b-2">Nombre</th>
                        <th class="py-2 px-4  text-xl border-gray-500 border-b-2">Dirección</th>
                        <th class="py-2 px-4  text-xl border-gray-500 border-b-2">Imagen</th>
                        <th class="py-2 px-4  text-xl border-gray-500 border-b-2">Enlace Maps</th>
                        <th class="py-2 px-4  text-xl border-gray-500 border-b-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ubicaciones as $ubicacion)
                        <tr>
                            <td class="py-2 px-4  text-xl border-gray-500 border-b-2 text-center">{{ $ubicacion->nombre }}
                            </td>
                            <td class="py-2 px-4  text-xl border-gray-500 border-b-2 text-center">
                                {{ $ubicacion->direccion }}</td>
                            <td class="py-2 px-4  text-xl border-gray-500 border-b-2 text-center">
                                @if ($ubicacion->imagen)
                                    <img src="{{ asset('storage/imagen/' . $ubicacion->imagen) }}" alt="Imagen Ubicación"
                                        class="w-16 h-16 object-cover rounded-full">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td class="py-2 px-4  text-xl border-gray-500 border-b-2 text-center">
                                @if ($ubicacion->enlace_maps)
                                    <a href="{{ $ubicacion->enlace_maps }}" target="_blank" rel="noopener noreferrer">
                                        Ver en Maps
                                    </a>
                                @else
                                    Sin enlace
                                @endif
                            </td>


                            <td class="py-2 px-4  text-xl border-gray-500 border-b-2 text-center">
                                <br>
                                <a href="{{ route('admin.ubicacion.edit', $ubicacion->id) }}"
                                    class= " bg-blue-500  over:bg-red-700 text-white px-3 py-1 rounded">
                                    Editar
                                </a>
                                <br>
                                <br>

                                <form action="{{ route('admin.ubicacion.destroy', $ubicacion->id) }}" method="post"
                                    onsubmit="return confirm('¿Quieres borrar {{ $ubicacion->nombre }}?')">
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
            {{ $ubicaciones->links() }}

        </div>


        <div class="flex items-center justify-center">
            <a href="{{ route('admin.ubicacion.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Crear Ubicación
            </a>
        </div>
        {{ $ubicaciones->links() }}


    </x-administrador>
