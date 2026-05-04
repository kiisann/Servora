<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jasa - Servora Worker</title>
    <link rel="stylesheet" href="../../public/css/style-worker.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <a href="kelola_jasa.php" class="nav-item active">
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
            <div class="manage-header">
                <div class="manage-header-left">
                    <h1>Kelola Jasa</h1>
                    <p>Atur jasa yang kamu tawarkan.</p>
                </div>
                <a href="tambah_jasa.php" class="btn-primary">
                    <i class='bx bx-plus'></i>
                    Tambah jasa
                </a>
            </div>

            <!-- Manage Grid -->
            <div class="manage-grid" id="manageGrid">

                <!-- Card 1 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=600&h=380&fit=crop&auto=format"
                         alt="Desain Poster">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(1)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(1)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge desain-grafis">Desain Grafis</span>
                        <div class="manage-card-title">Desain Poster &amp; Feed Instagram Estetik</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp50.000</span>
                            <span class="badge success">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=380&fit=crop&auto=format"
                         alt="Coding Web">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(2)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(2)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge pemrograman">Pemrograman</span>
                        <div class="manage-card-title">Bantuan Coding Web (React &amp; Tailwind)</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp150.000</span>
                            <span class="badge success">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=600&h=380&fit=crop&auto=format"
                         alt="Penerjemahan Jurnal">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(3)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(3)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge penerjemahan">Penerjemahan</span>
                        <div class="manage-card-title">Penerjemahan Jurnal EN ↔ ID</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp35.000</span>
                            <span class="badge success">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=600&h=380&fit=crop&auto=format"
                         alt="Edit Video">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(4)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(4)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge editing-video">Editing Video</span>
                        <div class="manage-card-title">Edit Video Pendek Reels &amp; TikTok</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp75.000</span>
                            <span class="badge warning">Nonaktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=600&h=380&fit=crop&auto=format"
                         alt="Penulisan Artikel">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(5)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(5)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge penulisan">Penulisan</span>
                        <div class="manage-card-title">Penulisan Artikel Blog SEO Friendly</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp45.000</span>
                            <span class="badge success">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="manage-card">
                    <img class="manage-card-img"
                         src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?w=600&h=380&fit=crop&auto=format"
                         alt="Presentasi">
                    <div class="manage-card-actions">
                        <button class="action-icon-btn edit" title="Edit jasa" onclick="editJasa(6)">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="action-icon-btn delete" title="Hapus jasa" onclick="hapusJasa(6)">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                    <div class="manage-card-body">
                        <span class="cat-badge presentasi">Presentasi</span>
                        <div class="manage-card-title">Desain Slide Presentasi PowerPoint / Canva Pro</div>
                        <div class="manage-card-footer">
                            <span class="manage-price">Rp60.000</span>
                            <span class="badge success">Aktif</span>
                        </div>
                    </div>
                </div>

            </div><!-- end manage-grid -->

        </div><!-- end content-wrapper -->
    </main>

</div><!-- end dashboard-container -->

<!-- Delete Confirm Modal -->
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:500; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; padding:28px 32px; max-width:380px; width:90%; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,0.15);">
        <div style="width:56px;height:56px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:#ef4444;">
            <i class='bx bx-trash'></i>
        </div>
        <h3 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:8px;">Hapus Jasa?</h3>
        <p style="font-size:13px;color:#64748b;margin-bottom:24px;">Jasa ini akan dihapus secara permanen dan tidak bisa dikembalikan.</p>
        <div style="display:flex;gap:10px;justify-content:center;">
            <button onclick="closeModal()" style="padding:9px 20px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#64748b;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">Batal</button>
            <button onclick="confirmDelete()" style="padding:9px 20px;border-radius:8px;border:none;background:#ef4444;color:#fff;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
  let deletingId = null;

  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  function editJasa(id) {
    window.location.href = 'tambah_jasa.php?edit=' + id;
  }

  function hapusJasa(id) {
    deletingId = id;
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
    deletingId = null;
  }

  function confirmDelete() {
    if (deletingId !== null) {
      // Di production: kirim request ke backend
      // Sementara ini: hapus card dari DOM
      const cards = document.querySelectorAll('#manageGrid .manage-card');
      cards[deletingId - 1].remove();
    }
    closeModal();
  }

  // Tutup modal jika klik di luar
  document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
</script>

</body>
</html>
