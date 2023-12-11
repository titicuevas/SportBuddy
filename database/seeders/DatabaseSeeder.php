<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Deporte;
use App\Models\Role;
use App\Models\Superficie;
use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DeporteSeeder::class,
            EquipoSeeder::class,
            UbicacionSeeder::class,
            SuperficieSeeder::class,
            PistaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // Hago Referencia para crear los seeders y crear los datos
        ]);

    }
}
