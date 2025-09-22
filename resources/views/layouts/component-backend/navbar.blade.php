<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
          <i class="ti ti-bell-ringing"></i>
          <div class="notification bg-primary rounded-circle"></div>
        </a>
      </li>
    </ul>

    {{-- Collapse Menu --}}
     <div class="d-block d-lg-none py-4">
              <a href="./main/index.html" class="text-nowrap logo-img">
                <img src="/assets/backend/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                <img src="/assets/backend/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
              </a>
            </div>
            <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="ti ti-dots fs-7"></i>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle mx-0 ms-n1 d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                  <i class="ti ti-align-justified fs-7"></i>
                </a>

        {{-- Avatar inisial + dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            @php
                switch (Auth::user()->role) {
                    case 'admin':
                        $initial = 'A';
                        break;
                    case 'petugas':
                        $initial = 'P';
                        break;
                    default:
                        $initial = 'U';
                        break;
                }
            @endphp
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                 style="width:35px; height:35px;">
                {{ $initial }}
            </div>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <li class="message-body">
              {{-- Info user login --}}
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <div>
                  <p class="mb-0 fs-3">{{ Auth::user()->name }}</p>
                  <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
              </a>

              {{-- Tombol Logout --}}
              <a href="{{ route('logout') }}" 
                 class="btn btn-outline-primary mx-3 mt-2 d-block"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
