@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-semibold text-indigo-600 bg-indigo-50 rounded-lg transition-colors'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
