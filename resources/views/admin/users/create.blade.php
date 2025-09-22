@extends('layouts.backend')

@section('title', 'Tambah User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah User</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin"   {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ old('role')=='petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="user"    {{ old('role')=='user' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password (opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan untuk default password: password123">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
