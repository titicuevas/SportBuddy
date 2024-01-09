<x-guest-layout>

    <!-- Cabecera -->
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-left items-center">
            <a href="{{ url('/') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h1 class="text-3xl text-center font-bold">SportBuddy</h1>
        </div>
    </header>

    <div class="mb-8 text-xl text-center text-gray-600">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Gif -->
    <div class="flex items-center justify-center mb-4">
        <img src="https://images.ctfassets.net/l3l0sjr15nav/6oNs9pKBWwOe46eSey20Qc/b69d9cc64685f8fc64d7e3de5f0846f7/giphy__1_.gif"
            alt="Gif" class="w-100 h-80">
    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="max-w-md mx-auto">
        @csrf

        <!-- Dirección de correo electrónico -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center text-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar enlace para restablecer la contraseña por correo electrónico') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
