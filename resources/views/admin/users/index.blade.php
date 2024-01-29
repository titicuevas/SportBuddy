<x-administrador>


    <!-- En tu archivo de componentes, por ejemplo, administrador.blade.php -->
    <div class="p-4">
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

            <div class="flex items-center justify-center mb-6">
                <h1 class="text-4xl text-blue-500">USUARIOS</h1>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-2 border-gray-500">
                    <thead>
                        <tr>
                            <th class="py-2 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-gray-500 px-4 border-b-2">Nombre</th>
                            <th class="py-2 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-gray-500 px-4 border-b-2">Apellidos
                            </th>
                            <th class="py-2 px-4 border-gray-500 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2">Telefono
                            </th>
                            <th class="py-2 px-4 border-gray-500 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2">Email</th>
                            <th class="py-2 px-4 border-gray-500 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2">Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td
                                    class="py-2 px-4 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2 border-gray-500 text-center">
                                    {{ $user->name }}</td>
                                <td
                                    class="py-2 px-4 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2 border-gray-500 text-center">
                                    {{ $user->apellidos }}</td>
                                <td
                                    class="py-2 px-4 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2 border-gray-500 text-center">
                                    {{ $user->telefono }}</td>
                                <td
                                    class="py-2 px-4 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2 border-gray-500 text-center">
                                    {{ $user->email }}</td>
                                <td
                                    class="py-2 px-4 text-xl sm:w-1/4 md:w-1/6 lg:w-1/6 border-b-2 border-gray-500 text-center">


                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post"
                                        x-data="{ showModal: false }">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" x-on:click="showModal = true"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red">
                                            Eliminar
                                        </button>


                                        {{-- Modal --}}


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
                                                        <h1 class="text-xl font-bold text-gray-900 mb-4">Eliminar partido
                                                        </h1>
                                                        <p class="text-gray-700">¿Seguro que quieres eliminar este Usuario?
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




                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}


        </div>


    </x-administrador>
