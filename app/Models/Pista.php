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
        'ubicacion_id',
        'superficie_id',
        'deporte_id',
        'numero',
        'tiene_luz',
        'precio_sin_luz',
        'precio_con_luz',
    ];
}
