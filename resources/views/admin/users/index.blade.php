<x-administrador>


    @section('contenido')


        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="flex items-center justify-center mb-6">
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
                    <p class="text-center text-xl">{{ session('success') }}</p>
                </div>
            </div>
        @endif



        <div class="flex items-center justify-center">
            <h1 class="text-4xl text-blue-500 mb-6">USUARIOS</h1>
        </div>

        <table class="min-w-full bg-white border-2  border-gray-500">
            <thead>

                <tr>
                    <th class="py-2 text-xl border-gray-500 px-4 border-b-2">Nombre</th>
                    <th class="py-2 text-xl border-gray-500 px-4 border-b-2">Apellidos</th>
                    <th class="py-2 px-4   border-gray-500 text-xl border-b-2">Telefono</th>
                    <th class="py-2 px-4 border-gray-500 text-xl border-b-2">Email</th>
                    <th class="py-2 px-4 border-gray-500 text-xl border-b-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $user->name }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $user->apellidos }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $user->telefono }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-xl border-b-2 border-gray-500 text-center">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post"
                                onsubmit="return confirm('¿Estás seguro de borrar a {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500  hover:bg-red-700 text-white  focus:outline-none px-4 py-2 rounded">
                                    Eliminar
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}



    </x-administrador>
