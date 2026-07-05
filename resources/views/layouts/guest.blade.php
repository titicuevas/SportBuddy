<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SportBuddy - Encuentra partidos deportivos y conoce nuevos compañeros de juego.">

    <title>{{ config('app.name', 'SportBuddy') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased min-h-screen flex flex-col bg-gray-50">
    <x-guest-header />
    <x-cookie-banner />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-site-footer />
</body>

</html>
