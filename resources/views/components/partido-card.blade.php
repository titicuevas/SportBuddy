@props(['partido', 'variant' => 'disponible'])

@php
    $plazasTotales = $partido->plazasTotales();
    $plazasOcupadas = $partido->plazasOcupadas();
    $completo = $partido->estaCompleto();
    $ocupacion = $plazasTotales > 0 ? min(100, (int) round(($plazasOcupadas / $plazasTotales) * 100)) : 0;

    $deporteAccent = match ($partido->deporte->nombre) {
        'Futbol 7', 'Futbol Sala' => 'from-emerald-500 to-green-600',
        'Padel' => 'from-blue-500 to-cyan-600',
        'Baloncesto' => 'from-orange-500 to-amber-600',
        'Tenis' => 'from-yellow-500 to-lime-600',
        default => 'from-indigo-500 to-purple-600',
    };
@endphp

<article class="w-full h-full flex flex-col rounded-2xl overflow-hidden bg-white shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-200 border border-gray-100 group">
    <a href="{{ route('partidos.show', $partido) }}" class="flex flex-col flex-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-2xl">
        <header class="relative h-44 sm:h-48 bg-gray-200 overflow-hidden shrink-0">
            <img
                src="{{ $partido->card_image }}"
                alt="Imagen de {{ $partido->deporte->nombre }} — {{ $partido->ubicacion->nombre }}"
                loading="lazy"
                decoding="async"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                onerror="this.onerror=null;this.src='{{ \App\Models\Deporte::coverImageUrl($partido->deporte->nombre) }}';"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-black/10"></div>

            <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-gray-800 shadow-sm">
                    {{ $partido->fecha_hora->translatedFormat('D d M') }}
                </span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-gray-800 shadow-sm">
                    {{ $partido->fecha_hora->format('H:i') }}
                </span>
            </div>

            <div class="absolute top-3 right-3">
                @if ($variant === 'inscrito')
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-600 text-white shadow-sm">
                        Inscrito
                    </span>
                @elseif ($completo)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-600 text-white shadow-sm">
                        Completo
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white shadow-sm">
                        {{ $partido->plazasLibres() }} {{ $partido->plazasLibres() === 1 ? 'plaza' : 'plazas' }}
                    </span>
                @endif
            </div>

            <div class="absolute bottom-0 left-0 right-0 p-4">
                <span class="inline-block mb-1 px-2 py-0.5 rounded text-xs font-medium bg-gradient-to-r {{ $deporteAccent }} text-white">
                    {{ $partido->deporte->nombre }}
                </span>
                <h3 class="text-lg sm:text-xl font-bold text-white drop-shadow-md line-clamp-1">{{ $partido->ubicacion->nombre }}</h3>
            </div>
        </header>

        <div class="flex flex-col flex-1 p-4 sm:p-5">
            <div class="flex items-start gap-2 text-gray-600 min-h-[2.5rem]">
                <svg class="w-4 h-4 mt-1 shrink-0 text-indigo-500" viewBox="0 0 9 12" aria-hidden="true">
                    <path fill="currentColor" d="M4.2,0c-2.303,0.003 -4.197,1.897 -4.2,4.2c0,2.133 3.346,6.48 3.727,6.969l0.473,0.606l0.473,-0.606c0.381,-0.488 3.727,-4.836 3.727,-6.969c0,-2.316 -1.885,-4.2 -4.2,-4.2"></path>
                </svg>
                <address class="not-italic text-sm line-clamp-2 leading-snug">
                    {{ $partido->ubicacion->direccion }}
                </address>
            </div>

            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Jugadores</span>
                    <span class="font-semibold text-gray-700">{{ $plazasOcupadas }}/{{ $plazasTotales ?: '—' }}</span>
                </div>
                @if ($plazasTotales > 0)
                    <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden" aria-hidden="true">
                        <div
                            class="h-full rounded-full bg-gradient-to-r {{ $deporteAccent }} transition-all duration-300"
                            style="width: {{ $ocupacion }}%"
                        ></div>
                    </div>
                @endif
            </div>

            <div class="mt-auto pt-4 flex items-center justify-between gap-3 border-t border-gray-100">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">
                        {{ strtoupper(substr($partido->user->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500">Organiza</p>
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $partido->user->name }}</p>
                    </div>
                </div>

                @if ($partido->precio)
                    <div class="text-right shrink-0">
                        <p class="text-xs text-gray-500">Precio</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($partido->precio, 2) }}€</p>
                    </div>
                @endif
            </div>
        </div>
    </a>
</article>
