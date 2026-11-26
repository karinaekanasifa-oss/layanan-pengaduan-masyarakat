<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" id="mainNav" style="background-color: #157347;">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase d-flex align-items-center gap-2" href="{{ route('masyarakat.dashboard') }}">
            <i class="fas fa-leaf"></i> Pengaduan Sampah
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('masyarakat.dashboard') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('masyarakat.dashboard') }}#services">Alur</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('masyarakat.dashboard') }}#kategori">Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('masyarakat.pengaduan') }}">Buat Pengaduan</a></li>

                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('masyarakat.riwayat') }}">Riwayat Saya</a></li>

                    <!-- Dropdown Profil & Logout -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-light text-success fw-bold rounded-pill px-3 py-2 text-capitalize d-flex align-items-center gap-2 shadow-sm"
                           href="#" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span>Halo, {{ Auth::user()->nama_lengkap }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2" aria-labelledby="navbarDropdownProfil" style="min-width: 240px;">
                            <li class="px-3 py-2 border-bottom">
                                <div class="fw-bold text-dark text-capitalize">{{ Auth::user()->nama_lengkap }}</div>
                                <small class="text-muted text-lowercase d-block">{{ Auth::user()->email }}</small>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill mt-1">
                                    {{ Auth::user()->peran }}
                                </span>
                            </li>
                            <li class="mt-1">
                                <a class="dropdown-item rounded-3 py-2 text-capitalize" href="#" data-bs-toggle="modal" data-bs-target="#modalProfilWarga">
                                    <i class="fas fa-id-card text-success me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-bold text-capitalize">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Jika Belum Login -->
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-light text-success fw-bold btn-sm rounded-pill px-4 py-2 shadow-sm" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk / Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@auth
<!-- Modal Pop-up Profil Saya -->
<div class="modal fade" id="modalProfilWarga" tabindex="-1" aria-labelledby="modalProfilWargaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white border-0">
                <h5 class="modal-title fw-bold" id="modalProfilWargaLabel">
                    <i class="fas fa-user-circle me-2"></i> Profil Akun Warga
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 75px; height: 75px;">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-0">{{ Auth::user()->nama_lengkap }}</h5>
                    <span class="badge bg-success rounded-pill px-3 mt-1">{{ Auth::user()->peran }}</span>
                </div>
                <ul class="list-group list-group-flush rounded-3 border">
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted small fw-bold text-uppercase">Email</span>
                        <span class="fw-semibold text-dark">{{ Auth::user()->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted small fw-bold text-uppercase">No. Telepon</span>
                        <span class="fw-semibold text-dark">{{ Auth::user()->no_telepon ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted small fw-bold text-uppercase">Zona Domisili</span>
                        <span class="fw-semibold text-dark">{{ Auth::user()->zona->nama_zona ?? 'Belum dipilih' }}</span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endauth
