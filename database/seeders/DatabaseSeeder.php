<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@karirku.com',
            'role' => 'superadmin', 
            'password' => Hash::make('password'),
        ]);

        // 2. Create Employer (Perusahaan)
        $employerUser = User::factory()->create([
            'name' => 'HRD PT Mencari Cinta',
            'email' => 'hrd@company.com',
            'role' => 'employer',
            'password' => Hash::make('password'),
        ]);

        // 3. Create Candidate (Pelamar Kerja)
        User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'user@karirku.com',
            'role' => 'candidate',
            'password' => Hash::make('password'),
        ]);
    }
}
