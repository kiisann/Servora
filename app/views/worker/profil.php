<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Servora Worker</title>
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
            <a href="profil.php" class="nav-item active">
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

            <div class="profile-layout">

                <div class="profile-card">

                    <div class="profile-avatar-wrap" onclick="document.getElementById('avatarInput').click()" title="Ganti foto">
                        <img src="https://i.pravatar.cc/150?img=47"
                             alt="Avatar"
                             class="profile-avatar-large"
                             id="profileAvatarImg">
                        <div class="avatar-edit-overlay">
                            <i class='bx bx-camera'></i>
                        </div>
                        <input type="file" id="avatarInput" accept="image/*"
                               style="display:none;" onchange="changeAvatar(event)">
                    </div>

                    <!-- Name & Handle -->
                    <div class="profile-name">Naya Pramesti</div>
                    <div class="profile-handle">@nayap &middot; UGM</div>

                    <!-- Role Badge -->
                    <span class="profile-role-badge">Freelancer</span>

                    <!-- Stats -->
                    <div class="profile-stats">
                        <div class="profile-stat-item">
                            <span class="stat-val">128</span>
                            <span class="stat-lbl">Pesanan</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-val">4.9</span>
                            <span class="stat-lbl">Rating</span>
                        </div>
                        <div class="profile-stat-item">
                            <span class="stat-val">2j</span>
                            <span class="stat-lbl">Member</span>
                        </div>
                    </div>

                    <!-- Share Button -->
                    <button class="btn-outline" onclick="shareProfile()">
                        <i class='bx bx-share-alt'></i>
                        Bagikan profil
                    </button>

                </div><!-- end profile-card -->

                <!-- ========================
                     RIGHT: FORM AREA
                ======================== -->
                <div class="profile-form-area">

                    <!-- Tabs -->
                    <div class="profile-tabs">
                        <button class="profile-tab-item active" onclick="switchTab(this, 'tab-informasi')">
                            Informasi
                        </button>
                        <button class="profile-tab-item" onclick="switchTab(this, 'tab-keamanan')">
                            Keamanan
                        </button>
                        <button class="profile-tab-item" onclick="switchTab(this, 'tab-notifikasi')">
                            Notifikasi
                        </button>
                    </div>

                    <!-- ======= TAB: INFORMASI ======= -->
                    <div class="profile-tab-content active" id="tab-informasi">
                        <form onsubmit="saveProfile(event)">

                            <!-- Nama + Username -->
                            <div class="form-row">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="namaLengkap">Nama lengkap</label>
                                    <input type="text" id="namaLengkap" class="form-control"
                                           value="Naya Pramesti" required>
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" id="username" class="form-control"
                                           value="nayap" required>
                                </div>
                            </div>

                            <!-- Email + Nomor HP -->
                            <div class="form-row">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" class="form-control"
                                           value="naya@kampus.ac.id" required>
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="nomorHp">Nomor HP</label>
                                    <input type="tel" id="nomorHp" class="form-control"
                                           value="+62 812 3456 7890">
                                </div>
                            </div>

                            <!-- Kampus + Jurusan -->
                            <div class="form-row">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="kampus">Kampus</label>
                                    <input type="text" id="kampus" class="form-control"
                                           value="Universitas Gadjah Mada">
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label" for="jurusan">Jurusan</label>
                                    <input type="text" id="jurusan" class="form-control"
                                           value="Desain Komunikasi Visual">
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="form-group">
                                <label class="form-label" for="bio">Bio</label>
                                <textarea id="bio" class="form-control" rows="4"
                                          placeholder="Ceritakan tentang dirimu...">Mahasiswa DKV dengan 3 tahun pengalaman desain grafis. Suka membantu teman mahasiswa lain.</textarea>
                            </div>

                            <!-- Keahlian -->
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Keahlian</label>
                                <div class="skill-tags" id="skillTags">
                                    <span class="skill-tag">
                                        Figma
                                        <button type="button" onclick="removeSkill(this)" title="Hapus">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </span>
                                    <span class="skill-tag">
                                        Canva
                                        <button type="button" onclick="removeSkill(this)" title="Hapus">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </span>
                                    <span class="skill-tag">
                                        Branding
                                        <button type="button" onclick="removeSkill(this)" title="Hapus">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </span>
                                    <span class="skill-tag">
                                        Illustration
                                        <button type="button" onclick="removeSkill(this)" title="Hapus">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </span>
                                    <span class="skill-tag">
                                        Poster
                                        <button type="button" onclick="removeSkill(this)" title="Hapus">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="skill-input-wrap">
                                    <input type="text" id="newSkillInput"
                                           placeholder="Tambah keahlian baru..."
                                           onkeydown="if(event.key==='Enter'){event.preventDefault();addSkill();}">
                                    <button type="button" onclick="addSkill()">Tambah</button>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="button" class="btn-secondary" onclick="resetForm()">Batal</button>
                                <button type="submit" class="btn-primary">
                                    <i class='bx bx-check'></i>
                                    Simpan perubahan
                                </button>
                            </div>

                        </form>
                    </div><!-- end tab-informasi -->

                    <!-- ======= TAB: KEAMANAN (kosong sesuai permintaan) ======= -->
                    <div class="profile-tab-content" id="tab-keamanan">
                        <div style="text-align:center;padding:40px 20px;color:var(--text-muted);">
                            <i class='bx bx-lock-alt' style="font-size:40px;display:block;margin-bottom:12px;"></i>
                            <p style="font-size:14px;">Pengaturan keamanan akan segera tersedia.</p>
                        </div>
                    </div>

                    <!-- ======= TAB: NOTIFIKASI (kosong sesuai permintaan) ======= -->
                    <div class="profile-tab-content" id="tab-notifikasi">
                        <div style="text-align:center;padding:40px 20px;color:var(--text-muted);">
                            <i class='bx bx-bell-off' style="font-size:40px;display:block;margin-bottom:12px;"></i>
                            <p style="font-size:14px;">Pengaturan notifikasi akan segera tersedia.</p>
                        </div>
                    </div>

                </div><!-- end profile-form-area -->

            </div><!-- end profile-layout -->

        </div><!-- end content-wrapper -->
    </main>

