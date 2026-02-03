@extends('layouts.backend')

@section('title', 'Admin Perpus - Hero Banner')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #457de4;">
            <h3 class="mb-0 text-white">Daftar Hero Banner</h3>
            <a href="{{ route('admin.hero-banners.create') }}" 
               class="btn" 
               style="background-color: #26559b; color: white; border: none;">
               Tambah Banner
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead style="background-color: #e3f2fd; color: #212529;">
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:20%;">Judul Utama</th>
                            <th style="width:20%;">Judul</th>
                            <th style="width:25%;">Deskripsi</th>
                            <th style="width:15%;">Gambar</th>
                            <th style="width:15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $banner->judul_utama }}</td>
                            <td>{{ $banner->judul }}</td>
                            <td style="max-width:250px; overflow:hidden; text-overflow:ellipsis;">{{ $banner->deskripsi }}</td>
                            <td>
                                @if($banner->gambar)
                                <img src="{{ asset('storage/' . $banner->gambar) }}" alt="Gambar Banner" style="width:100px; height:auto;">
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.hero-banners.edit', $banner->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.hero-banners.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-sm mb-1" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data banner</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
