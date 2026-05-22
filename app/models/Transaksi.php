<?php
require_once __DIR__ . '/../core/Database.php';

class Transaksi {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT * FROM transaksi";
        $result = mysqli_query($this->conn, $query);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getById($id) {
        $query = "SELECT * FROM transaksi WHERE id_transaksi = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $query = "INSERT INTO transaksi (id_pesanan, total, id_metode, status_bayar) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        $status_bayar = $data['status_bayar'] ?? 'belum lunas';
        
        mysqli_stmt_bind_param($stmt, "idis", 
            $data['id_pesanan'], $data['total'], $data['id_metode'], $status_bayar
        );
        return mysqli_stmt_execute($stmt);
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE transaksi SET status_bayar=? WHERE id_transaksi=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
    }
}
