@extends('layouts.backend')

@section('title', 'Petugas Perpus - Kelola User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar User</h3>
             <a href="{{ route('petugas.users.create') }}" 
            class="btn" 
            style="background-color: #26559b; color: white; border: none;">
            Tambah Data
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th style="width:5%;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td class="text-start">{{ $user->email }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('petugas.users.show', $user->id) }}" class="btn btn-sm btn-info mb-1">Detail</a>
                                    <a href="{{ route('petugas.users.edit', $user->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <form action="{{ route('petugas.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mb-1">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
