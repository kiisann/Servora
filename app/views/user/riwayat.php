<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pesanan – Servora Client</title>
  <meta name="description" content="Lihat semua riwayat pesanan jasamu di Servora." />
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
      <a href="riwayat.html" class="active">
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
        <h1>Riwayat Pesanan</h1>
        <p>Semua pesanan yang pernah kamu buat.</p>
      </div>
      <a href="cari-jasa.html" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
        Pesan Jasa Baru
      </a>
    </header>

    <div class="page-content">

      <!-- FILTER BAR -->
      <div style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">
        <div class="search-input-wrap" style="max-width:280px;">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
          <input type="text" id="search-order" placeholder="Cari pesanan..." oninput="filterOrders()" />
        </div>
        <select class="filter-select" id="filter-status" onchange="filterOrders()">
          <option value="">Semua status</option>
          <option value="Diproses">Diproses</option>
          <option value="Selesai">Selesai</option>
          <option value="Dibatalkan">Dibatalkan</option>
        </select>
      </div>

      <!-- TABLE -->
      <div class="table-wrap">
        <table id="orders-table">
          <thead>
            <tr>
              <th>ID Pesanan</th>
              <th>Jasa</th>
              <th>Freelancer</th>
              <th>Tanggal</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr data-status="Diproses">
              <td style="font-weight:600;color:var(--gray-700);">ORD-1024</td>
              <td>
                <div style="font-weight:600;color:var(--gray-800);">Pembuatan Website Portofolio React</div>
                <div style="font-size:12px;color:var(--gray-400);">Programming</div>
              </td>
              <td>Citra Anindya</td>
              <td>2026-04-28</td>
              <td style="font-weight:600;color:var(--primary);">Rp 450.000</td>
              <td><span class="badge badge-blue">Diproses</span></td>
              <td>
                <a href="detail-jasa.html" class="btn btn-outline btn-sm">Lihat</a>
              </td>
            </tr>
            <tr data-status="Selesai">
              <td style="font-weight:600;color:var(--gray-700);">ORD-1023</td>
              <td>
                <div style="font-weight:600;color:var(--gray-800);">Jasa Pengetikan &amp; Penulisan Makalah</div>
                <div style="font-size:12px;color:var(--gray-400);">Penulisan</div>
              </td>
              <td>Bagus Pratama</td>
              <td>2026-04-25</td>
              <td style="font-weight:600;color:var(--primary);">Rp 35.000</td>
              <td><span class="badge badge-green">Selesai</span></td>
              <td>
                <a href="detail-jasa.html" class="btn btn-outline btn-sm">Lihat</a>
              </td>
            </tr>
            <tr data-status="Selesai">
              <td style="font-weight:600;color:var(--gray-700);">ORD-1018</td>
              <td>
                <div style="font-weight:600;color:var(--gray-800);">Bantuan Tugas Statistika &amp; SPSS</div>
                <div style="font-size:12px;color:var(--gray-400);">Data &amp; Analisis</div>
              </td>
              <td>Dio Saputra</td>
              <td>2026-03-14</td>
              <td style="font-weight:600;color:var(--primary);">Rp 120.000</td>
              <td><span class="badge badge-green">Selesai</span></td>
              <td>
                <a href="detail-jasa.html" class="btn btn-outline btn-sm">Lihat</a>
              </td>
            </tr>
            <tr data-status="Dibatalkan">
              <td style="font-weight:600;color:var(--gray-700);">ORD-1010</td>
              <td>
                <div style="font-weight:600;color:var(--gray-800);">Desain Slide Presentasi Profesional</div>
                <div style="font-size:12px;color:var(--gray-400);">Desain Grafis</div>
              </td>
              <td>Hanifah Zahra</td>
              <td>2026-02-20</td>
              <td style="font-weight:600;color:var(--primary);">Rp 75.000</td>
              <td><span class="badge badge-gray">Dibatalkan</span></td>
              <td>
                <a href="detail-jasa.html" class="btn btn-outline btn-sm">Lihat</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<script>
  function filterOrders() {
    const q = document.getElementById('search-order').value.toLowerCase();
    const status = document.getElementById('filter-status').value;
    const rows = document.querySelectorAll('#orders-table tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const rowStatus = row.dataset.status;
      const show = text.includes(q) && (status === '' || rowStatus === status);
      row.style.display = show ? '' : 'none';
    });
  }
</script>
</body>
</html>
