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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">
    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <a href="<?= BASE_URL ?>/worker/jasa" style="display:inline-flex;align-items:center;gap:6px;color:#64748b;font-size:14px;text-decoration:none;margin-bottom:12px;font-weight:500;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Kembali ke Kelola Jasa
                </a>
                <h1 class="page-title"><?= $isEdit ? 'Edit Jasa' : 'Tambah Jasa Baru' ?></h1>
                <p class="page-subtitle"><?= $isEdit ? 'Perbarui informasi jasa yang sudah ada.' : 'Lengkapi informasi di bawah untuk mempublikasikan layananmu.' ?></p>
            </div>
        </header>

        <div class="page-content" style="max-width:800px;">
            <div class="card-container" style="padding:32px;">
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#1e293b;margin-bottom:8px;">Nama Jasa</label>
                        <input type="text" name="nama_jasa" value="<?= htmlspecialchars($jItem['nama_jasa'] ?? '') ?>" required
                               placeholder="Contoh: Desain Poster Estetik"
                               style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;">
                    </div>

                    <div style="display:flex;gap:20px;margin-bottom:20px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:200px;">
                            <label style="display:block;font-size:14px;font-weight:600;color:#1e293b;margin-bottom:8px;">Kategori</label>
                            <select name="id_kategori" required
                                    style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;background:#fff;">
                                <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>Pilih kategori</option>
                                <?php foreach($kategoris as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>" <?= ($isEdit && $jItem['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($k['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="flex:1;min-width:200px;">
                            <label style="display:block;font-size:14px;font-weight:600;color:#1e293b;margin-bottom:8px;">Harga (Rp)</label>
                            <input type="number" name="harga" value="<?= $jItem['harga'] ?? '' ?>" required
                                   placeholder="Misal: 50000" min="1000" step="500"
                                   style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;">
                        </div>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#1e293b;margin-bottom:8px;">Deskripsi Jasa</label>
                        <textarea name="deskripsi" required rows="6"
                                  placeholder="Jelaskan detail layanan yang kamu berikan, apa yang didapat pembeli, dll..."
                                  style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;resize:vertical;font-family:inherit;"><?= htmlspecialchars($jItem['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <?php if ($isEdit): ?>
                    <div style="margin-bottom:24px;">
                        <label style="display:block;font-size:14px;font-weight:600;color:#1e293b;margin-bottom:8px;">Status</label>
                        <select name="status" style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;background:#fff;">
                            <option value="aktif" <?= ($jItem['status'] ?? '') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($jItem['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:32px;">
                        <a href="<?= BASE_URL ?>/worker/jasa" style="padding:10px 20px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#475569;font-size:14px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">Batal</a>
                        <button type="submit" class="btn btn-primary" style="font-size:14px;padding:10px 24px;">
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
