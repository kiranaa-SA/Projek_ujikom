@extends('layouts.backend')

@section('title', 'Admin Perpus - Tambah Rak')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Rak</h3>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.raks.store') }}" method="POST" class="p-3 border rounded bg-light shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="kode" class="form-label fw-semibold">Kode Rak</label>
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" placeholder="Masukkan kode rak" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Rak</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama rak" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Masukkan lokasi rak" required>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('admin.raks.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
