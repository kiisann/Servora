<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring – Servora Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Monitoring Aktivitas Sistem</h1>
                <p class="page-subtitle">Pantau performa dan log aktivitas Servora.</p>
            </div>
        </header>

        <div class="page-content">
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Pengguna</div>
                        <div class="value"><?= number_format($total_pengguna ?? 0) ?></div>
                    </div>
                    <div class="stat-icon blue"></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Jasa</div>
                        <div class="value"><?= number_format($total_jasa ?? 0) ?></div>
                    </div>
                    <div class="stat-icon green"></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Pesanan</div>
                        <div class="value"><?= number_format($total_pesanan ?? 0) ?></div>
                    </div>
                    <div class="stat-icon orange"></div>
                </div>
            </section>

            <div class="card-container" style="margin-top:24px;">
                <div class="card-header">
                    <h3>Log Aktivitas</h3>
                </div>
                <div class="activity-list">
                    <?php if (!empty($logs)): ?>
                        <?php foreach($logs as $log): ?>
                        <div class="activity-item">
                            <div class="activity-bullet"></div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    <strong><?= htmlspecialchars($log['pengguna'])?></strong> 
                                    <?= htmlspecialchars($log['deskripsi']) ?>
                                    — <span class="badge <?= $log['tipe'] === 'warning' ? 'danger' : 'info' ?>"><?= strtoupper($log['tipe']) ?></span>
                                </div>
                                <div style="font-size:12px;color:#94a3b8;"><?= $log['created_at'] ?? '' ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="activity-item">
                            <div class="activity-content"><div class="activity-text" style="color:#94a3b8;">Belum ada aktivitas.</div></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>
