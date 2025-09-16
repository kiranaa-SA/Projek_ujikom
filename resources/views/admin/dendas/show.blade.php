@extends('layouts.backend')

@section('title', 'Admin Perpus - Detail Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail Denda</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Peminjam</th>
                    <td>{{ $denda->pengembalian->peminjaman->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Buku</th>
                    <td>{{ $denda->pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Denda</th>
                    <td>Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}</td>
                </tr>
                <tr>
                    <th>Kondisi Buku</th>
                    <td>{{ ucfirst($denda->kondisi_buku) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($denda->status == 'belum_dibayar')
                            <span class="badge bg-warning text-dark">Belum Lunas</span>
                        @else
                            <span class="badge bg-success">Lunas</span>
                        @endif
                    </td>
                </tr>
            </table>
            <a href="{{ route('admin.dendas.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
d