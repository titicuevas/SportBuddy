<x-administrador>
    @section('contenido')


        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="flex items-center justify-center mb-6">
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                    <p class="text-center text-xl">{{ session('success') }}</p>
                </div>
            </div>
        @endif


        {{-- @if (session('success') || session('error'))
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
 --}}
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
                                    class= " bg-blue-500  over:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                    Editar
                                </a>
                                <br>
                                <br>

                                <form action="{{ route('admin.ubicacion.destroy', $ubicacion->id) }}" method="post"
                                    x-data="{ showModal: false }">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" x-on:click="showModal = true"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red">
                                        Eliminar
                                    </button>

                                    {{--  Ventana modal --}}

                                    <!-- Ventana modal de confirmación -->
                                    <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto"
                                        style="display: none;">
                                        <div
                                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Cubierta oscura trasera -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>

                                            <!-- Centro de la ventana modal -->
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                aria-hidden="true">&#8203;</span>

                                            <!-- Contenido de la ventana modal -->
                                            <div x-show="showModal"
                                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                                style="max-width: 500px;">
                                                <div class="bg-white p-5">
                                                    <h1 class="text-xl font-bold text-gray-900 mb-4">Eliminar Ubicacion
                                                    </h1>
                                                    <p class="text-gray-700">¿Seguro que quieres eliminar este Ubicacion?
                                                        Esta
                                                        acción
                                                        no se puede deshacer.</p>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring focus:border-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Eliminar
                                                    </button>
                                                    <button type="button" x-on:click="showModal = false"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Cancelar
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
