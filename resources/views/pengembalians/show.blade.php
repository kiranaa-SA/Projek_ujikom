@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Pengembalian</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <td>{{ $pengembalian->id }}</td>
                </tr>
                <tr>
                    <th>Peminjaman</th>
                    <td>
                        {{ $pengembalian->peminjaman->id ?? '-' }} - 
                        {{ $pengembalian->peminjaman->buku->judul ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengembalian</th>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                </tr>
                <tr>
                    <th>Terlambat (hari)</th>
                    <td>{{ $pengembalian->terlambat }}</td>
                </tr>
                <tr>
                    <th>Kondisi Buku</th>
                    <td>{{ ucfirst($pengembalian->kondisi) }}</td>
                </tr>
                <tr>
                    <th>Denda</th>
                    <td>
                        @if($pengembalian->denda > 0)
                            <span class="text-danger fw-bold">
                                Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pengembalians.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('pengembalians.edit', $pengembalian->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
