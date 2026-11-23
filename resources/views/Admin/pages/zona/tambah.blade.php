@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Zona Wilayah</h1>
            <p class="page-subtitle">Tambahkan informasi zona atau kecamatan baru ke dalam sistem.</p>
        </div>
    </div>
    <!-- END: Page Header Banner -->

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Form Data Zona</h5>

                <form id="formTambah" action="{{ route('zona.store') }}" method="POST">
                    @csrf

                    <!-- Nama Zona -->
                    <div class="mb-3">
                        <label for="nama_zona" class="form-label-custom">
                            Nama Zona / Kecamatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control-custom" id="nama_zona" name="nama_zona"
                            placeholder="Contoh: Zona Utara - Kecamatan Banjarsari" required>
                    </div>

                    <!-- Deskripsi Wilayah -->
                    <div class="mb-4">
                        <label for="deskripsi_wilayah" class="form-label-custom">
                            Deskripsi Wilayah
                        </label>
                        <textarea class="form-control-custom" id="deskripsi_wilayah" name="deskripsi_wilayah" rows="3"
                            placeholder="Contoh: Meliputi area kelurahan Kadipiro, Nusukan, dan sekitarnya..."></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('zona.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Zona
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
