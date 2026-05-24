<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama  = htmlspecialchars($_SESSION['nama'] ?? 'Freelancer');
$pesananList  = $pesanan ?? [];
$selectedId   = $selected_id ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk – Servora</title>
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
                <h1 class="page-title">Pesanan Masuk</h1>
                <p class="page-subtitle">Kelola dan pantau status seluruh pesanan.</p>
            </div>
            <div class="header-right">
                <div style="position:relative;max-width:260px;">
                    <input type="text" id="searchOrder" placeholder="Cari pesanan..." oninput="filterOrders()"
                           style="width:100%;padding:10px 14px 10px 36px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8" width="16" height="16"
                         style="position:absolute;left:12px;top:50%;transform:translateY(-50%);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
            </div>
        </header>

        <div class="page-content">

            <!-- Tab Filter -->
            <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
                <button class="tab-btn active" onclick="setTab(this,'semua')" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:13px;font-weight:600;">Semua</button>
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
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Jasa</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Client</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Status</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Tanggal</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Aksi</th>
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
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($p['nama_client'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $p['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;">
                                        <button style="font-size:12px;padding:4px 12px;border:1px solid #e2e8f0;border-radius:6px;background:#fff;cursor:pointer;color:#6366f1;font-weight:600;"
                                                onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="padding:40px 16px;text-align:center;color:#94a3b8;">
                                        Belum ada pesanan masuk.
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

<!-- Detail Modal Popup -->
<div id="detailModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:500;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px 32px;max-width:480px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#1e293b;" id="modalTitle">Detail Pesanan</h3>
            <button onclick="closeDetail()" style="background:none;border:none;font-size:22px;color:#64748b;cursor:pointer;">✕</button>
        </div>
        <div id="modalContent"></div>
        <div id="modalActions" style="display:flex;gap:10px;justify-content:flex-end;margin-top:24px;"></div>
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
    filterOrders();
}

function filterOrders() {
    const keyword = document.getElementById('searchOrder').value.toLowerCase();
    const rows = document.querySelectorAll('#ordersBody tr[data-status]');
    rows.forEach(row => {
        const status = row.dataset.status;
        const text = row.textContent.toLowerCase();
        let tabMatch = activeTab === 'semua' || status === activeTab;
        const kwMatch = !keyword || text.includes(keyword);
        row.style.display = (tabMatch && kwMatch) ? '' : 'none';
    });
}

function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;

    const statusMap = {pending:'Menunggu',diproses:'Berlangsung',selesai:'Selesai',dibatalkan:'Dibatalkan'};

    document.getElementById('modalContent').innerHTML = `
        <table style="width:100%;font-size:14px;border-collapse:collapse;">
            <tr><td style="padding:8px 0;color:#64748b;width:40%;">Nama Jasa</td><td style="padding:8px 0;font-weight:600;color:#1e293b;">${data.nama_jasa}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Client</td><td style="padding:8px 0;color:#1e293b;">${data.nama_client || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Tanggal</td><td style="padding:8px 0;color:#1e293b;">${data.created_at || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Deadline</td><td style="padding:8px 0;color:#1e293b;">${data.deadline || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Catatan</td><td style="padding:8px 0;color:#1e293b;">${data.catatan || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Status</td><td style="padding:8px 0;font-weight:600;">${statusMap[data.status] || data.status}</td></tr>
        </table>`;

    let actionsHtml = `<button onclick="closeDetail()" style="padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;">Tutup</button>`;

    if (data.status === 'pending') {
        actionsHtml += `
            <form method="POST" action="<?= BASE_URL ?>/pesanan/updateStatus/${data.id_pesanan}" style="display:inline;">
                <input type="hidden" name="status" value="diproses">
                <button type="submit" style="padding:8px 16px;border:none;border-radius:8px;background:#6366f1;color:#fff;cursor:pointer;font-weight:600;">Terima Pesanan</button>
            </form>`;
    } else if (data.status === 'diproses') {
        actionsHtml += `
            <form method="POST" action="<?= BASE_URL ?>/pesanan/updateStatus/${data.id_pesanan}" style="display:inline;">
                <input type="hidden" name="status" value="selesai">
                <button type="submit" style="padding:8px 16px;border:none;border-radius:8px;background:#10b981;color:#fff;cursor:pointer;font-weight:600;">Tandai Selesai</button>
            </form>`;
    }
    document.getElementById('modalActions').innerHTML = actionsHtml;

    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() {
    document.getElementById('detailModal').style.display = 'none';
}

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetail();
});

// Init: set first tab active style
document.querySelector('.tab-btn').style.background = '#6366f1';
document.querySelector('.tab-btn').style.color = '#fff';
document.querySelector('.tab-btn').style.borderColor = '#6366f1';

<?php if ($selectedId): ?>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tr[data-pesanan]');
    rows.forEach(row => {
        const d = JSON.parse(row.dataset.pesanan);
        if (d.id_pesanan == <?= (int)$selectedId ?>) openDetail(row);
    });
});
<?php endif; ?>
</script>

</body>
</html>
