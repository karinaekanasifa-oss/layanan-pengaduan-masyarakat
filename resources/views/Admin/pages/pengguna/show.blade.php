@extends('Admin.index')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Pengguna</h1>
            <p class="page-subtitle">Informasi lengkap akun pengguna sistem.</p>
        </div>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Profil Akun</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Nama Lengkap:</strong> <span>{{ $pengguna->nama_lengkap }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Email:</strong> <span>{{ $pengguna->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>No. Telepon:</strong> <span>{{ $pengguna->no_telepon ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Peran (Role):</strong> <span>{{ $pengguna->peran }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Zona Wilayah:</strong> <span>{{ $pengguna->zona->nama_zona ?? '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
