<div class="flex items-center justify-center">
    <h1 class="text-4xl text-blue-500 mb-6">USUARIOS</h1>
</div>

<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Nombre</th>
            <th class="py-2 px-4 border-b">Apellidos</th>
            <th class="py-2 px-4 border-b">Telefono</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Acciones</th> <!-- Nueva columna para acciones -->
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->apellidos }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->telefono }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post"
                        onsubmit="return confirm('¿Estás seguro de borrar a {{ $user->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white focus:outline-none px-4 py-2 rounded">
                            Eliminar
                        </button>

                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
