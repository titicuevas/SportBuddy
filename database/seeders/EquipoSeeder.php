<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //Creo las seeder para la base de datos

    public function run(): void
    {
        $equipo1 = Equipo::create([
            'nombre' => 'Equipo 1'


        ]);

        $equipo2 = Equipo::create([
            'nombre' => 'Equipo 2'


        ]);
    }
}
