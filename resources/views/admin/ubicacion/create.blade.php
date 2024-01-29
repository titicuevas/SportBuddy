<x-administrador>

    @section('contenido')
        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">Agregar Ubicación</h1>
        </div>



        {{-- Errores --}}
        @if (session('success') || session('error'))
            <div x-data="{ show: false, showDetails: false }" x-show="show" x-init="() => {
                show = true;
                setTimeout(() => show = false, 5000);
            }"
                class="fixed inset-x-0 mx-auto top-4 px-4 py-2
        @if (session('success'))
bg-green-500
@else
@endif
        text-white rounded-md shadow-md">
                <div class="flex items-center justify-between">
                    <p class="text-base">{{ session('success') ?? session('error') }}</p>
                    <button @click="show = false" class="text-white focus:outline-none">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.348 5.652a.5.5 0 0 1 .708.707L11.707 10l3.35 3.646a.5.5 0 0 1-.707.707L11 10.707 7.65 14.354a.5.5 0 0 1-.707-.707L10.293 10 6.646 6.354a.5.5 0 1 1 .708-.707L11 9.293l3.65-3.647a.5.5 0 0 1 .698-.036z" />
                        </svg>
                    </button>
                </div>




                <!-- Agregar botón para mostrar detalles del error -->
                @if (session('errorDetails'))
                    <button @click="showDetails = true" class="text-white focus:outline-none mt-2 underline cursor-pointer">
                        Ver detalles del error
                    </button>
                @endif
            </div>
        @endif







        <div class="flex items-center justify-center">
            <form action="{{ route('admin.ubicacion.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 text-center">
                    <label for="nombre" class="block text-xl font-semibold mb-2 text-gray-600">Nombre de la
                        Ubicación</label>
                    <input type="text" name="nombre" id="nombre" class="w-48 border rounded-md p-2 border-opacity-50"
                        required>
                </div>

                <div class="mb-4 text-center">
                    <label for="direccion" class="block text-xl font-semibold mb-2 text-gray-600">Dirección</label>
                    <input type="text" name="direccion" id="direccion"
                        class="w-48 border rounded-md p-2 text-xl border-opacity-50" required>

                    @error('nombre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 text-center">
                    <label for="enlace_maps" class="block text-xl font-semibold mb-2 text-gray-600">Enlace de Google
                        Maps</label>
                    <input type="text" name="enlace_maps" id="enlace_maps"
                        class="w-48 border rounded-md p-2 text-xl border-opacity-50">

                    @error('direccion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 text-center">
                    <label for="iframe" class="block text-xl font-semibold mb-2 text-gray-600">Iframe</label>
                    <textarea name="iframe" id="iframe" class="w-48 border rounded-md text-xl p-2 border-opacity-50" rows="4"></textarea>
                </div>

                <div class="mb-4 text-center">
                    <label for="imagen" class="block text-xl font-semibold mb-2 text-gray-600">Imagen</label>
                    <input type="file" name="imagen" id="imagen"
                        class="w-48 border text-xl rounded-md p-2 border-opacity-50" onchange="previewImage()">


                    <div id="imagen-preview" class="mt-2"></div>

                    @error('imagen')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4 text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2  text-xl px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                        Agregar Ubicación
                    </button>

                    <div class="mt-4 text-center">
                        <button onclick="location.href='{{ route('admin.ubicacion.index') }}'"
                            class="bg-red-500 text-white text-xl py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none">
                            Volver
                        </button>
                    </div>
                </div>

                {{-- Previsualizacion de la imagen --}}
                <script>
                    function previewImage() {
                        const input = document.getElementById('imagen');
                        const previewContainer = document.getElementById('imagen-preview');
                        const previewImage = previewContainer.querySelector('img') || document.createElement('img');

                        if (input.files && input.files[0]) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                            };

                            reader.readAsDataURL(input.files[0]);

                            if (!previewImage.parentNode) {
                                previewImage.setAttribute('class', 'w-48 h-48 rounded-md mt-2');
                                previewContainer.appendChild(previewImage);
                            }
                        } else {
                            previewImage.src = null;
                            previewContainer.innerHTML = ''; // Limpiar si no hay imagen seleccionada
                        }
                    }
                </script>


            </form>

            <script src="{{ asset('js/validacionesAdmin.js') }}" defer></script>

        </div>



    </x-administrador>
