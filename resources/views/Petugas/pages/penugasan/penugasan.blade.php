@extends('Petugas.index')

@section('content')
    <!-- START: Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Daftar Tugas Lapangan</h1>
            <p class="page-subtitle">Kelola, pantau, dan perbarui status penanganan laporan sampah di zona wilayah tugasmu.</p>
        </div>
    </div>
    <!-- END: Page Header -->

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
                                <span class="badge bg-warning text-dark">{{ ucfirst($item->laporan->jenis_sampah ?? '-') }}</span>
                            </td>
                            <td>{{ $item->estimasi_selesai ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary px-2 py-1">{{ ucfirst($item->laporan->status_laporan ?? 'Ditugaskan') }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('petugas.penugasan.detail', $item->id_penugasan) }}" class="btn btn-sm btn-primary" title="Update Progres & Detail">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada tugas lapangan yang diberikan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Table Card -->
@endsection
