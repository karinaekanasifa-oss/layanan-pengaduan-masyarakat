<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">
            <img src="{{ asset('template-masyarakat/assets/img/navbar-logo.svg') }}" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('/masyarakat/dashboard') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/masyarakat/dashboard#services') }}">Alur</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/masyarakat/dashboard#kategori') }}">Kategori</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/masyarakat/pengaduan') }}">Buat Pengaduan</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/masyarakat/riwayat') }}">Riwayat Saya</a></li>
            </ul>
        </div>
    </div>
</nav>
