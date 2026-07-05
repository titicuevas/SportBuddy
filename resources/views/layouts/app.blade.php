<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SportBuddy - Encuentra partidos deportivos y conoce nuevos compañeros de juego.">

    <title>{{ config('app.name', 'SportBuddy') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
    <link rel="dns-prefetch" href="https://images.unsplash.com">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex flex-col min-h-screen bg-gray-100">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:rounded-md">
        Saltar al contenido principal
    </a>

    @include('layouts.navigation')

    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <main id="main-content" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="mt-auto" role="contentinfo">
        <x-site-footer />
    </footer>
</body>

</html>
