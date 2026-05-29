<?php

class MonitoringController extends Controller {

    public function index() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Hanya admin
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        // Load model
        $monitoringModel = $this->model('Monitoring');

        // Data
        $data = [

            'role' => $_SESSION['role'],
            'nama' => $_SESSION['nama'],

            'total_pengguna' => $monitoringModel->getTotalUsers(),

            'total_jasa' => $monitoringModel->getTotalJasa(),

            'total_pesanan' => $monitoringModel->getTotalPesanan(),

            'logs' => $monitoringModel->getLogs()
        ];

        $this->view('admin/monitoring', $data);
    }
}