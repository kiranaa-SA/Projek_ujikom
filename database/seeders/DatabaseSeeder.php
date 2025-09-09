<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // Petugas
        User::updateOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'name'     => 'Petugas User',
                'password' => Hash::make('password123'),
                'role'     => 'petugas',
            ]
        );

        // Siswa
        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name'     => 'Siswa User',
                'password' => Hash::make('password123'),
                'role'     => 'siswa',
            ]
        );
    }
}