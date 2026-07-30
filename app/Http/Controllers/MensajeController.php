<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMensajeRequest;
use App\Models\Partido;
use App\Services\MensajeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MensajeController extends Controller
{
    public function __construct(
        protected MensajeService $mensajeService
    ) {}

    public function index(Partido $partido): View
    {
        abort_unless($partido->usuarioPuedeInteractuar(auth()->id()), 403, 'Solo los jugadores inscritos pueden acceder al chat.');

        $partido->load([
            'deporte:id,nombre',
            'ubicacion:id,nombre',
        ]);

        return view('mensajes.chat', [
            'partido' => $partido,
            'mensajes' => $this->mensajeService->getMensajes($partido->id),
            'currentUserId' => auth()->id(),
        ]);
    }

    public function store(StoreMensajeRequest $request, Partido $partido): RedirectResponse
    {
        abort_unless($partido->usuarioPuedeInteractuar(auth()->id()), 403, 'Solo los jugadores inscritos pueden acceder al chat.');

        $this->mensajeService->crearMensaje($request->validated('contenido'), $partido->id);

        return redirect()
            ->route('mensajes.index', $partido)
            ->with('success', 'Mensaje enviado.');
    }
}
