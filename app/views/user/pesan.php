<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pemesanan Jasa – Servora Client</title>
  <meta name="description" content="Lengkapi detail pesananmu untuk memesan jasa di Servora." />
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
      <a href="cari-jasa.html" class="active">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
        Cari Jasa
      </a>
      <a href="riwayat.html">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" /></svg>
        Riwayat Pesanan
      </a>
      <a href="profil.html">
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
        <h1>Pemesanan Jasa</h1>
        <p>Lengkapi detail pesananmu di bawah ini.</p>
      </div>
    </header>

    <div class="page-content">
      <div class="order-page">
        <div class="order-grid">

          <!-- FORM -->
          <form id="order-form" onsubmit="handleOrder(event)">
            <div class="card">
              <div class="card-body">

                <div class="form-group">
                  <label for="order-title">Judul kebutuhan</label>
                  <input type="text" id="order-title" placeholder="Mis. Desain logo komunitas mahasiswa" required />
                </div>

                <div class="form-group">
                  <label for="order-detail">Detail kebutuhan</label>
                  <textarea id="order-detail" rows="5" placeholder="Jelaskan ekspektasi, referensi, dan deadline kamu." required></textarea>
                </div>

                <div class="form-group">
                  <label for="order-notes">Catatan tambahan <span style="font-weight:400;color:var(--gray-400);">(opsional)</span></label>
                  <textarea id="order-notes" rows="3" placeholder="Hal lain yang perlu freelancer ketahui."></textarea>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                  <label for="order-wa">Nomor WhatsApp kamu</label>
                  <input type="tel" id="order-wa" placeholder="+62 812 ..." required />
                </div>

              </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:16px;justify-content:flex-end;">
              <a href="detail-jasa.html" class="btn btn-outline btn-lg">Batal</a>
              <button type="submit" class="btn btn-primary btn-lg">Konfirmasi Pesanan</button>
            </div>
          </form>

          <!-- SUMMARY -->
          <div>
            <div class="summary-box">
              <div style="font-size:11px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;">Ringkasan</div>

              <div class="summary-service">
                <div class="summary-thumb">🎨</div>
                <div style="min-width:0;">
                  <div style="font-size:13px;font-weight:700;color:var(--gray-800);line-height:1.3;">Desain Logo &amp; Brand Identity ...</div>
                  <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">oleh Aulia Rahma</div>
                </div>
              </div>

              <div class="summary-row"><span>Harga</span><span style="font-weight:600;">Rp 150.000</span></div>
              <div class="summary-row"><span>Estimasi</span><span>3 hari</span></div>
              <div class="summary-total"><span>Total</span><span style="color:var(--primary);">Rp 150.000</span></div>

              <p class="summary-note">Setelah konfirmasi, kamu akan dapat tombol untuk lanjut diskusi via WhatsApp.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function handleOrder(e) {
    e.preventDefault();
    window.location.href = 'pesanan-berhasil.html';
  }
</script>
</body>
</html>
