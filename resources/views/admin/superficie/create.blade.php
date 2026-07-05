<x-admin-form-card title="Nueva superficie" :back-route="route('admin.superficie.index')">
    <form action="{{ route('admin.superficie.store') }}" method="post" class="space-y-5">
        @csrf
        <x-admin-field label="Tipo de superficie" name="tipo" :required="true" placeholder="Ej. Césped artificial" />
        <x-admin-form-actions :cancel-route="route('admin.superficie.index')" submit-label="Crear superficie" />
    </form>
</x-admin-form-card>
