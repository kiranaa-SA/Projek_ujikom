@extends('layouts.backend')

@section('title', 'Petugas Perpus - Detail Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center"
             style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Detail Pengembalian</h3>
            <a href="{{ route('petugas.pengembalians.index') }}"
               class="btn btn-sm"
               style="background-color: #1d37df; color: white;">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead style="background-color: #e3f2fd;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tenggat</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi</th>
                            <th>Terlambat</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>

                            <td class="fw-semibold text-primary">
                                {{ $pengembalian->kode_pengembalian ?? '-' }}
                            </td>

                            <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $pengembalian->peminjaman->buku->judul ?? '-' }}</td>

                            <td>
                                {{ $pengembalian->peminjaman->tanggal_pinjam
                                    ? \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $pengembalian->peminjaman->tenggat_tempo
                                    ? \Carbon\Carbon::parse($pengembalian->peminjaman->tenggat_tempo)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $pengembalian->tanggal_pengembalian
                                    ? \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y')
                                    : '-' }}
                            </td>

                            {{-- Kondisi --}}
                            <td>
                                @switch($pengembalian->kondisi)
                                    @case('baik')
                                        <span class="badge bg-primary">Baik</span>
                                        @break
                                    @case('rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                        @break
                                    @case('hilang')
                                        <span class="badge bg-dark">Hilang</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">-</span>
                                @endswitch
                            </td>

                            {{-- Terlambat Aman --}}
                            <td>
                                @php
                                    $terlambat = max($pengembalian->terlambat ?? 0, 0);
                                @endphp
                                {{ $terlambat }} Hari
                            </td>

                            {{-- Denda Aman --}}
                            <td>
                                @php
                                    $denda = max($pengembalian->denda ?? 0, 0);
                                @endphp

                                <span class="fw-semibold {{ $denda > 0 ? 'text-danger' : 'text-success' }}">
                                    Rp {{ number_format($denda, 0, ',', '.') }}
                                </span>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection