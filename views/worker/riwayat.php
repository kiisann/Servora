<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pekerjaan - Servora Worker</title>
    <link rel="stylesheet" href="../../public/css/style-worker.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Nama jasa berwarna biru seperti link */
        .order-name-link {
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .order-name-link:hover {
            opacity: 0.75;
            text-decoration: underline;
        }

        /* Kolom pendapatan rata kanan */
        .col-pendapatan {
            text-align: right;
            font-weight: 600;
            color: var(--text-main);
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <!-- ========================
         SIDEBAR
    ======================== -->
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
            <a href="riwayat.php" class="nav-item active">
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

    <!-- ========================
         TOP NAVBAR
    ======================== -->
    <header class="top-navbar">
        <div class="navbar-left">
            <button class="menu-toggle" onclick="toggleSidebar()" title="Toggle Menu">
                <i class='bx bx-menu'></i>
            </button>
            <div class="search-bar">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Cari pesanan...">
            </div>
        </div>
        <div class="navbar-right">
            <button class="icon-btn" title="Notifikasi">
                <i class='bx bx-bell'></i>
            </button>
            <img src="https://i.pravatar.cc/150?img=47" alt="Profil" class="profile-avatar">
        </div>
    </header>

    <!-- ========================
         MAIN CONTENT
    ======================== -->
    <main class="main-content">
        <div class="content-wrapper">

            <!-- Page Header -->
            <div class="page-header" style="margin-bottom: 20px;">
                <h1>Riwayat Pekerjaan</h1>
                <p style="font-size:14px;color:var(--text-muted);margin-top:4px;">
                    Semua pesanan yang pernah kamu kerjakan.
                </p>
            </div>

            <!-- Table Card -->
            <div class="orders-table-wrap">
                <table class="orders-table" id="historyTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jasa</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th style="text-align:right;">Pendapatan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><span class="order-id">ORD-1024</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Desain Poster &amp; Feed Instagram
                                </a>
                            </td>
                            <td>Andi P.</td>
                            <td><span class="badge info">Berlangsung</span></td>
                            <td class="col-pendapatan">Rp45.000</td>
                            <td class="order-date">2026-04-28</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1025</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Bantuan Coding Web
                                </a>
                            </td>
                            <td>Rina S.</td>
                            <td><span class="badge warning">Menunggu</span></td>
                            <td class="col-pendapatan">Rp135.000</td>
                            <td class="order-date">2026-04-29</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1026</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Penerjemahan Jurnal
                                </a>
                            </td>
                            <td>Bagus W.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="col-pendapatan">Rp31.500</td>
                            <td class="order-date">2026-04-25</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1027</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Konsultasi SPSS
                                </a>
                            </td>
                            <td>Mega L.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="col-pendapatan">Rp72.000</td>
                            <td class="order-date">2026-04-22</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1028</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Slide PowerPoint
                                </a>
                            </td>
                            <td>Yoga T.</td>
                            <td><span class="badge danger">Dibatalkan</span></td>
                            <td class="col-pendapatan">Rp58.500</td>
                            <td class="order-date">2026-04-20</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1029</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Desain Logo &amp; Brand Identity
                                </a>
                            </td>
                            <td>Tika M.</td>
                            <td><span class="badge info">Berlangsung</span></td>
                            <td class="col-pendapatan">Rp108.000</td>
                            <td class="order-date">2026-04-30</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1023</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Penulisan Artikel Blog
                                </a>
                            </td>
                            <td>Reza F.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="col-pendapatan">Rp40.500</td>
                            <td class="order-date">2026-04-15</td>
                        </tr>

                        <tr>
                            <td><span class="order-id">ORD-1021</span></td>
                            <td>
                                <a href="#" class="order-name-link">
                                    Edit Video Pendek
                                </a>
                            </td>
                            <td>Hani S.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="col-pendapatan">Rp67.500</td>
                            <td class="order-date">2026-04-10</td>
                        </tr>

                    </tbody>
                </table>
            </div><!-- end orders-table-wrap -->

        </div><!-- end content-wrapper -->
    </main>

</div><!-- end dashboard-container -->

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }
</script>

</body>
</html>
