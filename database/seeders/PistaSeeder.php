<?php

namespace Database\Seeders;

use App\Models\Pista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        //Creo las seeder para la base de datos


        /* Poli */



        $pista1 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 2,
        ]);

        $pista2 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 2,
            'numero' => 2,
            'deporte_id' => 2,
        ]);


        $pista3 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 3,
            'numero' => 3,
            'deporte_id' => 2,
        ]);



        $pista4 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
        ]);









        /* Palmeras */




        $pista5 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 1,
        ]);



        $pista5 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 1,
        ]);

        $pista6 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 4,
            'numero' => 3,
            'deporte_id' => 1,
        ]);











        /* La jara */

        $pista6 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 1,
        ]);




        $pista7 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
        ]);



        $pista8 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
        ]);




        $pista9 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
        ]);

        $pista10 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
        ]);


        /* La via */


        $pista11 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 3,
        ]);

        $pista12 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
        ]);

        $pista13 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
        ]);

        $pista14 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
        ]);

        $pista15 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
        ]);

        $pista16 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 6,
            'deporte_id' => 3,
        ]);

        /* Mauruja */


        $pista17 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 3,
        ]);

        $pista18 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
        ]);

        $pista19 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
        ]);

        $pista20 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
        ]);

        $pista21 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
        ]);

    }
}
