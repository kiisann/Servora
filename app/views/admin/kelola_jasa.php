<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$jasaList = $jasa ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jasa – Servora Admin</title>
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
                <h1 class="page-title">Kelola Jasa</h1>
                <p class="page-subtitle">Tinjau dan moderasi seluruh jasa yang dipublikasikan.</p>
            </div>
            <div class="header-right">
                <button class="btn btn-primary" onclick="openCreateJasa()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Jasa
                </button>
            </div>
        </header>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="flash-message flash-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="flash-message flash-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="page-content">
            <div class="card-container">
                <div class="card-header">
                    <h4>Daftar Jasa</h4>
                    <input type="text" id="searchJasa" placeholder="Cari jasa...">
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;font-size:14px;">
                        <thead>
                            <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Nama Jasa</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Kategori</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Freelancer</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Harga</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Status</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($jasaList)): ?>
                                <?php foreach($jasaList as $j): ?>
                                <tr data-id="<?= $j['id_jasa'] ?>"
                                    data-nama="<?= htmlspecialchars($j['nama_jasa']) ?>"
                                    data-kategori="<?= $j['id_kategori'] ?? '' ?>"
                                    data-harga="<?= $j['harga'] ?>"
                                    data-status="<?= $j['status'] ?>"
                                    data-deskripsi="<?= htmlspecialchars($j['deskripsi'] ?? '') ?>"
                                    data-gambar="<?= htmlspecialchars($j['gambar'] ?? '') ?>"
                                    style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;font-weight:600;"><?= htmlspecialchars($j['nama_jasa']) ?></td>
                                    <td style="padding:12px 16px;"><span class="badge secondary"><?= htmlspecialchars($j['nama_kategori'] ?? '-') ?></span></td>
                                    <td style="padding:12px 16px;"><?= htmlspecialchars($j['nama_freelancer'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;font-weight:600;">Rp<?= number_format($j['harga'],0,',','.') ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= $j['status'] === 'aktif' ? 'success' : 'warning' ?>"><?= ucfirst($j['status']) ?></span></td>
                                    <td style="padding:12px 16px; text-align: center;">
                                        <button class="btn-edit" onclick="openEditJasa(this.closest('tr'))">Edit</button>

                                        <a href="<?= BASE_URL ?>/jasa/delete/<?= $j['id_jasa'] ?>" class="btn-delete">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="padding:40px;text-align:center;color:#94a3b8;">Belum ada jasa terdaftar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<div id="editModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div>
                <h2 class="modal-title-main">Edit Jasa</h2>
                <p class="modal-subtitle-main">Perbarui informasi jasa freelancer.</p>
            </div>
            <button type="button"class="modal-close-btn"onclick="closeEditJasa()">✕</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data" data-action-template="<?= BASE_URL ?>/jasa/update/__ID__">
            <input type="hidden"name="gambar_lama"id="edit_gambar_lama">
            <div class="modal-grid-fields">
                <div class="modal-field-full">
                    <label class="modal-field-label">Nama Jasa</label>
                    <input type="text"name="nama_jasa"id="edit_nama_jasa"class="modal-field-input"required>
                </div>
                <div>
                    <label class="modal-field-label">Kategori</label>
                    <select name="id_kategori"id="edit_kategori"class="modal-field-select">
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Status</label>
                    <select name="status"id="edit_status"class="modal-field-select">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="modal-field-full">
                    <label class="modal-field-label">Harga</label>
                    <input type="number"name="harga"id="edit_harga"class="modal-field-input"></div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Deskripsi</label>
                    <textarea name="deskripsi"id="edit_deskripsi"rows="5"class="modal-field-textarea"></textarea>
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Gambar</label>
                    <input type="file" name="gambar" class="modal-field-input"></div>
            </div>
            <div class="modal-actions-container">
                <button type="button" class="modal-cancel-btn" onclick="closeEditJasa()">Batal</button>
                <button type="submit"class="modal-submit-btn">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div id="createJasaModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div>
                <h2 class="modal-title-main">Tambah Jasa</h2>
                <p class="modal-subtitle-main">Tambah jasa baru.</p>
            </div>
            <button type="button"class="modal-close-btn"onclick="closeCreateJasa()">✕</button>
        </div>
        <form id="createForm" method="POST" enctype="multipart/form-data" action="<?= BASE_URL ?>/jasa/create">
            <input type="hidden"name="gambar_lama"id="edit_gambar_lama">
            <div class="modal-grid-fields">
                <div class="modal-field-full">
                    <label class="modal-field-label">Nama Jasa</label>
                    <input type="text"name="nama_jasa"id="edit_nama_jasa"class="modal-field-input"required>
                </div>
                <div>
                    <label class="modal-field-label">Kategori</label>
                    <select name="id_kategori"id="edit_kategori"class="modal-field-select">
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Status</label>
                    <select name="status"id="edit_status"class="modal-field-select">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="modal-field-full">
                    <label class="modal-field-label">Harga</label>
                    <input type="number"name="harga"id="edit_harga"class="modal-field-input"></div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Deskripsi</label>
                    <textarea name="deskripsi"id="edit_deskripsi"rows="5"class="modal-field-textarea"></textarea>
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Gambar</label>
                    <input type="file" name="gambar" class="modal-field-input"></div>
            </div>
            <div class="modal-actions-container">
                <button type="button" class="modal-cancel-btn" onclick="closeCreateJasa()">Batal</button>
                <button type="submit"class="modal-submit-btn">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script src="<?= BASE_URL ?>/js/script.js"></script>

</body>
</html>
