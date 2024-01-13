<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Lista de Pistas</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                <p class="text-center text-lg">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-red-700 text-white rounded-md shadow-md">
                <p class="text-center text-lg">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Agrega un enlace para ir al formulario de creación -->
        <div class="mb-4">
            <a href="{{ route('admin.pista.create') }}"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                Agregar Pista
            </a>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-center">Ubicación</th>
                    <th class="py-2 px-4 border-b text-center">Superficie</th>
                    <th class="py-2 px-4 border-b text-center">Deporte</th>
                    <th class="py-2 px-4 border-b text-center">Número de Pista</th>
                    {{--                     <th class="py-2 px-4 border-b text-center">¿Tiene Luz?</th>
 --}} <th class="py-2 px-4 border-b text-center">Precio con Luz</th>
                    <th class="py-2 px-4 border-b text-center">Precio sin Luz</th>
                    <th class="py-2 px-4 border-b text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pistas as $pista)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $pista->ubicacion->nombre }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $pista->superficie->tipo }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $pista->deporte->nombre }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $pista->numero }}</td>
                        {{--                         <td class="py-2 px-4 border-b text-center">{{ $pista->tiene_luz ? 'Sí' : 'No' }}</td>
 --}} <td class="py-2 px-4 border-b text-center">
                            {{ $pista->precio_con_luz ?: 'N/A' }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $pista->precio_sin_luz }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <!-- Agrega enlaces para editar y eliminar según sea necesario -->
                            <a href="{{ route('admin.pista.edit', $pista->id) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Editar
                            </a>

                            <br>
                            <br>

                            <form action="{{ route('admin.pista.destroy', $pista->id) }}" method="post"
                                onsubmit="return confirm('¿Estás seguro de borrar esta pista?')">
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
        {{ $pistas->links() }}
    </x-administrador>
