<?php
class MonitoringController extends Controller {
    private $monitoringModel;

    public function __construct(){
        $this->monitoringModel = $this->model('Monitoring');
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $filter_tipe = $_GET['tipe'] ?? '';

        if ($filter_tipe) {
            $logs = $this->monitoringModel->getLogsByTipe($filter_tipe);
        } else {
            $logs = $this->monitoringModel->getLogs();
        }

        $total_pengguna = $this->monitoringModel->getTotalUsers();
        $total_jasa = $this->monitoringModel->getTotalJasa();
        $total_pesanan = $this->monitoringModel->getTotalPesanan();

        require '../app/views/admin/monitoring.php';
    }
}
