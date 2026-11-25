@extends('Masyarakat.index')

@section('content')
    <!-- Header Section for Page -->
    <header class="masthead-sub py-5"
        style="background-color: #212529; padding-top: 10rem !important; padding-bottom: 5rem !important;">
        <div class="container text-center text-white">
            <h2 class="section-heading text-uppercase">Formulir Pengaduan Sampah</h2>
            <h3 class="section-subheading text-muted text-white-50">Sampaikan aduanmu secara akurat agar segera
                ditindaklanjuti petugas kebersihan.</h3>
        </div>
    </header>

    <!-- Main Content Section: Form Pengaduan -->
    <section class="page-section" id="form-pengaduan">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4 p-md-5">

                        <!-- Form Pengaduan (Nanti action diarahkan ke Route store) -->
                        <form id="formPengaduan" action="#" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Zona -->
                            <div class="mb-4">
                                <label for="id_zona" class="form-label fw-bold text-uppercase small">Pilih Zona / Wilayah
                                    <span class="text-danger">*</span></label>
                                <select class="form-select py-3" id="id_zona" name="id_zona" required>
                                    <option value="">-- Pilih Zona Wilayah --</option>
                                    <!-- Looping data zona dari database nantinya -->
                                </select>
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-4">
                                <label for="lokasi" class="form-label fw-bold text-uppercase small">Lokasi / Alamat
                                    Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control py-3" id="lokasi" name="lokasi"
                                    placeholder="Contoh: Jl. Melati No. 12" required>
                            </div>

                            <!-- Jenis Sampah -->
                            <div class="mb-4">
                                <label for="jenis_sampah" class="form-label fw-bold text-uppercase small">Jenis Sampah <span
                                        class="text-danger">*</span></label>
                                <select class="form-select py-3" id="jenis_sampah" name="jenis_sampah" required>
                                    <option value="">-- Pilih Jenis Sampah --</option>
                                    <option value="organik">Organik</option>
                                    <option value="anorganik">Anorganik</option>
                                    <option value="campuran">Campuran</option>
                                </select>
                            </div>

                            <!-- Input File Foto (Sesuai gaya simling storage) -->
                            <div class="mb-4">
                                <label for="foto_kondisi_awal" class="form-label fw-bold text-uppercase small">Foto Kondisi
                                    Awal Sampah <span class="text-danger">*</span></label>
                                <input type="file" class="form-control py-3" id="foto_kondisi_awal"
                                    name="foto_kondisi_awal" required>
                            </div>

                            <!-- Ulasan -->
                            <div class="mb-4">
                                <label for="ulasan_warga" class="form-label fw-bold text-uppercase small">Ulasan /
                                    Keterangan Tambahan</label>
                                <textarea class="form-control" id="ulasan_warga" name="ulasan_warga" rows="4"
                                    placeholder="Keterangan tambahan..."></textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="{{ url('/masyarakat/dashboard') }}"
                                    class="btn btn-secondary text-uppercase px-4 py-3">Kembali</a>
                                <button type="submit" class="btn btn-primary text-uppercase px-5 py-3">Kirim
                                    Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
