<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'hora',
        'equipo1',
        'equipo2',
        'user_id',
        'partido_id',
        'superficie_id',
        'resultado',
        'ubicacion_id',
        'deporte_id',
        'pista_id'
    ];


    public function printAsignaciones()
    {
        for ($i = 0; $i < $this->asignaciones->count(); $i++) {
            $asignacion = $this->asignaciones[$i];

            // Imprime el nombre del jugador
            echo $asignacion->jugador->name;

            // Imprime el nombre del deporte
            echo $asignacion->deporte->getNombre();
        }
    }




    public function equipo1()
    {
        return $this->belongsTo('App\Models\Equipo', 'equipo1');
    }

    public function equipo2()
    {
        return $this->belongsTo('App\Models\Equipo', 'equipo2');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion','ubicacion_id');
    }


    public function deporte()
    {
        return $this->belongsTo('App\Models\Deporte' , 'deporte_id');
    }

    public function asignamientos()
    {
        return $this->hasMany(Asignamiento::class);
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function pista()
{
    return $this->belongsTo(Pista::class, 'pista_id');
}

public function superficie()
{
    return $this->belongsTo(Superficie::class, 'superficie_id');
}




}
