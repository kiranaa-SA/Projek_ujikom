@extends('layouts.backend')

@section('title', 'Edit User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Edit User</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin"   {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ old('role', $user->role)=='petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="user"    {{ old('role', $user->role)=='user' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password (opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ubah password">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
