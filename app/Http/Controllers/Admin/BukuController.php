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
    public function index()
    {
        $bukus = Buku::with(['rak', 'kategori'])->get();
        return view('admin.bukus.index', compact('bukus'));
    }

    public function create()
    {
        $raks      = Rak::all();
        $kategoris = Kategori::all();
        return view('admin.bukus.create', compact('raks', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
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
            ],
            [
                'kode_buku.required'  => 'Kode buku wajib diisi',
                'kode_buku.unique'    => 'Kode buku sudah digunakan',
                'judul.required'      => 'Judul buku wajib diisi',
                'penulis.required'    => 'Penulis wajib diisi',
                'penerbit.required'   => 'Penerbit wajib diisi',
                'tahun_terbit.digits' => 'Tahun terbit harus 4 digit',
                'stok.min'            => 'Stok tidak boleh minus',
                'rak_id.exists'       => 'Rak tidak valid',
                'kategori_id.exists'  => 'Kategori tidak valid',
                'gambar.image'        => 'File harus berupa gambar',
                'gambar.max'          => 'Ukuran gambar maksimal 2MB',
            ]
        );

        $buku = new Buku($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            $path         = $request->file('gambar')->store('bukus', 'public');
            $buku->gambar = $path;
        }

        $buku->save();

        return redirect()
            ->route('admin.bukus.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('admin.bukus.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $raks      = Rak::all();
        $kategoris = Kategori::all();
        return view('admin.bukus.edit', compact('buku', 'raks', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate(
            [
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
            ],
            [
                'kode_buku.required'  => 'Kode buku wajib diisi',
                'kode_buku.unique'    => 'Kode buku sudah digunakan',
                'judul.required'      => 'Judul buku wajib diisi',
                'penulis.required'    => 'Penulis wajib diisi',
                'penerbit.required'   => 'Penerbit wajib diisi',
                'tahun_terbit.digits' => 'Tahun terbit harus 4 digit',
                'stok.min'            => 'Stok tidak boleh minus',
            ]
        );

        $buku->fill($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $path         = $request->file('gambar')->store('bukus', 'public');
            $buku->gambar = $path;
        }

        $buku->save();

        return redirect()
            ->route('admin.bukus.index')
            ->with('success', 'Buku berhasil diupdate!');
    }

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