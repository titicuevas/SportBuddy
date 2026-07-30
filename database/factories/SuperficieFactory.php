<?php

namespace Database\Factories;

use App\Models\Superficie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Superficie>
 */
class SuperficieFactory extends Factory
{
    protected $model = Superficie::class;

    public function definition(): array
    {
        return [
            'tipo' => fake()->unique()->randomElement([
                'Cesped artificial',
                'Tierra batida',
                'Moqueta',
                'Parquet',
                'Hormigon',
            ]).' '.fake()->unique()->numerify('##'),
        ];
    }
}
