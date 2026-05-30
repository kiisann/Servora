<?php
class MonitoringController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $monitoringModel = $this->model('Monitoring');

        $filter_tipe = $_GET['tipe'] ?? '';
        $tipe_valid = ['info','warning','error'];

        if(!empty($filter_tipe) && in_array($filter_tipe, $tipe_valid)){
            $logs = $monitoringModel->getLogs($filter_tipe,50);
        }else{
            $filter_tipe = '';
            $logs = $monitoringModel->getLogs(null,50);
        }
        
        $data = [
            'role' => $_SESSION['role'],
            'nama' => $_SESSION['nama'],
            'total_pengguna' => $monitoringModel->getTotalUsers(),
            'total_jasa' => $monitoringModel->getTotalJasa(),
            'total_pesanan' => $monitoringModel->getTotalPesanan(),
            'logs' => $logs,
            'filter_tipe' => $filter_tipe
        ];


        $this->view('admin/monitoring', $data);
    }
}
