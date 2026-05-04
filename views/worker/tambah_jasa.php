<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jasa - Servora Worker</title>
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
            <a href="tambah_jasa.php" class="nav-item active">
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

            <a href="kelola_jasa.php" class="back-link">
                <i class='bx bx-arrow-back'></i>
                Kembali
            </a>

            <div class="page-header" style="margin-bottom: 20px;">
                <h1>Tambah Jasa Baru</h1>
            </div>

            <div class="form-card">
                <form id="addServiceForm" onsubmit="submitForm(event)">

                    <div class="form-group">
                        <label class="form-label">Cover jasa</label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" id="coverInput" accept="image/png, image/jpeg"
                                   onchange="previewImage(event)">
                            <img class="upload-preview" id="previewImg" alt="Preview">
                            <i class='bx bx-image-add upload-icon' id="uploadIcon"></i>
                            <span class="upload-label" id="uploadLabel">Klik untuk unggah gambar</span>
                            <span class="upload-hint" id="uploadHint">PNG/JPG &middot; maks 2MB</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="judulJasa">Judul jasa</label>
                        <input type="text"
                               id="judulJasa"
                               name="judul"
                               class="form-control"
                               placeholder="Contoh: Desain Poster Estetik"
                               required>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" class="form-control" required>
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="desain-grafis">Desain Grafis</option>
                                <option value="pemrograman">Pemrograman</option>
                                <option value="penulisan">Penulisan</option>
                                <option value="penerjemahan">Penerjemahan</option>
                                <option value="editing-video">Editing Video</option>
                                <option value="konsultasi">Konsultasi Akademik</option>
                                <option value="presentasi">Presentasi</option>
                                <option value="data-riset">Data &amp; Riset</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="harga">Harga (Rp)</label>
                            <input type="number"
                                   id="harga"
                                   name="harga"
                                   class="form-control"
                                   placeholder="50000"
                                   min="1000"
                                   step="500"
                                   value="50000"
                                   required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="estimasi">Estimasi pengerjaan (hari)</label>
                            <input type="number"
                                   id="estimasi"
                                   name="estimasi"
                                   class="form-control"
                                   placeholder="2"
                                   min="1"
                                   max="365"
                                   value="2"
                                   required>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="revisi">Jumlah revisi</label>
                            <input type="number"
                                   id="revisi"
                                   name="revisi"
                                   class="form-control"
                                   placeholder="2"
                                   min="0"
                                   max="99"
                                   value="2"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  class="form-control"
                                  placeholder="Jelaskan jasa yang kamu tawarkan..."
                                  required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tags">Tag <span style="font-weight:400;color:var(--text-muted);">(pisahkan dengan koma)</span></label>
                        <input type="text"
                               id="tags"
                               name="tags"
                               class="form-control"
                               placeholder="Figma, Branding, Poster">
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="window.location.href='kelola_jasa.php'">
                            Batal
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class='bx bx-check'></i>
                            Publikasikan jasa
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

</div>

<!-- Toast Notification -->
<div id="toast" style="
  display: none;
  position: fixed;
  bottom: 28px;
  right: 28px;
  background: #1e293b;
  color: #fff;
  padding: 14px 22px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 500;
  z-index: 999;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
  align-items: center;
  gap: 10px;
">
  <i class='bx bx-check-circle' style="font-size:18px;color:#22c55e;"></i>
  <span>Jasa berhasil dipublikasikan!</span>
</div>

<script>
  // Toggle sidebar
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  // Image preview
  function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;

    if (file.size > 2 * 1024 * 1024) {
      alert('Ukuran file melebihi 2MB. Pilih gambar yang lebih kecil.');
      event.target.value = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('previewImg');
      preview.src = e.target.result;
      preview.style.display = 'block';

      document.getElementById('uploadIcon').style.display = 'none';
      document.getElementById('uploadLabel').style.display = 'none';
      document.getElementById('uploadHint').style.display = 'none';

      document.getElementById('uploadArea').style.minHeight = '220px';
    };
    reader.readAsDataURL(file);
  }

  // Form submit
  function submitForm(e) {
    e.preventDefault();

    const judul = document.getElementById('judulJasa').value.trim();
    const kategori = document.getElementById('kategori').value;
    const harga = document.getElementById('harga').value;
    const deskripsi = document.getElementById('deskripsi').value.trim();

    if (!judul || !kategori || !harga || !deskripsi) {
      alert('Harap isi semua field yang diperlukan.');
      return;
    }

    const toast = document.getElementById('toast');
    toast.style.display = 'flex';
    setTimeout(() => {
      toast.style.display = 'none';
      window.location.href = 'kelola_jasa.php';
    }, 2000);
  }
</script>

</body>
</html>
