<x-admin-form-card title="Editar ubicación" :back-route="route('admin.ubicacion.index')">
    <form action="{{ route('admin.ubicacion.update', $ubicacion) }}" method="post" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <x-admin-field label="Nombre" name="nombre" :value="$ubicacion->nombre" :required="true" />
        <x-admin-field label="Dirección" name="direccion" :value="$ubicacion->direccion" :required="true" />

        <div>
            <label for="enlace_maps" class="block text-sm font-medium text-slate-700 mb-1.5">Enlace de Google Maps</label>
            <textarea name="enlace_maps" id="enlace_maps" rows="3"
                class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('enlace_maps', $ubicacion->enlace_maps) }}</textarea>
            @error('enlace_maps')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="iframe" class="block text-sm font-medium text-slate-700 mb-1.5">Iframe del mapa</label>
            <textarea name="iframe" id="iframe" rows="4"
                class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('iframe', $ubicacion->iframe) }}</textarea>
            @error('iframe')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="imagen" class="block text-sm font-medium text-slate-700 mb-1.5">Nueva imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" accept="image/*"
                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @if ($ubicacion->imagen)
                <p class="mt-2 text-xs text-slate-500">Imagen actual: {{ $ubicacion->imagen }}</p>
                <img src="{{ $ubicacion->image_path }}" alt="Imagen actual" class="mt-2 max-h-40 rounded-lg border border-slate-200">
            @endif
            @error('imagen')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-admin-form-actions :cancel-route="route('admin.ubicacion.index')" submit-label="Guardar cambios" />
    </form>
</x-admin-form-card>
