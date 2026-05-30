<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login'); exit;
}
$jasaList = $jasa ?? [];
$kategoris = $kategori ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Jasa – Servora</title>
    <meta name="description" content="Temukan jasa mahasiswa terbaik sesuai kebutuhanmu di Servora.">
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
                <h1 class="page-title">Cari Jasa</h1>
                <p class="page-subtitle">Temukan jasa yang paling sesuai dengan kebutuhanmu.</p>
            </div>
        </header>

        <div class="page-content">

            <!-- Filter Bar -->
            <div style="display:flex;gap:10px;margin-bottom:24px;flex-wrap:wrap;">
                <div style="position:relative;flex:1;min-width:200px;max-width:320px;">
                    <input type="text" id="searchInput" placeholder="Cari nama jasa..." oninput="filterCards()"
                           style="width:100%;padding:10px 14px 10px 36px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8" width="16" height="16"
                         style="position:absolute;left:12px;top:50%;transform:translateY(-50%);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
                <select id="filterKategori" onchange="filterCards()"
                        style="padding:10px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;background:#fff;">
                    <option value="">Semua kategori</option>
                    <?php foreach($kategoris as $k): ?>
                    <option value="<?= htmlspecialchars($k['nama_kategori']) ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <p id="resultCount" style="font-size:13px;color:#64748b;margin-bottom:16px;"><?= count($jasaList) ?> jasa ditemukan</p>

            <!-- Grid Jasa -->
            <div id="jasaGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:20px;">
                <?php if (!empty($jasaList)): ?>
                    <?php foreach($jasaList as $j): ?>
                    <div class="jasa-card card-container"
                         data-nama="<?= strtolower(htmlspecialchars($j['nama_jasa'])) ?>"
                         data-kategori="<?= htmlspecialchars($j['nama_kategori'] ?? '') ?>"
                         style="padding:0;overflow:hidden;cursor:pointer;transition:box-shadow .2s;"
                         onmouseover="this.style.boxShadow='0 8px 30px rgba(0,0,0,0.12)'"
                         onmouseout="this.style.boxShadow=''">
                        <div style="height:140px;background:linear-gradient(135deg,#6366f1,#818cf8);display:flex;align-items:center;justify-content:center;font-size:40px;overflow:hidden;">
                            <?php if (!empty($j['gambar'])): ?>
                                <img src="<?= BASE_URL . '/' . htmlspecialchars(ltrim($j['gambar'], '/')) ?>" alt="<?= htmlspecialchars($j['nama_jasa']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            🎨
                            <?php endif; ?>
                        </div>
                        <div style="padding:16px;">
                            <span class="badge secondary" style="font-size:11px;margin-bottom:8px;display:inline-block;"><?= htmlspecialchars($j['nama_kategori'] ?? 'Umum') ?></span>
                            <div style="font-weight:700;font-size:15px;margin-bottom:4px;color:#1e293b;"><?= htmlspecialchars($j['nama_jasa']) ?></div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:12px;">oleh <?= htmlspecialchars($j['nama_freelancer'] ?? '-') ?></div>
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <span style="font-weight:700;color:#6366f1;font-size:15px;">Rp<?= number_format($j['harga'],0,',','.') ?></span>
                                <a href="<?= BASE_URL ?>/jasa/detail/<?= $j['id_jasa'] ?>" class="btn btn-primary" style="font-size:12px;padding:6px 14px;">Pesan</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#94a3b8;">
                        <div style="font-size:48px;margin-bottom:12px;">🔍</div>
                        <p>Belum ada jasa yang tersedia.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>
</div>

<script>
function filterCards() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const kat = document.getElementById('filterKategori').value;
    const cards = document.querySelectorAll('.jasa-card');
    let visible = 0;
    cards.forEach(card => {
        const nama = card.dataset.nama || '';
        const kategori = card.dataset.kategori || '';
        const show = nama.includes(q) && (kat === '' || kategori === kat);
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('resultCount').textContent = visible + ' jasa ditemukan';
}
</script>

</body>
</html>
