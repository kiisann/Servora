<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama = htmlspecialchars($_SESSION['nama'] ?? 'Pengguna');
$pesananList = $pesanan ?? [];
$selectedId  = $selected_id ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya – Servora</title>
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
                <h1 class="page-title">Pesanan Saya</h1>
                <p class="page-subtitle">Kelola semua pesanan jasa kamu.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="<?= BASE_URL ?>/jasa" class="btn btn-primary" style="display:flex;align-items:center;gap:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
                        Cari Jasa
                    </a>
                </div>
            </div>
        </header>

        <div class="page-content">

            <div class="card-container">
                <div class="card-header">
                    <h3>Daftar Pesanan</h3>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border-color,#e2e8f0);text-align:left;">
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">ID</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Jasa</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Freelancer</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Tanggal</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Status</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                        'diproses'   => 'Diproses',
                                        'selesai'    => 'Selesai',
                                        'dibatalkan' => 'Dibatalkan',
                                        default      => ucfirst($p['status'])
                                    };
                                ?>
                                <tr style="border-bottom:1px solid #f1f5f9;"
                                    data-pesanan='<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                                    <td style="padding:12px 16px;font-weight:600;color:#475569;">#<?= $p['id_pesanan'] ?></td>
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $p['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td style="padding:12px 16px;">
                                        <button class="btn btn-sm" style="font-size:12px;padding:4px 12px;border:1px solid #e2e8f0;border-radius:6px;background:#fff;cursor:pointer;"
                                                onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="padding:40px 16px;text-align:center;color:#94a3b8;">
                                        Belum ada pesanan. <a href="<?= BASE_URL ?>/jasa" style="color:var(--primary,#6366f1);font-weight:600;">Cari jasa sekarang</a>
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
        <div id="modalActions"
            style="display:flex;gap:10px;justify-content:flex-end;margin-top:24px;">
        </div>
    </div>
</div>

<script>
function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;

    const statusMap = {
        pending: 'Menunggu',
        diskusi: 'Diskusi',
        menunggu_pembayaran: 'Menunggu Pembayaran',
        menunggu_verifikasi: 'Menunggu Verifikasi',
        diproses: 'Diproses',
        selesai: 'Selesai',
        dibatalkan: 'Dibatalkan'
    };

    const canContactWorker = data.status !== 'pending';
    const showFinalDetail = ['menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'selesai'].includes(data.status);
    const cancelButton = data.status === 'pending' ? `
       <form method="POST" action="<?= BASE_URL ?>/pesanan/updateStatus/${data.id_pesanan}">
             <input type="hidden" name="status" value="dibatalkan">
             <button type="submit"
                onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                style="padding:8px 16px;
                      border:none;
                      border-radius:8px;
                      background:#ef4444;
                      color:white;
                      cursor:pointer;">
                Batalkan Pesanan
             </button>
       </form>
    ` : '';
    
    const contactRow = canContactWorker ? `
        <tr>
            <td style="padding:8px 0;color:#64748b;">Kontak</td>
            <td style="padding:8px 0;">
                <a href="https://wa.me/${data.no_hp_freelancer ? data.no_hp_freelancer.replace(/^0/, '62') : ''}"
                   target="_blank"
                   style="color:#25D366;font-weight:600;text-decoration:none;">
                   Hubungi Freelancer
                </a>
            </td>
        </tr>
    ` : '';

    const finalDetailRows = showFinalDetail ? `
        <tr><td style="padding:8px 0;color:#64748b;">Harga Awal</td><td style="padding:8px 0;color:#1e293b;">${data.harga_awal ? 'Rp' + Number(data.harga_awal).toLocaleString('id-ID') : '-'}</td></tr>
        <tr><td style="padding:8px 0;color:#64748b;">Harga Final</td><td style="padding:8px 0;color:#1e293b;">${data.harga_final ? 'Rp' + Number(data.harga_final).toLocaleString('id-ID') : '-'}</td></tr>
        <tr><td style="padding:8px 0;color:#64748b;">Deadline Final</td><td style="padding:8px 0;color:#1e293b;">${data.deadline_final || '-'}</td></tr>
        <tr><td style="padding:8px 0;color:#64748b;">Waktu Pengerjaan</td><td style="padding:8px 0;color:#1e293b;">${data.waktu_pengerjaan || '-'}</td></tr>
        <tr><td style="padding:8px 0;color:#64748b;">Maksimal Revisi</td><td style="padding:8px 0;color:#1e293b;">${data.maksimal_revisi || '-'}</td></tr>
        <tr><td style="padding:8px 0;color:#64748b;">Catatan Worker</td><td style="padding:8px 0;color:#1e293b;">${data.catatan_worker || '-'}</td></tr>
    ` : '';

    document.getElementById('modalContent').innerHTML = `
        <table style="width:100%;font-size:14px;border-collapse:collapse;">
            <tr><td style="padding:8px 0;color:#64748b;width:40%;">Nama Jasa</td><td style="padding:8px 0;font-weight:600;color:#1e293b;">${data.nama_jasa}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Freelancer</td><td style="padding:8px 0;color:#1e293b;">${data.nama_freelancer || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Tanggal</td><td style="padding:8px 0;color:#1e293b;">${data.created_at || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Deadline</td><td style="padding:8px 0;color:#1e293b;">${data.deadline || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Catatan</td><td style="padding:8px 0;color:#1e293b;">${data.catatan || '-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Status</td><td style="padding:8px 0;font-weight:600;">${statusMap[data.status] || data.status}</td></tr>
            ${finalDetailRows}
            ${contactRow}
        </table>`;

    document.getElementById('modalActions').innerHTML = `
        ${cancelButton}
        <button onclick="closeDetail()"
            style="padding:8px 16px;
                   border:1px solid #e2e8f0;
                   border-radius:8px;
                   background:#fff;
                   cursor:pointer;">
            Tutup
        </button>
    `;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() {
    document.getElementById('detailModal').style.display = 'none';
}

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetail();
});

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
