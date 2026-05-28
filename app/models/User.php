<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT * FROM users";
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
        $query = "SELECT * FROM users WHERE id_user = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function getByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $query = "INSERT INTO users (role, status, nama, email, password, no_hp, saldo, kampus, bio, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        $role = $data['role'] ?? 'client';
        $status = $data['status'] ?? 'aktif';
        $saldo = $data['saldo'] ?? 0.00;
        
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "ssssssdsss", 
            $role, $status, $data['nama'], $data['email'], 
            $hashed_password, $data['no_hp'], $saldo, 
            $data['kampus'], $data['bio'], $data['foto']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function update($id, $data) {
        $query = "UPDATE users SET nama=?, no_hp=?, kampus=?, bio=?, foto=? WHERE id_user=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", 
            $data['nama'], $data['no_hp'], $data['kampus'], 
            $data['bio'], $data['foto'], $id
        );
        return mysqli_stmt_execute($stmt);
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id_user = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    public function updateByAdmin($id, $data) {
        $query = "UPDATE users SET nama=?, email=?, role=?, status=?, no_hp=?, kampus=?, bio=?, saldo=? WHERE id_user=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssdi",
            $data['nama'], 
            $data['email'], 
            $data['role'], 
            $data['status'],
            $data['no_hp'], 
            $data['kampus'], 
            $data['bio'], 
            $data['saldo'], 
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    /** Total semua user (admin) */
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role != 'admin'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Pengguna terbaru (admin) */
    public function getRecent($limit = 5) {
        $query = "SELECT * FROM users WHERE role != 'admin' ORDER BY id_user DESC LIMIT ?";
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