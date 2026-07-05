@props(['action', 'title' => 'Confirmar eliminación', 'message' => '¿Seguro que quieres eliminar este registro? Esta acción no se puede deshacer.'])

<form action="{{ $action }}" method="POST" x-data="{ open: false }" class="inline">
    @csrf
    @method('DELETE')

    <button type="button" @click="open = true"
        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
        Eliminar
    </button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-900/50" @click="open = false" aria-hidden="true"></div>
            <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
                <p class="mt-2 text-sm text-gray-600">{{ $message }}</p>
                <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
