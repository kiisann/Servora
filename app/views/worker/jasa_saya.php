<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasa Saya - Servora</title>
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

            <a href="dashboard.php" class="nav-item">Dashboard</a>
            <a href="jasa_saya.php" class="nav-item active">Jasa Saya</a>
            <a href="#" class="nav-item">Pesanan Masuk</a>
            <a href="#" class="nav-item">Pendapatan</a>
            <a href="#" class="nav-item">Rating & Review</a>
            <a href="#" class="nav-item">Profil</a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://i.pravatar.cc/100?img=12" alt="Freelancer Profile">
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
                <h1 class="page-title">Jasa Saya</h1>
                <p class="page-subtitle">Kelola daftar layanan yang kamu tawarkan di Servora.</p>
            </div>

            <div class="header-right">
                <button class="signin-btn" style="width:auto; padding:10px 18px; margin:0;">
                    + Tambah Jasa
                </button>
                <img src="https://i.pravatar.cc/100?img=12" alt="Profile" class="profile-avatar">
            </div>
        </header>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Total Jasa</div>
                    <div class="value">6</div>
                    <span class="trend">Semua layanan yang dibuat</span>
                </div>
                <div class="stat-icon blue">📌</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Jasa Aktif</div>
                    <div class="value">4</div>
                    <span class="trend">Sedang tampil di marketplace</span>
                </div>
                <div class="stat-icon green">✅</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Menunggu Review</div>
                    <div class="value">1</div>
                    <span class="trend">Perlu persetujuan admin</span>
                </div>
                <div class="stat-icon orange">⏳</div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Nonaktif</div>
                    <div class="value">1</div>
                    <span class="trend">Tidak ditampilkan sementara</span>
                </div>
                <div class="stat-icon blue">🚫</div>
            </div>
        </section>

        <section class="table-container">
            <div class="table-top-header">
                <div class="table-title">
                    <h3>Daftar Jasa Freelancer</h3>
                    <p>Atur layanan, kategori, harga, dan status jasa yang kamu miliki.</p>
                </div>

                <div class="table-search">
                    <input type="text" placeholder="Cari jasa...">
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Estimasi</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img class="service-thumbnail" src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=100" alt="Poster">
                                <div>
                                    <div class="service-title">Desain Poster Akademik</div>
                                    <div class="text-muted">Poster seminar, lomba, dan event kampus</div>
                                </div>
                            </div>
                        </td>
                        <td>Desain Grafis</td>
                        <td>Rp75.000</td>
                        <td>2 hari</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td>⭐ 4.9</td>
                        <td>
                            <button class="text-action-btn view">Edit</button>
                            <button class="text-action-btn disable">Hapus</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="service-cell">
                                <img class="service-thumbnail" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=100" alt="PPT">
                                <div>
                                    <div class="service-title">Pembuatan PPT Presentasi</div>
                                    <div class="text-muted">Slide presentasi rapi dan siap pakai</div>
                                </div>
                            </div>
                        </td>
                        <td>Tugas Akademik</td>
                        <td>Rp50.000</td>
                        <td>1 hari</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td>⭐ 4.8</td>
                        <td>
                            <button class="text-action-btn view">Edit</button>
                            <button class="text-action-btn disable">Hapus</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="service-cell">
                                <img class="service-thumbnail" src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=100" alt="Coding">
                                <div>
                                    <div class="service-title">Konsultasi Coding PHP</div>
                                    <div class="text-muted">Bantuan debugging dan pemahaman kode</div>
                                </div>
                            </div>
                        </td>
                        <td>Programming</td>
                        <td>Rp100.000</td>
                        <td>Hari ini</td>
                        <td><span class="badge warning">Review</span></td>
                        <td>⭐ 5.0</td>
                        <td>
                            <button class="text-action-btn view">Edit</button>
                            <button class="text-action-btn disable">Hapus</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="service-cell">
                                <img class="service-thumbnail" src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=100" alt="Menulis">
                                <div>
                                    <div class="service-title">Penulisan Artikel Mahasiswa</div>
                                    <div class="text-muted">Artikel akademik, caption, dan konten</div>
                                </div>
                            </div>
                        </td>
                        <td>Penulisan</td>
                        <td>Rp60.000</td>
                        <td>2 hari</td>
                        <td><span class="badge secondary">Nonaktif</span></td>
                        <td>⭐ 4.7</td>
                        <td>
                            <button class="text-action-btn view">Edit</button>
                            <button class="text-action-btn disable">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>

</body>
</html>