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
                    'Tagum City' => ['Magugpo North', 'Magugpo South', 'Magugpo East', 'Magugpo West'],
                    'Panabo City' => ['Poblacion', 'Salvacion', 'New Cortez', 'Cambanay'],
                    'Carmen' => ['Poblacion', 'Crossing', 'Malinao', 'Mabini'],
                    'Santo Tomas' => ['Poblacion', 'Macacao', 'Fatima', 'Mabuhay'],
                    'Island Garden City of Samal' => ['Babak', 'Kaputian', 'Peñaplata', 'Libertad']
                ],
                'Davao City' => [
                    'Davao City' => ['Poblacion', 'Talomo', 'Buhangin', 'Agdao', 'Toril', 'Calinan', 'Baguio District']
                ],
                'Davao de Oro' => [
                    'Compostela' => ['Poblacion', 'Lapu-lapu', 'San Roque', 'Luray'],
                    'Nabunturan' => ['Poblacion', 'New Leyte', 'Andap', 'Napnapan'],
                    'Monkayo' => ['Poblacion', 'Olaycon', 'Banlag', 'Awao'],
                    'Maco' => ['Poblacion', 'Anibongan', 'Hijo', 'Panibasan']
                ],
                'Davao Oriental' => [
                    'Mati City' => ['Poblacion', 'Dahican', 'Matiao', 'Tamisan'],
                    'Baganga' => ['Poblacion', 'Batawan', 'Salingcomot', 'Lamiawan'],
                    'Cateel' => ['Poblacion', 'San Alfonso', 'San Antonio', 'Alegria']
                ]
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
