<?php

namespace Database\Seeders;

use App\Models\Superficie;
use Illuminate\Database\Seeder;

class SuperficieSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Cesped Artificial', 'Parquet', 'Cemento', 'Alvero'] as $tipo) {
            Superficie::firstOrCreate(['tipo' => $tipo]);
        }
    }
}
