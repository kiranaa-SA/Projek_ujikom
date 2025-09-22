@extends('layouts.backend')

@section('title', 'Petugas Perpus - Tambah Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Card header --}}
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Denda</h3>
        </div>

        {{-- Card body --}}
        <div class="card-body">
            <form action="{{ route('petugas.dendas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="peminjaman_id" class="form-label">Nama Peminjam</label>
                    <select name="peminjaman_id" id="peminjaman_id" class="form-select @error('peminjaman_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach($peminjamans as $peminjaman)
                            <option value="{{ $peminjaman->id }}" {{ old('peminjaman_id') == $peminjaman->id ? 'selected' : '' }}>
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
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik" {{ old('kondisi_buku')=='baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ old('kondisi_buku')=='rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    @error('kondisi_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="belum_dibayar" {{ old('status')=='belum_dibayar' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ old('status')=='lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn" style="background-color: #1d37df; color: white;">Simpan</button>
                <a href="{{ route('petugas.dendas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
