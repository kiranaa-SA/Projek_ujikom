@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Buku</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light">
                            <strong>Kode Buku:</strong> {{ $buku->kode_buku }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Judul:</strong> {{ $buku->judul }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Penulis:</strong> {{ $buku->penulis }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Penerbit:</strong> {{ $buku->penerbit }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Stok:</strong> {{ $buku->stok }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Rak:</strong> {{ $buku->rak->nama }}
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Kategori:</strong> {{ $buku->kategori->nama_kategori }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <h6 class="mb-2">Gambar Buku</h6>
                    @if($buku->gambar)
                        <img src="{{ asset('storage/'.$buku->gambar) }}" 
                             class="img-fluid rounded shadow-sm border" 
                             style="max-height: 250px;">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('bukus.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
