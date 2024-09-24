<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'male_direct_re' => fake()->numberBetween(1, 10),
            'female_direct_re' => fake()->numberBetween(1, 10),
            'male_direct_part' => fake()->numberBetween(1, 10),
            'female_direct_part' => fake()->numberBetween(1, 10),
            'male_indirect_re' => fake()->numberBetween(1, 10),
            'female_indirect_re' => fake()->numberBetween(1, 10),
            'male_indirect_part' => fake()->numberBetween(1, 10),
            'female_indirect_part' => fake()->numberBetween(1, 10),
        ];
    }
}
