<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'equipo_local_nombre',
        'equipo_visitante_nombre',
        'user_id',
        'superficie_id',
        'resultado',
        'ubicacion_id',
        'deporte_id',
        'pista_id',
        'precio',
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
            ->with(['ubicacion:id,nombre,direccion,imagen,enlace_maps', 'deporte:id,nombre,jugadores_por_equipo', 'user:id,name'])
            ->withCount('asignamientos');
    }

    public function plazasTotales(): int
    {
        return ($this->relationLoaded('deporte') ? $this->deporte->limitePorEquipo() : 0) * 2;
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

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class);
    }

    public function asignamientos(): HasMany
    {
        return $this->hasMany(Asignamiento::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pista(): BelongsTo
    {
        return $this->belongsTo(Pista::class);
    }

    public function superficie(): BelongsTo
    {
        return $this->belongsTo(Superficie::class);
    }

    public function mensajes(): HasMany
    {
        return $this->hasMany(Mensaje::class);
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }

    public function ladoLocal(): int
    {
        return 1;
    }

    public function ladoVisitante(): int
    {
        return 2;
    }

    public function jugadoresPorLado(int $lado): int
    {
        return $this->asignamientos->where('lado', $lado)->count();
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
