<x-app-layout>
    <x-page-hero :title="'Hola, ' . Auth::user()->name" :subtitle="__('¿Qué se te apetece hacer hoy?')" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 pb-12 space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
                <p class="text-3xl font-bold text-indigo-600">{{ $misPartidos }}</p>
                <p class="mt-1 text-sm text-gray-600">Mis partidos</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
                <p class="text-3xl font-bold text-emerald-600">{{ $totalDisponibles }}</p>
                <p class="mt-1 text-sm text-gray-600">Partidos abiertos</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
                <p class="text-3xl font-bold text-gray-800">{{ max(0, $totalDisponibles - $misPartidos) }}</p>
                <p class="mt-1 text-sm text-gray-600">Por descubrir</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('partidos.create') }}"
                    class="group flex flex-col items-center p-6 rounded-xl border-2 border-indigo-100 hover:border-indigo-400 hover:bg-indigo-50/50 transition-all">
                    <div class="w-14 h-14 flex items-center justify-center rounded-full bg-indigo-600 text-white mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">Crear partido</span>
                    <span class="mt-1 text-sm text-gray-500 text-center">Organiza un nuevo encuentro</span>
                </a>

                <a href="{{ route('partidos.index') }}"
                    class="group flex flex-col items-center p-6 rounded-xl border-2 border-emerald-100 hover:border-emerald-400 hover:bg-emerald-50/50 transition-all">
                    <div class="w-14 h-14 flex items-center justify-center rounded-full bg-emerald-600 text-white mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">Ver partidos</span>
                    <span class="mt-1 text-sm text-gray-500 text-center">Explora partidos disponibles</span>
                </a>
            </div>
        </div>

        @if ($partidosProximos->isNotEmpty())
            <section aria-labelledby="proximos-partidos-heading">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 rounded-full bg-indigo-500" aria-hidden="true"></div>
                        <h2 id="proximos-partidos-heading" class="text-2xl font-bold text-gray-900">Próximos partidos</h2>
                    </div>
                    <a href="{{ route('partidos.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Ver todos →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($partidosProximos as $partido)
                        <x-partido-card :partido="$partido" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-app-layout>
