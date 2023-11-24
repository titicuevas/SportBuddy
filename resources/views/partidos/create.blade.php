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
                    <form action="{{ route('partidos.store') }}" method="POST" x-data="pistasComponent()"
                        x-init="cargarPistas">
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

                        <!-- Agregado para mostrar el mensaje -->
                        <div x-text="mensaje" class="text-red-500"></div>

                        <!-- Desplegable para el número de pista -->
                        <div x-show="pistas.length > 0">
                            <div class="form-group">
                                <label for="pista_id">Número de Pista</label>
                                <select class="form-control" id="pista_numero" name="pista_" x-model="pistaId"
                                    x-on:change="cargarTipoSuperficie" required>
                                    <option value="" disabled selected>Seleccione su pista</option>
                                    <template x-for="(pista, index) in pistas" :key="index">
                                        <option :value="pista.id" x-text="`Pista ${pista.numero}`"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Desplegable para el tipo de superficie -->
                            <div class="form-group mt-2">
                                <label for="tipo_superficie">Tipo de Superficie</label>
                                <select class="form-control" id="tipo_superficie" name="tipo_superficie"
                                    x-model="tipoSuperficie" required>
                                    <template x-for="tipo in tiposSuperficie" :key="tipo">
                                        <option :value="tipo" x-text="tipo"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <!-- Desplegable para el deporte -->
                        <div x-show="deportes.length > 0">
                            <div class="form-group mt-2">
                                <label for="deporte">Deporte</label>
                                <select class="form-control" id="deporte" name="deporte" x-model="deporteId" required>
                                    <option value="" disabled selected>Seleccione su deporte</option>
                                    <template x-for="(deporte, index) in deportes" :key="index">
                                        <option :value="deporte.id" x-text="deporte.nombre"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div x-show="pistas.length === 0" x-text="mensaje" class="text-red-500"></div>

                        <button type="submit" class="btn btn-primary">Crear</button>
                        <!-- Resto de tu formulario... -->
                    </form>

                    <script>
                        function pistasComponent() {
                            return {
                                ubicacionId: null,
                                mensaje: '',
                                pistas: [],
                                tiposSuperficie: [],
                                pistaId: null,
                                tipoSuperficie: '',
                                deportes: [], // Inicializar como un array vacío
                                deporteId: null,

                                cargarPistas: async function() {
                                    try {
                                        if (this.ubicacionId !== null) {
                                            const response = await fetch(`/pistas-por-ubicacion/${this.ubicacionId}`);
                                            if (response.ok) {
                                                console.log('Respuesta de la API para pistas:', response);
                                                const data = await response.json();

                                                // Actualizar la lógica para manejar diferentes estructuras de datos
                                                this.pistas = data.map(pista => ({
                                                    id: pista.id,
                                                    numero: pista.numero !== null ? pista.numero : 'Número Desconocido',
                                                }));

                                                this.mensaje = this.pistas.length ? '' : 'No hay pistas disponibles';

                                                // Agregar la opción "Seleccione su pista" si hay pistas disponibles
                                                if (this.pistas.length > 0) {
                                                    this.pistas.unshift({
                                                        id: null,
                                                        numero: 'Seleccione su pista'
                                                    });

                                                    // Llamamos a cargarTipoSuperficie con la primera pista en la lista
                                                    this.pistaId = this.pistas[0].id;
                                                    this.cargarTipoSuperficie();
                                                }
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
                                },

                                async cargarTipoSuperficie() {
                                    try {
                                        if (this.pistaId !== null) {
                                            const response = await fetch(`/pistas/${this.pistaId}`);
                                            console.log('Respuesta de la API para tipo de superficie y deportes:', response);

                                            if (response.ok) {
                                                const data = await response.json();
                                                console.log('Datos obtenidos:', data);

                                                // Verificar si hay datos de superficie
                                                if (data && data.tipo_superficie) {
                                                    this.tiposSuperficie = [data.tipo_superficie];
                                                    this.tipoSuperficie = this.tiposSuperficie[0] || '';
                                                } else {
                                                    console.warn(
                                                        'La respuesta de la API no contiene datos de tipo de superficie o tiene un formato inesperado.'
                                                    );
                                                }

                                                // Verificar si hay datos de deportes
                                                if (data && data.deportes && Array.isArray(data.deportes) && data.deportes.length > 0) {
                                                    this.deportes = data.deportes.map(deporte => ({
                                                        id: deporte.id,
                                                        nombre: deporte.nombre,
                                                        // Ajusta las propiedades según la estructura real de los datos de deportes
                                                    }));
                                                    console.log('Datos finales de deportes:', this.deportes);
                                                    this.deporteId = this.deportes.length > 0 ? this.deportes[0].id : null;
                                                } else {
                                                    console.warn(
                                                        'La respuesta de la API no contiene datos de deportes o tiene un formato inesperado.'
                                                    );
                                                }
                                            } else {
                                                console.error('Error al obtener el tipo de superficie:', response.status);
                                                console.log('Respuesta del servidor:', await response.text());
                                            }
                                        }
                                    } catch (error) {
                                        console.error('Error al obtener el tipo de superficie:', error);
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
