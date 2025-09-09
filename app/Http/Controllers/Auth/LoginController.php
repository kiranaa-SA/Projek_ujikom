<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan ada resources/views/auth/login.blade.php
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect user sesuai role.
     */
    protected function redirectBasedOnRole($user)
    {
        if ($user->role === 'admin') {
            return redirect('/kategoris'); // admin ke kategori
        }

        if ($user->role === 'petugas') {
            return redirect('/bukus'); // petugas ke buku
        }

        if ($user->role === 'siswa') {
            return redirect('/bukus'); // siswa juga ke buku
        }

        return redirect('/home'); // fallback
    }
}