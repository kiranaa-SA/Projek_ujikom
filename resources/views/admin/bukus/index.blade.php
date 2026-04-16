@extends('layouts.backend')

@section('title', 'Admin Perpus - Buku')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Buku</h3>
            <a href="{{ route('admin.bukus.create') }}" 
               class="btn" 
               style="background-color: #26559b; color: white;">
                + Tambah Data
            </a>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead style="background-color:#e3f2fd">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Rak</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($bukus as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-primary">{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>

                            {{-- RAK --}}
                            <td>
                                {{ $buku->rak->nama ?? '-' }}
                            </td>

                            {{-- KATEGORI --}}
                            <td>
                                {{ $buku->kategori->nama_kategori ?? '-' }}
                            </td>

                            {{-- GAMBAR --}}
                            <td>
                                @if($buku->gambar)
                                    <img src="{{ asset('storage/'.$buku->gambar) }}" width="60">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- ✅ AKSI (SAMA KAYAK KATEGORI) --}}
                            <td class="text-nowrap">
                                <a href="{{ route('admin.bukus.show', $buku->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.bukus.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>              </tr>
                        @empty
                        <tr>
                            <td colspan="9">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection