<?php

namespace Modules\Shipments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CombinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Shipments\Models\Combination::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'option_id' => fake()->unique()->id(),
            'name' => fake()->name()
        ];
    }
}

