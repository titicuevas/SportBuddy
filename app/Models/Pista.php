<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Para que me coja la tabla pistas que cambiamos ya que es un plural que no admite.
    protected $table = 'pistas';



    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function superficie()
    {
        return $this->belongsTo(Superficie::class);
    }


    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }


    public function deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }



    protected $fillable = [
        'numero',
        'horas_disponibles', // Agrega esta línea si planeas asignar masivamente horas_disponibles

    ];
}
