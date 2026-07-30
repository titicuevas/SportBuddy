<?php

namespace Database\Factories;

use App\Models\Deporte;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pista>
 */
class PistaFactory extends Factory
{
    protected $model = Pista::class;

    public function definition(): array
    {
        return [
            'ubicacion_id' => Ubicacion::factory(),
            'superficie_id' => Superficie::factory(),
            'deporte_id' => Deporte::factory(),
            'numero' => fake()->numberBetween(1, 20),
            'precio_sin_luz' => 20,
            'precio_con_luz' => 30,
        ];
    }

    public function sinLuz(): static
    {
        return $this->state(fn () => [
            'precio_con_luz' => null,
        ]);
    }
}
