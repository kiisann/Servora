<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cari Jasa – Servora Client</title>
  <meta name="description" content="Temukan jasa mahasiswa terbaik sesuai kebutuhanmu di Servora." />
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
        <h1>Cari Jasa</h1>
        <p>Temukan jasa yang paling sesuai dengan kebutuhanmu.</p>
      </div>
    </header>

    <div class="page-content">
      <!-- SEARCH & FILTERS -->
      <div class="search-bar">
        <div class="search-input-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
          <input type="text" id="search-input" placeholder="Mis. desain logo" />
        </div>
        <select class="filter-select" id="filter-category">
          <option value="">Semua kategori</option>
          <option value="Desain Grafis">Desain Grafis</option>
          <option value="Penulisan">Penulisan</option>
          <option value="Programming">Programming</option>
          <option value="Penerjemahan">Penerjemahan</option>
          <option value="Data & Analisis">Data &amp; Analisis</option>
          <option value="Video & Editing">Video &amp; Editing</option>
          <option value="Bimbingan Belajar">Bimbingan Belajar</option>
          <option value="Tugas Akademik">Tugas Akademik</option>
        </select>
        <select class="filter-select" id="filter-rating">
          <option value="">Semua rating</option>
          <option value="4">≥ 4</option>
          <option value="4.5">≥ 4.5</option>
          <option value="4.8">≥ 4.8</option>
        </select>
      </div>

      <p id="result-count" style="font-size:13px;color:var(--gray-500);margin-bottom:16px;">9 hasil ditemukan</p>

      <!-- SERVICE GRID -->
      <div class="service-grid" id="service-grid">

        <div class="service-card" data-category="Desain Grafis" data-rating="4.9" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">🎨</div>
          <div class="service-body">
            <span class="service-category">Desain Grafis</span>
            <div class="service-title">Desain Logo &amp; Brand Identity Modern</div>
            <div class="service-by">oleh Aulia Rahma</div>
            <div class="service-footer">
              <span class="service-price">Rp 150.000</span>
              <div class="rating"><span class="star">★</span> 4.9</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Penulisan" data-rating="4.7" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">✍️</div>
          <div class="service-body">
            <span class="service-category">Penulisan</span>
            <div class="service-title">Jasa Pengetikan &amp; Penulisan Makalah</div>
            <div class="service-by">oleh Bagus Pratama</div>
            <div class="service-footer">
              <span class="service-price">Rp 35.000</span>
              <div class="rating"><span class="star">★</span> 4.7</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Programming" data-rating="5" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">💻</div>
          <div class="service-body">
            <span class="service-category">Programming</span>
            <div class="service-title">Pembuatan Website Portofolio React</div>
            <div class="service-by">oleh Citra Anindya</div>
            <div class="service-footer">
              <span class="service-price">Rp 450.000</span>
              <div class="rating"><span class="star">★</span> 5</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Penerjemahan" data-rating="4.8" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">🌐</div>
          <div class="service-body">
            <span class="service-category">Penerjemahan</span>
            <div class="service-title">Terjemahan Inggris–Indonesia Akurat</div>
            <div class="service-by">oleh Dewi Astari</div>
            <div class="service-footer">
              <span class="service-price">Rp 25.000</span>
              <div class="rating"><span class="star">★</span> 4.8</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Data & Analisis" data-rating="4.9" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">📊</div>
          <div class="service-body">
            <span class="service-category">Data &amp; Analisis</span>
            <div class="service-title">Bantuan Tugas Statistika &amp; SPSS</div>
            <div class="service-by">oleh Dio Saputra</div>
            <div class="service-footer">
              <span class="service-price">Rp 120.000</span>
              <div class="rating"><span class="star">★</span> 4.9</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Video & Editing" data-rating="4.6" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">🎬</div>
          <div class="service-body">
            <span class="service-category">Video &amp; Editing</span>
            <div class="service-title">Editing Video Vlog &amp; Konten Kuliah</div>
            <div class="service-by">oleh Farhan Maulana</div>
            <div class="service-footer">
              <span class="service-price">Rp 90.000</span>
              <div class="rating"><span class="star">★</span> 4.6</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Bimbingan Belajar" data-rating="4.2" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">📐</div>
          <div class="service-body">
            <span class="service-category">Bimbingan Belajar</span>
            <div class="service-title">Bimbingan Belajar Kalkulus 1 &amp; 2</div>
            <div class="service-by">oleh Sra Maharidha</div>
            <div class="service-footer">
              <span class="service-price">Rp 60.000</span>
              <div class="rating"><span class="star">★</span> 4.2</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Desain Grafis" data-rating="4.3" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">🖼️</div>
          <div class="service-body">
            <span class="service-category">Desain Grafis</span>
            <div class="service-title">Desain Slide Presentasi Profesional</div>
            <div class="service-by">oleh Hanifah Zahra</div>
            <div class="service-footer">
              <span class="service-price">Rp 75.000</span>
              <div class="rating"><span class="star">★</span> 4.3</div>
            </div>
          </div>
        </div>

        <div class="service-card" data-category="Tugas Akademik" data-rating="4.7" onclick="location.href='detail-jasa.html'">
          <div class="service-thumb">📝</div>
          <div class="service-body">
            <span class="service-category">Tugas Akademik</span>
            <div class="service-title">Skripsi Bab 1–3: Konsultasi &amp; Review</div>
            <div class="service-by">oleh Irfan Hakim</div>
            <div class="service-footer">
              <span class="service-price">Rp 200.000</span>
              <div class="rating"><span class="star">★</span> 4.7</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  const searchInput = document.getElementById('search-input');
  const categoryFilter = document.getElementById('filter-category');
  const ratingFilter = document.getElementById('filter-rating');
  const grid = document.getElementById('service-grid');
  const countEl = document.getElementById('result-count');

  function filterCards() {
    const q = searchInput.value.toLowerCase();
    const cat = categoryFilter.value;
    const minRating = parseFloat(ratingFilter.value) || 0;
    const cards = grid.querySelectorAll('.service-card');
    let visible = 0;
    cards.forEach(card => {
      const title = card.querySelector('.service-title').textContent.toLowerCase();
      const cardCat = card.dataset.category;
      const cardRating = parseFloat(card.dataset.rating);
      const show = title.includes(q)
        && (cat === '' || cardCat === cat)
        && cardRating >= minRating;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    countEl.textContent = visible + ' hasil ditemukan';
  }

  searchInput.addEventListener('input', filterCards);
  categoryFilter.addEventListener('change', filterCards);
  ratingFilter.addEventListener('change', filterCards);
</script>
</body>
</html>
