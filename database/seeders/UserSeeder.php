<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => "Admin",
                'email' => "admin@example.com",
                'role' => "admin",
                'password' => Hash::make('password'),
            ],
            
            [
                'name' => "user",
                'email' => "user@example.com",
                'role' => "user",
                'password' => Hash::make('password'),
            ],


            [
                'name' => "user2",
                'email' => "user2@example.com",
                'role' => "user",
                'password' => Hash::make('password'),
            ],
            ]);
    }
}
