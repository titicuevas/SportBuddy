<x-app-layout>
    <x-page-hero :title="$partido->deporte->nombre" :subtitle="$partido->ubicacion->nombre . ' · ' . $partido->fecha_hora->format('d/m/Y H:i')" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Columna 1: datos y acciones --}}
            <section class="lg:col-span-4" aria-labelledby="datos-partido-heading">
                <div class="p-4 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
                    <h2 id="datos-partido-heading" class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="h-6 w-1 rounded-full bg-indigo-500" aria-hidden="true"></span>
                        Datos del partido
                    </h2>

                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Fecha</dt>
                            <dd class="text-lg text-gray-700">{{ $partido->fecha_hora->format('d-m-Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Hora</dt>
                            <dd class="text-lg text-gray-700">{{ $partido->fecha_hora->format('H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Creador</dt>
                            <dd>
                                <a href="{{ route('user.show', $partido->user) }}" class="text-lg text-indigo-600 hover:text-indigo-800 font-medium">
                                    {{ $partido->user->name }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Ubicación</dt>
                            <dd>
                                <a href="{{ $partido->ubicacion->enlace_maps }}" target="_blank" rel="noopener noreferrer"
                                    class="text-lg text-indigo-600 hover:text-indigo-800 font-medium">
                                    {{ $partido->ubicacion->nombre }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Número de pista</dt>
                            <dd class="text-lg text-gray-700">{{ $partido->pista->numero }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Deporte</dt>
                            <dd class="text-lg text-gray-700">{{ $partido->deporte->nombre }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-bold text-gray-900">Precio pista</dt>
                            <dd class="text-lg text-gray-700">{{ $partido->precio }}€</dd>
                        </div>
                    </dl>

                    @if (auth()->id() === $partido->user_id && ! $partido->pago_aprobado)
                        @if (config('services.paypal.client_id'))
                            <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200 space-y-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Pago de la pista</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Importe: <span class="font-bold text-gray-900">{{ number_format($partido->precio, 2) }}€</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Serás redirigido a PayPal. Si no quieres pagar, usa «Cancelar y volver» en la página de PayPal o el enlace de abajo.
                                    </p>
                                </div>

                                <a href="{{ route('paypal.start', $partido) }}"
                                    class="inline-flex w-full items-center justify-center gap-2 px-4 py-3 rounded-lg text-sm font-semibold text-white bg-[#0070ba] hover:bg-[#005ea6] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0070ba] focus:ring-offset-2">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M7.34 8.5h3.46c2.07 0 3.47 1.2 3.47 3.05 0 2.2-1.74 3.56-4.07 3.56H8.14L7.34 8.5zm1.18-5.5h7.9c3.66 0 6.1 1.86 6.1 4.93 0 3.2-2.53 5.2-6.58 5.2h-2.9l-1.02 5.37H7.34L8.52 3z"/>
                                    </svg>
                                    Pagar con PayPal
                                </a>

                                <a href="{{ route('partidos.index') }}"
                                    class="block w-full text-center text-sm font-medium text-gray-600 hover:text-gray-900 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    Volver a partidos sin pagar
                                </a>
                            </div>
                        @else
                            <p class="mt-4 text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-lg p-3">
                                PayPal no está configurado. Añade PAYPAL_CLIENT_ID y PAYPAL_CLIENT_SECRET en el archivo .env.
                            </p>
                        @endif
                    @elseif ($partido->pago_aprobado)
                        <div class="bg-green-100 text-green-800 border border-green-300 p-4 rounded-lg mt-4" role="status">
                            Pista pagada correctamente
                        </div>
                    @endif

                    <div class="mt-6 flex flex-wrap gap-2">
                        @if ($partido->fecha_hora->isFuture())
                            <form method="POST" action="{{ route('partidos.inscribirse', $partido) }}" class="inline">
                                @csrf
                                @if ($inscrito)
                                    <button type="button"
                                        class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-lg cursor-not-allowed"
                                        disabled>Ya estás inscrito</button>
                                @elseif ($partidoCompleto)
                                    <button type="button"
                                        class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded-lg cursor-not-allowed"
                                        disabled>Partido completo</button>
                                @else
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Unirse al partido
                                    </button>
                                @endif
                            </form>

                            @if ($inscrito && $partido->user_id !== auth()->id())
                                <form method="POST" action="{{ route('partidos.desapuntarse', $partido) }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                        Desapuntarse
                                    </button>
                                </form>
                            @endif
                        @else
                            <p class="text-sm text-gray-500 bg-gray-50 border border-gray-200 rounded-lg px-4 py-2">
                                Este partido ya ha finalizado.
                            </p>
                        @endif

                        @if (auth()->id() === $partido->user_id)
                            <form method="POST" action="{{ route('partidos.destroy', $partido) }}"
                                x-data="{ showModal: false }" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" x-on:click="showModal = true"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                    Eliminar partido
                                </button>

                                <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" x-on:click="showModal = false"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white p-5">
                                                <h3 class="text-xl font-bold text-gray-900 mb-2">Eliminar partido</h3>
                                                <p class="text-gray-700">¿Seguro que quieres eliminar este partido? Esta acción no se puede deshacer.</p>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                                                <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-sm font-medium text-white hover:bg-red-700 sm:w-auto">
                                                    Eliminar
                                                </button>
                                                <button type="button" x-on:click="showModal = false"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @if ($inscrito || auth()->id() === $partido->user_id)
                            <a href="{{ route('mensajes.index', $partido) }}"
                                class="px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                Chat del partido
                            </a>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Columna 2: mapa y clima --}}
            <section class="lg:col-span-4" aria-labelledby="ubicacion-heading">
                <div class="p-4 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
                    <h2 id="ubicacion-heading" class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="h-6 w-1 rounded-full bg-emerald-500" aria-hidden="true"></span>
                        Ubicación y pronóstico
                    </h2>

                    @if ($mapIframe)
                        <div class="w-full overflow-hidden rounded-lg [&_iframe]:w-full [&_iframe]:aspect-video">
                            {!! $mapIframe !!}
                        </div>
                    @endif

                    <div class="p-4 mt-4 bg-gray-50 rounded-xl border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Pronóstico del tiempo</h3>
                        <div id="weather-info" class="mt-2 text-gray-700" aria-live="polite">
                            <p class="text-sm text-gray-500">Cargando pronóstico…</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Columna 3: equipos y comentarios --}}
            <section class="lg:col-span-4 space-y-6" aria-labelledby="equipos-heading">
                <h2 id="equipos-heading" class="sr-only">Equipos y comentarios</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                    <div class="p-4 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $partido->equipo_local_nombre }}</h3>
                        <div class="h-1 w-full bg-gradient-to-r from-indigo-500 to-indigo-300 rounded mb-4" aria-hidden="true"></div>
                        @php $jugadoresEquipo1 = $partido->asignamientos->where('lado', $partido->ladoLocal()); @endphp
                        @forelse ($jugadoresEquipo1 as $asignamiento)
                            <a href="{{ route('user.show', $asignamiento->user) }}"
                                class="text-indigo-600 hover:text-indigo-800 font-medium block text-center mb-2 py-1 rounded hover:bg-indigo-50 transition-colors">
                                {{ $asignamiento->user->name }}
                            </a>
                        @empty
                            <p class="text-sm text-gray-500 text-center">Sin jugadores</p>
                        @endforelse
                    </div>

                    <div class="p-4 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $partido->equipo_visitante_nombre }}</h3>
                        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 to-emerald-300 rounded mb-4" aria-hidden="true"></div>
                        @php $jugadoresEquipo2 = $partido->asignamientos->where('lado', $partido->ladoVisitante()); @endphp
                        @forelse ($jugadoresEquipo2 as $asignamiento)
                            <a href="{{ route('user.show', $asignamiento->user) }}"
                                class="text-indigo-600 hover:text-indigo-800 font-medium block text-center mb-2 py-1 rounded hover:bg-indigo-50 transition-colors">
                                {{ $asignamiento->user->name }}
                            </a>
                        @empty
                            <p class="text-sm text-gray-500 text-center">Sin jugadores</p>
                        @endforelse
                    </div>
                </div>

                <div class="p-4 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Comentarios</h3>

                    @if ($inscrito)
                        <form id="comentario-form" method="POST" action="{{ route('comentarios.store', $partido->id) }}" class="mb-4 space-y-3">
                            @csrf
                            <textarea name="contenido" id="contenido" rows="3" aria-label="Escribe tu comentario"
                                class="w-full p-3 border border-gray-200 rounded-lg resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Escribe tu comentario"></textarea>
                            <button type="button" onclick="enviarComentario()"
                                class="w-full sm:w-auto px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Enviar
                            </button>
                        </form>
                    @else
                        <p class="text-gray-600 text-sm mb-4">Debes estar inscrito para agregar comentarios.</p>
                    @endif

                    <div id="comentarios-section" class="max-h-80 overflow-y-auto space-y-3">
                        @foreach ($partido->comentarios as $comentario)
                            @include('comentario.comment', ['comentario' => $comentario])
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('partidos.index') }}"
                class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Volver a partidos
            </a>
        </div>
    </div>

    <script>
        const fechaPartido = @json($partido->fecha_hora->format('d-m-Y'));
        const climaUrl = @json(route('partidos.clima', $partido));

        const iconos = {
            '01d': '🌞', '01n': '🌕', '02d': '⛅', '02n': '☁️',
            '03d': '☁️', '03n': '☁️', '04d': '☁️', '04n': '☁️',
            '09d': '🌧️', '09n': '🌧️', '10d': '🌧️', '10n': '🌧️',
            '11d': '⛈️', '11n': '⛈️', '13d': '❄️', '13n': '❄️',
            '50d': '🌫️', '50n': '🌫️',
        };

        async function obtenerTiempo() {
            const weatherInfoDiv = document.getElementById('weather-info');
            try {
                const response = await fetch(climaUrl, { headers: { 'Accept': 'application/json' } });
                const data = await response.json();

                if (data.configured === false) {
                    weatherInfoDiv.innerHTML = `<p class="text-sm text-gray-600">${data.error || 'Servicio meteorológico no configurado.'}</p>`;
                    return;
                }

                if (!data.available) {
                    weatherInfoDiv.innerHTML = `<p class="text-sm text-gray-600">${data.message || data.error || 'No se pudo obtener el tiempo.'}</p>`;
                    return;
                }

                const icono = iconos[data.icon] || iconos[(data.icon || '').replace(/[dn]$/, 'd')] || '🌡️';

                weatherInfoDiv.innerHTML = `
                    <p><strong>Fecha:</strong> ${fechaPartido}</p>
                    <p><strong>Temperatura:</strong> ${data.temp}°C <span class="text-gray-500">(sensación ${data.feels_like}°C)</span></p>
                    <p><strong>Descripción:</strong> ${data.description}</p>
                    <p class="text-sm text-gray-500">Humedad ${data.humidity}% · Viento ${data.wind} m/s</p>
                    <p class="text-3xl mt-2">${icono}</p>
                `;
            } catch (error) {
                console.error('Error al obtener el pronóstico:', error);
                weatherInfoDiv.innerHTML = '<p class="text-sm text-gray-600">No se pudo obtener la información del tiempo.</p>';
            }
        }

        obtenerTiempo();

        function enviarComentario() {
            const form = document.getElementById('comentario-form');
            if (!form) return;

            axios.post(form.action, new FormData(form))
                .then(response => {
                    document.getElementById('comentarios-section').insertAdjacentHTML('beforeend', response.data);
                    document.getElementById('contenido').value = '';
                    const container = document.getElementById('comentarios-section');
                    container.scrollTop = container.scrollHeight;
                })
                .catch(error => {
                    const message = error.response?.data?.message
                        || error.response?.data?.error
                        || 'No se pudo enviar el comentario.';
                    alert(message);
                });
        }

        document.getElementById('contenido')?.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                enviarComentario();
            }
        });
    </script>
</x-app-layout>
