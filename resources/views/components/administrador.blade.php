@props(['title' => 'Panel'])

@php
    $navLinks = [
        ['route' => 'admin.index', 'label' => 'Inicio', 'pattern' => 'admin.index'],
        ['route' => 'admin.users.index', 'label' => 'Usuarios', 'pattern' => 'admin.users.*'],
        ['route' => 'admin.deportes.index', 'label' => 'Deportes', 'pattern' => 'admin.deportes.*'],
        ['route' => 'admin.ubicacion.index', 'label' => 'Ubicaciones', 'pattern' => 'admin.ubicacion.*'],
        ['route' => 'admin.superficie.index', 'label' => 'Superficies', 'pattern' => 'admin.superficie.*'],
        ['route' => 'admin.pista.index', 'label' => 'Pistas', 'pattern' => 'admin.pista.*'],
    ];

    $headerBackUrl = match (true) {
        request()->routeIs('admin.index') => route('dashboard'),
        request()->routeIs('admin.deportes.create', 'admin.deportes.edit') => route('admin.deportes.index'),
        request()->routeIs('admin.ubicacion.create', 'admin.ubicacion.edit') => route('admin.ubicacion.index'),
        request()->routeIs('admin.superficie.create', 'admin.superficie.edit') => route('admin.superficie.index'),
        request()->routeIs('admin.pista.create', 'admin.pista.edit') => route('admin.pista.index'),
        request()->routeIs('admin.users.index', 'admin.deportes.index', 'admin.ubicacion.index', 'admin.superficie.index', 'admin.pista.index') => route('admin.index'),
        default => route('admin.index'),
    };
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — Admin — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-slate-100 font-sans antialiased overflow-x-hidden">
    @if (session('success'))
        <x-flash-message>{{ session('success') }}</x-flash-message>
    @endif
    @if (session('error'))
        <x-flash-message type="error">{{ session('error') }}</x-flash-message>
    @endif

    <div class="min-h-screen lg:grid lg:grid-cols-[16rem_minmax(0,1fr)]" x-data="{ menuOpen: false }" @keydown.escape.window="menuOpen = false">
        {{-- Sidebar escritorio --}}
        <aside class="hidden lg:flex flex-col bg-slate-900 text-white min-h-screen">
            <div class="p-5 border-b border-white/10">
                <a href="{{ route('admin.index') }}" class="block">
                    <p class="text-xs uppercase tracking-wider text-slate-400">SportBuddy</p>
                    <p class="text-lg font-bold mt-1">Administración</p>
                </a>
            </div>
            <nav class="flex-1 p-3 space-y-1">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                        class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs($link['pattern']) ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-3 border-t border-white/10">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-center gap-2 w-full px-3 py-2.5 text-sm font-medium text-white border border-white/30 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a la app
                </a>
            </div>
        </aside>

        {{-- Menú móvil / tablet: pantalla completa, sin dejar contenido detrás --}}
        <div
            x-show="menuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="lg:hidden fixed inset-0 z-50 bg-slate-900 text-white flex flex-col"
        >
            <div class="p-4 flex items-center justify-between border-b border-white/10">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">SportBuddy</p>
                    <p class="font-bold">Administración</p>
                </div>
                <button type="button" @click="menuOpen = false" class="p-2 rounded-lg hover:bg-white/10" aria-label="Cerrar menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}" @click="menuOpen = false"
                        class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs($link['pattern']) ? 'bg-indigo-600 text-white' : 'text-slate-200 hover:bg-white/10' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-white/10">
                <a href="{{ route('dashboard') }}" @click="menuOpen = false"
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-semibold text-slate-900 bg-slate-100 rounded-lg hover:bg-white transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a la app
                </a>
            </div>
        </div>

        {{-- Contenido principal --}}
        <div class="flex flex-col min-w-0 min-h-screen w-full">
            <header class="sticky top-0 z-40 bg-white border-b border-slate-200 px-4 py-3 flex items-center gap-3">
                <button type="button" @click="menuOpen = true" class="lg:hidden p-2 -ml-1 rounded-lg hover:bg-slate-100" aria-label="Abrir menú">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <a href="{{ $headerBackUrl }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-600 shrink-0" title="Volver" aria-label="Volver">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ $title }}</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shrink-0">
                    Salir
                </a>
            </header>

            <main class="flex-1 w-full max-w-6xl mx-auto p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
