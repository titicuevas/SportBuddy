<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1554068865-24cecd4e34b8?auto=format&fit=crop&w=1920&q=80');">
        </div>
        <div class="absolute inset-0 bg-emerald-900/70"></div>

        <div class="relative w-full max-w-md">
            <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 space-y-5" novalidate>
                @csrf

                <h1 class="text-2xl font-bold text-center text-gray-900">Crear cuenta</h1>

                <x-auth-error-alert />

                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                        :value="old('name')" autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <div id="nameError" class="text-sm text-red-600"></div>
                </div>

                <div>
                    <x-input-label for="apellidos" :value="__('Apellidos')" />
                    <x-text-input id="apellidos" class="mt-1 block w-full" type="text" name="apellidos"
                        :value="old('apellidos')" autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                    <div id="apellidosError" class="text-sm text-red-600"></div>
                </div>

                <div>
                    <x-input-label for="telefono" :value="__('Teléfono')" />
                    <x-text-input id="telefono" class="mt-1 block w-full" type="text" name="telefono"
                        :value="old('telefono')" autocomplete="tel" pattern="\d*" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    <div id="telefonoError" class="text-sm text-red-600"></div>
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                        :value="old('email')" autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div id="emailError" class="text-sm text-red-600"></div>
                </div>

                <div>
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <div id="passwordError" class="text-sm text-red-600"></div>
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                    <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password"
                        name="password_confirmation" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <div id="confirmPasswordError" class="text-sm text-red-600"></div>
                </div>

                <x-primary-button type="submit" class="w-full justify-center">
                    {{ __('Registrarse') }}
                </x-primary-button>

                <p class="text-center text-sm text-gray-600">
                    <a class="text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('login') }}">
                        {{ __('¿Ya tienes cuenta? Inicia sesión') }}
                    </a>
                </p>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/validacionesRegis.js') }}" defer></script>
</x-guest-layout>
