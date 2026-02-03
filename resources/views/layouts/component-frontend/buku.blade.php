<section id="portfolio" class="portfolio section">

  <div class="container section-title" data-aos="fade-up">
    <h2>Buku Terbaru</h2>
    <p>Berikut buku-buku terbaru yang ditambahkan</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
      @forelse($bukus->sortByDesc('created_at') as $buku)
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-content position-relative text-center">

            {{-- Gambar Buku --}}
            <a href="{{ route('buku.detail', $buku->id) }}">
              @if ($buku->gambar)
                <img src="{{ asset('storage/' . $buku->gambar) }}" class="img-fluid"
                     alt="{{ $buku->judul }}"
                     style="width: 100%; height: 450px; object-fit: cover; border-radius: 6px;">
              @else
                <img src="https://via.placeholder.com/300x450?text=No+Image"
                     class="img-fluid" alt="No Image"
                     style="width:100%; height:450px; object-fit: cover; border-radius:6px;">
              @endif
            </a>

            {{-- Info Buku --}}
            <div class="portfolio-info mt-2" style="color: #fff;">
              <h5 class="mb-1" style="color: #fff;">{{ $buku->judul }}</h5>
              <p class="small" style="color: #f0f0f0;">{{ Str::limit($buku->deskripsi, 60, '...') }}</p>

              {{-- Zoom Gambar --}}
              @if ($buku->gambar)
                <a href="{{ asset('storage/' . $buku->gambar) }}"
                   title="{{ $buku->judul }}"
                   class="glightbox preview-link me-2"
                   style="color: #fff;">
                  <i class="bi bi-plus"></i>
                </a>
              @endif

              {{-- Detail Buku --}}
              <a href="{{ route('buku.detail', $buku->id) }}" class="details-link" style="color: #fff;">
                <i class="bi bi-link-45deg"></i>
              </a>
            </div>

          </div>
        </div>
      @empty
        <p class="text-center">Belum ada buku terbaru.</p>
      @endforelse
    </div>
  </div>

</section>

<!-- Tambahkan CSS ini di head atau file CSS utama -->
<style>
  /* Semua gambar buku di portfolio sekarang lebih panjang */
  .portfolio-item img {
    height: 450px;       /* Tinggi baru lebih panjang */
    object-fit: cover;
    width: 100%;
    border-radius: 6px;
  }
</style>
