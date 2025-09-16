<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin'), 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            ['name' => 'Petugas', 'password' => Hash::make('petugas'), 'role' => 'petugas']
        );

        User::firstOrCreate(
            ['email' => 'siswa1@gmail.com'],
            ['name' => 'Siswa 1', 'password' => Hash::make('password123'), 'role' => 'siswa']
        );

        User::firstOrCreate(
            ['email' => 'siswa2@gmail.com'],
            ['name' => 'Siswa 2', 'password' => Hash::make('password123'), 'role' => 'siswa']
        );
    }
}