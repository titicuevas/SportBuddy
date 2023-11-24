<?php

namespace Database\Seeders;

use App\Models\Deporte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     //Creo las seeder para la base de datos
    public function run(): void
    {
        $deporte1 = Deporte::create([
            'nombre' => 'Futbol 7'


        ]);

        $deporte2 = Deporte::create([
            'nombre' => 'Futbol Sala',
            'imagen' => 'cesped_poli.jpeg',


        ]);

        $deporte3 = Deporte::create([
            'nombre' => 'Padel',
            'imagen' => 'pista_pade_poli.jpg',


        ]);
    }
}
