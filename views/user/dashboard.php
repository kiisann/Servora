<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Client – Servora</title>
  <meta name="description" content="Dashboard client Servora – pantau pesanan dan temukan jasa mahasiswa terbaik." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">S</div>
      <span class="logo-text">Servora</span>
    </div>

    <div class="sidebar-section-label">Area Client</div>
    <nav class="sidebar-nav">
      <a href="dashboard.php" class="active" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7m-9 5v6m-4-6h14" /></svg>
        Dashboard
      </a>
      <a href="cari_jasa.php" id="nav-cari">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
        Cari Jasa
      </a>
      <a href="riwayat.php" id="nav-riwayat">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" /></svg>
        Riwayat Pesanan
      </a>
      <a href="profil.php" id="nav-profil">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
        Profil
      </a>
    </nav>

    <div class="sidebar-user">
      <div class="avatar">R</div>
      <div class="user-info">
        <div class="user-name">Rina Pratiwi</div>
        <div class="user-email">rina@student.ac.id</div>
      </div>
      <button class="logout-btn" title="Keluar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0l-3-3m3 3H9" /></svg>
      </button>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-title">
        <h1>Dashboard</h1>
        <p>Halo Rina, ini ringkasan aktivitasmu.</p>
      </div>
      <a href="cari-jasa.html" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
        Cari Jasa
      </a>
    </header>

    <!-- PAGE CONTENT -->
    <div class="page-content">

      <!-- STAT CARDS -->
      <div class="stat-grid">
        <div class="stat-card">
          <div class="stat-icon blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" /></svg>
          </div>
          <div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value">2</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>
          </div>
          <div>
            <div class="stat-label">Sedang Berjalan</div>
            <div class="stat-value">1</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>
          </div>
          <div>
            <div class="stat-label">Selesai</div>
            <div class="stat-value">1</div>
          </div>
        </div>
      </div>

      <!-- MAIN GRID -->
      <div class="dashboard-grid">

        <!-- RECENT ORDERS -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Pesanan terbaru</span>
            <a href="riwayat.html" class="btn btn-ghost btn-sm" style="font-size:13px;color:var(--primary);font-weight:600;">Lihat semua</a>
          </div>
          <div class="card-body" style="padding:0 20px;">
            <div class="order-item">
              <div>
                <div class="order-title">Pembuatan Website Portofolio React</div>
                <div class="order-meta">ORD-1024 &bull; 2026-04-28</div>
              </div>
              <span class="badge badge-blue">Diproses</span>
            </div>
            <div class="order-item">
              <div>
                <div class="order-title">Jasa Pengetikan &amp; Penulisan Makalah</div>
                <div class="order-meta">ORD-1023 &bull; 2026-04-25</div>
              </div>
              <span class="badge badge-green">Selesai</span>
            </div>
          </div>
        </div>

        <!-- RECOMMENDATIONS -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Rekomendasi untukmu</span>
          </div>
          <div class="card-body" style="padding:0 20px;">
            <div class="rec-item" onclick="location.href='detail-jasa.html'">
              <div class="rec-thumb">🎨</div>
              <div style="flex:1;min-width:0;">
                <div class="rec-title">Desain Logo &amp; Brand Identity ...</div>
                <div class="rec-price">Rp 150.000</div>
              </div>
              <div class="rating"><span class="star">★</span> 4.9</div>
            </div>
            <div class="rec-item" onclick="location.href='detail-jasa.html'">
              <div class="rec-thumb">✍️</div>
              <div style="flex:1;min-width:0;">
                <div class="rec-title">Jasa Pengetikan &amp; Penulisan M...</div>
                <div class="rec-price">Rp 35.000</div>
              </div>
              <div class="rating"><span class="star">★</span> 4.7</div>
            </div>
            <div class="rec-item" onclick="location.href='detail-jasa.html'">
              <div class="rec-thumb">💻</div>
              <div style="flex:1;min-width:0;">
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
