@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Update Zona Wilayah</h1>
            <p class="page-subtitle">Perbarui informasi zona atau cakupan wilayah.</p>
        </div>
    </div>
    <!-- END: Page Header Banner -->

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Form Edit Zona</h5>

                <form id="formUpdate" action="{{ route('zona.update', $zona->id_zona) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="zonaId" value="{{ $zona->id_zona }}">

                    <!-- Nama Zona -->
                    <div class="mb-3">
                        <label for="nama_zona" class="form-label-custom">
                            Nama Zona / Kecamatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control-custom" id="nama_zona" name="nama_zona"
                            value="{{ $zona->nama_zona }}" placeholder="Contoh: Zona Utara" required>
                    </div>

                    <!-- Deskripsi Wilayah -->
                    <div class="mb-4">
                        <label for="deskripsi_wilayah" class="form-label-custom">
                            Deskripsi Wilayah
                        </label>
                        <textarea class="form-control-custom" id="deskripsi_wilayah" name="deskripsi_wilayah" rows="3"
                            placeholder="Masukkan keterangan cakupan wilayah...">{{ $zona->deskripsi_wilayah }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('zona.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            Update Zona
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
