<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama = htmlspecialchars($_SESSION['nama'] ?? 'Freelancer');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Freelancer – Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">

    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">

        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Halo <?= $sessionNama ?> 👋, berikut performa jasamu di Servora.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profil" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="page-content">

            <section class="stats-grid">
                <div class="stat-card stat-card-with-image">
                    <div class="stat-info">
                        <div class="title">Pesanan Baru</div>
                        <div class="value"><?= $pesanan_baru ?? 0 ?></div>
                    </div>
                    <div class="stat-image-box blue">
                        <img src="<?= BASE_URL ?>/assets/images/dashboard/pesanan-baru.png" alt="Pesanan Baru" class="stat-icon-img">
                    </div>
                </div>

                <div class="stat-card stat-card-with-image">
                    <div class="stat-info">
                        <div class="title">Sedang Berjalan</div>
                        <div class="value"><?= $pesanan_berjalan ?? 0 ?></div>
                    </div>
                    <div class="stat-image-box orange">
                        <img src="<?= BASE_URL ?>/assets/images/dashboard/sedang-berjalan.png" alt="Sedang Berjalan" class="stat-icon-img">
                    </div>
                </div>

                <div class="stat-card stat-card-with-image">
                    <div class="stat-info">
                        <div class="title">Selesai</div>
                        <div class="value"><?= $pesanan_selesai ?? 0 ?></div>
                    </div>
                    <div class="stat-image-box green">
                        <img src="<?= BASE_URL ?>/assets/images/dashboard/selesai.png" alt="Selesai" class="stat-icon-img">
                    </div>
                </div>

                <div class="stat-card stat-card-with-image">
                    <div class="stat-info">
                        <div class="title">Total Jasa</div>
                        <div class="value"><?= $total_jasa ?? 0 ?></div>
                    </div>
                    <div class="stat-image-box purple">
                        <img src="<?= BASE_URL ?>/assets/images/dashboard/total-jasa.png" alt="Total Jasa" class="stat-icon-img">
                    </div>
                </div>
            </section>

            <section class="content-grid">

                <div class="card-container">
                    <div class="card-header">
                        <h3>Pesanan terbaru</h3>
                        <a href="<?= BASE_URL ?>/pesanan" class="header-action">Semua</a>
                    </div>
                    <div class="list-container">
                        <?php if (!empty($recent_pesanan)): ?>
                            <?php foreach($recent_pesanan as $p): ?>
                            <?php
                                $badgeClass = match($p['status']) {
                                    'pending'    => 'warning',
                                    'diproses'   => 'info',
                                    'selesai'    => 'success',
                                    'dibatalkan' => 'danger',
                                    default      => 'info'
                                };
                                $badgeText = match($p['status']) {
                                    'pending'    => 'Menunggu',
                                    'diproses'   => 'Berlangsung',
                                    'selesai'    => 'Selesai',
                                    'dibatalkan' => 'Dibatalkan',
                                    default      => ucfirst($p['status'])
                                };
                            ?>
                            <div class="list-item">
                                <div class="item-left">
                                    <div class="item-title"><?= htmlspecialchars($p['nama_jasa']) ?></div>
                                    <div class="item-desc"><?= htmlspecialchars($p['nama_client']) ?></div>
                                </div>
                                <div class="item-right">
                                    <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-item"><div class="item-left"><div class="item-desc">Belum ada pesanan masuk.</div></div></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card-header">
                        <h3>Jasa Saya</h3>
                        <a href="<?= BASE_URL ?>/worker/jasa" class="header-action">Kelola</a>
                    </div>
                    <div class="list-container">
                        <?php if (!empty($jasa_saya)): ?>
                            <?php foreach(array_slice($jasa_saya, 0, 3) as $j): ?>
                            <div class="list-item">
                                <div class="item-left">
                                    <div class="item-title"><?= htmlspecialchars($j['nama_jasa']) ?></div>
                                    <div class="item-desc"><?= htmlspecialchars($j['nama_kategori'] ?? '-') ?> &middot; Rp<?= number_format($j['harga'], 0, ',', '.') ?></div>
                                </div>
                                <div class="item-right">
                                    <span class="badge <?= $j['status'] === 'aktif' ? 'success' : 'warning' ?>"><?= ucfirst($j['status']) ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-item"><div class="item-left"><div class="item-desc">Belum ada jasa. <a href="<?= BASE_URL ?>/worker/tambah">Tambah sekarang</a></div></div></div>
                        <?php endif; ?>
                    </div>
                </div>

            </section>

        </div>
    </main>

</div>

</body>
</html>
