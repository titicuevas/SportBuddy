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

                    <div class="flex justify-end items-center p-6 bg-neutral-700">
                        <div>
                            @if ($user->foto)
                                <img class="h-48 w-48 border-2 border-black rounded-t" id="imgPerfil"
                                    src="{{ $user->foto ? Storage::url($user->foto) : 'https://mastermdi.com/files/students/noImage.jpg' }}"
                                    alt="usuario" />
                            @else
                                <img src="https://seeklogo.com/images/S/spider-man-comic-new-logo-322E9DE914-seeklogo.com.png"
                                    alt="Foto de perfil" width="100" height="100">
                            @endif

                        </div>


                    </div>

                </div>


            </div>
        </div>
    </div>








</x-app-layout>
