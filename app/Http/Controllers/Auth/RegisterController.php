<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani registrasi user baru.
    | Kita menambahkan role 'siswa' otomatis.
    |
    */

    use RegistersUsers;

    /**
     * Redirect setelah register
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Buat instance controller baru.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validator input register.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Buat user baru setelah validasi berhasil
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user', // otomatis jadi siswa
        ]);
    }

    /**
     * Override register untuk langsung login user setelah register
     */
}