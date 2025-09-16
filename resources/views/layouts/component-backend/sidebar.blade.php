<aside class="left-sidebar">
  <div>
    <!-- Brand Logo -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{ url('/home') }}" class="text-nowrap logo-img">
        <img src="{{ asset('assets/images/logos/ChatGPT_Image_Sep_15__2025__09_08_07_AM-removebg-preview.png') }}" 
             style="height: 110px; width: auto;" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <!-- Sidebar navigation -->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Main Menu</span>
        </li>

        {{-- DASHBOARD --}}
        @if(Auth::user()->role == 'admin')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
               href="{{ route('admin.dashboard') }}">
              <span><i class="ti ti-layout-dashboard"></i></span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
        @elseif(Auth::user()->role == 'petugas')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" 
               href="{{ route('petugas.dashboard') }}">
              <span><i class="ti ti-layout-dashboard"></i></span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
        @endif

        {{-- ADMIN MENU --}}
        @if(Auth::user()->role == 'admin')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.userrs.*') ? 'active' : '' }}" 
               href="{{ route('admin.userrs.index') }}">
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

        {{-- MENU UNTUK ADMIN & PETUGAS --}}
        @if(in_array(Auth::user()->role, ['admin', 'petugas']))
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
        @endif

        {{-- SISWA MENU --}}
        @if(Auth::user()->role == 'siswa')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('siswa.bukus.*') ? 'active' : '' }}" 
               href="{{ route('siswa.bukus.index') }}">
              <span><i class="ti ti-book"></i></span>
              <span class="hide-menu">Lihat Buku</span>
            </a>
          </li>
        @endif

        {{-- MENU LAPORAN (KHUSUS ADMIN) --}}
        @if(Auth::user()->role == 'admin')
          <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.laporans.*') ? 'active' : '' }}" 
               href="{{ route('admin.laporans.index') }}">
              <span><i class="ti ti-report"></i></span>
              <span class="hide-menu">Laporan</span>
            </a>
          </li>
        @endif

      </ul>
    </nav>
  </div>
</aside>
