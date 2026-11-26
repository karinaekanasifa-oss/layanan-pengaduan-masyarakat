@extends('Admin.index')

@section('content')
    <!-- START: Dashboard Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Sistem Informasi Layanan Pengaduan Masyarakat &amp; Pengelolaan Sampah.</p>
      </div>
      <button class="btn-date-picker" type="button" id="date-picker-trigger">
        <i class="bi bi-calendar4-event"></i>
        <span id="selected-date-range">January 12, 2026 - January 23, 2026</span>
        <i class="bi bi-chevron-down ms-1"></i>
      </button>
    </div>
    <!-- END: Dashboard Header Banner -->

    <!-- START: Main Layout Grid (2 Columns: Dashboard + Performance Pane) -->
    <div class="row g-4">

      <!-- TOP AREA: Quick Info Stat Cards Row (Full Width) -->
      <div class="col-12">
        <div class="row g-4">
          <!-- Stat Card 1: Green Alert Banner -->
          <div class="col-md-4">
            <div class="card alert-green-card">
              <div class="position-relative z-index-2">
                <span class="alert-green-badge">Update</span>
                <div class="alert-green-date">Feb 14th 2026</div>
                <div class="alert-green-text">Total Laporan Masuk Meningkat Pesat</div>
              </div>
              <a href="{{ route('laporan.index') }}" class="alert-green-link z-index-2" id="alert-link-statistics">
                <span>Kelola Laporan</span>
                <i class="bi bi-arrow-right"></i>
              </a>

              <!-- Inline SVG geometric decoration -->
              <svg class="alert-green-bg-shape" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(50,50)">
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(60)" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(120)" />
                </g>
              </svg>
            </div>
          </div>

          <!-- Stat Card 2: Total Laporan -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Total Laporan</span>
                  <div class="dropdown">
                    <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                      aria-label="More Options" id="btn-more-income">
                      <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                      <li><a class="dropdown-item" href="{{ route('laporan.index') }}"><i class="bi bi-arrow-repeat"></i> Refresh</a></li>
                    </ul>
                  </div>
                </div>
                <div class="stat-value">{{ $totalLaporan ?? 0 }}</div>
                <div class="trend-badge trend-up">
                  <i class="bi bi-file-earmark-text"></i>
                  <span>Laporan masyarakat</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="income-sparkline"></div>
              </div>
            </div>
          </div>

          <!-- Stat Card 3: Total Zona & Pengguna -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Zona &amp; Pengguna</span>
                  <div class="dropdown">
                    <button class="card-more-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                      aria-label="More Options" id="btn-more-return">
                      <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                      <li><a class="dropdown-item" href="{{ route('zona.index') }}"><i class="bi bi-map"></i> Zona Wilayah</a></li>
                      <li><a class="dropdown-item" href="{{ route('pengguna.index') }}"><i class="bi bi-people"></i> Data Pengguna</a></li>
                    </ul>
                  </div>
                </div>
                <div class="stat-value">{{ $totalZona ?? 0 }} Zona</div>
                <div class="trend-badge trend-up">
                  <i class="bi bi-people-fill"></i>
                  <span>{{ $totalPengguna ?? 0 }} Pengguna Terdaftar</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="return-sparkline"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: TOP AREA -->

      <!-- LEFT AREA: Primary Dashboard Stats & Tables -->
      <div class="col-xl-9 col-lg-8">

        <!-- START: Details Area -->
        <div class="row g-4">
          <!-- Column: Laporan Terbaru / Tabel Ringkasan -->
          <div class="col-12">
            <div class="card mb-0">
              <div class="card-header mb-2">
                <h2 class="card-title">Laporan Sampah Terbaru</h2>
                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Pelapor</th>
                      <th>Zona</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($laporanTerbaru ?? [] as $laporan)
                      <tr>
                        <!-- Diperbaiki dari name menjadi nama_lengkap sesuai kolom database User -->
                        <td>{{ $laporan->pelapor->nama_lengkap ?? 'Masyarakat' }}</td>
                        <td>{{ $laporan->zona->nama_zona ?? '-' }}</td>
                        <!-- Diperbaiki dari deskripsi menjadi ulasan_warga atau lokasi -->
                        <td>{{ Str::limit($laporan->ulasan_warga ?? $laporan->lokasi ?? '-', 40) }}</td>
                        <td>{{ $laporan->dibuat_pada ?? $laporan->created_at }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center text-muted py-3">Belum ada data laporan masuk.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Details Area -->

      </div>

      <!-- RIGHT AREA: Performance Details Sidebar Panel -->
      <div class="col-xl-3 col-lg-4">
        <div class="right-panel-wrapper d-flex flex-column gap-4 h-100">

          <!-- Level Up Promotion CTA banner -->
          <div class="promo-banner-card">
            <svg class="promo-banner-bg-shape" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(50,50)">
                <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" />
                <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(60)" />
                <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(120)" />
              </g>
            </svg>

            <h3 class="promo-title">Kelola Sampah dengan Cepat dan Presisi.</h3>
            <p class="promo-desc">Pantau wilayah zona dan penugasan petugas kebersihan secara real-time.</p>
            <a href="{{ route('penugasan.index') }}" class="btn-promo text-decoration-none text-center d-block">Kelola Penugasan</a>
          </div>
        </div>
      </div>
      <!-- END: RIGHT AREA -->

    </div>
    <!-- END: Main Layout Grid -->

@endsection
