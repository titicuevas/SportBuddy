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

     $pista = Pista::create([
        'ubicacion_id' => 1,
        'superficie_id'=>1,
        'numero'=>1
     ]);

    }
}
