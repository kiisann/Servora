<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
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
    <?php require_once __DIR__ . '/../../../public/assets/icons/icons.php'; ?>

    <main class="main-content">

        <!-- HEADER -->
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Monitoring Aktivitas Sistem</h1>
                <p class="page-subtitle">Pantau log aktivitas Servora secara real-time.</p>
            </div>
        </header>

        <div class="page-content">

            <!-- ALERT -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- STATS -->
            <section class="stats-grid">

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Pengguna</div>
                        <div class="value"><?= number_format($total_pengguna ?? 0) ?></div>
                    </div>
                    <div class="stat-icon blue"><?= $icons['users'] ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Jasa</div>
                        <div class="value"><?= number_format($total_jasa ?? 0) ?></div>
                    </div>
                    <div class="stat-icon green"><?= $icons['package'] ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="title">Total Pesanan</div>
                        <div class="value"><?= number_format($total_pesanan ?? 0) ?></div>
                    </div>
                    <div class="stat-icon orange"><?= $icons['clipboard'] ?></div>
                </div>

            </section>

            <!-- LOG CONTAINER -->
            <div class="card-container" style="margin-top:24px;">

                <!-- FILTER TAB (STYLE PESANAN) -->
                <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">

                    <a href="<?= BASE_URL ?>/monitoring"
                       style="padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;
                       border:1px solid #e2e8f0;
                       background:<?= $filter_tipe === '' ? '#6366f1' : '#fff' ?>;
                       color:<?= $filter_tipe === '' ? '#fff' : '#475569' ?>;">
                        Semua
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=info"
                       style="padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;
                       border:1px solid #e2e8f0;
                       background:<?= $filter_tipe === 'info' ? '#6366f1' : '#fff' ?>;
                       color:<?= $filter_tipe === 'info' ? '#fff' : '#475569' ?>;">
                        INFO
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=warning"
                       style="padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;
                       border:1px solid #e2e8f0;
                       background:<?= $filter_tipe === 'warning' ? '#6366f1' : '#fff' ?>;
                       color:<?= $filter_tipe === 'warning' ? '#fff' : '#475569' ?>;">
                        WARNING
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=error"
                       style="padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;
                       border:1px solid #e2e8f0;
                       background:<?= $filter_tipe === 'error' ? '#6366f1' : '#fff' ?>;
                       color:<?= $filter_tipe === 'error' ? '#fff' : '#475569' ?>;">
                        ERROR
                    </a>

                </div>

                <!-- LOG LIST -->
                <div class="activity-list">

                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>

                            <?php
                            $tipe = $log['tipe'] ?? 'info';

                            $badgeClass = match($tipe) {
                                'warning' => 'warning',
                                'error'   => 'danger',
                                default   => 'info',
                            };

                            $bulletClass = match($tipe) {
                                'warning' => 'bullet-warning',
                                'error'   => 'bullet-danger',
                                default   => 'bullet-info',
                            };
                            ?>

                            <div class="activity-item">
                                <div class="activity-bullet <?= $bulletClass ?>"></div>

                                <div class="activity-content">
                                    <div class="activity-text">
                                        <strong><?= htmlspecialchars($log['pengguna'] ?? '-') ?></strong>
                                        <?= htmlspecialchars($log['deskripsi'] ?? '-') ?>
                                        &mdash;

                                        <span class="badge <?= $badgeClass ?>">
                                            <?= strtoupper($tipe) ?>
                                        </span>
                                    </div>

                                    <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                                        <?= htmlspecialchars($log['created_at'] ?? '-') ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>

                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-text" style="color:#94a3b8;">
                                    Tidak ada aktivitas
                                    <?= $filter_tipe ? " dengan tipe <strong>" . strtoupper($filter_tipe) . "</strong>" : '' ?>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>