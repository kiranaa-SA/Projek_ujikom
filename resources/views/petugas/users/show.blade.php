@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail User</h3>
            <a href="{{ route('petugas.users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <table class="table table-bordered table-striped text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
