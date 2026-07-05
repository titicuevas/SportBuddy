@props(['title' => 'Panel', 'description' => null, 'createRoute' => null, 'createLabel' => 'Crear nuevo'])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ $title }}</h2>
        @if ($description)
            <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
        @endif
    </div>

    @if ($createRoute)
        <a href="{{ $createRoute }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ $createLabel }}
        </a>
    @endif
</div>
