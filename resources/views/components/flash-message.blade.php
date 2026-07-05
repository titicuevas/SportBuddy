@props(['type' => 'success'])

@php
    $styles = match ($type) {
        'error' => 'bg-red-500',
        'warning' => 'bg-yellow-500',
        'info' => 'bg-blue-600',
        default => 'bg-green-500',
    };
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    x-transition
    role="alert"
    aria-live="polite"
    class="fixed top-4 left-1/2 -translate-x-1/2 z-50 px-6 py-3 {{ $styles }} text-white rounded-lg shadow-lg max-w-lg w-[calc(100%-2rem)]"
>
    <p class="text-center text-base sm:text-lg font-medium">{{ $slot }}</p>
</div>
