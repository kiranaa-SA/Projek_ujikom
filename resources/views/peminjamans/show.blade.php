@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Peminjaman</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $peminjaman->id }}</p>
            <p><strong>User:</strong> {{ $peminjaman->user->name }}</p>
            <p><strong>Buku:</strong> {{ $peminjaman->buku->judul }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
            <p><strong>Tenggat Tempo:</strong> {{ $peminjaman->tenggat_tempo }}</p>
            <p><strong>Status:</strong> 
                @if($peminjaman->status == 'dipinjam')
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                    <span class="badge bg-success">Dikembalikan</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-start">
        <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
