@extends('layouts.backend')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Selamat Datang Admin!</h2>

    {{-- Card Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-warning text-white p-3 shadow-sm">
                <h6>Total Buku</h6>
                <h3>{{ $totalBuku }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white p-3 shadow-sm">
                <h6>Total Kategori</h6>
                <h3>{{ $totalKategori }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white p-3 shadow-sm">
                <h6>Total Rak</h6>
                <h3>{{ $totalRak }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white p-3 shadow-sm">
                <h6>Total User</h6>
                <h3>{{ $totalUser }}</h3>
            </div>
        </div>
    </div>

    {{-- Grafik Peminjaman vs Pengembalian (Bar Chart) + Donut --}}
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

    {{-- Bar Chart Jumlah Buku per Kategori --}}
    <div class="row g-3 mt-4">
        <div class="col-md-12">
            <div class="card p-3 shadow-sm">
                <h6 class="mb-3">📊 Jumlah Buku per Kategori</h6>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart Peminjaman vs Pengembalian
    const labels = @json($labels);
    const jumlahPeminjaman = @json($jumlahPeminjaman);
    const jumlahPengembalian = @json($jumlahPengembalian);

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
                backgroundColor: ['rgba(54,162,235,0.7)','rgba(75,192,192,0.7)'],
                borderColor: ['#fff','#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Bar Chart Jumlah Buku per Kategori
    const labelsKategori = @json($labelsKategori);
    const jumlahBukuKategori = @json($jumlahBukuKategori);

    new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labelsKategori,
            datasets: [{
                label: 'Jumlah Buku',
                data: jumlahBukuKategori,
                backgroundColor: 'rgba(255,99,132,0.7)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
