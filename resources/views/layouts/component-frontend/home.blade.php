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
              <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                <a href="#about" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                   class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0">
                  <i class="bi bi-play-circle"></i><span>Watch Video</span>
                </a>
              </div>
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

                <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                  <a href="{{ $banner->link ?? '#' }}" class="btn-get-started">
                    {{ $banner->tombol_text ?? 'Get Started' }} <i class="bi bi-arrow-right"></i>
                  </a>

                  @if($banner->video_url)
                    <a href="{{ $banner->video_url }}"
                      class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0">
                      <i class="bi bi-play-circle"></i><span>Watch Video</span>
                    </a>
                  @endif
                </div>
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
