@props(['user', 'size' => 'lg'])

@php
    $sizes = [
        'sm' => 'w-16 h-16 text-xl',
        'md' => 'w-24 h-24 text-2xl',
        'lg' => 'w-32 h-32 text-3xl',
        'xl' => 'w-40 h-40 text-4xl',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['lg'];
@endphp

@if ($user->foto)
    <img {{ $attributes->merge(['class' => "rounded-full object-cover ring-4 ring-indigo-100 $sizeClass"]) }}
        src="{{ Storage::url($user->foto) }}"
        alt="Foto de {{ $user->name }}">
@else
    <div {{ $attributes->merge(['class' => "rounded-full bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center text-white font-bold ring-4 ring-indigo-100 $sizeClass"]) }}
        aria-hidden="true">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif
