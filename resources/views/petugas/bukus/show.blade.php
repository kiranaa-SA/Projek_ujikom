@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail Buku</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">Kode Buku</th>
                            <td>{{ $buku->kode_buku }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $buku->judul }}</td>
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
                        <tr>
                            <th>Gambar</th>
                            <td>
                                @if($buku->gambar)
                                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="Gambar Buku" width="150" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('petugas.bukus.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
