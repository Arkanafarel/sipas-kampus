<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan seeder kategori
        $this->call([
            CategorySeeder::class,
        ]);

        // Akun Admin Bawaan
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'npm' => '00000000',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Akun Mahasiswa Bawaan
        User::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa Contoh',
                'npm' => '12345678',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
            ]
        );
    }
}
