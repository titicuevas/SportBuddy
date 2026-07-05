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
    public function index($partidoId)
    {
        $comentarios = Comentario::query()
            ->with('user:id,name')
            ->where('partido_id', $partidoId)
            ->orderByDesc('created_at')
            ->skip(3)
            ->take(3)
            ->get();

        return View::make('comentario.index', ['comentarios' => $comentarios])->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'partido_id' => 'required|exists:partidos,id',
            'contenido' => 'required|string|max:500',
        ]);

        $partido = Partido::findOrFail($request->partido_id);

        $inscrito = Asignamiento::where('user_id', auth()->id())
            ->where('partido_id', $partido->id)
            ->exists();

        abort_unless($inscrito, 403, 'Debes estar inscrito para comentar.');

        try {
            $comentario = Comentario::create([
                'user_id' => auth()->id(),
                'partido_id' => $request->partido_id,
                'contenido' => $request->contenido,
            ]);

            return View::make('comentario.comment', ['comentario' => $comentario])->render();
        } catch (QueryException) {
            return response()->json(['error' => 'Error al agregar el comentario.'], 422);
        }
    }
}
