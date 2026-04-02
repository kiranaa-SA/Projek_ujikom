@extends('layouts.backend')

@section('title', 'Admin Perpus - Tambah Kategori')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tambah Kategori</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <form action="{{ route('admin.kategoris.store') }}" method="POST">
                @csrf

                {{-- Nama Kategori --}}
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori') }}"
                        required>
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="3"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="(Opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>
        </div>

    </div>
</div>
@endsection
