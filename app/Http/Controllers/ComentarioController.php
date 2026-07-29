<?php

namespace App\Http\Controllers;

use App\Models\Asignamiento;
use App\Models\Comentario;
use App\Models\Partido;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ComentarioController extends Controller
{
    public function store(Request $request, Partido $partido)
    {
        $request->validate([
            'contenido' => ['required', 'string', 'max:500'],
        ]);

        $inscrito = Asignamiento::where('user_id', auth()->id())
            ->where('partido_id', $partido->id)
            ->exists();

        abort_unless($inscrito, 403, 'Debes estar inscrito para comentar.');

        try {
            $comentario = Comentario::create([
                'user_id' => auth()->id(),
                'partido_id' => $partido->id,
                'contenido' => $request->contenido,
            ]);

            $comentario->load('user:id,name');

            return View::make('comentario.comment', ['comentario' => $comentario])->render();
        } catch (QueryException) {
            return response()->json(['error' => 'Error al agregar el comentario.'], 422);
        }
    }
}
