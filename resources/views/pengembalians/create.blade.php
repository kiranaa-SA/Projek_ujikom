@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="text-2xl font-semibold mb-6">Tambah Pengembalian</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <form action="{{ route('pengembalians.store') }}" method="POST">
                @csrf

                {{-- Pilih Peminjaman --}}
                <div class="mb-3">
                    <label for="peminjaman_id" class="form-label">Peminjaman</label>
                    <select name="peminjaman_id" id="peminjaman_id" class="form-control" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach($peminjamans as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->user->name ?? '-' }} - {{ $p->buku->judul ?? '-' }}
                                (Pinjam: {{ $p->tanggal_pinjam }}, Tempo: {{ $p->tenggat_tempo }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Pengembalian --}}
                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required>
                </div>

                {{-- Kondisi Buku --}}
                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi Buku</label>
                    <select name="kondisi" id="kondisi" class="form-control" required>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pengembalians.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
