<!-- resources/views/livewire/chat.blade.php -->

<div>
    <h1 class="text-2xl font-bold mb-4">Chat del Partido</h1>

    <div class="mb-4">
        {{-- Lista de mensajes --}}
        <ul>
            @forelse ($mensajes as $mensaje)
                <li class="mb-2">{{ $mensaje->contenido }} - {{ $mensaje->user->name }}</li>
            @empty
                <li>No hay mensajes</li>
            @endforelse
        </ul>
    </div>

    <div>
        {{-- Formulario para enviar mensajes --}}
        <form wire:submit.prevent="enviarMensaje">
            <input type="text" wire:model="nuevoMensaje" class="border p-2 mr-2">
            <button type="submit" class="bg-blue-500 text-white p-2">Enviar</button>
        </form>
    </div>
</div>
