@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pengembalian</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengembalians.update', $pengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Peminjaman</label>
                    <select name="peminjaman_id" class="form-control" required>
                        @foreach($peminjamans as $p)
                            <option value="{{ $p->id }}" {{ $pengembalian->peminjaman_id == $p->id ? 'selected' : '' }}>
                                {{ $p->user->name ?? '-' }} - {{ $p->buku->judul ?? '-' }} 
                                (Pinjam: {{ $p->tanggal_pinjam }}, Tempo: {{ $p->tenggat_tempo }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" class="form-control" 
                           value="{{ $pengembalian->tanggal_pengembalian }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kondisi Buku</label>
                    <select name="kondisi" class="form-control" required>
                        <option value="baik" {{ $pengembalian->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ $pengembalian->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ $pengembalian->kondisi == 'hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Denda (Rp)</label>
                    <input type="number" name="denda" class="form-control" 
                           value="{{ $pengembalian->denda }}" min="0">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengembalians.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
