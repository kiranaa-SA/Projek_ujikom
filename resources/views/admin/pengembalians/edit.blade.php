@extends('layouts.backend')

@section('title', 'Edit Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Edit Pengembalian</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengembalians.update', $pengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Peminjaman --}}
                <div class="mb-3">
                    <label class="form-label">Peminjaman</label>
                    <input type="text" class="form-control" 
                           value="{{ $pengembalian->peminjaman->user->name ?? '-' }} - {{ $pengembalian->peminjaman->buku->judul ?? '-' }}" readonly>
                </div>

                {{-- Kode Pengembalian --}}
                <div class="mb-3">
                    <label class="form-label">Kode Pengembalian</label>
                    <input type="text" class="form-control" 
                           value="{{ $pengembalian->kode_pengembalian ?? '-' }}" readonly>
                </div>

                {{-- Informasi Peminjaman --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control" 
                           value="{{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tenggat Waktu</label>
                    <input type="date" class="form-control" 
                           value="{{ $pengembalian->peminjaman->tenggat_tempo ?? '-' }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Buku</label>
                    <input type="text" class="form-control" 
                           value="{{ ucfirst($pengembalian->peminjaman->status ?? '-') }}" readonly>
                </div>

                {{-- Kondisi Buku --}}
                <div class="mb-3">
                    <label class="form-label">Kondisi Buku</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="baik" {{ $pengembalian->kondisi=='baik'?'selected':'' }}>Baik</option>
                        <option value="rusak" {{ $pengembalian->kondisi=='rusak'?'selected':'' }}>Rusak</option>
                        <option value="hilang" {{ $pengembalian->kondisi=='hilang'?'selected':'' }}>Hilang</option>
                    </select>
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" class="form-control" 
                           value="{{ $pengembalian->tanggal_pengembalian ?? date('Y-m-d') }}" required>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pengembalians.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
