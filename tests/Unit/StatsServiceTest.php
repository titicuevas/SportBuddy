<?php

namespace Tests\Unit;

use App\Models\Partido;
use App\Models\User;
use App\Services\StatsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class StatsServiceTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_dashboard_stats_are_cached(): void
    {
        $this->seedPartidoFixtures();
        $user = User::factory()->create();
        $partido = $this->createFuturePartido($user);
        $this->enrollUserInPartido($user, $partido);

        Cache::flush();

        $first = StatsService::dashboardForUser($user->id);
        $this->assertSame(1, $first['misPartidos']);

        $second = Partido::create([
            'fecha_hora' => now()->addDays(5),
            'equipo_local_nombre' => 'Equipo Azul',
            'equipo_visitante_nombre' => 'Equipo Naranja',
            'user_id' => $user->id,
            'superficie_id' => 1,
            'pista_id' => 1,
            'ubicacion_id' => 1,
            'deporte_id' => 2,
            'precio' => 15,
        ]);
        $this->enrollUserInPartido($user, $second);

        $cached = StatsService::dashboardForUser($user->id);
        $this->assertSame(1, $cached['misPartidos']);

        StatsService::bump();

        $fresh = StatsService::dashboardForUser($user->id);
        $this->assertSame(2, $fresh['misPartidos']);
    }
}
