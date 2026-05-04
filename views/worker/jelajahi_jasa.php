<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajahi Jasa - Servora Worker</title>
    <link rel="stylesheet" href="../../public/css/style-worker.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="dashboard-container">

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Menu Freelancer</div>

            <a href="dashboard.php" class="nav-item">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>
            <a href="jelajahi_jasa.php" class="nav-item active">
                <i class='bx bx-compass'></i>
                Jelajahi Jasa
            </a>
            <a href="kelola_jasa.php" class="nav-item">
                <i class='bx bx-store'></i>
                Kelola Jasa
            </a>
            <a href="tambah_jasa.php" class="nav-item">
                <i class='bx bx-plus-circle'></i>
                Tambah Jasa
            </a>
            <a href="pesanan_masuk.php" class="nav-item">
                <i class='bx bx-package'></i>
                Pesanan Masuk
            </a>
            <a href="riwayat.php" class="nav-item">
                <i class='bx bx-history'></i>
                Riwayat
            </a>
            <a href="profil.php" class="nav-item">
                <i class='bx bx-user'></i>
                Profil
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://i.pravatar.cc/150?img=47" alt="Avatar Pengguna">
                <div class="user-info">
                    <div class="name">Pengguna Servora</div>
                    <div class="role">Freelancer</div>
                </div>
            </div>
        </div>
    </aside>

    <header class="top-navbar">
        <div class="navbar-right">
            <button class="icon-btn" title="Notifikasi">
                <i class='bx bx-bell'></i>
            </button>
            <img src="https://i.pravatar.cc/150?img=47" alt="Profil" class="profile-avatar">
        </div>
    </header>

    <main class="main-content">
        <div class="content-wrapper">

            <div class="page-header">
                <h1>Jelajahi Jasa</h1>
                <p>Temukan jasa mahasiswa untuk kebutuhanmu.</p>
            </div>

            <div class="service-search-box">
                <div class="service-search-input">
                    <i class='bx bx-search'></i>
                    <input type="text" id="searchInput" placeholder="Cari jasa, keahlian, atau kategori..." oninput="filterServices()">
                </div>
                <button class="filter-btn">
                    <i class='bx bx-filter-alt'></i>
                    Filter
                </button>
            </div>

            <div class="category-tabs" id="categoryTabs">
                <button class="cat-tab active" onclick="setCategory(this, 'semua')">Semua</button>
                <button class="cat-tab" onclick="setCategory(this, 'desain-grafis')">Desain Grafis</button>
                <button class="cat-tab" onclick="setCategory(this, 'pemrograman')">Pemrograman</button>
                <button class="cat-tab" onclick="setCategory(this, 'penulisan')">Penulisan</button>
                <button class="cat-tab" onclick="setCategory(this, 'penerjemahan')">Penerjemahan</button>
                <button class="cat-tab" onclick="setCategory(this, 'editing-video')">Editing Video</button>
                <button class="cat-tab" onclick="setCategory(this, 'konsultasi')">Konsultasi Akademik</button>
                <button class="cat-tab" onclick="setCategory(this, 'presentasi')">Presentasi</button>
                <button class="cat-tab" onclick="setCategory(this, 'data-riset')">Data &amp; Riset</button>
            </div>

            <div class="result-count" id="resultCount">8 jasa ditemukan</div>

            <div class="services-grid" id="servicesGrid">

                <a href="#" class="service-card" data-category="desain-grafis" data-title="Desain Poster &amp; Feed Instagram Estetik">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=600&h=340&fit=crop&auto=format"
                         alt="Desain Poster">
                    <div class="service-card-body">
                        <span class="service-card-category">Desain Grafis</span>
                        <div class="service-card-title">Desain Poster &amp; Feed Instagram Estetik</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=12" alt="Fiki">
                            <span class="seller-name">Fiki Sulistiawan</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.9
                            <span class="count">(128)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp50.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="pemrograman" data-title="Bantuan Coding Web React Next.js">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=340&fit=crop&auto=format"
                         alt="Coding Web">
                    <div class="service-card-body">
                        <span class="service-card-category">Pemrograman</span>
                        <div class="service-card-title">Bantuan Coding Web React &amp; Next.js</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=33" alt="Wisnu">
                            <span class="seller-name">Wisnu Wira Winata</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.8
                            <span class="count">(76)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp150.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="penerjemahan" data-title="Penerjemahan Jurnal EN ke ID">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=600&h=340&fit=crop&auto=format"
                         alt="Penerjemahan Jurnal">
                    <div class="service-card-body">
                        <span class="service-card-category">Penerjemahan</span>
                        <div class="service-card-title">Penerjemahan Jurnal Bahasa Inggris ke Indonesia</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=25" alt="Salsabila">
                            <span class="seller-name">Salsabila Putri</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.7
                            <span class="count">(54)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp35.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="editing-video" data-title="Edit Video Pendek Reels TikTok">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=600&h=340&fit=crop&auto=format"
                         alt="Edit Video">
                    <div class="service-card-body">
                        <span class="service-card-category">Editing Video</span>
                        <div class="service-card-title">Edit Video Pendek untuk Reels &amp; TikTok</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=44" alt="Tika">
                            <span class="seller-name">Tika Maulidya</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.9
                            <span class="count">(41)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp75.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="penulisan" data-title="Penulisan Artikel Blog SEO Friendly">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=600&h=340&fit=crop&auto=format"
                         alt="Penulisan Artikel">
                    <div class="service-card-body">
                        <span class="service-card-category">Penulisan</span>
                        <div class="service-card-title">Penulisan Artikel Blog SEO Friendly</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=9" alt="Bagus">
                            <span class="seller-name">Bagus Wibowo</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.6
                            <span class="count">(37)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp45.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="konsultasi" data-title="Bimbingan Skripsi dan Tugas Akhir">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&h=340&fit=crop&auto=format"
                         alt="Bimbingan Skripsi">
                    <div class="service-card-body">
                        <span class="service-card-category">Konsultasi Akademik</span>
                        <div class="service-card-title">Bimbingan Skripsi &amp; Tugas Akhir (S1)</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=60" alt="Rina">
                            <span class="seller-name">Rina Suryani</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            5.0
                            <span class="count">(22)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp200.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="presentasi" data-title="Desain Slide Presentasi PowerPoint">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?w=600&h=340&fit=crop&auto=format"
                         alt="Presentasi">
                    <div class="service-card-body">
                        <span class="service-card-category">Presentasi</span>
                        <div class="service-card-title">Desain Slide Presentasi PowerPoint / Canva Pro</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=18" alt="Mega">
                            <span class="seller-name">Mega Pratiwi</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.8
                            <span class="count">(59)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp60.000
                        </div>
                    </div>
                </a>

                <a href="#" class="service-card" data-category="data-riset" data-title="Analisis Data SPSS dan R Studio">
                    <img class="service-card-img"
                         src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=340&fit=crop&auto=format"
                         alt="Analisis Data">
                    <div class="service-card-body">
                        <span class="service-card-category">Data &amp; Riset</span>
                        <div class="service-card-title">Analisis Data SPSS &amp; R Studio untuk Penelitian</div>
                        <div class="service-card-seller">
                            <img class="seller-avatar" src="https://i.pravatar.cc/40?img=52" alt="Andi">
                            <span class="seller-name">Andi Pratama</span>
                        </div>
                    </div>
                    <div class="service-card-footer">
                        <div class="service-rating">
                            <i class='bx bxs-star'></i>
                            4.7
                            <span class="count">(33)</span>
                        </div>
                        <div class="service-price">
                            <span class="price-label">Mulai </span>Rp100.000
                        </div>
                    </div>
                </a>



        </div>
    </main>

</div>

<script>
  // Toggle sidebar
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  // Kategori aktif
  let activeCategory = 'semua';

  function setCategory(btn, cat) {
    activeCategory = cat;
    document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    filterServices();
  }

  // Filter gabungan: kategori + kata kunci
  function filterServices() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('#servicesGrid .service-card');
    let visible = 0;

    cards.forEach(card => {
      const cat = card.dataset.category;
      const title = card.dataset.title.toLowerCase();
      const matchCat = activeCategory === 'semua' || cat === activeCategory;
      const matchKw = title.includes(keyword);

      if (matchCat && matchKw) {
        card.style.display = '';
        visible++;
      } else {
        card.style.display = 'none';
      }
    });

    document.getElementById('resultCount').textContent = visible + ' jasa ditemukan';
  }
</script>

</body>
</html>
