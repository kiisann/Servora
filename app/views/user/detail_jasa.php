<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}

$jasaItem  = $jasa    ?? null;
$reviewList = $reviews ?? [];

// Jika jasa tidak ditemukan, redirect balik
if (!$jasaItem) {
    header('Location: ' . BASE_URL . '/jasa'); exit;
}

// Hitung rating rata-rata
$avgRating = 0;
if (!empty($reviewList)) {
    $totalRating = array_sum(array_column($reviewList, 'rating'));
    $avgRating   = round($totalRating / count($reviewList), 1);
}

$hargaFormat = 'Rp' . number_format($jasaItem['harga'], 0, ',', '.');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($jasaItem['nama_jasa']) ?> – Servora</title>
    <meta name="description" content="<?= htmlspecialchars(mb_substr($jasaItem['deskripsi'] ?? '', 0, 150)) ?>">
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
                <a href="<?= BASE_URL ?>/jasa" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Cari Jasa
                </a>
                <h1 class="page-title">Detail Jasa</h1>
                <p class="page-subtitle">Informasi lengkap tentang layanan ini.</p>
            </div>
        </header>

        <div class="page-content">

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="detail-grid">

                <!-- Kolom Kiri: Info Jasa + Review -->
                <div>
                    <!-- Banner + Info Jasa -->
                    <div class="detail-card detail-card-mb">
                        <div class="jasa-banner">🎨</div>
                        <div class="detail-body">
                            <div class="jasa-meta">
                                <span class="badge secondary fs-11">
                                    <?= htmlspecialchars($jasaItem['nama_kategori'] ?? 'Umum') ?>
                                </span>
                                <?php if ($avgRating > 0): ?>
                                    <span class="jasa-rating-inline">
                                        ⭐ <?= $avgRating ?> (<?= count($reviewList) ?> ulasan)
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h2 class="jasa-title"><?= htmlspecialchars($jasaItem['nama_jasa']) ?></h2>
                            <p class="jasa-by">
                                Oleh <strong><?= htmlspecialchars($jasaItem['nama_freelancer'] ?? '-') ?></strong>
                            </p>
                            <hr class="divider">
                            <div class="section-label">Deskripsi</div>
                            <p class="jasa-desc"><?= htmlspecialchars($jasaItem['deskripsi'] ?? 'Tidak ada deskripsi.') ?></p>
                        </div>
                    </div>

                    <!-- Ulasan -->
                    <div class="detail-card">
                        <div class="detail-body">
                            <div class="review-section-title">Ulasan Pengguna</div>

                            <?php if (!empty($reviewList)): ?>
                                <div class="rating-summary">
                                    <div class="rating-big"><?= $avgRating ?></div>
                                    <div>
                                        <div class="stars">
                                            <?php for($i=1;$i<=5;$i++) echo $i<=$avgRating?'★':'☆'; ?>
                                        </div>
                                        <div class="rating-meta"><?= count($reviewList) ?> ulasan</div>
                                    </div>
                                </div>

                                <?php foreach($reviewList as $r): ?>
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="review-avatar">
                                            <?= strtoupper(mb_substr($r['nama_client'] ?? 'U', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="review-name"><?= htmlspecialchars($r['nama_client'] ?? 'Pengguna') ?></div>
                                            <div class="stars">
                                                <?php for($i=1;$i<=5;$i++) echo $i<=$r['rating']?'★':'☆'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-text"><?= htmlspecialchars($r['komentar'] ?? '') ?></p>
                                </div>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <div class="empty-review">
                                    <div class="empty-review-icon">💬</div>
                                    <p class="empty-review-text">Belum ada ulasan untuk jasa ini.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Pesan -->
                <div>
                    <div class="order-card">
                        <div class="order-price"><?= $hargaFormat ?></div>
                        <div class="order-label">Harga per pesanan</div>

                        <?php if ($role === 'client'): ?>
                        <form action="<?= BASE_URL ?>/pesanan/order" method="POST">
                            <input type="hidden" name="id_jasa" value="<?= (int)$jasaItem['id_jasa'] ?>">

                            <div class="form-group form-mb">
                                <label for="deadline">Deadline</label>
                                <input type="date" id="deadline" name="deadline"
                                       class="form-input"
                                       min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                                       required>
                            </div>

                            <div class="form-group form-mb-lg">
                                <label for="catatan">Catatan / Detail Kebutuhan</label>
                                <textarea id="catatan" name="catatan" rows="4"
                                          class="form-textarea"
                                          placeholder="Jelaskan kebutuhanmu secara detail..."></textarea>
                            </div>
                            <div class="form-group form-mb">
    <label for="id_metode">Metode Pembayaran</label>
    <select id="id_metode" name="id_metode" class="form-input" required>
        <option value="">Pilih metode pembayaran</option>
        <option value="1">Transfer Bank</option>
        <option value="2">E-Wallet</option>
        <option value="3">QRIS</option>
    </select>
</div>

                            <button type="submit" class="btn-order">
                                🛒 Pesan Sekarang
                            </button>
                        </form>
                        <?php elseif ($role === 'admin'): ?>
                            <div class="order-admin-msg">
                                Mode admin — tidak bisa memesan.
                            </div>
                        <?php endif; ?>

                        <hr class="divider">
                        <div class="order-info">
                            <strong>Info Layanan:</strong><br>
                            Kategori: <?= htmlspecialchars($jasaItem['nama_kategori'] ?? '-') ?><br>
                            Freelancer: <?= htmlspecialchars($jasaItem['nama_freelancer'] ?? '-') ?><br>
                            Status: <span class="order-info-status"><?= ucfirst($jasaItem['status'] ?? '-') ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

</body>
</html>
