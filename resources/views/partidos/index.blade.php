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
                {{ $partidos }}
                @foreach ($partidos as $partido)
                    <tr id="partido-{{ $partido->id }}">
                        <td class="text-gray-800">{{ $partido->fecha }}</td>
                        <td class="text-gray-800">{{ $partido->hora }}</td>
                        <td class="text-gray-800">{{ $partido->user->name }} <a href="{{ route('profile.show', $partido->user->id) }}" class="text-blue-500 hover:text-blue-700 underline">Ver perfil</a></td>
                        <td class="text-gray-800">{{ $partido->ubicacion->nombre }}</td>
                        <td class="text-gray-800">{{ $partido->deporte->nombre }}</td>



                        <td class="text-right">
                            <a href="{{ route('partidos.show', $partido->id) }}" class="btn btn-sm btn-primary">Ver
                                partido</a>
                        </td>


                        <td class="text-right">
                            <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger delete-partido"
                                    data-partido-id="{{ $partido->id }}">Eliminar</button>
                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-partido').on('click', function() {
                // Get the ID of the partido to be deleted
                const partidoId = $(this).data('partido-id');

                // Send a POST request to the 'destroy' route with the partido ID
                $.post('/partidos/' + partidoId, {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                }, function(data) {
                    // If the request is successful, remove the partido row from the table
                    if (data === 'Partido eliminado correctamente.') {
                        $('#partido-' + partidoId).remove();

                        // Print asignaciones for the deleted partido
                        printAsignaciones(partido);
                    }
                });
            });
        });

        function printAsignaciones(partido) {
            for (const asignacion of partido.asignaciones) {
                console.log(asignacion);
            }
        }
    </script>
</x-app-layout>
