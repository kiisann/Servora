<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
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

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/auth/loginProcess" method="POST">
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

            <p class="register-text">
                Belum punya akun?
                <a href="<?= BASE_URL ?>/auth/register">Daftar sekarang</a>
            </p>

            <a href="<?= BASE_URL ?>/" class="back-home">← Kembali ke Beranda</a>
        </div>
    </div>
</div>

</body>
</html>