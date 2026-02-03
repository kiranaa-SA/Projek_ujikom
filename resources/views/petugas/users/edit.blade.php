@extends('layouts.backend')

@section('title', 'Petugas Perpus - Edit User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Edit User</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <form action="{{ route('petugas.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('petugas.users.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
