@extends('layouts.backend')

@section('title', 'Petugas Perpus - Tambah Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tambah Peminjaman</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <form action="{{ route('petugas.peminjamans.store') }}" method="POST">
                @csrf

                {{-- Kode Peminjaman --}}
                <div class="mb-3">
                    <label class="form-label">Kode Peminjaman</label>
                    <input type="text" class="form-control" value="Otomatis oleh sistem" readonly>
                </div>

                {{-- User --}}
                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" id="user_id"
                        class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buku --}}
                <div class="mb-3">
                    <label for="buku_id" class="form-label">Buku</label>
                    <select name="buku_id" id="buku_id"
                        class="form-select @error('buku_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                {{ $buku->judul }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        required>
                    @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status Default --}}
                <input type="hidden" name="status" value="dipinjam">

                {{-- Tombol --}}
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('petugas.peminjamans.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </form>
        </div>

    </div>
</div>
@endsection