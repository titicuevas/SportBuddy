<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Para que me coja la tabla ubicaciones que cambiamos ya que es un plural que no admite.
    protected $table = 'ubicaciones';

}
