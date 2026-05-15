<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Servora</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body class="login-body">

<div class="login-wrapper">
    <div class="login-left">
        <div class="brand login-brand">
            <div class="brand-logo">S</div>
            <h2>Servora</h2>
        </div>

        <h1>Selamat datang kembali!</h1>
        <p>
            Masuk ke akun Servora untuk mencari jasa, mengelola layanan,
            atau memantau aktivitas pesananmu.
        </p>

        <div class="login-info-card">
            <strong>Untuk mahasiswa, oleh mahasiswa</strong>
            <span>Platform jasa mahasiswa yang simpel dan terpercaya.</span>
        </div>
    </div>

    <div class="login-right">
        <div class="login-card">
            <h2>Masuk Akun</h2>
            <p class="login-subtitle">Gunakan email dan password untuk melanjutkan.</p>

            <form action="proses_login.php" method="POST">
                <div class="form-group-login">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="form-group-login">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                    <a href="#">Lupa password?</a>
                </div>

                <button type="submit" class="login-submit">Masuk</button>
            </form>

            <div class="loginsm">
                <a href="../../views/admin/dashboard.php">Admin</a>
                <a href="../../views/user/dashboard.php">User</a>
                <a href="../../views/worker/dashboard.php">Worker</a>
            </div>

            <p class="register-text">
                Belum punya akun?
                <a href="register.php">Daftar sekarang</a>
            </p>


            <a href="../../public/index.php" class="back-home">← Kembali ke Beranda</a>
        </div>
    </div>
</div>

</body>
</html>