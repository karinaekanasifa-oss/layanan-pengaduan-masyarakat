<header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle (visible on large screens only) -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <!-- Right actions -->
      <div class="navbar-actions ms-auto">
        <!-- Fullscreen Toggle -->
        <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <img src="{{ asset('template-admin-petugas/assets/images/avatar.png') }}" alt="Profile Image" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">{{ Auth::user()->nama_lengkap ?? 'Petugas Lapangan' }}</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Panel Petugas Lapangan</li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalProfilPetugas"><i class="bi bi-person"></i> Profil Saya</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <!-- Form Logout -->
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </header>

<!-- Modal Profil Petugas -->
<div class="modal fade" id="modalProfilPetugas" tabindex="-1" aria-labelledby="modalProfilPetugasLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; background-color: #FDFBF7;">
      <!-- Header Modal -->
      <div class="modal-header text-white" style="background-color: #198754;">
        <h5 class="modal-title fw-bold" id="modalProfilPetugasLabel">Profil Petugas Lapangan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <div class="modal-body text-center p-4">
        <div class="mb-3">
          <img src="{{ asset('template-admin-petugas/assets/images/avatar.png') }}" alt="Avatar" class="rounded-circle shadow-sm border border-3 border-white" width="90" height="90" style="object-fit: cover;">
        </div>
        <h4 class="fw-bold mb-1" style="color: #198754;">{{ Auth::user()->nama_lengkap ?? 'Petugas Lapangan' }}</h4>

        <span class="badge px-3 py-1 mb-4" style="border-radius: 20px; background-color: #D1E7DD; color: #0F5132;">{{ Auth::user()->peran ?? 'Petugas' }}</span>

        <div class="text-start border rounded p-3" style="background-color: #F5F1EB; border-color: #E6E0D5 !important;">
          <div class="mb-2">
            <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px;">EMAIL</small>
            <span class="fw-semibold text-dark">{{ Auth::user()->email ?? '-' }}</span>
          </div>
          <hr class="my-2" style="border-color: #E6E0D5;">
          <div class="mb-2">
            <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px;">NO. TELEPON</small>
            <span class="fw-semibold text-dark">{{ Auth::user()->no_telepon ?? '-' }}</span>
          </div>
          <hr class="my-2" style="border-color: #E6E0D5;">
          <div>
            <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px;">ZONA PENUGASAN</small>
            <span class="fw-semibold text-dark">{{ Auth::user()->zona->nama_zona ?? 'Semua Zona / Umum' }}</span>
          </div>
        </div>
      </div>

      <div class="modal-footer border-0 justify-content-center pb-4" style="background-color: #FDFBF7;">
        <button type="button" class="btn px-4 py-2 text-white" data-bs-dismiss="modal" style="border-radius: 8px; background-color: #198754;">Tutup</button>
      </div>
    </div>
  </div>
</div>
