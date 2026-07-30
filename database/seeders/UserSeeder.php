<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Enrique Admin', 'apellidos' => 'Cuevas Garcia', 'telefono' => '661096250', 'email' => 'admin@gmail.com', 'rol_id' => 1],
            ['name' => 'Enrique', 'apellidos' => 'Cuevas Garcia', 'telefono' => '661096250', 'email' => 'enrique@gmail.com', 'rol_id' => 2],
            ['name' => 'Juan', 'apellidos' => 'Perez', 'telefono' => '661462500', 'email' => 'juan@gmail.com', 'rol_id' => 2],
            ['name' => 'Antonio', 'apellidos' => 'Rodriguez', 'telefono' => '691096250', 'email' => 'antonio@gmail.com', 'rol_id' => 2],
            ['name' => 'Agustin', 'apellidos' => 'Pedrote', 'telefono' => '695096250', 'email' => 'agustin@gmail.com', 'rol_id' => 2],
            ['name' => 'Carlos', 'apellidos' => 'Ruiz', 'telefono' => '695196250', 'email' => 'carlos@gmail.com', 'rol_id' => 2],
            ['name' => 'Manuel', 'apellidos' => 'García López', 'telefono' => '661096251', 'email' => 'manuel@gmail.com', 'rol_id' => 2],
            ['name' => 'Ana', 'apellidos' => 'Martínez Ruiz', 'telefono' => '661462501', 'email' => 'ana@gmail.com', 'rol_id' => 2],
            ['name' => 'Pepe', 'apellidos' => 'Fernández Sánchez', 'telefono' => '691096251', 'email' => 'pepe@gmail.com', 'rol_id' => 2],
            ['name' => 'Elena', 'apellidos' => 'López García', 'telefono' => '695096251', 'email' => 'elena@gmail.com', 'rol_id' => 2],
            ['name' => 'Javier', 'apellidos' => 'Sanz Martín', 'telefono' => '695196251', 'email' => 'javier@gmail.com', 'rol_id' => 2],
            ['name' => 'Pablo', 'apellidos' => 'Díaz Pérez', 'telefono' => '661462502', 'email' => 'pablo@gmail.com', 'rol_id' => 2],
            ['name' => 'Laura', 'apellidos' => 'Serrano Ruiz', 'telefono' => '691096252', 'email' => 'laura@gmail.com', 'rol_id' => 2],
            ['name' => 'Marcos', 'apellidos' => 'Hernández López', 'telefono' => '695096252', 'email' => 'marcos@gmail.com', 'rol_id' => 2],
            ['name' => 'Carmen', 'apellidos' => 'Gutiérrez Martín', 'telefono' => '695196252', 'email' => 'carmen@gmail.com', 'rol_id' => 2],
            ['name' => 'Adrián', 'apellidos' => 'Ramos Ruiz', 'telefono' => '695196253', 'email' => 'adrian@gmail.com', 'rol_id' => 2],
            ['name' => 'Jorge', 'apellidos' => 'Gutiérrez Pérez', 'telefono' => '665556677', 'email' => 'jorge@gmail.com', 'rol_id' => 2],
            ['name' => 'Raúl', 'apellidos' => 'López Martínez', 'telefono' => '655446667', 'email' => 'raul@gmail.com', 'rol_id' => 2],
        ];

        foreach ($users as $data) {
            $rolId = $data['rol_id'];
            unset($data['rol_id']);

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    ...$data,
                    'password' => '12345678',
                    'foto' => null,
                    'email_verified_at' => now(),
                ]
            );

            if ((int) $user->rol_id !== (int) $rolId) {
                $user->rol_id = $rolId;
                $user->save();
            }
        }
    }
}
