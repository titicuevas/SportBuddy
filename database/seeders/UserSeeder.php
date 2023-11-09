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
        $user1 = User::create([
            'name' => 'Enrique',
            'apellidos' => 'Cuevas Garcia',
            'telefono' => '661096250',
            'password' => 'titi',
            'email' => 'beticos5@msn.com',
            'foto' => ''

        ]);
    }
}
