<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect user after login based on role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return route('admin.dashboard'); // ✅ redirect ke dashboard admin
            case 'petugas':
                return route('petugas.dashboard'); // ✅ redirect ke dashboard petugas
            default:
                return route('home'); // ✅ user biasa diarahkan ke halaman frontend
        }
    }

    /**
     * Setelah logout redirect ke halaman frontend home.
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('home');
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Guest middleware untuk yang belum login
        $this->middleware('guest')->except('logout');
    }
}