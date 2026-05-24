<?php
// Controller::view() calls extract($data), sehingga variabel tersedia langsung
// Pastikan session aktif
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login');
    exit;
}

$role = $role ?? $_SESSION['role'] ?? 'client';
?>
<!-- Unified Dashboard View -->
<?php if ($role === 'admin'): ?>
    <?php require_once __DIR__ . '/../admin/dashboard.php'; ?>
<?php elseif ($role === 'freelancer'): ?>
    <?php require_once __DIR__ . '/../worker/dashboard.php'; ?>
<?php else: ?>
    <?php require_once __DIR__ . '/../user/dashboard.php'; ?>
<?php endif; ?>
