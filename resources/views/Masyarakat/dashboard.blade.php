@extends('Masyarakat.index')

@section('content')
    <!-- Masthead / Banner Utama yang Lebih Elegan -->
    <header class="masthead" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('template-masyarakat/assets/img/header-bg.jpg') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="masthead-subheading text-light">Layanan Pengaduan Sampah Online</div>
            <div class="masthead-heading text-uppercase text-white">Bersih Lingkungan Kita, Sehat Bersama</div>
            <p class="text-white-50 mx-auto mb-5 lead" style="max-width: 700px;">
                Punya keluhan soal tumpukan sampah di lingkungan sekitarmu? Laporkan sekarang dan pantau langsung proses penanganannya secara transparan.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a class="btn btn-primary btn-xl text-uppercase shadow-sm px-5 py-3" href="{{ route('masyarakat.pengaduan') }}">
                    <i class="fas fa-bullhorn me-2"></i> Laporkan Sampah
                </a>
                <a class="btn btn-outline-light btn-xl text-uppercase px-4 py-3" href="{{ route('masyarakat.riwayat') }}">
                    <i class="fas fa-history me-2"></i> Cek Riwayat
                </a>
            </div>
        </div>
    </header>

    <!-- Statistik Transparansi Publik -->
    <section class="py-5 bg-light border-bottom">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm border-start border-primary border-4">
                        <h2 class="fw-bold text-primary mb-1">1,250+</h2>
                        <p class="text-muted text-uppercase small fw-bold mb-0">Laporan Selesai</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm border-start border-success border-4">
                        <h2 class="fw-bold text-success mb-1">15 Zona</h2>
                        <p class="text-muted text-uppercase small fw-bold mb-0">Wilayah Layanan Aktif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded shadow-sm border-start border-warning border-4">
                        <h2 class="fw-bold text-warning mb-1">&lt; 24 Jam</h2>
                        <p class="text-muted text-uppercase small fw-bold mb-0">Respon Cepat Petugas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pengaduan (Services) -->
    <section class="page-section bg-white" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Alur Pengaduan</h2>
                <h3 class="section-subheading text-muted">Tiga langkah mudah untuk menciptakan lingkungan yang bersih dan nyaman.</h3>
            </div>
            <div class="row text-center g-4">
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-light rounded shadow-sm">
                        <span class="fa-stack fa-4x mb-3">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-camera fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3 fw-bold">1. Foto & Laporkan</h4>
                        <p class="text-muted">Ambil foto kondisi tumpukan sampah di lokasimu, pilih zona wilayah, lalu isi formulir pengaduan dengan mudah tanpa ribet.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-light rounded shadow-sm">
                        <span class="fa-stack fa-4x mb-3">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-truck-fast fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3 fw-bold">2. Verifikasi & Tugas</h4>
                        <p class="text-muted">Admin akan memverifikasi laporanmu dan meneruskannya secara langsung kepada petugas kebersihan lapangan yang bertugas.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 h-100 bg-light rounded shadow-sm">
                        <span class="fa-stack fa-4x mb-3">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-check-circle fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3 fw-bold">3. Selesai & Bersih</h4>
                        <p class="text-muted">Petugas membersihkan lokasi dan mengunggah foto bukti penyelesaian. Kamu bisa melihat statusnya langsung di menu riwayat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Sampah (Portfolio Grid) -->
    <section class="page-section bg-light" id="kategori">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Kategori Sampah</h2>
                <h3 class="section-subheading text-muted">Kenali jenis sampah sebelum mengirimkan laporan pengaduan ke sistem.</h3>
            </div>
            <div class="row g-4">
                <!-- Kategori 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item bg-white rounded shadow-sm overflow-hidden h-100">
                        <img class="img-fluid w-100" src="{{ asset('template-masyarakat/assets/img/portfolio/1.jpg') }}" alt="Sampah Organik" style="height: 220px; object-fit: cover;" />
                        <div class="p-4 text-center">
                            <h5 class="fw-bold mb-2">Sampah Organik</h5>
                            <p class="text-muted small mb-0">Sisa makanan, dedaunan, ranting pohon, dan limbah rumah tangga hayati yang mudah terurai alami.</p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item bg-white rounded shadow-sm overflow-hidden h-100">
                        <img class="img-fluid w-100" src="{{ asset('template-masyarakat/assets/img/portfolio/2.jpg') }}" alt="Sampah Anorganik" style="height: 220px; object-fit: cover;" />
                        <div class="p-4 text-center">
                            <h5 class="fw-bold mb-2">Sampah Anorganik</h5>
                            <p class="text-muted small mb-0">Botol plastik, kaleng, kemasan sachet, kaca, dan limbah non-hayati yang sulit terurai.</p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item bg-white rounded shadow-sm overflow-hidden h-100">
                        <img class="img-fluid w-100" src="{{ asset('template-masyarakat/assets/img/portfolio/3.jpg') }}" alt="Sampah Campuran" style="height: 220px; object-fit: cover;" />
                        <div class="p-4 text-center">
                            <h5 class="fw-bold mb-2">Sampah Campuran</h5>
                            <p class="text-muted small mb-0">Tumpukan sampah liar di lahan kosong atau pinggir jalan yang bercampur baur berbagai jenis limbah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Layanan / Call to Action Section -->
    <section class="page-section bg-dark text-white text-center" id="about">
        <div class="container">
            <h2 class="section-heading text-uppercase text-white mb-3">Siap Menciptakan Lingkungan yang Bersih?</h2>
            <h3 class="section-subheading text-white-50 mb-4">Setiap laporan kecil dari kamu sangat berarti bagi kenyamanan bersama.</h3>
            <a class="btn btn-primary btn-xl text-uppercase px-5 py-3 shadow" href="{{ route('masyarakat.pengaduan') }}">
                Mulai Buat Pengaduan Sekarang
            </a>
        </div>
    </section>
@endsection
