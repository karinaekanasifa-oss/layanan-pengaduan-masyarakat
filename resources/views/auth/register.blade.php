<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Warga - Pengaduan Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light d-flex align-items-center min-vh-100 py-5" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="bg-success text-white text-center py-4">
                        <i class="fas fa-user-plus fa-2x mb-2"></i>
                        <h4 class="fw-bold mb-0 text-uppercase">Registrasi Warga</h4>
                        <small class="text-white-50">Buat akun untuk mulai melaporkan keluhan sampah</small>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-success text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control py-2 rounded-3" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-success text-uppercase">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control py-2 rounded-3" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-success text-uppercase">No. Telepon / WA <span class="text-danger">*</span></label>
                                    <input type="text" name="no_telepon" class="form-control py-2 rounded-3" value="{{ old('no_telepon') }}" placeholder="0812xxxx" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-success text-uppercase">Zona Wilayah Domisili</label>
                                <select name="id_zona" class="form-select py-2 rounded-3">
                                    <option value="">-- Pilih Zona Wilayah (Opsional) --</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id_zona }}" {{ old('id_zona') == $zone->id_zona ? 'selected' : '' }}>
                                            {{ $zone->nama_zona }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-success text-uppercase">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control py-2 rounded-3" placeholder="Minimal 6 karakter" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-success text-uppercase">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control py-2 rounded-3" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 rounded-pill fw-bold text-uppercase shadow-sm">
                                Daftar & Lanjutkan
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="small text-muted mb-1">Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Masuk di sini</a></p>
                            <a href="{{ route('masyarakat.dashboard') }}" class="small text-secondary text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
