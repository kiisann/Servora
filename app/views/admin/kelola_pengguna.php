<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$pengguna = $pengguna ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna – Servora Admin</title>
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
                <h1 class="page-title">Kelola Pengguna</h1>
                <p class="page-subtitle">Kelola data client, freelancer, dan admin.</p>
            </div>
        </header>

        <div class="page-content">
            <div class="card-container">
                <div class="card-header">
                    <h3>Daftar Pengguna</h3>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Nama</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Email</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Role</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Kampus</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Bergabung</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pengguna)): ?>
                                <?php foreach($pengguna as $u): ?>
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;">
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div style="width:36px;height:36px;border-radius:50%;background:#ede9fe;color:#6366f1;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;"><?= strtoupper(mb_substr($u['nama'],0,1)) ?></div>
                                            <span style="font-weight:600;"><?= htmlspecialchars($u['nama']) ?></span>
                                        </div>
                                    </td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= htmlspecialchars($u['email']) ?></td>
                                    <td style="padding:12px 16px;"><span class="badge secondary"><?= ucfirst($u['role']) ?></span></td>
                                    <td style="padding:12px 16px;font-weight:500;"><?= htmlspecialchars($u['kampus'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $u['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= ($u['status'] ?? 'aktif') === 'aktif' ? 'success' : 'danger' ?>"><?= ucfirst($u['status'] ?? 'aktif') ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="padding:40px;text-align:center;color:#94a3b8;">Belum ada pengguna terdaftar.</td></tr>
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
