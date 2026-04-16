<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Riwayat Peminjaman - E-Perpus</title>

    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
</head>

<body>

@include('layouts.component-frontend.navbar')

<main style="margin-top: 100px">
<section class="py-4">
<div class="container">

    <div class="text-center mb-4">
        <h2>Riwayat Peminjaman Buku</h2>
        <p>Lihat status dan informasi peminjaman kamu</p>
    </div>

    @if($riwayat->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada riwayat peminjaman.
        </div>
    @else

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                    <th>Tenggat</th>
                    <th>Status</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>
            @foreach($riwayat as $i => $p)
            <tr>

                <td>{{ $i + 1 }}</td>
                <td>{{ $p->buku->judul ?? '-' }}</td>

                <td>
                    {{ $p->tanggal_pinjam 
                        ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') 
                        : '-' }}
                </td>

                <td>
                    {{ $p->tenggat_tempo 
                        ? \Carbon\Carbon::parse($p->tenggat_tempo)->format('d M Y') 
                        : '-' }}
                </td>

                {{-- STATUS --}}
                <td>
                    @if($p->status == 'pending')
                        <span class="badge bg-secondary">Mengajukan</span>

                    @elseif($p->status == 'dipinjam')
                        <span class="badge bg-success">Dipinjam</span>

                    @elseif($p->status == 'dikembalikan')
                        <span class="badge bg-primary">Selesai</span>

                    @elseif($p->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>

                    @else
                        <span class="badge bg-dark">Unknown</span>
                    @endif
                </td>

                {{-- 🔥 INFO TAMBAHAN + FITUR PERPANJANG --}}
                <td>

                    {{-- PENDING --}}
                    @if($p->status == 'pending')
                        <span class="badge bg-warning text-dark">
                            Menunggu ACC Admin
                        </span>

                    {{-- DIPINJAM --}}
                    @elseif($p->status == 'dipinjam')

                        {{-- STATUS REQUEST --}}
                        @if($p->status_perpanjang == 'menunggu')
                            <span class="badge bg-info">Menunggu ACC Perpanjang</span>

                        @elseif($p->status_perpanjang == 'ditolak')
                            <span class="badge bg-danger">Perpanjang Ditolak</span>

                        @endif

                        {{-- JUMLAH PERPANJANG --}}
                        @if(($p->jumlah_perpanjang ?? 0) > 0)
                            <div class="mt-1">
                                <span class="badge bg-primary">
                                    Sudah diperpanjang {{ $p->jumlah_perpanjang }}x
                                </span>
                            </div>
                        @endif

                        {{-- TOMBOL AJUKAN --}}
                        @if(
                            ($p->jumlah_perpanjang ?? 0) < 2 &&
                            now()->lt($p->tenggat_tempo) &&
                            $p->status_perpanjang != 'menunggu'
                        )
                            <form action="{{ route('peminjaman.requestPerpanjang', $p->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button class="btn btn-warning btn-sm">
                                    Ajukan Perpanjangan
                                </button>
                            </form>
                        @else
                            <div class="mt-1">
                                <span class="badge bg-secondary">
                                    Tidak bisa diperpanjang
                                </span>
                            </div>
                        @endif

                    {{-- SELESAI --}}
                    @elseif($p->status == 'dikembalikan')
                        <span class="badge bg-secondary">
                            Sudah selesai
                        </span>

                    {{-- DITOLAK --}}
                    @elseif($p->status == 'ditolak')
                        <span class="badge bg-danger">
                            Peminjaman ditolak
                        </span>
                    @endif

                </td>

            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    @endif

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

</div>
</section>
</main>

@include('layouts.component-frontend.footer')

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>