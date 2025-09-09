<?php
namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with('pengembalian.peminjaman.user')->latest()->get();
        return view('dendas.index', compact('dendas'));
    }

    public function create()
    {
        $pengembalians = Pengembalian::with('peminjaman.user')->get();
        $kondisiList   = ['baik', 'rusak', 'hilang'];
        $statusList    = ['belum_dibayar', 'lunas'];

        return view('dendas.create', compact('pengembalians', 'kondisiList', 'statusList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'kondisi_buku'    => 'required|in:baik,rusak,hilang',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        Denda::create($request->all());

        return redirect()->route('dendas.index')->with('success', 'Denda berhasil ditambahkan!');
    }

    public function show(Denda $denda)
    {
        return view('dendas.show', compact('denda'));
    }

    public function edit(Denda $denda)
    {
        $pengembalians = Pengembalian::with('peminjaman.user')->get();
        $kondisiList   = ['baik', 'rusak', 'hilang'];
        $statusList    = ['belum_dibayar', 'lunas'];

        return view('dendas.edit', compact('denda', 'pengembalians', 'kondisiList', 'statusList'));
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'kondisi_buku'    => 'required|in:baik,rusak,hilang',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        $denda->update($request->all());

        return redirect()->route('dendas.index')->with('success', 'Denda berhasil diperbarui!');
    }

    public function destroy(Denda $denda)
    {
        $denda->delete();
        return redirect()->route('dendas.index')->with('success', 'Denda berhasil dihapus!');
    }
}