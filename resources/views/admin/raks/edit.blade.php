@extends('layouts.backend')

@section('title', 'Admin Perpus - Edit Rak')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">edit Rak</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            {{-- Error Alert --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.raks.update', $rak->id) }}" method="POST" class="p-3 border rounded bg-light shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode" class="form-label fw-semibold">Kode Rak</label>
                    <input type="text" name="kode" id="kode" 
                           class="form-control @error('kode') is-invalid @enderror" 
                           value="{{ old('kode', $rak->kode) }}" placeholder="Masukkan kode rak" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Rak</label>
                    <input type="text" name="nama" id="nama" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $rak->nama) }}" placeholder="Masukkan nama rak" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" 
                           class="form-control @error('lokasi') is-invalid @enderror" 
                           value="{{ old('lokasi', $rak->lokasi) }}" placeholder="Masukkan lokasi rak" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('admin.raks.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
