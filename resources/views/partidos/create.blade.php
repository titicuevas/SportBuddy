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
                    <form action="{{ route('partidos.store') }}" method="POST" x-data="pistasComponent()">
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

                        <div class="form-group">
                            <label for="ubicacion_id">Ubicación</label>
                            <select name="ubicacion_id" id="ubicacion" x-model="ubicacionId" x-on:change="cargarPistas"
                                class="'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:ring focus:ring-black focus:ring-opacity-100 focus:border-transparent">
                                <option value="">Selecciona una ubicación</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <br>

                        <!-- Agregado para mostrar el mensaje -->
                        <div x-text="mensaje" class="text-red-500"></div>

                        <!-- Agregado para ocultar el select si no hay pistas -->
                        <div x-show="pistas.length > 0">
                            <div class="form-group">
                                <label for="pista_id">Pista</label>
                                <select class="form-control" id="pista_numero" name="pista_" x-model="pistaId"
                                    required>
                                    <template x-for="pista in pistas" :key="pista.id">
                                        <option :value="pista.id" x-text="`Pista ${pista.numero}`"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Agregamos otro select para mostrar el tipo de superficie -->
                            <div class="form-group mt-2">
                                <label for="tipo_superficie">Tipo de Superficie</label>
                                <select class="form-control" id="tipo_superficie" name="tipo_superficie" x-model="tipoSuperficie" required>
                                    <template x-for="pista in pistas" :key="pista.id">
                                        <option :value="pista.superficie.tipo" x-text="pista.superficie.tipo"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <!-- Agregado para mostrar el mensaje -->
                        <div x-show="pistas.length === 0" x-text="mensaje" class="text-red-500"></div>

                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>

                    <script>
                        function pistasComponent() {
                            return {
                                pistas: [],
                                ubicacionId: null,
                                pistaId: null,
                                mensaje: '', // Nuevo estado para el mensaje
                                tipoSuperficie: '', // Nuevo estado para el tipo de superficie

                                async cargarPistas() {
                                    try {
                                        if (this.ubicacionId) {
                                            const response = await fetch(`/pistas-por-ubicacion/${this.ubicacionId}`);
                                            if (response.ok) {
                                                const data = await response.json();
                                                this.pistas = data.map(pista => ({
                                                    id: pista,
                                                    numero: pista,
                                                    superficie: { tipo: 'TipoSuperficieDummy' }, // Reemplaza 'TipoSuperficieDummy' con la lógica real para obtener el tipo de superficie
                                                }));
                                                this.mensaje = this.pistas.length ? '' : 'No hay pistas disponibles';
                                            } else {
                                                console.error('Error al obtener pistas:', response.status);
                                                console.log('Respuesta del servidor:', await response.text());
                                            }
                                        } else {
                                            this.pistas = [];
                                            this.mensaje = '';
                                        }
                                    } catch (error) {
                                        console.error('Error al obtener pistas:', error);
                                        this.mensaje = 'Hubo un error al cargar las pistas';
                                    }
                                }
                            };
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
