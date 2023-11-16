<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superficie extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'tipo',
    ];


    public function pista()
    {
        return $this->belongsTo('App\Models\Pista');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

}
