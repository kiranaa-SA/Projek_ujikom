@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Daftar Denda</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('dendas.create') }}" class="btn btn-primary mb-3">Tambah Denda</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Jumlah</th>
                    <th>Kondisi Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dendas as $denda)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $denda->pengembalian->peminjaman->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}</td>
                        <td>{{ ucfirst($denda->kondisi_buku) }}</td>
                        <td>
                            @if($denda->status == 'belum_dibayar')
                                <span class="badge bg-warning text-dark">Belum Lunas</span>
                            @else
                                <span class="badge bg-success">Lunas</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                        <a href="{{ route('dendas.show', $denda->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('dendas.edit', $denda->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('dendas.destroy', $denda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mb-1" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data denda</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
