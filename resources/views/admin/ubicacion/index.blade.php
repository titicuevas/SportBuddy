<x-administrador>
    <x-slot name="title">Ubicaciones</x-slot>

    <x-admin-page-header
        title="Ubicaciones"
        description="Instalaciones y sedes donde se juegan los partidos."
        :create-route="route('admin.ubicacion.create')"
        create-label="Nueva ubicación"
    />

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nombre</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Dirección</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Imagen</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Maps</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($ubicaciones as $ubicacion)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $ubicacion->nombre }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $ubicacion->direccion }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ $ubicacion->image_path }}" alt="{{ $ubicacion->nombre }}"
                                class="w-12 h-12 rounded-lg object-cover" loading="lazy">
                        </td>
                        <td class="px-4 py-3">
                            @if ($ubicacion->enlace_maps)
                                <a href="{{ $ubicacion->enlace_maps }}" target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">Ver mapa</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.ubicacion.edit', $ubicacion) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100">
                                Editar
                            </a>
                            <x-admin-delete-button
                                :action="route('admin.ubicacion.destroy', $ubicacion)"
                                title="Eliminar ubicación"
                                message="¿Eliminar «{{ $ubicacion->nombre }}»?"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay ubicaciones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $ubicaciones->links() }}</div>
</x-administrador>
