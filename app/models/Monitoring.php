<?php

class Monitoring {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
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

        $monitoringModel = $this->model('Monitoring');

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

        public function catat($pengguna, $deskripsi, $tipe = 'info') {
        $query = "INSERT INTO log_aktivitas (pengguna, deskripsi, tipe) VALUES (?, ?, ?)";
        $stmt  = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $pengguna, $deskripsi, $tipe);
        return mysqli_stmt_execute($stmt);
    }

    public function getAll($limit = 50) {
        $query  = "SELECT * FROM log_aktivitas ORDER BY created_at DESC LIMIT ?";
        $stmt   = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role != 'admin'";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);

        return $data['total'] ?? 0;
    }

    public function getTotalJasa() {
        $query  = "SELECT COUNT(*) AS total FROM jasa WHERE status != 'dihapus'";
        $result = mysqli_query($this->conn, $query);
        $row    = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }
 
    public function getTotalPesanan() {
        $query  = "SELECT COUNT(*) AS total FROM pesanan";
        $result = mysqli_query($this->conn, $query);
        $row    = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    public function getLogs($limit = 10) {
        $query  = "SELECT * FROM log_aktivitas ORDER BY created_at DESC LIMIT ?";
        $stmt   = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
 
    public function getLogsByTipe($tipe, $limit = 50) {
        $query  = "SELECT * FROM log_aktivitas WHERE tipe = ? ORDER BY created_at DESC LIMIT ?";
        $stmt   = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $tipe, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    
    public function getAllLogs(){
        $query = "SELECT * FROM log_aktivitas ORDER BY created_at DESC";
        return $this->conn->query($query);
    }
}