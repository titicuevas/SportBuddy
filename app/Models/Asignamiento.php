<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignamiento extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = ['user_id', 'partido_id', 'equipo_id']; // Clave primaria compuesta
    public $incrementing = false; // Indicar que no es una clave primaria autoincremental
    protected $fillable = [
        'partido_id',
        'user_id',
        'equipo_id',
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
