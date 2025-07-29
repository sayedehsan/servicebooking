<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Remember to change this in production!
            'user_type' => 'admin',
        ]);

        // Regular User 1
        User::create([
            'name' => 'Rahat Murshed',
            'email' => 'rahat@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'customer',
        ]);

        // Regular User 2
        User::create([
            'name' => 'Sayed Ehsan',
            'email' => 'ehsan@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'customer',
        ]);
    }
}
