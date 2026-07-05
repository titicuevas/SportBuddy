<x-admin-form-card title="Editar superficie" :back-route="route('admin.superficie.index')">
    <form action="{{ route('admin.superficie.update', $superficie) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')
        <x-admin-field label="Tipo de superficie" name="tipo" :value="$superficie->tipo" :required="true" />
        <x-admin-form-actions :cancel-route="route('admin.superficie.index')" submit-label="Guardar cambios" />
    </form>
</x-admin-form-card>
