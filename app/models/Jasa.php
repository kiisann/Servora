<?php
require_once __DIR__ . '/../core/Database.php';

class Jasa {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT j.*, u.nama as nama_freelancer, k.nama_kategori 
                  FROM jasa j
                  JOIN users u ON j.id_user = u.id_user
                  JOIN kategori_jasa k ON j.id_kategori = k.id_kategori
                  WHERE j.status = 'aktif'";
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
        $query = "SELECT j.*, u.nama as nama_freelancer, k.nama_kategori 
                  FROM jasa j
                  JOIN users u ON j.id_user = u.id_user
                  JOIN kategori_jasa k ON j.id_kategori = k.id_kategori
                  WHERE j.id_jasa = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $query = "INSERT INTO jasa (id_user, id_kategori, nama_jasa, deskripsi, harga, gambar, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        $status = $data['status'] ?? 'aktif';
        
        mysqli_stmt_bind_param($stmt, "iissdss", 
            $data['id_user'], $data['id_kategori'], $data['nama_jasa'], 
            $data['deskripsi'], $data['harga'], $data['gambar'], $status
        );
        return mysqli_stmt_execute($stmt);
    }

    public function update($id, $data) {
        $query = "UPDATE jasa SET id_kategori=?, nama_jasa=?, deskripsi=?, harga=?, gambar=?, status=? WHERE id_jasa=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "issdssi", 
            $data['id_kategori'], $data['nama_jasa'], $data['deskripsi'], 
            $data['harga'], $data['gambar'], $data['status'], $id
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getByUser($userId) {
        $query = "SELECT j.*, k.nama_kategori 
                  FROM jasa j
                  JOIN kategori_jasa k ON j.id_kategori = k.id_kategori
                  WHERE j.id_user = ?
                  ORDER BY j.id_jasa DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getAllAdmin() {
        $query = "SELECT j.*, u.nama as nama_freelancer, k.nama_kategori 
                  FROM jasa j
                  JOIN users u ON j.id_user = u.id_user
                  JOIN kategori_jasa k ON j.id_kategori = k.id_kategori
                  ORDER BY j.id_jasa DESC";
        $result = mysqli_query($this->conn, $query);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function countByUser($userId) {
        $query = "SELECT COUNT(*) as total FROM jasa WHERE id_user = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    public function delete($id) {
        $query = "DELETE FROM jasa WHERE id_jasa = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
