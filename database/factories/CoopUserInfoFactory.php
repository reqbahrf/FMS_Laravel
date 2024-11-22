<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CoopUserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prefix' => fake()->title(),
            'f_name' => fake()->firstName(),
            'mid_name' => fake()->firstName(),
            'l_name' => fake()->lastName(),
            'suffix' => fake()->suffix(),
            'sex' => fake()->randomElement(['male', 'female']),
            'birth_date' => fake()->date(),
            'designation' => fake()->randomElement(['Owner', 'Manager', 'Director']),
            'mobile_number' => fake()->randomElement(['0912-345-6789', '0923-456-7890']),
            'landline' => fake()->phoneNumber(),
        ];
    }
}
