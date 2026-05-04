<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servora - Jasa Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="brand">
        <div class="brand-logo">S</div>
        <h2>Servora</h2>
    </div>

    <nav class="nav-menu">
        <a href="#beranda" class="active">Beranda</a>
        <a href="#jasa">Jasa</a>
        <a href="#cara-kerja">Cara Kerja</a>
        <a href="../views/auth/login.php" class="login-link">Masuk</a>
        <a href="../views/auth/register.php" class="btn-primary">Daftar</a>
    </nav>
</header>

<section class="hero" id="beranda">
    <div class="hero-content">
        <span class="badge">Untuk mahasiswa, oleh mahasiswa</span>
        <h1>Solusi jasa mahasiswa, simpel & terpercaya.</h1>
        <p>
            Servora menghubungkan pengguna dengan freelancer mahasiswa untuk kebutuhan
            tugas, desain, coding, penulisan, bimbel, dan berbagai layanan akademik lainnya.
        </p>

        <div class="hero-buttons">
            <a href="#jasa" class="btn-primary">Cari Jasa</a>
            <a href="../views/auth/register.php" class="btn-secondary">Daftar Sekarang</a>
        </div>

        <div class="hero-stats">
            <span>👥 2.500+ mahasiswa</span>
            <span>⭐ 4.9 rating rata-rata</span>
        </div>
    </div>

    <div class="hero-card">
        <h3>Kategori Populer</h3>
        <div class="category-grid">
            <div>Desain Grafis</div>
            <div>Penulisan</div>
            <div>Programming</div>
            <div>Penerjemahan</div>
            <div>Tugas Akademik</div>
            <div>Video Editing</div>
        </div>

        <div class="secure-card">
            <strong>Aman & Profesional</strong>
            <p>Verifikasi mahasiswa aktif</p>
        </div>
    </div>
</section>

<section class="section" id="jasa">
    <div class="section-title">
        <h2>Jasa Populer di Servora</h2>
        <p>Pilih layanan sesuai kebutuhanmu dengan cepat dan mudah.</p>
    </div>

    <div class="service-grid">
        <div class="service-card">
            <h3>Desain Poster</h3>
            <p>Pembuatan poster seminar, lomba, dan kegiatan kampus.</p>
            <span>Mulai Rp50.000</span>
        </div>

        <div class="service-card">
            <h3>Pembuatan PPT</h3>
            <p>Slide presentasi rapi, modern, dan siap dipakai.</p>
            <span>Mulai Rp40.000</span>
        </div>

        <div class="service-card">
            <h3>Konsultasi Coding</h3>
            <p>Bantuan memahami error, debugging, dan logika program.</p>
            <span>Mulai Rp75.000</span>
        </div>
    </div>
</section>

<section class="section how" id="cara-kerja">
    <div class="section-title">
        <h2>Cara Kerja Servora</h2>
        <p>Alur penggunaan dibuat sederhana agar mudah digunakan.</p>
    </div>

    <div class="step-grid">
        <div class="step-card">
            <div class="step-number">1</div>
            <h3>Cari Jasa</h3>
            <p>Pengguna memilih layanan berdasarkan kategori yang dibutuhkan.</p>
        </div>

        <div class="step-card">
            <div class="step-number">2</div>
            <h3>Pesan Layanan</h3>
            <p>Pengguna mengisi detail pesanan dan memilih freelancer.</p>
        </div>

        <div class="step-card">
            <div class="step-number">3</div>
            <h3>Berikan Review</h3>
            <p>Setelah layanan selesai, pengguna dapat memberi rating dan ulasan.</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Servora. Sistem Informasi Jasa Mahasiswa Berbasis Web.</p>
</footer>

</body>
</html>