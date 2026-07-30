<x-app-layout>
    <x-page-hero title="Crear partido" subtitle="Reserva una pista y publica tu encuentro" />

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Formulario --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-emerald-50 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Datos del partido</h2>
                        <p class="text-sm text-gray-600 mt-0.5">Completa los pasos para publicar tu encuentro</p>
                    </div>

                    <form action="{{ route('partidos.store') }}" method="POST" class="p-6"
                        x-data="crearPartidoForm(@js($ubicaciones->map(fn ($u) => [
                            'id' => $u->id,
                            'nombre' => $u->nombre,
                            'direccion' => $u->direccion,
                            'imagen' => $u->image_path,
                        ])), {
                            pistasPorUbicacion: @js(url('/pistas-por-ubicacion')),
                            pistaShow: @js(url('/pistas')),
                            horasOcupadas: @js(url('/obtener-horas-ocupadas')),
                        })"
                        x-init="init()">
                        @csrf

                        {{-- Paso 1 --}}
                        <fieldset class="space-y-4">
                            <legend class="flex items-center gap-2 text-sm font-semibold text-indigo-600 mb-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 text-white text-xs">1</span>
                                Cuándo y dónde
                            </legend>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="fecha" class="block text-gray-700 text-sm font-semibold mb-1.5">Fecha</label>
                                    <input type="date" id="fecha" name="fecha" x-model="fecha"
                                        class="input-field" :min="fechaMinima" required
                                        @change="onFechaChange">
                                </div>
                                <div>
                                    <label for="ubicacion_id" class="block text-gray-700 text-sm font-semibold mb-1.5">Ubicación</label>
                                    <select name="ubicacion_id" id="ubicacion_id" x-model="ubicacionId"
                                        @change="onUbicacionChange" class="input-field" required>
                                        <option value="">Selecciona una ubicación</option>
                                        @foreach ($ubicaciones as $ubicacion)
                                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        {{-- Paso 2 --}}
                        <fieldset x-show="ubicacionId && fecha" x-cloak class="mt-8 space-y-4">
                            <legend class="flex items-center gap-2 text-sm font-semibold text-indigo-600 mb-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 text-white text-xs">2</span>
                                Pista y horario
                            </legend>

                            <div x-show="cargandoPistas" class="flex items-center gap-2 text-sm text-gray-500 py-2">
                                <svg class="animate-spin h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Cargando pistas…
                            </div>

                            <template x-if="!cargandoPistas && pistas.length === 0 && ubicacionId">
                                <p class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-lg p-3">
                                    No hay pistas disponibles en esta ubicación.
                                </p>
                            </template>

                            <div x-show="pistas.length > 0" class="space-y-4">
                                <div>
                                    <label for="pista_id" class="block text-gray-700 text-sm font-semibold mb-1.5">Número de pista</label>
                                    <select id="pista_id" name="pista_id" x-model="pistaId"
                                        @change="onPistaChange" class="input-field" required>
                                        <option value="">Selecciona una pista</option>
                                        <template x-for="pista in pistas" :key="pista.id">
                                            <option :value="pista.id" x-text="'Pista ' + pista.numero"></option>
                                        </template>
                                    </select>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-1.5">Superficie</label>
                                        <input type="text" name="tipo_superficie" x-model="tipoSuperficie"
                                            class="input-field bg-gray-50" readonly required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-1.5">Deporte</label>
                                        <input type="text" name="deporte" x-model="deporte"
                                            class="input-field bg-gray-50" readonly required>
                                    </div>
                                </div>

                                <div>
                                    <label for="hora" class="block text-gray-700 text-sm font-semibold mb-1.5">Hora</label>
                                    <select id="hora" name="hora" x-model="hora" class="input-field"
                                        required @change="actualizarPrecio" :disabled="cargandoHoras">
                                        <option value="">Selecciona una hora</option>
                                        <template x-for="franja in franjasHorarias" :key="franja.hora">
                                            <option :value="franja.hora" :disabled="franja.disabled"
                                                x-text="franja.hora + (franja.ocupada ? ' — Ocupada' : '')"></option>
                                        </template>
                                    </select>
                                    <p x-show="cargandoHoras" class="text-xs text-gray-500 mt-1">Comprobando disponibilidad…</p>
                                </div>

                                <div>
                                    <label for="precio" class="block text-gray-700 text-sm font-semibold mb-1.5">Precio pista</label>
                                    <select name="precio" id="precio" x-model="precio" class="input-field" required>
                                        <option value="">Selecciona un precio</option>
                                        <template x-for="opcion in opcionesPrecio" :key="opcion.valor">
                                            <option :value="opcion.valor" x-text="opcion.etiqueta"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <button type="submit"
                                :disabled="!puedeEnviar"
                                class="btn-primary w-full disabled:opacity-50 disabled:cursor-not-allowed">
                                Publicar partido
                            </button>
                            <a href="{{ route('partidos.index') }}"
                                class="block text-center mt-3 text-sm text-gray-600 hover:text-gray-900">
                                Cancelar y volver
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Panel lateral --}}
            <aside class="lg:col-span-2 space-y-6" x-data="panelPreview()" x-init="init(@js($ubicaciones->map(fn ($u) => [
                'id' => $u->id,
                'nombre' => $u->nombre,
                'direccion' => $u->direccion,
                'imagen' => $u->image_path,
            ])))">

                {{-- Vista previa ubicación --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="relative h-40 bg-gray-200">
                        <template x-if="ubicacionActual">
                            <img :src="ubicacionActual.imagen" :alt="ubicacionActual.nombre"
                                class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        </template>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <p class="text-xs uppercase tracking-wide text-white/80">Ubicación</p>
                            <p class="font-bold text-lg" x-text="ubicacionActual?.nombre ?? 'Selecciona ubicación'"></p>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-600 line-clamp-2" x-text="ubicacionActual?.direccion ?? 'Elige una ubicación para ver la dirección.'"></p>
                    </div>
                </div>

                {{-- Pronóstico --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 flex items-center gap-2">
                        <span>🌤️</span> Pronóstico del tiempo
                    </h3>

                    <div x-show="!ubicacionId || !fecha" class="mt-3 text-sm text-gray-500">
                        Selecciona fecha y ubicación para ver el tiempo previsto.
                    </div>

                    <div x-show="ubicacionId && fecha && cargandoClima" class="mt-3 flex items-center gap-2 text-sm text-gray-500">
                        <svg class="animate-spin h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Consultando el tiempo…
                    </div>

                    <template x-if="clima && clima.available">
                        <div class="mt-4 flex items-center gap-4">
                            <span class="text-4xl" x-text="clima.emoji"></span>
                            <div>
                                <p class="text-2xl font-bold text-gray-900" x-text="clima.temp + '°C'"></p>
                                <p class="text-sm text-gray-600 capitalize" x-text="clima.description"></p>
                                <p class="text-xs text-gray-500 mt-1" x-text="'Sensación ' + clima.feels_like + '°C · Viento ' + clima.wind + ' m/s'"></p>
                            </div>
                        </div>
                    </template>

                    <p x-show="clima && !clima.available && clima.message" class="mt-3 text-sm text-gray-600" x-text="clima.message"></p>
                    <p x-show="clima && !clima.available && clima.error" class="mt-3 text-sm text-amber-700" x-text="clima.error"></p>
                    <p x-show="clima && clima.configured === false" class="mt-3 text-sm text-gray-500">
                        Añade <code class="text-xs bg-gray-100 px-1 rounded">OPENWEATHER_API_KEY</code> en el .env para activar el pronóstico.
                    </p>
                </div>

                {{-- Consejos --}}
                <div class="bg-gradient-to-br from-indigo-50 to-emerald-50 rounded-2xl border border-indigo-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-3">Consejos</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex gap-2"><span class="text-indigo-500">•</span> Las franjas son de 90 minutos (9:00 – 21:00).</li>
                        <li class="flex gap-2"><span class="text-indigo-500">•</span> Al crear el partido quedarás inscrito automáticamente.</li>
                        <li class="flex gap-2"><span class="text-indigo-500">•</span> Revisa el tiempo antes de reservar pista con luz.</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

    <style>
        .input-field {
            width: 100%;
            padding: 0.625rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background: white;
        }
        .input-field:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #10b981);
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.875rem;
            transition: opacity 0.2s;
        }
        .btn-primary:hover:not(:disabled) { opacity: 0.9; }
        [x-cloak] { display: none !important; }
    </style>

    <script>
        const WEATHER_ICONS = {
            '01': '☀️', '02': '⛅', '03': '☁️', '04': '☁️',
            '09': '🌧️', '10': '🌧️', '11': '⛈️', '13': '❄️', '50': '🌫️',
        };

        function weatherEmoji(icon) {
            return WEATHER_ICONS[(icon || '01d').substring(0, 2)] || '🌡️';
        }

        function crearPartidoForm(ubicaciones, endpoints) {
            return {
                ubicaciones,
                endpoints,
                ubicacionId: '',
                fecha: '',
                fechaMinima: new Date().toISOString().split('T')[0],
                pistas: [],
                pistaId: '',
                tipoSuperficie: '',
                deporte: '',
                tieneLuz: false,
                precioSinLuz: null,
                precioConLuz: null,
                hora: '',
                precio: '',
                franjasHorarias: [],
                opcionesPrecio: [],
                cargandoPistas: false,
                cargandoHoras: false,
                horasOcupadas: [],

                init() {},

                get puedeEnviar() {
                    return this.ubicacionId && this.fecha && this.pistaId && this.hora && this.precio
                        && this.tipoSuperficie && this.deporte;
                },

                onFechaChange() {
                    window.dispatchEvent(new CustomEvent('fecha-cambiada', { detail: this.fecha }));
                    if (this.pistaId) this.cargarFranjas();
                },

                async onUbicacionChange() {
                    window.dispatchEvent(new CustomEvent('ubicacion-cambiada', { detail: this.ubicacionId }));
                    this.pistaId = '';
                    this.pistas = [];
                    this.resetPista();

                    if (!this.ubicacionId) return;

                    this.cargandoPistas = true;
                    try {
                        const res = await fetch(`${this.endpoints.pistasPorUbicacion}/${this.ubicacionId}`);
                        if (res.ok) {
                            this.pistas = await res.json();
                        }
                    } catch (e) {
                        this.pistas = [];
                    } finally {
                        this.cargandoPistas = false;
                    }
                },

                async onPistaChange() {
                    this.resetPista();
                    if (!this.pistaId) return;

                    try {
                        const res = await fetch(`${this.endpoints.pistaShow}/${this.pistaId}`);
                        if (res.ok) {
                            const data = await res.json();
                            this.tipoSuperficie = data.tipo_superficie || '';
                            this.deporte = data.deporte || '';
                            this.tieneLuz = !!data.tiene_luz || data.precio_con_luz != null;
                            this.precioSinLuz = parseFloat(data.precio_sin_luz) || null;
                            this.precioConLuz = parseFloat(data.precio_con_luz) || null;
                        }
                    } catch (e) {
                        this.tipoSuperficie = '';
                        this.deporte = '';
                    }

                    await this.cargarFranjas();
                },

                resetPista() {
                    this.tipoSuperficie = '';
                    this.deporte = '';
                    this.hora = '';
                    this.precio = '';
                    this.franjasHorarias = [];
                    this.opcionesPrecio = [];
                    this.horasOcupadas = [];
                },

                async cargarFranjas() {
                    if (!this.pistaId || !this.fecha) return;

                    this.cargandoHoras = true;
                    this.hora = '';
                    this.precio = '';
                    this.opcionesPrecio = [];

                    try {
                        const res = await fetch(`${this.endpoints.horasOcupadas}/${this.pistaId}/${this.fecha}`);
                        this.horasOcupadas = res.ok ? await res.json() : [];
                    } catch (e) {
                        this.horasOcupadas = [];
                    }

                    const fechaActual = this.fechaMinima;
                    const horaActual = new Date().toTimeString().slice(0, 5);
                    const franjas = [];

                    for (let i = 0; i < 13; i++) {
                        const totalMin = 9 * 60 + i * 90;
                        const hora = Math.floor(totalMin / 60);
                        const min = totalMin % 60;
                        const horaCompleta = `${String(hora).padStart(2, '0')}:${String(min).padStart(2, '0')}`;
                        const pasada = this.fecha === fechaActual && horaCompleta <= horaActual;
                        const ocupada = this.horasOcupadas.includes(horaCompleta);

                        franjas.push({
                            hora: horaCompleta,
                            ocupada,
                            disabled: pasada || ocupada,
                        });
                    }

                    this.franjasHorarias = franjas;
                    this.cargandoHoras = false;
                },

                actualizarPrecio() {
                    window.dispatchEvent(new CustomEvent('hora-cambiada', { detail: this.hora }));
                    this.precio = '';
                    this.opcionesPrecio = [];

                    if (!this.hora) return;

                    const sinLuz = this.precioSinLuz ?? 15;
                    const conLuz = this.precioConLuz ?? (sinLuz + 3);

                    this.opcionesPrecio = [
                        { valor: sinLuz, etiqueta: `Sin luz: €${sinLuz.toFixed(2)}` },
                    ];

                    if (this.tieneLuz) {
                        this.opcionesPrecio.push({
                            valor: conLuz,
                            etiqueta: `Con luz: €${conLuz.toFixed(2)}`,
                        });
                    }
                },
            };
        }

        function panelPreview() {
            return {
                ubicaciones: [],
                ubicacionId: '',
                fecha: '',
                hora: '',
                ubicacionActual: null,
                clima: null,
                cargandoClima: false,
                climaTimeout: null,

                init(ubicaciones) {
                    this.ubicaciones = ubicaciones;
                    window.addEventListener('ubicacion-cambiada', (e) => this.onUbicacion(e.detail));
                    window.addEventListener('fecha-cambiada', (e) => this.onFecha(e.detail));
                    window.addEventListener('hora-cambiada', (e) => this.onHora(e.detail));
                },

                onUbicacion(id) {
                    this.ubicacionId = id;
                    this.ubicacionActual = this.ubicaciones.find(u => u.id == id) || null;
                    this.fetchClima();
                },

                onFecha(fecha) {
                    this.fecha = fecha;
                    this.fetchClima();
                },

                onHora(hora) {
                    this.hora = hora;
                    this.fetchClima();
                },

                fetchClima() {
                    clearTimeout(this.climaTimeout);

                    if (!this.ubicacionId || !this.fecha) {
                        this.clima = null;
                        return;
                    }

                    this.climaTimeout = setTimeout(async () => {
                        this.cargandoClima = true;
                        try {
                            let url = `/ubicaciones/${this.ubicacionId}/clima?fecha=${this.fecha}`;
                            if (this.hora) url += `&hora=${this.hora}`;

                            const res = await fetch(url, { headers: { Accept: 'application/json' } });
                            const data = await res.json();
                            this.clima = {
                                ...data,
                                emoji: data.icon ? weatherEmoji(data.icon) : '🌡️',
                            };
                        } catch (e) {
                            this.clima = { configured: true, available: false, error: 'No se pudo cargar el pronóstico.' };
                        } finally {
                            this.cargandoClima = false;
                        }
                    }, 400);
                },
            };
        }
    </script>
</x-app-layout>
