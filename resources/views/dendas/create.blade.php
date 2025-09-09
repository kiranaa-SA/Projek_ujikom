@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Denda</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dendas.store') }}" method="POST">
                @csrf

                {{-- Peminjaman --}}
                <div class="mb-3">
                    <label class="form-label">Peminjaman</label>
                    <select name="pengembalian_id" class="form-control" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($pengembalians as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->peminjaman->user->name ?? '-' }}
                                - {{ $p->peminjaman->buku->judul ?? '-' }}
                                (Kembali: {{ $p->tanggal_pengembalian }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kondisi Buku --}}
                <div class="mb-3">
                    <label class="form-label">Kondisi Buku</label>
                    <select name="kondisi_buku" class="form-control" required>
                        @foreach($kondisiList as $k)
                            <option value="{{ $k }}">{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        @foreach($statusList as $s)
                            <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dendas.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
