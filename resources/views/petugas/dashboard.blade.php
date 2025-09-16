@extends('layouts.backend')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Halo, {{ auth()->user()->name }}!</h2>

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white p-3">
                <h5>Total Buku</h5>
                <h2>{{ $totalBuku }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark p-3">
                <h5>Peminjaman Aktif</h5>
                <h2>{{ $totalPeminjaman }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white p-3">
                <h5>Pengembalian Hari Ini</h5>
                <h2>{{ $totalPengembalian }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white p-3">
                <h5>Denda Belum Lunas</h5>
                <h2>{{ $totalDenda }}</h2>
            </div>
        </div>
    </div>

    {{-- Shortcut Modul --}}
   
</div>
@endsection
