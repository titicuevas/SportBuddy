<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user0 = User::create([
            'name' => 'Enrique Admin',
            'apellidos' => 'Cuevas Garcia',
            'telefono' => '661096250',
            'password' => '12345678',
            'email' => 'admin@gmail.com',
            'foto' => '',
            'rol_id' => 1,

        ]);




        $user1 = User::create([
            'name' => 'Enrique',
            'apellidos' => 'Cuevas Garcia',
            'telefono' => '661096250',
            'password' => '12345678',
            'email' => 'enrique@gmail.com',
            'foto' => '',


        ]);

        $user2 = User::create([
            'name' => 'Juan',
            'apellidos' => 'Perez',
            'telefono' => '66146250',
            'password' => '12345678',
            'email' => 'juan@gmail.com',
            'foto' => '',


        ]);

        $user3 = User::create([
            'name' => 'Antonio',
            'apellidos' => 'Rodriguez',
            'telefono' => '691096250',
            'password' => '12345678',
            'email' => 'antonio@gmail.com',
            'foto' => '',


        ]);


        $user4 = User::create([
            'name' => 'Agustin',
            'apellidos' => 'Pedrote',
            'telefono' => '695096250',
            'password' => '12345678',
            'email' => 'agustin@gmail.com',
            'foto' => '',


        ]);



        $user5 = User::create([
            'name' => 'Carlos',
            'apellidos' => 'Ruiz',
            'telefono' => '695196250',
            'password' => '12345678',
            'email' => 'carlos@gmail.com',
            'foto' => '',


        ]);

        $user6 = User::create([
            'name' => 'Manuel',
            'apellidos' => 'García López',
            'telefono' => '661096250',
            'password' => '12345678',
            'email' => 'manuel@gmail.com',
            'foto' => '',
        ]);

        $user7 = User::create([
            'name' => 'Ana',
            'apellidos' => 'Martínez Ruiz',
            'telefono' => '66146250',
            'password' => '12345678',
            'email' => 'ana@gmail.com',
            'foto' => '',
        ]);

        $user8 = User::create([
            'name' => 'Pepe',
            'apellidos' => 'Fernández Sánchez',
            'telefono' => '691096250',
            'password' => '12345678',
            'email' => 'pepe@gmail.com',
            'foto' => '',
        ]);

        $user9 = User::create([
            'name' => 'Elena',
            'apellidos' => 'López García',
            'telefono' => '695096250',
            'password' => '12345678',
            'email' => 'elena@gmail.com',
            'foto' => '',
        ]);

        $user10 = User::create([
            'name' => 'Javier',
            'apellidos' => 'Sanz Martín',
            'telefono' => '695196250',
            'password' => '12345678',
            'email' => 'javier@gmail.com',
            'foto' => '',
        ]);

        $user11 = User::create([
            'name' => 'Pablo',
            'apellidos' => 'Díaz Pérez',
            'telefono' => '66146250',
            'password' => '12345678',
            'email' => 'pablo@gmail.com',
            'foto' => '',
        ]);

        $user12 = User::create([
            'name' => 'Laura',
            'apellidos' => 'Serrano Ruiz',
            'telefono' => '691096250',
            'password' => '12345678',
            'email' => 'laura@gmail.com',
            'foto' => '',
        ]);

        $user13 = User::create([
            'name' => 'Marcos',
            'apellidos' => 'Hernández López',
            'telefono' => '695096250',
            'password' => '12345678',
            'email' => 'marcos@gmail.com',
            'foto' => '',
        ]);

        $user14 = User::create([
            'name' => 'Carmen',
            'apellidos' => 'Gutiérrez Martín',
            'telefono' => '695196250',
            'password' => '12345678',
            'email' => 'carmen@gmail.com',
            'foto' => '',
        ]);

        $user15 = User::create([
            'name' => 'Adrián',
            'apellidos' => 'Ramos Ruiz',
            'telefono' => '695196250',
            'password' => '12345678',
            'email' => 'adrian@gmail.com',
            'foto' => '',
        ]);

        $user16 = User::create([
            'name' => 'Jorge',
            'apellidos' => 'Gutiérrez Pérez',
            'telefono' => '665556677',
            'password' => '12345678',
            'email' => 'jorge@gmail.com',
            'foto' => '',
        ]);

        $user17 = User::create([
            'name' => 'Raúl',
            'apellidos' => 'López Martínez',
            'telefono' => '655446667',
            'password' => '12345678',
            'email' => 'raul@gmail.com',
            'foto' => '',
        ]);
    }
}
