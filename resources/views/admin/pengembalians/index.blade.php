@extends('layouts.backend')

@section('title', 'Admin Perpus - Pengembalian')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Pengembalian</h3>
            <a href="{{ route('admin.pengembalians.create') }}"
               class="btn"
               style="background-color: #26559b; color: white; border: none;">
               Tambah Data
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="fw-semibold text-primary">
                                {{ $p->kode_pengembalian ?? '-' }}
                            </td>

                            <td>{{ $p->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $p->peminjaman->buku->judul ?? '-' }}</td>

                            <td>
                                @switch($p->peminjaman->status ?? '-')
                                    @case('dipinjam')
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @break
                                    @case('dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">-</span>
                                @endswitch
                            </td>

                            <td>
                                @switch($p->kondisi)
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

                            {{-- 🔥 Denda Aman --}}
                            <td>
                                @php
                                    $denda = max($p->denda ?? 0, 0);
                                @endphp

                                <span class="fw-semibold {{ $denda > 0 ? 'text-danger' : 'text-success' }}">
                                    Rp {{ number_format($denda, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.pengembalians.show', $p->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.pengembalians.edit', $p->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.pengembalians.destroy', $p->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-4">
                                Belum ada data pengembalian
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection