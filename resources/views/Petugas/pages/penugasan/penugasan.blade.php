@extends('Petugas.index')

@section('content')
    <!-- START: Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Daftar Tugas Lapangan</h1>
            <p class="page-subtitle">Kelola, pantau, dan perbarui status penanganan laporan sampah di zona wilayah tugasmu.
            </p>
        </div>
    </div>
    <!-- END: Page Header -->

    <!-- Form Filter Triwulan -->
    <form method="GET" action="{{ route('petugas.penugasan') }}" class="row g-3 mb-4">
        <div class="col-auto">
            <select name="filter_triwulan" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Triwulan (Jan - Des) --</option>
                <option value="Q1" {{ request('filter_triwulan') == 'Q1' ? 'selected' : '' }}>Q1 (Januari - Maret)
                </option>
                <option value="Q2" {{ request('filter_triwulan') == 'Q2' ? 'selected' : '' }}>Q2 (April - Juni)</option>
                <option value="Q3" {{ request('filter_triwulan') == 'Q3' ? 'selected' : '' }}>Q3 (Juli - September)
                </option>
                <option value="Q4" {{ request('filter_triwulan') == 'Q4' ? 'selected' : '' }}>Q4 (Oktober - Desember)
                </option>
            </select>
        </div>
    </form>

    <!-- START: Table Card -->
    <div class="card border-light shadow-sm p-4 rounded-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Laporan</th>
                        <th>Lokasi</th>
                        <th>Jenis Sampah</th>
                        <th>Estimasi Selesai</th>
                        <th>Status Penanganan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penugasans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold text-primary">#LPR-{{ $item->id_laporan }}</td>
                            <td>
                                <div class="fw-semibold">{{ $item->laporan->lokasi ?? '-' }}</div>
                                <small class="text-muted">{{ $item->laporan->zona->nama_zona ?? 'Zona Wilayah' }}</small>
                            </td>
                            <td>
                                <span
                                    class="badge bg-warning text-dark">{{ ucfirst($item->laporan->jenis_sampah ?? '-') }}</span>
                            </td>
                            <td>{{ $item->estimasi_selesai ?? '-' }}</td>
                            <td>
                                @php
                                    // Ambil status log terakhir yang diinput petugas
                                    $logTerakhir = $item->laporan->cleanupLogs->first();
                                    $statusTampil = $logTerakhir
                                        ? $logTerakhir->status_perubahan
                                        : $item->laporan->status_laporan ?? 'ditugaskan';

                                    // Atur warna badge berdasarkan status
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
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('petugas.penugasan.detail', $item->id_penugasan) }}"
                                        class="btn btn-sm btn-primary" title="Update Progres & Detail">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada tugas lapangan yang diberikan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Table Card -->
@endsection
