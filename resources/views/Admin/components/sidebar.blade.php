<div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span>Pengaduan Sampah</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu Utama -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu Utama</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" id="menu-overview" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Master Data & Kelola -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Manajemen Data</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('zona.index') }}" class="sidebar-menu-link {{ request()->routeIs('zona*') ? 'active' : '' }}" title="Kelola Zona">
              <i class="bi bi-map"></i>
              <span>Zona Wilayah</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('pengguna.index') }}" class="sidebar-menu-link {{ request()->routeIs('pengguna*') ? 'active' : '' }}" title="Kelola Pengguna">
              <i class="bi bi-people"></i>
              <span>Data Pengguna / Petugas</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('laporan.index') }}" class="sidebar-menu-link {{ request()->routeIs('laporan*') ? 'active' : '' }}" title="Verifikasi Laporan">
              <i class="bi bi-file-earmark-text"></i>
              <span>Laporan Sampah</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('penugasan.index') }}" class="sidebar-menu-link {{ request()->routeIs('penugasan*') ? 'active' : '' }}" title="Penugasan Petugas">
              <i class="bi bi-clipboard-check"></i>
              <span>Penugasan Laporan</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset('template-admin-petugas/assets/images/avatar.png') }}" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Admin Dinas</div>
        <div class="sidebar-profile-email">admin@sampah.com</div>
      </div>
    </div>
  </div>
