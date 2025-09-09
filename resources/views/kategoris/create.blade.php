@extends('layouts.backend')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-3">Tambah Kategori</h2>
    <hr class="mb-4">

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('kategoris.store') }}" method="POST" class="p-3 border rounded bg-light shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori</label>
            <input type="text" 
                   name="nama_kategori" 
                   id="nama_kategori" 
                   class="form-control @error('nama_kategori') is-invalid @enderror"
                   value="{{ old('nama_kategori') }}" 
                   placeholder="Masukkan nama kategori" required>
            @error('nama_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
