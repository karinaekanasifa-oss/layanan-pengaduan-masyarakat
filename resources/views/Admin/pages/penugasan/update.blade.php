@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Update Penugasan</h1>
            <p class="page-subtitle">Perbarui data penugasan laporan petugas.</p>
        </div>
    </div>
    <!-- END: Page Header Banner -->

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Form Edit Penugasan</h5>

                <form id="formUpdate" action="{{ route('penugasan.update', $penugasan->id_penugasan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Laporan -->
                    <div class="mb-3">
                        <label for="id_laporan" class="form-label-custom">
                            Pilih Laporan Sampah <span class="text-danger">*</span>
                        </label>
                        <select class="form-control-custom" id="id_laporan" name="id_laporan" required>
                            @foreach ($waste_reports as $report)
                                <option value="{{ $report->id_laporan }}" {{ $penugasan->id_laporan == $report->id_laporan ? 'selected' : '' }}>
                                    #LPR-{{ $report->id_laporan }} - {{ $report->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Petugas Kebersihan -->
                    <div class="mb-3">
                        <label for="id_petugas" class="form-label-custom">
                            Pilih Petugas Kebersihan <span class="text-danger">*</span>
                        </label>
                        <select class="form-control-custom" id="id_petugas" name="id_petugas" required>
                            @foreach ($petugas_list as $petugas)
                                <option value="{{ $petugas->id_pengguna }}" {{ $penugasan->id_petugas == $petugas->id_pengguna ? 'selected' : '' }}>
                                    {{ $petugas->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estimasi Selesai -->
                    <div class="mb-3">
                        <label for="estimasi_selesai" class="form-label-custom">
                            Estimasi Selesai
                        </label>
                        <input type="datetime-local" class="form-control-custom" id="estimasi_selesai" name="estimasi_selesai"
                            value="{{ $penugasan->estimasi_selesai ? date('Y-m-d\TH:i', strtotime($penugasan->estimasi_selesai)) : '' }}">
                    </div>

                    <!-- Catatan Admin -->
                    <div class="mb-4">
                        <label for="catatan_admin" class="form-label-custom">
                            Catatan dari Admin
                        </label>
                        <textarea class="form-control-custom" id="catatan_admin" name="catatan_admin" rows="3">{{ $penugasan->catatan_admin }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('penugasan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            Update Penugasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
