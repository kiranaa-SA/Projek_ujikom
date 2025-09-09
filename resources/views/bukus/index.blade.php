@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('bukus.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Buku
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Rak</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukus as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->kode_buku }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                    <td>
                        @if($buku->stok > 5)
                            <span class="badge bg-success">{{ $buku->stok }}</span>
                        @elseif($buku->stok > 0)
                            <span class="badge bg-warning text-dark">{{ $buku->stok }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>{{ $buku->rak->nama }}</td>
                    <td>{{ $buku->kategori->nama_kategori }}</td>
                    <td>
                        @if($buku->gambar)
                            <img src="{{ asset('storage/' . $buku->gambar) }}" 
                                 alt="Gambar Buku" class="img-thumbnail" width="60">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('bukus.show', $buku->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
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
                    <td colspan="11" class="text-center text-muted py-4">Belum ada data buku</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
