<aside class="left-sidebar" style="height: 100vh; overflow-y: auto; position: fixed;">
  <div class="d-flex flex-column h-100">

    <!-- Brand Logo -->
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ url('/home') }}" class="text-nowrap logo-img">
        <img src="{{ asset('assets/images/logos/ChatGPT_Image_Sep_15__2025__09_08_07_AM-removebg-preview.png') }}" 
             style="height: 90px; width: auto;" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <!-- Sidebar navigation -->
    <nav class="sidebar-nav flex-grow-1 p-2">
      <ul id="sidebarnav" class="list-unstyled">

        <li class="nav-small-cap mt-2">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Main Menu</span>
        </li>

        {{-- DASHBOARD --}}
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.dashboard') ? 'active' : '' }}" 
             href="{{ route(Auth::user()->role . '.dashboard') }}">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        {{-- MENU KHUSUS ADMIN --}}
        @if(Auth::user()->role == 'admin')

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
               href="{{ route('admin.users.index') }}">
              <span><i class="ti ti-users"></i></span>
              <span class="hide-menu">User</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}" 
               href="{{ route('admin.kategoris.index') }}">
              <span><i class="ti ti-category"></i></span>
              <span class="hide-menu">Kategori</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.raks.*') ? 'active' : '' }}" 
               href="{{ route('admin.raks.index') }}">
              <span><i class="ti ti-building-warehouse"></i></span>
              <span class="hide-menu">Rak</span>
            </a>
          </li>

        @endif

        {{-- MENU ADMIN & PETUGAS --}}
        @if(in_array(Auth::user()->role, ['admin','petugas']))

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.bukus.*') ? 'active' : '' }}" 
               href="{{ route(Auth::user()->role . '.bukus.index') }}">
              <span><i class="ti ti-book"></i></span>
              <span class="hide-menu">Buku</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.peminjamans.*') ? 'active' : '' }}" 
               href="{{ route(Auth::user()->role . '.peminjamans.index') }}">
              <span><i class="ti ti-file-export"></i></span>
              <span class="hide-menu">Peminjaman</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.pengembalians.*') ? 'active' : '' }}" 
               href="{{ route(Auth::user()->role . '.pengembalians.index') }}">
              <span><i class="ti ti-file-import"></i></span>
              <span class="hide-menu">Pengembalian</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.dendas.*') ? 'active' : '' }}" 
               href="{{ route(Auth::user()->role . '.dendas.index') }}">
              <span><i class="ti ti-cash"></i></span>
              <span class="hide-menu">Denda</span>
            </a>
          </li>

          {{-- LAPORAN --}}
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs(Auth::user()->role . '.laporans.*') ? 'active' : '' }}" 
               href="{{ route(Auth::user()->role . '.laporans.index') }}">
              <span><i class="ti ti-report"></i></span>
              <span class="hide-menu">Laporan</span>
            </a>
          </li>

        @endif

        {{-- HERO BANNER (ADMIN ONLY) --}}
        @if(Auth::user()->role == 'admin')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.hero-banners.*') ? 'active' : '' }}" 
               href="{{ route('admin.hero-banners.index') }}">
              <span><i class="ti ti-photo"></i></span>
              <span class="hide-menu">Hero Banner</span>
            </a>
          </li>
        @endif

        {{-- MENU LAINNYA --}}
        <li class="nav-small-cap mt-3">
          <span class="hide-menu text-uppercase fw-bold text-muted">Menu Lainnya</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/') }}">
            <i class="ti ti-user"></i>
            <span class="hide-menu">User</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>