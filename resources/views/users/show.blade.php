<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1 p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="mb-4">
                                <label for="Nombre" class="font-semibold text-gray-700">Nombre:</label>
                                <span class="ml-2 text-gray-900">{{ $user->name }}</span>
                            </div>

                            <div class="mb-4">
                                <label for="Apellidos" class="font-semibold text-gray-700">Apellidos:</label>
                                <span class="ml-2 text-gray-900">{{ $user->apellidos }}</span>
                            </div>

                            <div class="mb-4">
                                <label for="Email" class="font-semibold text-gray-700">Email:</label>
                                <span class="ml-2 text-gray-900">{{ $user->email }}</span>
                            </div>

                            <div class="mb-4">
                                <label for="Telefono" class="font-semibold text-gray-700">Teléfono:</label>
                                <span class="ml-2 text-gray-900">{{ $user->telefono }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vista previa de la foto -->
                    <div class="flex justify-center items-center mb-4">
                        @if ($user->foto)
                            <img class="h-48 w-48 border-2 border-black rounded-t mb-4" id="imgPerfil"
                                src="{{ Storage::url($user->foto) }}" alt="Foto de perfil" />
                        @else
                            <img class="h-48 w-48 border-2 border-black rounded-t mb-4" id="imgPerfil"
                                src="https://mastermdi.com/files/students/noImage.jpg" alt="usuario" />
                        @endif
                    </div>


                </div>

            </div>


        </div>
    </div>
    </div>








</x-app-layout>
