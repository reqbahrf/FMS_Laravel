<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requirement>
 */
class RequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_name' => $this->faker->word(),
            'file_link' => $this->faker->url(),
            'file_type' => $this->faker->fileExtension(),
        ];
    }
}
