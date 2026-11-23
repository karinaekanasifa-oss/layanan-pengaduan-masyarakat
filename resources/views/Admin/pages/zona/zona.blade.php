@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Zona Wilayah</h1>
            <p class="page-subtitle">Kelola master data zona wilayah atau kecamatan pengaduan sampah.</p>
        </div>
        <a href="{{ route('zona.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Zona
        </a>
    </div>
    <!-- END: Page Header Banner -->

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <!-- Header Controls -->
        <div class="table-header-control">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" id="searchZona" class="table-search-input" placeholder="Cari nama zona atau wilayah...">
            </div>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Zona</th>
                        <th>Deskripsi Wilayah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftarZona">
                    @foreach ($zones as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="table-product-name">{{ $item->nama_zona }}</td>
                            <td>{{ $item->deskripsi_wilayah ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('zona.edit', $item->id_zona) }}" class="table-btn-action" title="Edit Zona">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('zona.destroy', $item->id_zona) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-btn-action delete border-0 bg-transparent" title="Hapus Zona"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data zona ini?')">
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
