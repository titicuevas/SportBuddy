<x-administrador>
    <x-slot name="title">Pistas</x-slot>

    <x-admin-page-header
        title="Pistas"
        description="Pistas deportivas asociadas a ubicaciones y deportes."
        :create-route="route('admin.pista.create')"
        create-label="Nueva pista"
    />

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Ubicación</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Deporte</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Superficie</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nº</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Precios</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($pistas as $pista)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-900">{{ $pista->ubicacion->nombre }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-2">
                                <img src="{{ \App\Models\Deporte::coverImageUrl($pista->deporte->nombre) }}"
                                    alt="" class="w-8 h-8 rounded object-cover" loading="lazy">
                                <span class="text-gray-700">{{ $pista->deporte->nombre }}</span>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $pista->superficie->tipo }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $pista->numero }}</td>
                        <td class="px-4 py-3 text-gray-600 text-xs">
                            <span>Sin luz: {{ $pista->precio_sin_luz ?? '—' }}€</span><br>
                            <span>Con luz: {{ $pista->precio_con_luz ?? '—' }}€</span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.pista.edit', $pista) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100">
                                Editar
                            </a>
                            <x-admin-delete-button
                                :action="route('admin.pista.destroy', $pista)"
                                title="Eliminar pista"
                                message="¿Eliminar la pista {{ $pista->numero }} de {{ $pista->ubicacion->nombre }}?"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">No hay pistas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $pistas->links() }}</div>
</x-administrador>
