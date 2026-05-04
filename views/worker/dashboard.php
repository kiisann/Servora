<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Servora Worker</title>
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

            <a href="dashboard.php" class="nav-item active">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>
            <a href="jelajahi_jasa.php" class="nav-item">
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

            <div class="page-greeting">
                <h1>Halo, Naya 👋</h1>
                <p>Berikut performa jasamu di Servora.</p>
            </div>

            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Pesanan Baru</div>
                        <div class="stat-value">4</div>
                    </div>
                    <div class="stat-icon blue">
                        <i class='bx bx-envelope'></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Selesai Bulan Ini</div>
                        <div class="stat-value">18</div>
                    </div>
                    <div class="stat-icon green">
                        <i class='bx bx-check-circle'></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Pendapatan</div>
                        <div class="stat-value">Rp2.350.000</div>
                    </div>
                    <div class="stat-icon orange">
                        <i class='bx bx-wallet'></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Rating Rata-rata</div>
                        <div class="stat-value">4.9</div>
                    </div>
                    <div class="stat-icon yellow">
                        <i class='bx bx-star'></i>
                    </div>
                </div>
            </section>

            <section class="content-grid">

                <div class="card-container">
                    <div class="card-header">
                        <h3>Pesanan terbaru</h3>
                        <a href="pesanan_masuk.php" class="see-all">
                            Semua <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                    <div class="order-list">

                        <div class="order-item">
                            <div class="order-info">
                                <div class="order-title">Desain Poster &amp; Feed Instagram</div>
                                <div class="order-meta">ORD-1024 &middot; Andi P.</div>
                            </div>
                            <div class="order-right">
                                <span class="badge info">Berlangsung</span>
                                <span class="order-price">Rp50.000</span>
                            </div>
                        </div>

                        <div class="order-item">
                            <div class="order-info">
                                <div class="order-title">Bantuan Coding Web</div>
                                <div class="order-meta">ORD-1025 &middot; Rina S.</div>
                            </div>
                            <div class="order-right">
                                <span class="badge warning">Menunggu</span>
                                <span class="order-price">Rp150.000</span>
                            </div>
                        </div>

                        <div class="order-item">
                            <div class="order-info">
                                <div class="order-title">Penerjemahan Jurnal</div>
                                <div class="order-meta">ORD-1026 &middot; Bagus W.</div>
                            </div>
                            <div class="order-right">
                                <span class="badge success">Selesai</span>
                                <span class="order-price">Rp35.000</span>
                            </div>
                        </div>

                        <div class="order-item">
                            <div class="order-info">
                                <div class="order-title">Edit Video Pendek</div>
                                <div class="order-meta">ORD-1027 &middot; Tika M.</div>
                            </div>
                            <div class="order-right">
                                <span class="badge info">Berlangsung</span>
                                <span class="order-price">Rp75.000</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-container">
                    <div class="card-header">
                        <h3>Jasa Terlaris</h3>
                    </div>
                    <div class="service-list">

                        <div class="service-item">
                            <img src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=80&h=80&fit=crop&auto=format"
                                 alt="Desain Poster" class="service-thumb">
                            <div class="service-info">
                                <div class="service-name">Desain Poster &amp; Feed Insta...</div>
                                <div class="service-count">128 pesanan</div>
                            </div>
                        </div>

                        <div class="service-item">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=80&h=80&fit=crop&auto=format"
                                 alt="Coding Web" class="service-thumb">
                            <div class="service-info">
                                <div class="service-name">Bantuan Coding Web (Rea...</div>
                                <div class="service-count">76 pesanan</div>
                            </div>
                        </div>

                        <div class="service-item">
                            <img src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=80&h=80&fit=crop&auto=format"
                                 alt="Jurnal" class="service-thumb">
                            <div class="service-info">
                                <div class="service-name">Penerjemahan Jurnal EN ...</div>
                                <div class="service-count">54 pesanan</div>
                            </div>
                        </div>

                    </div>
                </div>

            </section>

        </div>
    </main>

</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }
</script>

</body>
</html>
