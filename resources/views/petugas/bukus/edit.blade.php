@extends('layouts.backend')

@section('title', 'Edit Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- HEADER --}}
        <div class="card-header" style="background-color:#457de4;">
            <h3 class="mb-0 text-white">Edit Buku</h3>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            <form action="{{ route('petugas.bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- KODE --}}
                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control"
                        value="{{ old('kode_buku', $buku->kode_buku) }}" required>
                </div>

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control"
                        value="{{ old('judul', $buku->judul) }}" required>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                </div>

                {{-- PENULIS --}}
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control"
                        value="{{ old('penulis', $buku->penulis) }}" required>
                </div>

                {{-- PENERBIT --}}
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control"
                        value="{{ old('penerbit', $buku->penerbit) }}" required>
                </div>

                {{-- TAHUN --}}
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control"
                        value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
                </div>

                {{-- STOK --}}
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control"
                        value="{{ old('stok', $buku->stok) }}" required>
                </div>

                {{-- RAK --}}
                <div class="mb-3">
                    <label class="form-label">Rak</label>
                    <select name="rak_id" class="form-control" required>
                        <option value="">-- Pilih Rak --</option>
                        @foreach($raks as $rak)
                            <option value="{{ $rak->id }}"
                                {{ old('rak_id', $buku->rak_id) == $rak->id ? 'selected' : '' }}>
                                {{ $rak->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- GAMBAR --}}
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control">

                    @if($buku->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $buku->gambar) }}" width="100">
                        </div>
                    @endif
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('petugas.bukus.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>
    </div>
</div>
@endsection