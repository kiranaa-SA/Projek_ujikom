<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    // Tampilkan semua rak
    public function index()
    {
        $raks = Rak::all();
        return view('admin.raks.index', compact('raks'));
    }

    // Form tambah rak
    public function create()
    {
        return view('admin.raks.create');
    }

    // Simpan rak baru
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode'   => 'required|string|max:50|unique:raks,kode',
                'nama'   => 'required|string|max:100',
                'lokasi' => 'required|string|max:100',
            ],
            [
                'kode.required'   => 'Kode rak wajib diisi',
                'kode.unique'     => 'Kode rak sudah digunakan',
                'kode.max'        => 'Kode rak maksimal 50 karakter',
                'nama.required'   => 'Nama rak wajib diisi',
                'nama.max'        => 'Nama rak maksimal 100 karakter',
                'lokasi.required' => 'Lokasi rak wajib diisi',
                'lokasi.max'      => 'Lokasi rak maksimal 100 karakter',
            ]
        );

        Rak::create($request->only(['kode', 'nama', 'lokasi']));

        return redirect()
            ->route('admin.raks.index')
            ->with('success', 'Rak berhasil ditambahkan');
    }

    // Form edit rak
    public function edit(Rak $rak)
    {
        return view('admin.raks.edit', compact('rak'));
    }

    // Update rak
    public function update(Request $request, Rak $rak)
    {
        $request->validate(
            [
                'kode'   => 'required|string|max:50|unique:raks,kode,' . $rak->id,
                'nama'   => 'required|string|max:100',
                'lokasi' => 'required|string|max:100',
            ],
            [
                'kode.required'   => 'Kode rak wajib diisi',
                'kode.unique'     => 'Kode rak sudah digunakan',
                'kode.max'        => 'Kode rak maksimal 50 karakter',
                'nama.required'   => 'Nama rak wajib diisi',
                'nama.max'        => 'Nama rak maksimal 100 karakter',
                'lokasi.required' => 'Lokasi rak wajib diisi',
                'lokasi.max'      => 'Lokasi rak maksimal 100 karakter',
            ]
        );

        $rak->update($request->only(['kode', 'nama', 'lokasi']));

        return redirect()
            ->route('admin.raks.index')
            ->with('success', 'Rak berhasil diupdate');
    }

    // Hapus rak
    public function destroy(Rak $rak)
    {
        $rak->delete();

        return redirect()
            ->route('admin.raks.index')
            ->with('success', 'Rak berhasil dihapus');
    }

    // Detail rak
    public function show(Rak $rak)
    {
        return view('admin.raks.show', compact('rak'));
    }
}