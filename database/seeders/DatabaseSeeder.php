<?php

namespace Database\Seeders;

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
        // Admin User
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@mindbodygoals.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin',
        ]);

        // Demo Client User
        \App\Models\User::create([
            'name' => 'Demo Client',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $this->call(BookSeeder::class);
        $this->call(ServiceAndSlotSeeder::class);
    }
}
