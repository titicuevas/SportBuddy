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
            'rol_id' =>1,

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
    }
}
