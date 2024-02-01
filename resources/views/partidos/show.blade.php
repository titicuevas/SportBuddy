<x-app-layout>



    <div class="flex justify-center items-center h-screen">
        <div class="flex flex-col space-y-4">

            <!-- Parte 1 con fondo azul -->
            <div class="bg-blue-200 p-6 rounded-lg flex space-x-4">


                <!-- Sección 1: Datos del partido -->
                <div class="flex-1/4">
                    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <h1 class="text-3xl font-bold text-gray-900 mb-4">Datos del partido</h1>
                        <hr class="w-full border-t-8 bg-gray-500 mt-1">




                        <div class="mb-6">
                            <p class="text-xl text-gray-700">
                                <label for="fecha" class="block mb-2 text-lg font-bold text-black">Fecha:
                                    {{ \Carbon\Carbon::parse($partido->fecha_hora)->format('d-m-Y') }}
                            </p></label>
                        </div>

                        <div class="mb-6">

                            <p class="text-xl text-gray-700">
                                <label for="hora" class="block mb-2 text-lg font-bold text-black">Hora:
                                    {{ \Carbon\Carbon::parse($partido->fecha_hora)->format('H:i') }}
                            </p></label>

                        </div>

                        <div class="mb-6">


                            <label for="creador" class="block mb-2 text-lg font-bold text-black">Creador:
                                <a href="{{ route('user.show', $partido->user) }}"
                                    class="text-xl text-gray-700">{{ $partido->user->name }}</a>


                            </label>

                        </div>

                        <div class="mb-6">


                            <label for="ubicacion" class="block mb-2 text-lg font-bold text-black">Ubicación:
                                <a href="{{ $partido->ubicacion->enlace_maps }}" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 underline">{{ $partido->ubicacion->nombre }}</a>
                            </label>
                        </div>

                        <div class="mb-6">
                            <p class="text-xl text-gray-700">
                                <label for="pista_id" class="block mb-2 text-lg font-bold text-black">Numero de Pista:
                                    {{ $partido->pista->numero }}
                            </p></label>
                        </div>

                        <div class="mb-6">
                            <p class="text-xl text-gray-700">
                                <label for="deporte" class="block mb-2 text-lg font-bold text-black">Deporte:
                                    {{ $partido->deporte->nombre }}
                            </p></label>
                        </div>



                        <div class="mb-6">
                            <p class="text-xl text-gray-700">
                                <label for="precio" class="block mb-2 text-lg font-bold text-black">Precio Pista:
                                    {{ $partido->precio }}€
                            </p></label>





                            @if (auth()->user()->id == $partido->user->id)
                                {{-- Botón de PayPal --}}
                                <div id="paypal-button-container"></div>
                                <div id="pista-pagada-message"
                                    class="hidden bg-green-200 text-green-800 border border-green-400 p-4 rounded mt-4">
                                    Pista Pagada 😊
                                </div>


                                <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR"></script>
                                <script nonce="random_nonce_value">
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const isPagoAprobado = localStorage.getItem('pago_aprobado_{{ $partido->id }}');

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
                                                    alert('Pago completado por ' + details.payer.name.given_name);
                                                    document.getElementById('paypal-button-container').style.display =
                                                        'none';
                                                    document.getElementById('pista-pagada-message').style.display = 'block';

                                                    // Almacena el estado del pago en localStorage
                                                    localStorage.setItem('pago_aprobado_{{ $partido->id }}', true);

                                                    // Actualiza el estado del pago en el servidor (puedes utilizar una solicitud HTTP o Laravel Echo, según tus preferencias)
                                                    axios.post('{{ route('actualizar_estado_pago', $partido->id) }}', {
                                                            pago_aprobado: true
                                                        })
                                                        .then(function(response) {
                                                            // Maneja la respuesta, si es necesario
                                                        })
                                                        .catch(function(error) {
                                                            console.error('Error al actualizar el estado del pago',
                                                                error);
                                                        });
                                                });
                                            }
                                        }).render('#paypal-button-container');

                                        // Mostrar el mensaje de "Pista Pagada" si el pago ya fue aprobado
                                        if (isPagoAprobado) {
                                            document.getElementById('paypal-button-container').style.display = 'none';
                                            document.getElementById('pista-pagada-message').style.display = 'block';
                                        }
                                    });
                                </script>
                            @elseif ($partido->pago_aprobado)
                                {{-- Mensaje de "Pista Pagada" --}}
                                <div id="pista-pagada-message"
                                    class="bg-green-200 text-green-800 border border-green-400 p-4 rounded mt-4">
                                    Pista Pagada 😊
                                </div>
                            @endif




                        </div>
                    </div>





                    {{-- Boton de Unirse al partido --}}
                    <form method="POST" action="{{ route('partidos.inscribirse', $partido) }}"
                        x-data="{ showModal: false }">
                        @csrf
                        {{-- Verificar si el usuario está inscrito --}}
                        @if ($inscrito)
                            <button type="button"
                                class="bg-gray-500 text-white font-bold py-2 px-4 rounded cursor-not-allowed"
                                disabled>Ya
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
                    <form method="POST" action="{{ route('partidos.desapuntarse', $partido) }}"
                        x-data="{ showModal: false }">
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
                        <form method="POST" action="{{ route('partidos.destroy', $partido) }}"
                            x-data="{ showModal: false }">
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
                                            <p class="text-gray-700">¿Seguro que quieres eliminar este partido? Esta
                                                acción
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
                        <h1 class="text-3xl font-bold text-gray-900 mb-4 text-center relative">
                            Ubicacion y pronostico del tiempo
                            <span class="block w-full bg-gray-500 mx-auto mt-1 h-1 absolute bottom-0"></span>
                            <!-- Línea divisoria -->
                        </h1> {!! $partido->ubicacion->iframe !!}

                        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <h2 class="text-lg  font-bold text-black">Pronóstico del tiempo</h2>
                            <br>
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
                            <hr class="w-full border-t-3 bg-gray-500 mt-1">
                            <br>
                            @foreach ($partido->asignamientos as $asignamiento)
                                @if ($asignamiento->equipo_id == 1)
                                    <a href="{{ route('user.show', $asignamiento->user) }}"
                                        class="text-blue-500 hover:text-blue-700 underline">
                                        <p class="text-gray-700 text-center">{{ $asignamiento->user->name }}</p>
                                    </a>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Parte 2.2 - EQUIPO 2 -->
                    <div class="flex-1">
                        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <h2 class="text-2xl font-bold text-black mb-4">EQUIPO 2</h2>
                            <hr class="w-full border-t-3 bg-gray-500 mt-1">
                            <br>
                            @foreach ($partido->asignamientos as $asignamiento)
                                @if ($asignamiento->equipo_id == 2)
                                    <a href="{{ route('user.show', $asignamiento->user->id) }}"
                                        class="text-blue-500 hover:text-blue-700 underline">
                                        <p class="text-gray-700 text-center">{{ $asignamiento->user->name }}</p>
                                    </a>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- Comentarios --}}
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-black mb-4">Comentarios</h2>

                    <!-- Formulario para agregar comentario -->
                    <form id="comentario-form" method="POST"
                        action="{{ route('comentarios.store', $partido->id) }}" class="mb-4">
                        @csrf
                        <input type="hidden" name="partido_id" value="{{ $partido->id }}">
                        <textarea name="contenido" id="contenido" class="w-full p-2 border rounded" placeholder="Escribe tu comentario"></textarea>
                        <button type="button" onclick="enviarComentario()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Agregar
                            Comentario</button>
                    </form>

                    <!-- Mostrar los últimos 3 comentarios existentes -->
                    <!-- Mostrar comentarios existentes -->
                    <div id="comentarios-section" class="max-h-96 overflow-y-auto">
                        @foreach ($partido->comentarios->sortByDesc('created_at')->take(5)->reverse() as $comentario)
                            <div class="bg-white p-4 mb-4 rounded-lg">
                                <p class="text-gray-700">
                                    <strong>{{ $comentario->user->name }}</strong>
                                    <span
                                        class="text-sm text-gray-500">{{ $comentario->created_at->format('H:i') }}</span>:
                                    {{ $comentario->contenido }}
                                </p>
                            </div>
                        @endforeach

                    </div>


                </div>

                {{-- <!-- Botón "Ver más comentarios" -->
                    @if ($partido->comentarios->count() > 3)
                        <button id="ver-mas-comentarios" class="text-blue-500 hover:text-blue-700 underline">Ver más
                            comentarios</button>
                    @endif --}}
            </div>

            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                // Declarar la función en el ámbito global
                function enviarComentario() {
                    // Obtener datos del formulario
                    var formData = $('#comentario-form').serialize();

                    // Enviar solicitud AJAX
                    $.ajax({
                        type: 'POST',
                        url: $('#comentario-form').attr('action'),
                        data: formData,
                        success: function(response) {
                            // Agregar el nuevo comentario al contenedor de comentarios
                            $('#comentarios-section').prepend(response);

                            // Limpiar el contenido del textarea
                            $('#contenido').val('');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }

                $(document).ready(function() {
                    function cargarComentarios() {
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('comentarios.index', $partido->id) }}',
                            success: function(response) {
                                $('#comentarios-section').html(response);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }

                    // Actualizar comentarios cada 5 segundos
                    setInterval(function() {
                        cargarComentarios();
                    }, 5000);

                    // Manejar clic en "Ver más comentarios"
                    $('#ver-mas-comentarios').on('click', function() {
                        cargarComentarios();
                    });

                    // Manejar tecla "Enter" en el área de texto
                    $('#contenido').keyup(function(event) {
                        if (event.key === 'Enter' && !event.shiftKey) {
                            event.preventDefault();
                            enviarComentario();
                        }
                    });

                    // Agregar la hora al enviar un comentario
                    $('#comentario-form').submit(function(event) {
                        event.preventDefault(); // Evitar que el formulario se envíe normalmente

                        var horaActual = obtenerHoraActual();
                        $('#comentarios-section').prepend(
                            '<div class="bg-white p-4 mb-4 rounded-lg"><p class="text-gray-700"><strong>{{ Auth::user()->name }}</strong> (' +
                            horaActual + '): ' + $('#contenido').val() + '</p></div>');

                        // Limpiar el contenido del textarea
                        $('#contenido').val('');
                    });

                    // Función para formatear la hora
                    function obtenerHoraActual() {
                        var fecha = new Date();
                        var horas = fecha.getHours().toString().padStart(2, '0');
                        var minutos = fecha.getMinutes().toString().padStart(2, '0');
                        return horas + ':' + minutos;
                    }
                });
            </script>





        </div>

    </div>



    {{-- Botón para ir a la lista de partidos --}}
    <div class="mt-8 flex justify-center">
        <a href="{{ route('partidos.index') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Volver
        </a>
    </div>

</x-app-layout>
