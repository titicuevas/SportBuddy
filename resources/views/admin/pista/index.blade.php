<x-administrador>
    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Lista de Pistas</h1>
        </div>



       {{-- Mensaje de éxito --}}
       @if (session('success'))
       <div class="flex items-center justify-center mb-6">
           <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
               class="fixed px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
               <p class="text-center text-xl">{{ session('success') }}</p>
           </div>
       </div>
   @endif


        <!-- Agrega un enlace para ir al formulario de creación -->


        <table class="min-w-full bg-white border  text-xl border-b-2 border-gray-500">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Ubicación</th>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Superficie</th>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Deporte</th>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Número de Pista</th>
                    {{--                     <th class="py-2 px-4 border-b text-center">¿Tiene Luz?</th>
 --}}
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Precio con Luz</th>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Precio sin Luz</th>
                    <th class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pistas as $pista)
                    <tr>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $pista->ubicacion->nombre }}
                        </td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $pista->superficie->tipo }}
                        </td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $pista->deporte->nombre }}
                        </td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $pista->numero }}</td>
                        {{--                         <td class="py-2 px-4 border-b text-center">{{ $pista->tiene_luz ? 'Sí' : 'No' }}</td>
 --}} <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">
                            {{ $pista->precio_con_luz ?: 'N/A' }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $pista->precio_sin_luz }}
                        </td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">
                            <!-- Agrega enlaces para editar y eliminar según sea necesario -->
                            <br>
                            <a href="{{ route('admin.pista.edit', $pista->id) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                Editar
                            </a>

                            <br>
                            <br>

                            <form action="{{ route('admin.pista.destroy', $pista->id) }}" method="post"
                                x-data="{ showModal: false }">                                @csrf
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
                                                <h1 class="text-xl font-bold text-gray-900 mb-4">Eliminar Pista
                                                </h1>
                                                <p class="text-gray-700">¿Seguro que quieres eliminar este Pista?
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
        <br>
        <div class="flex items-center justify-center">
            <a href="{{ route('admin.pista.create') }}"
                class="bg-blue-500 text-white py-2 px-4  text-2xl rounded-md hover:bg-blue-700 focus:outline-none">
                Agregar Pista
            </a>
        </div>
        {{ $pistas->links() }}
    </x-administrador>
