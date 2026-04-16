@extends('layouts.backend')

@section('title', 'Admin Perpus - Detail Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h3>Detail Peminjaman</h3>
            <a href="{{ route('admin.peminjamans.index') }}" class="btn btn-light btn-sm">
                Kembali
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Kode</th>
                    <td>{{ $peminjaman->kode_peminjaman }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $peminjaman->user->name }}</td>
                </tr>
                <tr>
                    <th>Buku</th>
                    <td>{{ $peminjaman->buku->judul }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                </tr>
                <tr>
                    <th>Tenggat Tempo</th>
                    <td>{{ $peminjaman->tenggat_tempo }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($peminjaman->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($peminjaman->status == 'dipinjam')
                            <span class="badge bg-success">Dipinjam</span>
                        @elseif($peminjaman->status == 'dikembalikan')
                            <span class="badge bg-primary">Dikembalikan</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Perpanjang</th>
                    <td>
                        <span class="badge bg-dark">
                            {{ $peminjaman->jumlah_perpanjang }}x
                        </span>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>
@endsection