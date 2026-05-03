<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Servora</title>
    <link rel="stylesheet" href="../../public/css/style-admin.css">
    <!-- <script src="https://unpkg.com/@phosphor-icons/web"></script> -->
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
            <a href="#" class="nav-item active">
                <i class="ph ph-squares-four"></i>
                Dashboard
            </a>
            <a href="kelola_pengguna.php" class="nav-item">
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Ringkasan aktivitas sistem Servora.</p>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Cari...">
                </div>
                <div class="header-actions">
                    <button class="icon-btn">
                        <i class="ph ph-bell"></i>
                    </button>
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Total Pengguna</div>
                    <div class="value">1.248</div>
                    <span class="trend">+24 minggu ini</span>
                </div>
                <div class="stat-icon blue">
                    <i class="ph ph-users"></i>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Jasa Aktif</div>
                    <div class="value">342</div>
                    <span class="trend"></span>
                </div>
                <div class="stat-icon green">
                    <i class="ph ph-briefcase"></i>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">Pesanan Bulan Ini</div>
                    <div class="value">186</div>
                    <span class="trend"></span>
                </div>
                <div class="stat-icon orange">
                    <i class="ph ph-receipt"></i>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <div class="title">GMV</div>
                    <div class="value">Rp45.000.000</div>
                    <span class="trend"></span>
                </div>
                <div class="stat-icon blue">
                    <i class="ph ph-wallet"></i>
                </div>
            </div>
        </section>

        <section class="content-grid">
            <!-- Recent Orders -->
            <div class="card-container">
                <div class="card-header">
                    <h3>Pesanan terbaru</h3>
                    <button class="header-action"><i class="ph ph-dots-three"></i></button>
                </div>
                <div class="list-container">
                    <div class="list-item">
                        <div class="item-left">
                            <div class="item-title">Desain Poster & Feed Instagram</div>
                            <div class="item-desc">ORD-1024 • Andi P. → Naya Pramesti</div>
                        </div>
                        <div class="item-right">
                            <span class="badge info">Berlangsung</span>
                            <span class="item-price">Rp50.000</span>
                        </div>
                    </div>
                    
                    <div class="list-item">
                        <div class="item-left">
                            <div class="item-title">Bantuan Coding Web</div>
                            <div class="item-desc">ORD-1025 • Rina S. → Rafi Hidayat</div>
                        </div>
                        <div class="item-right">
                            <span class="badge warning">Menunggu</span>
                            <span class="item-price">Rp150.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card-container">
                <div class="card-header">
                    <h3>Aktivitas terbaru</h3>
                    <button class="header-action"><i class="ph ph-chart-line-up"></i></button>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Naya P.</strong> menambahkan jasa baru</div>
                        </div>
                        <div class="activity-time">2m</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Andi P.</strong> membuat pesanan ORD-1029</div>
                        </div>
                        <div class="activity-time">17m</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Salsabila</strong> menyelesaikan pesanan ORD-1026</div>
                        </div>
                        <div class="activity-time">1j</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Mega L.</strong> ditangguhkan oleh admin</div>
                        </div>
                        <div class="activity-time">3j</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-bullet"></div>
                        <div class="activity-content">
                            <div class="activity-text"><strong>Rafi H.</strong> memperbarui profil</div>
                        </div>
                        <div class="activity-time">5j</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- New Users -->
        <section class="card-container" style="margin-bottom: 24px;">
            <div class="card-header" style="margin-bottom: 16px;">
                <h3>Pengguna baru</h3>
            </div>
            <div class="users-section">
                <div class="user-card">
                    <div class="user-card-left">
                        <div class="user-avatar" style="background-color: #eff6ff; color: #3b82f6;">N</div>
                        <div class="user-card-info">
                            <div class="name">Naya Pramesti</div>
                            <div class="role">Freelancer • UGM</div>
                        </div>
                    </div>
                    <span class="badge success">Aktif</span>
                </div>
                
                <div class="user-card">
                    <div class="user-card-left">
                        <div class="user-avatar" style="background-color: #eff6ff; color: #3b82f6;">A</div>
                        <div class="user-card-info">
                            <div class="name">Andi Pratama</div>
                            <div class="role">Client • UI</div>
                        </div>
                    </div>
                    <span class="badge success">Aktif</span>
                </div>
                
                <div class="user-card">
                    <div class="user-card-left">
                        <div class="user-avatar" style="background-color: #eff6ff; color: #3b82f6;">R</div>
                        <div class="user-card-info">
                            <div class="name">Rafi Hidayat</div>
                            <div class="role">Freelancer • ITB</div>
                        </div>
                    </div>
                    <span class="badge success">Aktif</span>
                </div>
            </div>
        </section>
    </main>
</div>

</body>
</html>
