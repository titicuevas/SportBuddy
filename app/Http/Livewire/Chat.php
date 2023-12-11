<?php
// app/Http/Livewire/Chat.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Partido;
use App\Models\Mensaje;

class Chat extends Component
{
    public $partido;
    public $nuevoMensaje;

    public function mount(Partido $partido)
    {
        $this->partido = $partido;
    }

    public function render()
    {
        $mensajes = Mensaje::where('partido_id', $this->partido->id)->get();

        return view('livewire.chat', compact('mensajes'));
    }

    public function enviarMensaje()
    {
        $this->validate([
            'nuevoMensaje' => 'required|string',
        ]);

        Mensaje::create([
            'partido_id' => $this->partido->id,
            'user_id' => auth()->id(),
            'contenido' => $this->nuevoMensaje,
        ]);

        $this->nuevoMensaje = ''; // Limpiar el campo después de enviar el mensaje
        $this->emit('mensajeEnviado');
    }
}
