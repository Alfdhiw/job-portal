<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'super@admin.com')->exists()) {

            User::create([
                'name'      => 'Super Administrator',
                'email'     => 'super@admin.com',
                'password'  => Hash::make('password123'),
                'role'      => 'superadmin',
                'email_verified_at' => now(),
            ]);

            $this->command->info('✅ Akun Super Admin berhasil dibuat!');
            $this->command->info('Email: super@admin.com');
            $this->command->info('Pass : password');
        } else {
            $this->command->warn('⚠️ Akun Super Admin sudah ada.');
        }
    }
}
