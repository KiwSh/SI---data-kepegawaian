<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SI Data Pegawai</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #002855;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card-left {
            background: rgb(15,80,157);
            background: linear-gradient(321deg, rgba(15,80,157,1) 0%, rgba(255,253,253,1) 100%);
            border-radius: 10px 0 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .card-right {
            padding: 30px;
        }
        .logo {
            max-width: 100%;
            height: auto;
        }
        .login-title {
            font-weight: 700;
            margin-bottom: 20px;
        }
        .btn-login {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card" style="width: 850px;">
            <div class="row g-0">
                <!-- Bagian kiri -->
                <div class="col-md-6 card-left">
                    <div class="text-center">
                        <img src="{{ asset('asset/images/logo-removebg.png') }}" alt="Logo" class="logo mb-4" style="width: 150px; height: auto;">
                        <h3>SI - DAKEP</h3>
                        <p>DISKOMINFO KAB.BOGOR</p>
                    </div>
                </div>
                <!-- Bagian kanan -->
                <div class="col-md-6 card-right">
                    <h3 class="login-title">Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <!-- Google reCAPTCHA -->
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Ld6KYoqAAAAAHRvNnKCKytfhay-RPWNJqt-CNNy"></div>
                        </div>
                        <button type="submit" class="btn btn-login w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <!-- Tambahkan script untuk menampilkan notifikasi logout -->
    <script>
        window.onload = function() {
            // Cek jika ada notifikasi logout
            if (sessionStorage.getItem("logout")) {
                alert("Logout berhasil!");
                // Hapus status logout setelah ditampilkan
                sessionStorage.removeItem("logout");
            }
        };
    </script>
</body>
</html>
