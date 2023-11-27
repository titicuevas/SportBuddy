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
            'enlace_maps' => 'https://maps.app.goo.gl/tgmpvXyZkxhNQb8Z9',
            'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1597.6666160849006!2d-6.3546783!3d36.78656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0de082d26a961f%3A0x3a4daf5756b23a2b!2sComplejo%20Polideportivo%20Municipal!5e0!3m2!1ses!2ses!4v1701036168970!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',

        ]);


        $ubicacion2 = Ubicacion::create([
            'nombre' => 'Campo de Fútbol Las Palmeras',
            'direccion' => 'C. de las Palmeras, 11, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'las_palmeras.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/Nca2UrX85ZjvKX8W6',
            'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.3720669768595!2d-6.364695923672187!3d36.76164076987136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dde4a66d1c4b7%3A0x9300becae17d3937!2sCampo%20de%20F%C3%BAtbol%20Las%20Palmeras!5e0!3m2!1ses!2ses!4v1701036435628!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',



        ]);



        $ubicacion3 = Ubicacion::create([
            'nombre' => 'Padel La Jara',
            'direccion' => 'C. Mar Serena, 5, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_la_jara.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/MdXNZynnenNcuZeTA',
            'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3195.9869730269343!2d-6.371414223671901!3d36.77087996935111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0ddfcdb6c94397%3A0x3a4243307e5894d8!2sPadel%20La%20Jara!5e0!3m2!1ses!2ses!4v1701036479571!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'




        ]);




        $ubicacion4 = Ubicacion::create([
            'nombre' => 'Club de pádel La Via',
            'direccion' => 'Av. Al-Andalus, 123, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_la_via.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/tgjnYzSDV2t1qhVZA',
            'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3195.410189554468!2d-6.341243123671423!3d36.78471446857167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dde1e084674f1%3A0xa55c701631a75f31!2sClub%20de%20p%C3%A1del%20La%20Via!5e0!3m2!1ses!2ses!4v1701036553780!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'



        ]);




        $ubicacion5 = Ubicacion::create([
            'nombre' => 'Padel Manzanilla Maruja',
            'direccion' => 'C. Alcoba, 44, 11540 Sanlúcar de Barrameda, Cádiz',
            'imagen' => 'padel_Maruja.jpg',
            'enlace_maps' => 'https://maps.app.goo.gl/6AB9BMw91oLguFE68',
            'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3195.595616919923!2d-6.351285423671541!3d36.780267368822095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dde214e28d1fd%3A0x4a02b9a7d36a3802!2sPadel%20Manzanilla%20Maruja!5e0!3m2!1ses!2ses!4v1701036672147!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'



        ]);




    }
}
