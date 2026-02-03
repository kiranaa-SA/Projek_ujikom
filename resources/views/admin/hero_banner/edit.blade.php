@extends('layouts.backend')

@section('title', 'Edit Hero Banner')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Edit Hero Banner</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hero-banners.update', $heroBanner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul_utama" class="form-label">Judul Utama</label>
                    <input type="text" name="judul_utama" class="form-control" value="{{ old('judul_utama', $heroBanner->judul_utama) }}" required>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $heroBanner->judul) }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $heroBanner->deskripsi) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Banner (biarkan kosong jika tidak diganti)</label>
                    <input type="file" name="gambar" class="form-control">
                    @if($heroBanner->gambar)
                        <img src="{{ asset('storage/' . $heroBanner->gambar) }}" alt="Gambar Banner" class="mt-2" style="width:150px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
