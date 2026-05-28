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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
                <button class="tab-btn active" onclick="setTab(this,'semua')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#6366f1;color:#fff;cursor:pointer;font-size:13px;font-weight:600;">Semua</button>
                <button class="tab-btn" onclick="setTab(this,'pending')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;font-weight:600;">Menunggu</button>
                <button class="tab-btn" onclick="setTab(this,'diproses')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;font-weight:600;">Berlangsung</button>
                <button class="tab-btn" onclick="setTab(this,'selesai')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;font-weight:600;">Selesai</button>
                <button class="tab-btn" onclick="setTab(this,'dibatalkan')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;font-weight:600;">Dibatalkan</button>
            </div>

            <div class="card-container">
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
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

<script>
let activeTab = 'semua';

function setTab(btn, tab) {
    activeTab = tab;
    document.querySelectorAll('.tab-btn').forEach(t => {
        t.style.background = '#fff';
        t.style.color = '#475569';
        t.style.borderColor = '#e2e8f0';
    });
    btn.style.background = '#6366f1';
    btn.style.color = '#fff';
    btn.style.borderColor = '#6366f1';
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
        <table style="width:100%;font-size:14px;border-collapse:collapse;">
            <tr><td style="padding:8px 0;color:#64748b;width:40%;">Jasa</td><td style="padding:8px 0;font-weight:600;">${data.nama_jasa}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Client</td><td style="padding:8px 0;">${data.nama_client||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Freelancer</td><td style="padding:8px 0;">${data.nama_freelancer||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Tanggal</td><td style="padding:8px 0;">${data.created_at||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Status</td><td style="padding:8px 0;font-weight:600;">${statusMap[data.status]||data.status}</td></tr>
        </table>`;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() { document.getElementById('detailModal').style.display = 'none'; }
document.getElementById('detailModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeDetail(); });
</script>

</body>
</html>
