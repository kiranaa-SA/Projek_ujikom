@extends('layouts.backend')

@section('title', 'Petugas Perpus - Edit Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header" style="background-color:#457de4;">
            <h3 class="mb-0 text-white">Edit Denda</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.dendas.update', $denda->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Pengembalian --}}
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <select name="pengembalian_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach($pengembalians as $pengembalian)
                            <option value="{{ $pengembalian->id }}"
                                {{ old('pengembalian_id', $denda->pengembalian_id) == $pengembalian->id ? 'selected' : '' }}>

                                {{ optional($pengembalian->peminjaman->user)->name }}
                                | Buku:
                                {{ optional($pengembalian->peminjaman->buku)->judul }}

                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="belum_dibayar"
                            {{ old('status', $denda->status) == 'belum_dibayar' ? 'selected' : '' }}>
                            Belum Lunas
                        </option>
                        <option value="lunas"
                            {{ old('status', $denda->status) == 'lunas' ? 'selected' : '' }}>
                            Lunas
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('petugas.dendas.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection