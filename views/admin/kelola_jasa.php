<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servora Admin</title>
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
            <a href="kelola_jasa.php" class="nav-item active">
                Kelola Jasa
            </a>
            <a href="kelola_pesanan.php" class="nav-item">
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
                <h1 class="page-title">Kelola Data Jasa</h1>
                <p class="page-subtitle">Tinjau dan moderasi seluruh jasa yang dipublikasikan.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Profile" class="profile-avatar">
                </div>
            </div>
        </header>

        <div class="page-header">
            <div class="table-search">
                <input type="text" placeholder="Cari jasa...">
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Jasa</th>
                        <th>Kategori</th>
                        <th>Freelancer</th>
                        <th>Rating</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYfS9dA-7SoMoAHF1tkNc5jFiJILtY4HZ-Jg&s" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Desain Poster & Feed Instagram</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Desain Grafis</span></td>
                        <td class="fw-medium">Fiki Sulistiawan</td>
                        <td>
                            <div class="rating-display">
                                    4.9
                            </div>
                        </td>
                        <td class="fw-medium">Rp50.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://news.bsi.ac.id/wp-content/uploads/2025/11/Tips-Jitu-Belajar-Coding.png" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Bantuan Coding Web</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Pemrograman</span></td>
                        <td class="fw-medium">Wisnu Wira Winata</td>
                        <td>
                            <div class="rating-display"> 
                                4.8
                            </div>
                        </td>
                        <td class="fw-medium">Rp150.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://sevima.com/wp-content/uploads/2019/02/Jurnal-imiah.jpg" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Penerjemahan Jurnal EN → ID</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Penerjemahan</span></td>
                        <td class="fw-medium">Salsabila</td>
                        <td>
                            <div class="rating-display"> 
                                5
                            </div>
                        </td>
                        <td class="fw-medium">Rp35.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://baraka.uma.ac.id/wp-content/uploads/wahid-khene-iKdQCIiSMlQ-unsplash-min-scaled-1.jpg" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Editing Video Skripsi & Vlog Kampus</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Editing Video</span></td>
                        <td class="fw-medium">Wisnu Wira Winata</td>
                        <td>
                            <div class="rating-display"> 
                                4.7
                            </div>
                        </td>
                        <td class="fw-medium">Rp120.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://bms.telkomuniversity.ac.id/wp-content/uploads/2024/10/5001093-scaled.jpg" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Konsultasi Statistika & SPSS</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Konsultasi Akademik</span></td>
                        <td class="fw-medium">Salsabila.</td>
                        <td>
                            <div class="rating-display"> 
                                4.9
                            </div>
                        </td>
                        <td class="fw-medium">Rp80.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="service-cell">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyOnyZEAZFLwFMeGEJE9eGem_7iBGG6bzcLA&s" alt="Thumbnail" class="service-thumbnail">
                                <span class="service-title">Slide PowerPoint Profesional</span>
                            </div>
                        </td>
                        <td><span class="badge secondary">Presentasi</span></td>
                        <td class="fw-medium">Fiki Sulistiawan</td>
                        <td>
                            <div class="rating-display"> 
                                4.8
                            </div>
                        </td>
                        <td class="fw-medium">Rp65.000</td>
                        <td><span class="badge success">Aktif</span></td>
                        <td class="text-right">
                            <button class="text-action-btn view">Lihat</button>
                            <button class="text-action-btn disable">Nonaktifkan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>

