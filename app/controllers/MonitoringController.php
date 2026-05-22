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

        $data['role'] = $_SESSION['role'];
        $data['nama'] = $_SESSION['nama'];

        $this->view('admin/monitoring', $data);
    }
}
