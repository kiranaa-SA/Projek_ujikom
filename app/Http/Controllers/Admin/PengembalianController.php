<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->latest()->get();
        return view('admin.pengembalians.index', compact('pengembalians'));
    }

    public function create()
    {
        // hanya peminjaman yang masih dipinjam
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        return view('admin.pengembalians.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'peminjaman_id'        => 'required|exists:peminjamans,id',
                'tanggal_pengembalian' => 'required|date',
                'kondisi'              => 'required|in:baik,rusak,hilang',
            ],
            [
                'peminjaman_id.required'        => 'Data peminjaman wajib dipilih',
                'tanggal_pengembalian.required' => 'Tanggal pengembalian wajib diisi',
                'kondisi.required'              => 'Kondisi buku wajib dipilih',
            ]
        );

        $peminjaman = Peminjaman::with('buku')->findOrFail($request->peminjaman_id);

        // hitung keterlambatan
        $tanggalKembali = Carbon::parse($request->tanggal_pengembalian);
        $jatuhTempo     = Carbon::parse($peminjaman->tenggat_tempo);
        $terlambat      = $tanggalKembali->greaterThan($jatuhTempo)
            ? $tanggalKembali->diffInDays($jatuhTempo)
            : 0;

        // hitung denda
        if ($request->kondisi === 'hilang') {
            $denda = 50000;
        } else {
            $denda = $terlambat * 5000;
            if ($request->kondisi === 'rusak') {
                $denda += 10000;
            }
        }

        $pengembalian  = Pengembalian::create([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat'            => $terlambat,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
        ]);

        // update status peminjaman
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        // tambah stok buku jika tidak hilang
        if ($request->kondisi !== 'hilang') {
            $peminjaman->buku->increment('stok');
        }

        // simpan laporan otomatis
        Laporan::create([
            'peminjaman_id'   => $request->peminjaman_id,
            'pengembalian_id' => $pengembalian->id,
            'kondisi_buku'    => $request->kondisi,
            'tanggal'         => $request->tanggal_pengembalian,
        ]);

        return redirect()
            ->route('admin.pengembalians.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->findOrFail($id);

        return view('admin.pengembalians.show', compact('pengembalian'));
    }
}