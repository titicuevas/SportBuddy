<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['id' => 1], ['nombre' => 'administrator']);
        Role::firstOrCreate(['id' => 2], ['nombre' => 'estandar']);
    }
}
