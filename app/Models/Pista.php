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
        return $this->belongsTo('App\Models\Ubicacion');
    }

    public function superficie()
{
    return $this->belongsTo(Superficie::class, 'superficie_id');
}

    public function pistas()
    {
        return $this->hasMany('App\Models\Pista');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    protected $fillable = [
        'numero',
    ];
}
