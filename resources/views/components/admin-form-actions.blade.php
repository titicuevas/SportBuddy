@props(['label', 'cancelRoute', 'submitLabel' => 'Guardar'])

<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
    <a href="{{ $cancelRoute }}"
        class="inline-flex justify-center px-4 py-2.5 rounded-lg text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
        Cancelar
    </a>
    <button type="submit"
        class="inline-flex justify-center px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
        {{ $submitLabel }}
    </button>
</div>
