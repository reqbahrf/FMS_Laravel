<?php

namespace Database\Seeders;

use App\Models\ChartYearOf;
use Illuminate\Database\Seeder;

class ChartYearOf2025Seeder extends Seeder
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

        $projectLocalCategories = json_encode([
            'Manila' => [
                'Micro Enterprise' => 25,
                'Small Enterprise' => 35,
                'Medium Enterprise' => 20,
            ],
            'Quezon City' => [
                'Micro Enterprise' => 30,
                'Small Enterprise' => 40,
                'Medium Enterprise' => 25,
            ],
            'Makati' => [
                'Micro Enterprise' => 20,
                'Small Enterprise' => 30,
                'Medium Enterprise' => 35,
            ]
        ]);

        ChartYearOf::create([
            'year_of' => '2025',
            'monthly_project_categories' => $monthlyProjectCategories,
            'project_local_categories' => $projectLocalCategories,
        ]);
    }
}
