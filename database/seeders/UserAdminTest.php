<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserAdminTest extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_name' => 'Admin101',
            'email' => 'Admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // You can use bcrypt instead if you prefer
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Admin', // Default role, can be changed
        ]);

        DB::table('org_users_info')->insert([
            'user_name' => 'Admin101',
            'full_name' => 'Admin User Ex.',
            'birthdate' => '2002-01-01',
            'access_to' => 'Allowed',
        ]);
    }
}