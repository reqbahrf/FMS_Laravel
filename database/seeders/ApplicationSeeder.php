<?php

namespace Database\Seeders;

use App\Models\ApplicationInfo;
use App\Models\Assets;
use App\Models\BusinessInfo;
use App\Models\Personnel;
use App\Models\User;
use App\Models\Requirement;
use App\Models\CoopUserInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $user = User::factory()->create();

            $coopUserInfo = CoopUserInfo::factory()->create([
                'user_name' => $user->user_name,
            ]);

            $businessInfo = BusinessInfo::factory()->create([
                'user_info_id' => $coopUserInfo->id,
            ]);

            Assets::factory()->create([
                'id' => $businessInfo->id
            ]);

            Personnel::factory()->create([
                'id' => $businessInfo->id
            ]);

            Requirement::factory()->create([
                'business_id' => $businessInfo->id
            ]);

            ApplicationInfo::factory()->create([
                'business_id' => $businessInfo->id
            ]);

        }
    }
}
