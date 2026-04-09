<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form register (untuk web)
    public function showRegistrationForm()
    {
        return view('auth.register'); // pastikan file view ada di resources/views/auth/register.blade.php
    }

    // Proses register (API & web)
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // tambahkan confirmed supaya ada password_confirmation
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // bisa diubah sesuai kebutuhan
        ]);

        // Kalau ini untuk API
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Register success',
                'user' => $user
            ], 201);
        }

        // Kalau ini untuk web (redirect)
        return redirect()->route('login')->with('success', 'Register success, silakan login!');
    }
}