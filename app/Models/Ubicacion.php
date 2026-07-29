<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'direccion',
        'imagen',
        'enlace_maps',
        'iframe',
    ];

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }

    public function pistas(): HasMany
    {
        return $this->hasMany(Pista::class);
    }

    public function getImagePathAttribute(): string
    {
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        if ($this->imagen && file_exists(storage_path('app/public/imagen/'.$this->imagen))) {
            return asset('storage/imagen/'.$this->imagen);
        }

        return match ($this->nombre) {
            'Polideportivo' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
            'Campo de Fútbol Las Palmeras' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80',
            'Padel La Jara', 'Club de pádel La Via', 'Padel Manzanilla Maruja' => 'https://images.unsplash.com/photo-1554068865-24cecd4e34b8?auto=format&fit=crop&w=800&q=80',
            default => 'https://images.unsplash.com/photo-1517649763962-0c6230660273?auto=format&fit=crop&w=800&q=80',
        };
    }
}
