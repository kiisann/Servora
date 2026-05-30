<?php
// Controller::view() memanggil extract($data), jadi $user tersedia langsung
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$user   = $user ?? [];
$nama   = htmlspecialchars($user['nama'] ?? $_SESSION['nama'] ?? 'User');
$email  = htmlspecialchars($user['email'] ?? $_SESSION['email'] ?? '');
$role   = htmlspecialchars($user['role'] ?? $_SESSION['role'] ?? 'client');
$bio    = htmlspecialchars($user['bio'] ?? '');
$nohp   = htmlspecialchars($user['no_hp'] ?? '');
$kampus = htmlspecialchars($user['kampus'] ?? '');
$userId = $user['id_user'] ?? $_SESSION['user_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil <?= ucfirst($role) ?> - Servora</title>
  <!-- Kita gunakan style admin sebagai template utama agar rapi -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">

  <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

  <main class="main-content">

    <header class="top-header">
      <div class="header-left">
        <h1 class="page-title">Profil <?= ucfirst($role) ?></h1>
        <p class="page-subtitle">Kelola informasi dan pengaturan akun Anda.</p>
      </div>
      <div class="header-right">
        <div class="header-actions">
          <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg"
               alt="Profile" class="profile-avatar">
        </div>
      </div>
    </header>

    <div class="profile-grid">

      <div class="profile-card">
        <div class="avatar-wrap">
          <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg"
               alt="Avatar" id="profileAvatar">
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
          <form method="POST" action="<?= BASE_URL ?>/profile/update/<?= htmlspecialchars($userId) ?>">

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
              <button type="submit" class="btn btn-primary">
                Simpan Perubahan
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>

  </main>
</div>

</body>
</html>
