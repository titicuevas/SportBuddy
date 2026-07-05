<?php

namespace App\Services;

use App\Models\Deporte;
use App\Models\Partido;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class StatsService
{
    public static function bump(): void
    {
        $version = (int) Cache::get('stats.version', 1);
        Cache::put('stats.version', $version + 1);
    }

    public static function dashboardForUser(int $userId): array
    {
        $version = (int) Cache::get('stats.version', 1);

        return Cache::remember("dashboard.user.{$userId}.v{$version}", 60, function () use ($userId) {
            return [
                'partidosProximos' => Partido::query()
                    ->future()
                    ->forUser($userId)
                    ->withCardData()
                    ->orderBy('fecha_hora')
                    ->limit(3)
                    ->get(),
                'totalDisponibles' => Partido::query()->future()->count(),
                'misPartidos' => Partido::query()->future()->forUser($userId)->count(),
            ];
        });
    }

    public static function adminStats(): array
    {
        $version = (int) Cache::get('stats.version', 1);

        return Cache::remember("admin.stats.v{$version}", 120, function () {
            return [
                'users' => User::count(),
                'deportes' => Deporte::count(),
                'ubicaciones' => Ubicacion::count(),
                'superficies' => Superficie::count(),
                'pistas' => Pista::count(),
                'partidos' => Partido::count(),
            ];
        });
    }
}
