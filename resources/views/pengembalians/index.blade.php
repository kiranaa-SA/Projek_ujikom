@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Daftar Pengembalian</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengembalians.create') }}" class="btn btn-primary mb-3">Tambah Pengembalian</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $pengembalian->id }}</td>
                    <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                    <td>{{ $pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                    <td>{{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
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
                        <a href="{{ route('pengembalians.show', $pengembalian->id) }}" 
                           class="btn btn-info btn-sm mb-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('pengembalians.edit', $pengembalian->id) }}" 
                           class="btn btn-warning btn-sm mb-1" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('pengembalians.destroy', $pengembalian->id) }}" 
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
