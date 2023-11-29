<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            ¡Añade un Nuevo Partido!
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto bg-white rounded-md overflow-hidden shadow-lg">
            <div class="p-6">
                <form action="{{ route('partidos.store') }}" method="POST" x-data="pistasComponent()" x-init="cargarPistas">
                    @csrf

                    <div class="mb-4">
                        <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                        <input type="date" id="fecha" name="fecha" x-model="fecha" class="input-field"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="hora" class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                        <input type="time" id="hora" name="hora" x-model="hora" class="input-field" required>
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion_id" class="block text-gray-700 text-sm font-bold mb-2">Ubicación</label>
                        <select name="ubicacion_id" id="ubicacion" x-model="ubicacionId" x-on:change="cargarPistas"
                            class="input-field">
                            <option value="">Selecciona una ubicación</option>
                            @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Desplegable para el número de pista -->
                    <div x-show="pistas.length > 0">
                        <div class="mb-4">
                            <label for="pista_id" class="block text-gray-700 text-sm font-bold mb-2">Número de
                                Pista</label>
                            <select id="pista_numero" name="pista_id" x-model="pistaId"
                                x-on:change="cargarTipoSuperficie" class="input-field" required>
                                <option value="" disabled selected>Seleccione su pista</option>
                                <template x-for="(pista, index) in pistas" :key="index">
                                    <option :value="pista.id" x-text="`Pista ${pista.numero}`"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Cuadro de texto para el tipo de superficie -->
                        <div class="mb-4">
                            <label for="tipo_superficie" class="block text-gray-700 text-sm font-bold mb-2">Tipo de
                                Superficie</label>
                            <input type="text" id="tipo_superficie" name="tipo_superficie" x-model="tipoSuperficie"
                                x-bind:value="tipoSuperficie" class="input-field" required>
                        </div>

                        <!-- Cuadro de texto para el deporte -->
                        <div class="mb-4">
                            <label for="deporte" class="block text-gray-700 text-sm font-bold mb-2">Deporte</label>
                            <input type="text" id="deporte" name="deporte" x-model="deporte"
                                x-bind:value="deporte" class="input-field">
                        </div>
                    </div>

                    <div x-show="pistas.length === 0" x-text="mensaje" class="text-red-500 mb-4"></div>

                    <button type="submit" class="btn-primary">Crear Partido</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .input-field {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>



    <script>
        function pistasComponent() {
            return {
                ubicacionId: null,
                mensaje: '',
                pistas: [],
                tiposSuperficie: [],
                pistaId: null,
                tipoSuperficie: '',
                deporte: null, // Inicializar como un array vacío
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

                                // Actualizar la carga de deportes
                                this.actualizarDeportes();
                            } else {
                                console.error('Error al obtener el tipo de superficie:', response.status);
                                console.log('Respuesta del servidor:', await response.text());
                            }
                        }
                    } catch (error) {
                        console.error('Error al obtener el tipo de superficie:', error);
                    }
                },

                actualizarDeportes: async function() {
                    try {
                        if (this.pistaId !== null) {
                            // Cargar los deportes relacionados con la pista seleccionada
                            const response = await fetch(`/pistas/${this.pistaId}/deportes`);
                            if (response.ok) {
                                const data = await response.json();
                                console.log('Datos completos de la respuesta de deportes:', data);


                                // Verificar si hay datos de deportes
                                if (data) {


                                    this.deporte = data.nombre;
                                    // Mostrar información en la consola
                                    console.log(this.deporte);
                                } else {
                                    console.warn(
                                        'La respuesta de la API no contiene datos de deportes relacionados con la pista o tiene un formato inesperado.'
                                    );

                                    // Mostrar información en la consola
                                    console.log('No hay datos de deportes');
                                }
                            } else {
                                console.error('Error al obtener deportes relacionados con la pista:', response.status);
                                console.log('Respuesta del servidor:', await response.text());
                            }
                        }
                    } catch (error) {
                        console.error('Error al obtener deportes relacionados con la pista:', error);
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
