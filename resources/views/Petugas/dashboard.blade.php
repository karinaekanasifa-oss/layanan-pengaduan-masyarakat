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
        <!-- Card 1: Tugas Baru / Masuk -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-primary border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Tugas Baru / Masuk</span>
                        <h2 class="fw-bold mt-2 mb-0 text-dark">{{ $tugasBaru ?? 0 }}</h2>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                        <i class="bi bi-clipboard-plus fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Sedang Dibersihkan -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-warning border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Sedang Dibersihkan</span>
                        <h2 class="fw-bold mt-2 mb-0 text-dark">{{ $sedangDibersihkan ?? 0 }}</h2>
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
                        <h2 class="fw-bold mt-2 mb-0 text-dark">{{ $selesai ?? 0 }}</h2>
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
            <a href="{{ route('petugas.penugasan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Tugas</a>
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
                    @forelse ($recentTasks as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold text-primary">#LPR-{{ $item->id_laporan }}</td>
                            <td>
                                <div class="fw-semibold">{{ $item->laporan->lokasi ?? '-' }}</div>
                                <small class="text-muted">{{ $item->laporan->zona->nama_zona ?? 'Zona Wilayah' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ ucfirst($item->laporan->jenis_sampah ?? '-') }}</span>
                            </td>
                            <td>{{ $item->estimasi_selesai ?? '-' }}</td>
                            <td>
                                @php
                                    $logTerakhir = $item->laporan->cleanupLogs->first();
                                    $statusTampil = $logTerakhir
                                        ? $logTerakhir->status_perubahan
                                        : $item->laporan->status_laporan ?? 'ditugaskan';

                                    $badgeBg = 'bg-secondary';
                                    if ($statusTampil == 'ditugaskan') {
                                        $badgeBg = 'bg-secondary';
                                    } elseif ($statusTampil == 'sedang_dibersihkan') {
                                        $badgeBg = 'bg-warning text-dark';
                                    } elseif ($statusTampil == 'selesai') {
                                        $badgeBg = 'bg-success';
                                    }
                                @endphp
                                <span class="badge {{ $badgeBg }} px-2 py-1">
                                    {{ ucwords(str_replace('_', ' ', $statusTampil)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('petugas.penugasan.detail', $item->id_penugasan) }}" class="btn btn-sm btn-primary" title="Update Progres">
                                    <i class="bi bi-pencil-square"></i> Update
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada tugas penanganan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Recent Tasks Section -->
@endsection
