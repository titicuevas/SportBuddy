<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    public $timestamps = false;



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
        return $this->hasMany('App\Models\Ubicacion', 'ubicacion_id');
    }


    public function deporte()
    {
        return $this->belongsTo('App\Models\Deporte' , 'deporte_id');
    }




    protected $fillable = [
        'fecha',
        'hora',
        'equipo1',
        'equipo2',
        'user_id',
        'resultado',
        'ubicacion_id',
        'deporte_id'

    ];
}
