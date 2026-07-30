<x-guest-layout>
    <div class="relative min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4">
        <div class="relative w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 text-center">
                <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-3">Verifica tu correo</h1>
                <p class="text-sm text-gray-600 mb-6">
                    Te hemos enviado un enlace a <strong>{{ auth()->user()->email }}</strong>.
                    Haz clic en el enlace para activar tu cuenta y acceder a SportBuddy.
                </p>

                @if (session('status') === 'verification-link-sent')
                    <div class="mb-4 p-3 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg">
                        Hemos reenviado el correo de verificación.
                    </div>
                @endif

                @if (config('mail.default') === 'log')
                    <div class="mb-4 p-3 text-sm text-amber-800 bg-amber-50 rounded-lg text-left">
                        <strong>Modo desarrollo:</strong> el correo no se envía por SMTP.
                        Busca el enlace en <code class="text-xs">storage/logs/laravel.log</code>.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                    @csrf
                    <x-primary-button class="w-full justify-center">
                        Reenviar correo
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                        Cerrar sesión y usar otra cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
