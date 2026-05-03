<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Servora Admin</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section-title">Admin Panel</div>
            <a href="dashboard.php" class="nav-item">
                <i class="ph ph-squares-four"></i>
                Dashboard
            </a>
            <a href="kelola_pengguna.php" class="nav-item active">
                <i class="ph ph-users"></i>
                Kelola Pengguna
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-briefcase"></i>
                Kelola Jasa
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-receipt"></i>
                Kelola Pesanan
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-star"></i>
                Rating & Review
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-chart-line-up"></i>
                Monitoring
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Admin Profile">
                <div class="user-info">
                    <div class="name">Pengguna Servora</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <div>
                    <h1 class="page-title">Kelola Pengguna</h1>
                    <p class="page-subtitle">Kelola data client, freelancer, dan admin.</p>
                </div>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <button class="icon-btn">
                        <i class="ph ph-bell"></i>
                    </button>
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="page-header">
            <div class="table-search">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" placeholder="Cari pengguna...">
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Kampus</th>
                        <th>Bergabung</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-card-left">
                                <div class="user-avatar">N</div>
                                <span class="fw-medium">Naya Pramesti</span>
                            </div>
                        </td>
                        <td>naya@kampus.ac.id</td>
                        <td><span class="badge secondary">Freelancer</span></td>
                        <td class="fw-medium">UGM</td>
                        <td>2026-01-12</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td><button class="action-btn"><i class="ph ph-dots-three"></i></button></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="user-card-left">
                                <div class="user-avatar">A</div>
                                <span class="fw-medium">Andi Pratama</span>
                            </div>
                        </td>
                        <td>andi@kampus.ac.id</td>
                        <td><span class="badge secondary">Client</span></td>
                        <td class="fw-medium">UI</td>
                        <td>2026-02-04</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td><button class="action-btn"><i class="ph ph-dots-three"></i></button></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="user-card-left">
                                <div class="user-avatar">R</div>
                                <span class="fw-medium">Rafi Hidayat</span>
                            </div>
                        </td>
                        <td>rafi@kampus.ac.id</td>
                        <td><span class="badge secondary">Freelancer</span></td>
                        <td class="fw-medium">ITB</td>
                        <td>2026-01-22</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td><button class="action-btn"><i class="ph ph-dots-three"></i></button></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="user-card-left">
                                <div class="user-avatar">M</div>
                                <span class="fw-medium">Mega Lestari</span>
                            </div>
                        </td>
                        <td>mega@kampus.ac.id</td>
                        <td><span class="badge secondary">Client</span></td>
                        <td class="fw-medium">Unpad</td>
                        <td>2026-03-09</td>
                        <td><span class="badge danger">Ditangguhkan</span></td>
                        <td><button class="action-btn"><i class="ph ph-dots-three"></i></button></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="user-card-left">
                                <div class="user-avatar">S</div>
                                <span class="fw-medium">Salsabila</span>
                            </div>
                        </td>
                        <td>salsa@kampus.ac.id</td>
                        <td><span class="badge secondary">Freelancer</span></td>
                        <td class="fw-medium">UI</td>
                        <td>2025-12-30</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td><button class="action-btn"><i class="ph ph-dots-three"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
