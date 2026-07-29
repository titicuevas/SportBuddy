<?php

namespace Database\Seeders;

use App\Models\Deporte;
use Illuminate\Database\Seeder;

class DeporteSeeder extends Seeder
{
    public function run(): void
    {
        $deportes = [
            ['nombre' => 'Futbol 7', 'jugadores_por_equipo' => 7],
            ['nombre' => 'Futbol Sala', 'jugadores_por_equipo' => 5],
            ['nombre' => 'Padel', 'jugadores_por_equipo' => 2],
            ['nombre' => 'Baloncesto', 'jugadores_por_equipo' => 5],
            ['nombre' => 'Tenis', 'jugadores_por_equipo' => 1],
            ['nombre' => 'Judo', 'jugadores_por_equipo' => 1],
        ];

        foreach ($deportes as $deporte) {
            Deporte::firstOrCreate(
                ['nombre' => $deporte['nombre']],
                ['jugadores_por_equipo' => $deporte['jugadores_por_equipo']]
            );
        }
    }
}
