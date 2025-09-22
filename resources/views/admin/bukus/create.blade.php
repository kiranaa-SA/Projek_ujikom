@extends('layouts.backend')

@section('title', 'Tambah Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bukus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="kode_buku" class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku') }}" required>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
                </div>
                <div class="mb-3">
                    <label for="rak_id" class="form-label">Rak</label>
                    <select name="rak_id" class="form-select" required>
                        <option value="">-- Pilih Rak --</option>
                        @foreach($raks as $rak)
                        <option value="{{ $rak->id }}" {{ old('rak_id') == $rak->id ? 'selected' : '' }}>{{ $rak->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.bukus.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
