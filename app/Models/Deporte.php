<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function partidos()
    {
        return $this->hasMany('App\Models\Partido');
    }
    public function ubicaciones()
    {
        return $this->belongsToMany('App\Models\Ubicacion');
    }
}
