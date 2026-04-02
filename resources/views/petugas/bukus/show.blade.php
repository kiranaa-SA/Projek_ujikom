@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detail Buku</h3>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- Kolom Info Buku -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Kode Buku</th>
                            <td>{{ $buku->kode_buku }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $buku->judul }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $buku->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $buku->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $buku->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $buku->stok }}</td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td>{{ $buku->rak->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $buku->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Kolom Gambar Buku -->
                <div class="col-md-4 text-center">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}" 
                             alt="Gambar Buku" 
                             class="img-fluid rounded shadow-sm mb-3">
                    @else
                        <div class="border rounded p-5 text-muted">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

            </div>

            <div class="mt-4">
                <a href="{{ route('petugas.bukus.index') }}" 
                   class="btn btn-secondary">
                   Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection