<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Userr;
use Illuminate\Http\Request;

class UserrController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = Userr::orderBy('id')->get(); // ambil semua user
        return view('admin.userrs.index', compact('users'));
    }

    // Form tambah user baru
    public function create()
    {
        return view('admin.userrs.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:userrs,email',
            'role'  => 'required|in:admin,siswa,petugas',
        ]);

        Userr::create([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.userrs.index')->with('success', 'User berhasil ditambahkan');
    }

    // Tampilkan detail user
    public function show(Userr $userr)
    {
        return view('admin.userrs.show', compact('userr'));
    }

    // Form edit user
    public function edit(Userr $userr)
    {
        return view('admin.userrs.edit', compact('userr'));
    }

    // Update user
    public function update(Request $request, Userr $userr)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:userrs,email,' . $userr->id,
            'role'  => 'required|in:admin,siswa,petugas',
        ]);

        $userr->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.userrs.index')->with('success', 'User berhasil diupdate');
    }

    // Hapus user
    public function destroy(Userr $userr)
    {
        $userr->delete();
        return redirect()->route('admin.userrs.index')->with('success', 'User berhasil dihapus');
    }
}