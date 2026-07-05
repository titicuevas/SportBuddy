<nav x-data="{ open: false }" class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm" aria-label="Navegación principal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <x-application-logo class="h-9 w-auto group-hover:scale-105 transition-transform" />
                    <span class="hidden sm:inline text-lg font-bold bg-gradient-to-r from-indigo-600 to-emerald-500 bg-clip-text text-transparent">
                        SportBuddy
                    </span>
                </a>

                <div class="hidden sm:flex items-center gap-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('partidos.index')" :active="request()->routeIs('partidos.*')">
                        {{ __('Partidos') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button"
                            aria-label="Menú de usuario"
                            aria-haspopup="true"
                            class="inline-flex items-center gap-3 px-3 py-1.5 rounded-full border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50/50 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @if (Auth::user()->foto)
                                <img src="{{ Storage::url(Auth::user()->foto) }}" alt="Foto de {{ Auth::user()->name }}"
                                    class="w-8 h-8 rounded-full object-cover ring-2 ring-indigo-100">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center text-white text-sm font-bold" aria-hidden="true">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-sm font-medium text-gray-700 max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Auth::user()->esAdmin())
                            <x-dropdown-link :href="route('admin.index')">
                                {{ __('Modo Admin') }}
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button type="button" @click="open = !open" :aria-expanded="open"
                    aria-label="Abrir menú de navegación"
                    class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open }" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" x-cloak class="hidden sm:hidden border-t border-gray-100 bg-white">
        <div class="px-4 pt-3 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('partidos.index')" :active="request()->routeIs('partidos.*')">
                {{ __('Partidos') }}
            </x-responsive-nav-link>
        </div>

        <div class="px-4 py-3 border-t border-gray-100">
            <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
        </div>

        <div class="px-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">{{ __('Perfil') }}</x-responsive-nav-link>
            @if (Auth::user()->esAdmin())
                <x-responsive-nav-link :href="route('admin.index')">{{ __('Modo Admin') }}</x-responsive-nav-link>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
