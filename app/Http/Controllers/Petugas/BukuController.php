<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['rak', 'kategori'])->get();
        return view('petugas.bukus.index', compact('bukus'));
    }

    public function create()
    {
        $raks      = Rak::all();
        $kategoris = Kategori::all();
        return view('petugas.bukus.create', compact('raks', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku'    => 'required|unique:bukus,kode_buku',
            'judul'        => 'required',
            'penulis'      => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|integer',
            'stok'         => 'required|integer',
            'rak_id'       => 'required|exists:raks,id',
            'kategori_id'  => 'required|exists:kategoris,id',
            'gambar'       => 'nullable|image|max:2048',
            'deskripsi'    => 'nullable|string', // tambahan
        ]);

        $buku = new Buku($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            $path         = $request->file('gambar')->store('bukus', 'public');
            $buku->gambar = $path;
        }

        $buku->deskripsi = $request->deskripsi; // simpan deskripsi

        $buku->save();

        return redirect()->route('petugas.bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('petugas.bukus.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $raks      = Rak::all();
        $kategoris = Kategori::all();
        return view('petugas.bukus.edit', compact('buku', 'raks', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku'    => 'required|unique:bukus,kode_buku,' . $buku->id,
            'judul'        => 'required',
            'penulis'      => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|integer',
            'stok'         => 'required|integer',
            'rak_id'       => 'required|exists:raks,id',
            'kategori_id'  => 'required|exists:kategoris,id',
            'gambar'       => 'nullable|image|max:2048',
            'deskripsi'    => 'nullable|string', // tambahan
        ]);

        $buku->fill($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            // hapus gambar lama jika ada
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $path         = $request->file('gambar')->store('bukus', 'public');
            $buku->gambar = $path;
        }

        $buku->deskripsi = $request->deskripsi; // update deskripsi

        $buku->save();

        return redirect()->route('petugas.bukus.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()->route('petugas.bukus.index')->with('success', 'Buku berhasil dihapus!');
    }
}