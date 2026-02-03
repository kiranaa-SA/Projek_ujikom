<header class="app-header shadow-sm">
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-3 py-2">
    <div class="container-fluid">

      {{-- Sidebar Toggle --}}
      <a class="nav-link d-block d-xl-none me-2" href="javascript:void(0)" id="headerCollapse">
        <i class="ti ti-menu-2 fs-5"></i>
      </a>

      {{-- Navbar Right --}}
      <ul class="navbar-nav ms-auto align-items-center">

        {{-- Notification --}}
        @php
            use App\Models\PeminjamanNotification;

            // Ambil 5 notifikasi terakhir (belum dibaca)
            $notifs = PeminjamanNotification::with(['peminjaman.user', 'peminjaman.buku'])
                        ->latest()
                        ->take(5)
                        ->get();

            // Hitung notif belum dibaca
            $notifCount = $notifs->where('is_read', false)->count();
        @endphp

        <li class="nav-item dropdown ms-3">
          <a class="nav-link nav-icon-hover position-relative" href="#" data-bs-toggle="dropdown" id="notifDropdown">
            <i class="ti ti-bell-ringing"></i>
            @if($notifCount > 0)
              <span class="notification bg-primary rounded-circle"></span>
            @endif
          </a>

          <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 320px;">
            <li class="dropdown-header fw-bold">Notifikasi</li>

            @forelse($notifs as $notif)
              @if($notif->peminjaman)
                <li>
                  <a class="dropdown-item d-flex justify-content-between align-items-center"
                     href="{{ route('admin.peminjamans.show', $notif->peminjaman->id) }}"
                     onclick="markAsRead({{ $notif->id }})">
                      <div>
                          <small>
                            {{ $notif->peminjaman->user->name }} meminjam 
                            {{ $notif->peminjaman->buku->judul }}
                          </small>
                          <br>
                          <span class="text-muted" style="font-size: 10px;">
                              {{ $notif->peminjaman->created_at->diffForHumans() }}
                          </span>
                      </div>
                      @if(!$notif->is_read)
                        <span class="badge bg-primary rounded-circle" style="width:10px; height:10px;"></span>
                      @endif
                  </a>
                </li>
              @endif
            @empty
              <li><span class="dropdown-item text-muted text-center">Tidak ada notifikasi</span></li>
            @endforelse

            <li><a class="dropdown-item text-center text-primary" href="{{ route('admin.peminjamans.index') }}">Lihat semua</a></li>
          </ul>
        </li>

        {{-- Avatar Profil --}}
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="#" data-bs-toggle="dropdown">
              @php
                  $initial = match(Auth::user()->role) {
                      'admin' => 'A',
                      'petugas' => 'P',
                      default => 'U'
                  };
              @endphp
              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                   style="width:35px; height:35px; font-weight:bold;">
                  {{ $initial }}
              </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
              <li class="dropdown-item d-flex align-items-center gap-2">
                  <i class="ti ti-user fs-6"></i>
                  <div>
                      <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                      <small class="text-muted">{{ Auth::user()->email }}</small>
                  </div>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li class="dropdown-item text-center">
                  <a href="{{ route('logout') }}" 
                     class="btn btn-outline-primary w-100"
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

<style>
.notification {
    width: 10px;
    height: 10px;
    position: absolute;
    top: 8px;
    right: 8px;
}
</style>

<script>
  function markAsRead(id) {
      fetch(`/notifications/${id}/read`, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
      });
  }
</script>
