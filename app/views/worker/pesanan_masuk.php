<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}

$pesananList = $pesanan ?? [];
$selectedId  = $selected_id ?? null;

$statusLabels = [
    'pending'              => 'Pending',
    'diskusi'              => 'Diskusi',
    'menunggu_pembayaran'  => 'Menunggu Pembayaran',
    'menunggu_verifikasi'  => 'Menunggu Verifikasi',
    'diproses'             => 'Diproses',
    'selesai'              => 'Selesai',
    'dibatalkan'           => 'Dibatalkan',
];

$statusBadges = [
    'pending'              => 'warning',
    'diskusi'              => 'info',
    'menunggu_pembayaran'  => 'warning',
    'menunggu_verifikasi'  => 'info',
    'diproses'             => 'info',
    'selesai'              => 'success',
    'dibatalkan'           => 'danger',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Servora</title>
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
                <h1 class="page-title">Pesanan Masuk</h1>
                <p class="page-subtitle">Kelola pesanan dari tahap diskusi sampai pekerjaan selesai.</p>
            </div>
            <div class="header-right">
                <div class="worker-order-search">
                    <input type="text" id="searchOrder" placeholder="Cari pesanan..." oninput="filterOrders()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
            </div>
        </header>

        <div class="page-content">
            <div class="worker-order-tabs">
                <button class="worker-order-tab active" type="button" onclick="setTab(this,'semua')">Semua</button>
                <?php foreach ($statusLabels as $status => $label): ?>
                    <button class="worker-order-tab" type="button" onclick="setTab(this,'<?= $status ?>')"><?= htmlspecialchars($label) ?></button>
                <?php endforeach; ?>
            </div>

            <div class="card-container worker-order-card">
                <div class="worker-order-table-wrap">
                    <table class="worker-order-table">
                        <thead>
                            <tr>
                                <th>Jasa</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ordersBody">
                            <?php if (!empty($pesananList)): ?>
                                <?php foreach ($pesananList as $p): ?>
                                    <?php
                                        $status = $p['status'] ?? 'pending';
                                        $badgeClass = $statusBadges[$status] ?? 'info';
                                        $badgeText = $statusLabels[$status] ?? ucfirst($status);
                                    ?>
                                    <tr data-status="<?= htmlspecialchars($status) ?>"
                                        data-pesanan='<?= htmlspecialchars(json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8') ?>'>
                                        <td class="worker-order-title"><?= htmlspecialchars($p['nama_jasa']) ?></td>
                                        <td><?= htmlspecialchars($p['nama_client'] ?? '-') ?></td>
                                        <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($badgeText) ?></span></td>
                                        <td><?= htmlspecialchars($p['created_at'] ?? '-') ?></td>
                                        <td>
                                            <button class="worker-order-detail-btn" type="button" onclick="openDetail(this.closest('tr'))">Detail</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="worker-order-empty">Belum ada pesanan masuk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<div id="detailModal" class="worker-order-modal">
    <div class="worker-order-dialog">
        <div class="worker-order-modal-header">
            <div>
                <h3 id="modalTitle">Detail Pesanan</h3>
                <p id="modalSubtitle"></p>
            </div>
            <button class="worker-order-close" type="button" onclick="closeDetail()">x</button>
        </div>
        <div id="modalContent"></div>
        <div id="modalActions" class="worker-order-actions"></div>
    </div>
</div>

<div id="reasonModal" class="worker-order-modal">
    <div class="worker-order-reason-dialog">
        <div class="worker-order-modal-header">
            <div>
                <h3 id="reasonTitle">Isi Alasan</h3>
                <p id="reasonSubtitle"></p>
            </div>
            <button class="worker-order-close" type="button" onclick="closeReasonModal()">x</button>
        </div>
        <form id="reasonForm" method="POST" class="worker-order-form">
            <label id="reasonLabel">Alasan</label>
            <textarea id="reasonTextarea" name="alasan_pembatalan" rows="4" required></textarea>
            <div class="worker-order-reason-actions">
                <button type="button" class="worker-order-secondary" onclick="closeReasonModal()">Batal</button>
                <button id="reasonSubmit" type="submit" class="worker-order-danger">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
