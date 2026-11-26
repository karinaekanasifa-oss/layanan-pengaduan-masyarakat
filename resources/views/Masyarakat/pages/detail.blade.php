@extends('Masyarakat.index')

@section('content')
    <header class="py-5 text-white" style="background: linear-gradient(135deg, #157347 0%, #198754 100%); padding-top: 9rem !important; padding-bottom: 4rem !important;">
        <div class="container text-center">
            <h2 class="section-heading text-uppercase fw-bold">Detail Pengaduan Sampah</h2>
            <p class="text-white-50 mb-0">Informasi lengkap status penanganan dan progres laporan Anda.</p>
        </div>
    </header>

    <section class="page-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow rounded-4 p-4 p-md-5">

                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div>
                                <span class="text-muted small">ID Laporan: #{{ $pengaduan->id_laporan }}</span>
                                <h5 class="fw-bold text-success mb-0">{{ $pengaduan->zona->nama_zona ?? '-' }}</h5>
                            </div>
                            <div>
                                @if($pengaduan->status_laporan == 'dibersihkan' || $pengaduan->status_laporan == 'selesai')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Selesai / Dibersihkan</span>
                                @elseif($pengaduan->status_laporan == 'ditugaskan')
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Ditugaskan ke Petugas</span>
                                @else
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu Verifikasi</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold text-uppercase small text-success">Lokasi / Alamat Lengkap</label>
                            <p class="text-dark mb-0">{{ $pengaduan->lokasi }}</p>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="fw-bold text-uppercase small text-success">Jenis Sampah</label>
                                <p class="mb-0"><span class="badge bg-secondary text-uppercase">{{ $pengaduan->jenis_sampah }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold text-uppercase small text-success">Tanggal Laporan</label>
                                <p class="text-dark mb-0">{{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold text-uppercase small text-success d-block mb-2">Foto Kondisi Awal</label>
                            @if($pengaduan->foto_kondisi_awal)
                                <img src="{{ asset('storage/' . $pengaduan->foto_kondisi_awal) }}" alt="Foto Awal" class="img-fluid rounded-4 shadow-sm" style="max-height: 300px; object-fit: cover;">
                            @else
                                <p class="text-muted">Tidak ada foto.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold text-uppercase small text-success">Ulasan / Catatan Warga</label>
                            <p class="text-dark p-3 bg-light rounded-3 mb-0">{{ $pengaduan->ulasan_warga ?? 'Tidak ada ulasan.' }}</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('masyarakat.riwayat') }}" class="btn btn-outline-secondary text-uppercase px-4 py-2 rounded-pill">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
