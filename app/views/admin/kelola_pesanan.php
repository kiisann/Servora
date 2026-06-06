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

            <!-- LOG CONTAINER -->
            <div class="card-container">

                <!-- Tab Filter -->
                <div class="filter-tabs">
                    <a href="#" class="filter-tab active" onclick="setTab(this,'semua');return false;">SEMUA</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'pending');return false;">MENUNGGU</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'diproses');return false;">BERLANGSUNG</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'selesai');return false;">SELESAI</a>
                    <a href="#" class="filter-tab" onclick="setTab(this,'dibatalkan');return false;">DIBATALKAN</a>
                </div>

                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">ID</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Jasa</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Client</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Freelancer</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Status</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Tanggal</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Aksi</th>
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
                                <tr data-status="<?= $p['status'] ?>" style="border-bottom:1px solid #f1f5f9;"
                                    data-pesanan='<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                                    <td style="padding:12px 16px;font-weight:600;color:#475569;">#<?= $p['id_pesanan'] ?></td>
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($p['nama_client'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $p['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;">
                                        <button class="btn-edit" onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" style="padding:40px;text-align:center;color:#94a3b8;">Belum ada pesanan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Detail Modal -->
<div id="detailModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:500;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px 32px;max-width:480px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#1e293b;" id="modalTitle">Detail Pesanan</h3>
            <button onclick="closeDetail()" style="background:none;border:none;font-size:22px;color:#64748b;cursor:pointer;">✕</button>
        </div>
        <div id="modalContent"></div>
        <div style="display:flex;justify-content:flex-end;margin-top:24px;">
            <button onclick="closeDetail()" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;">Tutup</button>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/js/script.js?v=<?= time() ?>"></script>

</body>
</html>
