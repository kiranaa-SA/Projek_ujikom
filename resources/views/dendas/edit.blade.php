@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Edit Denda</h1>
    <a href="{{ route('dendas.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('dendas.update', $denda->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Peminjaman</label>
            <select name="pengembalian_id" class="form-control" required>
                <option value="">-- Pilih Peminjaman --</option>
                @foreach($pengembalians as $p)
                    <option value="{{ $p->id }}" {{ $denda->pengembalian_id == $p->id ? 'selected' : '' }}>
                        {{ $p->peminjaman->user->name ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kondisi Buku</label>
            <select name="kondisi_buku" class="form-control" required>
                @foreach($kondisiList as $k)
                    <option value="{{ $k }}" {{ $denda->kondisi_buku == $k ? 'selected' : '' }}>
                        {{ ucfirst($k) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                @foreach($statusList as $s)
                    <option value="{{ $s }}" {{ $denda->status == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Denda</label>
            <input type="text" class="form-control" value="Rp {{ number_format($denda->pengembalian->denda ?? 0,0,',','.') }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
