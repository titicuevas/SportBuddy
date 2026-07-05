<x-admin-form-card title="Editar pista" :back-route="route('admin.pista.index')">
    <form action="{{ route('admin.pista.update', $pista) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')

        <x-admin-select label="Ubicación" name="ubicacion_id" :required="true">
            @foreach ($ubicaciones as $ubicacion)
                <option value="{{ $ubicacion->id }}" @selected(old('ubicacion_id', $pista->ubicacion_id) == $ubicacion->id)>
                    {{ $ubicacion->nombre }}
                </option>
            @endforeach
        </x-admin-select>

        <x-admin-select label="Superficie" name="superficie_id" :required="true">
            @foreach ($superficies as $superficie)
                <option value="{{ $superficie->id }}" @selected(old('superficie_id', $pista->superficie_id) == $superficie->id)>
                    {{ $superficie->tipo }}
                </option>
            @endforeach
        </x-admin-select>

        <x-admin-select label="Deporte" name="deporte_id" :required="true">
            @foreach ($deportes as $deporte)
                <option value="{{ $deporte->id }}" @selected(old('deporte_id', $pista->deporte_id) == $deporte->id)>
                    {{ $deporte->nombre }}
                </option>
            @endforeach
        </x-admin-select>

        <x-admin-field label="Número de pista" name="numero" type="number" :value="$pista->numero" :min="1" :required="true" />
        <x-admin-field label="Precio con luz (€)" name="precio_con_luz" type="number" step="0.01" :min="0" :value="$pista->precio_con_luz" />
        <x-admin-field label="Precio sin luz (€)" name="precio_sin_luz" type="number" step="0.01" :min="0" :value="$pista->precio_sin_luz" :required="true" />

        <x-admin-form-actions :cancel-route="route('admin.pista.index')" submit-label="Guardar cambios" />
    </form>
</x-admin-form-card>
