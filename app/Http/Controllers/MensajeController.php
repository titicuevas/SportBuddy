<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Services\MensajeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MensajeController extends Controller
{
    public function __construct(
        protected MensajeService $mensajeService
    ) {}

    public function index(Partido $partido): View
    {
        $this->authorizePartidoAccess($partido);

        $partido->load([
            'deporte:id,nombre',
            'ubicacion:id,nombre',
        ]);

        return view('mensajes.chat', [
            'partido' => $partido,
            'mensajes' => $this->mensajeService->getMensajes($partido->id),
        ]);
    }

    public function store(Request $request, Partido $partido): RedirectResponse
    {
        $this->authorizePartidoAccess($partido);

        $validated = $request->validate([
            'contenido' => ['required', 'string', 'max:255'],
        ]);

        $this->mensajeService->crearMensaje($validated['contenido'], $partido->id);

        return redirect()
            ->route('mensajes.index', $partido)
            ->with('success', 'Mensaje enviado.');
    }

    private function authorizePartidoAccess(Partido $partido): void
    {
        $userId = auth()->id();

        if ($partido->user_id === $userId) {
            return;
        }

        if ($partido->asignamientos()->where('user_id', $userId)->exists()) {
            return;
        }

        abort(403, 'Solo los jugadores inscritos pueden acceder al chat.');
    }
}
