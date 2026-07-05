<?php

namespace Tests\Concerns;

use App\Models\Asignamiento;
use App\Models\Partido;
use App\Models\User;
use Database\Seeders\DeporteSeeder;
use Database\Seeders\EquipoSeeder;
use Database\Seeders\PistaSeeder;
use Database\Seeders\SuperficieSeeder;
use Database\Seeders\UbicacionSeeder;

trait CreatesPartidos
{
    protected function seedPartidoFixtures(): void
    {
        $this->seed([
            DeporteSeeder::class,
            EquipoSeeder::class,
            UbicacionSeeder::class,
            SuperficieSeeder::class,
            PistaSeeder::class,
        ]);
    }

    protected function createFuturePartido(User $creator): Partido
    {
        return Partido::create([
            'fecha_hora' => now()->addDays(3),
            'equipo1' => 1,
            'equipo2' => 2,
            'user_id' => $creator->id,
            'superficie_id' => 1,
            'pista_id' => 1,
            'ubicacion_id' => 1,
            'deporte_id' => 2,
            'precio' => 15,
        ]);
    }

    protected function enrollUserInPartido(User $user, Partido $partido, int $equipoId = 1): void
    {
        Asignamiento::create([
            'partido_id' => $partido->id,
            'user_id' => $user->id,
            'equipo_id' => $equipoId,
        ]);
    }
}
