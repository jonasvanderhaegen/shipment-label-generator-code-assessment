<?php

namespace Modules\Shipments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipments\Models\Combination;

/**
 * @extends Factory<Combination>
 */
class CombinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Combination>
     */
    protected $model = Combination::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_id' => fake()->numberBetween(1, 1000),
            'name' => fake()->name(),
        ];
    }
}
