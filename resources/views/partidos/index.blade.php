<x-app-layout>
    @if (session('success'))
        <x-flash-message>{{ session('success') }}</x-flash-message>
    @endif

    @if (session('error'))
        <x-flash-message type="error">{{ session('error') }}</x-flash-message>
    @endif

    <x-page-hero title="Partidos" subtitle="Encuentra compañeros y únete a nuevos encuentros" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10 pb-12">
        {{-- Barra de resumen --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 px-5 py-4 sm:px-8 sm:py-5 mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-wrap gap-6 sm:gap-10">
                <div>
                    <p class="text-2xl font-bold text-indigo-600">{{ $partidosInscritos->count() }}</p>
                    <p class="text-sm text-gray-600">Mis inscripciones</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ $partidos->count() }}</p>
                    <p class="text-sm text-gray-600">Disponibles</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $partidosInscritos->count() + $partidos->count() }}</p>
                    <p class="text-sm text-gray-600">Próximos en total</p>
                </div>
            </div>

            <a href="{{ route('partidos.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear partido
            </a>
        </div>

        {{-- Mis partidos --}}
        <section class="mb-14" aria-labelledby="mis-partidos-heading">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-indigo-500" aria-hidden="true"></div>
                    <div>
                        <h2 id="mis-partidos-heading" class="text-2xl font-bold text-gray-900">Mis partidos</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Partidos a los que ya estás apuntado</p>
                    </div>
                </div>
                @if ($partidosInscritos->isNotEmpty())
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                        {{ $partidosInscritos->count() }} {{ $partidosInscritos->count() === 1 ? 'partido' : 'partidos' }}
                    </span>
                @endif
            </div>

            @if ($partidosInscritos->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($partidosInscritos as $partido)
                        <x-partido-card :partido="$partido" variant="inscrito" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 px-6 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="mx-auto w-14 h-14 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-600 mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Aún no tienes partidos</h3>
                    <p class="mt-2 text-gray-500 max-w-md mx-auto">Explora los partidos disponibles más abajo o crea uno nuevo e invita a tus amigos.</p>
                    <a href="#partidos-disponibles-heading"
                        class="mt-5 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                        Ver partidos disponibles ↓
                    </a>
                </div>
            @endif
        </section>

        {{-- Partidos disponibles --}}
        <section aria-labelledby="partidos-disponibles-heading">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-1 rounded-full bg-emerald-500" aria-hidden="true"></div>
                    <div>
                        <h2 id="partidos-disponibles-heading" class="text-2xl font-bold text-gray-900">Partidos disponibles</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Abiertos para unirte</p>
                    </div>
                </div>
                @if ($partidos->isNotEmpty())
                    <span class="text-sm font-medium text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                        {{ $partidos->count() }} {{ $partidos->count() === 1 ? 'partido' : 'partidos' }}
                    </span>
                @endif
            </div>

            @if ($partidos->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($partidos as $partido)
                        <x-partido-card :partido="$partido" variant="disponible" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 px-6 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="mx-auto w-14 h-14 flex items-center justify-center rounded-full bg-emerald-50 text-emerald-600 mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">No hay partidos abiertos</h3>
                    <p class="mt-2 text-gray-500 max-w-md mx-auto">Sé el primero en organizar un encuentro en tu zona.</p>
                    <a href="{{ route('partidos.create') }}"
                        class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear el primer partido
                    </a>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
