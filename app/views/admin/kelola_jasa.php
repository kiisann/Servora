<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$jasaList = $jasa ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jasa – Servora Admin</title>
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
                <h1 class="page-title">Kelola Jasa</h1>
                <p class="page-subtitle">Tinjau dan moderasi seluruh jasa yang dipublikasikan.</p>
            </div>
        </header>

        <div class="page-content">
            <div class="card-container">
                <div class="card-header">
                    <h3>Daftar Jasa</h3>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Nama Jasa</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Kategori</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Freelancer</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Harga</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Status</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($jasaList)): ?>
                                <?php foreach($jasaList as $j): ?>
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($j['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><span class="badge secondary"><?= htmlspecialchars($j['nama_kategori'] ?? '-') ?></span></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($j['nama_freelancer'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;font-weight:600;">Rp<?= number_format($j['harga'],0,',','.') ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $j['status'] === 'aktif' ? 'success' : 'warning' ?>"><?= ucfirst($j['status']) ?></span></td>
                                    <td style="padding:12px 16px; text-align: center;">
                                        <button class="text-action-btn view" style="font-size:12px;padding:4px 10px;border:1px solid #e2e8f0;border-radius:6px;background:#fff;cursor:pointer;color:#6366f1;font-weight:600;">Lihat</button>

                                        <a href="<?= BASE_URL ?>/jasa/delete/<?= $j['id_jasa'] ?>" class="btn-delete">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="padding:40px;text-align:center;color:#94a3b8;">Belum ada jasa terdaftar.</td></tr>
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
