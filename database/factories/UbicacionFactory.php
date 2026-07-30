<?php

namespace Database\Factories;

use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ubicacion>
 */
class UbicacionFactory extends Factory
{
    protected $model = Ubicacion::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->company().' Sport',
            'direccion' => fake()->streetAddress().', Sanlúcar de Barrameda',
        ];
    }
}
