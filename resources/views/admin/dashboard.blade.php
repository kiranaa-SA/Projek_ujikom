@extends('layouts.backend')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Halo, {{ auth()->user()->name }}!</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white p-3">
                <h5>Total Buku</h5>
                <h2>{{ $totalBuku }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white p-3">
                <h5>Total Kategori</h5>
                <h2>{{ $totalKategori }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark p-3">
                <h5>Total Rak</h5>
                <h2>{{ $totalRak }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white p-3">
                <h5>Total User</h5>
                <h2>{{ $totalUser }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-12">
            <canvas id="peminjamanChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('peminjamanChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($bulan) !!},
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: {!! json_encode($jumlahPeminjaman) !!},
            backgroundColor: 'rgba(70, 130, 180, 0.7)',
            borderColor: 'rgba(70, 130, 180, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
