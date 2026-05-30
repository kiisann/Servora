<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}
$sessionNama = htmlspecialchars($_SESSION['nama'] ?? 'Pengguna');
$pesananList = $pesanan ?? [];
$selectedId  = $selected_id ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya – Servora</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css">
</head>
<body>

<div class="dashboard-container">

    <?php require_once __DIR__ . '/../../../components/layout/sidebar.php'; ?>

    <main class="main-content">

        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">Pesanan Saya</h1>
                <p class="page-subtitle">Kelola semua pesanan jasa kamu.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="<?= BASE_URL ?>/jasa" class="btn btn-primary btn-icon-gap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" /></svg>
                        Cari Jasa
                    </a>
                </div>
            </div>
        </header>

        <div class="page-content">

            <div class="card-container">
                <div class="card-header">
                    <h3>Daftar Pesanan</h3>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr class="data-table-head-row">
                                <th>ID</th>
                                <th>Jasa</th>
                                <th>Freelancer</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesananList)): ?>
                                <?php foreach($pesananList as $p): ?>
                                <?php
                                    $badgeClass = match($p['status']) {
                                        'pending'    => 'warning',
                                        'diproses'   => 'info',
                                        'selesai'    => 'success',
                                        'dibatalkan' => 'danger',
                                        default      => 'info'
                                    };
                                    $badgeText = match($p['status']) {
                                        'pending'    => 'Menunggu',
                                        'diproses'   => 'Diproses',
                                        'selesai'    => 'Selesai',
                                        'dibatalkan' => 'Dibatalkan',
                                        default      => ucfirst($p['status'])
                                    };
                                ?>
                                <tr class="data-table-row"
                                    data-pesanan='<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                                    <td class="table-cell-id">#<?= $p['id_pesanan'] ?></td>
                                    <td class="table-cell-strong"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                    <td><?= htmlspecialchars($p['nama_freelancer'] ?? '-') ?></td>
                                    <td class="table-cell-muted"><?= $p['created_at'] ?? '-' ?></td>
                                    <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-table-detail"
                                                onclick="openDetail(this.closest('tr'))">Detail</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="table-empty">
                                        Belum ada pesanan. <a href="<?= BASE_URL ?>/jasa" class="link-primary-strong">Cari jasa sekarang</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</div>

<!-- Detail Modal Popup -->
<div id="detailModal" class="modal-overlay detail-modal detail-modal-wide">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title-main" id="modalTitle">Detail Pesanan</h3>
            <button onclick="closeDetail()" class="modal-close-plain">✕</button>
        </div>
        <div id="modalContent"></div>
        <div id="modalActions" class="detail-modal-actions">
        </div>
    </div>
</div>

<script>
function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    
    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;

    const statusMap = {
        pending: 'Menunggu',
        diskusi: 'Diskusi',
        menunggu_pembayaran: 'Menunggu Pembayaran',
        menunggu_verifikasi: 'Menunggu Verifikasi',
        diproses: 'Diproses',
        selesai: 'Selesai',
        dibatalkan: 'Dibatalkan'
    };

    const canContactWorker = !['pending', 'selesai', 'dibatalkan'].includes(data.status);
    const showFinalDetail = ['menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'selesai'].includes(data.status);
    const cancelButton = data.status === 'pending' ? `
       <form method="POST" action="<?= BASE_URL ?>/pesanan/updateStatus/${data.id_pesanan}">
             <input type="hidden" name="status" value="dibatalkan">
             <button type="submit"
                onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                class="btn-modal-danger">
                Batalkan Pesanan
             </button>
       </form>
    ` : '';

    const uploadBuktiForm = data.status === 'menunggu_pembayaran' ? `
       <form method="POST"
             action="<?= BASE_URL ?>/pesanan/uploadBuktiPembayaran/${data.id_pesanan}"
             enctype="multipart/form-data"
             class="payment-upload-form">

           <label class="modal-form-label">
              Pilih Metode Pembayaran
           </label>

          <select name="id_metode"
                  required
                  class="modal-form-select">
              <option value="">Pilih metode pembayaran</option>
              <option value="1">Transfer Bank</option>
              <option value="2">E-Wallet</option>
              <option value="3">QRIS</option>
          </select>

          <label class="modal-form-label">
             Upload Bukti Pembayaran
          </label>
            <input type="file"
                   name="bukti_pembayaran"
                   accept=".jpg,.jpeg,.png,.pdf"
                   required
                   class="modal-form-file">

            <button type="submit"
                   onclick="return confirm('Yakin ingin mengunggah bukti pembayaran?')"
                   class="btn-modal-primary">
                Kirim Bukti Pembayaran
            </button>
       </form>
    ` : '';
    
    const contactButton = canContactWorker ? `
        <a href="https://wa.me/${data.no_hp_freelancer ? data.no_hp_freelancer.replace(/^0/, '62') : ''}"
           target="_blank"
           class="btn-modal-contact">
           Hubungi Freelancer
        </a>
    ` : '';

    const finalDetailRows = showFinalDetail ? `
        <tr><td class="detail-label">Harga Awal</td><td>${data.harga_awal ? 'Rp' + Number(data.harga_awal).toLocaleString('id-ID') : '-'}</td></tr>
        <tr><td class="detail-label">Harga Final</td><td>${data.harga_final ? 'Rp' + Number(data.harga_final).toLocaleString('id-ID') : '-'}</td></tr>
        <tr><td class="detail-label">Deadline Final</td><td>${data.deadline_final || '-'}</td></tr>
        <tr><td class="detail-label">Waktu Pengerjaan</td><td>${data.waktu_pengerjaan || '-'}</td></tr>
        <tr><td class="detail-label">Maksimal Revisi</td><td>${data.maksimal_revisi || '-'}</td></tr>
        <tr><td class="detail-label">Catatan Worker</td><td>${data.catatan_worker || '-'}</td></tr>
    ` : '';

    document.getElementById('modalContent').innerHTML = `
        <table class="detail-table">
            <tr><td class="detail-label detail-label-wide">Nama Jasa</td><td class="detail-value-strong">${data.nama_jasa}</td></tr>
            <tr><td class="detail-label">Freelancer</td><td>${data.nama_freelancer || '-'}</td></tr>
            <tr><td class="detail-label">Tanggal</td><td>${data.created_at || '-'}</td></tr>
            <tr><td class="detail-label">Deadline</td><td>${data.deadline || '-'}</td></tr>
            <tr><td class="detail-label">Catatan</td><td>${data.catatan || '-'}</td></tr>
            <tr><td class="detail-label">Status</td><td class="detail-value-strong">${statusMap[data.status] || data.status}</td></tr>
            ${finalDetailRows}
        </table>`;

    document.getElementById('modalActions').innerHTML = `
        <div class="detail-modal-action-wrap">
            ${uploadBuktiForm}

            <div class="detail-modal-action-row">
                ${contactButton}
                ${cancelButton}

                <button onclick="closeDetail()"
                   class="btn-modal-close">
                   Tutup
                </button>
            </div>
        </div>
    `;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() {
    document.getElementById('detailModal').style.display = 'none';
}

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetail();
});

<?php if ($selectedId): ?>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tr[data-pesanan]');
    rows.forEach(row => {
        const d = JSON.parse(row.dataset.pesanan);
        if (d.id_pesanan == <?= (int)$selectedId ?>) openDetail(row);
    });
});
<?php endif; ?>
</script>

</body>
</html>
