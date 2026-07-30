<?php

namespace App\Services;

use App\Models\Mensaje;
use Illuminate\Database\Eloquent\Collection;

class MensajeService
{
    public function getMensajes(int $partidoId): Collection
    {
        return Mensaje::query()
            ->with('user:id,name,foto')
            ->where('partido_id', $partidoId)
            ->orderBy('created_at')
            ->get();
    }

    public function crearMensaje(string $contenido, int $partidoId): Mensaje
    {
        return Mensaje::create([
            'user_id' => auth()->id(),
            'partido_id' => $partidoId,
            'contenido' => $contenido,
        ]);
    }
}
