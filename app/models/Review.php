<?php
require_once __DIR__ . '/../core/Database.php';

class Review {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getByJasa($id_jasa) {
        $query = "SELECT r.*, u.nama as nama_client 
                  FROM review r
                  JOIN pesanan p ON r.id_pesanan = p.id_pesanan
                  JOIN users u ON r.id_client = u.id_user
                  WHERE p.id_jasa = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_jasa);
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

    public function create($data) {
        $query = "INSERT INTO review (id_pesanan, id_client, rating, komentar) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        mysqli_stmt_bind_param($stmt, "iids", 
            $data['id_pesanan'], $data['id_client'], $data['rating'], $data['komentar']
        );
        return mysqli_stmt_execute($stmt);
    }
}
