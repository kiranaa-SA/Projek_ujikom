@extends('layouts.backend')

@section('title', 'Admin Perpus - Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Peminjaman</h3>
            <a href="{{ route('admin.peminjamans.create') }}"
               class="btn"
               style="background-color: #26559b; color: white; border: none;">
               Tambah Data
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd;">
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tenggat Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-primary">
                                {{ $peminjaman->kode_peminjaman }}
                            </td>
                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tenggat_tempo }}</td>

                            {{-- STATUS --}}
                            <td>
                                @switch($peminjaman->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @break
                                    @case('dipinjam')
                                        <span class="badge bg-success">Dipinjam</span>
                                        @break
                                    @case('dikembalikan')
                                        <span class="badge bg-primary">Dikembalikan</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Tidak diketahui</span>
                                @endswitch
                            </td>

                            {{-- AKSI --}}
                           <td>
                        <div class="d-flex justify-content-center gap-2">
                            {{-- PENDING --}}
                            @if($peminjaman->status === 'pending')
                                <form action="{{ route('admin.peminjamans.accept', $peminjaman->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm" title="Setujui">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.peminjamans.reject', $peminjaman->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" title="Tolak">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>

                            {{-- DIPINJAM --}}
                            @else
                                <a href="{{ route('admin.peminjamans.show', $peminjaman->id) }}"
                                class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-4">
                                Belum ada data peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
