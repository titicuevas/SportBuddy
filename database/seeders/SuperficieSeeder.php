<?php

namespace Database\Seeders;

use App\Models\Superficie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperficieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creo las seeder para la base de datos

     $superficie1 = Superficie::create([
        'tipo' => 'Cesped Artificial'

    ]);
    $superficie2 = Superficie::create([
        'tipo' => 'Parquet'

    ]);
    $superficie3 = Superficie::create([
        'tipo' => 'Cemento'

    ]);


    $superficie4 = Superficie::create([
        'tipo' => 'Alvero'

    ]);



}

}
