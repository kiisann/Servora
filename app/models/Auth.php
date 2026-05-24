<?php
class Auth {
    private $conn;

    public function __construct() {
        global $conn;
        if (!$conn) {
            die('Database connection not available.');
        }
        $this->conn = $conn;
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }

    public function register($data) {
        $query = "INSERT INTO users (role, status, nama, email, password, no_hp, kampus) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            return false;
        }

        $role            = $data['role'] ?? 'client';
        $status          = 'aktif';
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "sssssss", 
            $role, $status, $data['nama'], $data['email'], 
            $hashed_password, $data['no_hp'], $data['kampus']
        );
        
        return mysqli_stmt_execute($stmt);
    }

    public function checkEmailExists($email) {
        $query = "SELECT id_user FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_num_rows($result) > 0;
    }
}
