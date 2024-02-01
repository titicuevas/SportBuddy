<x-app-layout>

    <div class="mt-8">
        <h2 class="text-2xl font-bold text-black mb-4">Comentarios</h2>

        <!-- Mostrar comentarios existentes -->
        <div id="comentarios-section">
            @foreach ($partido->comentarios as $comentario)
                <div class="bg-white p-4 mb-4 rounded-lg">
                    <p class="text-gray-700"><strong>{{ $comentario->user->name }}</strong>: {{ $comentario->contenido }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Formulario para agregar comentario -->
        <form id="comentario-form" method="POST" action="{{ route('comentarios.store', $partido->id) }}" class="mt-4">
            @csrf
            <input type="hidden" name="partido_id" value="{{ $partido->id }}">
            <textarea name="contenido" id="contenido" class="w-full p-2 border rounded" placeholder="Escribe tu comentario"></textarea>
            <button type="button" onclick="enviarComentario()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Agregar
                Comentario</button>
        </form>

    </div>

</x-app-layout>
