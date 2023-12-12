<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            {{-- FOTO --}}
            <div class="flex justify-center items-center p-6 bg-neutral-700 rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4 text-center">Cambiar Foto</h2>

                    {{-- Vista previa de la foto --}}
                    <div class="flex justify-center items-center mb-4">
                        @if ($user->foto)
                            <img class="h-48 w-48 border-2 border-black rounded-t mb-4" id="imgPerfil"
                                src="{{ Storage::url($user->foto) }}" alt="Foto de perfil" />
                        @else
                            <img class="h-48 w-48 border-2 border-black rounded-t mb-4" id="imgPerfil"
                                src="https://mastermdi.com/files/students/noImage.jpg" alt="usuario" />
                        @endif
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-center items-center mb-4 space-x-4">
                        <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" id="btn-examinar-foto">
                            Examinar
                        </button>

                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded" id="btn-eliminar-foto">
                            Eliminar foto de perfil
                        </button>

                        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded hidden"
                            id="btn-actualizar-foto">
                            Actualizar foto
                        </button>

                        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded" id="btn-guardar-foto">
                            Guardar foto
                        </button>
                    </div>

                    {{-- Formulario para actualizar foto --}}
                    <form action="{{ route('profile.update-foto') }}" method="post" enctype="multipart/form-data"
                        id="form-actualizar-foto">
                        @csrf
                        @method('post')

                        <div class="mb-4">
                            <label for="foto" class="text-gray-600">Actualizar Foto Perfil:</label>
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                        </div>

                        <button type="submit" class="hidden"></button>
                    </form>
                </div>
            </div>

            <script>
                // Agregar evento al cargar la página
                document.addEventListener("DOMContentLoaded", function() {
                    // Verificar si ya tiene una foto
                    var tieneFoto = {!! json_encode($user->foto) !!};

                    // Obtener referencias a los botones
                    var btnExaminar = document.getElementById('btn-examinar-foto');
                    var btnActualizar = document.getElementById('btn-actualizar-foto');

                    // Mostrar o ocultar botones según si tiene una foto
                    if (tieneFoto) {
                        btnExaminar.classList.add('hidden');
                        btnActualizar.classList.remove('hidden');
                    } else {
                        btnExaminar.classList.remove('hidden');
                        btnActualizar.classList.add('hidden');
                    }
                });





                // Botón "Examinar foto"
                document.getElementById('btn-examinar-foto').addEventListener('click', function() {
                    document.getElementById('foto').click();
                });

                // Botón "Eliminar foto"
                document.getElementById('btn-eliminar-foto').addEventListener('click', function() {
                    var respuesta = confirm('¿Está seguro de que desea eliminar la foto de perfil?');

                    if (respuesta) {
                        document.getElementById('foto').value = null;
                        document.getElementById('imgPerfil').src = 'https://mastermdi.com/files/students/noImage.jpg';
                        // Mostrar mensaje al usuario
                        alert('Foto eliminada');
                    }
                });

                // Botón "Guardar foto"
                document.getElementById('btn-guardar-foto').addEventListener('click', function() {
                    // Enviar el formulario para actualizar el perfil del usuario
                    document.getElementById('form-actualizar-foto').submit();
                    // Mostrar mensaje al usuario
                    alert('Foto actualizada');
                });

                // Manejar el cambio de la foto
                document.getElementById('foto').addEventListener('change', function() {
                    // Obtener la referencia a la imagen
                    var imgPerfil = document.getElementById('imgPerfil');

                    // Obtener la nueva imagen seleccionada
                    var nuevaFoto = this.files[0];

                    // Crear un objeto FileReader para leer la imagen
                    var reader = new FileReader();

                    // Cuando la lectura esté completa, actualizar la imagen
                    reader.onload = function(e) {
                        imgPerfil.src = e.target.result;
                    };

                    // Leer la nueva imagen como una URL de datos
                    reader.readAsDataURL(nuevaFoto);
                });
            </script>





            {{-- DELETE --}}



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
