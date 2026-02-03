@extends('layouts.backend')

@section('title', 'Detail User')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail User</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        @php
                            $labels = [
                                'admin'   => 'Administrator',
                                'petugas' => 'Petugas',
                                'user'    => 'Siswa',
                            ];
                        @endphp
                        {{ $labels[$user->role] ?? ucfirst($user->role) }}
                    </td>
                </tr>

            </table>

            <div class="mt-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
