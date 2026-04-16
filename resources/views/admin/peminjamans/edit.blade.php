@extends('layouts.backend')

@section('title', 'Admin Perpus - Edit Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3>Edit Peminjaman</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.peminjamans.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Kode</label>
                    <input type="text" class="form-control"
                        value="{{ $peminjaman->kode_peminjaman }}" readonly>
                </div>

                <div class="mb-3">
                    <label>User</label>
                    <select name="user_id" class="form-select">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Buku</label>
                    <select name="buku_id" class="form-select">
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}"
                                {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>
                                {{ $buku->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam"
                        value="{{ $peminjaman->tanggal_pinjam }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tenggat Tempo</label>
                    <input type="date" name="tenggat_tempo"
                        value="{{ $peminjaman->tenggat_tempo }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $peminjaman->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>

                {{-- 🔥 INFO PERPANJANG --}}
                <div class="mb-3">
                    <label>Jumlah Perpanjang</label>
                    <input type="text" class="form-control"
                        value="{{ $peminjaman->jumlah_perpanjang }}x" readonly>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.peminjamans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>

    </div>
</div>
@endsection