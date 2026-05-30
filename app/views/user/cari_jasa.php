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
            <div class="filter-bar filter-bar-lg">
                <div class="filter-search filter-search-wide">
                    <input type="text" id="searchInput" placeholder="Cari nama jasa..." oninput="filterCards()"
                           class="filter-input">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#94a3b8" width="16" height="16"
                         class="filter-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                </div>
                <select id="filterKategori" onchange="filterCards()"
                        class="filter-select">
                    <option value="">Semua kategori</option>
                    <?php foreach($kategoris as $k): ?>
                    <option value="<?= htmlspecialchars($k['nama_kategori']) ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <p id="resultCount" class="result-count"><?= count($jasaList) ?> jasa ditemukan</p>

            <!-- Grid Jasa -->
            <div id="jasaGrid" class="service-grid service-grid-client">
                <?php if (!empty($jasaList)): ?>
                    <?php foreach($jasaList as $j): ?>
                    <div class="jasa-card card-container service-card service-card-clickable"
                         data-nama="<?= strtolower(htmlspecialchars($j['nama_jasa'])) ?>"
                         data-kategori="<?= htmlspecialchars($j['nama_kategori'] ?? '') ?>">
                        <div class="service-card-image service-card-image-client">
                            <?php if (!empty($j['gambar'])): ?>
                                <img src="<?= BASE_URL . '/' . htmlspecialchars(ltrim($j['gambar'], '/')) ?>" alt="<?= htmlspecialchars($j['nama_jasa']) ?>" class="service-card-img">
                            <?php else: ?>
                            🎨
                            <?php endif; ?>
                        </div>
                        <div class="service-card-body">
                            <span class="badge secondary badge-card-category"><?= htmlspecialchars($j['nama_kategori'] ?? 'Umum') ?></span>
                            <div class="service-card-title service-card-title-client"><?= htmlspecialchars($j['nama_jasa']) ?></div>
                            <div class="service-card-desc service-card-desc-client">oleh <?= htmlspecialchars($j['nama_freelancer'] ?? '-') ?></div>
                            <div class="service-card-meta service-card-meta-client">
                                <span class="service-card-price service-card-price-client">Rp<?= number_format($j['harga'],0,',','.') ?></span>
                                <a href="<?= BASE_URL ?>/jasa/detail/<?= $j['id_jasa'] ?>" class="btn btn-primary btn-card-order">Pesan</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state-full">
                        <div class="empty-state-icon">🔍</div>
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
