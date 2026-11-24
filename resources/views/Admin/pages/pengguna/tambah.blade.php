@extends('Admin.index')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Pengguna Baru</h1>
            <p class="page-subtitle">Daftarkan akun baru untuk Admin, Petugas, atau Masyarakat.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-light shadow-sm p-4">
                <h5 class="card-title mb-4">Form Tambah Pengguna</h5>

                {{-- Menampilkan pesan error validasi jika ada yang terlewat --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formTambah" action="{{ route('pengguna.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label-custom">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control-custom" id="email" name="email" value="{{ old('email') }}" placeholder="nama@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label-custom">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control-custom" id="password" name="password" placeholder="Masukkan password (minimal 6 karakter)" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label-custom">No. Telepon</label>
                        <input type="text" class="form-control-custom" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="peran" class="form-label-custom">Peran (Role) <span class="text-danger">*</span></label>
                        <select class="form-control-custom" id="peran" name="peran" required>
                            <option selected disabled>Pilih peran akun...</option>
                            <option value="Masyarakat" {{ old('peran') == 'Masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            <option value="Petugas" {{ old('peran') == 'Petugas' ? 'selected' : '' }}>Petugas Kebersihan</option>
                            <option value="Admin" {{ old('peran') == 'Admin' ? 'selected' : '' }}>Admin Dinas</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="id_zona" class="form-label-custom">Zona Wilayah</label>
                        <select class="form-control-custom" id="id_zona" name="id_zona">
                            <option selected disabled>Pilih zona wilayah...</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id_zona }}" {{ old('id_zona') == $zone->id_zona ? 'selected' : '' }}>
                                    {{ $zone->nama_zona }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
