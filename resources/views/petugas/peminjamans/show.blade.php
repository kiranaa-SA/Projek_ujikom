@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail Peminjaman</h3>
            <a href="{{ route('petugas.peminjamans.index') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Kembali
            </a>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_pengembalian ?? '-' }}</td>
                            <td>
                                @if($peminjaman->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
