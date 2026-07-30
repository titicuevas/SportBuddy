<?php

namespace Database\Seeders;

use App\Models\Pista;
use Illuminate\Database\Seeder;

class PistaSeeder extends Seeder
{
    public function run(): void
    {
        $pistas = [
            // Polideportivo
            ['ubicacion_id' => 1, 'superficie_id' => 1, 'numero' => 1, 'deporte_id' => 2, 'precio_sin_luz' => 25, 'precio_con_luz' => 35],
            ['ubicacion_id' => 1, 'superficie_id' => 2, 'numero' => 2, 'deporte_id' => 2, 'precio_sin_luz' => 25, 'precio_con_luz' => 35],
            ['ubicacion_id' => 1, 'superficie_id' => 3, 'numero' => 3, 'deporte_id' => 2, 'precio_sin_luz' => 25, 'precio_con_luz' => 35],
            ['ubicacion_id' => 1, 'superficie_id' => 1, 'numero' => 4, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            // Las Palmeras
            ['ubicacion_id' => 2, 'superficie_id' => 1, 'numero' => 1, 'deporte_id' => 1, 'precio_sin_luz' => 30, 'precio_con_luz' => 40],
            ['ubicacion_id' => 2, 'superficie_id' => 1, 'numero' => 2, 'deporte_id' => 1, 'precio_sin_luz' => 30, 'precio_con_luz' => 40],
            ['ubicacion_id' => 2, 'superficie_id' => 4, 'numero' => 3, 'deporte_id' => 1, 'precio_sin_luz' => 30, 'precio_con_luz' => 40],
            // Padel La Jara
            ['ubicacion_id' => 3, 'superficie_id' => 1, 'numero' => 1, 'deporte_id' => 1, 'precio_sin_luz' => 30, 'precio_con_luz' => 40],
            ['ubicacion_id' => 3, 'superficie_id' => 1, 'numero' => 2, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 3, 'superficie_id' => 1, 'numero' => 3, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 3, 'superficie_id' => 1, 'numero' => 4, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 3, 'superficie_id' => 1, 'numero' => 5, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            // Club de pádel La Via
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 1, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 2, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 3, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 4, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 5, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 4, 'superficie_id' => 1, 'numero' => 6, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            // Padel Manzanilla Maruja
            ['ubicacion_id' => 5, 'superficie_id' => 1, 'numero' => 1, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 5, 'superficie_id' => 1, 'numero' => 2, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 5, 'superficie_id' => 1, 'numero' => 3, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 5, 'superficie_id' => 1, 'numero' => 4, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
            ['ubicacion_id' => 5, 'superficie_id' => 1, 'numero' => 5, 'deporte_id' => 3, 'precio_sin_luz' => 10, 'precio_con_luz' => 20],
        ];

        foreach ($pistas as $pista) {
            Pista::firstOrCreate(
                [
                    'ubicacion_id' => $pista['ubicacion_id'],
                    'superficie_id' => $pista['superficie_id'],
                    'deporte_id' => $pista['deporte_id'],
                    'numero' => $pista['numero'],
                ],
                $pista
            );
        }
    }
}
