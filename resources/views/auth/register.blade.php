<x-guest-layout>

    <!-- Cabecera -->
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-left items-center">
            <a href="{{ url('/') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h1 class="text-4xl font-bold ml-2">SportBuddy</h1>
        </div>
    </header>

    {{-- Fondo --}}

    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex justify-center items-center"
            style="background-image: url('https://www.campinglanoguera.com/uploads/media/pages/pista-de-padel/pista-de-padel.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <!-- Contenedor del formulario con fondo blanco y sombra -->
            <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 p-6 rounded-lg shadow-md">

                <!-- Formulario de registro -->
                <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                    class="max-w-md mx-auto mt-4 p-6 bg-white rounded-lg shadow-md space-y-6">
                    @csrf

                    <h1 class="text-3xl text-center font-bold">Registro</h1>

                    <!-- Nombre -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div id="nameError" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Apellidos -->
                    <div>
                        <x-input-label for="apellidos" :value="__('Apellidos')" />
                        <x-text-input id="apellidos" class="mt-1 block w-full" type="text" name="apellidos"
                            :value="old('apellidos')" autofocus autocomplete="apellidos" />
                        <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                        <div id="apellidosError" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <x-input-label for="telefono" :value="__('Telefono')" />
                        <x-text-input id="telefono" class="mt-1 block w-full" type="text" name="telefono"
                            :value="old('telefono')" autofocus autocomplete="telefono" pattern="\d*" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        <div id="telefonoError" class="text-sm text-red-600"></div>
                    </div>


                    <!-- Correo Electrónico -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                            :value="old('email')" autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div id="emailError" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div id="passwordError" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                        <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password"
                            name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <div id="confirmPasswordError" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Botón de Registrar -->
                    <div class="flex items-center justify-between mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('¿Ya estás registrado?') }}
                        </a>
                        <x-primary-button type="submit">
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/validacionesRegis.js') }}" defer></script>
    </body>

</x-guest-layout>
