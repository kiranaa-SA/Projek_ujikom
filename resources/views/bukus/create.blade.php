@extends('layouts.backend')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-3">Tambah Buku</h2>
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
    <form action="{{ route('bukus.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="kode_buku" class="form-label fw-semibold">Kode Buku</label>
            <input type="text" name="kode_buku" id="kode_buku" 
                   class="form-control @error('kode_buku') is-invalid @enderror"
                   value="{{ old('kode_buku') }}" placeholder="Masukkan kode buku" required>
            @error('kode_buku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" id="judul" 
                   class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label fw-semibold">Penulis</label>
            <input type="text" name="penulis" id="penulis" 
                   class="form-control @error('penulis') is-invalid @enderror"
                   value="{{ old('penulis') }}" placeholder="Masukkan nama penulis" required>
            @error('penulis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label fw-semibold">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" 
                   class="form-control @error('penerbit') is-invalid @enderror"
                   value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit" required>
            @error('penerbit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" 
                   class="form-control @error('tahun_terbit') is-invalid @enderror"
                   value="{{ old('tahun_terbit') }}" placeholder="Contoh: 2024" required>
            @error('tahun_terbit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label fw-semibold">Stok</label>
            <input type="number" name="stok" id="stok" 
                   class="form-control @error('stok') is-invalid @enderror"
                   value="{{ old('stok') }}" placeholder="Masukkan jumlah stok" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rak_id" class="form-label fw-semibold">Rak</label>
            <select name="rak_id" id="rak_id" 
                    class="form-select @error('rak_id') is-invalid @enderror" required>
                <option value="">-- Pilih Rak --</option>
                @foreach($raks as $rak)
                    <option value="{{ $rak->id }}" {{ old('rak_id') == $rak->id ? 'selected' : '' }}>
                        {{ $rak->nama }}
                    </option>
                @endforeach
            </select>
            @error('rak_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
            <select name="kategori_id" id="kategori_id" 
                    class="form-select @error('kategori_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label fw-semibold">Gambar</label>
            <input type="file" name="gambar" id="gambar" 
                   class="form-control @error('gambar') is-invalid @enderror">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
