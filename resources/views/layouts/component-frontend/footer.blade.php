<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row gy-4">

      <!-- Tentang Perpustakaan -->
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="d-flex align-items-center">
          <span class="sitename">E-Perpus</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Perpustakaan Digital Sekolah</p>
          <p>Indonesia</p>
          <p class="mt-3"><strong>Telepon:</strong> <span>+62 812 3456 7890</span></p>
          <p><strong>Email:</strong> <span>eperpus@gmail.com</span></p>
        </div>
      </div>

      <!-- Menu -->
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Menu</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/') }}">Beranda</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/buku') }}">Daftar Buku</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ route('login') }}">Login</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
        </ul>
      </div>

      <!-- Layanan -->
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Layanan</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Peminjaman Buku</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Pengembalian Buku</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Pencarian Buku</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Riwayat Peminjaman</a></li>
        </ul>
      </div>

      <!-- Sosial Media -->
      <div class="col-lg-4 col-md-12">
        <h4>Ikuti Kami</h4>
        <p>Ikuti informasi terbaru dan koleksi buku terbaru melalui media sosial kami.</p>
        <div class="social-links d-flex">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

    </div>
  </div>

  <!-- Copyright -->
  <div class="container copyright text-center mt-4">
    <p>
      © <span>Copyright</span>
      <strong class="px-1 sitename">E-Perpus</strong>
      <span>All Rights Reserved</span>
    </p>
    <div class="credits">
      Dibuat untuk kebutuhan pembelajaran dan pengelolaan perpustakaan digital
    </div>
  </div>

</footer>
