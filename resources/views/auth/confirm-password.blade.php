<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="relative w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-3">Confirmar contraseña</h1>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Esta es una zona segura. Confirma tu contraseña antes de continuar.
                </p>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="password" value="Contraseña" />
                        <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <x-primary-button class="w-full justify-center">
                        Confirmar
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
