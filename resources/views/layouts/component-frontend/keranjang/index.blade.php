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
        #main {
            margin-top: 100px;
        }

        /* FIX UKURAN GAMBAR (FINAL FIX) */
        .cart-img-wrapper {
            width: 70px;
            height: 100px;
            overflow: hidden;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .cart-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
</head>

<body>

@include('layouts.component-frontend.navbar')

<main id="main">
<section class="py-5">
<div class="container">

<h4 class="fw-bold mb-4">🛒 Keranjang Saya</h4>

{{-- ALERT --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

@if($items->isEmpty())
    <div class="alert alert-info text-center">
        Keranjang kamu masih kosong 📭
    </div>
@else

{{-- FORM PINJAM (SATU FORM, JANGAN ADA FORM LAIN DI DALAMNYA) --}}
<form action="{{ route('keranjang.pinjam') }}" method="POST">
@csrf

@foreach($items as $item)
<div class="card mb-3 border-0 shadow-sm">
    <div class="card-body d-flex align-items-center gap-3">

        {{-- CHECKBOX (INI KUNCI) --}}
        <input type="checkbox"
               name="keranjang_ids[]"
               value="{{ $item->id }}"
               class="form-check-input mt-0">

        {{-- GAMBAR --}}
        <div class="cart-img-wrapper">
            <img src="{{ asset('storage/'.$item->buku->gambar) }}"
                 alt="{{ $item->buku->judul }}">
        </div>

        {{-- INFO --}}
        <div class="flex-grow-1">
            <h6 class="mb-1 fw-semibold">{{ $item->buku->judul }}</h6>
            <small class="text-muted">{{ $item->buku->penulis }}</small>
        </div>

        {{-- HAPUS --}}
        <button type="button"
                class="btn btn-outline-danger btn-sm"
                onclick="hapusKeranjang({{ $item->id }})">
            <i class="bi bi-trash"></i>
        </button>

    </div>
</div>
@endforeach

<div class="d-flex justify-content-end mt-4">
    <button type="submit" class="btn btn-primary px-4 py-2">
        <i class="bi bi-book me-1"></i>
        Ajukan Peminjaman
    </button>
</div>

</form>

{{-- FORM HAPUS TERSEMBUNYI --}}
<form id="hapus-form" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endif

</div>
</section>
</main>

@include('layouts.component-frontend.footer')

<script>
function hapusKeranjang(id) {
    if (confirm('Hapus buku dari keranjang?')) {
        const form = document.getElementById('hapus-form');
        form.action = `/keranjang/${id}`;
        form.submit();
    }
}
</script>

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
