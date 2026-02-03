@extends('layouts.backend')

@section('title', 'Petugas Perpus - Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
 <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Pengembalian</h3>
             <a href="{{ route('petugas.pengembalians.create') }}" 
            class="btn" 
            style="background-color: #26559b; color: white; border: none;">
            Tambah Data
            </a>
        </div>       

        {{-- Body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $pengembalian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                                <td>{{ $pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                                <td>{{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}</td>
                                <td>{{ $pengembalian->tanggal_pengembalian ?? '-' }}</td>
                                <td>
                                    @if($pengembalian->kondisi == 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($pengembalian->kondisi == 'rusak')
                                        <span class="badge bg-warning text-dark">Rusak</span>
                                    @else
                                        <span class="badge bg-danger">Hilang</span>
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('petugas.pengembalians.show', $pengembalian->id) }}" 
                                       class="btn btn-info btn-sm mb-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('petugas.pengembalians.edit', $pengembalian->id) }}" 
                                       class="btn btn-warning btn-sm mb-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('petugas.pengembalians.destroy', $pengembalian->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin hapus data ini?')">
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
                                <td colspan="7" class="text-center text-muted py-3">Belum ada data pengembalian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
