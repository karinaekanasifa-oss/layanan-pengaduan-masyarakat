@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Laporan #LPR-{{ $laporan->id_laporan }}</h1>
            <p class="page-subtitle">Informasi lengkap laporan pengaduan sampah dari masyarakat.</p>
        </div>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <!-- END: Page Header Banner -->

    <div class="row g-4 mb-4">
        <!-- Informasi Detail Laporan -->
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Informasi Pengaduan</h5>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Nama Pelapor:</strong>
                        <span>{{ $laporan->pelapor->nama_lengkap ?? 'Masyarakat' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Zona Wilayah:</strong>
                        <span>{{ $laporan->zona->nama_zona ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Jenis Sampah:</strong>
                        <span class="badge bg-secondary">{{ ucfirst($laporan->jenis_sampah) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Lokasi Kejadian:</strong>
                        <span>{{ $laporan->lokasi }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Status Saat Ini:</strong>
                        <span class="badge-table {{ $laporan->status_laporan == 'dibersihkan' ? 'success' : ($laporan->status_laporan == 'ditugaskan' ? 'pending' : 'failed') }}">
                            {{ ucfirst($laporan->status_laporan) }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <strong>Waktu Dibuat:</strong>
                        <span>{{ $laporan->dibuat_pada }}</span>
                    </li>
                </ul>

                <div class="mb-3">
                    <strong class="d-block mb-2">Ulasan / Keterangan Warga:</strong>
                    <div class="p-3 bg-light rounded text-muted">
                        {{ $laporan->ulasan_warga ?? 'Tidak ada ulasan tambahan.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto Kondisi Awal & Aksi Verifikasi -->
        <div class="col-12 col-lg-4">
            <div class="card border-light shadow-sm p-4 mb-4">
                <h5 class="card-title mb-3">Foto Kondisi Awal</h5>
                @if($laporan->foto_kondisi_awal)
                    <div class="text-center">
                        <a href="{{ asset('storage/' . $laporan->foto_kondisi_awal) }}" target="_blank">
                            <img src="{{ asset('storage/' . $laporan->foto_kondisi_awal) }}" alt="Foto Kondisi Awal" class="img-fluid rounded border shadow-sm">
                        </a>
                        <small class="text-muted d-block mt-2">Klik gambar untuk memperbesar</small>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">Tidak ada foto yang diunggah.</p>
                @endif
            </div>

            <!-- Form Aksi / Penugasan Cepat jika diperlukan -->
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-3">Tindakan Admin</h5>
                <p class="text-muted small">Laporan ini dapat langsung diarahkan ke menu penugasan atau diperbarui statusnya.</p>
                <a href="{{ route('penugasan.create') }}" class="btn btn-primary w-100">
                    <i class="bi bi-clipboard-check"></i> Buat Penugasan Petugas
                </a>
            </div>
        </div>
    </div>
@endsection
