<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{--  <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div> --}}
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            {{-- Editar Foto --}}

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1>Editar foto</h1>
                    <img src="{{ $user->foto ? Storage::url($user->foto) : asset('images/default-profile.png') }}"
                        alt="{{ $user->name }}'s profile picture">


                </div>

                <div class="form-group">
                    <label for="foto">Cambiar foto</label>
                    <br>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">

                </div>

                {{-- Boton eliminar --}}

                
                <button type="button" class="btn btn-danger" id="btn-eliminar">Eliminar foto de perfil</button>
                <script>
                    // Manejar la eliminación de la foto de perfil
                    $('#btn-eliminar').click(function() {
                        // Confirmar la eliminación con el usuario
                        var respuesta = confirm('¿Está seguro de que desea eliminar la foto de perfil?');

                        if (respuesta) {
                            // Establecer el campo foto en nulo
                            $('#foto').val(null);

                            // Enviar el formulario para actualizar el perfil del usuario
                            $(this).closest('form').submit();
                        }

                    });
                </script>
            </div>




            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
