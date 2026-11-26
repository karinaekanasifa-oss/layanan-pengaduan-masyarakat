<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Pengaduan Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light d-flex align-items-center min-vh-100" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="bg-success text-white text-center py-4">
                        <i class="fas fa-leaf fa-2x mb-2"></i>
                        <h4 class="fw-bold mb-0 text-uppercase">Masuk Akun</h4>
                        <small class="text-white-50">Sistem Informasi Layanan Pengaduan Sampah</small>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-success text-uppercase">Alamat Email</label>
                                <input type="email" name="email" class="form-control py-2 rounded-3" value="{{ old('email') }}" placeholder="contoh@email.com" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-success text-uppercase">Password</label>
                                <input type="password" name="password" class="form-control py-2 rounded-3" placeholder="Masukkan password" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 rounded-pill fw-bold text-uppercase shadow-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="small text-muted mb-1">Belum punya akun warga? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Daftar di sini</a></p>
                            <a href="{{ route('masyarakat.dashboard') }}" class="small text-secondary text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
