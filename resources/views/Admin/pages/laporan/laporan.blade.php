@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Laporan Pengaduan Sampah</h1>
            <p class="page-subtitle">Verifikasi dan pantau laporan masuk dari masyarakat.</p>
        </div>
    </div>
    <!-- END: Page Header Banner -->

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <div class="table-header-control">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" id="searchLaporan" class="table-search-input" placeholder="Cari lokasi atau jenis sampah...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Laporan</th>
                        <th>Pelapor</th>
                        <th>Lokasi & Zona</th>
                        <th>Jenis Sampah</th>
                        <th>Foto Awal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftarLaporan">
                    @foreach ($waste_reports as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="table-order-id">#LPR-{{ $item->id_laporan }}</td>
                            <td>{{ $item->pelapor->nama_lengkap ?? 'Masyarakat' }}</td>
                            <td>
                                <strong>{{ $item->lokasi }}</strong><br>
                                <small class="text-muted">Zona: {{ $item->zona->nama_zona ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($item->jenis_sampah) }}</span>
                            </td>
                            <td>
                                @if($item->foto_kondisi_awal)
                                    <a href="{{ asset('storage/' . $item->foto_kondisi_awal) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->foto_kondisi_awal) }}" alt="Foto" width="50" class="rounded">
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-table {{ $item->status_laporan == 'dibersihkan' ? 'success' : ($item->status_laporan == 'ditugaskan' ? 'pending' : 'failed') }}">
                                    {{ ucfirst($item->status_laporan) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('laporan.show', $item->id_laporan) }}" class="table-btn-action" title="Lihat Detail & Verifikasi">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Basic Table Card Container -->
@endsection
