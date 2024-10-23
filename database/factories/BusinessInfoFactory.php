<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BusinessInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = ['Electronics', 'Furniture', 'Clothing', 'Food', 'Toys'];
        return [
            'firm_name' => fake()->unique(true)->company(),
            'enterprise_type' => fake()->randomElement(['Sole Proprietorship', 'Partnership', 'Corporation']),
            'enterprise_level' => fake()->randomElement(['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise']),
            'zip_code' => fake()->postcode(),
            'landmark' => fake()->streetAddress(),
            'barangay' => fake()->streetName(),
            'city' => fake()->randomElement(['Tagum', 'Panabo', 'Carmin', 'Santo Tomas', 'Davao City', 'Compostela', 'Davao de oro']),
            'province' => fake()->state(),
            'region' => fake()->state(),
            'Export_Mkt_Outlet' => implode(', ', fake()->randomElements($products, 5)),
            'Local_Mkt_Outlet' => implode(', ', fake()->randomElements($products, 5)),
        ];
    }
}
