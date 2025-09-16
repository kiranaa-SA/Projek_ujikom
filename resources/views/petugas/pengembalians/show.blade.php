@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail Pengembalian</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">ID</th>
                            <td>{{ $pengembalian->id }}</td>
                        </tr>
                        <tr>
                            <th>Peminjam</th>
                            <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Buku</th>
                            <td>{{ $pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td>{{ $pengembalian->peminjaman->tanggal_pinjam }}</td>
                        </tr>
                        <tr>
                            <th>Tenggat Tempo</th>
                            <td>{{ $pengembalian->peminjaman->tenggat_tempo }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengembalian</th>
                            <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                        </tr>
                        <tr>
                            <th>Kondisi Buku</th>
                            <td>{{ ucfirst($pengembalian->kondisi) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('petugas.pengembalians.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
