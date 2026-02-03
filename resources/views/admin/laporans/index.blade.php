@extends('layouts.backend')

@section('title', 'Laporan Peminjaman & Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Card header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Laporan Peminjaman & Pengembalian</h3>
            <a href="{{ route('admin.laporans.exportPdf') }}" class="btn" 
            style="background-color: #26559b; color: white; border: none;">Export PDF</a>
        </div>

        {{-- Card body --}}
        <div class="card-body">
            {{-- Filter --}}
            <form method="GET" action="{{ route('admin.laporans.index') }}" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-4">
                    <select name="kondisi" class="form-select">
                        <option value="">-- Semua Kondisi --</option>
                        <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ request('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ request('kondisi') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.laporans.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tenggat Tempo</th>
                            <th>Tanggal Kembali</th>
                            <th>Judul Buku</th>
                            <th>Kondisi Buku</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->tanggal_pinjam }}</td>
                                <td>{{ $laporan->tenggat_tempo }}</td>
                                <td>{{ $laporan->pengembalian->tanggal_pengembalian ?? '-' }}</td>
                                <td>{{ $laporan->buku->judul ?? '-' }}</td>
                                <td>{{ $laporan->pengembalian->kondisi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Belum ada data laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
