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

    <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    @include('layouts.component-frontend.navbar')

    <main class="main">

        <!-- Hero Section -->
        @include('layouts.component-frontend.home')
        <!-- /Hero Section -->

        <!-- About Section -->
        @include('layouts.component-frontend.about')

        <!-- /About Section -->

        <!-- Values Section -->
        <!-- /Values Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

           <div class="container" data-aos="fade-up" data-aos-delay="100">
<div class="row gy-4">

    <!-- Total Buku -->
    <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="bi bi-book color-blue flex-shrink-0"></i>
            <div>
                <span data-purecounter-start="0"
                      data-purecounter-end="{{ $totalBuku }}"
                      data-purecounter-duration="1"
                      class="purecounter"></span>
                <p>Total Buku</p>
            </div>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="bi bi-tags color-orange flex-shrink-0" style="color: #ee6c20;"></i>
            <div>
                <span data-purecounter-start="0"
                      data-purecounter-end="{{ $totalKategori }}"
                      data-purecounter-duration="1"
                      class="purecounter"></span>
                <p>Total Kategori</p>
            </div>
        </div>
    </div>

    <!-- Total Peminjaman -->
    <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="bi bi-journal-arrow-up color-green flex-shrink-0" style="color: #15be56;"></i>
            <div>
                <span data-purecounter-start="0"
                      data-purecounter-end="{{ $totalPeminjaman }}"
                      data-purecounter-duration="1"
                      class="purecounter"></span>
                <p>Total Peminjaman</p>
            </div>
        </div>
    </div>

    <!-- Total Penulis -->
  <div class="col-lg-3 col-md-6">
    <div class="stats-item d-flex align-items-center w-100 h-100">
        <i class="bi bi-arrow-counterclockwise color-pink flex-shrink-0" style="color: #bb0852;"></i>
        <div>
            <span data-purecounter-start="0"
                  data-purecounter-end="{{ $totalPengembalian }}"
                  data-purecounter-duration="1"
                  class="purecounter"></span>
            <p>Total Pengembalian</p>
        </div>
    </div>
</div>

</div>

</div>


</div>


        </section><!-- /Stats Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Mengapa Memilih Kami</h2>
                <p>Mengapa Memilih Perpustakaan Ini?<br></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ 'frontend\assets\img\ChatGPT Image Oct 10, 2025, 09_44_39 AM.png' }}"
                            class="img-fluid" alt="">
                    </div>

                    <div class="col-xl-6 d-flex">
                        <div class="row align-self-center gy-4">

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Akses 24 jam dari mana saja</h3>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Koleksi buku terbaru setiap minggu</h3>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Tampilan modern dan mudah digunakan</h3>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Dukungan untuk semua perangkat</h3>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Komunitas pembaca aktif</h3>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Sistem peminjaman cepat dan tanpa antre</h3>
                                </div>
                            </div><!-- End Feature Item -->

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Features Section -->

        <!-- Alt Features Section -->
        <!-- /Alt Features Section -->

        <!-- Services Section -->
       <section id="services" class="services section">

    <!-- Section Title -->
   <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Layanan</h2>
        <p>Layanan Perpustakaan Digital Kami<br></p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item item-cyan position-relative">
                    <i class="bi bi-book icon"></i>
                    <h3>Koleksi Buku Digital</h3>
                    <p>Menyediakan berbagai koleksi buku digital seperti novel, komik, dan buku pengetahuan yang dapat diakses secara online.</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item item-orange position-relative">
                    <i class="bi bi-search icon"></i>
                    <h3>Pencarian Buku</h3>
                    <p>Fitur pencarian buku berdasarkan judul, penulis, kategori, dan rak untuk memudahkan pengguna menemukan buku.</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-item item-teal position-relative">
                    <i class="bi bi-journal-check icon"></i>
                    <h3>Peminjaman Online</h3>
                    <p>Pengguna dapat melakukan peminjaman buku secara online tanpa harus datang langsung ke perpustakaan.</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-item item-red position-relative">
                    <i class="bi bi-clock-history icon"></i>
                    <h3>Riwayat Peminjaman</h3>
                    <p>Menyimpan data riwayat peminjaman buku pengguna sehingga lebih rapi dan mudah dipantau.</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="service-item item-indigo position-relative">
                    <i class="bi bi-people icon"></i>
                    <h3>Manajemen Pengguna</h3>
                    <p>Pengelolaan data anggota perpustakaan untuk memudahkan administrasi dan pemantauan aktivitas pengguna.</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="service-item item-pink position-relative">
                    <i class="bi bi-shield-lock icon"></i>
                    <h3>Keamanan Data</h3>
                    <p>Sistem perpustakaan dilengkapi dengan keamanan data untuk melindungi informasi pengguna dan koleksi buku.</p>
                </div>
            </div><!-- End Service Item -->

        </div>

    </div>

</section><!-- /Services Section -->
<!-- /Services Section -->


       
        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <!-- End Section Title -->

            <div class="container">

    <div class="row">

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

                <div class="faq-item faq-active">
                    <h3>Apa itu website perpustakaan digital?</h3>
                    <div class="faq-content">
                        <p>Website perpustakaan digital adalah sistem yang memudahkan pengguna untuk mencari, melihat,
                            dan meminjam buku secara online tanpa harus datang langsung ke perpustakaan.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Bagaimana cara meminjam buku di website ini?</h3>
                    <div class="faq-content">
                        <p>Pengguna dapat login terlebih dahulu, kemudian memilih buku yang diinginkan dan melakukan
                            peminjaman melalui sistem yang telah disediakan.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Apakah semua buku bisa diakses secara online?</h3>
                    <div class="faq-content">
                        <p>Tidak semua buku tersedia dalam bentuk digital. Beberapa buku hanya dapat dipinjam secara
                            fisik sesuai dengan ketersediaan koleksi perpustakaan.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

            </div>

        </div><!-- End Faq Column-->

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">

                <div class="faq-item">
                    <h3>Apakah peminjaman buku dikenakan biaya?</h3>
                    <div class="faq-content">
                        <p>Tidak, peminjaman buku di website perpustakaan ini gratis dan ditujukan untuk memudahkan
                            pengguna dalam mengakses bahan bacaan.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Berapa lama batas waktu peminjaman buku?</h3>
                    <div class="faq-content">
                        <p>Batas waktu peminjaman buku ditentukan oleh sistem perpustakaan, biasanya selama beberapa hari
                            dan dapat dilihat pada menu riwayat peminjaman.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

                <div class="faq-item">
                    <h3>Apakah data pengguna aman?</h3>
                    <div class="faq-content">
                        <p>Ya, data pengguna disimpan dengan sistem keamanan yang baik dan hanya digunakan untuk
                            keperluan pengelolaan perpustakaan.</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->

            </div>

        </div><!-- End Faq Column-->

    </div>

</div>


        </section><!-- /Faq Section -->

        <!-- Portfolio Section -->
        @include('layouts.component-frontend.buku')
        <!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        <!-- /Testimonials Section -->

        <!-- Team Section -->
        <section id="team" class="team section">
           <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
  <h2>Tips & Info Menarik</h2>
  <p>Temukan tips membaca dan info literasi untuk memperkaya pengalaman membaca Anda</p>
</div><!-- End Section Title -->

<div class="container">
  <div class="row gy-4">

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
      <div class="team-member">
        <div class="member-img">
          <img src="{{('frontend/download (2).jpg')}}" class="img-fluid" alt="Tips Memilih Buku">
        </div>
        <div class="member-info">
          <h4>Tips Memilih Buku Sesuai Minat</h4>
          <p>Pelajari cara menemukan buku yang cocok dengan minat dan gaya membaca Anda.</p>
        </div>
      </div>
    </div><!-- End Card -->

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
      <div class="team-member">
        <div class="member-img">
          <img src="{{('frontend/𝓟𝓲𝓷 _𝓟𝓸𝓸𝓳𝓪_.🦋')}}" class="img-fluid" alt="Cara Membaca Cepat">
        </div>
        <div class="member-info">
          <h4>Cara Membaca Cepat Efektif</h4>
          <p>Tips dan teknik membaca lebih cepat tanpa mengurangi pemahaman terhadap isi buku.</p>
        </div>
      </div>
    </div><!-- End Card -->

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
      <div class="team-member">
        <div class="member-img">
          <img src="{{('frontend/download (8).jpg')}}" class="img-fluid" alt="Event Literasi">
        </div>
        <div class="member-info">
          <h4>Event Literasi di Perpustakaan</h4>
          <p>Ikuti kegiatan literasi dan workshop menarik untuk menambah wawasan dan pengalaman membaca.</p>
        </div>
      </div>
    </div><!-- End Card -->

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
      <div class="team-member">
        <div class="member-img">
          <img src="{{('frontend/I love to read 📚.jpg')}}" class="img-fluid" alt="Buku Populer Minggu Ini">
        </div>
        <div class="member-info">
          <h4>Buku Populer Minggu Ini</h4>
          <p>Temukan buku-buku yang paling banyak dibaca dan diminati pengunjung minggu ini.</p>
        </div>
      </div>
    </div><!-- End Card -->

  </div>
</div>


        </section><!-- /Team Section -->

        <!-- Clients Section -->
        <!-- /Clients Section -->

       
        <!-- Contact Section -->
        <!-- /Contact Section -->

    </main>

    @include('layouts.component-frontend.footer')


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
