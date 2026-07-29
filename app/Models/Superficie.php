<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Superficie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tipo',
    ];

    public function pistas(): HasMany
    {
        return $this->hasMany(Pista::class);
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
