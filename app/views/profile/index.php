<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$user   = $user ?? [];
$nama   = htmlspecialchars($user['nama']  ?? $_SESSION['nama'] ?? 'User');
$email  = htmlspecialchars($user['email'] ?? $_SESSION['email'] ?? '');
$role   = htmlspecialchars($user['role']  ?? $_SESSION['role']  ?? 'client');
$bio    = htmlspecialchars($user['bio']   ?? '');
$nohp   = htmlspecialchars($user['no_hp'] ?? '');
$kampus = htmlspecialchars($user['kampus'] ?? '');
$userId = $user['id_user'] ?? $_SESSION['user_id'] ?? '';

$fotoDb       = $user['foto'] ?? null;
$hasFoto      = !empty($fotoDb);
$fotoUrl      = $hasFoto ? BASE_URL . '/assets/images/foto_profil/' . htmlspecialchars($fotoDb) : '';
$initial      = strtoupper(substr(trim($nama), 0, 1));

$successMsg = $_SESSION['success'] ?? null;
$errorMsg   = $_SESSION['error']   ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil <?= ucfirst($role) ?> - Servora</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css?v=<?= time() ?>">
</head>
<body>

<div class="dashboard-container profile-dashboard">

  <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

  <main class="main-content">

    <header class="top-header">
      <div class="header-left">
        <h1 class="page-title">Profil <?= ucfirst($role) ?></h1>
        <p class="page-subtitle">Kelola informasi dan pengaturan akun Anda.</p>
      </div>
    </header>

    <?php if ($successMsg): ?>
      <div class="profile-flash-msg profile-flash-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <?= htmlspecialchars($successMsg) ?>
      </div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
      <div class="profile-flash-msg profile-flash-error">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <?= htmlspecialchars($errorMsg) ?>
      </div>
    <?php endif; ?>

    <div class="profile-grid">
      <div class="profile-card">
        <div class="profile-hero-avatar-wrap" id="avatarWrap" title="Klik untuk ganti foto" style="<?= $hasFoto ? 'background: #fff;' : 'background: #6366f1;' ?>">
          <span id="profileInitial" style="<?= $hasFoto ? 'display:none;' : '' ?>"><?= $initial ?></span>
          <img src="<?= $fotoUrl ?>"
               alt="Foto Profil <?= $nama ?>"
               id="profileAvatar"
               style="<?= $hasFoto ? '' : 'display:none;' ?>">
          <div class="profile-hero-avatar-overlay" onclick="document.getElementById('profileFotoInput').click()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
              <circle cx="12" cy="13" r="4"/>
            </svg>
            Ganti Foto
          </div>
        </div>
        <p class="profile-foto-hint">Tekan foto profil untuk mengubah.</p>

        <div id="fileBadge" class="profile-file-badge">
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
          <span id="fileNameLabel">-</span>
        </div>

        <div class="pc-name"><?= $nama ?></div>
        <div class="pc-handle">@<?= explode('@', $email)[0] ?></div>
        <span class="pc-badge"><?= ucfirst($role) ?></span>

        <button class="btn-logout" onclick="window.location.href='<?= BASE_URL ?>/auth/logout'">
          Keluar
        </button>
      </div>

      <div class="form-area">

        <div class="tabs" role="tablist">
          <button class="tab-btn active">Informasi</button>
        </div>

        <div class="tab-panel active" id="panel-informasi">
          <form method="POST"
                action="<?= BASE_URL ?>/profile/update/<?= htmlspecialchars($userId) ?>"
                enctype="multipart/form-data"
                id="profileForm">

            <input type="file" id="profileFotoInput" name="foto"
                   accept="image/jpeg,image/png,image/webp">

            <fieldset class="form-section">
              <legend class="section-legend">Data Pribadi</legend>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="namaLengkap">Nama Lengkap</label>
                  <input type="text" id="namaLengkap" name="nama" class="form-control"
                         value="<?= $nama ?>" required>
                </div>
                <div class="form-group">
                  <label class="form-label" for="kampus">Kampus</label>
                  <input type="text" id="kampus" name="kampus" class="form-control"
                         value="<?= $kampus ?>">
                </div>
              </div>
            </fieldset>

            <hr class="form-divider">

            <fieldset class="form-section">
              <legend class="section-legend">Kontak &amp; Catatan</legend>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control"
                         value="<?= $email ?>" disabled>
                  <small>Email tidak dapat diubah</small>
                </div>
                <div class="form-group">
                  <label class="form-label" for="nomorHp">Nomor HP</label>
                  <input type="tel" id="nomorHp" name="no_hp" class="form-control"
                         value="<?= $nohp ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="bio">Bio / Catatan</label>
                <textarea id="bio" name="bio" class="form-control" rows="3"><?= $bio ?></textarea>
              </div>
            </fieldset>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
(function () {
  const input    = document.getElementById('profileFotoInput');
  const avatar   = document.getElementById('profileAvatar');
  const badge    = document.getElementById('fileBadge');
  const label    = document.getElementById('fileNameLabel');
  const MAX_MB   = 2;
  const MAX_BYTE = MAX_MB * 1024 * 1024;

  input.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    if (!allowed.includes(file.type)) {
      alert('Format tidak didukung. Pilih file JPG, PNG, atau WEBP.');
      this.value = '';
      return;
    }

    if (file.size > MAX_BYTE) {
      alert('Ukuran file melebihi ' + MAX_MB + ' MB. Pilih foto yang lebih kecil.');
      this.value = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      avatar.src = e.target.result;
      avatar.style.display = 'block';
      const initialSpan = document.getElementById('profileInitial');
      if (initialSpan) initialSpan.style.display = 'none';
      const wrap = document.getElementById('avatarWrap');
      if (wrap) wrap.style.background = '#fff';
    };
    reader.readAsDataURL(file);

    const kb = (file.size / 1024).toFixed(1);
    label.textContent = file.name + ' (' + kb + ' KB)';
    badge.classList.add('visible');
  });
})();
</script>

</body>
</html>
