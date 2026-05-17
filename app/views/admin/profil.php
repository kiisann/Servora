<?php
// session_start();
// if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Admin - Servora</title>
  <link rel="stylesheet" href="../../../public/css/style-admin.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<div class="dashboard-container">

  <aside class="sidebar">
    <div class="sidebar-header">
      <div class="logo-icon">S</div>
      <h2>Servora</h2>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section-title">Admin Panel</div>
      <a href="dashboard.php" class="nav-item"><i class='bx bxs-dashboard'></i> Dashboard</a>
      <a href="kelola_pengguna.php" class="nav-item"><i class='bx bx-group'></i> Kelola Pengguna</a>
      <a href="kelola_jasa.php" class="nav-item"><i class='bx bx-store'></i> Kelola Jasa</a>
      <a href="kelola_pesanan.php" class="nav-item"><i class='bx bx-package'></i> Kelola Pesanan</a>
      <a href="rating.php" class="nav-item"><i class='bx bx-star'></i> Rating &amp; Review</a>
      <a href="monitoring.php" class="nav-item"><i class='bx bx-bar-chart-alt-2'></i> Monitoring</a>
      <a href="profil.php" class="nav-item active"><i class='bx bx-user-circle'></i> Profil Admin</a>
    </nav>

    <div class="sidebar-footer">
      <div class="user-profile-small">
        <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Admin">
        <div class="user-info">
          <div class="name">Admin Servora</div>
          <div class="role">Administrator</div>
        </div>
      </div>
    </div>
  </aside>

  <main class="main-content">

    <header class="top-header">
      <div class="header-left">
        <h1 class="page-title">Profil Admin</h1>
        <p class="page-subtitle">Kelola informasi dan pengaturan akun administrator.</p>
      </div>
      <div class="header-right">
        <div class="search-bar">
          <i class='bx bx-search'></i>
          <input type="text" placeholder="Cari...">
        </div>
        <div class="header-actions">
          <button class="icon-btn"><i class='bx bx-bell'></i></button>
          <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg"
               alt="Profile" class="profile-avatar">
        </div>
      </div>
    </header>

    <div class="profile-grid">

      <div class="profile-card">
        <div class="avatar-wrap">
          <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg"
               alt="Avatar" id="profileAvatar">
          <div class="avatar-overlay"><i class='bx bx-camera'></i></div>
        </div>

        <div class="pc-name">Admin Servora</div>
        <div class="pc-handle">@admin &middot; Sistem</div>
        <span class="pc-badge">Administrator</span>

        <div class="pc-stats">
          <div class="stat-col">
            <span class="val">1.248</span>
            <span class="lbl">Pengguna</span>
          </div>
          <div class="stat-col">
            <span class="val">342</span>
            <span class="lbl">Jasa Aktif</span>
          </div>
          <div class="stat-col">
            <span class="val">2j</span>
            <span class="lbl">Member</span>
          </div>
        </div>

        <button class="btn-logout">
          <i class='bx bx-log-out'></i> Keluar
        </button>
      </div>

      <div class="form-area">

        <div class="tabs" role="tablist">
          <button class="tab-btn active">Informasi</button>
          <button class="tab-btn">Keamanan</button>
          <button class="tab-btn">Pengaturan Sistem</button>
        </div>

        <div class="tab-panel active" id="panel-informasi">
          <form method="POST" action="">

            <fieldset class="form-section">
              <legend class="section-legend">
                <i class='bx bx-user'></i> Data Pribadi
              </legend>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="namaLengkap">Nama Lengkap</label>
                  <input type="text" id="namaLengkap" class="form-control"
                         value="Admin Servora" required>
                </div>
                <div class="form-group">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" id="username" class="form-control"
                         value="admin" required>
                </div>
              </div>
            </fieldset>

            <hr class="form-divider">

            <fieldset class="form-section">
              <legend class="section-legend">
                <i class='bx bx-envelope'></i> Kontak &amp; Catatan
              </legend>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" class="form-control"
                         value="admin@servora.id" required>
                </div>
                <div class="form-group">
                  <label class="form-label" for="nomorHp">Nomor HP</label>
                  <input type="tel" id="nomorHp" class="form-control"
                         value="+62 812 0000 0000">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="bio">Catatan Admin</label>
                <textarea id="bio" class="form-control" rows="3"
                          placeholder="Catatan operasional dan peran...">Bertanggung jawab atas pengelolaan seluruh sistem platform Servora, termasuk verifikasi layanan dan moderasi pengguna.</textarea>
              </div>
            </fieldset>

            <div class="form-actions">
              <button type="button" class="btn btn-secondary">Batal</button>
              <button type="submit" class="btn btn-primary">
                <i class='bx bx-save'></i> Simpan Perubahan
              </button>
            </div>

          </form>
        </div>

        <div class="tab-panel" id="panel-keamanan">
          <div class="empty-state">
            <i class='bx bx-lock-alt'></i>
            <h3>Keamanan Akun</h3>
            <p>Fitur pengaturan kata sandi dan riwayat aktivitas belum tersedia.</p>
          </div>
        </div>

        <div class="tab-panel" id="panel-sistem">
          <div class="empty-state">
            <i class='bx bx-cog'></i>
            <h3>Pengaturan Sistem</h3>
            <p>Fitur notifikasi dan preferensi sistem sedang dalam pengembangan.</p>
          </div>
        </div>

      </div>
    </div>

  </main>
</div>

</body>
</html>
