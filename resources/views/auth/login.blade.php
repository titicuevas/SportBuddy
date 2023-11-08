<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <body class="font-sans text-gray-900 antialiased" style="background-color: #0e2343">
        <div class="min-h-screen flex flex-row">
            <div class="w-1/3">
                <img src="https://i.ibb.co/ZcyLsSV/Sport-Buddy.jpg" alt="Sport-Buddy" border="0">
            </div>

            <div class="w-1/3 flex justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ml-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="w-1/3">
                <img src="https://i.ibb.co/ZcyLsSV/Sport-Buddy.jpg" alt="Sport-Buddy" border="0">
            </div>
        </div>

    </body>
</x-guest-layout>
