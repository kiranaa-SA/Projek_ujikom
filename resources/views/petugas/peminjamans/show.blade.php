@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- 🔹 Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail Peminjaman</h3>
            <a href="{{ route('petugas.peminjamans.index') }}" 
               class="btn btn-sm" 
               style="background-color: #1d37df; color: white;">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        {{-- 🔹 Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead style="background-color: #e3f2fd;">
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tenggat Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <span class="fw-semibold text-primary">
                                    {{ $peminjaman->kode_peminjaman }}
                                </span>
                            </td>
                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                            <td>
                                {{ $peminjaman->tanggal_pinjam
                                    ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y')
                                    : '-' }}
                            </td>
                            <td>
                                {{ $peminjaman->tenggat_tempo
                                    ? \Carbon\Carbon::parse($peminjaman->tenggat_tempo)->format('d M Y')
                                    : '-' }}
                            </td>
                            <td>
                                @switch($peminjaman->status)
                                    @case('pending')
                                        <span class="badge bg-secondary">Pending</span>
                                        @break
                                    @case('dipinjam')
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @break
                                    @case('dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @break
                                    @default
                                        <span class="badge bg-light text-dark">Unknown</span>
                                @endswitch
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection