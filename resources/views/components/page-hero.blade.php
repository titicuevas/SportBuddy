@props(['title', 'subtitle' => null])

<section {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-600 to-emerald-500 py-10']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl font-bold text-white">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-2 text-indigo-100 text-lg">{{ $subtitle }}</p>
        @endif
    </div>
</section>
