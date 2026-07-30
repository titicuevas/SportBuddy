<x-administrador>
    <x-slot name="title">Usuarios</x-slot>

    <x-admin-page-header title="Usuarios" description="Gestiona las cuentas registradas en la plataforma." />

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nombre</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Apellidos</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Teléfono</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Correo electrónico</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->apellidos }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->telefono }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-right">
                            @if ($user->id !== auth()->id())
                                <x-admin-delete-button
                                    :action="route('admin.users.destroy', $user)"
                                    title="Eliminar usuario"
                                    message="¿Seguro que quieres eliminar a {{ $user->name }}? Esta acción no se puede deshacer."
                                />
                            @else
                                <span class="text-xs text-gray-400">Tu cuenta</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay usuarios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
</x-administrador>
