<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'freelancer') {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}

$jasaItem = $jasa_item ?? [];
$reviews = $reviews ?? [];
$summary = $review_summary ?? ['total_review' => 0, 'rata_rating' => 0];
$ratingAverage = (float)($summary['rata_rating'] ?? 0);
$reviewTotal = (int)($summary['total_review'] ?? 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jasa - Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <a href="<?= BASE_URL ?>/worker/jasa" class="service-form-back">
                    <svg class="service-form-back-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Kembali ke Kelola Jasa
                </a>
                <h1 class="page-title">Detail Jasa</h1>
                <p class="page-subtitle">Lihat informasi jasa dan review dari client.</p>
            </div>
        </header>

        <div class="page-content worker-service-detail-page">
            <section class="worker-service-detail-hero">
                <div class="worker-service-detail-image">
                    <?php if (!empty($jasaItem['gambar'])): ?>
                        <img src="<?= BASE_URL . '/' . htmlspecialchars(ltrim($jasaItem['gambar'], '/')) ?>" alt="<?= htmlspecialchars($jasaItem['nama_jasa'] ?? 'Jasa') ?>">
                    <?php else: ?>
                        <div class="worker-service-detail-placeholder">Jasa</div>
                    <?php endif; ?>
                </div>

                <div class="worker-service-detail-content">
                    <div class="worker-service-detail-meta">
                        <span class="badge secondary"><?= htmlspecialchars($jasaItem['nama_kategori'] ?? 'Umum') ?></span>
                        <span class="badge <?= ($jasaItem['status'] ?? '') === 'aktif' ? 'success' : 'warning' ?>"><?= htmlspecialchars(ucfirst($jasaItem['status'] ?? '-')) ?></span>
                    </div>
                    <h2><?= htmlspecialchars($jasaItem['nama_jasa'] ?? '-') ?></h2>
                    <p><?= nl2br(htmlspecialchars($jasaItem['deskripsi'] ?? '-')) ?></p>

                    <div class="worker-service-detail-stats">
                        <div>
                            <span>Harga</span>
                            <strong>Rp<?= number_format((float)($jasaItem['harga'] ?? 0), 0, ',', '.') ?></strong>
                        </div>
                        <div>
                            <span>Rating</span>
                            <strong><?= number_format($ratingAverage, 1) ?>/5</strong>
                        </div>
                        <div>
                            <span>Total Review</span>
                            <strong><?= $reviewTotal ?></strong>
                        </div>
                    </div>
                </div>
            </section>

            <section class="worker-service-review-section">
                <div class="worker-service-section-head">
                    <h3>Ulasan Pengguna</h3>
                    <span><?= $reviewTotal ?> review</span>
                </div>

                <?php if (!empty($reviews)): ?>
                    <div class="worker-service-review-list">
                        <?php foreach ($reviews as $review): ?>
                            <article class="worker-service-review-item">
                                <div class="worker-service-review-top">
                                    <div>
                                        <strong><?= htmlspecialchars($review['nama_client'] ?? '-') ?></strong>
                                        <span><?= htmlspecialchars($review['created_at'] ?? '-') ?></span>
                                    </div>
                                    <div class="worker-service-review-rating"><?= number_format((float)($review['rating'] ?? 0), 1) ?>/5</div>
                                </div>
                                <p><?= nl2br(htmlspecialchars($review['komentar'] ?? '-')) ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="worker-service-review-empty">
                        Belum ada review untuk jasa ini.
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>
</div>

</body>
</html>
