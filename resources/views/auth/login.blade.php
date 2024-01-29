<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Cabecera -->
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-left items-center">
            <a href="{{ url('/') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h1 class="text-4xl text-center font-bold">SportBuddy</h1>
        </div>
    </header>


    <body class="font-sans    text-gray-900 antialiased relative">
        <!-- Sección para el fondo oscuro con opacidad -->
        <div class="min-h-screen flex justify-center items-center relative">
            <div class="absolute inset-0 bg-black opacity-40"></div>

            <!-- Fondo de la imagen con ajuste al tamaño del contenedor y opacidad -->
            <div class="absolute inset-0 bg-opacity-40"
                style="background-image: url('https://fotografias.larazon.es/clipping/cmsimages01/2022/11/01/092ABA32-05C5-444E-A719-26DA4F374734/98.jpg?crop=823,463,x0,y11&width=1900&height=1069&optimize=low&format=webply'); background-size: cover; background-attachment: fixed;">
            </div>

            <!-- Sección para el contenido del formulario -->
            <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 relative z-10">
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">

                    <form method="POST" action="{{ route('login') }}" class="w-full">
                        @csrf
                        <h1 class="text-3xl font-bold mb-4 text-center">Iniciar Sesión</h1>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif

                            <a href="{{ route('register') }}" class="text-sm text-gray-600">
                                {{ '¿No tienes una cuenta?' }} <span
                                    class="text-blue-500 cursor-pointer">Registrarse</span>
                            </a>



                            <x-primary-button>
                                {{ __('Iniciar sesión') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/validaciones.js') }}" defer></script>

    </body>
</x-guest-layout>
