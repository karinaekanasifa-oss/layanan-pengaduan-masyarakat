@extends('Admin.index')

@section('content')
    <style>
        @media print {
            header.navbar-custom,
            .sidebar-wrapper,
            .page-header.d-print-none,
            .card.border-light.shadow-sm,
            nav {
                display: none !important;
            }
            body {
                background-color: white !important;
            }
        }
    </style>

    <!-- START: Page Header Banner -->
    <div class="page-header d-print-none">
        <div>
            <h1 class="page-title">Rekapitulasi Laporan Penanganan Sampah</h1>
            <p class="page-subtitle">Laporan rekapitulasi data pengaduan dan penanganan sampah masyarakat.</p>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Cetak / Print Rekapitulasi
            </button>
        </div>
    </div>
    <!-- END: Page Header Banner -->

    <!-- START: Filter & Summary Card (Hidden when printing) -->
    <div class="card border-light shadow-sm p-4 mb-4 d-print-none">
        <h5 class="card-title mb-3">Filter Rekapitulasi</h5>
        <form action="{{ route('laporan.rekapitulasi') }}" method="GET" class="row g-3">
            <div class="col-12 col-md-4">
                <label for="tanggal_mulai" class="form-label-custom">Dari Tanggal</label>
                <input type="date" class="form-control-custom" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-12 col-md-4">
                <label for="tanggal_selesai" class="form-label-custom">Sampai Tanggal</label>
                <input type="date" class="form-control-custom" id="tanggal_selesai" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-12 col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">
                    <i class="bi bi-filter">*</i> Tampilkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- START: Print Header (Visible only when printing) -->
    <div class="text-center mb-4 d-none d-print-block">
        <h3>PEMERINTAH KOTA / DINAS KEBERSIHAN LINGKUNGAN</h3>
        <h4>LAPORAN REKAPITULASI PENANGANAN SAMPAH MASYARAKAT</h4>
        <p class="text-muted">Dicetak pada: {{ date('d-m-Y H:i') }}</p>
        <hr>
    </div>

    <!-- START: Table Rekapitulasi -->
    <div class="table-card-custom">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Laporan</th>
                        <th>Tanggal Masuk</th>
                        <th>Zona Wilayah</th>
                        <th>Lokasi</th>
                        <th>Jenis Sampah</th>
                        <th>Status Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($waste_reports as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="table-order-id">#LPR-{{ $item->id_laporan }}</td>
                            <td>{{ $item->dibuat_pada }}</td>
                            <td>{{ $item->zona->nama_zona ?? '-' }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ ucfirst($item->jenis_sampah) }}</td>
                            <td>
                                <span class="badge-table {{ $item->status_laporan == 'dibersihkan' ? 'success' : ($item->status_laporan == 'ditugaskan' ? 'pending' : 'failed') }}">
                                    {{ ucfirst($item->status_laporan) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data rekapitulasi laporan untuk rentang waktu ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Table Rekapitulasi -->

    <!-- Tanda Tangan untuk Cetak (Muncul saat print) -->
    <div class="row mt-5 d-none d-print-flex justify-content-end text-center">
        <div class="col-4 ms-auto">
            <p class="mb-5">Mengetahui,<br><strong>Kepala Dinas Kebersihan</strong></p>
            <br><br>
            <p class="mb-0"><strong>( ________________________________ )</strong></p>
            <p class="mt-1">NIP. ....................................................</p>
        </div>
    </div>
@endsection
