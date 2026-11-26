@extends('Masyarakat.index')

@section('content')
    <!-- Masthead / Banner Utama Hijau Segar -->
    <header class="masthead text-white text-center py-5" style="background: linear-gradient(135deg, #157347 0%, #198754 50%, #20c997 100%); padding-top: 10rem !important; padding-bottom: 8rem !important;">
        <div class="container px-4">
            @auth
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold shadow-sm fs-6">
                        👋 Selamat datang kembali, {{ Auth::user()->nama_lengkap }}!
                    </span>
                </div>
            @endauth
            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                <i class="fas fa-leaf me-1"></i> Portal Resmi Layanan Warga
            </span>
            <h1 class="display-4 fw-bold text-uppercase mb-3">Sistem Informasi Layanan Pengaduan Sampah</h1>
            <p class="lead text-white-50 mx-auto mb-5" style="max-width: 700px;">
                Wujudkan lingkungan bersih, sehat, dan asri di wilayah kita. Laporkan penumpukan sampah liar dan pantau langsung penanganannya secara transparan.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a class="btn btn-light btn-lg text-success fw-bold px-5 py-3 shadow-sm rounded-pill text-uppercase" href="{{ route('masyarakat.pengaduan') }}">
                    <i class="fas fa-camera-retro me-2"></i> Buat Pengaduan Sekarang
                </a>
                <a class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill text-uppercase" href="{{ route('masyarakat.riwayat') }}">
                    <i class="fas fa-clipboard-list me-2"></i> Pantau Progres Warga
                </a>
            </div>
        </div>
    </header>

    <!-- Statistik Ringkas Warga -->
    <section class="py-5 bg-light border-bottom">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm border-top border-success border-4">
                        <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                        <h3 class="fw-bold text-dark mb-1">Transparan</h3>
                        <p class="text-muted small mb-0">Pantau status laporan dari ditugaskan hingga selesai dibersihkan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm border-top border-success border-4">
                        <i class="fas fa-map-marked-alt text-success fa-2x mb-2"></i>
                        <h3 class="fw-bold text-dark mb-1">Berbasis Zona</h3>
                        <p class="text-muted small mb-0">Penanganan langsung ditangani petugas kebersihan sesuai zona wilayah.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm border-top border-success border-4">
                        <i class="fas fa-star text-success fa-2x mb-2"></i>
                        <h3 class="fw-bold text-dark mb-1">Ulasan Warga</h3>
                        <p class="text-muted small mb-0">Berikan penilaian dan ulasan terhadap hasil kerja petugas di lapangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Layanan Sesuai Soal & ERD -->
    <section class="page-section py-5" id="services">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-heading text-uppercase fw-bold text-success">Alur Layanan Pengaduan</h2>
                <h3 class="section-subheading text-muted">Langkah mudah warga berpartisipasi menjaga kebersihan lingkungan.</h3>
            </div>
            <div class="row text-center g-4">
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-white rounded-4 shadow-sm border">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-edit fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">1. Registrasi & Lapor</h4>
                        <p class="text-muted">Masuk ke sistem, isi lokasi detail, pilih zona wilayah, tentukan jenis sampah, dan unggah foto kondisi awal.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-white rounded-4 shadow-sm border">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">2. Verifikasi & Tugas</h4>
                        <p class="text-muted">Admin mendinas/mengelola verifikasi laporan dan menugaskan Petugas Kebersihan lapangan secara spesifik.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-white rounded-4 shadow-sm border">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-check-double fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">3. Pembersihan & Selesai</h4>
                        <p class="text-muted">Petugas membersihkan lokasi, mengunggah foto bukti kerja, dan warga dapat memberikan ulasan hasil penanganan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Jenis Sampah (Sesuai ERD: organik, b3, campuran) -->
    <section class="page-section bg-light py-5" id="kategori">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-heading text-uppercase fw-bold text-success">Jenis Kategori Sampah</h2>
                <h3 class="section-subheading text-muted">Sesuaikan kategori sampah saat mengirimkan laporan pengaduan.</h3>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-success text-white p-3 text-center fw-bold text-uppercase">Organik</div>
                        <div class="card-body p-4 text-center">
                            <p class="text-muted mb-0">Limbah rumah tangga, sisa makanan, dedaunan, dan material alami yang mudah terurai oleh alam.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-warning text-dark p-3 text-center fw-bold text-uppercase">B3 (Bahan Berbahaya & Beracun)</div>
                        <div class="card-body p-4 text-center">
                            <p class="text-muted mb-0">Limbah medis, baterai bekas, wadah pestisida, elektronik rusak, dan bahan kimia beracun lainnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-secondary text-white p-3 text-center fw-bold text-uppercase">Campuran</div>
                        <div class="card-body p-4 text-center">
                            <p class="text-muted mb-0">Tumpukan sampah liar di pinggir jalan atau lahan kosong yang terdiri dari berbagai macam jenis limbah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
