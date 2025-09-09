@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Daftar Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kategoris.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td class="text-nowrap">
                        <a href="{{ route('kategoris.show', $kategori->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
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
                <td colspan="3" class="text-center">Belum ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
