<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar user
    public function index()
    {
        $users = User::where('role', 'user')->get(); // hanya user biasa
        return view('petugas.users.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('petugas.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // fix role user
        ]);

        return redirect()->route('petugas.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Detail user
    public function show($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        return view('petugas.users.show', compact('user'));
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        return view('petugas.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('petugas.users.index')->with('success', 'User berhasil diperbarui!');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->delete();

        return redirect()->route('petugas.users.index')->with('success', 'User berhasil dihapus!');
    }
}