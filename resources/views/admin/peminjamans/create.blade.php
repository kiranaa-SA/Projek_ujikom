@extends('layouts.backend')

@section('title', 'Admin Perpus - Tambah Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tambah Peminjaman</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.peminjamans.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kode Peminjaman</label>
                    <input type="text" class="form-control" value="Otomatis oleh sistem" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Buku</label>
                    <select name="buku_id" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control"
                        value="{{ date('Y-m-d') }}" required>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.peminjamans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>

    </div>
</div>
@endsection