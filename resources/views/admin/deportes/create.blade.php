<x-admin-form-card title="Nuevo deporte" :back-route="route('admin.deportes.index')">
    <form action="{{ route('admin.deportes.store') }}" method="post" class="space-y-5">
        @csrf
        <x-admin-field label="Nombre del deporte" name="nombre" :required="true" />
        <x-admin-field
            label="Jugadores por equipo"
            name="jugadores_por_equipo"
            type="number"
            :value="old('jugadores_por_equipo', 1)"
            :required="true"
            :min="1"
        />
        <x-admin-form-actions :cancel-route="route('admin.deportes.index')" submit-label="Crear deporte" />
    </form>
</x-admin-form-card>
