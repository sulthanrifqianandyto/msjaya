<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MS Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f2f1, #f1f8e9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 15px;
        }
        .login-header {
            background: #2e7d32;
            border-radius: 15px 15px 0 0;
        }
        .login-header h4 {
            margin: 0;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card shadow login-card">
                <div class="card-header text-center text-white login-header py-3">
                    <h4>Login Sistem MS Jaya</h4>
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

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}">Belum punya akun? Daftar di sini</a>
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
