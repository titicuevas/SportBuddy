<header class="sticky top-0 z-40 bg-gradient-to-r from-indigo-600 via-indigo-500 to-emerald-500 shadow-lg" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 group">
                <x-application-logo class="h-10 w-auto drop-shadow-sm group-hover:scale-105 transition-transform" />
                <span class="text-xl font-bold text-white tracking-tight">SportBuddy</span>
            </a>

            <nav class="hidden sm:flex items-center gap-3" aria-label="Acceso">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium text-white/90 hover:text-white border border-white/30 rounded-lg hover:bg-white/10 transition-colors">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 text-sm font-semibold text-indigo-700 bg-white rounded-lg hover:bg-indigo-50 shadow-sm transition-colors">
                    Registrarse
                </a>
            </nav>

            <button type="button" @click="open = !open" :aria-expanded="open"
                class="sm:hidden p-2 rounded-lg text-white hover:bg-white/10 transition-colors"
                aria-label="Abrir menú">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div x-show="open" x-cloak x-transition class="sm:hidden pb-4 space-y-2">
            <a href="{{ route('login') }}"
                class="block w-full text-center px-4 py-2 text-sm font-medium text-white border border-white/30 rounded-lg hover:bg-white/10">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
                class="block w-full text-center px-4 py-2 text-sm font-semibold text-indigo-700 bg-white rounded-lg hover:bg-indigo-50">
                Registrarse
            </a>
        </div>
    </div>
</header>
