<?php

namespace Database\Factories;

use App\Models\Partido;
use App\Models\Pista;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partido>
 */
class PartidoFactory extends Factory
{
    protected $model = Partido::class;

    public function definition(): array
    {
        return [
            'fecha_hora' => now()->addDays(fake()->numberBetween(1, 10))->setTime(20, 0),
            'equipo_local_nombre' => 'Equipo Azul',
            'equipo_visitante_nombre' => 'Equipo Naranja',
            'user_id' => User::factory(),
            'pista_id' => Pista::factory(),
            'ubicacion_id' => fn (array $attributes) => Pista::find($attributes['pista_id'])?->ubicacion_id,
            'superficie_id' => fn (array $attributes) => Pista::find($attributes['pista_id'])?->superficie_id,
            'deporte_id' => fn (array $attributes) => Pista::find($attributes['pista_id'])?->deporte_id,
            'precio' => 20,
            'pista_tiene_luz' => true,
            'precio_con_luz' => 30,
        ];
    }
}
