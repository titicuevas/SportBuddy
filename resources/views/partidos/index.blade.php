<x-app-layout>
    {{-- Crear la pista con éxito --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed inset-x-0 mx-auto top-4 px-4 py-2 bg-green-500 text-white rounded-md shadow-md">
            <p class="text-center text-base">{{ session('success') }}</p>
        </div>
    @endif

    <div class="container mx-auto mt-12 flex flex-wrap justify-center space-x-4">
        @forelse ($partidos as $partido)
            @php
                $fechaHoraPartido = \Carbon\Carbon::parse($partido->fecha_hora);
            @endphp
            @if ($fechaHoraPartido > \Carbon\Carbon::now())
                <article id="partido" class="card card2 w-96 mb-8">
                    <a href="{{ route('partidos.show', $partido) }}" name="partido" id="partido"
                        class="btn btn-sm btn-primary">
                        <header class="card__header bg-cover h-72"
                            style="background-image: url('{{ $partido->ubicacion->image_path }}');">
                            <h1 class="text-2xl font-bold text-black text-shadow">{{ $partido->ubicacion->nombre }}</h1>
                            <h1 class="text-2xl font-bold text-black text-shadow">{{ $partido->deporte->nombre }}</h1>
                        </header>
                    </a>
                    <div class="card__body p-6 bg-white text-base text-gray-700 border-t-4 border-gray-200">
                        <div class="card__address flex">
                            <svg class="icon icon--marker w-4 h-5" viewBox="0 0 9 12">
                                <path
                                    d="M4.2,0c-2.303,0.003 -4.197,1.897 -4.2,4.2c0,2.133 3.346,6.48 3.727,6.969l0.473,0.606l0.473,-0.606c0.381,-0.488 3.727,-4.836 3.727,-6.969c0,-2.316 -1.885,-4.2 -4.2,-4.2">
                                </path>
                            </svg>
                            <div
                                class="card_address_street whitespace-nowrap overflow-hidden text-ellipsis ml-2 text-xl">
                                <a href="{{ $partido->ubicacion->enlace_maps }}" target="_blank">
                                    {{ $partido->ubicacion->direccion }}
                                </a>
                            </div>
                        </div>
                        <div class="slots grid grid-cols-2 gap-2 min-h-14 pt-2 mt-5 text-center">
                            <div class="text-left">
                                <label for="fecha" class="block mb-2 text-2xl font-bold text-black">Fecha:</label>
                                <p class="text-gray-700 text-xl">
                                    {{ \Carbon\Carbon::parse($partido->fecha_hora)->format('d-m-Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <label for="hora" class="block mb-2 text-2xl font-bold text-black">Hora:</label>
                                <p class="text-gray-700 text-xl">
                                    {{ \Carbon\Carbon::parse($partido->fecha_hora)->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            @endif
        @empty
            <!-- No hay partidos o todos los partidos han pasado -->
        @endforelse

        @if (count($partidos) == 0)
            <p class="text-center text-gray-700">Todavía no hay partidos disponibles.</p>
        @elseif (count($partidos) > 0 &&
                $partidos->every(function ($partido) {
                    return \Carbon\Carbon::parse($partido->fecha_hora) <= \Carbon\Carbon::now();
                }))
            <p class="text-center text-gray-700">Todos los partidos han pasado.</p>
        @endif
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aquí puedes verificar si la ventana modal ya está presente y si no, crearla.
            // Luego, muestra el mensaje obtenido de la respuesta JSON.

            // Ejemplo de cómo mostrar un mensaje en una ventana modal usando JavaScript puro
            const showModalWithMessage = (message) => {
                // Muestra la ventana modal y establece el mensaje
                // Aquí deberías usar el código específico de tu biblioteca/modal.
                alert(message);
            };

            // Escucha la respuesta del servidor después de crear el partido
            const url = '{{ route('partidos.store') }}';
            fetch(url, {
                    method: 'POST',
                    // ... (Agrega las opciones necesarias, como headers y body)
                })
                .then(response => response.json())
                .then(data => {
                    // Muestra la ventana modal con el mensaje
                    showModalWithMessage(data.message);
                })
                .catch(error => {
                    console.error('Error al crear el partido:', error);
                    // Maneja errores si es necesario
                });
        });
    </script>




    {{-- Boton Delete --}}

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




    {{-- Ventana externa abierta --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[target="_blank"]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.open(this.getAttribute('href'), '_blank', 'width=600,height=400');
                });
            });
        });
    </script>






</x-app-layout>
