<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Pengaduan Sampah</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #dcfce7, #f0fdf4, #e2e8f0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-auth {
            border: none;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(20, 83, 45, 0.15);
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .auth-header {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            padding: 40px 20px;
            color: white;
            text-align: center;
            position: relative;
        }
        .auth-icon-box {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control {
            border-radius: 14px;
            padding: 14px 18px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.12);
        }
        .btn-auth {
            border-radius: 14px;
            padding: 14px;
            font-weight: 600;
            font-size: 15px;
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.4);
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(5, 150, 105, 0.5);
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        }
        .form-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #475569;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card card-auth">
                    <div class="auth-header">
                        <div class="auth-icon-box">
                            <i class="fas fa-recycle fa-2x text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-1 tracking-tight">Selamat Datang</h4>
                        <p class="text-white-50 small mb-0">Sistem Pengaduan Sampah Terpadu</p>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-4 py-3 px-3 small bg-danger bg-opacity-10 text-danger mb-4 d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                                <div>{{ $errors->first() }}</div>
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-uppercase">Alamat Email</label>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-uppercase">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-auth w-100 text-uppercase shadow-sm">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top border-light">
                            <p class="small text-muted mb-2">Belum punya akun warga? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Daftar di sini</a></p>
                            <a href="{{ route('masyarakat.dashboard') }}" class="small text-secondary text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
