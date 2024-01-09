<x-guest-layout>

    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-left items-center">
            <a href="{{ url('/') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h1 class="text-3xl text-center font-bold">SportBuddy</h1>
        </div>
    </header>

    <div class="flex items-center justify-center mt-8">
        <img src="https://i.giphy.com/aOften89vRbG.gif" alt="Mail Gif">
    </div>

    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte por correo electrónico? Si no recibiste el correo electrónico, con gusto te enviaremos otro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar correo de verificación') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="mt-4 flex items-center justify-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            {{-- <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Cerrar sesión') }}
            </button> --}}
        </form>
    </div>

    <div class="mt-8 text-center">
        <a href="https://mailtrap.io/inboxes" class="text-blue-500 underline hover:text-blue-700">
            {{ __('Ir a Mailtrap') }}
        </a>
    </div>

</x-guest-layout>
