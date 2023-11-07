<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     //Creo las seeder para la base de datos

     $ubicacion1 = Ubicacion::create([
        'nombre' => 'Polideportivo',
        'direccion' => 'Av. Bajo de Guía, s/n, 11540 Sanlúcar de Barrameda, Cádiz'

    ]);


    $ubicacion2 = Ubicacion::create([
        'nombre' => 'Campo de Fútbol Las Palmeras',
        'direccion' => 'C. de las Palmeras, 11, 11540 Sanlúcar de Barrameda, Cádiz'

    ]);

    $ubicacion3 = Ubicacion::create([
        'nombre' => 'Club de pádel La Via',
        'direccion' => 'Av. Al-Andalus, 123, 11540 Sanlúcar de Barrameda, Cádiz'

    ]);

    $ubicacion4 = Ubicacion::create([
        'nombre' => 'Padel Manzanilla Maruja',
        'direccion' => 'C. Alcoba, 44, 11540 Sanlúcar de Barrameda, Cádiz'

    ]);

    $ubicacion5 = Ubicacion::create([
        'nombre' => 'Padel La Jara',
        'direccion' => 'C. Mar Serena, 5, 11540 Sanlúcar de Barrameda, Cádiz'

    ]);




    }
}
