<?php
require_once __DIR__ . '/../core/Database.php';

class Pesanan {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client 
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user";
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
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client 
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  WHERE p.id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $query = "INSERT INTO pesanan (id_client, id_jasa, status, deadline, catatan) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        $status = $data['status'] ?? 'pending';
        
        mysqli_stmt_bind_param($stmt, "iisss", 
            $data['id_client'], $data['id_jasa'], $status, 
            $data['deadline'], $data['catatan']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getByClient($clientId) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_freelancer
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON j.id_user = u.id_user
                  WHERE p.id_client = ?
                  ORDER BY p.created_at DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getByFreelancer($freelancerId) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  WHERE j.id_user = ?
                  ORDER BY p.created_at DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $freelancerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE pesanan SET status=? WHERE id_pesanan=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function delete($id) {
        $query = "DELETE FROM pesanan WHERE id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    /** Hitung pesanan client berdasarkan status */
    public function countByClientStatus($clientId, $status) {
        $query = "SELECT COUNT(*) as total FROM pesanan WHERE id_client = ? AND status = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $clientId, $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Hitung pesanan freelancer berdasarkan status */
    public function countByFreelancerStatus($freelancerId, $status) {
        $query = "SELECT COUNT(*) as total 
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  WHERE j.id_user = ? AND p.status = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $freelancerId, $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Pesanan terbaru milik client (limit 5) */
    public function getRecentByClient($clientId, $limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_freelancer
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON j.id_user = u.id_user
                  WHERE p.id_client = ?
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $clientId, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /** Pesanan terbaru masuk ke freelancer (limit 5) */
    public function getRecentByFreelancer($freelancerId, $limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  WHERE j.id_user = ?
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $freelancerId, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /** Total semua pesanan (admin) */
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM pesanan";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Pesanan terbaru untuk admin (limit 5) */
    public function getRecentAll($limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

