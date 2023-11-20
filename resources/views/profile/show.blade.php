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
                  <img src="{{ $user->foto }}" class="w-20 rounded-full border-gray-300 border-2" alt="Imagen de perfil">
                </div>

                <button type="button" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Editar imagen</button>
              </div>
            </div>
          </div>
        </div>
      </div>


</x-app-layout>
