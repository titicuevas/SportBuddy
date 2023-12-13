<?php

namespace App\Livewire;

use Livewire\Component;

class ChatForm extends Component
{

    public $nombre;
    public $mensaje;


    public function mount()

    {

        $this->nombre = "";
        $this->mensaje = "";
    }


    public function render()
    {
        return view('livewire.chat-form');
    }


    public function enviarMensaje()

    {

        $this->emit("mensajeEnviado");
    }
}
