<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Mensaje;
use App\Http\Livewire\Mensajes;
use App\Services\MensajeService;

class MensajeController extends Controller
{
    protected $mensajeService;

    public function __construct(MensajeService $mensajeService)
    {
        $this->mensajeService = $mensajeService;
    }

    public function index($partidoId)
{
    // Verifica si $partidoId está definida antes de pasarla a la vista
    if (!isset($partidoId)) {
        // Puedes manejar el caso de que $partidoId no esté definida, redirigiendo o mostrando un error
        // Ejemplo: return redirect()->route('alguna_ruta');
    }

    return view('mensajes.index', ['partidoId' => $partidoId])
        ->with('mensajes', $this->mensajeService->getMensajes($partidoId));
}






    public function store(Request $request, $partidoId)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

        $mensaje = $this->mensajeService->crearMensaje($request->input('contenido'), $partidoId);

        return redirect()->back();
    }
}
