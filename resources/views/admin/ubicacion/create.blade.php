<x-admin-form-card title="Nueva ubicación" :back-route="route('admin.ubicacion.index')">
    <form action="{{ route('admin.ubicacion.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <x-admin-field label="Nombre" name="nombre" :required="true" />
        <x-admin-field label="Dirección" name="direccion" :required="true" />

        <div>
            <label for="enlace_maps" class="block text-sm font-medium text-slate-700 mb-1.5">Enlace de Google Maps</label>
            <input type="url" name="enlace_maps" id="enlace_maps" value="{{ old('enlace_maps') }}"
                class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('enlace_maps')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="iframe" class="block text-sm font-medium text-slate-700 mb-1.5">Iframe del mapa (opcional)</label>
            <textarea name="iframe" id="iframe" rows="4"
                class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('iframe') }}</textarea>
            @error('iframe')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="imagen" class="block text-sm font-medium text-slate-700 mb-1.5">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" accept="image/*"
                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                onchange="previewUbicacionImage(event)">
            <div id="imagen-preview" class="mt-3"></div>
            @error('imagen')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-admin-form-actions :cancel-route="route('admin.ubicacion.index')" submit-label="Crear ubicación" />
    </form>

    <script>
        function previewUbicacionImage(event) {
            const preview = document.getElementById('imagen-preview');
            preview.innerHTML = '';
            const file = event.target.files?.[0];
            if (!file) return;
            const img = document.createElement('img');
            img.className = 'max-h-40 rounded-lg border border-slate-200';
            img.src = URL.createObjectURL(file);
            preview.appendChild(img);
        }
    </script>
</x-admin-form-card>