const BASE_URL = <?= json_encode(BASE_URL) ?>;
const selectedId = <?= $selectedId ? (int)$selectedId : 'null' ?>;
let activeTab = 'semua';

const statusLabels = {
    pending: 'Pending',
    diskusi: 'Diskusi',
    menunggu_pembayaran: 'Menunggu Pembayaran',
    menunggu_verifikasi: 'Menunggu Verifikasi',
    diproses: 'Diproses',
    selesai: 'Selesai',
    dibatalkan: 'Dibatalkan'
};

function escapeHtml(value) {
    return String(value ?? '-').replace(/[&<>"']/g, match => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[match]));
}

function formatCurrency(value) {
    const amount = Number(value || 0);
    if (!amount) return '-';
    return 'Rp' + amount.toLocaleString('id-ID');
}

function assetUrl(path) {
    if (!path) return '';
    return BASE_URL + '/' + String(path).replace(/^\/+/, '');
}

function whatsappUrl(phone) {
    if (!phone) return '';
    let cleaned = String(phone).replace(/\D/g, '');
    if (cleaned.startsWith('0')) cleaned = '62' + cleaned.slice(1);
    return cleaned ? 'https://wa.me/' + cleaned : '';
}

function setTab(btn, tab) {
    activeTab = tab;
    document.querySelectorAll('.worker-order-tab').forEach(item => item.classList.remove('active'));
    btn.classList.add('active');
    filterOrders();
}

function filterOrders() {
    const keyword = document.getElementById('searchOrder').value.toLowerCase();
    document.querySelectorAll('#ordersBody tr[data-status]').forEach(row => {
        const tabMatch = activeTab === 'semua' || row.dataset.status === activeTab;
        const kwMatch = !keyword || row.textContent.toLowerCase().includes(keyword);
        row.style.display = tabMatch && kwMatch ? '' : 'none';
    });
}

function infoRow(label, value) {
    return `
        <div class="worker-order-info-row">
            <span>${escapeHtml(label)}</span>
            <strong>${escapeHtml(value)}</strong>
        </div>`;
}

function paymentProof(data) {
    if (!data.bukti_pembayaran) return infoRow('Bukti Pembayaran', '-');
    return `
        <div class="worker-order-proof">
            <span>Bukti Pembayaran</span>
            <a href="${assetUrl(data.bukti_pembayaran)}" target="_blank" rel="noopener">
                <img src="${assetUrl(data.bukti_pembayaran)}" alt="Bukti Pembayaran">
            </a>
        </div>`;
}

function baseInfo(data) {
    return `
        ${infoRow('Nama Jasa', data.nama_jasa)}
        ${infoRow('Client', data.nama_client)}
        ${infoRow('Harga Awal', formatCurrency(data.harga_awal || data.harga_jasa))}
        ${infoRow('Catatan Awal Client', data.catatan)}
        ${infoRow('Deadline Awal', data.deadline)}
        ${infoRow('Tanggal Pesanan', data.created_at)}
        ${infoRow('Status', statusLabels[data.status] || data.status)}`;
}

function finalInfo(data) {
    return `
        ${infoRow('Detail Project Final', data.detail_project_final)}
        ${infoRow('Harga Final', formatCurrency(data.harga_final))}
        ${infoRow('Waktu Pengerjaan', data.waktu_pengerjaan)}
        ${infoRow('Maksimal Revisi', data.maksimal_revisi)}
        ${infoRow('Deadline Final', data.deadline_final)}
        ${infoRow('Catatan Worker', data.catatan_worker)}`;
}

function discussionForm(data) {
    return `
        <form method="POST" action="${BASE_URL}/pesanan/submitFinal/${data.id_pesanan}" class="worker-order-form">
            <label>Detail Project</label>
            <textarea name="detail_project_final" rows="4" required>${escapeHtml(data.detail_project_final || '')}</textarea>
            <div class="worker-order-form-grid">
                <div>
                    <label>Harga Final</label>
                    <input type="number" name="harga_final" min="1000" step="500" value="${escapeHtml(data.harga_final || data.harga_awal || data.harga_jasa || '')}" required>
                </div>
                <div>
                    <label>Waktu Pengerjaan</label>
                    <input type="text" name="waktu_pengerjaan" value="${escapeHtml(data.waktu_pengerjaan || '')}" placeholder="Contoh: 5 hari" required>
                </div>
                <div>
                    <label>Maksimal Revisi</label>
                    <input type="number" name="maksimal_revisi" min="0" value="${escapeHtml(data.maksimal_revisi || 1)}" required>
                </div>
                <div>
                    <label>Deadline Pengerjaan</label>
                    <input type="date" name="deadline_final" value="${escapeHtml(data.deadline_final || data.deadline || '')}" required>
                </div>
            </div>
            <label>Catatan Tambahan</label>
            <textarea name="catatan_worker" rows="3">${escapeHtml(data.catatan_worker || '')}</textarea>
            <button type="submit" class="worker-order-primary">Submit Final Pesanan</button>
        </form>`;
}

function cancelButton(data) {
    return `<button type="button" class="worker-order-danger" onclick="openReasonModal('cancel', ${data.id_pesanan})">Batalkan Pesanan</button>`;
}

function actionButton(label, action, className) {
    return `
        <form method="POST" action="${action}">
            <button type="submit" class="${className}">${label}</button>
        </form>`;
}

function rejectPaymentButton(data) {
    return `<button type="button" class="worker-order-danger" onclick="openReasonModal('rejectPayment', ${data.id_pesanan})">Tolak Pembayaran</button>`;
}

function openReasonModal(type, orderId) {
    const form = document.getElementById('reasonForm');
    const title = document.getElementById('reasonTitle');
    const subtitle = document.getElementById('reasonSubtitle');
    const label = document.getElementById('reasonLabel');
    const textarea = document.getElementById('reasonTextarea');
    const submit = document.getElementById('reasonSubmit');

    textarea.value = '';

    if (type === 'rejectPayment') {
        form.action = `${BASE_URL}/pesanan/tolakPembayaran/${orderId}`;
        textarea.name = 'catatan_verifikasi';
        textarea.placeholder = 'Contoh: nominal tidak sesuai atau bukti pembayaran tidak jelas.';
        title.textContent = 'Tolak Pembayaran';
        subtitle.textContent = 'Isi catatan agar client tahu bagian pembayaran yang perlu diperbaiki.';
        label.textContent = 'Catatan Penolakan Pembayaran';
        submit.textContent = 'Submit Penolakan';
    } else {
        form.action = `${BASE_URL}/pesanan/batalkan/${orderId}`;
        textarea.name = 'alasan_pembatalan';
        textarea.placeholder = 'Jelaskan alasan pesanan tidak dapat dilanjutkan.';
        title.textContent = 'Batalkan Pesanan';
        subtitle.textContent = 'Isi alasan pembatalan agar client mengetahui penyebabnya.';
        label.textContent = 'Alasan Pembatalan';
        submit.textContent = 'Submit Pembatalan';
    }

    document.getElementById('reasonModal').classList.add('open');
}

function closeReasonModal() {
    document.getElementById('reasonModal').classList.remove('open');
}

function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    const wa = whatsappUrl(data.no_hp_client);

    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;
    document.getElementById('modalSubtitle').textContent = statusLabels[data.status] || data.status;

    let content = `<div class="worker-order-info">${baseInfo(data)}</div>`;
    let actions = '';

    if (data.status === 'pending') {
        actions = `
            ${cancelButton(data)}
            ${actionButton('Mulai Diskusi', `${BASE_URL}/pesanan/mulaiDiskusi/${data.id_pesanan}`, 'worker-order-primary')}`;
    }

    if (data.status === 'diskusi') {
        content += `<h4 class="worker-order-section-title">Detail Final Pesanan</h4>${discussionForm(data)}`;
        actions = `${wa ? `<a class="worker-order-secondary" href="${wa}" target="_blank" rel="noopener">Hubungi Client</a>` : ''}${cancelButton(data)}`;
    }

    if (data.status === 'menunggu_pembayaran') {
        content += `<h4 class="worker-order-section-title">Final Pesanan</h4><div class="worker-order-info">${finalInfo(data)}</div>`;
        actions = `${wa ? `<a class="worker-order-secondary" href="${wa}" target="_blank" rel="noopener">Hubungi Client</a>` : ''}`;
    }

    if (data.status === 'menunggu_verifikasi') {
        content += `
            <h4 class="worker-order-section-title">Pembayaran Client</h4>
            <div class="worker-order-info">
                ${infoRow('Harga Final', formatCurrency(data.harga_final || data.total_bayar))}
                ${infoRow('Metode Pembayaran', data.metode_pembayaran)}
                ${infoRow('Tanggal Upload Bukti', data.tanggal_upload_bukti)}
                ${paymentProof(data)}
            </div>`;
        actions = `
            ${wa ? `<a class="worker-order-secondary" href="${wa}" target="_blank" rel="noopener">Hubungi Client</a>` : ''}
            ${actionButton('Terima Pembayaran', `${BASE_URL}/pesanan/terimaPembayaran/${data.id_pesanan}`, 'worker-order-primary')}
            ${rejectPaymentButton(data)}`;
    }

    if (data.status === 'diproses') {
        content += `
            <h4 class="worker-order-section-title">Pesanan Diproses</h4>
            <div class="worker-order-info">${finalInfo(data)}${paymentProof(data)}</div>`;
        actions = `
            ${wa ? `<a class="worker-order-secondary" href="${wa}" target="_blank" rel="noopener">Hubungi Client</a>` : ''}
            ${actionButton('Tandai Selesai', `${BASE_URL}/pesanan/tandaiSelesai/${data.id_pesanan}`, 'worker-order-primary')}`;
    }

    if (data.status === 'selesai') {
        content += `
            <h4 class="worker-order-section-title">Pesanan Selesai</h4>
            <div class="worker-order-info">
                ${finalInfo(data)}
                ${paymentProof(data)}
                ${infoRow('Tanggal Selesai', data.selesai_at)}
            </div>`;
    }

    if (data.status === 'dibatalkan') {
        content += `
            <h4 class="worker-order-section-title">Pesanan Dibatalkan</h4>
            <div class="worker-order-info">
                ${infoRow('Alasan Pembatalan', data.alasan_pembatalan)}
                ${infoRow('Dibatalkan Oleh', data.dibatalkan_oleh)}
                ${infoRow('Tanggal Pembatalan', data.dibatalkan_at)}
            </div>`;
    }

    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('modalActions').innerHTML = actions || (data.status === 'selesai' ? '' : '<button type="button" class="worker-order-secondary" onclick="closeDetail()">Tutup</button>');
    document.getElementById('detailModal').classList.add('open');
}

function closeDetail() {
    document.getElementById('detailModal').classList.remove('open');
    if (window.location.pathname.includes('/pesanan/detail/')) {
        window.history.pushState({}, '', `${BASE_URL}/pesanan`);
    }
}

document.getElementById('detailModal').addEventListener('click', event => {
    if (event.target.id === 'detailModal') closeDetail();
});

document.getElementById('reasonModal').addEventListener('click', event => {
    if (event.target.id === 'reasonModal') closeReasonModal();
});

if (selectedId) {
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('tr[data-pesanan]').forEach(row => {
            const data = JSON.parse(row.dataset.pesanan);
            if (Number(data.id_pesanan) === selectedId) openDetail(row);
        });
    });
}
</script>

</body>
</html>