@extends('Admin.index')

@section('content')
    <!-- START: Page Header Banner -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Manajemen Data Pengguna</h1>
            <p class="page-subtitle">Kelola akun masyarakat, petugas kebersihan, dan admin sistem.</p>
        </div>
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pengguna
        </a>
    </div>
    <!-- END: Page Header Banner -->

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <div class="table-header-control">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" id="searchPengguna" class="table-search-input" placeholder="Cari nama atau email pengguna...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Peran (Role)</th>
                        <th>Zona Wilayah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftarPengguna">
                    @forelse ($penggunas as $item)
                        <tr>
                            <!-- Nomor urut menyesuaikan halaman pagination -->
                            <td>{{ $penggunas->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="table-user-cell">
                                    <img src="{{ asset('template-admin-petugas/assets/images/avatar.png') }}" alt="Avatar" class="table-user-avatar">
                                    <div>
                                        <div class="table-user-name">{{ $item->nama_lengkap }}</div>
                                        <div class="table-user-sub">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_telepon ?? '-' }}</td>
                            <td>
                                <span class="badge-table {{ $item->peran == 'Admin' ? 'success' : ($item->peran == 'Petugas' ? 'pending' : 'failed') }}">
                                    {{ $item->peran }}
                                </span>
                            </td>
                            <td>{{ $item->zona->nama_zona ?? 'Semua Zona' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('pengguna.show', $item->id_pengguna) }}" class="table-btn-action" title="Detail Pengguna">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pengguna.edit', $item->id_pengguna) }}" class="table-btn-action" title="Edit Pengguna">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pengguna.destroy', $item->id_pengguna) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-btn-action delete border-0 bg-transparent" title="Hapus Pengguna"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tombol Navigasi Halaman & Informasi -->
        <div class="p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted" style="font-size: 14px;">
                Menampilkan data ke {{ $penggunas->firstItem() }} sampai {{ $penggunas->lastItem() }} dari total {{ $penggunas->total() }} data
            </div>

            <!-- Bagian tombol nomor halaman -->
            <div>
                {{ $penggunas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- END: Basic Table Card Container -->
@endsection
