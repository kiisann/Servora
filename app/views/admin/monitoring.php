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
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> -->
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

                <!-- FILTER TAB -->
                <div class="filter-tabs">

                    <a href="<?= BASE_URL ?>/monitoring"
                       class="filter-tab <?= $filter_tipe === '' ? 'active' : '' ?>">
                        SEMUA
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=info"
                       class="filter-tab <?= $filter_tipe === 'info' ? 'active' : '' ?>">
                        INFO
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=warning"
                       class="filter-tab <?= $filter_tipe === 'warning' ? 'active' : '' ?>">
                        WARNING
                    </a>

                    <a href="<?= BASE_URL ?>/monitoring?tipe=error"
                       class="filter-tab <?= $filter_tipe === 'error' ? 'active' : '' ?>">
                        ERROR
                    </a>

                </div>

                <!-- LOG LIST -->
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:20%;">Waktu</th>
                                <th style="width:20%;">Pengguna</th>
                                <th style="width:<?= $filter_tipe === '' ? '50%' : '60%' ?>;">Aktivitas</th>
                                <?php if ($filter_tipe === ''): ?>
                                    <th class="text-right" style="width:10%;">Tipe</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($logs)): ?>
                                <?php foreach ($logs as $log): ?>
                                    <?php
                                    $tipe = $log['tipe'] ?? 'info';

                                    $badgeClass = match($tipe) {
                                        'warning' => 'warning',
                                        'error'   => 'danger',
                                        default   => 'info',
                                    };
                                    ?>
                                    <tr>
                                        <td class="text-muted" style="white-space:nowrap;"><?= htmlspecialchars($log['created_at'] ?? '-') ?></td>
                                        <td class="fw-medium"><?= htmlspecialchars($log['pengguna'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($log['deskripsi'] ?? '-') ?></td>
                                        <?php if ($filter_tipe === ''): ?>
                                            <td class="text-right">
                                                <span class="badge <?= $badgeClass ?>"><?= strtoupper($tipe) ?></span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?= $filter_tipe === '' ? '4' : '3' ?>" class="text-muted" style="padding:40px;text-align:center;">
                                        Tidak ada aktivitas
                                        <?= $filter_tipe ? " dengan tipe <strong>" . strtoupper($filter_tipe) . "</strong>" : '' ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>