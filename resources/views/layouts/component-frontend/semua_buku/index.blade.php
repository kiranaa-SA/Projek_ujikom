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
        body { font-family: 'Poppins', sans-serif; }
        #main { margin-top: 100px; }

        /* Filter */
        .filter-col {
            border-right: 1px solid #e5e7eb;
            padding-right: 30px;
        }
        .filter-col .list-group-item {
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: 0.25s;
        }
        .filter-col .list-group-item:hover,
        .filter-col .list-group-item.active {
            background: #1a2a6c;
            color: #fff;
            transform: translateX(6px);
        }

        /* Card Buku */
        .book-card {
            border-radius: 18px;
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
        }
        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .book-card img {
            height: 260px;
            object-fit: cover;
        }
        .book-card .card-body {
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
        }
        .book-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .book-card .card-text {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 14px;
        }

        /* Button */
        .btn-detail {
            background: #1a2a6c;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
        }
        .btn-cart {
            width: 42px;
            height: 38px;
            border-radius: 10px;
            background: #ffc107;
            border: none;
        }
        .btn-cart:hover {
            background: #e0aa06;
        }
    </style>
</head>

<body>

@include('layouts.component-frontend.navbar')

<main id="main">
    <section class="py-4">
        <div class="container-fluid px-5">
            <h2 class="fw-bold mb-4 text-center">📚 Semua Buku</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                <!-- Filter -->
                <div class="col-md-3 filter-col">
                    <h5 class="fw-semibold mb-3">Filter Kategori</h5>
                    <ul class="list-group">
                        <a href="{{ route('semua_buku.index') }}"
                           class="list-group-item {{ empty($kategori_id) ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach($kategoris as $kategori)
                            <a href="{{ route('semua_buku.index',['kategori'=>$kategori->id]) }}"
                               class="list-group-item {{ ($kategori_id ?? '') == $kategori->id ? 'active' : '' }}">
                                {{ $kategori->nama_kategori }}
                            </a>
                        @endforeach
                    </ul>
                </div>

                <!-- List Buku -->
                <div class="col-md-9 ps-4">
                    <div class="row g-4">
                        @forelse($bukus as $buku)
                            <div class="col-md-3">
                                <div class="card book-card border-0 shadow-sm">
                                    <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://via.placeholder.com/300x400?text=No+Image' }}">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $buku->judul }}</h5>
                                        <p class="card-text">{{ Str::limit($buku->deskripsi, 80) }}</p>

                                        <div class="mt-auto d-flex gap-2">
                                            <a href="{{ route('buku.detail',$buku->id) }}"
                                               class="btn btn-detail text-white flex-fill">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>

                                            @auth
                                            <form action="{{ route('keranjang.store',$buku->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-cart">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Belum ada buku tersedia.</p>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $bukus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('layouts.component-frontend.footer')

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></cript>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script>AOS.init();</script>

</body>
</html>
