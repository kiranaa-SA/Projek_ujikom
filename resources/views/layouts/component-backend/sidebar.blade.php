<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{ url('/home') }}" class="text-nowrap logo-img">
        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Main Menu</span>
        </li>
        <!-- Kategori -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('kategoris.index') }}" aria-expanded="false">
            <span><i class="ti ti-category"></i></span>
            <span class="hide-menu">Kategori</span>
          </a>
        </li>

        <!-- Rak -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('raks.index') }}" aria-expanded="false">
            <span><i class="ti ti-building-warehouse"></i></span>
            <span class="hide-menu">Rak</span>
          </a>
        </li>

        <!-- Buku -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('bukus.index') }}" aria-expanded="false">
            <span><i class="ti ti-book"></i></span>
            <span class="hide-menu">Buku</span>
          </a>
        </li>

        <!-- Peminjaman -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('peminjamans.index') }}" aria-expanded="false">
            <span><i class="ti ti-file-export"></i></span>
            <span class="hide-menu">Peminjaman</span>
          </a>
        </li>

        <!-- Pengembalian -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('pengembalians.index') }}" aria-expanded="false">
            <span><i class="ti ti-file-import"></i></span>
            <span class="hide-menu">Pengembalian</span>
          </a>
        </li>

        <!-- Denda -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('dendas.index') }}" aria-expanded="false">
            <span><i class="ti ti-cash"></i></span>
            <span class="hide-menu">Denda</span>
          </a>
        </li>

      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
