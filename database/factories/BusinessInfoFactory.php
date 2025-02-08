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
        $locationData = [
            'Region XI (Davao Region)' => [
                'Davao del Norte' => [
                    'Tagum' => ['Magugpo North', 'Magugpo South', 'Magugpo East', 'Magugpo West'],
                    'Panabo' => ['Poblacion', 'Salvacion', 'New Cortez', 'Cambanay'],
                    'Carmin' => ['Poblacion', 'Crossing', 'Malinao', 'Mabini'],
                    'Santo Tomas' => ['Poblacion', 'Macacao', 'Fatima', 'Mabuhay']
                ],
                'Davao City' => [
                    'Davao City' => ['Poblacion', 'Talomo', 'Buhangin', 'Agdao']
                ],
                'Davao de Oro' => [
                    'Compostela' => ['Poblacion', 'Lapu-lapu', 'San Roque', 'Luray'],
                    'Nabunturan' => ['Poblacion', 'New Leyte', 'Andap', 'Napnapan'],
                ],
            ]
        ];

        $selectedRegion = 'Region XI (Davao Region)';
        $selectedProvince = fake()->randomElement(array_keys($locationData[$selectedRegion]));
        $selectedCity = fake()->randomElement(array_keys($locationData[$selectedRegion][$selectedProvince]));
        $selectedBarangay = fake()->randomElement($locationData[$selectedRegion][$selectedProvince][$selectedCity]);

        return [
            'firm_name' => fake()->unique(true)->company(),
            'enterprise_type' => fake()->randomElement(['Sole Proprietorship', 'Partnership', 'Corporation']),
            'enterprise_level' => fake()->randomElement(['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise']),
            'zip_code' => fake()->postcode(),
            'landmark' => fake()->streetAddress(),
            'barangay' => $selectedBarangay,
            'city' => $selectedCity,
            'province' => $selectedProvince,
            'region' => $selectedRegion,
            'Export_Mkt_Outlet' => json_encode(fake()->randomElements(['Electronics', 'Furniture', 'Clothing', 'Food', 'Toys'], 5)),
            'Local_Mkt_Outlet' => json_encode(fake()->randomElements(['Electronics', 'Furniture', 'Clothing', 'Food', 'Toys'], 5)),
        ];
    }
}
