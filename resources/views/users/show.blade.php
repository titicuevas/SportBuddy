<x-app-layout>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">Detalles del Usuario</h1>

                <div class="flex items-center bg-gray-100 p-4">
                    <!-- Vista previa de la foto -->
                    <div class="flex-shrink-0 p-4">
                        @if ($user->foto)
                            <img class="h-32 w-32 border-2 border-black rounded-full"
                                src="{{ Storage::url($user->foto) }}" alt="Foto de perfil" />
                        @else
                            <img class="h-32 w-32 border-2 border-black rounded-full"
                                src="https://mastermdi.com/files/students/noImage.jpg" alt="usuario" />
                        @endif
                    </div>



                    <div class="flex-1 p-4 text-gray-900">
                        <div class="flex flex-col">
                            <div class="mb-2">
                                <label for="Nombre" class="font-bold text-lg text-gray-700">Nombre:</label>
                                <span class="ml-2 text-xl text-gray-900">{{ $user->name }}</span>
                            </div>

                            {{-- <div class="mb-2">
                                <label for="Apellidos" class="font-bold text-lg text-gray-700">Apellidos:</label>
                                <span class="ml-2 text-xl text-gray-900">{{ $user->apellidos }}</span>
                            </div> --}}

                            <div class="mb-2">
                                <label for="Email" class="font-bold text-lg text-gray-700">Email:</label>
                                <span class="ml-2 text-xl text-gray-900">{{ $user->email }}</span>
                            </div>

                            <div class="mb-2">
                                <label for="Telefono" class="font-bold text-lg text-gray-700">Teléfono:</label>
                                <span class="ml-2 text-xl text-gray-900">{{ $user->telefono }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <a href="{{ url()->previous() }}"
                                class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue hover:bg-blue-700">
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
