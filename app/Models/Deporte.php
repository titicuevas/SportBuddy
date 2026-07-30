<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deporte extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'jugadores_por_equipo',
        'imagen',
    ];

    protected $casts = [
        'jugadores_por_equipo' => 'integer',
    ];

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }

    public function pistas(): HasMany
    {
        return $this->hasMany(Pista::class);
    }

    public static function coverImageUrl(string $nombre = ''): string
    {
        return match ($nombre) {
            'Padel' => 'https://images.unsplash.com/photo-1617883964840-0a32ac7a9fc1?auto=format&fit=crop&w=800&q=80',
            'Futbol 7' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80',
            'Futbol Sala' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
            'Baloncesto' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80',
            'Tenis' => 'https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?auto=format&fit=crop&w=800&q=80',
            'Judo' => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?auto=format&fit=crop&w=800&q=80',
            default => 'https://images.unsplash.com/photo-1517649763962-0c6230660273?auto=format&fit=crop&w=800&q=80',
        };
    }

    public function getImagePathAttribute(): string
    {
        return asset('storage/imagen/'.($this->attributes['imagen'] ?? ''));
    }

    public function limitePorEquipo(): int
    {
        return max(1, (int) ($this->jugadores_por_equipo ?? 1));
    }
}
