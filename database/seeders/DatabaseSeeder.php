<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DeporteSeeder::class,
            UbicacionSeeder::class,
            SuperficieSeeder::class,
            PistaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
