<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AssetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'building_value' => fake()->randomFloat(2, 10000, 500000),
            'equipment_value' => fake()->randomFloat(2, 10000, 500000),
            'working_capital' => fake()->randomFloat(2, 10000, 500000),
        ];
    }
}
