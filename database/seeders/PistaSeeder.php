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
            'precio_sin_luz' => 25,
            'precio_con_luz' => 35,
        ]);

        $pista2 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 2,
            'numero' => 2,
            'deporte_id' => 2,
            'precio_sin_luz' => 25,
            'precio_con_luz' => 35,

        ]);


        $pista3 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 3,
            'numero' => 3,
            'deporte_id' => 2,
            'precio_sin_luz' => 25,
            'precio_con_luz' => 35,
        ]);



        $pista4 = Pista::create([
            'ubicacion_id' => 1,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);









        /* Palmeras */




        $pista5 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 1,
            'precio_sin_luz' => 30,
            'precio_con_luz' => 40,

        ]);



        $pista6 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 1,
            'precio_sin_luz' => 30,
            'precio_con_luz' => 40,

        ]);

        $pista7 = Pista::create([
            'ubicacion_id' => 2,
            'superficie_id' => 4,
            'numero' => 3,
            'deporte_id' => 1,
            'precio_sin_luz' => 30,
            'precio_con_luz' => 40,

        ]);











        /* La jara */

        $pista8 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 1,
            'precio_sin_luz' => 30,
            'precio_con_luz' => 40,

        ]);




        $pista9 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);



        $pista10 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);




        $pista11 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista12 = Pista::create([
            'ubicacion_id' => 3,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);


        /* La via */


        $pista13 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista14 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista15 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista16 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista17 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista18 = Pista::create([
            'ubicacion_id' => 4,
            'superficie_id' => 1,
            'numero' => 6,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        /* Mauruja */


        $pista19 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 1,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista20 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 2,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista21 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 3,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista22 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 4,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);

        $pista23 = Pista::create([
            'ubicacion_id' => 5,
            'superficie_id' => 1,
            'numero' => 5,
            'deporte_id' => 3,
            'precio_sin_luz' => 10,
            'precio_con_luz' => 20,
        ]);
    }
}
