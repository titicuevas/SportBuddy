<x-administrador>
    <x-slot name="title">Superficies</x-slot>

    <x-admin-page-header
        title="Superficies"
        description="Tipos de superficie de las pistas."
        :create-route="route('admin.superficie.create')"
        create-label="Nueva superficie"
    />

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tipo</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($superficies as $superficie)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $superficie->tipo }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.superficie.edit', $superficie) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100">
                                Editar
                            </a>
                            <x-admin-delete-button
                                :action="route('admin.superficie.destroy', $superficie)"
                                title="Eliminar superficie"
                                message="¿Eliminar la superficie «{{ $superficie->tipo }}»?"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-gray-500">No hay superficies.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $superficies->links() }}</div>
</x-administrador>
