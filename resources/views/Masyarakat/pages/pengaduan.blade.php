@extends('Masyarakat.index')

@section('content')
    <header class="py-5 text-white" style="background: linear-gradient(135deg, #157347 0%, #198754 100%); padding-top: 9rem !important; padding-bottom: 4rem !important;">
        <div class="container text-center">
            <h2 class="section-heading text-uppercase fw-bold">Formulir Pengaduan Sampah</h2>
            <p class="text-white-50 mb-0">Sampaikan aduan lokasi penumpukan sampah agar segera ditindaklanjuti petugas zona terkait.</p>
        </div>
    </header>

    <section class="page-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow rounded-4 p-4 p-md-5">

                        <form action="{{ route('masyarakat.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Zona Wilayah (Relasi ke tabel Zones) -->
                            <div class="mb-4">
                                <label for="id_zona" class="form-label fw-bold text-uppercase small text-success">Pilih Zona / Wilayah <span class="text-danger">*</span></label>
                                <select class="form-select py-3 rounded-3" id="id_zona" name="id_zona" required>
                                    <option value="">-- Pilih Zona Wilayah --</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id_zona }}">{{ $zone->nama_zona }} - {{ $zone->deskripsi_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Lokasi Detail -->
                            <div class="mb-4">
                                <label for="lokasi" class="form-label fw-bold text-uppercase small text-success">Lokasi / Alamat Lengkap & Patokan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control py-3 rounded-3" id="lokasi" name="lokasi" placeholder="Contoh: Jl. Mawar No. 10, sebelah pos ronda" required>
                            </div>

                            <!-- Jenis Sampah -->
                            <div class="mb-4">
                                <label for="jenis_sampah" class="form-label fw-bold text-uppercase small text-success">Jenis Sampah <span class="text-danger">*</span></label>
                                <select class="form-select py-3 rounded-3" id="jenis_sampah" name="jenis_sampah" required>
                                    <option value="">-- Pilih Jenis Sampah --</option>
                                    <option value="organik">Organik (Sisa makanan, daun, dll)</option>
                                    <option value="b3">B3 (Bahan Berbahaya & Beracun / Medis)</option>
                                    <option value="campuran">Campuran (Limbah liar berbagai jenis)</option>
                                </select>
                            </div>

                            <!-- Upload Foto Kondisi Awal -->
                            <div class="mb-4">
                                <label for="foto_kondisi_awal" class="form-label fw-bold text-uppercase small text-success">Foto Kondisi Awal Sampah <span class="text-danger">*</span></label>
                                <input type="file" class="form-control py-3 rounded-3" id="foto_kondisi_awal" name="foto_kondisi_awal" accept="image/*" required>
                                <div class="form-text">Format yang diizinkan: JPG, JPEG, PNG.</div>
                            </div>

                            <!-- Ulasan Warga -->
                            <div class="mb-4">
                                <label for="ulasan_warga" class="form-label fw-bold text-uppercase small text-success">Catatan / Ulasan Warga</label>
                                <textarea class="form-control rounded-3" id="ulasan_warga" name="ulasan_warga" rows="4" placeholder="Tambahkan keterangan deskripsi atau akses jalan jika diperlukan..."></textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('masyarakat.dashboard') }}" class="btn btn-outline-secondary text-uppercase px-4 py-3 rounded-pill">Kembali</a>
                                <button type="submit" class="btn btn-success text-uppercase px-5 py-3 rounded-pill fw-bold shadow-sm">Kirim Laporan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
