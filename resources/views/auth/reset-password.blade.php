<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="absolute inset-0 bg-indigo-900/10"></div>

        <div class="relative w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Nueva contraseña</h1>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <x-input-label for="email" value="Correo electrónico" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div id="emailError" class="mt-2 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div id="passwordError" class="mt-2 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <div id="confirmPasswordError" class="mt-2 text-sm text-red-600"></div>
                    </div>

                    <x-primary-button class="w-full justify-center">
                        Restablecer contraseña
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/validacionesRecup.js') }}" defer></script>
</x-guest-layout>
