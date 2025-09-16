@extends('layouts.backend')

@section('title', 'Admin Perpus - Edit User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Edit User</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.userrs.update', $userr->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $userr->name) }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $userr->email) }}">
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="siswa" {{ $userr->role=='siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="admin" {{ $userr->role=='admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $userr->role=='petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.userrs.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
