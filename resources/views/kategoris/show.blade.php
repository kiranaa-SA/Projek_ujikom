@extends('layouts.backend')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Kategori</h1>

    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <form>
                <fieldset disabled>
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" value="{{ $kategori->id }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" value="{{ $kategori->nama_kategori }}">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-start">
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
