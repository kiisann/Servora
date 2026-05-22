<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body class="login-body">

<div class="login-wrapper">
    <div class="login-left">
        <div class="brand login-brand">
            <div class="brand-logo">S</div>
            <h2>Servora</h2>
        </div>

        <h1>Buat akun Servora!</h1>
        <p>
            Daftar sebagai pengguna Servora untuk mulai mencari jasa mahasiswa,
            menawarkan layanan, dan terhubung dalam satu platform.
        </p>

        <div class="login-info-card">
            <strong>Gabung bersama Servora</strong>
            <span>Temukan jasa mahasiswa yang simpel, aman, dan terpercaya.</span>
        </div>
    </div>

    <div class="login-right">
        <div class="login-card">
            <h2>Daftar Akun</h2>
            <p class="login-subtitle">Lengkapi data berikut untuk membuat akun baru.</p>

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

            <form action="<?= BASE_URL ?>/auth/registerProcess" method="POST">
                <div class="form-group-login">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group-login">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="form-group-login">
                    <label for="role">Daftar Sebagai</label>
                    <select id="role" name="role" required>
                        <option value="">Pilih role akun</option>
                        <option value="client">Client / Pengguna Jasa</option>
                        <option value="freelancer">Freelancer / Penyedia Jasa</option>
                    </select>
                </div>

                <div class="form-group-login">
                    <label for="no_hp">Nomor HP</label>
                    <input type="tel" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group-login">
                    <label for="kampus">Kampus</label>
                    <input type="text" id="kampus" name="kampus" placeholder="Nama kampus Anda">
                </div>

                <div class="form-group-login">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Buat password" required>
                </div>

                <div class="form-group-login">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="login-submit">Daftar</button>
            </form>

            <p class="register-text">
                Sudah punya akun?
                <a href="<?= BASE_URL ?>/auth/login">Masuk sekarang</a>
            </p>

            <a href="<?= BASE_URL ?>/" class="back-home">← Kembali ke Beranda</a>
        </div>
    </div>
</div>

</body>
</html>