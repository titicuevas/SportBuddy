<x-app-layout>
    <x-page-hero
        :title="'Chat del partido'"
        :subtitle="$partido->deporte->nombre . ' · ' . $partido->ubicacion->nombre"
    />

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <a href="{{ route('partidos.show', $partido) }}"
            class="inline-flex items-center gap-1 text-sm font-medium text-indigo-600 hover:text-indigo-800">
            ← Volver al partido
        </a>

        <div class="mt-6 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                <p class="text-sm text-gray-600">Mensajes entre jugadores inscritos</p>
            </div>

            <div class="p-4 space-y-4 max-h-[28rem] overflow-y-auto" aria-live="polite">
                @forelse ($mensajes as $mensaje)
                    @php $esMio = $mensaje->user_id === auth()->id(); @endphp
                    <div class="flex {{ $esMio ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] rounded-2xl px-4 py-2.5 {{ $esMio ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                            <p class="text-xs font-semibold {{ $esMio ? 'text-indigo-100' : 'text-gray-500' }} mb-1">
                                {{ $esMio ? 'Tú' : $mensaje->user->name }}
                                · {{ $mensaje->created_at->format('d/m H:i') }}
                            </p>
                            <p class="text-sm whitespace-pre-wrap break-words">{{ $mensaje->contenido }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-sm text-gray-500 py-8">Aún no hay mensajes. ¡Sé el primero en escribir!</p>
                @endforelse
            </div>

            <form method="POST" action="{{ route('mensajes.store', $partido) }}"
                class="p-4 border-t border-gray-100 flex flex-col sm:flex-row gap-2">
                @csrf
                <label for="contenido" class="sr-only">Mensaje</label>
                <input
                    id="contenido"
                    type="text"
                    name="contenido"
                    value="{{ old('contenido') }}"
                    maxlength="255"
                    required
                    placeholder="Escribe un mensaje…"
                    class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                >
                <button type="submit"
                    class="px-4 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shrink-0">
                    Enviar
                </button>
            </form>
            @error('contenido')
                <p class="px-4 pb-3 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</x-app-layout>
