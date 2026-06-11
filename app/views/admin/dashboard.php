<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servora Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>
    <?php require_once __DIR__ . '/../../../public/assets/icons/icons.php'; ?> 
    
    
    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Ringkasan aktivitas sistem Servora.</p>
            </div>
        </header>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Total Pengguna</div>
                    <div class="value"><?= number_format($total_pengguna ?? 0) ?></div>
                </div>
                <div class="stat-icon blue">
                    <?= $icons['users'] ?>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Total Jasa</div>
                    <div class="value"><?= number_format($total_jasa ?? 0) ?></div>
                </div>
                <div class="stat-icon green">
                    <?= $icons['package'] ?>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Total Pesanan</div>
                    <div class="value"><?= number_format($total_pesanan ?? 0) ?></div>
                </div>
                <div class="stat-icon orange">
                    <?= $icons['clipboard'] ?>
                </div>
            </div>
        </section>

        <section class="content-grid">
            <!-- Recent Orders -->
            <div class="card-container">
                <div class="card-header">
                    <h3>Pesanan terbaru</h3>
                    <a href="<?= BASE_URL ?>/pesanan" class="header-action">Semua →</a>
                </div>
                <div class="list-container">
                    <?php if (!empty($recent_pesanan)): ?>
                        <?php foreach($recent_pesanan as $p): ?>
                        <?php
                            $badgeClass = match($p['status']) {
                                'pending'     => 'warning',
                                'diproses'    => 'info',
                                'selesai'     => 'success',
                                'dibatalkan'  => 'danger',
                                default       => 'info'
                            };
                            $badgeText = match($p['status']) {
                                'pending'     => 'Menunggu',
                                'diproses'    => 'Berlangsung',
                                'selesai'     => 'Selesai',
                                'dibatalkan'  => 'Dibatalkan',
                                default       => ucfirst($p['status'])
                            };
                        ?>
                        <div class="list-item">
                            <div class="item-left">
                                <div class="item-title"><?= htmlspecialchars($p['nama_jasa']) ?></div>
                                <div class="item-desc">#<?= $p['id_pesanan'] ?> &middot; <?= htmlspecialchars($p['nama_client']) ?></div>
                            </div>
                            <div class="item-right">
                                <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-item"><div class="item-left"><div class="item-desc">Belum ada pesanan.</div></div></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="card-container">
                <div class="card-header">
                    <h3>Pengguna terbaru</h3>
                    <a href="<?= BASE_URL ?>/user" class="header-action">Semua →</a>
                </div>
                <div class="activity-list">
                    <?php if (!empty($recent_users)): ?>
                        <?php foreach($recent_users as $u): ?>
                        <div class="activity-item">
                            <div class="activity-bullet"></div>
                            <div class="activity-content">
                                <div class="activity-text"><strong><?= htmlspecialchars($u['nama']) ?></strong> &middot; <?= ucfirst($u['role']) ?></div>
                                <div class = "text-muted"><?= htmlspecialchars($u['email']) ?></div>
                            </div>
                            <span class="badge <?= $u['status'] === 'aktif' ? 'success' : 'danger' ?>"><?= ucfirst($u['status']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="activity-item"><div class="activity-content"><div class="activity-text">Belum ada pengguna.</div></div></div>
                    <?php endif; ?>
                </div>
            </div>
        </section>


    </main>
</div>

</body>
</html>

