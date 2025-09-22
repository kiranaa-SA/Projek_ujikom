@extends('layouts.backend')

@section('title', 'Admin Perpus - Peminjaman')

@section('content')
<div class="container py-4">
    {{-- Card utama --}}
    <div class="card shadow-sm">
        {{-- Card header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Peminjaman</h3>
            <a href="{{ route('admin.peminjamans.create') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Tambah Data
            </a>
        </div>

        {{-- Card body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:15%;">User</th>
                            <th style="width:20%;">Buku</th>
                            <th style="width:12%;">Tanggal Pinjam</th>
                            <th style="width:12%;">Tenggat Tempo</th>
                            <th style="width:10%;">Status</th>
                            <th style="width:20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                        <tr class="text-nowrap">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis;">{{ $peminjaman->buku->judul ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam ?? '-' }}</td>
                            <td>{{ $peminjaman->tenggat_tempo ?? '-' }}</td>
                            <td>
                                @if($peminjaman->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.peminjamans.show', $peminjaman->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.peminjamans.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.peminjamans.destroy', $peminjaman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
