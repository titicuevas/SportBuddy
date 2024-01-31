<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Actualizar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asegúrate de que tu cuenta esté utilizando una contraseña larga y aleatoria para que permanezca segura') }}
        </p>
    </header>

    <form id="password-form" method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <x-input-label for="current_password" :value="__('Contraseña Actual')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            <div id="currentPasswordError" class="text-sm text-red-600"></div>
        </div>

        <!-- Nueva contraseña -->
        <div>
            <x-input-label for="password" :value="__('Nueva Contraseña')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <div id="newPasswordError" class="text-sm text-red-600"></div>
        </div>

        <!-- Confirmar nueva contraseña -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            <div id="confirmPasswordError" class="text-sm text-red-600"></div>
        </div>

        <!-- Botón de Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
            @endif
        </div>

    </form>

    <script src="{{ asset('js/validacionesPass.js') }}" defer></script>

    <!-- Ventana modal de confirmación -->
    <div x-data="{ showSuccessModal: @if (session('status') === 'password-updated') true @else false @endif }" x-show="showSuccessModal" class="fixed inset-0 z-10 overflow-y-auto">
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
                    <h1 class="text-xl font-bold text-gray-900 mb-4">Contraseña actualizada</h1>
                    <p class="text-gray-700">Tu contraseña ha sido actualizada con éxito.</p>
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

</section>
