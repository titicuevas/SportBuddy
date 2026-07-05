<x-administrador>
    <x-slot name="title">Deportes</x-slot>

    <x-admin-page-header
        title="Deportes"
        description="Catálogo de deportes disponibles en la plataforma."
        :create-route="route('admin.deportes.create')"
        create-label="Nuevo deporte"
    />

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nombre</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($deportes as $deporte)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ \App\Models\Deporte::coverImageUrl($deporte->nombre) }}"
                                    alt="{{ $deporte->nombre }}"
                                    class="w-10 h-10 rounded-lg object-cover"
                                    loading="lazy">
                                <span class="font-medium text-gray-900">{{ $deporte->nombre }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.deportes.edit', $deporte) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100">
                                Editar
                            </a>
                            <x-admin-delete-button
                                :action="route('admin.deportes.destroy', $deporte)"
                                title="Eliminar deporte"
                                message="¿Eliminar el deporte «{{ $deporte->nombre }}»?"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-gray-500">No hay deportes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $deportes->links() }}</div>
</x-administrador>
