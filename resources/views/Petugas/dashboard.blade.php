@extends('Petugas.index')

@section('content')
    <!-- START: Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Dashboard Petugas Lapangan</h1>
            <p class="page-subtitle">Selamat datang kembali! Pantau dan selesaikan tugas penanganan sampah di zona wilayahmu.</p>
        </div>
    </div>
    <!-- END: Page Header -->

    <!-- START: Statistics Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Tugas Ditugaskan (Baru) -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-primary border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Tugas Baru / Masuk</span>
                        <h2 class="fw-bold mt-2 mb-0 text-dark">3</h2>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                        <i class="bi bi-clipboard-plus fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Sedang Dikerjakan -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-warning border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Sedang Dibersihkan</span>
                        <h2 class="fw-bold mt-2 mb-0 text-dark">1</h2>
                    </div>
                    <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning">
                        <i class="bi bi-hourglass-split fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Selesai -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-success border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Tugas Selesai</span>
                        <h2 class="fw-bold mt-2 mb-0 text-dark">12</h2>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Statistics Cards Row -->

    <!-- START: Recent Tasks Section -->
    <div class="card border-light shadow-sm p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold m-0">Tugas Penanganan Terbaru</h5>
            <a href="{{ route('petugas.penugasan') ?? '#' }}" class="btn btn-sm btn-outline-primary">Lihat Semua Tugas</a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Laporan</th>
                        <th>Lokasi</th>
                        <th>Jenis Sampah</th>
                        <th>Estimasi Selesai</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh baris data dummy tugas -->
                    <tr>
                        <td>1</td>
                        <td class="fw-semibold text-primary">#LPR-001</td>
                        <td>Jl. Merdeka No. 10, Zona A</td>
                        <td><span class="badge bg-warning text-dark">Organik</span></td>
                        <td>2026-11-28 14:00</td>
                        <td><span class="badge bg-secondary">Ditugaskan</span></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-primary" title="Update Progres">
                                <i class="bi bi-pencil-square"></i> Update
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Recent Tasks Section -->
@endsection
@auth
<!-- Modal Pop-up Profil Petugas -->
<div class="modal fade" id="modalProfilPetugas" tabindex="-1" aria-labelledby="modalProfilPetugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white border-0">
                <h5 class="modal-title fw-bold" id="modalProfilPetugasLabel">
                    <i class="bi bi-person-circle me-2"></i> Profil Petugas Lapangan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 75px; height: 75px;">
                        <i class="bi bi-person fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">{{ Auth::user()->nama_lengkap }}</h5>
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
                        <span class="text-muted small fw-bold text-uppercase">Zona Penugasan</span>
                        <span class="fw-semibold text-dark">{{ Auth::user()->zona->nama_zona ?? 'Semua Zona / Umum' }}</span>
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