</div><!-- end dashboard-container -->

<!-- Toast Notification -->
<div id="toast" style="
  display:none; position:fixed; bottom:28px; right:28px;
  background:#1e293b; color:#fff; padding:14px 22px;
  border-radius:12px; font-size:14px; font-weight:500;
  z-index:999; box-shadow:0 8px 24px rgba(0,0,0,0.2);
  align-items:center; gap:10px;">
  <i class='bx bx-check-circle' style="font-size:18px;color:#22c55e;"></i>
  <span id="toastMsg">Profil berhasil disimpan!</span>
</div>

<script>
  // Sidebar toggle
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  // Tab switch
  function switchTab(btn, tabId) {
    document.querySelectorAll('.profile-tab-item').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.profile-tab-content').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(tabId).classList.add('active');
  }

  // Change avatar
  function changeAvatar(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('profileAvatarImg').src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  // Add skill tag
  function addSkill() {
    const input = document.getElementById('newSkillInput');
    const val = input.value.trim();
    if (!val) return;

    const tag = document.createElement('span');
    tag.className = 'skill-tag';
    tag.innerHTML = `${val} <button type="button" onclick="removeSkill(this)" title="Hapus"><i class='bx bx-x'></i></button>`;
    document.getElementById('skillTags').appendChild(tag);
    input.value = '';
  }

  // Remove skill tag
  function removeSkill(btn) {
    btn.closest('.skill-tag').remove();
  }

  // Save profile
  function saveProfile(e) {
    e.preventDefault();
    showToast('Profil berhasil disimpan!');
  }

  // Reset form
  function resetForm() {
    if (confirm('Batalkan semua perubahan?')) {
      window.location.reload();
    }
  }

  // Share profile
  function shareProfile() {
    const url = window.location.origin + '/profil/nayap';
    if (navigator.clipboard) {
      navigator.clipboard.writeText(url).then(() => showToast('Link profil disalin!'));
    } else {
      showToast('Link profil: ' + url);
    }
  }

  // Toast
  function showToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg;
    toast.style.display = 'flex';
    setTimeout(() => { toast.style.display = 'none'; }, 2500);
  }
</script>

</body>
</html>
