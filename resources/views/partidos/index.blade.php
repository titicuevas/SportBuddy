<x-app-layout>

    <div class="container mx-auto">
        <table class="table w-full mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="text-left text-gray-800">Fecha</th>
                    <th class="text-left text-gray-800">Hora</th>
                    <th class="text-left text-gray-800">Creador</th>
                    <th class="text-left text-gray-800">Ubicación</th>

                    <th class="text-left text-gray-800">Deporte</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partidos as $partido)
                    <tr>
                        <td class="text-gray-800">{{ $partido->fecha }}</td>
                        <td class="text-gray-800">{{ $partido->hora }}</td>
                        <td class="text-gray-800">{{ $partido->user->name }}</td>
                        <td class="text-gray-800">{{ $partido->ubicacion->nombre}}</td>

                        <td class="text-gray-800">{{ $partido->deporte->nombre }}</td>



                        <td class="text-right">
                            <a href="{{ route('partidos.show', $partido->id) }}" class="btn btn-sm btn-primary">Ver partido</a>
                        </td>


                        <td class="text-right">
                            <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
