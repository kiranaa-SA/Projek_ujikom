@extends('layouts.backend')

@section('title', 'Petugas Perpus - Tambah Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Tambah Denda</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.dendas.store') }}" method="POST">
                @csrf

                {{-- Pilih Pengembalian --}}
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam & Buku</label>
                    <select name="pengembalian_id" class="form-select" required>
                        <option value="">-- Pilih Pengembalian --</option>
                        @foreach($pengembalians as $pengembalian)
                            <option value="{{ $pengembalian->id }}">
                                {{ $pengembalian->peminjaman->user->name ?? '-' }}
                                | {{ $pengembalian->peminjaman->buku->judul ?? '-' }}
                                | Denda: Rp {{ number_format($pengembalian->denda ?? 0,0,',','.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status Denda</label>
                    <select name="status" class="form-select" required>
                        <option value="belum_dibayar">Belum Lunas</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>

                <button class="btn" style="background-color:#1d37df;color:white">
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