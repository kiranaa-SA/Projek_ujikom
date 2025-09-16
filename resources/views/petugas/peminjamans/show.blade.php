@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail Peminjaman</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">ID</th>
                            <td>{{ $peminjaman->id }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Buku</th>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td>{{ $peminjaman->tanggal_pinjam ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kembali</th>
                            <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $peminjaman->status == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('petugas.peminjamans.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
