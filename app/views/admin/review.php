<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review - Servora Admin</title>
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
                <h1 class="page-title">Monitoring Rating & Review</h1>
                <p class="page-subtitle">Pantau dan moderasi ulasan pengguna.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="review-grid" style="margin-top: 24px;">
            <?php if (!empty($reviews)): ?>
                <?php foreach($reviews as $r): ?>
                    <div class="review-card">
                        <div class="review-time">
                            <?= htmlspecialchars($r['created_at']) ?>
                        </div>
                        <div class="review-header">
                            <img src="<?= !empty($r['foto']) ? htmlspecialchars($r['foto']) : 'https://via.placeholder.com/50'; ?>" alt="User" >
                            <div class="review-user-info">
                                <span class="review-user-name">
                                    <?= htmlspecialchars($r['nama_user']) ?>
                                </span>
                                <div class="review-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?= $i <= $r['rating'] ? '⭐' : '☆' ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <p class="review-text"><?= htmlspecialchars($r['komentar']) ?></p>
                        <a href="<?= BASE_URL ?>/review/delete/<?= $r['id_review'] ?>">
                            <button class="review-action-btn">Hapus</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="review-card">
                    <p>Tidak ada review.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

</body>
</html>