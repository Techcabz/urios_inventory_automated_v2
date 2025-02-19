<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'administrator',
            'email' => 'admin@admin.com',
            'status' => "complete",
            'role_as' => 1,
            'user_status' => 0,
            'password' => Hash::make('admin123'),
        ]);


    }
}
