<?php
require_once __DIR__ . '/../core/Database.php';

class Review{

    private $conn;
    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }

    public function getByJasa($id_jasa) {
        $query = "SELECT r.*, u.nama AS nama_client, u.foto FROM review r JOIN pesanan p ON r.id_pesanan = p.id_pesanan JOIN users u ON r.id_client = u.id_user WHERE p.id_jasa = ? ORDER BY r.created_at DESC";
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

        mysqli_stmt_bind_param(
            $stmt,
            "iiis",
            $data['id_pesanan'],
            $data['id_client'],
            $data['rating'],
            $data['komentar']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getAll(){
        $query = "SELECT review.*, users.nama AS nama_user, users.foto FROM review JOIN users ON review.id_client = users.id_user ORDER BY review.created_at DESC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function delete($id){
        $query = "DELETE FROM review WHERE id_review = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}