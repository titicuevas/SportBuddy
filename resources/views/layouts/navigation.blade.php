<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <!-- Barra de Navegación Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div>
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-6 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Enlaces de Navegación -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Configuración de Usuario -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center space-x-2 px-4 py-2 border border-transparent text-2xl leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <!-- Muestra la imagen del perfil con un tamaño más grande -->
                                @if (Auth::user()->foto)
                                    <img src="{{ Storage::url(Auth::user()->foto) }}" class="w-16 h-16 rounded-full">
                                @else
                                    <img src="https://mastermdi.com/files/students/noImage.jpg"
                                        class="w-16 h-16 rounded-full">
                                @endif

                                <div class="ml-6">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-yellow-400 hover:text-white">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Auth::user()->rol_id === 1)
                            <x-dropdown-link :href="route('admin.index')" class="hover:bg-green-800  hover:text-white">
                                {{ __('Modo Admin') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Autenticación -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="hover:bg-red-700 hover:text-white"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Menú Hamburger para Dispositivos Móviles -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú de Navegación Responsivo -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden mt-4">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Opciones de Configuración Responsivas -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                @if (Auth::user()->rol_id === 1)
                    <x-dropdown-link :href="route('admin.index')">
                        {{ __('Modo Admin') }}
                    </x-dropdown-link>
                @endif

                <!-- Autenticación -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
