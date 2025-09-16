@extends('layouts.backend')

@section('title', 'Admin Perpus - Edit Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Edit Denda</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dendas.update', $denda->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="peminjaman_id" class="form-label">Nama Peminjam</label>
                    <select name="peminjaman_id" id="peminjaman_id" class="form-select @error('peminjaman_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach($peminjamans as $peminjaman)
                            <option value="{{ $peminjaman->id }}" {{ $denda->peminjaman_id == $peminjaman->id ? 'selected' : '' }}>
                                {{ $peminjaman->user->name ?? '-' }} | Buku: {{ $peminjaman->buku->judul ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('peminjaman_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi_buku" class="form-label">Kondisi Buku</label>
                    <select name="kondisi_buku" id="kondisi_buku" class="form-select @error('kondisi_buku') is-invalid @enderror" required>
                        <option value="baik" {{ $denda->kondisi_buku=='baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ $denda->kondisi_buku=='rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    @error('kondisi_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="belum_dibayar" {{ $denda->status=='belum_dibayar' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas"
