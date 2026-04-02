@extends('layouts.backend')

@section('title', 'Petugas Perpus - Tambah Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Buku</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.bukus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kode Buku</label>
                        <input type="text" name="kode_buku" class="form-control"
                               value="{{ old('kode_buku') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" name="judul" class="form-control"
                               value="{{ old('judul') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Penulis</label>
                        <input type="text" name="penulis" class="form-control"
                               value="{{ old('penulis') }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control"
                               value="{{ old('penerbit') }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control"
                               value="{{ old('tahun_terbit') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stok" class="form-control"
                               value="{{ old('stok') }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Rak</label>
                        <select name="rak_id" class="form-select select-search" required>
                            <option value="">-- Pilih Rak --</option>
                            @foreach($raks as $rak)
                                <option value="{{ $rak->id }}"
                                    {{ old('rak_id') == $rak->id ? 'selected' : '' }}>
                                    {{ $rak->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori_id" class="form-select select-search" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Gambar Buku (Opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('petugas.bukus.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= SELECT2 ================= --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select-search').select2({
            placeholder: "Pilih data",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection