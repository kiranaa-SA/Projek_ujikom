<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategoris.index', compact('kategoris'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategoris.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
                'deskripsi'     => 'nullable|string|max:255',
            ],
            [
                'nama_kategori.required' => 'Nama kategori wajib diisi',
                'nama_kategori.unique'   => 'Nama kategori sudah digunakan',
                'nama_kategori.max'      => 'Nama kategori maksimal 100 karakter',
                'deskripsi.max'          => 'Deskripsi maksimal 255 karakter',
            ]
        );

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan detail kategori
    public function show(Kategori $kategori)
    {
        return view('admin.kategoris.show', compact('kategori'));
    }

    // Menampilkan form edit kategori
    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori,' . $kategori->id,
                'deskripsi'     => 'nullable|string|max:255',
            ],
            [
                'nama_kategori.required' => 'Nama kategori wajib diisi',
                'nama_kategori.unique'   => 'Nama kategori sudah digunakan',
                'nama_kategori.max'      => 'Nama kategori maksimal 100 karakter',
                'deskripsi.max'          => 'Deskripsi maksimal 255 karakter',
            ]
        );

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    // Hapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}