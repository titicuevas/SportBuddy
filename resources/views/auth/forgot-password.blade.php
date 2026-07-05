<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="absolute inset-0 bg-cover bg-center opacity-20"
            style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1920&q=80');">
        </div>

        <div class="relative w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">Recuperar contraseña</h1>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Indica tu email y te enviaremos un enlace para restablecer la contraseña.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-full justify-center">
                        Enviar enlace
                    </x-primary-button>
                    <p class="text-center text-sm">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Volver al login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
