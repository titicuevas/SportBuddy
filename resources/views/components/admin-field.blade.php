@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false, 'step' => null, 'min' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        @if ($step) step="{{ $step }}" @endif
        @if ($min !== null) min="{{ $min }}" @endif
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500']) }}
    >
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
