@extends('layouts.backend')

@section('title', 'Admin Perpus - Tambah Hero Banner')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- Card header --}}
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Hero Banner</h3>
        </div>

        {{-- Card body --}}
        <div class="card-body">
            <form action="{{ route('admin.hero-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul Utama --}}
                <div class="mb-3">
                    <label for="judul_utama" class="form-label">Judul Utama</label>
                    <input type="text" name="judul_utama"
                        class="form-control @error('judul_utama') is-invalid @enderror"
                        value="{{ old('judul_utama') }}" required>
                    @error('judul_utama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar Banner --}}
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Banner</label>
                    <input type="file" name="gambar"
                        class="form-control @error('gambar') is-invalid @enderror" required>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn" style="background-color: #1d37df; color: white;">
                    Simpan
                </button>
                <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </form>
        </div>
    </div>
</div>
@endsection
