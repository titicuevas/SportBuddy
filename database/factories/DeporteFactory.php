<?php

namespace Database\Factories;

use App\Models\Deporte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deporte>
 */
class DeporteFactory extends Factory
{
    protected $model = Deporte::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(2, true),
            'jugadores_por_equipo' => fake()->numberBetween(1, 11),
        ];
    }
}
