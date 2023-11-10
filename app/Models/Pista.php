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
        return $this->belongsTo('App\Models\Superficie');
    }

    public function pistas()
    {
        return $this->hasMany('App\Models\Pista');
    }


    protected $fillable = [
        'numero',
    ];
}
