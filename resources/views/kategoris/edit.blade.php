@extends('layouts.backend')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" 
                   class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
