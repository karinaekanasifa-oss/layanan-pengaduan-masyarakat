@extends('Admin.index')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Update Pengguna</h1>
            <p class="page-subtitle">Perbarui informasi akun pengguna.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Form Edit Pengguna</h5>

                <form id="formUpdate" action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="nama_lengkap" name="nama_lengkap" value="{{ $pengguna->nama_lengkap }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label-custom">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control-custom" id="email" name="email" value="{{ $pengguna->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label-custom">Password Baru (Opsional)</label>
                        <input type="password" class="form-control-custom" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label-custom">No. Telepon</label>
                        <input type="text" class="form-control-custom" id="no_telepon" name="no_telepon" value="{{ $pengguna->no_telepon }}">
                    </div>

                    <div class="mb-3">
                        <label for="peran" class="form-label-custom">Peran (Role) <span class="text-danger">*</span></label>
                        <select class="form-control-custom" id="peran" name="peran" required>
                            <option value="Masyarakat" {{ $pengguna->peran == 'Masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            <option value="Petugas" {{ $pengguna->peran == 'Petugas' ? 'selected' : '' }}>Petugas Kebersihan</option>
                            <option value="Admin" {{ $pengguna->peran == 'Admin' ? 'selected' : '' }}>Admin Dinas</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="id_zona" class="form-label-custom">Zona Wilayah</label>
                        <select class="form-control-custom" id="id_zona" name="id_zona">
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id_zona }}" {{ $pengguna->id_zona == $zone->id_zona ? 'selected' : '' }}>
                                    {{ $zone->nama_zona }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
