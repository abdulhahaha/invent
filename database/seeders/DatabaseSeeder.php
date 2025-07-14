<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
            'name' => 'inbound',
            'email' => 'inbound@gmail.com',
            'role' => 1,
            'password' => Hash::make('12345'), // Hash password
        ]);
       User::create([
            'name' => 'invent',
            'email' => 'invent@gmail.com',
            'role' => 2,
            'password' => Hash::make('12345'), // Hash password
        ]);
       User::create([
            'name' => 'outbound',
            'email' => 'outbound@gmail.com',
            'role' => 3,
            'password' => Hash::make('12345'), // Hash password
        ]);
       User::create([
            'name' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'role' => 4,
            'password' => Hash::make('12345'), // Hash password
        ]);
    }
}
