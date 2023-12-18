    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                ¡Añade un Nuevo Partido!
            </h2>
        </x-slot>

        <div class="py-8">
            <div class="max-w-lg mx-auto bg-white rounded-md overflow-hidden shadow-lg">
                <div class="p-6">
                    <form action="{{ route('partidos.store') }}" method="POST" x-data="pistasComponent()"
                        x-init="cargarPistas">
                        @csrf

                        {{-- FECHA --}}


                        <div class="mb-4">
                            <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                            <input type="date" id="fecha" name="fecha" x-model="fecha" class="input-field"
                                :min="obtenerFechaActual()" required>
                            </p>
                        </div>










                        <div class="mb-4">
                            <label for="ubicacion_id"
                                class="block text-gray-700 text-sm font-bold mb-2">Ubicación</label>
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
                                <input type="text" id="tipo_superficie" name="tipo_superficie"
                                    x-model="tipoSuperficie" x-bind:value="tipoSuperficie" class="input-field" required>
                            </div>

                            <!-- Cuadro de texto para el deporte -->
                            <div class="mb-4">
                                <label for="deporte" class="block text-gray-700 text-sm font-bold mb-2">Deporte</label>
                                <input type="text" id="deporte" name="deporte" x-model="deporte"
                                    x-bind:value="deporte" class="input-field">
                            </div>


                            {{-- Horas --}}

                            <div class="mb-4">
                                <label for="hora" class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                                <select id="hora" name="hora" x-model="hora" class="input-field" required>
                                    <option value="" disabled selected>Selecciona una hora</option>
                                    <template x-for="franja in franjasHorarias" :key="franja.hora">
                                        <option :value="franja.hora" :class="{ 'ocupada': franja.ocupada }"
                                            :disabled="franja.ocupada">
                                            <span x-text="franja.hora"></span> - <span
                                                x-text="franja.ocupada ? 'No disponible' : ''"></span>
                                        </option>
                                    </template>
                                </select>
                                <!-- Agrega un mensaje de error si la hora está ocupada -->
                                <p x-show="errorHoraOcupada" class="text-red-500">La hora seleccionada está ocupada. Por
                                    favor, elige otra hora.</p>
                            </div>



                            {{-- PRECIO --}}
                            <!-- Cuadro de selección para el precio -->
                            <div class="mb-4">
                                <label for="precio" class="block mb-2 text-lg font-bold text-black">Precio
                                    Pista:</label>
                                <select name="precio" id="precio" x-model="precio" class="input-field" required>
                                    <option value="" disabled selected>Selecciona un precio</option>
                                    <template x-for="opcion in opcionesPrecio" :key="opcion.valor">
                                        <option :value="opcion.valor" x-text="opcion.etiqueta"></option>
                                    </template>
                                </select>
                            </div>


                            <div x-show="pistas.length === 0 || errorHoraOcupada" x-text="mensaje"
                                class="text-red-500 mb-4"></div>
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
                    deporte: null,
                    deporteId: null,
                    fecha: '',
                    hora: '',
                    franjasHorarias: [],
                    precio: '',
                    opcionesPrecio: [],

                    // Función para obtener el precio por hora
                    obtenerPrecioPorHora: function(hora) {
                        // Puedes ajustar esta lógica según los datos reales de tu base de datos
                        // Aquí estoy utilizando una lógica de ejemplo
                        let precioConLuz, precioSinLuz;
                        if (hora >= '09:00' && hora < '10:30') {
                            precioConLuz = 10.00;
                            precioSinLuz = 8.00;
                        } else if (hora >= '11:00' && hora < '12:30') {
                            precioConLuz = 15.00;
                            precioSinLuz = 12.00;
                        } else {
                            precioConLuz = 20.00;
                            precioSinLuz = 18.00;
                        }

                        // Devuelve un objeto con ambos precios
                        return {
                            conLuz: precioConLuz,
                            sinLuz: precioSinLuz
                        };
                    },

                    // Función para cargar las pistas
                    cargarPistas: async function() {
                        try {
                            if (this.ubicacionId !== null) {
                                const response = await fetch(`/pistas-por-ubicacion/${this.ubicacionId}`);
                                if (response.ok) {
                                    const data = await response.json();
                                    this.pistas = data.map(pista => ({
                                        id: pista.id,
                                        numero: pista.numero !== null ? pista.numero : 'Número Desconocido',
                                    }));

                                    this.mensaje = this.pistas.length ? '' : 'No hay pistas disponibles';

                                    if (this.pistas.length > 0) {
                                        this.pistas.unshift({
                                            id: null,
                                            numero: 'Seleccione su pista',
                                        });

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
                        } finally {
                            this.cargarFranjasYPrecio();
                        }
                    },

                    // Función para cargar el tipo de superficie
                    cargarTipoSuperficie: async function() {
                        try {
                            if (this.pistaId !== null) {
                                const response = await fetch(`/pistas/${this.pistaId}`);
                                if (response.ok) {
                                    const data = await response.json();
                                    if (data && data.tipo_superficie) {
                                        this.tiposSuperficie = [data.tipo_superficie];
                                        this.tipoSuperficie = this.tiposSuperficie[0] || '';
                                    } else {
                                        console.warn(
                                            'La respuesta de la API no contiene datos de tipo de superficie o tiene un formato inesperado.'
                                        );
                                    }

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

                    // Función para actualizar deportes
                    actualizarDeportes: async function() {
                        try {
                            if (this.pistaId !== null) {
                                const response = await fetch(`/pistas/${this.pistaId}/deportes`);
                                if (response.ok) {
                                    const data = await response.json();
                                    if (data) {
                                        this.deporte = data.nombre;
                                    } else {
                                        console.warn(
                                            'La respuesta de la API no contiene datos de deportes relacionados con la pista o tiene un formato inesperado.'
                                        );
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
                    },

                    // Función para obtener la fecha actual en el formato esperado
                    obtenerFechaActual: function() {
                        const ahora = new Date();
                        const ano = ahora.getFullYear();
                        const mes = (ahora.getMonth() + 1).toString().padStart(2, '0');
                        const dia = ahora.getDate().toString().padStart(2, '0');
                        return `${ano}-${mes}-${dia}`;
                    },

                    // Función para cargar las franjas horarias y calcular el precio
                    cargarFranjasYPrecio: async function() {
                        const franjas = await this.obtenerFranjasHorarias();

                        // Verificar si hay horas ocupadas
                        const hayHorasOcupadas = franjas.some(franja => franja.ocupada);

                        this.franjasHorarias = franjas;

                        // Actualizar el estado errorHoraOcupada
                        this.errorHoraOcupada = hayHorasOcupadas;

                        this.actualizarPrecio(); // Llamamos a la función para calcular el precio
                    },

                    obtenerPrecioPorHora: function(hora) {
                        let precioBaseConLuz, precioBaseSinLuz;

                        // Definir precios base según corresponda
                        if (hora >= '09:00' && hora < '10:30') {
                            precioBaseConLuz = 10.00;
                            precioBaseSinLuz = 8.00;
                        } else if (hora >= '11:00' && hora < '12:30') {
                            precioBaseConLuz = 15.00;
                            precioBaseSinLuz = 12.00;
                        } else {
                            precioBaseConLuz = 20.00;
                            precioBaseSinLuz = 18.00;
                        }

                        // Ajustar precio según la presencia de luz
                        const precioConLuz = this.pistaTieneLuz ? precioBaseConLuz + 5.00 : precioBaseConLuz;
                        const precioSinLuz = precioBaseSinLuz;

                        // Devolver un objeto con ambos precios
                        return {
                            conLuz: precioConLuz,
                            sinLuz: precioSinLuz
                        };
                    },



                    // Función para obtener las franjas horarias
                    horaOcupada: async function(hora) {
                        try {
                            console.log('Consultando horas ocupadas para', this.pistaId, 'en la fecha', this.fecha);
                            const response = await fetch(`/obtener-horas-ocupadas/${this.pistaId}/${this.fecha}`);
                            if (response.ok) {
                                const horasOcupadas = await response.json();
                                const ocupada = horasOcupadas.some(reserva => reserva.hora === hora && reserva.pista_id ===
                                    this.pistaId);
                                console.log('Hora', hora, 'ocupada:', ocupada);
                                return ocupada;
                            } else {
                                console.error('Error al obtener horas ocupadas:', response.status);
                                console.log('Respuesta del servidor:', await response.text());
                            }
                        } catch (error) {
                            console.error('Error al obtener horas ocupadas:', error);
                        }
                        return false;
                    },









                    // Modificación en el método para obtener las franjas horarias
                    obtenerFranjasHorarias: async function() {
                        const franjas = [];
                        const intervalo = 90; // 90 minutos en cada franja
                        const horasDisponibles = 22 - 9; // Total de horas disponibles

                        for (let i = 0; i < horasDisponibles * 60; i += intervalo) {
                            const hora = Math.floor(i / 60) + 9;
                            const minuto = i % 60;
                            const horaFormateada = hora.toString().padStart(2, '0');
                            const minutoFormateado = minuto.toString().padStart(2, '0');
                            const horaCompleta = `${horaFormateada}:${minutoFormateado}`;

                            // Utiliza tu función asíncrona para verificar si la hora está ocupada
                            const ocupada = await this.horaOcupada(horaCompleta);

                            franjas.push({
                                hora: horaCompleta,
                                ocupada: ocupada,
                            });
                        }

                        return franjas;
                    },




                    // Propiedad computada para obtener las opciones de precio
                    opcionesPrecio: function() {
                        const opciones = [];
                        if (this.hora) {
                            const precios = this.obtenerPrecioPorHora(this.hora);
                            opciones.push({
                                valor: precios.conLuz,
                                etiqueta: `Con luz: €${precios.conLuz.toFixed(2)}`
                            });
                            opciones.push({
                                valor: precios.sinLuz,
                                etiqueta: `Sin luz: €${precios.sinLuz.toFixed(2)}`
                            });
                        }
                        return opciones;
                    },


                };
            }
        </script>



        </div>
        </div>
        </div>
        </div>
    </x-app-layout>
