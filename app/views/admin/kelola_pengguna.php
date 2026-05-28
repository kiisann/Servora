<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$pengguna = $pengguna ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna – Servora Admin</title>
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
                <h1 class="page-title">Kelola Pengguna</h1>
                <p class="page-subtitle">Kelola data client, freelancer, dan admin.</p>
            </div>
            <div class="header-right">
                <button class="btn btn-primary" onclick="openCreateUser()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Pengguna
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
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;font-size:14px;">
                    <thead>
                        <tr style="border-bottom:1px solid #e2e8f0;text-align:left;">
                            <th style="padding:12px 16px;color:#64748b;font-weight:600;">Nama</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Email</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Role</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Kampus</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Bergabung</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600;">Status</th>
                                <th style="padding:12px 16px;color:#64748b;font-weight:600; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pengguna)): ?>
                                <?php foreach($pengguna as $u): ?>
                                 <tr data-user='<?= json_encode($u, JSON_HEX_APOS | JSON_HEX_QUOT) ?>' style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;">
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div style="width:36px;height:36px;border-radius:50%;background:#ede9fe;color:#6366f1;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;"><?= strtoupper(mb_substr($u['nama'],0,1)) ?></div>
                                            <span style="font-weight:600;"><?= htmlspecialchars($u['nama']) ?></span>
                                        </div>
                                    </td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= htmlspecialchars($u['email']) ?></td>
                                    <td style="padding:12px 16px;"><span class="badge secondary"><?= ucfirst($u['role']) ?></span></td>
                                    <td style="padding:12px 16px;font-weight:500;"><?= htmlspecialchars($u['kampus'] ?? '-') ?></td>
                                    <td style="padding:12px 16px;color:#64748b;"><?= $u['created_at'] ?? '-' ?></td>
                                    <td style="padding:12px 16px;"><span class="badge <?= ($u['status'] ?? 'aktif') === 'aktif' ? 'success' : 'danger' ?>"><?= ucfirst($u['status'] ?? 'aktif') ?></span></td>
                                     <td style="padding:12px 16px;text-align:center;white-space:nowrap;">
                                         <button type="button" class="btn-edit" onclick="openEditPengguna(this.closest('tr'))">
                                             Edit
                                         </button>
                                         <a href="<?= BASE_URL ?>/user/delete/<?= $u['id_user'] ?>" 
                                            class="btn-delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            Hapus
                                         </a>
                                     </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" style="padding:40px;text-align:center;color:#94a3b8;">Belum ada pengguna terdaftar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Edit Pengguna -->
<div id="editModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div>
                <h3 class="modal-title-main" id="modalTitle">Edit Data Pengguna</h3>
                <p class="modal-subtitle-main">Perbarui informasi lengkap akun pengguna.</p>
            </div>
            <button type="button" onclick="closeEditPengguna()" class="modal-close-btn">✕</button>
        </div>

        <form id="editForm" method="POST" data-action-template="<?= BASE_URL ?>/user/updateAdmin/__ID__">
            <div class="modal-grid-fields">
                <div class="modal-field-full">
                    <label class="modal-field-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="edit_nama" required class="modal-field-input">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Email</label>
                    <input type="email" name="email" id="edit_email" required class="modal-field-input">
                </div>


                <div>
                    <label class="modal-field-label">Role</label>
                    <select name="role" id="edit_role" class="modal-field-select">
                        <option value="client">Client</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Status</label>
                    <select name="status" id="edit_status" class="modal-field-select">
                        <option value="aktif">Aktif</option>
                        <option value="ditangguhkan">Ditangguhkan</option>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Nomor HP</label>
                    <input type="text" name="no_hp" id="edit_no_hp" class="modal-field-input">
                </div>

                <div>
                    <label class="modal-field-label">Saldo (Rp)</label>
                    <input type="number" step="0.01" name="saldo" id="edit_saldo" class="modal-field-input">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Kampus</label>
                    <input type="text" name="kampus" id="edit_kampus" class="modal-field-input">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Bio</label>
                    <textarea name="bio" id="edit_bio" rows="3" class="modal-field-textarea"></textarea>
                </div>
            </div>

            <div class="modal-actions-container">
                <button type="button" onclick="closeEditPengguna()" class="modal-cancel-btn">Batal</button>
                <button type="submit" class="modal-submit-btn">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Create Pengguna Modal -->
<div id="createModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div>
                <h3 class="modal-title-main">Tambah Pengguna Baru</h3>
                <p class="modal-subtitle-main">Isi data untuk membuat akun pengguna baru.</p>
            </div>
            <button type="button" onclick="closeCreateUser()" class="modal-close-btn">✕</button>
        </div>

        <form id="createForm" method="POST" action="<?= BASE_URL ?>/user/store">
            <div class="modal-grid-fields">
                <div class="modal-field-full">
                    <label class="modal-field-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
                    <input type="text" name="nama" required class="modal-field-input" placeholder="Masukkan nama lengkap">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Email <span style="color:#ef4444">*</span></label>
                    <input type="email" name="email" required class="modal-field-input" placeholder="contoh@email.com">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Password <span style="color:#ef4444">*</span></label>
                    <input type="password" name="password" required class="modal-field-input" placeholder="Minimal 6 karakter" minlength="6">
                </div>

                <div>
                    <label class="modal-field-label">Role</label>
                    <select name="role" class="modal-field-select">
                        <option value="client">Client</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Status</label>
                    <select name="status" class="modal-field-select">
                        <option value="aktif">Aktif</option>
                        <option value="ditangguhkan">Ditangguhkan</option>
                    </select>
                </div>

                <div>
                    <label class="modal-field-label">Nomor HP</label>
                    <input type="text" name="no_hp" class="modal-field-input" placeholder="08xxxxxxxxxx">
                </div>

                <div>
                    <label class="modal-field-label">Saldo (Rp)</label>
                    <input type="number" step="0.01" name="saldo" value="0" class="modal-field-input">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Kampus</label>
                    <input type="text" name="kampus" class="modal-field-input" placeholder="Nama kampus">
                </div>

                <div class="modal-field-full">
                    <label class="modal-field-label">Bio</label>
                    <textarea name="bio" rows="3" class="modal-field-textarea" placeholder="Deskripsi singkat..."></textarea>
                </div>
            </div>

            <div class="modal-actions-container">
                <button type="button" onclick="closeCreateUser()" class="modal-cancel-btn">Batal</button>
                <button type="submit" class="modal-submit-btn">Tambah Pengguna</button>
            </div>
        </form>
    </div>
</div>

<script src="<?= BASE_URL ?>/js/script.js"></script>

</body>
</html>
