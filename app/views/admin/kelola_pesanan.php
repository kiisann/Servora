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

            <!-- Tab Filter -->
            <div class="filter-tabs">
                <button class="tab-btn active" onclick="setTab(this,'semua')">Semua</button>
                <button class="tab-btn" onclick="setTab(this,'pending')">Menunggu</button>
                <button class="tab-btn" onclick="setTab(this,'diproses')">Berlangsung</button>
                <button class="tab-btn" onclick="setTab(this,'selesai')">Selesai</button>
                <button class="tab-btn" onclick="setTab(this,'dibatalkan')">Dibatalkan</button>
            </div>

            <div class="card-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr class="data-table-head-row">
                                <th>ID</th>
                                <th>Jasa</th>
                                <th>Client</th>
                                <th>Freelancer</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
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
                                <tr data-status="<?= $p['status'] ?>" class="data-table-row"
                                    data-pesanan='<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                                    <td class="table-cell-id">#<?= $p['id_pesanan'] ?></td>
                                    <td class="table-cell-strong"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td><?= htmlspecialchars($p['nama_client'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td class="table-cell-muted"><?= $p['created_at'] ?? '-' ?></td>
                                    <td>
                                        <button class="btn-edit" onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="table-empty-wide">Belum ada pesanan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="modal-overlay detail-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title-main" id="modalTitle">Detail Pesanan</h3>
            <button onclick="closeDetail()" class="modal-close-plain">✕</button>
        </div>
        <div id="modalContent"></div>
        <div class="modal-footer-end">
            <button onclick="closeDetail()" class="btn-modal-secondary">Tutup</button>
        </div>
    </div>
</div>

<script>
let activeTab = 'semua';

function setTab(btn, tab) {
    activeTab = tab;
    document.querySelectorAll('.tab-btn').forEach(t => {
        t.classList.remove('active');
    });
    btn.classList.add('active');
    document.querySelectorAll('#ordersBody tr[data-status]').forEach(row => {
        const show = activeTab === 'semua' || row.dataset.status === activeTab;
        row.style.display = show ? '' : 'none';
    });
}

function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;
    const statusMap = {pending:'Menunggu',diproses:'Berlangsung',selesai:'Selesai',dibatalkan:'Dibatalkan'};
    document.getElementById('modalContent').innerHTML = `
        <table class="detail-table">
            <tr><td class="detail-label detail-label-wide">Jasa</td><td class="detail-value-strong">${data.nama_jasa}</td></tr>
            <tr><td class="detail-label">Client</td><td>${data.nama_client||'-'}</td></tr>
            <tr><td class="detail-label">Freelancer</td><td>${data.nama_freelancer||'-'}</td></tr>
            <tr><td class="detail-label">Tanggal</td><td>${data.created_at||'-'}</td></tr>
            <tr><td class="detail-label">Status</td><td class="detail-value-strong">${statusMap[data.status]||data.status}</td></tr>
        </table>`;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() { document.getElementById('detailModal').style.display = 'none'; }
document.getElementById('detailModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeDetail(); });
</script>

</body>
</html>
