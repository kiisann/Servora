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
                <h1 class="page-title">Riwayat Pesanan</h1>
                <p class="page-subtitle">Semua pesanan yang sudah selesai atau dibatalkan.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="<?= BASE_URL ?>/jasa" class="btn btn-primary" style="display:flex;align-items:center;gap:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Pesan Jasa Baru
                    </a>
                </div>
            </div>
        </header>

        <div class="page-content">

            <!-- Filter -->
            <div style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">
                <div style="position:relative;max-width:280px;flex:1;">
                    <input type="text" id="searchOrder" placeholder="Cari riwayat..." oninput="filterOrders()"
                           style="width:100%;padding:10px 14px 10px 36px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8" width="16" height="16"
                         style="position:absolute;left:12px;top:50%;transform:translateY(-50%);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
                <select id="filterStatus" onchange="filterOrders()"
                        style="padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;background:#fff;">
                    <option value="">Semua status</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="card-container">
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">ID</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Jasa</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Freelancer</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Tanggal</th>
                                <th style="padding:12px 16px;font-weight:600;color:#64748b;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatBody">
                            <?php if (!empty($riwayatList)): ?>
                                <?php foreach($riwayatList as $p): ?>
                                <?php
                                    $badgeClass = $p['status'] === 'selesai' ? 'success' : 'danger';
                                    $badgeText  = $p['status'] === 'selesai' ? 'Selesai' : 'Dibatalkan';
                                ?>
                                <tr data-status="<?= $p['status'] ?>" style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;font-weight:600;color:#475569;">#<?= $p['id_pesanan'] ?></td>
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $p['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="padding:40px 16px;text-align:center;color:#94a3b8;">
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
