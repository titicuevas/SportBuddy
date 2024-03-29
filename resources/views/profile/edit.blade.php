<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 text-center leading-tight">
            {{('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 xl:px-8 flex justify-center items-center h-full">
            <div class="space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-2xl max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>

                {{-- FOTO --}}
                <div class="p-4 sm:p-8 bg-white rounded-lg max-w-xl">
                    <div>
                        <h2 class="text-xl font-medium text-gray-900 mb-4 text-center">Cambiar Foto</h2>

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
                        <div class="flex justify-center items-center space-x-4">
                            <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" id="btn-examinar-foto">
                                Examinar
                            </button>

                            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hidden" id="btn-eliminar-foto">
                                Eliminar foto de perfil
                            </button>

                            <button type="button" class="bg-green-500 text-white py-2 px-4 rounded" id="btn-guardar-foto"
                                disabled>
                                Guardar foto
                            </button>

                            {{-- Formulario para actualizar foto --}}
                            <form action="{{ route('profile.update-foto') }}" method="post"
                                enctype="multipart/form-data" id="form-actualizar-foto">
                                @csrf
                                @method('post')

                                <div class="mb-4">
                                    <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                                </div>

                                <!-- Agregamos un campo oculto para indicar si la foto fue eliminada -->
                                <input type="hidden" name="foto_eliminada" id="foto_eliminada" value="0">

                                <button type="submit" class="hidden"></button>
                            </form>
                        </div>
                    </div>
                <script>
                    // Agregar evento al cargar la página
                    document.addEventListener("DOMContentLoaded", function() {
                        // Obtener referencias a los elementos
                        var btnExaminar = document.getElementById('btn-examinar-foto');
                        var btnEliminar = document.getElementById('btn-eliminar-foto');
                        var btnGuardar = document.getElementById('btn-guardar-foto');
                        var imgPerfil = document.getElementById('imgPerfil');
                        var inputFoto = document.getElementById('foto');

                        // Deshabilitar el botón "Guardar foto" al cargar la página
                        btnGuardar.disabled = true;

                        // Botón "Examinar foto"
                        btnExaminar.addEventListener('click', function() {
                            inputFoto.click();
                        });

                        btnEliminar.addEventListener('click', function() {
                            var respuesta = confirm('¿Está seguro de que desea eliminar la foto de perfil?');

                            if (respuesta) {
                                // Actualizar la vista previa
                                imgPerfil.src = 'https://mastermdi.com/files/students/noImage.jpg';
                                // Ocultar el botón de eliminar
                                btnEliminar.classList.add('hidden');
                                // Mostrar el botón de examinar
                                btnExaminar.classList.remove('hidden');
                                // Limpiar el valor del input file
                                inputFoto.value = null;
                                // Deshabilitar el botón "Guardar foto"
                                btnGuardar.disabled = true;

                                // Indicar que la foto fue eliminada
                                document.getElementById('foto_eliminada').value = 1;

                                // Enviar el formulario para eliminar la foto
                                formActualizarFoto.submit();
                            }
                        });

                        // Botón "Guardar foto"
                        btnGuardar.addEventListener('click', function() {
                            // Enviar el formulario completo para actualizar el perfil del usuario
                            var formData = new FormData(document.getElementById('form-actualizar-foto'));

                            fetch("{{ route('profile.update-foto') }}", {
                                    method: "POST",
                                    body: formData,
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'error') {
                                        // Mostrar mensaje de error al usuario
                                        alert(data.message);
                                    } else {
                                        // Actualizar la vista previa de la foto
                                        imgPerfil.src = data.fotoPerfilURL;
                                        // Deshabilitar el botón "Guardar foto" nuevamente
                                        btnGuardar.disabled = true;

                                        // Mostrar mensaje de éxito al usuario
                                        alert('Foto actualizada');
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        });


                        // Manejar el cambio de la foto
                        inputFoto.addEventListener('change', function() {
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

                            // Mostrar el botón de eliminar y ocultar el de examinar
                            btnEliminar.classList.remove('hidden');
                            btnExaminar.classList.add('hidden');
                            // Habilitar el botón "Guardar foto"
                            btnGuardar.disabled = false;
                        });
                    });
                </script>
            </div>

            {{-- DELETE --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-xl max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
