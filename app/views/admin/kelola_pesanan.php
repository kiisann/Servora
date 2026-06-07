<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$pesananList = $pesanan ?? [];
$selectedId  = $selected_id ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan – Servora Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Kelola Pesanan</h1>
                <p class="page-subtitle">Kelola dan pantau status seluruh pesanan.</p>
            </div>
        </header>

        <div class="page-content">
            <div class="card-container">
                <div class="filter-tabs">
                    <a href="#" class="filter-tab active" onclick="setTab(this,'semua');return false;">SEMUA</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'pending');return false;">MENUNGGU</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'diproses');return false;">BERLANGSUNG</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'selesai');return false;">SELESAI</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'dibatalkan');return false;">DIBATALKAN</a>
                </div>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="td-default">ID</th>
                                <th class="td-default">Jasa</th>
                                <th class="td-default">Client</th>
                                <th class="td-default">Freelancer</th>
                                <th class="td-default">Status</th>
                                <th class="td-default">Tanggal</th>
                                <th class="td-default">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ordersBody">
                            <?php if (!empty($pesananList)): ?>
                                <?php foreach($pesananList as $p): ?>
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
                                <tr data-status="<?= $p['status'] ?>" class="table-row"
                                    data-pesanan='<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                                    <td class="order-id">#<?= $p['id_pesanan'] ?></td>
                                    <td class="order-service"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td class="order-cell"><?= htmlspecialchars($p['nama_client'] ?? '-') ?></td>
                                    <td class="order-cell"><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td class="order-cell"><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td class="order-date"><?= $p['created_at'] ?? '-' ?></td>
                                    <td class="order-cell">
                                        <button class="btn-edit" onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="empty-state">Belum ada pesanan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="detail-modal">
    <div class="detail-modal-container">
        <div class="detail-modal-header">
            <h3 class="detail-modal-title" id="modalTitle">Detail Pesanan</h3>
            <button onclick="closeDetail()" class="detail-modal-close">✕</button>
        </div>
        <div id="modalContent"></div>
        <div class="detail-modal-footer">
            <button onclick="closeDetail()" class="detail-modal-btn">Tutup</button>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/js/script.js?v=<?= time() ?>"></script>

</body>
</html>
