<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Freelancer - Servora</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>
<body>

<div class="dashboard-container">

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Freelancer Panel</div>

            <a href="dashboard.php" class="nav-item active">Dashboard</a>
            <a href="jasa_saya.php" class="nav-item">Jasa Saya</a>
            <a href="#" class="nav-item">Pesanan Masuk</a>
            <a href="#" class="nav-item">Pendapatan</a>
            <a href="#" class="nav-item">Rating & Review</a>
            <a href="#" class="nav-item">Profil</a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://i.pravatar.cc/100?img=12" alt="Freelancer">
                <div class="user-info">
                    <div class="name">Naya Freelancer</div>
                    <div class="role">Penyedia Jasa</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">

        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Dashboard Freelancer</h1>
                <p class="page-subtitle">Kelola jasa, pesanan, dan performa layananmu di Servora.</p>
            </div>

            <div class="header-right">
                <div class="header-actions">
                    <img src="https://i.pravatar.cc/100?img=12" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Jasa Aktif</div>
                    <div class="value">6</div>
                    <span class="trend">2 jasa baru bulan ini</span>
                </div>
                <div class="stat-icon blue">📌</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Pesanan Masuk</div>
                    <div class="value">14</div>
                    <span class="trend">5 pesanan menunggu respon</span>
                </div>
                <div class="stat-icon orange">📥</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Pesanan Selesai</div>
                    <div class="value">38</div>
                    <span class="trend">Performa layanan meningkat</span>
                </div>
                <div class="stat-icon green">✅</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Rating</div>
                    <div class="value">4.9</div>
                    <span class="trend">Berdasarkan 27 ulasan</span>
                </div>
                <div class="stat-icon blue">⭐</div>
            </div>

        </section>

        <section class="content-grid">

            <div class="card-container">
                <div class="card-header">
                    <h3>Pesanan Terbaru</h3>
                    <button class="header-action">Lihat Semua</button>
                </div>

                <div class="list-container">

                    <div class="list-item">
                        <div class="item-left">
                            <div class="item-title">Desain Poster Seminar</div>
                            <div class="item-desc">Client: Andi Pratama • Deadline: 2 hari</div>
                        </div>
                        <div class="item-right">
                            <span class="badge warning">Menunggu</span>
                            <span class="item-price">Rp75.000</span>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="item-left">
                            <div class="item-title">Pembuatan PPT Presentasi</div>
                            <div class="item-desc">Client: Sinta Maharani • Deadline: 1 hari</div>
                        </div>
                        <div class="item-right">
                            <span class="badge info">Diproses</span>
                            <span class="item-price">Rp50.000</span>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="item-left">
                            <div class="item-title">Konsultasi Coding PHP</div>
                            <div class="item-desc">Client: Rafi Hidayat • Deadline: Hari ini</div>
                        </div>
                        <div class="item-right">
                            <span class="badge success">Selesai</span>
                            <span class="item-price">Rp100.000</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-container">
                <div class="card-header">
                    <h3>Aktivitas Freelancer</h3>
                </div>

                <div class="activity-list">

                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Pesanan baru</strong> masuk untuk jasa desain poster.</div>
                            <div class="activity-time">10 menit lalu</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text">Jasa <strong>Pembuatan PPT</strong> diperbarui.</div>
                            <div class="activity-time">1 jam lalu</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text">Client memberi rating <strong>5.0</strong>.</div>
                            <div class="activity-time">Kemarin</div>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <section class="table-container">

            <div class="table-top-header">
                <div class="table-title">
                    <h3>Daftar Jasa Saya</h3>
                    <p>Kelola layanan yang kamu tawarkan kepada pengguna Servora.</p>
                </div>

                <button class="signin-btn" style="width:auto; padding:10px 18px; margin:0;">
                    + Tambah Jasa
                </button>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Rating</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Desain Poster Akademik</td>
                        <td>Desain Grafis</td>
                        <td>Rp75.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td>⭐ 4.9</td>
                    </tr>

                    <tr>
                        <td>Pembuatan PPT Presentasi</td>
                        <td>Tugas Akademik</td>
                        <td>Rp50.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td>⭐ 4.8</td>
                    </tr>

                    <tr>
                        <td>Konsultasi Coding PHP</td>
                        <td>Programming</td>
                        <td>Rp100.000</td>
                        <td><span class="badge warning">Review</span></td>
                        <td>⭐ 5.0</td>
                    </tr>
                </tbody>
            </table>

        </section>

    </main>

</div>

</body>
</html>