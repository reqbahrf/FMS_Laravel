<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTest extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_name' => 'Staff101',
            'email' => 'Staff@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Staff', // Default role, can be changed
        ]);

        DB::table('org_users_info')->insert([
            'user_name' => 'Staff101',
            'profile_pic' => null,
            'prefix' => '',
            'f_name' => 'User',
            'mid_name' => 'A.',
            'l_name' => 'Staff',
            'suffix' => '',
            'gender' => 'Male',
            'birthdate' => '2000-01-01',
            'access_to' => 'Allowed',
        ]);
    }
}
