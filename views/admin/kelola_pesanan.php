<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Servora Admin</title>
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
            <div class="nav-section-title">Admin Panel</div>
            <a href="dashboard.php" class="nav-item">
                Dashboard
            </a>
            <a href="kelola_pengguna.php" class="nav-item">
                Kelola Pengguna
            </a>
            <a href="kelola_jasa.php" class="nav-item">
                Kelola Jasa
            </a>
            <a href="kelola_pesanan.php" class="nav-item active">
                Kelola Pesanan
            </a>
            <a href="rating.php" class="nav-item">
                Rating & Review
            </a>
            <a href="monitoring.php" class="nav-item">
                Monitoring
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Admin Profile">
                <div class="user-info">
                    <div class="name">Admin Servora</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Pesanan Masuk</h1>
                <p class="page-subtitle">Kelola dan pantau status seluruh pesanan.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="page-header">
            <div class="table-search">
                <input type="text" placeholder="Cari pesanan...">
            </div>
        </div>

        <div class="filter-tabs">
            <a href="#" class="filter-tab active">Semua</a>
            <a href="#" class="filter-tab">Berlangsung</a>
            <a href="#" class="filter-tab">Selesai</a>
            <a href="#" class="filter-tab">Dibatalkan</a>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jasa</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-medium text-muted">ORD-1024</td>
                        <td class="fw-medium">Desain Poster & Feed Instagram</td>
                        <td>Andi P.</td>
                        <td><span class="badge outline outline-info">Berlangsung</span></td>
                        <td class="fw-medium">Rp50.000</td>
                        <td>2026-04-28</td>
                        <td class="text-right">
                            <button class="text-action-btn view">Detail</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-medium text-muted">ORD-1025</td>
                        <td class="fw-medium">Bantuan Coding Web</td>
                        <td>Rina S.</td>
                        <td><span class="badge outline outline-warning">Menunggu</span></td>
                        <td class="fw-medium">Rp150.000</td>
                        <td>2026-04-29</td>
                        <td class="text-right">
                            <button class="text-action-btn view">Detail</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-medium text-muted">ORD-1026</td>
                        <td class="fw-medium">Penerjemahan Jurnal</td>
                        <td>Bagus W.</td>
                        <td><span class="badge outline outline-success">Selesai</span></td>
                        <td class="fw-medium">Rp35.000</td>
                        <td>2026-04-25</td>
                        <td class="text-right">
                            <button class="text-action-btn view">Detail</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-medium text-muted">ORD-1027</td>
                        <td class="fw-medium">Konsultasi SPSS</td>
                        <td>Mega L.</td>
                        <td><span class="badge outline outline-success">Selesai</span></td>
                        <td class="fw-medium">Rp80.000</td>
                        <td>2026-04-22</td>
                        <td class="text-right">
                            <button class="text-action-btn view">Detail</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-medium text-muted">ORD-1028</td>
                        <td class="fw-medium">Slide PowerPoint</td>
                        <td>Yoga T.</td>
                        <td><span class="badge outline outline-danger">Dibatalkan</span></td>
                        <td class="fw-medium">Rp65.000</td>
                        <td>2026-04-20</td>
                        <td class="text-right">
                            <button class="text-action-btn view">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>

