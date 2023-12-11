<?php

// app/Models/Mensaje.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['partido_id', 'user_id', 'contenido'];

    // Relación con el partido
    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    // Relación con el usuario que envió el mensaje
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
