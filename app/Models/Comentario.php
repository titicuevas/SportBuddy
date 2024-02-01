<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'partido_id',
        'contenido',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    /**
     * Elimina todos los comentarios de un usuario específico en el contexto de un partido.
     *
     * @param int $partidoId
     * @param int $userId
     */
    public function eliminarComentariosUsuario($partido, $userId)
    {
        $this->where('partido_id', $partido->id)->where('user_id', $userId)->delete();
    }
}
