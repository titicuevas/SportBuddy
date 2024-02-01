<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Partido;
use Illuminate\Support\Facades\View;

class ComentarioController extends Controller
{


    public function index($partidoId)
    {
        $partido = Partido::findOrFail($partidoId);
        $comentarios = $partido->comentarios->skip(5)->take(5);

        return View::make('comentario.index', ['comentarios' => $comentarios])->render();
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'partido_id' => 'required|exists:partidos,id',
                'contenido' => 'required',
            ]);

            // Crea un nuevo comentario
            $comentario = Comentario::create([
                'user_id' => auth()->id(),
                'partido_id' => $request->partido_id,
                'contenido' => $request->contenido,
            ]);

            // Devuelve el nuevo comentario como HTML
            return View::make('comentario.comment', ['comentario' => $comentario])->render();
        } catch (QueryException $exception) {
            // Manejar excepción de base de datos
            return response()->json(['error' => 'Error al agregar el comentario.'], 422);
        }
    }
}
