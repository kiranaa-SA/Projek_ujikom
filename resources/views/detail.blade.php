<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $buku->judul }} - E-Perpus</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
</head>

<body>

@include('layouts.component-frontend.navbar')

<main id="main" style="margin-top: 100px">
<section id="book-detail" class="py-4">
<div class="container-fluid px-5">

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 90%; background-color: #f9fbff;">
<div class="row g-0 align-items-start">

<!-- Gambar Buku -->
<div class="col-md-4">
  @if ($buku->gambar)
    <img src="{{ asset('storage/' . $buku->gambar) }}"
         class="img-fluid w-100 h-100"
         style="object-fit: cover; max-height: 550px;"
         alt="{{ $buku->judul }}">
  @else
    <img src="https://via.placeholder.com/350x500?text=No+Image"
         class="img-fluid w-100 h-100"
         style="object-fit: cover; max-height: 550px;"
         alt="No Image">
  @endif
</div>

<!-- Detail Buku -->
<div class="col-md-8">
<div class="card-body p-4">

<h3 class="fw-bold mb-3" style="color: #142850;">
  {{ $buku->judul }}
</h3>

<!-- DETAIL + STOK (WARNA & UKURAN SAMA) -->
<div style="color: #1f3c88;">
  <p><strong>Kategori:</strong> {{ $buku->kategori->nama_kategori ?? '-' }}</p>
  <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
  <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
  <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
  <p><strong>Jumlah Buku:</strong> {{ $buku->stok }}</p>
</div>

<hr>

<p style="text-align: justify;">
  {{ $buku->deskripsi ?? 'Tidak ada deskripsi untuk buku ini.' }}
</p>

<!-- TOMBOL (TIDAK DIUBAH) -->
<div class="mt-4">
@auth
<form action="{{ route('pinjam.buku', $buku->id) }}" method="POST" class="d-inline">
@csrf

<div class="d-flex align-items-center mb-3" style="max-width: 200px;">
  <button type="button" class="btn btn-outline-secondary" id="decreaseQty">−</button>
  <input type="number" name="jumlah" id="jumlah" value="1" min="1"
         class="form-control text-center mx-2" style="width: 70px;">
  <button type="button" class="btn btn-outline-secondary" id="increaseQty">+</button>
</div>

<button type="submit" class="btn btn-primary px-4 py-2 rounded-3 me-2"
        style="background-color: #1a2a6c; border: none;">
  <i class="bi bi-book me-2"></i> Pinjam Buku
</button>
</form>
@else
<a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 rounded-3 me-2 text-white"
   style="background-color: #1a2a6c; border: none;">
  <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Pinjam Buku
</a>
@endauth

<a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
  <i class="bi bi-arrow-left me-2"></i> Kembali
</a>
</div>

</div>
</div>

</div>
</div>
</section>
</main>

@include('layouts.component-frontend.footer')

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
