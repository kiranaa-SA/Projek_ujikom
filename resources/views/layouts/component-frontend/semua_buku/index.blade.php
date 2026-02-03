<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - FlexStart Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ 'frontend/assets/img/favicon.png' }}" rel="icon">
    <link href="{{ 'frontend/assets/img/apple-touch-icon.png' }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            overflow-y: auto;
        }
        #main {
            margin-top: 100px;
            min-height: 100vh;
        }

        /* Filter kategori modern */
        .filter-col {
            border-right: 1px solid #dee2e6;
            padding-right: 30px;
        }
        .filter-col .list-group-item {
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }
        .filter-col .list-group-item:hover {
            background-color: #1a2a6c;
            color: #fff;
            transform: translateX(5px);
        }
        .filter-col .list-group-item.active {
            background-color: #1a2a6c;
            color: #fff;
        }

        /* Card buku vertikal modern seragam */
        .book-card {
            display: flex;
            flex-direction: column;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 450px; /* tinggi card tetap */
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .book-card img {
            width: 100%;
            height: 250px; /* tinggi gambar tetap */
            object-fit: cover;
        }
        .book-card .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }
        .book-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .book-card .card-text {
            font-size: 0.875rem;
            color: #6c757d;
            overflow: hidden;
            flex-grow: 1; /* teks mengisi area card */
        }
        .book-card .btn {
            background-color: #1a2a6c;
            border: none;
            width: 100%;
        }
    </style>
</head>
<body>
@include('layouts.component-frontend.navbar')

<main id="main">
    <section id="semua-buku" class="py-4">
        <div class="container-fluid px-5">
            <h2 class="mb-4 fw-bold text-center">Semua Buku</h2>
            <div class="row g-4">
                <!-- Filter Kategori -->
                <div class="col-md-3 filter-col">
                    <h5 class="mb-3">Filter Kategori</h5>
                    <ul class="list-group">
                        <a href="{{ route('semua_buku.index') }}" class="list-group-item {{ empty($kategori_id) ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('semua_buku.index', ['kategori' => $kategori->id]) }}" 
                               class="list-group-item {{ (isset($kategori_id) && $kategori_id == $kategori->id) ? 'active' : '' }}">
                              {{ $kategori->nama_kategori }}
                            </a>
                        @endforeach
                    </ul>
                </div>

                <!-- Card Buku -->
                <div class="col-md-9" style="padding-left: 40px;">
                    <div class="row g-4">
                        @forelse ($bukus as $buku)
                            <div class="col-md-3">
                                <div class="card book-card shadow-sm border-0">
                                    @if ($buku->gambar)
                                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x400?text=No+Image" alt="No Image">
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $buku->judul }}</h5>
                                        <p class="card-text">{{ Str::limit($buku->deskripsi, 90) }}</p>
                                        <a href="{{ route('buku.detail', $buku->id) }}" 
                                           class="btn btn-primary mt-auto">
                                          <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Belum ada buku di kategori ini.</p>
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

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>
</html>
