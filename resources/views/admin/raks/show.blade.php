@extends('layouts.backend')

@section('title', 'Admin Perpus - Detail Rak')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header --}}
        <div class="card-header" style="background-color: #457de4; color: white;">
            <h3 class="mb-0">Detail Rak</h3>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">No</th>
                            <td>{{ $rak->id }}</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>{{ $rak->kode }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $rak->nama }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $rak->lokasi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.raks.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
