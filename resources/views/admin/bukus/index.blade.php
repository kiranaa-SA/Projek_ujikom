@extends('layouts.backend')

@section('title', 'Admin Perpus - Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Buku</h3>
            <a href="{{ route('admin.bukus.create') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Tambah Data
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>Gambar</th> {{-- Pindah ke sini --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td class="text-start">{{ Str::limit($buku->deskripsi, 50, '...') }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>
                                @if($buku->gambar)
                                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" width="60">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.bukus.show', $buku->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.bukus.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
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
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data buku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
