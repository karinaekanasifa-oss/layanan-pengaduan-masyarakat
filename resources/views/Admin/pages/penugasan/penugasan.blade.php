@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Penugasan Laporan</h1>
            <p class="page-subtitle">Daftar penugasan penanganan laporan sampah kepada petugas kebersihan.</p>
        </div>
        <a href="{{ route('penugasan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Buat Penugasan Baru
        </a>
    </div>
    <!-- END: Page Header Banner -->

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <div class="table-header-control">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" id="searchPenugasan" class="table-search-input" placeholder="Cari penugasan atau petugas...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Laporan</th>
                        <th>Petugas Kebersihan</th>
                        <th>Waktu Ditugaskan</th>
                        <th>Estimasi Selesai</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftarPenugasan">
                    @foreach ($penugasans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="table-order-id">#LPR-{{ $item->id_laporan }}</td>
                            <td>{{ $item->petugas->nama_lengkap ?? '-' }}</td>
                            <td>{{ $item->waktu_ditugaskan }}</td>
                            <td>{{ $item->estimasi_selesai ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('penugasan.edit', $item->id_penugasan) }}" class="table-btn-action" title="Edit Penugasan">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('penugasan.destroy', $item->id_penugasan) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-btn-action delete border-0 bg-transparent" title="Hapus Penugasan"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus penugasan ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
