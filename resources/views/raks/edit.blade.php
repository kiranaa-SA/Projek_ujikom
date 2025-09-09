@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Rak</h4>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('raks.update', $rak->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Rak</label>
                    <input type="text" name="kode" class="form-control" value="{{ old('kode', $rak->kode) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Rak</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $rak->nama) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $rak->lokasi) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
