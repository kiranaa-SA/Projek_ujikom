@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Daftar Rak</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('raks.create') }}" class="btn btn-primary mb-3">Tambah Rak</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($raks as $rak)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rak->kode }}</td>
                    <td>{{ $rak->nama }}</td>
                    <td>{{ $rak->lokasi }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('raks.show', $rak->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('raks.edit', $rak->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('raks.destroy', $rak->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
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
                    <td colspan="5" class="text-center">Belum ada data rak.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
