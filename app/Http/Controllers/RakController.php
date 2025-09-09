<?php
namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    // Tampilkan semua rak
    public function index()
    {
        $raks = Rak::all();
        return view('raks.index', compact('raks'));
    }

    // Form tambah rak
    public function create()
    {
        return view('raks.create');
    }

    // Simpan rak baru
    public function store(Request $request)
    {
        $request->validate([
            'kode'   => 'required|max:50',
            'nama'   => 'required|max:100',
            'lokasi' => 'required|max:100',
        ]);

        Rak::create($request->all());

        return redirect()->route('raks.index')->with('success', 'Rak berhasil ditambahkan');
    }

    // Tampilkan detail rak
    public function show(Rak $rak)
    {
        return view('raks.show', compact('rak'));
    }

    // Form edit rak
    public function edit(Rak $rak)
    {
        return view('raks.edit', compact('rak'));
    }

    // Update rak
    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'kode'   => 'required|max:50',
            'nama'   => 'required|max:100',
            'lokasi' => 'required|max:100',
        ]);

        $rak->update($request->all());

        return redirect()->route('raks.index')->with('success', 'Rak berhasil diupdate');
    }

    // Hapus rak
    public function destroy(Rak $rak)
    {
        $rak->delete();
        return redirect()->route('raks.index')->with('success', 'Rak berhasil dihapus');
    }
}