<section id="hero" class="hero section">

  <div class="container">
    <div class="row gy-4">
    <div class="swiper heroSwiper">
      <div class="swiper-wrapper">

        {{-- ====== SLIDE 1 (Bawaan Template) ====== --}}
        <div class="swiper-slide">
          <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h1 data-aos="fade-up">Perpustakaan digital untuk generasi modern</h1>
              <p data-aos="fade-up" data-aos-delay="100">
                Nikmati kemudahan membaca dan meminjam buku secara digital di mana saja, kapan saja.
              </p>
              
            </div>

            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
              <img src="{{ asset('frontend/assets/img/ChatGPT Image Oct 10, 2025, 09_30_05 AM.png') }}"
                   class="img-fluid animated" alt="">
            </div>
          </div>
        </div>

        {{-- ====== SLIDE DARI DATABASE ====== --}}
      @if(isset($banners) && $banners->count())
  @foreach ($banners as $banner)
  <div class="swiper-slide">
    <div class="row gy-4">

      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">{{ $banner->judul_utama }}</h1>

        <p data-aos="fade-up" data-aos-delay="100">
          {{ $banner->deskripsi }}
        </p>

        {{-- 🔥 TOMBOL GET STARTED DIHAPUS --}}
        
        @if($banner->video_url)
        <div data-aos="fade-up" data-aos-delay="200">
          <a href="{{ $banner->video_url }}"
            class="glightbox btn-watch-video d-flex align-items-center mt-3">
            <i class="bi bi-play-circle"></i>
            <span class="ms-2">Watch Video</span>
          </a>
        </div>
        @endif

      </div>

      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="{{ asset('storage/' . $banner->gambar) }}"
             class="img-fluid animated"
             alt="{{ $banner->judul_utama }}">
      </div>

    </div>
  </div>
  @endforeach
@endif

      </div>

      <!-- Pagination -->
      <div class="swiper-pagination"></div>

    </div>
    </div>
  </div>
</section>

<style>
  /* jarak dari navbar */
  #hero {
    margin-top: 50px;
  }

  /* sembunyikan tombol panah */
  .swiper-button-next,
  .swiper-button-prev {
    display: none !important;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    new Swiper(".heroSwiper", {
      speed: 800,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      slidesPerView: 1,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: false // panah dimatikan
    });
  });
</script>
