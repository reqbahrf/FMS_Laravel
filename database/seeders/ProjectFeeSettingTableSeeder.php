<?php

namespace Database\Seeders;

use App\Models\ProjectSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectFeeSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectSetting::create([
            'key' => 'fee_percentage',
            'value' => "5",
        ]);
    }
}
