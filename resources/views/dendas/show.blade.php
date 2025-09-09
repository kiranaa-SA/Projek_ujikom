@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Denda</h1>

    <div class="card bg-light shadow-sm">
        <div class="card-body">
            <p><strong>Nama Peminjam:</strong> {{ $denda->pengembalian->peminjaman->user->name ?? '-' }}</p>
            <p><strong>Jumlah Denda:</strong> Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}</p>
            <p><strong>Kondisi Buku:</strong> {{ ucfirst($denda->kondisi_buku) }}</p>
            <p><strong>Status:</strong> 
                @if($denda->status == 'belum_dibayar')
                    <span class="badge bg-warning text-dark">Belum Dibayar</span>
                @else
                    <span class="badge bg-success">Lunas</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-start">
        <a href="{{ route('dendas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
