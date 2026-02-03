@extends('layouts.backend')

@section('title', 'Admin Perpus - Kelola User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar User</h3>
            <a href="{{ route('admin.users.create') }}" 
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
                            <th>Role</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td class="text-start">{{ $user->email }}</td>
                                <td>
                                    @php
                                        $labels = [
                                            'admin'   => ['label' => 'Administrator', 'color' => 'danger'],
                                            'petugas' => ['label' => 'Petugas', 'color' => 'primary'],
                                            'user'    => ['label' => 'Siswa', 'color' => 'success'],
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $labels[$user->role]['color'] ?? 'secondary' }}">
                                        {{ $labels[$user->role]['label'] ?? ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('admin.users.show', $user->id) }}" 
                                       class="btn btn-sm btn-info mb-1" title="Detail">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning mb-1" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mb-1" title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
