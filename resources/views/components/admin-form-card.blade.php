@props([
    'title',
    'backRoute',
    'backLabel' => 'Volver al listado',
])

<x-administrador>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="max-w-2xl">
        <a href="{{ $backRoute }}"
            class="inline-flex items-center gap-1 text-sm font-medium text-slate-600 hover:text-indigo-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ $backLabel }}
        </a>

        <div class="mt-4 bg-white rounded-xl border border-slate-200 shadow-sm p-6 sm:p-8">
            <h2 class="text-xl font-bold text-slate-900 mb-6">{{ $title }}</h2>
            {{ $slot }}
        </div>
    </div>
</x-administrador>
