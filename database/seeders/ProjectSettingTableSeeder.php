<?php

namespace Database\Seeders;


use App\Models\ProjectSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        ProjectSetting::insert(
            ['key' => 'fee_percentage', 'value' => "0"],
            ['key' => 'notify_duration', 'value' => "20"],
            ['key' => 'notify_interval', 'value' => "5"]
        );
        DB::commit();
    }
}
