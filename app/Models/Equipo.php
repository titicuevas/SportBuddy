<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'nombre',
    ];

    public function partidos()
    {
        return $this->belongsToMany('App\Models\Partido', 'equipos_partidos', 'equipos_id', 'partidos_id');
    }

    public function asignamientos()
    {
        return $this->hasMany('App\Models\Asignamiento','equipo_id');
    }

}
