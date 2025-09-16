@extends('layouts.backend')

@section('title', 'Petugas Perpus - Denda')

@section('content')
<div class="container py-4">
    {{-- Card utama --}}
    <div class="card shadow-sm">
        {{-- Card header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Daftar Denda</h3>
            <a href="{{ route('petugas.dendas.create') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Tambah Denda
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah</th>
                            <th>Kondisi Buku</th>
                            <th>Status</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dendas as $denda)
                        <tr class="text-nowrap">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $denda->pengembalian->peminjaman->user->name ?? '-' }}</td>
                            <td>Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}</td>
                            <td>{{ ucfirst($denda->kondisi_buku) }}</td>
                            <td>
                                @if($denda->status == 'belum_dibayar')
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @else
                                    <span class="badge bg-success">Lunas</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('petugas.dendas.show', $denda->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('petugas.dendas.edit', $denda->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('petugas.dendas.destroy', $denda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus denda ini?')">
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
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data denda</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
