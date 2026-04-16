<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $bukus = Buku::with(['rak', 'kategori'])->latest()->get();
        return view('admin.bukus.index', compact('bukus'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $raks = Rak::all();
        $kategoris = Kategori::all();

        return view('admin.bukus.create', compact('raks', 'kategoris'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku'    => 'required|string|max:50|unique:bukus,kode_buku',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok'         => 'required|integer|min:0',
            'rak_id'       => 'required|exists:raks,id',
            'kategori_id'  => 'required|exists:kategoris,id',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'    => 'nullable|string|max:1000',
        ]);

        // upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('bukus', 'public');
        }

        Buku::create($validated);

        return redirect()
            ->route('admin.bukus.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    // =========================
    // SHOW
    // =========================
    public function show(Buku $buku)
    {
        return view('admin.bukus.show', compact('buku'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit(Buku $buku)
    {
        $raks = Rak::all();
        $kategoris = Kategori::all();

        return view('admin.bukus.edit', compact('buku', 'raks', 'kategoris'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kode_buku'    => 'required|string|max:50|unique:bukus,kode_buku,' . $buku->id,
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok'         => 'required|integer|min:0',
            'rak_id'       => 'required|exists:raks,id',
            'kategori_id'  => 'required|exists:kategoris,id',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'    => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('gambar')) {

            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('bukus', 'public');
        }

        $buku->update($validated);

        return redirect()
            ->route('admin.bukus.index')
            ->with('success', 'Buku berhasil diupdate!');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy(Buku $buku)
    {
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()
            ->route('admin.bukus.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}