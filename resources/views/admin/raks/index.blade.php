@extends('layouts.backend')

@section('title', 'Admin Perpus - Daftar Rak')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Rak</h3>
            <a href="{{ route('admin.raks.create') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Tambah Data
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
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
                                    <a href="{{ route('admin.raks.show', $rak->id) }}" 
                                       class="btn btn-info btn-sm mb-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.raks.edit', $rak->id) }}" 
                                       class="btn btn-warning btn-sm mb-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.raks.destroy', $rak->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin hapus data rak ini?')">
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
                                <td colspan="5" class="text-center text-muted">Belum ada data rak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
