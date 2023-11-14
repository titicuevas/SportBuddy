<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    public $timestamps = false;




    public function deportes()
    {
        return $this->belongsToMany('App\Models\Deporte');
    }



    public function partidos()
    {
        return $this->belongsTo('App\Models\Partidos');
    }


    public function pistas()
    {
        return $this->hasMany('App\Models\Pista');
    }


    //Para que me coja la tabla ubicaciones que cambiamos ya que es un plural que no admite.
    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'direccion',
        'ubicacion_id'
    ];
}
