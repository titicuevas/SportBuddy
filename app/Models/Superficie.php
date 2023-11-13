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


    public function superficie()
    {
        return $this->belongsTo('App\Models\Superficie');
    }

}
