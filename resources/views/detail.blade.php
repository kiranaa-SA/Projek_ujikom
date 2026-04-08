<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $buku->judul }} - E-Perpus</title>

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Main CSS -->
  <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
</head>

<body>

@include('layouts.component-frontend.navbar')

<main id="main" style="margin-top: 100px">
  <section class="py-5">
    <div class="container px-5">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @php
        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('buku_id', $buku->id)
            ->exists();
      @endphp

      <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 90%; background-color:#f9fbff;">
        <div class="row g-0">

          <!-- Gambar -->
          <div class="col-md-4">
            <div class="h-100 w-100" style="overflow:hidden;">
              <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://via.placeholder.com/350x500' }}"
                   class="img-fluid w-100 h-100 rounded-start"
                   style="object-fit:cover; max-height:550px;">
            </div>
          </div>

          <!-- Detail -->
          <div class="col-md-8">
            <div class="card-body p-5 d-flex flex-column justify-content-between">

              <div>
                <h2 class="fw-bold mb-4" style="color:#142850">{{ $buku->judul }}</h2>

                <div class="mb-4" style="color:#1f3c88; line-height:1.6;">
                  <p><strong>Kategori:</strong> {{ $buku->kategori->nama_kategori ?? '-' }}</p>
                  <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                  <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                  <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                  <p><strong>Stok:</strong> {{ $buku->stok }}</p>
                </div>

                <hr class="my-4">

                <p style="text-align:justify; color:#142850;">
                  {{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>
              </div>

              {{-- TOMBOL --}}
              <div class="mt-4">
                @auth
                  <div class="d-flex align-items-center gap-3 flex-wrap">

                    {{-- PINJAM --}}
                    <form action="{{ route('pinjam.buku', $buku->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2"
                              style="background-color:#1a2a6c; border:none;">
                        <i class="bi bi-book"></i> Pinjam Buku
                      </button>
                    </form>

                    {{-- KERANJANG --}}
                    <form action="{{ route('keranjang.store', $buku->id) }}" method="POST">
                      @csrf
                      <button type="submit"
                              class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                              style="width:48px; height:48px;"
                              title="Tambah ke Keranjang">
                        <i class="bi bi-cart-plus fs-5"></i>
                      </button>
                    </form>

                    {{-- FAVORIT --}}
                    <form action="{{ route('favorite.toggle', $buku->id) }}" method="POST">
                      @csrf
                      <button type="submit"
                              class="btn {{ $isFavorite ? 'btn-danger' : 'btn-outline-danger' }} rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                              style="width:48px; height:48px;"
                              title="Favorit">
                        <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }} fs-5"></i>
                      </button>
                    </form>

                    {{-- KEMBALI --}}
                    <a href="{{ route('semua_buku.index') }}"
                       class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
                      <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                  </div>
                @else
                  <a href="{{ route('login') }}"
                      class="btn d-flex align-items-center gap-2 shadow-sm"
                      style="background-color:#1a2a6c; color:white; border:none; border-radius:8px; padding:0.5rem 1rem;">
                      <i class="bi bi-book"></i> Login untuk Pinjam
                    </a>
                @endauth
              </div>

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