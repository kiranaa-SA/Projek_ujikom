@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail Denda</h3>
            <a href="{{ route('petugas.dendas.index') }}" class="btn" style="background-color: #1d37df; color: white; border: none;">
                Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Jumlah Denda</th>
                            <th>Kondisi Buku</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $denda->pengembalian->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $denda->pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                            <td>Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}</td>
                            <td>{{ ucfirst($denda->pengembalian->kondisi ?? '-') }}</td>
                            <td>
                                @if($denda->status == 'belum_dibayar')
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @else
                                    <span class="badge bg-success">Lunas</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection