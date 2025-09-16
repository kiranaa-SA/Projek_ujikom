@extends('layouts.backend')

@section('title', 'Admin Perpus - Detail User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail User</h3>
        </div>
        <div class="card-body">
            <p><strong>No:</strong> {{ $userr->id }}</p>
            <p><strong>Nama:</strong> {{ $userr->name }}</p>
            <p><strong>Email:</strong> {{ $userr->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($userr->role) }}</p>
            <a href="{{ route('admin.userrs.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
