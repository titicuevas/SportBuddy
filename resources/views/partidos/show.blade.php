<x-app-layout>


    <div class="flex flex-col space-y-4">

        <!-- Parte 1 con fondo azul -->
        <div class="bg-blue-200 p-6 rounded-lg flex space-x-4">

            <!-- Sección 1: Datos del partido -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Datos del partido</h1>

                    <div class="mb-6">
                        <label for="fecha" class="block mb-2 text-lg font-bold text-black">Fecha:</label>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->fecha_hora)->format('d-m-Y') }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="hora" class="block mb-2 text-lg font-bold text-black">Hora:</label>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->fecha_hora)->format('H:i') }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="creador" class="block mb-2 text-lg font-bold text-black">Creador:</label>
                        <a href="{{ route('user.show', $partido->user) }}"
                            class="text-blue-500 hover:text-blue-700 underline">
                            <p class="text-gray-700">{{ $partido->user->name }}</p>
                        </a>
                    </div>

                    <div class="mb-6">
                        <label for="ubicacion" class="block mb-2 text-lg font-bold text-black">Ubicación:</label>
                        <a href="{{ $partido->ubicacion->enlace_maps }}" target="_blank"
                            class="text-blue-500 hover:text-blue-700 underline">
                            {{ $partido->ubicacion->nombre }}
                        </a>
                    </div>

                    <div class="mb-6">
                        <label for="deporte" class="block mb-2 text-lg font-bold text-black">Deporte:</label>
                        <p class="text-gray-700">{{ $partido->deporte->nombre }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="precio" class="block mb-2 text-lg font-bold text-black">Precio Pista:</label>
                        <p class="text-gray-700">{{ $partido->precio }}€</p>


                        {{-- Imprimir el valor de PAYPAL_CLIENT_ID --}}

                        {{-- Boton paypal --}}
                        <div id="paypal-button-container"></div>
                        <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR"></script>
                        <script nonce="random_nonce_value">
                            paypal.Buttons({
                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: '{{ $partido->precio }}',
                                                currency_code: 'EUR'
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(details) {
                                        // Aquí puedes realizar acciones adicionales después de que el pago sea aprobado
                                        alert('Pago completado por ' + details.payer.name.given_name);
                                    });
                                }
                            }).render('#paypal-button-container');
                        </script>


                        <!-- Contenedor para el botón de PayPal Checkout -->
                        <div id="paypal-button-container"></div>



                    </div>
                </div>





                {{-- Boton de Unirse al partido --}}
                <form method="POST" action="{{ route('partidos.inscribirse', $partido) }}" x-data="{ showModal: false }">
                    @csrf
                    {{-- Verificar si el usuario está inscrito --}}
                    @if ($inscrito)
                        <button type="button"
                            class="bg-gray-500 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>Ya
                            estás inscrito</button>
                    @elseif ($partidoCompleto)
                        <button type="button"
                            class="bg-red-500 text-white font-bold py-2 px-4 rounded cursor-not-allowed"
                            disabled>Partido Completo</button>
                    @else
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">Unirse
                            al partido</button>
                    @endif
                </form>

                {{-- Boton de Desapuntarse --}}
                <form method="POST" action="{{ route('partidos.desapuntarse', $partido) }}" x-data="{ showModal: false }">
                    @csrf
                    {{-- Verificar si el usuario está inscrito y no es el creador del partido --}}
                    @if ($inscrito && $partido->user_id !== auth()->user()->id)
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red">Desapuntarse
                            del partido</button>
                    @endif
                </form>



                {{-- Boton Borrarse del partido el creador --}}
                <!-- Agrega un botón solo si el usuario actual es el creador del partido -->
                @if (auth()->user()->id === $partido->user_id)
                    <!-- Agrega un botón para eliminar el partido con una función de confirmación -->
                    <form method="POST" action="{{ route('partidos.destroy', $partido) }}" x-data="{ showModal: false }">
                        @csrf
                        @method('DELETE')

                        <!-- Botón para abrir la ventana modal -->
                        <button type="button" x-on:click="showModal = true"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red">
                            Eliminar partido
                        </button>







                        <!-- Ventana modal de confirmación -->
                        <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" style="display: none;">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <!-- Cubierta oscura trasera -->
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- Centro de la ventana modal -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                    aria-hidden="true">&#8203;</span>

                                <!-- Contenido de la ventana modal -->
                                <div x-show="showModal"
                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                    style="max-width: 500px;">
                                    <div class="bg-white p-5">
                                        <h1 class="text-xl font-bold text-gray-900 mb-4">Eliminar partido</h1>
                                        <p class="text-gray-700">¿Seguro que quieres eliminar este partido? Esta acción
                                            no se puede deshacer.</p>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring focus:border-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                            Eliminar
                                        </button>
                                        <button type="button" x-on:click="showModal = false"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif












            </div>

            <!-- Sección 2: Mapa con fondo amarillo -->
            <div class="flex-1/2">
                <div class="p-6 bg-yellow-200 rounded-lg">
                    <p class="text-lg font-bold text-black">Aquí va el mapa</p>
                    {!! $partido->ubicacion->iframe !!}
                </div>
            </div>

            <div class="flex-1/2">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-lg font-bold text-black">Pronóstico del tiempo</h2>
                    <div id="weather-info"></div>
                </div>
            </div>
        </div>









        {{-- Script TIEMPO    Utilizo la librería Guzzle Para sacar el tiempo composer require guzzlehttp/guzzle  --}}



        <style>
            .clima-icono {
                font-size: 3em;
                /* Ajusta el tamaño de fuente según tus preferencias */
            }
        </style>

        <script nonce="random_nonce_value">
            const apiKey = '9facddaf62df7e0216baad1b406319c9';
            const fechaPartido = '{{ \Carbon\Carbon::parse($partido->fecha)->format('d-m-Y') }}';
            const ciudadPartido = 'Sanlúcar de Barrameda, ES';
            const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${ciudadPartido}&units=metric&appid=${apiKey}`;

            async function obtenerTiempo() {
                try {
                    const response = await fetch(apiUrl);
                    const data = await response.json();
                    mostrarInfoTiempo(data);
                } catch (error) {
                    console.error('Error al obtener el pronóstico del tiempo:', error);
                }
            }

            function mostrarInfoTiempo(data) {
                const weatherInfoDiv = document.getElementById('weather-info');

                if (data.main && data.weather && data.weather.length > 0) {
                    const temperaturaCelsius = Math.round(data.main.temp);
                    const descripcion = traducirDescripcion(data.weather[0].description);
                    const fecha = fechaPartido; // Utiliza la fecha del partido
                    const icono = obtenerIconoClima(data.weather[0].icon);

                    const contenidoHTML = `
                            <p><strong>Fecha:</strong> ${fecha}</p>
                            <p><strong>Temperatura:</strong> ${temperaturaCelsius}°C</p>
                            <p><strong>Descripción:</strong> ${descripcion}</p>
                            <p class="clima-icono"><strong>Clima:</strong> ${icono}</p>
                        `;

                    weatherInfoDiv.innerHTML = contenidoHTML;
                } else {
                    weatherInfoDiv.innerHTML = 'No se pudo obtener la información del tiempo.';
                }
            }

            function traducirDescripcion(descripcion) {
                // Puedes agregar más traducciones según sea necesario
                const traducciones = {
                    'clear sky': 'cielo despejado',
                    'few clouds': 'pocas nubes',
                    'scattered clouds': 'nubes dispersas',
                    'broken clouds': 'nubes rotas',
                    'shower rain': 'lluvia',
                    'rain': 'lluvia',
                    'thunderstorm': 'tormenta',
                    'snow': 'nieve',
                    'mist': 'niebla',
                };

                return traducciones[descripcion.toLowerCase()] || descripcion;
            }

            function obtenerIconoClima(codigoIcono) {
                // Mapea códigos de iconos a emojis
                const iconos = {
                    '01d': '🌞', // clear sky (día)
                    '01n': '🌕', // clear sky (noche)
                    '02d': '⛅', // few clouds (día)
                    '02n': '☁️', // few clouds (noche)
                    '03d': '☁️', // scattered clouds (día)
                    '03n': '☁️', // scattered clouds (noche)
                    '04d': '☁️', // broken clouds (día)
                    '04n': '☁️', // broken clouds (noche)
                    '09d': '🌧️', // shower rain (día)
                    '09n': '🌧️', // shower rain (noche)
                    '10d': '🌧️', // rain (día)
                    '10n': '🌧️', // rain (noche)
                    '11d': '⛈️', // thunderstorm (día)
                    '11n': '⛈️', // thunderstorm (noche)
                    '13d': '❄️', // snow (día)
                    '13n': '❄️', // snow (noche)
                    '50d': '🌫️', // mist (día)
                    '50n': '🌫️', // mist (noche)
                };

                return iconos[codigoIcono] || '🤷'; // Icono predeterminado para casos desconocidos
            }

            obtenerTiempo();
        </script>







        <!-- Parte 2 dividida en dos con fondo verde -->
        <div class="bg-green-200 p-6 rounded-lg flex space-x-4">
            <!-- Parte 2.1 - EQUIPO 1 -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-black mb-4">EQUIPO 1</h2>
                    <h3>Jugadores</h3>
                    <br>
                    @foreach ($partido->asignamientos as $asignamiento)
                        @if ($asignamiento->equipo_id == 1)
                            {{ $asignamiento->user->name }}
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Parte 2.2 - EQUIPO 2 -->
            <div class="flex-1">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-black mb-4">EQUIPO 2</h2>
                    <h3>Jugadores</h3>
                    <br>
                    @foreach ($partido->asignamientos as $asignamiento)
                        @if ($asignamiento->equipo_id == 2)
                            {{ $asignamiento->user->name }}
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>





        </div>


        {{-- Chat --}}
        <a href="{{ route('pagina_chat') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Chat
        </a>



    </div>
    </div>
</x-app-layout>
