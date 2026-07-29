<div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
    <p class="text-gray-800">
        <strong>{{ $comentario->user->name }}</strong>
        <span class="text-xs text-gray-500 ml-2">{{ $comentario->created_at->format('H:i') }}</span>
    </p>
    <p class="text-gray-700 mt-1">{{ $comentario->contenido }}</p>
</div>
