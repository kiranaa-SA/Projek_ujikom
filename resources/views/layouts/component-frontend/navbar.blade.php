<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      {{-- <img src="{{ asset('frontend/assets/img/logo.png') }}" alt=""> --}}
      <h1 class="sitename">E-Perpus</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ url('/') }}#hero" class="active">Home</a></li>
        <li><a href="{{ url('/') }}#about">Tentang</a></li>

        {{-- 🔽 Dropdown Jelajahi Buku --}}
        <li class="dropdown">
          <a href="#"><span>Jelajahi Buku</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
            <li><a href="{{ url('/') }}#portfolio">Koleksi Buku</a></li>
            <li><a href="{{ route('semua_buku.index') }}">Semua Buku</a></li>
          </ul>
        </li>

        <li><a href="{{ url('/') }}#team">Jelajahi Genre</a></li>

        {{-- 🔹 Tambahan: Riwayat Peminjaman --}}
        @auth
          <li><a href="{{ route('riwayat.index') }}">Riwayat</a></li>
        @endauth

        <li><a href="#contact">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- 🔹 Tombol Login / Logout Dinamis --}}
    @guest
      <a href="{{ route('login') }}" class="btn-getstarted flex-md-shrink-0">Login</a>
    @endguest

    @auth
      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn-getstarted flex-md-shrink-0">Logout</button>
      </form>
    @endauth

  </div>
</header>
