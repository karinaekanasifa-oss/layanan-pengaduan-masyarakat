@extends('Masyarakat.index')

@section('content')
    <header class="py-5 text-white"
        style="background: linear-gradient(135deg, #157347 0%, #198754 100%); padding-top: 9rem !important; padding-bottom: 4rem !important;">
        <div class="container text-center">
            <h2 class="section-heading text-uppercase fw-bold">Riwayat Pengaduan Saya</h2>
            <p class="text-white-50 mb-0">Pantau progres penanganan dan status pembersihan laporan sampah yang telah dikirim.
            </p>
        </div>
    </header>

    <section class="page-section py-5">
        <div class="container">
            <div class="card border-0 shadow rounded-4 p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-success text-dark">
                            <tr>
                                <th class="py-3">No.</th>
                                <th class="py-3">Tanggal / Waktu</th>
                                <th class="py-3">Zona & Lokasi</th>
                                <th class="py-3">Jenis Sampah</th>
                                <th class="py-3">Foto Awal</th>
                                <th class="py-3 text-center">Status Laporan</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengaduans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td>
                                    <td>
                                        <strong>{{ $item->zona->nama_zona ?? 'Zona Umum' }}</strong><br>
                                        <small class="text-muted">{{ $item->lokasi }}</small>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $item->jenis_sampah == 'b3' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                            {{ strtoupper($item->jenis_sampah) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->foto_kondisi_awal)
                                            <!-- Pemanggilan Simling Storage -->
                                            <img src="{{ asset('storage/' . $item->foto_kondisi_awal) }}" alt="Foto Sampah"
                                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 10px;">
                                        @else
                                            <span class="text-muted small">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status_laporan == 'dibersihkan' || $item->status_laporan == 'selesai')
                                            <span class="badge bg-success px-3 py-2 rounded-pill">Selesai /
                                                Dibersihkan</span>
                                        @elseif($item->status_laporan == 'ditugaskan')
                                            <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Ditugaskan ke
                                                Petugas</span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu
                                                Verifikasi</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('masyarakat.show', $item->id_laporan) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat pengaduan
                                        sampah yang dikirim.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('masyarakat.dashboard') }}"
                        class="btn btn-outline-secondary text-uppercase px-4 rounded-pill">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>
@endsection
