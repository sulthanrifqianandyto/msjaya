<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MS Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e8f5e9, #f1f8e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-card {
            border: none;
            border-radius: 15px;
        }
        .register-header {
            background: #388e3c;
            border-radius: 15px 15px 0 0;
        }
        .register-header h4 {
            margin: 0;
        }
        .btn-success {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        .btn-success:hover {
            background-color: #2e7d32;
        }
        @media (min-width: 768px) {
            .form-group-row {
                display: flex;
                gap: 1rem;
            }
            .form-group-row .form-group {
                flex: 1;
            }
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6">
            <div class="card shadow register-card">
                <div class="card-header text-white text-center register-header py-3">
                    <h4>Registrasi Pelanggan</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group-row mb-3">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group-row mb-3">
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group-row mb-3">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                    </div>

                    <div class="text-center mt-2">
                        <a href="{{ route('home') }}" class="btn btn-link">← Kembali ke Beranda</a>
                    </div>
                </div>
                <div class="card-footer text-center text-muted small py-2">
                    &copy; 2025 Pabrik MS Jaya
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
