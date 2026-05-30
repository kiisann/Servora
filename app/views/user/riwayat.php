<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama   = htmlspecialchars($_SESSION['nama'] ?? 'Pengguna');
$riwayatList   = $riwayat ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan – Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">

    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">

        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Riwayat Pesanan</h1>
                <p class="page-subtitle">Semua pesanan yang sudah selesai atau dibatalkan.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="<?= BASE_URL ?>/jasa" class="btn btn-primary btn-icon-gap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Pesan Jasa Baru
                    </a>
                </div>
            </div>
        </header>

        <div class="page-content">

            <!-- Filter -->
            <div class="filter-bar">
                <div class="filter-search">
                    <input type="text" id="searchOrder" placeholder="Cari riwayat..." oninput="filterOrders()"
                           class="filter-input">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8" width="16" height="16"
                         class="filter-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
                <select id="filterStatus" onchange="filterOrders()"
                        class="filter-select">
                    <option value="">Semua status</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="card-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr class="data-table-head-row">
                                <th>ID</th>
                                <th>Jasa</th>
                                <th>Freelancer</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatBody">
                            <?php if (!empty($riwayatList)): ?>
                                <?php foreach($riwayatList as $p): ?>
                                <?php
                                    $badgeClass = $p['status'] === 'selesai' ? 'success' : 'danger';
                                    $badgeText  = $p['status'] === 'selesai' ? 'Selesai' : 'Dibatalkan';
                                ?>
                                <tr data-status="<?= $p['status'] ?>" class="data-table-row">
                                    <td class="table-cell-id">#<?= $p['id_pesanan'] ?></td>
                                    <td class="table-cell-strong"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td class="table-cell-muted"><?= $p['created_at'] ?? '-' ?></td>
                                    <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="table-empty">
                                        Belum ada riwayat pesanan.
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

<script>
function filterOrders() {
    const q = document.getElementById('searchOrder').value.toLowerCase();
    const status = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#riwayatBody tr[data-status]');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowStatus = row.dataset.status;
        const show = text.includes(q) && (status === '' || rowStatus === status);
        row.style.display = show ? '' : 'none';
    });
}
</script>

</body>
</html>
