<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">E-Perpus</h1>
    </a>

    {{-- Menu Navbar --}}
    <nav id="navmenu" class="navmenu me-auto">
      <ul>
        <li><a href="{{ url('/') }}#hero" class="active">Home</a></li>
        <li><a href="{{ url('/') }}#about">Tentang</a></li>

        {{-- Dropdown Jelajahi Buku --}}
        <li class="dropdown">
          <a href="#">
            <span>Jelajahi Buku</span>
            <i class="bi bi-chevron-down dropdown-indicator"></i>
          </a>
          <ul>
            <li><a href="{{ url('/') }}#portfolio">Koleksi Buku</a></li>
            <li><a href="{{ route('semua_buku.index') }}">Semua Buku</a></li>
          </ul>
        </li>

        {{-- GANTI JELAJAHI GENRE --}}
        <li><a href="{{ url('/') }}#team">Tips & Info</a></li>

        @auth
          <li class="ms-3">
            <a href="{{ route('riwayat.index') }}">Riwayat</a>
          </li>
        @endauth
      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- KANAN: Keranjang + Logout --}}
    @auth
      @php
        $cartCount = \App\Models\Keranjang::where('user_id', auth()->id())->count();
      @endphp

      <div class="d-flex align-items-center ms-4 gap-4">

        {{-- ICON KERANJANG (FRONTEND) --}}
        <a href="{{ route('keranjang.index') }}"
           class="position-relative text-dark"
           style="font-size: 22px;">
          <i class="bi bi-cart3"></i>

          @if($cartCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  style="font-size: 10px;">
              {{ $cartCount }}
            </span>
          @endif
        </a>

        {{-- LOGOUT --}}
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-getstarted">
            Logout
          </button>
        </form>
      </div>
    @endauth

    @guest
      <a href="{{ route('login') }}" class="btn-getstarted">Login</a>
    @endguest

  </div>
</header>
