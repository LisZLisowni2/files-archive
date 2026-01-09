<?php

namespace Database\Seeders;

use App\EnumsScope;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'scope' => EnumsScope::ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Root User',
            'email' => 'root@example.com',
            'password'=> bcrypt('12345678'),
            'scope' => EnumsScope::ROOT,
        ]);
    }
}
