<div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="{{ route('petugas.dashboard') }}" class="sidebar-brand">
      <i class="bi bi-trash3-fill"></i>
      <span>Pengaduan Sampah</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu Utama -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu Utama</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('petugas.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" id="menu-overview" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Operasional Lapangan -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Operasional Lapangan</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('petugas.penugasan') }}" class="sidebar-menu-link {{ request()->routeIs('petugas.penugasan*') ? 'active' : '' }}" title="Daftar Tugas Lapangan">
              <i class="bi bi-clipboard-check"></i>
              <span>Tugas Lapangan Saya</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset('template-admin-petugas/assets/images/avatar.png') }}" alt="Petugas Lapangan" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">{{ Auth::user()->nama_lengkap ?? 'Petugas Lapangan' }}</div>
        <div class="sidebar-profile-email">{{ Auth::user()->email ?? 'petugas@sampah.com' }}</div>
      </div>
    </div>
  </div>
