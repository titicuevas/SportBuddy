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
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->fecha)->format('d-m-Y') }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="hora" class="block mb-2 text-lg font-bold text-black">Hora:</label>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</p>
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
                </div>

                {{-- Boton de Unirse al partido --}}
                <form method="POST" action="{{ route('partidos.apuntarse', $partido) }}" x-data="{ showModal: false }">
                    @csrf
                    <button type="button"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue"
                        @click="showModal = true">Unirse al partido</button>

                    <!-- Ventana modal -->
                    <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Background overlay -->
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <!-- Centered modal content -->
                            <div
                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div
                                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <!-- Heroicon name: exclamation -->
                                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6-5h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8a2 2 0 012-2zm10 4a1 1 0 100-2 1 1 0 000 2z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Partido Completo
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    El partido está completo. Vuelve por donde has venido VACA.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <a href="/partidos/index"><button type="button" @click="showModal = false"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cerrar
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>text-base
                </form>

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
                    const temperaturaCelsius = data.main.temp;
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
    </div>
</x-app-layout>
