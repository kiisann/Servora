<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama  = htmlspecialchars($_SESSION['nama'] ?? 'Pengguna');
$sessionEmail = htmlspecialchars($_SESSION['email'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Client – Servora</title>
  <meta name="description" content="Dashboard client Servora – pantau pesanan dan temukan jasa mahasiswa terbaik." />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css" />
</head>
<body>
<div class="dashboard-container">

  <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

  <div class="main-content">

    <header class="top-header">
      <div class="header-left">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Halo <?= $sessionNama ?>, ini ringkasan aktivitasmu.</p>
      </div>
      <div class="header-right">
        <div class="header-actions">
          <a href="<?= BASE_URL ?>/jasa" class="btn btn-primary btn-icon-gap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
            Cari Jasa
          </a>
          <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
        </div>
      </div>
    </header>

    <div class="page-content">

      <!-- STAT CARDS -->
      <div class="stat-grid">
        <div class="stat-card">
          <div class="stat-icon blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" /></svg>
          </div>
          <div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value"><?= $total_pesanan ?? 0 ?></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>
          </div>
          <div>
            <div class="stat-label">Sedang Berjalan</div>
            <div class="stat-value"><?= $pesanan_berjalan ?? 0 ?></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>
          </div>
          <div>
            <div class="stat-label">Selesai</div>
            <div class="stat-value"><?= $pesanan_selesai ?? 0 ?></div>
          </div>
        </div>
      </div>

      <!-- MAIN GRID -->
      <div class="dashboard-grid">

        <!-- RECENT ORDERS -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Pesanan terbaru</span>
            <a href="<?= BASE_URL ?>/riwayat" class="btn btn-ghost btn-sm header-action-link">Lihat semua</a>
          </div>
          <div class="card-body card-body-flush-x">
            <?php if (!empty($recent_pesanan)): ?>
              <?php foreach($recent_pesanan as $p): ?>
              <?php
                $badgeClass = match($p['status']) {
                  'pending'    => 'badge-yellow',
                  'diproses'   => 'badge-blue',
                  'selesai'    => 'badge-green',
                  'dibatalkan' => 'badge-red',
                  default      => 'badge-blue'
                };
                $badgeText = match($p['status']) {
                  'pending'    => 'Menunggu',
                  'diproses'   => 'Diproses',
                  'selesai'    => 'Selesai',
                  'dibatalkan' => 'Dibatalkan',
                  default      => ucfirst($p['status'])
                };
              ?>
              <div class="order-item">
                <div>
                  <div class="order-title"><?= htmlspecialchars($p['nama_jasa']) ?></div>
                  <div class="order-meta">#<?= $p['id_pesanan'] ?> &bull; <?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></div>
                </div>
                <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
              </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="order-item"><div><div class="order-meta">Belum ada pesanan.</div></div></div>
            <?php endif; ?>
          </div>
        </div>

        <!-- RECOMMENDATIONS -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Rekomendasi untukmu</span>
          </div>
          <div class="card-body card-body-flush-x">
            <div class="rec-item" onclick="location.href='<?= BASE_URL ?>/jasa'">
              <div class="rec-thumb">🎨</div>
              <div class="item-flex-fill">
                <div class="rec-title">Desain Logo &amp; Brand Identity ...</div>
                <div class="rec-price">Rp 150.000</div>
              </div>
              <div class="rating"><span class="star">★</span> 4.9</div>
            </div>
            <div class="rec-item" onclick="location.href='<?= BASE_URL ?>/jasa'">
              <div class="rec-thumb">✍️</div>
              <div class="item-flex-fill">
                <div class="rec-title">Jasa Pengetikan &amp; Penulisan M...</div>
                <div class="rec-price">Rp 35.000</div>
              </div>
              <div class="rating"><span class="star">★</span> 4.7</div>
            </div>
            <div class="rec-item" onclick="location.href='<?= BASE_URL ?>/jasa'">
              <div class="rec-thumb">💻</div>
              <div class="item-flex-fill">
                <div class="rec-title">Pembuatan Website Portofolio R...</div>
                <div class="rec-price">Rp 450.000</div>
              </div>
              <div class="rating"><span class="star">★</span> 5</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>
