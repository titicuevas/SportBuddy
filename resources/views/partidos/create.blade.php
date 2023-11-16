<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Añadir partido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('partidos.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="{{ old('fecha') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora"
                                value="{{ old('hora') }}" required>
                        </div>

                        {{-- Desplegable de las ubicaciones disponibles en la aplicación --}}
                        <div class="form-group">
                            <label for="ubicacion_id">Ubicación</label>
                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una ubicación</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--


                        {{-- Desplegable de las pistas disponibles en la ubicacion seleccionada mediante petición ajax --}}
                        <div class="form-group">
                            <label for="ubicacion_id">Numero Pista</label>
                            <select class="form-control" id="pista_id" name="pista_id" required>
                                <option value="">Selecciona un numero de pista</option>

                            </select>
                        </div>
                        --}}


                        <br><br><br><br><br><br><br>



                        {{--  --}}




                        {{-- <div
                            x-data= " {
                            ubicaciones: [],
                            pistas: [],
                            selectedUbicacion: null,
                            selectedPista: null
                        }">

                            <select name="ubicacion_id" id="ubicacion" x-model="ubicacionId"
                                x-on:change="fetchPistas()">
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="ubicacion_id">Pista</label>
                                <select class="form-control" id="pista_id" name="pista_id" required>
                                    <option value="">Selecciona una pista</option>
                                    <template x-for="pistas in pistas" :key="pista.id">
                                        <option :value="pista.id" x-text="pista.numero"></option>
                                    </template>
                                </select>
                            </div>

                            <script>
                                function fetchPistas() {
                                    // Obtenemos el ID de la ubicación seleccionada
                                    const ubicacionId = this.selectedUbicacion;

                                    // Realizamos la petición AJAX
                                    fetch(`/api/pistas?ubicacionId=${ubicacionId}`)
                                        .then(response => response.json())
                                        .then(pistas => {
                                            // Actualizamos el estado de la aplicación
                                            this.pistas = pistas;
                                            this.pistasDisponibles = pistas.length > 0;
                                        })
                                        .catch(error => {
                                            // Mostramos un error
                                            console.error(error);
                                        });

                                }





                                if (this.pistas.length === 0) {
                                    alert("No hay pistas disponibles para la ubicación seleccionada.");
                                } else {
                                    // El desplegable mostrará las pistas disponibles
                                }
                            </script>
                        </div>
 --}}

                        <br><br><br><br><br><br><br>




                        {{--  --}}
                        {{-- Desplegable de las ubicaciones disponibles en la aplicación --}}
                        <div class="form-group">
                            <label for="ubicacion_id">Superficie</label>
                            <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                                <option value="">Selecciona una superficie</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    @foreach ($ubicacion->pistas as $pista)
                                        <option value="{{ $pista->superficie->id }}">{{ $pista->superficie->tipo }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="deporte_id">Deporte</label>
                            <select class="form-control" id="deporte_id" name="deporte_id" required>
                                <option value="">Selecciona un deporte</option>
                                @foreach ($deportes as $deporte)
                                    <option value="{{ $deporte->id }}">{{ $deporte->nombre }}</option>
                                @endforeach
                            </select>
                        </div>


                        <br><br><br><br><br><br><br>

                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
