@extends('layouts.backend')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-3">Tambah Peminjaman</h2>
    <hr class="mb-4">

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ups!</strong> Ada beberapa masalah dengan inputan kamu.
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('peminjamans.store') }}" method="POST" class="p-4 border rounded bg-light shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label fw-semibold">User</label>
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

        <div class="mb-3">
            <label for="buku_id" class="form-label fw-semibold">Buku</label>
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

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" 
                   class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
            @error('tanggal_pinjam')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select name="status" id="status" 
                    class="form-select @error('status') is-invalid @enderror" required>
                <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tenggat Tempo dihitung otomatis di controller --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
