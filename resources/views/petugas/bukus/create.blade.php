@extends('layouts.backend')

@section('title', 'Petugas Perpus - Tambah Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Tambah Buku
        </div>

        <div class="card-body">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('petugas.bukus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                {{-- RAK --}}
                <div class="mb-3">
                    <label>Rak</label>
                    <select name="rak_id" class="form-control" required>
                        <option value="">-- Pilih Rak --</option>
                        @foreach($raks as $rak)
                            <option value="{{ $rak->id }}">{{ $rak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('petugas.bukus.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>
@endsection