<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'freelancer') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$kategoris = $kategori ?? [];
$isEdit    = isset($jasa_item) && !empty($jasa_item);
$jItem     = $isEdit ? $jasa_item : [];
$actionUrl = $isEdit ? BASE_URL . '/worker/update/' . $jItem['id_jasa'] : BASE_URL . '/worker/simpan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Edit Jasa' : 'Tambah Jasa' ?> – Servora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <a href="<?= BASE_URL ?>/worker/jasa" class="service-form-back">
                    <svg class="service-form-back-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Kembali ke Kelola Jasa
                </a>
                <h1 class="page-title"><?= $isEdit ? 'Edit Jasa' : 'Tambah Jasa Baru' ?></h1>
                <p class="page-subtitle"><?= $isEdit ? 'Perbarui informasi jasa yang sudah ada.' : 'Lengkapi informasi di bawah untuk mempublikasikan layananmu.' ?></p>
            </div>
        </header>

        <div class="page-content service-form-page">
            <div class="card-container service-form-card">
                <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data" class="service-form">
                    
                    <div class="service-form-group">
                        <label class="service-form-label">Nama Jasa</label>
                        <input type="text" name="nama_jasa" value="<?= htmlspecialchars($jItem['nama_jasa'] ?? '') ?>" required
                               placeholder="Contoh: Desain Poster Estetik"
                               class="service-form-control">
                    </div>

                    <div class="service-form-row">
                        <div class="service-form-col">
                            <label class="service-form-label">Kategori</label>
                            <select name="id_kategori" required class="service-form-control">
                                <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>Pilih kategori</option>
                                <?php foreach($kategoris as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>" <?= ($isEdit && $jItem['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($k['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="service-form-col">
                            <label class="service-form-label">Harga (Rp)</label>
                            <input type="number" name="harga" value="<?= $jItem['harga'] ?? '' ?>" required
                                   placeholder="Misal: 50000" min="1000" step="500"
                                   class="service-form-control">
                        </div>
                    </div>

                    <div class="service-form-group service-form-group-lg">
                        <label class="service-form-label">Deskripsi Jasa</label>
                        <textarea name="deskripsi" required rows="6"
                                  placeholder="Jelaskan detail layanan yang kamu berikan, apa yang didapat pembeli, dll..."
                                  class="service-form-control service-form-textarea"><?= htmlspecialchars($jItem['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="service-form-group service-form-group-lg">
                        <label class="service-form-label">Gambar Jasa</label>
                        <?php if (!empty($jItem['gambar'])): ?>
                            <div class="service-form-preview">
                                <img src="<?= BASE_URL . '/' . htmlspecialchars(ltrim($jItem['gambar'], '/')) ?>" alt="<?= htmlspecialchars($jItem['nama_jasa'] ?? 'Gambar Jasa') ?>" class="service-form-preview-img">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="gambar" accept="image/jpeg,image/png,image/webp"
                               class="service-form-control service-form-file">
                        <p class="service-form-help">Format JPG, PNG, atau WebP. Maksimal 2MB<?= $isEdit ? '. Kosongkan jika tidak ingin mengganti gambar.' : '.' ?></p>
                    </div>

                    <?php if ($isEdit): ?>
                    <div class="service-form-group service-form-group-lg">
                        <label class="service-form-label">Status</label>
                        <select name="status" class="service-form-control">
                            <option value="aktif" <?= ($jItem['status'] ?? '') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($jItem['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="service-form-actions">
                        <a href="<?= BASE_URL ?>/worker/jasa" class="service-form-cancel">Batal</a>
                        <button type="submit" class="btn btn-primary service-form-submit">
                            <?= $isEdit ? 'Simpan Perubahan' : 'Publikasikan Jasa' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</div>

</body>
</html>
