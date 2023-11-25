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
            'direccion' => 'Av. Bajo de Guía, s/n, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'Poli.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/tgmpvXyZkxhNQb8Z9'

        ]);


        $ubicacion2 = Ubicacion::create([
            'nombre' => 'Campo de Fútbol Las Palmeras',
            'direccion' => 'C. de las Palmeras, 11, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'las_palmeras.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/Nca2UrX85ZjvKX8W6'



        ]);



        $ubicacion3 = Ubicacion::create([
            'nombre' => 'Padel La Jara',
            'direccion' => 'C. Mar Serena, 5, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_la_jara.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/MdXNZynnenNcuZeTA'



        ]);




        $ubicacion4 = Ubicacion::create([
            'nombre' => 'Club de pádel La Via',
            'direccion' => 'Av. Al-Andalus, 123, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_la_via.jpeg',
            'enlace_maps' => 'https://maps.app.goo.gl/tgjnYzSDV2t1qhVZA'



        ]);




        $ubicacion5 = Ubicacion::create([
            'nombre' => 'Padel Manzanilla Maruja',
            'direccion' => 'C. Alcoba, 44, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_Maruja.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/6AB9BMw91oLguFE68'



        ]);




    }
}
