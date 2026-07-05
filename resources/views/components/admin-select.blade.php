@props(['label', 'name', 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">{{ $label }}</label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500']) }}
    >
        {{ $slot }}
    </select>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
