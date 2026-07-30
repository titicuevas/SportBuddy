<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pista extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ubicacion_id',
        'superficie_id',
        'deporte_id',
        'numero',
        'tiene_luz',
        'precio_sin_luz',
        'precio_con_luz',
    ];

    protected $casts = [
        'tiene_luz' => 'boolean',
        'precio_sin_luz' => 'decimal:2',
        'precio_con_luz' => 'decimal:2',
        'numero' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Pista $pista) {
            $pista->tiene_luz = $pista->precio_con_luz !== null;
        });
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function superficie(): BelongsTo
    {
        return $this->belongsTo(Superficie::class);
    }

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class);
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }
}
