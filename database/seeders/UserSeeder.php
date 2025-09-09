<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name'     => 'Siswa 1',
            'email'    => 'siswa1@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name'     => 'Siswa 2',
            'email'    => 'siswa2@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}