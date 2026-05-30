<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'freelancer') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$jasaList = $jasa ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jasa – Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Kelola Jasa</h1>
                <p class="page-subtitle">Atur jasa yang kamu tawarkan di Servora.</p>
            </div>
            <div class="header-right">
                <a href="<?= BASE_URL ?>/worker/tambah" class="btn btn-primary btn-icon-gap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Jasa
                </a>
            </div>
        </header>

        <div class="page-content">
            <?php if (!empty($jasaList)): ?>
                <div class="service-grid">
                    <?php foreach($jasaList as $j): ?>
                    <div class="card-container service-card">
                        <a href="<?= BASE_URL ?>/worker/jasa/detail/<?= $j['id_jasa'] ?>" class="service-card-link">
                        <div class="service-card-image">
                            <?php if (!empty($j['gambar'])): ?>
                                <img src="<?= BASE_URL . '/' . htmlspecialchars(ltrim($j['gambar'], '/')) ?>" alt="<?= htmlspecialchars($j['nama_jasa']) ?>" class="service-card-img">
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgba(255,255,255,0.6)" width="48" height="48"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            <?php endif; ?>
                        </div>
                        <div class="service-card-body">
                            <div class="service-card-badge-wrap"><span class="badge secondary badge-compact"><?= htmlspecialchars($j['nama_kategori'] ?? 'Umum') ?></span></div>
                            <div class="service-card-title"><?= htmlspecialchars($j['nama_jasa']) ?></div>
                            <div class="service-card-desc"><?= htmlspecialchars(mb_strimwidth($j['deskripsi'] ?? '', 0, 80, '...')) ?></div>
                            <div class="service-card-meta">
                                <span class="service-card-price">Rp<?= number_format($j['harga'],0,',','.') ?></span>
                                <span class="badge <?= $j['status'] === 'aktif' ? 'success' : 'warning' ?>"><?= ucfirst($j['status']) ?></span>
                            </div>
                        </div>
                        </a>
                        <div class="service-card-actions">
                            <div class="service-card-action-row">
                                <a href="<?= BASE_URL ?>/worker/edit/<?= $j['id_jasa'] ?>" class="service-card-edit">Edit</a>
                                <form method="POST" action="<?= BASE_URL ?>/worker/hapus/<?= $j['id_jasa'] ?>" onsubmit="return confirm('Hapus jasa ini?')" class="service-card-delete-form">
                                    <button type="submit" class="service-card-delete">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="card-container empty-state-card">
                    <div class="empty-state-icon">📦</div>
                    <h3 class="empty-state-title">Belum ada jasa</h3>
                    <p class="empty-state-text">Mulai tambahkan jasa pertamamu untuk mulai menerima pesanan.</p>
                    <a href="<?= BASE_URL ?>/worker/tambah" class="btn btn-primary">Tambah Jasa Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

</body>
</html>
