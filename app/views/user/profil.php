<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil – Servora Client</title>
  <meta name="description" content="Kelola informasi profil akunmu di Servora." />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
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
      <a href="dashboard.php" id="nav-dashboard">
        Dashboard
      </a>
      <a href="cari_jasa.php" id="nav-cari">
        Cari Jasa
      </a>
      <a href="riwayat.php" id="nav-riwayat">
        Riwayat Pesanan
      </a>
      <a href="profil.php" class="active" id="nav-profil">
        Profil
      </a>
    </nav>
    <div class="sidebar-user">
      <a href="profil.php" class="profile-user-link">
        <div class="avatar">R</div>
        <div class="user-info">
          <div class="user-name">Rina Pratiwi</div>
          <div class="user-email">rina@student.ac.id</div>
        </div>
      </a>
      <button class="logout-btn" title="Keluar" onClick="window.location.href='../../views/auth/login.php'">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0l-3-3m3 3H9" /></svg>
      </button>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <header class="topbar">
      <div class="topbar-title">
        <h1>Profil</h1>
        <p>Kelola informasi akun dan preferensimu.</p>
      </div>
    </header>

    <div class="page-content">

      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="profile-avatar">R</div>
        <div>
          <div class="profile-name">Rina Pratiwi</div>
          <div class="profile-email">rina@student.ac.id</div>
          <div class="profile-badge-wrap">
            <span class="badge badge-blue">Client</span>
          </div>
        </div>
        <div class="profile-header-action">
          <button class="btn btn-outline" onclick="toggleEdit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="icon-sm"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931zm0 0L19.5 7.125" /></svg>
            Edit Profil
          </button>
        </div>
      </div>

      <!-- FORM SECTION -->
      <div class="profile-main-grid">

        <!-- INFO PRIBADI -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Informasi Pribadi</span>
          </div>
          <div class="card-body">
            <form id="profile-form" onsubmit="saveProfile(event)">
              <div class="form-grid">
                <div class="form-group">
                  <label for="first-name">Nama depan</label>
                  <input type="text" id="first-name" value="Rina" disabled />
                </div>
                <div class="form-group">
                  <label for="last-name">Nama belakang</label>
                  <input type="text" id="last-name" value="Pratiwi" disabled />
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="rina@student.ac.id" disabled />
              </div>
              <div class="form-group">
                <label for="phone">Nomor WhatsApp</label>
                <input type="tel" id="phone" value="+62 812 3456 7890" disabled />
              </div>
              <div class="form-group">
                <label for="university">Universitas</label>
                <input type="text" id="university" value="Universitas Indonesia" disabled />
              </div>
              <div class="form-group form-group-flat">
                <label for="bio">Bio singkat</label>
                <textarea id="bio" rows="3" disabled>Mahasiswa aktif yang sering membutuhkan jasa desain dan konten.</textarea>
              </div>
              <div id="save-btn-wrap" class="profile-save-actions">
                <button type="button" class="btn btn-outline btn-spaced-right" onclick="cancelEdit()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="profile-side-column">

          <!-- KEAMANAN -->
          <div class="card">
            <div class="card-header">
              <span class="card-title">Keamanan</span>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="current-pw">Password saat ini</label>
                <input type="password" id="current-pw" placeholder="••••••••" />
              </div>
              <div class="form-group">
                <label for="new-pw">Password baru</label>
                <input type="password" id="new-pw" placeholder="Min. 8 karakter" />
              </div>
              <div class="form-group form-group-flat">
                <label for="confirm-pw">Konfirmasi password baru</label>
                <input type="password" id="confirm-pw" placeholder="Ulangi password baru" />
              </div>
              <div class="profile-form-submit-actions">
                <button class="btn btn-primary" onclick="alert('Password berhasil diperbarui!')">Perbarui Password</button>
              </div>
            </div>
          </div>

          <!-- STATISTIK -->
          <div class="card">
            <div class="card-header">
              <span class="card-title">Statistik Akun</span>
            </div>
            <div class="card-body">
              <div class="profile-stats-grid">
                <div class="profile-stat-box">
                  <div class="profile-stat-number primary">4</div>
                  <div class="profile-stat-label">Total Pesanan</div>
                </div>
                <div class="profile-stat-box">
                  <div class="profile-stat-number success">2</div>
                  <div class="profile-stat-label">Selesai</div>
                </div>
                <div class="profile-stat-box">
                  <div class="profile-stat-number warning">1</div>
                  <div class="profile-stat-label">Berjalan</div>
                </div>
                <div class="profile-stat-box">
                  <div class="profile-stat-number muted">1</div>
                  <div class="profile-stat-label">Dibatalkan</div>
                </div>
              </div>
              <div class="profile-total-row">
                <span>Total pengeluaran</span>
                <span class="profile-total-price">Rp 605.000</span>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<script>
  let editing = false;

  function toggleEdit() {
    editing = true;
    const fields = document.querySelectorAll('#profile-form input, #profile-form textarea');
    fields.forEach(f => f.disabled = false);
    document.getElementById('save-btn-wrap').style.display = 'block';
  }

  function cancelEdit() {
    editing = false;
    const fields = document.querySelectorAll('#profile-form input, #profile-form textarea');
    fields.forEach(f => f.disabled = true);
    document.getElementById('save-btn-wrap').style.display = 'none';
  }

  function saveProfile(e) {
    e.preventDefault();
    cancelEdit();
    const name = document.getElementById('first-name').value + ' ' + document.getElementById('last-name').value;
    document.querySelector('.profile-name').textContent = name;
    document.querySelector('.user-name').textContent = name;
    alert('Profil berhasil disimpan!');
  }
</script>
</body>
</html>
