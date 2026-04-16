<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Buku - E-Perpus</title>

    <!-- Favicons -->
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">

<style>
#main { margin-top: 100px; }

.fav-card {
    border-radius: 16px;
    transition: 0.25s;
    overflow: hidden;
}

.fav-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.fav-img {
    width: 80px;
    height: 110px;
    object-fit: cover;
    border-radius: 10px;
}

.fav-title {
    font-weight: 600;
    color: #142850;
}

.fav-author {
    font-size: 13px;
    color: #6c757d;
}

.btn-love {
    width: 38px;
    height: 38px;
    border-radius: 50%;
}

.badge-fav {
    background: #ffe5e5;
    color: #dc3545;
    font-size: 11px;
}
</style>
</head>

<body>

@include('layouts.component-frontend.navbar')

<main id="main">
<section class="py-5">
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">❤️ Buku Favorit</h4>
    <span class="badge badge-fav px-3 py-2">
        {{ $favorites->count() }} Buku
    </span>
</div>

@if($favorites->isEmpty())
    <div class="text-center mt-5">
        <i class="bi bi-heart" style="font-size:60px; color:#ccc;"></i>
        <p class="mt-3 text-muted">Belum ada buku favorit</p>
    </div>
@else

@foreach($favorites as $fav)
@php $buku = $fav->buku; @endphp

<div class="fav-card card mb-3 border-0 shadow-sm">
<div class="card-body d-flex align-items-center gap-3">

    {{-- GAMBAR --}}
    <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://via.placeholder.com/100x150' }}"
         class="fav-img">

    {{-- INFO --}}
    <div class="flex-grow-1">
        <div class="fav-title">{{ $buku->judul }}</div>
        <div class="fav-author">{{ $buku->penulis }}</div>

        <div class="mt-2">
            <a href="{{ route('buku.detail', $buku->id) }}"
               class="btn btn-sm btn-outline-primary">
               Lihat Detail
            </a>
        </div>
    </div>

    {{-- ACTION --}}
    <div class="d-flex flex-column gap-2 align-items-center">

        {{-- HAPUS --}}
        <form action="{{ route('favorite.toggle', $buku->id) }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-love">
                <i class="bi bi-heart-fill"></i>
            </button>
        </form>

    </div>

</div>
</div>

@endforeach

@endif

</div>
</section>
</main>

@include('layouts.component-frontend.footer')

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>