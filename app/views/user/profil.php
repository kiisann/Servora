<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil – Servora Client</title>
  <meta name="description" content="Kelola informasi profil akunmu di Servora." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../public/css/style_user.css" />
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
      <a href="index.html">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7m-9 5v6m-4-6h14" /></svg>
        Dashboard
      </a>
      <a href="cari-jasa.html">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
        Cari Jasa
      </a>
      <a href="riwayat.html">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" /></svg>
        Riwayat Pesanan
      </a>
      <a href="profil.html" class="active">
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
          <div style="margin-top:10px;">
            <span class="badge badge-blue">Client</span>
          </div>
        </div>
        <div style="margin-left:auto;">
          <button class="btn btn-outline" onclick="toggleEdit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931zm0 0L19.5 7.125" /></svg>
            Edit Profil
          </button>
        </div>
      </div>

      <!-- FORM SECTION -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

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
              <div class="form-group" style="margin-bottom:0;">
                <label for="bio">Bio singkat</label>
                <textarea id="bio" rows="3" disabled>Mahasiswa aktif yang sering membutuhkan jasa desain dan konten.</textarea>
              </div>
              <div id="save-btn-wrap" style="display:none;margin-top:16px;text-align:right;">
                <button type="button" class="btn btn-outline" style="margin-right:8px;" onclick="cancelEdit()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div style="display:flex;flex-direction:column;gap:16px;">

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
              <div class="form-group" style="margin-bottom:0;">
                <label for="confirm-pw">Konfirmasi password baru</label>
                <input type="password" id="confirm-pw" placeholder="Ulangi password baru" />
              </div>
              <div style="margin-top:16px;text-align:right;">
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
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div style="background:var(--gray-50);border-radius:8px;padding:14px;text-align:center;">
                  <div style="font-size:22px;font-weight:800;color:var(--primary);">4</div>
                  <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">Total Pesanan</div>
                </div>
                <div style="background:var(--gray-50);border-radius:8px;padding:14px;text-align:center;">
                  <div style="font-size:22px;font-weight:800;color:var(--success);">2</div>
                  <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">Selesai</div>
                </div>
                <div style="background:var(--gray-50);border-radius:8px;padding:14px;text-align:center;">
                  <div style="font-size:22px;font-weight:800;color:#ea580c;">1</div>
                  <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">Berjalan</div>
                </div>
                <div style="background:var(--gray-50);border-radius:8px;padding:14px;text-align:center;">
                  <div style="font-size:22px;font-weight:800;color:var(--gray-400);">1</div>
                  <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">Dibatalkan</div>
                </div>
              </div>
              <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--gray-100);display:flex;justify-content:space-between;font-size:13px;color:var(--gray-600);">
                <span>Total pengeluaran</span>
                <span style="font-weight:700;color:var(--gray-900);">Rp 605.000</span>
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
