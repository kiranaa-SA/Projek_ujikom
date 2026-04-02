<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Riwayat Peminjaman Buku - E-Perpus</title>

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
    <section id="riwayat-peminjaman" class="py-4">
      <div class="container px-5">

        <div class="text-center mb-4">
          <h2>Riwayat Peminjaman Buku</h2>
          <p>Lihat status peminjaman buku kamu di bawah ini.</p>
        </div>

        @if($riwayat->isEmpty())
          <div class="alert alert-info text-center shadow-sm">
            Belum ada riwayat peminjaman buku.
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-primary text-center">
                <tr>
                  <th>No</th>
                  <th>Judul Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($riwayat as $index => $p)
                  <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->buku->judul ?? '-' }}</td>
                    <td class="text-center">{{ $p->tanggal_pinjam ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') : '-' }}</td>
                    <td class="text-center">{{ $p->tenggat_tempo ? \Carbon\Carbon::parse($p->tenggat_tempo)->format('d M Y') : '-' }}</td>
                    <td class="text-center">
                      @switch($p->status ?? '')
                        @case('pending')
                          <span class="badge bg-secondary">Menunggu</span>
                          @break
                        @case('dipinjam')
                          <span class="badge bg-success">Dipinjam</span>
                          @break
                        @case('dikembalikan')
                          <span class="badge bg-primary">Selesai</span>
                          @break
                        @case('hilang')
                          <span class="badge bg-danger">Hilang</span>
                          @break
                        @default
                          <span class="badge bg-secondary">Tidak diketahui</span>
                      @endswitch
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        <div class="mt-4 text-center">
          <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
            <i class="bi bi-arrow-left me-2"></i> Kembali
          </a>
        </div>

      </div>
    </section>
  </main>

  @include('layouts.component-frontend.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

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
