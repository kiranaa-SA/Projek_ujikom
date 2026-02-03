@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Peminjaman Buku</h5>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" value="{{ $buku->judul }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name ?? 'Guest' }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control" name="tgl_pinjam" value="{{ now()->toDateString() }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" class="form-control" name="tgl_kembali">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Simpan Peminjaman
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
