<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Models\Comentario;
use App\Models\Partido;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ComentarioController extends Controller
{
    public function store(StoreComentarioRequest $request, Partido $partido): Response|JsonResponse
    {
        abort_unless($partido->usuarioPuedeInteractuar(auth()->id()), 403, 'Debes estar inscrito para comentar.');

        try {
            $comentario = Comentario::create([
                'user_id' => auth()->id(),
                'partido_id' => $partido->id,
                'contenido' => $request->validated('contenido'),
            ]);

            $comentario->load('user:id,name');

            return response(
                view('comentario.comment', ['comentario' => $comentario])->render()
            );
        } catch (QueryException) {
            return response()->json(['error' => 'Error al agregar el comentario.'], 422);
        }
    }
}
