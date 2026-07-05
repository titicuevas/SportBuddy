<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'equipo1',
        'equipo2',
        'user_id',
        'superficie_id',
        'resultado',
        'ubicacion_id',
        'deporte_id',
        'pista_id',
        'precio',
        'pago_aprobado',
        'pista_tiene_luz',
        'precio_con_luz',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
        'pago_aprobado' => 'boolean',
        'pista_tiene_luz' => 'boolean',
        'precio' => 'decimal:2',
        'precio_con_luz' => 'decimal:2',
    ];

    public function scopeFuture(Builder $query): Builder
    {
        return $query->where('fecha_hora', '>', now());
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->whereHas('asignamientos', fn (Builder $q) => $q->where('user_id', $userId));
    }

    public function scopeWithCardData(Builder $query): Builder
    {
        return $query
            ->with(['ubicacion:id,nombre,direccion,imagen,enlace_maps', 'deporte:id,nombre', 'user:id,name'])
            ->withCount('asignamientos');
    }

    public static function limitePorDeporte(string $deporte): int
    {
        return match ($deporte) {
            'Futbol 7' => 7,
            'Futbol Sala' => 5,
            'Padel' => 2,
            'Baloncesto' => 5,
            'Tenis' => 1,
            'Judo' => 1,
            default => 0,
        };
    }

    public function plazasTotales(): int
    {
        $deporte = $this->relationLoaded('deporte') ? $this->deporte->nombre : '';

        return self::limitePorDeporte($deporte) * 2;
    }

    public function plazasOcupadas(): int
    {
        return $this->asignamientos_count ?? $this->asignamientos->count();
    }

    public function plazasLibres(): int
    {
        return max(0, $this->plazasTotales() - $this->plazasOcupadas());
    }

    public function estaCompleto(): bool
    {
        $total = $this->plazasTotales();

        return $total > 0 && $this->plazasOcupadas() >= $total;
    }

    public function equipo1()
    {
        return $this->belongsTo(Equipo::class, 'equipo1');
    }

    public function equipo2()
    {
        return $this->belongsTo(Equipo::class, 'equipo2');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function deporte()
    {
        return $this->belongsTo(Deporte::class);
    }

    public function asignamientos()
    {
        return $this->hasMany(Asignamiento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pista()
    {
        return $this->belongsTo(Pista::class);
    }

    public function superficie()
    {
        return $this->belongsTo(Superficie::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function jugadoresPorEquipo(int $equipoId): int
    {
        return $this->asignamientos->where('equipo_id', $equipoId)->count();
    }

    public function usuarioInscrito(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->asignamientos->contains('user_id', $userId);
    }

    public function getCardImageAttribute(): string
    {
        $deporteNombre = $this->relationLoaded('deporte') ? ($this->deporte->nombre ?? '') : '';
        $ubicacion = $this->ubicacion;

        if ($ubicacion?->imagen) {
            if (filter_var($ubicacion->imagen, FILTER_VALIDATE_URL)) {
                return $ubicacion->imagen;
            }

            $localPath = storage_path('app/public/imagen/'.$ubicacion->imagen);
            if (file_exists($localPath) && filesize($localPath) > 0) {
                return asset('storage/imagen/'.$ubicacion->imagen);
            }
        }

        return Deporte::coverImageUrl($deporteNombre);
    }
}
