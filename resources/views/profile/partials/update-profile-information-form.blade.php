<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información de perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualiza la información de perfil y la dirección de correo electrónico de tu cuenta.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                autofocus autocomplete="name" />
            <!-- Muestra mensajes de error para el nombre -->
            <div class="mt-2 text-sm text-red-600" id="nameError"></div>
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('name')" />
        </div>

        <!-- Apellidos -->
        <div class="mb-4">
            <x-input-label for="apellidos" :value="__('Apellidos')" />
            <x-text-input id="apellidos" name="apellidos" type="text" class="mt-1 block w-full" :value="old('apellidos', $user->apellidos)"
                required autofocus autocomplete="apellidos" />
            <!-- Muestra mensajes de error para los apellidos -->
            <div class="mt-2 text-sm text-red-600" id="apellidosError"></div>
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('apellidos')" />
        </div>

        <!-- Teléfono -->
        <div class="mb-4">
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->telefono)"
                required autofocus autocomplete="telefono" />
            <!-- Muestra mensajes de error para el teléfono -->
            <div class="mt-2 text-sm text-red-600" id="telefonoError"></div>
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('telefono')" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <!-- Muestra mensajes de error para el correo electrónico -->
            <div class="mt-2 text-sm text-red-600" id="emailError"></div>
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón de Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
            @endif
        </div>

        <!-- Ventana modal de confirmación -->
        <div x-data="{ showSuccessModal: @if (session('status') === 'profile-updated') true @else false @endif }" x-show="showSuccessModal" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Cubierta oscura trasera -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Centro de la ventana modal -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Contenido de la ventana modal -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    style="max-width: 500px;">
                    <div class="bg-white p-5">
                        <h1 class="text-xl font-bold text-gray-900 mb-4">Información de perfil actualizada</h1>
                        <p class="text-gray-700">Tu información de perfil ha sido actualizada con éxito.</p>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" x-on:click="showSuccessModal = false"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300 sm:ml-3 sm:w-auto sm:text-sm">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('js/validaciones.js') }}" defer></script>
    </form>
</section>
