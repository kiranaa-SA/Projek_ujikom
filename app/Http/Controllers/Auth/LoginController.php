<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
                return route('admin.dashboard'); // redirect ke admin dashboard
            case 'petugas':
                return route('petugas.dashboard'); // redirect ke petugas dashboard
            case 'siswa':
                return route('siswa.dashboard'); // redirect ke siswa dashboard
            default:
                return '/home'; // fallback
        }
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}