<?php
namespace App\Services;

use App\Models\Mensaje;

class MensajeService
{
public function getMensajes($partidoId)
{
return Mensaje::where('partido_id', $partidoId)->get();
}

public function crearMensaje($contenido, $partidoId)
{
return Mensaje::create([
'user_id' => auth()->user()->id,
'partido_id' => $partidoId,
'contenido' => $contenido,
]);
}
}
