@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Buku</h4>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku', $buku->kode_buku) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Rak</label>
                    <select name="rak_id" class="form-select">
                        @foreach($raks as $rak)
                        <option value="{{ $rak->id }}" {{ old('rak_id', $buku->rak_id)==$rak->id ? 'selected' : '' }}>
                            {{ $rak->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select">
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $buku->kategori_id)==$kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Buku</label>
                    <input type="file" name="gambar" class="form-control">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/'.$buku->gambar) }}" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
