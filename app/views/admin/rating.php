<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servora Adminn</title>
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
            <a href="kelola_pesanan.php" class="nav-item">
                Kelola Pesanan
            </a>
            <a href="rating.php" class="nav-item active">
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
                <h1 class="page-title">Monitoring Rating & Review</h1>
                <p class="page-subtitle">Pantau dan moderasi ulasan pengguna.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="review-grid" style="margin-top: 24px;">
            <div class="review-card">
                <div class="review-time">2 hari lalu</div>
                <div class="review-header">
                    <img src="https://sm.ign.com/ign_fr/cover/c/christophe/christopher-nolan_vwm3.jpg" alt="Andi P." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Andi P.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Hasilnya rapi banget dan cepat. Recommended!</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>

            <div class="review-card">
                <div class="review-time">1 minggu lalu</div>
                <div class="review-header">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXq77Wlpi8uI6ahv5_c8hrge4Ny_7zTTxMOg&s" alt="Rina S." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Rina S.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Komunikasinya enak, revisi cepat ditanggapi.</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>

            <div class="review-card">
                <div class="review-time">2 minggu lalu</div>
                <div class="review-header">
                    <img src="https://c.pxhere.com/images/09/16/6a6365d0bdb9fbe20a752cb34a5f-1666078.jpg!d" alt="Bagus W." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Bagus W.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Bagus, sesuai ekspektasi.</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>

            <div class="review-card">
                <div class="review-time">2 hari lalu</div>
                <div class="review-header">
                    <img src="https://sm.ign.com/ign_fr/cover/c/christophe/christopher-nolan_vwm3.jpg" alt="Andi P." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Andi P.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Hasilnya rapi banget dan cepat. Recommended!</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>

            <div class="review-card">
                <div class="review-time">1 minggu lalu</div>
                <div class="review-header">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXq77Wlpi8uI6ahv5_c8hrge4Ny_7zTTxMOg&s" alt="Rina S." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Rina S.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Komunikasinya enak, revisi cepat ditanggapi.</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>

            <div class="review-card">
                <div class="review-time">2 minggu lalu</div>
                <div class="review-header">
                    <img src="https://c.pxhere.com/images/09/16/6a6365d0bdb9fbe20a752cb34a5f-1666078.jpg!d" alt="Bagus W." class="review-avatar">
                    <div class="review-user-info">
                        <span class="review-user-name">Bagus W.</span>
                        <div class="review-stars">
                        </div>
                    </div>
                </div>
                <p class="review-text">Bagus, sesuai ekspektasi.</p>
                <button class="review-action-btn"> Hapus
                </button>
            </div>
        </div>
    </main>
</div>
</body>
</html>

