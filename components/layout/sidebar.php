<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Load icons
include __DIR__ . '/../../assets/icons/icons.php';

// Ambil data user dari session (diset saat login)
$currentUser = [
    'name'   => $_SESSION['nama'] ?? 'Guest',
    'role'   => $_SESSION['role'] ?? 'client',
    'avatar' => strtoupper(mb_substr($_SESSION['nama'] ?? 'G', 0, 1)),
];
$currentRole = $currentUser['role'];

// Deteksi halaman aktif dari URL
$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$menus = [
    'admin' => [
        ['icon' => $icons['dashboard'],   'text' => 'Dashboard',        'url' => '/dashboard',             'match' => '/dashboard'],
        ['icon' => $icons['users'],       'text' => 'Kelola Pengguna',  'url' => '/user',                  'match' => '/user'],
        ['icon' => $icons['package'],     'text' => 'Kelola Jasa',      'url' => '/jasa',                  'match' => '/jasa'],
        ['icon' => $icons['monitoring'],  'text' => 'Monitoring',       'url' => '/monitoring',             'match' => '/monitoring'],
    ],
    'client' => [
        ['icon' => $icons['dashboard'],      'text' => 'Dashboard',       'url' => '/dashboard',  'match' => '/dashboard'],
        ['icon' => $icons['search'],         'text' => 'Cari Jasa',       'url' => '/jasa',       'match' => '/jasa'],
        ['icon' => $icons['shopping-cart'],  'text' => 'Pesanan',         'url' => '/pesanan',    'match' => '/pesanan'],
        ['icon' => $icons['history'],        'text' => 'Riwayat Pesanan', 'url' => '/riwayat',    'match' => '/riwayat'],
    ],
    'freelancer' => [
        ['icon' => $icons['dashboard'],  'text' => 'Dashboard',      'url' => '/dashboard',    'match' => '/dashboard'],
        ['icon' => $icons['cog'],        'text' => 'Kelola Jasa',    'url' => '/worker/jasa',  'match' => '/worker/jasa'],
        ['icon' => $icons['package'],    'text' => 'Pesanan Masuk',  'url' => '/pesanan',      'match' => '/pesanan'],
        ['icon' => $icons['history'],    'text' => 'Riwayat',        'url' => '/riwayat',      'match' => '/riwayat'],
    ],
];

$currentMenus = $menus[$currentRole] ?? $menus['client'];
$baseUrl = defined('BASE_URL') ? BASE_URL : '';
?>

<aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>
        
        <nav class="sidebar-nav">
            <?php foreach($currentMenus as $menu):
                $isActive = isset($menu['match']) && strpos($currentUri, $menu['match']) !== false;
                $activeClass = $isActive ? 'active' : '';
            ?>
            <a href="<?= $baseUrl . $menu['url']; ?>" class="nav-item <?= $activeClass; ?>">
                <?= $menu['icon']; ?>
                <span><?= $menu['text']; ?></span>
            </a>
            <?php endforeach; ?>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= $baseUrl ?>/profile" class="user-profile-small" style="text-decoration:none;">
                <div class="sidebar-avatar"><?= htmlspecialchars($currentUser['avatar']) ?></div>
                <div class="user-info">
                    <div class="name"><?= htmlspecialchars($currentUser['name']) ?></div>
                    <div class="role"><?= ucfirst(htmlspecialchars($currentUser['role'])) ?></div>
                </div>
            </a>
            <a href="<?= $baseUrl ?>/auth/logout" class="sidebar-logout" title="Keluar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0l-3-3m3 3H9" /></svg>
            </a>
        </div>
    </aside>