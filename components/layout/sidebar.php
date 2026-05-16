<?php
require_once __DIR__ . '/../../auth/login.php';
include __DIR__ . '/../../assets/icons/icons.php';
$currentUser = getCurrentUser();
$currentRole = $currentUser['role'];
$currentPage = basename($_SERVER['PHP_SELF']);

$menus = [
    'admin' => [
        ['icon' => $icons['dashboard'], 'text' => 'Dashboard', 'url' => '../../views/admin/dashboard.php', 'page' => 'dashboard.php'],
        ['icon' => $icons['users'], 'text' => 'Kelola Pengguna', 'url' => '../../views/admin/pesanan.php', 'page' => 'pesanan.php'],
        ['icon' => $icons['package'], 'text' => 'Kelola Jasa', 'url' => '../../views/admin/kelola_jasa.php', 'page' => 'kelola_jasa.php'],
        ['icon' => $icons['monitoring'], 'text' => 'Monitoring', 'url' => '../../views/admin/monitoring.php', 'page' => 'monitoring.php']
        // ['icon' => $icons['worker'], 'text' => 'Pekerja', 'url' => '../../views/admin/pekerja.php']
    ],
    'client' => [
        ['icon' => $icons['dashboard'], 'text' => 'Dashboard', 'url' => '../../views/user/dashboard.php', 'page' => 'dashboard.php'],
        ['icon' => $icons['search'], 'text' => 'Cari Jasa', 'url' => '../../views/user/cari_jasa.php', 'page' => 'cari_jasa.php'],
        ['icon' => $icons['shopping-cart'], 'text' => 'Pesanan', 'url' => '../../views/user/pesanan.php', 'page' => 'pesanan.php'],
        ['icon' => $icons['history'], 'text' => 'Riwayat Pesanan', 'url' => '../../views/user/riwayat.php', 'page' => 'riwayat.php']
    ],
    'worker' => [
        ['icon' => $icons['dashboard'], 'text' => 'Dashboard', 'url' => '../../views/worker/dashboard.php', 'page' => 'dashboard.php'],
        ['icon' => $icons['cog'], 'text' => 'Kelola Jasa', 'url' => '../../views/worker/kelola_jasa.php', 'page' => 'kelola_jasa.php'],
        ['icon' => $icons['package'], 'text' => 'Pesanan Masuk', 'url' => '../../views/worker/pesanan_masuk.php', 'page' => 'pesanan_masuk.php'],
        ['icon' => $icons['history'], 'text' => 'Riwayat', 'url' => '../../views/worker/riwayat.php', 'page' => 'riwayat.php']
        // ['icon' => '', 'text' => '', 'url' => '']
    ]
];

$currentMenus = $menus[$currentRole] ?? [];
?>

<aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>
        
        <nav class="sidebar-nav">
            <?php foreach($currentMenus as $menu): 
                $activeClass = ($currentPage === $menu['page']) ? 'active' : '';?>
            <a href="<?= APP_URL . $menu['url']; ?>" class="nav-item <?= $activeClass; ?>">
                <?= $menu['text']; ?>
            </a>
            <?php endforeach; ?>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://wallpapers.com/images/hd/cool-profile-picture-kpwjvjw5434qfzo3.jpg" alt="Admin Profile">
                <div class="user-info">
                    <div class="name"><?= htmlspecialchars($currentUser['name']) ?></div>
                    <div class="role"><?= htmlspecialchars($currentUser['role']) ?></div>
                </div>
            </div>
        </div>
    </aside>