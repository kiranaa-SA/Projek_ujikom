@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="card mb-3 bg-light shadow-sm">
        <div class="card-body">
            <form>
                <fieldset disabled>
                    <legend class="mb-3">Detail Rak</legend>

                    <div class="mb-3">
                        <label class="form-label">Kode Rak</label>
                        <input type="text" class="form-control" value="{{ $rak->kode }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Rak</label>
                        <input type="text" class="form-control" value="{{ $rak->nama }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" class="form-control" value="{{ $rak->lokasi }}">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-start">
        <a href="{{ route('raks.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
