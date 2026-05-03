<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring - Servora Admin</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section-title">Admin Panel</div>
            <a href="dashboard.php" class="nav-item">
                Dashboard
            </a>
            <a href="kelola_pengguna.php" class="nav-item">
                Kelola Pengguna
            </a>
            <a href="kelola_jasa.php" class="nav-item">
                Kelola Jasa
            </a>
            <a href="kelola_pesanan.php" class="nav-item">
                Kelola Pesanan
            </a>
            <a href="rating.php" class="nav-item">
                Rating & Review
            </a>
            <a href="monitoring.php" class="nav-item active">
                Monitoring
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Admin Profile">
                <div class="user-info">
                    <div class="name">Admin Servora</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Monitoring Aktivitas Sistem</h1>
                <p class="page-subtitle">Pantau performa dan log aktivitas Servora.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="monitoring-stats" style="margin-top: 24px;">
            <div class="monitoring-card">
                <span class="monitoring-card-title">Sesi Aktif</span>
                <span class="monitoring-card-value">312</span>
            </div>
            <div class="monitoring-card">
                <span class="monitoring-card-title">Registrasi Hari Ini</span>
                <span class="monitoring-card-value">18</span>
            </div>
            <div class="monitoring-card">
                <span class="monitoring-card-title">Transaksi 24j</span>
                <span class="monitoring-card-value">46</span>
            </div>
            <div class="monitoring-card">
                <span class="monitoring-card-title">Laporan</span>
                <span class="monitoring-card-value">3</span>
            </div>
        </div>

        <div class="log-container">
            <div class="log-container-title">Log aktivitas</div>
            <div class="log-list">
                <div class="log-item">
                    <div class="log-time">10:42</div>
                    <div class="log-label info">INFO</div>
                    <div class="log-desc">Pesanan ORD-1029 dibuat oleh Andi P.</div>
                </div>
                <div class="log-item">
                    <div class="log-time">10:30</div>
                    <div class="log-label info">INFO</div>
                    <div class="log-desc">Login berhasil untuk naya@kampus.ac.id</div>
                </div>
                <div class="log-item">
                    <div class="log-time">09:58</div>
                    <div class="log-label warn">WARN</div>
                    <div class="log-desc">Percobaan login gagal dari IP 36.71.x.x</div>
                </div>
                <div class="log-item">
                    <div class="log-time">09:12</div>
                    <div class="log-label info">INFO</div>
                    <div class="log-desc">Jasa baru dipublikasikan oleh Rafi H.</div>
                </div>
                <div class="log-item">
                    <div class="log-time">08:40</div>
                    <div class="log-label error">ERROR</div>
                    <div class="log-desc">Gagal memproses pembayaran ORD-1027 (di-retry)</div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
