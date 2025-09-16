@extends('layouts.backend')

@section('title', 'Admin Perpus - User')

@section('content')
<div class="container py-4">
    {{-- Card utama --}}
    <div class="card shadow-sm">
        {{-- Card header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Daftar User</h3>
            <a href="{{ route('admin.userrs.create') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Tambah User
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
                            <th style="width: 5%;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="text-nowrap">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.userrs.show', $user->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.userrs.edit', $user->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.userrs.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
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
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data user</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
