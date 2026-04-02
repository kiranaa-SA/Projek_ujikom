@extends('layouts.backend')

@section('title', 'Admin Perpus - Denda')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center"
             style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Denda</h3>
            <a href="{{ route('admin.dendas.create') }}"
               class="btn"
               style="background-color: #26559b; color: white;">
               Tambah Data
            </a>
        </div>

        {{-- Body --}}
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
                            <th>Peminjam</th>
                            <th>Kondisi Buku</th>
                            <th>Nominal Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dendas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Nama Peminjam --}}
                            <td>
                                {{ optional($d->pengembalian->peminjaman->user)->name ?? '-' }}
                            </td>

                            {{-- Kondisi Buku --}}
                            <td>
                                @php
                                    $kondisi = optional($d->pengembalian)->kondisi;
                                @endphp

                                @if($kondisi === 'baik')
                                    <span class="badge bg-primary">Baik</span>
                                @elseif($kondisi === 'rusak')
                                    <span class="badge bg-danger">Rusak</span>
                                @elseif($kondisi === 'hilang')
                                    <span class="badge bg-dark">Hilang</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>

                            {{-- Nominal dari pengembalian --}}
                            <td>
                                Rp {{ number_format(optional($d->pengembalian)->denda ?? 0, 0, ',', '.') }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($d->status === 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.dendas.show', $d->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.dendas.edit', $d->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.dendas.destroy', $d->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus data?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">
                                Belum ada data denda
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