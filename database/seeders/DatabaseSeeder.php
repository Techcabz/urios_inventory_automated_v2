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
            'status' => "completed",
            'role_as' => 1,
            'status' => 0,
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'username' => 'testuser',
            'email' => 'user@test.com',
            'status' => "completed",
            'role_as' => 0, 
            'status' => 'incompleted',
            'password' => Hash::make('user1234'),
        ]);
    }
}
