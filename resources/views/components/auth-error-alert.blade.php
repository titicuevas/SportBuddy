@props(['messages' => null])

@php
    $items = array_unique($messages ?? $errors->all());
@endphp

@if (count($items) > 0)
    <div {{ $attributes->merge(['class' => 'mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800']) }} role="alert">
        <div class="flex gap-3">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm space-y-1">
                @foreach ($items as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endif
