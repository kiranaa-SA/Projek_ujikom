@extends('layouts.backend')

@section('title', 'Admin Perpus - Detail Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail Pengembalian</h3>
            <a href="{{ route('admin.pengembalians.index') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Kembali
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi Buku</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                            <td>{{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}</td>
                            <td>{{ $pengembalian->tanggal_pengembalian ?? '-' }}</td>
                            <td>
                                @if($pengembalian->kondisi == 'baik')
                                    <span class="badge bg-success">Baik</span>
                                @elseif($pengembalian->kondisi == 'rusak')
                                    <span class="badge bg-warning text-dark">Rusak</span>
                                @else
                                    <span class="badge bg-danger">Hilang</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
