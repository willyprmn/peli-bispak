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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            'name' => 'Administrator',
            'email' => 'permanawilly21@bkkbn.go.id',
            'password' => Hash::make('passwd'),
            'username' => 'admin',
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
