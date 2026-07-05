<x-admin-form-card title="Editar deporte" :back-route="route('admin.deportes.index')">
    <form action="{{ route('admin.deportes.update', $deporte) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')
        <x-admin-field label="Nombre del deporte" name="nombre" :value="$deporte->nombre" :required="true" />
        <x-admin-form-actions :cancel-route="route('admin.deportes.index')" submit-label="Guardar cambios" />
    </form>
</x-admin-form-card>
