<?php
class MonitoringController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Hanya admin yang boleh akses monitoring
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        global $conn;

        $queryUser = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role != 'admin'");
        $totalUser = mysqli_fetch_assoc($queryUser);

        $queryJasa = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jasa");
        $totalJasa = mysqli_fetch_assoc($queryJasa);

        $queryPesanan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pesanan");
        $totalPesanan = mysqli_fetch_assoc($queryPesanan);

        $userQuery = mysqli_query($conn, "SELECT * FROM log_aktivitas ORDER BY created_at DESC LIMIT 10 ");
        $logs = [];

        while($row = mysqli_fetch_assoc($userQuery)) {
            $logs[] = $row;
        }

        $data = [
            'role' => $_SESSION['role'],
            'nama' => $_SESSION['nama'],
            'total_pengguna' => $totalUser['total'],
            'total_jasa' => $totalJasa['total'],
            'total_pesanan' => $totalPesanan['total'],
            'logs' => $logs
        ];


        $this->view('admin/monitoring', $data);
    }
}
