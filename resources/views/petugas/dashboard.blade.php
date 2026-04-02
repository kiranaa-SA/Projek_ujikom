@extends('layouts.backend')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Selamat Datang Petugas!</h2>

    {{-- Card Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-warning p-3 shadow-sm">
                <h6 class="text-white">Total Buku</h6>
                <h3 class="text-white fw-bold">{{ $totalBuku }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-primary p-3 shadow-sm">
                <h6 class="text-white">Peminjaman Aktif</h6>
                <h3 class="text-white fw-bold">{{ $totalPeminjamanAktif }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success p-3 shadow-sm">
                <h6 class="text-white">Total Pengembalian</h6>
                <h3 class="text-white fw-bold">{{ $totalPengembalian }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger p-3 shadow-sm">
                <h6 class="text-white">Total User</h6>
                <h3 class="text-white fw-bold">{{ $totalUser }}</h3>
            </div>
        </div>
    </div>

    {{-- Grafik Peminjaman vs Pengembalian --}}
    <div class="row g-3">
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h6 class="mb-3">📊 Peminjaman vs Pengembalian (per Minggu)</h6>
                <canvas id="weeklyBarChart"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h6 class="mb-3">📈 Perbandingan Total</h6>
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const jumlahPeminjaman = @json($jumlahPeminjaman);
    const jumlahPengembalian = @json($jumlahPengembalian);

    // Bar Chart
    new Chart(document.getElementById('weeklyBarChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Peminjaman',
                    data: jumlahPeminjaman,
                    backgroundColor: 'rgba(54,162,235,0.7)',
                    borderColor: 'rgba(54,162,235,1)',
                    borderWidth: 1
                },
                {
                    label: 'Pengembalian',
                    data: jumlahPengembalian,
                    backgroundColor: 'rgba(75,192,192,0.7)',
                    borderColor: 'rgba(75,192,192,1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Donut Chart
    new Chart(document.getElementById('donutChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Peminjaman', 'Pengembalian'],
            datasets: [{
                data: [
                    jumlahPeminjaman.reduce((a,b) => a+b, 0),
                    jumlahPengembalian.reduce((a,b) => a+b, 0)
                ],
                backgroundColor: [
                    'rgba(54,162,235,0.7)',
                    'rgba(75,192,192,0.7)'
                ],
                borderColor: ['#fff','#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection