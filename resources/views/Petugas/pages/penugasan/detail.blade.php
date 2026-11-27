@extends('Petugas.index')

@section('content')
    <!-- START: Page Header -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Detail & Update Penugasan</h1>
            <p class="page-subtitle">Periksa detail laporan warga dan perbarui status penanganan di lapangan.</p>
        </div>
        <a href="{{ route('petugas.penugasan') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <!-- END: Page Header -->

    <div class="row g-4">
        <!-- Informasi Detail Laporan -->
        <div class="col-12 col-lg-6">
            <div class="card border-light shadow-sm p-4 rounded-4 h-100">
                <h5 class="card-title fw-bold mb-4">Informasi Laporan Sampah</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted">ID Laporan:</span>
                        <span class="fw-semibold">#LPR-{{ $penugasan->id_laporan }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted">Pelapor:</span>
                        <span class="fw-semibold">{{ $penugasan->laporan->pelapor->nama_lengkap ?? 'Masyarakat' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted">Lokasi:</span>
                        <span class="fw-semibold text-end">{{ $penugasan->laporan->lokasi ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted">Jenis Sampah:</span>
                        <span><span class="badge bg-warning text-dark">{{ ucfirst($penugasan->laporan->jenis_sampah ?? '-') }}</span></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3">
                        <span class="text-muted">Ulasan / Keterangan:</span>
                        <span class="text-end">{{ $penugasan->laporan->ulasan_warga ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex flex-column py-3">
                        <span class="text-muted mb-2">Foto Kondisi Awal:</span>
                        <div>
                            @if ($penugasan->laporan->foto_kondisi_awal)
                                <img src="{{ asset('storage/' . $penugasan->laporan->foto_kondisi_awal) }}"
                                    alt="Foto Kondisi Awal"
                                    style="width: 200px; height: 150px; object-fit: cover; border-radius: 10px;">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </div>
                    </li>
                </ul>

                <!-- Riwayat Pengerjaan / Bukti Sebelumnya (Jika Ada) -->
                @if($penugasan->laporan->cleanupLogs->count() > 0)
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-1"></i> Riwayat Pengerjaan Sebelumnya</h6>
                        @foreach($penugasan->laporan->cleanupLogs as $log)
                            <div class="p-3 mb-3 bg-light rounded-3 border">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-secondary">{{ ucwords(str_replace('_', ' ', $log->status_perubahan)) }}</span>
                                    <small class="text-muted">{{ $log->waktu_pembaruan }}</small>
                                </div>
                                <p class="mb-2 small text-dark"><strong>Catatan:</strong> {{ $log->catatan_petugas ?? '-' }}</p>
                                @if($log->foto_bukti)
                                    <div>
                                        <small class="text-muted d-block mb-1">Foto Bukti:</small>
                                        <img src="{{ asset('storage/' . $log->foto_bukti) }}" alt="Foto Bukti" style="width: 120px; height: 90px; object-fit: cover; border-radius: 8px;">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Form Update Status & Upload Foto Bukti -->
        <div class="col-12 col-lg-6">
            <div class="card border-light shadow-sm p-4 rounded-4 h-100">
                <h5 class="card-title fw-bold mb-4">Form Perbarui Progres</h5>

                <form action="{{ route('petugas.penugasan.update', $penugasan->id_penugasan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Status Perubahan -->
                    <div class="mb-3">
                        <label for="status_perubahan" class="form-label fw-semibold">Status Penanganan <span class="text-danger">*</span></label>
                        @php
                            $logTerakhir = $penugasan->laporan->cleanupLogs->first();
                            $statusSaatIni = $logTerakhir ? $logTerakhir->status_perubahan : ($penugasan->laporan->status_laporan ?? 'ditugaskan');
                        @endphp
                        <select class="form-select" id="status_perubahan" name="status_perubahan" required>
                            <option value="ditugaskan" {{ $statusSaatIni == 'ditugaskan' ? 'selected' : '' }}>Ditugaskan</option>
                            <option value="sedang_dibersihkan" {{ $statusSaatIni == 'sedang_dibersihkan' ? 'selected' : '' }}>Sedang Dibersihkan</option>
                            <option value="selesai" {{ $statusSaatIni == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Upload Foto Bukti Setelah Dibersihkan -->
                    <div class="mb-3">
                        <label for="foto_bukti" class="form-label fw-semibold">Foto Bukti Baru / Pengerjaan</label>
                        <input type="file" class="form-control" id="foto_bukti" name="foto_bukti" accept="image/*">
                        <small class="text-muted">Unggah foto kondisi lokasi terbaru sesuai progres.</small>
                    </div>

                    <!-- Catatan Petugas -->
                    <div class="mb-4">
                        <label for="catatan_petugas" class="form-label fw-semibold">Catatan Petugas</label>
                        <textarea class="form-control" id="catatan_petugas" name="catatan_petugas" rows="3"
                            placeholder="Masukkan catatan atau keterangan tambahan..."></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
