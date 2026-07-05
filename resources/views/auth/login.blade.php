<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1920&q=80');">
        </div>
        <div class="absolute inset-0 bg-indigo-900/70"></div>

        <div class="relative w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Iniciar sesión</h1>

                <x-auth-error-alert class="mb-5" />

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" class="block mt-1 w-full @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" type="password" name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                        </label>
                    </div>

                    <x-primary-button class="w-full justify-center">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm">
                        @if (Route::has('password.request'))
                            <a class="text-indigo-600 hover:text-indigo-800"
                                href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">
                            ¿No tienes cuenta? <span class="text-indigo-600 font-medium">Regístrate</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
