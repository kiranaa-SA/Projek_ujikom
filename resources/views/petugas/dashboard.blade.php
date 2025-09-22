@extends('layouts.backend')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Halo, {{ auth()->user()->name }}!</h2>

    {{-- Statistik kartu --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white p-3 shadow-sm">
                <h5>Total Buku</h5>
                <h2>{{ $totalBuku }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark p-3 shadow-sm">
                <h5>Peminjaman Aktif</h5>
                <h2>{{ $totalPeminjaman }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white p-3 shadow-sm">
                <h5>Pengembalian</h5>
                <h2>{{ $totalPengembalian }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white p-3 shadow-sm">
                <h5>Denda Belum Lunas</h5>
                <h2>{{ $totalDenda }}</h2>
            </div>
        </div>
    </div>

    {{-- Diagram batang per minggu --}}
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header">Statistik Per Minggu (6 Minggu Terakhir)</div>
                <div class="card-body">
                    <canvas id="weeklyBarChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($labels);
const dataPeminjaman = @json($jumlahPeminjaman);
const dataPengembalian = @json($jumlahPengembalian);
const dataDenda = @json($jumlahDenda);

new Chart(document.getElementById('weeklyBarChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Peminjaman',
                data: dataPeminjaman,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            },
            {
                label: 'Pengembalian',
                data: dataPengembalian,
                backgroundColor: 'rgba(75, 192, 192, 0.7)'
            },
            {
                label: 'Denda',
                data: dataDenda,
                backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, stepSize: 1 },
            x: { stacked: false }
        }
    }
});
</script>
@endsection
