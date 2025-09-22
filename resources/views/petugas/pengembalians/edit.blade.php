@extends('layouts.backend')

@section('title', 'Petugas Perpus - Edit Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
         <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Edit Pengembalian</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ups!</strong> Ada beberapa masalah dengan inputan kamu.
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('petugas.pengembalians.update', $pengembalian->id) }}" method="POST" class="p-3 border rounded bg-light shadow-sm">
                @csrf
                @method('PUT')

                {{-- Pilih Peminjaman --}}
                <div class="mb-3">
                    <label for="peminjaman_id" class="form-label fw-semibold">Peminjaman</label>
                    <select name="peminjaman_id" id="peminjaman_id" 
                            class="form-select @error('peminjaman_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach($peminjamans as $p)
                            <option value="{{ $p->id }}" {{ old('peminjaman_id', $pengembalian->peminjaman_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->user->name ?? '-' }} - {{ $p->buku->judul ?? '-' }}
                                (Pinjam: {{ $p->tanggal_pinjam }}, Tempo: {{ $p->tenggat_tempo }})
                            </option>
                        @endforeach
                    </select>
                    @error('peminjaman_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label fw-semibold">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" 
                           class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                           value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian) }}" required>
                    @error('tanggal_pengembalian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kondisi Buku --}}
                <div class="mb-3">
                    <label for="kondisi" class="form-label fw-semibold">Kondisi Buku</label>
                    <select name="kondisi" id="kondisi" 
                            class="form-select @error('kondisi') is-invalid @enderror" required>
                        <option value="baik" {{ old('kondisi', $pengembalian->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ old('kondisi', $pengembalian->kondisi) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ old('kondisi', $pengembalian->kondisi) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('petugas.pengembalians.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
