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
                    class="text-sm text-emerald-600">Contraseña actualizada.</p>
            @endif
        </div>

    </form>

    <script src="{{ asset('js/validacionesPass.js') }}" defer></script>

</section>
