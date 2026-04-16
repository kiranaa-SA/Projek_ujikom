@extends('layouts.backend')

@section('title', 'Admin Perpus - Peminjaman')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Peminjaman</h3>
            <a href="{{ route('admin.peminjamans.create') }}"
               class="btn"
               style="background-color: #26559b; color: white;">
               Tambah Data
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Perpanjang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="fw-semibold text-primary">
                                {{ $peminjaman->kode_peminjaman }}
                            </td>

                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($peminjaman->tenggat_tempo)->format('d M Y') }}
                            </td>

                            {{-- JUMLAH PERPANJANG --}}
                            <td>
                                <span class="badge bg-dark">
                                    {{ $peminjaman->jumlah_perpanjang ?? 0 }}x
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($peminjaman->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu ACC</span>
                                @elseif($peminjaman->status == 'dipinjam')
                                    <span class="badge bg-success">Dipinjam</span>
                                @elseif($peminjaman->status == 'dikembalikan')
                                    <span class="badge bg-primary">Dikembalikan</span>
                                @elseif($peminjaman->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    {{-- PENDING --}}
                                    @if($peminjaman->status === 'pending')

                                        <form action="{{ route('admin.peminjamans.accept', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm" title="ACC">
                                                ✔
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.peminjamans.reject', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" title="Tolak">
                                                ✖
                                            </button>
                                        </form>

                                    {{-- DIPINJAM --}}
                                    @elseif($peminjaman->status === 'dipinjam')

                                        {{-- PERPANJANG --}}
                                        @if(($peminjaman->jumlah_perpanjang ?? 0) < 2 && now()->lt($peminjaman->tenggat_tempo))
                                            <form action="{{ route('admin.peminjamans.perpanjang', $peminjaman->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-warning btn-sm" title="Perpanjang">
                                                    ⟳
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                ⟳
                                            </button>
                                        @endif

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.peminjamans.show', $peminjaman->id) }}"
                                           class="btn btn-info btn-sm">
                                            👁
                                        </a>

                                        {{-- DELETE (GANTI KEMBALIKAN) --}}
                                        <form action="{{ route('admin.peminjamans.destroy', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin mau hapus data ini?')">
                                                🗑
                                            </button>
                                        </form>

                                    {{-- LAINNYA --}}
                                    @else
                                        <a href="{{ route('admin.peminjamans.show', $peminjaman->id) }}"
                                           class="btn btn-info btn-sm">
                                            👁
                                        </a>

                                        <form action="{{ route('admin.peminjamans.destroy', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin mau hapus data ini?')">
                                                🗑
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-muted py-4">
                                Belum ada data peminjaman
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