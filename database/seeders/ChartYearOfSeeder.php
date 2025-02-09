<?php

namespace Database\Seeders;

use App\Models\ChartYearOf;
use Illuminate\Database\Seeder;

class ChartYearOfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monthlyProjectCategories = json_encode([
            'December' => ['Applicants' => 100],
            'November' => ['Applicants' => 90],
            'October' => ['Applicants' => 80],
            'September' => ['Applicants' => 70],
            'August' => ['Applicants' => 60],
            'July' => ['Applicants' => 50],
            'June' => ['Applicants' => 40],
            'May' => ['Applicants' => 30],
            'April' => ['Applicants' => 20],
            'March' => ['Applicants' => 10],
            'February' => ['Applicants' => 5],
            'January' => ['Applicants' => 0]
        ]);

        $projectLocalCategories = [
            'Region XI (Davao Region)' => [
                'byProvince' => [
                    'Davao del Norte' => [
                        'byCity' => [
                            'Tagum City' => [
                                'byBarangay' => [
                                    'Magugpo North' => ['Micro Enterprise' => 25, 'Small Enterprise' => 35, 'Medium Enterprise' => 20],
                                    'Magugpo South' => ['Micro Enterprise' => 30, 'Small Enterprise' => 40, 'Medium Enterprise' => 25],
                                    'Apokon' => ['Micro Enterprise' => 28, 'Small Enterprise' => 38, 'Medium Enterprise' => 22],
                                    'San Miguel' => ['Micro Enterprise' => 26, 'Small Enterprise' => 36, 'Medium Enterprise' => 24],
                                    'Visayan Village' => ['Micro Enterprise' => 27, 'Small Enterprise' => 37, 'Medium Enterprise' => 23]
                                ]
                            ],
                            'Panabo City' => [
                                'byBarangay' => [
                                    'Poblacion' => ['Micro Enterprise' => 30, 'Small Enterprise' => 40, 'Medium Enterprise' => 25],
                                    'Salvacion' => ['Micro Enterprise' => 20, 'Small Enterprise' => 30, 'Medium Enterprise' => 35]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];


        ChartYearOf::create([
            'year_of' => '2026',
            'monthly_project_categories' => $monthlyProjectCategories,
            'project_local_categories' => $projectLocalCategories,
        ]);
    }
}
