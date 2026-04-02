<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // ADMIN
        // =====================
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin Perpus',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // =====================
        // PETUGAS
        // =====================
        User::updateOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'name'     => 'Petugas Perpus',
                'password' => Hash::make('petugas123'),
                'role'     => 'petugas',
            ]
        );
    }
}